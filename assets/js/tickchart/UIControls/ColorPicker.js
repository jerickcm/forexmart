﻿$(function () {
    var colorPickerDictionary = [];
    var themeColors = ['ffffff', '000000', 'eeece1', '1f497d', '4f81bd', 'c0504d', '9bbb59', '8064a2', '4bacc6', 'f79646',
                        'f2f2f2', '7f7f7f', 'ddd9c3', 'c6d9f0', 'dbe5f1', 'f2dcdb', 'ebf1dd', 'e5e0ec', 'dbeef3', 'fdeada',
                        'd8d8d8', '595959', 'c4bd97', '8db3e2', 'b8cce4', 'e5b9b7', 'd7e3bc', 'ccc1d9', 'b7dde8', 'fbd5b5',
                        'bfbfbf', '3f3f3f', '938953', '548dd4', '95b3d7', 'd99694', 'c3d69b', 'b2a2c7', '92cddc', 'fac08f',
                        'a5a5a5', '262626', '494429', '17365d', '366092', '953734', '76923c', '5f497a', '31859b', 'e36c09',
                        '7f7f7f', '0c0c0c', '1d1b10', '0f243e', '244061', '632423', '4f6128', '3f3151', '205867', '974806'];
    var standardColors = ['c00000', 'ff0000', 'ffc000', 'ffff00', '92d050', '00b050', '00b0f0', '0070c0', '002060', '7030a0'];
    var webColors = [
        { name: "Aliceblue", val: "f0f8ff" },
        { name: "Antiquewhite", val: "faebd7" },
        { name: "Aqua", val: "0ff" },
        { name: "Aquamarine", val: "7fffd4" },
        { name: "Azure", val: "f0ffff" },
        { name: "Beige", val: "f5f5dc" },
        { name: "Bisque", val: "ffe4c4" },
        { name: "Black", val: "000" },
        { name: "Blanchedalmond", val: "ffebcd" },
        { name: "Blue", val: "00f" },
        { name: "Blueviolet", val: "8a2be2" },
        { name: "Brown", val: "a52a2a" },
        { name: "Burlywood", val: "deb887" },
        { name: "Burntsienna", val: "ea7e5d" },
        { name: "Cadetblue", val: "5f9ea0" },
        { name: "Chartreuse", val: "7fff00" },
        { name: "Chocolate", val: "d2691e" },
        { name: "Coral", val: "ff7f50" },
        { name: "Cornflowerblue", val: "6495ed" },
        { name: "Cornsilk", val: "fff8dc" },
        { name: "Crimson", val: "dc143c" },
        { name: "Cyan", val: "0ff" },
        { name: "Darkblue", val: "00008b" },
        { name: "Darkcyan", val: "008b8b" },
        { name: "Darkgoldenrod", val: "b8860b" },
        { name: "Darkgreen", val: "006400" },
        { name: "Darkgrey", val: "a9a9a9" },
        { name: "Darkkhaki", val: "bdb76b" },
        { name: "Darkmagenta", val: "8b008b" },
        { name: "Darkolivegreen", val: "556b2f" },
        { name: "Darkorange", val: "ff8c00" },
        { name: "Darkorchid", val: "9932cc" },
        { name: "Darkred", val: "8b0000" },
        { name: "Darksalmon", val: "e9967a" },
        { name: "Darkseagreen", val: "8fbc8f" },
        { name: "Darkslateblue", val: "483d8b" },
        { name: "Darkslategrey", val: "2f4f4f" },
        { name: "Darkturquoise", val: "00ced1" },
        { name: "Darkviolet", val: "9400d3" },
        { name: "Deeppink", val: "ff1493" },
        { name: "Deepskyblue", val: "00bfff" },
        { name: "Dimgrey", val: "696969" },
        { name: "Dodgerblue", val: "1e90ff" },
        { name: "Firebrick", val: "b22222" },
        { name: "Floralwhite", val: "fffaf0" },
        { name: "Forestgreen", val: "228b22" },
        { name: "Fuchsia", val: "f0f" },
        { name: "Gainsboro", val: "dcdcdc" },
        { name: "Ghostwhite", val: "f8f8ff" },
        { name: "Gold", val: "ffd700" },
        { name: "Goldenrod", val: "daa520" },
        { name: "Grey", val: "808080" },
        { name: "Green", val: "008000" },
        { name: "Greenyellow", val: "adff2f" },
        { name: "Honeydew", val: "f0fff0" },
        { name: "Hotpink", val: "ff69b4" },
        { name: "Indianred", val: "cd5c5c" },
        { name: "Indigo", val: "4b0082" },
        { name: "Ivory", val: "fffff0" },
        { name: "Khaki", val: "f0e68c" },
        { name: "Lavender", val: "e6e6fa" },
        { name: "Lavenderblush", val: "fff0f5" },
        { name: "Lawngreen", val: "7cfc00" },
        { name: "Lemonchiffon", val: "fffacd" },
        { name: "Lightblue", val: "add8e6" },
        { name: "Lightcoral", val: "f08080" },
        { name: "Lightcyan", val: "e0ffff" },
        { name: "Lightgoldenrodyellow", val: "fafad2" },
        { name: "Lightgrey", val: "d3d3d3" },
        { name: "Lightgreen", val: "90ee90" },
        { name: "Lightpink", val: "ffb6c1" },
        { name: "Lightsalmon", val: "ffa07a" },
        { name: "Lightseagreen", val: "20b2aa" },
        { name: "Lightskyblue", val: "87cefa" },
        { name: "Lightslategrey", val: "789" },
        { name: "Lightyellow", val: "ffffe0" },
        { name: "Lime", val: "0f0" },
        { name: "Limegreen", val: "32cd32" },
        { name: "Linen", val: "faf0e6" },
        { name: "Magenta", val: "f0f" },
        { name: "Maroon", val: "800000" },
        { name: "Mediumaquamarine", val: "66cdaa" },
        { name: "Mediumblue", val: "0000cd" },
        { name: "Mediumorchid", val: "ba55d3" },
        { name: "Mediumpurple", val: "9370db" },
        { name: "Mediumseagreen", val: "3cb371" },
        { name: "Mediumslateblue", val: "7b68ee" },
        { name: "Mediumspringgreen", val: "00fa9a" },
        { name: "Mediumturquoise", val: "48d1cc" },
        { name: "Mediumvioletred", val: "c71585" },
        { name: "Midnightblue", val: "191970" },
        { name: "Mintcream", val: "f5fffa" },
        { name: "Mistyrose", val: "ffe4e1" },
        { name: "Moccasin", val: "ffe4b5" },
        { name: "Navajowhite", val: "ffdead" },
        { name: "Navy", val: "000080" },
        { name: "Oldlace", val: "fdf5e6" },
        { name: "Olive", val: "808000" },
        { name: "Orange", val: "ffa500" },
        { name: "Orchid", val: "da70d6" },
        { name: "Palegoldenrod", val: "eee8aa" },
        { name: "Palegreen", val: "98fb98" },
        { name: "Paleturquoise", val: "afeeee" },
        { name: "Palevioletred", val: "db7093" },
        { name: "Papayawhip", val: "ffefd5" },
        { name: "Peachpuff", val: "ffdab9" },
        { name: "Peru", val: "cd853f" },
        { name: "Pink", val: "ffc0cb" },
        { name: "Plum", val: "dda0dd" },
        { name: "Powderblue", val: "b0e0e6" },
        { name: "Purple", val: "800080" },
        { name: "Rebeccapurple", val: "663399" },
        { name: "Red", val: "f00" },
        { name: "Rosybrown", val: "bc8f8f" },
        { name: "Royalblue", val: "4169e1" },
        { name: "Saddlebrown", val: "8b4513" },
        { name: "Salmon", val: "fa8072" },
        { name: "Sandybrown", val: "f4a460" },
        { name: "Seagreen", val: "2e8b57" },
        { name: "Seashell", val: "fff5ee" },
        { name: "Sienna", val: "a0522d" },
        { name: "Silver", val: "c0c0c0" },
        { name: "Skyblue", val: "87ceeb" },
        { name: "Slateblue", val: "6a5acd" },
        { name: "Slategrey", val: "708090" },
        { name: "Snow", val: "fffafa" },
        { name: "Springgreen", val: "00ff7f" },
        { name: "Steelblue", val: "4682b4" },
        { name: "Tan", val: "d2b48c" },
        { name: "Teal", val: "008080" },
        { name: "Thistle", val: "d8bfd8" },
        { name: "Tomato", val: "ff6347" },
        { name: "Turquoise", val: "40e0d0" },
        { name: "Violet", val: "ee82ee" },
        { name: "Wheat", val: "f5deb3" },
        { name: "White", val: "fff" },
        { name: "Whitesmoke", val: "f5f5f5" },
        { name: "Yellow", val: "ff0" },
        { name: "Yellowgreen", val: "9acd32" }
    ];
    var systemColors = [
        { name: "ActiveBorder", val: "B4B4B4" },
        { name: "ActiveCaption", val: "99B4D1" },
        { name: "ActiveCaptionText", val: "000000" },
        { name: "AppWorkspace", val: "ABABAB" },
        { name: "ButtonFace", val: "F0F0F0" },
        { name: "ButtonHighlight", val: "FFFFFF" },
        { name: "ButtonShadow", val: "A0A0A0" },
        { name: "Control", val: "F0F0F0" },
        { name: "ControlDark", val: "A0A0A0" },
        { name: "ControlDarkDark", val: "696969" },
        { name: "ControlLight", val: "E3E3E3" },
        { name: "ControlLightLight", val: "FFFFFF" },
        { name: "ControlText", val: "000000" },
        { name: "Desktop", val: "0A3B76" },
        { name: "GradientActiveCaption", val: "B9D1EA" },
        { name: "GradientInactiveCaption", val: "D7E4F2" },
        { name: "GrayText", val: "6D6D6D" },
        { name: "Highlight", val: "3399FF" },
        { name: "HighlightText", val: "FFFFFF" },
        { name: "HotTrack", val: "0066CC" },
        { name: "InactiveBorder", val: "F4F7FC" },
        { name: "InactiveCaption", val: "BFCDDB" },
        { name: "InactiveCaption", val: "000000" },
        { name: "Info", val: "FFFFE1" },
        { name: "InfoText", val: "000000" },
        { name: "Menu", val: "F0F0F0" },
        { name: "MenuBar", val: "F0F0F0" },
        { name: "MenuHighlight", val: "3399FF" },
        { name: "MenuText", val: "000000" },
        { name: "ScrollBar", val: "C8C8C8" },
        { name: "Window", val: "FFFFFF" },
        { name: "WindowFrame", val: "646464" },
        { name: "WindowText", val: "000000" }
    ];
    var colPickInst = "";
    var colPickId = "";
    var visible = false;
    var hasColors = false;

    $.widget("colorpicker.wcColorPicker", {
        options: {
            change: function () { }
        },

        _create: function () {
            var lastIndex = colorPickerDictionary.length == 0 ? -1 : colorPickerDictionary[colorPickerDictionary.length - 1].Index;
            var colorPickerInstance = {
                Id: "wc-ColorPicker" + (lastIndex + 1),
                Index: colorPickerDictionary.length == 0 ? 0 : lastIndex + 1
            };
            colorPickerDictionary.push(colorPickerInstance);
            //Construct Color Picker
            colPickInst = "#" + colorPickerInstance.Id;
            colPickId = colorPickerInstance.Id;
        },

        _init: function () {
            var self = this;
            var _doc = WC.Document;
            var cpInst = colPickInst;
            var cpId = colPickId;
            var tblName = "#tbl" + cpId;
            var colorPickerDiv = $("<div id = '" + cpId + "'></div>");
            var isColors = hasColors;
            var palette = 'custom';
            var chng = self.options.change;

            $(document.body).append(colorPickerDiv);

            _doc.on({
                click: function (e) {
                    if (self.element.is(e.target) || self.element.has(e.target).length) {
                        e.preventDefault();
                        self.toggle(e);
                    }
                    else if (colorPickerDiv.is(e.target) || colorPickerDiv.has(e.target).length) {
                        if (e.target.nodeName == 'DIV' && (e.target.getAttribute('value') !== null && e.target.getAttribute('value') != '') && (e.target.getAttribute('value').substring(0, 1) == '#')) {
                            $(cpInst).toggleClass('wc-colorpicker-design-hide');
                            $(cpInst).toggleClass('wc-colorpicker-design');
                            chng(e.target.getAttribute('value').toString());
                            $(cpInst).empty();
                            isColors = false;
                        }
                        else if (e.target.nodeName == 'DIV' && (e.target.getAttribute('value') !== null && e.target.getAttribute('value') != '') && (e.target.getAttribute('value').substring(0, 1) != '#')) {
                            palette = e.target.getAttribute('value').toString();
                            $(tblName).empty();
                            self.changeTbl();
                        }
                    }
                    else {
                        $(cpInst).addClass('wc-colorpicker-design-hide');
                        $(cpInst).removeClass('wc-colorpicker-design');
                        $(cpInst).empty();
                        isColors = false;
                    }

                }
            });

            //$(colPickInst).on('click.colPickClick' + cpId, function (e) {
            //    if (e.target.nodeName == 'DIV' && (e.target.getAttribute('value') !== null && e.target.getAttribute('value') != '') && (e.target.getAttribute('value').substring(0, 1) == '#')) {
            //        $(cpInst).toggleClass('wc-colorpicker-design-hide');
            //        $(cpInst).toggleClass('wc-colorpicker-design');
            //        chng(e.target.getAttribute('value').toString());
            //        $(cpInst).empty();
            //        isColors = false;
            //    }
            //    else if (e.target.nodeName == 'DIV' && (e.target.getAttribute('value') !== null && e.target.getAttribute('value') != '') && (e.target.getAttribute('value').substring(0, 1) != '#')) {
            //        palette = e.target.getAttribute('value').toString();
            //        $(tblName).empty();
            //        self.changeTbl();
            //    }
            //});

            $(colPickInst).on('mouseleave.colPickMouseLeave' + cpId, function (e) {
                $(cpInst).addClass('wc-colorpicker-design-hide');
                $(cpInst).removeClass('wc-colorpicker-design');
                $(cpInst).empty();
                isColors = false;
            });

            self.toggle = function (e) {

                var colLen = colorPickerDictionary.length;
                for (var i = 0; i < colLen; i++) {
                    if (colorPickerDictionary[i].Id != cpId) {
                        var cp = $('#' + colorPickerDictionary[i].Id);
                        cp.addClass('wc-colorpicker-design-hide');
                        cp.removeClass('wc-colorpicker-design');
                    }
                }
                if (isColors && $(cpInst).children().length == 0) {
                    $(cpInst).toggleClass('wc-colorpicker-design-hide');
                    $(cpInst).toggleClass('wc-colorpicker-design');
                    $(cpInst).empty();
                    isColors = false;
                }
                else if (isColors && $(cpInst).children().length != 0) {
                    $(cpInst).toggleClass('wc-colorpicker-design-hide');
                    $(cpInst).toggleClass('wc-colorpicker-design');
                }
                else {
                    $(cpInst).append("<div id='" + "menu-" + cpId + "'></div>");
                    $("#menu-" + cpId).append("<div style='cursor:pointer;' id='" + "Custom" + cpId + "' value='custom' class='wc-colorpicker-design-menu-item'>Custom</div>");
                    $("#menu-" + cpId).append("<div style='cursor:pointer;' id='" + "Web" + cpId + "' value='web' class='wc-colorpicker-design-menu-item'>Web</div>");
                    $("#menu-" + cpId).append("<div style='cursor:pointer;' id='" + "System" + cpId + "' value='system' class='wc-colorpicker-design-menu-item'>System</div>");
                    $(cpInst).append("<div id ='" + "divtbl" + cpId + "' style='width:100%; height: calc(100% * .90);'></div>");
                    $("#divtbl" + cpId).append("<table id ='" + "tbl" + cpId + "' style='height:225px;'></table>");

                    if (palette == "custom") {
                        $("#Custom" + cpId).addClass('wc-colorpicker-active-tab');
                        $("#Web" + cpId).removeClass('wc-colorpicker-active-tab');
                        $("#System" + cpId).removeClass('wc-colorpicker-active-tab');
                        $(tblName).append("<tr><th colspan='10'>Automatic</th></tr>");
                        var AtrName = "#tr0-" + cpId;
                        $(tblName).append("<tr id='" + "tr0-" + cpId + "'></tr>");
                        $(AtrName).append("<td style='width: 10%; height: 10%;'><div value='#000000' style='background-color: " + "#000000" + ";'></div></td>");
                        $(tblName).append("<tr><th colspan='10'>Theme Colors</th></tr>");
                        for (var i = 0; i < themeColors.length; i += 10) {
                            var string = randomString(6, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
                            var trName = "#tr1-" + cpId + string;
                            $(tblName).append("<tr id='" + "tr1-" + cpId + string + "'></tr>");
                            for (var j = i; j < i + 10; j++) {
                                $(trName).append("<td style='width: 10%; height: 10%;'><div value='" + "#" + themeColors[j] + "' style='background-color: " + "#" + themeColors[j] + ";'></div></td>");
                            }
                        }

                        $(tblName).append("<tr><th colspan='10'>Standard Colors</th></tr>");
                        for (var i = 0; i < standardColors.length; i += 10) {
                            var trName = "#tr2-" + cpId + i.toString();
                            $(tblName).append("<tr id='" + "tr2-" + cpId + i.toString() + "'></tr>");
                            for (var j = i; j < i + 10; j++) {
                                $(trName).append("<td style='width: 10%; height: 10%;'><div value='" + "#" + standardColors[j] + "' style='background-color: " + "#" + standardColors[j] + ";'></div></td>");
                            }
                        }
                    }

                    else if (palette == 'web') {
                        $("#Custom" + cpId).removeClass('wc-colorpicker-active-tab');
                        $("#Web" + cpId).addClass('wc-colorpicker-active-tab');
                        $("#System" + cpId).removeClass('wc-colorpicker-active-tab');
                        for (var i = 0; i < webColors.length; i++) {
                            var string = randomString(6, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
                            var trName = "#tr1-" + cpId + string;
                            $(tblName).append("<tr id='" + "tr1-" + cpId + string + "'></tr>");
                            $(trName).append("<td style='width: 10%;'><div value='" + "#" + webColors[i].val + "' style='background-color: " + "#" + webColors[i].val + ";'></div></td>");
                            $(trName).append("<td><div value='" + "#" + webColors[i].val + "'  style='border: 0px !important;' >" + webColors[i].name + "</div></td>");
                        }
                    }

                    else if (palette == 'system') {
                        $("#Custom" + cpId).removeClass('wc-colorpicker-active-tab');
                        $("#Web" + cpId).removeClass('wc-colorpicker-active-tab');
                        $("#System" + cpId).addClass('wc-colorpicker-active-tab');
                        for (var i = 0; i < systemColors.length; i++) {
                            var string = randomString(6, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
                            var trName = "#tr1-" + cpId + string;
                            $(tblName).append("<tr id='" + "tr1-" + cpId + string + "'></tr>");
                            $(trName).append("<td style='width: 10%;'><div value='" + "#" + systemColors[i].val + "' style='background-color: " + "#" + systemColors[i].val + ";'></div></td>");
                            $(trName).append("<td><div value='" + "#" + systemColors[i].val + "'  style='border: 0px !important;' >" + systemColors[i].name + "</div></td>");
                        }
                    }

                    $(cpInst).css({
                        "z-index": "21"
                    });

                    $(cpInst).addClass('wc-colorpicker-design');
                    $(cpInst).removeClass('wc-colorpicker-design-hide');
                    $("#menu-" + cpId).addClass("wc-colorpicker-design-menu");
                    isColors = true;

                    $("#divtbl" + cpId).wcScrollBar({
                        Orientation: 'y',
                        RailSteps: 15
                    });

                    $("#divtbl" + cpId).wcScrollBar("Refresh");
                }

                $(cpInst).position({
                    my: "right top",
                    at: "right bottom",
                    of: this.element
                });
            }

            self.changeTbl = function () {
                if (palette == 'custom') {
                    $("#Custom" + cpId).addClass('wc-colorpicker-active-tab');
                    $("#Web" + cpId).removeClass('wc-colorpicker-active-tab');
                    $("#System" + cpId).removeClass('wc-colorpicker-active-tab');
                    $(tblName).append("<tr><th colspan='10'>Automatic</th></tr>");
                    var AtrName = "#tr0-" + cpId;
                    $(tblName).append("<tr id='" + "tr0-" + cpId + "'></tr>");
                    $(AtrName).append("<td style='width: 10%; height: 10%;'><div value='#000000' style='background-color: " + "#000000" + ";'></div></td>");
                    $(tblName).append("<tr><th colspan='10'>Theme Colors</th></tr>");
                    for (var i = 0; i < themeColors.length; i += 10) {
                        var string = randomString(6, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
                        var trName = "#tr1-" + cpId + string;
                        $(tblName).append("<tr id='" + "tr1-" + cpId + string + "'></tr>");
                        for (var j = i; j < i + 10; j++) {
                            $(trName).append("<td style='width: 10%; height: 10%;'><div value='" + "#" + themeColors[j] + "' style='background-color: " + "#" + themeColors[j] + ";'></div></td>");
                        }
                    }

                    $(tblName).append("<tr><th colspan='10'>Standard Colors</th></tr>");
                    for (var i = 0; i < standardColors.length; i += 10) {
                        var trName = "#tr2-" + cpId + i.toString();
                        $(tblName).append("<tr id='" + "tr2-" + cpId + i.toString() + "'></tr>");
                        for (var j = i; j < i + 10; j++) {
                            $(trName).append("<td style='width: 10%; height: 10%;'><div value='" + "#" + standardColors[j] + "' style='background-color: " + "#" + standardColors[j] + ";'></div></td>");
                        }
                    }
                }
                else if (palette == 'web') {
                    $("#Custom" + cpId).removeClass('wc-colorpicker-active-tab');
                    $("#Web" + cpId).addClass('wc-colorpicker-active-tab');
                    $("#System" + cpId).removeClass('wc-colorpicker-active-tab');
                    for (var i = 0; i < webColors.length; i++) {
                        var string = randomString(6, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
                        var trName = "#tr1-" + cpId + string;
                        $(tblName).append("<tr id='" + "tr1-" + cpId + string + "'></tr>");
                        $(trName).append("<td style='width: 10%;'><div value='" + "#" + webColors[i].val + "' style='background-color: " + "#" + webColors[i].val + ";'></div></td>");
                        $(trName).append("<td><div value='" + "#" + webColors[i].val + "'  style='border: 0px !important;' >" + webColors[i].name + "</div></td>");
                    }
                }

                else if (palette == 'system') {
                    $("#Custom" + cpId).removeClass('wc-colorpicker-active-tab');
                    $("#Web" + cpId).removeClass('wc-colorpicker-active-tab');
                    $("#System" + cpId).addClass('wc-colorpicker-active-tab');
                    for (var i = 0; i < systemColors.length; i++) {
                        var string = randomString(6, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
                        var trName = "#tr1-" + cpId + string;
                        $(tblName).append("<tr id='" + "tr1-" + cpId + string + "'></tr>");
                        $(trName).append("<td style='width: 10%;'><div value='" + "#" + systemColors[i].val + "' style='background-color: " + "#" + systemColors[i].val + ";'></div></td>");
                        $(trName).append("<td><div value='" + "#" + systemColors[i].val + "'  style='border: 0px !important;' >" + systemColors[i].name + "</div></td>");
                    }
                }

                $("#divtbl" + cpId).wcScrollBar("Refresh");
            }
        }
    });

    function randomString(length, chars) {
        var result = '';
        for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
        return result;
    }
});