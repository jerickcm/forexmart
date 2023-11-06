WC.CM = {};

WC.CM.BaseChart = function (Container, options) {
    var self = this;
    //Default Settings of chart
    self.settings = $.extend({
        ZoomLevel: 3,
        Data: null,
        WeeklyPeriod: 1,
        IsLegendVisible: false,
        IsChartMarkerVisible: false,
        GraphType: "CandleStick",
        TimeFrame: 15,
        BoxSize: 500,
        Reversal: 3,
        Symbol: "",
        ShowSymbolIndicator: true,
        IsAskLineVisible: false,
        IsBidLineVisible: true,
        IsOrdersVisible: false,
        IsLineStyle: true,
        IsArrowStyle: false,
        IsOpenTradeVisible: false,
        IsPeriodSeparator: false,
        IsTradePanelVisible: true,
        IsTradePanelBottomRight: false,
        IsVolumeVisible: false,
        IsOHLCDigitsVisible: true,
        IsOHLCDigitsBottomRight: true,
        IsChartDisplayDisabled: false,
        IsAlwaysShowBidAsk: false,
        CorrelationNumberOfBars: null,
        BackGroundColor: "white",
        BuysTradesColor: "#3399ff",
        ForeGround: "black",
        Grid: "#c0c0c0",
        HighLight: "black",
        Legend: "#008000",
        Line: "#32cd32",
        LosingTrade: "red",
        Marker: "#008000",
        NegativeFill: "red",
        NegativeLine: "black",
        Periods: "black",
        PositiveFill: "#008000",
        PositiveLines: "black",
        SellsTradesColor: "#008000",
        SellsBuysTradesForeColor: "#FFFFFF",
        Volumes: "#0000ff",
        WinningTrade: "#008000",
        ActiveIndicators: [],
        ActiveVisualTools: [],
        IsShowPoweredText: false,
        IsShowWaterMark: false,
        ZoomChartTitle: "Zoom Chart",
        SellBuysLineWidth: 1.5,
        SellBuysDashPattern: [6, 7, 0]
    }, options);

    // Color Schemes
    self.BasicColorScheme = {
        BackGroundColor: "white",
        BuysTradesColor: "#3399ff",
        ForeGround: "black",
        Grid: "#c0c0c0",
        HighLight: "black",
        Legend: "#008000",
        Line: "#32cd32",
        LosingTrade: "red",
        Marker: "#008000",
        NegativeFill: "red",
        NegativeLine: "black",
        Periods: "black",
        PositiveFill: "#008000",
        PositiveLines: "black",
        SellsTradesColor: "#008000",
        Volumes: "#0000ff",
        WinningTrade: "#008000",
    };

    self.GreenOnBlackColorScheme = {
        BackGroundColor: "black",
        BuysTradesColor: self.settings.BuysTradesColor,
        ForeGround: "white",
        Grid: "#262626",
        HighLight: "white",
        Legend: "#008000",
        Line: "#00ff00",
        LosingTrade: "red",
        Marker: "#008000",
        NegativeFill: "white",
        NegativeLine: "#00ff00",
        Periods: "white",
        PositiveFill: "black",
        PositiveLines: "#00ff00",
        SellsTradesColor: self.settings.SellsTradesColor,
        Volumes: "white",
        WinningTrade: "#008000",
    };

    // Set Color Scheme
    self.ColorSchemeDefault = self.BasicColorScheme;

    if (self.settings.Symbol === "") {
        self.settings.Symbol = "EURUSD";
    }

    var zIndexVisualTools = 9;

    var Months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    SetProperties();

    SetAllCanvasNeeded();

    //Set Translate on all context
    self.SetTranslateAllContext = function () {
        self.ctxGridLine.translate(0.5, 0.5);
        self.ctxIndicatorBotCanvas.translate(0.5, 0.5);
        self.ctxMainCanvas.translate(0.5, 0.5);
        self.ctxVolume.translate(0.5, 0.5);
        self.ctxIndicatorTopCanvas.translate(0.5, 0.5);
        self.ctxTradesCanvas.translate(0.5, 0.5);
        self.ctxOrdersCanvas.translate(0.5, 0.5);
        self.ctxVisualToolsCanvas.translate(0.5, 0.5);
        self.ctxDragging.translate(0.5, 0.5);
    };

    //Constructor call to computevaraible needed for first load
    self.DrawBaseChartWithOutData = function () {
        //Height Of the Container
        self.OHLCCanvas.width = 0;
        self.OHLCCanvas.height = 0;
        self.VolumeCanvas.width = 0;
        self.VolumeCanvas.height = 0;
        self.GridLineCanvas.width = 0;
        self.GridLineCanvas.height = 0;
        self.IndicatorTopCanvas.width = 0;
        self.IndicatorTopCanvas.height = 0;
        self.TradesCanvas.width = 0;
        self.TradesCanvas.height = 0;
        self.OrdersCanvas.width = 0;
        self.OrdersCanvas.height = 0;
        self.VisualToolsCanvas.width = 0;
        self.VisualToolsCanvas.height = 0;
        $(self.ParentELement).find('.VisualToolsCanvas').removeAttr('width');
        $(self.ParentELement).find('.VisualToolsCanvas').removeAttr('height');
        $(self.ParentELement).find('.VisualToolsCanvas').attr('width', '0');
        $(self.ParentELement).find('.VisualToolsCanvas').attr('height', '0');
        $(self.ParentELement).find('.canvas-container canvas').removeAttr('style');
        $(self.ParentELement).find('.canvas-container').removeAttr('style');
        self.IndicatorBotCanvas.width = 0;
        self.IndicatorBotCanvas.height = 0;
        self.DraggingCanvas.width = 0;
        self.DraggingCanvas.height = 0;
        self.BaseChartElement.removeAttr("style");
        self.BaseChartElement.attr('style', 'background-color: white; position:relative;height:' + (self.ParentELement.height()) + 'px');
        self.OHLCCanvas.width = self.ParentELement.width();
        self.OHLCCanvas.height = self.ParentELement.height();
        self.VolumeCanvas.width = self.ParentELement.width();
        self.VolumeCanvas.height = self.ParentELement.height();
        self.GridLineCanvas.width = self.ParentELement.width();
        self.GridLineCanvas.height = self.ParentELement.height();
        self.IndicatorTopCanvas.width = self.ParentELement.width() - 60;
        self.IndicatorTopCanvas.height = self.ParentELement.height() - 20;
        self.TradesCanvas.width = self.ParentELement.width() - 60;
        self.TradesCanvas.height = self.ParentELement.height() - 20;
        self.OrdersCanvas.width = self.ParentELement.width() - 60;
        self.OrdersCanvas.height = self.ParentELement.height() - 20;
        self.VisualToolsCanvas.width = self.ParentELement.width() - 60;
        self.VisualToolsCanvas.height = self.ParentELement.height() - 20;
        $(self.ParentELement).find('.VisualToolsCanvas').attr('width', self.ParentELement.width() - 60);
        $(self.ParentELement).find('.VisualToolsCanvas').attr('height', self.ParentELement.height() - 20);
        $(self.ParentELement).find('.canvas-container canvas').attr('style', 'position: absolute; top:0; left: 0px; z-index: ' + zIndexVisualTools + ';width:' + (self.ParentELement.width() - 60) + 'px; height:' + (self.ParentELement.height() - 20) + 'px;');
        $(self.ParentELement).find('.canvas-container').attr('style', 'position: relative; -webkit-user-select: none; width:' + self.ParentELement.width() + 'px; height:' + self.ParentELement.height() + 'px;');
        self.IndicatorBotCanvas.width = self.ParentELement.width() - 60;
        self.IndicatorBotCanvas.height = self.ParentELement.height() - 20;
        self.BaseChartElement.height = self.ParentELement.height();

        self.DraggingCanvas.width = self.ParentELement.width();
        self.DraggingCanvas.height = self.ParentELement.height();

        self.ComputationProperties.height = self.ParentELement.height() - 20;
        //width of the container
        self.ComputationProperties.width = self.ParentELement.width() - 60;
        self.SetTranslateAllContext();
        //Draw Chart withoutData While getting its live data
        DrawVerticalLines(self.ComputationProperties.width, self.ComputationProperties.height, self.ComputationProperties.DefaultBarsWidth, Math.ceil(self.ComputationProperties.width / self.ComputationProperties.DefaultBarsWidth));
        if (self.ChartSettings.IsVolumeVisible) {
            DrawHorizontalLines(self.ComputationProperties.width, self.ComputationProperties.height - (self.ComputationProperties.height * self.ComputationProperties.PercentageOfVolumeSpace), self.ComputationProperties.DefaultBarsWidth, Math.ceil(self.ComputationProperties.height / self.ComputationProperties.DefaultBarsWidth));
        }
        else {
            DrawHorizontalLines(self.ComputationProperties.width, self.ComputationProperties.height, self.ComputationProperties.DefaultBarsWidth, Math.ceil(self.ComputationProperties.height / self.ComputationProperties.DefaultBarsWidth));
        }
        DrawChartBorderLines();

        if (self.ChartSettings.IsShowWaterMark) {
            var fontSize = 120;
            var x = 0;
            var y = 0;

            self.ctxVisualToolsCanvas.font = fontSize + "px Arial";

            var canvasWidth = self.ctxVisualToolsCanvas.canvas.width;
            var canvasHeight = self.ctxVisualToolsCanvas.canvas.height;
            var textWidth = self.ctxVisualToolsCanvas.measureText(self.ChartSettings.Symbol).width;
            var textHeight = fontSize;

            while (textWidth >= canvasWidth) {
                fontSize -= 5;

                self.ctxVisualToolsCanvas.font = fontSize + "px Arial";

                canvasWidth = self.ctxVisualToolsCanvas.canvas.width;
                canvasHeight = self.ctxVisualToolsCanvas.canvas.height;
                textWidth = self.ctxVisualToolsCanvas.measureText(self.ChartSettings.Symbol).width;
                textHeight = fontSize;
            }

            x = (canvasWidth / 2) - (textWidth / 2);
            y = (canvasHeight / 2) + (textHeight / 2);

            self.ctxVisualToolsCanvas.globalAlpha = 0.2;
            self.ctxVisualToolsCanvas.fillStyle = self.ChartSettings.ForeGround;
            self.ctxVisualToolsCanvas.fillText(self.ChartSettings.Symbol, x, y);
            self.ctxVisualToolsCanvas.globalAlpha = 1;
        }
    };

    self.DrawIndicatorBaseChartWithoutData = function (height, MainChartInstance) {
        self.OHLCCanvas.width = 0;
        self.OHLCCanvas.height = 0;
        self.VolumeCanvas.width = 0;
        self.VolumeCanvas.height = 0;
        self.GridLineCanvas.width = 0;
        self.GridLineCanvas.height = 0;
        self.IndicatorTopCanvas.width = 0;
        self.IndicatorTopCanvas.height = 0;
        self.TradesCanvas.width = 0;
        self.TradesCanvas.height = 0;
        self.OrdersCanvas.width = 0;
        self.OrdersCanvas.height = 0;
        self.VisualToolsCanvas.width = 0;
        self.VisualToolsCanvas.height = 0;
        $(self.ParentELement).find('.VisualToolsCanvas').removeAttr('width');
        $(self.ParentELement).find('.VisualToolsCanvas').removeAttr('height');
        $(self.ParentELement).find('.VisualToolsCanvas').attr('width', '0');
        $(self.ParentELement).find('.VisualToolsCanvas').attr('height', '0');
        $(self.ParentELement).find('.canvas-container canvas').removeAttr('style');
        $(self.ParentELement).find('.canvas-container').removeAttr('style');
        self.IndicatorBotCanvas.width = 0;
        self.IndicatorBotCanvas.height = 0;
        self.DraggingCanvas.width = 0;
        self.DraggingCanvas.height = 0;
        self.BaseChartElement.removeAttr("style");
        self.BaseChartElement.attr('style', 'background-color: white; position:relative;height:' + (height) + 'px');
        self.OHLCCanvas.width = self.ParentELement.width();
        self.OHLCCanvas.height = height;
        self.VolumeCanvas.width = self.ParentELement.width();
        self.VolumeCanvas.height = height;
        self.GridLineCanvas.width = self.ParentELement.width();
        self.GridLineCanvas.height = height;
        self.IndicatorTopCanvas.width = self.ParentELement.width() - 60;
        self.IndicatorTopCanvas.height = height;
        self.TradesCanvas.width = self.ParentELement.width() - 60;
        self.TradesCanvas.height = height;
        self.OrdersCanvas.width = self.ParentELement.width() - 60;
        self.OrdersCanvas.height = height;
        self.VisualToolsCanvas.width = self.ParentELement.width() - 60;
        self.VisualToolsCanvas.height = height;
        $(self.ParentELement).find('.VisualToolsCanvas').attr('width', self.ParentELement.width() - 60);
        $(self.ParentELement).find('.VisualToolsCanvas').attr('height', height - 20);
        $(self.ParentELement).find('.canvas-container canvas').attr('style', 'position: absolute; top:0; left: 0px; z-index: ' + zIndexVisualTools + ';width:' + (self.ParentELement.width() - 60) + 'px; height:' + (height - 20) + 'px;');
        $(self.ParentELement).find('.canvas-container').attr('style', 'position: relative; -webkit-user-select: none; width:' + self.ParentELement.width() + 'px; height:' + height + 'px;');
        self.IndicatorBotCanvas.width = self.ParentELement.width() - 60;
        self.IndicatorBotCanvas.height = height;
        self.BaseChartElement.height = height;
        self.DraggingCanvas.width = self.ParentELement.width();
        self.DraggingCanvas.height = height;
        self.ComputationProperties.height = height;
        //width of the container
        self.ComputationProperties.width = self.ParentELement.width() - 60;
        self.SetTranslateAllContext();
        //Draw Chart withoutData While getting its live data
        DrawIndicatorVerticalLines(self.ctxGridLine, self.ComputationProperties.width, self.ComputationProperties.height, self.ComputationProperties.DefaultBarsWidth, Math.ceil(self.ComputationProperties.width / self.ComputationProperties.DefaultBarsWidth), MainChartInstance);
        DrawChartBorderLines();
        DrawIndicatorChartBorderLines();
    };

    self.DrawIndicatorBaseChart = function (MainChartInstance) {
        //VerticalIndicators();
        //Draw the vertical Lines Indicator
        DrawIndicatorVerticalLines(self.ctxGridLine, self.ComputationProperties.width, self.ComputationProperties.height, self.ComputationProperties.DefaultBarsWidth, self.ComputationProperties.NumbersOfVisibleBars, MainChartInstance);

        DrawChartBorderLines();
        DrawIndicatorChartBorderLines();
    };

    self.DrawBaseChart = function () {
        var SizeWithoutDuplicatePips = 32;
        var PixelOfOriginalYmin = GetYaxis(self.ChartOtherProperties.OriginalYMin);
        var TempDefaultBarsWidth = self.ComputationProperties.DefaultBarsWidth;
        var PartialHeight = parseFloat((self.ComputationProperties.height / GetDecimalPlaces(self.ComputationProperties.difference)).toFixed(2));
        var NewTypeConter = 0;
        if (IsNewGraphType()) {
            TempDefaultBarsWidth = 32;
        }

        if (self.ComputationProperties.yMin !== 0) {
            if (self.ComputationProperties.difference === 0) {
                SizeWithoutDuplicatePips = TempDefaultBarsWidth;
                self.ChartOtherProperties.PipsPerGrid = 0;
            }
            else {
                if (!IsNewGraphType()) {
                    if (PartialHeight <= 0) {
                        PartialHeight = 32;
                    }
                    var Counter = 1;
                    while (true) {
                        var ComputedHeight = PartialHeight * Counter;
                        if (ComputedHeight >= TempDefaultBarsWidth) {
                            SizeWithoutDuplicatePips = ComputedHeight;
                            //Set The pips Per grid
                            SetPipsPerGrid(ComputedHeight, PartialHeight);
                            break;
                        }
                        Counter++;
                    }
                }
                else {
                    while (true) {
                        SizeWithoutDuplicatePips = ComputeHeightOfGridLines(PixelOfOriginalYmin, NewTypeConter);
                        if (SizeWithoutDuplicatePips > 23) {
                            SetPipsPerGrid(SizeWithoutDuplicatePips, PartialHeight);
                            break;
                        }
                        NewTypeConter++;
                    }
                }
            }
            self.ChartOtherProperties.DottedYAxisVisibleBars = (IsNewGraphType() ? PixelOfOriginalYmin : self.ComputationProperties.height) / SizeWithoutDuplicatePips;
            if (!IsNewGraphType()) {
                VerticalIndicators(SizeWithoutDuplicatePips);
            }
            else {
                VerticalIndicatorNewGraphType(NewTypeConter, PixelOfOriginalYmin, SizeWithoutDuplicatePips);
            }
            //Draw the vertical Lines Indicator
            DrawVerticalLines(self.ComputationProperties.width, self.ComputationProperties.height, self.ComputationProperties.DefaultBarsWidth, self.ComputationProperties.NumbersOfVisibleBars);
            //Draw the Horizontal Lines Indicator
            var PartialHeight = self.ComputationProperties.height;
            if (IsNewGraphType()) {
                PartialHeight = PixelOfOriginalYmin;
            }
            if (self.ChartSettings.IsVolumeVisible) {
                DrawHorizontalLines(self.ComputationProperties.width, PartialHeight - (PartialHeight * self.ComputationProperties.PercentageOfVolumeSpace), SizeWithoutDuplicatePips, self.ChartOtherProperties.DottedYAxisVisibleBars);

            }
            else {
                DrawHorizontalLines(self.ComputationProperties.width, PartialHeight, SizeWithoutDuplicatePips, self.ChartOtherProperties.DottedYAxisVisibleBars);
            }
            DrawChartBorderLines();
        }
        HorizontalIndicators(self.ComputationProperties.DefaultBarsWidth);

        DrawRemainingSpaceBottom(SizeWithoutDuplicatePips, SizeWithoutDuplicatePips);

        if (self.ChartSettings.IsShowWaterMark) {
            var fontSize = 120;
            var x = 0;
            var y = 0;

            self.ctxVisualToolsCanvas.font = fontSize + "px Arial";

            var canvasWidth = self.ctxVisualToolsCanvas.canvas.width;
            var canvasHeight = self.ctxVisualToolsCanvas.canvas.height;
            var textWidth = self.ctxVisualToolsCanvas.measureText(self.ChartSettings.Symbol).width;
            var textHeight = fontSize;

            while (textWidth >= canvasWidth) {
                fontSize -= 5;

                self.ctxVisualToolsCanvas.font = fontSize + "px Arial";

                canvasWidth = self.ctxVisualToolsCanvas.canvas.width;
                canvasHeight = self.ctxVisualToolsCanvas.canvas.height;
                textWidth = self.ctxVisualToolsCanvas.measureText(self.ChartSettings.Symbol).width;
                textHeight = fontSize;
            }

            x = (canvasWidth / 2) - (textWidth / 2);
            y = (canvasHeight / 2) + (textHeight / 2);

            self.ctxVisualToolsCanvas.globalAlpha = 0.2;
            self.ctxVisualToolsCanvas.fillStyle = self.ChartSettings.ForeGround;
            self.ctxVisualToolsCanvas.fillText(self.ChartSettings.Symbol, x, y);
            self.ctxVisualToolsCanvas.globalAlpha = 1;
        }
    };

    function VerticalIndicatorNewGraphType(index, HeightUsedToDraw, ValidSize) {
        //loop tgo create the displayed data in chart its located in the right side of the chart
        for (var i = 0 ; i <= self.ChartOtherProperties.DottedYAxisVisibleBars; i++) {
            self.ctxGridLine.beginPath();
            self.ctxGridLine.moveTo(self.ComputationProperties.width, Math.round(HeightUsedToDraw - (ValidSize * i)));
            self.ctxGridLine.lineTo(self.ComputationProperties.width + 7, Math.round(HeightUsedToDraw - (ValidSize * i)));
            self.ctxGridLine.strokeStyle = self.ChartSettings.HighLight;
            self.ctxGridLine.stroke();
            self.ctxGridLine.fillStyle = self.ChartSettings.ForeGround;
            self.ctxGridLine.font = "bold 10px Arial";
            self.ctxGridLine.fillText((self.ChartOtherProperties.OriginalYMin + ((self.ChartSettings.BoxSize / GetMultiplyingDigits(0)) * index * i)).toFixed(self.Digits).toString(), self.ComputationProperties.width + 10, Math.round((HeightUsedToDraw - (ValidSize * i)) + 3));
        }
    }

    function GetMultiplyingDigits(n) {
        var NumberToMultiply = "1";
        for (var ii = 0; ii < self.Digits - n; ii++) {
            NumberToMultiply = NumberToMultiply + "0";
        }

        return parseInt(NumberToMultiply);
    }

    function ComputeHeightOfGridLines(PixelOfOriginalYmin, i) {
        var TempYMin = self.ChartOtherProperties.OriginalYMin + ((self.ChartSettings.BoxSize * i) / GetMultiplyingDigits(0));
        var TempYminPixel = GetYaxis(TempYMin);
        var Difference = PixelOfOriginalYmin - TempYminPixel;
        if (Difference < 0) {
            Difference = Difference * -1;
        }
        return Difference;
    }

    function GetDecimalPlaces(Decimal) {
        var ConvertedValue = Decimal.toFixed(self.Digits);
        ConvertedValue = ConvertedValue * GetMultiplyingDigits(0);
        return ConvertedValue;
    }

    function HorizontalIndicators() {
        if (self.ComputationProperties.DataEndInternal > self.ComputationProperties.DataLength) {
            self.ComputationProperties.DataEndInternal = self.ComputationProperties.DataLength;
        }

        //Variable To determine if last data is already displayed to prevent duplicate Display
        var isLastDataAlreadyDisplayed = false;
        var CurrentDay = 0;
        var CurrentMonth = 0;
        var CurrentYear = 0;
        var NextDate = null;
        var NextIndex;
        var datatoadd = 0;
        var isDateAlreadyDisplayed = false;
        if (self.ChartOtherProperties.dataAdded === 0) {
            datatoadd = 2;
        }

        var LoopLength = Math.floor(self.ComputationProperties.width / self.ComputationProperties.DefaultBarsWidth + datatoadd);
        var IsNotEnough = false;
        if (self.ComputationProperties.DataLength < self.ComputationProperties.NumbersOfVisibleBars) {
            IsNotEnough = true;
        }
        //when starting data of line graph is zero this is use to include a space on the 1st data when user is viewing the first record
        for (var i = 0; i < LoopLength ; i = i + 2) {
            if (i < self.ComputationProperties.DataLength) {
                if (i % 2 !== 0) {
                    continue;
                }
                if (isDateAlreadyDisplayed) {
                    return;
                }

                var IndexOfArray = (i + 1) * (self.ComputationProperties.DefaultBarsWidth / self.ComputationProperties.BarSpace) - 1 + self.ComputationProperties.DataStartInternal;
                IndexOfArray = (IndexOfArray - (self.ComputationProperties.ZoomCollection[self.ChartSettings.ZoomLevel] - 1));
                NextIndex = (i + 3) * (self.ComputationProperties.DefaultBarsWidth / self.ComputationProperties.BarSpace) - 1 + self.ComputationProperties.DataStartInternal;
                NextIndex = (NextIndex - (self.ComputationProperties.ZoomCollection[self.ChartSettings.ZoomLevel] - 1));
                //Set the Index Of array to to the length of the data
                if (IndexOfArray > self.ComputationProperties.DataLength - 1) {
                    return;
                }
                //Validation For Duplicate of Data displayed
                if (isLastDataAlreadyDisplayed) {
                    return;
                }
                if (IndexOfArray === self.ComputationProperties.DataLength - 1) {
                    isLastDataAlreadyDisplayed = true;
                }

                var XpositionNextData;
                var XPositionLine;
                if (IsNotEnough) {
                    XpositionNextData = (self.ComputationProperties.XPositionFirstData - self.ComputationProperties.DefaultBarsWidth * (i + 2)) + 1;
                    XPositionLine = Math.round(self.ComputationProperties.XPositionFirstData - (self.ComputationProperties.DefaultBarsWidth * i));
                }
                else {
                    XpositionNextData = (self.ComputationProperties.width - self.ComputationProperties.DefaultBarsWidth * (i + 2 + self.ChartOtherProperties.dataAdded)) + 1;
                    XPositionLine = Math.round(self.ComputationProperties.width - (self.ComputationProperties.DefaultBarsWidth * (i + self.ChartOtherProperties.dataAdded)));
                }

                self.ctxGridLine.beginPath();
                self.ctxGridLine.strokeStyle = self.ChartSettings.HighLight;
                self.ctxGridLine.moveTo(XPositionLine, self.ComputationProperties.height + 0);
                self.ctxGridLine.lineTo(XPositionLine, self.ComputationProperties.height + 7);
                self.ctxGridLine.stroke();
                self.ctxGridLine.fillStyle = self.ChartSettings.ForeGround;
                self.ctxGridLine.font = "bold 9px Arial";
                var dataToConvert = self.ChartOtherProperties.ChartData[Math.floor(IndexOfArray)].Stamp();
                var Type = (typeof dataToConvert);
                var DateValue = null;
                if (Type === "String" || Type === "string") {
                    DateValue = ISOStringToDate(self.ChartOtherProperties.ChartData[Math.floor(IndexOfArray)].Stamp());
                    if (NextIndex < self.ComputationProperties.DataLength) {
                        NextDate = ISOStringToDate(self.ChartOtherProperties.ChartData[NextIndex].Stamp());
                    }
                }
                else {
                    DateValue = ISOStringToDate(self.ChartOtherProperties.ChartData[Math.floor(IndexOfArray)].Stamp());
                    if (NextIndex < self.ComputationProperties.DataLength) {
                        NextDate = ISOStringToDate(self.ChartOtherProperties.ChartData[NextIndex].Stamp());
                    }
                }

                if (CurrentDay === 0) {
                    CurrentDay = DateValue.getDate();
                }
                if (CurrentMonth === 0) {
                    CurrentMonth = DateValue.getMonth();
                }
                if (CurrentYear === 0) {
                    CurrentYear = DateValue.getFullYear();
                }

                var date;
                var hrs;
                var mins;
                if (NextDate !== null) {
                    if (XpositionNextData <= 0) {
                        date = DateValue.getDate() + " " + Months[DateValue.getMonth()] + " " + DateValue.getFullYear();
                        isDateAlreadyDisplayed = true;
                    }
                    else if (CurrentYear !== NextDate.getFullYear()) {
                        CurrentYear = DateValue.getFullYear();
                        date = DateValue.getDate() + " " + Months[DateValue.getMonth()] + " " + DateValue.getFullYear();
                    }
                    else if (CurrentMonth !== NextDate.getMonth()) {
                        if (DateValue.getMinutes() !== 0) {
                            mins = DateValue.getMinutes().toString();
                        }
                        else {
                            mins = "00";
                        }
                        if (mins.length === 1) {
                            mins = "0" + mins;
                        }

                        if (DateValue.getHours() !== 0) {
                            hrs = DateValue.getHours().toString();
                        }
                        else {
                            hrs = "00";
                        }

                        if (hrs.length === 1) {
                            hrs = "0" + hrs;
                        }

                        CurrentMonth = DateValue.getMonth();
                        if (self.ChartSettings.TimeFrame === 1440) {
                            date = DateValue.getDate() + " " + Months[DateValue.getMonth()];
                        }
                        else if (self.ChartSettings.TimeFrame === 43829) {
                            //date = Months[DateValue.getMonth()];
                            date = DateValue.getDate() + " " + Months[DateValue.getMonth()] + " " + DateValue.getFullYear();
                        }
                        else {
                            date = DateValue.getDate() + " " + Months[DateValue.getMonth()] + " " + hrs + ":" + mins;
                        }
                    }

                    else if (NextDate.getDate() > CurrentDay || NextDate.getDate() < CurrentDay) {
                        if (DateValue.getMinutes() !== 0) {
                            mins = DateValue.getMinutes().toString();
                        }
                        else {
                            mins = "00";
                        }
                        if (mins.length === 1) {
                            mins = "0" + mins;
                        }

                        if (DateValue.getHours() !== 0) {
                            hrs = DateValue.getHours().toString();
                        }
                        else {
                            hrs = "00";
                        }

                        if (hrs.length === 1) {
                            hrs = "0" + hrs;
                        }
                        CurrentDay = NextDate.getDate();
                        if (self.ChartSettings.TimeFrame === 1440) {
                            date = DateValue.getDate() + " " + Months[DateValue.getMonth()];
                        }
                        else {
                            date = DateValue.getDate() + " " + Months[DateValue.getMonth()] + " " + hrs + ":" + mins;
                        }
                    }

                    else {

                        if (DateValue.getMinutes() !== 0) {
                            mins = DateValue.getMinutes().toString();
                        }
                        else {
                            mins = "00";
                        }
                        if (mins.length === 1) {
                            mins = "0" + mins;
                        }

                        if (DateValue.getHours() !== 0) {
                            hrs = DateValue.getHours().toString();
                        }
                        else {
                            hrs = "00";
                        }

                        if (hrs.length === 1) {
                            hrs = "0" + hrs;
                        }
                        date = hrs + ":" + mins;
                    }
                }
                else {
                    if (self.ChartSettings.TimeFrame === 43829) {
                        date = "1 " + Months[DateValue.getMonth()] + " " + DateValue.getFullYear();
                    }
                    else {
                        date = DateValue.getDate() + " " + Months[DateValue.getMonth()] + " " + DateValue.getFullYear();
                    }

                    isDateAlreadyDisplayed = true;
                }
                var XPosition;
                if (IsNotEnough) {
                    XPosition = Math.round((self.ComputationProperties.XPositionFirstData - self.ComputationProperties.DefaultBarsWidth * i) + 1);
                }
                else {
                    XPosition = Math.round((self.ComputationProperties.width - self.ComputationProperties.DefaultBarsWidth * (i + self.ChartOtherProperties.dataAdded)) + 1);
                }
                self.ctxGridLine.fillText(date, XPosition, self.ComputationProperties.height + 14);
                DateValue = null;
                NextDate = null;
            }
        }

    }

    function VerticalIndicators(ValidSize) {
        var HeightUsedToDraw;

        if (self.ChartSettings.IsVolumeVisible) {
            HeightUsedToDraw = self.DrawingHeightWithVolume;
        }
        else if (IsNewGraphType()) {
            HeightUsedToDraw = self.GetYaxis(self.ChartOtherProperties.OriginalYMin);
        }
        else {
            HeightUsedToDraw = self.ComputationProperties.height;
        }
        //loop tgo create the displayed data in chart its located in the right side of the chart
        for (var i = (IsNewGraphType() ? 0 : 1) ; i <= self.ChartOtherProperties.DottedYAxisVisibleBars; i++) {
            self.ctxGridLine.beginPath();
            self.ctxGridLine.moveTo(self.ComputationProperties.width, Math.round(HeightUsedToDraw - (ValidSize * i)));
            self.ctxGridLine.lineTo(self.ComputationProperties.width + 7, Math.round(HeightUsedToDraw - (ValidSize * i)));
            self.ctxGridLine.strokeStyle = self.ChartSettings.HighLight;
            self.ctxGridLine.stroke();
            self.ctxGridLine.fillStyle = self.ChartSettings.ForeGround;
            self.ctxGridLine.font = "bold 10px Arial";
            self.ctxGridLine.fillText((((((ValidSize * i) + (IsNewGraphType() ? self.ComputationProperties.height - HeightUsedToDraw : 0)) / self.ComputationProperties.steps) + self.ComputationProperties.yMin).toFixed(self.Digits)).toString(), self.ComputationProperties.width + 10, Math.round((HeightUsedToDraw - (ValidSize * i)) + 3));
        }
    }

    self.drawIndicatorDashedLine = function (context, fromX, fromY, toX, toY, dashPattern, LineColor, LineWidth) {
        fromX = Math.round(fromX);
        fromY = Math.round(fromY);
        toX = Math.round(toX);
        toY = Math.round(toY);
        //function for drawing a dashed lines
        context.strokeStyle = LineColor;
        context.lineWidth = LineWidth;
        context.beginPath();
        var tY;
        if (fromY !== toY) {
            tY = (toY < 60) ? 80 : toY;
        } else {
            tY = toY;
        }
        context.setLineDash(dashPattern);
        context.moveTo(fromX, fromY);
        context.lineTo(toX, tY);
        context.stroke();
        context = null;
        dashPattern = null;
    };

    self.drawDashedLine = function (IsGridLines, fromX, fromY, toX, toY, dashPattern, LineColor, LineWidth) {
        fromX = Math.round(fromX);
        fromY = Math.round(fromY);
        toX = Math.round(toX);
        toY = Math.round(toY);
        if (IsGridLines === "Trades") {
            //function for drawing a dashed lines
            self.ctxTradesCanvas.strokeStyle = LineColor;
            self.ctxTradesCanvas.lineWidth = LineWidth;
            self.ctxTradesCanvas.beginPath();

            self.ctxTradesCanvas.setLineDash(dashPattern);
            self.ctxTradesCanvas.moveTo(fromX, fromY);
            self.ctxTradesCanvas.lineTo(toX, toY);
            self.ctxTradesCanvas.stroke();
        }
        else if (IsGridLines === "Orders") {

            self.ctxOrdersCanvas.strokeStyle = LineColor;
            self.ctxOrdersCanvas.lineWidth = LineWidth;
            self.ctxOrdersCanvas.beginPath();

            self.ctxOrdersCanvas.setLineDash(dashPattern);
            self.ctxOrdersCanvas.moveTo(fromX, fromY);
            self.ctxOrdersCanvas.lineTo(toX, toY);
            self.ctxOrdersCanvas.stroke();
        }
        else {


            //function for drawing a dashed lines
            self.ctxGridLine.strokeStyle = LineColor;
            self.ctxGridLine.lineWidth = LineWidth;
            self.ctxGridLine.beginPath();

            self.ctxGridLine.setLineDash(dashPattern);
            self.ctxGridLine.moveTo(fromX, fromY);
            self.ctxGridLine.lineTo(toX, toY);
            self.ctxGridLine.stroke();
        }
        dashPattern = null;
    };

    function DrawIndicatorVerticalLines(Container, width, height, BarSpace, VisibleBarsWidth, MainChart) {
        //Vertical Grid Lines

        Container.canvas.style.backgroundColor = MainChart.ChartSettings.BackGroundColor;

        if (MainChart.ComputationProperties.DataLength < MainChart.ComputationProperties.NumbersOfVisibleBars) {
            self.ComputationProperties.XPositionFirstData = self.ComputationProperties.BarSpace * (MainChart.ComputationProperties.DataLength - 1);
            var TempDatalength = MainChart.ComputationProperties.DataLength - 1;

            while (true) {
                if (TempDatalength <= self.ComputationProperties.ZoomCollection[self.ChartSettings.ZoomLevel]) {
                    break;
                }
                TempDatalength = TempDatalength - self.ComputationProperties.ZoomCollection[self.ChartSettings.ZoomLevel];
            }

            self.ComputationProperties.ExcessBarsTotalWidth = (self.ComputationProperties.ZoomCollection[self.ChartSettings.ZoomLevel] - TempDatalength) * self.ComputationProperties.BarSpace;

            for (var i = 1; i < VisibleBarsWidth + 1; i++) {
                var XPositionGridLines = BarSpace * i - self.ComputationProperties.ExcessBarsTotalWidth;
                if (XPositionGridLines >= self.ComputationProperties.width) {
                    return;
                }
                self.drawIndicatorDashedLine(Container, XPositionGridLines, 0, XPositionGridLines, height, [4, 2, 4, 2], MainChart.ChartSettings.Grid, 1);
            }
        }
        else {
            self.ComputationProperties.ExcessBarsTotalWidth = 0;
            for (var i = 1; i < VisibleBarsWidth + 1; i++) {
                self.drawIndicatorDashedLine(Container, self.ComputationProperties.width - BarSpace * i, 0, width - BarSpace * i, height, [4, 2, 4, 2], MainChart.ChartSettings.Grid, 1);
            }
        }

        Container = null;
        MainChart = null;
    }

    function DrawVerticalLines(width, height, BarSpace, VisibleBarsWidth) {
        //Vertical Grid Lines
        if (self.ComputationProperties.DataLength < self.ComputationProperties.NumbersOfVisibleBars && self.ChartValidationsProperties.isDataReady && self.ChartValidationsProperties.isDigitsReady) {
            self.ComputationProperties.XPositionFirstData = self.ComputationProperties.BarSpace * (self.ComputationProperties.DataLength - 1);
            var TempDatalength = self.ComputationProperties.DataLength - 1;
            if (TempDatalength < 0) {
                TempDatalength = 0;
            }
            while (true) {
                if (TempDatalength <= self.ComputationProperties.ZoomCollection[self.ChartSettings.ZoomLevel]) {
                    break;
                }
                TempDatalength = TempDatalength - self.ComputationProperties.ZoomCollection[self.ChartSettings.ZoomLevel];
            }

            self.ComputationProperties.ExcessBarsTotalWidth = (self.ComputationProperties.ZoomCollection[self.ChartSettings.ZoomLevel] - TempDatalength) * self.ComputationProperties.BarSpace;

            for (var i = 1; i < VisibleBarsWidth + 1; i++) {
                var XPositionGridLines = BarSpace * i - self.ComputationProperties.ExcessBarsTotalWidth;
                if (XPositionGridLines >= self.ComputationProperties.width) {
                    return;
                }
                self.drawDashedLine(true, XPositionGridLines, 0, XPositionGridLines, height, [4, 2, 4, 2], self.ChartSettings.Grid, 1);
            }
        }
        else {
            self.ComputationProperties.ExcessBarsTotalWidth = 0;
            for (var i = 1; i < VisibleBarsWidth + 1; i++) {
                self.drawDashedLine(true, self.ComputationProperties.width - BarSpace * i, 0, width - BarSpace * i, height, [4, 2, 4, 2], self.ChartSettings.Grid, 1);
            }
        }
    }

    function DrawHorizontalLines(width, height, MarginSpacing, LineNumber) {
        //Horizontal Grid Lines
        for (var i = (IsNewGraphType() ? 0 : 1) ; i < LineNumber; i++) {
            self.drawDashedLine(true, 0, height - MarginSpacing * i, width, height - MarginSpacing * i, [4, 2, 4, 2], self.ChartSettings.Grid, 1);
        }
    }

    function DrawChartBorderLines() {
        //Draw the chart border line to seperate data being displayed in bottom and right side of the chart

        self.ctxMainCanvas.moveTo(self.ComputationProperties.width, 0);
        self.ctxMainCanvas.lineTo(self.ComputationProperties.width, self.ComputationProperties.height);
        self.ctxMainCanvas.lineTo(0, self.ComputationProperties.height);
        self.ctxMainCanvas.strokeStyle = self.ChartSettings.ForeGround;
        self.ctxMainCanvas.stroke();
        self.ctxMainCanvas.strokeStyle = "black";
    }

    function DrawIndicatorChartBorderLines() {
        self.ctxMainCanvas.strokeStyle = '#9da0aa';
        self.ctxMainCanvas.moveTo(0, 0);
        self.ctxMainCanvas.lineTo(self.ComputationProperties.width + 60, 0);
        self.ctxMainCanvas.stroke();
        self.ctxMainCanvas.moveTo(0, self.ComputationProperties.height);
        self.ctxMainCanvas.lineTo(self.ComputationProperties.width + 60, self.ComputationProperties.height);
        self.ctxMainCanvas.stroke();
        self.ctxMainCanvas.strokeStyle = '#000000';
    }

    function SetProperties() {
        //This is the parent Element the currently selected element to implement the chart plugin
        if ((typeof Container) === "object") {
            self.ParentELement = Container;
        }
        else {
            self.ParentELement = $('#' + Container);
        }
        //bundle property for chart settings
        self.ChartSettings = new WC.CM.ChartSettingsProperty(self.settings);
        //bundle Properties for Chart Validations
        self.ChartValidationsProperties = new WC.CM.ChartValidationsProperties();
        //bundle Properties for Computation
        self.ComputationProperties = new WC.CM.ChartComputationProperties(self.ParentELement.height(), self.ParentELement.width());
        //bundle Other properties of the chart
        self.ChartOtherProperties = new WC.CM.ChartOtherProperties();
        //Main Holder
        self.BaseChartElement = $('<div style="background-color: ' + self.ChartSettings.BackGroundColor + '; position:relative;height:' + 0 + 'px' + '" class="MainChartHolder"></div>');
    }

    function SetAllCanvasNeeded() {
        //Creating Element that is needed to create the chart plugin
        self.GridLineCanvas = document.createElement('canvas');
        self.GridLineCanvas.height = 0;
        self.GridLineCanvas.width = 0;
        self.GridLineCanvas.style.position = "absolute";
        self.GridLineCanvas.style.right = 0;
        self.GridLineCanvas.style.zIndex = 1;
        self.GridLineCanvas.className = "GridLineCanvas";

        //Canvas For Indicator Bottom Drawwing
        self.IndicatorBotCanvas = document.createElement('canvas');
        self.IndicatorBotCanvas.height = 0;
        self.IndicatorBotCanvas.width = 0;
        self.IndicatorBotCanvas.style.position = "absolute";
        self.IndicatorBotCanvas.style.left = 0;
        self.IndicatorBotCanvas.style.zIndex = 2;
        self.IndicatorBotCanvas.className = "IndicatorBotCanvas";


        //Canvas For OHLC Drawwing
        self.OHLCCanvas = document.createElement('canvas');
        self.OHLCCanvas.height = 0;
        self.OHLCCanvas.width = 0;
        self.OHLCCanvas.style.position = "absolute";
        self.OHLCCanvas.style.left = 0;
        self.OHLCCanvas.style.zIndex = 3;
        self.OHLCCanvas.className = "OHLCCanvas";

        //Canvas For Volume Drawwing
        self.VolumeCanvas = document.createElement('canvas');
        self.VolumeCanvas.height = 0;
        self.VolumeCanvas.width = 0;
        self.VolumeCanvas.style.position = "absolute";
        self.VolumeCanvas.style.left = 0;
        self.VolumeCanvas.style.zIndex = 4;
        self.VolumeCanvas.className = "VolumeCanvas";

        //Canvas For Indicator Top Drawwing
        self.IndicatorTopCanvas = document.createElement('canvas');
        self.IndicatorTopCanvas.height = 0;
        self.IndicatorTopCanvas.width = 0;
        self.IndicatorTopCanvas.style.position = "absolute";
        self.IndicatorTopCanvas.style.left = 0;
        self.IndicatorTopCanvas.style.zIndex = 5;
        self.IndicatorTopCanvas.className = "IndicatorTopCanvas";

        //Canvas For Open Trades Canvas
        self.TradesCanvas = document.createElement('canvas');
        self.TradesCanvas.height = 0;
        self.TradesCanvas.width = 0;
        self.TradesCanvas.style.position = "absolute";
        self.TradesCanvas.style.left = 0;
        self.TradesCanvas.style.zIndex = 7;
        self.TradesCanvas.className = "TradesCanvas";

        //Canvas For Indicator Top Drawwing
        self.OrdersCanvas = document.createElement('canvas');
        self.OrdersCanvas.height = 0;
        self.OrdersCanvas.width = 0;
        self.OrdersCanvas.style.position = "absolute";
        self.OrdersCanvas.style.left = 0;
        self.OrdersCanvas.style.zIndex = 7;
        self.OrdersCanvas.className = "OrdersCanvas";

        //Canvas For Dragging Drawwing
        self.DraggingCanvas = document.createElement('canvas');
        self.DraggingCanvas.height = 0;
        self.DraggingCanvas.width = 0;
        self.DraggingCanvas.style.position = "absolute";
        self.DraggingCanvas.style.left = 0;
        self.DraggingCanvas.style.zIndex = 8;
        self.DraggingCanvas.style.top = 0;
        self.DraggingCanvas.className = "DraggingCanvas";

        //Canvas For Visualtools Drawwing
        self.VisualToolsCanvas = document.createElement('canvas');
        self.VisualToolsCanvas.height = 0;
        self.VisualToolsCanvas.width = 0;
        self.VisualToolsCanvas.style.position = "absolute";
        self.VisualToolsCanvas.style.left = 0;
        self.VisualToolsCanvas.style.zIndex = 9;
        self.VisualToolsCanvas.style.top = 0;
        self.VisualToolsCanvas.className = "VisualToolsCanvas";

        self.VisualToolsInput = document.createElement("input");
        self.VisualToolsInput.type = "text";
        self.VisualToolsInput.style.position = "absolute";
        self.VisualToolsInput.style.display = "none";
        self.VisualToolsInput.style.zIndex = 1;

        //Add Required Style In the Parent Element
        self.ParentELement.css("position", "relative");

        //Get the context this is for drawing
        self.ctxGridLine = self.GridLineCanvas.getContext('2d');
        self.ctxIndicatorBotCanvas = self.IndicatorBotCanvas.getContext('2d');
        self.ctxMainCanvas = self.OHLCCanvas.getContext('2d');
        self.ctxVolume = self.VolumeCanvas.getContext('2d');
        self.ctxIndicatorTopCanvas = self.IndicatorTopCanvas.getContext('2d');
        self.ctxTradesCanvas = self.TradesCanvas.getContext('2d');
        self.ctxOrdersCanvas = self.OrdersCanvas.getContext('2d');
        self.ctxVisualToolsCanvas = self.VisualToolsCanvas.getContext('2d');
        self.ctxDragging = self.DraggingCanvas.getContext('2d');
        //Appending the Canvas to the main holder element
        self.BaseChartElement.append(self.GridLineCanvas);
        self.BaseChartElement.append(self.IndicatorBotCanvas);
        self.BaseChartElement.append(self.OHLCCanvas);
        self.BaseChartElement.append(self.VolumeCanvas);
        self.BaseChartElement.append(self.IndicatorTopCanvas);
        self.BaseChartElement.append(self.TradesCanvas);
        self.BaseChartElement.append(self.OrdersCanvas);
        self.BaseChartElement.append(self.VisualToolsCanvas);
        self.BaseChartElement.append(self.DraggingCanvas);
        self.BaseChartElement.append(self.VisualToolsInput);
        self.ParentELement.append(self.BaseChartElement);
    }

    function IsNewGraphType() {
        if (self.ChartSettings.GraphType === "Renko" || self.ChartSettings.GraphType === "PointAndFigure") {
            return true;
        }

        return false;
    }

    function GetYaxis(Price) {
        var YAxis = (self.ComputationProperties.yMax - Price) * self.ComputationProperties.steps;
        return YAxis;
    }

    function DrawRemainingSpaceBottom(GridHeight) {
        if (IsNewGraphType()) {
            var YminYPosition = GetYaxis(self.ChartOtherProperties.OriginalYMin);
            var Difference = self.ComputationProperties.height - YminYPosition;
            if (Difference > GridHeight) {
                var Difference = self.ComputationProperties.height - YminYPosition;
                var VisibleGrid = Math.round(Difference / GridHeight);
                for (var i = 1; i < VisibleGrid + 1; i++) {
                    var YPosition = YminYPosition + (GridHeight * i);
                    if (YPosition > self.ComputationProperties.height) {
                        break;
                    }

                    self.ctxVolume.beginPath();
                    self.ctxVolume.moveTo(self.ComputationProperties.width, YPosition);
                    self.ctxVolume.lineTo(self.ComputationProperties.width + 7, YPosition);
                    self.ctxGridLine.strokeStyle = self.ChartSettings.HighLight;
                    self.ctxVolume.stroke();
                    self.ctxGridLine.fillStyle = self.ChartSettings.ForeGround;
                    self.ctxGridLine.font = "bold 10px Arial";
                    self.ctxGridLine.fillText(getPrice(YPosition), self.ComputationProperties.width + 10, YPosition + 3);

                    self.drawDashedLine(true, 0, YPosition, self.ComputationProperties.width, YPosition, [4, 2, 4, 2], self.ChartSettings.Grid, 1);

                }
            }
        }
    }

    function SetPipsPerGrid(ComputedHeight, PartialHeight) {
        var value = parseFloat(((ComputedHeight / PartialHeight) / GetMultiplyingDigits(0)).toFixed(self.Digits));
        if (value !== 0.00001) {
            self.ChartOtherProperties.PipsPerGrid = value;
        }
    }

    function getPrice(YAxis) {
        return ((((self.ComputationProperties.height - YAxis) / self.ComputationProperties.steps) + self.ComputationProperties.yMin).toFixed(self.Digits)).toString();
    }

};

WC.CM.OHLCChart = function (Container, ChartFormResizingMethod, BarsViewModel, options, ChartFormInstance, Callbacks, QuotesViewModel, TradesViewModel) {
    //WebChartInstance.Instance.push({ ChartInstance: this });
    var OHLCChart = this;
    var Months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    // Subscription Objects
    var BidSubscription = null;
    var BidMovementSubscription = null;
    var QuoteIsOpenSubscription = null;
    var AskSubscription = null;
    var AskMovementSubscription = null;
    var DigitSubscription = null;
    var OpenTradesSub = null;
    var OrdersSub = null;
    var DrawCloseSub = null;
    var DrawArraySub = null;
    var DrawNoDataSub = null;
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    var IsDragRedraw = false;
    var IsUpdateReDraw = false;
    var ZeroIndexVolume = 0;
    var LastXAxis = "";
    var IsTradePanelEditing = false;
    var IsChartNeedToDraw = true;
    var zIndexVisualTools = 9;
    var IsSymbolChanged = false;
    var IsTimeFrameChanged = false;
    var IsGraphTypeChange = false;
    var _isConnected = false;
    var _isMarketOpen = false;
    var OpenTradesData = [];
    var OrdersData = [];
    var _refreshingData = false;
    var PreviousYmax = 0;
    var isReCreateData = false;
    var isReCreateDataStopLimitOrders = false;
    var CurrentSelectedTrades = "";
    var CurrentSelectedStopLimit = "";
    ChartFormResizingMethod();
    var DraggedAdjustPrice = false;
    var _isAlreadyDisposed = false;

    // Call the parent constructor, making sure (using Function#call)
    // that "this" is set correctly during the call
    WC.CM.BaseChart.call(this, Container, options);

    //Elements In Variables 
    var LoadingHolder;
    var BottomIndicator;
    var TradePanel;
    var mastercontainterverticalmarker;
    var BidLineIndicator;
    var BidDataIndicator;
    var PriceData;
    var AskLineIndicator;
    var AskDataIndicator;
    var HorizontalLineIndicator;
    var RightIndicator;
    var BarHoveredEffectElement;
    var LegendHolder;
    var LegendDateLabelHolder;
    var LegendOpenLabelHolder;
    var LegendHighLabelHolder;
    var LegendLowLabelHolder;
    var LegendCloseLabelHolder;
    var LegendVolumeLabelHolder;
    var VolumeSpinner;
    var ArrowStyleToolTip;
    var ArrowStyleToolTipLabel;
    var RightIndicatorLabel;
    var BottomIndicatorLabel;
    var TradePanelSellSpan;
    var TradePanelBuySpan;
    var TradePanelSpinnerHolder;
    var TradePanelSellButton;
    var TradePanelBuyButton;
    var TradePanelArrowButtonBuy;
    var TradePanelArrowButtonSell;
    var AskDataIndicatorLabel;
    var BidDataIndicatorLabel;
    var PriceDataLabel;
    var LeftDataContainer;
    var OpenCloseHolder;
    var DataIndicatorCorrelation;
    var ScrollBarMainHolder = OHLCChart.ParentELement.parent().find('div.ScrollBarMainHolder');
    var ToolZoomChart = OHLCChart.ParentELement.parent().find('div.ToolZoomChart');
    var ChartScrollBarHolder = OHLCChart.ParentELement.parent().find('div.ChartScrollBarHolder');
    var VisualToolsCanvas = $(OHLCChart.VisualToolsCanvas);

    ComputeVariablesNeeded();

    OHLCChart.DrawBaseChartWithOutData();

    OHLCChart.DrawOHLCChart = function (isRecompute) {
        if (OHLCChart.ParentELement.parent().width() === 0) {
            return;
        }
        var IsAlreadyDraw = false;

        if (_isAlreadyDisposed) {
            return;
        }
        if (_refreshingData) return;
        if (!IsDragRedraw || IsUpdateReDraw) {
            if (IsNewGraphType()) {
                var data = BarsViewModel.FindProcessedBar(OHLCChart.ChartSettings.Symbol, OHLCChart.ChartSettings.TimeFrame, OHLCChart.ChartSettings.GraphType, OHLCChart.ChartSettings.BoxSize, OHLCChart.ChartSettings.Reversal);
                if (data !== null) {
                    OHLCChart.ChartOtherProperties.ChartData = data.Data();
                    OHLCChart.ChartValidationsProperties.isDataReady = true;
                }
            } else {
                var BarsLength = BarsViewModel.BarsDataHolder().length;
                for (var i = 0; i < BarsLength; i++) {
                    if (BarsViewModel.BarsDataHolder()[i].Symbol === OHLCChart.ChartSettings.Symbol && BarsViewModel.BarsDataHolder()[i].TimeFrame === OHLCChart.ChartSettings.TimeFrame) {
                        OHLCChart.ChartOtherProperties.ChartData = BarsViewModel.BarsDataHolder()[i].Data();
                        OHLCChart.ChartValidationsProperties.isDataReady = true;
                    }
                }
            }
        }


        if (!IsChartReady()) {
            OHLCChart.DrawBaseChartWithOutData();
            SetPositionTradePanel();
            return;
        }
        if (isRecompute && isRecompute === true) {
            DrawComputeChart();
            SetPositionTradePanel();
            TrigAfterDraw();
        }
        if (!isRecompute) {
            if (!OHLCChart.ChartValidationsProperties.isDataReady) {
                RequestData();
                return;
            }
        }

        if (!OHLCChart.ChartValidationsProperties.isDigitsReady) {
            return;
        }
        if (IsChartNeedToDraw) {
            IsChartNeedToDraw = false;
            DrawComputeChart();
            TrigAfterDraw();
        }

        if (OHLCChart.ComputationProperties.DataLength !== 0) {
            var ChartDataLength = OHLCChart.ChartOtherProperties.ChartData.length;
            if (OHLCChart.ComputationProperties.DataLength === ChartDataLength && ZeroIndexVolume !== 0) {
                if (ZeroIndexVolume !== OHLCChart.ChartOtherProperties.ChartData[0].Volume()) {
                    TrigBarsUpdate();
                    if (OHLCChart.ComputationProperties.DataStartInternal === 0) {
                        if (!IsAlreadyDraw) {
                            DrawComputeChart();
                            TrigAfterDraw();
                        }
                    }
                }
            }
            else if (OHLCChart.ComputationProperties.DataLength + 1 === ChartDataLength) {
                DrawComputeChart();
                TrigFrontDataAdded();
                TrigAfterDraw();
            }
            else if (ChartDataLength > OHLCChart.ComputationProperties.DataLength) {
                DrawComputeChart();
                TrigHistoryDataAdded();
                TrigAfterDraw();
            }
        }
        else {
            DrawComputeChart();
            TrigAfterDraw();
        }

        if (IsDragRedraw) {
            IsAlreadyDraw = true;
            DrawComputeChart();
            TrigAfterDraw();
        }

        if (OHLCChart.ChartOtherProperties.ChartData[0]) {
            ZeroIndexVolume = OHLCChart.ChartOtherProperties.ChartData[0].Volume();
        }
        else {
            ZeroIndexVolume = 1;
        }


        if (OHLCChart.ChartOtherProperties.BidValue !== 0) {
            ShowBidLine(OHLCChart.ChartOtherProperties.BidValue);
        }
        if (OHLCChart.ChartOtherProperties.AskValue !== 0) {
            ShowAskLine(OHLCChart.ChartOtherProperties.AskValue);
        }

        InitChartScrollBar();
        CheckDataIfNeedsToRequest(true);
        SetPercentageOfZoom();
        SetVisibilityOfLoadingIndicator();
    };

    SetScrollBarEvent();

    SetZoomItemMenuValue();

    if (QuotesViewModel.Quotes().length === 0) {
        DigitSubscription = QuotesViewModel.Quotes.subscribe(SetDigits);
    }
    else {
        SetDigits();
    }

    SetAllMarkersLegendAndOtherElementsNeeded();


    SubscribeToBid();

    SubscribeToAsk();

    RequestData();

    InitTradePanelSpinner();

    SetAllChartEvents();

    ScrollBarMainHolder.css({ display: "none" });

    SetPositionTradePanel();

    AppendArrowStyleTradesToolTip();

    EnableDropChart();

    BarsViewModel.RequestLastBarStamp(OHLCChart.ChartSettings.Symbol, OHLCChart.ChartSettings.TimeFrame, SetLastDateOfBars);

    SetCorrelationText();
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Internal Functions~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    function CheckDataIfNeedsToRequest(IsLoadingIndicatorValidation) {
        if (!OHLCChart.ChartValidationsProperties.isRequestingAdditionalData) {
            if (IsLoadingIndicatorValidation) {
                LoadingHolder.css({ display: "none" });
            }
            if (OHLCChart.ChartSettings.CorrelationNumberOfBars !== null) {
                if (OHLCChart.ComputationProperties.DataLength >= OHLCChart.ChartSettings.CorrelationNumberOfBars) {
                    return;
                }
            }
            if (OHLCChart.ComputationProperties.DataEndInternal > (OHLCChart.ComputationProperties.DataLength * 0.60)) {
                LoadingHolder.css({ display: "block" });
                OHLCChart.ChartValidationsProperties.isRequestingAdditionalData = true;
                BarsViewModel.RequestAdditionalDataForDragging(OHLCChart.ChartSettings.Symbol, OHLCChart.ChartSettings.TimeFrame, OHLCChart.ComputationProperties.NumbersOfVisibleBars, OHLCChart.DrawOHLCChart, OHLCChart);
                SetVisibilityOfLoadingIndicator();
            }
        }
        else {
            LoadingHolder.css({ display: "block" });
        }
    }
    //Function To Set arrow style trades tool tip
    function SetArrowStyleToolTipText(IsShow, Text, X, Y, Color) {
        if (IsShow) {
            ArrowStyleToolTip.css({
                "top": Y - 20,
                "left": X - 7 >= 0 ? X - 7 : 0,
                "background": Color
            });
            ArrowStyleToolTip.css({ display: "block" });
            ArrowStyleToolTipLabel.text(Text);
        }
        else {
            ArrowStyleToolTip.css({ display: "none" });
        }
    }
    //Function to append ArrowStyle Trades tool tip
    function AppendArrowStyleTradesToolTip() {
        ArrowStyleToolTip = $('<div class="ArrowStyleToolTip" style="display:none;padding-top: 3px;padding-bottom: 2px;position: absolute;height: 10px;left: 0;z-index: 8;"></div>');
        ArrowStyleToolTipLabel = $('<label style="float:left;padding-right: 3px;font-size:9px;color:white;display: block;margin-left: 3px;"></label>');
        ArrowStyleToolTip.append(ArrowStyleToolTipLabel);
        OHLCChart.BaseChartElement.append(ArrowStyleToolTip);
    }
    //Check for Orders
    function CheckOrdersData() {
        if (OHLCChart.ChartSettings.CorrelationNumberOfBars !== null) {
            return;
        }
        if (OHLCChart.ChartSettings.IsOrdersVisible) {
            if (TradesViewModel.stopLimitOrders().length !== 0) {
                SubscribeToOrdersAndAddDataToLocalVisibleTradesOnChart();
            }
            if (OrdersSub !== null) {
                OrdersSub.dispose();
            }
            OrdersSub = TradesViewModel.stopLimitOrders.subscribe(SubscribeToOrdersAndAddDataToLocalVisibleTradesOnChart);
        }
        else {
            if (OrdersSub !== null) {
                OrdersSub.dispose();
                RemoveAllElementsNeededStopLimitOrders();
            }
        }
    }
    //Function for arrowStyle Stop limit Orders
    function ArrowStyleTrades(X, Y, TradeType) {
        OHLCChart.ctxTradesCanvas.beginPath();
        OHLCChart.ctxTradesCanvas.lineWidth = 4;
        if (TradeType === "Buy") {
            OHLCChart.ctxTradesCanvas.strokeStyle = OHLCChart.ChartSettings.BuysTradesColor;
            OHLCChart.ctxTradesCanvas.moveTo(X - 7, Y + 8);
            OHLCChart.ctxTradesCanvas.lineTo(X, Y);
            OHLCChart.ctxTradesCanvas.lineTo(X + 7, Y + 8);
        }
        else {
            OHLCChart.ctxTradesCanvas.strokeStyle = OHLCChart.ChartSettings.SellsTradesColor;
            OHLCChart.ctxTradesCanvas.moveTo(X - 7, Y);
            OHLCChart.ctxTradesCanvas.lineTo(X, Y + 8);
            OHLCChart.ctxTradesCanvas.lineTo(X + 7, Y);
        }
        OHLCChart.ctxTradesCanvas.stroke();
    }
    //Check Hovered Trades Arrow Style
    function CheckHoveredTradesArrowStyle(X, Y) {
        if (OHLCChart.ChartSettings.CorrelationNumberOfBars !== null) {
            return;
        }
        var OpenTradesLength = OpenTradesData.length;
        for (var i = 0; i < OpenTradesLength; i++) {
            var PricePixelY = OHLCChart.GetYaxis(parseFloat(OpenTradesData[i].OpenQuote()));
            var StampPixelX = OHLCChart.GetXAxis(ISOStringToDate(OpenTradesData[i].OpenTime()));
            if (StampPixelX >= X - 7 && StampPixelX <= X + 7) {
                var TradeTypeToWord = OpenTradesData[i].TradeType();
                var Color;
                if (TradeTypeToWord.includes('Buy')) {
                    Color = OHLCChart.ChartSettings.BuysTradesColor;
                }
                else {
                    Color = OHLCChart.ChartSettings.SellsTradesColor;
                }

                if (PricePixelY >= Y - 8 && PricePixelY <= Y) {
                    var Text = TradeTypeToWord + ' ' + OpenTradesData[i].Volume() + ' at ' + OpenTradesData[i].OpenQuote();
                    SetArrowStyleToolTipText(true, Text, StampPixelX, PricePixelY, Color);
                    return;
                }
            }
        }
        SetArrowStyleToolTipText(false);
    }
    //Subscribe to orders and add data to local visible trades on chart
    function SubscribeToOrdersAndAddDataToLocalVisibleTradesOnChart(NewValue) {
        var stopLimitOrdersLength = TradesViewModel.stopLimitOrders().length;
        if (stopLimitOrdersLength === 0) {
            isReCreateDataStopLimitOrders = true;
        }
        if ((typeof NewValue) === "object") {
            isReCreateDataStopLimitOrders = true;
        }

        if (isReCreateDataStopLimitOrders) {
            RemoveAllElementsNeededStopLimitOrders();
            OrdersData = [];
            for (var i = 0; i < stopLimitOrdersLength; i++) {
                var IsDuplicate = false;
                if (TradesViewModel.stopLimitOrders()[i].Symbol() === OHLCChart.ChartSettings.Symbol) {
                    if (parseFloat(TradesViewModel.stopLimitOrders()[i].Rate()) >= OHLCChart.ComputationProperties.yMin && parseFloat(TradesViewModel.stopLimitOrders()[i].Rate()) <= OHLCChart.ComputationProperties.yMax) {
                        var OrdersDataLength = OrdersData.length;
                        if (OrdersDataLength === 0) {
                            OrdersData.push(TradesViewModel.stopLimitOrders()[i]);
                            SetElementsForOrders(TradesViewModel.stopLimitOrders()[i].OrderId());
                            continue;
                        }

                        //Check for the Same OpenQuote Of the Data
                        for (var ii = 0; ii < OrdersDataLength; ii++) {
                            if (parseFloat(OrdersData[ii].Rate()) === parseFloat(TradesViewModel.stopLimitOrders()[i].Rate())) {
                                IsDuplicate = true;
                                break;
                            }
                        }
                        if (!IsDuplicate) {
                            OrdersData.push(TradesViewModel.stopLimitOrders()[i]);
                            SetElementsForOrders(TradesViewModel.stopLimitOrders()[i].OrderId());
                        }
                    }
                }
            }
        }
        DrawDashedLineStopLimitOrders();
    }
    //Set Elements for Stop Limit Orders
    function SetElementsForOrders(ID) {
        var ElementNeededDiv = $('<div StopLimitOrderID="' + ID + '" class="StopLimitOrders" style="padding-top: 3px;padding-bottom: 2px;position: absolute;height: 10px;left: 0;z-index: 8;"></div>');
        var ElementNeededLabel = $('<label class="StopLimitOrdersDetails" style="float:left;padding-right: 3px;font-size:9px;color:white;display: block;margin-left: 3px;"></label>');
        var BorderOfStopLimitOrders = $('<div class="BorderStopLimitOrders" style="display:none; float: left;width: 3px;background-color: white;height: 15px;margin-top: -3px;"></div>');
        var CloseLabelStopLimitOrders = $('<div class="StopLimitOrdersCloseButton" style="display:none;float: left;height: 15px;margin-top: -3px;"></div>');
        var CloseLabel = $('<label style="padding-right: 3px;font-size:9px;color:white;display: block;margin-left: 3px;float: left;line-height: 16px;">Cancel</label>');
        CloseLabelStopLimitOrders.append(CloseLabel);
        ElementNeededDiv.append(ElementNeededLabel);
        //ElementNeededDiv.append(BorderOfStopLimitOrders);
        //ElementNeededDiv.append(CloseLabelStopLimitOrders);
        OHLCChart.BaseChartElement.append(ElementNeededDiv);
    }
    //Draw The Dashed Line in Stop Limit Orders
    function DrawDashedLineStopLimitOrders() {
        ClearOrdersCanvas();
        var OrdersDataLength = OrdersData.length;
        for (var i = 0; i < OrdersDataLength; i++) {
            var LineColor;
            var TradeTypeWord = OrdersData[i].OrderType();
            if (TradeTypeWord.includes('Sell')) {
                LineColor = OHLCChart.ChartSettings.SellsTradesColor;
            }
            else {
                LineColor = OHLCChart.ChartSettings.BuysTradesColor;

            }
            var YPositionLine = Math.round(OHLCChart.GetYaxis(parseFloat(OrdersData[i].Rate())));
            OHLCChart.drawDashedLine("Orders", 0, YPositionLine, OHLCChart.ComputationProperties.width, YPositionLine, OHLCChart.ChartSettings.SellBuysDashPattern, LineColor, OHLCChart.ChartSettings.SellBuysLineWidth);
            SetPositionStopLimitOrders(OrdersData[i].OrderId(), YPositionLine, LineColor, TradeTypeWord, OrdersData[i].Volume());
        }
        if (TradesViewModel.stopLimitOrders().length !== 0) {
            isReCreateDataStopLimitOrders = false;
        }
    }
    //Set The position of the element of stop limit loss
    function SetPositionStopLimitOrders(ID, YPosition, Color, TradeTypeWord, Vol) {
        //Select The element to be edited
        var ElementToSet = OHLCChart.BaseChartElement.find('[StopLimitOrderID="' + ID + '"]');

        ElementToSet.css({
            "top": YPosition - 8,
            "background": Color
        });

        //Set The label Text
        ElementToSet.find('label.StopLimitOrdersDetails').text(TradeTypeWord + ' ' + Vol + ' Lot').css("color", OHLCChart.ChartSettings.SellsBuysTradesForeColor);;
        ElementToSet = null;
    }
    //Remove all element used by Stop Limit Orders
    function RemoveAllElementsNeededStopLimitOrders() {
        OHLCChart.BaseChartElement.find('.StopLimitOrders').remove();
    }
    //Check Hovered Item in Stop Limit Orders
    function CheckHoveredStopLimitOrders(Y) {
        if (OHLCChart.ChartSettings.CorrelationNumberOfBars !== null) {
            return;
        }
        var IsSomeItemHovered = false;
        var OrdersDataLength = OrdersData.length;
        for (var i = 0; i < OrdersDataLength; i++) {
            var ComputedY = parseInt(OHLCChart.GetYaxis(parseFloat(OrdersData[i].Rate())).toFixed(0));
            var StopLimitOrderID = OrdersData[i].OrderId();
            var TradeTypeWord = OrdersData[i].OrderType();
            if (Y <= ComputedY + 7 && Y >= ComputedY - 7) {
                IsSomeItemHovered = true;
                CurrentSelectedStopLimit = StopLimitOrderID;
                CurrentSelectedTrades = "";
                OHLCChart.BaseChartElement.find('[StopLimitOrderID="' + StopLimitOrderID + '"]').find('.StopLimitOrdersCloseButton').css({ display: "block" });
                OHLCChart.BaseChartElement.find('[StopLimitOrderID="' + StopLimitOrderID + '"]').find('.BorderStopLimitOrders').css({ display: "block" });
                OHLCChart.BaseChartElement.find('[StopLimitOrderID="' + StopLimitOrderID + '"]').find('label.StopLimitOrdersDetails').text("#" + StopLimitOrderID + ': ' + TradeTypeWord + " at " + OrdersData[i].Rate());
            }
            else {
                OHLCChart.BaseChartElement.find('[StopLimitOrderID="' + StopLimitOrderID + '"]').find('.StopLimitOrdersCloseButton').css({ display: "none" });
                OHLCChart.BaseChartElement.find('[StopLimitOrderID="' + StopLimitOrderID + '"]').find('.BorderStopLimitOrders').css({ display: "none" });
                OHLCChart.BaseChartElement.find('[StopLimitOrderID="' + StopLimitOrderID + '"]').find('label.StopLimitOrdersDetails').text(TradeTypeWord + " " + OrdersData[i].Volume() + " Lot");
            }

        }
        if (!IsSomeItemHovered) {
            CurrentSelectedStopLimit = "";
        }
    }
    //Function To check the Trades When hovered
    function CheckHoveredTrades(Y) {
        if (OHLCChart.ChartSettings.CorrelationNumberOfBars !== null) {
            return;
        }
        var IsSomeItemHovered = false;
        var OpenTradesDataLength = OpenTradesData.length;
        for (var i = 0; i < OpenTradesDataLength; i++) {
            var ComputedY = parseInt(OHLCChart.GetYaxis(parseFloat(OpenTradesData[i].OpenQuote())).toFixed(0));
            var TradeID = OpenTradesData[i].TradeId();
            var TradeTypeWord = OpenTradesData[i].TradeType();

            if (Y <= ComputedY + 7 && Y >= ComputedY - 7) {
                IsSomeItemHovered = true;
                CurrentSelectedTrades = TradeID;
                OHLCChart.BaseChartElement.find('[TradeID="' + TradeID + '"]').find('.TradesCloseButton').css({ display: "block" }).find('label').css("color", OHLCChart.ChartSettings.SellsBuysTradesForeColor);
                OHLCChart.BaseChartElement.find('[TradeID="' + TradeID + '"]').find('.BorderTrades').css({ display: "block" });
                OHLCChart.BaseChartElement.find('[TradeID="' + TradeID + '"]').find('label.TradesDetails').text("#" + TradeID + ': ' + TradeTypeWord + " at " + OpenTradesData[i].OpenQuote());
            }
            else {
                OHLCChart.BaseChartElement.find('[TradeID="' + TradeID + '"]').find('.TradesCloseButton').css({ display: "none" });
                OHLCChart.BaseChartElement.find('[TradeID="' + TradeID + '"]').find('.BorderTrades').css({ display: "none" });
                OHLCChart.BaseChartElement.find('[TradeID="' + TradeID + '"]').find('label.TradesDetails').text(TradeTypeWord + " " + OpenTradesData[i].Volume() + " Lot");
            }

        }
        if (!IsSomeItemHovered) {
            CurrentSelectedTrades = "";
        }
    }
    //SetPositionOfTrades
    function SetPositionTradesAndOrders(ID, YPosition, Color, TradeTypeWord, Vol) {
        //Select The element to be edited
        var ElementToSet = OHLCChart.BaseChartElement.find('[TradeID="' + ID + '"]');

        ElementToSet.css({
            "top": YPosition - 8,
            "background": Color
        });
        //Set The label Text
        ElementToSet.find('label.TradesDetails').text(TradeTypeWord + ' ' + Vol + ' Lot').css("color", OHLCChart.ChartSettings.SellsBuysTradesForeColor);
        ElementToSet = null;
    }
    //Remove All Elements In Trades
    function RemoveAllElementsNeeded() {
        OHLCChart.BaseChartElement.find('.TradesOrders').remove();
    }
    //Create Element for Trades
    function SetElementsForTrades(ID) {
        var ElementNeededDiv = $('<div TradeID="' + ID + '" class="TradesOrders" style="padding-top: 3px;padding-bottom: 2px;position: absolute;height: 10px;left: 0;z-index: 7;"></div>');
        var ElementNeededLabel = $('<label class="TradesDetails" style="float:left;padding-right: 3px;font-size:9px;color:white;display: block;margin-left: 3px;"></label>');
        var BorderOfTrades = $('<div class="BorderTrades" style="display:none;float: left;width: 3px;background-color: white;height: 15px;margin-top: -3px;"></div>');
        var CloseLabelTrades = $('<div class="TradesCloseButton" style="display:none;float: left;width: 30px;height: 15px;margin-top: -3px;"></div>');
        var CloseLabel = $('<label style="padding-right: 3px;font-size:9px;color:white;display: block;margin-left: 3px;float: left;line-height: 16px;">Close</label>');
        //CloseLabelTrades.append(CloseLabel);
        ElementNeededDiv.append(ElementNeededLabel);
        //ElementNeededDiv.append(BorderOfTrades);
        //ElementNeededDiv.append(CloseLabelTrades);
        OHLCChart.BaseChartElement.append(ElementNeededDiv);
        ElementNeededDiv = null;
        ElementNeededLabel = null;
        BorderOfTrades = null;
        CloseLabelTrades = null;
        CloseLabel = null;
    }
    //Clear the Drawing of open trades canvas
    function ClearOpenTradesCanvas() {
        OHLCChart.TradesCanvas.width = OHLCChart.ParentELement.width() - 60;
        OHLCChart.TradesCanvas.height = OHLCChart.ParentELement.height() - 20;
    }
    function ClearOrdersCanvas() {
        OHLCChart.OrdersCanvas.width = OHLCChart.ParentELement.width() - 60;
        OHLCChart.OrdersCanvas.height = OHLCChart.ParentELement.height() - 20;
    }
    //Function To Check The Data in Trades
    function CheckTradesData() {
        if (OHLCChart.ChartSettings.CorrelationNumberOfBars !== null) {
            return;
        }
        if (OHLCChart.ChartSettings.IsOpenTradeVisible) {
            var OpenTradesDateLength = TradesViewModel.openTrades().length;
            if (OpenTradesDateLength !== 0) {
                SubscribeToTradesAndAddDataToLocalVisibleTradesOnChart();
            }
            if (OpenTradesSub !== null) {
                OpenTradesSub.dispose();
            }
            OpenTradesSub = TradesViewModel.openTrades.subscribe(SubscribeToTradesAndAddDataToLocalVisibleTradesOnChart);
        }
        else {
            if (OpenTradesSub !== null) {
                OpenTradesSub.dispose();
            }
            RemoveAllElementsNeeded();
        }
    }
    //Subscribe To Trades And  Add Data To Local Visible Trades On Chart
    function SubscribeToTradesAndAddDataToLocalVisibleTradesOnChart(NewValue) {
        var OpenTradesDataLength = TradesViewModel.openTrades().length;
        if (OpenTradesDataLength === 0) {
            isReCreateData = true;
        }
        if ((typeof NewValue) === "object") {
            isReCreateData = true;
        }

        if (isReCreateData) {
            RemoveAllElementsNeeded();
            OpenTradesData = [];
            var TradesDataLength = OpenTradesData.length;
            for (var i = 0; i < OpenTradesDataLength; i++) {
                var IsDuplicate = false;
                if (TradesViewModel.openTrades()[i].Symbol() === OHLCChart.ChartSettings.Symbol) {
                    if (parseFloat(TradesViewModel.openTrades()[i].OpenQuote()) >= OHLCChart.ComputationProperties.yMin && parseFloat(TradesViewModel.openTrades()[i].OpenQuote()) <= OHLCChart.ComputationProperties.yMax) {
                        if (TradesDataLength === 0) {
                            OpenTradesData.push(TradesViewModel.openTrades()[i]);
                            if (OHLCChart.ChartSettings.IsLineStyle) {
                                SetElementsForTrades(TradesViewModel.openTrades()[i].TradeId());
                            }
                            continue;
                        }

                        //Check for the Same OpenQuote Of the Data
                        for (var ii = 0; ii < TradesDataLength; ii++) {
                            if (parseFloat(OpenTradesData[ii].OpenQuote()) === parseFloat(TradesViewModel.openTrades()[i].OpenQuote())) {
                                IsDuplicate = true;
                                break;
                            }
                        }
                        if (!IsDuplicate) {
                            OpenTradesData.push(TradesViewModel.openTrades()[i]);
                            if (OHLCChart.ChartSettings.IsLineStyle) {
                                SetElementsForTrades(TradesViewModel.openTrades()[i].TradeId());
                            }
                        }
                    }
                }
            }
        }
        if (OHLCChart.ChartSettings.IsLineStyle) {
            DrawDashedLineTrades();
        }
        if (OHLCChart.ChartSettings.IsArrowStyle) {
            SetArrowTrades();
        }

    }
    //Function To Draw Call the drawing of arrow
    function SetArrowTrades() {
        ClearOpenTradesCanvas();
        var OpenTradesDataLength = OpenTradesData.length;
        for (var i = 0; i < OpenTradesDataLength; i++) {
            var LineColor;
            var TradeTypeWord = OpenTradesData[i].TradeType();
            if (TradeTypeWord === "Buy") {
                LineColor = OHLCChart.ChartSettings.BuysTradesColor;
            }
            else {
                LineColor = OHLCChart.ChartSettings.SellsTradesColor;
            }
            ArrowStyleTrades(OHLCChart.GetXAxis(ISOStringToDate(OpenTradesData[i].OpenTime())), OHLCChart.GetYaxis(parseFloat(OpenTradesData[i].OpenQuote())), TradeTypeWord);
        }

    }
    //Function TO Draw Dashed Line for Trades
    function DrawDashedLineTrades() {
        ClearOpenTradesCanvas();
        var OpenTradesDataLength = OpenTradesData.length;
        for (var i = 0; i < OpenTradesDataLength; i++) {
            var LineColor;
            var TradeTypeWord = OpenTradesData[i].TradeType();
            if (OpenTradesData[i].TradeType() === "Buy") {
                LineColor = OHLCChart.ChartSettings.BuysTradesColor;
            }
            else {
                LineColor = OHLCChart.ChartSettings.SellsTradesColor;
            }
            var YPositionLine = Math.round(OHLCChart.GetYaxis(parseFloat(OpenTradesData[i].OpenQuote())));
            OHLCChart.drawDashedLine("Trades", 0, YPositionLine, OHLCChart.ComputationProperties.width, YPositionLine, OHLCChart.ChartSettings.SellBuysDashPattern, LineColor, OHLCChart.ChartSettings.SellBuysLineWidth);
            SetPositionTradesAndOrders(OpenTradesData[i].TradeId(), YPositionLine, LineColor, TradeTypeWord, OpenTradesData[i].Volume());
        }
        if (TradesViewModel.openTrades().length !== 0) {
            isReCreateData = false;
        }
    }
    //Function for setting the Tool Tip of ScrollBar Zoom in Menu
    function SetPercentageOfZoom() {
        var Computation;
        if ((OHLCChart.ChartSettings.ZoomLevel + 1) === 1) {
            Computation = 100;
        }
        if ((OHLCChart.ChartSettings.ZoomLevel + 1) === 2) {
            Computation = 80;
        }
        if ((OHLCChart.ChartSettings.ZoomLevel + 1) === 3) {
            Computation = 60;
        }
        if ((OHLCChart.ChartSettings.ZoomLevel + 1) === 4) {
            Computation = 40;
        }
        if ((OHLCChart.ChartSettings.ZoomLevel + 1) === 5) {
            Computation = 20;
        }

        ToolZoomChart.attr("Title", OHLCChart.ChartSettings.ZoomChartTitle + " " + Computation.toString() + "%");
    }
    //Function to Draw and compute
    function DrawComputeChart() {
        if (OHLCChart.ChartOtherProperties.ChartData.length === 1) {
            OHLCChart.DrawBaseChartWithOutData();
            SetPositionTradePanel();
            IsDragRedraw = false;
            IsUpdateReDraw = false;
            OHLCChart.ChartValidationsProperties.isDataReady = false;
            return;
        }
        ComputeVariablesNeeded();
        //Height Of the Container
        if (OHLCChart.ComputationProperties.DataLength < OHLCChart.ComputationProperties.NumbersOfVisibleBars) {
            if (ScrollBarMainHolder.css('display') === 'inline-block') {
                ScrollBarMainHolder.css('display', 'none');
                IsDragRedraw = false;
                ComputeVariablesNeeded();
            }
        }
        else {
            if (ScrollBarMainHolder.css('display') === 'none') {
                ScrollBarMainHolder.css('display', 'inline-block');
                IsDragRedraw = false;
                ComputeVariablesNeeded();
            }
        }

        OHLCChart.DrawBaseChart();
        FunctionToDrawChartType();
        SetPriceData();
        CheckTradesData();
        CheckOrdersData();

        if (IsSymbolChanged) {
            TrigSymbolChanged();
            SubscribeToBid();
            SubscribeToAsk();
            IsSymbolChanged = false;
        }
        if (IsTimeFrameChanged) {
            TrigTimeFrameChanged();
            IsTimeFrameChanged = false;
        }

        if (IsGraphTypeChange) {
            TrigGraphTypeChanged();
            IsGraphTypeChange = false;
        }
        IsDragRedraw = false;
        IsUpdateReDraw = false;


    }
    //Function to draw chart Type
    function FunctionToDrawChartType() {
        if (OHLCChart.ChartSettings.GraphType === "CandleStick") {
            WC.CM.CandleStick(OHLCChart, SetPeriodSeparator);
        }
        else if (OHLCChart.ChartSettings.GraphType === "LineChart") {
            WC.CM.LineChart(OHLCChart, SetPeriodSeparator);
        }
        else if (OHLCChart.ChartSettings.GraphType === "BarChart") {
            WC.CM.BarChart(OHLCChart, SetPeriodSeparator);
        }
        else if (OHLCChart.ChartSettings.GraphType === "Renko") {
            WC.CM.Renko(OHLCChart, SetPeriodSeparator);
        }
        else if (OHLCChart.ChartSettings.GraphType === "LineBreak") {
            WC.CM.LineBreak(OHLCChart, SetPeriodSeparator);
        }
        else if (OHLCChart.ChartSettings.GraphType === "PointAndFigure") {
            WC.CM.PointAndFigure(OHLCChart, SetPeriodSeparator);
        }
        else if (OHLCChart.ChartSettings.GraphType === "Kagi") {
            WC.CM.Kagi(OHLCChart, SetPeriodSeparator);
        }
    }
    //Function For displaying data in the legend
    function DisplayDataInLegend() {
        var DateValue = ISOStringToDate(OHLCChart.ChartOtherProperties.ChartData[OHLCChart.ComputationProperties.dataNumber].Stamp());
        var hrs;
        var mins;
        if (DateValue.getMinutes() !== 0) {
            mins = DateValue.getMinutes();
        }
        else {
            mins = "00";
        }

        if (DateValue.getHours() !== 0) {
            hrs = DateValue.getHours();
        }
        else {
            hrs = "00";
        }

        var date = DateValue.getDate() + "-" + Months[DateValue.getMonth()] + "-" + DateValue.getFullYear().toString().substring(2, 4) + " " + hrs + ":" + mins;
        LegendDateLabelHolder.text(date);
        LegendOpenLabelHolder.text(OHLCChart.ChartOtherProperties.ChartData[OHLCChart.ComputationProperties.dataNumber].Open().toFixed(OHLCChart.Digits));
        LegendHighLabelHolder.text(OHLCChart.ChartOtherProperties.ChartData[OHLCChart.ComputationProperties.dataNumber].High().toFixed(OHLCChart.Digits));
        LegendLowLabelHolder.text(OHLCChart.ChartOtherProperties.ChartData[OHLCChart.ComputationProperties.dataNumber].Low().toFixed(OHLCChart.Digits));
        LegendCloseLabelHolder.text(OHLCChart.ChartOtherProperties.ChartData[OHLCChart.ComputationProperties.dataNumber].Close().toFixed(OHLCChart.Digits));
        LegendVolumeLabelHolder.text(OHLCChart.ChartOtherProperties.ChartData[OHLCChart.ComputationProperties.dataNumber].Volume());
        DateValue = null;
        date = null;
    }
    //Draw the circular indicator in the hovered data in line chart
    function DrawCircleIndicatorOfLineChartWhenHovered() {
        var TempWidth = OHLCChart.ComputationProperties.width;
        if (OHLCChart.ComputationProperties.DataLength < OHLCChart.ComputationProperties.NumbersOfVisibleBars && OHLCChart.ChartValidationsProperties.isDataReady) {
            TempWidth = OHLCChart.ComputationProperties.XPositionFirstData;
        }
        OHLCChart.ComputationProperties.MarginOfBar = OHLCChart.ChartOtherProperties.dataAdded;
        if (OHLCChart.ChartOtherProperties.dataAdded !== 0) {
            OHLCChart.ComputationProperties.MarginOfBar = OHLCChart.ChartOtherProperties.dataAdded + (OHLCChart.ComputationProperties.ZoomCollection[OHLCChart.ChartSettings.ZoomLevel] - 1);
        }
        ClearDrawingHoveredEffectLineGraph();
        OHLCChart.ctxDragging.beginPath();
        OHLCChart.ctxDragging.arc(TempWidth - OHLCChart.ComputationProperties.BarSpace * (OHLCChart.ComputationProperties.dataNumber + OHLCChart.ComputationProperties.MarginOfBar - OHLCChart.ComputationProperties.DataStartInternal), OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[OHLCChart.ComputationProperties.dataNumber].Close()), 4, 0, 2 * Math.PI);
        OHLCChart.ctxDragging.fillStyle = "green";
        OHLCChart.ctxDragging.strokeStyle = "green";
        OHLCChart.ctxDragging.fill();
        OHLCChart.ctxDragging.stroke();
    }
    //Clear the circular Indicator in the hovered data in line chart
    function ClearDrawingHoveredEffectLineGraph() {
        OHLCChart.DraggingCanvas.width = OHLCChart.ParentELement.width();
        OHLCChart.DraggingCanvas.height = OHLCChart.ParentELement.height();
    }
    //logic on displaying legend and validation for overlapping legend display
    function ValidationForLegendToPreventOverlapping(LegendsWidth, LegendsHeight, X, Y) {
        var ComputedHoveredXAxis = (X + 10 + LegendsWidth);
        var LocationOfTheBottomOfLegend = Y + 10 + LegendsHeight;
        //condition to prevent legend to overlap outside the chart control
        if (ComputedHoveredXAxis > OHLCChart.ComputationProperties.width && (LocationOfTheBottomOfLegend < OHLCChart.ComputationProperties.height)) {
            LegendHolder.css({
                left: (X - (LegendsWidth + 5)),
                top: (Y + 5),
                display: "block"
            });

        }
        else if (ComputedHoveredXAxis > OHLCChart.ComputationProperties.width && (LocationOfTheBottomOfLegend > OHLCChart.ComputationProperties.height)) {
            LegendHolder.css({
                left: (X - (LegendsWidth + 5)),
                top: (Y - (LegendsHeight + 5)),
                display: "block"
            });
        }
        else if (ComputedHoveredXAxis < OHLCChart.ComputationProperties.width && (LocationOfTheBottomOfLegend > OHLCChart.ComputationProperties.height)) {
            LegendHolder.css({
                left: (X + 10),
                top: (Y - (LegendsHeight + 5)),
                display: "block"
            });
        }
        else {
            LegendHolder.css({
                left: (X + 10),
                top: (Y + 5),
                display: "block"
            });
        }
        LegendHolder.find('div').css({
            "background-color": OHLCChart.ChartSettings.Legend
        });
    }
    //Validation for chart hovered effect it also displays the element
    function ValidationForChartHoveredEffect(HeightOfBarHoveredEffect, WidthOfBarHoveredEffect, LeftPositionBarHoveredEffect, TopPositionOfBarHoveredEffect) {

        //BarHoveredEffect Should be half of its width
        if (OHLCChart.ChartOtherProperties.dataAdded === 0 && OHLCChart.ComputationProperties.dataNumber === OHLCChart.ComputationProperties.DataStartInternal && (OHLCChart.ComputationProperties.DataLength > OHLCChart.ComputationProperties.NumbersOfVisibleBars && OHLCChart.ChartValidationsProperties.isDataReady)) {
            BarHoveredEffectElement.css({
                height: HeightOfBarHoveredEffect,
                width: (WidthOfBarHoveredEffect / 2),
                left: LeftPositionBarHoveredEffect,
                top: TopPositionOfBarHoveredEffect,
                "border-bottom": OHLCChart.ChartSettings.HighLight + " solid 2px",
                "border-right": "0",
                "border-top": OHLCChart.ChartSettings.HighLight + " solid 2px",
                "border-left": OHLCChart.ChartSettings.HighLight + " solid 2px",
                display: "block"
            });
        }
        else if (LeftPositionBarHoveredEffect < 0) {
            BarHoveredEffectElement.css({
                height: HeightOfBarHoveredEffect,
                width: (WidthOfBarHoveredEffect + LeftPositionBarHoveredEffect + 3),
                left: 0,
                top: TopPositionOfBarHoveredEffect,
                "border-bottom": OHLCChart.ChartSettings.HighLight + " solid 2px",
                "border-right": OHLCChart.ChartSettings.HighLight + " solid 2px",
                "border-top": OHLCChart.ChartSettings.HighLight + " solid 2px",
                "border-left": "0",
                display: "block"
            });
        }
        else {
            BarHoveredEffectElement.css({
                height: HeightOfBarHoveredEffect,
                width: WidthOfBarHoveredEffect,
                left: LeftPositionBarHoveredEffect,
                top: TopPositionOfBarHoveredEffect,
                "border-bottom": OHLCChart.ChartSettings.HighLight + " solid 2px",
                "border-right": OHLCChart.ChartSettings.HighLight + " solid 2px",
                "border-top": OHLCChart.ChartSettings.HighLight + " solid 2px",
                "border-left": OHLCChart.ChartSettings.HighLight + " solid 2px",
                display: "block"
            });
        }
    }
    //compute the variables needed
    function ComputeVariablesNeeded() {
        if (!IsDragRedraw) {
            ChartFormResizingMethod();

            OHLCChart.BaseChartElement.attr('style', 'background-color: white; position:relative;').outerHeight(OHLCChart.ParentELement.height());
            OHLCChart.BaseChartElement.height = ParentElementHeight;
        }
        var ParentElementWidth = OHLCChart.ParentELement.width();
        var ParentElementHeight = OHLCChart.ParentELement.height();
        OHLCChart.OHLCCanvas.width = ParentElementWidth - 59;
        OHLCChart.OHLCCanvas.height = ParentElementHeight;
        OHLCChart.VolumeCanvas.width = ParentElementWidth;
        OHLCChart.VolumeCanvas.height = ParentElementHeight;
        OHLCChart.GridLineCanvas.width = ParentElementWidth;
        OHLCChart.GridLineCanvas.height = ParentElementHeight;
        OHLCChart.IndicatorBotCanvas.width = ParentElementWidth - 60;
        OHLCChart.IndicatorBotCanvas.height = ParentElementHeight - 20;
        OHLCChart.IndicatorTopCanvas.width = ParentElementWidth - 60;
        OHLCChart.IndicatorTopCanvas.height = ParentElementHeight - 20;
        OHLCChart.TradesCanvas.width = ParentElementWidth - 60;
        OHLCChart.TradesCanvas.height = ParentElementHeight - 20;
        OHLCChart.OrdersCanvas.width = ParentElementWidth - 60;
        OHLCChart.OrdersCanvas.height = ParentElementHeight - 20;

        OHLCChart.VisualToolsCanvas.width = ParentElementWidth - 60;
        OHLCChart.VisualToolsCanvas.height = ParentElementHeight - 20;
        OHLCChart.DraggingCanvas.width = ParentElementWidth;
        OHLCChart.DraggingCanvas.height = ParentElementHeight;
        VisualToolsCanvas.attr('width', ParentElementWidth - 60);
        VisualToolsCanvas.attr('height', ParentElementHeight - 20);
        $(OHLCChart.ParentELement).find('.canvas-container canvas').attr('style', 'position: absolute; top:0; left: 0px; z-index: ' + zIndexVisualTools + ';width:' + (ParentElementWidth - 60) + 'px; height:' + (ParentElementHeight - 20) + 'px;');
        $(OHLCChart.ParentELement).find('.canvas-container').attr('style', 'position: relative; -webkit-user-select: none; width:' + ParentElementWidth + 'px; height:' + ParentElementHeight + 'px;');
        OHLCChart.ComputationProperties.height = ParentElementHeight - 20;
        //width of the container
        OHLCChart.ComputationProperties.width = OHLCChart.ParentELement.width() - 60;
        //Computed Volume Drawing space Height
        OHLCChart.VolumeDrawingSpaceHeight = OHLCChart.ComputationProperties.height * OHLCChart.ComputationProperties.PercentageOfVolumeSpace;
        //Actual height WHEN volume is visible
        OHLCChart.DrawingHeightWithVolume = OHLCChart.ComputationProperties.height - OHLCChart.VolumeDrawingSpaceHeight;
        //This is the fefault BarsWidth
        if (IsNewGraphType()) {
            OHLCChart.ComputationProperties.DefaultBarsWidth = 48;
        } else {
            OHLCChart.ComputationProperties.DefaultBarsWidth = 32;
        }
        //Computed BarsWidth Depending on the Zoom Level
        OHLCChart.ComputationProperties.BarSpace = OHLCChart.ComputationProperties.DefaultBarsWidth / OHLCChart.ComputationProperties.ZoomCollection[OHLCChart.ChartSettings.ZoomLevel];
        OHLCChart.ChartOtherProperties.DragSensetivity = (OHLCChart.ComputationProperties.BarSpace - OHLCChart.ComputationProperties.barsMargin) / 2;
        OHLCChart.ChartOtherProperties.DottedXaxisVisibleBars = OHLCChart.ComputationProperties.width / OHLCChart.ComputationProperties.DefaultBarsWidth;
        OHLCChart.ChartOtherProperties.DottedYAxisVisibleBars = OHLCChart.ComputationProperties.height / OHLCChart.ComputationProperties.DefaultBarsWidth;




        if (OHLCChart.ChartValidationsProperties.isDataReady) {
            OHLCChart.ComputationProperties.DataLength = OHLCChart.ChartOtherProperties.ChartData.length;
            if (OHLCChart.ChartSettings.CorrelationNumberOfBars !== null) {
                if (OHLCChart.ComputationProperties.DataLength > OHLCChart.ChartSettings.CorrelationNumberOfBars) {
                    OHLCChart.ComputationProperties.DataLength = OHLCChart.ChartSettings.CorrelationNumberOfBars;
                }
            }
        }
        if (OHLCChart.ComputationProperties.DataStartInternal !== 0) {
            OHLCChart.ChartOtherProperties.dataAdded = 0;
        }
        else {
            OHLCChart.ChartOtherProperties.dataAdded = 1;
        }
        if (OHLCChart.ChartSettings.GraphType === "LineChart") {
            OHLCChart.ComputationProperties.NumbersOfVisibleBars = Math.ceil((OHLCChart.ComputationProperties.width - (OHLCChart.ComputationProperties.DefaultBarsWidth * OHLCChart.ChartOtherProperties.dataAdded)) / OHLCChart.ComputationProperties.BarSpace);
            OHLCChart.ComputationProperties.DataEndInternal = Math.ceil(OHLCChart.ComputationProperties.NumbersOfVisibleBars) + OHLCChart.ComputationProperties.DataStartInternal + 1;
        }
        else {
            OHLCChart.ComputationProperties.NumbersOfVisibleBars = Math.ceil(((OHLCChart.ComputationProperties.width - (OHLCChart.ComputationProperties.DefaultBarsWidth * OHLCChart.ChartOtherProperties.dataAdded)) / OHLCChart.ComputationProperties.BarSpace) + 1);
            OHLCChart.ComputationProperties.DataEndInternal = Math.round(OHLCChart.ComputationProperties.NumbersOfVisibleBars) + OHLCChart.ComputationProperties.DataStartInternal;
        }
        if (OHLCChart.ComputationProperties.DataStartInternal !== 0) {
            OHLCChart.ComputationProperties.DataEndInternal = OHLCChart.ComputationProperties.DataEndInternal + 1;
        }

        if (OHLCChart.ComputationProperties.DataLength > OHLCChart.ComputationProperties.NumbersOfVisibleBars) {
            if (OHLCChart.ComputationProperties.DataStartInternal > OHLCChart.ComputationProperties.DataLength - OHLCChart.ComputationProperties.NumbersOfVisibleBars) {
                OHLCChart.ComputationProperties.DataStartInternal = OHLCChart.ComputationProperties.DataLength - OHLCChart.ComputationProperties.NumbersOfVisibleBars;
            }
        }

        if (OHLCChart.ChartValidationsProperties.isDataReady) {
            if (OHLCChart.ComputationProperties.DataLength < OHLCChart.ComputationProperties.NumbersOfVisibleBars && OHLCChart.ChartValidationsProperties.isDataReady) {
                OHLCChart.ComputationProperties.DataStartInternal = 0;
                OHLCChart.ChartOtherProperties.dataAdded = 1;
            }
            SetYminYmax();
            OHLCChart.ComputationProperties.difference = OHLCChart.ComputationProperties.yMax - OHLCChart.ComputationProperties.yMin;
            OHLCChart.ComputationProperties.steps = OHLCChart.DrawingHeightWithVolume / OHLCChart.ComputationProperties.difference;
            OHLCChart.ComputationProperties.LineNumber = OHLCChart.DrawingHeightWithVolume / OHLCChart.ComputationProperties.DefaultBarsWidth;
            //Compute Difference and steps of the volume
            OHLCChart.differenceVolume = OHLCChart.ComputationProperties.VolumeYmax - OHLCChart.ComputationProperties.VolumeYmin;
            OHLCChart.stepsVolume = (OHLCChart.ComputationProperties.height - OHLCChart.DrawingHeightWithVolume) / OHLCChart.differenceVolume;
            MarginTopAndBottomChart();
            if (OHLCChart.ChartSettings.GraphType === "CandleStick") {
                if (OHLCChart.ComputationProperties.ZoomCollection[OHLCChart.ChartSettings.ZoomLevel] === 1) {
                    OHLCChart.ComputationProperties.barsMargin = Math.round(OHLCChart.ComputationProperties.BarSpace * 0.20);
                }
                else if (OHLCChart.ComputationProperties.ZoomCollection[OHLCChart.ChartSettings.ZoomLevel] === 2) {
                    OHLCChart.ComputationProperties.barsMargin = Math.round(OHLCChart.ComputationProperties.BarSpace * 0.30);
                }
                else if (OHLCChart.ComputationProperties.ZoomCollection[OHLCChart.ChartSettings.ZoomLevel] === 4) {
                    OHLCChart.ComputationProperties.barsMargin = Math.round(OHLCChart.ComputationProperties.BarSpace * 0.40);
                }
                else if (OHLCChart.ComputationProperties.ZoomCollection[OHLCChart.ChartSettings.ZoomLevel] === 7) {
                    OHLCChart.ComputationProperties.barsMargin = Math.round(OHLCChart.ComputationProperties.BarSpace * 0.55);
                }
                else {
                    OHLCChart.ComputationProperties.barsMargin = 1;
                }
            }
            else {
                OHLCChart.ComputationProperties.barsMargin = OHLCChart.ComputationProperties.BarSpace * 0.20;
            }
            OHLCChart.ComputationProperties.BarsWidth = OHLCChart.ComputationProperties.BarSpace - OHLCChart.ComputationProperties.barsMargin;
        }

        if (IsNewGraphType()) {
            OHLCChart.ComputationProperties.barsMargin = 0;
        }

        OHLCChart.SetTranslateAllContext();
        ParentElementWidth = null;
        ParentElementHeight = null;



    }
    //Set YminYmax
    function SetYminYmax() {
        //Getting the Ymin and Ymax of the chart
        if (OHLCChart.ComputationProperties.DataEndInternal > OHLCChart.ComputationProperties.DataLength) {
            OHLCChart.ComputationProperties.DataEndInternal = OHLCChart.ComputationProperties.DataLength;
        }
        for (var i = OHLCChart.ComputationProperties.DataStartInternal; i < OHLCChart.ComputationProperties.DataEndInternal; i++) {
            if (i === OHLCChart.ComputationProperties.DataStartInternal) {
                OHLCChart.ComputationProperties.yMax = OHLCChart.ChartOtherProperties.ChartData[i].Close();
                OHLCChart.ComputationProperties.yMin = OHLCChart.ChartOtherProperties.ChartData[i].Close();
                OHLCChart.ComputationProperties.VolumeYmax = OHLCChart.ChartOtherProperties.ChartData[i].Volume();
            }
            if (OHLCChart.ChartSettings.GraphType === "LineChart") {

                if (OHLCChart.ChartOtherProperties.ChartData[i].Close() > OHLCChart.ComputationProperties.yMax) {
                    OHLCChart.ComputationProperties.yMax = OHLCChart.ChartOtherProperties.ChartData[i].Close();
                }
                if (OHLCChart.ChartOtherProperties.ChartData[i].Close() < OHLCChart.ComputationProperties.yMin) {
                    OHLCChart.ComputationProperties.yMin = OHLCChart.ChartOtherProperties.ChartData[i].Close();
                }
            }
            else {
                if (OHLCChart.ChartOtherProperties.ChartData[i].High() > OHLCChart.ComputationProperties.yMax) {
                    OHLCChart.ComputationProperties.yMax = OHLCChart.ChartOtherProperties.ChartData[i].High();
                }
                if (OHLCChart.ChartOtherProperties.ChartData[i].Low() < OHLCChart.ComputationProperties.yMin) {
                    OHLCChart.ComputationProperties.yMin = OHLCChart.ChartOtherProperties.ChartData[i].Low();
                }
            }
            if (OHLCChart.ChartOtherProperties.ChartData[i].Volume() > OHLCChart.ComputationProperties.VolumeYmax) {
                OHLCChart.ComputationProperties.VolumeYmax = OHLCChart.ChartOtherProperties.ChartData[i].Volume();
            }
        }
        if (OHLCChart.ComputationProperties.yMin > OHLCChart.ComputationProperties.yMax) {
            var Temp = OHLCChart.ComputationProperties.yMax;
            OHLCChart.ComputationProperties.yMax = OHLCChart.ComputationProperties.yMin;
            OHLCChart.ComputationProperties.yMin = Temp;
        }

        if (OHLCChart.ChartSettings.IsAlwaysShowBidAsk) {
            if (OHLCChart.ChartOtherProperties.BidValue !== 0) {
                if (OHLCChart.ChartOtherProperties.BidValue > OHLCChart.ComputationProperties.yMax) {
                    OHLCChart.ComputationProperties.yMax = OHLCChart.ChartOtherProperties.BidValue;
                }
                if (OHLCChart.ChartOtherProperties.BidValue < OHLCChart.ComputationProperties.yMin) {
                    OHLCChart.ComputationProperties.yMin = OHLCChart.ChartOtherProperties.BidValue;
                }
            }
            if (OHLCChart.ChartOtherProperties.AskValue !== 0) {
                if (OHLCChart.ChartOtherProperties.AskValue > OHLCChart.ComputationProperties.yMax) {
                    OHLCChart.ComputationProperties.yMax = OHLCChart.ChartOtherProperties.AskValue;
                }
                if (OHLCChart.ChartOtherProperties.AskValue < OHLCChart.ComputationProperties.yMin) {
                    OHLCChart.ComputationProperties.yMin = OHLCChart.ChartOtherProperties.AskValue;
                }
            }
        }

        OHLCChart.ChartOtherProperties.OriginalYMax = OHLCChart.ComputationProperties.yMax;
        OHLCChart.ChartOtherProperties.OriginalYMin = OHLCChart.ComputationProperties.yMin;

        OHLCChart.ComputationProperties.yMax = OHLCChart.ComputationProperties.yMax + OHLCChart.ChartOtherProperties.TotalAddYminYmax;
        OHLCChart.ComputationProperties.yMin = OHLCChart.ComputationProperties.yMin - OHLCChart.ChartOtherProperties.TotalAddYminYmax;
    }
    //Add Margin to the graph Bottom and top
    function MarginTopAndBottomChart() {
        //Add Margin To the graph
        OHLCChart.ComputationProperties.yMax = OHLCChart.ComputationProperties.yMax + (10 / OHLCChart.ComputationProperties.steps);
        OHLCChart.ComputationProperties.yMin = OHLCChart.ComputationProperties.yMin - (10 / OHLCChart.ComputationProperties.steps);
        OHLCChart.ComputationProperties.difference = OHLCChart.ComputationProperties.yMax - OHLCChart.ComputationProperties.yMin;
        if (OHLCChart.ChartSettings.IsVolumeVisible) {
            OHLCChart.ComputationProperties.steps = OHLCChart.DrawingHeightWithVolume / OHLCChart.ComputationProperties.difference;
            OHLCChart.ComputationProperties.LineNumber = OHLCChart.DrawingHeightWithVolume / OHLCChart.ComputationProperties.DefaultBarsWidth;
        }
        else {
            OHLCChart.ComputationProperties.steps = OHLCChart.ComputationProperties.height / OHLCChart.ComputationProperties.difference;
            OHLCChart.ComputationProperties.LineNumber = OHLCChart.ComputationProperties.height / OHLCChart.ComputationProperties.DefaultBarsWidth;
        }

        //This Condition is to check if the Ymax is Changed 
        if (PreviousYmax === 0) {
            isReCreateData = true;
            isReCreateDataStopLimitOrders = true;
        }

        if (PreviousYmax !== 0 && PreviousYmax !== OHLCChart.ComputationProperties.yMax) {
            isReCreateData = true;
            isReCreateDataStopLimitOrders = true;
        }

        PreviousYmax = OHLCChart.ComputationProperties.yMax;
    }
    //Recompute Marker
    function ReComputeComputedHightWidthOfMarker() {

        var HeightToCondition;

        if (OHLCChart.ChartSettings.IsVolumeVisible) {
            HeightToCondition = OHLCChart.DrawingHeightWithVolume;
        }
        else {
            HeightToCondition = OHLCChart.ComputationProperties.height;
        }
        var TempWidth = OHLCChart.ComputationProperties.width;
        if (OHLCChart.ComputationProperties.DataLength < OHLCChart.ComputationProperties.NumbersOfVisibleBars && OHLCChart.ChartValidationsProperties.isDataReady) {
            TempWidth = OHLCChart.ComputationProperties.XPositionFirstData;
        }
        if (OHLCChart.ChartOtherProperties.HoveredXaxis < TempWidth + (OHLCChart.ComputationProperties.BarSpace / 2)) {
            //Validation if the current data hovered is less than 0 this is to handle negative value to prevent miscalculations
            if (OHLCChart.ComputationProperties.dataNumber < 0) {
                HideChartMarkers();
                return;
            }
            //validation so that the marker will not go outisde the drawing area
            if (OHLCChart.ComputationProperties.dataNumber < OHLCChart.ComputationProperties.DataStartInternal) {
                HideChartMarkers();
                return;
            }
            //validation so that the marker will not go beyond the last data
            if (OHLCChart.ComputationProperties.dataNumber > OHLCChart.ComputationProperties.DataEndInternal - 1) {
                HideChartMarkers();
                return;
            }
            if (GetIndexOfData(OHLCChart.ChartOtherProperties.HoveredXaxis, true) < 0 || OHLCChart.ChartOtherProperties.HoveredXaxis >= TempWidth + (OHLCChart.ComputationProperties.BarSpace / 2) || GetIndexOfData(OHLCChart.ChartOtherProperties.HoveredXaxis, true) > OHLCChart.ComputationProperties.DataLength - 1) {
                HideChartMarkers();
                return;
            }
        }
        else {
            HideChartMarkers();
            return;
        }
        var VerticalPositionX = Math.round((((TempWidth - OHLCChart.ComputationProperties.BarSpace * ((OHLCChart.ComputationProperties.dataNumber) - OHLCChart.ComputationProperties.DataStartInternal)) - (OHLCChart.ChartOtherProperties.dataAdded * OHLCChart.ComputationProperties.DefaultBarsWidth)) - ((OHLCChart.ComputationProperties.BarSpace - OHLCChart.ComputationProperties.barsMargin) / 2)) - 1);
        mastercontainterverticalmarker.css({ display: "block" });
        //Condition if marker should be about half of its size. to avoid ovelapping
        if (OHLCChart.ChartOtherProperties.dataAdded === 0 && OHLCChart.ComputationProperties.dataNumber === OHLCChart.ComputationProperties.DataStartInternal && (OHLCChart.ComputationProperties.DataLength > OHLCChart.ComputationProperties.NumbersOfVisibleBars && OHLCChart.ChartValidationsProperties.isDataReady)) {

            mastercontainterverticalmarker.css({
                height: OHLCChart.ComputationProperties.height,
                top: 0,
                width: Math.round((OHLCChart.ComputationProperties.BarSpace - OHLCChart.ComputationProperties.barsMargin) / 2),
                left: Math.round((TempWidth - OHLCChart.ComputationProperties.BarSpace * (OHLCChart.ComputationProperties.dataNumber + OHLCChart.ComputationProperties.MarginOfBar - OHLCChart.ComputationProperties.DataStartInternal)) - ((OHLCChart.ComputationProperties.BarSpace - OHLCChart.ComputationProperties.barsMargin) / 2)),

                "border-color": OHLCChart.ChartSettings.Marker
            });
            mastercontainterverticalmarker.find('div').css({ "background-color": OHLCChart.ChartSettings.Marker });
        }
        else if (VerticalPositionX < 0) {
            mastercontainterverticalmarker.css({
                height: OHLCChart.ComputationProperties.height,
                width: Math.round((OHLCChart.ComputationProperties.BarSpace - OHLCChart.ComputationProperties.barsMargin) + VerticalPositionX),
                left: 0,
                top: 0,
                "border-color": OHLCChart.ChartSettings.Marker
            });
            mastercontainterverticalmarker.find('div').css({ "background-color": OHLCChart.ChartSettings.Marker });

        }
        else {
            mastercontainterverticalmarker.css({
                height: OHLCChart.ComputationProperties.height,
                width: Math.round(OHLCChart.ComputationProperties.BarSpace - OHLCChart.ComputationProperties.barsMargin),
                top: 0,
                left: VerticalPositionX,
                "border-color": OHLCChart.ChartSettings.Marker
            });
            mastercontainterverticalmarker.find('div').css({ "background-color": OHLCChart.ChartSettings.Marker });

        }
        if (OHLCChart.ChartOtherProperties.HoveredYaxis < HeightToCondition) {
            if (OHLCChart.ChartOtherProperties.HoveredYaxis > 0) {
                var CurrentPositionTop = (OHLCChart.ChartOtherProperties.HoveredYaxis - 6);
                if (CurrentPositionTop < 0) {
                    CurrentPositionTop = 0;
                }
                RightIndicator.css({ display: "block" });
                HorizontalLineIndicator.css({ display: "block" });

                RightIndicatorLabel.text(((((HeightToCondition - OHLCChart.ChartOtherProperties.HoveredYaxis) / OHLCChart.ComputationProperties.steps) + OHLCChart.ComputationProperties.yMin).toFixed(OHLCChart.Digits)).toString());
                RightIndicator.css({
                    top: CurrentPositionTop,
                    "background-color": OHLCChart.ChartSettings.Marker
                });


                HorizontalLineIndicator.css({
                    width: OHLCChart.ComputationProperties.width,
                    top: OHLCChart.ChartOtherProperties.HoveredYaxis,
                    "background-color": OHLCChart.ChartSettings.Marker
                });
            }
        }
        else {

            RightIndicator.css({ display: "none" });
            HorizontalLineIndicator.css({ display: "none" });

            HideChartMarkers();
        }
        VerticalPositionX = null;
        HeightToCondition = null;

    }
    //Hide Chart Marker
    function HideChartMarkers() {
        mastercontainterverticalmarker.css({ display: "none" });
        BottomIndicator.css({ display: "none" });
        HorizontalLineIndicator.css({ display: "none" });
        RightIndicator.css({ display: "none" });
        BarHoveredEffectElement.css({ display: "none" });
        LeftDataContainer.css('display', 'none');
    }
    //ShowBottomDataIndicator
    function showBottomDataIndicator() {
        var Condition1 = GetIndexOfData(OHLCChart.ChartOtherProperties.HoveredXaxis, true);
        var Condition2 = OHLCChart.ChartOtherProperties.HoveredXaxis;
        var Condition4 = OHLCChart.ComputationProperties.DataLength - 1;
        var TempWidth = OHLCChart.ComputationProperties.width;
        if (OHLCChart.ComputationProperties.DataLength < OHLCChart.ComputationProperties.NumbersOfVisibleBars && OHLCChart.ChartValidationsProperties.isDataReady) {
            TempWidth = OHLCChart.ComputationProperties.XPositionFirstData;
            OHLCChart.ChartOtherProperties.dataAdded = 0;
        }
        if (Condition1 < 0 || Condition2 >= TempWidth + (OHLCChart.ComputationProperties.BarSpace / 2) || Condition1 > Condition4) {
            HideChartMarkers();
            return;
        }

        Condition1 = null;
        Condition2 = null;
        Condition3 = null;
        Condition4 = null;
        if (OHLCChart.ChartValidationsProperties.isDigitsReady === false || OHLCChart.ChartValidationsProperties.isDataReady === false) {
            HideChartMarkers();
            return;
        }
        if (OHLCChart.ChartOtherProperties.ChartData) {
            if (OHLCChart.ComputationProperties.DataLength === 0) {
                return;
            }
        }

        if (OHLCChart.ChartOtherProperties.ChartData) {
            if (OHLCChart.ComputationProperties.DataLength === 0) {
                HideChartMarkers();
                return;
            }
        }
        var DateValue = ISOStringToDate(OHLCChart.ChartOtherProperties.ChartData[OHLCChart.ComputationProperties.dataNumber].Stamp());
        var hrs;
        var mins;

        if (DateValue.getMinutes() !== 0) {
            if (DateValue.getMinutes().toString().length === 1) {
                mins = "0" + DateValue.getMinutes();
            }
            else {
                mins = DateValue.getMinutes();
            }
        }
        else {
            mins = "00";
        }

        if (DateValue.getHours() !== 0) {
            hrs = DateValue.getHours();
        }
        else {
            hrs = "00";
        }

        var year = DateValue.getMonth() == 0 || DateValue.getMonth() == 11 ? " " + DateValue.getFullYear() + " " : " ";
        var date = DateValue.getDate() + " " + Months[DateValue.getMonth()] + year + hrs + ":" + mins;
        BottomIndicatorLabel.text(date);

        var BottomIndicatorPositionX = ((TempWidth - OHLCChart.ComputationProperties.BarSpace * ((OHLCChart.ComputationProperties.dataNumber) - OHLCChart.ComputationProperties.DataStartInternal)) - (BottomIndicator.outerWidth() / 2) - (OHLCChart.ChartOtherProperties.dataAdded * OHLCChart.ComputationProperties.DefaultBarsWidth));
        if (OHLCChart.ChartOtherProperties.dataAdded === 0 && OHLCChart.ComputationProperties.dataNumber === OHLCChart.ComputationProperties.DataStartInternal) {
            BottomIndicator.css({
                left: ((TempWidth - OHLCChart.ComputationProperties.BarSpace * ((OHLCChart.ComputationProperties.dataNumber + OHLCChart.ChartOtherProperties.dataAdded) - OHLCChart.ComputationProperties.DataStartInternal)) - (BottomIndicator.outerWidth() / 2)),
                bottom: 2,
                display: "block",
                "background-color": OHLCChart.ChartSettings.Marker
            });
        }
        else {
            BottomIndicator.css({
                left: BottomIndicatorPositionX,
                bottom: 2,
                display: "block",
                "background-color": OHLCChart.ChartSettings.Marker
            });
        }
        if (BottomIndicatorPositionX < 0) {
            BottomIndicator.css({
                left: 0,
                bottom: 2,
                display: "block",
                "background-color": OHLCChart.ChartSettings.Marker
            });
        }
        DateValue = null;
    }
    //Function To Show Bid Line Indicator
    function ShowBidLine(NewValue) {
        TradePanelSellSpan.text(NewValue.toFixed(OHLCChart.Digits));
        OHLCChart.ChartOtherProperties.BidValue = NewValue;
        if (!OHLCChart.ChartSettings.IsBidLineVisible) {
            return;
        }
        if (!OHLCChart.ChartValidationsProperties.isDataReady) {
            return;
        }
        var CurrentPositionTopBid = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.BidValue) - 6;
        var LinePosition = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.BidValue);
        if (CurrentPositionTopBid < 0) {
            CurrentPositionTopBid = 0;
        }
        if (LinePosition < 0) {
            BidDataIndicator.css({ display: "none" });
            BidLineIndicator.css({ display: "none" });
            return;
        }
        if (CurrentPositionTopBid > OHLCChart.ComputationProperties.height - 4) {
            BidDataIndicator.css({ display: "none" });
            BidLineIndicator.css({ display: "none" });
            return;
        }
        BidDataIndicator.css({ display: "block" });

        BidDataIndicator.css({
            top: CurrentPositionTopBid,
            right: 0,
        });

        BidDataIndicatorLabel.text(OHLCChart.ChartOtherProperties.BidValue.toFixed(OHLCChart.Digits));

        BidLineIndicator.css({ display: "block" });

        BidLineIndicator.css({
            width: OHLCChart.ComputationProperties.width,
            top: LinePosition,
            left: 0
        });

    }
    //Function to show Ask Line
    function ShowAskLine(NewValue) {
        TradePanelBuySpan.text(NewValue.toFixed(OHLCChart.Digits));
        OHLCChart.ChartOtherProperties.AskValue = NewValue;
        if (!OHLCChart.ChartSettings.IsAskLineVisible) {
            return;
        }
        if (!OHLCChart.ChartValidationsProperties.isDataReady) {
            return;
        }
        var CurrentPositionTopAsk = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.AskValue) - 6;
        var LinePosition = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.AskValue);
        if (CurrentPositionTopAsk < 0) {
            CurrentPositionTopAsk = 0;
        }
        if (LinePosition < 0) {
            AskDataIndicator.css({ display: "none" });
            AskLineIndicator.css({ display: "none" });
            return;
        }
        if (CurrentPositionTopAsk > OHLCChart.ComputationProperties.height - 4) {
            AskDataIndicator.css({ display: "none" });
            AskLineIndicator.css({ display: "none" });
            return;
        }


        AskDataIndicator.css({ display: "block" });
        AskDataIndicator.css({
            top: CurrentPositionTopAsk,
            right: 0,
        });

        AskDataIndicatorLabel.text(OHLCChart.ChartOtherProperties.AskValue.toFixed(OHLCChart.Digits));

        AskLineIndicator.css({ display: "block" });

        AskLineIndicator.css({
            width: OHLCChart.ComputationProperties.width,
            top: LinePosition,
            left: 0
        });
    }
    //Function TO Set All chart Events or subscribe
    function SetAllChartEvents() {
        var XAxis;
        var YAxis;
        var BegDragOnYmaxYminAdjustment = 0;
        var YAxisYmaxYminAdjustment = 0;

        OHLCChart.MouseUpEvent = function () {
            OHLCChart.ChartValidationsProperties.stillDown = false;
            TrigChartMouseUp(XAxis, YAxis);
            LastXAxis = "";
        };

        OHLCChart.MouseDownEvent = function (X) {
            OHLCChart.ChartValidationsProperties.stillDown = true;
            OHLCChart.ChartOtherProperties.BegDrag = X;
            LegendHolder.css({ display: "none" });
            BarHoveredEffectElement.css({ display: "none" });
            TrigChartMouseDown(XAxis, YAxis);
            LastXAxis = "";
        };

        OHLCChart.MouseMoveEvent = function (X, Y) {
            if (typeof (OHLCChart.ChartOtherProperties.ChartData) === 'undefined') {
                return;
            }
            if (OHLCChart.ChartOtherProperties.ChartData) {
                if (OHLCChart.ComputationProperties.DataLength === 0) {
                    HideChartMarkers();
                    return;
                }
            }

            if (!IsChartReady()) {
                return;
            }
            XAxis = X;
            YAxis = Y;
            OHLCChart.ComputationProperties.dataNumber = GetIndexOfData(XAxis);
            OHLCChart.ChartOtherProperties.HoveredYaxis = YAxis;
            OHLCChart.ChartOtherProperties.HoveredXaxis = XAxis;
            if (OHLCChart.ChartSettings.IsOHLCDigitsVisible) {
                SetOHLCUpperLeftData();
            }
            showBottomDataIndicator();
            if (OHLCChart.ChartSettings.IsChartMarkerVisible) {
                ReComputeComputedHightWidthOfMarker();
            }
            TrigChartMouseMove(XAxis, YAxis);
            if (OHLCChart.ChartSettings.IsLineStyle) {
                CheckHoveredTrades(Y);
            }
            if (OHLCChart.ChartSettings.IsArrowStyle) {
                CheckHoveredTradesArrowStyle(X, Y);
            }

            CheckHoveredStopLimitOrders(Y);

            if (!OHLCChart.ChartValidationsProperties.stillDown) {
                OHLCChart.ShowLegend(XAxis, YAxis);
                return;
            }
            if (OHLCChart.ComputationProperties.DataLength < OHLCChart.ComputationProperties.NumbersOfVisibleBars && OHLCChart.ChartValidationsProperties.isDataReady) {
                return;
            }
            if (OHLCChart.ChartValidationsProperties.IsDraggable) {
                var RealDataAdded;
                var ComputedAddedData;
                if (XAxis >= OHLCChart.ChartOtherProperties.BegDrag + OHLCChart.ChartOtherProperties.DragSensetivity) {
                    OHLCChart.ChartOtherProperties.BegDrag = XAxis;
                    if (OHLCChart.ComputationProperties.DataStartInternal <= OHLCChart.ComputationProperties.DataLength - OHLCChart.ComputationProperties.NumbersOfVisibleBars - 1) {
                        if (LastXAxis === "") {
                            OHLCChart.ComputationProperties.DataStartInternal = OHLCChart.ComputationProperties.DataStartInternal + 1;
                        }
                        else {
                            ComputedAddedData = (XAxis - LastXAxis) / OHLCChart.ChartOtherProperties.DragSensetivity;

                            if (ComputedAddedData < 0) {
                                RealDataAdded = ComputedAddedData - (ComputedAddedData * 2);
                            }
                            else {
                                RealDataAdded = ComputedAddedData;
                            }
                            RealDataAdded = Math.floor(RealDataAdded);
                            OHLCChart.ComputationProperties.DataStartInternal = OHLCChart.ComputationProperties.DataStartInternal + RealDataAdded;
                        }
                    }
                    IsDragRedraw = true;
                    OHLCChart.DrawOHLCChart();
                    TrigChartDragged();
                    LastXAxis = XAxis;
                }
                if (XAxis <= OHLCChart.ChartOtherProperties.BegDrag - OHLCChart.ChartOtherProperties.DragSensetivity) {
                    OHLCChart.ChartOtherProperties.BegDrag = XAxis;
                    if (OHLCChart.ComputationProperties.DataStartInternal <= 0) {
                        OHLCChart.ComputationProperties.DataStartInternal = 0;
                    }
                    if (OHLCChart.ComputationProperties.DataStartInternal > 0) {
                        if (LastXAxis === "") {
                            OHLCChart.ComputationProperties.DataStartInternal = OHLCChart.ComputationProperties.DataStartInternal - 1;
                        }
                        else {
                            ComputedAddedData = (XAxis - LastXAxis) / OHLCChart.ChartOtherProperties.DragSensetivity;
                            if (ComputedAddedData < 0) {
                                RealDataAdded = ComputedAddedData - (ComputedAddedData * 2);
                            }
                            else {
                                RealDataAdded = ComputedAddedData;
                            }
                            RealDataAdded = Math.floor(RealDataAdded);
                            OHLCChart.ComputationProperties.DataStartInternal = OHLCChart.ComputationProperties.DataStartInternal - RealDataAdded;
                            if (OHLCChart.ComputationProperties.DataStartInternal < 0) {
                                OHLCChart.ComputationProperties.DataStartInternal = 0;
                            }
                        }

                    }
                    IsDragRedraw = true;
                    OHLCChart.DrawOHLCChart();
                    TrigChartDragged();
                    LastXAxis = XAxis;
                }
            }

        };

        OHLCChart.DraggingCanvas.addEventListener('mousedown', eDraggingMouseDown);

        OHLCChart.DraggingCanvas.addEventListener('mouseup', eDraggingMouseUp);

        OHLCChart.DraggingCanvas.addEventListener('mousemove', eDraggingMouseMove);

        //~~~~~~~~~~~~~~~~~~~~~ Event Functions ~~~~~~~~~~~~~~~~~~~~~~~~~
        function eDraggingMouseMove(e) {
            YAxisYmaxYminAdjustment = e.pageY;
            if (!DraggedAdjustPrice) {
                return;
            }
            if (YAxisYmaxYminAdjustment >= BegDragOnYmaxYminAdjustment + OHLCChart.ChartOtherProperties.YAxisDraggingSensetivity) {
                BegDragOnYmaxYminAdjustment = YAxisYmaxYminAdjustment;
                if (OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.OriginalYMin) - OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.OriginalYMax) <= OHLCChart.ChartOtherProperties.MinimumHeightBars) {
                    return;
                }
                OHLCChart.ChartOtherProperties.TotalAddYminYmax = OHLCChart.ChartOtherProperties.TotalAddYminYmax + OHLCChart.ChartOtherProperties.PipsPerGrid;
                IsChartNeedToDraw = true;
                OHLCChart.DrawOHLCChart();
            }

            if (YAxisYmaxYminAdjustment <= BegDragOnYmaxYminAdjustment - OHLCChart.ChartOtherProperties.YAxisDraggingSensetivity) {
                BegDragOnYmaxYminAdjustment = YAxisYmaxYminAdjustment;
                OHLCChart.ChartOtherProperties.TotalAddYminYmax = OHLCChart.ChartOtherProperties.TotalAddYminYmax - OHLCChart.ChartOtherProperties.PipsPerGrid;
                if (OHLCChart.ChartOtherProperties.TotalAddYminYmax < 0) {
                    OHLCChart.ChartOtherProperties.TotalAddYminYmax = 0;
                }
                IsChartNeedToDraw = true;
                OHLCChart.DrawOHLCChart();
            }
        }

        function eDraggingMouseUp() {
            DraggedAdjustPrice = false;
        }

        function eDraggingMouseDown() {
            DraggedAdjustPrice = true;
            BegDragOnYmaxYminAdjustment = YAxisYmaxYminAdjustment;
        }
    }
    //Function to uncollapse Trade Panel
    function UnCollapseTradePanel() {
        if (TradePanel !== null) {
            // Check if Trade Panel is in Bottom Left of Chart            
            //var isBottomRight = parseInt(TradePanel.css("bottom")) > 5;   
            var isBottomRight = OHLCChart.ChartSettings.IsTradePanelBottomRight;
            if (isBottomRight && TradePanel.hasClass("TradePanelEditMode")) {
                var new_loc = parseInt(TradePanel.css("bottom")) - 15;
                TradePanel.css({
                    "bottom": new_loc + "px"
                });
            }

            TradePanelSpinnerHolder.removeClass("EditModeVisible");
            TradePanelBuyButton.removeClass("EditModeVisible");
            TradePanelSellButton.removeClass("EditModeVisible");
            TradePanel.removeClass("TradePanelEditMode");
        }
    }
    //Function For Collapsing Trade Panel
    function CollapseTradePanel() {
        if (TradePanel !== null) {
            // Check if Trade Panel is in Bottom Left of Chart            
            //var isBottomRight = parseInt(TradePanel.css("bottom")) > 5;   
            var isBottomRight = OHLCChart.ChartSettings.IsTradePanelBottomRight;
            if (isBottomRight && !TradePanel.hasClass("TradePanelEditMode")) {
                var new_loc = parseInt(TradePanel.css("bottom")) + 15;
                TradePanel.css({
                    "bottom": new_loc + "px"
                });
            }

            TradePanelSpinnerHolder.addClass("EditModeVisible");
            TradePanelBuyButton.addClass("EditModeVisible");
            TradePanelSellButton.addClass("EditModeVisible");
            TradePanel.addClass("TradePanelEditMode");
        }
    }
    //Set ALl Elements needed to created marker/legend etc.
    function SetAllMarkersLegendAndOtherElementsNeeded() {
        //~~~Creating the Marker of the chart~~~
        mastercontainterverticalmarker = $('<div class="MarkerVertical" style="z-index:6;display:none;height: ' + OHLCChart.ComputationProperties.height + 'px;width: 26px;position: absolute;background: transparent;border-left: solid 1.5px;border-right: solid 1.5px;border-color: green;  opacity: 0.7;left: 50px;">');

        BidLineIndicator = $('<div class="BidLineIndicator" style="z-index:6;display:none;height:1px;width: ' + OHLCChart.ComputationProperties.width + 'px;position: absolute;background: green;border-left: solid 1.5px;border-right: solid 1.5px;border-color: green; left: 0px; top:0px;">');

        BidDataIndicator = $('<div class="BidDataIndicator" style="z-index:6;display:none; width:60px;height:15px;background: green;color: white;position: absolute;"><label style="display: block;line-height: 15px;font-size: 10px;text-align: center;"></label></div>');

        PriceData = $('<div class="PriceData" style="z-index:6;display:none; width:60px;height:15px;background: green;color: white;position: absolute;"><label style="display: block;line-height: 15px;font-size: 10px;text-align: center;"></label></div>');

        AskLineIndicator = $('<div class="AskLineIndicator" style="z-index:6;display:none;height:1px;width: ' + OHLCChart.ComputationProperties.width + 'px;position: absolute;background: red;border-left: solid 1.5px;border-right: solid 1.5px;border-color: red; left: 0px; top:0px;">');

        AskDataIndicator = $('<div class="AskDataIndicator" style="z-index:6;display:none; width:60px;height:15px;background: red;color: white;position: absolute;"><label style="display: block;line-height: 15px;font-size: 10px;text-align: center;"></label></div>');

        HorizontalLineIndicator = $('<div class="HorizontalLineIndicator" style="z-index:6;display:none;height:1px;width: ' + OHLCChart.ComputationProperties.width + 'px;position: absolute;background: green;border-left: solid 1.5px;border-right: solid 1.5px;border-color: green; left: 0px; top:0px;">');

        RightIndicator = $('<div class="RightIndicator" style="z-index:6;display:none; width:60px;height:15px;background: green;color: white;position: absolute;right: 0;"><label style="display: block;line-height: 15px;font-size: 10px;text-align: center;"></label></div>');

        BottomIndicator = $('<div class="BottomIndicator" style="z-index:6;display:none; background: green;padding-left: 5px;padding-right: 5px;height: 18px;position: absolute;bottom: 1px;color: white;left: 90px;"><label style="display:block; text-align: center;font-size: 9px;margin-top: 2.5px;line-height: 15px;"></label></div>');

        BarHoveredEffectElement = $('<div class="BarHoveredEffect" style="display:none; z-index:6;border: black solid 2px;height: 49px;width: 22px;position: absolute;left: 50px;top: 65px;"></div>');

        LegendHolder = $('<div class="LegendHolder"><div class="DateHolder"><label>8-Jan-15 10:00</label></div><div class="OpenHolder"><div class="OHLCLegend">Open</div><div class="OHLCLegendData">119.79</div></div><div class="HighHolder"><div class="OHLCLegend">High</div><div class="OHLCLegendData">119.79</div></div><div class="LowHolder"><div class="OHLCLegend">Low</div><div class="OHLCLegendData">119.79</div></div><div class="CloseHolder"><div class="OHLCLegend">Close</div><div class="OHLCLegendData">119.79</div></div><div class="VolumeHolder"><div class="OHLCLegend">Volume</div><div class="OHLCLegendData">119.79</div></div></div>');

        LoadingHolder = $('<div class="LoadingHolder" style="z-index:6;left: 5px; bottom: 20px; position:  absolute;width: 100px;height: 20px;"><label style="color: #FFF;font-size: 15px;">Loading...</label></div>');

        TradePanel = $('<div class="TradePanel" style="display:' + (OHLCChart.ChartSettings.IsTradePanelVisible ? "block" : "none") + ';"><div class="Sell wt-disabled"><div id="SellImageTradePanel"></div><span id="SellPriceTradePanel"></span><label id="SellLabelTradePanel">Sell</label></div><div class="SpinnerHolder"><input id="VolumeSpinner" class="wt-spin-edit" min="0" style=""></div><div class="Buy wt-disabled"><span id="PriceTradePanel"></span><div id="BuyImageTradePanel"></div><label id="LabelTradePanel">Buy</label></div></div>');

        LeftDataContainer = $('<div style="z-index:6;display:none; position: absolute;left: 5px;top: 1px;"><div style="background-color:white;" class="OpenCloseHolder">O: 0.00 C: 0.00</div></div>');

        DataIndicatorCorrelation = $('<div style="z-index:6;display:inline-block; position:absolute; left: 5px; top: 3px; background-color:white;">Test</div>');

        //Find Some Reference Element
        OpenCloseHolder = LeftDataContainer.find('.OpenCloseHolder');
        PriceDataLabel = PriceData.find('label');
        BidDataIndicatorLabel = BidDataIndicator.find('label');
        AskDataIndicatorLabel = AskDataIndicator.find('label');
        RightIndicatorLabel = RightIndicator.find('label');
        BottomIndicatorLabel = BottomIndicator.find('label');
        LegendDateLabelHolder = LegendHolder.find('div.DateHolder div.OHLCLegendData');
        LegendOpenLabelHolder = LegendHolder.find('.OpenHolder div.OHLCLegendData');
        LegendHighLabelHolder = LegendHolder.find('.HighHolder div.OHLCLegendData');
        LegendLowLabelHolder = LegendHolder.find('.LowHolder div.OHLCLegendData');
        LegendCloseLabelHolder = LegendHolder.find('.CloseHolder div.OHLCLegendData');
        LegendVolumeLabelHolder = LegendHolder.find('.VolumeHolder div.OHLCLegendData');
        TradePanelSellSpan = TradePanel.find('.Sell span');
        TradePanelBuySpan = TradePanel.find('.Buy span');
        TradePanelSpinnerHolder = TradePanel.find('.SpinnerHolder');
        TradePanelSellButton = TradePanel.find('.Sell');
        TradePanelBuyButton = TradePanel.find('.Buy');
        TradePanelArrowButtonSell = TradePanelSellButton.find('div');
        TradePanelArrowButtonBuy = TradePanelBuyButton.find('div');
        VolumeSpinner = TradePanel.find('#VolumeSpinner');
        OHLCChart.BaseChartElement.append(mastercontainterverticalmarker);
        OHLCChart.BaseChartElement.find('div').append('<div style="height: 100%;  width: 100%;  position: absolute;  background: green;  opacity: 0.4;">');

        //Append All Element to the main Container
        OHLCChart.BaseChartElement.append(AskLineIndicator);
        OHLCChart.BaseChartElement.append(AskDataIndicator);
        OHLCChart.BaseChartElement.append(BidLineIndicator);
        OHLCChart.BaseChartElement.append(PriceData);
        OHLCChart.BaseChartElement.append(BidDataIndicator);
        OHLCChart.BaseChartElement.append(HorizontalLineIndicator);
        OHLCChart.BaseChartElement.append(RightIndicator);
        OHLCChart.BaseChartElement.append(BottomIndicator);
        OHLCChart.BaseChartElement.append(BarHoveredEffectElement);
        OHLCChart.BaseChartElement.append(LegendHolder);
        OHLCChart.BaseChartElement.append(LeftDataContainer);
        OHLCChart.BaseChartElement.append(LoadingHolder);
        OHLCChart.BaseChartElement.append(TradePanel);

        if (OHLCChart.ChartSettings.IsTradePanelBottomRight) {
            TradePanel.css({
                "bottom": "25px",
                "right": "60px",
                "top": "auto"
            });
        }

        if (OHLCChart.ChartSettings.IsChartDisplayDisabled) {
            OHLCChart.BaseChartElement.append(DataIndicatorCorrelation);
        }


    }
    //Initialize Trade Panel Spinner and its event
    function InitTradePanelSpinner() {
        // Take Profit
        VolumeSpinner.WCSpinner({
            DefaultValue: 1.00,
            Step: 0.01,
            DecimalPlaces: 2,
            MinValue: 0.01,
            MaxValue: 99.99
        });
    }
    //Subscribe to bid ViewModel
    function SubscribeToBid() {
        //if (!options.IsHasArrowMovement) return;
        if (BidSubscription !== null) {
            BidSubscription.dispose();
        }
        if (BidMovementSubscription !== null) {
            BidMovementSubscription.dispose();
            QuoteIsOpenSubscription.dispose();
        }
        var QuotesLength = QuotesViewModel.Quotes().length;
        for (var i = 0; i < QuotesLength; i++) {
            if (QuotesViewModel.Quotes()[i].Symbol() === OHLCChart.ChartSettings.Symbol) {
                if (QuotesViewModel.Quotes()[i].Bid() !== 0) {
                    if (OHLCChart.ChartValidationsProperties.isDataReady && OHLCChart.ChartValidationsProperties.isDigitsReady) {
                        ShowBidLine(QuotesViewModel.Quotes()[i].Bid());
                        UpdateBidMovement(QuotesViewModel.Quotes()[i].BidMovement());
                    }
                }
                OHLCChart.ChartOtherProperties.BidValue = QuotesViewModel.Quotes()[i].Bid();
                BidSubscription = QuotesViewModel.Quotes()[i].Bid.subscribe(ShowBidLine);
                BidMovementSubscription = QuotesViewModel.Quotes()[i].BidMovement.subscribe(UpdateBidMovement);
                UpdateTradePanelSession(QuoteIsOpenSubscription = QuotesViewModel.Quotes()[i].IsOpen());
                QuoteIsOpenSubscription = QuotesViewModel.Quotes()[i].IsOpen.subscribe(UpdateTradePanelSession);
                return;
            }
            else {
                BidLineIndicator.css({ display: "none" });
                BidDataIndicator.css({ display: "none" });
            }
        }
        BidSubscription = QuotesViewModel.Quotes.subscribe(SubscribeToBid);
    }
    //Function For Updating Trade Panel
    function UpdateTradePanelSession(newVal) {
        _isMarketOpen = newVal;
        DisableTradePanel();
    }
    //Function When to disable Trade Panel
    function DisableTradePanel() {
        if (TradePanelBuyButton === null) {
            return;
        }
        if (_isMarketOpen === false || QuotesViewModel.IsConnected() === false) {
            TradePanelBuyButton.addClass("wt-disabled");
            TradePanelSellButton.addClass("wt-disabled");
        }
        else {
            TradePanelBuyButton.removeClass("wt-disabled");
            TradePanelSellButton.removeClass("wt-disabled");
        }
    }
    //Subscribe to Ask View Model
    function SubscribeToAsk() {
        // if (!options.IsHasArrowMovement) return;

        if (AskSubscription !== null) {
            AskSubscription.dispose();
        }
        if (AskMovementSubscription !== null) {
            AskMovementSubscription.dispose();
        }
        var QuotesLength = QuotesViewModel.Quotes().length;
        for (var i = 0; i < QuotesLength; i++) {
            if (QuotesViewModel.Quotes()[i].Symbol() === OHLCChart.ChartSettings.Symbol) {
                if (QuotesViewModel.Quotes()[i].Ask() !== 0) {
                    if (OHLCChart.ChartValidationsProperties.isDataReady && OHLCChart.ChartValidationsProperties.isDigitsReady) {
                        ShowAskLine(QuotesViewModel.Quotes()[i].Ask());
                        UpdateAskMovement(QuotesViewModel.Quotes()[i].AskMovement());
                    }
                }
                OHLCChart.ChartOtherProperties.AskValue = QuotesViewModel.Quotes()[i].Ask();
                AskSubscription = QuotesViewModel.Quotes()[i].Ask.subscribe(ShowAskLine);
                AskMovementSubscription = QuotesViewModel.Quotes()[i].AskMovement.subscribe(UpdateAskMovement);
                return;
            }
            else {
                AskLineIndicator.css({ display: "none" });
                AskDataIndicator.css({ display: "none" });
            }
        }
        AskSubscription = QuotesViewModel.Quotes.subscribe(SubscribeToAsk);
    }
    //Subscribe to The symbol digits
    function SetDigits() {
        var QuotesLength = QuotesViewModel.Quotes().length;
        for (var i = 0; i < QuotesLength; i++) {
            if (QuotesViewModel.Quotes()[i].Symbol() === OHLCChart.ChartSettings.Symbol) {
                OHLCChart.ChartValidationsProperties.isDigitsReady = true;
                if (DigitSubscription !== null) {
                    DigitSubscription.dispose();
                }
                OHLCChart.Digits = QuotesViewModel.Quotes()[i].Digits();
                if (OHLCChart.ChartValidationsProperties.isDataReady) {
                    OHLCChart.DrawOHLCChart();
                }
            }
        }
    }
    //Request Data function
    function RequestData(isClear, callback) {
        if (IsNewGraphType()) {
            var data = BarsViewModel.FindProcessedBar(OHLCChart.ChartSettings.Symbol, OHLCChart.ChartSettings.TimeFrame, OHLCChart.ChartSettings.GraphType, OHLCChart.ChartSettings.BoxSize, OHLCChart.ChartSettings.Reversal);
            if (data === null) {
                BarsViewModel.RequestProcessedBarsData(OHLCChart.ChartSettings.Symbol, OHLCChart.ChartSettings.TimeFrame, OHLCChart.ChartSettings.GraphType, OHLCChart.ChartSettings.BoxSize, OHLCChart.ChartSettings.Reversal, OHLCChart.ComputationProperties.NumbersOfVisibleBars, OHLCChart.DrawOHLCChart, OHLCChart);
            }
        }
        else {
            if (OHLCChart.ChartOtherProperties.ChartData.length === 0) {
                BarsViewModel.RequestBarsData(OHLCChart.ChartSettings.Symbol, OHLCChart.ChartSettings.TimeFrame, OHLCChart.ComputationProperties.NumbersOfVisibleBars, OHLCChart.DrawOHLCChart, OHLCChart, isClear, callback);
            }
        }
    }
    //UpdateAskMovement
    function UpdateAskMovement(NewValue) {
        var ArrowMovement = GetArrowMovement(OHLCChart.ChartSettings.Symbol, "Ask");
        if (ArrowMovement === "ArrowUp") {
            TradePanelArrowButtonSell.removeClass('ArrowUp');
            TradePanelArrowButtonSell.removeClass('ArrowDown');
            TradePanelArrowButtonSell.addClass('ArrowUp');
        }
        else {
            TradePanelArrowButtonSell.removeClass('ArrowUp');
            TradePanelArrowButtonSell.removeClass('ArrowDown');
            TradePanelArrowButtonSell.addClass('ArrowDown');
        }
    }
    //UpdateBidMovement
    function UpdateBidMovement(NewValue) {
        var ArrowMovement = GetArrowMovement(OHLCChart.ChartSettings.Symbol, "Bid");
        if (ArrowMovement === "ArrowUp") {
            TradePanelArrowButtonBuy.removeClass('ArrowUp');
            TradePanelArrowButtonBuy.removeClass('ArrowDown');
            TradePanelArrowButtonBuy.addClass('ArrowUp');
        }
        else {
            TradePanelArrowButtonBuy.removeClass('ArrowUp');
            TradePanelArrowButtonBuy.removeClass('ArrowDown');
            TradePanelArrowButtonBuy.addClass('ArrowDown');
        }
    }
    //Draw Line Period Separator 
    function DrawLinePeriodSeparator(Xposition, iNumber) {
        if (!ValidateSeparator(iNumber)) {
            return;
        }
        OHLCChart.ctxGridLine.setLineDash([]);
        OHLCChart.ctxGridLine.beginPath();
        OHLCChart.ctxGridLine.strokeStyle = OHLCChart.ChartSettings.Periods;
        OHLCChart.ctxGridLine.lineWidth = 1;
        OHLCChart.ctxGridLine.moveTo(Xposition, 0);
        OHLCChart.ctxGridLine.lineTo(Xposition, OHLCChart.ComputationProperties.height);
        OHLCChart.ctxGridLine.stroke();
    }
    // Validate through number separator
    function ValidateNumberDifferenceSeparator(iNumber, numberCondition) {
        var Difference = iNumber - OHLCChart.LastSeparatorNumber;
        if (Difference < 0) {
            Difference = Difference * -1;
        }
        OHLCChart.LastSeparatorNumber = iNumber;
        if (Difference > numberCondition) {
            return true;
        }
        else {
            return false;
        }
    }
    //function Validate Separator
    function ValidateSeparator(iNumber) {
        if (OHLCChart.LastSeparatorNumber === null) {
            OHLCChart.LastSeparatorNumber = iNumber;
            return true;
        }

        switch (OHLCChart.ChartSettings.TimeFrame) {
            case 1:
                if (ValidateNumberDifferenceSeparator(iNumber, 30)) {
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 5:
                if (ValidateNumberDifferenceSeparator(iNumber, 144)) {
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 15:
                if (ValidateNumberDifferenceSeparator(iNumber, 48)) {
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 30:
                if (ValidateNumberDifferenceSeparator(iNumber, 168)) {
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 60:
                if (ValidateNumberDifferenceSeparator(iNumber, 84)) {
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 180:
                if (ValidateNumberDifferenceSeparator(iNumber, 28)) {
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 240:
                if (ValidateNumberDifferenceSeparator(iNumber, 21)) {
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 360:
                if (ValidateNumberDifferenceSeparator(iNumber, 60)) {
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 480:
                if (ValidateNumberDifferenceSeparator(iNumber, 45)) {
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 720:
                if (ValidateNumberDifferenceSeparator(iNumber, 30)) {
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 1440:
                if (ValidateNumberDifferenceSeparator(iNumber, 15)) {
                    return true;
                }
                else {
                    return false;
                }
                break;

            case 10080:
                if (ValidateNumberDifferenceSeparator(iNumber, 24)) {
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 43829:
                if (ValidateNumberDifferenceSeparator(iNumber, 6)) {
                    return true;
                }
                else {
                    return false;
                }
                break;
        }
    }
    //Set PeriodSeparator
    function SetPeriodSeparator(date, Xposition, NextDate, iNumber) {
        if (!OHLCChart.ChartSettings.IsPeriodSeparator) {
            date = null;
            return;
        }
        var CurrentStamp = ISOStringToDate(date);
        var NextCurrentStamp = ISOStringToDate(NextDate);

        var CurrentHr;
        var Hr;
        var min;
        var Nexthr;
        var NextD;
        var GetDay;
        var CurrentD;
        //Hourly Separator
        if (OHLCChart.ChartSettings.TimeFrame === 1) {
            CurrentHr = CurrentStamp.getHours();
            min = CurrentStamp.getMinutes();
            Nexthr = NextCurrentStamp.getHours();
            if (min === 0) {
                DrawLinePeriodSeparator(Xposition, iNumber);
            }
            else if (CurrentHr !== Nexthr) {
                DrawLinePeriodSeparator(Xposition, iNumber);
            }
        }
            //Daily Separator
        else if (OHLCChart.ChartSettings.TimeFrame === 5 || OHLCChart.ChartSettings.TimeFrame === 15) {
            CurrentD = CurrentStamp.getDate();
            Hr = CurrentStamp.getHours();
            min = CurrentStamp.getMinutes();
            NextD = NextCurrentStamp.getDate();
            if (Hr === 0 && min === 0) {
                DrawLinePeriodSeparator(Xposition, iNumber);
            }
            else if (CurrentD !== NextD) {
                DrawLinePeriodSeparator(Xposition, iNumber);
            }
        }
            //Weekly Separator
        else if (OHLCChart.ChartSettings.TimeFrame === 30 || OHLCChart.ChartSettings.TimeFrame === 240 || OHLCChart.ChartSettings.TimeFrame === 60 || OHLCChart.ChartSettings.TimeFrame === 180) {
            CurrentD = CurrentStamp.getDay();
            Hr = CurrentStamp.getHours();
            min = CurrentStamp.getMinutes();
            NextD = NextCurrentStamp.getDay();
            GetDay = CurrentStamp.getDay();
            if (GetDay === OHLCChart.ChartSettings.WeeklyPeriod && Hr === 0 && min === 0) {
                DrawLinePeriodSeparator(Xposition, iNumber);
            }
            else if (CurrentD === OHLCChart.ChartSettings.WeeklyPeriod && NextD !== OHLCChart.ChartSettings.WeeklyPeriod) {
                DrawLinePeriodSeparator(Xposition, iNumber);
            }

        }
            //Monthly Separator
        else if (OHLCChart.ChartSettings.TimeFrame === 1440 || OHLCChart.ChartSettings.TimeFrame === 360 || OHLCChart.ChartSettings.TimeFrame === 480 || OHLCChart.ChartSettings.TimeFrame === 720) {
            var CurrentMonth = CurrentStamp.getMonth() + 1;
            var NextDate = NextCurrentStamp.getDate();
            var NextMonth = NextCurrentStamp.getMonth() + 1;

            if (CurrentMonth !== NextMonth) {
                DrawLinePeriodSeparator(Xposition, iNumber);
            }

        }
            //Yearly Separator
        else if (OHLCChart.ChartSettings.TimeFrame === 43829 || OHLCChart.ChartSettings.TimeFrame === 10080) {
            var CurrentYear = CurrentStamp.getFullYear();
            var NextYear = NextCurrentStamp.getFullYear();
            if (CurrentYear !== NextYear) {
                DrawLinePeriodSeparator(Xposition, iNumber);
            }
        }
        CurrentStamp = null;
        NextCurrentStamp = null;
        date = null;
    }
    //Set ChartScrollBar
    function SetScrollBarEvent() {
        ChartScrollBarHolder.on("slide", function (event, ui) {
            OHLCChart.ComputationProperties.DataStartInternal = OHLCChart.ComputationProperties.DataLength - OHLCChart.ComputationProperties.NumbersOfVisibleBars - ui.value;
            IsDragRedraw = true;
            OHLCChart.DrawOHLCChart();
            CheckDataIfNeedsToRequest(false);
            TrigScrollDragged();
        });
    }
    //InitChartScrollBar
    function InitChartScrollBar() {
        var ScrollBarValue = OHLCChart.ComputationProperties.DataLength - OHLCChart.ComputationProperties.NumbersOfVisibleBars - OHLCChart.ComputationProperties.DataStartInternal;
        var ScrollBarMax = OHLCChart.ComputationProperties.DataLength - OHLCChart.ComputationProperties.NumbersOfVisibleBars;
        if (ChartScrollBarHolder.slider("option")) {
            ChartScrollBarHolder.slider("option", "max", ScrollBarMax);
        }

        if (ChartScrollBarHolder.slider("value") || ChartScrollBarHolder.slider("value") === 0) {
            if (ChartScrollBarHolder.slider("value") !== ScrollBarValue) {
                ChartScrollBarHolder.slider("value", ScrollBarValue);
            }
        }
    }
    //Function To Set Position of Trade Panel
    function SetPositionTradePanel() {
        if (!OHLCChart.ChartSettings.IsTradePanelBottomRight) {
            TradePanel.css({ left: (OHLCChart.ComputationProperties.width / 2 - 75) });
        }
    }
    //Function To subscribe when to draw
    function SubscribeWhenToDraw() {
        if (DrawArraySub !== null) {
            DrawArraySub.dispose();
        }

        if (DrawNoDataSub !== null) {
            DrawNoDataSub.dispose();
        }

        if (DrawCloseSub !== null) {
            DrawCloseSub.dispose();
        }
        var BarsViewModelLength = BarsViewModel.BarsDataHolder().length;
        if (BarsViewModelLength !== 0) {
            for (var i = 0; i < BarsViewModelLength; i++) {
                if (BarsViewModel.BarsDataHolder()[i].Symbol === OHLCChart.ChartSettings.Symbol && BarsViewModel.BarsDataHolder()[i].TimeFrame === OHLCChart.ChartSettings.TimeFrame) {
                    MainDrawFunctionToPreventCallingOfUnecessaryFunction();
                    if (DrawNoDataSub !== null) {
                        DrawNoDataSub.dispose();
                    }
                    DrawArraySub = BarsViewModel.BarsDataHolder()[i].Data.subscribe(SubscribeWhenToDraw);
                    DrawCloseSub = BarsViewModel.BarsDataHolder()[i].Data()[0].Close.subscribe(MainDrawFunctionToPreventCallingOfUnecessaryFunction);
                    BarsViewModel.BarsDataHolder()[i].Data()[0].Close.extend({ notify: 'always' });
                    return;
                }
            }
        }
        DrawNoDataSub = BarsViewModel.BarsDataHolder.subscribe(SubscribeWhenToDraw);
    }
    // Function To subscribe when to draw - Processed Bars
    function SubscribeWhenToDrawProcessedBars() {
        if (DrawArraySub !== null) {
            DrawArraySub.dispose();
        }

        if (DrawNoDataSub !== null) {
            DrawNoDataSub.dispose();
        }

        if (DrawCloseSub !== null) {
            DrawCloseSub.dispose();
        }

        var data = BarsViewModel.FindProcessedBar(OHLCChart.ChartSettings.Symbol, OHLCChart.ChartSettings.TimeFrame, OHLCChart.ChartSettings.GraphType, OHLCChart.ChartSettings.BoxSize, OHLCChart.ChartSettings.Reversal);
        if (data !== null) {
            MainDrawFunctionToPreventCallingOfUnecessaryFunction();
            if (DrawNoDataSub !== null) {
                DrawNoDataSub.dispose();
            }
            DrawArraySub = data.Data.subscribe(MainDrawFunctionToPreventCallingOfUnecessaryFunction);
            return;
        }
        var BarsData = FindBarsData(OHLCChart.ChartSettings.Symbol, OHLCChart.ChartSettings.TimeFrame);
        if (BarsData !== null) {
            if (DrawNoDataSub !== null) {
                DrawNoDataSub.dispose();
            }
            switch (OHLCChart.ChartSettings.GraphType) {
                case "PointAndFigure":
                    DrawNoDataSub = BarsData.PNFBars.subscribe(SubscribeWhenToDrawProcessedBars);
                    break;

                case "LineBreak":
                    DrawNoDataSub = BarsData.LineBreakBars.subscribe(SubscribeWhenToDrawProcessedBars);
                    break;

                case "Renko":
                    DrawNoDataSub = BarsData.RenkoBars.subscribe(SubscribeWhenToDrawProcessedBars);
                    break;

                case "Kagi":
                    DrawNoDataSub = BarsData.KagiBars.subscribe(SubscribeWhenToDrawProcessedBars);
                    break;
                default: break;
            }
        }
        else {
            DrawNoDataSub = BarsViewModel.BarsDataHolder.subscribe(SubscribeWhenToDrawProcessedBars);
        }
    }
    //Find Bars
    function FindBarsData(symbol, timeframe) {
        var BarsLength = BarsViewModel.BarsDataHolder().length;
        for (var i = 0; i < BarsLength; i++) {
            if (BarsViewModel.BarsDataHolder()[i].Symbol === symbol && BarsViewModel.BarsDataHolder()[i].TimeFrame === timeframe) {
                return BarsViewModel.BarsDataHolder()[i];
            }
        }
        return null;
    }
    //Main Function to subscribe when to draw
    function MainDrawFunctionToPreventCallingOfUnecessaryFunction() {
        if (OHLCChart.ParentELement.parent().width() === 0) {
            return;
        }
        if (IsNewGraphType()) {
            console.log();
        }
        IsDragRedraw = true;
        IsUpdateReDraw = true;
        OHLCChart.DrawOHLCChart();
    }
    //Function To get Index of the chart using X Axis
    function GetIndexOfData(X, IncludeValidation) {
        var IndexResult = 0;
        var TempWidth = OHLCChart.ComputationProperties.width;
        if (OHLCChart.ComputationProperties.DataLength < OHLCChart.ComputationProperties.NumbersOfVisibleBars && OHLCChart.ChartValidationsProperties.isDataReady) {
            TempWidth = OHLCChart.ComputationProperties.XPositionFirstData;
        }
        if (OHLCChart.ChartOtherProperties.dataAdded === 1) {
            IndexResult = (Math.floor((TempWidth - (X - (OHLCChart.ComputationProperties.BarSpace / 2))) / OHLCChart.ComputationProperties.BarSpace) + OHLCChart.ComputationProperties.DataStartInternal) - 1 - (OHLCChart.ComputationProperties.ZoomCollection[OHLCChart.ChartSettings.ZoomLevel] - 1);
        }
        else {
            IndexResult = (Math.floor((TempWidth - (X - (OHLCChart.ComputationProperties.BarSpace / 2))) / OHLCChart.ComputationProperties.BarSpace) + OHLCChart.ComputationProperties.DataStartInternal);
        }

        if (!IncludeValidation) {
            var ChartDataLength = OHLCChart.ChartOtherProperties.ChartData.length;
            if (IndexResult > ChartDataLength - 1) {
                IndexResult = ChartDataLength - 1;
            }
        }

        if (IndexResult < 0) {
            IndexResult = 0;
        }
        return IndexResult;
    }
    //Enabliing Drop Chart
    function EnableDropChart() {
        var dropElement = $(OHLCChart.VisualToolsCanvas);
        var dropOptions = {
            drop: function (event, ui) {
                var ElementSource = ui.draggable.attr('ElementSource');
                var DraggedSymbol = ui.draggable.attr('Symbol');
                if (ElementSource != undefined && DraggedSymbol != undefined) {
                    if (ElementSource === "MW") {
                        if (DraggedSymbol === null || DraggedSymbol === undefined) {
                            return;
                        }
                        if (SymbolDraggedIsValid(DraggedSymbol)) {
                            ChartFormInstance.ChartChangeSymbol(DraggedSymbol);
                            TrigSymbolDropped(DraggedSymbol);
                        }
                    }
                    else {
                        var arrSymbols = DraggedSymbol.split(" ");
                        var Symbol1 = arrSymbols[0];
                        var Symbol2 = arrSymbols[1];
                        if (SymbolDraggedIsValid(Symbol1) && SymbolDraggedIsValid(Symbol2)) {
                            TrigCorrelationDrop(Symbol1, Symbol2);
                        }
                    }
                }
            }
        };
        dropElement.droppable(dropOptions);
    }
    //GetTheLastStampOfBars 
    function GetLastStampBars() {
        if (OHLCChart.ChartOtherProperties.ChartData) {
            var ChartDataLength = OHLCChart.ChartOtherProperties.ChartData.length;
            if (ChartDataLength !== 0) {
                return ISOStringToDate(OHLCChart.ChartOtherProperties.ChartData[ChartDataLength - 1].Stamp());
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    //Condition For Loading indicator of the chart
    function SetVisibilityOfLoadingIndicator() {
        if (OHLCChart.ChartOtherProperties.LastDateOfBars !== null) {
            var InLastBarStamp = GetLastStampBars();
            if (InLastBarStamp) {
                if (InLastBarStamp.getTime() <= OHLCChart.ChartOtherProperties.LastDateOfBars.getTime()) {
                    LoadingHolder.css({ display: "none" });
                }
            }
            if (OHLCChart.ChartSettings.CorrelationNumberOfBars !== null) {
                if (OHLCChart.ComputationProperties.DataLength >= OHLCChart.ChartSettings.CorrelationNumberOfBars) {
                    LoadingHolder.css({ display: "none" });
                }
            }
        }
    }
    // Get the last bar date
    function SetLastDateOfBars(ActualDate) {
        if (OHLCChart === null) {
            return;
        }
        OHLCChart.ChartOtherProperties.LastDateOfBars = ISOStringToDate(ActualDate);
        SetVisibilityOfLoadingIndicator();
    }
    //Set OHLC Data Indicator upper left
    function SetOHLCUpperLeftData() {
        var TempDataNumber = OHLCChart.ComputationProperties.dataNumber;
        OpenCloseHolder.text("O: " + OHLCChart.ChartOtherProperties.ChartData[TempDataNumber].Open().toFixed(OHLCChart.Digits) + " | H: " + OHLCChart.ChartOtherProperties.ChartData[TempDataNumber].High().toFixed(OHLCChart.Digits) + " | L: " + OHLCChart.ChartOtherProperties.ChartData[TempDataNumber].Low().toFixed(OHLCChart.Digits) + " | C: " + OHLCChart.ChartOtherProperties.ChartData[TempDataNumber].Close().toFixed(OHLCChart.Digits));
        LeftDataContainer.css({
            'display': 'block',
            'color': OHLCChart.ChartSettings.ForeGround,
            "background-color": OHLCChart.ChartSettings.BackGroundColor,
            "top": OHLCChart.ChartSettings.IsOHLCDigitsBottomRight ? "auto" : "1px",
            "bottom": OHLCChart.ChartSettings.IsOHLCDigitsBottomRight ? "21px" : "auto",
            "left": OHLCChart.ChartSettings.IsOHLCDigitsBottomRight ? "auto" : "5px",
            "right": OHLCChart.ChartSettings.IsOHLCDigitsBottomRight ? "65px" : "auto"
        });
        OpenCloseHolder.css({ "background-color": OHLCChart.ChartSettings.BackGroundColor, "font-size": 11, "opacity": .3 });
    }
    //Check if new graph type - PointAndFigure, LineBreak, Renko and Kagi
    function IsNewGraphType() {
        if (OHLCChart.ChartSettings.GraphType === "Renko" || OHLCChart.ChartSettings.GraphType === "LineBreak" || OHLCChart.ChartSettings.GraphType === "PointAndFigure" || OHLCChart.ChartSettings.GraphType === "Kagi") {
            return true;
        }

        return false;
    }
    //Function to handle all subscription of charts
    function SubscribeWhenToDrawFunction() {
        if (IsNewGraphType()) {
            SubscribeWhenToDrawProcessedBars();
        } else {
            SubscribeWhenToDraw();
        }
    }
    //function to reload chart
    function ReloadChart() {
        LoadingHolder.css({ display: "block" });
        ScrollBarMainHolder.css({ display: "none" });
        AskLineIndicator.css({ display: "none" });
        AskDataIndicator.css({ display: "none" });
        BidLineIndicator.css({ display: "none" });
        BidDataIndicator.css({ display: "none" });
        PriceData.css({ 'display': 'none' });
        OHLCChart.ChartValidationsProperties.isDataReady = false;
        OHLCChart.ChartValidationsProperties.isDigitsReady = false;
        OHLCChart.ComputationProperties.DataStartInternal = 0;
        SetDigits();
        IsChartNeedToDraw = true;
        RemoveAllElementsNeeded();
        RemoveAllElementsNeededStopLimitOrders();
        OHLCChart.ChartOtherProperties.ChartData = [];
        SubscribeWhenToDrawFunction();
        RequestData();
        IsChartNeedToDraw = true;
        OHLCChart.DrawBaseChartWithOutData();
    }
    //Function To Set Price Data For New chart
    function SetPriceData() {
        if (OHLCChart.ChartValidationsProperties.isDataReady && OHLCChart.ChartValidationsProperties.isDigitsReady) {
            if (IsNewGraphType()) {
                var Data = OHLCChart.ChartOtherProperties.ChartData[OHLCChart.ComputationProperties.DataStartInternal];
                var CurrentPositionTop = OHLCChart.GetYaxis(Data.Close()) - 6;
                if (OHLCChart.ChartSettings.GraphType === 'Kagi') {
                    SetPositionPriceData(CurrentPositionTop, OHLCChart.ChartOtherProperties.KagiFillStyle);
                }
                else {
                    SetPositionPriceData(CurrentPositionTop, Data.Trend() === 'Up' ? 'green' : 'red');
                }
                PriceDataLabel.text(Data.Close().toFixed(OHLCChart.Digits));
            }
            else {
                PriceData.css({
                    'display': 'none'
                });
            }
        }
    }
    //Set Position of price data
    function SetPositionPriceData(Xposition, color) {
        PriceData.css({
            'display': 'block',
            'top': Xposition,
            'right': 0,
            'background-color': color
        });
    }
    //Function to determine if chart is ready
    function IsChartReady() {
        if (!OHLCChart.ChartValidationsProperties.isDataReady || !OHLCChart.ChartValidationsProperties.isDigitsReady) {
            return false;
        }
        return true;
    }
    //Set zoom item Menu its value on first load
    function SetZoomItemMenuValue() {
        ToolZoomChart.slider("value", 4 - OHLCChart.ChartSettings.ZoomLevel);
    }
    //Set Correlation Text
    function SetCorrelationText() {
        if (!OHLCChart.ChartSettings.IsChartDisplayDisabled) {
            return;
        }
        var TimeFrameConvertion;
        switch (OHLCChart.ChartSettings.TimeFrame) {
            case 15:
                TimeFrameConvertion = "M15";
                break;
            case 30:
                TimeFrameConvertion = "M30";
                break;
            case 60:
                TimeFrameConvertion = "H1";
                break;
            case 360:
                TimeFrameConvertion = "H6";
                break;
            case 720:
                TimeFrameConvertion = "H12";
                break;
            case 1440:
                TimeFrameConvertion = "Daily";
                break;
            case 10080:
                TimeFrameConvertion = "Weekly";
                break;
        }
        DataIndicatorCorrelation.text(OHLCChart.ChartSettings.Symbol + " - " + TimeFrameConvertion);
    }
    //Checked if DraggedSymbol if Valid
    function SymbolDraggedIsValid(DraggedSymbol) {
        if (typeof DraggedSymbol === "string") {
            var QuotesLength = QuotesViewModel.Quotes().length;
            for (var i = 0; i < QuotesLength; i++) {
                if (DraggedSymbol === QuotesViewModel.Quotes()[i].Symbol()) {
                    return true;
                }
            }
        }
        return false;
    }

    function GetArrowMovement(Symbol, AskBid) {
        var quoteslength = QuotesViewModel.Quotes().length;
        for (var i = 0; i < quoteslength; i++) {
            var quote = QuotesViewModel.Quotes()[i];
            if (Symbol == quote.Symbol()) {
                var movement = "";
                if (AskBid == "Bid") {
                    movement = quote.BidMovement();
                } else if (AskBid == "Ask") {
                    movement = quote.AskMovement();
                }

                switch (movement) {
                    case "+":
                        quote = null;
                        return "ArrowUp";
                        break;
                    case "-":
                        quote = null;
                        return "ArrowDown";
                        break;
                    case "=":
                        if (AskBid == "Bid") {
                            quote = null;
                            return "ArrowDown";
                        } else if (AskBid == "Ask") {
                            quote = null;
                            return "ArrowUp";
                        }
                        break;
                }
                break;
            }
            quote = null;
        }
    }



    //Chart Triggers
    //Trigger for settings Changed
    function TrigSettingsChanged() {
        ChartFormInstance.ParentElement.trigger("ChartSettingsChanged", [OHLCChart.GetAllSettingsProperty(), OHLCChart]);
    }
    function TrigAfterDraw() {
        OHLCChart.ParentELement.trigger("ChartAfterDraw", [OHLCChart.VisualToolsCanvas, OHLCChart.ctxIndicatorTopCanvas, OHLCChart.ctxIndicatorBotCanvas, OHLCChart.ChartOtherProperties.ChartData, OHLCChart]);
    }
    function TrigBarsUpdate() {
        OHLCChart.ParentELement.trigger("BarUpdate", [OHLCChart.ctxIndicatorTopCanvas, OHLCChart.ctxIndicatorBotCanvas, OHLCChart.ChartOtherProperties.ChartData, OHLCChart]);
    }
    function TrigFrontDataAdded() {
        OHLCChart.ParentELement.trigger("FrontDataAdded", [OHLCChart.ctxIndicatorTopCanvas, OHLCChart.ctxIndicatorBotCanvas, OHLCChart.ChartOtherProperties.ChartData, OHLCChart]);
    }
    function TrigHistoryDataAdded() {
        OHLCChart.ParentELement.trigger("HistoryDataAdd", [OHLCChart.ctxIndicatorTopCanvas, OHLCChart.ctxIndicatorBotCanvas, OHLCChart.ChartOtherProperties.ChartData, OHLCChart]);
    }
    function TrigSymbolChanged() {
        OHLCChart.ParentELement.trigger("SymbolChanged", [OHLCChart.VisualToolsCanvas, OHLCChart.ctxIndicatorTopCanvas, OHLCChart.ctxIndicatorBotCanvas, OHLCChart.ChartOtherProperties.ChartData, OHLCChart]);
    }
    function TrigTimeFrameChanged() {
        OHLCChart.ParentELement.trigger("TimeFrameChanged", [OHLCChart.VisualToolsCanvas, OHLCChart.ctxIndicatorTopCanvas, OHLCChart.ctxIndicatorBotCanvas, OHLCChart.ChartOtherProperties.ChartData, OHLCChart]);
    }
    function TrigGraphTypeChanged() {
        OHLCChart.ParentELement.trigger("GraphTypeChanged", [OHLCChart.VisualToolsCanvas, OHLCChart.ctxIndicatorTopCanvas, OHLCChart.ctxIndicatorBotCanvas, OHLCChart.ChartOtherProperties.ChartData, OHLCChart]);
    }
    function TrigChartMouseUp(XAxis, YAxis) {
        OHLCChart.ParentELement.trigger("ChartMouseUp", [OHLCChart.VisualToolsCanvas, XAxis, YAxis, OHLCChart.ChartOtherProperties.ChartData[OHLCChart.ComputationProperties.dataNumber], OHLCChart]);
    }
    function TrigChartMouseDown(XAxis, YAxis) {
        OHLCChart.ParentELement.trigger("ChartMouseDown", [OHLCChart.VisualToolsCanvas, XAxis, YAxis, OHLCChart.ChartOtherProperties.ChartData[OHLCChart.ComputationProperties.dataNumber], OHLCChart]);
    }
    function TrigChartMouseMove(XAxis, YAxis) {
        OHLCChart.ParentELement.trigger("ChartMouseMove", [OHLCChart.VisualToolsCanvas, XAxis, YAxis, OHLCChart.ChartOtherProperties.ChartData[OHLCChart.ComputationProperties.dataNumber], OHLCChart]);
    }
    function TrigChartDragged() {
        OHLCChart.ParentELement.trigger("ChartDragged", [OHLCChart.VisualToolsCanvas, OHLCChart.ctxIndicatorTopCanvas, OHLCChart.ctxIndicatorBotCanvas, OHLCChart.ChartOtherProperties.ChartData, OHLCChart]);
    }
    function TrigScrollDragged() {
        OHLCChart.ParentELement.trigger("ScrollDragged", [OHLCChart.VisualToolsCanvas, OHLCChart.ctxIndicatorTopCanvas, OHLCChart.ctxIndicatorBotCanvas, OHLCChart.ChartOtherProperties.ChartData, OHLCChart]);
    }
    function TrigSymbolDropped(strDraggedSymbol) {
        OHLCChart.ParentELement.trigger("SymbolDropped", strDraggedSymbol);
    }
    function TrigCorrelationDrop(strSymbol1, strSymbol2) {
        OHLCChart.ParentELement.trigger("CorrelationDrop", [{ Symbol1: strSymbol1, Symbol2: strSymbol2 }]);
    }
    function TrigChartMouseWheel() {
        OHLCChart.ParentELement.trigger("ChartMouseWheel", [OHLCChart.VisualToolsCanvas, OHLCChart.ctxIndicatorTopCanvas, OHLCChart.ctxIndicatorBotCanvas, OHLCChart.ChartOtherProperties.ChartData, OHLCChart, OHLCChart.ChartOtherProperties.HoveredXaxis]);
    }
    function TrigChartMouseLeave() {
        OHLCChart.ParentELement.trigger("ChartMouseLeave", []);
    }
    function TrigChartSizeChanged() {
        OHLCChart.ParentELement.trigger("ChartSizeChanged", [OHLCChart.VisualToolsCanvas, OHLCChart.ctxIndicatorTopCanvas, OHLCChart.ctxIndicatorBotCanvas, OHLCChart.ChartOtherProperties.ChartData, OHLCChart]);
    }
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    //~~~~~~~~~~~~~Public Methods~~~~~~~~~~~~~~~~~~~
    OHLCChart.OnSymbolChanged = [];

    OHLCChart.OnTimeFrameChanged = [];

    OHLCChart.ShowHideBidLine = function () {
        if (OHLCChart.ChartSettings.IsBidLineVisible) {
            OHLCChart.ChartSettings.IsBidLineVisible = false;
        }
        else {
            OHLCChart.ChartSettings.IsBidLineVisible = true;
        }
        if (IsChartReady()) {
            if (OHLCChart.ChartSettings.IsBidLineVisible) {
                ShowBidLine(OHLCChart.ChartOtherProperties.BidValue);
            }
            else {
                BidDataIndicator.css({ display: "none" });
                BidLineIndicator.css({ display: "none" });
            }
        }
        TrigSettingsChanged();
    };

    OHLCChart.ShowHideAskLine = function () {
        if (OHLCChart.ChartSettings.IsAskLineVisible) {
            OHLCChart.ChartSettings.IsAskLineVisible = false;
        }
        else {
            OHLCChart.ChartSettings.IsAskLineVisible = true;
        }
        if (IsChartReady()) {
            ShowAskLine(OHLCChart.ChartOtherProperties.AskValue);
            if (!OHLCChart.ChartSettings.IsAskLineVisible) {
                AskDataIndicator.css({ display: "none" });
                AskLineIndicator.css({ display: "none" });
            }
        }
        TrigSettingsChanged();
    };

    OHLCChart.ChangeTimeFrame = function (Time) {
        if (OHLCChart.ChartSettings.TimeFrame === Time) {
            return;
        }
        LoadingHolder.css({ display: "block" });
        ScrollBarMainHolder.css({ display: "none" });
        AskLineIndicator.css({ display: "none" });
        AskDataIndicator.css({ display: "none" });
        BidLineIndicator.css({ display: "none" });
        BidDataIndicator.css({ display: "none" });
        PriceData.css({ 'display': 'none' });
        OHLCChart.ChartSettings.TimeFrame = Time;
        OHLCChart.ChartValidationsProperties.isDataReady = false;
        var isNewDataAdded = false;
        OHLCChart.ComputationProperties.DataStartInternal = 0;
        IsChartNeedToDraw = true;
        RemoveAllElementsNeeded();
        RemoveAllElementsNeededStopLimitOrders();
        OHLCChart.ChartOtherProperties.ChartData = [];
        BarsViewModel.RequestLastBarStamp(OHLCChart.ChartSettings.Symbol, OHLCChart.ChartSettings.TimeFrame, SetLastDateOfBars);
        var BarsModelLength = BarsViewModel.BarsDataHolder().length;
        OHLCChart.ChartValidationsProperties.isRequestingAdditionalData = false;
        for (var i = 0; i < BarsModelLength; i++) {
            if (BarsViewModel.BarsDataHolder()[i].Symbol === OHLCChart.ChartSettings.Symbol && BarsViewModel.BarsDataHolder()[i].TimeFrame === OHLCChart.ChartSettings.TimeFrame) {
                OHLCChart.ChartOtherProperties.ChartData = BarsViewModel.BarsDataHolder()[i].Data();
                isNewDataAdded = true;
                OHLCChart.ChartValidationsProperties.isDataReady = true;
            }
        }
        IsTimeFrameChanged = true;
        if (!isNewDataAdded) {
            RequestData();
            OHLCChart.DrawBaseChartWithOutData();
        }
        else {
            OHLCChart.DrawOHLCChart();
            ShowBidLine(OHLCChart.ChartOtherProperties.BidValue);
            ShowAskLine(OHLCChart.ChartOtherProperties.AskValue);
        }
        SubscribeWhenToDraw();
        TrigSettingsChanged();
        $.each(OHLCChart.OnTimeFrameChanged, function (i, f) { if ($.isFunction(f)) f(Time); });
        SetCorrelationText();
    };

    OHLCChart.SetTradePanelVisibility = function () {
        if (OHLCChart.ChartSettings.IsTradePanelVisible) {
            OHLCChart.ChartSettings.IsTradePanelVisible = false;
            TradePanel.css({ display: "none" });
        }
        else {
            OHLCChart.ChartSettings.IsTradePanelVisible = true;
            TradePanel.css({ display: "block" });
        }
        TrigSettingsChanged();
    };

    OHLCChart.SetPeriodSeparatorVisibility = function () {
        if (OHLCChart.ChartSettings.IsPeriodSeparator) {
            OHLCChart.ChartSettings.IsPeriodSeparator = false;
        }
        else {
            OHLCChart.ChartSettings.IsPeriodSeparator = true;
        }
        IsChartNeedToDraw = true;
        OHLCChart.DrawOHLCChart();
        TrigSettingsChanged();
    };

    OHLCChart.SetVolumeVisibility = function () {
        if (OHLCChart.ChartSettings.IsVolumeVisible) {
            OHLCChart.ChartSettings.IsVolumeVisible = false;
        }
        else {
            OHLCChart.ChartSettings.IsVolumeVisible = true;
        }
        IsChartNeedToDraw = true;
        OHLCChart.DrawOHLCChart();
        TrigSettingsChanged();
    };

    OHLCChart.DrawVolume = function (XPosition, Volume) {
        OHLCChart.ctxVolume.beginPath();
        OHLCChart.ctxVolume.strokeStyle = OHLCChart.ChartSettings.Volumes;
        OHLCChart.ctxVolume.moveTo(XPosition, OHLCChart.ComputationProperties.height);
        OHLCChart.ctxVolume.lineTo(XPosition, ((OHLCChart.ComputationProperties.VolumeYmax - Volume) * OHLCChart.stepsVolume) + OHLCChart.DrawingHeightWithVolume);
        OHLCChart.ctxVolume.stroke();
    };

    OHLCChart.ChangeSymbol = function (Symbol) {
        LoadingHolder.css({ display: "block" });
        ScrollBarMainHolder.css({ display: "none" });
        AskLineIndicator.css({ display: "none" });
        AskDataIndicator.css({ display: "none" });
        BidLineIndicator.css({ display: "none" });
        BidDataIndicator.css({ display: "none" });
        PriceData.css({ 'display': 'none' });
        OHLCChart.ChartSettings.Symbol = Symbol;
        OHLCChart.ChartValidationsProperties.isDataReady = false;
        OHLCChart.ChartValidationsProperties.isDigitsReady = false;
        OHLCChart.ComputationProperties.DataStartInternal = 0;
        SetDigits();

        var isNewDataAdded = false;
        IsChartNeedToDraw = true;
        RemoveAllElementsNeeded();
        RemoveAllElementsNeededStopLimitOrders();
        OHLCChart.ChartOtherProperties.ChartData = [];
        BarsViewModel.RequestLastBarStamp(OHLCChart.ChartSettings.Symbol, OHLCChart.ChartSettings.TimeFrame, SetLastDateOfBars);
        var BarsModelLength = BarsViewModel.BarsDataHolder().length;
        OHLCChart.ChartValidationsProperties.isRequestingAdditionalData = false;
        for (var i = 0; i < BarsModelLength; i++) {
            if (BarsViewModel.BarsDataHolder()[i].Symbol === OHLCChart.ChartSettings.Symbol && BarsViewModel.BarsDataHolder()[i].TimeFrame === OHLCChart.ChartSettings.TimeFrame) {
                OHLCChart.ChartOtherProperties.ChartData = BarsViewModel.BarsDataHolder()[i].Data();
                OHLCChart.ChartValidationsProperties.isDataReady = true;
                isNewDataAdded = true;
            }
        }
        IsSymbolChanged = true;
        if (!isNewDataAdded) {
            RequestData();
            OHLCChart.DrawBaseChartWithOutData();
        }
        else {
            OHLCChart.DrawOHLCChart();
            ShowBidLine(OHLCChart.ChartOtherProperties.BidValue);
            ShowAskLine(OHLCChart.ChartOtherProperties.AskValue);
        }
        SubscribeWhenToDrawFunction();
        $.each(OHLCChart.OnSymbolChanged, function (i, f) { if ($.isFunction(f)) f(Symbol); });
        TrigSettingsChanged();
        SetCorrelationText();
    };

    OHLCChart.GetXAxis = function (DateTime) {
        if (!IsChartReady()) {
            return null;
        }
        if ((DateTime instanceof Date && !isNaN(DateTime.valueOf()))) {
            //Convert Time Frame to MiliSeconds
            var ToMiliSec = OHLCChart.ChartSettings.TimeFrame * 60000;
            //Get the Request Date Miliseconds
            var DateToLocate = DateTime.getTime();
            //Get the FirstData Stamp MiliSeconds
            var DataFirstDate = ISOStringToDate(OHLCChart.ChartOtherProperties.ChartData[0].Stamp()).getTime();
            //Get the difference between Request Data and the First Data In chart (MiliSeconds)
            var DifferenceToFirstDate = DataFirstDate - DateToLocate;
            //Compute the Index Result
            var IndexResult = DifferenceToFirstDate / ToMiliSec;
            //Math the Index Computed
            IndexResult = Math.floor(IndexResult);
            //Validation if the IndexResult Exceeds the Lenght of data available
            if (IndexResult >= OHLCChart.ComputationProperties.DataLength) {
                IndexResult = OHLCChart.ComputationProperties.DataLength - 1;
            }

            if (IndexResult < 0) {
                IndexResult = 0;
            }
            var DateOfComputedIndex = ISOStringToDate(OHLCChart.ChartOtherProperties.ChartData[IndexResult].Stamp());
            if (typeof DateOfComputedIndex !== "undefined") {
                var i;
                if (DateOfComputedIndex.getTime() < DateTime.getTime()) {
                    for (i = IndexResult - 1; i >= 0; i--) {
                        var ConvertTolMiliSec = ISOStringToDate(OHLCChart.ChartOtherProperties.ChartData[i].Stamp()).getTime();
                        var ConvertTolMiliSecNextData;
                        if (i - 1 < 0) {
                            ConvertTolMiliSecNextData = new Date(ISOStringToDate(OHLCChart.ChartOtherProperties.ChartData[i].Stamp()).getTime() + ToMiliSec);
                        }
                        else {
                            ConvertTolMiliSecNextData = ISOStringToDate(OHLCChart.ChartOtherProperties.ChartData[i - 1].Stamp()).getTime();
                        }
                        var MilOfDateToGet = DateTime.getTime();
                        if (ConvertTolMiliSec === DateTime.getTime()) {
                            IndexResult = i;
                            break;
                        }
                        if (MilOfDateToGet >= ConvertTolMiliSec && MilOfDateToGet < ConvertTolMiliSecNextData) {
                            IndexResult = i - 1;
                            break;
                        }
                    }
                }
                else if (DateOfComputedIndex.getTime() > DateTime.getTime()) {
                    for (i = IndexResult; i < OHLCChart.ComputationProperties.DataLength; i++) {
                        var ConvertTolMiliSec = ISOStringToDate(OHLCChart.ChartOtherProperties.ChartData[i].Stamp()).getTime();
                        var ConvertTolMiliSecNextData;
                        if (i - 1 < 0) {
                            ConvertTolMiliSecNextData = new Date(ISOStringToDate(OHLCChart.ChartOtherProperties.ChartData[i].Stamp()).getTime() + ToMiliSec);
                        }
                        else {
                            ConvertTolMiliSecNextData = ISOStringToDate(OHLCChart.ChartOtherProperties.ChartData[i - 1].Stamp()).getTime();
                        }

                        var MilOfDateToGet = DateTime.getTime();
                        if (ConvertTolMiliSec === DateTime.getTime()) {
                            IndexResult = i;
                            break;
                        }
                        if (MilOfDateToGet >= ConvertTolMiliSec && MilOfDateToGet < ConvertTolMiliSecNextData) {
                            IndexResult = i - 1;
                            break;
                        }
                    }
                }
            }

            DateOfComputedIndex = null;
            DateTime = null;
            var TempWidth = OHLCChart.ComputationProperties.width;
            var TempMarginOfBar = OHLCChart.ComputationProperties.MarginOfBar;
            if (OHLCChart.ComputationProperties.DataLength < OHLCChart.ComputationProperties.NumbersOfVisibleBars && OHLCChart.ChartValidationsProperties.isDataReady) {
                TempWidth = OHLCChart.ComputationProperties.XPositionFirstData;
                TempMarginOfBar = 0;
            }
            //Compute the Position in the chart
            var Position = TempWidth - OHLCChart.ComputationProperties.BarSpace * (IndexResult + TempMarginOfBar - OHLCChart.ComputationProperties.DataStartInternal);
            //console.log(IndexResult + " " + Position);
            //Return The Computed X Position in the Chart
            return Math.round(Position);
        }
        else {
            console.log("Invalid Date: " + DateTime);
            return null;
        }
    };

    OHLCChart.GetYaxis = function (Price) {
        if (typeof Price === "number") {
            if (!IsChartReady()) {
                return -1;
            }
            var YAxis = (OHLCChart.ComputationProperties.yMax - Price) * OHLCChart.ComputationProperties.steps;
            return Math.round(YAxis);
        }
        else {
            console.log("Invalid Number: " + Price);
            return null;
        }
    };

    OHLCChart.GetPrice = function (YAxis) {
        if (typeof YAxis === "number") {
            if (!IsChartReady()) {
                return null;
            }
            var Price;
            if (!OHLCChart.ChartSettings.IsVolumeVisible) {
                Price = ((OHLCChart.ComputationProperties.height - YAxis) / OHLCChart.ComputationProperties.steps) + OHLCChart.ComputationProperties.yMin;
            }
            else {
                Price = ((OHLCChart.DrawingHeightWithVolume - YAxis) / OHLCChart.ComputationProperties.steps) + OHLCChart.ComputationProperties.yMin;
            }
            return Price;
        }
        else {
            console.log("Invalid Number: " + YAxis);
            return null;
        }
    };

    OHLCChart.GetDate = function (XAxis) {
        if (typeof XAxis === "number") {
            if (!IsChartReady()) {
                return null;
            }
            var IndexNumber;
            IndexNumber = GetIndexOfData(XAxis);
            var DateOfIndex;

            if (IndexNumber < 0) {
                IndexNumber = 0;
            }

            if (IndexNumber >= OHLCChart.ComputationProperties.DataLength) {
                IndexNumber = OHLCChart.ComputationProperties.DataLength - 1;
            }
            DateOfIndex = ISOStringToDate(OHLCChart.ChartOtherProperties.ChartData[IndexNumber].Stamp());
            return DateOfIndex;
        }
        else {
            console.log("Invalid Number: " + XAxis);
            return null;
        }
    };

    OHLCChart.SetOtherChartEvents = function () {
        $(OHLCChart.ParentELement).find('.VisualToolsCanvas').hover(function () {
        }, function () {
            mastercontainterverticalmarker.css({ display: "none" });
            HorizontalLineIndicator.css({ display: "none" });
            RightIndicator.css({ display: "none" });
            BottomIndicator.css({ display: "none" });
            BarHoveredEffectElement.css({ display: "none" });
            LegendHolder.css({ display: "none" });
            ClearDrawingHoveredEffectLineGraph();
            OHLCChart.ChartValidationsProperties.stillDown = false;
            CheckHoveredTrades(OHLCChart.ComputationProperties.height);
            CheckHoveredStopLimitOrders(OHLCChart.ComputationProperties.height);
            SetArrowStyleToolTipText(false);
            LeftDataContainer.css('display', 'none');
            TrigChartMouseLeave();
        });

        $(OHLCChart.ParentELement).find('.DraggingCanvas').hover(function () {
        }, function () {
            DraggedAdjustPrice = false;
        });

        //TradePanel.hover(function () {
        //    CollapseTradePanel();
        //}, function () {
        //    if (!IsTradePanelEditing) {
        //        UnCollapseTradePanel();
        //    }
        //});

        $(OHLCChart.ParentELement).find('.VisualToolsCanvas').mousewheel(function (event) {
            if (!OHLCChart.ChartValidationsProperties.IsDraggable) {
                return;
            }
            if (typeof (OHLCChart.ChartOtherProperties.ChartData) === 'undefined') {
                return;
            }
            if (!IsChartReady()) {
                return;
            }
            BarHoveredEffectElement.css({ display: "none" });
            LegendHolder.css({ display: "none" });
            if (event.deltaY === 1) {
                if (OHLCChart.ChartSettings.ZoomLevel !== 0) {
                    OHLCChart.ChartSettings.ZoomLevel = OHLCChart.ChartSettings.ZoomLevel - 1;
                }
            }
            if (event.deltaY === -1) {
                if (OHLCChart.ChartSettings.ZoomLevel !== 4) {
                    OHLCChart.ChartSettings.ZoomLevel = OHLCChart.ChartSettings.ZoomLevel + 1;
                }
            }
            if (OHLCChart.ChartSettings.ZoomLevel !== 5) {
                IsDragRedraw = true;
                OHLCChart.DrawOHLCChart();
            }

            SetZoomItemMenuValue();
            SetArrowStyleToolTipText(false);
            TrigSettingsChanged();

            if (OHLCChart.ComputationProperties.DataLength < OHLCChart.ComputationProperties.NumbersOfVisibleBars && OHLCChart.ChartValidationsProperties.isDataReady) {
                HideChartMarkers();
            }
            if (OHLCChart.ChartSettings.IsChartMarkerVisible) {
                OHLCChart.ComputationProperties.dataNumber = GetIndexOfData(OHLCChart.ChartOtherProperties.HoveredXaxis);
                ReComputeComputedHightWidthOfMarker();
            }
            TrigChartMouseWheel();
        });

        OHLCChart.ParentELement.parent().find('div.ScrollLeftArrow').click(function () {
            if (!IsChartReady()) {
                return;
            }
            if (OHLCChart.ComputationProperties.DataStartInternal + OHLCChart.ComputationProperties.NumbersOfVisibleBars < OHLCChart.ComputationProperties.DataLength) {
                OHLCChart.ComputationProperties.DataStartInternal = OHLCChart.ComputationProperties.DataStartInternal + 1;
                IsDragRedraw = true;
                OHLCChart.DrawOHLCChart();
            }
            CheckDataIfNeedsToRequest(false);
            TrigScrollDragged();
        });

        OHLCChart.ParentELement.parent().find('div.ScrollRightArrow').click(function () {
            if (!IsChartReady()) {
                return;
            }
            if (OHLCChart.ComputationProperties.DataStartInternal - 1 >= 0) {
                OHLCChart.ComputationProperties.DataStartInternal = OHLCChart.ComputationProperties.DataStartInternal - 1;
                IsDragRedraw = true;
                OHLCChart.DrawOHLCChart();
            }
            CheckDataIfNeedsToRequest(false);
            TrigScrollDragged();
        });

        $(document).on('click', function (e) {
            if (e.target.id !== "VolumeSpinner" && e.target.className !== "ui-icon ui-icon-triangle-1-n" && e.target.className !== "ui-icon ui-icon-triangle-1-s" && e.target.id !== "SellImageTradePanel" && e.target.id !== "SellPriceTradePanel" && e.target.id !== "SellLabelTradePanel" && e.target.id !== "BuyImageTradePanel" && e.target.id !== "BuyPriceTradePanel" && e.target.id !== "BuyLabelTradePanel") {
                IsTradePanelEditing = false;
                UnCollapseTradePanel();
            }
        });

        VolumeSpinner.on('click', function () {
            IsTradePanelEditing = true;
        });

        OHLCChart.ParentELement.parent().find('.VisualToolsCanvas').click(function () {
            if (CurrentSelectedStopLimit !== "") {
                var MainElement = OHLCChart.BaseChartElement.find('[StopLimitOrderID="' + CurrentSelectedStopLimit + '"]');
                var width = MainElement.width();
                if (OHLCChart.ChartOtherProperties.HoveredXaxis >= width - MainElement.find('.BorderStopLimitOrders').width() - MainElement.find('.StopLimitOrdersCloseButton').width() && OHLCChart.ChartOtherProperties.HoveredXaxis <= width) {
                    WC.TM.ComObject.Trigger("showCancelOrderForm", CurrentSelectedStopLimit);
                    isReCreateData = true;
                }
            }
            else {
                if (CurrentSelectedTrades !== "") {
                    var MainElement = OHLCChart.BaseChartElement.find('[TradeID="' + CurrentSelectedTrades + '"]');
                    var width = MainElement.width();
                    if (OHLCChart.ChartOtherProperties.HoveredXaxis >= width - MainElement.find('.BorderTrades').width() - MainElement.find('.TradesCloseButton').width() && OHLCChart.ChartOtherProperties.HoveredXaxis <= width) {
                        WC.TM.ComObject.Trigger("closeTrade", CurrentSelectedTrades);
                        isReCreateData = true;
                    }
                }
            }
            IsTradePanelEditing = false;
            UnCollapseTradePanel();
            var SpinnerVal = VolumeSpinner.val();
            if (SpinnerVal === "") {
                VolumeSpinner.val("0.01");
            }
        });
    };

    OHLCChart.LowerIndicatorChartZoom = function (event) {
        if (!OHLCChart.ChartValidationsProperties.IsDraggable) {
            return;
        }
        if (typeof (OHLCChart.ChartOtherProperties.ChartData) === 'undefined') {
            return;
        }
        if (!IsChartReady()) {
            return;
        }
        BarHoveredEffectElement.css({ display: "none" });
        LegendHolder.css({ display: "none" });
        if (event.deltaY === 1) {
            if (OHLCChart.ChartSettings.ZoomLevel !== 0) {
                OHLCChart.ChartSettings.ZoomLevel = OHLCChart.ChartSettings.ZoomLevel - 1;
            }
        }
        if (event.deltaY === -1) {
            if (OHLCChart.ChartSettings.ZoomLevel !== 4) {
                OHLCChart.ChartSettings.ZoomLevel = OHLCChart.ChartSettings.ZoomLevel + 1;
            }
        }
        if (OHLCChart.ChartSettings.ZoomLevel !== 5) {
            IsDragRedraw = true;
            OHLCChart.DrawOHLCChart();
        }

        ToolZoomChart.slider("value", 4 - OHLCChart.ChartSettings.ZoomLevel);
        SetArrowStyleToolTipText(false);
    };

    OHLCChart.BringVisualToolsCanvasFront = function () {
        zIndexVisualTools = 9;
        $(OHLCChart.ParentELement).find('.canvas-container canvas').css("z-index", zIndexVisualTools);
    };

    OHLCChart.BringVisualToolsCanvasBack = function () {
        zIndexVisualTools = 7;
        $(OHLCChart.ParentELement).find('.canvas-container canvas').css("z-index", zIndexVisualTools);
    };

    OHLCChart.GetMouseObjectInfo = function (X, Y) {
        var IndexResult = GetIndexOfData(X);
        return { Bar: OHLCChart.ChartOtherProperties.ChartData[IndexResult], Price: OHLCChart.GetPrice(Y) };
    };

    OHLCChart.SeIsConnectedState = function (isConnected) {
        _isConnected = isConnected;
        DisableTradePanel();
    };

    OHLCChart.RefreshChartData = function () {
        OHLCChart.ChartOtherProperties.ChartData = [];
        _refreshingData = true;
        LoadingHolder.css({ display: "block" });
        ScrollBarMainHolder.css({ display: "none" });
        AskLineIndicator.css({ display: "none" });
        AskDataIndicator.css({ display: "none" });
        BidLineIndicator.css({ display: "none" });
        BidDataIndicator.css({ display: "none" });
        RemoveAllElementsNeededStopLimitOrders();
        RemoveAllElementsNeeded();
        OHLCChart.ComputationProperties.DataStartInternal = 0;
        HideChartMarkers();
        OHLCChart.DrawBaseChartWithOutData();
        if (DrawArraySub !== null) {
            DrawArraySub.dispose();
        }

        if (DrawNoDataSub !== null) {
            DrawNoDataSub.dispose();
        }

        if (DrawCloseSub !== null) {
            DrawCloseSub.dispose();
        }
        RequestData(true, function () {
            _refreshingData = false;
            IsChartNeedToDraw = true;
            SubscribeWhenToDraw();
        });
    };

    OHLCChart.SetOHLCDataUpperLeftVisibility = function () {
        if (OHLCChart.ChartSettings.IsOHLCDigitsVisible) {
            OHLCChart.ChartSettings.IsOHLCDigitsVisible = false;
        }
        else {
            OHLCChart.ChartSettings.IsOHLCDigitsVisible = true;
        }
        TrigSettingsChanged();
    };

    OHLCChart.ShowLegend = function (X, Y) {
        if (!OHLCChart.ChartSettings.IsLegendVisible) {
            return;
        }
        var TempWidth = OHLCChart.ComputationProperties.width;
        if (OHLCChart.ComputationProperties.DataLength < OHLCChart.ComputationProperties.NumbersOfVisibleBars && OHLCChart.ChartValidationsProperties.isDataReady) {
            TempWidth = OHLCChart.ComputationProperties.XPositionFirstData;
        }
        if (GetIndexOfData(OHLCChart.ChartOtherProperties.HoveredXaxis, true) < 0 || OHLCChart.ChartOtherProperties.HoveredXaxis >= TempWidth + (OHLCChart.ComputationProperties.BarSpace / 2) || GetIndexOfData(OHLCChart.ChartOtherProperties.HoveredXaxis, true) > OHLCChart.ComputationProperties.DataLength - 1) {
            LegendHolder.css({ display: "none" });
            return;
        }
        if (OHLCChart.ChartOtherProperties.ChartData) {
            if (OHLCChart.ChartOtherProperties.ChartData.length === 0) {
                return;
            }
        }
        var Index = GetIndexOfData(X);
        //validation if datanumber is greater than the length data it causes an error
        if (Index < OHLCChart.ComputationProperties.DataStartInternal || Index > OHLCChart.ComputationProperties.DataLength - 1 || X >= TempWidth + (OHLCChart.ComputationProperties.BarSpace / 2)) {
            BarHoveredEffectElement.css({ display: "none" });
            LegendHolder.css({ display: "none" });
            HorizontalLineIndicator.css({ display: "none" });
            RightIndicator.css({ display: "none" });
            return;
        }

        //Variables Needed
        var LeftPositionBarHoveredEffect = Math.round(((TempWidth - OHLCChart.ComputationProperties.BarSpace * ((Index) - OHLCChart.ComputationProperties.DataStartInternal)) - (OHLCChart.ChartOtherProperties.dataAdded * OHLCChart.ComputationProperties.DefaultBarsWidth)) - ((OHLCChart.ComputationProperties.BarSpace - OHLCChart.ComputationProperties.barsMargin) / 2));
        var WidthOfBarHoveredEffect = Math.round(OHLCChart.ComputationProperties.BarSpace - OHLCChart.ComputationProperties.barsMargin) - 2;
        var TopPositionOfBarHoveredEffect;
        var HeightOfBarHoveredEffect;
        var LegendsWidth = LegendHolder.width();
        var LegendsHeight = LegendHolder.height();

        if (OHLCChart.ChartOtherProperties.ChartData[Index].Open() <= OHLCChart.ChartOtherProperties.ChartData[Index].Close()) {
            TopPositionOfBarHoveredEffect = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Close());
            HeightOfBarHoveredEffect = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Open()) - OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Close());
        }
        else {
            TopPositionOfBarHoveredEffect = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Open());
            HeightOfBarHoveredEffect = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Close()) - OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Open());
        }

        TopPositionOfBarHoveredEffect = TopPositionOfBarHoveredEffect - 1;
        LeftPositionBarHoveredEffect = LeftPositionBarHoveredEffect - 1;

        HeightOfBarHoveredEffect = HeightOfBarHoveredEffect - 2;
        //Showing Legend for Line Chart it is really different from the other chart type
        if (Index < OHLCChart.ComputationProperties.DataLength && Index >= 0) {
            if (OHLCChart.ChartSettings.GraphType === "LineChart") {
                if ((OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Close()) - 2) <= Y && (OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Close()) + 2) >= Y) {
                    ValidationForLegendToPreventOverlapping(LegendsWidth, LegendsHeight, X, Y);
                    DisplayDataInLegend();
                    DrawCircleIndicatorOfLineChartWhenHovered();
                }
                else {
                    BarHoveredEffectElement.css({ display: "none" });
                    LegendHolder.css({ display: "none" });
                    ClearDrawingHoveredEffectLineGraph();
                }
            }
            else {
                if (OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Open()) <= Y && OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Close()) >= Y) {
                    ValidationForLegendToPreventOverlapping(LegendsWidth, LegendsHeight, X, Y);
                    DisplayDataInLegend();
                    //BarHoveredEffect Should be half of its width
                    ValidationForChartHoveredEffect(HeightOfBarHoveredEffect, WidthOfBarHoveredEffect, LeftPositionBarHoveredEffect, TopPositionOfBarHoveredEffect);
                }
                else if (OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Close()) <= Y && OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Open()) >= Y) {
                    ValidationForLegendToPreventOverlapping(LegendsWidth, LegendsHeight, X, Y);
                    DisplayDataInLegend();
                    //BarHoveredEffect Should be half of its width
                    ValidationForChartHoveredEffect(HeightOfBarHoveredEffect, WidthOfBarHoveredEffect, LeftPositionBarHoveredEffect, TopPositionOfBarHoveredEffect);
                }
                else if ((OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Close()) - 1) <= Y && (OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[Index].Open()) + 1) >= Y) {
                    ValidationForLegendToPreventOverlapping(LegendsWidth, LegendsHeight, X, Y);
                    DisplayDataInLegend();
                    //BarHoveredEffect Should be half of its width
                    ValidationForChartHoveredEffect(HeightOfBarHoveredEffect, WidthOfBarHoveredEffect, LeftPositionBarHoveredEffect, TopPositionOfBarHoveredEffect);
                }
                else {
                    BarHoveredEffectElement.css({ display: "none" });
                    LegendHolder.css({ display: "none" });
                }
            }
        }
    };

    OHLCChart.SetLineStyleTrades = function () {
        OHLCChart.ChartSettings.IsOpenTradeVisible = true;
        if (!OHLCChart.ChartSettings.IsLineStyle) {
            OHLCChart.ChartSettings.IsLineStyle = true;
            OHLCChart.ChartSettings.IsArrowStyle = false;
            IsChartNeedToDraw = true;
            isReCreateData = true;
            OHLCChart.DrawOHLCChart();
        }
        TrigSettingsChanged();
    };

    OHLCChart.SetArrowStyleTrades = function () {
        OHLCChart.ChartSettings.IsOpenTradeVisible = true;
        if (!OHLCChart.ChartSettings.IsArrowStyle) {
            OHLCChart.ChartSettings.IsArrowStyle = true;
            OHLCChart.ChartSettings.IsLineStyle = false;
            IsChartNeedToDraw = true;
            RemoveAllElementsNeeded();
            OHLCChart.DrawOHLCChart();
        }
        TrigSettingsChanged();
    };

    OHLCChart.SetTradesVisibility = function () {
        OHLCChart.ChartSettings.IsLineStyle = false;
        OHLCChart.ChartSettings.IsArrowStyle = false;
        if (OHLCChart.ChartSettings.IsOpenTradeVisible) {
            OHLCChart.ChartSettings.IsOpenTradeVisible = false;
            isReCreateData = true;
            IsChartNeedToDraw = true;
            OHLCChart.DrawOHLCChart();
        }
        TrigSettingsChanged();
    };

    OHLCChart.SetStopLimitVisibility = function () {
        if (OHLCChart.ChartSettings.IsOrdersVisible) {
            OHLCChart.ChartSettings.IsOrdersVisible = false;
            isReCreateDataStopLimitOrders = true;
            IsChartNeedToDraw = true;
            OHLCChart.DrawOHLCChart();
        }
        else {
            OHLCChart.ChartSettings.IsOrdersVisible = true;
            isReCreateDataStopLimitOrders = true;
            IsChartNeedToDraw = true;
            OHLCChart.DrawOHLCChart();
        }
        TrigSettingsChanged();
    };

    OHLCChart.SetMarkerVisibility = function () {
        if (OHLCChart.ChartSettings.IsChartMarkerVisible) {
            OHLCChart.ChartSettings.IsChartMarkerVisible = false;
        }
        else {
            OHLCChart.ChartSettings.IsChartMarkerVisible = true;
        }
        TrigSettingsChanged();
    };

    OHLCChart.SetLegendVisibility = function () {
        if (OHLCChart.ChartSettings.IsLegendVisible) {
            OHLCChart.ChartSettings.IsLegendVisible = false;
        }
        else {
            OHLCChart.ChartSettings.IsLegendVisible = true;
        }
        TrigSettingsChanged();
    };

    OHLCChart.ChangeGraphType = function (GraphType) {
        OHLCChart.ChartSettings.GraphType = GraphType;
        IsGraphTypeChange = true;
        ReloadChart();
        TrigSettingsChanged();
    };

    OHLCChart.ChangeBoxSize = function (BoxSize) {
        OHLCChart.ChartSettings.BoxSize = BoxSize;
        ReloadChart();
        TrigSettingsChanged();
    };

    OHLCChart.ChangeReversal = function (Reversal) {
        OHLCChart.ChartSettings.Reversal = Reversal;
        ReloadChart();
        TrigSettingsChanged();
    };

    OHLCChart.GetAllSettingsProperty = function () {
        return {
            IsOrdersVisible: OHLCChart.ChartSettings.IsOrdersVisible,
            IsLineStyle: OHLCChart.ChartSettings.IsLineStyle,
            IsArrowStyle: OHLCChart.ChartSettings.IsArrowStyle,
            IsOpenTradeVisible: OHLCChart.ChartSettings.IsOpenTradeVisible,
            IsVolumeVisible: OHLCChart.ChartSettings.IsVolumeVisible,
            IsPeriodSeparator: OHLCChart.ChartSettings.IsPeriodSeparator,
            IsTradePanelVisible: OHLCChart.ChartSettings.IsTradePanelVisible,
            Symbol: OHLCChart.ChartSettings.Symbol,
            TimeFrame: OHLCChart.ChartSettings.TimeFrame,
            BoxSize: OHLCChart.ChartSettings.BoxSize,
            Reversal: OHLCChart.ChartSettings.Reversal,
            ShowSymbolIndicator: OHLCChart.ChartSettings.ShowSymbolIndicator,
            IsOHLCDigitsVisible: OHLCChart.ChartSettings.IsOHLCDigitsVisible,
            IsBidLineVisible: OHLCChart.ChartSettings.IsBidLineVisible,
            IsAskLineVisible: OHLCChart.ChartSettings.IsAskLineVisible,
            IsLegendVisible: OHLCChart.ChartSettings.IsLegendVisible,
            GraphType: OHLCChart.ChartSettings.GraphType,
            ZoomLevel: OHLCChart.ChartSettings.ZoomLevel,
            IsChartMarkerVisible: OHLCChart.ChartSettings.IsChartMarkerVisible,
            IsChartDisplayVisible: ChartFormInstance.IsChartDisplayVisible,
            IsChartObjectsVisible: ChartFormInstance.IsChartObjectsVisible,
            IsVisualToolsVisible: ChartFormInstance.IsVisualToolsVisible,
            IsExplicitlySetChartDisplay: ChartFormInstance.IsExplicitlySetChartDisplay,
            IsExplicitlySetChartObjects: ChartFormInstance.IsExplicitlySetChartObjects,
            IsExplicitlySetVisualTools: ChartFormInstance.IsExplicitlySetVisualTools,
            BackGroundColor: OHLCChart.ChartSettings.BackGroundColor,
            BuysTradesColor: OHLCChart.ChartSettings.BuysTradesColor,
            ForeGround: OHLCChart.ChartSettings.ForeGround,
            Grid: OHLCChart.ChartSettings.Grid,
            HighLight: OHLCChart.ChartSettings.HighLight,
            Legend: OHLCChart.ChartSettings.Legend,
            Line: OHLCChart.ChartSettings.Line,
            LosingTrade: OHLCChart.ChartSettings.LosingTrade,
            Marker: OHLCChart.ChartSettings.Marker,
            NegativeFill: OHLCChart.ChartSettings.NegativeFill,
            NegativeLine: OHLCChart.ChartSettings.NegativeLine,
            Periods: OHLCChart.ChartSettings.Periods,
            PositiveFill: OHLCChart.ChartSettings.PositiveFill,
            PositiveLines: OHLCChart.ChartSettings.PositiveLines,
            SellsTradesColor: OHLCChart.ChartSettings.SellsTradesColor,
            Volumes: OHLCChart.ChartSettings.Volumes,
            WinningTrade: OHLCChart.ChartSettings.WinningTrade,
            IsOHLCDigitsBottomRight: OHLCChart.ChartSettings.IsOHLCDigitsBottomRight,
            ActiveIndicators: ChartFormInstance.ActiveIndicators,
            ActiveVisualTools: ChartFormInstance.ActiveVisualTools,
            IsAlwaysShowBidAsk: OHLCChart.ChartSettings.IsAlwaysShowBidAsk,
            WeeklyPeriod: OHLCChart.ChartSettings.WeeklyPeriod
        };
    };

    OHLCChart.DisposeChart = function () {
        _isAlreadyDisposed = true;
        if (DrawArraySub !== null) {
            DrawArraySub.dispose();
        }
        if (DrawCloseSub !== null) {
            DrawCloseSub.dispose();
        }
        if (DrawNoDataSub !== null) {
            DrawNoDataSub.dispose();
        }
        if (BidSubscription !== null) {
            BidSubscription.dispose();
        }
        if (BidMovementSubscription !== null) {
            BidMovementSubscription.dispose();
        }
        if (QuoteIsOpenSubscription !== null) {
            QuoteIsOpenSubscription.dispose();
        }
        if (AskSubscription !== null) {
            AskSubscription.dispose();
        }
        if (AskMovementSubscription !== null) {
            AskMovementSubscription.dispose();
        }
        if (OpenTradesSub !== null) {
            OpenTradesSub.dispose();
        }
        if (OrdersSub !== null) {
            OrdersSub.dispose();
        }
        if (DigitSubscription !== null) {
            DigitSubscription.dispose();
        }

        OpenTradesData = null;
        OrdersData = null;
        LoadingHolder = null;
        BottomIndicator = null;
        TradePanel = null;
        mastercontainterverticalmarker = null;
        BidLineIndicator = null;
        BidDataIndicator = null;
        AskLineIndicator = null;
        AskDataIndicator = null;
        HorizontalLineIndicator = null;
        RightIndicator = null;
        BarHoveredEffectElement = null;
        LegendHolder = null;
        LegendDateLabelHolder = null;
        LegendOpenLabelHolder = null;
        LegendHighLabelHolder = null;
        LegendLowLabelHolder = null;
        LegendCloseLabelHolder = null;
        LegendVolumeLabelHolder = null;
        VolumeSpinner = null;
        ArrowStyleToolTip = null;
        ArrowStyleToolTipLabel = null;
        RightIndicatorLabel = null;
        BottomIndicatorLabel = null;
        TradePanelSellSpan = null;
        TradePanelBuySpan = null;
        TradePanelSpinnerHolder = null;
        TradePanelSellButton = null;
        TradePanelBuyButton = null;
        TradePanelArrowButtonBuy = null;
        TradePanelArrowButtonSell = null;
        AskDataIndicatorLabel = null;
        BidDataIndicatorLabel = null;
        LeftDataContainer = null;
        OpenCloseHolder = null;
        ScrollBarMainHolder = null;
        ToolZoomChart = null;
        ChartScrollBarHolder = null;
        VisualToolsCanvas = null;
        OHLCChart = null;
    };

    OHLCChart.Resizemethod = function () {
        if (OHLCChart.ParentELement.parent().width() === 0) {
            return;
        }
        if (!IsChartReady()) {
            ComputeVariablesNeeded();
            OHLCChart.DrawBaseChartWithOutData();
        }
        else {
            IsChartNeedToDraw = true;
            OHLCChart.DrawOHLCChart();
            TrigChartSizeChanged();

        }
        SetPositionTradePanel();
    };

    OHLCChart.TriggerHoverOut = function () {
        TrigChartMouseLeave();
    };

    OHLCChart.HideMarkers = HideChartMarkers;

    OHLCChart.GetIndex = GetIndexOfData;

    OHLCChart.ChangeCorrelationNumberOfBars = function (count) {
        if (OHLCChart.ChartSettings.CorrelationNumberOfBars !== null) {
            OHLCChart.ChartSettings.CorrelationNumberOfBars = count;
            IsChartNeedToDraw = true;
            OHLCChart.DrawOHLCChart();
        }
    };

    OHLCChart.CorrelationReDraw = function () {
        IsChartNeedToDraw = true;
        OHLCChart.DrawOHLCChart();
    };

    OHLCChart.ColorSchemeChanged = function (strPropertyName, strValue) {
        OHLCChart.ChartSettings[strPropertyName] = strValue;
        OHLCChart.Resizemethod();
        TrigSettingsChanged();
        $(OHLCChart.GridLineCanvas).css({ 'background-color': OHLCChart.ChartSettings.BackGroundColor });
    };

    OHLCChart.RestoreDefaultColorScheme = function (obj) {
        for (var x in obj) {
            OHLCChart.ChartSettings[x] = obj[x];
        }
        OHLCChart.Resizemethod();
        TrigSettingsChanged();
        $(OHLCChart.GridLineCanvas).css({ 'background-color': OHLCChart.ChartSettings.BackGroundColor });
    }

    OHLCChart.SetDefaultColorScheme = function (str) {
        var obj = {};
        switch (str) {
            case "Basic":
                obj = OHLCChart.BasicColorScheme;
                break;

            case "GreenOnBlack":
                obj = OHLCChart.GreenOnBlackColorScheme;
                break;

            default:
                obj = OHLCChart.BasicColorScheme;
                break;
        }

        OHLCChart.ColorSchemeDefault = obj;

        for (var x in obj) {
            OHLCChart.ChartSettings[x] = obj[x];
        }
        OHLCChart.Resizemethod();
        TrigSettingsChanged();
        $(OHLCChart.GridLineCanvas).css({ 'background-color': OHLCChart.ChartSettings.BackGroundColor });
    }

    OHLCChart.GetColorSchemeObjects = function () {
        var GroupName = "ChartProperty";
        var PropertyaGridObject = {
            BackGroundColor: { group: GroupName, name: "Background", type: "color", options: { preferformat: "hex" } },
            BuysTradesColor: { group: GroupName, name: "Buys Color", type: "color", options: { preferformat: "hex" } },
            ForeGround: { group: GroupName, name: "Foreground", type: "color", options: { preferformat: "hex" } },
            Grid: { group: GroupName, name: "Grid", type: "color", options: { preferformat: "hex" } },
            HighLight: { group: GroupName, name: "Highlight", type: "color", options: { preferformat: "hex" } },
            Legend: { group: GroupName, name: "Legend", type: "color", options: { preferformat: "hex" } },
            Line: { group: GroupName, name: "Line Chart", type: "color", options: { preferformat: "hex" } },
            LosingTrade: { group: GroupName, name: "Losing Trade", type: "color", options: { preferformat: "hex" } },
            Marker: { group: GroupName, name: "Marker", type: "color", options: { preferformat: "hex" } },
            NegativeFill: { group: GroupName, name: "Negative Fill", type: "color", options: { preferformat: "hex" } },
            NegativeLine: { group: GroupName, name: "Negative Lines", type: "color", options: { preferformat: "hex" } },
            Periods: { group: GroupName, name: "Periods", type: "color", options: { preferformat: "hex" } },
            PositiveFill: { group: GroupName, name: "Positive Fill", type: "color", options: { preferformat: "hex" } },
            PositiveLines: { group: GroupName, name: "Positive Lines", type: "color", options: { preferformat: "hex" } },
            Sells: { group: GroupName, name: "Sells Color", type: "color", options: { preferformat: "hex" } },
            Volumes: { group: GroupName, name: "Volumes", type: "color", options: { preferformat: "hex" } },
            WinningTrade: { group: GroupName, name: "Winning Trade", type: "color", options: { preferformat: "hex" } }
        };
        var SetObjects = {
            BackGroundColor: OHLCChart.ChartSettings.BackGroundColor,
            BuysTradesColor: OHLCChart.ChartSettings.BuysTradesColor,
            ForeGround: OHLCChart.ChartSettings.ForeGround,
            Grid: OHLCChart.ChartSettings.Grid,
            HighLight: OHLCChart.ChartSettings.HighLight,
            Legend: OHLCChart.ChartSettings.Legend,
            Line: OHLCChart.ChartSettings.Line,
            LosingTrade: OHLCChart.ChartSettings.LosingTrade,
            Marker: OHLCChart.ChartSettings.Marker,
            NegativeFill: OHLCChart.ChartSettings.NegativeFill,
            NegativeLine: OHLCChart.ChartSettings.NegativeLine,
            Periods: OHLCChart.ChartSettings.Periods,
            PositiveFill: OHLCChart.ChartSettings.PositiveFill,
            PositiveLines: OHLCChart.ChartSettings.PositiveLines,
            SellsTradesColor: OHLCChart.ChartSettings.SellsTradesColor,
            Volumes: OHLCChart.ChartSettings.Volumes,
            WinningTrade: OHLCChart.ChartSettings.WinningTrade
        };
        return { MetaObject: PropertyaGridObject, SetObjects: SetObjects };
    }

    OHLCChart.SetAlwaysVisibleBidAsk = function () {
        if (OHLCChart.ChartSettings.IsAlwaysShowBidAsk) {
            OHLCChart.ChartSettings.IsAlwaysShowBidAsk = false;
        }
        else {
            OHLCChart.ChartSettings.IsAlwaysShowBidAsk = true;
        }

        OHLCChart.Resizemethod();
        TrigSettingsChanged();
    }

    OHLCChart.SetWeeklyPeriod = function (Day) {
        if (Day === "Monday") {
            OHLCChart.ChartSettings.WeeklyPeriod = 1;
        } else if (Day === "Tuesday") {
            OHLCChart.ChartSettings.WeeklyPeriod = 2;
        } else if (Day === "Wednesday") {
            OHLCChart.ChartSettings.WeeklyPeriod = 3;
        } else if (Day === "Thursday") {
            OHLCChart.ChartSettings.WeeklyPeriod = 4;
        } else if (Day === "Friday") {
            OHLCChart.ChartSettings.WeeklyPeriod = 5;
        }
        TrigSettingsChanged();
        OHLCChart.Resizemethod();
    }

    OHLCChart.SetPercentageOfZoom = SetPercentageOfZoom;

    OHLCChart.ChangeBarLegendText = function (txtOpen, txtHigh, txtLow, txtClose, txtVolume) {
        LegendHolder.find('div.OpenHolder div.OHLCLegend').text(txtOpen);
        LegendHolder.find('div.HighHolder div.OHLCLegend').text(txtHigh);
        LegendHolder.find('div.LowHolder div.OHLCLegend').text(txtLow);
        LegendHolder.find('div.CloseHolder div.OHLCLegend').text(txtClose);
        LegendHolder.find('div.VolumeHolder div.OHLCLegend').text(txtVolume);
    };

    SubscribeWhenToDrawFunction();

    $(OHLCChart.GridLineCanvas).css({ 'background-color': OHLCChart.ChartSettings.BackGroundColor });
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
};

WC.CM.CandleStick = function (OHLCChart, ShowPeriodFunction) {
    OHLCChart.ComputationProperties.MarginOfBar = OHLCChart.ChartOtherProperties.dataAdded;
    if (OHLCChart.ChartOtherProperties.dataAdded !== 0) {
        OHLCChart.ComputationProperties.MarginOfBar = OHLCChart.ChartOtherProperties.dataAdded + (OHLCChart.ComputationProperties.ZoomCollection[OHLCChart.ChartSettings.ZoomLevel] - 1);
    }

    var XPositionOfCandleStick = null;
    var BarYPositionOpen = null;
    var BarYPositionClose = null;
    var BarYPositionHigh = null;
    var BarYPositionLow = null;
    OHLCChart.LastSeparatorNumber = null;

    //Vertical Grid Lines
    if (OHLCChart.ComputationProperties.DataLength < OHLCChart.ComputationProperties.NumbersOfVisibleBars) {
        for (var i = OHLCChart.ComputationProperties.DataEndInternal - 1; i >= OHLCChart.ComputationProperties.DataStartInternal; i--) {
            OHLCChart.ctxMainCanvas.beginPath();
            XPositionOfCandleStick = Math.round(OHLCChart.ComputationProperties.BarSpace * (OHLCChart.ComputationProperties.DataEndInternal - 1 - i));
            BarYPositionOpen = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].Open());
            BarYPositionClose = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].Close());
            BarYPositionHigh = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].High());
            BarYPositionLow = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].Low());
            DrawCandleStick(i);
        }
    }
    else {
        for (var i = OHLCChart.ComputationProperties.DataStartInternal; i < OHLCChart.ComputationProperties.DataEndInternal ; i++) {
            OHLCChart.ctxMainCanvas.beginPath();
            XPositionOfCandleStick = Math.round(OHLCChart.ComputationProperties.width - OHLCChart.ComputationProperties.BarSpace * (i + OHLCChart.ComputationProperties.MarginOfBar - OHLCChart.ComputationProperties.DataStartInternal));
            BarYPositionOpen = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].Open());
            BarYPositionClose = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].Close());
            BarYPositionHigh = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].High());
            BarYPositionLow = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].Low());
            DrawCandleStick(i);
        }
    }
    //Actual Function to draw Candle Stick
    function DrawCandleStick(i) {
        if (OHLCChart.ComputationProperties.ZoomCollection[OHLCChart.ChartSettings.ZoomLevel] !== 14) {
            OHLCChart.ctxMainCanvas.lineWidth = 0.7;
            if (OHLCChart.ChartOtherProperties.ChartData[i].Open() <= OHLCChart.ChartOtherProperties.ChartData[i].Close()) {
                //Draw the line on top of the box
                OHLCChart.ctxMainCanvas.moveTo(XPositionOfCandleStick, BarYPositionClose);
                OHLCChart.ctxMainCanvas.lineTo(XPositionOfCandleStick, BarYPositionHigh);
                //Draw The line on the bottom of the box
                OHLCChart.ctxMainCanvas.moveTo(XPositionOfCandleStick, BarYPositionOpen);
                OHLCChart.ctxMainCanvas.lineTo(XPositionOfCandleStick, BarYPositionLow);
                OHLCChart.ctxMainCanvas.fillStyle = OHLCChart.ChartSettings.PositiveFill;
                OHLCChart.ctxMainCanvas.strokeStyle = OHLCChart.ChartSettings.PositiveLines;
            }
            else {
                //Draw the line on top of the box
                OHLCChart.ctxMainCanvas.moveTo(XPositionOfCandleStick, BarYPositionOpen);
                OHLCChart.ctxMainCanvas.lineTo(XPositionOfCandleStick, BarYPositionHigh);
                //Draw The line on the bottom of the box
                OHLCChart.ctxMainCanvas.moveTo(XPositionOfCandleStick, BarYPositionClose);
                OHLCChart.ctxMainCanvas.lineTo(XPositionOfCandleStick, BarYPositionLow);
                OHLCChart.ctxMainCanvas.fillStyle = OHLCChart.ChartSettings.NegativeFill;
                OHLCChart.ctxMainCanvas.strokeStyle = OHLCChart.ChartSettings.NegativeLine;
            }
            //Draw The box Of the Candle Stick

            //Condition For Spliting The Box of the Candle Stick so it will look like there's still more in that side. OHLCChart is to prevent overlapping
            var barOneSideMargin;
            if (OHLCChart.ChartOtherProperties.dataAdded === 0 && i === OHLCChart.ComputationProperties.DataStartInternal) {
                barOneSideMargin = Math.round((OHLCChart.ComputationProperties.BarSpace - OHLCChart.ComputationProperties.barsMargin) / 2);
                OHLCChart.ctxMainCanvas.moveTo(XPositionOfCandleStick - barOneSideMargin, BarYPositionOpen);
                OHLCChart.ctxMainCanvas.lineTo(XPositionOfCandleStick - barOneSideMargin, BarYPositionClose);
                OHLCChart.ctxMainCanvas.lineTo(XPositionOfCandleStick, BarYPositionClose);
                OHLCChart.ctxMainCanvas.lineTo(XPositionOfCandleStick, BarYPositionOpen);
                OHLCChart.ctxMainCanvas.lineTo(XPositionOfCandleStick - barOneSideMargin, BarYPositionOpen);
            }
            else {
                barOneSideMargin = Math.round((OHLCChart.ComputationProperties.BarSpace - OHLCChart.ComputationProperties.barsMargin) / 2);
                OHLCChart.ctxMainCanvas.moveTo(XPositionOfCandleStick - barOneSideMargin, BarYPositionOpen);
                OHLCChart.ctxMainCanvas.lineTo(XPositionOfCandleStick - barOneSideMargin, BarYPositionClose);
                OHLCChart.ctxMainCanvas.lineTo(XPositionOfCandleStick + barOneSideMargin, BarYPositionClose);
                OHLCChart.ctxMainCanvas.lineTo(XPositionOfCandleStick + barOneSideMargin, BarYPositionOpen);
                OHLCChart.ctxMainCanvas.lineTo(XPositionOfCandleStick - barOneSideMargin, BarYPositionOpen);
            }
        }
        else {
            if (OHLCChart.ChartOtherProperties.ChartData[i].Open() <= OHLCChart.ChartOtherProperties.ChartData[i].Close()) {
                OHLCChart.ctxMainCanvas.strokeStyle = OHLCChart.ChartSettings.PositiveLines;
            } else {
                OHLCChart.ctxMainCanvas.strokeStyle = OHLCChart.ChartSettings.NegativeLine;
            }

            OHLCChart.ctxMainCanvas.lineWidth = 1;
            OHLCChart.ctxMainCanvas.moveTo(XPositionOfCandleStick, BarYPositionHigh);
            OHLCChart.ctxMainCanvas.lineTo(XPositionOfCandleStick, BarYPositionLow);
        }

        OHLCChart.ctxMainCanvas.fill();
        OHLCChart.ctxMainCanvas.stroke();
        if (i + 1 < OHLCChart.ComputationProperties.DataLength) {
            ShowPeriodFunction(OHLCChart.ChartOtherProperties.ChartData[i].Stamp(), XPositionOfCandleStick, OHLCChart.ChartOtherProperties.ChartData[i + 1].Stamp(), i);
        }
        if (OHLCChart.ChartSettings.IsVolumeVisible) {
            OHLCChart.DrawVolume(XPositionOfCandleStick, OHLCChart.ChartOtherProperties.ChartData[i].Volume());
        }
    }
};

WC.CM.LineChart = function (OHLCChart, ShowPeriodFunction) {
    OHLCChart.ComputationProperties.MarginOfBar = OHLCChart.ChartOtherProperties.dataAdded;
    if (OHLCChart.ChartOtherProperties.dataAdded !== 0) {
        OHLCChart.ComputationProperties.MarginOfBar = Math.round(OHLCChart.ChartOtherProperties.dataAdded + (OHLCChart.ComputationProperties.ZoomCollection[OHLCChart.ChartSettings.ZoomLevel] - 1));
    }
    var XPosition;



    if (OHLCChart.ComputationProperties.DataLength < OHLCChart.ComputationProperties.NumbersOfVisibleBars) {
        OHLCChart.ctxMainCanvas.beginPath();
        OHLCChart.ctxMainCanvas.strokeStyle = OHLCChart.ChartSettings.Line;
        for (var i = OHLCChart.ComputationProperties.DataStartInternal; i < OHLCChart.ComputationProperties.DataEndInternal ; i++) {
            XPosition = Math.round(OHLCChart.ComputationProperties.BarSpace * (OHLCChart.ComputationProperties.DataEndInternal - 1 - i));
            FunctionToDrawLineChart(i);
        }
        OHLCChart.ctxMainCanvas.stroke();
    }
    else {
        OHLCChart.ctxMainCanvas.beginPath();
        OHLCChart.ctxMainCanvas.strokeStyle = OHLCChart.ChartSettings.Line;
        for (var i = OHLCChart.ComputationProperties.DataStartInternal; i < OHLCChart.ComputationProperties.DataEndInternal ; i++) {
            XPosition = Math.round(OHLCChart.ComputationProperties.width - OHLCChart.ComputationProperties.BarSpace * (i + OHLCChart.ComputationProperties.MarginOfBar - OHLCChart.ComputationProperties.DataStartInternal));
            FunctionToDrawLineChart(i);
        }
        OHLCChart.ctxMainCanvas.stroke();
    }
    function FunctionToDrawLineChart(i) {
        var YPosition = OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].Close());
        if (i === OHLCChart.ComputationProperties.DataStartInternal) {
            OHLCChart.ctxMainCanvas.moveTo(XPosition, YPosition);
        }
        else {
            OHLCChart.ctxMainCanvas.lineTo(XPosition, YPosition);
        }
        if (i + 1 < OHLCChart.ComputationProperties.DataLength) {
            ShowPeriodFunction(OHLCChart.ChartOtherProperties.ChartData[i].Stamp(), XPosition, OHLCChart.ChartOtherProperties.ChartData[i + 1].Stamp(), i);
        }
        if (OHLCChart.ChartSettings.IsVolumeVisible) {
            OHLCChart.DrawVolume(XPosition, OHLCChart.ChartOtherProperties.ChartData[i].Volume());
        }
    }
};

WC.CM.BarChart = function (OHLCChart, ShowPeriodFunction) {
    OHLCChart.ComputationProperties.MarginOfBar = OHLCChart.ChartOtherProperties.dataAdded;
    if (OHLCChart.ChartOtherProperties.dataAdded !== 0) {
        OHLCChart.ComputationProperties.MarginOfBar = OHLCChart.ChartOtherProperties.dataAdded + (OHLCChart.ComputationProperties.ZoomCollection[OHLCChart.ChartSettings.ZoomLevel] - 1);
    }
    var Xposition;
    var TempDataAdded = OHLCChart.ChartOtherProperties.dataAdded;
    //Vertical Grid Lines
    if (OHLCChart.ComputationProperties.DataLength < OHLCChart.ComputationProperties.NumbersOfVisibleBars) {
        for (var i = OHLCChart.ComputationProperties.DataEndInternal - 1; i >= OHLCChart.ComputationProperties.DataStartInternal; i--) {
            Xposition = Math.round(OHLCChart.ComputationProperties.BarSpace * (OHLCChart.ComputationProperties.DataEndInternal - 1 - i));
            TempDataAdded = 1;
            FunctioToDrawBarGraph(i);
        }
    }
    else {
        for (var i = OHLCChart.ComputationProperties.DataStartInternal; i < OHLCChart.ComputationProperties.DataEndInternal ; i++) {
            Xposition = Math.round(OHLCChart.ComputationProperties.width - OHLCChart.ComputationProperties.BarSpace * (i + OHLCChart.ComputationProperties.MarginOfBar - OHLCChart.ComputationProperties.DataStartInternal));
            FunctioToDrawBarGraph(i);
        }
    }

    function FunctioToDrawBarGraph(i) {
        if (OHLCChart.ChartOtherProperties.ChartData[i].Open() <= OHLCChart.ChartOtherProperties.ChartData[i].Close()) {
            OHLCChart.ctxMainCanvas.strokeStyle = OHLCChart.ChartSettings.PositiveLines;
        } else {
            OHLCChart.ctxMainCanvas.strokeStyle = OHLCChart.ChartSettings.NegativeLine;
        }

        //Straight line of the bar graph
        OHLCChart.ctxMainCanvas.beginPath();
        OHLCChart.ctxMainCanvas.lineWidth = 1;
        OHLCChart.ctxMainCanvas.moveTo(Xposition, OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].Low()));
        OHLCChart.ctxMainCanvas.lineTo(Xposition, OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].High()));
        OHLCChart.ctxMainCanvas.stroke();
        //Draw Open Data
        OHLCChart.ctxMainCanvas.beginPath();
        OHLCChart.ctxMainCanvas.lineWidth = 1;
        OHLCChart.ctxMainCanvas.moveTo(Xposition, OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].Open()));
        OHLCChart.ctxMainCanvas.lineTo(Math.round((Xposition) - ((OHLCChart.ComputationProperties.BarSpace - OHLCChart.ComputationProperties.barsMargin) / 2)), OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].Open()));
        OHLCChart.ctxMainCanvas.stroke();

        if (TempDataAdded !== 0 || i !== OHLCChart.ComputationProperties.DataStartInternal) {
            //Draw Close Data
            OHLCChart.ctxMainCanvas.beginPath();
            OHLCChart.ctxMainCanvas.lineWidth = 1;
            OHLCChart.ctxMainCanvas.moveTo(Xposition, OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].Close()));
            OHLCChart.ctxMainCanvas.lineTo(Math.round((Xposition) + ((OHLCChart.ComputationProperties.BarSpace - OHLCChart.ComputationProperties.barsMargin) / 2)), OHLCChart.GetYaxis(OHLCChart.ChartOtherProperties.ChartData[i].Close()));
            OHLCChart.ctxMainCanvas.stroke();
        }
        if (i + 1 < OHLCChart.ComputationProperties.DataLength) {
            ShowPeriodFunction(OHLCChart.ChartOtherProperties.ChartData[i].Stamp(), Xposition, OHLCChart.ChartOtherProperties.ChartData[i + 1].Stamp(), i);
        }
        if (OHLCChart.ChartSettings.IsVolumeVisible) {
            OHLCChart.DrawVolume(Xposition, OHLCChart.ChartOtherProperties.ChartData[i].Volume());
        }
    }
};

WC.CM.ChartSettingsProperty = function (settings) {
    var self = this;
    self.IsOrdersVisible = settings.IsOrdersVisible;
    //Porperty if Line Style
    self.IsLineStyle = settings.IsLineStyle;
    //Property if arrow style trades
    self.IsArrowStyle = settings.IsArrowStyle;
    //Visiblity of Open Trades
    self.IsOpenTradeVisible = settings.IsOpenTradeVisible;
    //Volume Visibility
    self.IsVolumeVisible = settings.IsVolumeVisible;
    //Set Separator Visibility
    self.IsPeriodSeparator = settings.IsPeriodSeparator;
    //SetTradePanel Visibility
    self.IsTradePanelVisible = settings.IsTradePanelVisible;
    // Set Trade Panel Position
    self.IsTradePanelBottomRight = settings.IsTradePanelBottomRight;
    //Symbol
    self.Symbol = settings.Symbol;
    //TimeFrame
    self.TimeFrame = settings.TimeFrame;
    //BoxSize
    self.BoxSize = settings.BoxSize;
    //Reversal
    self.Reversal = settings.Reversal;
    //Show Symbol Indicator Used by tickChart
    self.ShowSymbolIndicator = settings.ShowSymbolIndicator;
    //Bid Line Visibility
    self.IsBidLineVisible = settings.IsBidLineVisible;
    //AskLine Visibility
    self.IsAskLineVisible = settings.IsAskLineVisible;
    //Visibility of chart legend
    self.IsLegendVisible = settings.IsLegendVisible;
    //Graph Type
    self.GraphType = settings.GraphType;
    //Internal Use of Zoom 
    self.ZoomLevel = settings.ZoomLevel;
    //Variable used to determine if the marker is visible
    self.IsChartMarkerVisible = settings.IsChartMarkerVisible;
    //Variable Used to determine if upper left OHLC is visible
    self.IsOHLCDigitsVisible = settings.IsOHLCDigitsVisible;
    // Set OHLC Digits Position
    self.IsOHLCDigitsBottomRight = settings.IsOHLCDigitsBottomRight;
    //Variable If ChartDisplay Is Disabled
    self.IsChartDisplayDisabled = settings.IsChartDisplayDisabled;
    //Number of bars in correlation
    self.CorrelationNumberOfBars = settings.CorrelationNumberOfBars;
    //Set Visibility of bid and ask if its  always show on chart
    self.IsAlwaysShowBidAsk = settings.IsAlwaysShowBidAsk;
    //Weekly Period
    self.WeeklyPeriod = settings.WeeklyPeriod;
    //Chart Color Scheme---------------------------------

    //Chart BackGround Color
    self.BackGroundColor = settings.BackGroundColor;
    //Chart Buys Color
    self.BuysTradesColor = settings.BuysTradesColor;
    //Chart ForeGround
    self.ForeGround = settings.ForeGround;
    //Chart Grid Color
    self.Grid = settings.Grid;
    //Chart Highlight Color
    self.HighLight = settings.HighLight;
    //Chart Legend Color
    self.Legend = settings.Legend;
    //Chart Line Chart Color
    self.Line = settings.Line;
    //Chart Losing Trade Color
    self.LosingTrade = settings.LosingTrade;
    //Chart Marker Color
    self.Marker = settings.Marker;
    //Chart Negative Fill
    self.NegativeFill = settings.NegativeFill;
    //Chart Negative Lines Color
    self.NegativeLine = settings.NegativeLine;
    //Chart Periods Color
    self.Periods = settings.Periods;
    //Chart Positive Fill
    self.PositiveFill = settings.PositiveFill;
    //Chart Positive Lines
    self.PositiveLines = settings.PositiveLines;
    //Chart Sells Color
    self.SellsTradesColor = settings.SellsTradesColor;
    //Chart Volumes Color
    self.Volumes = settings.Volumes;
    //Chart Winning Trades Color
    self.WinningTrade = settings.WinningTrade;
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    self.ZoomChartTitle = settings.ZoomChartTitle;

    self.ActiveIndicators = settings.ActiveIndicators;
    self.ActiveVisualTools = settings.ActiveVisualTools;

    self.IsShowPoweredText = settings.IsShowPoweredText;
    self.IsShowWaterMark = settings.IsShowWaterMark;

    self.SellsBuysTradesForeColor = settings.SellsBuysTradesForeColor

    self.SellBuysLineWidth = settings.SellBuysLineWidth

    self.SellBuysDashPattern = settings.SellBuysDashPattern;
};

WC.CM.ChartComputationProperties = function (height, width) {
    var self = this;
    //Length of the data
    self.DataLength = 0;
    //Height Of the Container
    self.height = height - 20;
    //width of the container
    self.width = width - 60;
    //This is the fefault BarsWidth
    self.DefaultBarsWidth = 32;
    //Computed BarsWidth Depending on the Zoom Level
    self.BarSpace = 0;
    //Difference between ymin and ymax
    self.difference = 0;
    //Computed Steps
    self.steps = 0;
    //Line number
    self.LineNumber = 0;
    //Bars's margin for each bar to ber drawn
    self.barsMargin = 0;
    //Bar's Width
    self.BarsWidth = 0;
    //Zoom Array
    self.ZoomCollection = [1, 2, 4, 7, 14];
    //variable for Ymin
    self.yMin = 0;
    //varaible for YMax
    self.yMax = 0;
    //Internal Use data start
    self.DataStartInternal = 0;
    //Internal Use data End
    self.DataEndInternal = undefined;
    //Volume Ymax
    self.VolumeYmax = 0;
    //Volume Ymin
    self.VolumeYmin = 0;
    //Percentage of the Volume
    self.PercentageOfVolumeSpace = 0.15;
    //used to determin the margin of bar before drawing anything
    self.MarginOfBar = 0;
    //Current Data Number Where mouse is hovered
    self.dataNumber = 0;
    //This variable is used to determine how many bars is visible in the chart
    self.NumbersOfVisibleBars = null;
    //Excess Bars TotalWidth
    self.ExcessBarsTotalWidth = 0;
    //Position of First Data
    self.XPositionFirstData = 0;
};

WC.CM.ChartValidationsProperties = function () {
    var self = this;
    //Property if the Chart is draggable
    self.IsDraggable = true;
    //Is Still Requesting additional Data
    self.isRequestingAdditionalData = false;
    //Digits Ready
    self.isDigitsReady = false;
    //Data Ready
    self.isDataReady = false;
    //Determine if the mouse is still down this variable is used in the drag event of the chart
    self.stillDown = false;
};

WC.CM.ChartOtherProperties = function () {
    var self = this;
    //Use To Determine the Margin of the Chart on the right side before drawing         
    self.dataAdded = 0;
    //Drag Sensetivity
    self.DragSensetivity = 0;
    //This it to determine the beggining x axis of drag
    self.BegDrag = 0;
    //the actual y axis when mouse is hovered in the chart
    self.HoveredYaxis = 0;
    //the actual x axis when mouse is hovered in the chart
    self.HoveredXaxis = 0;
    //This is used on the Grid lines to determine the visible bars
    self.DottedXaxisVisibleBars = 0;
    //This is used on the Grid lines to determine the Visible Bars
    self.DottedYAxisVisibleBars = 0;
    //Pips Per Grid 
    self.PipsPerGrid = 0;
    //Total DataAdded To Ymin And Ymax
    self.TotalAddYminYmax = 0;
    //Y Axis Draggin Sensetivity
    self.YAxisDraggingSensetivity = 5;
    //Minimum Height of bars
    self.MinimumHeightBars = 5;
    //Property for last Date of current bar
    self.LastDateOfBars = null;
    //OriginalYMax
    self.OriginalYMax = 0;
    //Original Ymin
    self.OriginalYMin = 0;
    //Bid Value
    self.BidValue = 0;
    //AskValue
    self.AskValue = 0;
    // Chart Data
    self.ChartData = [];
    //Kagi Fill Style
    self.KagiFillStyle;
    //Last Separator Number 
    self.LastSeparatorNumber = null;
};

WC.CM.BottomIndicatorChart = function (Container, ChartFormResizingMethod, MainChartInstance, IndicatorID, ChartDisplay, ContainerID) {
    //WebChartInstance.Instance.push({ ChartInstance: this });
    var IndicatorChart = this;
    var IsDragRedraw = false;
    var LastXAxis = "";
    var IsChartNeedToDraw = true;
    var DrawCloseSub = "";
    var DrawArraySub = "";
    var IsTimeFrameChanged = false;
    var CloseID = IndicatorID + "-Close" + ContainerID;
    var tempYMax;
    var tempYMin;
    var tempDataEnd;
    var isMultiLinedIndicator = false;
    var mastercontainterverticalmarker;
    var XAxis;
    var YAxis;
    IndicatorChart.FirstLoad = true;
    IndicatorChart.DrawLabel = false;
    ChartFormResizingMethod();

    // Call the parent constructor, making sure (using Function#call)
    // that "this" is set correctly during the call
    WC.CM.BaseChart.call(this, Container);
    IndicatorChart.ChartHeight = IndicatorChart.ParentELement.height();
    ComputeVariablesNeeded();
    SetAllChartEvents();
    IndicatorChart.DrawIndicatorBaseChartWithoutData(IndicatorChart.ChartHeight, MainChartInstance);
    SetScrollBarEvent();
    SetChartZoomEvent();
    setCloseButton();
    SetAllMarkersLegendAndOtherElementsNeeded();
    $(IndicatorChart.ParentELement).find('[CloseID="' + CloseID + '"]').click(function () {
        IndicatorChart.ParentELement.trigger("LowerIndicatorClose", [IndicatorID, CloseID]);
        $('[CloseID="' + CloseID + '"]').remove();
    });

    IndicatorChart.ParentELement.parent().find('div.ScrollBarMainHolder').fadeOut(0);

    SubscribeWhenToDraw();

    MainChartInstance.ParentELement.on("ChartMouseMove", {
    }, function (event, VisualToolsCanvas, XAxis1, YAxis1, CurrentBar, OHLCChart) {

        var X = XAxis1;
        var Y = YAxis1;
        IndicatorChart.ComputationProperties.dataNumber = GetIndexOfData(X);
        if (MainChartInstance.ChartSettings.IsChartMarkerVisible) {
            ReComputeComputedHightWidthOfMarker();
        }
    });

    MainChartInstance.ParentELement.on("ChartMouseLeave", {
    }, function (event) {
        HideChartMarkers();
    });


    MainChartInstance.ParentELement.on("ChartMouseWheel", {
    }, function (event, VisualToolsCanvas, ctxIndicatorTopCanvas, ctxIndicatorBotCanvas, ChartData, OHLCChart, X) {
        IndicatorChart.ComputationProperties.dataNumber = GetIndexOfData(X);
        if (MainChartInstance.ChartSettings.IsChartMarkerVisible) {
            ReComputeComputedHightWidthOfMarker();
        }
    });



    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Internal Functions~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    //Function to Draw and compute
    function DrawComputeChart() {
        if (IndicatorChart.ChartOtherProperties.ChartData.length <= 1) {
            if (IndicatorChart.FirstLoad) {
                IndicatorChart.DrawIndicatorBaseChartWithoutData(IndicatorChart.ChartHeight, MainChartInstance);
                return;
            } else {
                return;
            }
        }

        ComputeVariablesNeeded();
        // IndicatorChart.DrawIndicatorBaseChart(IndicatorChart.ChartHeight, MainChartInstance);
        IndicatorChart.DrawIndicatorBaseChart(MainChartInstance);
    }

    IndicatorChart.DrawChartWithoutData = function () {
        ComputeVariablesNeeded();
        IndicatorChart.DrawIndicatorBaseChartWithoutData(IndicatorChart.ChartHeight, MainChartInstance);
    }

    IndicatorChart.initRedraw = function (data, ChartInstance) {
        IndicatorChart.ChartSettings.ZoomLevel = ChartInstance.ChartSettings.ZoomLevel;
        IndicatorChart.ChartOtherProperties.ChartData = data;
        IndicatorChart.initYBoundaries(data);
        DrawComputeChart();
        IndicatorChart.initDrawing(ChartInstance);
        $(IndicatorChart.ParentELement).find('.wt-ChartClose').removeAttr('style');
        var leftValue = IndicatorChart.ComputationProperties.width - 20;
        $(IndicatorChart.ParentELement).find('.wt-ChartClose').attr('style', 'z-index:19; position: absolute; left: ' + leftValue + 'px; top: 5px; cursor: pointer; vertical-align: middle;');
        IsDragRedraw = false;
    };

    IndicatorChart.initYBoundaries = function (ChartData) {
        tempDataEnd = null; tempYMax = null; tempYMin = null; isMultiLinedIndicator = true;
        IndicatorChart.ComputationProperties.height = IndicatorChart.ChartHeight;
        var isMultiLined = Array.isArray(ChartData[0]);
        isMultiLinedIndicator = isMultiLined;
        if (isMultiLined) {
            for (var data in ChartData) {
                var index = parseInt(data);

                // TEMP FIX - Replace ASAP
                if (isNaN(index) || index >= ChartData.length) break;

                IndicatorChart.ChartOtherProperties.ChartData = ChartData[index];
                IndicatorChart.ComputationProperties.DataLength = IndicatorChart.ChartOtherProperties.ChartData.length;
                SetYminYmax();
            }
        } else {
            IndicatorChart.ChartOtherProperties.ChartData = ChartData;
            IndicatorChart.ComputationProperties.DataLength = IndicatorChart.ChartOtherProperties.ChartData.length;
            SetYminYmax();
        }
        if (ChartData.length >= 1) {
            IndicatorChart.ComputationProperties.difference = IndicatorChart.ComputationProperties.yMax - IndicatorChart.ComputationProperties.yMin;
            IndicatorChart.ComputationProperties.steps = IndicatorChart.ComputationProperties.height / IndicatorChart.ComputationProperties.difference;
            IndicatorChart.ComputationProperties.LineNumber = IndicatorChart.ComputationProperties.height / IndicatorChart.ComputationProperties.DefaultBarsWidth;
            MarginTopAndBottomChart();
            VerticalIndicators();
        }
    };


    //compute the variables needed
    function ComputeVariablesNeeded() {
        //Height Of the Container
        IndicatorChart.OHLCCanvas.width = 0;
        IndicatorChart.OHLCCanvas.height = 0;
        IndicatorChart.VolumeCanvas.width = 0;
        IndicatorChart.VolumeCanvas.height = 0;
        IndicatorChart.GridLineCanvas.width = 0;
        IndicatorChart.GridLineCanvas.height = 0;
        IndicatorChart.IndicatorBotCanvas.width = 0;
        IndicatorChart.IndicatorBotCanvas.height = 0;
        IndicatorChart.IndicatorTopCanvas.width = 0;
        IndicatorChart.IndicatorTopCanvas.height = 0;
        $(IndicatorChart.ParentELement).find('.VisualToolsCanvas').removeAttr('width');
        $(IndicatorChart.ParentELement).find('.VisualToolsCanvas').removeAttr('height');
        $(IndicatorChart.ParentELement).find('.VisualToolsCanvas').attr('width', '0');
        $(IndicatorChart.ParentELement).find('.VisualToolsCanvas').attr('height', '0');
        $(IndicatorChart.ParentELement).find('.canvas-container canvas').removeAttr('style');
        $(IndicatorChart.ParentELement).find('.canvas-container').removeAttr('style');
        IndicatorChart.DraggingCanvas.width = 0;
        IndicatorChart.DraggingCanvas.height = 0;
        IndicatorChart.BaseChartElement.removeAttr("style");
        ChartFormResizingMethod();
        IndicatorChart.BaseChartElement.attr('style', 'background-color: white; position:relative;').outerHeight(IndicatorChart.ChartHeight);
        IndicatorChart.OHLCCanvas.width = IndicatorChart.ParentELement.width();
        IndicatorChart.OHLCCanvas.height = IndicatorChart.ChartHeight;
        IndicatorChart.VolumeCanvas.width = IndicatorChart.ParentELement.width();
        IndicatorChart.VolumeCanvas.height = IndicatorChart.ChartHeight;
        IndicatorChart.GridLineCanvas.width = IndicatorChart.ParentELement.width();
        IndicatorChart.GridLineCanvas.height = IndicatorChart.ChartHeight;
        IndicatorChart.IndicatorBotCanvas.width = IndicatorChart.ParentELement.width() - 60;
        IndicatorChart.IndicatorBotCanvas.height = IndicatorChart.ChartHeight;
        IndicatorChart.IndicatorTopCanvas.width = IndicatorChart.ParentELement.width() - 60;
        IndicatorChart.IndicatorTopCanvas.height = IndicatorChart.ChartHeight;
        IndicatorChart.VisualToolsCanvas.width = IndicatorChart.ParentELement.width();
        IndicatorChart.VisualToolsCanvas.height = IndicatorChart.ChartHeight;
        ChartFormResizingMethod();
        $(IndicatorChart.ParentELement).find('.VisualToolsCanvas').attr('width', IndicatorChart.ParentELement.width() - 60);
        $(IndicatorChart.ParentELement).find('.VisualToolsCanvas').attr('height', IndicatorChart.ChartHeight - 20);
        $(IndicatorChart.ParentELement).find('.canvas-container canvas').attr('style', 'position: absolute; top:0; left: 0px; z-index:7;width:' + (IndicatorChart.ParentELement.width() - 60) + 'px; height:' + (IndicatorChart.ChartHeight - 20) + 'px;');
        $(IndicatorChart.ParentELement).find('.canvas-container').attr('style', 'position: relative; -webkit-user-select: none; width:' + IndicatorChart.ParentELement.width() + 'px; height:' + IndicatorChart.ChartHeight + 'px;');
        IndicatorChart.BaseChartElement.height = IndicatorChart.ChartHeight;
        IndicatorChart.DraggingCanvas.width = IndicatorChart.ParentELement.width();
        IndicatorChart.DraggingCanvas.height = IndicatorChart.ChartHeight;
        IndicatorChart.ComputationProperties.height = IndicatorChart.ChartHeight;
        //width of the container
        IndicatorChart.ComputationProperties.width = IndicatorChart.ParentELement.width() - 60;
        IndicatorChart.ComputationProperties.DefaultBarsWidth = 32;
        //Computed BarsWidth Depending on the Zoom Level
        ComputeBarsMargin();
        IndicatorChart.ComputationProperties.BarSpace = IndicatorChart.ComputationProperties.DefaultBarsWidth / IndicatorChart.ComputationProperties.ZoomCollection[IndicatorChart.ChartSettings.ZoomLevel];
        IndicatorChart.ChartOtherProperties.DragSensetivity = (IndicatorChart.ComputationProperties.BarSpace - IndicatorChart.ComputationProperties.barsMargin) / 2;
        IndicatorChart.ChartOtherProperties.DottedXaxisVisibleBars = IndicatorChart.ComputationProperties.width / IndicatorChart.ComputationProperties.DefaultBarsWidth;
        IndicatorChart.ChartOtherProperties.DottedYAxisVisibleBars = IndicatorChart.ComputationProperties.height / IndicatorChart.ComputationProperties.DefaultBarsWidth;

        // IndicatorChart.ComputationProperties.NumbersOfVisibleBars = Math.ceil(IndicatorChart.ComputationProperties.width - (IndicatorChart) / IndicatorChart.ComputationProperties.BarSpace);
        IndicatorChart.ComputationProperties.NumbersOfVisibleBars = Math.ceil((IndicatorChart.ComputationProperties.width - (IndicatorChart.ComputationProperties.DefaultBarsWidth * IndicatorChart.ChartOtherProperties.dataAdded)) / IndicatorChart.ComputationProperties.BarSpace);
        //IndicatorChart.ComputationProperties.DataEndInternal = Math.ceil(IndicatorChart.ComputationProperties.NumbersOfVisibleBars) + IndicatorChart.ComputationProperties.DataStartInternal + 1;
        IndicatorChart.ComputationProperties.DataEndInternal = Math.round(IndicatorChart.ComputationProperties.NumbersOfVisibleBars) + IndicatorChart.ComputationProperties.DataStartInternal;


        IndicatorChart.SetTranslateAllContext();
        if (IndicatorChart.ComputationProperties.DataStartInternal !== 0) {
            IndicatorChart.ComputationProperties.DataEndInternal = IndicatorChart.ComputationProperties.DataEndInternal + 1;
            IndicatorChart.ChartOtherProperties.dataAdded = 0;
        }
        else {
            IndicatorChart.ChartOtherProperties.dataAdded = 1;
        }
        if (IndicatorChart.y) {
            IndicatorChart.ParentELement.trigger("initChartDraw");
        }
    }

    function ComputeBarsMargin() {
        if (IndicatorChart.ComputationProperties.ZoomCollection[IndicatorChart.ChartSettings.ZoomLevel] === 1) {
            IndicatorChart.ComputationProperties.barsMargin = Math.round(IndicatorChart.ComputationProperties.BarSpace * 0.20);
        }
        else if (IndicatorChart.ComputationProperties.ZoomCollection[IndicatorChart.ChartSettings.ZoomLevel] === 2) {
            IndicatorChart.ComputationProperties.barsMargin = Math.round(IndicatorChart.ComputationProperties.BarSpace * 0.30);
        }
        else if (IndicatorChart.ComputationProperties.ZoomCollection[IndicatorChart.ChartSettings.ZoomLevel] === 4) {
            IndicatorChart.ComputationProperties.barsMargin = Math.round(IndicatorChart.ComputationProperties.BarSpace * 0.40);
        }
        else if (IndicatorChart.ComputationProperties.ZoomCollection[IndicatorChart.ChartSettings.ZoomLevel] === 7) {
            IndicatorChart.ComputationProperties.barsMargin = Math.round(IndicatorChart.ComputationProperties.BarSpace * 0.55);
        }
        else {
            IndicatorChart.ComputationProperties.barsMargin = 1;
        }
    }

    IndicatorChart.initDrawing = function (ChartInstance) {
        IndicatorChart.ComputationProperties.DataStartInternal = ChartInstance.ComputationProperties.DataStartInternal;
        IndicatorChart.ComputationProperties.DataEndInternal = ChartInstance.ComputationProperties.DataEndInternal;
        IndicatorChart.ChartOtherProperties.dataAdded = ChartInstance.ChartOtherProperties.dataAdded;
        if (Array.isArray(IndicatorChart.ChartOtherProperties.ChartData[0])) {
            IndicatorChart.initYBoundaries(IndicatorChart.ChartOtherProperties.ChartData);
            VerticalIndicators();
            return;
        }
        IndicatorChart.ComputationProperties.DataLength = IndicatorChart.ChartOtherProperties.ChartData.length;
        //IndicatorChart.SetTranslateAllContext();
        //IndicatorChart.DrawIndicatorBaseChart();

        //SetYminYmax();
        //IndicatorChart.ComputationProperties.difference = IndicatorChart.ComputationProperties.yMax - IndicatorChart.ComputationProperties.yMin;
        //IndicatorChart.ComputationProperties.steps = IndicatorChart.ComputationProperties.height / IndicatorChart.ComputationProperties.difference;
        //IndicatorChart.ComputationProperties.LineNumber = IndicatorChart.ComputationProperties.height / IndicatorChart.ComputationProperties.DefaultBarsWidth;

        //MarginTopAndBottomChart();

        if (IndicatorChart.ChartOtherProperties.ChartData.length !== 0) {
            VerticalIndicators();
        }
        //InitChartScrollBar();
    };

    //Set YminYmax
    function SetYminYmax() {
        //Getting the Ymin and Ymax of the chart
        if (IndicatorChart.ComputationProperties.DataEndInternal > IndicatorChart.ComputationProperties.DataLength) {
            IndicatorChart.ComputationProperties.DataEndInternal = IndicatorChart.ComputationProperties.DataLength;
        }

        for (var i = MainChartInstance.ComputationProperties.DataStartInternal; i < IndicatorChart.ComputationProperties.DataEndInternal; i++) {
            if (i === MainChartInstance.ComputationProperties.DataStartInternal) {
                IndicatorChart.ComputationProperties.yMax = IndicatorChart.ChartOtherProperties.ChartData[i].Value;
                IndicatorChart.ComputationProperties.yMin = IndicatorChart.ChartOtherProperties.ChartData[i].Value;
            }
            if (IndicatorChart.ChartOtherProperties.ChartData[i].Value > IndicatorChart.ComputationProperties.yMax) {
                IndicatorChart.ComputationProperties.yMax = IndicatorChart.ChartOtherProperties.ChartData[i].Value;
            }
            if (IndicatorChart.ChartOtherProperties.ChartData[i].Value < IndicatorChart.ComputationProperties.yMin) {
                IndicatorChart.ComputationProperties.yMin = IndicatorChart.ChartOtherProperties.ChartData[i].Value;
            }
        }

        if (isMultiLinedIndicator) {
            if (tempYMax === null && tempYMin === null && tempDataEnd === null) {
                tempYMax = IndicatorChart.ComputationProperties.yMax;
                tempYMin = IndicatorChart.ComputationProperties.yMin;
                tempDataEnd = IndicatorChart.ComputationProperties.DataEndInternal;
            }
            else {
                if (IndicatorChart.ComputationProperties.yMax >= tempYMax) {
                    tempYMax = IndicatorChart.ComputationProperties.yMax;
                }
                else {
                    IndicatorChart.ComputationProperties.yMax = tempYMax;
                }
                if (IndicatorChart.ComputationProperties.yMin <= tempYMin) {
                    tempYMin = IndicatorChart.ComputationProperties.yMin;
                }
                else {
                    IndicatorChart.ComputationProperties.yMin = tempYMin;
                }
                if (IndicatorChart.ComputationProperties.DataEndInternal >= tempDataEnd) {
                    tempDataEnd = IndicatorChart.ComputationProperties.DataEndInternal;
                }
                else {
                    IndicatorChart.ComputationProperties.DataEndInternal = tempDataEnd;
                }
            }
            IndicatorChart.ComputationProperties.yMax = tempYMax;
            IndicatorChart.ComputationProperties.yMin = tempYMin;
            IndicatorChart.ComputationProperties.DataEndInternal = tempDataEnd;
        }
        //  VerticalIndicators();
    }
    //Add Margin to the graph Bottom and top
    function MarginTopAndBottomChart() {
        //Add Margin To the graph
        IndicatorChart.ComputationProperties.OriginalYMax = IndicatorChart.ComputationProperties.yMax;
        IndicatorChart.ComputationProperties.OriginalYMin = IndicatorChart.ComputationProperties.yMin;
        IndicatorChart.ComputationProperties.yMax = IndicatorChart.ComputationProperties.yMax + (5 / IndicatorChart.ComputationProperties.steps);
        IndicatorChart.ComputationProperties.yMin = IndicatorChart.ComputationProperties.yMin - (5 / IndicatorChart.ComputationProperties.steps);
        IndicatorChart.ComputationProperties.difference = IndicatorChart.ComputationProperties.yMax - IndicatorChart.ComputationProperties.yMin;
        IndicatorChart.ComputationProperties.steps = IndicatorChart.ComputationProperties.height / IndicatorChart.ComputationProperties.difference;
        IndicatorChart.ComputationProperties.LineNumber = IndicatorChart.ComputationProperties.height / IndicatorChart.ComputationProperties.DefaultBarsWidth;
    }

    IndicatorChart.Resizemethod = function () {
        ComputeVariablesNeeded();
        IndicatorChart.DrawIndicatorBaseChartWithoutData(IndicatorChart.ChartHeight, MainChartInstance);
        // IndicatorChart.SetTranslateAllContext();
    };

    IndicatorChart.MouseUpEvent = function () {
        IndicatorChart.ChartValidationsProperties.stillDown = false;
        LastXAxis = "";
    };

    IndicatorChart.MouseDownEvent = function (X) {

        IndicatorChart.ChartValidationsProperties.stillDown = true;
        IndicatorChart.ChartOtherProperties.BegDrag = X;
        LastXAxis = "";
    };

    IndicatorChart.MouseMoveEvent = function (X, Y) {

        XAxis = X;
        YAxis = Y;
        IndicatorChart.ComputationProperties.dataNumber = GetIndexOfData(XAxis);
        MainChartInstance.MouseMoveEvent(X, -1);
        if (MainChartInstance.ChartSettings.IsChartMarkerVisible) {
            ReComputeComputedHightWidthOfMarker();
        }
        if (!IndicatorChart.ChartValidationsProperties.stillDown) {
            return;
        }
        if (IndicatorChart.ChartValidationsProperties.IsDraggable) {
            var RealDataAdded;
            var ComputedAddedData;
            if (XAxis >= IndicatorChart.ChartOtherProperties.BegDrag + IndicatorChart.ChartOtherProperties.DragSensetivity) {
                IndicatorChart.ChartOtherProperties.BegDrag = XAxis;
                if (IndicatorChart.ComputationProperties.DataStartInternal <= MainChartInstance.ComputationProperties.DataLength - IndicatorChart.ComputationProperties.NumbersOfVisibleBars - 1) {
                    if (LastXAxis === "") {
                        IndicatorChart.ComputationProperties.DataStartInternal = IndicatorChart.ComputationProperties.DataStartInternal + 1;
                    }
                    else {
                        ComputedAddedData = (XAxis - LastXAxis) / IndicatorChart.ChartOtherProperties.DragSensetivity;

                        if (ComputedAddedData < 0) {
                            RealDataAdded = ComputedAddedData - (ComputedAddedData * 2);
                        }
                        else {
                            RealDataAdded = ComputedAddedData;
                        }
                        RealDataAdded = Math.floor(RealDataAdded);
                        IndicatorChart.ComputationProperties.DataStartInternal = IndicatorChart.ComputationProperties.DataStartInternal + RealDataAdded;
                    }
                }
                IsDragRedraw = true;
                // ChartDragRedraw();
                IndicatorChart.ParentELement.trigger("ChartDragged", [IndicatorChart.ctxIndicatorTopCanvas, IndicatorChart]);
                LastXAxis = XAxis;
            }
            if (XAxis <= IndicatorChart.ChartOtherProperties.BegDrag - IndicatorChart.ChartOtherProperties.DragSensetivity) {
                IndicatorChart.ChartOtherProperties.BegDrag = XAxis;
                if (IndicatorChart.ComputationProperties.DataStartInternal <= 0) {
                    IndicatorChart.ComputationProperties.DataStartInternal = 0;
                }
                if (IndicatorChart.ComputationProperties.DataStartInternal > 0) {
                    if (LastXAxis === "") {
                        IndicatorChart.ComputationProperties.DataStartInternal = IndicatorChart.ComputationProperties.DataStartInternal - 1;
                    }
                    else {
                        ComputedAddedData = (XAxis - LastXAxis) / IndicatorChart.ChartOtherProperties.DragSensetivity;
                        if (ComputedAddedData < 0) {
                            RealDataAdded = ComputedAddedData - (ComputedAddedData * 2);
                        }
                        else {
                            RealDataAdded = ComputedAddedData;
                        }
                        RealDataAdded = Math.floor(RealDataAdded);
                        IndicatorChart.ComputationProperties.DataStartInternal = IndicatorChart.ComputationProperties.DataStartInternal - RealDataAdded;
                        if (IndicatorChart.ComputationProperties.DataStartInternal < 0) {
                            IndicatorChart.ComputationProperties.DataStartInternal = 0;
                        }
                    }

                }
                IsDragRedraw = true;
                //  ChartDragRedraw();
                //IndicatorChart.DrawOHLCChart();
                IndicatorChart.ParentELement.trigger("ChartDragged", [IndicatorChart.ctxIndicatorTopCanvas, IndicatorChart]);
                LastXAxis = XAxis;
            }
        }
    };

    //Function TO Set All chart Events or subscribe
    function SetAllChartEvents() {
        //~~~Chart Events~~~
        var TopIndicatorCanvas = $(IndicatorChart.ParentELement).find('.IndicatorTopCanvas');



        TopIndicatorCanvas.removeAttr('style');
        TopIndicatorCanvas.attr('style', 'position: absolute; left: 0px; z-index: 10; top: 0px;');

        TopIndicatorCanvas.mousedown(TopIndicatorCanvasMouseDown);
        TopIndicatorCanvas.on('touchstart', TopIndicatorCanvasMouseDown);
        function TopIndicatorCanvasMouseDown(e) {
            //MainChartInstance.MouseDownEvent(e.pageX);
            var elem = $(IndicatorChart.ParentELement).offset();
            var X = (e.pageX ? e.pageX : e.originalEvent.touches[0].pageX) - elem.left;
            IndicatorChart.MouseDownEvent(X);
        };

        TopIndicatorCanvas.mouseup(TopIndicatorCanvasMouseUp)
        TopIndicatorCanvas.on('touchend', TopIndicatorCanvasMouseUp);

        function TopIndicatorCanvasMouseUp() {
            IndicatorChart.MouseUpEvent();
        };

        for (i = 0; i < IndicatorChart.ParentELement.length; i++) {
            (function (i) {
                IndicatorChart.ParentELement[i].onmouseover = function () {
                    //  console.log(i);
                };
            }(i));
        }

        TopIndicatorCanvas.mousemove(TopIndicatorCanvasMouseMove);
        TopIndicatorCanvas.on('touchmove', TopIndicatorCanvasMouseMove);
        function TopIndicatorCanvasMouseMove(e) {
            var elem = $(IndicatorChart.ParentELement).offset();
            var X = (e.pageX ? e.pageX : e.originalEvent.touches[0].pageX) - elem.left;
            IndicatorChart.MouseMoveEvent(X, 0);
            //  console.log(IndicatorID);
        }

        TopIndicatorCanvas.mouseout(function () {
            IndicatorChart.ChartValidationsProperties.stillDown = false;
            HideChartMarkers();
            MainChartInstance.HideMarkers();
            MainChartInstance.TriggerHoverOut();
        });

        IndicatorChart.Resizemethod = function () {
            if (!IndicatorChart.ChartValidationsProperties.isDigitsReady || !IndicatorChart.ChartValidationsProperties.isDataReady) {
                ComputeVariablesNeeded();
                IndicatorChart.DrawIndicatorBaseChartWithoutData(IndicatorChart.ChartHeight, MainChartInstance);
                //  VerticalIndicators();

            }
            else {
                IsDragRedraw = true;
                ChartDragRedraw();
                // IndicatorChart.DrawIndicatorBaseChartWithoutData(IndicatorChart.ChartHeight);
                // VerticalIndicators();

                IndicatorChart.ParentELement.trigger("ChartSizeChanged", [IndicatorChart.VisualToolsCanvas, IndicatorChart.ctxIndicatorTopCanvas, IndicatorChart.ctxIndicatorBotCanvas, IndicatorChart.ChartOtherProperties.ChartData, IndicatorChart]);
            }
        };
    }

    function SetChartZoomEvent() {
        $(IndicatorChart.ParentELement).find('.IndicatorTopCanvas').mousewheel(function (e) {
            if (e.deltaY === 1) {
                if (IndicatorChart.ChartSettings.ZoomLevel !== 0) {
                    IndicatorChart.ChartSettings.ZoomLevel = IndicatorChart.ChartSettings.ZoomLevel - 1;
                }
            }
            if (e.deltaY === -1) {
                if (IndicatorChart.ChartSettings.ZoomLevel !== 4) {
                    IndicatorChart.ChartSettings.ZoomLevel = IndicatorChart.ChartSettings.ZoomLevel + 1;
                }
            }
            if (IndicatorChart.ChartSettings.ZoomLevel !== 5) {
                IsDragRedraw = true;
                ComputeVariablesNeeded();
            }
            MainChartInstance.LowerIndicatorChartZoom(e);

            MainChartInstance.MouseMoveEvent(MainChartInstance.ChartOtherProperties.HoveredXaxis, -1);
            if (MainChartInstance.ChartSettings.IsChartMarkerVisible) {
                ReComputeComputedHightWidthOfMarker();
            }
        });
    }


    function setCloseButton() {
        var leftValue = IndicatorChart.ComputationProperties.width - 20;
        var CloseButton = $('<div CloseID="' + CloseID + '" class="wt-ChartClose" align="center" style="z-index:19; position: absolute; left: ' + leftValue + 'px; top: 5px; cursor: pointer; vertical-align: middle;"></div>');
        IndicatorChart.BaseChartElement.append(CloseButton);
    }

    //Set ChartScrollBar
    function SetScrollBarEvent() {
        IndicatorChart.ParentELement.parent().find('div.ChartScrollBarHolder').on("slide", function (event, ui) {
            IndicatorChart.ComputationProperties.DataStartInternal = IndicatorChart.ComputationProperties.DataLength - IndicatorChart.ComputationProperties.NumbersOfVisibleBars - ui.value;
            IsDragRedraw = true;
            IndicatorChart.DrawIndicatorBaseChartWithoutData(IndicatorChart.ChartHeight, MainChartInstance);
            IndicatorChart.ParentELement.trigger("IndicatorChartDragged");
        });
    }

    //Function To subscribe when to draw
    function SubscribeWhenToDraw() {
        if (DrawArraySub !== "") {
            DrawArraySub.dispose();
        }

        if (DrawCloseSub !== "") {
            DrawCloseSub.dispose();
        }
        IndicatorChart.DrawIndicatorBaseChartWithoutData(IndicatorChart.ChartHeight, MainChartInstance);

    }
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    //~~~~~~~~~~~~~Public Methods~~~~~~~~~~~~~~~~~~~
    IndicatorChart.OnSymbolChanged = [];

    IndicatorChart.OnTimeFrameChanged = [];

    IndicatorChart.ChangeTimeFrame = function (Time) {
        if (IndicatorChart.ChartSettings.TimeFrame === Time) {
            return;
        }

        $(IndicatorChart.ParentELement).find('.LoadingHolder').fadeIn(0);
        IndicatorChart.ParentELement.parent().find('div.ScrollBarMainHolder').fadeOut(0);
        $(IndicatorChart.ParentELement).find('.AskLineIndicator').fadeOut(0);
        $(IndicatorChart.ParentELement).find('.AskDataIndicator').fadeOut(0);
        $(IndicatorChart.ParentELement).find('.BidLineIndicator').fadeOut(0);
        $(IndicatorChart.ParentELement).find('.BidDataIndicator').fadeOut(0);
        IndicatorChart.ChartSettings.TimeFrame = Time;
        IndicatorChart.ChartValidationsProperties.isDataReady = false;
        var isNewDataAdded = false;
        IndicatorChart.ComputationProperties.DataStartInternal = 0;
        IsChartNeedToDraw = true;
        for (var i = 0; i < BarsViewModel.BarsDataHolder().length; i++) {
            if (BarsViewModel.BarsDataHolder()[i].Symbol === IndicatorChart.ChartSettings.Symbol && BarsViewModel.BarsDataHolder()[i].TimeFrame === IndicatorChart.ChartSettings.TimeFrame) {
                IndicatorChart.ChartOtherProperties.ChartData = BarsViewModel.BarsDataHolder()[i].Data();
                isNewDataAdded = true;
            }
        }
        IsTimeFrameChanged = true;
        if (!isNewDataAdded) {
            IndicatorChart.DrawIndicatorBaseChartWithoutData(IndicatorChart.ChartHeight, MainChartInstance);
        }
        else {
            IndicatorChart.DrawIndicatorBaseChartWithoutData(IndicatorChart.ChartHeight, MainChartInstance);
        }
        IndicatorChart.DrawIndicatorBaseChartWithoutData(IndicatorChart.ChartHeight, MainChartInstance);
        $.each(IndicatorChart.OnTimeFrameChanged, function (i, f) { if ($.isFunction(f)) f(Time); });
    };

    IndicatorChart.GetYaxis = function (Price) {
        var YAxis = (IndicatorChart.ComputationProperties.yMax - Price) * IndicatorChart.ComputationProperties.steps;
        return Math.round(YAxis);
    };

    IndicatorChart.GetPrice = function (YAxis) {
        var Price;
        Price = ((IndicatorChart.ComputationProperties.height - YAxis) / IndicatorChart.ComputationProperties.steps) + IndicatorChart.ComputationProperties.yMin;

        return Price;
    };


    IndicatorChart.GetDate = function (XAxis) {
        var IndexNumber;
        if (IndicatorChart.ChartOtherProperties.dataAdded === 1) {
            IndexNumber = (Math.floor((IndicatorChart.ComputationProperties.width - (XAxis - (IndicatorChart.ComputationProperties.BarSpace / 2))) / IndicatorChart.ComputationProperties.BarSpace) + IndicatorChart.DataStartInternal) - 1 - (IndicatorChart.ComputationProperties.ZoomCollection[IndicatorChart.ChartSettings.ZoomLevel] - 1);
        }
        else {
            IndexNumber = (Math.floor((IndicatorChart.ComputationProperties.width - (XAxis - (IndicatorChart.ComputationProperties.BarSpace / 2))) / IndicatorChart.ComputationProperties.BarSpace) + IndicatorChart.DataStartInternal);
        }
        var DateOfIndex;

        if (IndexNumber < 0) {
            IndexNumber = 0;
        }

        DateOfIndex = ISOStringToDate(IndicatorChart.ChartOtherProperties.ChartData[IndexNumber].Stamp());

        return DateOfIndex;
    };

    function CheckDecimalPlaces(Price) {
        var strPrice = Price.toString();
        var counter;
        var startCounter = false;
        for (var character in strPrice) {
            var index = parseInt(character);
            var letter = strPrice.charAt(index);
            if (startCounter) {
                counter++;
                if (counter >= 5) { break; }
            }
            if (letter === ".") {
                counter = 0;
                startCounter = true;
            }
        }

        return counter;
    }

    function numberOfZeros(val) {
        return -Math.floor(Math.log(val) / Math.log(10) + 1);
    }

    function VerticalIndicators() {
        var HeightUsedToDraw = IndicatorChart.ComputationProperties.height;
        // var yValueMax = IndicatorChart.GetPrice(0);;
        // var yValueMin = IndicatorChart.GetPrice((HeightUsedToDraw));
        // var DeciamlPlaces = CheckDecimalPlaces(yValueMax);
        // IndicatorChart.ctxMainCanvas.width = IndicatorChart.ctxMainCanvas.
        //IndicatorChart.ctxMainCanvas.beginPath();
        //IndicatorChart.ctxMainCanvas.moveTo(IndicatorChart.ComputationProperties.width, 5);
        //IndicatorChart.ctxMainCanvas.lineTo(IndicatorChart.ComputationProperties.width + 7, 5);
        //IndicatorChart.ctxMainCanvas.stroke();
        var ZeroNum = numberOfZeros(IndicatorChart.ComputationProperties.yMax);
        var ComputedDigits = (ZeroNum > 0) ? (ZeroNum + 3) : 2;
        IndicatorChart.ctxMainCanvas.fillStyle = MainChartInstance.ChartSettings.ForeGround;
        IndicatorChart.ctxMainCanvas.font = "bold 10px Arial";

        IndicatorChart.ctxMainCanvas.fillText(IndicatorChart.ComputationProperties.OriginalYMax.toFixed(ComputedDigits), IndicatorChart.ComputationProperties.width + 3, 5 + 3);
        //IndicatorChart.ctxMainCanvas.beginPath();
        //IndicatorChart.ctxMainCanvas.moveTo(IndicatorChart.ComputationProperties.width, HeightUsedToDraw - 5);
        //IndicatorChart.ctxMainCanvas.lineTo(IndicatorChart.ComputationProperties.width + 7, HeightUsedToDraw - 5);
        //IndicatorChart.ctxMainCanvas.stroke();
        IndicatorChart.ctxMainCanvas.fillStyle = MainChartInstance.ChartSettings.ForeGround;
        IndicatorChart.ctxMainCanvas.font = "bold 10px Arial";

        IndicatorChart.ctxMainCanvas.fillText(IndicatorChart.ComputationProperties.OriginalYMin.toFixed(ComputedDigits), IndicatorChart.ComputationProperties.width + 3, (HeightUsedToDraw - 5) + 2);
        //  console.log("yMin = " + IndicatorChart.ComputationProperties.yMin);
        if (IndicatorChart.ComputationProperties.yMin < 0) {
            var ZeroLine = IndicatorChart.GetYaxis(0);
            IndicatorChart.ctxMainCanvas.strokeStyle = MainChartInstance.ChartSettings.ForeGround
            IndicatorChart.ctxMainCanvas.beginPath();
            IndicatorChart.ctxMainCanvas.moveTo(IndicatorChart.ComputationProperties.width, ZeroLine);
            IndicatorChart.ctxMainCanvas.lineTo(IndicatorChart.ComputationProperties.width + 7, ZeroLine);
            IndicatorChart.ctxMainCanvas.stroke();
            IndicatorChart.ctxMainCanvas.fillStyle = MainChartInstance.ChartSettings.ForeGround;
            IndicatorChart.ctxMainCanvas.fillText(0, IndicatorChart.ComputationProperties.width + 10, ZeroLine + 4);
            IndicatorChart.drawIndicatorDashedLine(IndicatorChart.ctxMainCanvas, IndicatorChart.ComputationProperties.width, ZeroLine, 0, ZeroLine, [4, 2, 4, 2], 'black', 0.25);
        }

    }

    function ReComputeComputedHightWidthOfMarker() {
        var TempWidth = MainChartInstance.ComputationProperties.width;
        if (MainChartInstance.ComputationProperties.DataLength < MainChartInstance.ComputationProperties.NumbersOfVisibleBars && MainChartInstance.ChartValidationsProperties.isDataReady) {
            TempWidth = MainChartInstance.ComputationProperties.XPositionFirstData;
        }
        if (MainChartInstance.ChartOtherProperties.HoveredXaxis < TempWidth + (MainChartInstance.ComputationProperties.BarSpace / 2)) {
            //Validation if the current data hovered is less than 0 this is to handle negative value to prevent miscalculations
            if (MainChartInstance.ComputationProperties.dataNumber < 0) {
                HideChartMarkers();
                return;
            }
            //validation so that the marker will not go outisde the drawing area
            if (MainChartInstance.ComputationProperties.dataNumber < MainChartInstance.ComputationProperties.DataStartInternal) {
                HideChartMarkers();
                return;
            }
            //validation so that the marker will not go beyond the last data
            if (MainChartInstance.ComputationProperties.dataNumber > MainChartInstance.ComputationProperties.DataEndInternal - 1) {
                HideChartMarkers();
                return;
            }
            if (GetIndexOfData(MainChartInstance.ChartOtherProperties.HoveredXaxis, true) < 0 || MainChartInstance.ChartOtherProperties.HoveredXaxis >= TempWidth + (MainChartInstance.ComputationProperties.BarSpace / 2) || GetIndexOfData(MainChartInstance.ChartOtherProperties.HoveredXaxis, true) > MainChartInstance.ComputationProperties.DataLength - 1) {
                HideChartMarkers();
                return;
            }
        }

        else {
            HideChartMarkers();
            return;
        }
        var VerticalPositionX = Math.round((((TempWidth - MainChartInstance.ComputationProperties.BarSpace * ((MainChartInstance.ComputationProperties.dataNumber) - MainChartInstance.ComputationProperties.DataStartInternal)) - (MainChartInstance.ChartOtherProperties.dataAdded * MainChartInstance.ComputationProperties.DefaultBarsWidth)) - ((MainChartInstance.ComputationProperties.BarSpace - MainChartInstance.ComputationProperties.barsMargin) / 2)) - 1);
        mastercontainterverticalmarker.css({ display: "block" });
        //Condition if marker should be about half of its size. to avoid ovelapping
        if (MainChartInstance.ChartOtherProperties.dataAdded === 0 && MainChartInstance.ComputationProperties.dataNumber === MainChartInstance.ComputationProperties.DataStartInternal && (MainChartInstance.ComputationProperties.DataLength > MainChartInstance.ComputationProperties.NumbersOfVisibleBars && MainChartInstance.ChartValidationsProperties.isDataReady)) {

            mastercontainterverticalmarker.css({
                height: MainChartInstance.ComputationProperties.height,
                top: 0,
                width: Math.round((MainChartInstance.ComputationProperties.BarSpace - MainChartInstance.ComputationProperties.barsMargin) / 2),
                left: Math.round((TempWidth - MainChartInstance.ComputationProperties.BarSpace * (MainChartInstance.ComputationProperties.dataNumber + MainChartInstance.ComputationProperties.MarginOfBar - MainChartInstance.ComputationProperties.DataStartInternal)) - ((MainChartInstance.ComputationProperties.BarSpace - MainChartInstance.ComputationProperties.barsMargin) / 2)),
                "border-color": MainChartInstance.ChartSettings.Marker
            });
            mastercontainterverticalmarker.find('div').css({ "background-color": MainChartInstance.ChartSettings.Marker });
        }
        else if (VerticalPositionX < 0) {
            mastercontainterverticalmarker.css({
                height: MainChartInstance.ComputationProperties.height,
                width: Math.round((MainChartInstance.ComputationProperties.BarSpace - MainChartInstance.ComputationProperties.barsMargin) + VerticalPositionX),
                left: 0,
                top: 0,
                "border-color": MainChartInstance.ChartSettings.Marker
            });
            mastercontainterverticalmarker.find('div').css({ "background-color": MainChartInstance.ChartSettings.Marker });
        }
        else {
            mastercontainterverticalmarker.css({
                height: MainChartInstance.ComputationProperties.height,
                width: Math.round(MainChartInstance.ComputationProperties.BarSpace - MainChartInstance.ComputationProperties.barsMargin),
                top: 0,
                left: VerticalPositionX,
                "border-color": MainChartInstance.ChartSettings.Marker
            });
            mastercontainterverticalmarker.find('div').css({ "background-color": MainChartInstance.ChartSettings.Marker });

        }
        if (MainChartInstance.ChartOtherProperties.HoveredYaxis < MainChartInstance.ComputationProperties.height) {

        }
        else {
            HideChartMarkers();
        }
        VerticalPositionX = null;
        HeightToCondition = null;

    }

    function HideChartMarkers() {
        mastercontainterverticalmarker.css({ display: "none" });

    }

    //Set ALl Elements needed to created marker/legend etc.
    function SetAllMarkersLegendAndOtherElementsNeeded() {
        //~~~Creating the Marker of the chart~~~
        mastercontainterverticalmarker = $('<div class="MarkerVertical" style="z-index:6;display:none;height: ' + IndicatorChart.ComputationProperties.height + 'px;width: 26px;position: absolute;background: transparent;border-left: solid 1.5px;border-right: solid 1.5px;border-color: green;  opacity: 0.7;left: 50px;"><div style="height: 100%;  width: 100%;  position: absolute;  background: green;  opacity: 0.4;"></div></div>');
        IndicatorChart.BaseChartElement.append(mastercontainterverticalmarker);
    }

    //Function To get Index of the chart using X Axis
    function GetIndexOfData(X, IncludeValidation) {
        var IndexResult = 0;
        var TempWidth = MainChartInstance.ComputationProperties.width;
        if (MainChartInstance.ComputationProperties.DataLength < MainChartInstance.ComputationProperties.NumbersOfVisibleBars && MainChartInstance.ChartValidationsProperties.isDataReady) {
            TempWidth = MainChartInstance.ComputationProperties.XPositionFirstData;
        }
        if (MainChartInstance.ChartOtherProperties.dataAdded === 1) {
            IndexResult = (Math.floor((TempWidth - (X - (MainChartInstance.ComputationProperties.BarSpace / 2))) / MainChartInstance.ComputationProperties.BarSpace) + MainChartInstance.ComputationProperties.DataStartInternal) - 1 - (MainChartInstance.ComputationProperties.ZoomCollection[MainChartInstance.ChartSettings.ZoomLevel] - 1);
        }
        else {
            IndexResult = (Math.floor((TempWidth - (X - (MainChartInstance.ComputationProperties.BarSpace / 2))) / MainChartInstance.ComputationProperties.BarSpace) + MainChartInstance.ComputationProperties.DataStartInternal);
        }

        if (!IncludeValidation) {
            var ChartDataLength = MainChartInstance.ChartOtherProperties.ChartData.length;
            if (IndexResult > ChartDataLength - 1) {
                IndexResult = ChartDataLength - 1;
            }
        }

        if (IndexResult < 0) {
            IndexResult = 0;
        }
        return IndexResult;
    }

    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
};

WC.CM.TickChart = function (Container, options) {
    var self = this;
    WC.CM.BaseChart.call(this, Container, options);
    var TakeProfitInternal = 0;
    var StopLossInternal = 0;
    var RateInternal = 0;
    var DigitSubscription = null;
    var DataSubscription = null;
    var zIndexVisualTools = 9;
    //Elements in variables
    var AskDataIndicator;
    var AskDataIndicatorLabel;
    var BidDataIndicator;
    var BidDataIndicatorLabel;
    var TakeProfitLineIndicator;
    var RateLineIndicator;
    var StopLossLineIndicator;
    var TakeProfitDataIndicator;
    var TakeProfitDataIndicatorLabel;
    var StopLossDataIndicator;
    var StopLossDataIndicatorLabel;
    var RateDataIndicator;
    var RateDataIndicatorLabel;
    var VisualToolsCanvas = $(self.VisualToolsCanvas);

    var QuotesViewModel = {
        Quotes: ValidateObservableProperty(options.Data.Quotes, "Quotes", true),
        Ticks: ValidateObservableProperty(options.Data.Ticks, "Ticks", true),
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

    AppendElementNeeded();

    if (QuotesViewModel.Quotes().length === 0) {
        DigitSubscription = QuotesViewModel.Quotes.subscribe(SetDigits);
    }
    else {
        SetDigits();
    }

    self.DrawBaseChartWithOutData();

    CheckDataInQuotes();


    function SetDigits() {
        var QuotesLength = QuotesViewModel.Quotes().length;
        for (var i = 0; i < QuotesLength; i++) {
            if (QuotesViewModel.Quotes()[i].Symbol() === self.ChartSettings.Symbol) {
                self.ChartValidationsProperties.isDigitsReady = true;
                if (DigitSubscription !== null) {
                    DigitSubscription.dispose();
                }
                self.Digits = QuotesViewModel.Quotes()[i].Digits();
                if (self.ChartValidationsProperties.isDataReady) {
                    ComputeVariablesNeeded();
                    DrawTickChartAll();
                    return;
                }
            }
        }
    }

    function DrawSymbolIndicator() {
        self.ctxMainCanvas.fillStyle = "black";
        self.ctxMainCanvas.font = "13px Arial";
        self.ctxMainCanvas.fillText(self.ChartSettings.Symbol, 4, 16);
    }

    function AddChartData(newValue) {
        var TicksLength = QuotesViewModel.Ticks().length;
        for (var i = 0; i < TicksLength; i++) {
            var tick = QuotesViewModel.Ticks()[i];
            if (tick.Symbol() === self.ChartSettings.Symbol) {
                self.ChartOtherProperties.ChartData = tick.TickItems();
                if (self.ChartOtherProperties.ChartData.length < 50) {
                    if (self.ComputationProperties.NumbersOfVisibleBars > 0 || self.ComputationProperties.NumbersOfVisibleBars === null) {
                        //tick.RequestTicks(self.ComputationProperties.NumbersOfVisibleBars * 2);
                    }
                }
                self.ChartValidationsProperties.isDataReady = true;
                if (!self.ChartValidationsProperties.isDigitsReady) {
                    tick = null;
                    return;
                }
                DrawTickChartAll();
                tick = null;
                return;
            }
            tick = null;
        }
        newValue = null;
    }

    function CheckDataInQuotes() {
        if (DataSubscription !== null) {
            DataSubscription.dispose();
            DataSubscription = null;
        }
        var TicksLength = QuotesViewModel.Ticks().length;
        for (var i = 0; i < TicksLength; i++) {
            if (QuotesViewModel.Ticks()[i].Symbol() === self.ChartSettings.Symbol) {
                AddChartData();
                DataSubscription = QuotesViewModel.Ticks()[i].TickItems.subscribe(AddChartData);
                return;
            }
        }
        DataSubscription = QuotesViewModel.Ticks.subscribe(CheckDataInQuotes);
    }

    function DrawTickChartAll() {
        if (self.ParentELement.css('display') === 'none' || self.ParentELement.height() === 0) return;
        ComputeVariablesNeeded();
        if (self.ChartOtherProperties.ChartData === null) {
            CheckDataInQuotes();
            return;
        }

        if (self.ChartOtherProperties.ChartData.length !== 0) {
            if (self.ChartOtherProperties.ChartData[0].Ask() <= 0) {
                self.DrawBaseChartWithOutData();
                return;
            }
        }
        SetYminYmax();
        if (TakeProfitInternal !== 0) {
            if (TakeProfitInternal > self.ComputationProperties.yMax) {
                self.ComputationProperties.yMax = TakeProfitInternal;
            }
            else if (TakeProfitInternal < self.ComputationProperties.yMin) {
                self.ComputationProperties.yMin = TakeProfitInternal;
            }
        }

        if (StopLossInternal !== 0) {
            if (StopLossInternal > self.ComputationProperties.yMax) {
                self.ComputationProperties.yMax = StopLossInternal;
            }
            else if (StopLossInternal < self.ComputationProperties.yMin) {
                self.ComputationProperties.yMin = StopLossInternal;
            }
        }
        if (RateInternal !== 0) {
            if (RateInternal > self.ComputationProperties.yMax) {
                self.ComputationProperties.yMax = RateInternal;
            }
            else if (RateInternal < self.ComputationProperties.yMin) {
                self.ComputationProperties.yMin = RateInternal;
            }
        }
        self.SetTranslateAllContext();
        SetVariablesNeededToDrawChart();
        SetTopMarginChart();
        SetBottomMarginChart();
        self.DrawBaseChart();
        DrawTickChart();
        SetElementPositionAndData();
        SetTakeProfitIndicator();
        SetStopLossIndicator();
        SetRateIndicator();
        if (self.ChartSettings.ShowSymbolIndicator) {
            DrawSymbolIndicator();
        }
    }

    function AppendElementNeeded() {
        AskDataIndicator = $('<div class="AskDataIndicator" style="z-index:6;visibility:hidden; width:60px;height:15px;background: red;color: white;position: absolute;left: 0;"><label style="display: block;line-height: 15px;font-size: 10px;text-align: center;"></label></div>');
        AskDataIndicatorLabel = AskDataIndicator.find('label');
        self.BaseChartElement.append(AskDataIndicator);
        BidDataIndicator = $('<div class="BidDataIndicator" style="z-index:6;visibility:hidden; width:60px;height:15px;background: green;color: white;position: absolute;left: 0;"><label style="display: block;line-height: 15px;font-size: 10px;text-align: center;"></label></div>');
        BidDataIndicatorLabel = BidDataIndicator.find('label');
        self.BaseChartElement.append(BidDataIndicator);

        TakeProfitLineIndicator = $('<div class="TakeProfitLineIndicator" style="z-index:6;visibility:hidden;">');
        self.BaseChartElement.append(TakeProfitLineIndicator);

        RateLineIndicator = $('<div class="RateLineIndicator" style="z-index:6;visibility:hidden;">');
        self.BaseChartElement.append(RateLineIndicator);

        StopLossLineIndicator = $('<div class="StopLossLineIndicator" style="z-index:6;visibility:hidden;height:2px;width: ' + self.ComputationProperties.width + 'px;position: absolute;background: green;border-left: solid 1.5px;border-right: solid 1.5px;border-color: green; left: 0px; top:0px;">');
        self.BaseChartElement.append(StopLossLineIndicator);

        TakeProfitDataIndicator = $('<div class="TakeProfitDataIndicator" style="z-index:6;visibility:hidden; width:100px;height:15px;color: white;position: absolute;left: 0;"><label style="display: block;padding-top: 2px;font-size: 10px;text-align: left;margin-left:7px;"></label></div>');
        TakeProfitDataIndicatorLabel = TakeProfitDataIndicator.find('label');
        self.BaseChartElement.append(TakeProfitDataIndicator);

        StopLossDataIndicator = $('<div class="StopLossDataIndicator" style="z-index:6;visibility:hidden; width:100px;height:15px;color: red;position: absolute;left: 0;"><label style="display: block;padding-top: 2px;font-size: 10px;text-align: left;margin-left:7px;"></label></div>');
        StopLossDataIndicatorLabel = StopLossDataIndicator.find('label');
        self.BaseChartElement.append(StopLossDataIndicator);

        RateDataIndicator = $('<div class="RateDataIndicator" style="z-index:6;visibility:hidden; width:100px;height:15px;color: red;position: absolute;left: 0;"><label style="display: block;padding-top: 2px;font-size: 10px;text-align: left;margin-left:7px;"></label></div>');
        RateDataIndicatorLabel = RateDataIndicator.find('label');
        self.BaseChartElement.append(RateDataIndicator);

    }

    function SetElementPositionAndData() {
        //Computaion for Y Axis or the Y position of the container
        var CurrentPositionTopAsk = GetYaxis(self.ChartOtherProperties.ChartData[0].Ask()) - 6;
        var CurrentPositionTopBid = GetYaxis(self.ChartOtherProperties.ChartData[0].Bid()) - 6;

        //validation so that the container of the data will not overlap the main Chart container
        if (CurrentPositionTopAsk < 0) {
            CurrentPositionTopAsk = 0;
        }

        if (CurrentPositionTopBid < 0) {
            CurrentPositionTopBid = 0;
        }

        //setting position in the ask data handler and assigning text
        AskDataIndicator.removeAttr("style");
        AskDataIndicator.attr("style", 'z-index:6;visibility:visible;width: 60px;height: 15px;background: red;color: white;position: absolute;right: 0; top:' + CurrentPositionTopAsk + "px");
        AskDataIndicatorLabel.text(self.ChartOtherProperties.ChartData[0].Ask().toFixed(self.Digits));
        //setting position in the bid data handler and assigning text
        BidDataIndicator.removeAttr("style");
        BidDataIndicator.attr("style", 'z-index:6;visibility:visible;width: 60px;height: 15px;background: green;color: white;position: absolute;right: 0; top:' + CurrentPositionTopBid + "px");
        BidDataIndicatorLabel.text(self.ChartOtherProperties.ChartData[0].Bid().toFixed(self.Digits));

    }

    function SetTakeProfitIndicator() {
        if (TakeProfitInternal > 0) {
            var topPosition = GetYaxis(TakeProfitInternal);

            TakeProfitLineIndicator.removeAttr("style");
            TakeProfitLineIndicator.attr("style", 'visibility:visible;z-index:6;height:2px;width: ' + self.ComputationProperties.width + 'px;position: absolute;background: blue;border-left: solid 1.5px;border-right: solid 1.5px;border-color: green; left: 0px; top:' + topPosition + 'px;');

            //Set position and the data in take profit
            TakeProfitDataIndicator.removeAttr("style");
            TakeProfitDataIndicator.attr("style", 'z-index:6; color:blue;visibility:visible; width:150px;height:15px;position: absolute;left: 0;top:' + (topPosition - 17) + 'px');
            TakeProfitDataIndicatorLabel.text('Take Profit: ' + FormatNumber(TakeProfitInternal));
        }
        else {
            TakeProfitLineIndicator.css({ display: "none" });
            TakeProfitDataIndicator.css({ display: "none" });
        }
    }

    function SetRateIndicator() {
        if (RateInternal > 0) {
            var topPosition = GetYaxis(RateInternal);

            RateLineIndicator.removeAttr("style");
            RateLineIndicator.attr("style", 'visibility:visible;z-index:6;height:2px;width: ' + self.ComputationProperties.width + 'px;position: absolute;background: black;border-left: solid 1.5px;border-right: solid 1.5px;border-color: green; left: 0px; top:' + topPosition + 'px;');

            //Set position and the data in take profit
            RateDataIndicator.removeAttr("style");
            RateDataIndicator.attr("style", 'z-index:6; color:black;visibility:visible; width:150px;height:15px;position: absolute;left: 0;top:' + (topPosition - 17) + 'px');
            RateDataIndicatorLabel.text('Rate: ' + FormatNumber(RateInternal));
        }
        else {
            RateLineIndicator.css({ display: "none" });
            RateDataIndicator.css({ display: "none" });
        }
    }

    function SetStopLossIndicator() {
        if (StopLossInternal > 0) {
            var topPosition = GetYaxis(StopLossInternal);
            StopLossLineIndicator.removeAttr("style");
            StopLossLineIndicator.attr("style", 'z-index:6;visibility:visible;height:2px;width: ' + self.ComputationProperties.width + 'px;position: absolute;background: red;border-left: solid 1.5px;border-right: solid 1.5px;border-color: green; left: 0px; top:' + topPosition + 'px;');

            //Set position and the data in take profit
            StopLossDataIndicator.removeAttr("style");
            StopLossDataIndicator.attr("style", 'z-index:6; color:red;visibility:visible; width:150px;height:15px;position: absolute;left: 0;top:' + (topPosition - 17) + 'px');
            StopLossDataIndicatorLabel.text('Stop Loss: ' + FormatNumber(StopLossInternal));
        }
        else {
            StopLossLineIndicator.css({ display: "none" });
            StopLossDataIndicator.css({ display: "none" });
        }
    }

    function ComputeVariablesNeeded() {
        //Height Of the Container
        self.BaseChartElement.attr('style', 'background-color:white;position:relative;height:' + (self.ParentELement.height()) + 'px');
        self.OHLCCanvas.width = self.ParentELement.width();
        self.OHLCCanvas.height = self.ParentELement.height();
        self.VolumeCanvas.width = self.ParentELement.width();
        self.VolumeCanvas.height = self.ParentELement.height();
        self.GridLineCanvas.width = self.ParentELement.width();
        self.GridLineCanvas.height = self.ParentELement.height();
        self.IndicatorTopCanvas.width = self.ParentELement.width() - 60;
        self.IndicatorTopCanvas.height = self.ParentELement.height() - 20;
        self.TradesCanvas.width = self.ParentELement.width() - 60;
        self.TradesCanvas.height = self.ParentELement.height() - 20;
        self.OrdersCanvas.width = self.ParentELement.width() - 60;
        self.OrdersCanvas.height = self.ParentELement.height() - 20;
        self.VisualToolsCanvas.width = self.ParentELement.width() - 60;
        self.VisualToolsCanvas.height = self.ParentELement.height() - 20;
        VisualToolsCanvas.attr('width', self.ParentELement.width() - 60);
        VisualToolsCanvas.attr('height', self.ParentELement.height() - 20);
        $(self.ParentELement).find('.canvas-container canvas').attr('style', 'position: absolute;top:0; left: 0px; z-index: ' + zIndexVisualTools + ';width:' + (self.ParentELement.width() - 60) + 'px; height:' + (self.ParentELement.height() - 20) + 'px;');
        $(self.ParentELement).find('.canvas-container').attr('style', 'position: relative; -webkit-user-select: none; width:' + self.ParentELement.width() + 'px; height:' + self.ParentELement.height() + 'px;');
        self.IndicatorBotCanvas.width = self.ParentELement.width() - 60;
        self.IndicatorBotCanvas.height = self.ParentELement.height() - 20;
        self.BaseChartElement.height = self.ParentELement.height();
        self.DraggingCanvas.width = self.ParentELement.width();
        self.DraggingCanvas.height = self.ParentELement.height();
        //Height Of the Container
        self.ComputationProperties.height = self.ParentELement.height() - 20;
        //width of the container
        self.ComputationProperties.width = self.ParentELement.width() - 60;
        //This is the fefault BarsWidth
        self.ComputationProperties.DefaultBarsWidth = 32;
        self.ChartSettings.ZoomLevel = 4;
        //Computed BarsWidth Depending on the Zoom Level
        self.ComputationProperties.BarSpace = self.ComputationProperties.DefaultBarsWidth / self.ComputationProperties.ZoomCollection[self.ChartSettings.ZoomLevel];
        self.ChartOtherProperties.DragSensetivity = (self.ComputationProperties.BarSpace - self.ComputationProperties.barsMargin) / 2;
        //
        self.ChartOtherProperties.DottedXaxisVisibleBars = self.ComputationProperties.width / self.ComputationProperties.DefaultBarsWidth;
        self.ChartOtherProperties.DottedYAxisVisibleBars = self.ComputationProperties.height / self.ComputationProperties.DefaultBarsWidth;
        if (self.ChartValidationsProperties.isDataReady) {
            self.ComputationProperties.DataLength = self.ChartOtherProperties.ChartData.length;
        }
        self.ComputationProperties.NumbersOfVisibleBars = Math.ceil((self.ComputationProperties.width - self.ComputationProperties.DefaultBarsWidth) / self.ComputationProperties.BarSpace);
        self.ComputationProperties.DataEndInternal = Math.round(self.ComputationProperties.NumbersOfVisibleBars) + self.ComputationProperties.DataStartInternal;
        if (self.ComputationProperties.DataStartInternal !== 0) {
            self.ComputationProperties.DataEndInternal = self.ComputationProperties.DataEndInternal + 1;
            self.ChartOtherProperties.dataAdded = 0;
        }
        else {
            self.ChartOtherProperties.dataAdded = 1;
        }
        self.ComputationProperties.BarsWidth = self.ComputationProperties.BarSpace - self.ComputationProperties.barsMargin;

    }

    function SetVariablesNeededToDrawChart() {
        self.ComputationProperties.difference = self.ComputationProperties.yMax - self.ComputationProperties.yMin;
        self.ComputationProperties.steps = self.ComputationProperties.height / self.ComputationProperties.difference;
        self.ComputationProperties.LineNumber = self.ComputationProperties.height / self.ComputationProperties.DefaultBarsWidth;
        self.ComputationProperties.barsMargin = self.ComputationProperties.BarSpace * 0.20;
    }

    function SetTopMarginChart() {
        self.ComputationProperties.difference = self.ComputationProperties.yMax - self.ComputationProperties.yMin;
        self.ComputationProperties.steps = self.ComputationProperties.height / self.ComputationProperties.difference;
        self.ComputationProperties.LineNumber = self.ComputationProperties.height / self.ComputationProperties.DefaultBarsWidth;
        self.ComputationProperties.barsMargin = self.ComputationProperties.BarSpace * 0.20;

        self.ComputationProperties.yMax = self.ComputationProperties.yMax + (50 / self.ComputationProperties.steps);

        self.ComputationProperties.difference = self.ComputationProperties.yMax - self.ComputationProperties.yMin;
        self.ComputationProperties.steps = self.ComputationProperties.height / self.ComputationProperties.difference;
        self.ComputationProperties.LineNumber = self.ComputationProperties.height / self.ComputationProperties.DefaultBarsWidth;
        self.ComputationProperties.barsMargin = self.ComputationProperties.BarSpace * 0.20;
    }

    function SetBottomMarginChart() {
        self.ComputationProperties.difference = self.ComputationProperties.yMax - self.ComputationProperties.yMin;
        self.ComputationProperties.steps = self.ComputationProperties.height / self.ComputationProperties.difference;
        self.ComputationProperties.LineNumber = self.ComputationProperties.height / self.ComputationProperties.DefaultBarsWidth;
        self.ComputationProperties.barsMargin = self.ComputationProperties.BarSpace * 0.20;

        self.ComputationProperties.yMin = self.ComputationProperties.yMin - (10 / self.ComputationProperties.steps);

        self.ComputationProperties.difference = self.ComputationProperties.yMax - self.ComputationProperties.yMin;
        self.ComputationProperties.steps = self.ComputationProperties.height / self.ComputationProperties.difference;
        self.ComputationProperties.LineNumber = self.ComputationProperties.height / self.ComputationProperties.DefaultBarsWidth;
        self.ComputationProperties.barsMargin = self.ComputationProperties.BarSpace * 0.20;
    }

    function SetYminYmax() {
        ////Getting the Ymin and Ymax of the chart
        if (self.ComputationProperties.DataEndInternal > self.ComputationProperties.DataLength) {
            self.ComputationProperties.DataEndInternal = self.ComputationProperties.DataLength;
        }
        for (var i = self.ComputationProperties.DataStartInternal; i < self.ComputationProperties.DataEndInternal; i++) {
            if (i === self.ComputationProperties.DataStartInternal) {
                self.ComputationProperties.yMax = self.ChartOtherProperties.ChartData[i].Ask();
                self.ComputationProperties.yMin = self.ChartOtherProperties.ChartData[i].Bid();

            }
            if (self.ChartOtherProperties.ChartData[i].Ask() > self.ComputationProperties.yMax) {
                self.ComputationProperties.yMax = self.ChartOtherProperties.ChartData[i].Ask();
            }
            if (self.ChartOtherProperties.ChartData[i].Bid() > self.ComputationProperties.yMax) {
                self.ComputationProperties.yMax = self.ChartOtherProperties.ChartData[i].Bid();
            }

            if (self.ChartOtherProperties.ChartData[i].Ask() < self.ComputationProperties.yMin) {
                self.ComputationProperties.yMin = self.ChartOtherProperties.ChartData[i].Ask();
            }
            if (self.ChartOtherProperties.ChartData[i].Bid() < self.ComputationProperties.yMin) {
                self.ComputationProperties.yMin = self.ChartOtherProperties.ChartData[i].Bid();
            }
        }
        if (self.ComputationProperties.yMin > self.ComputationProperties.yMax) {
            var Temp = self.ComputationProperties.yMax;
            self.ComputationProperties.yMax = self.ComputationProperties.yMin;
            self.ComputationProperties.yMin = Temp;
        }


    }

    function FormatNumber(Numnber) {
        // Fix for decimal places
        var currentValue = Numnber.toString();
        var decimalIndex = currentValue.indexOf(".");

        if (decimalIndex >= 0) {
            var decimalLength = currentValue.length - decimalIndex - 1;

            while (decimalLength < self.Digits) {
                currentValue = currentValue + "0";
                decimalLength = currentValue.length - decimalIndex - 1;
            }
        } else {
            var decimalValue = ".";
            for (var i = 0; i < 2; i++) {
                decimalValue = decimalValue + "0";
            }

            currentValue = currentValue + decimalValue;
        }

        return currentValue;
    }

    function DrawTickChart() {
        var TempWidth = self.ComputationProperties.width;
        self.ComputationProperties.MarginOfBar = self.ChartOtherProperties.dataAdded;
        if (self.ComputationProperties.DataLength < self.ComputationProperties.NumbersOfVisibleBars && self.ChartValidationsProperties.isDataReady) {
            TempWidth = self.ComputationProperties.XPositionFirstData;

            if (self.ChartOtherProperties.dataAdded !== 0) {
                self.ComputationProperties.MarginOfBar = Math.round(self.ChartOtherProperties.dataAdded + (self.ComputationProperties.ZoomCollection[self.ChartSettings.ZoomLevel]));
            }
            var i;
            //~~Draw Ask Line On chart~~
            self.ctxMainCanvas.beginPath();
            self.ctxMainCanvas.strokeStyle = 'red';
            for (i = self.ComputationProperties.DataEndInternal - 1; i >= self.ComputationProperties.DataStartInternal; i--) {
                var Xposition = GetYaxis(self.ChartOtherProperties.ChartData[i].Ask());
                if (i === self.ComputationProperties.DataEndInternal - 1) {
                    self.ctxMainCanvas.moveTo(0, Xposition);
                }
                self.ctxMainCanvas.lineTo(Math.round(self.ComputationProperties.BarSpace * (self.ComputationProperties.DataEndInternal - 1 - i)), Xposition);
                if (i === self.ComputationProperties.DataStartInternal) {
                    self.ctxMainCanvas.lineTo(self.ComputationProperties.width, Xposition);
                }
            }
            self.ctxMainCanvas.stroke();

            //~~~Draw Bid Line On chart~~~
            self.ctxMainCanvas.beginPath();
            self.ctxMainCanvas.strokeStyle = 'green';
            for (i = self.ComputationProperties.DataEndInternal - 1; i >= self.ComputationProperties.DataStartInternal; i--) {
                var Xposition = GetYaxis(self.ChartOtherProperties.ChartData[i].Bid());
                if (i === self.ComputationProperties.DataEndInternal - 1) {
                    self.ctxMainCanvas.moveTo(0, Xposition);
                }
                self.ctxMainCanvas.lineTo(Math.round(self.ComputationProperties.BarSpace * (self.ComputationProperties.DataEndInternal - 1 - i)), Xposition);
                if (i === self.ComputationProperties.DataStartInternal) {
                    self.ctxMainCanvas.lineTo(self.ComputationProperties.width, Xposition);
                }
            }
            //~~~~~~~~~~~~~~~~~~~~~~~~~~~
            self.ctxMainCanvas.stroke();

            ////~~Draw Ask Line On chart~~
            //self.ctxMainCanvas.beginPath();
            //self.ctxMainCanvas.strokeStyle = 'red';
            //for (i = self.ComputationProperties.DataStartInternal; i < self.ComputationProperties.DataEndInternal ; i++) {
            //    if (i === self.ComputationProperties.DataStartInternal) {
            //        self.ctxMainCanvas.moveTo(self.ComputationProperties.width, GetYaxis(self.ChartOtherProperties.ChartData[i].Ask()));
            //    }
            //    self.ctxMainCanvas.lineTo(Math.round(TempWidth - self.ComputationProperties.BarSpace * (i + self.ComputationProperties.MarginOfBar - self.ComputationProperties.DataStartInternal)), GetYaxis(self.ChartOtherProperties.ChartData[i].Ask()));
            //}
            //self.ctxMainCanvas.stroke();
            ////~~~~~~~~~~~~~~~~~~~~~~~~~~

            ////~~~Draw Bid Line On chart~~~
            //self.ctxMainCanvas.beginPath();
            //self.ctxMainCanvas.strokeStyle = 'green';
            //for (i = self.ComputationProperties.DataStartInternal; i < self.ComputationProperties.DataEndInternal ; i++) {
            //    if (i === self.ComputationProperties.DataStartInternal) {
            //        self.ctxMainCanvas.moveTo(self.ComputationProperties.width, GetYaxis(self.ChartOtherProperties.ChartData[i].Bid()));
            //    }
            //    self.ctxMainCanvas.lineTo(Math.round(TempWidth - self.ComputationProperties.BarSpace * (i + self.ComputationProperties.MarginOfBar - self.ComputationProperties.DataStartInternal)), GetYaxis(self.ChartOtherProperties.ChartData[i].Bid()));
            //}
            //self.ctxMainCanvas.stroke();
            ////~~~~~~~~~~~~~~~~~~~~~~~~~~~

        }
        else {
            if (self.ChartOtherProperties.dataAdded !== 0) {
                self.ComputationProperties.MarginOfBar = Math.round(self.ChartOtherProperties.dataAdded + (self.ComputationProperties.ZoomCollection[self.ChartSettings.ZoomLevel]));
            }
            var i;
            //~~Draw Ask Line On chart~~
            self.ctxMainCanvas.beginPath();
            self.ctxMainCanvas.strokeStyle = 'red';
            for (i = self.ComputationProperties.DataStartInternal; i < self.ComputationProperties.DataEndInternal ; i++) {
                if (i === self.ComputationProperties.DataStartInternal) {
                    self.ctxMainCanvas.moveTo(self.ComputationProperties.width, GetYaxis(self.ChartOtherProperties.ChartData[i].Ask()));
                }
                self.ctxMainCanvas.lineTo(Math.round(TempWidth - self.ComputationProperties.BarSpace * (i + self.ComputationProperties.MarginOfBar - self.ComputationProperties.DataStartInternal)), GetYaxis(self.ChartOtherProperties.ChartData[i].Ask()));
            }
            self.ctxMainCanvas.stroke();
            //~~~~~~~~~~~~~~~~~~~~~~~~~~

            //~~~Draw Bid Line On chart~~~
            self.ctxMainCanvas.beginPath();
            self.ctxMainCanvas.strokeStyle = 'green';
            for (i = self.ComputationProperties.DataStartInternal; i < self.ComputationProperties.DataEndInternal ; i++) {
                if (i === self.ComputationProperties.DataStartInternal) {
                    self.ctxMainCanvas.moveTo(self.ComputationProperties.width, GetYaxis(self.ChartOtherProperties.ChartData[i].Bid()));
                }
                self.ctxMainCanvas.lineTo(Math.round(TempWidth - self.ComputationProperties.BarSpace * (i + self.ComputationProperties.MarginOfBar - self.ComputationProperties.DataStartInternal)), GetYaxis(self.ChartOtherProperties.ChartData[i].Bid()));
            }
            self.ctxMainCanvas.stroke();
            //~~~~~~~~~~~~~~~~~~~~~~~~~~~
        }
    }

    function GetYaxis(Price) {
        if (typeof Price === "number") {
            if (!self.ChartValidationsProperties.isDigitsReady || !self.ChartValidationsProperties.isDataReady) {
                return null;
            }
            var YAxis = Math.round((self.ComputationProperties.yMax - Price) * self.ComputationProperties.steps);
            return YAxis;
        }
        else {
            console.log("Invalid Number: " + Price);
            return null;
        }
    }

    self.SetStopLoss = function (StopLoss) {
        if (StopLoss < 0 || StopLoss === null) {
            StopLossInternal = 0;
        }
        else {
            StopLossInternal = StopLoss;
        }
        DrawTickChartAll();
    };

    self.SetTakeProfit = function (TakeProfit) {
        if (TakeProfit < 0 || TakeProfit === null) {
            TakeProfitInternal = 0;
        }
        else {
            TakeProfitInternal = TakeProfit;
        }
        DrawTickChartAll();
    };

    self.SetRate = function (Rate) {
        if (Rate < 0 || Rate === null) {
            RateInternal = 0;
        }
        else {
            RateInternal = Rate;
        }
        DrawTickChartAll();
    };

    self.RefreshChart = function () {
        if (!self.ChartValidationsProperties.isDigitsReady || !self.ChartValidationsProperties.isDataReady) {
            IsRequestedTicks = false;
            ComputeVariablesNeeded();
            self.DrawBaseChartWithOutData();
        }
        else {
            AddChartData();
        }
    };

    self.ChangeSymbol = function (Symbol) {
        StopLossInternal = 0;
        TakeProfitInternal = 0;
        RateInternal = 0;
        AskDataIndicator.css({ display: "none" });
        BidDataIndicator.css({ display: "none" });
        TakeProfitLineIndicator.css({ display: "none" });
        StopLossLineIndicator.css({ display: "none" });
        TakeProfitDataIndicator.css({ display: "none" });
        StopLossDataIndicator.css({ display: "none" });
        RateDataIndicator.css({ display: "none" });
        RateLineIndicator.css({ display: "none" });
        self.ChartSettings.Symbol = Symbol;
        self.ChartValidationsProperties.isDataReady = false;
        IsRequestedTicks = false;
        SetDigits();
        self.DrawBaseChartWithOutData();
        CheckDataInQuotes();
    };

    self.Dispose = function () {
        AskDataIndicator = null;
        AskDataIndicatorLabel = null;
        BidDataIndicator = null;
        BidDataIndicatorLabel = null;
        TakeProfitLineIndicator = null;
        RateLineIndicator = null;
        StopLossLineIndicator = null;
        TakeProfitDataIndicator = null;
        TakeProfitDataIndicatorLabel = null;
        StopLossDataIndicator = null;
        StopLossDataIndicatorLabel = null;
        RateDataIndicator = null;
        RateDataIndicatorLabel = null;
        VisualToolsCanvas = null;
        self.ChartOtherProperties.ChartData = null;
        self.BaseChartElement = null;
        self.ChangeSymbol = null;
        self.ChartOtherProperties = null;
        self.ChartSettings = null;
        self.ChartValidationsProperties = null;
        self.ComputationProperties = null;
        self.Digits = null;
        self.Dispose = null;
        self.DraggingCanvas = null;
        self.DrawBaseChart = null;
        self.DrawBaseChartWithOutData = null;
        self.DrawIndicatorBaseChart = null;
        self.DrawIndicatorBaseChartWithoutData = null;
        self.GridLineCanvas = null;
        self.IndicatorBotCanvas = null;
        self.IndicatorTopCanvas = null;
        self.OHLCCanvas = null;
        self.TradesCanvas = null;
        self.OrdersCanvas = null;
        self.ParentELement = null;
        self.RefreshChart = null;
        self.SetRate = null;
        self.SetStopLoss = null;
        self.SetTakeProfit = null;
        self.SetTranslateAllContext = null;
        self.VisualToolsCanvas = null;
        self.VisualToolsInput = null;
        self.VolumeCanvas = null;
        self.ctxDragging = null;
        self.ctxGridLine = null;
        self.ctxIndicatorBotCanvas = null;
        self.ctxIndicatorTopCanvas = null;
        self.ctxMainCanvas = null;
        self.ctxTradesCanvas = null;
        self.ctxOrdersCanvas = null;
        self.ctxVisualToolsCanvas = null;
        self.ctxVolume = null;
        self.drawDashedLine = null;
        self.drawIndicatorDashedLine = null;
        self.settings = null;
        if (DigitSubscription !== null) {
            DigitSubscription.dispose();
            DigitSubscription = null;
        }
        if (DataSubscription !== null) {
            DataSubscription.dispose();
            DataSubscription = null;
        }
        self = null;
    };
};







