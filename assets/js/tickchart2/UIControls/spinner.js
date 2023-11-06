$(function () {
    // Spinner Instance Dictionary
    var SpinnerDictionary = [];

    $.widget("spin.WCSpinner", {
        options: {
            // Value and Validation Properties
            DefaultValue: 0,
            Step: 1,
            DecimalPlaces: 0,
            MinValue: -999999,
            MaxValue: 999999,
            BidPrice: 0,
            AskPrice: 0,
            IsApplyBusinessRules: false,
            IsValidateOnEnter: false,

            // UI Properties
            Height: 18,
            IsAlignLeft: false,
            IsShowSpinButtons: true,
            IsDisabled: false,
            BorderColor: "gray",

            // Callbacks
            OnEnter: function () { },
            Spin: function () { },
            SpinUp: function () { },
            SpinDown: function () { },
            Stop: function () { }
        },
        _create: function () {
            if (!$(this.element[0].parentElement).hasClass("spinner-input-container")) {
                // Spinner Instance Dictionary
                var lastIndex = SpinnerDictionary.length == 0 ? -1 : SpinnerDictionary[SpinnerDictionary.length - 1].Index;
                var spinnerInstance = {
                    Id: "wt-spinner-" + (lastIndex + 1),
                    Index: SpinnerDictionary.length == 0 ? 0 : lastIndex + 1
                };
                SpinnerDictionary.push(spinnerInstance);

                // Spinner Components
                $(this.element[0]).addClass("wt-spinner");
                var spinnerContainer = "<div id='" + spinnerInstance.Id + "' class='spinner-container'></div>";
                var spinnerInputContainer = "<div class='spinner-input-container'></div>";
                var spinnerButtons = "<div class='spinner-button-group'><button class='spin-up-button'><span class='wt-arrow-up-icon'></span></button><button class='spin-down-button'><span class='wt-arrow-down-icon'></span></button></div>";

                // Construct Spinner                
                $(this.element[0].parentElement).append(spinnerContainer);
                $(spinnerInputContainer).appendTo("#" + spinnerInstance.Id);
                $(spinnerButtons).appendTo("#" + spinnerInstance.Id);
                $(this.element[0]).appendTo("#" + spinnerInstance.Id + ">.spinner-input-container");
            }
        },
        _init: function () {
            // Set Value and Validation Properties
            var defaultValue = this.options.DefaultValue;
            var step = this.options.Step;
            var decimalPlaces = this.options.DecimalPlaces;
            var minValue = this.options.MinValue;
            var maxValue = this.options.MaxValue;
            var isApplyBusinessRules = this.options.IsApplyBusinessRules;
            var isValidateOnEnter = this.options.IsValidateOnEnter;

            // Set UI Properties
            var height = this.options.Height;
            var isAlignLeft = this.options.IsAlignLeft;
            var isShowSpinButtons = this.options.IsShowSpinButtons;
            var isDisabled = this.options.IsDisabled;
            var borderColor = this.options.BorderColor;

            // Set Callbacks
            var onEnter = this.options.OnEnter;
            var spin = this.options.Spin;
            var spinUp = this.options.SpinUp;
            var spinDown = this.options.SpinDown;
            var stop = this.options.Stop;

            // Business Rules
            var askIncrement = this.options.AskPrice == 0 ? 0 : this.options.AskPrice + (step * 8);
            var bidIncrement = this.options.BidPrice == 0 ? 0 : this.options.BidPrice - (step * 8);
            askIncrement = isApplyBusinessRules ? askIncrement : step;
            bidIncrement = isApplyBusinessRules ? bidIncrement : -step;

            // Events and Callbacks
            var spinnerInputContainer = this.element[0].parentElement;
            var spinnerContainer = spinnerInputContainer.parentElement;
            var spinnerInput = $(spinnerInputContainer).find(".wt-spinner");
            var spinnerButtonGroup = $(spinnerContainer).find(".spinner-button-group");
            var spinnerButton = $(spinnerContainer).find(".spinner-button-group>button");
            var spinnerDownButton = $(spinnerContainer).find(".spin-down-button");

            $(spinnerInputContainer).undelegate();
            $(spinnerContainer).undelegate();
            $(spinnerInputContainer).delegate(".wt-spinner", "keydown", function (e) {
                switch (e.which) {
                    case 13: // Enter
                        var floatValue = parseFloat($(this).val());

                        // Is Validate On Enter
                        if (isValidateOnEnter) {
                            var newValue = parseFloat($(this).val());
                            var formattedValue = roundDownValue(newValue, decimalPlaces);

                            if (parseFloat(formattedValue) >= maxValue) {
                                var currentCaretPosition = getCaretPosition($(spinnerInput)) - 1;
                                $(this).val(roundDownValue(maxValue, decimalPlaces));

                                var nextCaretPosition = currentCaretPosition >= $(this).val().length ? currentCaretPosition : currentCaretPosition + 1;
                                setCaretPosition($(spinnerInput), nextCaretPosition);

                                stop(parseFloat(roundDownValue(maxValue, decimalPlaces)));
                            } else if (parseFloat(formattedValue) <= minValue) {
                                var currentCaretPosition = getCaretPosition($(spinnerInput)) - 1;
                                $(this).val(roundDownValue(minValue, decimalPlaces));

                                var nextCaretPosition = currentCaretPosition >= $(this).val().length ? currentCaretPosition : currentCaretPosition + 1;
                                setCaretPosition($(spinnerInput), nextCaretPosition);

                                stop(parseFloat(roundDownValue(minValue, decimalPlaces)));
                            } else {
                                var currentCaretPosition = getCaretPosition($(spinnerInput)) - 1;
                                $(this).val(formattedValue);

                                var nextCaretPosition = currentCaretPosition >= $(this).val().length ? currentCaretPosition : currentCaretPosition + 1;
                                setCaretPosition($(spinnerInput), nextCaretPosition);

                                stop(parseFloat(formattedValue));
                            }
                        }

                        onEnter(floatValue);
                        break;

                    case 38: // Arrow up
                        var floatValue = parseFloat($(this).val());
                        spin(floatValue);

                        var currentCaretPosition = getCaretPosition($(spinnerInput));
                        var previousValue = $(this).val()
                        var temp = roundOffValue(parseFloat(previousValue) + step, decimalPlaces);
                        if ((parseFloat(temp) >= minValue || minValue == null) && (parseFloat(temp) <= maxValue)) {
                            if (previousValue == 0) {
                                $(this).val(roundOffValue(askIncrement, decimalPlaces));
                            } else {
                                $(this).val(temp);
                            }
                        }

                        setCaretPosition($(spinnerInput), currentCaretPosition);

                        floatValue = parseFloat($(this).val());
                        spinUp(floatValue);
                        stop(floatValue);
                        break;

                    case 40: // Arrow down
                        var floatValue = parseFloat($(this).val());
                        spin(floatValue);

                        var currentCaretPosition = getCaretPosition($(spinnerInput));
                        var previousValue = $(this).val()
                        var temp = roundOffValue(parseFloat(previousValue) - step, decimalPlaces);
                        if (((parseFloat(temp) >= minValue || minValue == null) && (parseFloat(temp) <= maxValue)) || (previousValue == 0 && bidIncrement >= minValue)) {
                            if (previousValue == 0) {
                                $(this).val(roundOffValue(bidIncrement, decimalPlaces));
                            } else {
                                $(this).val(temp);
                            }
                        }

                        setCaretPosition($(spinnerInput), currentCaretPosition);

                        floatValue = parseFloat($(this).val());
                        spinDown(floatValue);
                        stop(floatValue);
                        break;

                    default:
                        var isKeyAllowed = function () {
                            // Validated keys
                            var isNumberKeys = (e.which >= 48 && e.which <= 57) || (e.which >= 96 && e.which <= 105) || e.which == 190; // 0-9, .
                            var isUtilityKeys = (e.which >= 35 && e.which <= 40) || (e.which >= 45 && e.which <= 46) || (e.which >= 8 && e.which <= 9) || e.which == 13 || (e.which >= 16 && e.which <= 17); // End, Home, Left, Up, Right, Down, Insert, Delete, Backspace, Tab, Enter, Shift, Ctrl
                            var isFunctionKeys = e.which >= 112 && e.which <= 123; // F1-F12

                            if (isNumberKeys || isUtilityKeys || isFunctionKeys) {
                                return true;
                            }

                            return false;
                        };

                        return isKeyAllowed();
                }
            });
            $(spinnerInputContainer).delegate(".wt-spinner", "input", function (e) {
                if (!isValidateOnEnter) {
                    var newValue = parseFloat($(this).val());
                    var formattedValue = roundDownValue(newValue, decimalPlaces);

                    if (parseFloat(formattedValue) >= maxValue) {
                        var currentCaretPosition = getCaretPosition($(spinnerInput)) - 1;
                        $(this).val(roundDownValue(maxValue, decimalPlaces));

                        var nextCaretPosition = currentCaretPosition >= $(this).val().length ? currentCaretPosition : currentCaretPosition + 1;
                        setCaretPosition($(spinnerInput), nextCaretPosition);

                        stop(parseFloat(roundDownValue(maxValue, decimalPlaces)));
                    } else if (parseFloat(formattedValue) <= minValue) {
                        var currentCaretPosition = getCaretPosition($(spinnerInput)) - 1;
                        $(this).val(roundDownValue(minValue, decimalPlaces));

                        var nextCaretPosition = currentCaretPosition >= $(this).val().length ? currentCaretPosition : currentCaretPosition + 1;
                        setCaretPosition($(spinnerInput), nextCaretPosition);

                        stop(parseFloat(roundDownValue(minValue, decimalPlaces)));
                    } else {
                        var currentCaretPosition = getCaretPosition($(spinnerInput)) - 1;
                        $(this).val(formattedValue);

                        var nextCaretPosition = currentCaretPosition >= $(this).val().length ? currentCaretPosition : currentCaretPosition + 1;
                        setCaretPosition($(spinnerInput), nextCaretPosition);

                        stop(parseFloat(formattedValue));
                    }
                }
            });
            $(spinnerInputContainer).delegate(".wt-spinner", "focusout", function (e) {
                if (isValidateOnEnter) {
                    var newValue = parseFloat($(this).val());
                    var formattedValue = roundDownValue(newValue, decimalPlaces);

                    if (parseFloat(formattedValue) >= maxValue) {
                        var currentCaretPosition = getCaretPosition($(spinnerInput)) - 1;
                        $(this).val(roundDownValue(maxValue, decimalPlaces));

                        var nextCaretPosition = currentCaretPosition >= $(this).val().length ? currentCaretPosition : currentCaretPosition + 1;
                        setCaretPosition($(spinnerInput), nextCaretPosition);

                        stop(parseFloat(roundDownValue(maxValue, decimalPlaces)));
                    } else if (parseFloat(formattedValue) <= minValue) {
                        var currentCaretPosition = getCaretPosition($(spinnerInput)) - 1;
                        $(this).val(roundDownValue(minValue, decimalPlaces));

                        var nextCaretPosition = currentCaretPosition >= $(this).val().length ? currentCaretPosition : currentCaretPosition + 1;
                        setCaretPosition($(spinnerInput), nextCaretPosition);

                        stop(parseFloat(roundDownValue(minValue, decimalPlaces)));
                    } else {
                        var currentCaretPosition = getCaretPosition($(spinnerInput)) - 1;
                        $(this).val(formattedValue);

                        var nextCaretPosition = currentCaretPosition >= $(this).val().length ? currentCaretPosition : currentCaretPosition + 1;
                        setCaretPosition($(spinnerInput), nextCaretPosition);

                        stop(parseFloat(formattedValue));
                    }
                }
            });
            $(spinnerInputContainer).delegate(".wt-spinner", "mousewheel", function (e) {
                if (e.deltaY == 1) { // Scroll up
                    var floatValue = parseFloat($(this).val());
                    spin(floatValue);

                    var currentCaretPosition = getCaretPosition($(spinnerInput));
                    var previousValue = $(this).val()
                    var temp = roundOffValue(parseFloat(previousValue) + step, decimalPlaces);
                    if ((parseFloat(temp) >= minValue || minValue == null) && (parseFloat(temp) <= maxValue)) {
                        if (previousValue == 0) {
                            $(this).val(roundOffValue(askIncrement, decimalPlaces));
                        } else {
                            $(this).val(temp);
                        }
                    }

                    setCaretPosition($(spinnerInput), currentCaretPosition);

                    floatValue = parseFloat($(this).val());
                    spinUp(floatValue);
                    stop(floatValue);
                } else if (e.deltaY == -1) { // Scroll down
                    var floatValue = parseFloat($(this).val());
                    spin(floatValue);

                    var currentCaretPosition = getCaretPosition($(spinnerInput));
                    var previousValue = $(this).val()
                    var temp = roundOffValue(parseFloat(previousValue) - step, decimalPlaces);
                    if (((parseFloat(temp) >= minValue || minValue == null) && (parseFloat(temp) <= maxValue)) || (previousValue == 0 && bidIncrement >= minValue)) {
                        if (previousValue == 0) {
                            $(this).val(roundOffValue(bidIncrement, decimalPlaces));
                        } else {
                            $(this).val(temp);
                        }
                    }

                    setCaretPosition($(spinnerInput), currentCaretPosition);

                    floatValue = parseFloat($(this).val());
                    spinDown(floatValue);
                    stop(floatValue);
                }
            });
            $(spinnerContainer).delegate(".spin-up-button", "click", function (e) {
                var targetElement = $(spinnerInputContainer).find(".wt-spinner");
                var floatValue = parseFloat(targetElement.val());
                spin(floatValue);

                var currentCaretPosition = getCaretPosition($(spinnerInput));
                var previousValue = targetElement.val()
                var temp = roundOffValue(parseFloat(previousValue) + step, decimalPlaces);
                if ((parseFloat(temp) >= minValue || minValue == null) && (parseFloat(temp) <= maxValue)) {
                    if (previousValue == 0) {
                        targetElement.val(roundOffValue(askIncrement, decimalPlaces));
                    } else {
                        targetElement.val(temp);
                    }
                }

                setCaretPosition($(spinnerInput), currentCaretPosition);

                floatValue = parseFloat(targetElement.val());
                spinUp(floatValue);
                stop(floatValue);
            });
            $(spinnerContainer).delegate(".spin-down-button", "click", function (e) {
                var targetElement = $(spinnerInputContainer).find(".wt-spinner");
                var floatValue = parseFloat(targetElement.val());
                spin(floatValue);

                var currentCaretPosition = getCaretPosition($(spinnerInput));
                var previousValue = targetElement.val()
                var temp = roundOffValue(parseFloat(previousValue) - step, decimalPlaces);
                if (((parseFloat(temp) >= minValue || minValue == null) && (parseFloat(temp) <= maxValue)) || (previousValue == 0 && bidIncrement >= minValue)) {
                    if (previousValue == 0) {
                        targetElement.val(roundOffValue(bidIncrement, decimalPlaces));
                    } else {
                        targetElement.val(temp);
                    }
                }

                setCaretPosition($(spinnerInput), currentCaretPosition);

                floatValue = parseFloat(targetElement.val());
                spinDown(floatValue);
                stop(floatValue);
            });

            // Layout
            $(spinnerInput).val(roundDownValue(defaultValue, decimalPlaces)); // Set Default Value

            var spinnerButtonGroupHeight = height;
            var spinnerButtonGroupWidth = isShowSpinButtons ? 18 : 2;
            var spinnerButtonGroupVisibility = isShowSpinButtons ? "inline" : "none";
            var spinnerInputContainerHeight = height;
            var spinnerInputContainerWidth = "calc(100% - " + spinnerButtonGroupWidth + "px)";
            var spinnerInputHeight = height - 4;
            var spinnerInputWidth = spinnerInputContainerWidth;
            var spinnerInputTextAlignment = isAlignLeft ? "left" : "right";
            var spinnerButtonHeight = roundDownValue(((spinnerButtonGroupHeight - 2) / 2), 0);

            if (isDisabled) {
                var input = $(spinnerInputContainer).find(".wt-spinner");
                var buttons = $(spinnerContainer).find(".spinner-button-group>button");

                $(input).prop('disabled', true);
                $(buttons).prop('disabled', true);

                $(spinnerContainer).css({
                    "opacity": ".3"
                });
            } else {
                var input = $(spinnerInputContainer).find(".wt-spinner");
                var buttons = $(spinnerContainer).find(".spinner-button-group>button");

                $(input).prop('disabled', false);
                $(buttons).prop('disabled', false);

                $(spinnerContainer).css({
                    "opacity": "1"
                });
            }

            $(spinnerContainer).css({
                "border-color": borderColor
            });

            $(spinnerInputContainer).css({
                "height": spinnerInputContainerHeight,
                "width": spinnerInputContainerWidth
            });

            $(spinnerInput).css({
                "height": spinnerInputHeight,
                "width": spinnerInputWidth,
                "text-align": spinnerInputTextAlignment
            });

            $(spinnerButtonGroup).css({
                "height": spinnerButtonGroupHeight,
                "display": spinnerButtonGroupVisibility
            });

            $(spinnerButton).css({
                "height": spinnerButtonHeight
            });

            $(spinnerDownButton).css({
                "margin-top": spinnerButtonHeight + "px"
            });
        },
        disable: function () {
            var spinnerInputContainer = this.element[0].parentElement;
            var spinnerContainer = spinnerInputContainer.parentElement;

            var input = $(spinnerInputContainer).find(".wt-spinner");
            var buttons = $(spinnerContainer).find(".spinner-button-group>button");

            $(input).prop('disabled', true);
            $(buttons).prop('disabled', true);

            // Layout
            $(spinnerContainer).css({
                "opacity": ".3"
            });

            this.options.IsDisabled = true;
        },
        enable: function () {
            var spinnerInputContainer = this.element[0].parentElement;
            var spinnerContainer = spinnerInputContainer.parentElement;

            var input = $(spinnerInputContainer).find(".wt-spinner");
            var buttons = $(spinnerContainer).find(".spinner-button-group>button");

            $(input).prop('disabled', false);
            $(buttons).prop('disabled', false);

            // Layout
            $(spinnerContainer).css({
                "opacity": "1"
            });

            this.options.IsDisabled = false;
        }
    });

    // Helpers
    var roundOffValue = function (val, decPlaces) {
        var retval = accounting.toFixed(val, decPlaces);

        return retval;
    };
    var roundDownValue = function (val, decPlaces) {
        var currentValue = String(val) == "" ? roundOffValue(0, decPlaces) : String(val);
        var decimalIndex = currentValue.indexOf(".");
        var decimalLength = currentValue.length - decimalIndex - 1;

        currentValue = decimalLength > decPlaces && decimalIndex >= 0 ? currentValue.substr(0, decimalIndex + decPlaces + 1) : roundOffValue(currentValue, decPlaces);

        return currentValue;
    };
    var getCaretPosition = function (element) {
        var target = element[0];
        var isContentEditable = target.contentEditable === 'true';
        if (window.getSelection) {
            if (isContentEditable) {
                target.focus();
                var range1 = window.getSelection().getRangeAt(0),
                    range2 = range1.cloneRange();
                range2.selectNodeContents(target);
                range2.setEnd(range1.endContainer, range1.endOffset);
                return range2.toString().length;
            }
            return target.selectionStart;
        }
    };
    var setCaretPosition = function (element, pos) {
        var target = element[0];
        var isContentEditable = target.contentEditable === 'true';
        if (window.getSelection) {
            if (isContentEditable) {
                target.focus();
                window.getSelection().collapse(target.firstChild, pos);
            } else {
                target.setSelectionRange(pos, pos);
            }
        }
    };
});