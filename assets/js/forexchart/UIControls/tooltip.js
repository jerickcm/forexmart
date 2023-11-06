$(function () {
    $.widget("ptwebtooltip.WCToolTip", {
        options: {
            content: function () {
                var title = $(this).attr("title") || "";
                return $("<a>").text(title).html();
            },
            hide: true,
            position: {
                at: "left bottom",
                my: "left top+15",
                collision: "flipfit flip"
            },
            show: true,
            track: false,

            close: null,
            open: null
        },

        _addDescribedBy: function (elem, id) {
            var describedby = (elem.attr("aria-describedby") || "").split(/\s+/);
            describedby.push(id);
            elem
                .data("wt-tooltip-id", id);
        },

        _removeDescribedBy: function (elem) {
            var id = elem.data("wt-tooltip-id"),
                describedby = (elem.attr("aria-describedby") || "").split(/\s+/),
                index = $.inArray(id, describedby);

            if (index !== -1) {
                describedby.splice(index, 1);
            }

            elem.removeData("wt-tooltip-id");
            describedby = $.trim(describedby.join(" "));
        },

        _create: function () {
            this._on({
                mouseover: "open",
                focusin: "open"
            });

            this.tooltips = {};
            this.parents = {};
        },

        open: function (event) {
            var that = this,
                target = $(event ? event.target : this.element)
            if (!target.length || target.data("wt-tooltip-id")) {
                return;
            }

            if (target.attr("title")) {
                target.data("wt-tooltip-title", target.attr("title"));
            }

            target.data("wt-tooltip-open", true);

            this._registerCloseHandlers(event, target);
            this._updateContent(target, event);
        },

        _updateContent: function (target, event) {
            var content,
                contentOption = this.options.content,
                that = this,
                eventType = event ? event.type : null;

            if (typeof contentOption === "string") {
                return this._open(event, target, contentOption);
            }

            content = contentOption.call(target[0], function (response) {
            });
            if (content) {
                this._open(event, target, content);
            }
        },

        _open: function (event, target, content) {
            var tooltipData, tooltip, delayedShow, a11yContent,
                positionOption = $.extend({}, this.options.position);

            if (!content) {
                return;
            }

            tooltipData = this._find(target);
            if (tooltipData) {
                tooltipData.tooltip.find(".wt-tooltip-content").html(content);
                return;
            }

            if (target.is("[title]")) {
                if (event && event.type === "mouseover") {
                    target.attr("title", "");
                } else {
                    target.removeAttr("title");
                }
            }

            tooltipData = this._tooltip(target);
            tooltip = tooltipData.tooltip;
            this._addDescribedBy(target, tooltip.attr("id"));
            tooltip.find(".wt-tooltip-content").html(content);

            function position(event) {
                positionOption.of = event;
                if (tooltip.is(":hidden")) {
                    return;
                }
                tooltip.position(positionOption);
            }
            tooltip.position($.extend({
                of: target
            }, this.options.position));

            tooltip.hide();

            this._show(tooltip, this.options.show);

            this._trigger("open", event, { tooltip: tooltip });
        },

        _registerCloseHandlers: function (event, target) {
            var events = {
                keyup: function (event) {
                    if (event.keyCode === $.ui.keyCode.ESCAPE) {
                        var fakeEvent = $.Event(event);
                        fakeEvent.currentTarget = target[0];
                        this.close(fakeEvent, true);
                    }
                }
            };

            if (target[0] !== this.element[0]) {
                events.remove = function () {
                    this._removeTooltip(this._find(target).tooltip);
                };
            }

            if (!event || event.type === "mouseover") {
                events.mouseleave = "close";
            }
            if (!event || event.type === "focusin") {
                events.focusout = "close";
            }
            this._on(true, target, events);
        },

        close: function (event) {
            var tooltip,
                that = this,
                target = $(event ? event.currentTarget : this.element),
                tooltipData = this._find(target);

            if (!tooltipData) {
                target.removeData("wt-tooltip-open");
                return;
            }

            tooltip = tooltipData.tooltip;
            if (tooltipData.closing) {
                return;
            }

            clearInterval(this.delayedShow);

            if (target.data("wt-tooltip-title") && !target.attr("title")) {
                target.attr("title", target.data("wt-tooltip-title"));
            }

            this._removeDescribedBy(target);

            tooltipData.hiding = true;
            tooltip.stop(true);
            this._hide(tooltip, this.options.hide, function () {
                that._removeTooltip($(this));
            });

            target.removeData("wt-tooltip-open");
            this._off(target, "mouseleave focusout keyup");

            if (target[0] !== this.element[0]) {
                this._off(target, "remove");
            }
            this._off(this.document, "mousemove");

            if (event && event.type === "mouseleave") {
                $.each(this.parents, function (id, parent) {
                    $(parent.element).attr("title", parent.title);
                    delete that.parents[id];
                });
            }

            tooltipData.closing = true;
            this._trigger("close", event, { tooltip: tooltip });
            if (!tooltipData.hiding) {
                tooltipData.closing = false;
            }
        },

        _tooltip: function (element) {
            var tooltip = $("<div>")
                    .attr("role", "tooltip")
                    .addClass("wt-tooltip"),
                id = tooltip.uniqueId().attr("id");

            $("<div>")
                .addClass("wt-tooltip-content")
                .appendTo(tooltip);

            tooltip.appendTo(this.document[0].body);

            return this.tooltips[id] = {
                element: element,
                tooltip: tooltip
            };
        },

        _find: function (target) {
            var id = target.data("wt-tooltip-id");
            return id ? this.tooltips[id] : null;
        },

        _removeTooltip: function (tooltip) {
            tooltip.remove();
            delete this.tooltips[tooltip.attr("id")];
        }
    })
});