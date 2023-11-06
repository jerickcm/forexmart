WC.CD = {};
WC.CD.ChartDisplay = function (params) {
    var self = this;
//    self.CurrentUrl = window.location.href;
    self.CurrentUrl = window.location.href;
    console.log('windows location');
    console.log( self.CurrentUrl);
    //Default Settings of chart
    var Options = $.extend({
        ActiveIndicators: [],
        ActiveVisualTools: [],
        DefaultColorScheme: "GreenOnBlack",
        DefaultTheme: "DarkStyle",
        GraphType: "CandleStick",
        IsChartDisplayDisabled: false,
        IsChartDisplayVisible: true,
        IsChartForBinaryOptions: false,
        IsChartObjectsVisible: false,
        IsExplicitlySetChartDisplay: false,
        IsExplicitlySetChartObjects: false,
        IsExplicitlySetVisualTools: false,
        IsOHLCDigitsBottomRight: false,
        IsShowAll: false,
        IsShowAskLine: false,
        IsShowBar: false,
        IsShowBidLine: false,
        IsShowCandleStick: false,
        IsShowChartObjects: false,
        IsShowGraphType: false,
        IsShowINBW: false,
        IsShowINMO: false,
        IsShowINOB: true,
        IsShowINOS: true,
        IsShowINOT: false,
        IsShowINVO: false,
        IsShowIndicator: true,
        IsShowKagi: false,
        IsShowLegend: false,
        IsShowLine: false,
        IsShowLineBreak: false,
        IsShowMarker: false,
        IsShowOHLCDigits: false,
        IsShowOptions: false,
        IsShowPointAndFigure: false,
        IsShowPoweredText: false,
        IsShowRenko: false,
        IsShowSeparator: false,
        IsShowSymbolSelector: false,
        IsShowTF1: true,
        IsShowTF1H: true,
        IsShowTF3H: false,
        IsShowTF4H: true,
        IsShowTF5: true,
        IsShowTF6H: false,
        IsShowTF8H: false,
        IsShowTF12H: true,
        IsShowTF15: true,
        IsShowTF30: true,
        IsShowTFD: true,
        IsShowTFM: true,
        IsShowTFW: true,
        IsShowTemplate: false,
        IsShowTimeframe: true,
        IsShowTitleBarButtons: false,
        IsShowTradePanel: false,
        IsShowTrades: false,
        IsShowVTF: false,
        IsShowVTFC: false,
        IsShowVTG: false,
        IsShowVTL: false,
        IsShowVTS: false,
        IsShowVTT: false,
        IsShowVisualTools: true,
        IsShowVolume: false,
        IsShowWIN: true,
        IsShowWaterMark: false,
        IsUseSpecialIndicatorList: true,
        IsVisualToolsVisible: false,
        ShowChartObjectsKey: 3,
        ShowGraphTypeKey: 3,
        ShowIndicatorKey: 3,
        ShowTimeframeKey: 1,
        ShowVisualToolsKey: 3,
        ShowWINKey: 3,
        Symbol: "",
        TimeFrame: 15,
        WaterMarkMaxHeight: 300,
        WaterMarkMinHeight: 100,
        TimeFrameItems: []
    }, params.Options);

    var IndicatorCollection = [];
    var ContainerID = params.ContainerID;
    var MainContainerID = ContainerID;
    var IndicatorCanvas;
    var BotIndicatorCanvas;
    var Bars;
    var isDataAvailable = false;
    var IsSettingsVisible = false;
    var isLowerIndicatorVisible = false;
    var VisualToolInstance;
    var _comObj = WC.ComObject;
    var _maximizeCallBack = $.isFunction(params.CallBacks.Maximize) ? params.CallBacks.Maximize : undefined;
    var _CloseCallBack = params.CallBacks.Close;
    var ActiveIndicatorSettings;
    var LowerIndicatorInstanceCollection = [];
    var InstanceCollectionCount = 0;
    var TopChart = 0.7;
    var BotChart = 0.3;
    var SettingsContainerWidth = 191;
    var ButtonHeight = 30;
    var _currentSymbolLongName = "";
    var SubObj = null;
    var VisualToolsMenuItems;
    var SymbolSelectorElement = null;
    var selectedVTObject;
    var vtActiveObj1;
    var ChartInstance = null;
    var IndicatorInstance = null;
    var VTInstance = null;

    //Elements
    var ChartForm;
    var IndicatorSettingsForm;
    var BottomIndicatorChartContainer;
    var TitleBar;
    var MainNav;
    var ChartHolder;
    var ChartScrollBarHolder;
    var VisualToolsSettingsForm;
    var SettingsHeaderContainer;
    var ToolBar;
    var SecondScrollBarHolder;
    var BoxSizeSpinner;
    var ReversalSpinner;
    var WaterMark;
    var div = null;

    self.IsChartDisplayVisible = Options.IsChartDisplayVisible;
    self.IsChartObjectsVisible = Options.IsChartObjectsVisible;
    self.IsVisualToolsVisible = Options.IsVisualToolsVisible;
    self.TempIsChartDisplayVisible = Options.IsChartDisplayVisible;
    self.TempIsChartObjectsVisible = Options.IsChartObjectsVisible;
    self.TempIsVisualToolsVisible = Options.IsVisualToolsVisible;
    self.IsExplicitlySetChartDisplay = Options.IsExplicitlySetChartDisplay;
    self.IsExplicitlySetChartObjects = Options.IsExplicitlySetChartObjects;
    self.IsExplicitlySetVisualTools = Options.IsExplicitlySetVisualTools;
    self.IsShowTitleBarButtons = Options.IsShowTitleBarButtons;
    self.isLowerIndicatorVisible = false;
    self.IsShowWaterMark = Options.IsShowWaterMark;

    // Web Chart Options
    self.IsShowTrades = Options.IsShowTrades;
    self.IsShowSymbolSelector = Options.IsShowSymbolSelector;
    self.IsShowChartObjects = Options.IsShowChartObjects; // <<<<<<<<<<<<
    self.IsShowMarker = Options.IsShowMarker;
    self.IsShowOHLCDigits = Options.IsShowOHLCDgiits;
    self.IsShowLegend = Options.IsShowLegend;
    self.IsShowTradePanel = Options.IsShowTradePanel;
    self.IsShowBidLine = Options.IsShowBidLine;
    self.IsShowAskLine = Options.IsShowAskLine;
    self.IsShowSeparator = Options.IsShowSeparator;
    self.IsShowVolume = Options.IsShowVolume;
    self.GraphType = Options.GraphType;
    self.IsShowGraphType = Options.IsShowGraphType; // <<<<<<<<<<<<
    self.IsShowCandleStick = Options.IsShowCandleStick;
    self.IsShowBar = Options.IsShowBar;
    self.IsShowLine = Options.IsShowLine;
    self.IsShowRenko = Options.IsShowRenko;
    self.IsShowLineBreak = Options.IsShowLineBreak;
    self.IsShowPointAndFigure = Options.IsShowPointAndFigure;
    self.IsShowKagi = Options.IsShowKagi;
    self.IsShowTimeframe = Options.IsShowTimeframe; // <<<<<<<<<<<<
    self.IsShowTF1 = Options.IsShowTF1;
    self.IsShowTF5 = Options.IsShowTF5;
    self.IsShowTF15 = Options.IsShowTF15;
    self.IsShowTF30 = Options.IsShowTF30;
    self.IsShowTF1H = Options.IsShowTF1H;
    self.IsShowTF3H = Options.IsShowTF3H;
    self.IsShowTF4H = Options.IsShowTF4H;
    self.IsShowTF6H = Options.IsShowTF6H;
    self.IsShowTF8H = Options.IsShowTF8H;
    self.IsShowTF12H = Options.IsShowTF12H;
    self.IsShowTFD = Options.IsShowTFD;
    self.IsShowTFW = Options.IsShowTFW;
    self.IsShowTFM = Options.IsShowTFM;
    self.IsShowIndicator = Options.IsShowIndicator; // <<<<<<<<<<<<
    self.IsShowINOB = Options.IsShowINOB;
    self.IsShowINOS = Options.IsShowINOS;
    self.IsShowINVO = Options.IsShowINVO;
    self.IsShowINBW = Options.IsShowINBW;
    self.IsShowINMO = Options.IsShowINMO;
    self.IsShowINOT = Options.IsShowINOT;
    self.IsShowVisualTools = Options.IsShowVisualTools; // <<<<<<<<<<<<
    self.IsShowVTF = Options.IsShowVTF;
    self.IsShowVTFC = Options.IsShowVTFC;
    self.IsShowVTG = Options.IsShowVTG;
    self.IsShowVTL = Options.IsShowVTL;
    self.IsShowVTS = Options.IsShowVTS;
    self.IsShowVTT = Options.IsShowTT;
    self.IsShowWIN = Options.IsShowWIN; // <<<<<<<<<<<<
    self.ActiveIndicators = Options.ActiveIndicators;
    self.ActiveVisualTools = Options.ActiveVisualTools;
    self.DefaultColorScheme = Options.DefaultColorScheme;
    self.IsShowPoweredText = Options.IsShowPoweredText;
    self.IsShowTemplate = Options.IsShowTemplate;
    self.IsShowOptions = Options.IsShowOptions;
    self.DefaultTheme = Options.DefaultTheme;
    self.IsUseSpecialIndicatorList = Options.IsUseSpecialIndicatorList;
    self.TimeFrameItems = Options.TimeFrameItems;
    var pgDiv;
    var vtobjectselected = null;
    var vtobjectType = null;
    var vtActiveObj = null;

    var QuotesViewModel = {
        Quotes: ValidateObservableProperty(params.Data.Quotes, "Quotes", true),
        IsConnected: ValidateObservableProperty(params.Data.IsConnected, "IsConnected")
    }
    var BarsViewModel = {
        RequestLastBarStamp: ValidatePropertyMethod(params.CallBacks.RequestLastBarStamp, "RequestLastBarStamp"),
        RequestBarsData: ValidatePropertyMethod(params.CallBacks.RequestBarsData, "RequestBarsData"),
        BarsDataHolder: ValidateObservableProperty(params.Data.BarsDataHolder, "BarsDataHolder", true),
        RequestAdditionalDataForDragging: ValidatePropertyMethod(params.CallBacks.RequestAdditionalDataForDragging, "RequestAdditionalDataForDragging")
    };

    var txtTimeframe = "Timeframe",
        txtIndicators = "Indicators",
        txtVisualTools = "Visual Tools",
        txtWindow = "Window",
        txtChartObject = "Chart Objects",
        txtChartDisplay = "Chart Display",
        txtShow = "Show",
        txtHide = "Hide",
        txtBar = "Bar",
        txtMarker = "Marker",
        txtLegend = "Legend",
        txtAsk = "Ask",
        txtBid = "Bid",
        txtPanel = "Panel",
        txtLine = "Line",
        txtPeriod = "Period",
        txtSeparator = "Separator",
        txtTick = "Tick",
        txtVolume = "Volume",
        txtCandleStick = "CandleStick",
        txtGraph = "Graph",
        txtType = "Type",
        txtChart = "Chart",
        txtZoom = "Zoom",
        txtFibonacci = "Fibonacci",
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
        txtRefresh = "Refresh",
        txtRefreshChart = txtRefresh + " " + txtChart,
        txtOpen = "Open",
        txtHigh = "High",
        txtLow = "Low",
        txtClose = "Close",
        txtVolume = "Volume";

    function ValidatePropertyMethod(method, name) {
        if (method) {
            if ($.isFunction(method)) {
                return method;
            }
        }
        throw "Invalid " + name + " is not a function";
    }

    function ValidateObservableProperty(property, name, isarray) {
        if (property) {
            if (ko.isObservable(property)) {
                if (isarray) {
                    if (property.indexOf) {
                        return property;
                    }

                } else {
                    return property;
                }
            }
        }
        throw "Invalid " + name + " is not a observable" + (isarray ? "Array" : "");
    }

    _comObj.OnTrigger.push(function (method, paramObj) {
        switch (method) {
            case "IsConnected":
                if (ChartInstance) ChartInstance.SeIsConnectedState(paramObj);
                break;
            case "LanguageChanged":
                var ChartWords = WC.ChartWords;
                //For TimeFrames
                var length = self.TimeFrameItems.length;
                for (var i = 0; i < length; i++) {
                    var item = self.TimeFrameItems[i];
                    var num = parseInt(item.Name);
                    var char = item.Name.replace(/[^a-zA-Z]+/g, '')
                    var getchar = ChartWords[char]
                    if (getchar) self.TimeFrameItems[i].Name = isNaN(num) ? getchar : num + " " + getchar;
                    item = null;
                }
                txtTimeframe = ChartWords["Timeframe"];
                txtIndicators = ChartWords["Indicators"];
                txtVisualTools = ChartWords["Visual_Tools"];
                txtWindow = ChartWords["Window"];
                txtChartObject = ChartWords["Chart_Objects"];
                txtChartDisplay = ChartWords["Chart_Display"];
                txtShow = ChartWords["Show"];
                txtHide = ChartWords["Hide"];
                txtBar = ChartWords["Bar"];
                txtMarker = ChartWords["Marker"];
                txtLegend = ChartWords["Legend"];
                txtAsk = ChartWords["Ask"];
                txtBid = ChartWords["Bid"];
                txtPanel = ChartWords["Panel"];
                txtLine = ChartWords["Line"];
                txtPeriod = ChartWords["Period"];
                txtSeparator = ChartWords["Separator"];
                txtTick = ChartWords["Tick"];
                txtVolume = ChartWords["Volume"];
                txtCandleStick = ChartWords["CandleStick"];
                txtGraph = ChartWords["Graph"];
                txtType = ChartWords["Type"];
                txtZoom = ChartWords["Zoom"];
                txtChart = ChartWords["Chart"];

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
                txtRefresh = ChartWords["Refresh"];
                txtRefreshChart = txtRefresh + " " + txtChart;
                txtOpen = ChartWords["Open"];
                txtHigh = ChartWords["High"];
                txtLow = ChartWords["Low"];
                txtClose = ChartWords["Close"];
                txtVolume = ChartWords["Volume"];


                $('#' + ContainerID + ' .TimeFrame').text(txtTimeframe);
                $('#' + ContainerID + ' .Indicators').text(txtIndicators);
                $('#' + ContainerID + ' .VisualTools').text(txtVisualTools);
                $('#' + ContainerID + ' .ToolWindow').text(txtWindow);

                var ShowHide = txtShow + "/" + txtHide,
                    AskBid = txtAsk + "|" + txtBid,
                    GraphType = txtGraph + " " + txtType,
                    ZoomChartTitle = txtZoom + " " + txtChart;

                ItemHolderChartObjects = self.ChartObjectsGroup.find('div.ItemHolder'),
                ItemHolderChartFunctionGroup = self.ChartFunctionGroup.find('div.ItemHolder'),
                ItemHolderVisualToolsGroup = self.VisualToolsGroup.find('div.ItemHolder')
                ;


                ItemHolderChartObjects.find('div.ToolMarker').attr("title", ShowHide + " " + txtBar + " " + txtMarker);
                ItemHolderChartObjects.find('div.ToolLegend').attr("title", ShowHide + " " + txtBar + " " + txtLegend);
                ItemHolderChartObjects.find('div.ToolTradePanel').attr("title", ShowHide + " " + AskBid + " " + txtPanel);
                ItemHolderChartObjects.find('div.ToolBidLine').attr("title", ShowHide + " " + txtAsk + " " + txtLine);
                ItemHolderChartObjects.find('div.ToolAskLine').attr("title", ShowHide + " " + txtBid + " " + txtLine);
                ItemHolderChartObjects.find('div.ToolSeparator').attr("title", ShowHide + " " + txtPeriod + " " + txtSeparator);
                ItemHolderChartObjects.find('div.ToolVolume').attr("title", ShowHide + " " + txtTick + " " + txtVolume);
                ItemHolderChartObjects

                ItemHolderChartFunctionGroup.find('div.ToolCandleStick').attr("title", txtCandleStick + " " + GraphType);
                ItemHolderChartFunctionGroup.find('div.ToolBarGraph').attr("title", txtBar + " " + GraphType);
                ItemHolderChartFunctionGroup.find('div.ToolLineGraph').attr("title", txtLine + " " + GraphType);
                ItemHolderChartFunctionGroup.find('div.TimeFrameTextHolder').text(txtTimeframe);

                ItemHolderVisualToolsGroup.find("#ToolText-" + ContainerID).attr("title", txtText);
                ItemHolderVisualToolsGroup.find("#ToolEllipse-" + ContainerID).attr("title", txtEllipse);
                ItemHolderVisualToolsGroup.find("#ToolRectangle-" + ContainerID).attr("title", txtRectangle);
                ItemHolderVisualToolsGroup.find("#ToolTrendLineB-" + ContainerID).attr("title", txtTrendLine);
                ItemHolderVisualToolsGroup.find("#ToolGannFan-" + ContainerID).attr("title", txtGannFan);
                ItemHolderVisualToolsGroup.find("#ToolGannLine-" + ContainerID).attr("title", txtGannLine);

                ItemHolderVisualToolsGroup.find("#ToolFibArc-" + ContainerID).attr("title", txtFibonacciArc);
                ItemHolderVisualToolsGroup.find("#ToolFibFan-" + ContainerID).attr("title", txtFibonacciFan);
                ItemHolderVisualToolsGroup.find("#ToolFibTime-" + ContainerID).attr("title", txtFibonacciTimeZone);

                ItemHolderVisualToolsGroup.find("#ToolForexChannel-" + ContainerID).attr("title", txtForexChannel);

                ChartInstance.ChartSettings.ZoomChartTitle = ZoomChartTitle;
                ChartInstance.SetPercentageOfZoom();
                ChartInstance.ChangeBarLegendText(txtOpen, txtHigh, txtLow, txtClose, txtVolume);

                if (ActiveIndicatorSettings) {
                    for (var indicator in WC.IN.IndicatorCollection[ContainerID]) {
                        var index = parseInt(indicator);
                        // TEMP FIX - Replace ASAP
                        if (isNaN(index) || index >= WC.IN.IndicatorCollection[ContainerID].length) break;

                        var obj = WC.IN.IndicatorCollection[ContainerID][index];
                        if (obj.IndicatorID === ActiveIndicatorSettings) {
                            IndicatorSettingsFunction(ActiveIndicatorSettings)
                            break;
                        }
                    }

                    for (var indicator in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                        var index = parseInt(indicator);
                        var obj = WC.VT.VisualToolsObjectCollection[ContainerID][index];
                        if (obj.vtID === ActiveIndicatorSettings) {
                            VisualToolsSettingsFunction(ActiveIndicatorSettings);
                            break;
                        }
                    }
                }


                ItemHolderChartObjects = null;
                ItemHolderChartFunctionGroup = null;
                ChartWords = null;
                break;
        }
    });

    self.ParentElement = $('#' + ContainerID);

    SetAllElementsNeededAndSetVariablesNeeded();

    AttackClickEventOnSymbolSelector();

    function GetSymbolSelector() {

        var ItemToAppend = $('<div style="display: inline-block;"><div class="SymbolContainer">' + _currentSymbolLongName + '</div><div class="BtnShowSymbolSelector"></div></div>');
        WC.SymbolSelector = ItemToAppend.find('.BtnShowSymbolSelector');
        SymbolSelectorElement = WC.SymbolSelector.SymbolSelector({

            width: 200

            , selecteditem: function (obj) {

                var _item = obj.item;
                var _symbol = obj.symbol;
                ChartInstance.ChangeSymbol(_symbol);
                UpdateSymbolSelectorText(_item);
                _currentSymbolLongName = _item;
                SetTitleBarCaption();
                root.$menu.trigger('contextmenu:hide');
            }
        });
        return ItemToAppend;
    }

    //Set all the container height
    function IndicatorSettingsFunction(indicator) {
        if (pgDiv !== undefined) {
            pgDiv.PropertyGrid("RemoveProperty", { KeyObject: ActiveIndicatorSettings });
            pgDiv = undefined;
            $('#SettingsContainer' + ContainerID).empty();
            $('#SettingsHeader-' + ContainerID).empty();
        }
        var SettingsObject, ValuesObject, IndicatorHeader;
        if (WC.IN.IndicatorCollection[ContainerID].length != 0) {
            self.ChartFormElement.find('#SettingsContainer' + ContainerID).removeAttr('style');
            self.ChartFormElement.find('#SettingsContainer' + ContainerID).attr('style', 'visibility:visible');

            getIndicatorSettingsObject(indicator);

            var width = SettingsContainerWidth + 'px';
            var height = (self.ChartFormElement.height() - ((self.ChartFormElement.find('.ChartToolBar').css('display') === 'none') ? 0 : self.ChartFormElement.find('.ChartToolBar').height()) - ((self.ChartFormElement.find('.ChartTitleBar').css('display') === 'none') ? 0 : self.ChartFormElement.find('.ChartTitleBar').height()) - self.ChartFormElement.find('div.ChartMenu').height() - 4 - self.ChartFormElement.find('div.ChartScrollBarHolder').height() - 3) - 6 + 'px';

            self.ChartFormElement.find('#SettingsHeader-' + ContainerID).append(IndicatorHeader);
            $('#SettingsContainer' + ContainerID).attr('style', 'width:' + width + '; height:' + height);
            pgDiv = $('#SettingsContainer' + ContainerID).PropertyGrid();
            IsSettingsVisible = true;
            ActiveIndicatorSettings = indicator;
            SetPropertyGrid(SettingsObject, ValuesObject, pgDiv);
            self.ResizeFunction();
            IndicatorDraw(IndicatorCanvas);
            ChartInstance.Resizemethod();

            $('#SettingsCloseButton' + ContainerID).click(function () {

                CloseSettingsOnIndicatorRemove(ActiveIndicatorSettings);
            });
        }

        function getIndicatorSettingsObject(name) {
            for (var indicator in WC.IN.IndicatorCollection[ContainerID]) {
                var index = parseInt(indicator);

                // TEMP FIX - Replace ASAP
                if (isNaN(index) || index >= WC.IN.IndicatorCollection[ContainerID].length) break;

                var obj = WC.IN.IndicatorCollection[ContainerID][index];
                if (obj.IndicatorID === name) {
                    IndicatorHeader = obj.IndicatorSettingsHeader;
                    IndicatorHeader.find("span.textTrimmable").text(WC.ChartWords[obj.IndicatorInfo.IndicatorCodeName]);
                    SettingsObject = obj.SettingsObject;
                    ValuesObject = obj.SettingsValues;
                }
            }
        }
    }

    function VisualToolsSettingsFunction(vt) {
        if (pgDiv !== undefined) {
            pgDiv.PropertyGrid("RemoveProperty", { KeyObject: ActiveIndicatorSettings });
            pgDiv.empty();
            $('#SettingsHeader-' + ContainerID).empty();
            pgDiv = undefined;
        }
        var SettingsObject, ValuesObject, VTHeader;

        if (WC.VT.VisualToolsObjectCollection[ContainerID].length !== 0) {
            self.ChartFormElement.find('#SettingsContainer' + ContainerID).removeAttr('style');
            self.ChartFormElement.find('#SettingsContainer' + ContainerID).attr('style', 'visibility:visible');

            getSettingsObject(vt);

            var width = SettingsContainerWidth + 'px';
            var height = (self.ChartFormElement.height() - ((self.ChartFormElement.find('.ChartToolBar').css('display') === 'none') ? 0 : self.ChartFormElement.find('.ChartToolBar').height()) - ((self.ChartFormElement.find('.ChartTitleBar').css('display') === 'none') ? 0 : self.ChartFormElement.find('.ChartTitleBar').height()) - self.ChartFormElement.find('div.ChartMenu').height() - 4 - self.ChartFormElement.find('div.ChartScrollBarHolder').height() - 3) - 6 + 'px';
            self.ChartFormElement.find('#SettingsHeader-' + ContainerID).append(VTHeader);
            $('#SettingsContainer' + ContainerID).attr('style', 'width:' + width + '; height:' + height);
            pgDiv = $('#SettingsContainer' + ContainerID).PropertyGrid();
            IsSettingsVisible = true;
            ActiveIndicatorSettings = vt;

            pgDiv.PropertyGrid("AddProperty", {
                KeyObject: ActiveIndicatorSettings,
                SetObject: ValuesObject,
                MetaObject: SettingsObject,
                ObjectChanged: function (object, propertyChanged) {
                    SetVtPropertyValueChange(object, propertyChanged);
                }
            });

            self.ResizeFunction();
            if (WC.IN.IndicatorCollection[ContainerID].length != 0) {
                IndicatorDraw(IndicatorCanvas);
            }
            ChartInstance.Resizemethod();
            pgDiv.PropertyGrid("Refresh", { KeyObject: ActiveIndicatorSettings });
            $('#SettingsCloseButton' + ContainerID).click(function () {

                CloseSettingsOnIndicatorRemove(ActiveIndicatorSettings);

            });
        }

        function getSettingsObject(name) {
            for (var indicator in WC.VT.VisualToolsObjectCollection[ContainerID]) {
                var index = parseInt(indicator);
                var obj = WC.VT.VisualToolsObjectCollection[ContainerID][index];
                if (obj.vtID === name) {
                    SettingsObject = obj.SettingsObject;
                    ValuesObject = obj.SettingsValues;
                    VTHeader = obj.SettingsHeader;
                    VTHeader.find("span.textTrimmable").text(WC.ChartWords[obj.vtInfo.vtCodeName]);
                    break;
                }
            }
        }
    }

    function ChartColorSchemeVisibility() {
        RemoveSettings();
        div = self.ChartFormElement.find('#SettingsContainer' + ContainerID);
        var width = SettingsContainerWidth + 'px';
        var height = (self.ChartFormElement.height() - ((self.ChartFormElement.find('.ChartToolBar').css('display') === 'none') ? 0 : self.ChartFormElement.find('.ChartToolBar').height()) - ((self.ChartFormElement.find('.ChartTitleBar').css('display') === 'none') ? 0 : self.ChartFormElement.find('.ChartTitleBar').height()) - self.ChartFormElement.find('div.ChartMenu').height() - 4 - self.ChartFormElement.find('div.ChartScrollBarHolder').height() - 3) - ButtonHeight - 6 + 'px';
        var TemplateHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">Color Panel</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');
        var $RestoreDefaultButton = $('<input style="width:190px;height:' + ButtonHeight + 'px; float:right; bottom: 0;position: absolute;" type="button" value="Restore Default"></input>');
        div.empty();
        $('#SettingsHeader-' + ContainerID).empty();
        div.css('visibility', 'visible');
        self.ChartFormElement.find('#SettingsHeader-' + ContainerID).append(TemplateHeader);
        self.ChartFormElement.find('#SettingsHeader-' + ContainerID).append($RestoreDefaultButton);
        div.css({ width: width, height: height });
        IsSettingsVisible = true;
        var PropertyGrid = div.PropertyGrid();
        ChartInstance.Resizemethod();
        TemplateHeader.find('button').click(RemoveSettings);
        pgDiv = PropertyGrid;

        var PropertyGridObject = ChartInstance.GetColorSchemeObjects();

        PropertyGrid.PropertyGrid("AddProperty", {
            KeyObject: ContainerID,
            SetObject: PropertyGridObject.SetObjects,
            MetaObject: PropertyGridObject.MetaObject,
            ObjectChanged: function (object, propertyChanged) {
                if (propertyChanged === undefined) {
                    ChartInstance.RestoreDefaultColorScheme(ChartInstance.ColorSchemeDefault);
                }
                else {
                    ChartInstance.ColorSchemeChanged(propertyChanged, object[propertyChanged]);
                }
            }
        });
        PropertyGrid.PropertyGrid("Refresh", { KeyObject: ContainerID });

        $RestoreDefaultButton.click(function () {



            PropertyGrid.PropertyGrid("RestoreDefault", ContainerID, ChartInstance.ColorSchemeDefault);
        });

    }

    self.Symbol = function () {
        return ChartInstance.ChartSettings.Symbol;
    };

    self.Title = function () {
        return TitleBar.text();
    };

    self.OnSymbolChanged = ChartInstance.OnSymbolChanged;

    self.OnTimeFrameChanged = ChartInstance.OnTimeFrameChanged;

    self.OnTitleChanged = [];

    self.ShowTitleBar = function () { TitleBar.show(); };

    self.HideTitleBar = function () { TitleBar.hide(); };

    self.InvalidateChart = function (isRecompute) { ChartInstance.DrawOHLCChart(isRecompute); };

    ChartInstance.ParentELement.on("PlotIndicatorData", {}, function () { IndicatorDraw(ChartInstance.ctxIndicatorTopCanvas); ChartInstance.Resizemethod(); });

    ChartInstance.ParentELement.on("TriggerSettingsClose", {}, function (event, IndicatorID, Action) {
        switch (Action) {
            case "Remove":
                if (ActiveIndicatorSettings === IndicatorID) {
                    CloseSettingsOnIndicatorRemove(IndicatorID);
                }
                break;

            case "RemoveAll":
                if (ActiveIndicatorSettings !== undefined) {
                    self.ChartFormElement.find('#SettingsContainer' + ContainerID).removeAttr('style');
                    self.ChartFormElement.find('#SettingsContainer' + ContainerID).attr('style', 'visibility:visible');
                    pgDiv.PropertyGrid("RemoveProperty", { KeyObject: ActiveIndicatorSettings });
                    $('#SettingsContainer' + ContainerID).empty();
                    $('#SettingsHeader-' + ContainerID).empty();
                    $('#SettingsHeader-' + ContainerID).removeAttr('style');
                    $('#SettingsHeader-' + ContainerID).attr('style', 'visibility:hidden');
                    IsSettingsVisible = false;
                    ActiveIndicatorSettings = undefined;
                    ChartInstance.Resizemethod();
                }
                break;
        }

    });

    ChartInstance.ParentELement.on("TriggerSettings", {}, function (event, VisualToolID) {
        VisualToolsSettingsFunction(VisualToolID);
    });

    ChartInstance.ParentELement.on("ChartAfterDraw", {
    }, function (event, VisualToolsContext, IndicatorTopCanvas, IndicatorBotCanvas, BarsData) {

        if (ActiveIndicatorSettings !== undefined) {
            pgDiv.PropertyGrid("Refresh", { KeyObject: ActiveIndicatorSettings });
        }
        if (div !== null) {
            div.PropertyGrid("Refresh", { KeyObject: ContainerID });
        }
    });

    ChartInstance.ParentELement.on("ChartSizeChanged", {
    }, function (event, VisualToolsContext, IndicatorTopCanvas) {

        if (IndicatorCollection.length > 0) {
            IndicatorDraw(IndicatorTopCanvas);
        }

    });

    function IndicatorDraw(top) {
        var newHeight = BottomIndicatorChartContainer.height() / InstanceCollectionCount;
        for (var indicator in IndicatorCollection) {
            var index = parseInt(indicator);
            var obj = IndicatorCollection[index];
            if (obj.OnBars) {
                obj.DrawIndicatorLine(top);
            }
            else {
                LowerIndicatorInstanceCollection[obj.IndicatorID].ChartHeight = newHeight;
                LowerIndicatorInstanceCollection[obj.IndicatorID].initRedraw(obj.IndicatorData, ChartInstance);
                obj.DrawIndicatorLine(LowerIndicatorInstanceCollection[obj.IndicatorID].ctxIndicatorTopCanvas, ChartInstance);
                DrawLowerIndicatorName(LowerIndicatorInstanceCollection[obj.IndicatorID].ctxIndicatorTopCanvas, obj.IndicatorSettings.IndicatorInfo.IndicatorName);
            }

        }
    }

    function getIndicatorID(IndicatorName) {
        var SimilarIndicatorCount = (IndicatorCollection.length !== 0) ? CountSimilarIndicators(IndicatorName) : 0;
        var ReturnValue;
        if (IndicatorCollection.length === 0) {
            ReturnValue = IndicatorName + "1";
            return ReturnValue;
        }
        if (SimilarIndicatorCount === 0) {
            ReturnValue = IndicatorName + "1";
            return ReturnValue;
        }
        if (SimilarIndicatorCount !== 0) {
            var number = SimilarIndicatorCount + 1;
            var strReturn = number.toString();
            return IndicatorName + strReturn;
        }

        function CountSimilarIndicators(name) {
            var ReturnValue = 0;
            for (var indicator in IndicatorCollection) {
                var index = parseInt(indicator);
                var obj = IndicatorCollection[index];
                if (obj.IndicatorSettings.IndicatorInfo.IndicatorName === name) {
                    ReturnValue = ReturnValue + 1;
                }
            }
            return ReturnValue;
        }
    }

    function SetPropertyGrid(SettingsObject, SettingsValues, SettingsContainer) {
        SettingsContainer.PropertyGrid("AddProperty", {
            KeyObject: ActiveIndicatorSettings,
            SetObject: SettingsValues,
            MetaObject: SettingsObject,
            ObjectChanged: function (object, propertyChanged) {
                SetPropertyValueChange(object, propertyChanged);
                var count = self.ActiveIndicators.length;
                if (count === 1) {
                    self.ActiveIndicators[0].Settings = object;
                    self.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
                } else if (count > 1) {
                    for (var i = 0; i < count; i++) {
                        if (self.ActiveIndicators[i].ID === ActiveIndicatorSettings) {
                            self.ActiveIndicators[i].Settings = object;
                            self.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
                            break;
                        }
                    }
                }
            }
        });
    }

    function SetPropertyValueChange(object, PropertyChanged) {
        for (var indicator in WC.IN.IndicatorCollection[ContainerID]) {
            var index = parseInt(indicator);
            var obj = WC.IN.IndicatorCollection[ContainerID][index];
            if (ActiveIndicatorSettings === obj.IndicatorID) {
                if (Contains(PropertyChanged, "Period")) {
                    if (obj.ContainerId === ContainerID) {
                        initPeriodChange(obj);
                    }

                    break;
                }
                if (!obj.OnBars) {
                    if (Contains(PropertyChanged, "VisualType")) {
                        obj.SetPropertyVisibility(pgDiv, ActiveIndicatorSettings, PropertyChanged);
                    }
                    if (Contains(PropertyChanged, "CollectionType")) {
                        obj.SetPropertyVisibility(pgDiv, ActiveIndicatorSettings, PropertyChanged);
                    }
                }
                obj.SettingsValues = object;
                if (!obj.OnBars) {
                    WC.IN.LowerIndicatorInstanceCollection[ContainerID][obj.IndicatorID].initRedraw(obj.IndicatorData, ChartInstance);
                    obj.DrawIndicatorLine();
                    DrawLowerIndicatorName(WC.IN.LowerIndicatorInstanceCollection[ContainerID][obj.IndicatorID].ctxIndicatorTopCanvas, obj.IndicatorInfo.IndicatorName);
                    break;
                }
                else {
                    ChartInstance.Resizemethod();
                }
            }
        }
    }

    function SetVtPropertyValueChange(object, PropertyChanged) {
        for (var vtool in WC.VT.VisualToolsObjectCollection[ContainerID]) {
            var index = parseInt(vtool);
            var obj = WC.VT.VisualToolsObjectCollection[ContainerID][index];
            if (ActiveIndicatorSettings === obj.vtID) {
                if (obj.BaseType === "RegressionLine") {
                    obj.Reg = false;
                    WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0].canvas.width = WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0].canvas.width;
                    VTInstance.VtRedrawFunction(ContainerID);
                    obj.Reg = true;
                    SaveVisualToolSettings(obj.vtID, index)
                    break;
                }
                if (PropertyChanged === "TextInput" && obj.BaseType === "Text") {
                    obj.TextValue = obj.SettingsValues.TextInput;
                }
                WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0].canvas.width = WC.VT.ctxVisualToolsCanvasCollection[ContainerID][0].canvas.width;
                VTInstance.VtRedrawFunction(ContainerID);
                SaveVisualToolSettings(obj.vtID, index)
                break;
            }
        }
    }

    function SaveVisualToolSettings(id, index) {
        var count = self.ActiveVisualTools.length;
        for (var i = 0; i < count; i++) {
            if (self.ActiveVisualTools[i].ID === id) {
                self.ActiveVisualTools[i].Settings = WC.VT.VisualToolsObjectCollection[ContainerID][index].SettingsValues;
                self.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
                break;
            }
        }
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

    function initPeriodChange(Indicator) {
        if (!Indicator.OnBars) {
            WC.IN.LowerIndicatorInstanceCollection[ContainerID][Indicator.IndicatorID].Resizemethod();
            Indicator.initIndicatorComputations(null);
        }
        else {
            Indicator.IndicatorData = [];
            Indicator.initIndicatorComputations(null);
            ChartInstance.Resizemethod();
        }
    }

    function DrawLowerIndicatorName(context, name) {
        context.fillStyle = "black";
        context.font = "11px Arial";
        context.fillText(name, 4, 16);
    }

    WC.OnLayout.push(ChartInstance.Resizemethod);

    SetContextMenu();

    SetToolBarEvents();

    SetToolBarActiveClass();

    AttachEventOnArrowDownButton();

    AttachClickEventToCloseHiddenItemsContainer();

    SetSortable();

    SetToolBarGroupVisibility();

    function SetSortable() {
        ToolBar.sortable({
            revert: true,
            axis: "x",
            cancel: ".item,.ArrowDownHiddenItems"
        });
    }

    function SetToolBarEvents() {

        $('#ToolTrendLine-' + ContainerID).on('click', function () { VisualToolsCtxMenuCallBack("TrendLine"); });

        $('#ToolPitchFork-' + ContainerID).on('click', function () { VisualToolsCtxMenuCallBack("Pitchfork"); });

        $('#ToolTrendLineB-' + ContainerID).on('click', function () { VisualToolsCtxMenuCallBack("TrendLine"); });

        $('#ToolPitchForkB-' + ContainerID).on('click', function () { VisualToolsCtxMenuCallBack("Pitchfork"); });

        $('#ToolEllipse-' + ContainerID).on('click', function () { VisualToolsCtxMenuCallBack("Ellipse"); });

        $('#ToolRectangle-' + ContainerID).on('click', function () { VisualToolsCtxMenuCallBack("Rectangle"); });

        $('#ToolText-' + ContainerID).on('click', function () { VisualToolsCtxMenuCallBack("Text"); });

        $('#ToolGannFan-' + ContainerID).on('click', function () { VisualToolsCtxMenuCallBack("GannFan"); });

        $('#ToolGannLine-' + ContainerID).on('click', function () { VisualToolsCtxMenuCallBack("GannLine"); });

        $('#ToolFibArc-' + ContainerID).on('click', function () { VisualToolsCtxMenuCallBack("FibonacciArc"); });

        $('#ToolFibFan-' + ContainerID).on('click', function () { VisualToolsCtxMenuCallBack("FibonacciFan"); });

        $('#ToolFibTime-' + ContainerID).on('click', function () { VisualToolsCtxMenuCallBack("FibonacciTimezone"); });

        $('#ToolForexChannel-' + ContainerID).on('click', function () { VisualToolsCtxMenuCallBack("ForexChannel"); });

        $('#' + ContainerID + ' .ToolMarker').on('click', eToolMarkerClick);

        $('#' + ContainerID + ' .ToolLegend').on('click', eToolLegendClick);

        $('#' + ContainerID + ' .ToolTradePanel').on('click', eToolTradePanelClick);

        $('#' + ContainerID + ' .TradePanel .Sell').on('click', eToolTradePanelSellClick);

        $('#' + ContainerID + ' .TradePanel .Buy').on('click', eToolTradePanelBuyClick);

        $('#' + ContainerID + ' .ToolBidLine').on('click', eToolBidLineClick);

        $('#' + ContainerID + ' .ToolAskLine').on('click', eToolAskLineClick);

        $('#' + ContainerID + ' .ToolSeparator').on('click', eToolSeparatorClick);

        $('#' + ContainerID + ' .ToolVolume').on('click', eToolVolumeClick);

        $('#' + ContainerID + ' .ToolOHLCDigits').on('click', eToolOHLCDigitsClick);

        $('#' + ContainerID + ' .ToolCandleStick').on('click', eToolCandleStickClick);

        $('#' + ContainerID + ' .ToolBarGraph').on('click', eToolBarClick);

        $('#' + ContainerID + ' .ToolLineGraph').on('click', eToolLineClick);

        $('#' + ContainerID + ' .ToolPointAndFigure').on('click', eToolPointAndFigureClick);

        $('#' + ContainerID + ' .ToolLineBreak').on('click', eToolLineBreakClick);

        $('#' + ContainerID + ' .ToolRenko').on('click', eToolRenkoClick);

        $('#' + ContainerID + ' .ToolKagi').on('click', eToolKagiClick);

        $('#inpToolBarStrokeColor').change(eToolinpToolBarStrokeColorClick);

        $('#inpToolBarHoverColor').change(eToolinpToolBarHoverColorClick);

        $('#inpToolBarFillColor').change(eToolinpToolBarFillColorClick);

        $('#' + ContainerID + ' .Maximize').on('click', eMaximizeClick);

        $('#' + ContainerID + ' .Close').on('click', eCloseClick);

        // Init Plugins        
        BoxSizeSpinner = $('#' + ContainerID + ' .BoxSizeSpinner').WCSpinner({
            DefaultValue: 500,
            MinValue: 1,
            OnEnter: eToolBoxSizeSpinnerOnEnter
        });
        ReversalSpinner = $('#' + ContainerID + ' .ReversalSpinner').WCSpinner({
            DefaultValue: 3,
            MinValue: 1,
            OnEnter: eToolReversalSpinnerOnEnter
        });

        SetTextOfReversalAndBoxSize();
    }

    function SetToolBarActiveClass() {
        //Condition for Chart Marker Visibility
        (ChartInstance.ChartSettings.IsChartMarkerVisible) ? $('#' + ContainerID + ' .ToolMarker').addClass('ToolActive') : $('#' + ContainerID + ' .ToolMarker').removeClass('ToolActive');
        //Condition For Chart Legend Visibility
        (ChartInstance.ChartSettings.IsLegendVisible) ? $('#' + ContainerID + ' .ToolLegend').addClass('ToolActive') : $('#' + ContainerID + ' .ToolLegend').removeClass('ToolActive');
        //Condition For Trade Panel Visiblity
        (ChartInstance.ChartSettings.IsTradePanelVisible) ? $('#' + ContainerID + ' .ToolTradePanel').addClass('ToolActive') : $('#' + ContainerID + ' .ToolTradePanel').removeClass('ToolActive');
        //Condition For Bid Line Visiblity
        (ChartInstance.ChartSettings.IsBidLineVisible) ? $('#' + ContainerID + ' .ToolBidLine').addClass('ToolActive') : $('#' + ContainerID + ' .ToolBidLine').removeClass('ToolActive');
        //Condition For Ask Line Visiblity
        (ChartInstance.ChartSettings.IsAskLineVisible) ? $('#' + ContainerID + ' .ToolAskLine').addClass('ToolActive') : $('#' + ContainerID + ' .ToolAskLine').removeClass('ToolActive');
        //Condition For Period Separator Visiblity
        (ChartInstance.ChartSettings.IsPeriodSeparator) ? $('#' + ContainerID + ' .ToolSeparator').addClass('ToolActive') : $('#' + ContainerID + ' .ToolSeparator').removeClass('ToolActive');
        //Condition For Volume Visiblity
        (ChartInstance.ChartSettings.IsVolumeVisible) ? $('#' + ContainerID + ' .ToolVolume').addClass('ToolActive') : $('#' + ContainerID + ' .ToolVolume').removeClass('ToolActive');

        (ChartInstance.ChartSettings.IsOHLCDigitsVisible) ? $('#' + ContainerID + ' .ToolOHLCDigits').addClass('ToolActive') : $('#' + ContainerID + ' .ToolOHLCDigits').removeClass('ToolActive');


        //Condition for chart Types
        $('#' + ContainerID + ' .ToolCandleStick').removeClass('ToolActive');
        $('#' + ContainerID + ' .ToolBarGraph').removeClass('ToolActive');
        $('#' + ContainerID + ' .ToolLineGraph').removeClass('ToolActive');
        $('#' + ContainerID + ' .ToolPointAndFigure').removeClass('ToolActive');
        $('#' + ContainerID + ' .ToolLineBreak').removeClass('ToolActive');
        $('#' + ContainerID + ' .ToolRenko').removeClass('ToolActive');
        $('#' + ContainerID + ' .ToolKagi').removeClass('ToolActive');

        if (ChartInstance.ChartSettings.GraphType === "CandleStick") {
            $('#' + ContainerID + ' .ToolCandleStick').addClass('ToolActive');
        }
        else if (ChartInstance.ChartSettings.GraphType === "LineChart") {
            $('#' + ContainerID + ' .ToolLineGraph').addClass('ToolActive');
        }
        else if (ChartInstance.ChartSettings.GraphType === "BarChart") {
            $('#' + ContainerID + ' .ToolBarGraph').addClass('ToolActive');
        }
        else if (ChartInstance.ChartSettings.GraphType === "PointAndFigure") {
            $('#' + ContainerID + ' .ToolPointAndFigure').addClass('ToolActive');
        }
        else if (ChartInstance.ChartSettings.GraphType === "LineBreak") {
            $('#' + ContainerID + ' .ToolLineBreak').addClass('ToolActive');
        }
        else if (ChartInstance.ChartSettings.GraphType === "Renko") {
            $('#' + ContainerID + ' .ToolRenko').addClass('ToolActive');
        }
        else if (ChartInstance.ChartSettings.GraphType === "Kagi") {
            $('#' + ContainerID + ' .ToolKagi').addClass('ToolActive');
        }

        // Box Size and Reversal
        DisableBoxSizeReversal();
    }

    function SetVisualToolsMenu(VToolsItems) {
        VisualToolsMenuItems = VToolsItems;
    }

    function GenerateSubItems(_VToolsItems, mode) {
        var vtsubitems = {};
        return vtsubitems;
    }

    function RemoveSettings() {
        self.ChartFormElement.find('.wt-IndicatorSettings').removeAttr('style');
        self.ChartFormElement.find('.wt-IndicatorSettings').attr('style', 'visibility:hidden');
        $('#SettingsContainer' + ContainerID).empty();
        $('#SettingsHeader-' + ContainerID).empty();
        $('#SettingsHeader-' + ContainerID).removeAttr('style');
        $('#SettingsHeader-' + ContainerID).attr('style', 'visibility:hidden');
        IsSettingsVisible = false;
        if (pgDiv !== undefined && pgDiv !== null) {
            pgDiv.PropertyGrid("RemoveProperty", { KeyObject: ContainerID });
        }
        ChartInstance.Resizemethod();
    }

    function SetDefVTSettingsPropertyGrid(SettingsObject, SettingsValues, SettingsContainer, VTObject) {
        SettingsContainer.PropertyGrid("AddProperty", {
            KeyObject: VTObject,
            SetObject: SettingsValues,
            MetaObject: SettingsObject,
            ObjectChanged: function (object, propertyChanged) {
                OnVTDefPropertyValueChange(object, propertyChanged);
            }
        });
    }

    function GenerateVTSettingsHeader(objname) {
        var hdrlayout = null;

        hdrlayout = "<div id='vtsettingsheader'  style='background-color: #E6E7EA; font-family: Verdana; font-size-adjust: 0.5; font-size: 10px; font-weight: bold; height: 18px; line-height: 18px; border: 1px solid #CBCED8; color: rgba(105, 105, 105, 0.81); padding-left: 3pt;'><span class='textTrimmable'>" + objname + "</span><button type='button' id='btnClose" + ContainerID + "' style='float: right; border: none ;color: #FFF; background-color: #505050; height: 13px; line-height: 15px; font-weight: bold; font-family: Verdana; width: 20px;'>x</button></div>";

        return hdrlayout;
    }

    function VTCanvasCtxtMenuCallBack(key) {
        switch (key) {
            case 'Marker':
                {
                    ChartInstance.SetOHLCDataUpperLeftVisibility();
                    ChartInstance.SetMarkerVisibility();
                    SetToolBarActiveClass();
                    break;
                }
            case 'OHLCDigits':
                {
                    ChartInstance.SetOHLCDataUpperLeftVisibility();
                    break;
                }
            case 'Legend':
                {
                    ChartInstance.SetLegendVisibility();
                    SetToolBarActiveClass();
                    break;
                }
            case 'Bid':
                {
                    ChartInstance.ShowHideBidLine();
                    SetToolBarActiveClass();
                    break;
                }
            case 'Ask':
                {
                    ChartInstance.ShowHideAskLine();
                    SetToolBarActiveClass();
                    break;
                }
            case 'CandleStick':
                {
                    ChartInstance.ChangeGraphType("CandleStick");
                    SetToolBarActiveClass();
                    break;
                }
            case 'BarGraph':
                {
                    ChartInstance.ChangeGraphType("BarChart");
                    ChartInstance.Resizemethod();
                    SetToolBarActiveClass();
                    break;
                }
            case 'LineGraph':
                {
                    ChartInstance.ChangeGraphType("LineChart");
                    ChartInstance.Resizemethod();
                    SetToolBarActiveClass();
                    break;
                }
            case 'PointAndFigure':
                {
                    ChartInstance.ChangeGraphType("PointAndFigure");
                    ChartInstance.Resizemethod();
                    SetToolBarActiveClass();
                    break;
                }
            case 'LineBreak':
                {
                    ChartInstance.ChangeGraphType("LineBreak");
                    ChartInstance.Resizemethod();
                    SetToolBarActiveClass();
                    break;
                }
            case 'Renko':
                {
                    ChartInstance.ChangeGraphType("Renko");
                    ChartInstance.Resizemethod();
                    SetToolBarActiveClass();
                    break;
                }
            case 'Kagi':
                {
                    ChartInstance.ChangeGraphType("Kagi");
                    ChartInstance.Resizemethod();
                    SetToolBarActiveClass();
                    break;
                }
            case '1M':
                {
                    ChartInstance.ChangeTimeFrame(1);
                    SetTitleBarCaption();

                    break;
                }
            case '5M':
                {
                    ChartInstance.ChangeTimeFrame(5);
                    SetTitleBarCaption();

                    break;
                }
            case '15M':
                {
                    ChartInstance.ChangeTimeFrame(15);
                    SetTitleBarCaption();

                    break;
                }
            case '30M':
                {
                    ChartInstance.ChangeTimeFrame(30);
                    SetTitleBarCaption();

                    break;
                }
            case '1H':
                {
                    ChartInstance.ChangeTimeFrame(60);
                    SetTitleBarCaption();

                    break;
                }
            case '3H':
                {
                    ChartInstance.ChangeTimeFrame(180);
                    SetTitleBarCaption();

                    break;
                }

            case '4H':
                {
                    ChartInstance.ChangeTimeFrame(240);
                    SetTitleBarCaption();

                    break;
                }
            case '6H':
                {
                    ChartInstance.ChangeTimeFrame(360);
                    SetTitleBarCaption();

                    break;
                }
            case '8H':
                {
                    ChartInstance.ChangeTimeFrame(480);
                    SetTitleBarCaption();

                    break;
                }
            case '12H':
                {
                    ChartInstance.ChangeTimeFrame(720);
                    SetTitleBarCaption();

                    break;
                }
            case 'D1':
                {
                    ChartInstance.ChangeTimeFrame(1440);
                    SetTitleBarCaption();

                    break;
                }
            case 'Weekly':
                {
                    ChartInstance.ChangeTimeFrame(10080);
                    SetTitleBarCaption();

                    break;
                }
            case 'Monthly':
                {
                    ChartInstance.ChangeTimeFrame(43829);
                    SetTitleBarCaption();

                    break;
                }
            case 'TradePanel':
                {
                    ChartInstance.SetTradePanelVisibility();
                    SetToolBarActiveClass();
                    break;
                }

            case 'Separator':
                {
                    ChartInstance.SetPeriodSeparatorVisibility();
                    SetToolBarActiveClass();
                    break;
                }

            case 'Volume':
                {
                    ChartInstance.SetVolumeVisibility();
                    SetToolBarActiveClass();
                    break;
                }
            case 'TrendLine':
                {

                    VisualToolInstance.StartDrawing('trendline');
                    break;
                }
            case 'Ellipse':
                {

                    VisualToolInstance.StartDrawing('ellipse');
                    break;
                }
            case 'Rectangle':
                {

                    VisualToolInstance.StartDrawing('rectangle');
                    break;
                }
            case 'Text':
                {

                    VisualToolInstance.StartDrawing('text');
                    break;
                }
            case 'AndrewsPitch':
                {
                    break;
                }
            case 'LineStyle':
                {
                    ChartInstance.SetLineStyleTrades();
                    break;
                }

            case 'ArrowStyle':
                {
                    ChartInstance.SetArrowStyleTrades();
                    break;
                }

            case 'Hide':
                {
                    ChartInstance.SetTradesVisibility();
                    break;
                }
            case 'Orders':
                {
                    ChartInstance.SetStopLimitVisibility();
                    break;
                }

            case 'WindowChartObject':
                {
                    (self.IsChartObjectsVisible === false) ? self.IsChartObjectsVisible = true : self.IsChartObjectsVisible = false;
                    self.IsExplicitlySetChartObjects = true;
                    self.TempIsChartObjectsVisible = self.IsChartObjectsVisible;
                    SetToolBarGroupVisibility();
                    ChartInstance.Resizemethod();
                    self.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
                    break;
                }
            case 'WindowChartDisplay':
                {
                    (self.IsChartDisplayVisible === false) ? self.IsChartDisplayVisible = true : self.IsChartDisplayVisible = false;
                    self.IsExplicitlySetChartDisplay = true;
                    self.TempIsChartDisplayVisible = self.IsChartDisplayVisible;
                    SetToolBarGroupVisibility();
                    ChartInstance.Resizemethod();
                    self.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
                    break;
                }
            case 'WindowVisualTools':
                {
                    (self.IsVisualToolsVisible === false) ? self.IsVisualToolsVisible = true : self.IsVisualToolsVisible = false;
                    self.IsExplicitlySetVisualTools = true;
                    self.TempIsVisualToolsVisible = self.IsVisualToolsVisible;
                    SetToolBarGroupVisibility();
                    ChartInstance.Resizemethod();
                    self.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
                    break;
                }

            case "LineColorPicker":
                {
                    return false;
                }
                break;

            case "FillColorPicker":
                {
                    return false;
                }
                break;

            case "HoverColorPicker":
                {
                    return false;
                }
                break;


        }
    }

    function VTLineColorPicker(item, opt) {
        var objprop;
        var objname = vtActiveObj[0];
        var objtype = vtActiveObj[1];
        var colorValue = null;
        switch (objtype) {
            case 'line':
                {
                    objprop = VisualToolInstance.GetTrendlineProp(objname, null);
                    if (objprop === null) {
                        colorValue = "#585858";
                    }
                    else {
                        colorValue = objprop.StrokeColor;
                    }
                }
                break;

            case 'ellipse':
                {
                    objprop = VisualToolInstance.GetEllipseProp(objname);
                    if (objprop === null) {
                        colorValue = "#585858";
                    }
                    else {
                        colorValue = objprop.StrokeColor;
                    }
                }
                break;

            case 'rect':
                {
                    objprop = VisualToolInstance.GetRectProp(objname);
                    if (objprop === null) {
                        colorValue = "#585858";
                    }
                    else {
                        colorValue = objprop.StrokeColor;
                    }
                }
                break;

            case 'i-text':
                {
                    objprop = VisualToolInstance.GetTextStyleProp(objname);
                    if (objprop === null) {
                        colorValue = "#585858";
                    }
                    else {
                        colorValue = objprop.ForeColor;
                    }
                }
                break;
        }

        var coltemplate = $('<div style="line-height: 20px; height: 20px;"><span style="width:80px; vertical-align: top;">Line Color </span><input style="width:50px;" id="CtxMenuLineColorPicker" class="spLineColorPicker" /></div>');
        var SpColpicker = coltemplate.find('.spLineColorPicker').spectrum({
            color: colorValue
            , showPalette: true
            , palette: [
                       ["#000", "#444", "#666", "#999", "#ccc", "#eee", "#f3f3f3", "#fff"],
                       ["#f00", "#f90", "#ff0", "#0f0", "#0ff", "#00f", "#90f", "#f0f"],
                       ["#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc"],
                       ["#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
                       ["#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6fa8dc", "#8e7cc3", "#c27ba0"],
                       ["#c00", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3d85c6", "#674ea7", "#a64d79"],
                       ["#900", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#0b5394", "#351c75", "#741b47"],
                       ["#600", "#783f04", "#7f6000", "#274e13", "#0c343d", "#073763", "#20124d", "#4c1130"]
            ]
           , showPaletteOnly: true
           , togglePaletteOnly: true
           , cancelText: 'Cancel'
           , chooseText: 'Select'
           , togglePaletteMoreText: 'More'
           , togglePaletteLessText: 'Less'
           , hideAfterPaletteSelect: true
        });
        SpColpicker.on("change", function (options, color) {

            var objname = vtActiveObj[0];
            var objtype = vtActiveObj[1];
            var value = color.toHexString();
            switch (objtype) {
                case 'line':
                    {
                        VisualToolInstance.UpdateTLineExtProp(objname, value, null, null, null);
                    }
                    break;
                case 'rect':
                    {
                        VisualToolInstance.UpdateRectStyleProp(objname, value, null, null, null);
                    }
                    break;

                case 'ellipse':
                    {
                        VisualToolInstance.UpdateEllipseStyleProp(objname, value, null, null, null);
                    }
                    break;
                case 'i-text':
                    {
                        VisualToolInstance.UpdateTextStyleProp(objname, null, value, null, null);
                    }
                    break;
            }
        });

        return coltemplate;


    }

    function VTFillColorPicker(item, opt) {

        var objprop;
        var objname = vtActiveObj[0];
        var objtype = vtActiveObj[1];
        var colorValue = null;
        var IsDisabled = false;
        switch (objtype) {
            case 'line':
                {
                    IsDisabled = true;
                }
                break;

            case 'ellipse':
                {
                    objprop = VisualToolInstance.GetEllipseProp(objname);
                }
                break;

            case 'rect':
                {
                    objprop = VisualToolInstance.GetRectProp(objname);
                }
                break;

            case 'i-text':
                {
                    IsDisabled = true;

                }
                break;
        }

        if (objprop === null) {
            colorValue = "#585858";
        }
        else {
            colorValue = objprop.FillColor;
        }

        var coltemplate = $('<div style="line-height: 20px; height: 20px;"><span style="width:80px; vertical-align: top;">Fill Color </span><input style="width:50px;" id="CtxMenuFillColorPicker" class="spFillColorPicker" /></div>');
        var SpColpicker = coltemplate.find('.spFillColorPicker').spectrum({
            color: colorValue
            , disabled: IsDisabled
            , showPalette: true
            , palette: [
                       ["#000", "#444", "#666", "#999", "#ccc", "#eee", "#f3f3f3", "#fff"],
                       ["#f00", "#f90", "#ff0", "#0f0", "#0ff", "#00f", "#90f", "#f0f"],
                       ["#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc"],
                       ["#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
                       ["#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6fa8dc", "#8e7cc3", "#c27ba0"],
                       ["#c00", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3d85c6", "#674ea7", "#a64d79"],
                       ["#900", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#0b5394", "#351c75", "#741b47"],
                       ["#600", "#783f04", "#7f6000", "#274e13", "#0c343d", "#073763", "#20124d", "#4c1130"]
            ]
           , showPaletteOnly: true
           , togglePaletteOnly: true
           , cancelText: 'Cancel'
           , chooseText: 'Select'
           , togglePaletteMoreText: 'More'
           , togglePaletteLessText: 'Less'
           , hideAfterPaletteSelect: true
        });

        if (objprop === null) {
            $("#CtxMenuFillColorPicker").spectrum({
                disabled: true
            });
        }


        SpColpicker.on("change", function (options, color) {
            var objname = vtActiveObj[0];
            var objtype = vtActiveObj[1];
            var value = color.toHexString();
            switch (objtype) {
                case 'rect':
                    {
                        VisualToolInstance.UpdateRectStyleProp(objname, null, value, null, null);
                    }
                    break;

                case 'ellipse':
                    {
                        VisualToolInstance.UpdateEllipseStyleProp(objname, null, value, null, null);
                    }
                    break;
            }
        });

        return coltemplate;
    }

    function VTHoverColorPicker(item, opt) {

        var objprop;
        var objname = vtActiveObj[0];
        var objtype = vtActiveObj[1];
        var colorValue = null;
        switch (objtype) {
            case 'line':
                {
                    objprop = VisualToolInstance.GetTrendlineProp(objname, null);
                }
                break;

            case 'ellipse':
                {
                    objprop = VisualToolInstance.GetEllipseProp(objname);
                }
                break;

            case 'rect':
                {
                    objprop = VisualToolInstance.GetRectProp(objname);
                }
                break;

            case 'i-text':
                {
                    objprop = VisualToolInstance.GetTextStyleProp(objname);
                }
                break;
        }

        if (objprop === null) {
            colorValue = "#585858";
        }
        else {
            colorValue = objprop.HoverColor;
        }
        var coltemplate = $('<div style="line-height: 20px; height: 20px;"><span style="width:80px; vertical-align: top;">Hover Color </span><input style="width:50px;" id="CtxMenuHoverColorPicker" class="spHoverColorPicker" /></div>');
        var SpColpicker = coltemplate.find('.spHoverColorPicker').spectrum({
            color: colorValue
            , showPalette: true
            , palette: [
                       ["#000", "#444", "#666", "#999", "#ccc", "#eee", "#f3f3f3", "#fff"],
                       ["#f00", "#f90", "#ff0", "#0f0", "#0ff", "#00f", "#90f", "#f0f"],
                       ["#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc"],
                       ["#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
                       ["#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6fa8dc", "#8e7cc3", "#c27ba0"],
                       ["#c00", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3d85c6", "#674ea7", "#a64d79"],
                       ["#900", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#0b5394", "#351c75", "#741b47"],
                       ["#600", "#783f04", "#7f6000", "#274e13", "#0c343d", "#073763", "#20124d", "#4c1130"]
            ]
           , showPaletteOnly: true
           , togglePaletteOnly: true
           , cancelText: 'Cancel'
           , chooseText: 'Select'
           , togglePaletteMoreText: 'More'
           , togglePaletteLessText: 'Less'
           , hideAfterPaletteSelect: true
        });
        SpColpicker.on("change", function (options, color) {

            var value = color.toHexString();
            var objname = vtActiveObj[0];
            var objtype = vtActiveObj[1];
            switch (objtype) {
                case 'line':
                    {
                        VisualToolInstance.UpdateTLineExtProp(objname, null, value, null, null);
                    }
                    break;
                case 'rect':
                    {
                        VisualToolInstance.UpdateRectStyleProp(objname, null, null, value, null);
                    }
                    break;

                case 'ellipse':
                    {
                        VisualToolInstance.UpdateEllipseStyleProp(objname, null, null, value, null);
                    }
                    break;
                case 'i-text':
                    {
                        VisualToolInstance.UpdateTextStyleProp(objname, null, null, value, null);
                    }
                    break;
            }
        });


        return coltemplate;
    }

    function SetContextMenu() {
        SetTitleBarCaption();
        var menuCallBack = function (key) {
            switch (key) {
                case "Marker":
                    eToolMarkerClick();
                    break;
                case "OHLCDigits":
                    eToolOHLCDigitsClick();
                    break;
                case "Legend":
                    eToolLegendClick();
                    break;
                case "Bid":
                    eToolBidLineClick();
                    break;
                case "Ask":
                    eToolAskLineClick();
                    break;
                case "CandleStick":
                    eToolCandleStickClick();
                    break;
                case "BarGraph":
                    eToolBarClick();
                    break;
                case "LineGraph":
                    eToolLineClick();
                    break;
                case "PointAndFigure":
                    eToolPointAndFigureClick();
                    break;
                case "LineBreak":
                    eToolLineBreakClick();
                    break;
                case "Renko":
                    eToolRenkoClick();
                    break;
                case "Kagi":
                    eToolKagiClick();
                    break;
                case "TradePanel":
                    eToolTradePanelClick();
                    break;
                case "Separator":
                    eToolSeparatorClick();
                    break;
                case "Volume":
                    eToolVolumeClick();
                    break;
                case "TrendLine":
                    eToolTrendLineClick();
                    break;
                case "Ellipse":
                    eToolEllipsisClick();
                    break;
                case "Rectangle":
                    eToolRectangleClick();
                    break;
                case "Text":
                    eToolTextClick();
                    break;
                case "LineStyle":
                    ChartInstance.SetLineStyleTrades();
                    break;
                case "ArrowStyle":
                    ChartInstance.SetArrowStyleTrades();
                    break;
                case "Hide":
                    ChartInstance.SetTradesVisibility();
                    break;
                case "Orders":
                    ChartInstance.SetStopLimitVisibility();
                    break;
                case "RemoveAllVT":
                    VisualToolInstance.RemoveAllObjects();
                    break;
                case "WindowChartObject":
                    (self.IsChartObjectsVisible === false) ? self.IsChartObjectsVisible = true : self.IsChartObjectsVisible = false;
                    self.IsExplicitlySetChartObjects = true;
                    self.TempIsChartObjectsVisible = self.IsChartObjectsVisible;
                    SetToolBarGroupVisibility();
                    ChartInstance.Resizemethod();
                    self.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
                    break;
                case "WindowChartDisplay":
                    (self.IsChartDisplayVisible === false) ? self.IsChartDisplayVisible = true : self.IsChartDisplayVisible = false;
                    self.IsExplicitlySetChartDisplay = true;
                    self.TempIsChartDisplayVisible = self.IsChartDisplayVisible;
                    SetToolBarGroupVisibility();
                    ChartInstance.Resizemethod();
                    self.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
                    break;
                case "WindowVisualTools":
                    (self.IsVisualToolsVisible === false) ? self.IsVisualToolsVisible = true : self.IsVisualToolsVisible = false;
                    self.IsExplicitlySetVisualTools = true;
                    self.TempIsVisualToolsVisible = self.IsVisualToolsVisible;
                    SetToolBarGroupVisibility();
                    ChartInstance.Resizemethod();
                    self.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
                    break;
                case "ColorScheme":
                    ChartColorSchemeVisibility();
                    break;
                case "AskBidLineAlways":
                    ChartInstance.SetAlwaysVisibleBidAsk();
                    break;
                default:
                    var items = $.grep(self.TimeFrameItems, function (item) {
                        return (item.Id == key);
                    });
                    if (items.length) {
                        ChangeTimeFrame(items[0].Value);
                    }
            }
        };

        var determinePositionFunc = function ($menu) { $menu.css('display', 'block').position({ my: "left top", at: "left bottom", of: this, offset: "0 5", collision: "fit" }).css('display', 'none'); };

        BottomIndicatorChartContainer.PTContextMenu({
            activation: "rightclick",
            callBack: VTCanvasCtxtMenuCallBack,
            zIndex: 20,
            AppendToParent: true,
            items: function () {
                var Value = ChartInstance.GetPrice(ChartInstance.ChartOtherProperties.HoveredYaxis);
                if (!ChartInstance.Digits || Value === null) {
                    return {};
                }
                var HoveredPrice = Value.toFixed(ChartInstance.Digits);
                var SellWord = "";
                var BuyWord = "";
                if (HoveredPrice > ChartInstance.ChartOtherProperties.BidValue && HoveredPrice < ChartInstance.ChartOtherProperties.AskValue) {
                    SellWord = "Limit";
                    BuyWord = "Limit";
                }
                else if (HoveredPrice >= ChartInstance.ChartOtherProperties.AskValue) {
                    SellWord = "Limit";
                    BuyWord = "Stop";
                }
                else {
                    SellWord = "Stop";
                    BuyWord = "Limit";
                }
                if (vtActiveObj === null) {
                    var contextMenuItemsObject = {};
                    if (self.IsShowTrades) {
                        contextMenuItemsObject["RCNewTrade"] = { // New Trade/Order
                            name: "New Trade/Order", className: "InActiveNewTrade", callback: function () { _comObj.Trigger("showTradeOrderForm", self.Symbol()); }
                        };
                        contextMenuItemsObject["RCSellLimit"] = { // Sell Stop
                            name: "Sell " + SellWord + " at " + HoveredPrice, className: "InActiveSellLimit", callback: function () { setTimeout(_comObj.Trigger("showOrderForm", [self.Symbol(), parseFloat(HoveredPrice)]), 500); }
                        };
                        contextMenuItemsObject["RCBuyLimit"] = { // Buy Limit
                            name: "Buy " + BuyWord + " at " + HoveredPrice, className: "InActiveBuyLimit", callback: function () { setTimeout(_comObj.Trigger("showOrderForm", [self.Symbol(), parseFloat(HoveredPrice)]), 500); }
                        };
                    }

                    if (self.IsShowSymbolSelector) {
                        contextMenuItemsObject["SymbolSelector"] = { // Symbol Selector
                            Name: "SymbolSelector", className: "InActiveSymbolSelector", appendElement: GetSymbolSelector(), HasBorderTop: true, callback: function () {
                                return false;
                            }
                        }
                    }

                    if (self.IsShowGraphType) { // Graph Type
                        contextMenuItemsObject["RCGraphType"] = {
                            name: "Graph Type", className: "InActiveGraphType", items: {}
                        }

                        if (self.IsShowCandleStick) {
                            contextMenuItemsObject["RCGraphType"].items["CandleStick"] = {
                                name: "CandleStick", className: "CandleStick" + ((ChartInstance.ChartSettings.GraphType === "CandleStick") ? " ActiveMenuItemCandleStick" : " InActiveCandleStick")
                            }
                        }

                        if (self.IsShowBar) {
                            contextMenuItemsObject["RCGraphType"].items["BarGraph"] = {
                                name: "Bar Graph", className: "BarGraph" + ((ChartInstance.ChartSettings.GraphType === "BarChart") ? " ActiveMenuItemBarGraph" : " InActiveBarGraph")
                            }
                        }

                        if (self.IsShowLine) {
                            contextMenuItemsObject["RCGraphType"].items["LineGraph"] = {
                                name: "LineGraph", className: "LineGraph" + ((ChartInstance.ChartSettings.GraphType === "LineChart") ? " ActiveMenuItemLineGraph" : " InActiveLineGraph")
                            }
                        }

                        if (self.IsShowPointAndFigure) {
                            contextMenuItemsObject["RCGraphType"].items["PointAndFigure"] = {
                                name: "PointAndFigure", className: "PointAndFigure" + ((ChartInstance.ChartSettings.GraphType === "PointAndFigure") ? " ActiveMenuItemPointAndFigure" : " InActivePointAndFigure")
                            }
                        }

                        if (self.IsShowLineBreak) {
                            contextMenuItemsObject["RCGraphType"].items["LineBreak"] = {
                                name: "LineBreak", className: "LineBreak" + ((ChartInstance.ChartSettings.GraphType === "LineBreak") ? " ActiveMenuItemLineBreak" : " InActiveLineBreak")
                            }
                        }

                        if (self.IsShowRenko) {
                            contextMenuItemsObject["RCGraphType"].items["Renko"] = {
                                name: "Renko", className: "Renko" + ((ChartInstance.ChartSettings.GraphType === "Renko") ? " ActiveMenuItemRenko" : " InActiveRenko")
                            }
                        }

                        if (self.IsShowKagi) {
                            contextMenuItemsObject["RCGraphType"].items["Kagi"] = {
                                name: "Kagi", className: "Kagi" + ((ChartInstance.ChartSettings.GraphType === "Kagi") ? " ActiveMenuItemKagi" : " InActiveKagi")
                            }
                        }
                    }

                    if (self.IsShowTimeframe) { // Timeframe
                        contextMenuItemsObject["RCTimeFrame"] = {
                            name: txtTimeframe, className: "InActiveTimeFrame", items: TimeFrameItems()
                        }

                    }

                    if (self.IsShowChartObjects) { // Chart Objects
                        contextMenuItemsObject["RCChartObjects"] = {
                            name: "Chart Objects", className: "InActiveChartObjects", items: {}
                        }

                        if (self.IsShowMarker) {
                            contextMenuItemsObject["RCChartObjects"].items["Marker"] = {
                                name: "Marker", className: ((ChartInstance.ChartSettings.IsChartMarkerVisible) ? "ActiveMenuItemMarker" : "InActiveMarker")
                            }
                        }

                        if (self.IsShowLegend) {
                            contextMenuItemsObject["RCChartObjects"].items["Legend"] = {
                                name: "Legend", className: ((ChartInstance.ChartSettings.IsLegendVisible) ? "ActiveMenuItemLegend" : "InActiveLegend")
                            }
                        }

                        if (self.IsShowTradePanel) {
                            contextMenuItemsObject["RCChartObjects"].items["TradePanel"] = {
                                name: "TradePanel", className: ((ChartInstance.ChartSettings.IsTradePanelVisible) ? "ActiveMenuItemTradePanel" : "InActiveTradePanel")
                            }
                        }

                        if (self.IsShowBidLine) {
                            contextMenuItemsObject["RCChartObjects"].items["Bid"] = {
                                name: "Bid", className: ((ChartInstance.ChartSettings.IsBidLineVisible) ? "ActiveMenuItemBidLine" : "InActiveBidLine")
                            }
                        }

                        if (self.IsShowAskLine) {
                            contextMenuItemsObject["RCChartObjects"].items["Ask"] = {
                                name: "Ask", className: ((ChartInstance.ChartSettings.IsAskLineVisible) ? "ActiveMenuItemAskLine" : "InActiveAskLine")
                            }
                        }

                        if (self.IsShowSeparator) {
                            contextMenuItemsObject["RCChartObjects"].items["Separator"] = {
                                name: "Period Separator", className: ((ChartInstance.ChartSettings.IsPeriodSeparator) ? "ActiveMenuItemSeparator" : "InActiveSeparator")
                            }
                        }

                        if (self.IsShowVolume) {
                            contextMenuItemsObject["RCChartObjects"].items["Volume"] = {
                                name: "Volume", className: ((ChartInstance.ChartSettings.IsVolumeVisible) ? "ActiveMenuItemVolume" : "InActiveVolume")
                            }
                        }

                        if (self.IsShowOHLCDigits) {
                            contextMenuItemsObject["RCChartObjects"].items["OHLCDigits"] = {
                                name: "OHLC Digits", className: ((ChartInstance.ChartSettings.IsOHLCDigitsVisible) ? "ActiveMenuItemOHLCDigits" : "InActiveOHLCDigits")
                            }

                            // OHLC Digits Position Element
                            var odp_element = $('<div id="odp_element-OHLC"/>').css({ "width": "100px", "height": "19px" }).DropDown({
                                controltype: "on-options",
                                items: ["Top Left", "Bottom Right"],
                                setvalue: ChartInstance.ChartSettings.IsOHLCDigitsBottomRight ? "Bottom Right" : "Top Left",
                                selecteditem: function (value) {
                                    if (value == "Top Left") {
                                        ChartInstance.ChartSettings.IsOHLCDigitsBottomRight = false;
                                    } else {
                                        ChartInstance.ChartSettings.IsOHLCDigitsBottomRight = true;
                                    }
                                }
                            });

                            contextMenuItemsObject["OHLCDigitsPosition"] = {
                                name: "OHLC Digits Position", appendElement: odp_element, callback: function () { return false; }
                            }
                        }

                        if (self.IsShowTrades) {
                            contextMenuItemsObject["RCChartObjects"].items["Trades"] = {
                                name: "Trades", className: "InActiveTrades", items: {
                                    "LineStyle": { name: "Line Style", className: ((ChartInstance.ChartSettings.IsLineStyle) ? "ActiveMenuItemLineStyle" : "InActiveLine") }, "ArrowStyle": { name: "Arrow Style", className: ((ChartInstance.ChartSettings.IsArrowStyle) ? "ActiveMenuItemArrowStyle" : "InActiveArrow") }, "Hide": { name: "Hide", className: ((!ChartInstance.ChartSettings.IsOpenTradeVisible) ? "ActiveMenuItemHide" : "InActiveHide") }
                                }
                            }

                            contextMenuItemsObject["RCChartObjects"].items["Orders"] = {
                                name: "Orders", className: ((ChartInstance.ChartSettings.IsOrdersVisible) ? "ActiveMenuItemAOrders" : "InActiveOrders")
                            }
                        }
                    }

                    if (self.IsShowIndicator) { // Indicators
                        var contextMenuObj = self.IsUseSpecialIndicatorList ? IndicatorInstance.SpecialContextMenuObject(IndicatorCtxMenuCallBack, IndicatorSettingsFunction) : IndicatorInstance.ContextMenuObject(IndicatorCtxMenuCallBack, IndicatorSettingsFunction);

                        contextMenuItemsObject["RCIndicators"] = {
                            name: txtIndicators, className: "InIndicatorsMenu", items: contextMenuObj
                        }
                    }

                    if (self.IsShowVisualTools) { // Visual Tools
                        contextMenuItemsObject["RCVisualTools"] = {
                            name: txtVisualTools, className: "InActiveVisualTools", items: VTInstance.ContextMenuObject(VisualToolsCtxMenuCallBack, VisualToolsSettingsFunction)
                        }
                    }

                    contextMenuItemsObject["RCRefreshChart"] = { // Refresh Chart
                        name: txtRefreshChart, className: "InActiveRefresh", callback: function () {
                            ChartInstance.RefreshChartData();
                        }
                    };

                    return contextMenuItemsObject;
                } else {
                    var contextMenuObj = self.IsUseSpecialIndicatorList ? IndicatorInstance.SpecialContextMenuObjectContextMenuObject(IndicatorCtxMenuCallBack, IndicatorSettingsFunction) : IndicatorInstance.ContextMenuObject(IndicatorCtxMenuCallBack, IndicatorSettingsFunction);

                    return {
                        "RCVTSettings": {
                            name: "Settings", callback: function () {
                                var selectedVTObject = VisualToolInstance.GetActiveObject(vtActiveObj[0]);
                                ShowVTSettings(selectedVTObject);
                            }
                        },

                        "VTLineColorPicker": {
                            Name: "SymbolSelector", appendElement: VTLineColorPicker(), callback: function () {
                                return false;
                            }
                        },

                        "VTHoverColorPicker": {
                            Name: "SymbolSelector", appendElement: VTHoverColorPicker(), callback: function () {
                                return false;
                            }
                        },

                        "VTFillColorPicker": {
                            Name: "SymbolSelector", appendElement: VTFillColorPicker(), callback: function () {
                                return false;
                            }
                        },

                        "RCNewTrade": {
                            name: "New Trade/Order", className: "InActiveNewTrade", callback: function () { _comObj.Trigger("showTradeOrderForm", self.Symbol()); }
                        },
                        "RCSellLimit": {
                            name: "Sell " + SellWord + " at " + HoveredPrice, className: "InActiveSellLimit", callback: function () { setTimeout(_comObj.Trigger("showOrderForm", [self.Symbol(), parseFloat(HoveredPrice)]), 500); }
                        },
                        "RCBuyLimit": {
                            name: "Buy " + BuyWord + " at " + HoveredPrice, className: "InActiveBuyLimit", callback: function () { setTimeout(_comObj.Trigger("showOrderForm", [self.Symbol(), parseFloat(HoveredPrice)]), 500); }
                        },
                        "SymbolSelector": {
                            Name: "SymbolSelector", className: "InActiveSymbolSelector", appendElement: GetSymbolSelector(), callback: function () {
                                return false;
                            }
                        },
                        "RCGraphType": {
                            name: "Graph Type", className: "InActiveGraphType", items: { "CandleStick": { name: "CandleStick", className: "CandleStick" + ((ChartInstance.ChartSettings.GraphType === "CandleStick") ? " ActiveMenuItemCandleStick" : " InActiveCandleStick") }, "BarGraph": { name: "Bar Graph", className: "BarGraph" + ((ChartInstance.ChartSettings.GraphType === "BarChart") ? " ActiveMenuItemBarGraph" : " InActiveBarGraph") }, "LineGraph": { name: "LineGraph", className: "LineGraph" + ((ChartInstance.ChartSettings.GraphType === "LineChart") ? " ActiveMenuItemLineGraph" : " InActiveLineGraph") }, "PointAndFigure": { name: "PointAndFigure", className: "PointAndFigure" + ((ChartInstance.ChartSettings.GraphType === "PointAndFigure") ? " ActiveMenuItemPointAndFigure" : " InActivePointAndFigure") }, "LineBreak": { name: "LineBreak", className: "LineBreak" + ((ChartInstance.ChartSettings.GraphType === "LineBreak") ? " ActiveMenuItemLineBreak" : " InActiveLineBreak") }, "Renko": { name: "Renko", className: "Renko" + ((ChartInstance.ChartSettings.GraphType === "Renko") ? " ActiveMenuItemRenko" : " InActiveRenko") }, "Kagi": { name: "Kagi", className: "Kagi" + ((ChartInstance.ChartSettings.GraphType === "Kagi") ? " ActiveMenuItemKagi" : " InActiveKagi") } }
                        },
                        "RCTimeFrame": {
                            name: "Time Frame", className: "InActiveTimeFrame", items: { "1M": { name: "1 Minute", className: ((ChartInstance.ChartSettings.TimeFrame === 1) ? "ContextMenuChecked" : "") }, "5M": { name: "5 Minute", className: ((ChartInstance.ChartSettings.TimeFrame === 5) ? "ContextMenuChecked" : "") }, "15M": { name: "15 Minute", className: ((ChartInstance.ChartSettings.TimeFrame === 15) ? "ContextMenuChecked" : "") }, "30M": { name: "30 Minute", className: ((ChartInstance.ChartSettings.TimeFrame === 30) ? "ContextMenuChecked" : "") }, "1H": { name: "1 Hour", className: ((ChartInstance.ChartSettings.TimeFrame === 60) ? "ContextMenuChecked" : "") }, "4H": { name: "4 Hours", className: ((ChartInstance.ChartSettings.TimeFrame === 240) ? "ContextMenuChecked" : "") }, "D1": { name: "Daily", className: ((ChartInstance.ChartSettings.TimeFrame === 1440) ? "ContextMenuChecked" : "") } }
                        },
                        "RCChartObjects": {
                            name: "Chart Objects", className: "InActiveChartObjects", items: {
                                "Marker": { name: "Marker", className: ((ChartInstance.ChartSettings.IsChartMarkerVisible) ? "ActiveMenuItemMarker" : "InActiveMarker") },
                                "Legend": { name: "Legend", className: ((ChartInstance.ChartSettings.IsLegendVisible) ? "ActiveMenuItemLegend" : "InActiveLegend") },
                                "TradePanel": { name: "TradePanel", className: ((ChartInstance.ChartSettings.IsTradePanelVisible) ? "ActiveMenuItemTradePanel" : "InActiveTradePanel") },
                                "Bid": { name: "Bid", className: ((ChartInstance.ChartSettings.IsBidLineVisible) ? "ActiveMenuItemBidLine" : "InActiveBidLine") },
                                "Ask": { name: "Ask", className: ((ChartInstance.ChartSettings.IsAskLineVisible) ? "ActiveMenuItemAskLine" : "InActiveAskLine") },
                                "Separator": { name: "Period Separator", className: ((ChartInstance.ChartSettings.IsPeriodSeparator) ? "ActiveMenuItemSeparator" : "InActiveSeparator") },
                                "Volume": { name: "Volume", className: ((ChartInstance.ChartSettings.IsVolumeVisible) ? "ActiveMenuItemVolume" : "InActiveVolume") },
                                "Trades": {
                                    name: "Trades", className: "InActiveTrades", items: {
                                        "LineStyle": { name: "Line Style", className: ((ChartInstance.ChartSettings.IsLineStyle) ? "ActiveMenuItemLineStyle" : "InActiveLine") }, "ArrowStyle": { name: "Arrow Style", className: ((ChartInstance.ChartSettings.IsArrowStyle) ? "ActiveMenuItemArrowStyle" : "InActiveArrow") }, "Hide": { name: "Hide", className: ((!ChartInstance.ChartSettings.IsOpenTradeVisible) ? "ActiveMenuItemHide" : "InActiveHide") }
                                    }
                                },
                                "Orders": { name: "Orders", className: ((ChartInstance.ChartSettings.IsOrdersVisible) ? "ActiveMenuItemAOrders" : "InActiveOrders") }
                            }
                        },
                        "RCIndicators": {
                            name: "Indicators", className: "InIndicatorsMenu", items: contextMenuObj
                        },
                        "RCVisualTools": {
                            name: "Visual Tools", className: "InIndicatorsMenu", items: VTInstance.ContextMenuObject(VisualToolsCtxMenuCallBack, VisualToolsSettingsFunction)
                        },
                        "RCRefreshChart": {
                            name: txtRefreshChart, className: "InActiveRefresh", callback: function () {
                                ChartInstance.RefreshChartData();
                            }
                        }
                    };
                }
            }
        });

        if (!Options.IsChartDisplayDisabled) {
            ChartHolder.PTContextMenu({
                activation: "rightclick",
                callBack: VTCanvasCtxtMenuCallBack,
                zIndex: 20,
                AppendToParent: true,
                close: function () {
                    if (SymbolSelectorElement !== null && SymbolSelectorElement !== "") {
                        //SymbolSelectorElement.show(false);
                        SymbolSelectorElement.SymbolSelector("show", false);
                    }
                },
                items: function () {
                    var Value = ChartInstance.GetPrice(ChartInstance.ChartOtherProperties.HoveredYaxis);
                    if (!ChartInstance.Digits || Value === null) {
                        return {};
                    }
                    var HoveredPrice = Value.toFixed(ChartInstance.Digits);
                    var SellWord = "";
                    var BuyWord = "";
                    if (HoveredPrice > ChartInstance.ChartOtherProperties.BidValue && HoveredPrice < ChartInstance.ChartOtherProperties.AskValue) {
                        SellWord = "Limit";
                        BuyWord = "Limit";
                    }
                    else if (HoveredPrice >= ChartInstance.ChartOtherProperties.AskValue) {
                        SellWord = "Limit";
                        BuyWord = "Stop";
                    }
                    else {
                        SellWord = "Stop";
                        BuyWord = "Limit";
                    }
                    if (vtActiveObj === null) {
                        var contextMenuItemsObject = {};
                        if (self.IsShowTrades) {
                            contextMenuItemsObject["RCNewTrade"] = { // New Trade/Order
                                name: "New Trade/Order", className: "InActiveNewTrade", callback: function () { _comObj.Trigger("showTradeOrderForm", self.Symbol()); }
                            };
                            contextMenuItemsObject["RCSellLimit"] = { // Sell Stop
                                name: "Sell " + SellWord + " at " + HoveredPrice, className: "InActiveSellLimit", callback: function () { setTimeout(_comObj.Trigger("showOrderForm", [self.Symbol(), parseFloat(HoveredPrice)]), 500); }
                            };
                            contextMenuItemsObject["RCBuyLimit"] = { // Buy Limit
                                name: "Buy " + BuyWord + " at " + HoveredPrice, className: "InActiveBuyLimit", callback: function () { setTimeout(_comObj.Trigger("showOrderForm", [self.Symbol(), parseFloat(HoveredPrice)]), 500); }
                            };
                        }

                        if (self.IsShowSymbolSelector) {
                            contextMenuItemsObject["SymbolSelector"] = { // Symbol Selector
                                Name: "SymbolSelector", className: "InActiveSymbolSelector", appendElement: GetSymbolSelector(), HasBorderTop: true, callback: function () {
                                    return false;
                                }
                            }
                        }

                        if (self.IsShowGraphType) { // Graph Type
                            contextMenuItemsObject["RCGraphType"] = {
                                name: "Graph Type", className: "InActiveGraphType", items: {}
                            }

                            if (self.IsShowCandleStick) {
                                contextMenuItemsObject["RCGraphType"].items["CandleStick"] = {
                                    name: "CandleStick", className: "CandleStick" + ((ChartInstance.ChartSettings.GraphType === "CandleStick") ? " ActiveMenuItemCandleStick" : " InActiveCandleStick")
                                }
                            }

                            if (self.IsShowBar) {
                                contextMenuItemsObject["RCGraphType"].items["BarGraph"] = {
                                    name: "Bar Graph", className: "BarGraph" + ((ChartInstance.ChartSettings.GraphType === "BarChart") ? " ActiveMenuItemBarGraph" : " InActiveBarGraph")
                                }
                            }

                            if (self.IsShowLine) {
                                contextMenuItemsObject["RCGraphType"].items["LineGraph"] = {
                                    name: "LineGraph", className: "LineGraph" + ((ChartInstance.ChartSettings.GraphType === "LineChart") ? " ActiveMenuItemLineGraph" : " InActiveLineGraph")
                                }
                            }

                            if (self.IsShowPointAndFigure) {
                                contextMenuItemsObject["RCGraphType"].items["PointAndFigure"] = {
                                    name: "PointAndFigure", className: "PointAndFigure" + ((ChartInstance.ChartSettings.GraphType === "PointAndFigure") ? " ActiveMenuItemPointAndFigure" : " InActivePointAndFigure")
                                }
                            }

                            if (self.IsShowLineBreak) {
                                contextMenuItemsObject["RCGraphType"].items["LineBreak"] = {
                                    name: "LineBreak", className: "LineBreak" + ((ChartInstance.ChartSettings.GraphType === "LineBreak") ? " ActiveMenuItemLineBreak" : " InActiveLineBreak")
                                }
                            }

                            if (self.IsShowRenko) {
                                contextMenuItemsObject["RCGraphType"].items["Renko"] = {
                                    name: "Renko", className: "Renko" + ((ChartInstance.ChartSettings.GraphType === "Renko") ? " ActiveMenuItemRenko" : " InActiveRenko")
                                }
                            }

                            if (self.IsShowKagi) {
                                contextMenuItemsObject["RCGraphType"].items["Kagi"] = {
                                    name: "Kagi", className: "Kagi" + ((ChartInstance.ChartSettings.GraphType === "Kagi") ? " ActiveMenuItemKagi" : " InActiveKagi")
                                }
                            }
                        }

                        if (self.IsShowTimeframe) { // Timeframe
                            contextMenuItemsObject["RCTimeFrame"] = {
                                name: txtTimeframe, className: "InActiveTimeFrame", items: TimeFrameItems()
                            }
                        }

                        if (self.IsShowChartObjects) { // Chart Objects
                            contextMenuItemsObject["RCChartObjects"] = {
                                name: txtChartObject, className: "InActiveChartObjects", items: {}
                            }

                            if (self.IsShowMarker) {
                                contextMenuItemsObject["RCChartObjects"].items["Marker"] = {
                                    name: "Marker", className: ((ChartInstance.ChartSettings.IsChartMarkerVisible) ? "ActiveMenuItemMarker" : "InActiveMarker")
                                }
                            }

                            if (self.IsShowLegend) {
                                contextMenuItemsObject["RCChartObjects"].items["Legend"] = {
                                    name: "Legend", className: ((ChartInstance.ChartSettings.IsLegendVisible) ? "ActiveMenuItemLegend" : "InActiveLegend")
                                }
                            }

                            if (self.IsShowTradePanel) {
                                contextMenuItemsObject["RCChartObjects"].items["TradePanel"] = {
                                    name: "TradePanel", className: ((ChartInstance.ChartSettings.IsTradePanelVisible) ? "ActiveMenuItemTradePanel" : "InActiveTradePanel")
                                }
                            }

                            if (self.IsShowBidLine) {
                                contextMenuItemsObject["RCChartObjects"].items["Bid"] = {
                                    name: "Bid", className: ((ChartInstance.ChartSettings.IsBidLineVisible) ? "ActiveMenuItemBidLine" : "InActiveBidLine")
                                }
                            }

                            if (self.IsShowAskLine) {
                                contextMenuItemsObject["RCChartObjects"].items["Ask"] = {
                                    name: "Ask", className: ((ChartInstance.ChartSettings.IsAskLineVisible) ? "ActiveMenuItemAskLine" : "InActiveAskLine")
                                }
                            }

                            if (self.IsShowSeparator) {
                                contextMenuItemsObject["RCChartObjects"].items["Separator"] = {
                                    name: "Period Separator", className: ((ChartInstance.ChartSettings.IsPeriodSeparator) ? "ActiveMenuItemSeparator" : "InActiveSeparator")
                                }
                            }

                            if (self.IsShowVolume) {
                                contextMenuItemsObject["RCChartObjects"].items["Volume"] = {
                                    name: "Volume", className: ((ChartInstance.ChartSettings.IsVolumeVisible) ? "ActiveMenuItemVolume" : "InActiveVolume")
                                }
                            }

                            if (self.IsShowOHLCDigits) {
                                contextMenuItemsObject["RCChartObjects"].items["OHLCDigits"] = {
                                    name: "OHLC Digits", className: ((ChartInstance.ChartSettings.IsOHLCDigitsVisible) ? "ActiveMenuItemOHLCDigits" : "InActiveOHLCDigits")
                                }

                                // OHLC Digits Position Element
                                var odp_element = $('<div id="odp_element-OHLC1"/>').css({ "width": "100px", "height": "19px" }).DropDown({
                                    controltype: "on-options",
                                    items: ["Top Left", "Bottom Right"],
                                    setvalue: ChartInstance.ChartSettings.IsOHLCDigitsBottomRight ? "Bottom Right" : "Top Left",
                                    selecteditem: function (value) {
                                        if (value == "Top Left") {
                                            ChartInstance.ChartSettings.IsOHLCDigitsBottomRight = false;
                                        } else {
                                            ChartInstance.ChartSettings.IsOHLCDigitsBottomRight = true;
                                        }
                                    }
                                });

                                contextMenuItemsObject["OHLCDigitsPosition"] = {
                                    name: "OHLC Digits Position", appendElement: odp_element, callback: function () { return false; }
                                }
                            }

                            if (self.IsShowTrades) {
                                contextMenuItemsObject["RCChartObjects"].items["Trades"] = {
                                    name: "Trades", className: "InActiveTrades", items: {
                                        "LineStyle": { name: "Line Style", className: ((ChartInstance.ChartSettings.IsLineStyle) ? "ActiveMenuItemLineStyle" : "InActiveLine") }, "ArrowStyle": { name: "Arrow Style", className: ((ChartInstance.ChartSettings.IsArrowStyle) ? "ActiveMenuItemArrowStyle" : "InActiveArrow") }, "Hide": { name: "Hide", className: ((!ChartInstance.ChartSettings.IsOpenTradeVisible) ? "ActiveMenuItemHide" : "InActiveHide") }
                                    }
                                }

                                contextMenuItemsObject["RCChartObjects"].items["Orders"] = {
                                    name: "Orders", className: ((ChartInstance.ChartSettings.IsOrdersVisible) ? "ActiveMenuItemAOrders" : "InActiveOrders")
                                }
                            }
                        }

                        if (self.IsShowIndicator) { // Indicators
                            var contextMenuObj = self.IsUseSpecialIndicatorList ? IndicatorInstance.SpecialContextMenuObject(IndicatorCtxMenuCallBack, IndicatorSettingsFunction) : IndicatorInstance.ContextMenuObject(IndicatorCtxMenuCallBack, IndicatorSettingsFunction);

                            contextMenuItemsObject["RCIndicators"] = {
                                name: txtIndicators, className: "InIndicatorsMenu", items: contextMenuObj
                            }
                        }

                        if (self.IsShowVisualTools) { // Visual Tools
                            contextMenuItemsObject["RCVisualTools"] = {
                                name: txtVisualTools, className: "InActiveVisualTools", items: VTInstance.ContextMenuObject(VisualToolsCtxMenuCallBack, VisualToolsSettingsFunction)
                            }
                        }

                        contextMenuItemsObject["RCRefreshChart"] = { // Refresh Chart
                            name: txtRefreshChart, className: "InActiveRefresh", callback: function () {
                                ChartInstance.RefreshChartData();
                            }
                        };

                        return contextMenuItemsObject;
                    }
                    else {
                        var contextMenuItemsObject = {};
                        var contextMenuObj = self.IsUseSpecialIndicatorList ? IndicatorInstance.SpecialContextMenuObject(IndicatorCtxMenuCallBack, IndicatorSettingsFunction) : IndicatorInstance.ContextMenuObject(IndicatorCtxMenuCallBack, IndicatorSettingsFunction);

                        if (self.IsShowVisualTools) {
                            contextMenuItemsObject["RCVTSettings"] = {
                                name: "Settings", callback: function () {
                                    var selectedVTObject = VisualToolInstance.GetActiveObject(vtActiveObj[0]);
                                    ShowVTSettings(selectedVTObject);
                                }
                            };

                            contextMenuItemsObject["VTLineColorPicker"] = {
                                Name: "SymbolSelector", appendElement: VTLineColorPicker(), callback: function () {
                                    return false;
                                }
                            };

                            contextMenuItemsObject["VTHoverColorPicker"] = {
                                Name: "SymbolSelector", appendElement: VTHoverColorPicker(), callback: function () {
                                    return false;
                                }
                            };

                            contextMenuItemsObject["VTFillColorPicker"] = {
                                Name: "SymbolSelector", appendElement: VTFillColorPicker(), callback: function () {
                                    return false;
                                }
                            };

                        }

                        if (self.IsShowTrades) {
                            contextMenuItemsObject["RCNewTrade"] = {
                                name: "New Trade/Order", className: "InActiveNewTrade", callback: function () { _comObj.Trigger("showTradeOrderForm", self.Symbol()); }
                            };

                            contextMenuItemsObject["RCSellLimit"] = {
                                name: "Sell " + SellWord + " at " + HoveredPrice, className: "InActiveSellLimit", callback: function () { setTimeout(_comObj.Trigger("showOrderForm", [self.Symbol(), parseFloat(HoveredPrice)]), 500); }
                            };

                            contextMenuItemsObject["RCBuyLimit"] = {
                                name: "Buy " + BuyWord + " at " + HoveredPrice, className: "InActiveBuyLimit", callback: function () { setTimeout(_comObj.Trigger("showOrderForm", [self.Symbol(), parseFloat(HoveredPrice)]), 500); }
                            };
                        }

                        if (self.IsShowSymbolSelector) {
                            contextMenuItemsObject["SymbolSelector"] = {
                                Name: "SymbolSelector", className: "InActiveSymbolSelector", appendElement: GetSymbolSelector(), HasBorderTop: true, callback: function () {
                                    return false;
                                }
                            };
                        }

                        if (self.IsShowGraphType) {
                            contextMenuItemsObject["RCGraphType"] = {
                                name: "Graph Type", className: "InActiveGraphType"
                            }

                            if (self.IsShowCandleStick) {
                                contextMenuItemsObject["RCGraphType"].items["CandleStick"] = {
                                    name: "CandleStick", className: "CandleStick" + ((ChartInstance.ChartSettings.GraphType === "CandleStick") ? " ActiveMenuItemCandleStick" : " InActiveCandleStick")
                                };
                            }

                            if (self.IsShowLine) {
                                contextMenuItemsObject["RCGraphType"].items["LineGraph"] = {
                                    name: "LineGraph", className: "LineGraph" + ((ChartInstance.ChartSettings.GraphType === "LineChart") ? " ActiveMenuItemLineGraph" : " InActiveLineGraph")
                                };
                            }

                            if (self.IsShowPointAndFigure) {
                                contextMenuItemsObject["RCGraphType"].items["PointAndFigure"] = {
                                    name: "PointAndFigure", className: "PointAndFigure" + ((ChartInstance.ChartSettings.GraphType === "PointAndFigure") ? " ActiveMenuItemPointAndFigure" : " InActivePointAndFigure")
                                };
                            }

                            if (self.IsShowLineBreak) {
                                contextMenuItemsObject["RCGraphType"].items["LineBreak"] = {
                                    name: "LineBreak", className: "LineBreak" + ((ChartInstance.ChartSettings.GraphType === "LineBreak") ? " ActiveMenuItemLineBreak" : " InActiveLineBreak")
                                };
                            }

                            if (self.IsShowRenko) {
                                contextMenuItemsObject["RCGraphType"].items["Renko"] = {
                                    name: "Renko", className: "Renko" + ((ChartInstance.ChartSettings.GraphType === "Renko") ? " ActiveMenuItemRenko" : " InActiveRenko")
                                };
                            }

                            if (self.IsShowKagi) {
                                contextMenuItemsObject["RCGraphType"].items["Kagi"] = {
                                    name: "Kagi", className: "Kagi" + ((ChartInstance.ChartSettings.GraphType === "Kagi") ? " ActiveMenuItemKagi" : " InActiveKagi")
                                }
                            }
                        }

                        if (self.IsShowTimeframe) {
                            contextMenuItemsObject["RCTimeFrame"] = { name: "Time Frame", className: "InActiveTimeFrame" };
                            contextMenuItemsObject["RCTimeFrame"].items = TimeFrameItems();
                        }

                        if (self.IsShowChartObjects) {
                            contextMenuItemsObject["RCChartObjects"] = { name: "Chart Objects", className: "InActiveChartObjects" };

                            if (self.IsShowMarker) {
                                contextMenuItemsObject["RCChartObjects"].items["Marker"] = { name: "Marker", className: ((ChartInstance.ChartSettings.IsChartMarkerVisible) ? "ActiveMenuItemMarker" : "InActiveMarker") };
                            }

                            if (self.IsShowLegend) {
                                contextMenuItemsObject["RCChartObjects"].items["Legend"] = { name: "Legend", className: ((ChartInstance.ChartSettings.IsLegendVisible) ? "ActiveMenuItemLegend" : "InActiveLegend") };
                            }

                            if (self.IsShowTradePanel) {
                                contextMenuItemsObject["RCChartObjects"].items["TradePanel"] = { name: "TradePanel", className: ((ChartInstance.ChartSettings.IsTradePanelVisible) ? "ActiveMenuItemTradePanel" : "InActiveTradePanel") };
                            }

                            if (self.IsShowBidLine) {
                                contextMenuItemsObject["RCChartObjects"].items["Bid"] = { name: "Bid", className: ((ChartInstance.ChartSettings.IsBidLineVisible) ? "ActiveMenuItemBidLine" : "InActiveBidLine") };
                            }

                            if (self.IsShowAskLine) {
                                contextMenuItemsObject["RCChartObjects"].items["Ask"] = { name: "Ask", className: ((ChartInstance.ChartSettings.IsAskLineVisible) ? "ActiveMenuItemAskLine" : "InActiveAskLine") }
                            }

                            if (self.IsShowSeparator) {
                                contextMenuItemsObject["RCChartObjects"].items["Separator"] = { name: "Period Separator", className: ((ChartInstance.ChartSettings.IsPeriodSeparator) ? "ActiveMenuItemSeparator" : "InActiveSeparator") };
                            }

                            if (self.IsShowVolume) {
                                contextMenuItemsObject["RCChartObjects"].items["Volume"] = { name: "Volume", className: ((ChartInstance.ChartSettings.IsVolumeVisible) ? "ActiveMenuItemVolume" : "InActiveVolume") };
                            }

                            if (self.IsShowOHLCDigits) {
                                contextMenuItemsObject["RCChartObjects"].items["OHLCDigits"] = { name: "OHLC Digits", className: ((ChartInstance.ChartSettings.IsOHLCDigitsVisible) ? "ActiveMenuItemOHLCDigits" : "InActiveOHLCDigits") };
                            }

                            if (self.IsShowTrades) {
                                contextMenuItemsObject["RCChartObjects"].items["Trades"] = { name: "Trades", className: "InActiveTrades", items: { "LineStyle": { name: "Line Style", className: ((ChartInstance.ChartSettings.IsLineStyle) ? "ActiveMenuItemLineStyle" : "InActiveLine") }, "ArrowStyle": { name: "Arrow Style", className: ((ChartInstance.ChartSettings.IsArrowStyle) ? "ActiveMenuItemArrowStyle" : "InActiveArrow") }, "Hide": { name: "Hide", className: ((!ChartInstance.ChartSettings.IsOpenTradeVisible) ? "ActiveMenuItemHide" : "InActiveHide") } } };
                            }

                            if (self.IsShowTrades) {
                                contextMenuItemsObject["RCChartObjects"].items["Orders"] = { name: "Orders", className: ((ChartInstance.ChartSettings.IsOrdersVisible) ? "ActiveMenuItemAOrders" : "InActiveOrders") };
                            }
                        }

                        if (self.IsShowIndicator) {
                            contextMenuItemsObject["RCIndicators"] = {
                                name: "Indicators", className: "InIndicatorsMenu", items: contextMenuObj
                            };
                        }

                        if (self.IsShowVisualTools) {
                            contextMenuItemsObject["RCVisualTools"] = {
                                name: "Visual Tools", className: "InActiveVisualTools", items: VTInstance.ContextMenuObject(VisualToolsCtxMenuCallBack, VisualToolsSettingsFunction)
                            };
                        }

                        contextMenuItemsObject["RCRefreshChart"] = {
                            name: "Refresh Chart", className: "InActiveRefresh", callback: function () {
                                ChartInstance.RefreshChartData();
                            }
                        };

                        return contextMenuItemsObject;
                    }

                }
            });
        }

        $('#' + ContainerID + ' .Indicators').PTContextMenu({
            activation: "hover",
            zIndex: 20,
            items: function () {
                WC.SymbolSelector.SymbolSelector("show", false);
                var contextMenuObj = self.IsUseSpecialIndicatorList ? IndicatorInstance.SpecialContextMenuObject(IndicatorCtxMenuCallBack, IndicatorSettingsFunction) : IndicatorInstance.ContextMenuObject(IndicatorCtxMenuCallBack, IndicatorSettingsFunction);

                return contextMenuObj;
            }
        });

        $('#' + ContainerID + ' .ChartObjects').PTContextMenu({
            activation: "hover",
            callBack: menuCallBack,
            zIndex: 20,
            items: function () {
                WC.SymbolSelector.SymbolSelector("show", false);
                var contextMenuItemObject = {
                };

                if (self.IsShowMarker) {
                    contextMenuItemObject["Marker"] = {
                        name: "Marker", className: ((ChartInstance.ChartSettings.IsChartMarkerVisible) ? "ActiveMenuItemMarker" : "InActiveMarker")
                    };
                }

                if (self.IsShowLegend) {
                    contextMenuItemObject["Legend"] = {
                        name: "Legend", className: ((ChartInstance.ChartSettings.IsLegendVisible) ? "ActiveMenuItemLegend" : "InActiveLegend")
                    }
                }

                if (self.IsShowTradePanel) {
                    contextMenuItemObject["TradePanel"] = {
                        name: "TradePanel", className: ((ChartInstance.ChartSettings.IsTradePanelVisible) ? "ActiveMenuItemTradePanel" : "InActiveTradePanel")
                    }
                }

                if (self.IsShowBidLine) {
                    contextMenuItemObject["Bid"] = {
                        name: "Bid", className: ((ChartInstance.ChartSettings.IsBidLineVisible) ? "ActiveMenuItemBidLine" : "InActiveBidLine")
                    }
                }

                if (self.IsShowBidLine) {
                    contextMenuItemObject["Ask"] = {
                        name: "Ask", className: ((ChartInstance.ChartSettings.IsAskLineVisible) ? "ActiveMenuItemAskLine" : "InActiveAskLine")
                    }
                }

                if (self.IsShowSeparator) {
                    contextMenuItemObject["Separator"] = {
                        name: "Period Separator", className: ((ChartInstance.ChartSettings.IsPeriodSeparator) ? "ActiveMenuItemSeparator" : "InActiveSeparator")
                    }
                }

                if (self.IsShowVolume) {
                    contextMenuItemObject["Volume"] = {
                        name: "Volume", className: ((ChartInstance.ChartSettings.IsVolumeVisible) ? "ActiveMenuItemVolume" : "InActiveVolume")
                    }
                }

                if (self.IsShowOHLCDigits) {
                    contextMenuItemObject["OHLCDigits"] = {
                        name: "OHLC Digits", className: ((ChartInstance.ChartSettings.IsOHLCDigitsVisible) ? "ActiveMenuItemOHLCDigits" : "InActiveOHLCDigits")
                    }

                    // OHLC Digits Position Element
                    var odp_element = $('<div id="odp_element-OHLC2"/>').css({ "width": "100px", "height": "19px" }).DropDown({
                        controltype: "on-options",
                        items: ["Top Left", "Bottom Right"],
                        setvalue: ChartInstance.ChartSettings.IsOHLCDigitsBottomRight ? "Bottom Right" : "Top Left",
                        selecteditem: function (value) {
                            if (value == "Top Left") {
                                ChartInstance.ChartSettings.IsOHLCDigitsBottomRight = false;
                            } else {
                                ChartInstance.ChartSettings.IsOHLCDigitsBottomRight = true;
                            }
                        }
                    });

                    contextMenuItemObject["OHLCDigitsPosition"] = {
                        name: "OHLC Digits Position", appendElement: odp_element, callback: function () { return false; }
                    }
                }

                if (self.IsShowTrades) {
                    contextMenuItemObject["Trades"] = {
                        name: "Trades", className: "InActiveTrades", items: {
                            "LineStyle": { name: "Line Style", className: ((ChartInstance.ChartSettings.IsLineStyle) ? "ActiveMenuItemLineStyle" : "InActiveLine") }, "ArrowStyle": { name: "Arrow Style", className: ((ChartInstance.ChartSettings.IsArrowStyle) ? "ActiveMenuItemArrowStyle" : "InActiveArrow") }, "Hide": { name: "Hide", className: ((!ChartInstance.ChartSettings.IsOpenTradeVisible) ? "ActiveMenuItemHide" : "InActiveHide") }
                        }
                    }

                    contextMenuItemObject["Orders"] = {
                        name: "Orders", className: ((ChartInstance.ChartSettings.IsOrdersVisible) ? "ActiveMenuItemAOrders" : "InActiveOrders")
                    }
                }

                return contextMenuItemObject;
            }
        });

        $('#' + ContainerID + ' .VisualTools').PTContextMenu({
            activation: "hover",
            callBack: VisualToolsSettingsFunction,
            zIndex: 20,
            items: function () {
                WC.SymbolSelector.SymbolSelector("show", false);
                return VTInstance.ContextMenuObject(VisualToolsCtxMenuCallBack, VisualToolsSettingsFunction);
            }
        });


        $('#' + ContainerID + ' .ToolTrades').PTContextMenu({
            activation: "leftclick",
            callBack: menuCallBack,
            zIndex: 20,
            items: function () {
                return {
                    "LineStyle": { name: "Line Style", className: ((ChartInstance.ChartSettings.IsLineStyle) ? "ActiveMenuItemLineStyle" : "InActiveLine") },
                    "ArrowStyle": { name: "Arrow Style", className: ((ChartInstance.ChartSettings.IsArrowStyle) ? "ActiveMenuItemArrowStyle" : "InActiveArrow") },
                    "Hide": { name: "Hide", className: ((!ChartInstance.ChartSettings.IsOpenTradeVisible) ? "ActiveMenuItemHide" : "InActiveHide") }
                };
            }
        });
        $('#' + ContainerID + ' .GraphType').PTContextMenu({
            activation: "hover",
            callBack: menuCallBack,
            zIndex: 20,
            items: function () {
                WC.SymbolSelector.SymbolSelector("show", false);
                var contextMenuItemObject = {};

                if (self.IsShowCandleStick) {
                    contextMenuItemObject["CandleStick"] = {
                        name: "CandleStick", className: "CandleStick" + ((ChartInstance.ChartSettings.GraphType === "CandleStick") ? " ActiveMenuItemCandleStick" : " InActiveCandleStick")
                    }
                }

                if (self.IsShowBar) {
                    contextMenuItemObject["BarGraph"] = {
                        name: "Bar Graph", className: "BarGraph" + ((ChartInstance.ChartSettings.GraphType === "BarChart") ? " ActiveMenuItemBarGraph" : " InActiveBarGraph")
                    }
                }

                if (self.IsShowLine) {
                    contextMenuItemObject["LineGraph"] = {
                        name: "LineGraph", className: "LineGraph" + ((ChartInstance.ChartSettings.GraphType === "LineChart") ? " ActiveMenuItemLineGraph" : " InActiveLineGraph")
                    }
                }

                if (self.IsShowPointAndFigure) {
                    contextMenuItemObject["PointAndFigure"] = {
                        name: "PointAndFigure", className: "PointAndFigure" + ((ChartInstance.ChartSettings.GraphType === "PointAndFigure") ? " ActiveMenuItemPointAndFigure" : " InActivePointAndFigure")
                    }
                }

                if (self.IsShowLineBreak) {
                    contextMenuItemObject["LineBreak"] = {
                        name: "LineBreak", className: "LineBreak" + ((ChartInstance.ChartSettings.GraphType === "LineBreak") ? " ActiveMenuItemLineBreak" : " InActiveLineBreak")
                    }
                }

                if (self.IsShowRenko) {
                    contextMenuItemObject["Renko"] = {
                        name: "Renko", className: "Renko" + ((ChartInstance.ChartSettings.GraphType === "Renko") ? " ActiveMenuItemRenko" : " InActiveRenko")
                    }
                }

                if (self.IsShowKagi) {
                    contextMenuItemObject["Kagi"] = {
                        name: "Kagi", className: "Kagi" + ((ChartInstance.ChartSettings.GraphType === "Kagi") ? " ActiveMenuItemKagi" : " InActiveKagi")
                    }
                }

                return contextMenuItemObject;
            }
        });

        $('#' + ContainerID + ' .TimeFrame').PTContextMenu({
            activation: "hover",
            callBack: menuCallBack,
            zIndex: 20,
            items: TimeFrameItems
        });



        $('#' + ContainerID + ' .ToolTimeFrame').PTContextMenu({
            activation: "leftclick",
            callBack: menuCallBack,
            zIndex: 20,
            items: TimeFrameItems
        });

        function TimeFrameItems() {
            WC.SymbolSelector.SymbolSelector("show", false);
            var contextMenuItemsObject = {};
            var itemslenght = self.TimeFrameItems.length;
            for (var i = 0; i < itemslenght; i++) {
                var item = self.TimeFrameItems[i];
                contextMenuItemsObject[item.Id] = {
                    name: item.Name,
                    className: ((ChartInstance.ChartSettings.TimeFrame === item.Value) ? "ContextMenuChecked" : "")
                };
            }
            return contextMenuItemsObject;
        }



        $('#' + ContainerID + ' .ToolWindow').PTContextMenu({
            activation: "hover",
            callBack: menuCallBack,
            zIndex: 20,
            items: function () {
                WC.SymbolSelector.SymbolSelector("show", false);
                return {
                    "WindowChartObject": {
                        name: txtChartObject
                        , className: self.IsChartObjectsVisible === true ? 'ContextMenuChecked' : null
                    },
                    "WindowChartDisplay": {
                        name: txtChartDisplay
                        , className: self.IsChartDisplayVisible === true ? 'ContextMenuChecked' : null
                    },
                    "WindowVisualTools": {
                        name: txtVisualTools
                        , className: self.IsVisualToolsVisible === true ? 'ContextMenuChecked' : null
                    }
                };
            }
        });
        $('#' + ContainerID + ' .WOptions').PTContextMenu({
            activation: "hover",
            callBack: menuCallBack,
            zIndex: 20,
            items: function () {
                WC.SymbolSelector.SymbolSelector("show", false);
                var Weeks = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
                var $MainHolderWeeklyPeriod = $('<div><span style="display:inline-block;top: 9px;">Weekly period at </span</div>');
                var $SecondHolderWeeklyPeriod = $('<div id="SecondHolderWeeklyPeriod"/>');
                $MainHolderWeeklyPeriod.append($SecondHolderWeeklyPeriod);

                var odp_element = $SecondHolderWeeklyPeriod.css({ "width": "100px", "height": "19px", "display": "inline-block", "margin-left": "10px" }).DropDown({
                    controltype: "on-options",
                    items: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                    setvalue: Weeks[ChartInstance.ChartSettings.WeeklyPeriod],
                    selecteditem: function (value) {
                        ChartInstance.SetWeeklyPeriod(value);
                    }
                });
                return {
                    "AskBidLineAlways": {
                        name: "Display ask/bid line always"
                        , className: ChartInstance.ChartSettings.IsAlwaysShowBidAsk === true ? 'ContextMenuChecked' : null
                    },
                    "WindowChartDisplay": {
                        name: "Chart Display"
                        , callback: function () { return false; }, appendElement: $MainHolderWeeklyPeriod
                    }
                };
            }
        });


        $('#' + ContainerID + ' .ToolTemplate').PTContextMenu({
            activation: "hover",
            callBack: menuCallBack,
            zIndex: 20,
            items: function () {
                WC.SymbolSelector.SymbolSelector("show", false);
                return {
                    "ColorScheme": {
                        name: "Color Scheme", disabled: ChartInstance.ChartValidationsProperties.isDataReady && ChartInstance.ChartValidationsProperties.isDigitsReady ? false : true
                    }
                };
            }
        });

    }

    function SetTitleBarCaption() {
        var TimeFrameString = null;
        var length = self.TimeFrameItems.length

        for (var i = 0; i < length; i++) {
            var item = self.TimeFrameItems[i];
            if (item.Value == ChartInstance.ChartSettings.TimeFrame) {
                TimeFrameString = item.Id;
                item = null;
                break;
            }
            item = null;
        }
        if (!TimeFrameString) {
            alert("Time Frame is not available");
            return;
        }
        var tmptext = self.IsShowPoweredText ? " - Web Charts" : "";
        var text = ChartInstance.ChartSettings.Symbol + " - " + TimeFrameString + tmptext;
        self.ChartFormElement.find('.ChartFormTitleBar').text(text);
        $.each(self.OnTitleChanged, function (i, f) { if ($.isFunction(f)) f(text); });
    }

    function IndicatorCtxMenuCallBack(key) {
        if(!key) return;
        IndicatorInstance.AllowAdd = true;
        IndicatorInstance.LoadOnBarsIndicator(key, ChartInstance.ChartOtherProperties.ChartData, Options);
        IndicatorInstance.AllowAdd = false;
    }

    function VisualToolsCtxMenuCallBack(key) {
        VTInstance.initDrawVT(key);
    }

    function CloseSettingsOnIndicatorRemove(IndicatorID) {
        if (ActiveIndicatorSettings === IndicatorID) {
            self.ChartFormElement.find('.wt-IndicatorSettings').removeAttr('style');
            self.ChartFormElement.find('.wt-IndicatorSettings').attr('style', 'visibility:hidden');
            pgDiv.PropertyGrid("RemoveProperty", { KeyObject: ActiveIndicatorSettings });
            $('#SettingsContainer' + ContainerID).empty();
            $('#SettingsHeader-' + ContainerID).empty();
            $('#SettingsHeader-' + ContainerID).removeAttr('style');
            $('#SettingsHeader-' + ContainerID).attr('style', 'visibility:hidden');
            IsSettingsVisible = false;
            ActiveIndicatorSettings = undefined;
            ChartInstance.Resizemethod();
        }
    }

    self.LowerIndicatorRemove = function (ID) {
        IndicatorInstance.RemoveIndicator(ID);
    };

    function SetAllElementsNeededAndSetVariablesNeeded() {
        var TitleBarButtons = self.IsShowTitleBarButtons ? '<span title="Close" class="Close" style=" cursor: pointer;float: right;  width: 18px;  height: 17px;  margin: 1px 1px 0 1px;  border: solid 1px black;"></span><span title="Maximized / Tabbed View" class="Maximize" style="cursor: pointer; float: right;  width: 18px;  height: 17px;  margin: 1px 1px 0 1px;  border: solid 1px black;"></span>' : '';
        var ChartControls = !self.IsShowChartObjects && self.IsUseSpecialIndicatorList ? '<span class="ChartControls wt-span-menu">Chart Objects</span>' : "";
        var ChartObjects = self.IsShowChartObjects ? '<span class="ChartObjects wt-span-menu">Chart Objects</span>' : "";
        var GraphTypes = self.IsShowGraphType ? '<span class="GraphType wt-span-menu">Graph Type</span>' : "";
        var Timeframe = self.IsShowTimeframe ? '<span class="TimeFrame wt-span-menu">Timeframe</span>' : "";
        var Indicators = self.IsShowIndicator ? '<span class="Indicators wt-span-menu">Indicators</span>' : "";
        var VisualTools = self.IsShowVisualTools ? '<span class="VisualTools wt-span-menu">Visual Tools</span>' : "";
        var Windows = self.IsShowWIN ? '<span class="ToolWindow wt-span-menu">Window</span>' : "";
        var Template = self.IsShowTemplate ? '<span class="ToolTemplate wt-span-menu">Template</span>' : "";
        var WOptions = self.IsShowOptions ? '<span class="WOptions wt-span-menu">Options</span>' : "";

        ChartForm = $('<div style="height:0;" class="ChartForm"></div>');
        IndicatorSettingsForm = $('<div id="SettingsContainer' + ContainerID + '" class="wt-IndicatorSettings" style="visibility:hidden;"></div>');
        BottomIndicatorChartContainer = $('<div id="botIndicatorContainer" class="BotIndicatorHolder" style="visibility:hidden;"></div>');
        TitleBar = $('<div class="ChartTitleBar wt-ChartHeader" style="' + (Options.IsChartForBinaryOptions ? 'display:none;' : '') + 'height: 21px;border-bottom: 1px solid #9da0aa;"><label class="ChartFormTitleBar" style="margin: 5px 8px; */;display: inline-block;">USDJPY - 15M</label>' + TitleBarButtons + '</div>');
        MainNav = $('<div class="ChartMenu" style="border-bottom: 1px solid #9da0aa;"><div class="VisibleChartMenuItem">' + ChartObjects + GraphTypes + Timeframe + Indicators + Template + VisualTools + WOptions + Windows + '<div class="ArrowDownMenu wt-arrow-down-gray-icon" style="display:none;position: absolute;width: 30px;height: 23px;right: 0px;top: 0px;background-repeat: no-repeat;background-position: 5px 0px; cursor:pointer;"></div></div> <div style="visibility:hidden; position:absolute;" class="HiddenItemsForMenu"></div></div>');
        ChartHolder = $('<div class="ChartHolder" style="width:100%; height:0; position:relative; display:inline-block; float:left;"></div>');
        ChartScrollBarHolder = $('<div class="ScrollBarMainHolder" style="display: inline-block; background: rgb(237, 237, 237); height: 10px; padding-top: 2px; padding-bottom: 1px; "><div class="ScrollLeftArrow" style="display: inline-block;width: 20px;height: 10px;"></div><div class="ChartScrollBarHolder" style=" background: rgb(237, 237, 237); border: none;display:inline-block; height: 8px;"></div><div class="ScrollRightArrow" style="display: inline-block;width: 19px;  height: 10px;"></div></div>');
        SecondScrollBarHolder = ChartScrollBarHolder.find('.ChartScrollBarHolder');
        VisualToolsSettingsForm = $('<div id="VTSettingsContainer" class="wt-VTSettings" style="visibility:hidden;"></div>');
        SettingsHeaderContainer = $('<div id="SettingsHeader-' + ContainerID + '" class="wt-IndicatorSettingsHeader" style="visibility:hidden; height: 15px; float:right"></div>');
        WaterMark = $("<div class='ChartWaterMark'></div>");
        var ToolBar = SetToolBarItemElements();
        ChartForm.append(TitleBar);
        ChartForm.append(MainNav);
        ChartForm.append(ToolBar);
        ChartForm.append(ChartHolder);
        ChartForm.append(VisualToolsSettingsForm);
        ChartForm.append(SettingsHeaderContainer);
        ChartForm.append(IndicatorSettingsForm);
        ChartForm.append(ChartScrollBarHolder);
        ChartForm.append(BottomIndicatorChartContainer);

        if (Options.IsChartDisplayDisabled) {
            ChartScrollBarHolder.remove();
            MainNav.remove();
            TitleBar.remove();
            SecondScrollBarHolder.remove();
            ToolBar.remove();
        }
        MainNav.find('.ArrowDownMenu').click(clickEventArrowButtonDownMenu);

        self.ParentElement.append(ChartForm);

        self.ChartFormElement = $('#' + ContainerID + " .ChartForm");
        //Set Resize Function of chartDisplay
        self.ResizeFunction = function () {
            ChartForm.css({
                height: self.ParentElement.height() - 2
            });

            if (!self.IsExplicitlySetChartObjects || !self.IsExplicitlySetChartDisplay || !self.IsExplicitlySetVisualTools) {
                if (self.ParentElement.height() <= 200) {
                    if (!self.IsExplicitlySetChartObjects) {
                        self.ChartObjectsGroup.css('display', 'none');
                        self.IsChartObjectsVisible = false;
                    }
                    else {
                        self.IsChartObjectsVisible = self.TempIsChartObjectsVisible;

                    }
                    if (!self.IsExplicitlySetChartDisplay) {
                        self.ChartFunctionGroup.css('display', 'none');
                        self.IsChartDisplayVisible = false;
                    }
                    else {
                        self.IsChartDisplayVisible = self.TempIsChartDisplayVisible;
                    }
                    if (!self.IsExplicitlySetVisualTools) {
                        self.IsVisualToolsVisible = false;
                    }
                    else {
                        self.IsVisualToolsVisible = self.TempIsVisualToolsVisible;
                    }
                    if (!self.IsExplicitlySetChartObjects && !self.IsExplicitlySetChartDisplay && !self.IsExplicitlySetVisualTools) {
                        ToolBar.css('display', 'block');
                        if (self.ParentElement.width() <= 270) {
                            ToolBar.css('display', 'none');
                        }
                    }
                }
                else {
                    ToolBar.css('display', 'block');
                    if (self.ParentElement.width() <= 270) {
                        ToolBar.css('display', 'none');
                    }
                    self.IsChartDisplayVisible = self.TempIsChartDisplayVisible;
                    self.IsChartObjectsVisible = self.TempIsChartObjectsVisible;
                    self.IsVisualToolsVisible = self.TempIsVisualToolsVisible;
                    SetToolBarGroupVisibility();
                    if (!self.IsVisualToolsVisible && !self.IsChartObjectsVisible && !self.IsChartDisplayVisible) {
                        ToolBar.css('display', 'none');
                    }
                }
            }
            else {
                if (!self.IsVisualToolsVisible && !self.IsChartObjectsVisible && !self.IsChartDisplayVisible) {
                    ToolBar.css('display', 'none');
                }
                else {
                    ToolBar.css('display', 'block');
                    if (self.ParentElement.width() <= 270) {
                        ToolBar.css('display', 'none');
                    }
                }
            }

            ResizeFunctionForItems();
            ResizeFunctionForMenu();

            if (!Options.IsChartDisplayDisabled) {
                if (IsSettingsVisible) {
                    if (self.isLowerIndicatorVisible) {
                        ChartHolder.css({
                            width: (self.ChartFormElement.width() - 195),
                            height: (self.ChartFormElement.height() - ((ToolBar.css('display') === 'none') ? 0 : ToolBar.height()) - ((TitleBar.css('display') === 'none') ? 0 : TitleBar.height()) - MainNav.height() - 4 - ((ChartScrollBarHolder.css('display') === 'none') ? 0 : ChartScrollBarHolder.height()) - 3) * TopChart
                        });
                        SecondScrollBarHolder.css({
                            width: ((self.ChartFormElement.width() - 195) - self.ChartFormElement.find('.ScrollLeftArrow').width() - self.ChartFormElement.find('.ScrollRightArrow').width() - 1)
                        });
                        self.ChartFormElement.find('#SettingsHeader-' + ContainerID).attr('style', 'visibility: visible; background: white; width: ' + SettingsContainerWidth + 'px;display:inline-block; float:right;');
                        self.ChartFormElement.find('#SettingsContainer' + ContainerID).attr('style', 'margin-left: 3px;visibility:visible; background: white; float:right; width: ' + SettingsContainerWidth + 'px; display:inline-block; height:' + ((self.ChartFormElement.height() - ((ToolBar.css('display') === 'none') ? 0 : ToolBar.height()) - ((TitleBar.css('display') === 'none') ? 0 : TitleBar.height()) - MainNav.height() - 4 - ((ChartScrollBarHolder.css('display') === 'none') ? 0 : ChartScrollBarHolder.height()) - (self.ChartFormElement.find('#SettingsHeader-' + ContainerID).has('input').length ? ButtonHeight : -1) - 3) - 6) + 'px;');
                        BottomIndicatorChartContainer.attr('style', 'background: white; position:relative; float:left; width:' + (self.ChartFormElement.width() - 195) + 'px; height:' + (self.ChartFormElement.height() - ((ToolBar.css('display') === 'none') ? 0 : ToolBar.height()) - ((TitleBar.css('display') === 'none') ? 0 : TitleBar.height()) - MainNav.height() - 4 - ((ChartScrollBarHolder.css('display') === 'none') ? 0 : ChartScrollBarHolder.height()) - ChartHolder.height() - 3) + 'px;visibility:visible; display:inline-block;');
                    }
                    else {
                        ChartHolder.css({
                            width: (self.ChartFormElement.width() - 195),
                            height: (self.ChartFormElement.height() - ((ToolBar.css('display') === 'none') ? 0 : ((ToolBar.css('display') === 'none') ? 0 : ToolBar.height())) - ((TitleBar.css('display') === 'none') ? 0 : TitleBar.height()) - MainNav.height() - 4 - ((ChartScrollBarHolder.css('display') === 'none') ? 0 : ChartScrollBarHolder.height()) - 3)
                        });
                        SecondScrollBarHolder.css({
                            width: ((self.ChartFormElement.width() - 195) - self.ChartFormElement.find('.ScrollLeftArrow').width() - self.ChartFormElement.find('.ScrollRightArrow').width() - 1)
                        });
                        self.ChartFormElement.find('#SettingsHeader-' + ContainerID).attr('style', 'visibility: visible; background: white; width: ' + SettingsContainerWidth + 'px;display:inline-block; float:right;');
                        self.ChartFormElement.find('#SettingsContainer' + ContainerID).attr('style', 'margin-left: 3px;visibility:visible; background: white; float:right; width: ' + SettingsContainerWidth + 'px; display:inline-block; height:' + ((self.ChartFormElement.height() - ((ToolBar.css('display') === 'none') ? 0 : ToolBar.height()) - ((TitleBar.css('display') === 'none') ? 0 : TitleBar.height()) - MainNav.height() - 4 - ((ChartScrollBarHolder.css('display') === 'none') ? 0 : ChartScrollBarHolder.height()) - 3) - (self.ChartFormElement.find('#SettingsHeader-' + ContainerID).has('input').length ? ButtonHeight : -1) - 6) + 'px;');
                        BottomIndicatorChartContainer.removeAttr('style');
                        BottomIndicatorChartContainer.attr('style', 'visibility:hidden;');
                    }
                }
                else {
                    if (self.isLowerIndicatorVisible) {
                        ChartHolder.css({
                            width: (self.ChartFormElement.width()),
                            height: (self.ChartFormElement.height() - ((ToolBar.css('display') === 'none') ? 0 : ToolBar.height()) - ((TitleBar.css('display') === 'none') ? 0 : TitleBar.height()) - MainNav.height() - 4 - ((ChartScrollBarHolder.css('display') === 'none') ? 0 : ChartScrollBarHolder.height()) - 3) * TopChart
                        });

                        SecondScrollBarHolder.css({
                            width: (self.ChartFormElement.width() - self.ChartFormElement.find('.ScrollLeftArrow').width() - self.ChartFormElement.find('.ScrollRightArrow').width() - 1)
                        });
                        BottomIndicatorChartContainer.attr('style', 'display:inline-block; background: white; position:relative; width:' + (self.ChartFormElement.width()) + 'px; height:' + (self.ChartFormElement.height() - ((ToolBar.css('display') === 'none') ? 0 : ToolBar.height()) - ((TitleBar.css('display') === 'none') ? 0 : TitleBar.height()) - MainNav.height() - 4 - ((ChartScrollBarHolder.css('display') === 'none') ? 0 : ChartScrollBarHolder.height()) - 3) * BotChart + 'px;visibility:visible; float: left;');
                    }
                    else {
                        ChartHolder.css({
                            width: (self.ChartFormElement.width()),
                            height: (self.ChartFormElement.height() - ((ToolBar.css('display') === 'none') ? 0 : ToolBar.height()) - ((TitleBar.css('display') === 'none') ? 0 : TitleBar.height()) - MainNav.height() - 4 - ((ChartScrollBarHolder.css('display') === 'none') ? 0 : ChartScrollBarHolder.height()) - 3)
                        });
                        BottomIndicatorChartContainer.removeAttr('style');
                        BottomIndicatorChartContainer.attr('style', 'visibility:hidden;');
                        SecondScrollBarHolder.css({
                            width: (self.ChartFormElement.width() - self.ChartFormElement.find('.ScrollLeftArrow').width() - self.ChartFormElement.find('.ScrollRightArrow').width() - 1)
                        });
                    }
                }
            }
            else {
                ChartHolder.css({
                    width: self.ChartFormElement.width(),
                    height: self.ChartFormElement.height()
                });
                ChartHolder.parent().css({
                    border: "0px"
                });
            }

            // Water Mark Resizing
            if (ChartInstance != null) {
                var waterMarkSize = ChartInstance.ParentELement.width() <= 700 ? 100 : ChartInstance.ParentELement.width() <= 1100 ? 100 + (((ChartInstance.ParentELement.width() - 700) / 400) * 50) : 150; // Max Height = 150px, Min Height = 100px
                ChartInstance.ParentELement.find(".ChartWaterMark").css({
                    "visibility": "visible",
                });
            }
        };
        //Init Chart Scrollbar
        InitChartSCrollBar();

        //instantiate chartInstance
        ChartInstance = new WC.CM.OHLCChart(ChartHolder, self.ResizeFunction, BarsViewModel, Options, self, params.CallBacks, QuotesViewModel);
        if (self.IsShowPoweredText) { ChartInstance.ParentELement.append(WaterMark); }

        if (QuotesViewModel.Quotes().length === 0) {
            SubObj = QuotesViewModel.Quotes.subscribe(SetSymbolSetterVisibility);
        }
        else {
            SetSymbolSetterVisibility();
        }
        IndicatorInstance = new WC.IN.BaseIndicator(ChartInstance, ContainerID, self, Options);
        VTInstance = new WC.VT.VisualToolsBase(ChartInstance, ContainerID, self);
        ChartInstance.SetOtherChartEvents();
        if (self.ActiveIndicators.length !== 0) {
            IndicatorInstance.IndicatorSessionCollection = self.ActiveIndicators;
        }
        if (self.ActiveVisualTools.length !== 0) {
            VTInstance.VisualToolSessionCollection = self.ActiveVisualTools;
        }
        // Preset Options
        if (!self.IsShowTradePanel) { ChartInstance.SetTradePanelVisibility(); }

        // Set Default Color Scheme
        ChartInstance.SetDefaultColorScheme(self.DefaultColorScheme);
    }

    function SetTextOfReversalAndBoxSize() {
        ChartForm.find('.BoxSizeSpinner').val(ChartInstance.ChartSettings.BoxSize);
        ChartForm.find('.ReversalSpinner').val(ChartInstance.ChartSettings.Reversal);
    }

    function clickEventArrowButtonDownMenu() {
        var VisibleState = self.ChartFormElement.find('.ChartMenu div.HiddenItemsForMenu').css('visibility');
        if (VisibleState === 'visible') {
            self.ChartFormElement.find('.ChartMenu div.HiddenItemsForMenu').css('visibility', 'hidden');
        }
        else {
            self.ChartFormElement.find('.ChartMenu div.HiddenItemsForMenu').css('visibility', 'visible');
        }
    }

    function ResizeFunctionForMenu() {
        var NotEnoughMenuVisible = true;
        var NotEnoughMenuHidden = true;
        var ChartMenu = MainNav;
        var VisibleChartMenuItems = ChartMenu.find('.VisibleChartMenuItem');
        var ChartMenuHiddenItems = ChartMenu.find('.HiddenItemsForMenu');
        var ArrowDownMenu = ChartMenu.find('.ArrowDownMenu');

        while (NotEnoughMenuVisible) {
            var MenuItem = VisibleChartMenuItems.find('.wt-span-menu');
            var TotalWidthMenuItems = 0;
            TotalWidthMenuItems = GetTotalWidthMenu(MenuItem, ArrowDownMenu.width());
            if (MenuItem.length !== 1) {
                if (TotalWidthMenuItems > ChartMenu.outerWidth(true)) {
                    ChartMenuHiddenItems.append($(MenuItem[MenuItem.length - 1]));
                }
                else {
                    MenuItem = null;
                    NotEnoughMenuVisible = false;
                }
            }
            else {
                MenuItem = null;
                NotEnoughMenuVisible = false;
            }
        }

        while (NotEnoughMenuHidden) {
            var MenuItem = VisibleChartMenuItems.find('.wt-span-menu');
            var HiddenItem = ChartMenuHiddenItems.find('.wt-span-menu');
            if (HiddenItem.length !== 0) {
                var TotalWidthMenuItems = 0;
                TotalWidthMenuItems = GetTotalWidthMenu(MenuItem, ArrowDownMenu.width());
                if (ChartMenu.outerWidth(true) > TotalWidthMenuItems + $(HiddenItem[HiddenItem.length - 1]).outerWidth()) {
                    VisibleChartMenuItems.append($(HiddenItem[HiddenItem.length - 1]));
                }
                else {
                    MenuItem = null;
                    HiddenItem = null;
                    NotEnoughMenuHidden = false;
                }
            }
            else {
                MenuItem = null;
                HiddenItem = null;
                NotEnoughMenuHidden = false;
            }

            if (ChartMenuHiddenItems.find('.wt-span-menu').length !== 0) {
                ArrowDownMenu.css('display', 'block');
            }
            else {
                ChartMenuHiddenItems.css('visibility', 'hidden');
                ArrowDownMenu.css('display', 'none');
            }
        }
        ChartMenuHiddenItems = null;
        ChartMenu = null;
        VisibleChartMenuItems = null;
        ArrowDownMenu = null;
    }

    function GetTotalWidthMenu(MenuItem, widthToAdd) {
        var MenuItemLength = MenuItem.length;
        var TotalWidthMenuItems = 0;
        for (var i = 0; i < MenuItemLength; i++) {
            TotalWidthMenuItems = TotalWidthMenuItems + $(MenuItem[i]).outerWidth(true);
        }
        return TotalWidthMenuItems + widthToAdd;
    }

    function SetToolBarItemElements() {
        ToolBar = $('<div class="wt-ChartHeader ChartToolBar" style="border-bottom: 1px solid #9da0aa;"></div>');
        self.ChartObjectsGroup = $('<div class="ItemGroup ChartObjectGroup"></div>');
        self.ChartFunctionGroup = $('<div class="ItemGroup ChartFunctionGroup"></div>');
        self.VisualToolsGroup = $('<div class="ItemGroup VisualToolsGroup"></div>');
        var ItemHolderChartObject = $('<div class="ItemHolder" style="display: inline-block;"></div>');
        var HiddenHolderChartObject = $('<div class="HiddenItemHolder"></div>');
        var ItemHolderChartFunction = $('<div class="ItemHolder" style="display: inline-block;"></div>');
        var HiddenHolderChartFunction = $('<div class="HiddenItemHolder"></div>');
        var ItemHolderVisualTools = $('<div class="ItemHolder" style="display: inline-block;"></div>');
        var HiddenHolderVisualTools = $('<div class="HiddenItemHolder"></div>');
        var ToolBarMarker = $('<div class="item"><span class="Divider"></span><div title="Show/Hide Bar Marker" class="ToolBarItem ToolMarker"></div></div>');
        var ToolBarLegend = $('<div class="item"><span class="Divider"></span><div title="Show/Hide Bar Legend" legend="" class="ToolBarItem  ToolLegend"></div></div>');
        var ToolBarTradePanel = $(' <div class="item"><span class="Divider"></span><div title="Show/Hide Ask|Bid Panel" class="ToolBarItem ToolTradePanel ToolActive"></div></div>');
        var ToolBarBidLine = $('<div class="item"><span class="Divider"></span><div title="Show/Hide Bid Line" class="ToolBarItem ToolBidLine ToolActive"></div></div>');
        var ToolBarAskLine = $('<div class="item"><span class="Divider"></span><div title="Show/Hide Ask Line" class="ToolBarItem ToolAskLine"></div></div>');
        var ToolBarSeparator = $('<div class="item"><span class="Divider"></span><div title="Show/Hide Period Separator" class="ToolBarItem ToolSeparator"></div></div>');
        var ToolBarVolume = $('<div class="item"><span class="Divider"></span><div title="Show/Hide Tick Volume" class="ToolBarItem ToolVolume"></div></div>');
        var ToolBarOHLCDigits = $('<div class="item"><span class="Divider"></span><div title="Show/Hide OHLC Digits" class="ToolBarItem ToolOHLCDigits"></div></div>');
        var ToolBarOpenTrades = $('<div class="item"><span class="Divider"></span><div class="ToolBarItem ToolTrades"><span>Trades</span></div></div>');
        var ToolBarGraphType = $('<div class="item"><span class="Divider"></span><div title="CandleStick Graph Type" class="ToolBarItem ToolCandleStick ToolActive"></div><span class="Divider"></span><div title="Bar Graph Type" class="ToolBarItem ToolBarGraph"></div><span class="Divider"></span><div title="Line Graph Type" class="ToolBarItem ToolLineGraph"></div></div>');
        var ToolBarNewGraphType = $('<div class="item"><span class="Divider"></span><div title="Point and Figure Graph Type" class="ToolBarItem ToolPointAndFigure"></div><span class="Divider"></span><div title="Line Break Graph Type" class="ToolBarItem ToolLineBreak"></div><span class="Divider"></span><div title="Renko Graph Type" class="ToolBarItem ToolRenko"></div><span class="Divider"></span><div title="Kagi Graph Type" class="ToolBarItem ToolKagi"></div></div>');
        var ToolBarZoomItem = $('<div class="item"><span class="Divider"></span><div class="ToolBarItemHolderZoomItem MenuItemZoom"><div class="ToolZoomOut"></div><div title="Zoom Chart 40%" class="ToolBarItem ToolZoomChart"></div><div class="ToolZoomIn"></div></div></div>');
        var ToolBarSymbolSelector = $('<div class="item"><span class="Divider"></span><div class="MainHolderSymbolSelector MainContainerSymbolSelector"><div class="SymbolContainer"></div><div class="BtnShowSymbolSelector"></div></div>');
        var ToolBarTimeFrame = $('<div class="item"><span class="Divider"></span><div  class="ToolBarItem ToolTimeFrame"><div class="TimeFrameBackgroundHolder"></div><div class="TimeFrameTextHolder">Timeframe</div><div class="ArrowDownTimeFrame"></div></div></div>');
        var ToolBarReversal = $('<div class="item"><span class="Divider"></span><div class="InputToolBarItem"><div class="InputToolBarLabel">Reversal in Pips</div><div class="InputToolBarInput"><input class="ReversalSpinner" /></div></div>');
        var ToolBarAndrewsPitch = $('<div class="item"><span class="Divider"></span><div title="Andrew&#39;s Pitchfork" class="ToolBarItem ToolPitchFork" id="ToolPitchFork-' + ContainerID + '"></div><div title="Trend Line" class="ToolBarItem ToolTrendLine"></div></div>');
        var ToolBarTrendLine = $('<div class="item"><span class="Divider"></span><div title="Andrew&#39;s Pitchfork" class="ToolBarItem ToolPitchFork" id="ToolPitchFork-' + ContainerID + '"></div><div title="Trend Line" class="ToolBarItem ToolTrendLine" id="ToolTrendLine-' + ContainerID + '"></div></div>');
        var ToolBarTrendLineB = $('<div class="item"><span class="Divider"></span><div title="Trend Line" class="ToolBarItem ToolTrendLine" id="ToolTrendLineB-' + ContainerID + '"></div></div>');
        var ToolBarEllipseRectangle = $('<div class="item"><span class="Divider"></span><div title="Ellipse" class="ToolBarItem ToolEllipsis" id="ToolEllipse-' + ContainerID + '"></div><div title="Rectangle" class="ToolBarItem ToolRectangle" id="ToolRectangle-' + ContainerID + '"></div></div>');
        var ToolBarGann = $('<div class="item"><span class="Divider"></span><div title="Gann Fan" class="ToolBarItem ToolGannFan" id="ToolGannFan-' + ContainerID + '"></div><div title="Gann Line" class="ToolBarItem ToolGannLine" id="ToolGannLine-' + ContainerID + '"></div></div>');
        var ToolBarFib = $('<div class="item"><span class="Divider"></span><div title="Fibonacci Arc" class="ToolBarItem ToolFibArc" id="ToolFibArc-' + ContainerID + '"></div><div title="Fibonacci Fan" class="ToolBarItem ToolFibFan" id="ToolFibFan-' + ContainerID + '"></div><div title="Fibonacci Timezone" class="ToolBarItem ToolFibTime" id="ToolFibTime-' + ContainerID + '"></div></div>');
        var ToolText = $('<div class="item"><span class="Divider"></span><div title="Text" class="ToolBarItem ToolText" id="ToolText-' + ContainerID + '"></div></div>');
        var ToolForexChannel = $('<div class="item"><span class="Divider"></span><div title="Forex Channel" class="ToolBarItem ToolForexChannel" id="ToolForexChannel-' + ContainerID + '"></div></div>');
        var DraggerChartObject = $('<div class="GroupDragger"><div></div><div></div><div></div></div>');
        var DraggerChartFunction = $('<div class="GroupDragger"><div></div><div></div><div></div></div>');
        var DraggerVisualTools = $('<div class="GroupDragger"><div></div><div></div><div></div></div>');
        var ToolBarLineColor = $('<div class="item"><span class="Divider"></span><div title="Line Color" class="ToolBarItem SpLineColor"><input class="spStrokeColor" id="spToolBarStrokeColor-' + ContainerID + '" style="float:left; width:45px;height:12px;vertical-align: middle" ></div></div>');
        var ToolBarHoverColor = $('<div class="item"><span class="Divider"></span><div title="Hover Color" class="ToolBarItem SpHoverColor"><input class="spHoverColor" id="spToolBarHoverColor-' + ContainerID + '" style="float:left; width:45px;height:12px;vertical-align: middle" ></div></div>');
        var SpStrokeColpicker = ToolBarLineColor.find('#spToolBarStrokeColor-' + ContainerID);
        InitToolbarColorPicker(SpStrokeColpicker);
        var SpHoverColpicker = ToolBarHoverColor.find('#spToolBarHoverColor-' + ContainerID);
        InitToolbarColorPicker(SpHoverColpicker);
        ItemHolderChartObject.append(DraggerChartObject);
        ItemHolderChartObject.append(ToolBarMarker);
        ItemHolderChartObject.append(ToolBarLegend);
        ItemHolderChartObject.append(ToolBarTradePanel);
        ItemHolderChartObject.append(ToolBarBidLine);
        ItemHolderChartObject.append(ToolBarAskLine);
        ItemHolderChartObject.append(ToolBarSeparator);
        ItemHolderChartObject.append(ToolBarVolume);
        ItemHolderChartObject.append(ToolBarOHLCDigits);
        if (self.IsShowTrades) { ItemHolderChartObject.append(ToolBarOpenTrades); }
        self.ChartObjectsGroup.append(ItemHolderChartObject);
        self.ChartObjectsGroup.append(HiddenHolderChartObject);
        ToolBar.append(self.ChartObjectsGroup);
        ItemHolderChartFunction.append(DraggerChartFunction);
        ItemHolderChartFunction.append(ToolBarGraphType);
        if (!self.IsUseSpecialIndicatorList) { ItemHolderChartFunction.append(ToolBarNewGraphType); }
        ItemHolderChartFunction.append(ToolBarZoomItem);
        ItemHolderChartFunction.append(ToolBarSymbolSelector);
        ItemHolderChartFunction.append(ToolBarTimeFrame);
        if (self.IsShowRenko || self.IsShowPointAndFigure || self.IsShowLineBreak || self.IsShowKagi) {
            ItemHolderChartFunction.append(ToolBarReversal);
            ItemHolderChartFunction.append(ToolBarBoxSize);
        }
        self.ChartFunctionGroup.append(ItemHolderChartFunction);
        self.ChartFunctionGroup.append(HiddenHolderChartFunction);
        ToolBar.append(self.ChartFunctionGroup);
        ItemHolderVisualTools.append(DraggerVisualTools);
        ItemHolderVisualTools.append(ToolBarLineColor);
        ItemHolderVisualTools.append(ToolBarHoverColor);
        ItemHolderVisualTools.append(ToolText);
        ItemHolderVisualTools.append(ToolBarEllipseRectangle);
        ItemHolderVisualTools.append(ToolBarTrendLineB);
        ItemHolderVisualTools.append(ToolBarGann);
        ItemHolderVisualTools.append(ToolForexChannel);
        ItemHolderVisualTools.append(ToolBarFib);
        self.VisualToolsGroup.append(ItemHolderVisualTools);
        self.VisualToolsGroup.append(HiddenHolderVisualTools);
        ToolBar.append(self.VisualToolsGroup);


        ToolBarTradePanel = null;
        ToolBarBidLine = null;
        ToolBarAskLine = null;

        return ToolBar;
    }

    function SetSymbolSetterVisibility() {
        try {
            var QuotesLength = QuotesViewModel.Quotes().length;
            for (var i = 0; i < QuotesLength; i++) {
                var quote = QuotesViewModel.Quotes()[i];
                if (quote.Symbol() === ChartInstance.ChartSettings.Symbol) {
                    UpdateSymbolSelectorText(quote.LongName());
                    _currentSymbolLongName = quote.LongName();
                    if (SubObj !== null) {
                        SubObj.dispose();
                    }
                    quote = null;
                    return;
                }
                quote = null;
            }
        }
        catch (e) {
            console.log(e);
        }
    }

    function InitChartSCrollBar() {

        self.ChartFormElement.find('.ToolZoomIn').click(eToolZoomIn);

        self.ChartFormElement.find('.ToolZoomOut').click(eToolZoomOut);

        SecondScrollBarHolder.slider({
            value: 1,
            max: 1
        });
        self.ChartFormElement.find('div.ToolZoomChart').slider({
            value: 0,
            max: 4
        });
        self.ChartFormElement.find('div.ToolZoomChart ').slider("value", 4);
        InitToolScrollZoomEvent();
    }

    function InitToolScrollZoomEvent() {
        self.ChartFormElement.find('div.ToolZoomChart').on("slide", eSlideZoomChart);
    }

    function ResizeFunctionForItems() {
        var MainElementToAppend = ToolBar;
        var ItemGroupLength = MainElementToAppend.find('.ItemGroup').length;
        for (var ii = ItemGroupLength - 1; ii >= 0; ii--) {
            var CurrentSelectedGroup = MainElementToAppend.find('.ItemGroup').eq(ii);
            var IsStillNotEnough = true;
            while (IsStillNotEnough) {
                var TotalWidthItem = 0;
                var MainContainerWidth = MainElementToAppend.width();
                TotalWidthItem = GetTotalWidthOfItems(MainElementToAppend);

                if (CurrentSelectedGroup.find('div.ItemHolder .item').length > 1) {
                    var WidthOfAllArrowDownDiv = MainElementToAppend.find('.ArrowDownHiddenItems').length * 25 - 50;
                    if (MainContainerWidth < TotalWidthItem + 7 + WidthOfAllArrowDownDiv) {
                        CurrentSelectedGroup.find('div.HiddenItemHolder').append(CurrentSelectedGroup.find('div.ItemHolder .item')[CurrentSelectedGroup.find('div.ItemHolder .item').length - 1]);
                        if (CurrentSelectedGroup.find('div.ItemHolder .ArrowDownHiddenItems').length === 0) {
                            ReAddArrowItem(false, CurrentSelectedGroup);
                        }
                    }
                    else {
                        IsStillNotEnough = false;
                    }
                }
                else {
                    IsStillNotEnough = false;
                }
                var ContainerUsedToRestore = "";
                var iItemGroupLength = MainElementToAppend.find('.ItemGroup').length;
                for (var c = 0; c < iItemGroupLength; c++) {
                    var TempContainer = MainElementToAppend.find('.ItemGroup').eq(c);
                    if (TempContainer.find('div.HiddenItemHolder .item').length !== 0) {
                        ContainerUsedToRestore = MainElementToAppend.find('.ItemGroup').eq(c);
                        break;
                    }
                }

                if (ContainerUsedToRestore !== "") {
                    if (ContainerUsedToRestore.find('div.HiddenItemHolder .item').length !== 0) {
                        var IsNotEnough = true;
                        while (IsNotEnough) {
                            if (ContainerUsedToRestore.find('div.HiddenItemHolder .item').length === 0) {
                                ContainerUsedToRestore.find('div.ItemHolder .ArrowDownHiddenItems').remove();
                                CurrentSelectedGroup = null;
                                ContainerUsedToRestore = null;
                                return;
                            }
                            var WidthOfAllArrowDownDiv = MainElementToAppend.find('.ArrowDownHiddenItems').length * 25 - 50;
                            if (ContainerUsedToRestore.find('div.HiddenItemHolder .item').length === 1) {
                                if (WidthOfAllArrowDownDiv !== 0) {
                                    WidthOfAllArrowDownDiv = WidthOfAllArrowDownDiv - 25;
                                }
                            }
                            if (MainContainerWidth > TotalWidthItem + 7 + ContainerUsedToRestore.find('div.HiddenItemHolder .item')[ContainerUsedToRestore.find('div.HiddenItemHolder .item').length - 1].offsetWidth + WidthOfAllArrowDownDiv) {
                                TotalWidthItem = TotalWidthItem + ContainerUsedToRestore.find('div.HiddenItemHolder .item')[0].offsetWidth;
                                ContainerUsedToRestore.find('div.ItemHolder').append(ContainerUsedToRestore.find('div.HiddenItemHolder .item')[ContainerUsedToRestore.find('div.HiddenItemHolder .item').length - 1]);
                                ReAddArrowItem(true, ContainerUsedToRestore);
                            }
                            else {
                                IsNotEnough = false;
                            }
                        }
                    }
                }
            }
            if (CurrentSelectedGroup.find('div.HiddenItemHolder .item').length === 0) {
                CurrentSelectedGroup.find('div.HiddenItemHolder').css('visibility', 'hidden');
            }
            CurrentSelectedGroup = null;
            ContainerUsedToRestore = null;
        }
    }

    function ReAddArrowItem(NeedToRemove, Group) {
        if (NeedToRemove) {
            Group.find('div.ItemHolder .ArrowDownHiddenItems').remove();
        }
        var DivToAppendArrow = $('<div class="ArrowDownHiddenItems"><div class="ArrowDownImageContainer"></div></div>');
        Group.find('div.ItemHolder').append(DivToAppendArrow);
    }

    function GetTotalWidthOfItems(MainElementToAppend) {
        var TotalGroupWidth = 0;
        var TotalVisibleGroup = 0;
        var ItemGroupLength = MainElementToAppend.find('.ItemGroup').length;
        for (var i = 0; i < ItemGroupLength; i++) {
            var Internallength = MainElementToAppend.find('.ItemGroup').eq(i).find('div.ItemHolder .item').length;
            for (var iii = 0; iii < Internallength; iii++) {
                var CurrentGroupElement = MainElementToAppend.find('.ItemGroup').eq(i).find('div.ItemHolder .item')[iii];
                TotalGroupWidth = TotalGroupWidth + CurrentGroupElement.offsetWidth;
            }
            if (MainElementToAppend.find('.ItemGroup')[i].offsetWidth !== 0) {
                TotalVisibleGroup++;
            }
        }
        TotalGroupWidth = TotalGroupWidth + 9 + (30 * TotalVisibleGroup) + 23;
        return TotalGroupWidth;
    }

    function AttachEventOnArrowDownButton() {
        var MainElementToAppend = ToolBar;
        ToolBar.delegate(".ArrowDownHiddenItems", "click", function () {
            ShowHideHiddenItems($(this).parent().parent(), MainElementToAppend);
        });
    }

    function ShowHideHiddenItems(MainElementToAppend, ParentElement) {
        var VisibilityStatus = MainElementToAppend.find('div.HiddenItemHolder').css('visibility');
        ParentElement.find('div.HiddenItemHolder').css('visibility', 'hidden');
        if (MainElementToAppend.find('div.HiddenItemHolder .item').length !== 0) {
            if (VisibilityStatus === 'hidden') {
                MainElementToAppend.find('div.HiddenItemHolder').css('visibility', 'visible');
            }
            else {
                MainElementToAppend.find('div.HiddenItemHolder').css('visibility', 'hidden');
            }
        }
    }

    function AttachClickEventToCloseHiddenItemsContainer() {
        var container = self.ChartFormElement.find('.ChartToolBar div.HiddenItemHolder');
        var container2 = self.ChartFormElement.find('.ChartMenu div.HiddenItemsForMenu');
        $(document).mouseup(function (e) {
            if (self === null) {
                return;
            }
            if ($('#forexchart').is(e.target) || $('#forexchart').has(e.target).length !== 0) {
                if (!container.is(e.target) && container.has(e.target).length === 0 && e.target.className !== "ArrowDownImageContainer") {
                    container.css('visibility', 'hidden');
                }
                if (!container2.is(e.target) && container2.has(e.target).length === 0 && e.target.className !== 'ArrowDownMenu wt-arrow-down-gray-icon') {
                    container2.css('visibility', 'hidden');
                }
                if (self.ParentElement !== null) {
                    if (self.ParentElement.is(e.target) || self.ParentElement.has(e.target).length !== 0) {
                        TitleBar.addClass('wt-ActiveChartHeader');
                        self.ParentElement.trigger("ChartActivated", [self, GetChartMenu, true]);
                    }
                    else {
                        TitleBar.removeClass('wt-ActiveChartHeader');
                    }
                }
            }
        });
    }

    function AttackClickEventOnSymbolSelector() {
        var ButtonSelector = self.ChartFormElement.find('.ChartToolBar .BtnShowSymbolSelector');
        WC.SymbolSelector = ButtonSelector;
        WC.SymbolSelector.SymbolSelector({

            show: false

            , width: 320

            , position: { top: 18, left: -265 }

            , selecteditem: function (obj) { //callback function
                var _item = obj.item; //returned the selected item
                var _symbol = obj.symbol;//returned the symbol
                ChartInstance.ChangeSymbol(_symbol);
                UpdateSymbolSelectorText(_item);
                _currentSymbolLongName = _item;
                SetTitleBarCaption();
            }

            , quotes: QuotesViewModel.Quotes
        });
    }

    function UpdateSymbolSelectorText(Value) {
        self.ChartFormElement.find('.SymbolContainer').text(Value);
        $('.' + MainContainerID + 'SymbolSelector .SymbolContainer').text(Value);
    }

    function InitToolbarColorPicker(inputbox) {
        inputbox.spectrum({
            color: '#585858'
            , showPalette: true
            , palette: [
                       ["#000", "#444", "#666", "#999", "#ccc", "#eee", "#f3f3f3", "#fff"],
                       ["#f00", "#f90", "#ff0", "#0f0", "#0ff", "#00f", "#90f", "#f0f"],
                       ["#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc"],
                       ["#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
                       ["#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6fa8dc", "#8e7cc3", "#c27ba0"],
                       ["#c00", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3d85c6", "#674ea7", "#a64d79"],
                       ["#900", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#0b5394", "#351c75", "#741b47"],
                       ["#600", "#783f04", "#7f6000", "#274e13", "#0c343d", "#073763", "#20124d", "#4c1130"]
            ]
           , showPaletteOnly: true
           , togglePaletteOnly: true
           , cancelText: 'Cancel'
           , chooseText: 'Select'
           , togglePaletteMoreText: 'More'
           , togglePaletteLessText: 'Less'
           , hideAfterPaletteSelect: true
           , disabled: true
        });
    }

    function SetToolBarGroupVisibility() {
        if (self.IsChartDisplayVisible) {
            self.ChartFunctionGroup.css('display', 'inline-block');

        }
        else {
            self.ChartFunctionGroup.css('display', 'none');
        }

        if (self.IsChartObjectsVisible) {
            self.ChartObjectsGroup.css('display', 'inline-block');
        }
        else {
            self.ChartObjectsGroup.css('display', 'none');
        }

        if (self.IsVisualToolsVisible) {
            self.VisualToolsGroup.css('display', 'inline-block');
        } else {
            self.VisualToolsGroup.css('display', 'none');
        }

    }

    function GetChartMenu() {
        return {
            "RCGraphType": {
                name: "Graph Type", className: "InActiveGraphType", items: {
                    "CandleStick": {
                        name: "CandleStick", className: "CandleStick" + ((ChartInstance.ChartSettings.GraphType === "CandleStick") ? " ActiveMenuItemCandleStick" : " InActiveCandleStick"), callback: function () {
                            ChartInstance.ChangeGraphType("CandleStick");
                            SetToolBarActiveClass();
                        }
                    }, "BarGraph": {
                        name: "Bar Graph", className: "BarGraph" + ((ChartInstance.ChartSettings.GraphType === "BarChart") ? " ActiveMenuItemBarGraph" : " InActiveBarGraph"), callback: function () {
                            ChartInstance.ChangeGraphType("BarChart");
                            SetToolBarActiveClass();
                        }
                    }, "LineGraph": {
                        name: "LineGraph", className: "LineGraph" + ((ChartInstance.ChartSettings.GraphType === "LineChart") ? " ActiveMenuItemLineGraph" : " InActiveLineGraph"), callback: function () {
                            ChartInstance.ChangeGraphType("LineChart");
                            SetToolBarActiveClass();
                        }
                    }, "PointAndFigure": {
                        name: "PointAndFigure", className: "PointAndFigure" + ((ChartInstance.ChartSettings.GraphType === "PointAndFigure") ? " ActiveMenuItemPointAndFigure" : " InActivePointAndFigure"), callback: function () {
                            ChartInstance.ChangeGraphType("PointAndFigure");
                            SetToolBarActiveClass();
                        }
                    }, "LineBreak": {
                        name: "LineBreak", className: "LineBreak" + ((ChartInstance.ChartSettings.GraphType === "LineBreak") ? " ActiveMenuItemLineBreak" : " InActiveLineBreak"), callback: function () {
                            ChartInstance.ChangeGraphType("LineBreak");
                            SetToolBarActiveClass();
                        }
                    }, "Renko": {
                        name: "Renko", className: "Renko" + ((ChartInstance.ChartSettings.GraphType === "Renko") ? " ActiveMenuItemRenko" : " InActiveRenko"), callback: function () {
                            ChartInstance.ChangeGraphType("Renko");
                            SetToolBarActiveClass();
                        }
                    }, "Kagi": {
                        name: "Kagi", className: "Kagi" + ((ChartInstance.ChartSettings.GraphType === "Kagi") ? " ActiveMenuItemKagi" : " InActiveKagi"), callback: function () {
                            ChartInstance.ChangeGraphType("Kagi");
                            SetToolBarActiveClass();
                        }
                    }
                }
            },
            "RCTimeFrame": {
                name: "Time Frame", className: "InActiveTimeFrame", items: {
                    "1M": {
                        name: "1 Minute", className: ((ChartInstance.ChartSettings.TimeFrame === 1) ? "ContextMenuChecked" : ""), callback: function () {
                            ChartInstance.ChangeTimeFrame(1);
                            SetTitleBarCaption();

                        }
                    }, "5M": {
                        name: "5 Minute", className: ((ChartInstance.ChartSettings.TimeFrame === 5) ? "ContextMenuChecked" : ""), callback: function () {
                            ChartInstance.ChangeTimeFrame(5);
                            SetTitleBarCaption();

                        }
                    }, "15M": {
                        name: "15 Minute", className: ((ChartInstance.ChartSettings.TimeFrame === 15) ? "ContextMenuChecked" : ""), callback: function () {
                            ChartInstance.ChangeTimeFrame(15);
                            SetTitleBarCaption();

                        }
                    }, "30M": {
                        name: "30 Minute", className: ((ChartInstance.ChartSettings.TimeFrame === 30) ? "ContextMenuChecked" : ""), callback: function () {
                            ChartInstance.ChangeTimeFrame(30);
                            SetTitleBarCaption();

                        }
                    }, "1H": {
                        name: "1 Hour", className: ((ChartInstance.ChartSettings.TimeFrame === 60) ? "ContextMenuChecked" : ""), callback: function () {
                            ChartInstance.ChangeTimeFrame(60);
                            SetTitleBarCaption();

                        }
                    }, "3H": {
                        name: "3 Hours", className: ((ChartInstance.ChartSettings.TimeFrame === 180) ? "ContextMenuChecked" : ""), callback: function () {
                            ChartInstance.ChangeTimeFrame(180);
                            SetTitleBarCaption();

                        }
                    }, "4H": {
                        name: "4 Hours", className: ((ChartInstance.ChartSettings.TimeFrame === 240) ? "ContextMenuChecked" : ""), callback: function () {
                            ChartInstance.ChangeTimeFrame(240);
                            SetTitleBarCaption();

                        }
                    }, "6H": {
                        name: "6 Hours", className: ((ChartInstance.ChartSettings.TimeFrame === 360) ? "ContextMenuChecked" : ""), callback: function () {
                            ChartInstance.ChangeTimeFrame(360);
                            SetTitleBarCaption();

                        }
                    }, "8H": {
                        name: "8 Hours", className: ((ChartInstance.ChartSettings.TimeFrame === 480) ? "ContextMenuChecked" : ""), callback: function () {
                            ChartInstance.ChangeTimeFrame(480);
                            SetTitleBarCaption();

                        }
                    }, "12H": {
                        name: "12 Hours", className: ((ChartInstance.ChartSettings.TimeFrame === 720) ? "ContextMenuChecked" : ""), callback: function () {
                            ChartInstance.ChangeTimeFrame(720);
                            SetTitleBarCaption();

                        }
                    }, "D1": {
                        name: "Daily", className: ((ChartInstance.ChartSettings.TimeFrame === 1440) ? "ContextMenuChecked" : ""), callback: function () {
                            ChartInstance.ChangeTimeFrame(1440);
                            SetTitleBarCaption();

                        }
                    }, "Weekly": {
                        name: "Weekly", className: ((ChartInstance.ChartSettings.TimeFrame === 10080) ? "ContextMenuChecked" : ""), callback: function () {
                            ChartInstance.ChangeTimeFrame(10080);
                            SetTitleBarCaption();

                        }
                    }, "Monthly": {
                        name: "Monthly", className: ((ChartInstance.ChartSettings.TimeFrame === 43829) ? "ContextMenuChecked" : ""), callback: function () {
                            ChartInstance.ChangeTimeFrame(43829);
                            SetTitleBarCaption();

                        }
                    }
                }
            },
            "RCChartObjects": {
                name: "Chart Objects", className: "InActiveChartObjects", items: {
                    "Marker": {
                        name: "Marker", className: ((ChartInstance.ChartSettings.IsChartMarkerVisible) ? "ActiveMenuItemMarker" : "InActiveMarker"), callback: function () {
                            ChartInstance.SetMarkerVisibility();
                            SetToolBarActiveClass();
                        }
                    }, "Legend": {
                        name: "Legend", className: ((ChartInstance.ChartSettings.IsLegendVisible) ? "ActiveMenuItemLegend" : "InActiveLegend"), callback: function () {
                            ChartInstance.SetLegendVisibility();
                            SetToolBarActiveClass();
                        }
                    }, "TradePanel": {
                        name: "TradePanel", className: ((ChartInstance.ChartSettings.IsTradePanelVisible) ? "ActiveMenuItemTradePanel" : "InActiveTradePanel"), callback: function () {
                            ChartInstance.SetTradePanelVisibility();
                            SetToolBarActiveClass();

                        }
                    }, "Bid": {
                        name: "Bid", className: ((ChartInstance.ChartSettings.IsBidLineVisible) ? "ActiveMenuItemBidLine" : "InActiveBidLine"), callback: function () {
                            ChartInstance.ShowHideBidLine();
                            SetToolBarActiveClass();

                        }
                    }, "Ask": {
                        name: "Ask", className: ((ChartInstance.ChartSettings.IsAskLineVisible) ? "ActiveMenuItemAskLine" : "InActiveAskLine"), callback: function () {
                            ChartInstance.ShowHideAskLine();
                            SetToolBarActiveClass();

                        }
                    }, "Separator": {
                        name: "Period Separator", className: ((ChartInstance.ChartSettings.IsPeriodSeparator) ? "ActiveMenuItemSeparator" : "InActiveSeparator"), callback: function () {
                            ChartInstance.SetPeriodSeparatorVisibility();
                            SetToolBarActiveClass();

                        }
                    }, "Volume": {
                        name: "Volume", className: ((ChartInstance.ChartSettings.IsVolumeVisible) ? "ActiveMenuItemVolume" : "InActiveVolume"), callback: function () {
                            ChartInstance.SetVolumeVisibility();
                            SetToolBarActiveClass();

                        }
                    },
                    "OHLCDigits": {
                        name: "OHLC Digits", className: ((ChartInstance.ChartSettings.IsOHLCDigitsVisible) ? "ActiveMenuItemOHLCDigits" : "InActiveOHLCDigits"), callback: function () {
                            ChartInstance.SetOHLCDataUpperLeftVisibility();
                        }
                    },
                    "Trades": {
                        name: "Trades", className: "InActiveTrades",
                        items: {
                            "LineStyle": {
                                name: "Line Style", className: ((ChartInstance.ChartSettings.IsLineStyle) ? "ActiveMenuItemLineStyle" : "InActiveLine"), callback: function () {
                                    ChartInstance.SetLineStyleTrades();

                                }
                            }, "ArrowStyle": {
                                name: "Arrow Style", className: ((ChartInstance.ChartSettings.IsArrowStyle) ? "ActiveMenuItemArrowStyle" : "InActiveArrow"), callback: function () {
                                    ChartInstance.SetArrowStyleTrades();

                                }
                            }, "Hide": {
                                name: "Hide", className: ((!ChartInstance.ChartSettings.IsOpenTradeVisible) ? "ActiveMenuItemHide" : "InActiveHide"), callback: function () {
                                    ChartInstance.SetTradesVisibility();

                                }
                            }
                        }
                    }, "Orders": {
                        name: "Orders", className: ((ChartInstance.ChartSettings.IsOrdersVisible) ? "ActiveMenuItemAOrders" : "InActiveOrders"), callback: function () {
                            ChartInstance.SetStopLimitVisibility();

                        }
                    }
                }
            },
            "RCVisualTools": {
                name: "Visual Tools", className: "InActiveVisualTools", items:
                    {
                        "Line": {
                            name: "Line", className: "InActiveTrendLine", items:
                                {

                                    "TrendLine": {
                                        name: "Trend Line", className: "InActiveTrendLine", callback: function () {
                                            VisualToolInstance.StartDrawing('trendline');
                                        }
                                    }
                                }
                        }, "Shape": {
                            name: "Shape", className: "InActiveEllipsis",
                            items: {
                                "Ellipse": {
                                    name: "Ellipse", className: "InActiveEllipsis", callback: function () {
                                        VisualToolInstance.StartDrawing('ellipse');

                                    }
                                }, "Rectangle": {
                                    name: "Rectangle", className: "InActiveRectangle", callback: function () {
                                        VisualToolInstance.StartDrawing('rectangle');
                                    }
                                }
                            }
                        }, "Text": {
                            name: "Text", className: "InActiveText", callback: function () {
                                VisualToolInstance.StartDrawing('text');
                            }
                        }
                    }
            },

        };
    }

    function DisableBoxSizeReversal() {
        switch (ChartInstance.ChartSettings.GraphType) {
            case "PointAndFigure":
                BoxSizeSpinner.WCSpinner("enable");
                ReversalSpinner.WCSpinner("enable");
                break;

            case "LineBreak":
                BoxSizeSpinner.WCSpinner("disable");
                ReversalSpinner.WCSpinner("disable");
                break;

            case "Renko":
                BoxSizeSpinner.WCSpinner("enable");
                ReversalSpinner.WCSpinner("disable");
                break;

            case "Kagi":
                BoxSizeSpinner.WCSpinner("disable");
                ReversalSpinner.WCSpinner("enable");
                break;

            default:
                BoxSizeSpinner.WCSpinner("disable");
                ReversalSpinner.WCSpinner("disable");
                break;
        }
    }

    function ChangeGraphType(GraphType) {
        ChartInstance.ChangeGraphType(GraphType);
        ChartInstance.Resizemethod();
        SetToolBarActiveClass();
    }

    function ChangeTimeFrame(iTimeFrame) {
        ChartInstance.ChangeTimeFrame(iTimeFrame);
        SetTitleBarCaption();
    }

    //EventFunctions
    function eToolZoomOut() {
        var Value = self.ChartFormElement.find('div.ToolZoomChart ').slider("value") - 1;
        if (Value < 0) {
            return;
        }
        self.ChartFormElement.find('div.ToolZoomChart ').slider("value", Value);
        ChartInstance.ChartSettings.ZoomLevel = 4 - Value;
        ChartInstance.Resizemethod();
        self.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
    }

    function eToolZoomIn() {
        var Value = (self.ChartFormElement.find('div.ToolZoomChart ').slider("value") + 1);
        if (Value > 4) {
            return;
        }
        self.ChartFormElement.find('div.ToolZoomChart ').slider("value", Value);
        ChartInstance.ChartSettings.ZoomLevel = 4 - Value;
        ChartInstance.Resizemethod();
        self.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
    }

    function eSlideZoomChart(event, ui) {
        ChartInstance.ChartSettings.ZoomLevel = 4 - ui.value;
        ChartInstance.Resizemethod();
    }

    function eToolMarkerClick() {
        ChartInstance.SetMarkerVisibility();
        SetToolBarActiveClass();
    }

    function eToolLegendClick() {
        ChartInstance.SetLegendVisibility();
        SetToolBarActiveClass();
    }

    function eToolTradePanelClick() {
        ChartInstance.SetTradePanelVisibility();
        SetToolBarActiveClass();
    }

    function eToolTradePanelSellClick() {
        _comObj.Trigger("InstantOpenTrade"
            , {
                Type: "Sell"
                , Price: $(this).find("span").text()
                , Volume: $('#' + ContainerID + ' .TradePanel #VolumeSpinner').val()
                , Symbol: self.Symbol()
            });
    }

    function eToolTradePanelBuyClick() {
        _comObj.Trigger("InstantOpenTrade", {
            Type: "Buy"
            , Price: $(this).find("span").text()
            , Volume: $('#' + ContainerID + ' .TradePanel #VolumeSpinner').val()
            , Symbol: self.Symbol()
        });
    }

    function eToolBidLineClick() {
        ChartInstance.ShowHideBidLine();
        SetToolBarActiveClass();
    }

    function eToolAskLineClick() {
        ChartInstance.ShowHideAskLine();
        SetToolBarActiveClass();

    }

    function eToolSeparatorClick() {
        ChartInstance.SetPeriodSeparatorVisibility();
        SetToolBarActiveClass();
    }

    function eToolVolumeClick() {
        ChartInstance.SetVolumeVisibility();
        SetToolBarActiveClass();
    }

    function eToolOHLCDigitsClick() {
        ChartInstance.SetOHLCDataUpperLeftVisibility();
        SetToolBarActiveClass();
    }

    function eToolCandleStickClick() {
        ChangeGraphType("CandleStick");
    }

    function eToolBarClick() {
        ChangeGraphType("BarChart");
    }

    function eToolLineClick() {
        ChangeGraphType("LineChart");
    }

    function eToolPointAndFigureClick() {
        ChangeGraphType("PointAndFigure");
    }

    function eToolLineBreakClick() {
        ChangeGraphType("LineBreak");
    }

    function eToolRenkoClick() {
        ChangeGraphType("Renko");
    }

    function eToolKagiClick() {
        ChangeGraphType("Kagi");
    }

    function eToolTrendLineClick() {
        VisualToolInstance.StartDrawing('trendline');
    }

    function eToolRectangleClick() {

        VisualToolInstance.StartDrawing('rectangle');
    }

    function eToolEllipsisClick() {

        VisualToolInstance.StartDrawing('ellipse');
    }

    function eToolTextClick() {

        VisualToolInstance.StartDrawing('text');
    }

    function eToolinpToolBarStrokeColorClick() {
        var value = $(this).val();
        if (vtobjectselected === null) {
            VisualToolInstance.UpdateDefaultStyleProp(value, null, null, null);
        }
        else {
            switch (vtobjectType) {
                case 'line':
                    {
                        VisualToolInstance.UpdateTLineExtProp(vtobjectselected, value, null, null, null);
                    }
                    break;
                case 'rect':
                    {
                        VisualToolInstance.UpdateRectStyleProp(vtobjectselected, value, null, null, null);
                    }
                    break;
                case 'ellipse':
                    {
                        VisualToolInstance.UpdateEllipseStyleProp(vtobjectselected, value, null, null, null);
                    }
                    break;
                case 'i-text':
                    {
                        VisualToolInstance.UpdateTextStyleProp(vtobjectselected, null, value, null, null);
                    }
                    break;
            }
        }

    }

    function eToolinpToolBarHoverColorClick() {
        var value = $(this).val();

        if (vtobjectselected === null) {
            VisualToolInstance.UpdateDefaultStyleProp(null, null, value, null);
        }
        else {
            switch (vtobjectType) {
                case 'line':
                    {
                        VisualToolInstance.UpdateTLineExtProp(vtobjectselected, null, value, null, null);
                    }
                    break;
                case 'rect':
                    {
                        VisualToolInstance.UpdateRectStyleProp(vtobjectselected, null, null, value, null);
                    }
                    break;
                case 'ellipse':
                    {
                        VisualToolInstance.UpdateEllipseStyleProp(vtobjectselected, null, null, value, null);
                    }
                    break;
                case 'i-text':
                    {
                        VisualToolInstance.UpdateTextStyleProp(vtobjectselected, null, null, value, null);
                    }
                    break;
            }
        }

    }

    function eToolinpToolBarFillColorClick() {
        var value = $(this).val();

        if (vtobjectselected === null) {
            VisualToolInstance.UpdateDefaultStyleProp(null, value, null, null);
        }
        else {
            switch (vtobjectType) {
                case 'line':
                    {
                        VisualToolInstance.UpdateTLineExtProp(vtobjectselected, null, value, null, null);
                    }
                    break;
                case 'rect':
                    {
                        VisualToolInstance.UpdateRectStyleProp(vtobjectselected, null, value, null, null);
                    }
                    break;
                case 'ellipse':
                    {
                        VisualToolInstance.UpdateEllipseStyleProp(vtobjectselected, null, value, null, null);
                    }
                    break;
                case 'i-text':
                    {
                        VisualToolInstance.UpdateTextStyleProp(vtobjectselected, null, value, null, null);
                    }
                    break;
            }
        }

    }

    function eMaximizeClick() {
        if (_maximizeCallBack) {
            _maximizeCallBack(self);
        }
    }

    function eCloseClick() {
        if (_CloseCallBack) _CloseCallBack(self);
    }

    function eToolBoxSizeSpinnerOnEnter(val) {
        ChartInstance.ChangeBoxSize(val);
        ChartInstance.Resizemethod();
    }

    function eToolReversalSpinnerOnEnter(val) {
        ChartInstance.ChangeReversal(val);
        ChartInstance.Resizemethod();
    }

    self.SetActiveChart = function (IsActive) {
        if (IsActive) {
            $('.ChartTitleBar').removeClass('wt-ActiveChartHeader');
            TitleBar.addClass('wt-ActiveChartHeader');
            self.ParentElement.trigger("ChartActivated", [self, GetChartMenu, false]);
        }
    };

    self.ChartChangeSymbol = function (Symbol) {
        ChartInstance.ChangeSymbol(Symbol);
        SetSymbolSetterVisibility();
        SetTitleBarCaption();
    };

    self.DisposeChart = function () {
        var LayOutResizeLength = WC.OnLayout.length;
        for (var i = 0; i < LayOutResizeLength; i++) {
            if (WC.OnLayout[i] === ChartInstance.Resizemethod) {
                WC.OnLayout.splice(i, 1);
                break;
            }
        }
        ChartInstance.DisposeChart();
        if (SubObj !== null) {
            SubObj.dispose();
        }

        self = null;
    };

    self.ChartScriptResizeFunction = function () {
        ChartInstance.Resizemethod();
    };

    self.GetChartInstance = function () {
        return ChartInstance;
    }

    self.AddIndicator = IndicatorCtxMenuCallBack;

    };
