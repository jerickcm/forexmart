$.widget("custom.PTContextMenu", {
    // default options
    options: {
        activation: "hover",
        items: null,
        zIndex: 5,
        FadeTime: 50,
        // callbacks
        callBack: null,
        SubMenuCloseCallBack: null,
        close: null,
        classexception: []
    },
    // the constructor
    _create: function () {
        //declaring this to a variable
        var self = this;
        //Property to prevent from calling global callback when item has a seperate callback to prevent double firing of the functions
        self.PreventFromCallingGlobalCallBack = false;
        self.PreventFromCreating = false;
        //Adding class to the main element
        this.element
          // add a class for theming
          .addClass(self.options.activation === "leftclick" ? "wt-ContextMenu wt-ContextLeftClick" : "wt-ContextMenu")
          // prevent double click to select text
          .disableSelection();

        //function to create all elements needed on the plugin including sorting of the elements depending on the parent and child
        this.CreateElement = function () {
            self.RemoveAllElementInPlugin();
            //Creating the base element of the menu
            var list = $('<ul class="PTMainContextMenu" style=" display:none; position:absolute;  z-index:' +
                         self.options.zIndex + '">');
            $.each(self.options.items(), function (i, value) {
                var IsItemDisabled = false;
                if (typeof value.disabled !== 'undefined') {
                    if (value.disabled === true) {
                        IsItemDisabled = true;
                    }
                }
                var item = $('<li ' + ((IsItemDisabled) ? ' IsDisabled="true"' : "") +
                                       ((value.className) ? ' class="' + value.className + '"' : "") +
                                       ' ItemCallBackName="' + i + '">' +
                                        ((!value.appendElement) ? value.name : "") + '</li>')

                if (value.appendElement) {
                    item.append(value.appendElement);
                }
                if (value.callback) {
                    SubscribeClickEventOnItem(item, value.callback);
                }
                if (value.items) {
                    item.addClass('PTContext-Sub-Menu');
                    checkChild(value.items, item);
                }
                if (value.HasBorderTop) {
                    list.append('<hr>');
                }
                list.append(item);
            });
            self.ContextMenu = list;
            self.element.append(self.ContextMenu);
            //Function to check child of the item and create element for it
            function checkChild(items, parent) {
                var children = $('<ul>');
                $.each(items, function (i, value) {
                    var IsItemDisabled = false;
                    if (typeof value.disabled !== 'undefined') {
                        if (value.disabled === true) {
                            IsItemDisabled = true;
                        }
                    }
                    var item = $('<li ' + ((IsItemDisabled) ? ' IsDisabled="true"' : "") +
                                           ((value.className) ? ' class="' + value.className + '"' : "") +
                                           ' ItemCallBackName="' + i + '">' +
                                            ((!value.appendElement) ? value.name : "") + '</li>')
                    if (value.appendElement) {
                        item.append(value.appendElement);
                    }
                    if (value.callback) {
                        SubscribeClickEventOnItem(item, value.callback);
                    }
                    children.append(item);
                    if (value.items) {
                        item.addClass('PTContext-Sub-Menu');
                        checkChild(value.items, item);
                    }
                    if (value.HasBorderTop) {
                        parent.append('<hr>');
                    }
                    parent.append(children);
                });
            }
            //Subscribing Click event on Items
            function SubscribeClickEventOnItem(item, callback) {
                item.on('click', function (e) {
                    //Prevent from calling the call back when item is disabled
                    if (!$(e.target).attr('IsDisabled')) {
                        var CallBackReturn = callback($(e.target).attr('ItemCallBackName'));
                        if (typeof CallBackReturn !== 'undefined') {
                            if (CallBackReturn) {
                                self.RemoveAllElementInPlugin(true);
                                if (self.options.activation === "leftclick") {
                                    self.PreventFromCreating = true;
                                }
                            }
                        }
                        else {
                            self.RemoveAllElementInPlugin(true);
                        }
                        self.PreventFromCallingGlobalCallBack = true;
                    }
                });
            }
            self.element.find('.PTContext-Sub-Menu').hover(function () {
                $($(this).find('ul')[0]).removeAttr('style');
                $($(this).find('ul')[0]).css('left', '100%');
                $($(this).find('ul')[0]).css('top', '-2px');
                var IsWidthOverlap = false;
                if ($($(this).find('ul')[0]).offset()) {
                    if ($($(this).find('ul')[0]).offset().left + $($(this).find('ul')[0]).outerWidth() > $(document).width()) {
                        $($(this).find('ul')[0]).removeAttr('style');
                        $($(this).find('ul')[0]).css('right', '100%');
                        IsWidthOverlap = true;
                    }
                }

                $($(this).find('ul')[0]).css('top', '-2px');
                if ($($(this).find('ul')[0]).offset()) {
                    if ($($(this).find('ul')[0]).offset().top + $($(this).find('ul')[0]).outerHeight() > $(document).height()) {
                        $($(this).find('ul')[0]).removeAttr('style');
                        if (IsWidthOverlap) {
                            $($(this).find('ul')[0]).css('right', '100%');
                        }
                        else {
                            $($(this).find('ul')[0]).css('left', '100%');
                        }
                        $($(this).find('ul')[0]).css('bottom', '0%');
                    }
                }

                $($(this).find('ul')[0]).css('visibility', 'visible');
            }, function (e) {
                if (!$(e.relatedTarget).hasClass("wt-shadow")) {
                    $($(this).find('ul')[0]).css('visibility', 'hidden');
                    if (self.options.SubMenuCloseCallBack !== null) {
                        self.options.SubMenuCloseCallBack();
                    }
                }
            });
        };
        //Handles the right click of the Parent element
        this.element.on("contextmenu", function (e) {
            if (self.options.activation === "rightclick") {
                self.CreateElement();
                self.ContextMenu.fadeIn(self.options.FadeTime);
                if (self.HoveredXAxis + self.ContextMenu.width() > self.element.width() + 10) {
                    self.HoveredXAxis = self.HoveredXAxis - self.ContextMenu.width();
                }
                if (self.HoveredXAxis < 0) {
                    self.HoveredXAxis = 0;
                }
                self.ContextMenu.css({ "left": self.HoveredXAxis, "top": self.HoveredYAxis });
            }
            //Prevent Parent element from right click functionality
            return false;
        });
        //Get Xaxis and Yaxis of the mouse when activation is rightclick
        if (self.options.activation === "rightclick") {
            //Hover event to determin the location of the mouse
            self.element.mousemove(function (e) {
                var elem = self.element.offset();
                self.HoveredXAxis = e.pageX - elem.left;
                self.HoveredYAxis = e.pageY - elem.top;
            });
        }

        //Click on Parent Element
        this.element.on('click', function (e) {
            if (self.options.activation === "leftclick") {
                if (self.ContextMenu === null || self.ContextMenu === undefined) {
                    if (!self.PreventFromCreating) {
                        self.CreateElement();
                        self.ContextMenu.fadeIn(0);
                        if ($(this).find('.PTMainContextMenu').offset().left + $(this).find('.PTMainContextMenu').outerWidth() > $(document).width()) {
                            self.ContextMenu.css({ "left": $(this).find('.PTMainContextMenu').position().left - $(this).find('.PTMainContextMenu').outerWidth() });
                        }
                    }
                    else {
                        self.PreventFromCreating = false;
                    }
                }
            }
            if (self.ContextMenu) {
                if (!self.ContextMenu.is(e.target) && self.ContextMenu.has(e.target).length === 0) {
                    if (self.options.activation === "rightclick") {
                        self.RemoveAllElementInPlugin(true);
                    }
                }
                else {
                    if ($(e.target).hasClass('PTContext-Sub-Menu')) {
                        return;
                    };
                    if (self.options.callBack) {
                        //Prevent from calling the call back when item is disabled
                        if (!$(e.target).attr('IsDisabled') && !$(e.target).closest('li').attr('IsDisabled')) {
                            var ItemCallBackName = $(e.target).attr('ItemCallBackName');
                            if (typeof ItemCallBackName === "undefined") {
                                ItemCallBackName = $(e.target).closest('li').attr('ItemCallBackName');
                            }
                            //Validation when clicked border
                            if (typeof ItemCallBackName === "undefined") {
                                return;
                            }
                            if (self.options.callBack) {
                                //Call the global callback
                                if (self.PreventFromCallingGlobalCallBack) {
                                    self.PreventFromCallingGlobalCallBack = false;
                                }
                                else {
                                    var CallBackReturn = self.options.callBack(ItemCallBackName);
                                    if (typeof CallBackReturn !== 'undefined') {
                                        if (CallBackReturn) {
                                            self.RemoveAllElementInPlugin(true);
                                        }
                                    }
                                    else {
                                        self.RemoveAllElementInPlugin(true);
                                    }
                                }
                            }
                        }
                    };
                }
            }
        });
        //Removing all element in the plugin
        this.RemoveAllElementInPlugin = function (isClosed) {
            if (isClosed && isClosed === true) {
                if (self.element.find('.PTMainContextMenu').length !== 0) {
                    if (self.options.close !== null) {
                        //Firing the close call back of the plugin
                        self.options.close();
                    }
                }
            }
            //Removing element to recreate element needed for on demand Menu
            self.element.find('.PTMainContextMenu').remove();
            self.ContextMenu = null;
        };
        //Remove Element when hovered In/Out
        this.element.hover(function () {
            if (self.options.activation === "hover") {
                self.CreateElement();
                self.ContextMenu.fadeIn(0);
                if (self.HoveredXAxis + self.ContextMenu.width() > self.element.width() + 10) {
                    self.HoveredXAxis = self.HoveredXAxis - self.ContextMenu.width();
                }
                if ($(this).find('.PTMainContextMenu').offset().left + $(this).find('.PTMainContextMenu').outerWidth() > $(document).width()) {
                    self.ContextMenu.css({ "left": $(this).find('.PTMainContextMenu').position().left - $(this).find('.PTMainContextMenu').outerWidth() });
                }
            }
        }, function (e) {
            //Remove All element when hovered out of the plugin
            if (!$(e.relatedTarget).hasClass("sp-container") && !$(e.relatedTarget).hasClass("sp-palette-container") && !$(e.relatedTarget).hasClass("wt-ssp-container") && !$(e.relatedTarget).hasClass("wt-ssp-header") && !$(e.relatedTarget).hasClass("wt-ssp-header-textbox") && !$(e.relatedTarget).hasClass("wt-shadow")) {
                self.RemoveAllElementInPlugin(true);
            }
        });
        //Validation if click was made outside container
        $(document).click(function myfunction(e) {
            if ($.inArray(e.target.className, self.options.classexception) == -1 && !self.element.is(e.target) && self.element.has(e.target).length === 0) {
                self.RemoveAllElementInPlugin(true);
            }
        });
    },
    // events bound via _on are removed automatically
    // revert other modifications here
    _destroy: function () {
        self.RemoveAllElementInPlugin();
        self.element.removeClass('wt-ContextMenu');
    },
    // _setOptions is called with a hash of all options that are changing
    // always refresh when changing options
    _setOptions: function () {
        // _super and _superApply handle keeping the right this-context
        this._superApply(arguments);
    }
});