WC.VT = {};

WC.VT.VisualToolsObjectCollection = [];
WC.VT.ctxVisualToolsCanvasCollection = [];
WC.VT.ChartInstanceCollection = [];

WC.VT.ActiveChart = "";
WC.VT.CopyVisualTool = null;
WC.VT.CopyVisualToolProperty = null;
WC.VT.CopyVisualToolSettings = null;

//Trigger for Changing Languaged
var txtFibonacci = "Fibonacci",
    txtFibonacciArc = "Fibonacci Arc",
    txtFibonacciFan = "Fibonacci Fan",
    txtFibonacciTimeZone = "Fibonacci TimeZone",
    txtForexChannel = "Forex Channel",
    txtGann = "Gann",
    txtGannLine = "Gann Line",
    txtGannFan = "Gann Fan",
    txtLabels = "Labels",
    txtText = "Text",
    txtLine = "Line",
    txtTrendLine = "Trend Line",
    txtShapes = "Shapes",
    txtEllipse = "Ellipse",
    txtRectangle = "Rectangle",
    txtSettings = "Settings",
    txtRemoveVisualTool = "Remove Visual Tool",
    txtRemoveAll = "Remove All";

WC.ComObject.OnTrigger.push(function (methodname) {

    switch (methodname) {
        case "LanguageChanged":
            var ChartWords = WC.ChartWords;

            txtFibonacci = ChartWords["Fibonacci"];
            txtFibonacciArc = ChartWords["Fibonacci_Arc"];
            txtFibonacciFan = ChartWords["Fibonacci_Fan"];
            txtFibonacciTimeZone = ChartWords["Fibonacci_TimeZone"];
            txtForexChannel = ChartWords["Forex_Channel"];
            txtGann = ChartWords["Gann"];
            txtGannLine = ChartWords["Gann_Line"];
            txtGannFan = ChartWords["Gann_Fan"];
            txtLabels = ChartWords["Labels"];
            txtText = ChartWords["Text"];
            txtLine = ChartWords["Line"];
            txtTrendLine = ChartWords["Trend_Line"];
            txtShapes = ChartWords["Shapes"];
            txtEllipse = ChartWords["Ellipse"];
            txtRectangle = ChartWords["Rectangle"];
            txtSettings = ChartWords["Settings"];
            txtRemoveVisualTool = ChartWords["Remove_Visual_Tool"];
            txtRemoveAll = ChartWords["Remove_All"];

            ChartWords = null;
            break;
    }

});

WC.VT.VisualToolsBase = function (chartInstance, ContainerID, ChartDisplayInstance) {
    var vtBase = this;
    if (!(ContainerID in WC.VT.VisualToolsObjectCollection)) {
        if (ContainerID !== undefined) {
            WC.VT.VisualToolsObjectCollection[ContainerID] = [];
            WC.VT.ctxVisualToolsCanvasCollection[ContainerID] = [];
            WC.VT.ChartInstanceCollection[ContainerID] = [];
        }
    }
    vtBase.VisualToolSessionCollection = [];
    vtBase.ChartInstance = chartInstance;
    WC.VT.ChartInstanceCollection[ContainerID].push(chartInstance);
    WC.VT.ctxVisualToolsCanvasCollection[ContainerID].push(vtBase.ChartInstance.ctxVisualToolsCanvas);
    vtBase.ChartDisplay = ChartDisplayInstance;
    vtBase.cID = ContainerID;
    var isDown = false;
    var tempX, tempY, mdX, mdY;
    var isDrawingMode = false;
    var mdCounter = 0;
    var IsPenDrawing = false;

    vtBase.temp = 0;
    vtBase.tempVT = null;
    vtBase.AllowAdd = false;
    vtBase.CanvasCleared = false;
    vtBase.setToTrue = false;
    vtBase.isDraggingVT = false;
    vtBase.isChartDragging = false;
    vtBase.Cursor = 'default';
    vtBase.ContextMenuObject = function (vtCtxMenuCallBack, VisualToolsSettingsFunction) {

        var cmObj = this;

        var togglePenDrawing = function (param) {
            IsPenDrawing = !IsPenDrawing;

            if (param !== "Pen") {
                IsPenDrawing = false;
            }
            if (!IsPenDrawing) {

                vtBase.vtToCreate = null;
                vtBase.Selector.css('cursor', vtBase.Cursor);
                vtBase.isDraggingVT = false;
                isDrawingMode = false;
                vtBase.VtRedrawFunction(vtBase.cID);
                vtBase.ChartDisplay.ActiveVisualTools.push({ Key: vtBase.tempVT.vtInfo.vtName, ID: vtBase.tempVT.vtID, Settings: vtBase.tempVT.SettingsValues, Properties: setProperty(vtBase.tempVT.vtID) });
                vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
                vtBase.tempVT = null;
            }

            vtCtxMenuCallBack(param);
        }


        var vtCtxMenuCallBackWrapper = function (param) {
            if (param !== "Pen") {
                IsPenDrawing = false;
                vtBase.Selector.css('cursor', vtBase.Cursor);
                isDrawingMode = false;
            }

            vtCtxMenuCallBack(param);
        }

        return {

            "FibonacciVT": {
                name: txtFibonacci, items: {
                    "FibonacciArc": { name: txtFibonacciArc, callback: vtCtxMenuCallBackWrapper },
                    "FibonacciFan": { name: txtFibonacciFan, callback: vtCtxMenuCallBackWrapper },
                    "FibonacciTimezone": { name: txtFibonacciTimeZone, callback: vtCtxMenuCallBackWrapper }
                }
            },

            "ForexChannel": {
                name: txtForexChannel, callback: vtCtxMenuCallBackWrapper
            },

            "GannVT": {
                name: txtGann, items: {
                    "GannLine": { name: txtGannLine, callback: vtCtxMenuCallBackWrapper },
                    "GannFan": { name: txtGannFan, callback: vtCtxMenuCallBackWrapper }
                },
            },

            "TextVT": {
                name: txtLabels, items: {
                    "Text": { name: txtText, callback: vtCtxMenuCallBackWrapper }
                }
            },

            "LineVT": {
                name: txtLine, items: {
                    "TrendLine": { name: txtTrendLine, callback: vtCtxMenuCallBackWrapper }
                },
            },
            "ShapeVT": {
                name: txtShapes, items: {
                    "Ellipse": { name: txtEllipse, callback: vtCtxMenuCallBackWrapper },
                    "Rectangle": { name: txtRectangle, callback: vtCtxMenuCallBackWrapper }
                }
            },

            "VisualToolsSettings": {
                name: txtSettings, items: getAllActiveVisualTools("Settings", VisualToolsSettingsFunction), disabled: (WC.VT.VisualToolsObjectCollection[vtBase.cID].length > 0) ? false : true
            },

            "RemoveVisualTool": {
                name: txtRemoveVisualTool, items: getAllActiveVisualTools("Remove", VisualToolsSettingsFunction)
            }
        };

    }
    //Cursor Callback
    function vtCursorCallBack(key) {
        switch (key) {
            case "dot":
                vtBase.Cursor = 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAHCAYAAADEUlfTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAABpSURBVHjafI6xDYAwDAQ/0LEBE2QOSykyAJULxmEQagZwEclbIHkROvR0FCjipK+u+EskZwBra22JCOScUUo5AOwgualqAHinqkFyS2Z21lpHfDCze3D3Cx3c/RpEZOpJEZn+P/9qnwEAMcw/8MqYcIwAAAAASUVORK5CYII=), auto';
                break
            default:
                vtBase.Cursor = key;
        }
        vtBase.Selector.css('cursor', vtBase.Cursor);
    }

    vtBase.LineColorToolbar = $('#spToolBarStrokeColor-' + vtBase.cID);
    vtBase.HighlightColorToolbar = $('#spToolBarHoverColor-' + vtBase.cID);

    vtBase.setToolbar = function (enabled, lineColor, highlightColor) {
        if (enabled) {
            $('#spToolBarStrokeColor-' + vtBase.cID).spectrum({
                color: lineColor,
                showPalette: true,
                palette: [
					   ["#000", "#444", "#666", "#999", "#ccc", "#eee", "#f3f3f3", "#fff"],
					   ["#f00", "#f90", "#ff0", "#0f0", "#0ff", "#00f", "#90f", "#f0f"],
					   ["#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc"],
					   ["#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
					   ["#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6fa8dc", "#8e7cc3", "#c27ba0"],
					   ["#c00", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3d85c6", "#674ea7", "#a64d79"],
					   ["#900", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#0b5394", "#351c75", "#741b47"],
					   ["#600", "#783f04", "#7f6000", "#274e13", "#0c343d", "#073763", "#20124d", "#4c1130"]
                ],
                showPaletteOnly: true,
                preferredFormat: "hex",
                hideAfterPaletteSelect: true,
                change: ToolbarLineColorChanged
            });
            $('#spToolBarHoverColor-' + vtBase.cID).spectrum({
                color: highlightColor,
                showPalette: true,
                palette: [
					   ["#000", "#444", "#666", "#999", "#ccc", "#eee", "#f3f3f3", "#fff"],
					   ["#f00", "#f90", "#ff0", "#0f0", "#0ff", "#00f", "#90f", "#f0f"],
					   ["#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc"],
					   ["#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
					   ["#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6fa8dc", "#8e7cc3", "#c27ba0"],
					   ["#c00", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3d85c6", "#674ea7", "#a64d79"],
					   ["#900", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#0b5394", "#351c75", "#741b47"],
					   ["#600", "#783f04", "#7f6000", "#274e13", "#0c343d", "#073763", "#20124d", "#4c1130"]
                ],
                showPaletteOnly: true,
                preferredFormat: "hex",
                hideAfterPaletteSelect: true,
                change: ToolbarHighlightColorChanged
            });
            $('#spToolBarHoverColor-' + vtBase.cID).spectrum("enable");
            $('#spToolBarStrokeColor-' + vtBase.cID).spectrum("enable");
        } else {
            $('#spToolBarStrokeColor-' + vtBase.cID).spectrum({ color: lineColor });
            $('#spToolBarHoverColor-' + vtBase.cID).spectrum({ color: highlightColor });
            $('#spToolBarHoverColor-' + vtBase.cID).spectrum("disable");
            $('#spToolBarStrokeColor-' + vtBase.cID).spectrum("disable");
        }
    }

    function ToolbarLineColorChanged(color) {
        vtBase.SelectedVtObject.SettingsValues.ForeColor = color.toHexString();
        vtBase.VtRedrawFunction(vtBase.cID);
        if (vtBase.ChartDisplay.ActiveIndicatorSettings === vtBase.SelectedVtObject.vtID) {
            vtBase.ChartInstance.ParentELement.trigger("TriggerSettings", [vtBase.ChartDisplay.ActiveIndicatorSettings]);
            UpdateSessionObject();
            vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
        }
    }

    function ToolbarHighlightColorChanged(color) {
        vtBase.SelectedVtObject.SettingsValues.HighlightColor = color.toHexString();
        vtBase.VtRedrawFunction(vtBase.cID);
        if (vtBase.ChartDisplay.ActiveIndicatorSettings === vtBase.SelectedVtObject.vtID) {
            vtBase.ChartInstance.ParentELement.trigger("TriggerSettings", [vtBase.ChartDisplay.ActiveIndicatorSettings]);
            UpdateSessionObject();
            vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
        }
    }

    function getAllActiveVisualTools(ContextItem, VisualToolsSettingsFunction) {
        var Items = {};

        var count = WC.VT.VisualToolsObjectCollection[vtBase.cID].length;

        if (count === 0) {
            switch (ContextItem) {
                case "Settings":
                    return Items;
                case "Remove":
                    Items['RemoveAllVisualTools'] = { name: txtRemoveAll, disabled: true };
                    break;
            }

            return Items;
        }

        if (count > 0) {
            var ChartWords = WC.ChartWords;
            switch (ContextItem) {
                case "Settings":
                    for (var i = 0; i < count; i++) {
                        var transname = ChartWords[WC.VT.VisualToolsObjectCollection[vtBase.cID][i].vtInfo.vtCodeName];
                        var translatedword = transname ? transname : WC.VT.VisualToolsObjectCollection[vtBase.cID][i].vtInfo.vtProperName;
                        Items[WC.VT.VisualToolsObjectCollection[vtBase.cID][i].vtID] = { name: ((i + 1) + ". " + translatedword), callback: VisualToolsSettingsFunction };
                    }
                    break;
                case "Remove":
                    Items['RemoveAllVisualTools'] = { name: txtRemoveAll, disabled: false, callback: vtBase.RemoveAllVisualTools };

                    for (var i = 0; i < count; i++) {
                        var transname = ChartWords[WC.VT.VisualToolsObjectCollection[vtBase.cID][i].vtInfo.vtCodeName];
                        var translatedword = transname ? transname : WC.VT.VisualToolsObjectCollection[vtBase.cID][i].vtInfo.vtProperName;
                        Items[WC.VT.VisualToolsObjectCollection[vtBase.cID][i].vtID] = { name: ((i + 1) + ". " + translatedword), callback: vtBase.RemoveVisualTools };
                    }
                    break;
            }

            return Items;
        }
    }

    vtBase.RemoveAllVisualTools = function () {
        WC.VT.VisualToolsObjectCollection[vtBase.cID] = [];
        vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
        vtBase.SelectedVT = null;
        vtBase.HoveringVT = null;
        vtBase.isDraggingVT = false;
        vtBase.SelectedVtObject = null;
        vtBase.ChartInstance.ParentELement.trigger("TriggerSettingsClose", [null, "RemoveAll"]);
        vtBase.ChartDisplay.ActiveVisualTools = [];
        vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
    }

    vtBase.RemoveVisualTools = function (VisualToolID) {
        var count = WC.VT.VisualToolsObjectCollection[vtBase.cID].length;
        if (count === null || count === 0) {
            return;
        }

        for (var i = 0; i < count; i++) {
            if (WC.VT.VisualToolsObjectCollection[vtBase.cID][i] != undefined && WC.VT.VisualToolsObjectCollection[vtBase.cID][i].vtID === VisualToolID) {
                WC.VT.VisualToolsObjectCollection[vtBase.cID].splice(i, 1);
                vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
                vtBase.ChartInstance.ParentELement.trigger("TriggerSettingsClose", [VisualToolID, "Remove"]);
                vtBase.SelectedVT = null;
                vtBase.HoveringVT = null;
                vtBase.isDraggingVT = false;
                vtBase.SelectedVtObject = null;
            }
        }
    }

    vtBase.Selector = $(vtBase.ChartInstance.VisualToolsCanvas);
    vtBase.vtToCreate = null;
    vtBase.SelectedVT = null;
    vtBase.HoveringVT = null;
    vtBase.SelectedVtObject = null;
    vtBase.lastSelectedVT = null;
    vtBase.SelectedPoint = null;
    vtBase.isHoveringEndpoint = false;
    vtBase.hoverNum = 0;
    vtBase.hoverAnchor = null;
    var PointA, PointB, PointC;
    vtBase.Selector.on('mousedown', vtMouseDown);
    vtBase.Selector.on('mousemove', vtMouseMove);
    vtBase.Selector.on('mouseup', vtMouseUp);
    vtBase.Selector.on('mouseout', vtMouseOut);

    vtBase.Selector.on('touchstart', vtMouseDown);
    vtBase.Selector.on('touchmove', vtMouseMove);
    vtBase.Selector.on('touchend', vtMouseUp);

    vtBase.ctx = vtBase.ChartInstance.ctxVisualToolsCanvas;

    vtBase.initDrawVT = function (VT) {
        if (WC.VT.VisualToolsObjectCollection[ContainerID].length !== 0) {
            for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                if (WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected) {
                    WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                    WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                }
            }
        }
        vtBase.SelectedVtObject = null;
        vtBase.SelectedVT = null;
        if (vtBase.tempVT !== null) {
            vtBase.tempVT = null;
        }
        if (vtBase.ChartInstance.VisualToolsInput.style.display !== "none") {
            vtBase.ChartInstance.VisualToolsInput.style.display = "none";
        }
        vtBase.vtToCreate = VT;
        if (vtBase.tempVT !== null) {
            vtBase.tempVT = null;
        }
        isDrawingMode = true;
        vtBase.Selector.css('cursor', 'crosshair');
    }


    function getObjectIndex(id) {
        var count = WC.VT.VisualToolsObjectCollection[ContainerID].length;
        var i;
        for (i = 0; i < count; i++) {
            if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID === id) {
                break;
            }
        }

        return i;
    }

    function DeselectSelectedVT(id) {
        var obj = WC.VT.VisualToolsObjectCollection[ContainerID][getObjectIndex(id)];
        obj.isSelected = false;
        obj.isHovered = false;
        vtBase.lastSelectedVT = null;
    }

    function vtMouseOut() {
        vtMouseUp();
    }

    function vtMouseDown(event) {
        var pntr = event.originalEvent.targetTouches ? event.originalEvent.targetTouches[0] : event;

        mdX = event.offsetX ? event.offsetX : pntr.pageX;
        mdY = event.offsetY ? event.offsetY : pntr.pageY;
        isDown = true;

        if (vtBase.SelectedVT !== null && vtBase.HoveringVT !== null) {

            for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID === vtBase.SelectedVT) {
                    switch (WC.VT.VisualToolsObjectCollection[ContainerID][i].BaseType) {
                        case "Line":
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5)) {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, tempX, tempY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                }

                                vtBase.hoverNum = endpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, 5, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case "Polygon":
                            {
                                if (!inPolygon(Math.min(vtBase.SelectedVtObject.vtProp.A.x, vtBase.SelectedVtObject.vtProp.E.x), Math.min(vtBase.SelectedVtObject.vtProp.A.y, vtBase.SelectedVtObject.vtProp.E.y), Math.max(vtBase.SelectedVtObject.vtProp.A.x, vtBase.SelectedVtObject.vtProp.E.x), Math.max(vtBase.SelectedVtObject.vtProp.A.y, vtBase.SelectedVtObject.vtProp.E.y), tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }
                                vtBase.hoverAnchor = null;
                                for (var i in vtBase.SelectedVtObject.vtProp) {
                                    if (polygonAnchorPointHovering(vtBase.SelectedVtObject.vtProp[i].x, vtBase.SelectedVtObject.vtProp[i].y, 5, mdX, mdY)) {
                                        vtBase.hoverAnchor = i;
                                    }
                                }

                                if (vtBase.hoverAnchor !== null) {
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                } else if (vtBase.hoverAnchor === null) {
                                    vtBase.isHoveringEndpoint = false;
                                    vtBase.isDraggingVT = true;
                                }

                                vtBase.isDraggingVT = true;
                            }
                            break;
                        case "Text":
                            {
                                if (!inText(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, tempX, tempY, 5, vtBase.SelectedVtObject.SettingsValues.FontSize, vtBase.SelectedVtObject.TextWidth)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }
                                vtBase.isDraggingVT = true;
                            }
                            break;
                        case "Balloon":
                            {
                                if (!inText(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, tempX, tempY, 5, vtBase.SelectedVtObject.SettingsValues.FontSize, vtBase.SelectedVtObject.TextWidth) && singlePointHovering(vtBase.SelectedVtObject.HandlePointX, vtBase.SelectedVtObject.HandlePointY, 3, tempX, tempY) == null) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }
                                vtBase.isDraggingVT = true;
                            }
                            break;
                        case "Callout":
                            {
                                if (inText(vtBase.SelectedVtObject.PolygonX, vtBase.SelectedVtObject.PolygonY, tempX, tempY, 5, vtBase.SelectedVtObject.PolygonHeight, vtBase.SelectedVtObject.PolygonWidth)) {
                                    vtBase.hoverNum = 2;
                                    vtBase.isHoveringEndpoint = true;
                                    //vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                }
                                else if (singlePointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, 3, tempX, tempY) == 0) {
                                    vtBase.hoverNum = 1;
                                    vtBase.isHoveringEndpoint = true;
                                    //vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                }
                                else {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                            }
                            break;
                        case "4-Point":
                            if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5)) {
                                vtBase.lastSelectedVT = vtBase.SelectedVT;
                                vtBase.SelectedVT = null;
                                vtBase.SelectedVtObject.isSelected = false;
                                vtBase.SelectedVtObject.isHovered = false;
                                vtBase.VtRedrawFunction(vtBase.cID);
                                vtBase.isDraggingVT = false;
                                vtBase.setToolbar(false, '#909090', '#909090');
                                vtBase.SelectedVtObject = null;
                                return;
                            }

                            vtBase.hoverNum = ABCDendpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2,
								vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, 5, tempX, tempY);
                            switch (vtBase.hoverNum) {
                                case 0:
                                    vtBase.isHoveringEndpoint = false;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 1:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 2:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 3:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 4:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                            }
                            break;
                        case 'Pitchfork':

                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.ExtendedX1, vtBase.SelectedVtObject.ExtendedY1, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.ExtendedX2, vtBase.SelectedVtObject.ExtendedY2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.ExtendedX3, vtBase.SelectedVtObject.ExtendedY3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.hoverNum = PitchforkEndpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, 8, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 3:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case "Parallel":
                            {
                                if (vtBase.SelectedVtObject.SettingsValues.ExtendToInfinity === "True") {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5)
										&& !isMouseOverLineInfinity(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5, ContainerID) && !isMouseOverLineInfinity(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5, ContainerID)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                }
                                else {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                }

                                vtBase.hoverNum = parallelPointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2,
								 vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, 5, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 3:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case "GannLine":
                            {
                                if (vtBase.SelectedVtObject.SettingsValues.ExtendToInfinity === "True") {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !isMouseOverLineInfinity(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5, ContainerID)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                }
                                else {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }

                                }

                                vtBase.hoverNum = oneendPointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, 5, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case "5-Point":
                            if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, tempX, tempY, 5) && !inTriangle(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY) && !inTriangle(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, tempX, tempY)) {
                                vtBase.lastSelectedVT = vtBase.SelectedVT;
                                vtBase.SelectedVT = null;
                                vtBase.SelectedVtObject.isSelected = false;
                                vtBase.SelectedVtObject.isHovered = false;
                                vtBase.VtRedrawFunction(vtBase.cID);
                                vtBase.isDraggingVT = false;
                                vtBase.setToolbar(false, '#909090', '#909090');
                                vtBase.SelectedVtObject = null;
                                return;
                            }

                            vtBase.hoverNum = XABCDendpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2,
								vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, 5, tempX, tempY);
                            switch (vtBase.hoverNum) {
                                case 0:
                                    vtBase.isHoveringEndpoint = false;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 1:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 2:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 3:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 4:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 5:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                            }
                            break;
                        case "7-Point":
                            if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X6, vtBase.SelectedVtObject.vtProperties.Y6, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, vtBase.SelectedVtObject.vtProperties.X6, vtBase.SelectedVtObject.vtProperties.Y6, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X6, vtBase.SelectedVtObject.vtProperties.Y6, vtBase.SelectedVtObject.vtProperties.X7, vtBase.SelectedVtObject.vtProperties.Y7, tempX, tempY, 5)) {
                                vtBase.lastSelectedVT = vtBase.SelectedVT;
                                vtBase.SelectedVT = null;
                                vtBase.SelectedVtObject.isSelected = false;
                                vtBase.SelectedVtObject.isHovered = false;
                                vtBase.VtRedrawFunction(vtBase.cID);
                                vtBase.isDraggingVT = false;
                                vtBase.SelectedVtObject = null;
                                return;
                            }

                            vtBase.hoverNum = ThreeDriversEndpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2,
								vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, vtBase.SelectedVtObject.vtProperties.X6, vtBase.SelectedVtObject.vtProperties.Y6, vtBase.SelectedVtObject.vtProperties.X7, vtBase.SelectedVtObject.vtProperties.Y7, 5, tempX, tempY);
                            switch (vtBase.hoverNum) {
                                case 0:
                                    vtBase.isHoveringEndpoint = false;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 1:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 2:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 3:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 4:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 5:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 6:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 7:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                            }
                            break;
                        case "Ray":
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.hoverNum = endpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, 5, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case "Extended":
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.hoverNum = endpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, 5, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case "4-PointTriangle":
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5) && !inTriangle(vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, vtBase.SelectedVtObject.vtProperties.X6, vtBase.SelectedVtObject.vtProperties.Y6, vtBase.SelectedVtObject.vtProperties.X7, vtBase.SelectedVtObject.vtProperties.Y7, tempX, tempY)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.hoverNum = ABCDendpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, 5, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 3:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 4:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case "GannBox":
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.X3, vtBase.SelectedVtObject.Y3, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.X4, vtBase.SelectedVtObject.Y4, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.X3, vtBase.SelectedVtObject.Y3, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.X4, vtBase.SelectedVtObject.Y4, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.X5, vtBase.SelectedVtObject.Y5, vtBase.SelectedVtObject.X10, vtBase.SelectedVtObject.Y10, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.X6, vtBase.SelectedVtObject.Y6, vtBase.SelectedVtObject.X11, vtBase.SelectedVtObject.Y11, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.X7, vtBase.SelectedVtObject.Y7, vtBase.SelectedVtObject.X12, vtBase.SelectedVtObject.Y12, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.X8, vtBase.SelectedVtObject.Y8, vtBase.SelectedVtObject.X13, vtBase.SelectedVtObject.Y13, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.X9, vtBase.SelectedVtObject.Y9, vtBase.SelectedVtObject.X14, vtBase.SelectedVtObject.Y14, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.X15, vtBase.SelectedVtObject.Y15, vtBase.SelectedVtObject.X20, vtBase.SelectedVtObject.Y20, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.X16, vtBase.SelectedVtObject.Y16, vtBase.SelectedVtObject.X21, vtBase.SelectedVtObject.Y21, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.X17, vtBase.SelectedVtObject.Y17, vtBase.SelectedVtObject.X22, vtBase.SelectedVtObject.Y22, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.X18, vtBase.SelectedVtObject.Y18, vtBase.SelectedVtObject.X23, vtBase.SelectedVtObject.Y23, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.X19, vtBase.SelectedVtObject.Y19, vtBase.SelectedVtObject.X24, vtBase.SelectedVtObject.Y24, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.hoverNum = endpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, 5, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case 'SchiffPitchfork':
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.medianX, vtBase.SelectedVtObject.medianY, vtBase.SelectedVtObject.ExtendedX1, vtBase.SelectedVtObject.ExtendedY1, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.ExtendedX2, vtBase.SelectedVtObject.ExtendedY2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.ExtendedX3, vtBase.SelectedVtObject.ExtendedY3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.hoverNum = PitchforkEndpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, 8, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 3:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case 'InsidePitchfork':
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.medianX, vtBase.SelectedVtObject.medianY, vtBase.SelectedVtObject.ExtendedX1, vtBase.SelectedVtObject.ExtendedY1, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.ExtendedX2, vtBase.SelectedVtObject.ExtendedY2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.ExtendedX3, vtBase.SelectedVtObject.ExtendedY3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.hoverNum = PitchforkEndpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, 8, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 3:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case 'PitchFan':
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.ExtendedX1, vtBase.SelectedVtObject.ExtendedY1, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.ExtendedX2, vtBase.SelectedVtObject.ExtendedY2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.ExtendedX3, vtBase.SelectedVtObject.ExtendedY3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.ExtendedX4, vtBase.SelectedVtObject.ExtendedY4, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.ExtendedX5, vtBase.SelectedVtObject.ExtendedY5, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.hoverNum = PitchforkEndpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, 8, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 3:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;

                        case 'FibonacciChannel':
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }
                                vtBase.hoverNum = PitchforkEndpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, 8, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 3:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case 'TrendBasedFibonacciExtension':
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }
                                vtBase.hoverNum = PitchforkEndpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, 8, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 3:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case "FibonacciSpiral":
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.hoverNum = endpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, 5, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case 'FibWedge':

                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.hoverNum = PitchforkEndpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, 8, tempX, tempY);
                                if (endpointOverlapping(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, 5, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2) && endpointOverlapping(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, 5, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3)) {
                                    vtBase.hoverNum = 1;
                                }
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 3:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;

                                        break;
                                }
                            }
                            break;
                        case "GannSquare":
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X6, vtBase.SelectedVtObject.vtProperties.Y6, vtBase.SelectedVtObject.vtProperties.X7, vtBase.SelectedVtObject.vtProperties.Y7, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X8, vtBase.SelectedVtObject.vtProperties.Y8, vtBase.SelectedVtObject.vtProperties.X9, vtBase.SelectedVtObject.vtProperties.Y9, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X10, vtBase.SelectedVtObject.vtProperties.Y10, vtBase.SelectedVtObject.vtProperties.X11, vtBase.SelectedVtObject.vtProperties.Y11, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X12, vtBase.SelectedVtObject.vtProperties.Y12, vtBase.SelectedVtObject.vtProperties.X13, vtBase.SelectedVtObject.vtProperties.Y13, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X14, vtBase.SelectedVtObject.vtProperties.Y14, vtBase.SelectedVtObject.vtProperties.X15, vtBase.SelectedVtObject.vtProperties.Y15, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X16, vtBase.SelectedVtObject.vtProperties.Y16, vtBase.SelectedVtObject.vtProperties.X17, vtBase.SelectedVtObject.vtProperties.Y17, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X18, vtBase.SelectedVtObject.vtProperties.Y18, vtBase.SelectedVtObject.vtProperties.X19, vtBase.SelectedVtObject.vtProperties.Y19, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X20, vtBase.SelectedVtObject.vtProperties.Y20, vtBase.SelectedVtObject.vtProperties.X21, vtBase.SelectedVtObject.vtProperties.Y21, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.hoverNum = endpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, 5, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case "RegressionLine":
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5)) {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, tempX, tempY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                }

                                vtBase.hoverNum = endpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, 5, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case 'Pen':
                            {
                                var flag;
                                vtBase.SelectedVtObject.vtProperties.points.forEach(function (path) {
                                    if (vtBase.SelectedVtObject.vtProperties.points.some(function (point) {
									  return flag = isBetween(point.x, point.y, tempX, tempY, 5)
                                    })) {
                                    }
                                });
                                if (!flag) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.ishoveringendpoint = false;
                                vtBase.isdraggingvt = true;


                            }
                            break;
                        case "Horizontal":
                            {
                                if (vtBase.SelectedVtObject.SettingsValues.ExtendToInfinityL.toLowerCase() === "true" && vtBase.SelectedVtObject.SettingsValues.ExtendToInfinityR.toLowerCase() === "true") {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                } else if (vtBase.SelectedVtObject.SettingsValues.ExtendToInfinityL.toLowerCase() === "true" && vtBase.SelectedVtObject.SettingsValues.ExtendToInfinityR.toLowerCase() === "false") {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                } else if (vtBase.SelectedVtObject.SettingsValues.ExtendToInfinityL.toLowerCase() === "false" && vtBase.SelectedVtObject.SettingsValues.ExtendToInfinityR.toLowerCase() === "true") {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                } else {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X1 + 10, vtBase.SelectedVtObject.vtProperties.Y1 + 10, tempX, tempY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                }

                                vtBase.isHoveringEndpoint = false;
                                vtBase.isDraggingVT = true;
                            }
                            break;
                        case "Vertical":
                            {
                                if (vtBase.SelectedVtObject.SettingsValues.ExtendToInfinityB.toLowerCase() === "true" && vtBase.SelectedVtObject.SettingsValues.ExtendToInfinityT.toLowerCase() === "true") {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                } else if (vtBase.SelectedVtObject.SettingsValues.ExtendToInfinityT.toLowerCase() === "true" && vtBase.SelectedVtObject.SettingsValues.ExtendToInfinityB.toLowerCase() === "false") {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                } else if (vtBase.SelectedVtObject.SettingsValues.ExtendToInfinityT.toLowerCase() === "false" && vtBase.SelectedVtObject.SettingsValues.ExtendToInfinityB.toLowerCase() === "true") {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                } else {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X1 + 10, vtBase.SelectedVtObject.vtProperties.Y1 + 10, tempX, tempY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                }

                                vtBase.isHoveringEndpoint = false;
                                vtBase.isDraggingVT = true;
                            }
                            break;
                        case "TrendAngle":
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5)) {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, tempX, tempY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                }

                                vtBase.hoverNum = endpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, 5, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                    case 1:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case "FTB":
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3A, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X3B, vtBase.SelectedVtObject.vtProperties.Y3, mdX, mdY, 5)) {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3B, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X3A, vtBase.SelectedVtObject.vtProperties.Y3, mdX, mdY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                }

                                vtBase.hoverNum = ABCDendpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3A, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X3B, vtBase.SelectedVtObject.vtProperties.Y3, 5, mdX, mdY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 3:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 4:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case "Disjoint":
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3A, vtBase.SelectedVtObject.vtProperties.Y3A, vtBase.SelectedVtObject.vtProperties.X3B, vtBase.SelectedVtObject.vtProperties.Y3B, mdX, mdY, 5)) {
                                    if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3B, vtBase.SelectedVtObject.vtProperties.Y3B, vtBase.SelectedVtObject.vtProperties.X3A, vtBase.SelectedVtObject.vtProperties.Y3A, mdX, mdY, 5)) {
                                        vtBase.lastSelectedVT = vtBase.SelectedVT;
                                        vtBase.SelectedVT = null;
                                        vtBase.SelectedVtObject.isSelected = false;
                                        vtBase.SelectedVtObject.isHovered = false;
                                        vtBase.VtRedrawFunction(vtBase.cID);
                                        vtBase.isDraggingVT = false;
                                        vtBase.setToolbar(false, '#909090', '#909090');
                                        vtBase.SelectedVtObject = null;
                                        return;
                                    }
                                }

                                vtBase.hoverNum = ABCDendpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3A, vtBase.SelectedVtObject.vtProperties.Y3A, vtBase.SelectedVtObject.vtProperties.X3B, vtBase.SelectedVtObject.vtProperties.Y3B, 5, mdX, mdY);
                                if (Math.abs(vtBase.SelectedVtObject.vtProperties.X1 - vtBase.SelectedVtObject.vtProperties.X2) < 2 && Math.abs(vtBase.SelectedVtObject.vtProperties.X1 - vtBase.SelectedVtObject.vtProperties.X3A) < 2 && Math.abs(vtBase.SelectedVtObject.vtProperties.X1 - vtBase.SelectedVtObject.vtProperties.X3B) < 2
									 && Math.abs(vtBase.SelectedVtObject.vtProperties.Y1 - vtBase.SelectedVtObject.vtProperties.Y2) < 5 && Math.abs(vtBase.SelectedVtObject.vtProperties.Y1 - vtBase.SelectedVtObject.vtProperties.Y3A) < 5 && Math.abs(vtBase.SelectedVtObject.vtProperties.Y1 - vtBase.SelectedVtObject.vtProperties.Y3B) < 5) {
                                    vtBase.hoverNum = 2;
                                }
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 3:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 4:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case "8-Points":
                            if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, vtBase.SelectedVtObject.vtProperties.X6, vtBase.SelectedVtObject.vtProperties.Y6, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X6, vtBase.SelectedVtObject.vtProperties.Y6, vtBase.SelectedVtObject.vtProperties.X7, vtBase.SelectedVtObject.vtProperties.Y7, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X7, vtBase.SelectedVtObject.vtProperties.Y7, vtBase.SelectedVtObject.vtProperties.X8, vtBase.SelectedVtObject.vtProperties.Y8, tempX, tempY, 5)) {
                                vtBase.lastSelectedVT = vtBase.SelectedVT;
                                vtBase.SelectedVT = null;
                                vtBase.SelectedVtObject.isSelected = false;
                                vtBase.SelectedVtObject.isHovered = false;
                                vtBase.VtRedrawFunction(vtBase.cID);
                                vtBase.isDraggingVT = false;
                                vtBase.SelectedVtObject = null;
                                return;
                            }

                            vtBase.hoverNum = EightPointsEndpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2,
								vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, vtBase.SelectedVtObject.vtProperties.X6, vtBase.SelectedVtObject.vtProperties.Y6, vtBase.SelectedVtObject.vtProperties.X7, vtBase.SelectedVtObject.vtProperties.Y7, vtBase.SelectedVtObject.vtProperties.X8, vtBase.SelectedVtObject.vtProperties.Y8, 5, tempX, tempY);
                            switch (vtBase.hoverNum) {
                                case 0:
                                    vtBase.isHoveringEndpoint = false;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 1:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 2:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 3:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 4:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 5:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 6:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 7:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 8:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                            }
                            break;
                        case "HeadAndShoulders":
                            var a = (vtBase.SelectedVtObject.checkIntersect1) ? !inTriangle(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X8, vtBase.SelectedVtObject.vtProperties.Y8, tempX, tempY) : true;
                            var b = (vtBase.SelectedVtObject.checkIntersect2) ? !inTriangle(vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, vtBase.SelectedVtObject.vtProperties.X6, vtBase.SelectedVtObject.vtProperties.Y6, vtBase.SelectedVtObject.vtProperties.X9, vtBase.SelectedVtObject.vtProperties.Y9, tempX, tempY) : true;
                            if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, vtBase.SelectedVtObject.vtProperties.X6, vtBase.SelectedVtObject.vtProperties.Y6, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X6, vtBase.SelectedVtObject.vtProperties.Y6, vtBase.SelectedVtObject.vtProperties.X7, vtBase.SelectedVtObject.vtProperties.Y7, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, tempX, tempY, 5)
								&& !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X8, vtBase.SelectedVtObject.vtProperties.Y8, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, vtBase.SelectedVtObject.vtProperties.X9, vtBase.SelectedVtObject.vtProperties.Y9, tempX, tempY, 5) && !inTriangle(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, tempX, tempY) && a && b) {
                                vtBase.lastSelectedVT = vtBase.SelectedVT;
                                vtBase.SelectedVT = null;
                                vtBase.SelectedVtObject.isSelected = false;
                                vtBase.SelectedVtObject.isHovered = false;
                                vtBase.VtRedrawFunction(vtBase.cID);
                                vtBase.isDraggingVT = false;
                                vtBase.SelectedVtObject = null;
                                return;
                            }

                            vtBase.hoverNum = ThreeDriversEndpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2,
								vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, vtBase.SelectedVtObject.vtProperties.X5, vtBase.SelectedVtObject.vtProperties.Y5, vtBase.SelectedVtObject.vtProperties.X6, vtBase.SelectedVtObject.vtProperties.Y6, vtBase.SelectedVtObject.vtProperties.X7, vtBase.SelectedVtObject.vtProperties.Y7, 5, tempX, tempY);
                            switch (vtBase.hoverNum) {
                                case 0:
                                    vtBase.isHoveringEndpoint = false;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 1:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 2:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 3:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 4:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 5:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 6:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 7:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                            }
                            break;
                        case 'PriceDateRange':
                            {
                                if (!inPolygon(Math.min(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2), Math.min(vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2), Math.max(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2), Math.max(vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2), tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.hoverNum = endpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, 5, mdX, mdY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case "Label":
                            {
                                if (singlePointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, 4, tempX, tempY) === null) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }
                                vtBase.isDraggingVT = true;
                            }
                            break;
                        case 'Image':
                            {
                                if (!isBetween(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, tempX, tempY, 5) && !inPolygon(Math.min(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.X3), Math.min(vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.Y3), Math.max(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.X3), Math.max(vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.Y3), tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }

                                vtBase.isHoveringEndpoint = false;
                                vtBase.isDraggingVT = true;

                            }
                            break;
                        case "Cyclic": // On mouse move
                            if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, tempX, tempY, 5)) {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }
                            }
                            vtBase.hoverNum = endpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, 5, tempX, tempY);
                            switch (vtBase.hoverNum) {
                                case 0:
                                    vtBase.isHoveringEndpoint = false;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 1:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                                case 2:
                                    vtBase.isHoveringEndpoint = true;
                                    vtBase.HoveringVT = null;
                                    vtBase.isDraggingVT = true;
                                    break;
                            }
                            break;
                        case "Note":
                            {
                                if (!inPolygon(Math.min(vtBase.SelectedVtObject.vtProperties.X1 - 10, vtBase.SelectedVtObject.vtProperties.X1 + 10), Math.min(vtBase.SelectedVtObject.vtProperties.Y1 - 20, vtBase.SelectedVtObject.vtProperties.Y1), Math.max(vtBase.SelectedVtObject.vtProperties.X1 - 10, vtBase.SelectedVtObject.vtProperties.X1 + 10), Math.max(vtBase.SelectedVtObject.vtProperties.Y1 - 20, vtBase.SelectedVtObject.vtProperties.Y1), tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }
                                vtBase.isDraggingVT = true;
                            }
                            break;
                        case "ShortPosition":
                        case "LongPosition":
                            {
                                if (!inPolygon(Math.min(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2), Math.min(vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.Y4), Math.max(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2), Math.max(vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.Y4), tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }
                                vtBase.hoverNum = ABCDendpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, 5, mdX, mdY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 2:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 3:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 4:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                            break;
                        case 'BarsPattern':
                            {
                                if (tempX >= vtBase.SelectedVtObject.vtProperties.X1 && tempX <= vtBase.SelectedVtObject.vtProperties.X2) {
                                    vtBase.SelectedVtObject.IsBarsHovered = true;
                                    vtBase.isDraggingVT = true;
                                    vtBase.SelectedVT = vtBase.HoveringVT;
                                }
                                else {
                                    vtBase.SelectedVtObject.IsBarsHovered = false;
                                    vtBase.SelectedVT = null;
                                }
                                var YPoint2 = vtBase.ChartInstance.GetYaxis(vtBase.SelectedVtObject.BarsCollection[0].Low + vtBase.SelectedVtObject.AllowancePips);
                                var YPoint1 = vtBase.ChartInstance.GetYaxis(vtBase.SelectedVtObject.BarsCollection[vtBase.SelectedVtObject.BarsCollection.length - 1].High + vtBase.SelectedVtObject.AllowancePips);
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, YPoint1, vtBase.SelectedVtObject.vtProperties.X1, YPoint1, tempX, tempY, 5) && !WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X2, YPoint2, vtBase.SelectedVtObject.vtProperties.X2, YPoint2, tempX, tempY, 5) && !CheckBarsPatternHovered(vtBase.SelectedVtObject, tempX, tempY)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.setToolbar(false, '#909090', '#909090');
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }
                                vtBase.hoverNum = endpointHovering(vtBase.SelectedVtObject.vtProperties.X1, YPoint1, vtBase.SelectedVtObject.vtProperties.X2, YPoint2, 5, tempX, tempY);
                                vtBase.isHoveringEndpoint = false;
                                vtBase.isDraggingVT = true;
                            }
                        case "Arc":
                            {
                                if (!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5) &&
									!WC.VT.isMouseOverLine(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, tempX, tempY, 5)) {
                                    vtBase.lastSelectedVT = vtBase.SelectedVT;
                                    vtBase.SelectedVT = null;
                                    vtBase.SelectedVtObject.isSelected = false;
                                    vtBase.SelectedVtObject.isHovered = false;
                                    vtBase.VtRedrawFunction(vtBase.cID);
                                    vtBase.isDraggingVT = false;
                                    vtBase.SelectedVtObject = null;
                                    return;
                                }
                                vtBase.hoverNum = ArcEndpointHovering(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3, vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4, 5, tempX, tempY);
                                switch (vtBase.hoverNum) {
                                    case 0:
                                        vtBase.isHoveringEndpoint = false;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 1:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 3:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                    case 4:
                                        vtBase.isHoveringEndpoint = true;
                                        vtBase.HoveringVT = null;
                                        vtBase.isDraggingVT = true;
                                        break;
                                }
                            }
                    }
                }
            }


        }
        if (!isDrawingMode) {
            vtBase.ChartInstance.MouseDownEvent(mdX);
            if (vtBase.HoveringVT !== null) {
                vtBase.SelectedVT = vtBase.HoveringVT;
                vtBase.SelectedVtObject = WC.VT.VisualToolsObjectCollection[ContainerID][getObjectIndex(vtBase.SelectedVT)];
                vtBase.SelectedVtObject.isSelected = true;
                vtBase.VtRedrawFunction(vtBase.cID);
            } else {
                if (vtBase.SelectedVT !== null) {
                    if (!vtBase.isHoveringEndpoint) {
                        vtBase.SelectedVT = null;
                        vtBase.SelectedVtObject.isSelected = false;
                        vtBase.VtRedrawFunction(vtBase.cID);
                        vtBase.SelectedVtObject = null;
                        vtBase.setToolbar(false, '#909090', '#909090');
                    }
                } else {
                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected) {
                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                            vtBase.setToolbar(false, '#909090', '#909090');
                            vtBase.VtRedrawFunction(ContainerID);
                        }
                    }
                }

            }
            return;
        }

        var ev = event;
        if (event = null) {
            return;
        }

        switch (vtBase.vtToCreate) {
            case 'TrendLine':
                {
                    if (vtBase.tempVT === null) {
                        vtBase.tempVT = new WC.VT.TrendLine(vtBase.ChartInstance, GenerateID(), vtBase.cID);
                        vtBase.tempVT.vtProperties.X1 = mdX, vtBase.tempVT.vtProperties.Y1 = mdY;
                        vtBase.tempVT.DatePriceProperties.x1Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y1Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                    } else {
                        vtBase.tempVT.vtProperties.X2 = mdX, vtBase.tempVT.vtProperties.Y2 = mdY;

                        vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;

                        vtBase.tempVT.AdjustVT();
                        vtBase.tempVT.isSelected = true;
                        vtBase.tempVT.isHovered = true;
                        WC.VT.VisualToolsObjectCollection[vtBase.tempVT.ContainerID].push(vtBase.tempVT);
                        vtBase.vtToCreate = null;
                        vtBase.Selector.css('cursor', vtBase.Cursor);
                        vtBase.SelectedVtObject = vtBase.tempVT;
                        vtBase.setToolbar(true, vtBase.SelectedVtObject.SettingsValues.ForeColor, vtBase.SelectedVtObject.SettingsValues.HighlightColor);
                        //vtBase.tempVT = null;
                        isDrawingMode = false;
                        vtBase.CanvasCleared = false;
                        vtBase.VtRedrawFunction(vtBase.cID);
                        vtBase.ChartDisplay.ActiveVisualTools.push({ Key: vtBase.tempVT.vtInfo.vtName, ID: vtBase.tempVT.vtID, Settings: vtBase.tempVT.SettingsValues, Properties: setProperty(vtBase.tempVT.vtID) });
                        vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
                        vtBase.tempVT = null;
                    }
                    event = null;
                    break;
                }
            case "FibonacciTimezone":
                if (vtBase.tempVT == null) {
                    //Creating new Instance and Intialize
                    vtBase.tempVT = new WC.VT.FibonacciTimezone(vtBase.ChartInstance, GenerateID(), vtBase.cID);
                    //Setting X,Y point when first mousedown fired
                    vtBase.tempVT.vtProperties.X1 = mdX;
                    vtBase.tempVT.vtProperties.Y1 = mdY;
                    //Converting X to Date and Y to Price
                    vtBase.tempVT.DatePriceProperties.x1Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                    vtBase.tempVT.DatePriceProperties.y1Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                }
                else {
                    //Setting X,Y point when second mousedown fired
                    vtBase.tempVT.vtProperties.X2 = mdX;
                    vtBase.tempVT.vtProperties.Y2 = mdY;
                    //Converting X to Date and Y to Price
                    vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                    vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;

                    vtBase.tempVT.AdjustVT();
                    vtBase.tempVT.isSelected = true;
                    vtBase.tempVT.isHovered = true;
                    WC.VT.VisualToolsObjectCollection[vtBase.tempVT.ContainerID].push(vtBase.tempVT);
                    vtBase.vtToCreate = null;
                    vtBase.Selector.css('cursor', vtBase.Cursor);
                    vtBase.SelectedVtObject = vtBase.tempVT;
                    vtBase.setToolbar(true, vtBase.SelectedVtObject.SettingsValues.ForeColor, vtBase.SelectedVtObject.SettingsValues.HighlightColor);

                    isDrawingMode = false;
                    vtBase.CanvasCleared = false;
                    vtBase.VtRedrawFunction(vtBase.cID);
                    vtBase.ChartDisplay.ActiveVisualTools.push({ Key: vtBase.tempVT.vtInfo.vtName, ID: vtBase.tempVT.vtID, Settings: vtBase.tempVT.SettingsValues, Properties: setProperty(vtBase.tempVT.vtID) });
                    vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
                    vtBase.tempVT = null;
                }
                event = null;
                break;

            case 'Ellipse':
                {
                    if (vtBase.tempVT === null) {
                        vtBase.tempVT = new WC.VT.Ellipse(vtBase.ChartInstance, GenerateID(), vtBase.cID);
                        vtBase.tempVT.vtProperties.X1 = mdX, vtBase.tempVT.vtProperties.Y1 = mdY;
                        vtBase.tempVT.DatePriceProperties.x1Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y1Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                    } else {
                        vtBase.tempVT.vtProp.E.x = mdX, vtBase.tempVT.vtProp.E.y = mdY;
                        vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                        vtBase.tempVT.AdjustVT();
                        vtBase.tempVT.isSelected = true;
                        vtBase.tempVT.isHovered = true;
                        WC.VT.VisualToolsObjectCollection[vtBase.tempVT.ContainerID].push(vtBase.tempVT);
                        vtBase.vtToCreate = null;
                        vtBase.Selector.css('cursor', vtBase.Cursor);
                        vtBase.SelectedVtObject = vtBase.tempVT;
                        vtBase.setToolbar(true, vtBase.SelectedVtObject.SettingsValues.ForeColor, vtBase.SelectedVtObject.SettingsValues.HighlightColor);

                        isDrawingMode = false;
                        vtBase.CanvasCleared = false;
                        vtBase.VtRedrawFunction(vtBase.cID);
                        vtBase.ChartDisplay.ActiveVisualTools.push({ Key: vtBase.tempVT.vtInfo.vtName, ID: vtBase.tempVT.vtID, Settings: vtBase.tempVT.SettingsValues, Properties: setProperty(vtBase.tempVT.vtID) });
                        vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
                        vtBase.tempVT = null;
                    }

                    break;
                }
            case 'Text':
                {
                    if (vtBase.tempVT === null) {
                        vtBase.tempVT = new WC.VT.Text(vtBase.ChartInstance, GenerateID(), vtBase.cID);
                        vtBase.tempVT.vtProperties.X1 = mdX, vtBase.tempVT.vtProperties.Y1 = mdY;
                        vtBase.tempVT.DatePriceProperties.x1Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y1Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                        if (vtBase.ChartInstance.VisualToolsInput.style.display === "none") {
                            vtBase.ChartInstance.VisualToolsInput.value = "";
                            vtBase.ChartInstance.VisualToolsInput.style.top = mdY + 'px';
                            vtBase.ChartInstance.VisualToolsInput.style.left = mdX + 'px';
                            vtBase.ChartInstance.VisualToolsInput.size = 1;
                            vtBase.ChartInstance.VisualToolsInput.style.display = "block";
                            vtBase.ChartInstance.VisualToolsInput.focus();
                        }
                    } else {
                        if (vtBase.ChartInstance.VisualToolsInput.value !== "") {
                            vtBase.tempVT.SettingsValues.TextInput = vtBase.ChartInstance.VisualToolsInput.value;
                            vtBase.tempVT.AdjustVT();
                            vtBase.tempVT.isSelected = true;
                            vtBase.tempVT.isHovered = true;
                            WC.VT.VisualToolsObjectCollection[vtBase.tempVT.ContainerID].push(vtBase.tempVT);
                            vtBase.vtToCreate = null;
                            vtBase.Selector.css('cursor', vtBase.Cursor);
                            vtBase.SelectedVtObject = vtBase.tempVT;
                            vtBase.setToolbar(true, vtBase.SelectedVtObject.SettingsValues.ForeColor, vtBase.SelectedVtObject.SettingsValues.HighlightColor);

                            isDrawingMode = false;
                            vtBase.VtRedrawFunction(vtBase.cID);
                            vtBase.ChartInstance.VisualToolsInput.style.display = "none";
                            vtBase.ChartInstance.VisualToolsInput.value = "";
                            vtBase.ChartInstance.VisualToolsInput.size = 1;
                            vtBase.ChartDisplay.ActiveVisualTools.push({ Key: vtBase.tempVT.vtInfo.vtName, ID: vtBase.tempVT.vtID, Settings: vtBase.tempVT.SettingsValues, Properties: setProperty(vtBase.tempVT.vtID) });
                            vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
                            vtBase.tempVT = null;
                        } else if (vtBase.ChartInstance.VisualToolsInput.value === "") {
                            vtBase.vtToCreate = null;
                            vtBase.Selector.css('cursor', vtBase.Cursor);
                            vtBase.tempVT = null;
                            isDrawingMode = false;
                            vtBase.ChartInstance.VisualToolsInput.style.display = "none";
                            vtBase.ChartInstance.VisualToolsInput.value = "";
                            vtBase.ChartInstance.VisualToolsInput.size = 1;
                        }
                    }
                    break;
                }
            case "Rectangle":
                if (vtBase.tempVT) {
                    //Setting points for E anchor when second mouse down is fired
                    vtBase.tempVT.vtProp.E.x = mdX;
                    vtBase.tempVT.vtProp.E.y = mdY;
                    //Converting X point to Date and Y point to price
                    vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                    vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                    //Calling for Snapping of Rectangle
                    vtBase.tempVT.AdjustVT();
                    vtBase.tempVT.isSelected = true;
                    vtBase.tempVT.isHovered = true;
                    //Storing Instance on Visual Tool Collection
                    WC.VT.VisualToolsObjectCollection[vtBase.tempVT.ContainerID].push(vtBase.tempVT);

                    vtToCreate = null;
                    vtBase.Selector.css('cursor', vtBase.Cursor);
                    vtBase.SelectedVtObject = vtBase.tempVT;
                    vtBase.setToolbar(true, vtBase.SelectedVtObject.SettingsValues.ForeColor, vtBase.SelectedVtObject.SettingsValues.HighlightColor);

                    isDrawingMode = false;
                    vtBase.VtRedrawFunction(vtBase.cID);
                    vtBase.ChartDisplay.ActiveVisualTools.push({ Key: vtBase.tempVT.vtInfo.vtName, ID: vtBase.tempVT.vtID, Settings: vtBase.tempVT.SettingsValues, Properties: setProperty(vtBase.tempVT.vtID) });
                    vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
                    vtBase.tempVT = null;
                }
                else {
                    //Creating new Instance for Visual Tool
                    vtBase.tempVT = new WC.VT.Rectangle(vtBase.ChartInstance, GenerateID(), vtBase.cID);
                    //Setting X & Y point in first mouse down for anchor A
                    vtBase.tempVT.vtProperties.X1 = mdX;
                    vtBase.tempVT.vtProperties.Y1 = mdY;
                    //Converting X point to Date and Y point to price
                    vtBase.tempVT.DatePriceProperties.x1Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                    vtBase.tempVT.DatePriceProperties.y1Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                    vtBase.VtRedrawFunction(vtBase.cID);
                }
                break;
            case 'FibonacciArc':
                {
                    if (vtBase.tempVT === null) {
                        vtBase.tempVT = new WC.VT.FibonacciArc(vtBase.ChartInstance, GenerateID(), vtBase.cID);
                        vtBase.tempVT.vtProperties.X1 = mdX, vtBase.tempVT.vtProperties.Y1 = mdY;
                        vtBase.tempVT.DatePriceProperties.x1Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y1Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                    } else {
                        vtBase.tempVT.vtProperties.X2 = mdX, vtBase.tempVT.vtProperties.Y2 = mdY;

                        vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;

                        vtBase.tempVT.AdjustVT();
                        vtBase.tempVT.isSelected = true;
                        vtBase.tempVT.isHovered = true;
                        WC.VT.VisualToolsObjectCollection[vtBase.tempVT.ContainerID].push(vtBase.tempVT);
                        vtBase.vtToCreate = null;
                        vtBase.Selector.css('cursor', vtBase.Cursor);
                        vtBase.SelectedVtObject = vtBase.tempVT;
                        vtBase.setToolbar(true, vtBase.SelectedVtObject.SettingsValues.ForeColor, vtBase.SelectedVtObject.SettingsValues.HighlightColor);

                        isDrawingMode = false;
                        vtBase.CanvasCleared = false;
                        vtBase.VtRedrawFunction(vtBase.cID);
                        vtBase.ChartDisplay.ActiveVisualTools.push({ Key: vtBase.tempVT.vtInfo.vtName, ID: vtBase.tempVT.vtID, Settings: vtBase.tempVT.SettingsValues, Properties: setProperty(vtBase.tempVT.vtID) });
                        vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
                        vtBase.tempVT = null;
                    }
                    event = null;
                    break;
                }
            case 'FibonacciFan':
                {
                    if (vtBase.tempVT === null) {
                        vtBase.tempVT = new WC.VT.FibonacciFan(vtBase.ChartInstance, GenerateID(), vtBase.cID);
                        vtBase.tempVT.vtProperties.X1 = mdX, vtBase.tempVT.vtProperties.Y1 = mdY;
                        vtBase.tempVT.DatePriceProperties.x1Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y1Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                    } else {
                        vtBase.tempVT.vtProperties.X2 = mdX, vtBase.tempVT.vtProperties.Y2 = mdY;

                        vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;

                        vtBase.tempVT.AdjustVT();
                        vtBase.tempVT.isSelected = true;
                        vtBase.tempVT.isHovered = true;
                        WC.VT.VisualToolsObjectCollection[vtBase.tempVT.ContainerID].push(vtBase.tempVT);
                        vtBase.vtToCreate = null;
                        vtBase.Selector.css('cursor', vtBase.Cursor);
                        vtBase.SelectedVtObject = vtBase.tempVT;
                        vtBase.setToolbar(true, vtBase.SelectedVtObject.SettingsValues.ForeColor, vtBase.SelectedVtObject.SettingsValues.HighlightColor);

                        isDrawingMode = false;
                        vtBase.CanvasCleared = false;
                        vtBase.VtRedrawFunction(vtBase.cID);
                        vtBase.ChartDisplay.ActiveVisualTools.push({ Key: vtBase.tempVT.vtInfo.vtName, ID: vtBase.tempVT.vtID, Settings: vtBase.tempVT.SettingsValues, Properties: setProperty(vtBase.tempVT.vtID) });
                        vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
                        vtBase.tempVT = null;
                        vtBase.hoverNum = 0;
                    }
                    event = null;
                    break;
                }
            case 'GannLine':
                {
                    if (vtBase.tempVT === null) {
                        vtBase.tempVT = new WC.VT.GannLine(vtBase.ChartInstance, GenerateID(), vtBase.cID);
                        vtBase.tempVT.vtProperties.X1 = mdX, vtBase.tempVT.vtProperties.Y1 = mdY;
                        vtBase.tempVT.DatePriceProperties.x1Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y1Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                    } else {
                        vtBase.tempVT.vtProperties.X2 = mdX, vtBase.tempVT.vtProperties.Y2 = mdY;
                        vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                        vtBase.tempVT.AdjustVT();
                        vtBase.tempVT.isSelected = true;
                        vtBase.tempVT.isHovered = true;
                        WC.VT.VisualToolsObjectCollection[vtBase.tempVT.ContainerID].push(vtBase.tempVT);
                        vtBase.vtToCreate = null;
                        vtBase.Selector.css('cursor', vtBase.Cursor);
                        vtBase.SelectedVtObject = vtBase.tempVT;
                        vtBase.setToolbar(true, vtBase.SelectedVtObject.SettingsValues.ForeColor, vtBase.SelectedVtObject.SettingsValues.HighlightColor);

                        isDrawingMode = false;
                        vtBase.CanvasCleared = false;
                        vtBase.VtRedrawFunction(vtBase.cID);
                        vtBase.ChartDisplay.ActiveVisualTools.push({ Key: vtBase.tempVT.vtInfo.vtName, ID: vtBase.tempVT.vtID, Settings: vtBase.tempVT.SettingsValues, Properties: setProperty(vtBase.tempVT.vtID) });
                        vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
                        vtBase.tempVT = null;
                        vtBase.hoverNum = null;
                    }
                    event = null;
                    break;
                }
            case 'ForexChannel':
                {
                    if (vtBase.tempVT === null) {
                        vtBase.tempVT = new WC.VT.ForexChannel(vtBase.ChartInstance, GenerateID(), vtBase.cID);
                        vtBase.tempVT.vtProperties.X1 = mdX, vtBase.tempVT.vtProperties.Y1 = mdY;
                        vtBase.tempVT.DatePriceProperties.x1Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y1Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                    } else {

                        vtBase.tempVT.vtProperties.X2 = mdX, vtBase.tempVT.vtProperties.Y2 = mdY;
                        vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                        if (vtBase.tempVT.vtProperties.X1 !== null && vtBase.tempVT.vtProperties.X2 !== null) {
                            vtBase.tempVT.vtProperties.Y3 = -(mdY - tempY) + vtBase.tempVT.vtProperties.Y2 + 20;
                            vtBase.tempVT.vtProperties.Y4 = -(mdY - tempY) + vtBase.tempVT.vtProperties.Y1 + 20;
                            vtBase.tempVT.vtProperties.X3 = vtBase.tempVT.vtProperties.X2;
                            vtBase.tempVT.vtProperties.X4 = vtBase.tempVT.vtProperties.X1;
                            vtBase.tempVT.DatePriceProperties.x3Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(vtBase.tempVT.vtProperties.X2, vtBase.tempVT.vtProperties.Y3).Bar.Stamp());
                            vtBase.tempVT.DatePriceProperties.y3Price = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.tempVT.vtProperties.X2, vtBase.tempVT.vtProperties.Y3).Price;
                            vtBase.tempVT.DatePriceProperties.x4Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(vtBase.tempVT.vtProperties.X4, vtBase.tempVT.vtProperties.Y4).Bar.Stamp());
                            vtBase.tempVT.DatePriceProperties.y4Price = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.tempVT.vtProperties.X4, vtBase.tempVT.vtProperties.Y4).Price;
                            vtBase.tempVT.AdjustVT();
                            vtBase.tempVT.isSelected = true;
                            vtBase.tempVT.isHovered = true;
                            WC.VT.VisualToolsObjectCollection[vtBase.tempVT.ContainerID].push(vtBase.tempVT);
                            vtToCreate = null;
                            vtBase.Selector.css('cursor', vtBase.Cursor);
                            vtBase.SelectedVtObject = vtBase.tempVT;
                            vtBase.setToolbar(true, vtBase.SelectedVtObject.SettingsValues.ForeColor, vtBase.SelectedVtObject.SettingsValues.HighlightColor);

                            isDrawingMode = false;
                            vtBase.CanvasCleared = false;
                            vtBase.VtRedrawFunction(vtBase.cID);
                            vtBase.ChartDisplay.ActiveVisualTools.push({ Key: vtBase.tempVT.vtInfo.vtName, ID: vtBase.tempVT.vtID, Settings: vtBase.tempVT.SettingsValues, Properties: setProperty(vtBase.tempVT.vtID) });
                            vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
                            vtBase.tempVT = null;
                            vtBase.hoverNum = null;
                        }

                    }
                    event = null;
                    break;
                }
            case 'GannFan':
                {
                    if (vtBase.tempVT === null) {
                        vtBase.tempVT = new WC.VT.GannFan(vtBase.ChartInstance, GenerateID(), vtBase.cID);
                        vtBase.tempVT.vtProperties.X1 = mdX, vtBase.tempVT.vtProperties.Y1 = mdY;
                        vtBase.tempVT.DatePriceProperties.x1Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y1Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                    } else {
                        vtBase.tempVT.vtProperties.X2 = mdX, vtBase.tempVT.vtProperties.Y2 = mdY;
                        vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
                        vtBase.tempVT.AdjustVT();
                        vtBase.tempVT.isSelected = true;
                        vtBase.tempVT.isHovered = true;
                        WC.VT.VisualToolsObjectCollection[vtBase.tempVT.ContainerID].push(vtBase.tempVT);
                        vtBase.vtToCreate = null;
                        vtBase.Selector.css('cursor', vtBase.Cursor);
                        vtBase.SelectedVtObject = vtBase.tempVT;
                        vtBase.setToolbar(true, vtBase.SelectedVtObject.SettingsValues.ForeColor, vtBase.SelectedVtObject.SettingsValues.HighlightColor);

                        isDrawingMode = false;
                        vtBase.CanvasCleared = false;
                        vtBase.VtRedrawFunction(vtBase.cID);
                        vtBase.ChartDisplay.ActiveVisualTools.push({ Key: vtBase.tempVT.vtInfo.vtName, ID: vtBase.tempVT.vtID, Settings: vtBase.tempVT.SettingsValues, Properties: setProperty(vtBase.tempVT.vtID) });
                        vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
                        vtBase.tempVT = null;
                        vtBase.hoverNum = null;
                    }
                    event = null;
                    break;
                }


        }
    }

    var setElliot = function () {
        if (vtBase.tempVT.vtProperties.X1 === null && vtBase.tempVT.vtProperties.X2 === null && vtBase.tempVT.vtProperties.X3 === null && vtBase.tempVT.vtProperties.X4 === null && vtBase.tempVT.vtProperties.X5 === null && vtBase.tempVT.vtProperties.X6 === null && vtBase.tempVT.vtProperties.X7 === null) {
            vtBase.tempVT.vtProperties.X1 = mdX, vtBase.tempVT.vtProperties.Y1 = mdY;
            vtBase.tempVT.DatePriceProperties.x1Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
            vtBase.tempVT.DatePriceProperties.y1Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
        }
        else if (vtBase.tempVT.vtProperties.X1 !== null && vtBase.tempVT.vtProperties.X2 === null && vtBase.tempVT.vtProperties.X3 === null && vtBase.tempVT.vtProperties.X4 === null && vtBase.tempVT.vtProperties.X5 === null && vtBase.tempVT.vtProperties.X6 === null && vtBase.tempVT.vtProperties.X7 === null) {
            vtBase.tempVT.vtProperties.X2 = mdX, vtBase.tempVT.vtProperties.Y2 = mdY;
            vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
            vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
        } else if (vtBase.tempVT.vtProperties.X1 !== null && vtBase.tempVT.vtProperties.X2 !== null && vtBase.tempVT.vtProperties.X3 === null && vtBase.tempVT.vtProperties.X4 == null && vtBase.tempVT.vtProperties.X5 === null && vtBase.tempVT.vtProperties.X6 === null && vtBase.tempVT.vtProperties.X7 === null) {
            vtBase.tempVT.vtProperties.X3 = mdX, vtBase.tempVT.vtProperties.Y3 = mdY;
            vtBase.tempVT.DatePriceProperties.x3Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
            vtBase.tempVT.DatePriceProperties.y3Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
        } else if (vtBase.tempVT.vtProperties.X1 !== null && vtBase.tempVT.vtProperties.X2 !== null && vtBase.tempVT.vtProperties.X3 !== null && vtBase.tempVT.vtProperties.X4 == null && vtBase.tempVT.vtProperties.X5 === null && vtBase.tempVT.vtProperties.X6 === null && vtBase.tempVT.vtProperties.X7 === null) {
            vtBase.tempVT.vtProperties.X4 = mdX, vtBase.tempVT.vtProperties.Y4 = mdY;
            vtBase.tempVT.DatePriceProperties.x4Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
            vtBase.tempVT.DatePriceProperties.y4Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
        } else if (vtBase.tempVT.vtProperties.X1 !== null && vtBase.tempVT.vtProperties.X2 !== null && vtBase.tempVT.vtProperties.X3 !== null && vtBase.tempVT.vtProperties.X4 != null && vtBase.tempVT.vtProperties.X5 === null && vtBase.tempVT.vtProperties.X6 === null && vtBase.tempVT.vtProperties.X7 === null) {
            vtBase.tempVT.vtProperties.X5 = mdX, vtBase.tempVT.vtProperties.Y5 = mdY;
            vtBase.tempVT.DatePriceProperties.x5Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
            vtBase.tempVT.DatePriceProperties.y5Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
        } else if (vtBase.tempVT.vtProperties.X1 !== null && vtBase.tempVT.vtProperties.X2 !== null && vtBase.tempVT.vtProperties.X3 !== null && vtBase.tempVT.vtProperties.X4 != null && vtBase.tempVT.vtProperties.X5 !== null && vtBase.tempVT.vtProperties.X6 === null && vtBase.tempVT.vtProperties.X7 === null) {
            vtBase.tempVT.vtProperties.X6 = mdX, vtBase.tempVT.vtProperties.Y6 = mdY;
            vtBase.tempVT.DatePriceProperties.x6Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
            vtBase.tempVT.DatePriceProperties.y6Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
        } else if (vtBase.tempVT.vtProperties.X1 !== null && vtBase.tempVT.vtProperties.X2 !== null && vtBase.tempVT.vtProperties.X3 !== null && vtBase.tempVT.vtProperties.X4 != null && vtBase.tempVT.vtProperties.X5 !== null && vtBase.tempVT.vtProperties.X6 !== null && vtBase.tempVT.vtProperties.X7 === null) {
            vtBase.tempVT.vtProperties.X7 = mdX, vtBase.tempVT.vtProperties.Y7 = mdY;
            vtBase.tempVT.DatePriceProperties.x7Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
            vtBase.tempVT.DatePriceProperties.y7Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
        } else {
            vtBase.tempVT.vtProperties.X8 = mdX, vtBase.tempVT.vtProperties.Y8 = mdY;
            vtBase.tempVT.DatePriceProperties.x8Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Bar.Stamp());
            vtBase.tempVT.DatePriceProperties.y8Price = vtBase.ChartInstance.GetMouseObjectInfo(mdX, mdY).Price;
            vtBase.tempVT.AdjustVT();
            vtBase.tempVT.isSelected = true;
            vtBase.tempVT.isHovered = true;
            WC.VT.VisualToolsObjectCollection[vtBase.tempVT.ContainerID].push(vtBase.tempVT);
            vtToCreate = null;
            vtBase.Selector.css('cursor', vtBase.Cursor);

            isDrawingMode = false;
            vtBase.CanvasCleared = false;
            vtBase.VtRedrawFunction(vtBase.cID);
            vtBase.ChartDisplay.ActiveVisualTools.push({ Key: vtBase.tempVT.vtInfo.vtName, ID: vtBase.tempVT.vtID, Settings: vtBase.tempVT.SettingsValues, Properties: setProperty(vtBase.tempVT.vtID) });
            vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
            vtBase.tempVT = null;
            vtBase.hoverNum = null;
        }
    };

    function hexToRGBA(color, opacity) {
        var strHex = color.replace(/'/g, '"');
        var hex = (strHex.charAt(0) === "#" ? strHex.substring(1) : strHex);
        var r = parseInt(hex.substring(0, 2), 16);
        var g = parseInt(hex.substring(2, 4), 16);
        var b = parseInt(hex.substring(4, 6), 16);

        var rgba = 'rgba(' + r + ',' + g + ',' + b + ',' + opacity + ')';

        return rgba;
    }

    function endpointOverlapping(X, Y, rad, xTC, yTC) {
        var dx = xTC - X,
			dy = yTC - Y,
			d = Math.sqrt(dx * dx + dy * dy);

        if (d <= rad) {
            return true;
        } else {
            return false;
        }
    }

    function endpointHovering(x1, y1, x2, y2, rad, tcX, tcY) {
        var ret = 0;
        var dx1 = tcX - x1;
        var dy1 = tcY - y1;
        var dx2 = tcX - x2;
        var dy2 = tcY - y2;
        var d1 = Math.sqrt(dx1 * dx1 + dy1 * dy1);
        var d2 = Math.sqrt(dx2 * dx2 + dy2 * dy2);

        if (d1 < rad) {
            ret = 1;
        }
        if (d2 < rad) {
            ret = 2;
        }

        return ret;
    }

    function singlePointHovering(x, y, rad, tcX, tcY) {
        var ret = null;
        var dx = tcX - x;
        var dy = tcY - y;
        var d = Math.sqrt(dx * dx + dy * dy);
        if (d < rad) {
            ret = 0;
        }

        return ret;
    }

    function PitchforkEndpointHovering(x1, y1, x2, y2, x3, y3, rad, tcX, tcY) {
        var ret = 0;
        var dx1 = tcX - x1;
        var dy1 = tcY - y1;
        var dx2 = tcX - x2;
        var dy2 = tcY - y2;
        var dx3 = tcX - x3;
        var dy3 = tcY - y3;
        var d1 = Math.sqrt(dx1 * dx1 + dy1 * dy1);
        var d2 = Math.sqrt(dx2 * dx2 + dy2 * dy2);
        var d3 = Math.sqrt(dx3 * dx3 + dy3 * dy3);
        if (d1 < rad) {
            ret = 1;
        }
        if (d2 < rad) {
            ret = 2;
        }
        if (d3 < rad) {
            ret = 3;
        }

        return ret;
    }

    function ABCDendpointHovering(x1, y1, x2, y2, x3, y3, x4, y4, rad, tcX, tcY) {
        var ret = 0;
        var dx1 = tcX - x1;
        var dy1 = tcY - y1;
        var dx2 = tcX - x2;
        var dy2 = tcY - y2;
        var dx3 = tcX - x3;
        var dy3 = tcY - y3;
        var dx4 = tcX - x4;
        var dy4 = tcY - y4;
        var d1 = Math.sqrt(dx1 * dx1 + dy1 * dy1);
        var d2 = Math.sqrt(dx2 * dx2 + dy2 * dy2);
        var d3 = Math.sqrt(dx3 * dx3 + dy3 * dy3);
        var d4 = Math.sqrt(dx4 * dx4 + dy4 * dy4);

        if (d1 < rad) {
            ret = 1;
        }
        if (d2 < rad) {
            ret = 2;
        }

        if (d3 < rad) {
            ret = 3;
        }

        if (d4 < rad) {
            ret = 4;
        }

        return ret;
    }

    function XABCDendpointHovering(x1, y1, x2, y2, x3, y3, x4, y4, x5, y5, rad, tcX, tcY) {

        var ret = 0;
        var dx1 = tcX - x1;
        var dy1 = tcY - y1;
        var dx2 = tcX - x2;
        var dy2 = tcY - y2;
        var dx3 = tcX - x3;
        var dy3 = tcY - y3;
        var dx4 = tcX - x4;
        var dy4 = tcY - y4;
        var dx5 = tcX - x5;
        var dy5 = tcY - y5;
        var d1 = Math.sqrt(dx1 * dx1 + dy1 * dy1);
        var d2 = Math.sqrt(dx2 * dx2 + dy2 * dy2);
        var d3 = Math.sqrt(dx3 * dx3 + dy3 * dy3);
        var d4 = Math.sqrt(dx4 * dx4 + dy4 * dy4);
        var d5 = Math.sqrt(dx5 * dx5 + dy5 * dy5);

        if (inTriangle(x1, y1, x2, y2, x3, y3, tcX, tcY) == true) {
            ret = 0;
        }
        if (d1 < rad) {
            ret = 1;
        }
        if (d2 < rad) {
            ret = 2;
        }

        if (d3 < rad) {
            ret = 3;
        }

        if (d4 < rad) {
            ret = 4;
        }

        if (d5 < rad) {
            ret = 5;
        }

        return ret;
    }

    function ThreeDriversEndpointHovering(x1, y1, x2, y2, x3, y3, x4, y4, x5, y5, x6, y6, x7, y7, rad, tcX, tcY) {
        var ret = 0;
        var dx1 = tcX - x1;
        var dy1 = tcY - y1;
        var dx2 = tcX - x2;
        var dy2 = tcY - y2;
        var dx3 = tcX - x3;
        var dy3 = tcY - y3;
        var dx4 = tcX - x4;
        var dy4 = tcY - y4;
        var dx5 = tcX - x5;
        var dy5 = tcY - y5;
        var dx6 = tcX - x6;
        var dy6 = tcY - y6;
        var dx7 = tcX - x7;
        var dy7 = tcY - y7;
        var d1 = Math.sqrt(dx1 * dx1 + dy1 * dy1);
        var d2 = Math.sqrt(dx2 * dx2 + dy2 * dy2);
        var d3 = Math.sqrt(dx3 * dx3 + dy3 * dy3);
        var d4 = Math.sqrt(dx4 * dx4 + dy4 * dy4);
        var d5 = Math.sqrt(dx5 * dx5 + dy5 * dy5);
        var d6 = Math.sqrt(dx6 * dx6 + dy6 * dy6);
        var d7 = Math.sqrt(dx7 * dx7 + dy7 * dy7);
        if (d1 < rad) {
            ret = 1;
        }
        if (d2 < rad) {
            ret = 2;
        }

        if (d3 < rad) {
            ret = 3;
        }

        if (d4 < rad) {
            ret = 4;
        }

        if (d5 < rad) {
            ret = 5;
        }

        if (d6 < rad) {
            ret = 6;
        }

        if (d7 < rad) {
            ret = 7;
        }

        return ret;
    }

    function EightPointsEndpointHovering(x1, y1, x2, y2, x3, y3, x4, y4, x5, y5, x6, y6, x7, y7, x8, y8, rad, tcX, tcY) {
        var ret = 0;
        var dx1 = tcX - x1;
        var dy1 = tcY - y1;
        var dx2 = tcX - x2;
        var dy2 = tcY - y2;
        var dx3 = tcX - x3;
        var dy3 = tcY - y3;
        var dx4 = tcX - x4;
        var dy4 = tcY - y4;
        var dx5 = tcX - x5;
        var dy5 = tcY - y5;
        var dx6 = tcX - x6;
        var dy6 = tcY - y6;
        var dx7 = tcX - x7;
        var dy7 = tcY - y7;
        var dx8 = tcX - x8;
        var dy8 = tcY - y8;
        var d1 = Math.sqrt(dx1 * dx1 + dy1 * dy1);
        var d2 = Math.sqrt(dx2 * dx2 + dy2 * dy2);
        var d3 = Math.sqrt(dx3 * dx3 + dy3 * dy3);
        var d4 = Math.sqrt(dx4 * dx4 + dy4 * dy4);
        var d5 = Math.sqrt(dx5 * dx5 + dy5 * dy5);
        var d6 = Math.sqrt(dx6 * dx6 + dy6 * dy6);
        var d7 = Math.sqrt(dx7 * dx7 + dy7 * dy7);
        var d8 = Math.sqrt(dx8 * dx8 + dy8 * dy8);
        if (d1 < rad) {
            ret = 1;
        }
        if (d2 < rad) {
            ret = 2;
        }

        if (d3 < rad) {
            ret = 3;
        }

        if (d4 < rad) {
            ret = 4;
        }

        if (d5 < rad) {
            ret = 5;
        }

        if (d6 < rad) {
            ret = 6;
        }

        if (d7 < rad) {
            ret = 7;
        }

        if (d8 < rad) {
            ret = 8;
        }

        return ret;
    }

    function parallelPointHovering(x1, y1, x2, y2, x3, y3, x4, y4, rad, tcX, tcY) {
        var ret = 0;
        var dx1 = tcX - x1;
        var dy1 = tcY - y1;
        var dx2 = tcX - x2;
        var dy2 = tcY - y2;
        var dx3 = tcX - x3;
        var dy3 = tcY - y3;
        var dx4 = tcX - x4;
        var dy4 = tcY - y4;
        var midx3 = (dx3 + dx4) / 2;
        var midy3 = (dy3 + dy4) / 2;
        var d1 = Math.sqrt(dx1 * dx1 + dy1 * dy1);
        var d2 = Math.sqrt(dx2 * dx2 + dy2 * dy2);
        var d3 = Math.sqrt(midx3 * midx3 + midy3 * midy3);

        if (d1 < rad) {
            ret = 1;
        }
        if (d2 < rad) {
            ret = 2;
        }

        if (d3 < rad) {
            ret = 3;
        }

        return ret;

    }

    function oneendPointHovering(x1, y1, x2, y2, rad, tcX, tcY) {
        var ret = 0;
        var dx2 = tcX - x2;
        var dy2 = tcY - y2;
        var d2 = Math.sqrt(dx2 * dx2 + dy2 * dy2);

        if (d2 < rad) {
            ret = 1;
        }

        return ret;
    }

    function polygonAnchorPointHovering(x, y, rad, tcX, tcY) {
        var dx = tcX - x;
        var dy = tcY - y;
        var d = Math.sqrt(dx * dx + dy * dy);

        if (d < rad) {
            return true;
        } else {
            return false;
        }
    }

    function ArcEndpointHovering(x1, y1, x3, y3, x4, y4, rad, tcX, tcY) {
        var ret = 0;
        var dx1 = tcX - x1;
        var dy1 = tcY - y1;
        var dx3 = tcX - x3;
        var dy3 = tcY - y3;
        var dx4 = tcX - x4;
        var dy4 = tcY - y4;
        var d1 = Math.sqrt(dx1 * dx1 + dy1 * dy1);
        var d3 = Math.sqrt(dx3 * dx3 + dy3 * dy3);
        var d4 = Math.sqrt(dx4 * dx4 + dy4 * dy4);

        if (d1 < rad) {
            ret = 1;
        }
        if (d3 < rad) {
            ret = 3;
        }
        if (d4 < rad) {
            ret = 4;
        }
        return ret;
    }

    function HighlightLine(contID) {
        var count = WC.VT.VisualToolsObjectCollection[contID].length;
        var obj, obj1;
        if (count !== 0) {
            for (var i = 0; i < count; i++) {
                obj = WC.VT.VisualToolsObjectCollection[contID][i];
                switch (obj.BaseType) {
                    case "Line":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X1, obj.vtProperties.Y1, tempX, tempY, 5)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;

                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);


                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                switch (endpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    vtBase.SelectedVtObject = obj;
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "BarsPattern":
                        {
                            vtBase.SelectedVtObject = obj;
                            var YPoint2 = vtBase.ChartInstance.GetYaxis(vtBase.SelectedVtObject.BarsCollection[0].Low + vtBase.SelectedVtObject.AllowancePips);
                            var YPoint1 = vtBase.ChartInstance.GetYaxis(vtBase.SelectedVtObject.BarsCollection[vtBase.SelectedVtObject.BarsCollection.length - 1].High + vtBase.SelectedVtObject.AllowancePips);
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, YPoint1, obj.vtProperties.X1, YPoint1, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, YPoint2, obj.vtProperties.X2, YPoint2, tempX, tempY, 5) || CheckBarsPatternHovered(vtBase.SelectedVtObject, tempX, tempY)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);

                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, YPoint1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, YPoint2, 5, obj.ContainerID);
                                switch (endpointHovering(obj.vtProperties.X1, YPoint1, obj.vtProperties.X2, YPoint2, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {

                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {

                                    vtBase.SelectedVtObject = obj;
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.VtRedrawFunction(contID);
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X1, YPoint1, 5, obj.ContainerID);
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X2, YPoint2, 5, obj.ContainerID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }


                        }
                        break;
                    case "Polygon":
                        {
                            if (inPolygon(Math.min(obj.vtProp.A.x, obj.vtProp.E.x), Math.min(obj.vtProp.A.y, obj.vtProp.E.y), Math.max(obj.vtProp.A.x, obj.vtProp.E.x), Math.max(obj.vtProp.A.y, obj.vtProp.E.y), tempX, tempY, 5)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;

                                        }
                                    }
                                }
                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                vtBase.Selector.css('cursor', 'move');
                                for (var i in obj.vtProp) {
                                    var prop = obj.vtProp[i];
                                    if (polygonAnchorPointHovering(prop.x, prop.y, 5, tempX, tempY)) {
                                        switch (i) {

                                            case "B":
                                                vtBase.Selector.css('cursor', 'n-resize');
                                                break;

                                            case "D":
                                                vtBase.Selector.css('cursor', 'e-resize');
                                                break;

                                            case "F":
                                                vtBase.Selector.css('cursor', 'n-resize');
                                                break;

                                            case "H":
                                                vtBase.Selector.css('cursor', 'e-resize');
                                                break;
                                            default:
                                                if (obj.vtProp["A"].x > obj.vtProp["E"].x || obj.vtProp["A"].y > obj.vtProp["E"].y) {
                                                    if (i === "A" || i === "E") {
                                                        if ((obj.vtProp["A"].x > obj.vtProp["E"].x && obj.vtProp["A"].y < obj.vtProp["E"].y) || (obj.vtProp["A"].x < obj.vtProp["E"].x && obj.vtProp["A"].y > obj.vtProp["E"].y)) {
                                                            vtBase.Selector.css('cursor', 'ne-resize');
                                                        }
                                                        else {
                                                            vtBase.Selector.css('cursor', 'nw-resize');
                                                        }
                                                    } else {
                                                        if (obj.vtProp["A"].x > obj.vtProp["E"].x && obj.vtProp["A"].y > obj.vtProp["E"].y) {
                                                            vtBase.Selector.css('cursor', 'ne-resize');
                                                        } else {
                                                            vtBase.Selector.css('cursor', 'nw-resize');
                                                        }
                                                    }
                                                } else {

                                                    if (i === "A" || i === "E") {
                                                        vtBase.Selector.css('cursor', 'nw-resize');

                                                    } else {
                                                        vtBase.Selector.css('cursor', 'ne-resize');
                                                    }
                                                }
                                                break;
                                        }
                                    }

                                }
                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.hoverAnchor = null;
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                            break;
                        }
                    case "Text":
                        {
                            if (inText(obj.vtProperties.X1, obj.vtProperties.Y1, tempX, tempY, 5, obj.SettingsValues.FontSize, obj.TextWidth)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;

                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                }
                                else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);
                            }
                            break;
                        }
                    case "Balloon":
                        {
                            if (inText(obj.X1, obj.Y1, tempX, tempY, 5, obj.TextHeight, obj.TextWidth) || singlePointHovering(obj.HandlePointX, obj.HandlePointY, 3, tempX, tempY) == 0) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                vtBase.Selector.css('cursor', 'pointer');
                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                }
                                else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);
                            }
                            break;
                        }
                    case "Callout": // on mouse move
                        if (inText(obj.PolygonX, obj.PolygonY, tempX, tempY, 1, obj.PolygonHeight, obj.PolygonWidth) || singlePointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, 3, tempX, tempY) == 0) {
                            if (count > 0) {
                                for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                    if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                        WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                        WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;

                                    }
                                }
                            }

                            obj.isHovered = true;
                            vtBase.setToTrue = true;
                            vtBase.HoveringVT = obj.vtID;
                            vtBase.SelectedVtObject = obj;
                            vtBase.SelectedVT = obj.vtID;
                            vtBase.VtRedrawFunction(contID);
                            obj.DrawVT();
                            vtBase.Selector.css('cursor', 'pointer');
                        } else {
                            if (!obj.isSelected) {
                                obj.isHovered = false;
                                obj.isSelected = false;
                                vtBase.VtRedrawFunction(contID);
                                vtBase.setToTrue = false;
                                vtBase.HoveringVT = null;
                                if (vtBase.SelectedVtObject !== null) {
                                    if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                        vtBase.SelectedVtObject = null;
                                    }
                                } else {
                                    vtBase.SelectedVtObject = null;
                                }
                                vtBase.SelectedVT = null;
                                vtBase.hoverNum = 0;
                            }
                            else {
                                obj.isHovered = false;
                                obj.isSelected = true;
                                vtBase.SelectedVtObject = obj;
                                vtBase.VtRedrawFunction(contID);
                            }
                            vtBase.Selector.css('cursor', vtBase.Cursor);
                        }
                        break;
                    case "4-Point":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;

                                        }
                                    }
                                }
                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X3, obj.vtProperties.Y3, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X4, obj.vtProperties.Y4, 5, obj.ContainerID);
                                switch (ABCDendpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 4:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }


                                vtBase.Selector.css('cursor', vtBase.Cursor);


                            }
                        }
                        break;
                    case "Pitchfork":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.ExtendedX1, obj.ExtendedY1, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.ExtendedX2, obj.ExtendedY2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.ExtendedX3, obj.ExtendedY3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.X3, obj.Y3, tempX, tempY, 5)) {

                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;

                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                switch (PitchforkEndpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, 8, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "Parallel":
                        {
                            if (obj.SettingsValues.ExtendToInfinity === "True") {
                                if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) || isMouseOverLineInfinity(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5, contID) || isMouseOverLineInfinity(obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5, contID)) {
                                    if (count > 0) {
                                        for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                            if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;

                                            }
                                        }
                                    }
                                    obj.isHovered = true;
                                    vtBase.setToTrue = true;
                                    vtBase.HoveringVT = obj.vtID;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.SelectedVT = obj.vtID;
                                    vtBase.VtRedrawFunction(contID);
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                    WC.VT.drawCircleEndpoint((obj.vtProperties.X3 + obj.vtProperties.X4) / 2, (obj.vtProperties.Y3 + obj.vtProperties.Y4) / 2, 5, obj.ContainerID);
                                    obj.DrawVT();
                                    switch (parallelPointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, 5, tempX, tempY)) {
                                        case 0:
                                            vtBase.Selector.css('cursor', 'move');
                                            break;
                                        case 1:
                                            vtBase.Selector.css('cursor', 'pointer');
                                            break;
                                        case 2:
                                            vtBase.Selector.css('cursor', 'pointer');
                                            break;
                                        case 3:
                                            vtBase.Selector.css('cursor', 'n-resize');
                                            break;
                                    }
                                    return;

                                }
                                else {
                                    if (!obj.isSelected) {
                                        obj.isHovered = false;
                                        obj.isSelected = false;
                                        vtBase.VtRedrawFunction(contID);
                                        vtBase.setToTrue = false;
                                        vtBase.HoveringVT = null;
                                        if (vtBase.SelectedVtObject !== null) {
                                            if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                                vtBase.SelectedVtObject = null;
                                            }
                                        } else {
                                            vtBase.SelectedVtObject = null;
                                        }
                                        vtBase.SelectedVT = null;
                                        vtBase.hoverNum = 0;
                                    } else {
                                        obj.isHovered = false;
                                        obj.isSelected = true;
                                        vtBase.SelectedVtObject = obj;
                                        vtBase.VtRedrawFunction(contID);
                                    }


                                    vtBase.Selector.css('cursor', vtBase.Cursor);


                                }
                            }
                            else {
                                if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5)) {
                                    if (count > 0) {
                                        for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                            if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;

                                            }
                                        }
                                    }
                                    obj.isHovered = true;
                                    vtBase.setToTrue = true;
                                    vtBase.HoveringVT = obj.vtID;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.SelectedVT = obj.vtID;
                                    vtBase.VtRedrawFunction(contID);
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                    WC.VT.drawCircleEndpoint((obj.vtProperties.X3 + obj.vtProperties.X4) / 2, (obj.vtProperties.Y3 + obj.vtProperties.Y4) / 2, 5, obj.ContainerID);
                                    obj.DrawVT();
                                    switch (parallelPointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, 5, tempX, tempY)) {
                                        case 0:
                                            vtBase.Selector.css('cursor', 'move');
                                            break;
                                        case 1:
                                            vtBase.Selector.css('cursor', 'pointer');
                                            break;
                                        case 2:
                                            vtBase.Selector.css('cursor', 'pointer');
                                            break;
                                        case 3:
                                            vtBase.Selector.css('cursor', 'n-resize');
                                            break;
                                    }
                                    return;

                                }
                                else {
                                    if (!obj.isSelected) {
                                        obj.isHovered = false;
                                        obj.isSelected = false;
                                        vtBase.VtRedrawFunction(contID);
                                        vtBase.setToTrue = false;
                                        vtBase.HoveringVT = null;
                                        if (vtBase.SelectedVtObject !== null) {
                                            if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                                vtBase.SelectedVtObject = null;
                                            }
                                        } else {
                                            vtBase.SelectedVtObject = null;
                                        }
                                        vtBase.SelectedVT = null;
                                        vtBase.hoverNum = 0;
                                    } else {
                                        obj.isHovered = false;
                                        obj.isSelected = true;
                                        vtBase.SelectedVtObject = obj;
                                        vtBase.VtRedrawFunction(contID);
                                    }



                                    vtBase.Selector.css('cursor', vtBase.Cursor);

                                }
                            }
                        }
                        break;
                    case "GannLine":
                        {
                            if (obj.SettingsValues.ExtendToInfinity === "True") {
                                if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || isMouseOverLineInfinity(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5, contID)) {

                                    if (count > 0) {
                                        for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                            if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;

                                            }
                                        }
                                    }

                                    obj.isHovered = true;
                                    vtBase.setToTrue = true;
                                    vtBase.HoveringVT = obj.vtID;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.SelectedVT = obj.vtID;
                                    vtBase.VtRedrawFunction(contID);
                                    obj.DrawVT();

                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                    switch (oneendPointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, 5, tempX, tempY)) {
                                        case 0:
                                            vtBase.Selector.css('cursor', 'move');
                                            break;
                                        case 1:
                                            vtBase.Selector.css('cursor', 'pointer');
                                            break;
                                    }
                                    return;

                                } else {
                                    if (!obj.isSelected) {
                                        obj.isHovered = false;
                                        obj.isSelected = false;
                                        vtBase.VtRedrawFunction(contID);
                                        vtBase.setToTrue = false;
                                        vtBase.HoveringVT = null;
                                        if (vtBase.SelectedVtObject !== null) {
                                            if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                                vtBase.SelectedVtObject = null;
                                            }
                                        } else {
                                            vtBase.SelectedVtObject = null;
                                        }
                                        vtBase.SelectedVT = null;
                                        vtBase.hoverNum = 0;
                                    } else {
                                        obj.isHovered = false;
                                        obj.isSelected = true;
                                        vtBase.SelectedVtObject = obj;
                                        vtBase.VtRedrawFunction(contID);
                                    }
                                    vtBase.Selector.css('cursor', vtBase.Cursor);

                                }
                            }
                            else {
                                if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5)) {

                                    if (count > 0) {
                                        for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                            if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;

                                            }
                                        }
                                    }

                                    obj.isHovered = true;
                                    vtBase.setToTrue = true;
                                    vtBase.HoveringVT = obj.vtID;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.SelectedVT = obj.vtID;
                                    vtBase.VtRedrawFunction(contID);
                                    obj.DrawVT();

                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                    switch (oneendPointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, 5, tempX, tempY)) {
                                        case 0:
                                            vtBase.Selector.css('cursor', 'move');
                                            break;
                                        case 1:
                                            vtBase.Selector.css('cursor', 'pointer');
                                            break;
                                    }
                                    return;

                                } else {
                                    if (!obj.isSelected) {
                                        obj.isHovered = false;
                                        obj.isSelected = false;
                                        vtBase.VtRedrawFunction(contID);
                                        vtBase.setToTrue = false;
                                        vtBase.HoveringVT = null;
                                        if (vtBase.SelectedVtObject !== null) {
                                            if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                                vtBase.SelectedVtObject = null;
                                            }
                                        } else {
                                            vtBase.SelectedVtObject = null;
                                        }
                                        vtBase.SelectedVT = null;
                                        vtBase.hoverNum = 0;
                                    } else {
                                        obj.isHovered = false;
                                        obj.isSelected = true;
                                        vtBase.SelectedVtObject = obj;
                                        vtBase.VtRedrawFunction(contID);
                                    }
                                    vtBase.Selector.css('cursor', vtBase.Cursor);

                                }
                            }
                        }
                        break;
                    case "5-Point":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X5, obj.vtProperties.Y5, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X5, obj.vtProperties.Y5, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X5, obj.vtProperties.Y5, tempX, tempY, 5) || inTriangle(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY) || inTriangle(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X5, obj.vtProperties.Y5, tempX, tempY)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;

                                        }
                                    }
                                }
                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);

                                switch (XABCDendpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X5, obj.vtProperties.Y5, 5, tempX, tempY)) {
                                    case 0:

                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 4:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 5:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    vtBase.SelectedVtObject = obj;
                                    obj.isSelected = true;
                                    vtBase.VtRedrawFunction(contID);
                                }


                                vtBase.Selector.css('cursor', vtBase.Cursor);


                            }
                        }
                        break;
                    case "7-Point":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X5, obj.vtProperties.Y5, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X6, obj.vtProperties.Y6, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X5, obj.vtProperties.Y5, obj.vtProperties.X6, obj.vtProperties.Y6, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X6, obj.vtProperties.Y6, obj.vtProperties.X7, obj.vtProperties.Y7, tempX, tempY, 5)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;

                                        }
                                    }
                                }
                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                switch (ThreeDriversEndpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X5, obj.vtProperties.Y5, obj.vtProperties.X6, obj.vtProperties.Y6, obj.vtProperties.X7, obj.vtProperties.Y7, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 4:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 5:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 6:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 7:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    vtBase.SelectedVtObject = obj;
                                    obj.isSelected = true;
                                    vtBase.VtRedrawFunction(contID);
                                }


                                vtBase.Selector.css('cursor', vtBase.Cursor);


                            }
                        }
                        break;
                    case "Ray":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5)) {
                                //if (vtBase.SelectedVtObject.BaseType !== null) {
                                //    vtBase.SelectedVtObject.isHovered = false;
                                //    vtBase.SelectedVtObject.isSelected = false;
                                //}
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                switch (endpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = null;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "Extended":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X1, obj.vtProperties.Y1, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5)) {
                                //if (vtBase.SelectedVtObject.BaseType !== null) {
                                //    vtBase.SelectedVtObject.isHovered = false;
                                //    vtBase.SelectedVtObject.isSelected = false;
                                //}
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                switch (endpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    vtBase.SelectedVtObject = null;
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "4-PointTriangle":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5) || inTriangle(obj.vtProperties.X5, obj.vtProperties.Y5, obj.vtProperties.X6, obj.vtProperties.Y6, obj.vtProperties.X7, obj.vtProperties.Y7, tempX, tempY)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }
                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                //obj.DrawVT();
                                //WC.VT.drawCircleEndpoint(obj.X1, obj.Y1, 5, obj.ContainerID);
                                //WC.VT.drawCircleEndpoint(obj.X2, obj.Y2, 5, obj.ContainerID);
                                //WC.VT.drawCircleEndpoint(obj.X3, obj.Y3, 5, obj.ContainerID);
                                //WC.VT.drawCircleEndpoint(obj.X4, obj.Y4, 5, obj.ContainerID);
                                switch (ABCDendpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 4:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    vtBase.SelectedVtObject = null;
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.VtRedrawFunction(contID);
                                }

                                //if (vtBase.Selector.css('cursor') !== "default") {
                                vtBase.Selector.css('cursor', vtBase.Cursor);
                                //}

                            }
                        }
                        break;
                    case "SchiffPitchfork":
                        {
                            if (WC.VT.isMouseOverLine(obj.medianX, obj.medianY, obj.ExtendedX1, obj.ExtendedY1, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.ExtendedX2, obj.ExtendedY2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.ExtendedX3, obj.ExtendedY3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5)) {
                                //if (vtBase.SelectedVtObject.BaseType !== null) {
                                //    vtBase.SelectedVtObject.isHovered = false;
                                //    vtBase.SelectedVtObject.isSelected = false;
                                //}
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                switch (PitchforkEndpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, 8, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "InsidePitchfork":
                        {
                            if (WC.VT.isMouseOverLine(obj.medianX, obj.medianY, obj.ExtendedX3, obj.ExtendedY3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.ExtendedX1, obj.ExtendedY1, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.midX, obj.midY, obj.ExtendedX2, obj.ExtendedY2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5)) {

                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                switch (PitchforkEndpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, 8, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "GannBox":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.X3, obj.Y3, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.X4, obj.Y4, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.X3, obj.Y3, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.X4, obj.Y4, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.X5, obj.Y5, obj.X10, obj.Y10, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.X6, obj.Y6, obj.X11, obj.Y11, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.X7, obj.Y7, obj.X12, obj.Y12, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.X8, obj.Y8, obj.X13, obj.Y13, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.X9, obj.Y9, obj.X14, obj.Y14, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.X15, obj.Y15, obj.X20, obj.Y20, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.X16, obj.Y16, obj.X21, obj.Y21, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.X17, obj.Y17, obj.X22, obj.Y22, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.X18, obj.Y18, obj.X23, obj.Y23, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.X19, obj.Y19, obj.X24, obj.Y24, tempX, tempY, 5)) {
                                //if (vtBase.SelectedVtObject.BaseType !== null) {
                                //    vtBase.SelectedVtObject.isHovered = false;
                                //    vtBase.SelectedVtObject.isSelected = false;
                                //}
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                switch (endpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = null;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "PitchFan":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.ExtendedX1, obj.ExtendedY1, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.ExtendedX2, obj.ExtendedY2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.ExtendedX3, obj.ExtendedY3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.ExtendedX4, obj.ExtendedY4, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.ExtendedX5, obj.ExtendedY5, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5)) {
                                //if (vtBase.SelectedVtObject.BaseType !== null) {
                                //    vtBase.SelectedVtObject.isHovered = false;
                                //    vtBase.SelectedVtObject.isSelected = false;
                                //}
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                switch (PitchforkEndpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, 8, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "FibonacciChannel":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5)) {
                                //if (vtBase.SelectedVtObject.BaseType !== null) {
                                //    vtBase.SelectedVtObject.isHovered = false;
                                //    vtBase.SelectedVtObject.isSelected = false;
                                //}
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                //WC.VT.drawCircleEndpoint(obj.X3, obj.Y3, 5, obj.ContainerID);
                                switch (PitchforkEndpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, 8, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "TrendBasedFibonacciExtension":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5)) {
                                //if (vtBase.SelectedVtObject.BaseType !== null) {
                                //    vtBase.SelectedVtObject.isHovered = false;
                                //    vtBase.SelectedVtObject.isSelected = false;
                                //}
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X3, obj.vtProperties.Y3, 5, obj.ContainerID);
                                switch (PitchforkEndpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, 8, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "FibonacciSpiral":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5)) {
                                //if (vtBase.SelectedVtObject.BaseType !== null) {
                                //    vtBase.SelectedVtObject.isHovered = false;
                                //    vtBase.SelectedVtObject.isSelected = false;
                                //}
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                switch (endpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "FibWedge":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X1, obj.vtProperties.Y1, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X1, obj.vtProperties.Y1, tempX, tempY, 5)) {
                                //if (vtBase.SelectedVtObject.BaseType !== null) {
                                //    vtBase.SelectedVtObject.isHovered = false;
                                //    vtBase.SelectedVtObject.isSelected = false;
                                //}
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                //obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X3, obj.vtProperties.Y3, 5, obj.ContainerID);
                                switch (PitchforkEndpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, 8, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    vtBase.SelectedVtObject = obj;
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                            break;
                        }
                    case "GannSquare":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X5, obj.vtProperties.Y5, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X5, obj.vtProperties.Y5, obj.vtProperties.X1, obj.vtProperties.Y1, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X6, obj.vtProperties.Y6, obj.vtProperties.X7, obj.vtProperties.Y7, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X8, obj.vtProperties.Y8, obj.vtProperties.X9, obj.vtProperties.Y9, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X10, obj.vtProperties.Y10, obj.vtProperties.X11, obj.vtProperties.Y11, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X12, obj.vtProperties.Y12, obj.vtProperties.X13, obj.vtProperties.Y13, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X14, obj.vtProperties.Y14, obj.vtProperties.X15, obj.vtProperties.Y15, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X16, obj.vtProperties.Y16, obj.vtProperties.X17, obj.vtProperties.Y17, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X18, obj.vtProperties.Y18, obj.vtProperties.X19, obj.vtProperties.Y19, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X20, obj.vtProperties.Y20, obj.vtProperties.X21, obj.vtProperties.Y21, tempX, tempY, 5)) {
                                //if (vtBase.SelectedVtObject.BaseType !== null) {
                                //    vtBase.SelectedVtObject.isHovered = false;
                                //    vtBase.SelectedVtObject.isSelected = false;
                                //}
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                switch (endpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = null;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "RegressionLine":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X1, obj.vtProperties.Y1, tempX, tempY, 5)) {
                                //if (vtBase.SelectedVtObject.BaseType !== null) {
                                //    vtBase.SelectedVtObject.isHovered = false;
                                //    vtBase.SelectedVtObject.isSelected = false;
                                //}
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                //obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                switch (endpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    vtBase.SelectedVtObject = obj;
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "Pen":
                        {
                            var flag;
                            var tempx = [];
                            tempx = obj.vtProperties.points;
                            tempx.forEach(function (path) {
                                if (tempx.some(function (point) {
								  return flag = isBetween(point.x, point.y, tempX, tempY, 5)
                                })) {
                                }
                            });

                            if (flag) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }
                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                vtBase.Selector.css('cursor', 'move');
                                return;


                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);
                            }
                        }
                        break;
                    case "Horizontal":
                        {
                            if (obj.SettingsValues.ExtendToInfinityL.toLowerCase() === "true" && obj.SettingsValues.ExtendToInfinityR.toLowerCase() === "true") {
                                if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5)) {
                                    if (count > 0) {
                                        for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                            if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            }
                                        }
                                    }

                                    obj.isHovered = true;
                                    vtBase.setToTrue = true;
                                    vtBase.HoveringVT = obj.vtID;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.SelectedVT = obj.vtID;
                                    vtBase.VtRedrawFunction(contID);
                                    obj.DrawVT();
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                    vtBase.Selector.css('cursor', 'move');
                                    return;

                                } else {
                                    if (!obj.isSelected) {
                                        obj.isHovered = false;
                                        obj.isSelected = false;
                                        vtBase.VtRedrawFunction(contID);
                                        vtBase.setToTrue = false;
                                        vtBase.HoveringVT = null;
                                        vtBase.SelectedVtObject = null;
                                        vtBase.SelectedVT = null;
                                        vtBase.hoverNum = 0;
                                    } else {
                                        obj.isHovered = false;
                                        obj.isSelected = true;
                                        vtBase.VtRedrawFunction(contID);
                                    }
                                    vtBase.Selector.css('cursor', vtBase.Cursor);

                                }
                            } else if (obj.SettingsValues.ExtendToInfinityL.toLowerCase() === "false" && obj.SettingsValues.ExtendToInfinityR.toLowerCase() === "true") {
                                if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5)) {
                                    if (count > 0) {
                                        for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                            if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            }
                                        }
                                    }

                                    obj.isHovered = true;
                                    vtBase.setToTrue = true;
                                    vtBase.HoveringVT = obj.vtID;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.SelectedVT = obj.vtID;
                                    vtBase.VtRedrawFunction(contID);
                                    obj.DrawVT();
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                    vtBase.Selector.css('cursor', 'move');
                                    return;

                                } else {
                                    if (!obj.isSelected) {
                                        obj.isHovered = false;
                                        obj.isSelected = false;
                                        vtBase.VtRedrawFunction(contID);
                                        vtBase.setToTrue = false;
                                        vtBase.HoveringVT = null;
                                        vtBase.SelectedVtObject = null;
                                        vtBase.SelectedVT = null;
                                        vtBase.hoverNum = 0;
                                    } else {
                                        obj.isHovered = false;
                                        obj.isSelected = true;
                                        vtBase.VtRedrawFunction(contID);
                                    }
                                    vtBase.Selector.css('cursor', vtBase.Cursor);

                                }
                            } else if (obj.SettingsValues.ExtendToInfinityL.toLowerCase() === "true" && obj.SettingsValues.ExtendToInfinityR.toLowerCase() === "false") {
                                if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5)) {
                                    if (count > 0) {
                                        for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                            if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            }
                                        }
                                    }

                                    obj.isHovered = true;
                                    vtBase.setToTrue = true;
                                    vtBase.HoveringVT = obj.vtID;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.SelectedVT = obj.vtID;
                                    vtBase.VtRedrawFunction(contID);
                                    obj.DrawVT();
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                    vtBase.Selector.css('cursor', 'move');
                                    return;

                                } else {
                                    if (!obj.isSelected) {
                                        obj.isHovered = false;
                                        obj.isSelected = false;
                                        vtBase.VtRedrawFunction(contID);
                                        vtBase.setToTrue = false;
                                        vtBase.HoveringVT = null;
                                        vtBase.SelectedVtObject = null;
                                        vtBase.SelectedVT = null;
                                        vtBase.hoverNum = 0;
                                    } else {
                                        obj.isHovered = false;
                                        obj.isSelected = true;
                                        vtBase.VtRedrawFunction(contID);
                                    }
                                    vtBase.Selector.css('cursor', vtBase.Cursor);

                                }
                            } else {
                                if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X1 + 10, obj.vtProperties.Y1, tempX, tempY, 5)) {
                                    if (count > 0) {
                                        for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                            if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            }
                                        }
                                    }

                                    obj.isHovered = true;
                                    vtBase.setToTrue = true;
                                    vtBase.HoveringVT = obj.vtID;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.SelectedVT = obj.vtID;
                                    vtBase.VtRedrawFunction(contID);
                                    obj.DrawVT();
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                    vtBase.Selector.css('cursor', 'move');
                                    return;
                                } else {
                                    if (!obj.isSelected) {
                                        obj.isHovered = false;
                                        obj.isSelected = false;
                                        vtBase.VtRedrawFunction(contID);
                                        vtBase.setToTrue = false;
                                        vtBase.HoveringVT = null;
                                        vtBase.SelectedVtObject = null;
                                        vtBase.SelectedVT = null;
                                        vtBase.hoverNum = 0;
                                    } else {
                                        obj.isHovered = false;
                                        obj.isSelected = true;
                                        vtBase.VtRedrawFunction(contID);
                                    }
                                    vtBase.Selector.css('cursor', vtBase.Cursor);

                                }
                            }
                        }
                        break;
                    case "Vertical":
                        {
                            if (obj.SettingsValues.ExtendToInfinityB.toLowerCase() === "true" && obj.SettingsValues.ExtendToInfinityT.toLowerCase() === "true") {
                                if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5)) {
                                    if (count > 0) {
                                        for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                            if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            }
                                        }
                                    }

                                    obj.isHovered = true;
                                    vtBase.setToTrue = true;
                                    vtBase.HoveringVT = obj.vtID;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.SelectedVT = obj.vtID;
                                    vtBase.VtRedrawFunction(contID);
                                    obj.DrawVT();
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                    vtBase.Selector.css('cursor', 'move');
                                    return;

                                } else {
                                    if (!obj.isSelected) {
                                        obj.isHovered = false;
                                        obj.isSelected = false;
                                        vtBase.VtRedrawFunction(contID);
                                        vtBase.setToTrue = false;
                                        vtBase.HoveringVT = null;
                                        vtBase.SelectedVtObject = null;
                                        vtBase.SelectedVT = null;
                                        vtBase.hoverNum = 0;
                                    } else {
                                        obj.isHovered = false;
                                        obj.isSelected = true;
                                        vtBase.VtRedrawFunction(contID);
                                    }
                                    vtBase.Selector.css('cursor', vtBase.Cursor);

                                }
                            } else if (obj.SettingsValues.ExtendToInfinityT.toLowerCase() === "false" && obj.SettingsValues.ExtendToInfinityB.toLowerCase() === "true") {
                                if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5)) {
                                    if (count > 0) {
                                        for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                            if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            }
                                        }
                                    }

                                    obj.isHovered = true;
                                    vtBase.setToTrue = true;
                                    vtBase.HoveringVT = obj.vtID;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.SelectedVT = obj.vtID;
                                    vtBase.VtRedrawFunction(contID);
                                    obj.DrawVT();
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                    vtBase.Selector.css('cursor', 'move');
                                    return;

                                } else {
                                    if (!obj.isSelected) {
                                        obj.isHovered = false;
                                        obj.isSelected = false;
                                        vtBase.VtRedrawFunction(contID);
                                        vtBase.setToTrue = false;
                                        vtBase.HoveringVT = null;
                                        vtBase.SelectedVtObject = null;
                                        vtBase.SelectedVT = null;
                                        vtBase.hoverNum = 0;
                                    } else {
                                        obj.isHovered = false;
                                        obj.isSelected = true;
                                        vtBase.VtRedrawFunction(contID);
                                    }
                                    vtBase.Selector.css('cursor', vtBase.Cursor);

                                }
                            } else if (obj.SettingsValues.ExtendToInfinityT.toLowerCase() === "true" && obj.SettingsValues.ExtendToInfinityB.toLowerCase() === "false") {
                                if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5)) {
                                    if (count > 0) {
                                        for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                            if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            }
                                        }
                                    }

                                    obj.isHovered = true;
                                    vtBase.setToTrue = true;
                                    vtBase.HoveringVT = obj.vtID;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.SelectedVT = obj.vtID;
                                    vtBase.VtRedrawFunction(contID);
                                    obj.DrawVT();
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                    vtBase.Selector.css('cursor', 'move');
                                    return;

                                } else {
                                    if (!obj.isSelected) {
                                        obj.isHovered = false;
                                        obj.isSelected = false;
                                        vtBase.VtRedrawFunction(contID);
                                        vtBase.setToTrue = false;
                                        vtBase.HoveringVT = null;
                                        vtBase.SelectedVtObject = null;
                                        vtBase.SelectedVT = null;
                                        vtBase.hoverNum = 0;
                                    } else {
                                        obj.isHovered = false;
                                        obj.isSelected = true;
                                        vtBase.VtRedrawFunction(contID);
                                    }
                                    vtBase.Selector.css('cursor', vtBase.Cursor);

                                }
                            } else {
                                if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X1 + 10, obj.vtProperties.Y1, tempX, tempY, 5)) {
                                    if (count > 0) {
                                        for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                            if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                                WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            }
                                        }
                                    }

                                    obj.isHovered = true;
                                    vtBase.setToTrue = true;
                                    vtBase.HoveringVT = obj.vtID;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.SelectedVT = obj.vtID;
                                    vtBase.VtRedrawFunction(contID);
                                    obj.DrawVT();
                                    WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                    vtBase.Selector.css('cursor', 'move');
                                    return;
                                } else {
                                    if (!obj.isSelected) {
                                        obj.isHovered = false;
                                        obj.isSelected = false;
                                        vtBase.VtRedrawFunction(contID);
                                        vtBase.setToTrue = false;
                                        vtBase.HoveringVT = null;
                                        vtBase.SelectedVtObject = null;
                                        vtBase.SelectedVT = null;
                                        vtBase.hoverNum = 0;
                                    } else {
                                        obj.isHovered = false;
                                        obj.isSelected = true;
                                        vtBase.VtRedrawFunction(contID);
                                    }
                                    vtBase.Selector.css('cursor', vtBase.Cursor);

                                }
                            }
                        }
                        break;
                    case "TrendAngle":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X1, obj.vtProperties.Y1, tempX, tempY, 5)) {
                                //if (vtBase.SelectedVtObject.BaseType !== null) {
                                //    vtBase.SelectedVtObject.isHovered = false;
                                //    vtBase.SelectedVtObject.isSelected = false;
                                //}
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                //obj.DrawVT();
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                switch (endpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, 5, tempX, tempY)) {
                                    case 0:
                                    case 1:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    vtBase.SelectedVtObject = obj;
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "FTB":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X1, obj.vtProperties.Y1, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3A, obj.vtProperties.Y3, obj.vtProperties.X3B, obj.vtProperties.Y3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3B, obj.vtProperties.Y3, obj.vtProperties.X3A, obj.vtProperties.Y3, tempX, tempY, 5)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X3A, obj.vtProperties.Y3, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X3B, obj.vtProperties.Y3, 5, obj.ContainerID);
                                switch (ABCDendpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3A, obj.vtProperties.Y3, obj.vtProperties.X3B, obj.vtProperties.Y3, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 4:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    vtBase.SelectedVtObject = obj;
                                    obj.isHovered = false;
                                    vtBase.hoverNum = null;
                                    obj.isSelected = true;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "Disjoint":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X1, obj.vtProperties.Y1, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3A, obj.vtProperties.Y3A, obj.vtProperties.X3B, obj.vtProperties.Y3B, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3B, obj.vtProperties.Y3B, obj.vtProperties.X3A, obj.vtProperties.Y3A, tempX, tempY, 5)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X3A, obj.vtProperties.Y3A, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X3B, obj.vtProperties.Y3B, 5, obj.ContainerID);
                                switch (ABCDendpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3A, obj.vtProperties.Y3A, obj.vtProperties.X3B, obj.vtProperties.Y3B, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 4:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    vtBase.SelectedVtObject = obj;
                                    obj.isHovered = false;
                                    vtBase.hoverNum = null;
                                    obj.isSelected = true;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                    case "8-Points":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X5, obj.vtProperties.Y5, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X5, obj.vtProperties.Y5, obj.vtProperties.X6, obj.vtProperties.Y6, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X6, obj.vtProperties.Y6, obj.vtProperties.X7, obj.vtProperties.Y7, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X7, obj.vtProperties.Y7, obj.vtProperties.X8, obj.vtProperties.Y8, tempX, tempY, 5)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }
                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                //obj.DrawVT();
                                switch (EightPointsEndpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X5, obj.vtProperties.Y5, obj.vtProperties.X6, obj.vtProperties.Y6, obj.vtProperties.X7, obj.vtProperties.Y7, obj.vtProperties.X8, obj.vtProperties.Y8, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 4:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 5:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 6:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 7:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 8:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    vtBase.SelectedVtObject = obj;
                                    obj.isSelected = true;
                                    vtBase.VtRedrawFunction(contID);
                                }

                                //if (vtBase.Selector.css('cursor') !== "default") {
                                vtBase.Selector.css('cursor', vtBase.Cursor);
                                //}

                            }
                        }
                        break;
                    case "HeadAndShoulders":
                        {
                            var a = (obj.checkIntersect1) ? inTriangle(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X8, obj.vtProperties.Y8, tempX, tempY) : false;
                            var b = (obj.checkIntersect2) ? inTriangle(obj.vtProperties.X5, obj.vtProperties.Y5, obj.vtProperties.X6, obj.vtProperties.Y6, obj.vtProperties.X9, obj.vtProperties.Y9, tempX, tempY) : false;
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X5, obj.vtProperties.Y5, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X5, obj.vtProperties.Y5, obj.vtProperties.X6, obj.vtProperties.Y6, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X6, obj.vtProperties.Y6, obj.vtProperties.X7, obj.vtProperties.Y7, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X5, obj.vtProperties.Y5, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X8, obj.vtProperties.Y8, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X5, obj.vtProperties.Y5, obj.vtProperties.X9, obj.vtProperties.Y9, tempX, tempY, 5) || inTriangle(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X5, obj.vtProperties.Y5, tempX, tempY) || a || b) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }
                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                //obj.DrawVT();
                                switch (ThreeDriversEndpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, obj.vtProperties.X5, obj.vtProperties.Y5, obj.vtProperties.X6, obj.vtProperties.Y6, obj.vtProperties.X7, obj.vtProperties.Y7, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 4:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 5:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 6:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 7:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    vtBase.SelectedVtObject = obj;
                                    obj.isSelected = true;
                                    vtBase.VtRedrawFunction(contID);
                                }

                                //if (vtBase.Selector.css('cursor') !== "default") {
                                vtBase.Selector.css('cursor', vtBase.Cursor);
                                //}

                            }
                        }
                        break;
                    case "PriceDateRange":
                        {
                            if (inPolygon(Math.min(obj.vtProperties.X1, obj.vtProperties.X2), Math.min(obj.vtProperties.Y1, obj.vtProperties.Y2), Math.max(obj.vtProperties.X1, obj.vtProperties.X2), Math.max(obj.vtProperties.Y1, obj.vtProperties.Y2), tempX, tempY, 5)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                                WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);

                                switch (endpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                }
                                else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);
                            }
                        }
                        break;
                    case "Label":
                        {
                            if (singlePointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, 4, tempX, tempY) !== null) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                obj.DrawVT();
                                vtBase.Selector.css('cursor', 'pointer');
                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                }
                                else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);
                            }
                            break;
                        }
                    case "Image":
                        {

                            if (isBetween(obj.vtProperties.X1, obj.vtProperties.Y1, tempX, tempY, 5) || inPolygon(Math.min(obj.vtProperties.X2, obj.vtProperties.X3), Math.min(obj.vtProperties.Y2, obj.vtProperties.Y3), Math.max(obj.vtProperties.X2, obj.vtProperties.X3), Math.max(obj.vtProperties.Y2, obj.vtProperties.Y3), tempX, tempY, 5)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }
                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                //obj.DrawVT();
                                vtBase.Selector.css('cursor', 'move');
                                return;


                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);
                            }
                            break;
                        }
                    case "Cyclic":
                        if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, tempX, tempY, 5) || WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X1, obj.vtProperties.Y1, tempX, tempY, 5)) {
                            //if (vtBase.SelectedVtObject.BaseType !== null) {
                            //    vtBase.SelectedVtObject.isHovered = false;
                            //    vtBase.SelectedVtObject.isSelected = false;
                            //}
                            if (count > 0) {
                                for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                    if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                        WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                        WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                        //    vtBase.VtRedrawFunction(ContainerID);
                                    }
                                }
                            }

                            obj.isHovered = true;
                            vtBase.setToTrue = true;
                            vtBase.HoveringVT = obj.vtID;
                            vtBase.SelectedVtObject = obj;
                            vtBase.SelectedVT = obj.vtID;
                            vtBase.VtRedrawFunction(contID);
                            //obj.DrawVT();
                            WC.VT.drawCircleEndpoint(obj.vtProperties.X1, obj.vtProperties.Y1, 5, obj.ContainerID);
                            WC.VT.drawCircleEndpoint(obj.vtProperties.X2, obj.vtProperties.Y2, 5, obj.ContainerID);
                            switch (endpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, 5, tempX, tempY)) {
                                case 0:
                                    vtBase.Selector.css('cursor', 'move');
                                    break;
                                case 1:
                                    vtBase.Selector.css('cursor', 'pointer');
                                    break;
                                case 2:
                                    vtBase.Selector.css('cursor', 'pointer');
                                    break;
                            }
                            return;

                        } else {
                            if (!obj.isSelected) {
                                obj.isHovered = false;
                                obj.isSelected = false;
                                vtBase.VtRedrawFunction(contID);
                                vtBase.setToTrue = false;
                                vtBase.HoveringVT = null;
                                if (vtBase.SelectedVtObject !== null) {
                                    if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                        vtBase.SelectedVtObject = null;
                                    }
                                } else {
                                    vtBase.SelectedVtObject = null;
                                }
                                vtBase.SelectedVT = null;
                                vtBase.hoverNum = 0;
                            } else {
                                vtBase.SelectedVtObject = obj;
                                obj.isHovered = false;
                                obj.isSelected = true;
                                vtBase.VtRedrawFunction(contID);
                            }
                            vtBase.Selector.css('cursor', vtBase.Cursor);

                        }
                        break;

                    case "Note":
                        {
                            if (inPolygon(Math.min(obj.vtProperties.X1 - 10, obj.vtProperties.X1 + 10), Math.min(obj.vtProperties.Y1 - 20, obj.vtProperties.Y1), Math.max(obj.vtProperties.X1 - 10, obj.vtProperties.X1 + 10), Math.max(obj.vtProperties.Y1 - 20, obj.vtProperties.Y1), tempX, tempY, 5)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                //obj.DrawVT();
                                vtBase.Selector.css('cursor', 'move');
                                return;
                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                }
                                else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);
                            }
                            break;
                        }
                    case "ShortPosition":
                    case "LongPosition":
                        {
                            if (inPolygon(Math.min(obj.vtProperties.X1, obj.vtProperties.X2), Math.min(obj.vtProperties.Y3, obj.vtProperties.Y4), Math.max(obj.vtProperties.X1, obj.vtProperties.X2), Math.max(obj.vtProperties.Y3, obj.vtProperties.Y4), tempX, tempY, 5)) {
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                //obj.DrawVT();
                                switch (ABCDendpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 2:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 4:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;
                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                }
                                else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);
                            }
                            break;
                        }
                    case "Arc":
                        {
                            if (WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X3, obj.vtProperties.Y3, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X2, obj.vtProperties.Y2, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5) ||
								WC.VT.isMouseOverLine(obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, tempX, tempY, 5)) {
                                //if (vtBase.SelectedVtObject.BaseType !== null) {
                                //    vtBase.SelectedVtObject.isHovered = false;
                                //    vtBase.SelectedVtObject.isSelected = false;
                                //}
                                if (count > 0) {
                                    for (var i in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                                        if (WC.VT.VisualToolsObjectCollection[ContainerID][i].vtID !== obj.vtID) {
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isSelected = false;
                                            WC.VT.VisualToolsObjectCollection[ContainerID][i].isHovered = false;
                                            //    vtBase.VtRedrawFunction(ContainerID);
                                        }
                                    }
                                }

                                obj.isHovered = true;
                                vtBase.setToTrue = true;
                                vtBase.HoveringVT = obj.vtID;
                                vtBase.SelectedVtObject = obj;
                                vtBase.SelectedVT = obj.vtID;
                                vtBase.VtRedrawFunction(contID);
                                switch (ArcEndpointHovering(obj.vtProperties.X1, obj.vtProperties.Y1, obj.vtProperties.X3, obj.vtProperties.Y3, obj.vtProperties.X4, obj.vtProperties.Y4, 5, tempX, tempY)) {
                                    case 0:
                                        vtBase.Selector.css('cursor', 'move');
                                        break;
                                    case 1:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 3:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                    case 4:
                                        vtBase.Selector.css('cursor', 'pointer');
                                        break;
                                }
                                return;

                            } else {
                                if (!obj.isSelected) {
                                    obj.isHovered = false;
                                    obj.isSelected = false;
                                    vtBase.VtRedrawFunction(contID);
                                    vtBase.setToTrue = false;
                                    vtBase.HoveringVT = null;
                                    if (vtBase.SelectedVtObject !== null) {
                                        if (vtBase.SelectedVtObject.vtID === obj.vtID) {
                                            vtBase.SelectedVtObject = null;
                                        }
                                    } else {
                                        vtBase.SelectedVtObject = null;
                                    }
                                    vtBase.SelectedVT = null;
                                    vtBase.hoverNum = 0;
                                } else {
                                    obj.isHovered = false;
                                    obj.isSelected = true;
                                    vtBase.SelectedVtObject = obj;
                                    vtBase.VtRedrawFunction(contID);
                                }
                                vtBase.Selector.css('cursor', vtBase.Cursor);

                            }
                        }
                        break;
                }
            }
        }

        obj = null;
    }

    function inPolygon(x1, y1, x2, y2, xToCheck, yToCheck, Allowance) {
        if (xToCheck <= (x1 - Allowance)) {
            return false;
        }
        if (yToCheck <= (y1 - Allowance)) {
            return false;
        }
        if (xToCheck >= (x2 + Allowance)) {
            return false;
        }
        if (yToCheck >= (y2 + Allowance)) {
            return false;
        }

        return true;
    }

    function inTriangle(x1, y1, x2, y2, x3, y3, tcx, tcy) {
        var A = 1 / 2 * (-y2 * x3 + y1 * (-x2 + x3) + x1 * (y2 - y3) + x2 * y3);
        var sign = A < 0 ? -1 : 1;
        var s = (y1 * x3 - x1 * y3 + (y3 - y1) * tcx + (x1 - x3) * tcy) * sign;
        var t = (x1 * y2 - y1 * x2 + (y1 - y2) * tcx + (x2 - x1) * tcy) * sign;

        return s > 0 && t > 0 && (s + t) < 2 * A * sign;
    }

    function isBetween(x1, y1, tempoX, tempoY, z) {
        return (tempoX >= x1 - z && tempoX <= x1 + z && tempoY >= y1 - z && tempoY <= y1 + z);
    }

    function inText(x, y, xTC, yTC, a, h, w) {

        var x1 = x - a;
        var y1 = y - a;
        var x2 = (x + w) + a;
        var y2 = (y + h) + a;

        if (xTC <= (x1 - a)) {
            return false;
        }
        if (yTC <= (y1 - a)) {
            return false;
        }
        if (xTC >= (x2 + a)) {
            return false;
        }
        if (yTC >= (y2 + a)) {
            return false;
        }

        return true;
    }

    function inPriceBalloon(x, y, xTC, yTC, h, w) {
        var x1 = x + w;
        var y1 = y - h;

        if (xTC < x) {
            return false;
        }
        if (xTC > x1) {
            return false;
        }
        if (yTC < y1) {
            return false;
        }
        if (yTC > y) {
            return false;
        }

        return true;
    }

    function isMouseOverLineInfinity(x1, y1, x2, y2, xToCheck, yToCheck, Allowance, cID) {
        var ctx = WC.VT.ctxVisualToolsCanvasCollection[cID][0];
        var segLength = Math.sqrt(Math.pow((x1 - x2), 2) + Math.pow((y1 - y2), 2)),
			vstartDist = segLength * -2,
			endDist = Math.sqrt(Math.pow((x2 - ctx.canvas.width), 2) + Math.pow((y2 - ctx.canvas.height), 2));

        var pointInfinityX = x2 + (x2 - x1) / segLength * endDist;
        var pointInfinityY = y2 + (y2 - y1) / segLength * endDist;
        var x = x1 - pointInfinityX;
        var y = y1 - pointInfinityY;
        var m = y / x;
        if (Math.abs(m) === Infinity) {
            if (Math.abs(xToCheck - x1) < Allowance) {
                return true;
            }
        }
        var yTC = parseInt(yToCheck - y1);
        var xTC = parseInt(m * (xToCheck - x1))
        var z = (Math.abs(yTC - xTC) <= Allowance) ? true : false;
        var c = (yTC >= pointInfinityY) ? false : true;
        if (z === true && c === false) {
            if (y1 >= 0) {
                z = false;
            }
            if (y1 < 0) {
                z = true;
            }
        }

        if (z) {
            var PointRight, PointLeft;
            if (x1 > pointInfinityX) {
                PointRight = x1;
                PointLeft = pointInfinityX;
            } else {
                PointRight = pointInfinityX;
                PointLeft = x1;
            }

            if (xToCheck > PointRight + Allowance) {
                z = false;
            }

            if (xToCheck < PointLeft - Allowance) {
                z = false;
            }
        }
        return z;

    }

    function vtMouseMove(event) {
        var pntr = event.originalEvent.targetTouches ? event.originalEvent.targetTouches[0] : event;

        tempX = event.offsetX ? event.offsetX : pntr.pageX;
        tempY = event.offsetY ? event.offsetY : pntr.pageY;

        if (event.buttons === 1 && vtBase.isDraggingVT) {
            vtBase.isDraggingVT = false;
        }

        if (event.buttons === 1 && vtBase.SelectedVtObject === null) {
            vtBase.isChartDragging = true;
        } else {
            vtBase.isChartDragging = false;
        }

        if (isDown && event.buttons === 1) {
            var mObj;
            if (vtBase.SelectedVtObject !== null) {
                switch (vtBase.SelectedVtObject.BaseType) {
                    case "Line":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "Polygon":
                        {
                            if (vtBase.hoverAnchor !== null) {
                                switch (vtBase.hoverAnchor) {
                                    case "A":
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        // vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case "B":
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case "C":
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                        mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj1.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj1.Price;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case "D":
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case "E":
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case "F":
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case "G":
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                        mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj1.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj1.Price;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case "H":
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            } else {
                                var diffX = mdX - tempX;
                                var diffY = mdY - tempY;
                                vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                vtBase.VtDragRedrawFunction(vtBase.cID);
                                mdX = tempX;
                                mdY = tempY;
                            }

                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "Note":
                    case "Text":
                        {
                            var diffX = mdX - tempX;
                            var diffY = mdY - tempY;
                            vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                            vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                            var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                            vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                            vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                            vtBase.VtDragRedrawFunction(vtBase.cID);
                            mdX = tempX;
                            mdY = tempY;

                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "Balloon":
                        {
                            var diffX = mdX - tempX;
                            var diffY = mdY - tempY;
                            vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                            vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                            var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                            vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                            vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                            vtBase.VtDragRedrawFunction(vtBase.cID);
                            mdX = tempX;
                            mdY = tempY;

                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "Callout": // Mouse Move
                        //var diffX = mdX - tempX;
                        //var diffY = mdY - tempY;
                        //vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                        //vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                        //var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo( vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1 );
                        //vtBase.SelectedVtObject.x1Date = ISOStringToDate( mObj1.Bar.Stamp() );
                        //vtBase.SelectedVtObject.y1Price = mObj1.Price;
                        //vtBase.VtDragRedrawFunction( vtBase.cID );
                        //mdX = tempX;
                        //mdY = tempY;

                        //vtBase.ChartInstance.MouseUpEvent();
                        //vtBase.ChartInstance.MouseMoveEvent( tempX, tempY );
                        //if ( vtBase.SelectedVT !== null ) {
                        //    return;
                        //}

                        if (vtBase.hoverNum !== 0) {
                            switch (vtBase.hoverNum) {
                                case 1:
                                    vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                        vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 2:
                                    vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                        vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                            }
                        }
                        //else {
                        //    if ( vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT ) {
                        //        var diffX = mdX - tempX;
                        //        var diffY = mdY - tempY;
                        //        vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                        //        vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                        //        vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                        //        vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                        //        var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo( vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1 );
                        //        var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo( vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2 );
                        //        vtBase.SelectedVtObject.x1Date = ISOStringToDate( mObj1.Bar.Stamp() );
                        //        vtBase.SelectedVtObject.y1Price = mObj1.Price;
                        //        vtBase.SelectedVtObject.x2Date = ISOStringToDate( mObj2.Bar.Stamp() );
                        //        vtBase.SelectedVtObject.y2Price = mObj2.Price;
                        //        vtBase.VtDragRedrawFunction( vtBase.cID );
                        //        mdX = tempX;
                        //        mdY = tempY;
                        //    }
                        //}
                        vtBase.ChartInstance.MouseUpEvent();
                        vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                        if (vtBase.SelectedVT !== null) {
                            return;
                        }
                        break;
                    case "4-PointTriangle":
                        if (vtBase.hoverNum !== 0) {
                            switch (vtBase.hoverNum) {
                                case 1:
                                    vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                        vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 2:
                                    vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                        vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 3:
                                    vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 4:
                                    vtBase.SelectedVtObject.vtProperties.X4 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y4 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x4Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y4Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                            }
                        }
                        else {
                            if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                var diffX = mdX - tempX;
                                var diffY = mdY - tempY;
                                for (var i = 1; i < vtBase.SelectedVtObject.Points + 1; i++) {
                                    vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                    vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                    var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                    vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                }
                                vtBase.VtDragRedrawFunction(vtBase.cID);
                                mdX = tempX;
                                mdY = tempY;
                            }
                        }
                        vtBase.ChartInstance.MouseUpEvent();
                        vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                        if (vtBase.SelectedVT !== null) {
                            return;
                        }
                        break;
                    case "4-Point":
                        if (vtBase.hoverNum !== 0) {
                            switch (vtBase.hoverNum) {
                                case 1:
                                    vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                        vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 2:
                                    vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                        vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 3:
                                    vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 4:
                                    vtBase.SelectedVtObject.vtProperties.X4 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y4 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x4Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y4Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                            }
                        }
                        else {
                            if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                var diffX = mdX - tempX;
                                var diffY = mdY - tempY;
                                for (var i = 1; i < vtBase.SelectedVtObject.Points + 1; i++) {
                                    vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                    vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                    var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                    vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                }
                                vtBase.VtDragRedrawFunction(vtBase.cID);
                                mdX = tempX;
                                mdY = tempY;
                            }
                        }
                        vtBase.ChartInstance.MouseUpEvent();
                        vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                        if (vtBase.SelectedVT !== null) {
                            return;
                        }
                        break;
                    case "Pitchfork":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 3:
                                        vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    for (var i = 1; i < vtBase.SelectedVtObject.Points + 1; i++) {
                                        vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                        vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                        var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                        vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "Parallel":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        var tempoY = vtBase.SelectedVtObject.vtProperties.Y1 - tempY;
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        vtBase.SelectedVtObject.vtProperties.X4 = vtBase.SelectedVtObject.vtProperties.X1;
                                        vtBase.SelectedVtObject.vtProperties.Y4 = vtBase.SelectedVtObject.vtProperties.Y4 - tempoY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.DatePriceProperties.x4Date = ISOStringToDate(mObj2.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y4Price = mObj2.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        var tempoY2 = vtBase.SelectedVtObject.vtProperties.Y2 - tempY;
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        vtBase.SelectedVtObject.vtProperties.X3 = vtBase.SelectedVtObject.vtProperties.X2;
                                        vtBase.SelectedVtObject.vtProperties.Y3 = vtBase.SelectedVtObject.vtProperties.Y3 - tempoY2;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj2.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj2.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 3:
                                        if (vtBase.SelectedVtObject.vtProperties.X1 !== null && vtBase.SelectedVtObject.vtProperties.X2 !== null) {
                                            var tempoY = vtBase.SelectedVtObject.vtProperties.Y1 - tempY;
                                            var tempoY2 = vtBase.SelectedVtObject.vtProperties.Y2 - tempY;
                                            vtBase.SelectedVtObject.vtProperties.Y3 = ((vtBase.SelectedVtObject.vtProperties.Y3 + vtBase.SelectedVtObject.vtProperties.Y2) / 2 - tempoY / 2) - (vtBase.SelectedVtObject.vtProperties.Y3 / 2 - tempY / 2);
                                            vtBase.SelectedVtObject.vtProperties.Y4 = ((vtBase.SelectedVtObject.vtProperties.Y4 + vtBase.SelectedVtObject.vtProperties.Y1) / 2 - tempoY2 / 2) - (vtBase.SelectedVtObject.vtProperties.Y4 / 2 - tempY / 2);
                                            mObj3 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4);
                                            mObj4 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3);
                                            vtBase.SelectedVtObject.DatePriceProperties.x4Date = ISOStringToDate(mObj3.Bar.Stamp());
                                            vtBase.SelectedVtObject.DatePriceProperties.y4Price = mObj3.Price;
                                            vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj4.Bar.Stamp());
                                            vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj4.Price;
                                            vtBase.SelectedVtObject.isSelected = true;
                                            vtBase.VtDragRedrawFunction(vtBase.cID);
                                        }

                                        break;
                                }
                            } else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    for (var i = 1; i < vtBase.SelectedVtObject.Points + 1; i++) {
                                        vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                        vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                        var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                        vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }

                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "GannLine":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "5-Point":
                        if (vtBase.hoverNum !== 0) {
                            switch (vtBase.hoverNum) {
                                case 1:
                                    vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 2:
                                    vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 3:
                                    vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 4:
                                    vtBase.SelectedVtObject.vtProperties.X4 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y4 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x4Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y4Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 5:
                                    vtBase.SelectedVtObject.vtProperties.X5 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y5 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x5Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y5Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                            }
                        }
                        else {
                            if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                var diffX = mdX - tempX;
                                var diffY = mdY - tempY;
                                for (var i = 1; i < vtBase.SelectedVtObject.Points + 1; i++) {
                                    vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                    vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                    var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                    vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                }
                                vtBase.VtDragRedrawFunction(vtBase.cID);
                                mdX = tempX;
                                mdY = tempY;
                            }
                        }
                        vtBase.ChartInstance.MouseUpEvent();
                        vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                        if (vtBase.SelectedVT !== null) {
                            return;
                        }
                        break;
                    case "7-Point":
                        if (vtBase.hoverNum !== 0) {
                            switch (vtBase.hoverNum) {
                                case 1:
                                    vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 2:
                                    vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 3:
                                    vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 4:
                                    vtBase.SelectedVtObject.vtProperties.X4 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y4 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x4Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y4Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 5:
                                    vtBase.SelectedVtObject.vtProperties.X5 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y5 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x5Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y5Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 6:
                                    vtBase.SelectedVtObject.vtProperties.X6 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y6 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x6Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y6Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 7:
                                    vtBase.SelectedVtObject.vtProperties.X7 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y7 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x7Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y7Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                            }
                        }
                        else {
                            if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                var diffX = mdX - tempX;
                                var diffY = mdY - tempY;
                                for (var i = 1; i < vtBase.SelectedVtObject.Points + 1; i++) {
                                    vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                    vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                    var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                    vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                }
                                vtBase.VtDragRedrawFunction(vtBase.cID);
                                mdX = tempX;
                                mdY = tempY;
                            }
                        }
                        vtBase.ChartInstance.MouseUpEvent();
                        vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                        if (vtBase.SelectedVT !== null) {
                            return;
                        }
                        break;
                    case "Ray":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "Extended":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "Pen":
                        {
                            if (vtBase.hoverNum === 0) {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    for (var i = 0; i < vtBase.SelectedVtObject.vtProperties.points.length ; i++) {
                                        vtBase.SelectedVtObject.vtProperties.points[i].x = vtBase.SelectedVtObject.vtProperties.points[i].x - diffX;
                                        vtBase.SelectedVtObject.vtProperties.points[i].y = vtBase.SelectedVtObject.vtProperties.points[i].y - diffY;
                                        var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.points[i].x, vtBase.SelectedVtObject.vtProperties.points[i].y);
                                        vtBase.SelectedVtObject.currentPath[i] = vtBase.SelectedVtObject.currentPath[i] || {};
                                        vtBase.SelectedVtObject.currentPath[i].Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.currentPath[i].Price = mObj.Price;
                                    }
                                    vtBase.SelectedVtObject.AdjustVT();
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                                vtBase.ChartInstance.MouseUpEvent();
                                vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                                if (vtBase.SelectedVT !== null) {
                                    return;
                                }
                            }
                        }

                        break;

                    case "SchiffPitchfork":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.SelectedVtObject.AdjustVT();
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.SelectedVtObject.AdjustVT();
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 3:
                                        vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.SelectedVtObject.AdjustVT();
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    for (var i = 1; i < vtBase.SelectedVtObject.Points + 1; i++) {
                                        vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                        vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                        var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                        vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                    }
                                    vtBase.SelectedVtObject.AdjustVT();
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;

                    case "InsidePitchfork":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.SelectedVtObject.AdjustVT();
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.SelectedVtObject.AdjustVT();
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 3:
                                        vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.SelectedVtObject.AdjustVT();
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    for (var i = 1; i < vtBase.SelectedVtObject.Points + 1; i++) {
                                        vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                        vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                        var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                        vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                    }
                                    vtBase.SelectedVtObject.AdjustVT();
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "GannBox":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "PitchFan":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 3:
                                        vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    for (var i = 1; i < vtBase.SelectedVtObject.vtProperties.Points + 1; i++) {
                                        vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                        vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                        var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                        vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "FibonacciChannel":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 3:
                                        vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    for (var i = 1; i < vtBase.SelectedVtObject.vtProperties.Points + 1; i++) {
                                        vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                        vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                        var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                        vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "TrendBasedFibonacciExtension":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = (vtBase.SelectedVtObject.vtProperties.Y1 > vtBase.SelectedVtObject.vtProperties.Y2) ? "Up" : "Down";
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = (vtBase.SelectedVtObject.vtProperties.Y1 > vtBase.SelectedVtObject.vtProperties.Y2) ? "Up" : "Down";
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 3:
                                        vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    for (var i = 1; i < vtBase.SelectedVtObject.vtProperties.Points + 1; i++) {
                                        vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                        vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                        var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                        vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "FibonacciSpiral":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "FibWedge":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY).Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = vtBase.ChartInstance.GetPrice(tempY);
                                        vtBase.SelectedVtObject.vtProperties.X1 = vtBase.ChartInstance.GetXAxis(vtBase.SelectedVtObject.DatePriceProperties.x1Date);

                                        vtBase.SelectedVtObject.d = Math.sqrt((Math.pow(vtBase.SelectedVtObject.vtProperties.X2 - vtBase.SelectedVtObject.vtProperties.X1, 2) + Math.pow(vtBase.SelectedVtObject.vtProperties.Y2 - vtBase.SelectedVtObject.vtProperties.Y1, 2)));
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        vtBase.SelectedVtObject.DatePriceProperties.Points = 3;
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY).Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = vtBase.ChartInstance.GetPrice(tempY);
                                        vtBase.SelectedVtObject.vtProperties.X2 = vtBase.ChartInstance.GetXAxis(vtBase.SelectedVtObject.DatePriceProperties.x2Date);

                                        vtBase.SelectedVtObject.d = Math.sqrt((Math.pow(vtBase.SelectedVtObject.vtProperties.X2 - vtBase.SelectedVtObject.vtProperties.X1, 2) + Math.pow(vtBase.SelectedVtObject.vtProperties.Y2 - vtBase.SelectedVtObject.vtProperties.Y1, 2)));
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        vtBase.SelectedVtObject.DatePriceProperties.Points = 3;
                                        break;
                                    case 3:
                                        vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                        vtBase.SelectedVtObject.DatePriceProperties.Points = 2;
                                        vtBase.SelectedVtObject.d = Math.sqrt((Math.pow(vtBase.SelectedVtObject.vtProperties.X3 - vtBase.SelectedVtObject.vtProperties.X1, 2) + Math.pow(vtBase.SelectedVtObject.vtProperties.Y3 - vtBase.SelectedVtObject.vtProperties.Y1, 2)));
                                        vtBase.SelectedVtObject.slope = (vtBase.SelectedVtObject.vtProperties.Y2 - vtBase.SelectedVtObject.vtProperties.Y1) / (vtBase.SelectedVtObject.vtProperties.X2 - vtBase.SelectedVtObject.vtProperties.X1);
                                        if (vtBase.SelectedVtObject.vtProperties.X2 > vtBase.SelectedVtObject.vtProperties.X1) {
                                            vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X1 + (vtBase.SelectedVtObject.d / (Math.sqrt(1 + Math.pow(vtBase.SelectedVtObject.slope, 2))));
                                            vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y1 + vtBase.SelectedVtObject.slope * vtBase.SelectedVtObject.d / (Math.sqrt(1 + Math.pow(vtBase.SelectedVtObject.slope, 2)));
                                        } else if (vtBase.SelectedVtObject.vtProperties.X2 < vtBase.SelectedVtObject.vtProperties.X1) {
                                            vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X1 + (-1 * vtBase.SelectedVtObject.d / (Math.sqrt(1 + Math.pow(vtBase.SelectedVtObject.slope, 2))));
                                            vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y1 + -1 * vtBase.SelectedVtObject.slope * vtBase.SelectedVtObject.d / (Math.sqrt(1 + Math.pow(vtBase.SelectedVtObject.slope, 2)));
                                        }
                                        if (vtBase.SelectedVtObject.vtProperties.X1 === vtBase.SelectedVtObject.vtProperties.X2) {
                                            vtBase.SelectedVtObject.slope = (vtBase.SelectedVtObject.vtProperties.Y3 - vtBase.SelectedVtObject.vtProperties.Y1) / (vtBase.SelectedVtObject.vtProperties.X3 - vtBase.SelectedVtObject.vtProperties.X1);
                                            if (vtBase.SelectedVtObject.vtProperties.X3 > vtBase.SelectedVtObject.vtProperties.X1) {
                                                vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X1 + (vtBase.SelectedVtObject.d / (Math.sqrt(1 + Math.pow(vtBase.SelectedVtObject.slope, 2))));
                                                vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y1 + vtBase.SelectedVtObject.slope * vtBase.SelectedVtObject.d / (Math.sqrt(1 + Math.pow(vtBase.SelectedVtObject.slope, 2)));
                                            } else if (vtBase.SelectedVtObject.vtProperties.X3 < vtBase.SelectedVtObject.vtProperties.X1) {
                                                vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X1 + (-1 * vtBase.SelectedVtObject.d / (Math.sqrt(1 + Math.pow(vtBase.SelectedVtObject.slope, 2))));
                                                vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y1 + -1 * vtBase.SelectedVtObject.slope * vtBase.SelectedVtObject.d / (Math.sqrt(1 + Math.pow(vtBase.SelectedVtObject.slope, 2)));
                                            }
                                        }
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2).Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        vtBase.SelectedVtObject.DatePriceProperties.Points = 3;
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    var x = vtBase.ChartInstance.GetXAxis(ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo((vtBase.SelectedVtObject.vtProperties.X1 - diffX), (vtBase.SelectedVtObject.vtProperties.Y1 - diffY)).Bar.Stamp()));
                                    if (x !== vtBase.SelectedVtObject.vtProperties.X1) {
                                        if (Math.abs(Math.abs(diffX) - Math.abs(vtBase.SelectedVtObject.vtProperties.X1 - x)) < 10) {
                                            vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                            vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                            vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                            vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                            vtBase.SelectedVtObject.vtProperties.X3 = vtBase.SelectedVtObject.vtProperties.X3 - diffX;
                                            vtBase.SelectedVtObject.vtProperties.Y3 = vtBase.SelectedVtObject.vtProperties.Y3 - diffY;
                                            vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1).Bar.Stamp());
                                            vtBase.SelectedVtObject.DatePriceProperties.y1Price = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y1);
                                            vtBase.SelectedVtObject.vtProperties.X1 = vtBase.ChartInstance.GetXAxis(vtBase.SelectedVtObject.DatePriceProperties.x1Date);
                                            vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2).Bar.Stamp());
                                            vtBase.SelectedVtObject.DatePriceProperties.y2Price = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.vtProperties.X2 = vtBase.ChartInstance.GetXAxis(vtBase.SelectedVtObject.DatePriceProperties.x2Date);
                                            // vtBase.SelectedVtObject.DatePriceProperties.Points = 2;
                                            vtBase.VtDragRedrawFunction(vtBase.cID);
                                            vtBase.SelectedVtObject.DatePriceProperties.Points = 3;
                                            mdX = tempX;
                                            mdY = tempY;

                                        }
                                    }
                                    //mdX = tempX;
                                    //mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "GannSquare":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "RegressionLine":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        //vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.Reg = false;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.Reg = false;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                            vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                            vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                        }
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                    vtBase.SelectedVtObject.Reg = false;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "Horizontal":
                        {
                            if (vtBase.hoverNum === 0) {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X3 = vtBase.SelectedVtObject.vtProperties.X3 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y3 = vtBase.SelectedVtObject.vtProperties.Y3 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                    var mObj3 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj3.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj2.Price;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "Vertical":
                        {
                            if (vtBase.hoverNum === 0) {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X3 = vtBase.SelectedVtObject.vtProperties.X3 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y3 = vtBase.SelectedVtObject.vtProperties.Y3 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                    var mObj3 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj3.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj2.Price;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "TrendAngle":
                        {

                            switch (vtBase.hoverNum) {
                                case 0:
                                case 1:
                                    if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                        var diffX = mdX - tempX;
                                        var diffY = mdY - tempY;
                                        vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                        vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                        var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                        var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        mdX = tempX;
                                        mdY = tempY;
                                    }
                                    break;
                                case 2:
                                    vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                        vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "FTB":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.X3A = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.x3DateA = vtBase.SelectedVtObject.DatePriceProperties.x1Date;
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.X3B = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.x3DateB = vtBase.SelectedVtObject.DatePriceProperties.x2Date;
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 3:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.X3A = tempX;
                                        var date = vtBase.ChartInstance.GetDate(tempX);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = date;
                                        vtBase.SelectedVtObject.DatePriceProperties.x3DateA = date;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 4:
                                        vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                        var price = vtBase.ChartInstance.GetPrice(tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.y3Price = price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X3A = vtBase.SelectedVtObject.vtProperties.X1;
                                    vtBase.SelectedVtObject.vtProperties.X3B = vtBase.SelectedVtObject.vtProperties.X2;
                                    vtBase.SelectedVtObject.vtProperties.Y3 = vtBase.SelectedVtObject.vtProperties.Y3 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.y3Price = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y3);
                                    vtBase.SelectedVtObject.DatePriceProperties.x3DateA = vtBase.SelectedVtObject.DatePriceProperties.x1Date;
                                    vtBase.SelectedVtObject.DatePriceProperties.x3DateB = vtBase.SelectedVtObject.DatePriceProperties.x2Date;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "Disjoint":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.X3A = tempX;
                                        if (tempY > vtBase.SelectedVtObject.vtProperties.Y1) {
                                            var diff = tempY - vtBase.SelectedVtObject.vtProperties.Y1;
                                            vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                            vtBase.SelectedVtObject.vtProperties.Y3A = vtBase.SelectedVtObject.vtProperties.Y3A - diff;
                                        } else if (tempY < vtBase.SelectedVtObject.vtProperties.Y1) {
                                            var diff = vtBase.SelectedVtObject.vtProperties.Y1 - tempY;
                                            vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                            vtBase.SelectedVtObject.vtProperties.Y3A = vtBase.SelectedVtObject.vtProperties.Y3A + diff;
                                        }
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = vtBase.ChartInstance.GetDate(vtBase.SelectedVtObject.vtProperties.X1);
                                        vtBase.SelectedVtObject.DatePriceProperties.x3DateA = vtBase.SelectedVtObject.DatePriceProperties.x1Date;
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y1);
                                        vtBase.SelectedVtObject.DatePriceProperties.y3PriceA = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y3A);
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.SelectedVtObject.AdjustVT();
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.X3B = tempX;
                                        if (tempY > vtBase.SelectedVtObject.vtProperties.Y2) {
                                            var diff = tempY - vtBase.SelectedVtObject.vtProperties.Y2;
                                            vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                            vtBase.SelectedVtObject.vtProperties.Y3B = vtBase.SelectedVtObject.vtProperties.Y3B - diff;
                                        } else if (tempY < vtBase.SelectedVtObject.vtProperties.Y2) {
                                            var diff = vtBase.SelectedVtObject.vtProperties.Y2 - tempY;
                                            vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                            vtBase.SelectedVtObject.vtProperties.Y3B = vtBase.SelectedVtObject.vtProperties.Y3B + diff;
                                        }
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = vtBase.ChartInstance.GetDate(vtBase.SelectedVtObject.vtProperties.X2);
                                        vtBase.SelectedVtObject.DatePriceProperties.x3DateB = vtBase.SelectedVtObject.DatePriceProperties.x2Date;
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.DatePriceProperties.y3PriceB = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y3B);
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.SelectedVtObject.AdjustVT();
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 3:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.X3A = tempX;
                                        if (tempY > vtBase.SelectedVtObject.vtProperties.Y3A) {
                                            var diff = tempY - vtBase.SelectedVtObject.vtProperties.Y3A;
                                            vtBase.SelectedVtObject.vtProperties.Y3A = tempY;
                                            vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diff;
                                        } else if (tempY < vtBase.SelectedVtObject.vtProperties.Y3A) {
                                            var diff = vtBase.SelectedVtObject.vtProperties.Y3A - tempY;
                                            vtBase.SelectedVtObject.vtProperties.Y3A = tempY;
                                            vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 + diff;
                                        }
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = vtBase.ChartInstance.GetDate(vtBase.SelectedVtObject.vtProperties.X1);
                                        vtBase.SelectedVtObject.DatePriceProperties.x3DateA = vtBase.SelectedVtObject.DatePriceProperties.x1Date;
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y1);
                                        vtBase.SelectedVtObject.DatePriceProperties.y3PriceA = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y3A);
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.SelectedVtObject.AdjustVT();
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 4:
                                        var diffY = mdY - tempY;
                                        vtBase.SelectedVtObject.vtProperties.Y3A = vtBase.SelectedVtObject.vtProperties.Y3A - diffY;
                                        vtBase.SelectedVtObject.vtProperties.Y3B = vtBase.SelectedVtObject.vtProperties.Y3B - diffY;
                                        vtBase.SelectedVtObject.DatePriceProperties.y3PriceB = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y3B);
                                        vtBase.SelectedVtObject.DatePriceProperties.y3PriceA = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y3A);
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.SelectedVtObject.AdjustVT();
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        mdY = tempY;
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X3A = vtBase.SelectedVtObject.vtProperties.X1;
                                    vtBase.SelectedVtObject.vtProperties.X3B = vtBase.SelectedVtObject.vtProperties.X2;
                                    vtBase.SelectedVtObject.vtProperties.Y3A = vtBase.SelectedVtObject.vtProperties.Y3A - diffY;
                                    vtBase.SelectedVtObject.vtProperties.Y3B = vtBase.SelectedVtObject.vtProperties.Y3B - diffY;
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = vtBase.ChartInstance.GetDate(vtBase.SelectedVtObject.vtProperties.X1);
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = vtBase.ChartInstance.GetDate(vtBase.SelectedVtObject.vtProperties.X2);
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y1);
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y2);
                                    vtBase.SelectedVtObject.DatePriceProperties.y3PriceA = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y3A);
                                    vtBase.SelectedVtObject.DatePriceProperties.y3PriceB = vtBase.ChartInstance.GetPrice(vtBase.SelectedVtObject.vtProperties.Y3B);
                                    vtBase.SelectedVtObject.DatePriceProperties.x3DateA = vtBase.SelectedVtObject.DatePriceProperties.x1Date;
                                    vtBase.SelectedVtObject.DatePriceProperties.x3DateB = vtBase.SelectedVtObject.DatePriceProperties.x2Date;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "8-Points":
                        if (vtBase.hoverNum !== 0) {
                            switch (vtBase.hoverNum) {
                                case 1:
                                    vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 2:
                                    vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 3:
                                    vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 4:
                                    vtBase.SelectedVtObject.vtProperties.X4 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y4 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x4Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y4Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 5:
                                    vtBase.SelectedVtObject.vtProperties.X5 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y5 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x5Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y5Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 6:
                                    vtBase.SelectedVtObject.vtProperties.X6 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y6 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x6Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y6Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 7:
                                    vtBase.SelectedVtObject.vtProperties.X7 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y7 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x7Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y7Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 8:
                                    vtBase.SelectedVtObject.vtProperties.X8 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y8 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x8Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y8Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                            }
                        }
                        else {
                            if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                var diffX = mdX - tempX;
                                var diffY = mdY - tempY;
                                for (var i = 1; i < vtBase.SelectedVtObject.Points + 1; i++) {
                                    vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                    vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                    var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                    vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                }
                                vtBase.VtDragRedrawFunction(vtBase.cID);
                                mdX = tempX;
                                mdY = tempY;
                            }
                        }
                        vtBase.ChartInstance.MouseUpEvent();
                        vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                        if (vtBase.SelectedVT !== null) {
                            return;
                        }
                        break;
                    case "HeadAndShoulders":
                        if (vtBase.hoverNum !== 0) {
                            switch (vtBase.hoverNum) {
                                case 1:
                                    vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 2:
                                    vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 3:
                                    vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 4:
                                    vtBase.SelectedVtObject.vtProperties.X4 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y4 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x4Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y4Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 5:
                                    vtBase.SelectedVtObject.vtProperties.X5 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y5 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x5Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y5Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 6:
                                    vtBase.SelectedVtObject.vtProperties.X6 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y6 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x6Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y6Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 7:
                                    vtBase.SelectedVtObject.vtProperties.X7 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y7 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x7Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y7Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                            }
                        }
                        else {
                            if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                var diffX = mdX - tempX;
                                var diffY = mdY - tempY;
                                for (var i = 1; i < vtBase.SelectedVtObject.vtProperties.Points + 1; i++) {
                                    vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                    vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                    var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                    vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                }
                                vtBase.VtDragRedrawFunction(vtBase.cID);
                                mdX = tempX;
                                mdY = tempY;
                            }
                        }
                        vtBase.ChartInstance.MouseUpEvent();
                        vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                        if (vtBase.SelectedVT !== null) {
                            return;
                        }
                        break;
                    case "PriceDateRange":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 2:
                                        vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "Label":
                        {
                            if (vtBase.hoverNum === 0) {
                                var diffX = mdX - tempX;
                                var diffY = mdY - tempY;
                                vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                vtBase.VtDragRedrawFunction(vtBase.cID);
                                mdX = tempX;
                                mdY = tempY;
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "BarsPattern":
                        {

                            if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                var diffX = mdX - tempX;
                                var diffY = mdY - tempY;
                                vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                var CurrentIndex = vtBase.ChartInstance.GetIndex(tempX);

                                if (vtBase.SelectedVtObject.Index1 === -1) {
                                    vtBase.SelectedVtObject.Index1 = vtBase.ChartInstance.GetIndex(vtBase.SelectedVtObject.vtProperties.X1);;
                                }

                                if (vtBase.SelectedVtObject.Index2 === -1) {
                                    vtBase.SelectedVtObject.Index2 = vtBase.ChartInstance.GetIndex(vtBase.SelectedVtObject.vtProperties.X2);;
                                }

                                switch (vtBase.hoverNum) {
                                    case 1:
                                        if (CurrentIndex - vtBase.SelectedVtObject.Index2 > 0 || vtBase.SelectedVtObject.Index2 === -1) {
                                            if (vtBase.SelectedVtObject.Index1 !== CurrentIndex) {
                                                var Xposition = vtBase.ChartInstance.GetXAxis(ISOStringToDate(vtBase.ChartInstance.ChartOtherProperties.ChartData[CurrentIndex].Stamp()));
                                                vtBase.SelectedVtObject.Index1 = CurrentIndex;
                                                vtBase.SelectedVtObject.vtProperties.X1 = Xposition;
                                            }
                                        }
                                        break;
                                    case 2:
                                        if (vtBase.SelectedVtObject.Index1 - CurrentIndex > 0 || vtBase.SelectedVtObject.Index1 === -1) {
                                            if (vtBase.SelectedVtObject.Index2 !== CurrentIndex) {
                                                var Xposition = vtBase.ChartInstance.GetXAxis(ISOStringToDate(vtBase.ChartInstance.ChartOtherProperties.ChartData[CurrentIndex].Stamp()));
                                                vtBase.SelectedVtObject.Index2 = CurrentIndex;
                                                vtBase.SelectedVtObject.vtProperties.X2 = Xposition;
                                            }
                                        }
                                        break;
                                    default:
                                        if (vtBase.SelectedVtObject.IsBarsHovered) {
                                            vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                            vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                            vtBase.SelectedVtObject.Index2 = vtBase.ChartInstance.GetIndex(vtBase.SelectedVtObject.vtProperties.X2);
                                            vtBase.SelectedVtObject.Index1 = vtBase.ChartInstance.GetIndex(vtBase.SelectedVtObject.vtProperties.X1);
                                        }
                                        break;
                                }



                                var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                vtBase.VtDragRedrawFunction(vtBase.cID);
                                mdX = tempX;
                                mdY = tempY;
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);

                            if (vtBase.SelectedVT !== null) {
                                return;
                            }

                        }
                        break;
                    case "Image":
                        {
                            if (vtBase.hoverNum === 0) {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                    case "Cyclic":
                        if (vtBase.hoverNum !== 0) {
                            switch (vtBase.hoverNum) {
                                case 1:
                                    vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                        vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 2:
                                    vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = tempY;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    if (vtBase.SelectedVtObject.TrendDirection !== null) {
                                        vtBase.SelectedVtObject.TrendDirection = getTrendDirection(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y1, vtBase.SelectedVtObject.vtProperties.Y2);
                                        vtBase.SelectedVtObject.R = (vtBase.SelectedVtObject.DatePriceProperties.y1Price >= vtBase.SelectedVtObject.DatePriceProperties.y2Price) ? (vtBase.SelectedVtObject.DatePriceProperties.y1Price - vtBase.SelectedVtObject.DatePriceProperties.y2Price) : (vtBase.SelectedVtObject.DatePriceProperties.y2Price - vtBase.SelectedVtObject.DatePriceProperties.y1Price);
                                    }
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                            }
                        }
                        else {
                            if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                var currentX1 = vtBase.SelectedVtObject.vtProperties.X1;
                                var currentX2 = vtBase.SelectedVtObject.vtProperties.X2;

                                var diffX = mdX - tempX;
                                var diffY = mdY - tempY;

                                //Getting Difference
                                var X1Diff = vtBase.SelectedVtObject.vtProperties.X1 - diffX
								  , Y1Diff = vtBase.SelectedVtObject.vtProperties.Y1 - diffY
								  , X2Diff = vtBase.SelectedVtObject.vtProperties.X2 - diffX
								  , Y2Diff = vtBase.SelectedVtObject.vtProperties.Y2 - diffY
								  , MouseObject1 = vtBase.ChartInstance.GetMouseObjectInfo(X1Diff, Y1Diff)
								  , MouseObject2 = vtBase.ChartInstance.GetMouseObjectInfo(X2Diff, Y2Diff)

								  , getXPoint = vtBase.ChartInstance.GetXAxis(ISOStringToDate(MouseObject1.Bar.Stamp()))
								  , getYPoint = vtBase.ChartInstance.GetYaxis(MouseObject1.Price)
                                ;

                                //var amObj1 = vtBase.ChartInstance.GetMouseObjectInfo( X1, aY1 );
                                //var amObj2 = vtBase.ChartInstance.GetMouseObjectInfo( X2, aY2 );

                                // var x = vtBase.ChartInstance.GetXAxis( ISOStringToDate( vtBase.ChartInstance.GetMouseObjectInfo(( vtBase.SelectedVtObject.vtProperties.X1 - diffX ), ( vtBase.SelectedVtObject.vtProperties.Y1 - diffY ) ).Bar.Stamp() ) );
                                if (getXPoint != vtBase.SelectedVtObject.vtProperties.X1 || getYPoint != vtBase.SelectedVtObject.vtProperties.Y1) {

                                    var absvalue = Math.abs(Math.abs(diffX) - Math.abs(vtBase.SelectedVtObject.vtProperties.X1 - getXPoint));
                                    if (absvalue < 5) {

                                        vtBase.SelectedVtObject.vtProperties.X1 = X1Diff;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = Y1Diff;
                                        vtBase.SelectedVtObject.vtProperties.X2 = X2Diff;
                                        vtBase.SelectedVtObject.vtProperties.Y2 = Y2Diff;

                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(MouseObject1.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = MouseObject1.Price;
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(MouseObject2.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = MouseObject2.Price;

                                        vtBase.VtDragRedrawFunction(vtBase.cID);

                                        mdX = tempX;
                                        mdY = tempY;

                                    }
                                    else {

                                        if (vtBase.SelectedVtObject.vtProperties.X1 != getXPoint) {

                                        }

                                        //vtBase.SelectedVtObject.vtProperties.X1 = X1;
                                        //vtBase.SelectedVtObject.vtProperties.X2 = X2;
                                        var check = "";
                                    }
                                }
                                else {

                                    var check = "";
                                }
                            }
                        }
                        vtBase.ChartInstance.MouseUpEvent();
                        vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                        if (vtBase.SelectedVT !== null) {
                            return;
                        }
                        break;
                    case "LongPosition":
                        if (vtBase.hoverNum !== 0) {
                            switch (vtBase.hoverNum) {
                                case 1:
                                    vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 2:
                                    vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, vtBase.SelectedVtObject.vtProperties.Y2);
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 3:
                                    if (tempY >= vtBase.SelectedVtObject.vtProperties.Y1) {
                                        vtBase.SelectedVtObject.SettingsValues.ProfitLevelTicks = 1;
                                    }
                                    else {
                                        vtBase.SelectedVtObject.SettingsValues.ProfitLevelTicks = Math.round(vtBase.SelectedVtObject.SettingsValues.ProfitLevelTicks + ((vtBase.SelectedVtObject.vtProperties.Y1 - vtBase.SelectedVtObject.SettingsValues.ProfitLevelTicks) - tempY));
                                    }
                                    vtBase.SelectedVtObject.vtProperties.Y3 = vtBase.SelectedVtObject.vtProperties.Y3 - vtBase.SelectedVtObject.SettingsValues.ProfitLevelTicks;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, vtBase.SelectedVtObject.vtProperties.Y3);
                                    vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 4:
                                    if (tempY <= vtBase.SelectedVtObject.vtProperties.Y1) {
                                        vtBase.SelectedVtObject.SettingsValues.StopLevelTicks = 1;
                                    }
                                    else {
                                        vtBase.SelectedVtObject.SettingsValues.StopLevelTicks = Math.round(vtBase.SelectedVtObject.SettingsValues.StopLevelTicks + (tempY - (vtBase.SelectedVtObject.vtProperties.Y1 + vtBase.SelectedVtObject.SettingsValues.StopLevelTicks)));
                                    }
                                    vtBase.SelectedVtObject.vtProperties.Y4 = vtBase.SelectedVtObject.vtProperties.Y4 + vtBase.SelectedVtObject.SettingsValues.StopLevelTicks;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, vtBase.SelectedVtObject.vtProperties.Y4);
                                    vtBase.SelectedVtObject.DatePriceProperties.y4Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                            }
                        }
                        else {
                            if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                var diffX = mdX - tempX;
                                var diffY = mdY - tempY;
                                for (var i = 1; i < vtBase.SelectedVtObject.Points + 1; i++) {
                                    vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                    vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                    var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                    vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                }
                                vtBase.VtDragRedrawFunction(vtBase.cID);
                                mdX = tempX;
                                mdY = tempY;
                            }
                        }
                        vtBase.ChartInstance.MouseUpEvent();
                        vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                        if (vtBase.SelectedVT !== null) {
                            return;
                        }
                        break;
                    case "ShortPosition":
                        if (vtBase.hoverNum !== 0) {
                            switch (vtBase.hoverNum) {
                                case 1:
                                    vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 2:
                                    vtBase.SelectedVtObject.vtProperties.X2 = tempX;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, vtBase.SelectedVtObject.vtProperties.Y2);
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 3:
                                    if (tempY >= vtBase.SelectedVtObject.vtProperties.Y1) {
                                        vtBase.SelectedVtObject.SettingsValues.StopLevelTicks = 1;
                                    }
                                    else {
                                        vtBase.SelectedVtObject.SettingsValues.StopLevelTicks = Math.round(vtBase.SelectedVtObject.SettingsValues.StopLevelTicks + ((vtBase.SelectedVtObject.vtProperties.Y1 - vtBase.SelectedVtObject.SettingsValues.StopLevelTicks) - tempY));
                                    }
                                    vtBase.SelectedVtObject.vtProperties.Y3 = vtBase.SelectedVtObject.vtProperties.Y3 - vtBase.SelectedVtObject.SettingsValues.ProfitLevelTicks;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, vtBase.SelectedVtObject.vtProperties.Y3);
                                    vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                                case 4:
                                    if (tempY <= vtBase.SelectedVtObject.vtProperties.Y1) {
                                        vtBase.SelectedVtObject.SettingsValues.ProfitLevelTicks = 1;
                                    }
                                    else {
                                        vtBase.SelectedVtObject.SettingsValues.ProfitLevelTicks = Math.round(vtBase.SelectedVtObject.SettingsValues.ProfitLevelTicks + (tempY - (vtBase.SelectedVtObject.vtProperties.Y1 + vtBase.SelectedVtObject.SettingsValues.ProfitLevelTicks)));
                                    }
                                    vtBase.SelectedVtObject.vtProperties.Y4 = vtBase.SelectedVtObject.vtProperties.Y4 + vtBase.SelectedVtObject.SettingsValues.StopLevelTicks;
                                    mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, vtBase.SelectedVtObject.vtProperties.Y4);
                                    vtBase.SelectedVtObject.DatePriceProperties.y4Price = mObj.Price;
                                    vtBase.SelectedVtObject.isSelected = true;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    break;
                            }
                        }
                        else {
                            if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                var diffX = mdX - tempX;
                                var diffY = mdY - tempY;
                                for (var i = 1; i < vtBase.SelectedVtObject.Points + 1; i++) {
                                    vtBase.SelectedVtObject.vtProperties["X" + i] = vtBase.SelectedVtObject.vtProperties["X" + i] - diffX;
                                    vtBase.SelectedVtObject.vtProperties["Y" + i] = vtBase.SelectedVtObject.vtProperties["Y" + i] - diffY;
                                    var mObj = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties["X" + i], vtBase.SelectedVtObject.vtProperties["Y" + i]);
                                    vtBase.SelectedVtObject.DatePriceProperties["x" + i + "Date"] = ISOStringToDate(mObj.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties["y" + i + "Price"] = mObj.Price;
                                }
                                vtBase.VtDragRedrawFunction(vtBase.cID);
                                mdX = tempX;
                                mdY = tempY;
                            }
                        }
                        vtBase.ChartInstance.MouseUpEvent();
                        vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                        if (vtBase.SelectedVT !== null) {
                            return;
                        }
                        break;
                    case "Arc":
                        {
                            if (vtBase.hoverNum !== 0) {
                                switch (vtBase.hoverNum) {
                                    case 1:
                                        vtBase.SelectedVtObject.vtProperties.X1 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y1 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj.Price;

                                        var mid = vtBase.SelectedVtObject.getMid({ x: vtBase.SelectedVtObject.vtProperties.X1, y: vtBase.SelectedVtObject.vtProperties.Y1 }, { x: vtBase.SelectedVtObject.vtProperties.X3, y: vtBase.SelectedVtObject.vtProperties.Y3 });
                                        vtBase.SelectedVtObject.vtProperties.X2 = mid.x, vtBase.SelectedVtObject.vtProperties.Y2 = mid.y;
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mid.x, mid.y).Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(mid.x, mid.y).Price;
                                        vtBase.SelectedVtObject.setAngle();
                                        vtBase.SelectedVtObject.DatePriceProperties.x4Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4).Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y4Price = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4).Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 3:
                                        vtBase.SelectedVtObject.vtProperties.X3 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y3 = tempY;
                                        mObj = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY);
                                        vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj.Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj.Price;

                                        var mid = vtBase.SelectedVtObject.getMid({ x: vtBase.SelectedVtObject.vtProperties.X1, y: vtBase.SelectedVtObject.vtProperties.Y1 }, { x: vtBase.SelectedVtObject.vtProperties.X3, y: vtBase.SelectedVtObject.vtProperties.Y3 });
                                        vtBase.SelectedVtObject.vtProperties.X2 = mid.x, vtBase.SelectedVtObject.vtProperties.Y2 = mid.y;
                                        vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(mid.x, mid.y).Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(mid.x, mid.y).Price;
                                        vtBase.SelectedVtObject.setAngle();
                                        vtBase.SelectedVtObject.DatePriceProperties.x4Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4).Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y4Price = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4).Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;
                                    case 4:
                                        vtBase.SelectedVtObject.vtProperties.X4 = tempX;
                                        vtBase.SelectedVtObject.vtProperties.Y4 = tempY;
                                        vtBase.SelectedVtObject.vtProperties.distance = Math.sqrt(Math.pow(vtBase.SelectedVtObject.vtProperties.X4 - vtBase.SelectedVtObject.vtProperties.X2, 2) + Math.pow(vtBase.SelectedVtObject.vtProperties.Y4 - vtBase.SelectedVtObject.vtProperties.Y2, 2));
                                        vtBase.SelectedVtObject.setAngle();
                                        vtBase.SelectedVtObject.DatePriceProperties.x4Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4).Bar.Stamp());
                                        vtBase.SelectedVtObject.DatePriceProperties.y4Price = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4).Price;
                                        vtBase.SelectedVtObject.isSelected = true;
                                        vtBase.VtDragRedrawFunction(vtBase.cID);
                                        break;

                                }
                            }
                            else {
                                if (vtBase.SelectedVT !== null && vtBase.HoveringVT === vtBase.SelectedVT) {
                                    var diffX = mdX - tempX;
                                    var diffY = mdY - tempY;
                                    vtBase.SelectedVtObject.vtProperties.X1 = vtBase.SelectedVtObject.vtProperties.X1 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y1 = vtBase.SelectedVtObject.vtProperties.Y1 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X2 = vtBase.SelectedVtObject.vtProperties.X2 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y2 = vtBase.SelectedVtObject.vtProperties.Y2 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X3 = vtBase.SelectedVtObject.vtProperties.X3 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y3 = vtBase.SelectedVtObject.vtProperties.Y3 - diffY;
                                    vtBase.SelectedVtObject.vtProperties.X4 = vtBase.SelectedVtObject.vtProperties.X4 - diffX;
                                    vtBase.SelectedVtObject.vtProperties.Y4 = vtBase.SelectedVtObject.vtProperties.Y4 - diffY;
                                    var mObj1 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X1, vtBase.SelectedVtObject.vtProperties.Y1);
                                    var mObj2 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X2, vtBase.SelectedVtObject.vtProperties.Y2);
                                    var mObj3 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X3, vtBase.SelectedVtObject.vtProperties.Y3);
                                    vtBase.SelectedVtObject.DatePriceProperties.x1Date = ISOStringToDate(mObj1.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y1Price = mObj1.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x2Date = ISOStringToDate(mObj2.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y2Price = mObj2.Price;
                                    vtBase.SelectedVtObject.DatePriceProperties.x3Date = ISOStringToDate(mObj3.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y3Price = mObj3.Price;
                                    vtBase.SelectedVtObject.setAngle();
                                    var mObj4 = vtBase.ChartInstance.GetMouseObjectInfo(vtBase.SelectedVtObject.vtProperties.X4, vtBase.SelectedVtObject.vtProperties.Y4);
                                    vtBase.SelectedVtObject.DatePriceProperties.x4Date = ISOStringToDate(mObj4.Bar.Stamp());
                                    vtBase.SelectedVtObject.DatePriceProperties.y4Price = mObj4.Price;
                                    vtBase.VtDragRedrawFunction(vtBase.cID);
                                    mdX = tempX;
                                    mdY = tempY;
                                }
                            }
                            vtBase.ChartInstance.MouseUpEvent();
                            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
                            if (vtBase.SelectedVT !== null) {
                                return;
                            }
                        }
                        break;
                }
            }
        }

        if (!IsPenDrawing && event.buttons === 0 && vtBase.vtToCreate === "Pen") {
            vtBase.Selector.css('cursor', vtBase.Cursor);
            isDrawingMode = false;
        }

        if (vtBase.lastSelectedVT !== null) {
            vtBase.ChartInstance.MouseDownEvent(mdX);
            DeselectSelectedVT(vtBase.lastSelectedVT);
        }

        if (vtBase.SelectedVtObject !== null && event.buttons === 0) {
            if (vtBase.Selector.css('cursor') !== 'default') {
                vtBase.Selector.css('cursor', vtBase.Cursor);
            }

        }
        if (!vtBase.isChartDragging && !isDrawingMode) {
            if (WC.VT.VisualToolsObjectCollection[vtBase.cID].length !== 0) {
                HighlightLine(ContainerID);
            }
        }
        if (!isDrawingMode && !vtBase.isDraggingVT) {
            if (event.buttons === 1) {
                vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
            }
            if (event.buttons === 0) {
                vtBase.ChartInstance.MouseUpEvent();
                vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);

            }
            if (!event.buttons) {
                vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
            }
            if (!vtBase.isChartDragging) {
                if (WC.VT.VisualToolsObjectCollection[vtBase.cID].length !== 0) {
                    HighlightLine(ContainerID);
                }
            }

            return;
        }

        if (vtBase.isDraggingVT && event.buttons === 0) {
            vtBase.ChartInstance.MouseUpEvent();
            vtBase.ChartInstance.MouseMoveEvent(tempX, tempY);
        }

        if (vtBase.tempVT !== null) {
            switch (vtBase.vtToCreate) {
                case 'TrendLine':
                    {
                        vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
                        vtBase.CanvasCleared = true;
                        vtBase.ctx.beginPath();
                        vtBase.ctx.moveTo(vtBase.tempVT.vtProperties.X1, vtBase.tempVT.vtProperties.Y1);
                        vtBase.ctx.lineTo(tempX, tempY);
                        vtBase.ctx.LineWidth = 1;
                        vtBase.ctx.strokeStyle = vtBase.tempVT.SettingsValues.ForeColor;
                        vtBase.ctx.stroke();
                        break;
                    }
                case "FibonacciTimezone":
                    vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
                    vtBase.tempVT.vtProperties.X2 = tempX;
                    vtBase.tempVT.vtProperties.Y2 = tempY;
                    vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY).Bar.Stamp());
                    vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY).Price;
                    vtBase.CanvasCleared = true;
                    vtBase.tempVT.isSelected = true;
                    vtBase.tempVT.DrawVT();
                    break;
                case 'Ellipse':
                    {
                        vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
                        vtBase.CanvasCleared = true;
                        vtBase.tempVT.vtProperties.X2 = tempX, vtBase.tempVT.vtProperties.Y2 = tempY;
                        vtBase.tempVT.isSelected = true;
                        vtBase.tempVT.DrawVT();
                        break;
                    }
                case "Rectangle":
                    vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
                    vtBase.CanvasCleared = true;
                    vtBase.tempVT.vtProperties.X2 = tempX;
                    vtBase.tempVT.vtProperties.Y2 = tempY;
                    vtBase.tempVT.isSelected = true;
                    vtBase.tempVT.DrawVT();
                    break;
                case 'FibonacciArc':
                    {
                        vtBase.tempVT.TrendDirection = getTrendDirection(vtBase.tempVT.vtProperties.X1, tempX, vtBase.tempVT.vtProperties.Y1, tempY);
                        vtBase.tempVT.vtProperties.X2 = tempX, vtBase.tempVT.vtProperties.Y2 = tempY;
                        vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY).Price;
                        vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
                        vtBase.CanvasCleared = true;
                        vtBase.tempVT.isSelected = true;
                        vtBase.tempVT.DrawVT();
                        break;
                    }
                case 'FibonacciFan':
                    {
                        vtBase.tempVT.TrendDirection = getTrendDirection(vtBase.tempVT.vtProperties.X1, tempX, vtBase.tempVT.vtProperties.Y1, tempY);
                        vtBase.tempVT.vtProperties.X2 = tempX, vtBase.tempVT.vtProperties.Y2 = tempY;
                        vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY).Price;
                        vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
                        vtBase.CanvasCleared = true;
                        vtBase.tempVT.isSelected = true;
                        vtBase.tempVT.DrawVT();
                        break;
                    }
                case 'GannLine':
                    {
                        vtBase.tempVT.vtProperties.X2 = tempX, vtBase.tempVT.vtProperties.Y2 = tempY;
                        vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY).Price;
                        vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
                        vtBase.CanvasCleared = true;
                        vtBase.tempVT.isSelected = true;
                        vtBase.tempVT.DrawVT();
                        break;
                    }
                case 'GannFan':
                    {
                        vtBase.tempVT.TrendDirection = getTrendDirection(vtBase.tempVT.vtProperties.X1, tempX, vtBase.tempVT.vtProperties.Y1, tempY);
                        vtBase.tempVT.vtProperties.X2 = tempX, vtBase.tempVT.vtProperties.Y2 = tempY;
                        vtBase.tempVT.DatePriceProperties.x2Date = ISOStringToDate(vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY).Bar.Stamp());
                        vtBase.tempVT.DatePriceProperties.y2Price = vtBase.ChartInstance.GetMouseObjectInfo(tempX, tempY).Price;
                        vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
                        vtBase.CanvasCleared = true;
                        vtBase.tempVT.isSelected = true;
                        vtBase.tempVT.DrawVT();
                        break;
                    }
                case 'ForexChannel':
                    {
                        vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
                        vtBase.CanvasCleared = true;
                        //vtBase.tempVT.isSelected = true;
                        vtBase.ctx.beginPath();
                        vtBase.ctx.moveTo(vtBase.tempVT.vtProperties.X1, vtBase.tempVT.vtProperties.Y1);
                        vtBase.ctx.lineTo(tempX, tempY);
                        vtBase.ctx.LineWidth = 1;
                        vtBase.ctx.strokeStyle = vtBase.tempVT.SettingsValues.ForeColor;
                        vtBase.ctx.stroke();
                    }
                    break;
            }
        }

        vtBase.VtRedrawFunction(vtBase.cID);
        //if (WC.VT.VisualToolsObjectCollection[vtBase.cID].length !== 0 && isDrawingMode) {
        //    

        //        vtBase.setToolbar(true, vtBase.SelectedVtObject.SettingsValues.ForeColor, vtBase.SelectedVtObject.SettingsValues.HighlightColor);

        //}

    }

    function vtMouseUp(event) {
        if (vtBase.vtToCreate === "Text" || vtBase.vtToCreate === "Balloon" || vtBase.vtToCreate === "Callout") {
            vtBase.ChartInstance.VisualToolsInput.focus();
        }
        if (vtBase.vtToCreate === "Note") {
            vtBase.ChartInstance.VisualToolsInput.focus();
        }
        vtBase.ChartInstance.MouseUpEvent();
        isDown = false;
        vtBase.isHoveringEndpoint = false;
        if (vtBase.SelectedVtObject !== null) {
            vtBase.SelectedVtObject.isHovered = false;
            vtBase.VtRedrawFunction(vtBase.cID);
            UpdateSessionObject();
            vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
        }
    }

    function UpdateSessionObject() {
        if (vtBase.tempVT === null) {
            var count = vtBase.ChartDisplay.ActiveVisualTools.length;
            for (var i = 0; i < count; i++) {
                if (vtBase.SelectedVtObject.vtID === vtBase.ChartDisplay.ActiveVisualTools[i].ID) {
                    for (var ii in vtBase.SelectedVtObject.DatePriceProperties) {
                        if (ii === "TextInput") { vtBase.ChartDisplay.ActiveVisualTools[i].Properties[ii] = vtBase.SelectedVtObject.SettingsValues.TextInput; continue; }
                        vtBase.ChartDisplay.ActiveVisualTools[i].Properties[ii] = (Contains(ii, "Date")) ? ((vtBase.SelectedVtObject.DatePriceProperties[ii] instanceof Date) ? vtBase.SelectedVtObject.DatePriceProperties[ii].getTime() : vtBase.SelectedVtObject.DatePriceProperties[ii]) : vtBase.SelectedVtObject.DatePriceProperties[ii];
                    }
                    break;
                }
            }
        }
    }

    $(document).on('keydown', HotkeyDown);

    function HotkeyDown(e) {
        if (WC.VT.ActiveChart === vtBase.cID) {

            if (e.altKey === true || e.ctrlKey === true || e.shiftKey === true) {
                if (e.ctrlKey === true && e.keyCode === 67) {
                    if (vtBase.SelectedVtObject !== null) {
                        WC.VT.CopyVisualTool = vtBase.SelectedVtObject.vtInfo.vtName;
                        WC.VT.CopyVisualToolProperty = vtBase.SelectedVtObject.vtProperties;
                        if (WC.VT.CopyVisualTool === "Text" || WC.VT.CopyVisualTool === "Note" || WC.VT.CopyVisualTool === "Balloon" || vtBase.vtToCreate === "Callout") {
                            WC.VT.CopyVisualToolProperty.TextInput = vtBase.SelectedVtObject.SettingsValues.TextInput;
                        }
                        if (WC.VT.CopyVisualTool === "Pen") {
                            WC.VT.CopyVisualTool = null;
                        }

                        WC.VT.CopyVisualToolSettings = vtBase.SelectedVtObject.SettingsValues;
                    }
                }
                if (e.ctrlKey === true && e.keyCode === 86) {
                    if (WC.VT.CopyVisualTool !== null) {
                        var cVT = new WC.VT[WC.VT.CopyVisualTool](WC.VT.ChartInstanceCollection[WC.VT.ActiveChart][0], GenerateID(), WC.VT.ActiveChart);
                        var prop = Object.getOwnPropertyNames(cVT.vtProperties).sort();
                        var count = prop.length, ii = 0;

                        for (var i in WC.VT.CopyVisualToolProperty) {
                            if (typeof (WC.VT.CopyVisualToolProperty[i]) !== "function") {
                                cVT.vtProperties[i] = WC.VT.CopyVisualToolProperty[i];
                            }
                        }
                        WC.VT.VisualToolsObjectCollection[WC.VT.ActiveChart].push(cVT);
                        vtBase.AdjustCopiedVT(WC.VT.ActiveChart, cVT.vtID);
                        cVT.SettingsValues = WC.VT.CopyVisualToolSettings;
                        vtBase.VtRedrawFunction(WC.VT.ActiveChart);

                        vtBase.ChartDisplay.ActiveVisualTools.push({ Key: cVT.vtInfo.vtName, ID: cVT.vtID, Settings: cVT.SettingsValues, Properties: setProperty(cVT.vtID) });
                        vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);

                        cVT = null;
                    }
                }
                return;
            }
            if (e.keyCode === 46) {
                var count = WC.VT.VisualToolsObjectCollection[vtBase.cID].length;
                if (count === 1) {
                    if (WC.VT.VisualToolsObjectCollection[vtBase.cID][0].isSelected) {
                        RemoveVT(WC.VT.VisualToolsObjectCollection[vtBase.cID][0].vtID);
                        vtBase.SelectedVT = null;
                        vtBase.HoveringVT = null;
                        vtBase.isDraggingVT = false;
                        vtBase.Selector.css('cursor', vtBase.Cursor);
                        vtBase.setToolbar(false, '#909090', '#909090');
                        return;
                    }
                } else if (count > 1) {
                    for (var i = 0; i < count; i++) {
                        if (WC.VT.VisualToolsObjectCollection[vtBase.cID][i].isSelected) {
                            RemoveVT(WC.VT.VisualToolsObjectCollection[vtBase.cID][i].vtID);
                            vtBase.SelectedVT = null;
                            vtBase.HoveringVT = null;
                            vtBase.isDraggingVT = false;
                            vtBase.Selector.css('cursor', vtBase.Cursor);
                            vtBase.setToolbar(false, '#909090', '#909090');
                            return;
                        }
                    }
                }
            }
        }
    }

    vtBase.ChartInstance.VisualToolsCanvas.ondblclick = function () {
        //  alert(vtBase.cID);
        if (vtBase.HoveringVT !== null) {
            if (vtBase.SelectedVtObject.BaseType !== "Image") {
                vtBase.ChartInstance.ParentELement.trigger("TriggerSettings", [vtBase.HoveringVT]);
            }
        }
    };

    vtBase.ChartInstance.VisualToolsInput.onkeydown = function () { ResizeInput() };

    function ResizeInput() {
        if (vtBase.vtToCreate === "Text" || vtBase.vtToCreate === "Balloon" || vtBase.vtToCreate === "Callout") {
            if (vtBase.ChartInstance.VisualToolsInput.value.length !== 0) {
                vtBase.ChartInstance.VisualToolsInput.size = vtBase.ChartInstance.VisualToolsInput.value.length;
            }
        }
    }
    vtBase.ChartInstance.VisualToolsInput.onkeyup = function () { GetTyped() };
    //vtBase.ChartInstance.VisualToolsInput.onkeypress = function () { GetTyped() };

    function GetTyped() {
        if (vtBase.vtToCreate === "Note") {
            vtBase.tempVT.SettingsValues.TextInput = vtBase.ChartInstance.VisualToolsInput.value;
            vtBase.VtRedrawFunction(WC.VT.ActiveChart);
        }
    }


    function getTrendDirection(x1, x2, y1, y2) {
        var ret = (((y1 - y2) / (x1 - x2)) < 0) ? "Up" : "Down";

        return ret;
    }

    function LoadSessionData(count) {
        vtBase.ChartDisplay.ActiveVisualTools = [];
        for (var i = 0; i < count; i++) {
            var item = vtBase.VisualToolSessionCollection[i];
            var cVT = new WC.VT[item.Key](WC.VT.ChartInstanceCollection[vtBase.cID][0], GenerateID(), vtBase.cID);
            //var prop = Object.getOwnPropertyNames(cVT.vtProperties).sort();
            //var count = prop.length, ii = 0;
            if (cVT.BaseType === "Pen") {
                var len = item.Properties.currentPath.length;
                for (var iii = 0; iii < len; iii++) {
                    cVT.currentPath.push({
                        Date: new Date(item.Properties.currentPath[iii].Date),
                        Price: item.Properties.currentPath[iii].Price
                    });
                }
            } else {
                for (var ii in item.Properties) {
                    cVT.DatePriceProperties[ii] = (Contains(ii, "Date")) ? (new Date(item.Properties[ii])) : item.Properties[ii];
                }
            }

            if (cVT.BaseType === "BarsPattern") {
                cVT.isDoneGettingIndex = false;

            }
            //vtBase.VisualToolSessionCollection.splice(i, 1);
            cVT.SettingsValues = item.Settings;
            WC.VT.VisualToolsObjectCollection[vtBase.cID].push(cVT);
            //vtBase.AdjustCopiedVT(WC.VT.ActiveChart, cVT.vtID);
            vtBase.VtRedrawFunction(vtBase.cID);
            if (cVT.BaseType === "BarsPattern") {
                cVT.isDoneGettingIndex = true;
                vtBase.VtRedrawFunction(vtBase.cID);
            }
            vtBase.ChartDisplay.ActiveVisualTools.push({ Key: cVT.vtInfo.vtName, ID: cVT.vtID, Settings: cVT.SettingsValues, Properties: setProperty(cVT.vtID) });
            vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
            cVT = null;
        }
        vtBase.VisualToolSessionCollection = [];
    }

    function setProperty(ID) {
        var properties = {};
        var vCount = WC.VT.VisualToolsObjectCollection[vtBase.cID].length;
        for (var i = 0; i < vCount; i++) {
            if (WC.VT.VisualToolsObjectCollection[vtBase.cID][i].vtID === ID) {
                if (WC.VT.VisualToolsObjectCollection[vtBase.cID][i].BaseType === "Pen") {
                    var cp = [];
                    var len = WC.VT.VisualToolsObjectCollection[vtBase.cID][i].currentPath.length;
                    for (var iii = 0; iii < len; iii++) {
                        cp.push(
							{
							    Date: WC.VT.VisualToolsObjectCollection[vtBase.cID][i].currentPath[iii].Date.getTime(),
							    Price: WC.VT.VisualToolsObjectCollection[vtBase.cID][i].currentPath[iii].Price
							});
                    }
                    properties["currentPath"] = cp;
                } else {
                    for (var ii in WC.VT.VisualToolsObjectCollection[vtBase.cID][i].DatePriceProperties) {
                        if (WC.VT.VisualToolsObjectCollection[vtBase.cID][i].BaseType === "Text" && ii === "TextInput" || WC.VT.VisualToolsObjectCollection[vtBase.cID][i].BaseType === "Note" && ii === "TextInput" || WC.VT.VisualToolsObjectCollection[vtBase.cID][i].BaseType === "Balloon" && ii === "TextInput") {
                            properties[ii] = WC.VT.VisualToolsObjectCollection[vtBase.cID][i].SettingsValues.TextInput;
                            continue;
                        }
                        properties[ii] = (WC.VT.VisualToolsObjectCollection[vtBase.cID][i].DatePriceProperties[ii] instanceof Date) ? WC.VT.VisualToolsObjectCollection[vtBase.cID][i].DatePriceProperties[ii].getTime() : WC.VT.VisualToolsObjectCollection[vtBase.cID][i].DatePriceProperties[ii];
                    }
                }
            }
        }

        return properties;
    }

    function Contains(str, strToCheck) {
        var m = str.indexOf(strToCheck);
        var a;
        if (m >= 0) {
            a = true;
        } else {
            a = false;
        }
        return a;
    }

    function RemoveVT(ID) {
        vtBase.ChartInstance.ParentELement.trigger("TriggerSettingsClose", [ID, "Remove"]);
        WC.VT.VisualToolsObjectCollection[ContainerID].splice(getObjectIndex(ID), 1);
        vtBase.SelectedVtObject = null;
        if (WC.VT.VisualToolsObjectCollection[ContainerID].length === 0) {
            vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
        } else {
            vtBase.VtRedrawFunction(ContainerID);
        }
        var count = vtBase.ChartDisplay.ActiveVisualTools.length;
        if (count !== 0) {
            for (var i = 0; i < count; i++) {
                if (vtBase.ChartDisplay.ActiveVisualTools[i].ID === ID) {
                    vtBase.ChartDisplay.ActiveVisualTools.splice(i, 1);
                    vtBase.ChartDisplay.ParentElement.trigger("ChartSettingsChanged", [vtBase.ChartInstance.GetAllSettingsProperty(), vtBase.ChartInstance]);
                    break;
                }
            }
        }
    }
    function CheckBarsPatternHovered(obj, X, Y) {
        if (X >= obj.vtProperties.X1 && X <= obj.vtProperties.X2) {
            var TempX = X - obj.vtProperties.X1;
            var Index = obj.BarsCollection.length - 1 - Math.round(TempX / obj.TempBarSpace);
            var HighPx = vtBase.ChartInstance.GetYaxis(obj.BarsCollection[Index].High + obj.AllowancePips);
            var LowPx = vtBase.ChartInstance.GetYaxis(obj.BarsCollection[Index].Low + obj.AllowancePips);
            if (Y >= HighPx && Y <= LowPx) {
                return true;
            }
        }
        return false;
    }
    vtBase.VtRedrawFunction = function (contID) {
        var obj;
        var count = WC.VT.VisualToolsObjectCollection[contID].length;
        if (count !== 0) {
            if (!vtBase.CanvasCleared) {
                vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
            }
            for (var i = 0; i < count; i++) {
                obj = WC.VT.VisualToolsObjectCollection[contID][i];
                if (obj.DatePriceProperties === undefined) {
                    obj.AdjustVT();
                    obj.DrawVT();
                    continue;
                }
                if (obj.DatePriceProperties.x1Date !== null && obj.DatePriceProperties.x2Date !== null) {
                    obj.AdjustVT();
                }
                obj.DrawVT();
            }

        }
        vtBase.CanvasCleared = false;
        obj = null;
    }

    vtBase.AdjustCopiedVT = function (cID, vtID) {
        var obj;
        var count = WC.VT.VisualToolsObjectCollection[cID].length;
        for (var i = 0; i < count; i++) {
            obj = WC.VT.VisualToolsObjectCollection[cID][i];
            if (obj.vtID === vtID) {
                obj.vtProperties.setProperties();
            }
        }
    }



    vtBase.VtDragRedrawFunction = function (contID) {
        var obj;
        var count = WC.VT.VisualToolsObjectCollection[contID].length;
        if (count !== 0) {
            if (!vtBase.CanvasCleared) {
                vtBase.ctx.canvas.width = vtBase.ctx.canvas.width;
            }
            for (var i = 0; i < count; i++) {
                obj = WC.VT.VisualToolsObjectCollection[contID][i];

                obj.DrawVT();
            }
        }
        vtBase.CanvasCleared = false;
        obj = null;
    }

    vtBase.VtUpdateFunction = function (contID, UpdateType) {
        var count = WC.VT.VisualToolsObjectCollection[contID].length;
        if (count !== 0) {
            for (var i = 0; i < count; i++) {
                if (UpdateType === "FrontDataAdded") {
                    WC.VT.VisualToolsObjectCollection[contID][i].AdjustVT();
                    WC.VT.VisualToolsObjectCollection[contID][i].DrawVT();
                }
            }
        }
    }

    vtBase.ChartInstance.ParentELement.on("FrontDataAdded", {
    }, function (event, IndicatorTopCanvas, IndicatorBotCanvas, BarsData, ChartObject) {
        if (ContainerID !== undefined) {
            vtBase.VtUpdateFunction(ContainerID, "FrontDataAdded");
        }
    });

    vtBase.ChartInstance.ParentELement.on("ChartAfterDraw", {
    }, function (event, VisualToolsContext, IndicatorTopCanvas, IndicatorBotCanvas, BarsData, ChartObject) {
        if (ContainerID !== undefined) {
            if (BarsData.length !== 0) {
                vtBase.VtRedrawFunction(ContainerID);
                var count = vtBase.VisualToolSessionCollection.length;
                if (count !== 0) {
                    LoadSessionData(count);
                }
            }
            if (vtBase.tempVT !== null) {
                vtBase.tempVT.DrawVT();
            }
        }
    });

    vtBase.ChartInstance.ParentELement.on("ChartMouseWheel", {
    }, function (event, VisualToolsContext, IndicatorTopCanvas, IndicatorBotCanvas, BarsDate, ChartObject) {

    });

    vtBase.ChartInstance.ParentELement.on("SymbolChanged", {
    }, function (event, VisualToolsCanvas, IndicatorTopCanvas, IndicatorBotCanvas, BarsData, ChartObject) {
        if (ContainerID !== undefined) {
            vtBase.RemoveAllVisualTools();
        }
    });

    vtBase.ChartInstance.ParentELement.on("TimeFrameChanged", {
    }, function (event, VisualToolsCanvas, IndicatorTopCanvas, IndicatorBotCanvas, BarsData, ChartObject) {
        if (ContainerID !== undefined) {
            //vtBase.RemoveAllVisualTools();
        }
    });

    vtBase.ChartDisplay.ParentElement.on("ChartActivated", {
    }, function (event, ChartInstance, Menu, Variable) {
        WC.VT.ActiveChart = event.currentTarget.id;
    });
};

function SnapToPrice(price, high, low, open, close) {
    var arr = [high, low, open, close];
    var ret = null, diff = null, diffTc;
    for (var i = 0; i < 4; i++) {
        if (ret === null) {
            diff = Math.abs((price - arr[i]));
            diffTc = diff;
            ret = arr[i];
        } else {
            diffTc = Math.abs((price - arr[i]));
            if (diffTc < diff) {
                diff = diffTc;
                ret = arr[i];
            }
        }
    }

    return ret;
}

function GenerateID() {
    var date = new Date().getTime();
    var genID = 'XXXXXXXXXX'.replace(/[X]/g, function (e) {
        var random = (date + Math.random() * 32) % 32 | 0;
        var RetVal = (e === 'X' ? random : (random & 0x3 | 0x8)).toString(32);
        e = null; event = null;
        return RetVal;
    });
    date = null;
    return genID;
}

function isInt(n) {
    return n % 1 === 0;
}

function hexToRGBA(color, opacity) {
    var strHex = color.replace(/'/g, '"');
    var hex = (strHex.charAt(0) === "#" ? strHex.substring(1) : strHex);
    var r = parseInt(hex.substring(0, 2), 16);
    var g = parseInt(hex.substring(2, 4), 16);
    var b = parseInt(hex.substring(4, 6), 16);

    var rgba = 'rgba(' + r + ',' + g + ',' + b + ',' + opacity + ')';

    return rgba;
}

function ExtendToInfinity(originX, originY, slope, extendTo, cID, ValueToCompute) {
    var ComputedValue;
    switch (ValueToCompute) {
        case 'x':
            {
                var b = (originY - (slope * originX));
                ComputedValue = (extendTo - b) / slope;
            }
            break;
        case 'y':
            {
                var b = (originY - (slope * originX));
                ComputedValue = slope * extendTo + b;
            }
            break;
    }

    return ComputedValue;
}

function GetIntersectionPoints(obj, ChartInstance) {
    var x1 = obj.vtProperties.X1;
    var x2 = obj.vtProperties.X2;
    var x3 = obj.vtProperties.X3;
    var x4 = obj.vtProperties.X4;
    var y1 = obj.vtProperties.Y1;
    var y2 = obj.vtProperties.Y2;
    var y3 = obj.vtProperties.Y3;
    var y4 = obj.vtProperties.Y4;
    var Index1 = ChartInstance.GetIndex(x1);
    var Index2 = ChartInstance.GetIndex(x2);
    var Point1 = null;
    var Point2 = null;
    if (Index2 > Index1) {
        var temp = Index1;
        Index1 = Index2;
        Index2 = temp;
    }

    for (var i = Index1; i >= Index2; i--) {
        var YHigh = ChartInstance.GetYaxis(ChartInstance.ChartOtherProperties.ChartData[i].High());
        var YLow = ChartInstance.GetYaxis(ChartInstance.ChartOtherProperties.ChartData[i].Low());
        var X = ChartInstance.GetXAxis(ISOStringToDate(ChartInstance.ChartOtherProperties.ChartData[i].Stamp()));
        var InterSectionPoint1 = null;
        if (Point1 === null) {
            InterSectionPoint1 = ComputeIntersection(X, YHigh, X, YLow, x1, y1, x2, y2);
        }

        if (InterSectionPoint1) {
            Point1 = InterSectionPoint1;
            continue;
        }
        if (Point1 === null) {
            continue;
        }

        var InterSectionPoint2 = ComputeIntersection(X, YHigh, X, YLow, x1, y3, x2, y3);

        if (InterSectionPoint2) {
            Point2 = InterSectionPoint2;
            if (Point1 !== null && Point2 !== null) {
                return { Point1: Point1, Point2: Point2 };
            }
        }

        InterSectionPoint2 = ComputeIntersection(X, YHigh, X, YLow, x2, y2, x2, y3);

        if (InterSectionPoint2) {
            Point2 = InterSectionPoint2;
            if (Point1 !== null && Point2 !== null) {
                return { Point1: Point1, Point2: Point2 };
            }
        }

        InterSectionPoint2 = ComputeIntersection(X, YHigh, X, YLow, x1, y4, x2, y4);

        if (InterSectionPoint2) {
            Point2 = InterSectionPoint2;
            if (Point1 !== null && Point2 !== null) {
                return { Point1: Point1, Point2: Point2 };
            }
        }

        InterSectionPoint2 = ComputeIntersection(X, YHigh, X, YLow, x2, y2, x2, y4);

        if (InterSectionPoint2) {
            Point2 = InterSectionPoint2;
            if (Point1 !== null && Point2 !== null) {
                return { Point1: Point1, Point2: Point2 };
            }
        }

    }

    if (Point1 !== null && Point2 === null) {
        var YPoint = ChartInstance.GetYaxis(ChartInstance.ChartOtherProperties.ChartData[Index2].Close());
        if (YPoint >= y3 && YPoint <= y4) {
            return { Point1: Point1, Point2: { XPoint: ChartInstance.GetXAxis(ISOStringToDate(ChartInstance.ChartOtherProperties.ChartData[Index2].Stamp())), YPoint: YPoint }, Trend: "Down" };
        }
    }

    return false;
}


WC.VT.isMouseOverLine = function (x1, y1, x2, y2, xToCheck, yToCheck, Allowance) {
    var x = x1 - x2;
    var y = y1 - y2;
    var m = y / x;
    if (Math.abs(m) === Infinity || isNaN(m)) {
        var max = Math.max(y1, y2);
        var min = Math.min(y1, y2);
        if ((Math.abs(xToCheck - x1) < Allowance && yToCheck < (max + Allowance)) && yToCheck > (min - Allowance)) {
            return true;
        }
    }
    var yTC = parseInt(yToCheck - y1);
    var xTC = parseInt(m * (xToCheck - x1))
    var z = (Math.abs(yTC - xTC) <= Allowance) ? true : false;
    var c = (yTC >= y2) ? false : true;
    if (z === true && c === false) {
        if (y1 >= 0) {
            z = false;
        }
        if (y1 < 0) {
            z = true;
        }
    }

    if (z) {
        var PointRight, PointLeft;
        if (x1 > x2) {
            PointRight = x1;
            PointLeft = x2;
        } else {
            PointRight = x2;
            PointLeft = x1;
        }

        if (xToCheck > PointRight + Allowance) {
            z = false;
        }

        if (xToCheck < PointLeft - Allowance) {
            z = false;
        }
    }
    return z;
}

WC.VT.drawString = function (Str, X, Y, Font, FontSize, FontColor, Alignment, ContainerID) {
    var ctx = WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0];
    ctx.font = FontSize + " " + Font;
    ctx.textAlign = (Alignment !== null) ? Alignment : "left";
    ctx.fillStyle = FontColor;
    ctx.fillText(Str, X, Y);
}

WC.VT.drawCircleEndpoint = function (x, y, rad, cID, StrokeStyle) {
    var ctx = WC.VT.ctxVisualToolsCanvasCollection[cID][0];
    ctx.setLineDash([]);
    ctx.beginPath();
    ctx.arc(x, y, rad, 0, 2 * Math.PI, false);
    ctx.strokeStyle = (StrokeStyle === undefined) ? '#000000' : StrokeStyle;
    ctx.fillStyle = 'white';
    ctx.fill();
    ctx.lineWidth = 1;
    ctx.stroke();
}

WC.VT.drawLetter = function (letter, x, y, color, cID) {
    var ctx = WC.VT.ctxVisualToolsCanvasCollection[cID][0];
    ctx.setLineDash([]);
    ctx.fill();
    ctx.fillStyle = color;
    ctx.fillText(letter, x - 3, y - 8);
}

WC.VT.drawLine = function (x1, y1, x2, y2, cID) {
    var ctx = WC.VT.ctxVisualToolsCanvasCollection[cID][0];
    ctx.beginPath();
    ctx.setLineDash([]);
    ctx.moveTo(x1, y1);
    ctx.lineTo(x2, y2);
    ctx.lineJoin = 'round';
    ctx.stroke();
    ctx.closePath();

}

WC.VT.TrendLine = function (ChartInstance, vtID, ContainerID) {

    var self = this;
    self.ContainerID = ContainerID;
    self.isSelected = false;
    var ctx = WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0];
    self.vtInfo = {
        vtName: "TrendLine",
        vtProperName: "Trend Line",
        vtCodeName: "Trend_Line"
    };

    self.SettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.vtInfo.vtProperName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" style="float: right; border: none; color:#CCC ;background-color:#555; height: 13px; line-height: 15px; font-weight: bold; font-family: Verdana; width: 20px;">x</button></div></div>');
    self.Points = 2;
    self.BaseType = "Line";

    self.isHovered = false;

    self.SettingsValues = {
        // ExtendToInfinity: false,
        ForeColor: '#0000CD',
        HighlightColor: '#FF1493',
        LineWidth: 1,
        HighlightWidth: 4,
        //   SnapToPrice: false
    };

    self.SettingsObject = {
        // ExtendToInfinity: { group: self.vtInfo.vtProperName, name: "Extend to Infinity", type: "option", options: [true, "False"] },
        ForeColor: { group: self.vtInfo.vtProperName, name: "Fore Color", type: "color", options: { preferformat: "hex" } },
        HighlightColor: { group: self.vtInfo.vtProperName, name: "Highlight Color", type: "color", options: { preferformat: "hex" } },
        LineWidth: { group: self.vtInfo.vtProperName, name: "Line Width", type: "number", options: { min: 1, max: 20 } },
        HighlightWidth: { group: self.vtInfo.vtProperName, name: "Highlight Width", type: "number", options: { min: 1, max: 20 } },
        // SnapToPrice: { group: self.vtInfo.vtProperName, name: "Snap to Price", type: "option", options: ["True", "False"] }
    };

    //    

    self.vtID = "TrendLine-" + vtID;

    self.x1Date = null;
    self.x2Date = null;
    self.y1Price = null;
    self.y2Price = null;

    self.DatePriceProperties = {
        x1Date: null,
        x2Date: null,
        y1Price: null,
        y2Price: null
    };

    self.vtProperties = {
        X1: null,
        X2: null,
        Y1: null,
        Y2: null,
        setProperties: function () {
            var p = this;
            self.DatePriceProperties.x1Date = ChartInstance.GetDate(p.X1);
            self.DatePriceProperties.x2Date = ChartInstance.GetDate(p.X2);
            self.DatePriceProperties.y1Price = ChartInstance.GetPrice(p.Y1);
            self.DatePriceProperties.y2Price = ChartInstance.GetPrice(p.Y2);
            p = null;
        }
    };

    self.X1 = null;
    self.X2 = null;
    self.Y1 = null;
    self.Y2 = null;

    self.AdjustVT = function () {
        if (true) { // self.SettingsValues.SnapToPrice !== true
            if (self.DatePriceProperties.x1Date !== null || self.DatePriceProperties.x2Date !== null) {
                if (!false) { //!self.SettingsValues.SnapToPrice
                    self.vtProperties.X1 = ChartInstance.GetXAxis(self.DatePriceProperties.x1Date);
                    self.vtProperties.X2 = ChartInstance.GetXAxis(self.DatePriceProperties.x2Date);
                    self.vtProperties.Y1 = ChartInstance.GetYaxis(self.DatePriceProperties.y1Price);
                    self.vtProperties.Y2 = ChartInstance.GetYaxis(self.DatePriceProperties.y2Price);
                    // self.DrawVT();
                } else {

                }
            }

        }
    }

    self.DrawVT = function () {
        if (ChartInstance.ChartOtherProperties.ChartData.length > 0) {
            if (!self.isSelected) {
                ctx.beginPath();
                ctx.setLineDash([]);
                ctx.moveTo(self.vtProperties.X1, self.vtProperties.Y1);
                ctx.lineTo(self.vtProperties.X2, self.vtProperties.Y2);
                ctx.lineWidth = (self.isHovered) ? self.SettingsValues.HighlightWidth : self.SettingsValues.LineWidth;
                ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
                ctx.lineJoin = 'round';
                ctx.lineCap = 'round';
                ctx.stroke();
                if (self.isHovered) {
                    WC.VT.drawCircleEndpoint(self.vtProperties.X1, self.vtProperties.Y1, 5, self.ContainerID);
                    WC.VT.drawCircleEndpoint(self.vtProperties.X2, self.vtProperties.Y2, 5, self.ContainerID);
                }
            } else {
                ctx.beginPath();
                ctx.setLineDash([]);
                ctx.moveTo(self.vtProperties.X1, self.vtProperties.Y1);
                ctx.lineTo(self.vtProperties.X2, self.vtProperties.Y2);
                ctx.lineWidth = (self.isHovered) ? self.SettingsValues.HighlightWidth : self.SettingsValues.LineWidth;
                ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
                ctx.lineJoin = 'round';
                ctx.lineCap = 'round';
                ctx.stroke();

                WC.VT.drawCircleEndpoint(self.vtProperties.X1, self.vtProperties.Y1, 5, self.ContainerID);
                WC.VT.drawCircleEndpoint(self.vtProperties.X2, self.vtProperties.Y2, 5, self.ContainerID);
            }
        }
    }
};

WC.VT.Ellipse = function (ChartInstance, vtID, ContainerID) {
    var self = this;
    self.ContainerID = ContainerID;
    self.isSelected = false;
    var ctx = WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0];
    self.vtInfo = {
        vtName: "Ellipse",
        vtProperName: "Ellipse",
        vtCodeName: "Ellipse"
    };

    self.SettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.vtInfo.vtProperName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" style="float: right; border: none; color:#CCC ;background-color:#555; height: 13px; line-height: 15px; font-weight: bold; font-family: Verdana; width: 20px;">x</button></div></div>');

    self.BaseType = "Polygon";
    self.isHovered = false;

    self.SettingsValues = {
        // ExtendToInfinity: false,
        ForeColor: '#0000CD',
        HighlightColor: '#FF1493',
        // HighlightWidth: 4,
        LineWidth: 1,
        //  SnapToPrice: false
    };

    self.SettingsObject = {
        //  ExtendToInfinity: { group: self.vtInfo.vtProperName, name: "Extend to Infinity", type: "option", options: [true, "False"] },
        ForeColor: { group: self.vtInfo.vtProperName, name: "Fore Color", type: "color", options: { preferformat: "hex" } },
        HighlightColor: { group: self.vtInfo.vtProperName, name: "Highlight Color", type: "color", options: { preferformat: "hex" } },
        //  HighlightWidth: { group: self.vtInfo.vtProperName, name: "Highlight Width", type: "number", options: { min: 1, max: 20 } },
        LineWidth: { group: self.vtInfo.vtProperName, name: "Line Width", type: "number", options: { min: 1, max: 20 } },
        // SnapToPrice: { group: self.vtInfo.vtProperName, name: "Snap to Price", type: "option", options: ["True", "False"] }
    };

    //    

    self.vtID = "Ellipse-" + vtID;

    self.x1Date = null;
    self.x2Date = null;
    self.y1Price = null;
    self.y2Price = null;
    self.midXDate = null;
    self.midYDate = null;

    self.X1 = null;
    self.X2 = null;
    //self.midX = null;
    //self.midY = null;
    self.Y1 = null;
    self.Y2 = null;

    self.DatePriceProperties = {
        x1Date: null,
        x2Date: null,
        y1Price: null,
        y2Price: null
    };

    var minX, minY, maxX, maxY;

    self.vtProperties = {
        X1: null,
        X2: null,
        Y1: null,
        Y2: null,
        setProperties: function () {
            var p = this;
            self.x1Date = ChartInstance.GetDate(p.X1);
            self.x2Date = ChartInstance.GetDate(p.X2);
            self.y1Price = ChartInstance.GetPrice(p.Y1);
            self.y2Price = ChartInstance.GetPrice(p.Y2);
            p = null;
        }
    };

    self.vtProp = {
        A: { x: null, y: null },
        B: { x: null, y: null },
        C: { x: null, y: null },
        D: { x: null, y: null },
        E: { x: null, y: null },
        F: { x: null, y: null },
        G: { x: null, y: null },
        H: { x: null, y: null },
        mid: { x: null, y: null },
        dist: { x: null, y: null }
    };

    function setProp() {

        self.vtProp.A.x = self.vtProperties.X1, self.vtProp.A.y = self.vtProperties.Y1;
        self.vtProp.E.x = self.vtProperties.X2, self.vtProp.E.y = self.vtProperties.Y2;

        self.vtProp.mid.x = (self.vtProp.A.x + self.vtProp.E.x) / 2;
        self.vtProp.mid.y = (self.vtProp.A.y + self.vtProp.E.y) / 2;
        self.vtProp.dist.x = Math.abs(self.vtProp.A.x - self.vtProp.E.x) / 2;
        self.vtProp.dist.y = Math.abs(self.vtProp.A.y - self.vtProp.E.y) / 2;
        self.vtProp.B.x = self.vtProp.mid.x, self.vtProp.B.y = self.vtProp.A.y;
        self.vtProp.C.x = self.vtProp.E.x, self.vtProp.C.y = self.vtProp.A.y;
        self.vtProp.D.x = self.vtProp.E.x, self.vtProp.D.y = self.vtProp.mid.y;
        self.vtProp.F.x = self.vtProp.mid.x, self.vtProp.F.y = self.vtProp.E.y;
        self.vtProp.G.x = self.vtProp.A.x, self.vtProp.G.y = self.vtProp.E.y;
        self.vtProp.H.x = self.vtProp.A.x, self.vtProp.H.y = self.vtProp.mid.y;
        //    
    }

    self.AdjustVT = function () {
        if (true) { // self.SettingsValues.SnapToPrice !== true
            if (self.DatePriceProperties.x1Date !== null || self.DatePriceProperties.x2Date !== null) {
                if (true) { //!self.SettingsValues.SnapToPrice
                    self.vtProperties.X1 = ChartInstance.GetXAxis(self.DatePriceProperties.x1Date);
                    self.vtProperties.X2 = ChartInstance.GetXAxis(self.DatePriceProperties.x2Date);
                    self.vtProperties.Y1 = ChartInstance.GetYaxis(self.DatePriceProperties.y1Price);
                    self.vtProperties.Y2 = ChartInstance.GetYaxis(self.DatePriceProperties.y2Price);
                }
            }
        }
    }

    self.DrawVT = function () {
        if (ChartInstance.ChartOtherProperties.ChartData.length > 0) {
            setProp();
            if (!self.isSelected) {
                ctx.beginPath();
                ctx.setLineDash([]);
                ctx.ellipse(self.vtProp.mid.x, self.vtProp.mid.y, self.vtProp.dist.x, self.vtProp.dist.y, 0, 0, 2 * Math.PI);
                ctx.lineWidth = self.SettingsValues.LineWidth;
                ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
                ctx.stroke();
                if (self.isHovered) {
                    WC.VT.drawCircleEndpoint(self.vtProp.A.x, self.vtProp.A.y, 2, self.ContainerID);
                    WC.VT.drawCircleEndpoint(self.vtProp.B.x, self.vtProp.B.y, 2, self.ContainerID);
                    WC.VT.drawCircleEndpoint(self.vtProp.C.x, self.vtProp.C.y, 2, self.ContainerID);
                    WC.VT.drawCircleEndpoint(self.vtProp.D.x, self.vtProp.D.y, 2, self.ContainerID);
                    WC.VT.drawCircleEndpoint(self.vtProp.E.x, self.vtProp.E.y, 2, self.ContainerID);
                    WC.VT.drawCircleEndpoint(self.vtProp.F.x, self.vtProp.F.y, 2, self.ContainerID);
                    WC.VT.drawCircleEndpoint(self.vtProp.G.x, self.vtProp.G.y, 2, self.ContainerID);
                    WC.VT.drawCircleEndpoint(self.vtProp.H.x, self.vtProp.H.y, 2, self.ContainerID);

                    ctx.beginPath();
                    ctx.setLineDash([4, 2, 4, 2]);
                    ctx.lineWidth = 0.5;
                    ctx.moveTo(self.vtProp.A.x, self.vtProp.A.y);
                    ctx.lineTo(self.vtProp.C.x, self.vtProp.C.y);
                    ctx.lineTo(self.vtProp.E.x, self.vtProp.E.y);
                    ctx.lineTo(self.vtProp.G.x, self.vtProp.G.y);
                    ctx.lineTo(self.vtProp.A.x, self.vtProp.A.y);
                    ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
                    ctx.lineJoin = 'round';
                    ctx.stroke();
                }
            } else {
                ctx.beginPath();
                ctx.setLineDash([4, 2, 4, 2]);
                ctx.lineWidth = 0.5;
                ctx.moveTo(self.vtProp.A.x, self.vtProp.A.y);
                ctx.lineTo(self.vtProp.C.x, self.vtProp.C.y);
                ctx.lineTo(self.vtProp.E.x, self.vtProp.E.y);
                ctx.lineTo(self.vtProp.G.x, self.vtProp.G.y);
                ctx.lineTo(self.vtProp.A.x, self.vtProp.A.y);
                ctx.lineWidth = 0.5;
                ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
                ctx.lineJoin = 'round';
                ctx.stroke();

                ctx.beginPath();
                ctx.setLineDash([]);
                ctx.lineWidth = self.SettingsValues.LineWidth;
                ctx.ellipse(self.vtProp.mid.x, self.vtProp.mid.y, self.vtProp.dist.x, self.vtProp.dist.y, 0, 0, 2 * Math.PI);
                ctx.stroke();

                ctx.lineWidth = 1;
                WC.VT.drawCircleEndpoint(self.vtProp.A.x, self.vtProp.A.y, 2, self.ContainerID);
                WC.VT.drawCircleEndpoint(self.vtProp.B.x, self.vtProp.B.y, 2, self.ContainerID);
                WC.VT.drawCircleEndpoint(self.vtProp.C.x, self.vtProp.C.y, 2, self.ContainerID);
                WC.VT.drawCircleEndpoint(self.vtProp.D.x, self.vtProp.D.y, 2, self.ContainerID);
                WC.VT.drawCircleEndpoint(self.vtProp.E.x, self.vtProp.E.y, 2, self.ContainerID);
                WC.VT.drawCircleEndpoint(self.vtProp.F.x, self.vtProp.F.y, 2, self.ContainerID);
                WC.VT.drawCircleEndpoint(self.vtProp.G.x, self.vtProp.G.y, 2, self.ContainerID);
                WC.VT.drawCircleEndpoint(self.vtProp.H.x, self.vtProp.H.y, 2, self.ContainerID);

            }
        }
    }

    function drawOutline() {
        ctx.beginPath();
        ctx.setLineDash([4, 2, 4, 2]);


    }
};

WC.VT.Text = function (ChartInstance, vtID, ContainerID) {

    var self = this;
    self.ContainerID = ContainerID;
    self.isSelected = false;
    var ctx = WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0];
    self.vtInfo = {
        vtName: "Text",
        vtProperName: "Text",
        vtCodeName: "Text"
    };

    self.SettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.vtInfo.vtProperName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" style="float: right; border: none; color:#CCC ;background-color:#555; height: 13px; line-height: 15px; font-weight: bold; font-family: Verdana; width: 20px;">x</button></div></div>');

    self.BaseType = "Text";

    self.isHovered = false;
    self.TextValue = "";
    self.SettingsValues = {
        Font: 'Tahoma',
        FontSize: 12,
        ForeColor: '#0000CD',
        HighlightColor: '#FF1493',
        TextInput: "",
    };


    self.SettingsObject = {
        // ExtendToInfinity: { group: self.vtInfo.vtProperName, name: "Extend to Infinity", type: "option", options: [true, "False"] },
        Font: { group: self.vtInfo.vtProperName, name: "Font", type: "option", options: ['Tahoma', 'Arial', 'Comic Sans MS', 'Helvetica', 'Impact'] },
        FontSize: { group: self.vtInfo.vtProperName, name: "Font Size", type: "number", options: { min: 2, max: 50 } },
        ForeColor: { group: self.vtInfo.vtProperName, name: "Fore Color", type: "color", options: { preferformat: "hex" } },
        HighlightColor: { group: self.vtInfo.vtProperName, name: "Highlight Color", type: "color", options: { preferformat: "hex" } },
        TextInput: { group: self.vtInfo.vtProperName, name: "Text Value", type: "text", options: { maxlength: 255 } },
    };


    self.vtID = "Text-" + vtID;

    self.x1Date = null;
    self.y1Price = null;

    self.TextWidth = null;

    self.X1 = null;
    self.Y1 = null;

    self.DatePriceProperties = {
        x1Date: null,
        y1Price: null,
        TextInput: ""
    };

    self.vtProperties = {
        X1: null,
        Y1: null,
        TextInput: "",
        setProperties: function () {
            var p = this;
            self.DatePriceProperties.x1Date = ChartInstance.GetDate(p.X1);
            self.DatePriceProperties.y1Price = ChartInstance.GetPrice(p.Y1);
            self.SettingsValues.TextInput = p.TextInput;
            p = null;
        }
    };

    self.AdjustVT = function () {
        if (true) { //self.SettingsValues.SnapToPrice !== true
            if (self.DatePriceProperties.x1Date !== null) {
                if (true) { //!self.SettingsValues.SnapToPrice
                    self.vtProperties.X1 = ChartInstance.GetXAxis(self.DatePriceProperties.x1Date);
                    self.vtProperties.Y1 = ChartInstance.GetYaxis(self.DatePriceProperties.y1Price);
                    if (self.DatePriceProperties.TextInput !== "") {
                        self.SettingsValues.TextInput = self.DatePriceProperties.TextInput;
                        self.DatePriceProperties.TextInput = "";
                    }
                } else {

                }
            }

        }
    }

    self.DrawVT = function () {
        if (ChartInstance.ChartOtherProperties.ChartData.length > 0) {
            if (!self.isSelected) {
                //ctx.beginPath();
                //ctx.moveTo(self.X1, self.Y1);
                //ctx.lineTo(self.X2, self.Y2);
                //ctx.lineWidth = 0.5;
                //ctx.strokeStyle = (self.isHovered) ? '#00FF00' : '#000000';
                //ctx.lineJoin = 'round';
                //ctx.stroke();
                //if (self.isHovered) {
                //    WC.VT.drawCircleEndpoint(self.X1, self.Y1, 5, self.ContainerID);
                //    WC.VT.drawCircleEndpoint(self.X2, self.Y2, 5, self.ContainerID);
                //}
                drawText(self.vtProperties.X1, self.vtProperties.Y1, self.SettingsValues.FontSize, 5, (self.isHovered ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor), 0.5);
            } else {
                //ctx.beginPath();
                //ctx.moveTo(self.X1, self.Y1);
                //ctx.lineTo(self.X2, self.Y2);
                //ctx.lineWidth = self.SettingsValues.LineWidth - 0.5;
                //ctx.strokeStyle = '#00FF00';
                //ctx.lineJoin = 'round';
                //ctx.stroke();

                //WC.VT.drawCircleEndpoint(self.X1, self.Y1, 5, self.ContainerID);
                //WC.VT.drawCircleEndpoint(self.X2, self.Y2, 5, self.ContainerID);

                drawText(self.vtProperties.X1, self.vtProperties.Y1, self.SettingsValues.FontSize, 5, (self.isHovered ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor), 0.5);
            }
        }
    }

    function drawText(x, y, h, a, ss, lw) {
        ctx.font = self.SettingsValues.FontSize + 'px ' + self.SettingsValues.Font;
        self.TextWidth = ctx.measureText(self.SettingsValues.TextInput).width;
        var x1 = x - a;
        var y1 = y - a;
        var x2 = (x + self.TextWidth) + a;
        var y2 = (y + h) + a;
        if (self.isHovered || self.isSelected) {
            ctx.beginPath();
            ctx.moveTo(x1, y1);
            ctx.lineTo(x2, y1);
            ctx.lineTo(x2, y2);
            ctx.lineTo(x1, y2);
            ctx.lineTo(x1, y1);
            ctx.lineJoin = 'round';
            ctx.lineWidth = 0.5;
            ctx.strokeStyle = ss;
            ctx.stroke();
        }
        ctx.fillStyle = ss;
        ctx.fillText(self.SettingsValues.TextInput, x, (y + h) - (h * 0.1));
    }
};

WC.VT.Rectangle = function (ChartInstance, vtID, ContainerID) {
    var self = this;
    self.ContainerID = ContainerID;
    self.isSelected = false;
    var ctx = WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0];
    self.vtInfo = {
        vtName: "Rectangle",
        vtProperName: "Rectangle",
        vtCodeName: "Rectangle"
    };
    self.SettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.vtInfo.vtProperName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" style="float: right; border: none; color:#CCC ;background-color:#555; height: 13px; line-height: 15px; font-weight: bold; font-family: Verdana; width: 20px;">x</button></div></div>');
    self.BaseType = "Polygon";
    self.isHovered = false;

    self.SettingsValues = {
        ForeColor: '#0000CD',
        HighlightColor: '#FF1493',
        //HighlightWidth: 4,
        LineWidth: 2
        //SnapToPrice: false
    };

    self.SettingsObject = {
        ForeColor: { group: self.vtInfo.vtProperName, name: "Fore Color", type: "color", options: { preferformat: "hex" } },
        HighlightColor: { group: self.vtInfo.vtProperName, name: "Highlight Color", type: "color", options: { preferformat: "hex" } },
        //HighlightWidth: { group: self.vtInfo.vtProperName, name: "Highlight Width", type: "number", options: { min: 1, max: 20 } },
        LineWidth: { group: self.vtInfo.vtProperName, name: "Line Width", type: "number", options: { min: 1, max: 20 } }
        //SnapToPrice: { group: self.vtInfo.vtProperName, name: "Snap to Price", type: "option", options: ["True", "False"] }
    };

    self.vtID = "Rectangle-" + vtID;

    self.x1Date = null;
    self.x2Date = null;
    self.y1Price = null;
    self.y2Price = null;
    self.midXDate = null;
    self.midYDate = null;

    self.X1 = null;
    self.X2 = null;
    self.Y1 = null;
    self.Y2 = null;

    var minX, minY, maxX, maxY;

    self.DatePriceProperties = {
        x1Date: null,
        x2Date: null,
        y1Price: null,
        y2Price: null
    };

    self.vtProperties = {
        X1: null
	  , Y1: null
	  , X2: null
	  , Y2: null
	  , setProperties: function () {
	      var point = this;
	      self.DatePriceProperties.x1Date = ChartInstance.GetDate(point.X1);
	      self.DatePriceProperties.y1Price = ChartInstance.GetPrice(point.Y1);
	      self.DatePriceProperties.x2Date = ChartInstance.GetDate(point.X2);
	      self.DatePriceProperties.y2Price = ChartInstance.GetPrice(point.Y2);
	      point = null;
	  }
    }


    self.vtProp = {
        A: { x: null, y: null },
        B: { x: null, y: null },
        C: { x: null, y: null },
        D: { x: null, y: null },
        E: { x: null, y: null },
        F: { x: null, y: null },
        G: { x: null, y: null },
        H: { x: null, y: null },
        mid: { x: null, y: null },
        dist: { x: null, y: null }
    };

    function setProp() {

        self.vtProp.A.x = self.vtProperties.X1, self.vtProp.A.y = self.vtProperties.Y1;
        self.vtProp.E.x = self.vtProperties.X2, self.vtProp.E.y = self.vtProperties.Y2;

        self.vtProp.mid.x = (self.vtProp.A.x + self.vtProp.E.x) / 2;
        self.vtProp.mid.y = (self.vtProp.A.y + self.vtProp.E.y) / 2;
        self.vtProp.dist.x = Math.abs(self.vtProp.A.x - self.vtProp.E.x) / 2;
        self.vtProp.dist.y = Math.abs(self.vtProp.A.y - self.vtProp.E.y) / 2;
        self.vtProp.B.x = self.vtProp.mid.x, self.vtProp.B.y = self.vtProp.A.y;
        self.vtProp.C.x = self.vtProp.E.x, self.vtProp.C.y = self.vtProp.A.y;
        self.vtProp.D.x = self.vtProp.E.x, self.vtProp.D.y = self.vtProp.mid.y;
        self.vtProp.F.x = self.vtProp.mid.x, self.vtProp.F.y = self.vtProp.E.y;
        self.vtProp.G.x = self.vtProp.A.x, self.vtProp.G.y = self.vtProp.E.y;
        self.vtProp.H.x = self.vtProp.A.x, self.vtProp.H.y = self.vtProp.mid.y;
    }

    self.AdjustVT = function () {
        if (self.SettingsValues.SnapToPrice !== true) {
            if (self.DatePriceProperties.x1Date !== null || self.DatePriceProperties.x2Date !== null) {
                if (!self.SettingsValues.SnapToPrice) {
                    self.vtProperties.X1 = ChartInstance.GetXAxis(self.DatePriceProperties.x1Date);
                    self.vtProperties.X2 = ChartInstance.GetXAxis(self.DatePriceProperties.x2Date);
                    self.vtProperties.Y1 = ChartInstance.GetYaxis(self.DatePriceProperties.y1Price);
                    self.vtProperties.Y2 = ChartInstance.GetYaxis(self.DatePriceProperties.y2Price);
                }
            }
        }
    }

    self.DrawVT = function () {
        setProp();
        DrawRectangle();
        if (self.isSelected) {
            DrawHandle();
        }
        else {
            if (self.isHovered) {
                DrawHandle();
            }
        }

    }

    function DrawRectangle() {
        ctx.beginPath();
        ctx.setLineDash([]);
        ctx.lineWidth = self.SettingsValues.LineWidth;
        ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
        ctx.moveTo(self.vtProp.A.x, self.vtProp.A.y);
        ctx.lineTo(self.vtProp.C.x, self.vtProp.C.y);
        ctx.lineTo(self.vtProp.E.x, self.vtProp.E.y);
        ctx.lineTo(self.vtProp.G.x, self.vtProp.G.y);
        ctx.lineTo(self.vtProp.A.x, self.vtProp.A.y);
        ctx.closePath();
        ctx.stroke();
    }

    function DrawHandle() {
        WC.VT.drawCircleEndpoint(self.vtProp.A.x, self.vtProp.A.y, 2, self.ContainerID);
        WC.VT.drawCircleEndpoint(self.vtProp.B.x, self.vtProp.B.y, 2, self.ContainerID);
        WC.VT.drawCircleEndpoint(self.vtProp.C.x, self.vtProp.C.y, 2, self.ContainerID);
        WC.VT.drawCircleEndpoint(self.vtProp.D.x, self.vtProp.D.y, 2, self.ContainerID);
        WC.VT.drawCircleEndpoint(self.vtProp.E.x, self.vtProp.E.y, 2, self.ContainerID);
        WC.VT.drawCircleEndpoint(self.vtProp.F.x, self.vtProp.F.y, 2, self.ContainerID);
        WC.VT.drawCircleEndpoint(self.vtProp.G.x, self.vtProp.G.y, 2, self.ContainerID);
        WC.VT.drawCircleEndpoint(self.vtProp.H.x, self.vtProp.H.y, 2, self.ContainerID);
    }

};

WC.VT.FibonacciArc = function (ChartInstance, vtID, ContainerID) {

    var self = this;
    self.ContainerID = ContainerID;
    self.isSelected = false;
    self.R = 0;
    var ctx = WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0];
    var base = 0;
    self.vtInfo = {
        vtName: "FibonacciArc",
        vtProperName: "Fibonacci Arc",
        vtCodeName: "Fibonacci_Arc"
    };
    var lastDir = null;
    self.SettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.vtInfo.vtProperName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" style="float: right; border: none; color:#CCC ;background-color:#555; height: 13px; line-height: 15px; font-weight: bold; font-family: Verdana; width: 20px;">x</button></div></div>');
    self.Points = 2;
    self.BaseType = "Line";

    self.DatePriceProperties = {
        x1Date: null,
        x2Date: null,
        y1Price: null,
        y2Price: null
    };

    self.vtProperties = {
        X1: null,
        X2: null,
        Y1: null,
        Y2: null,
        setProperties: function () {
            var p = this;
            self.DatePriceProperties.x1Date = ChartInstance.GetDate(p.X1);
            self.DatePriceProperties.x2Date = ChartInstance.GetDate(p.X2);
            self.DatePriceProperties.y1Price = ChartInstance.GetPrice(p.Y1);
            self.DatePriceProperties.y2Price = ChartInstance.GetPrice(p.Y2);
            self.TrendDirection = (((p.Y1 - p.Y2) / (p.X1 - p.X2)) < 0) ? "Up" : "Down";
            p = null;
        }
    };

    self.isHovered = false;
    self.TrendDirection = null;

    self.SettingsValues = {
        //  ExtendToInfinity: false,
        ForeColor: '#0000CD',
        HighlightColor: '#FF1493',
        // HighlightWidth: 4,
        LineWidth: 1,
        // RetracementLevels: [0, 0.236, 0.382, 0.618, 1],
        // ExtensionLevels: [1.618, 2.618, 4.236],
        //  SnapToPrice: false
    };

    self.SettingsObject = {
        // ExtendToInfinity: { group: self.vtInfo.vtProperName, name: "Extend to Infinity", type: "option", options: [true, "False"] },
        ForeColor: { group: self.vtInfo.vtProperName, name: "Fore Color", type: "color", options: { preferformat: "hex" } },
        HighlightColor: { group: self.vtInfo.vtProperName, name: "Highlight Color", type: "color", options: { preferformat: "hex" } },
        //  HighlightWidth: { group: self.vtInfo.vtProperName, name: "Highlight Width", type: "number", options: { min: 1, max: 20 } },
        LineWidth: { group: self.vtInfo.vtProperName, name: "Line Width", type: "number", options: { min: 1, max: 20 } },
        //  SnapToPrice: { group: self.vtInfo.vtProperName, name: "Snap to Price", type: "option", options: ["True", "False"] }
    };

    //    

    self.vtID = "FibonacciArc-" + vtID;

    self.x1Date = null;
    self.x2Date = null;
    self.y1Price = null;
    self.y2Price = null;

    self.X1 = null;
    self.X2 = null;
    self.Y1 = null;
    self.Y2 = null;

    self.AdjustVT = function () {
        if (true) { //self.SettingsValues.SnapToPrice !== true
            if (self.DatePriceProperties.x1Date !== null || self.DatePriceProperties.x2Date !== null) {
                if (!false) { //!self.SettingsValues.SnapToPrice
                    self.vtProperties.X1 = ChartInstance.GetXAxis(self.DatePriceProperties.x1Date);
                    self.vtProperties.X2 = ChartInstance.GetXAxis(self.DatePriceProperties.x2Date);
                    self.vtProperties.Y1 = ChartInstance.GetYaxis(self.DatePriceProperties.y1Price);
                    self.vtProperties.Y2 = ChartInstance.GetYaxis(self.DatePriceProperties.y2Price);
                    self.R = (self.DatePriceProperties.y1Price >= self.DatePriceProperties.y2Price) ? (self.DatePriceProperties.y1Price - self.DatePriceProperties.y2Price) : (self.DatePriceProperties.y2Price - self.DatePriceProperties.y1Price);

                    // self.DrawVT();
                } else {

                }
            }

        }
    }

    self.DrawVT = function () {
        if (ChartInstance.ChartOtherProperties.ChartData.length > 0) {
            if (!self.isSelected) {
                ctx.beginPath();
                ctx.moveTo(self.vtProperties.X1, self.vtProperties.Y1);
                ctx.lineTo(self.vtProperties.X2, self.vtProperties.Y2);
                ctx.lineWidth = 0.5;
                ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
                ctx.lineJoin = 'round';
                ctx.setLineDash([4, 2, 4, 2]);
                ctx.stroke();
                ctx.lineWidth = self.SettingsValues.LineWidth;
                setLevels();

            } else {
                ctx.beginPath();
                ctx.moveTo(self.vtProperties.X1, self.vtProperties.Y1);
                ctx.lineTo(self.vtProperties.X2, self.vtProperties.Y2);
                ctx.lineWidth = 0.5;
                ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
                ctx.lineJoin = 'round';
                ctx.setLineDash([4, 2, 4, 2]);
                ctx.stroke();
                ctx.lineWidth = self.SettingsValues.LineWidth;
                setLevels();

                WC.VT.drawCircleEndpoint(self.vtProperties.X1, self.vtProperties.Y1, 5, self.ContainerID);
                WC.VT.drawCircleEndpoint(self.vtProperties.X2, self.vtProperties.Y2, 5, self.ContainerID);
            }
        }
    }

    function distance(x1, x2, y1, y2) {
        var ret = Math.sqrt((Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2)));
        return ret;
    }

    function setLevels() {
        var d = distance(self.vtProperties.X1, self.vtProperties.X2, self.vtProperties.Y1, self.vtProperties.Y2);
        if (self.vtProperties.Y1 < self.vtProperties.Y2) {
            DrawArcs(self.DatePriceProperties.y1Price, self.DatePriceProperties.y2Price, "Down", self.DatePriceProperties.x1Date, [0.236, 0.382, 0.618, 1], d);
            lastDir = "Down";
        }
        if (self.vtProperties.Y1 > self.vtProperties.Y2) {
            DrawArcs(self.DatePriceProperties.y1Price, self.DatePriceProperties.y2Price, "Up", self.DatePriceProperties.x1Date, [0.236, 0.382, 0.618, 1], d);
            lastDir = "Up";
        }
        if (self.vtProperties.Y1 === self.vtProperties.Y2) {
            if (lastDir !== null || lastDir !== undefined) {
                DrawArcs(self.DatePriceProperties.y1Price, self.DatePriceProperties.y2Price, lastDir, self.DatePriceProperties.x1Date, [0.236, 0.382, 0.618, 1], d);
                lastDir = null;
            } else {
                DrawArcs(self.DatePriceProperties.y1Price, self.DatePriceProperties.y2Price, "Up", self.DatePriceProperties.x1Date, [0.236, 0.382, 0.618, 1], d);
                lastDir = "Up";
            }
        }
    }

    function DrawArcs(Price1, Price2, direction, Date1, retracement, dist) {
        ctx.setLineDash([]);
        ctx.font = "10px Tahoma";
        ctx.fillStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
        //var levels = retracement.concat(extensions);
        var Max = Math.max(Price1, Price2);
        var Min = Math.min(Price1, Price2);
        var R = Max - Min;
        var RL;
        var RetracementY;
        var BaseY = ChartInstance.GetYaxis(Price1);
        var BaseX = ChartInstance.GetXAxis(Date1);
        var count = retracement.length;
        var r;
        var d;
        for (var i = 0; i < count; i++) {
            switch (direction) {
                case "Down":
                    RL = Max - R * retracement[i];
                    RetracementY = ChartInstance.GetYaxis(RL);
                    d = dist * retracement[i];
                    ctx.beginPath();
                    ctx.arc(BaseX, BaseY, d, 0, 1 * Math.PI);
                    ctx.textAlign = "center";
                    ctx.fillText(ChartInstance.GetPrice(RetracementY).toFixed(ChartInstance.Digits) + " (" + (retracement[i] * 100).toFixed(1) + "%)", (BaseX), (BaseY + d + 7 + self.SettingsValues.LineWidth));
                    break;
                case "Up":
                    RL = Min + R * retracement[i];
                    RetracementY = ChartInstance.GetYaxis(RL);
                    d = dist * retracement[i];
                    ctx.beginPath();
                    ctx.arc(BaseX, BaseY, d, 1 * Math.PI, 0);
                    ctx.textAlign = "center";
                    ctx.fillText(ChartInstance.GetPrice(RetracementY).toFixed(ChartInstance.Digits) + " (" + (retracement[i] * 100).toFixed(1) + "%)", (BaseX), (BaseY - d - 3 - self.SettingsValues.LineWidth));
                    break;
            }
            ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
            ctx.lineWidth = self.SettingsValues.LineWidth;
            ctx.stroke();
        }
    }
};

WC.VT.FibonacciFan = function (ChartInstance, vtID, ContainerID) {

    var self = this;
    self.ContainerID = ContainerID;
    self.isSelected = false;
    self.R = 0;
    var ctx = WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0];
    var base = 0;
    self.vtInfo = {
        vtName: "FibonacciFan",
        vtProperName: "Fibonacci Fan",
        vtCodeName: "Fibonacci_Fan"
    };

    self.SettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.vtInfo.vtProperName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" style="float: right; border: none; color:#CCC ;background-color:#555; height: 13px; line-height: 15px; font-weight: bold; font-family: Verdana; width: 20px;">x</button></div></div>');

    self.BaseType = "Line";

    self.isHovered = false;
    self.TrendDirection = null;

    self.DatePriceProperties = {
        x1Date: null,
        x2Date: null,
        y1Price: null,
        y2Price: null
    };

    self.vtProperties = {
        X1: null,
        X2: null,
        Y1: null,
        Y2: null,
        setProperties: function () {
            var p = this;
            self.DatePriceProperties.x1Date = ChartInstance.GetDate(p.X1);
            self.DatePriceProperties.x2Date = ChartInstance.GetDate(p.X2);
            self.DatePriceProperties.y1Price = ChartInstance.GetPrice(p.Y1);
            self.DatePriceProperties.y2Price = ChartInstance.GetPrice(p.Y2);
            self.TrendDirection = (((p.Y1 - p.Y2) / (p.X1 - p.X2)) < 0) ? "Up" : "Down";
            p = null;
        }
    };

    self.SettingsValues = {
        //  ExtendToInfinity: false,
        ForeColor: '#0000CD',
        HighlightColor: '#FF1493',
        // HighlightWidth: 4,
        LineWidth: 1,
        // RetracementLevels: [0, 0.236, 0.382, 0.618, 1],
        // ExtensionLevels: [1.618, 2.618, 4.236],
        //  SnapToPrice: false
    };

    self.SettingsObject = {
        // ExtendToInfinity: { group: self.vtInfo.vtProperName, name: "Extend to Infinity", type: "option", options: [true, "False"] },
        ForeColor: { group: self.vtInfo.vtProperName, name: "Fore Color", type: "color", options: { preferformat: "hex" } },
        HighlightColor: { group: self.vtInfo.vtProperName, name: "Highlight Color", type: "color", options: { preferformat: "hex" } },
        //  HighlightWidth: { group: self.vtInfo.vtProperName, name: "Highlight Width", type: "number", options: { min: 1, max: 20 } },
        LineWidth: { group: self.vtInfo.vtProperName, name: "Line Width", type: "number", options: { min: 1, max: 20 } },
        //  SnapToPrice: { group: self.vtInfo.vtProperName, name: "Snap to Price", type: "option", options: ["True", "False"] }
    };

    //    

    self.vtID = "FibonacciFan-" + vtID;

    self.x1Date = null;
    self.x2Date = null;
    self.y1Price = null;
    self.y2Price = null;

    self.X1 = null;
    self.X2 = null;
    self.Y1 = null;
    self.Y2 = null;

    self.AdjustVT = function () {
        if (true) { //self.SettingsValues.SnapToPrice !== true
            if (self.DatePriceProperties.x1Date !== null || self.DatePriceProperties.x2Date !== null) {
                if (!false) { //!self.SettingsValues.SnapToPrice
                    self.vtProperties.X1 = ChartInstance.GetXAxis(self.DatePriceProperties.x1Date);
                    self.vtProperties.X2 = ChartInstance.GetXAxis(self.DatePriceProperties.x2Date);
                    self.vtProperties.Y1 = ChartInstance.GetYaxis(self.DatePriceProperties.y1Price);
                    self.vtProperties.Y2 = ChartInstance.GetYaxis(self.DatePriceProperties.y2Price);
                    self.R = (self.DatePriceProperties.y1Price >= self.DatePriceProperties.y2Price) ? (self.DatePriceProperties.y1Price - self.DatePriceProperties.y2Price) : (self.DatePriceProperties.y2Price - self.DatePriceProperties.y1Price);
                    // self.DrawVT();
                } else {

                }
            }

        }
    }

    self.DrawVT = function () {
        if (ChartInstance.ChartOtherProperties.ChartData.length > 0) {
            if (!self.isSelected) {
                ctx.beginPath();
                ctx.moveTo(self.vtProperties.X1, self.vtProperties.Y1);
                ctx.lineTo(self.vtProperties.X2, self.vtProperties.Y2);
                ctx.lineWidth = self.SettingsValues.LineWidth;
                ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
                ctx.lineJoin = 'round';
                ctx.setLineDash([4, 2, 4, 2]);
                ctx.lineCap = 'round';
                ctx.stroke();
                ctx.fillStyle = ctx.strokeStyle;
                setLevels();

            } else {
                ctx.beginPath();
                ctx.moveTo(self.vtProperties.X1, self.vtProperties.Y1);
                ctx.lineTo(self.vtProperties.X2, self.vtProperties.Y2);
                ctx.lineWidth = self.SettingsValues.LineWidth;
                ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
                ctx.lineJoin = 'round';
                ctx.setLineDash([4, 2, 4, 2]);
                ctx.lineCap = 'round';
                ctx.stroke();
                ctx.fillStyle = ctx.strokeStyle;
                setLevels();

                WC.VT.drawCircleEndpoint(self.vtProperties.X1, self.vtProperties.Y1, 5, self.ContainerID);
                WC.VT.drawCircleEndpoint(self.vtProperties.X2, self.vtProperties.Y2, 5, self.ContainerID);
            }
        }
    }

    function distance(x1, x2, y1, y2) {
        var ret = Math.sqrt((Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2)));
        return ret;
    }

    function setLevels() {
        var d = distance(self.vtProperties.X1, self.vtProperties.X2, self.vtProperties.Y1, self.vtProperties.Y2);
        if (self.TrendDirection === null) { self.TrendDirection = (((self.vtProperties.Y1 - self.vtProperties.Y2) / (self.vtProperties.X1 - self.vtProperties.X2)) < 0) ? "Up" : "Down"; }
        switch (self.TrendDirection) {
            case "Up":
                if (self.DatePriceProperties.x1Date.getTime() >= self.DatePriceProperties.x2Date.getTime()) {
                    DrawLevel(self.DatePriceProperties.y1Price, self.DatePriceProperties.y2Price, "Up", self.vtProperties.X2, self.vtProperties.X1, [0, 0.236, 0.382, 0.5, 0.618, 0.764], []);
                }
                else {
                    DrawLevel(self.DatePriceProperties.y1Price, self.DatePriceProperties.y2Price, "Up", self.vtProperties.X1, self.vtProperties.X2, [0, 0.236, 0.382, 0.5, 0.618, 0.764], []);
                }
                break;
            case "Down":
                if (self.DatePriceProperties.x1Date.getTime() <= self.DatePriceProperties.x2Date.getTime()) {
                    DrawLevel(self.DatePriceProperties.y1Price, self.DatePriceProperties.y2Price, "Down", self.vtProperties.X1, self.vtProperties.X2, [0, 0.236, 0.382, 0.5, 0.618, 0.764], []);
                } else {
                    DrawLevel(self.DatePriceProperties.y1Price, self.DatePriceProperties.y2Price, "Down", self.vtProperties.X2, self.vtProperties.X1, [0, 0.236, 0.382, 0.5, 0.618, 0.764], []);
                }
                break;
        }
    }

    function DrawLevel(Price1, Price2, direction, startX, endX, retracement, extensions) {
        ctx.setLineDash([]);
        var levels = retracement.concat(extensions);
        var Max = Math.max(Price1, Price2);
        var Min = Math.min(Price1, Price2);
        var R = Max - Min;
        var RL;
        var computedY;
        var BaseY = (direction === "Up") ? ChartInstance.GetYaxis(Min) : ChartInstance.GetYaxis(Max);
        var count = levels.length;
        var slope;
        var b;
        var cw = ctx.canvas.width;
        var extendedY;
        for (var i = 0; i < count; i++) {
            switch (direction) {
                case "Up":
                    RL = Max - R * levels[i];
                    break;
                case "Down":
                    RL = Min + R * levels[i];
                    break;
            }
            computedY = ChartInstance.GetYaxis(RL);
            ctx.beginPath();
            ctx.moveTo(startX, BaseY);
            ctx.lineTo(endX, computedY);
            if (retracement[i] !== 0) {
                slope = (computedY - BaseY) / (endX - startX);
                //b = (computedY - (slope * endX));
                //extendedY = slope * cw + b;
                //ctx.lineTo(cw, extendedY);
                extendedY = ExtendToInfinity(endX, computedY, slope, cw, self.ContainerID, 'y');
                ctx.moveTo(endX, computedY);
                ctx.lineTo(cw, extendedY);
                //ExtendToInfinity(endX, computedY, slope, cw, self.ContainerID, 'y');
            }
            ctx.fillText(ChartInstance.GetPrice(computedY).toFixed(ChartInstance.Digits) + " (" + (retracement[i] * 100).toFixed(1) + "%)", endX, (computedY - 5 - self.SettingsValues.LineWidth));
            ctx.lineWidth = self.SettingsValues.LineWidth;
            ctx.lineCap = 'round';
            ctx.stroke();
        }
    }
};

WC.VT.GannLine = function (ChartInstance, vtID, ContainerID) {

    var self = this;
    self.ContainerID = ContainerID;
    self.isSelected = false;
    var ctx = WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0];
    self.vtInfo = {
        vtName: "GannLine",
        vtProperName: "Gann Line",
        vtCodeName: "Gann_Line"
    };

    self.SettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.vtInfo.vtProperName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" style="float: right; border: none; color:#CCC ;background-color:#555; height: 13px; line-height: 15px; font-weight: bold; font-family: Verdana; width: 20px;">x</button></div></div>');

    self.BaseType = "GannLine";

    self.isHovered = false;
    self.TrendDirection = null;

    self.SettingsValues = {
        ExtendToInfinity: "False",
        ForeColor: '#0000CD',
        HighlightColor: '#FF1493',
        // HighlightWidth: 4,
        LineWidth: 1,
        //   SnapToPrice: false
    };

    self.SettingsObject = {
        ExtendToInfinity: { group: self.vtInfo.vtProperName, name: "Extend to Infinity", type: "option", options: ["True", "False"] },
        ForeColor: { group: self.vtInfo.vtProperName, name: "Fore Color", type: "color", options: { preferformat: "hex" } },
        HighlightColor: { group: self.vtInfo.vtProperName, name: "Highlight Color", type: "color", options: { preferformat: "hex" } },
        // HighlightWidth: { group: self.vtInfo.vtProperName, name: "Highlight Width", type: "number", options: { min: 1, max: 20 } },
        LineWidth: { group: self.vtInfo.vtProperName, name: "Line Width", type: "number", options: { min: 1, max: 20 } },
        // SnapToPrice: { group: self.vtInfo.vtProperName, name: "Snap to Price", type: "option", options: ["True", "False"] }
    };

    //    

    self.vtID = "GannLine-" + vtID;

    self.x1Date = null;
    self.x2Date = null;
    self.y1Price = null;
    self.y2Price = null;

    //self.X1 = null;
    //self.X2 = null;
    //self.Y1 = null;
    //self.Y2 = null;

    //self.X3 = null;
    //self.Y3 = null;

    self.DatePriceProperties = {
        x1Date: null,
        x2Date: null,
        y1Price: null,
        y2Price: null
    };

    self.vtProperties = {
        X1: null,
        X2: null,
        X3: null,
        Y1: null,
        Y2: null,
        Y3: null,
        setProperties: function () {
            var p = this;
            self.DatePriceProperties.x1Date = ChartInstance.GetDate(p.X1);
            self.DatePriceProperties.x2Date = ChartInstance.GetDate(p.X2);
            self.DatePriceProperties.y1Price = ChartInstance.GetPrice(p.Y1);
            self.DatePriceProperties.y2Price = ChartInstance.GetPrice(p.Y2);
            p = null;
        }
    };

    self.AdjustVT = function () {
        if (true) { // self.SettingsValues.SnapToPrice !== true
            if (self.DatePriceProperties.x1Date !== null || self.DatePriceProperties.x2Date !== null) {
                if (!false) { //!self.SettingsValues.SnapToPrice
                    self.vtProperties.X1 = ChartInstance.GetXAxis(self.DatePriceProperties.x1Date);
                    self.vtProperties.X2 = ChartInstance.GetXAxis(self.DatePriceProperties.x2Date);
                    self.vtProperties.Y1 = ChartInstance.GetYaxis(self.DatePriceProperties.y1Price);
                    self.vtProperties.Y2 = ChartInstance.GetYaxis(self.DatePriceProperties.y2Price);
                    // self.DrawVT();
                } else {

                }
            }

        }
    }

    self.DrawVT = function () {
        if (ChartInstance.ChartOtherProperties.ChartData.length > 0) {
            if (!self.isSelected) {
                ctx.beginPath();
                ctx.setLineDash([]);
                ctx.moveTo(self.vtProperties.X1, self.vtProperties.Y1);
                setAngle();
                ctx.lineWidth = self.SettingsValues.LineWidth - .5;
                ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
                ctx.lineJoin = 'round';
                ctx.stroke();
                if (self.isHovered)
                    WC.VT.drawCircleEndpoint(self.vtProperties.X2, self.vtProperties.Y2, 5, self.ContainerID);
            } else {
                ctx.beginPath();
                ctx.setLineDash([]);
                ctx.moveTo(self.vtProperties.X1, self.vtProperties.Y1);
                setAngle();
                ctx.lineWidth = self.SettingsValues.LineWidth - .5;
                ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
                ctx.lineJoin = 'round';
                ctx.stroke();
                WC.VT.drawCircleEndpoint(self.vtProperties.X2, self.vtProperties.Y2, 5, self.ContainerID);
            }
        }
    }

    function distance(x1, x2, y1, y2) {
        var ret = Math.sqrt((Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2)));
        return ret;
    }

    function drawInfinity(x1, y1, x2, y2) {
        var segLength = Math.sqrt(Math.pow((x1 - x2), 2) + Math.pow((y1 - y2), 2)),
		   startDist = Math.max(ctx.canvas.width, ctx.canvas.height) * -2,
		   endDist = startDist * -1;

        var pointInfinityX = x2 + (x2 - x1) / segLength * endDist;
        var pointInfinityY = y2 + (y2 - y1) / segLength * endDist;

        ctx.lineTo(pointInfinityX, pointInfinityY);
        self.vtProperties.X3 = pointInfinityX;
        self.vtProperties.Y3 = pointInfinityY;
    }

    function setAngle() {
        var dis = distance(self.vtProperties.X1, self.vtProperties.X2, self.vtProperties.Y1, self.vtProperties.Y2);
        if (self.vtProperties.Y1 < self.vtProperties.Y2) {
            self.vtProperties.X2 = self.vtProperties.X1 + dis * Math.cos(Math.PI * 45 / 180);
            self.vtProperties.Y2 = self.vtProperties.Y1 + dis * Math.sin(Math.PI * 45 / 180);
            (self.SettingsValues.ExtendToInfinity === "True") ? drawInfinity(self.vtProperties.X1, self.vtProperties.Y1, self.vtProperties.X2, self.vtProperties.Y2) : ctx.lineTo(self.vtProperties.X2, self.vtProperties.Y2);
        }
        else {
            self.vtProperties.X2 = self.vtProperties.X1 + dis * Math.cos(Math.PI * 45 / 180);
            self.vtProperties.Y2 = self.vtProperties.Y1 - dis * Math.sin(Math.PI * 45 / 180);
            (self.SettingsValues.ExtendToInfinity === "True") ? drawInfinity(self.vtProperties.X1, self.vtProperties.Y1, self.vtProperties.X2, self.vtProperties.Y2) : ctx.lineTo(self.vtProperties.X2, self.vtProperties.Y2);
        }
    }
};

WC.VT.GannFan = function (ChartInstance, vtID, ContainerID) {

    var self = this;
    self.ContainerID = ContainerID;
    self.isSelected = false;
    self.R = 0;
    var ctx = WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0];
    var base = 0;
    self.vtInfo = {
        vtName: "GannFan",
        vtProperName: "Gann Fan",
        vtCodeName: "Gann_Fan"
    };

    self.SettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.vtInfo.vtProperName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" style="float: right; border: none; color:#CCC ;background-color:#555; height: 13px; line-height: 15px; font-weight: bold; font-family: Verdana; width: 20px;">x</button></div></div>');
    self.Points = 2;
    self.BaseType = "Line";

    self.isHovered = false;
    self.TrendDirection = null;

    self.SettingsValues = {
        //  ExtendToInfinity: false,
        ForeColor: '#0000CD',
        HighlightColor: '#FF1493',
        // HighlightWidth: 4,
        LineWidth: 1,
        // RetracementLevels: [0, 0.236, 0.382, 0.618, 1],
        // ExtensionLevels: [1.618, 2.618, 4.236],
        //  SnapToPrice: false
    };

    self.SettingsObject = {
        // ExtendToInfinity: { group: self.vtInfo.vtProperName, name: "Extend to Infinity", type: "option", options: [true, "False"] },
        ForeColor: { group: self.vtInfo.vtProperName, name: "Fore Color", type: "color", options: { preferformat: "hex" } },
        HighlightColor: { group: self.vtInfo.vtProperName, name: "Highlight Color", type: "color", options: { preferformat: "hex" } },
        //  HighlightWidth: { group: self.vtInfo.vtProperName, name: "Highlight Width", type: "number", options: { min: 1, max: 20 } },
        LineWidth: { group: self.vtInfo.vtProperName, name: "Line Width", type: "number", options: { min: 1, max: 20 } },
        //  SnapToPrice: { group: self.vtInfo.vtProperName, name: "Snap to Price", type: "option", options: ["True", "False"] }
    };

    //    

    self.vtID = "GannFan-" + vtID;

    self.x1Date = null;
    self.x2Date = null;
    self.y1Price = null;
    self.y2Price = null;

    //self.X1 = null;
    //self.X2 = null;
    //self.Y1 = null;
    //self.Y2 = null;

    self.DatePriceProperties = {
        x1Date: null,
        x2Date: null,
        y1Price: null,
        y2Price: null
    };

    self.vtProperties = {
        X1: null,
        X2: null,
        Y1: null,
        Y2: null,
        setProperties: function () {
            var p = this;
            self.DatePriceProperties.x1Date = ChartInstance.GetDate(p.X1);
            self.DatePriceProperties.x2Date = ChartInstance.GetDate(p.X2);
            self.DatePriceProperties.y1Price = ChartInstance.GetPrice(p.Y1);
            self.DatePriceProperties.y2Price = ChartInstance.GetPrice(p.Y2);
            self.TrendDirection = (((p.Y1 - p.Y2) / (p.X1 - p.X2)) < 0) ? "Up" : "Down";
            p = null;
        }
    };

    self.AdjustVT = function () {
        if (true) { //self.SettingsValues.SnapToPrice !== true
            if (self.DatePriceProperties.x1Date !== null || self.DatePriceProperties.x2Date !== null) {
                if (!false) { //!self.SettingsValues.SnapToPrice
                    self.vtProperties.X1 = ChartInstance.GetXAxis(self.DatePriceProperties.x1Date);
                    self.vtProperties.X2 = ChartInstance.GetXAxis(self.DatePriceProperties.x2Date);
                    self.vtProperties.Y1 = ChartInstance.GetYaxis(self.DatePriceProperties.y1Price);
                    self.vtProperties.Y2 = ChartInstance.GetYaxis(self.DatePriceProperties.y2Price);
                    self.R = (self.DatePriceProperties.y1Price >= self.DatePriceProperties.y2Price) ? (self.DatePriceProperties.y1Price - self.DatePriceProperties.y2Price) : (self.DatePriceProperties.y2Price - self.DatePriceProperties.y1Price);
                    // self.DrawVT();
                    if (self.TrendDirection === null) {
                        self.TrendDirection = (((self.vtProperties.Y1 - self.vtProperties.Y2) / (self.vtProperties.X1 - self.vtProperties.X2)) < 0) ? "Up" : "Down";
                    }
                } else {

                }
            }

        }
    }

    self.DrawVT = function () {
        if (ChartInstance.ChartOtherProperties.ChartData.length > 0) {
            if (!self.isSelected) {
                ctx.beginPath();
                ctx.moveTo(self.vtProperties.X1, self.vtProperties.Y1);
                ctx.lineTo(self.vtProperties.X2, self.vtProperties.Y2);
                ctx.lineWidth = self.SettingsValues.LineWidth - .5;
                ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
                ctx.lineJoin = 'round';
                ctx.setLineDash([4, 2, 4, 2]);
                ctx.lineCap = 'round';
                ctx.stroke();
                ctx.fillStyle = ctx.strokeStyle;
                setLevels();

            } else {
                ctx.beginPath();
                ctx.moveTo(self.vtProperties.X1, self.vtProperties.Y1);
                ctx.lineTo(self.vtProperties.X2, self.vtProperties.Y2);
                ctx.lineWidth = self.SettingsValues.LineWidth - .5;
                ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
                ctx.lineJoin = 'round';
                ctx.setLineDash([4, 2, 4, 2]);
                ctx.lineCap = 'round';
                ctx.stroke();
                ctx.fillStyle = ctx.strokeStyle;
                setLevels();

                WC.VT.drawCircleEndpoint(self.vtProperties.X1, self.vtProperties.Y1, 5, self.ContainerID);
                WC.VT.drawCircleEndpoint(self.vtProperties.X2, self.vtProperties.Y2, 5, self.ContainerID);
            }
        }
    }

    function ExtendToInfinityOld(originX, originY, slope, extendToX) {
        var b = (originY - (slope * originX));
        var computedY = slope * extendToX + b;
        ctx.moveTo(originX, originY);
        ctx.lineTo(extendToX, computedY);
    }

    function distance(x1, x2, y1, y2) {
        var ret = Math.sqrt((Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2)));
        return ret;
    }

    function setLevels() {
        var d = distance(self.vtProperties.X1, self.vtProperties.X2, self.vtProperties.Y1, self.vtProperties.Y2);
        switch (self.TrendDirection) {
            case "Up":
                DrawLevel(self.DatePriceProperties.y1Price, self.DatePriceProperties.y2Price, "Up", self.vtProperties.X1, self.vtProperties.X2, [0.000001], [-5.835, -2.73, -1.98, -1.0, 0.5, 0.66, 0.75, 0.875]);
                break;
            case "Down":
                DrawLevel(self.DatePriceProperties.y1Price, self.DatePriceProperties.y2Price, "Down", self.vtProperties.X1, self.vtProperties.X2, [0.000001], [-5.835, -2.73, -1.98, -1.0, 0.5, 0.66, 0.75, 0.875]);
                break;
        }
    }

    function DrawLevel(Price1, Price2, direction, startX, endX, retracement, extensions) {
        ctx.setLineDash([]);
        var levels = retracement.concat(extensions);
        var Max = Math.max(Price1, Price2);
        var Min = Math.min(Price1, Price2);
        var R = Max - Min;
        var R2 = Min - Max;
        var RL;
        var computedY;
        var BaseY = (direction === "Up") ? ChartInstance.GetYaxis(Min) : ChartInstance.GetYaxis(Max);
        var BaseY2 = (direction === "Up") ? ChartInstance.GetYaxis(Max) : ChartInstance.GetYaxis(Min);
        var count = levels.length;
        var slope;
        var b;
        var cw = ctx.canvas.width;
        var extendedY;
        for (var i = 0; i < count; i++) {
            switch (direction) {
                case "Up":
                    if (startX < endX) {
                        RL = Max - R * levels[i];
                        computedY = ChartInstance.GetYaxis(RL);
                        ctx.beginPath();
                        ctx.moveTo(startX, BaseY);
                        ctx.lineTo(endX, computedY);
                        if (retracement[i] !== 0) {
                            slope = (computedY - BaseY) / (endX - startX);
                            ExtendToInfinityOld(endX, computedY, slope, cw);
                        }
                    }
                    else {
                        RL = Min + R * levels[i];
                        computedY = ChartInstance.GetYaxis(RL);
                        ctx.beginPath();
                        ctx.moveTo(startX, BaseY2);
                        ctx.lineTo(endX, computedY);
                        if (retracement[i] !== 0) {
                            slope = ((computedY - BaseY2) / (endX - startX));
                            ExtendToInfinityOld(endX, computedY, slope, -cw);
                        }
                    }
                    break;
                case "Down":
                    if (startX < endX) {
                        RL = Min + R * levels[i];
                        computedY = ChartInstance.GetYaxis(RL);
                        ctx.beginPath();
                        ctx.moveTo(startX, BaseY);
                        ctx.lineTo(endX, computedY);
                        if (retracement[i] !== 0) {
                            slope = (computedY - BaseY) / (endX - startX);
                            ExtendToInfinityOld(endX, computedY, slope, cw);
                        }
                    }
                    else {
                        RL = Max - R * levels[i];
                        computedY = ChartInstance.GetYaxis(RL);
                        ctx.beginPath();
                        ctx.moveTo(startX, BaseY2);
                        ctx.lineTo(endX, computedY);
                        if (retracement[i] !== 0) {
                            slope = (computedY - BaseY2) / (endX - startX);
                            ExtendToInfinityOld(endX, computedY, slope, -cw);
                        }
                    }
                    break;
            }

            ctx.lineWidth = self.SettingsValues.LineWidth;
            ctx.lineCap = 'round';
            ctx.stroke();
        }
    }
};

WC.VT.FibonacciTimezone = function (ChartInstance, vtID, ContainerID) {
    var self = this
	, ctx = WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0]
    ;

    self.ContainerID = ContainerID;
    self.isSelected = false;
    self.vtInfo = {
        vtName: "FibonacciTimeZone"
	  , vtProperName: "Fibonacci TimeZone",
        vtCodeName: "Fibonacci_TimeZone"
    }
    self.SettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.vtInfo.vtProperName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" style="float: right; border: none; color:#CCC ;background-color:#555; height: 13px; line-height: 15px; font-weight: bold; font-family: Verdana; width: 20px;">x</button></div></div>');
    self.Points = 2;
    self.BaseType = "Cyclic";
    self.isHovered = false;

    self.SettingsValues = {
        ExtendToInfinity: false,
        ForeColor: '#0000CD',
        HighlightColor: '#FF1493',
        HighlightWidth: 4,
        LineWidth: 1,
        SnapToPrice: true
    };

    self.SettingsObject = {
        ExtendToInfinity: { group: self.vtInfo.vtProperName, name: "Extend to Infinity", type: "option", options: [true, "False"], visible: false },
        ForeColor: { group: self.vtInfo.vtProperName, name: "Fore Color", type: "color", options: { preferformat: "hex" } },
        HighlightColor: { group: self.vtInfo.vtProperName, name: "Highlight Color", type: "color", options: { preferformat: "hex" } },
        HighlightWidth: { group: self.vtInfo.vtProperName, name: "Highlight Width", type: "number", options: { min: 1, max: 20 }, visible: false },
        LineWidth: { group: self.vtInfo.vtProperName, name: "Line Width", type: "number", options: { min: 1, max: 20 } },
        SnapToPrice: { group: self.vtInfo.vtProperName, name: "Snap to Price", type: "option", options: ["True", "False"], visible: false }
    };

    self.vtID = "FibonacciTimezone-" + vtID;
    self.LineDash = [];

    self.DatePriceProperties = {
        x1Date: null,
        x2Date: null,
        y1Price: null,
        y2Price: null
    };

    self.vtProperties = {
        X1: null
	   , Y1: null
	   , X2: null
	   , Y2: null
	   , setProperties: function () {
	       var point = this;
	       self.DatePriceProperties.x1Date = ChartInstance.GetDate(point.X1);
	       self.DatePriceProperties.y1Price = ChartInstance.GetPrice(point.Y1);
	       self.DatePriceProperties.x2Date = ChartInstance.GetDate(point.X2);
	       self.DatePriceProperties.y2Price = ChartInstance.GetPrice(point.Y2);
	       point = null;
	   }
    }

    self.x1Date = null;
    self.y1Price = null;
    self.X1 = null;
    self.Y1 = null;

    self.x2Date = null;
    self.y2Price = null;
    self.X2 = null;
    self.Y2 = null;

    self.Y2Zone = null;

    self.AdjustVT = function () {
        if (self.SettingsValues.SnapToPrice) {
            if (self.DatePriceProperties.x1Date || self.DatePriceProperties.x2Date) {
                if (self.SettingsValues.SnapToPrice) {
                    self.vtProperties.X1 = ChartInstance.GetXAxis(self.DatePriceProperties.x1Date);
                    self.vtProperties.Y1 = ChartInstance.GetYaxis(self.DatePriceProperties.y1Price);
                    self.vtProperties.X2 = ChartInstance.GetXAxis(self.DatePriceProperties.x2Date);
                    self.vtProperties.Y2 = ChartInstance.GetYaxis(self.DatePriceProperties.y2Price);
                }
            }
        }
    }

    function Snapping() {
        //Current BarIndex
        //self.vtProperties.X1 = ChartInstance.GetXAxis( self.x1Date );
        //self.vtProperties.X2 = ChartInstance.GetXAxis( self.x2Date );


        BarIndexX1 = ChartInstance.GetIndex(self.vtProperties.X1);
        BarIndexX2 = ChartInstance.GetIndex(self.vtProperties.X2);

        isEqualPoint = BarIndexX1 == BarIndexX2 ? true : false;

        if (isEqualPoint) {

            self.vtProperties.X1 = ChartInstance.GetXAxis(ISOStringToDate(ChartInstance.ChartOtherProperties.ChartData[BarIndexX1].Stamp()));
            self.vtProperties.X2 = self.vtProperties.X1;

        }
        else {

            if (PreviousBarIndexX1 != BarIndexX1 || PreviousBarIndexX2 != BarIndexX2) {
                PreviousBarIndexX2 = BarIndexX2
                PreviousBarIndexX1 = BarIndexX1;
                self.vtProperties.X1 = ChartInstance.GetXAxis(ISOStringToDate(ChartInstance.ChartOtherProperties.ChartData[BarIndexX1].Stamp()));
                self.vtProperties.X2 = ChartInstance.GetXAxis(ISOStringToDate(ChartInstance.ChartOtherProperties.ChartData[BarIndexX2].Stamp()));

                self.PreviousX1 = self.vtProperties.X1;
                self.PreviousX2 = self.vtProperties.X2;
            }
            else {
                self.vtProperties.X1 = ChartInstance.GetXAxis(ISOStringToDate(ChartInstance.ChartOtherProperties.ChartData[BarIndexX1].Stamp()));
                self.vtProperties.X2 = ChartInstance.GetXAxis(ISOStringToDate(ChartInstance.ChartOtherProperties.ChartData[BarIndexX2].Stamp()));
                //self.vtProperties.X1 = self.PreviousX1;
                //self.vtProperties.X2 = self.PreviousX2;
            }

        }


        //   self.PreviousX1 = self.vtProperties.X1;
        //   self.PreviousX2 = self.vtProperties.X2;

        //currentX1 = self.vtProperties.X1;
        //   currentX2 = self.vtProperties.X2;

        //       var temptbarindex1 = ChartInstance.GetIndex( currentX1 )
        //     , temptbarindex2 = ChartInstance.GetIndex( currentX2 )

        //if ( isEqualPoint ) {
        //    self.vtProperties.X2 = self.vtProperties.X1;
        //}
        //   else {

        //       var temptX1 = ChartInstance.GetXAxis( ISOStringToDate( ChartInstance.ChartOtherProperties.ChartData[BarIndexX1].Stamp() ) )
        //          , temptX2 = ChartInstance.GetXAxis( ISOStringToDate( ChartInstance.ChartOtherProperties.ChartData[BarIndexX2].Stamp() ) )
        //       ;
        //       if ( temptbarindex1 == BarIndexX1 && temptbarindex2 == BarIndexX2 ) {
        //           self.vtProperties.X1 = temptX1;
        //           self.vtProperties.X2 = temptX2;
        //       }
        //       else {
        //           var check = "";
        //       }
        //   }



    };

    var isEqualPoint = null
	, BarIndexX1 = null
	, BarIndexX2 = null
	, PreviousBarIndexX1 = null
	, PreviousBarIndexX2 = null
	, isSnapped = false
	, currentX1 = 0
	, currentX2 = 0
    ;

    self.DrawVT = function () {
        Snapping();
        ctx.beginPath();
        ctx.moveTo(self.vtProperties.X1, self.vtProperties.Y1);
        ctx.lineTo(self.vtProperties.X2, self.vtProperties.Y2);
        ctx.lineWidth = self.isHovered ? self.SettingsValues.HighlightWidth : 1;
        ctx.strokeStyle = self.isHovered ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
        ctx.lineJoin = 'round';
        ctx.setLineDash(self.isHovered ? [] : [4, 2, 4, 2]);
        ctx.stroke();
        DrawTimeZone();

        if (!self.isSelected) {

            if (self.isHovered) {
                WC.VT.drawCircleEndpoint(self.vtProperties.X1, self.vtProperties.Y1, 5, self.ContainerID);
                WC.VT.drawCircleEndpoint(self.vtProperties.X2, self.vtProperties.Y2, 5, self.ContainerID);
            }
        }
        else {
            WC.VT.drawCircleEndpoint(self.vtProperties.X1, self.vtProperties.Y1, 5, self.ContainerID);
            WC.VT.drawCircleEndpoint(self.vtProperties.X2, self.vtProperties.Y2, 5, self.ContainerID);
        }

    }

    function DrawTimeZone() {

        ctx.setLineDash([]);
        ctx.beginPath();

        var first = null
		, second = null
		, fibovalue = null
		, barindex1 = ChartInstance.GetIndex(self.vtProperties.X1)
		, getbarindex2 = ChartInstance.GetIndex(self.vtProperties.X2)
		, barindex2 = getbarindex2 == barindex1 ? getbarindex2 - 1 : getbarindex2
		, direction = barindex1 > barindex2 ? "LeftToRight" : "RightToLeft"
		, distance = (barindex1 - barindex2) * ChartInstance.ComputationProperties.BarSpace
		, linedistance = null
		, nextzoneXpoint = null
        ;
        self.Y2Zone = ChartInstance.ComputationProperties.height;



        for (var i = 0; i > -1; i++) {
            if (i < 2) {  // First and Second Line TimeZone
                if (i == 0) {
                    first = i;
                    if (self.vtProperties.X1 > -1 && self.vtProperties.X1 < ChartInstance.ComputationProperties.width) {
                        ctx.moveTo(self.vtProperties.X1, 0);
                        ctx.lineTo(self.vtProperties.X1, self.Y2Zone);
                        DrawLabel(first, self.vtProperties.X1);
                    }
                }
                else if (i == 1) {
                    second = i;
                    if (self.vtProperties.X2 > -1 && self.vtProperties.X2 < ChartInstance.ComputationProperties.width && !isEqualPoint) {
                        ctx.moveTo(self.vtProperties.X2, 0);
                        ctx.lineTo(self.vtProperties.X2, self.Y2Zone);
                        DrawLabel(second, self.vtProperties.X2);
                    }
                }
            }
            else {
                fibovalue = first + second;
                first = second;
                second = fibovalue;
                linedistance = distance * fibovalue;
                nextzoneXpoint = Math.ceil(self.vtProperties.X2 + linedistance);
                if (nextzoneXpoint > -1 && nextzoneXpoint < ChartInstance.ComputationProperties.width) {
                    ctx.moveTo(nextzoneXpoint, 0);
                    ctx.lineTo(nextzoneXpoint, self.Y2Zone);
                    DrawLabel(fibovalue, nextzoneXpoint);
                }
                else {
                    // determine next zone
                    var nextfibovalue = first + second
					, nextlinedistance = distance * nextfibovalue
					, nextnextXpoint = Math.ceil(self.vtProperties.X2 + nextlinedistance)
                    ;
                    if (direction == "RightToLeft") {
                        if (nextnextXpoint < 0) {
                            break;
                        }
                    }
                    else {
                        if (nextnextXpoint > ChartInstance.ComputationProperties.width) {
                            break;
                        }

                    }

                }
            }
        }
        ctx.lineWidth = self.SettingsValues.LineWidth;
        ctx.strokeStyle = self.SettingsValues.ForeColor;
        ctx.lineJoin = 'round';
        ctx.font = "10px Tahoma";
        ctx.stroke();


    }

    function DrawLabel(text, xAxis) {
        ctx.fillStyle = self.SettingsValues.ForeColor;
        ctx.textAlign = "start";
        ctx.fillText(text, xAxis + self.SettingsValues.LineWidth, self.Y2Zone - 3);
    };

};

WC.VT.ForexChannel = function (ChartInstance, vtID, ContainerID) {

    var self = this;
    self.ContainerID = ContainerID;
    self.isSelected = false;
    var ctx = WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0];
    self.vtInfo = {
        vtName: "ForexChannel",
        vtProperName: "Forex Channel",
        vtCodeName: "Forex_Channel"
    };

    self.SettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.vtInfo.vtProperName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" style="float: right; border: none; color:#CCC ;background-color:#555; height: 13px; line-height: 15px; font-weight: bold; font-family: Verdana; width: 20px;">x</button></div></div>');
    self.isHovered = false;
    self.BaseType = "Parallel";
    self.Points = 4;
    self.SettingsValues = {
        ExtendToInfinity: "False",
        ForeColor: '#0000CD',
        HighlightColor: '#FF1493',
        // HighlightWidth: 4,
        LineWidth: 1,
        //  SnapToPrice: false
    };

    self.SettingsObject = {
        ExtendToInfinity: { group: self.vtInfo.vtProperName, name: "Extend to Infinity", type: "option", options: ["True", "False"] },
        ForeColor: { group: self.vtInfo.vtProperName, name: "Fore Color", type: "color", options: { preferformat: "hex" } },
        HighlightColor: { group: self.vtInfo.vtProperName, name: "Highlight Color", type: "color", options: { preferformat: "hex" } },
        //  HighlightWidth: { group: self.vtInfo.vtProperName, name: "Highlight Width", type: "number", options: { min: 1, max: 20 } },
        LineWidth: { group: self.vtInfo.vtProperName, name: "Line Width", type: "number", options: { min: 1, max: 20 } },
        // SnapToPrice: { group: self.vtInfo.vtProperName, name: "Snap to Price", type: "option", options: ["True", "False"] }
    };

    //    

    self.vtID = "ForexChannel-" + vtID;

    self.x1Date = null;
    self.x2Date = null;
    self.x3Date = null;
    self.x4Date = null;

    self.y1Price = null;
    self.y2Price = null;
    self.y3Price = null;
    self.y4Price = null;

    //self.X1 = null;
    //self.X2 = null;
    //self.X3 = null;
    //self.X4 = null;
    //self.Y1 = null;
    //self.Y2 = null;
    //self.Y3 = null;
    //self.Y4 = null;

    self.DatePriceProperties = {
        x1Date: null,
        x2Date: null,
        x3Date: null,
        x4Date: null,
        y1Price: null,
        y2Price: null,
        y3Price: null,
        y4Price: null
    };

    self.vtProperties = {
        X1: null,
        X2: null,
        X3: null,
        X4: null,
        Y1: null,
        Y2: null,
        Y3: null,
        Y4: null,
        setProperties: function () {
            var p = this;
            self.DatePriceProperties.x1Date = ChartInstance.GetDate(p.X1);
            self.DatePriceProperties.x2Date = ChartInstance.GetDate(p.X2);
            self.DatePriceProperties.x3Date = ChartInstance.GetDate(p.X3);
            self.DatePriceProperties.x4Date = ChartInstance.GetDate(p.X4);
            self.DatePriceProperties.y1Price = ChartInstance.GetPrice(p.Y1);
            self.DatePriceProperties.y2Price = ChartInstance.GetPrice(p.Y2);
            self.DatePriceProperties.y3Price = ChartInstance.GetPrice(p.Y3);
            self.DatePriceProperties.y4Price = ChartInstance.GetPrice(p.Y4);
            p = null;
        }
    };


    var minX, minY, maxX, maxY;

    self.vtProp = {
        A: { x: null, y: null },
        B: { x: null, y: null },
        C: { x: null, y: null },
        D: { x: null, y: null },
        E: { x: null, y: null },
        mid: { x: null, y: null }
    };

    function setProp() {

        self.vtProp.A.x = self.vtProperties.X1, self.vtProp.A.y = self.vtProperties.Y1;
        self.vtProp.B.x = self.vtProperties.X2, self.vtProp.B.y = self.vtProperties.Y2;

        self.vtProp.mid.x = (self.vtProperties.X3 + self.vtProperties.X4) / 2;
        self.vtProp.mid.y = (self.vtProperties.Y3 + self.vtProperties.Y4) / 2;
        if (self.vtProperties.Y1 !== null && self.vtProperties.Y2 !== null && self.vtProperties.Y3 !== null && self.vtProperties.Y4 !== null) {
            self.vtProp.C.x = self.vtProperties.X3, self.vtProp.C.y = self.vtProperties.Y3;
            self.vtProp.D.x = self.vtProp.mid.x, self.vtProp.D.y = self.vtProp.mid.y;
            self.vtProp.E.x = self.vtProperties.X4, self.vtProp.E.y = self.vtProperties.Y4;
        }
    }

    self.AdjustVT = function () {
        if (true) { // self.SettingsValues.SnapToPrice !== true
            if (self.DatePriceProperties.x1Date !== null || self.DatePriceProperties.x2Date !== null || self.DatePriceProperties.x3Date !== null || self.DatePriceProperties.x4Date !== null) {
                if (true) { //!self.SettingsValues.SnapToPrice
                    self.vtProperties.X1 = ChartInstance.GetXAxis(self.DatePriceProperties.x1Date);
                    self.vtProperties.X2 = ChartInstance.GetXAxis(self.DatePriceProperties.x2Date);
                    self.vtProperties.X3 = ChartInstance.GetXAxis(self.DatePriceProperties.x3Date);
                    self.vtProperties.X4 = ChartInstance.GetXAxis(self.DatePriceProperties.x4Date);
                    self.vtProperties.Y1 = ChartInstance.GetYaxis(self.DatePriceProperties.y1Price);
                    self.vtProperties.Y2 = ChartInstance.GetYaxis(self.DatePriceProperties.y2Price);
                    self.vtProperties.Y3 = ChartInstance.GetYaxis(self.DatePriceProperties.y3Price);
                    self.vtProperties.Y4 = ChartInstance.GetYaxis(self.DatePriceProperties.y4Price);

                }
            }
        }
    }

    self.DrawVT = function () {
        if (ChartInstance.ChartOtherProperties.ChartData.length > 0) {
            setProp();
            DrawParallel();
            if (self.isSelected) {
                DrawHandle();
            }
            else {
                if (self.isHovered) {
                    DrawHandle();
                }
            }
        }
    }

    function drawInfinity(x1, y1, x2, y2) {
        var segLength = Math.sqrt(Math.pow((x1 - x2), 2) + Math.pow((y1 - y2), 2)),
			vstartDist = segLength * -2,
			endDist = Math.sqrt(Math.pow((x2 - ctx.canvas.width), 4) + Math.pow((y2 - ctx.canvas.height), 4));

        var pointInfinityX = x2 + (x2 - x1) / segLength * endDist;
        var pointInfinityY = y2 + (y2 - y1) / segLength * endDist;

        ctx.lineTo(pointInfinityX, pointInfinityY);
    }

    function DrawParallel() {
        if (self.vtProperties.X1 !== null && self.vtProperties.X2 !== null) {
            ctx.beginPath();
            ctx.setLineDash([]);
            ctx.lineWidth = self.SettingsValues.LineWidth - .5;
            ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
            ctx.moveTo(self.vtProp.A.x, self.vtProp.A.y);
            (self.SettingsValues.ExtendToInfinity === "True") ? drawInfinity(self.vtProp.A.x, self.vtProp.A.y, self.vtProp.B.x, self.vtProp.B.y) : ctx.lineTo(self.vtProp.B.x, self.vtProp.B.y);
            ctx.stroke();

            ctx.beginPath();
            ctx.setLineDash([]);
            ctx.lineWidth = self.SettingsValues.LineWidth - .5;
            ctx.strokeStyle = (self.isHovered) ? self.SettingsValues.HighlightColor : self.SettingsValues.ForeColor;
            ctx.moveTo(self.vtProp.E.x, self.vtProp.E.y);
            (self.SettingsValues.ExtendToInfinity === "True") ? drawInfinity(self.vtProp.E.x, self.vtProp.E.y, self.vtProp.C.x, self.vtProp.C.y) : ctx.lineTo(self.vtProp.C.x, self.vtProp.C.y);
            ctx.stroke();
        }
    }
    function DrawHandle() {
        if (self.vtProperties.X1 !== null && self.vtProperties.X2 !== null) {
            WC.VT.drawCircleEndpoint(self.vtProp.A.x, self.vtProp.A.y, 5, self.ContainerID);
            WC.VT.drawCircleEndpoint(self.vtProp.B.x, self.vtProp.B.y, 5, self.ContainerID);
            WC.VT.drawCircleEndpoint(self.vtProp.D.x, self.vtProp.D.y, 5, self.ContainerID);
        }
    }
};
