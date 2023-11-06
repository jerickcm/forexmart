var WC = WC || {};
WC.CD = WC.CD || {};
WC.CM = WC.CM || {};
WC.IN = WC.IN || {};
WC.VM = {};
WC.OnLayout = [];
WC.ScrollbarX = {};
WC.ChartWords = GetWords();

WC.ComObject = (function () {
    var self = this;
    self.OnLayout = WC.OnLayout;
    self.OnTrigger = [];
    self.Trigger = function (methodname, params) {
        $.each(self.OnTrigger, function (i, f) { if ($.isFunction(f)) f(methodname, params); });
    };
    return self;
})();

WC.Init = function () {

    WC.Document = $(document);
    //init tooltip
    $(document).WCToolTip();

    $(window).on("resize", (function () {
        clearTimeout(WC.ResizeTimeOut);
        WC.ResizeTimeOut = setTimeout(WC.Layout, 100);
    }));
    //Note: Timeframe values must be converted in minute value.
    //Ex.30 Minutes = 30, 1 Hour = 60
    //Initialization of Charts 
    var wc_ohlc_chart = new WC.CD.ChartDisplay({
        ContainerID: "wc-ohlc-chart",
        CallBacks: {
            RequestLastBarStamp: DD.RequestLastBarStamp,

            RequestBarsData: DD.RequestBarsData,

            RequestAdditionalDataForDragging: DD.RequestAdditionalDataForDragging
        },
        Data: {
            Quotes: DD.Quotes,
            IsConnected: ko.observable(true),
            BarsDataHolder: DD.BarsDataHolder
        },
        Options: {
            Symbol: "SymbolXXX",
            TimeFrameItems: DD.TimeFrameItems,
            TimeFrame: 30,
            IsShowTimeframe: true,
            IsShowIndicator: true,
            IsShowVisualTools: true,
            IsShowWIN: true,
            IsShowTradePanel: true,
            IsVisualToolsVisible: false
        }
    });

    WC.Layout();

    DD.Chart = wc_ohlc_chart;

};

WC.Layout = function () {
    // call each function on OnLayout array
    $.each(WC.OnLayout, function (i, v) {
        if ($.isFunction(v)) v();
    });
};

// Global functions
function GetWords() {
    return {
        Timeframe: "Timeframe",
        Minute: "Minute",
        Minutes: "Minutes",
        Hour: "Hour",
        Hours: "Hours",
        Daily: "Daily",
        Weekly: "Weekly",
        Monthly: "Monthly",

        Indicators: "Indicators",
        OnBars: "OnBars",
        Alligator: "Alligator",
        Bollinger_Bands: "Bollinger Bands",
        Donchian_Channel: "Donchian Channel",
        Envelope_Moving_Average: "Envelope Moving Average",
        Exponential_Moving_Average: "Exponential Moving Average",
        Fractal_Chaos_Bands: "Fractal Chaos Bands",
        Parabolic_SAR: "Parabolic SAR",
        Simple_Moving_Average: "Simple Moving Average",
        Weighted_Moving_Average: "Weighted Moving Average",

        Oscillators: "Oscillators",
        Accumulative_Swing_Index: "Accumulative Swing Index",
        Average_True_Range: "Average True Range",
        Bear_Power: "Bear Power",
        Chaikin_Volatility: "Chaikin Volatility",
        Commodity_Channel_Index: "Commodity Channel Index",
        Moving_Average_Convergence_Divergence: "Moving Average Convergence-Divergence",
        Mass_Index: "Mass Index",
        Swing_Index: "Swing Index",
        Ulcer_Index: "Ulcer Index",

        Momentum: "Momentum",
        Stochastic_Oscillator: "Stochastic Oscillator",
        Williams_Percent_R: "Williams Percent R",
        Settings: "Settings",
        Remove_Indicator: "Remove Indicator",
        Remove_All: "Remove All",

        Visual_Tools: "Visual Tools",
        Fibonacci: "Fibonacci",
        Fibonacci_Arc: "Fibonacci Arc",
        Fibonacci_Fan: "Fibonacci Fan",
        Fibonacci_TimeZone: "Fibonacci TimeZone",
        Forex_Channel: "Forex Channel",
        Gann: "Gann",
        Gann_Line: "Gann Line",
        Gann_Fan: "Gann Fan",
        Labels: "Labels",
        Text: "Text",
        Line: "Line",
        Trend_Line: "Trend Line",
        Shapes: "Shapes",
        Ellipse: "Ellipse",
        Rectangle: "Rectangle",
        Remove_Visual_Tool: "Remove Visual Tool",

        Window: "Window",
        Chart_Objects: "Chart Objects",
        Chart_Display: "Chart Display",
        Show_Hide_Bar_Marker: "Show/Hide Bar Marker",
        Show_Hide_Bar_Legend: "Show/Hide Bar Legend",
        Show_Hide_Ask_Bid_Panel: "Show/Hide Ask/Bid Panel",
        Show_Hide_Bid_Line: "Show/Hide Bid Line",
        Show_Hide_Ask_Line: "Show/Hide Ask Line",
        Show_Hide_Period_Separator: "Show/Hide Period Separator",
        Show_Hide_Tick_Volume: "Show/Hide Tick Volume",

        CandleStick_Graph_Type: "CandleStick Graph Type",
        Bar_Graph_Type: "Bar Graph Type",
        Line_Graph_Type: "Line Graph Type",
        Zoom_Chart: "Zoom Chart",

        Collection_Type: "Collection Type",
        Dots: "Dots",
        Color: "Color",
        Custom: "Custom",
        Web: "Web",
        System: "System",
        Automatic: "Automatic",
        Themes_Color: "Themes_Color",
        Shift: "Shift",
        Style: "Style",
        Solid: "Solid",
        Dash: "Dash",
        Dot: "Dot",
        DashDot: "DashDot",
        DashDotDot: "DashDotDot",
        Width: "Width",

        Fore_Color: "Fore Color",
        Highlight_Color: "Highlight Color",
        Line_Width: "Line Width",

        Show: "Show",
        Hide: "Hide",
        Bar: "Bar",
        Marker: "Marker",
        Legend: "Legend",
        Ask: "Ask",
        Bid: "Bid",
        Panel: "Panel",
        Line: "Line",
        Period: "Period",
        Separator: "Separator",
        Tick: "Tick",
        Volume: "Volume",
        Digits: "Digits",
        CandleStick: "CandleStick",
        Graph: "Graph",
        Type: "Type",
        Zoom: "Zoom",
        Chart: "Chart",
        Hover: "Hover",
        Color: "Color",
        Refresh: "Refresh",


        Alligator_s_Jaw: "Alligator's Jaw",
        Alligator_s_Lips: "Alligator's Lips",
        Alligator_s_Teeth: "Alligator's Teeth",
        Computations: "Computations",
        Bollinger_Mid_Line: "Bollinger Mid Line",
        Bollinger_Top_Line: "Bollinger Top Line",
        Bollinger_Bottom_Line: "Bollinger Bottom Line",
        Upper_Band: "Upper Band",
        Middle_Line: "Middle Line",
        Lower_Band: "Lower Band",
        Lower_Band_Line: "Lower Band Line",
        Upper_Band_Line: "Upper Band Line",
        EMA_Line: "EMA Line",
        Fractal_High: "Fractal High",
        Fractal_Low: "Fractal Low",
        SMA_Line: "SMA Line",
        WMA_Line: "WMA Line",
        Jaw_Period: "Jaw Period",
        Lips_Period: "Lips Period",
        Teeth_Period: "Teeth Period",
        Limit_Move: "Limit_Move",
        Deviation: "Deviation",
        Accumulative_Swing_Index_Line: "Accumulative Swing Index Line",
        Histogram: "Histogram",
        Histogram_Fill: "Histogram Fill",
        Histogram_Color_1: "Histogram Color 1",
        Histogram_Color_2: "Histogram Color 2",
        Histogram_Color_3: "Histogram Color 3",
        Histogram_Color_4: "Histogram Color 4",
        VisualType: "VisualType",
        oneLine: "oneLine",
        twoLine: "twoLine",
        Change: "Change",
        Multi: "Multi",
        ATR_Line: "ATR Line",
        Percentage: "Percentage",
        Notation: "Notation",
        CCI_Line: "CCI_Line",
        Short_Period:"Short Period",
        Long_Period:"Long Period",
        Signal_Period:"Signal Period",
        MACD_Line:"MACD Line",
        Signal_Line:"Signal Line",
        MACD_Histogram: "MACD Histogram",
        EMAPeriod: "EMAPeriod",
        Period_Close_Max:"Period Close Max",
        Ulcer_Line: "Ulcer Line",
        Percent_D_Line: "Percent D Line",
        Percent_K_Line: "Percent K Line",
        Polygon1: "Polygon1",
        Polygon2: "Polygon2",
        Percent_D_Period: "Percent D Period",
        Percent_K_Period: "Percent K Period",
        Percent_R_Line: "Percent R Line",
        Font:"Font",
        Highlight_Width: "Highlight Width",
        Extend_to_Infinity: "Extend to Infinity",
        Snap_to_Price: "Snap to Price",
        Open: "Open",
        High: "High",
        Low: "Low",
        Close: "Close",
        Volume: "Volume"

    };
};
function ISOStringToDate(stringDate) {
    if (stringDate) {
        var d = new Date(stringDate.substr(0, 19).replace("T", " ").replace(/-/g, "/"));
        var i = stringDate.indexOf(".");
        if (stringDate.length > 18 && i > 0)
            d.setMilliseconds(parseInt(stringDate.substring(i + 1, 3)));
        return d;
    }
    else return null;
};
function GetBaseUrl() {
    var pathArray = location.href.split('/');
    var protocol = pathArray[0];
    var host = pathArray[2];
    var url = protocol + '//' + host + '/';

    return url;
}
(function () {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame']
                                   || window[vendors[x] + 'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function (callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function () { callback(currTime + timeToCall); },
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function (id) {
            clearTimeout(id);
        };
}());

