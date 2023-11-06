 (function ($) {

    $.widget("STWC.DropDown", {

        options: {
            title: null,
            controltype: "",
            setvalue: null,
            items: [{ text: "", value: "" }],
            selecteditem: null


        },

        _create: function () {
            var $elem = this.element;
            var $option = this.options;


            this._buildcontroltype($option.controltype, $elem, $option);

            return $elem;
        },

        _init: function () { },

        _buildcontroltype: function (type, elem, option) {
            if (option.title) this._BuildTooltip(elem);
            var self = this;
            switch (type) {
                //on-grid
                case "on-grid":
                    elem.addClass("wc-dd-grid-select control-clickable");
                    var slcttext = $('<span class="wc-dd-grid-select"/>').appendTo(elem).css("width", (elem.width() - 20) + "%");
                    var arrow = $('<span class="wc-dd-grid-arrow"/>').appendTo(elem);

                    var itemcontainer = $('<div class="wc-dd-grid-container"/>');//
                    itemcontainer.appendTo(elem);
                    $.each(option.items, function (index, item) {
                        var spanitem = $('<span class="wc-dd-options-item"/>');
                        spanitem.appendTo(itemcontainer).text(self._textvalidation(item)).on('click', function () {
                            var optionstext = self._textvalidation($(this).text());
                            slcttext.text(optionstext).attr('title', optionstext).trigger('change')
                            if ($.isFunction(option.selecteditem))
                                option.selecteditem(item);
                        });

                    })
                    var valuetext = option.setvalue != null ? option.setvalue : option.items[0];
                    slcttext.text(valuetext);
                    slcttext.attr('title', valuetext).tooltip({
                        position: {
                            my: "center bottom",
                            at: "center top-5",
                            collision: "fit"
                        }, tooltipClass: "wc-dd-tooltip",
                        open: function (event, ui) {
                            ui.tooltip.css("max-width", "100% !important");
                        }
                    });

                    function remove() {
                        itemcontainer.hide();
                        arrow.removeClass("ui-icon ui-icon-triangle-1-s wc-dd-grid-arrow-focus");
                    }
                    elem.on('click', function (e) {
                        if (e.target == elem[0] || $.contains(elem[0], e.target)) {
                            arrow.toggleClass("ui-icon ui-icon-triangle-1-s wc-dd-grid-arrow-focus");
                            itemcontainer.css({
                                "top": slcttext.offset().top + 21,
                                "left": slcttext.offset().left,
                                "width": elem.outerWidth()
                            }).toggle();
                        }
                        else {
                            remove();
                        }
                    });
                    elem.on("mousewheel", function () {
                        remove();
                    });
                    elem.on("mouseleave", function () {
                        remove()
                    })

                    break;

                case "on-input":
                    //var storageofitem;

                    elem.addClass("wc-dd-textbox-panel");
                    $('<input class="wc-dd-textbox"/>').appendTo(elem).on("keypress", function (e) {
                        if (e.which != 0 && e.which != 8 && e.which != 120 && e.which != 122 && e.which != 99 && e.which != 118 && (e.which < 48 || e.which > 57)) {
                            return false;
                        }
                    });

                    break;

                    //on-options
                case "on-options":
                    elem.addClass("wc-dd-options-select");

                    var slcttext = $('<span/>').addClass("wc-dd-options-text").appendTo(elem);
                    var arrow = $('<span class="wc-arrow-down-icon wc-fn-dropdown-arrow"/>').appendTo(elem);

                    var containerwidth = elem.width() ? elem.width() : elem.outerWidth() - 4;
                    var itemcontainer = $('<div class="wc-dd-options-container"/>').css("width", elem.outerWidth()).appendTo(elem);

                    $.each(option.items, function (index) {
                        var spanitem = $('<span class="wc-dd-options-item"/>').appendTo(itemcontainer);
                        var item = option.items[index];
                        var type = $.type(item);
                        switch (type) {
                            case "string":
                                spanitem.text(item).val(item).on('click', function () {
                                    slcttext.text(item).trigger('change');
                                    if ($.isFunction(option.selecteditem))
                                        option.selecteditem($(this).val());
                                });
                                break;
                            case "object":
                                spanitem.text(self._textvalidation(item.text)).val(item.value).on('click', function () {
                                    slcttext.text(self._textvalidation(item.text));
                                    if ($.isFunction(option.selecteditem))
                                        option.selecteditem(item);
                                });
                                break;
                        }

                    });
                    itemcontainer.wcScrollBar({
                        Orientation: 'y',
                        RailSteps: 15
                    });

                    slcttext.text(option.setvalue != null ? option.setvalue : $.type(option.items[0]) == "string" ? option.items[0] : option.items[0].text);

                    $(document).on('click', function (e) {

                        if ((e.target.id == elem[0].id || $.contains(elem[0], e.target))) {
                            itemcontainer.toggle();
                            arrow.toggleClass("arrowfoccus");
                            try {
                                itemcontainer.wcScrollBar("Refresh");
                            } catch (e) {
                                itemcontainer.wcScrollBar();
                                itemcontainer.wcScrollBar("Refresh");
                            }

                        }
                        else {
                            itemcontainer.hide();
                            arrow.removeClass("arrowfoccus");
                        }
                    });

                    break;
            }
        },

        //Adding Item on Options
        AddItem: function (item) {
            if (item == "undifined" || item == "") return null;

            if (this.options.controltype == "on-input") {
                dataitems = this._HandleData("AddItem", item);
                this._BuildOptions(dataitems);
            }
        },

        //Removinging Item on Options
        RemoveItem: function (item) {
            if (item == "undifined") return null;
            if (this.options.controltype == "on-input") {
                dataitems = this._HandleData("Remove", item);
                this._BuildOptions(dataitems);
            }
        },

        //Updating Items
        UpdateItem: function (item) {
            if (!item) return;

            this.element.children().remove();
            this.options.items = item;
            this._buildcontroltype(this.options.controltype, this.element, this.options);

            item = null;

        },

        _HandleData: function (method, item) {
            var getdata = $(this.element).data("input-" + this.uuid) ? $(this.element).data("input-" + this.uuid) : [];

            if (method == "AddItem") {

                if ($.inArray(item, getdata) > -1) return null;

                getdata.push(item);
                $(this.element).data("input-" + this.uuid, getdata);
                return getdata;
            }
            else {
                if (getdata.length == 0) return null;
                else {
                    var index = $.inArray(item, getdata);
                    if (index > -1) {
                        getdata.splice(index, 1);
                        $(this.element).data("input-" + this.uuid, getdata);
                        return getdata;
                    }
                    else {
                        return null;
                    }
                }
            }
        },

        _BuildOptions: function (getdata) {

            var elem = this.element;
            var option = this.options;


            $(this.element.contents()[0]).val("");
            if (getdata != null) {
                $(this.element.contents()[2]).remove();
                $(this.element.contents()[1]).remove();

                //var arrow = $(this.element.contents()[1]);
                if (getdata.length > 0) {
                    var arrow = $('<span class="ui-icon ui-icon-triangle-1-s wc-dd-textbox-arrow"/>').appendTo(elem[0]);
                    var itemcontainer = $('<div class="wc-dd-input-container"/>').appendTo(elem[0]).width($(elem.contents()[0]).outerWidth() - 1);

                    $.each(getdata, function (index, items) {
                        var spanitem = $('<span class="wc-dd-options-item"/>').appendTo(itemcontainer).text(items).on('click', function () {
                            $(elem.contents()[0]).val($(this).text());
                            if ($.isFunction(option.selecteditem))
                                option.selecteditem($(this).text()); $(elem.contents()[0]).focus();
                        });

                        if (items.length > 25) {
                            spanitem.attr('title', items).tooltip({
                                position: {
                                    my: "left top",
                                    at: "left bottom",
                                    collision: "fit"
                                }, tooltipClass: "wc-dd-tooltip",
                                open: function (event, ui) {
                                    ui.tooltip.css("max-width", "100% !important");
                                }
                            });
                        }


                    });

                    if (itemcontainer.outerHeight(true) > 125) {
                        itemcontainer.mCustomScrollbar({
                            axis: "y",
                            theme: "3d",
                            scrollButtons: { enable: true },
                            alwaysShowScrollbar: 1,
                            scrollInertia: 0
                        });
                    }

                    $(document).on('click', function (e) {
                        if (e.target == elem[0] || $.contains(elem[0], e.target)) {
                            arrow.toggleClass("arrowfoccus");
                            itemcontainer.toggle();
                        }
                        else {
                            itemcontainer.hide();
                            arrow.removeClass("arrowfoccus");
                        }
                    });
                }
            }
        },

        _BuildTooltip: function (element) {
            //if ( this.options.title ) {
            element.attr('title', this._textvalidation(this.options.title)).tooltip({
                position: {
                    my: "left center",
                    at: "right center",
                    collision: "fit"
                }
            });
            //}
        },

        _textvalidation: function (strname) {
            var trim = strname.toString().replace(/[^a-zA-Z0-9]/g, '_');
            var getTrans = WC.ChartWords[trim];

            if (!getTrans) {
                console.log(trim);
                return strname;
            }
            else {
                return getTrans;
            }
        }
    });

}(jQuery));