WC.IN = WC.IN || {};

var WorkerPath = 'Modules/Worker';
WC.IN.IndicatorWorker = new Worker(WorkerPath);
WC.IN.IndicatorCollection = [];
WC.IN.LowerIndicatorInstanceCollection = [];

var txtSettings = "Settings",
    txtRemoveIndicator = "Remove Indicator",
    txtRemoveAll = "Remove All",
    txtOnBars = "On Bars",
    txtAlligator = "Alligator",
    txtBollingerBands = "Bollinger Bands",
    txtDonchianChannel = "Donchian Channel",
    txtEnvelopeMovingAverage = "Envelope Moving Average",
    txtExponentialMovingAverage = "Exponential Moving Average",
    txtFractalChaosBands = "Fractal Chaos Bands",
    txtParabolicSAR = "Parabolic SAR",
    txtSimpleMovingAverage = "Simple Moving Average",
    txtWeightedMovingAverage = "Weighted Moving Average",

    txtOscillators = "Oscillators",
    txtAccumulativeSwingIndex = "Accumulative Swing Index",
    txtAverageTrueRange = "Average True Range",
    txtBearPower = "Bear Power",
    txtChaikinVolatility = "Chaikin Volatility",
    txtCommodityChannelIndex = "Commodity Channel Index",
    txtMovingAverageConvergenceDivergence = "Moving Average Convergence-Divergence",
    txtMassIndex = "Mass Index",
    txtSwingIndex = "Swing Index",
    txtUlcerIndex = "Ulcer Index",

    txtMomentum = "Momentum",
    txtStochasticOscillator = "Stochastic Oscillator",
    txtWilliamsPercentR = "Williams Percent R";

WC.ComObject.OnTrigger.push(function (methodname) {

    switch (methodname) {
        case "LanguageChanged":
            var ChartWords = WC.ChartWords;
            txtSettings = ChartWords["Settings"];
            txtRemoveIndicator = ChartWords["Remove_Indicator"]
            txtRemoveAll = ChartWords["Remove_All"];
            txtOnBars = ChartWords["OnBars"];

            txtAlligator = ChartWords["Alligator"];
            txtBollingerBands = ChartWords["Bollinger_Bands"];
            txtDonchianChannel = ChartWords["Donchian_Channel"];
            txtEnvelopeMovingAverage = ChartWords["Envelope_Moving_Average"];
            txtExponentialMovingAverage = ChartWords["Exponential_Moving_Average"];
            txtFractalChaosBands = ChartWords["Fractal_Chaos_Bands"];
            txtParabolicSAR = ChartWords["Parabolic_SAR"];
            txtSimpleMovingAverage = ChartWords["Simple_Moving_Average"];
            txtWeightedMovingAverage = ChartWords["Weighted_Moving_Average"];

            txtOscillators = ChartWords["Oscillators"];
            txtAccumulativeSwingIndex = ChartWords["Accumulative_Swing_Index"];
            txtAverageTrueRange = ChartWords["Average_True_Range"];
            txtBearPower = ChartWords["Bear_Power"];
            txtChaikinVolatility = ChartWords["Chaikin_Volatility"];
            txtCommodityChannelIndex = ChartWords["Commodity_Channel_Index"];
            txtMovingAverageConvergenceDivergence = ChartWords["Moving_Average_Convergence_Divergence"];
            txtMassIndex = ChartWords["Mass_Index"];
            txtSwingIndex = ChartWords["Swing_Index"];
            txtUlcerIndex = ChartWords["Ulcer_Index"];

            txtMomentum = ChartWords["Momentum"];
            txtStochasticOscillator = ChartWords["Stochastic_Oscillator"];
            txtWilliamsPercentR = ChartWords["Williams_Percent_R"];


            break;
        default:

    }
    ChartWords = null;
});
//Load Lower Indicator

WC.IN.IndicatorWorker.onmessage = function (event) {

    var i; var count = WC.IN.IndicatorCollection[event.data.ContainerID].length;
    for (i = 0; i < count; i++) {
        var obj = WC.IN.IndicatorCollection[event.data.ContainerID][i];
        if (obj.IndicatorID === event.data.IndicatorID && obj.ChartInstance.ChartSettings.GraphType === event.data.GraphType) {
            obj.tmpIndicatorData = event.data;
            obj.SetWorkerData();
            break;
        }
    }
    event = null;
    count = null;
}

WC.IN.BaseIndicator = function (chartInstance, ContainerID, ChartDisplayInstance, Options) {

    var BaseIndicator = this;
    if (!(ContainerID in WC.IN.IndicatorCollection)) {
        if (ContainerID !== undefined) {
            WC.IN.IndicatorCollection[ContainerID] = [];
            WC.IN.LowerIndicatorInstanceCollection[ContainerID] = [];
        }
    }
    var ChartInstance = (chartInstance !== undefined) ? chartInstance : BaseIndicator.ChartInstance;
    var ChartDisplay = ChartDisplayInstance;
    var IndicatorCollectionCount = 0;
    var LowerIndicatorInstanceCount = 0;
    var isLoadingIndicatorSession = true;
    ContainerID = (ContainerID !== undefined) ? ContainerID : BaseIndicator.ContainerId;
    BaseIndicator.IndicatorSessionCollection = [];
    BaseIndicator.AllowAdd = false;

    BaseIndicator.ContextMenuObject = function (IndicatorCtxMenuCallBack, IndicatorSettingsFunction) {
        var obj = {};

        if (ChartDisplay != null && ChartDisplay.IsShowINOB) {
            obj.OnBars = {
                name: "On Bars", items: {
                    "AI": { name: "Alligator", callback: IndicatorCtxMenuCallBack },
                    "BB": { name: "Bollinger Bands", callback: IndicatorCtxMenuCallBack },
                    "DC": { name: "Donchian Channel", callback: IndicatorCtxMenuCallBack },
                    "EnMA": { name: "Envelope Moving Average", callback: IndicatorCtxMenuCallBack },
                    "EMA": { name: "Exponential Moving Average", callback: IndicatorCtxMenuCallBack },
                    "FCB": { name: "Fractal Chaos Bands", callback: IndicatorCtxMenuCallBack },
                    "PSAR": { name: "Parabolic SAR", callback: IndicatorCtxMenuCallBack },
                    "SMA": { name: "Simple Moving Average", callback: IndicatorCtxMenuCallBack },
                    "WMA": { name: "Weighted Moving Average", callback: IndicatorCtxMenuCallBack }
                }
            };
        }

        if (ChartDisplay != null && ChartDisplay.IsShowINOS) {
            obj.Oscillators = {
                name: "Oscillators", items: {
                    "ASI": { name: "Accumulative Swing Index", callback: IndicatorCtxMenuCallBack },
                    "ATR": { name: "Average True Range", callback: IndicatorCtxMenuCallBack },
                    "Bear": { name: "Bear Power", callback: IndicatorCtxMenuCallBack },
                    "CHV": { name: "Chaikin Volatility", callback: IndicatorCtxMenuCallBack },
                    "CCI": { name: "Commodity Channel Index", callback: IndicatorCtxMenuCallBack },
                    "MACD": { name: "Moving Average Convergence-Divergence", callback: IndicatorCtxMenuCallBack },
                    "MI": { name: "Mass Index", callback: IndicatorCtxMenuCallBack },
                    "SI": { name: "Swing Index", callback: IndicatorCtxMenuCallBack },
                    "UI": { name: "Ulcer Index", callback: IndicatorCtxMenuCallBack },
                }
            };
        }

        if (ChartDisplay != null && ChartDisplay.IsShowINVO) {
            obj.Volumes = {
                name: "Volumes", items: {
                }
            };
        }

        if (ChartDisplay != null && ChartDisplay.IsShowINBW) {
            obj.BillWilliams = {
                name: "Bill Williams", items: {
                }
            };
        }

        if (ChartDisplay != null && ChartDisplay.IsShowINMO) {
            obj.Momentum = {
                name: "Momentum", items: {
                    "SO": { name: "Stochastic Oscillator", callback: IndicatorCtxMenuCallBack },
                    "WilliamsPercentR": { name: "Williams Percent R", callback: IndicatorCtxMenuCallBack }
                }
            };
        }

        if (ChartDisplay != null && ChartDisplay.IsShowINOT) {
            obj.Others = {
                name: "Others", items: {
                }
            }
        };

        obj.IndicatorSettings = {
            name: "Settings", items: getAllActiveIndicators("Settings", IndicatorSettingsFunction), disabled: WC.IN.IndicatorCollection[ContainerID].length == 0
        };
        obj.RemoveIndicator = {
            name: "Remove Indicator", items: getAllActiveIndicators("Remove", IndicatorSettingsFunction)
        };

        return obj;
    }

    BaseIndicator.SpecialContextMenuObject = function (IndicatorCtxMenuCallBack, IndicatorSettingsFunction) {
        return {
            "OnBars": {
                name: txtOnBars, items:
                    {
                        "AI": { name: txtAlligator, callback: IndicatorCtxMenuCallBack },
                        "BB": { name: txtBollingerBands, callback: IndicatorCtxMenuCallBack },
                        "DC": { name: txtDonchianChannel, callback: IndicatorCtxMenuCallBack },
                        "EnMA": { name: txtEnvelopeMovingAverage, callback: IndicatorCtxMenuCallBack },
                        "EMA": { name: txtExponentialMovingAverage, callback: IndicatorCtxMenuCallBack },
                        "FCB": { name: txtFractalChaosBands, callback: IndicatorCtxMenuCallBack },
                        "PSAR": { name: txtParabolicSAR, callback: IndicatorCtxMenuCallBack },
                        "SMA": { name: txtSimpleMovingAverage, callback: IndicatorCtxMenuCallBack },
                        "WMA": { name: txtWeightedMovingAverage, callback: IndicatorCtxMenuCallBack }
                    }
            },
            "Oscillators": {
                name: txtOscillators, items:
                  {
                      "ASI": { name: txtAccumulativeSwingIndex, callback: IndicatorCtxMenuCallBack },
                      "ATR": { name: txtAverageTrueRange, callback: IndicatorCtxMenuCallBack },
                      "Bear": { name: txtBearPower, callback: IndicatorCtxMenuCallBack },
                      "CHV": { name: txtChaikinVolatility, callback: IndicatorCtxMenuCallBack },
                      "CCI": { name: txtCommodityChannelIndex, callback: IndicatorCtxMenuCallBack },
                      "MACD": { name: txtMovingAverageConvergenceDivergence, callback: IndicatorCtxMenuCallBack },
                      "MI": { name: txtMassIndex, callback: IndicatorCtxMenuCallBack },
                      "SI": { name: txtSwingIndex, callback: IndicatorCtxMenuCallBack },
                      "UI": { name: txtUlcerIndex, callback: IndicatorCtxMenuCallBack },
                  }
            },
            "Momentum": {
                name: txtMomentum, items: {
                    "SO": { name: txtStochasticOscillator, callback: IndicatorCtxMenuCallBack },
                    "WilliamsPercentR": { name: txtWilliamsPercentR, callback: IndicatorCtxMenuCallBack }
                }
            },
            "IndicatorSettings": {
                name: txtSettings, items:
                    getAllActiveIndicators("Settings", IndicatorSettingsFunction), disabled: (WC.IN.IndicatorCollection[ContainerID].length > 0) ? false : true
            },
            "RemoveIndicator": {
                name: txtRemoveIndicator, items:
                    getAllActiveIndicators("Remove", IndicatorSettingsFunction)
            }
        };
    }

    function getAllActiveIndicators(ContextItem, IndicatorSettingsFunction) {
        var Items = {};

        var count = WC.IN.IndicatorCollection[ContainerID].length;

        if (count === 0) {
            switch (ContextItem) {
                case "Settings":
                    //Items['IndSettings'] = { name: ContextItem, disabled: true };
                    break;
                case "Remove":
                    Items['RemoveAllIndicators'] = { name: txtRemoveAll, disabled: true };
                    break;
            }

            return Items;
        }

        if (count > 0) {
            var ChartWords = WC.ChartWords;
            switch (ContextItem) {
                case "Settings":
                    for (var i = 0; i < count; i++) {
                        var transname = ChartWords[WC.IN.IndicatorCollection[ContainerID][i].IndicatorInfo.IndicatorCodeName];
                        var translatedword = transname ? transname : WC.IN.IndicatorCollection[ContainerID][i].IndicatorInfo.IndicatorFullName;
                        Items[WC.IN.IndicatorCollection[ContainerID][i].IndicatorID] = { name: ((i + 1) + ". " + translatedword), callback: IndicatorSettingsFunction };
                    }
                    break;
                case "Remove":
                    Items['RemoveAllIndicators'] = { name: txtRemoveAll, disabled: false, callback: BaseIndicator.RemoveAllIndicator };

                    for (var i = 0; i < count; i++) {
                        var transname = ChartWords[WC.IN.IndicatorCollection[ContainerID][i].IndicatorInfo.IndicatorCodeName];
                        var translatedword = transname ? transname : WC.IN.IndicatorCollection[ContainerID][i].IndicatorInfo.IndicatorFullName;
                        Items[WC.IN.IndicatorCollection[ContainerID][i].IndicatorID] = { name: ((i + 1) + ". " + translatedword), callback: BaseIndicator.RemoveIndicator };
                    }
                    break;
            }

            return Items;
        }

    }

    function LoadSessionData(count, Bars, Options) {
        if (count !== 0) {
            ChartDisplayInstance.ActiveIndicators = [];

            for (var i = 0; i < count; i++) {
                BaseIndicator.AllowAdd = true;
                LoadIndicatorFunction(BaseIndicator.IndicatorSessionCollection[i].Key, Bars, Options, true, BaseIndicator.IndicatorSessionCollection[i].ID, i);

            }
            BaseIndicator.IndicatorSessionCollection = [];
        }
    }

    //Load OnBars
    BaseIndicator.LoadOnBarsIndicator = function (IndicatorName, Bars, Options, SettingsValues) {
        LoadIndicatorFunction(IndicatorName, Bars, Options, false, null, null, SettingsValues);
    }

    var ctxMenuObj = BaseIndicator.ContextMenuObject(null, null);

    function LoadIndicatorFunction(IndicatorName, Bars, Options, LoadSession, IndicatorSessionID, index, SettingsValues) {
        var newIndicator;
        if (BaseIndicator.AllowAdd) {
            BaseIndicator.AllowAdd = false;
            if (IndicatorName in ctxMenuObj.OnBars.items) {
                newIndicator = new WC.IN["Indicator" + IndicatorName](ChartInstance, Bars, "Close", GenerateID(), ContainerID);
                Object.keys(newIndicator.SettingsValues).map(function (prop) {
                    if (SettingsValues[prop]) newIndicator.SettingsValues[prop] = SettingsValues[prop];
                });
                WC.IN.IndicatorCollection[ContainerID].push(newIndicator);
                if (LoadSession) {
                    if (BaseIndicator.IndicatorSessionCollection[index].Settings !== null) {
                        newIndicator.SettingsValues = BaseIndicator.IndicatorSessionCollection[index].Settings;
                    }
                }
                newIndicator.initIndicatorComputations(null);
            } else {
                ChartDisplay.isLowerIndicatorVisible = true;
                var ID = IndicatorName + "-" + GenerateID();
                ChartDisplay.ResizeFunction();
                var IndicatorContainer = $('<div id="botIndicatorContainer-' + ID + '" class="BotIndicatorChildContainer" style="visibility:visible; width:' + ChartDisplay.ChartFormElement.find('.BotIndicatorHolder').width + 'px; height:' + ChartDisplay.ChartFormElement.find('.BotIndicatorHolder').height + 'px;"></div>');
                WC.IN.LowerIndicatorInstanceCollection[ContainerID][ID] = new WC.CM.BottomIndicatorChart(IndicatorContainer, ChartDisplay.ResizeFunction, ChartInstance, ID, ChartDisplay, Options);
                ChartDisplay.ChartFormElement.find('.BotIndicatorHolder').append(IndicatorContainer);
                newIndicator = new WC.IN["Indicator" + IndicatorName](WC.IN.LowerIndicatorInstanceCollection[ContainerID][ID], ChartInstance, Bars, "Close", ID, ContainerID);
                Object.keys(newIndicator.SettingsValues).map(function (prop) {
                    if (SettingsValues[prop]) newIndicator.SettingsValues[prop] = SettingsValues[prop];
                });
                WC.IN.IndicatorCollection[ContainerID].push(newIndicator);
                if (LoadSession) {
                    if (BaseIndicator.IndicatorSessionCollection[index].Settings !== null) {
                        newIndicator.SettingsValues = BaseIndicator.IndicatorSessionCollection[index].Settings;
                    }
                }
                newIndicator.initIndicatorComputations(null);
                ChartInstance.Resizemethod();
                WC.IN.LowerIndicatorInstanceCollection[ContainerID][ID].FirstLoad = false;
                LowerIndicatorEventSubscription(ID);
            }
            ChartDisplayInstance.ActiveIndicators.push({ Key: IndicatorName, Settings: newIndicator.SettingsValues, ID: newIndicator.IndicatorID });
            ChartDisplayInstance.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
        }

    }

    function RemoveSessionItem(Id) {
        for (var i in ChartDisplayInstance.ActiveIndicators) {
            var index = parseInt(i);
            if (ChartDisplayInstance.ActiveIndicators[index].ID === Id) {
                ChartDisplayInstance.ActiveIndicators.splice(index, 1);
                ChartDisplayInstance.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
                break;
            }
        }
    }

    BaseIndicator.RecomputeIndicatorValues = function (cID, BarsData) {
        var count = WC.IN.IndicatorCollection[cID].length;
        if (count === null || count === 0) {
            return;
        }
        var i;
        if (count > 1) {
            for (i = 0; i < count; i++) {
                WC.IN.IndicatorCollection[cID][i].isIndicatorSettingsBuffers = true;
                WC.IN.IndicatorCollection[cID][i].IndicatorData = [];
                WC.IN.IndicatorCollection[cID][i].Bars = BarsData;
                WC.IN.IndicatorCollection[cID][i].initIndicatorComputations(null);
            }
        } else if (count === 1) {
            WC.IN.IndicatorCollection[cID][0].isIndicatorSettingsBuffers = true;
            WC.IN.IndicatorCollection[cID][0].IndicatorData = [];
            WC.IN.IndicatorCollection[cID][0].Bars = BarsData;
            WC.IN.IndicatorCollection[cID][0].initIndicatorComputations(null);
        }
    }

    BaseIndicator.IndicatorUpdate = function (UpdateType, cID) {
        var count = WC.IN.IndicatorCollection[cID].length;
        if (count === null || count === 0) {
            return;
        }
        var i;
        ChartInstance.IndicatorTopCanvas.width = ChartInstance.IndicatorTopCanvas.width;
        if (count > 1) {
            for (i = 0; i < count; i++) {
                WC.IN.IndicatorCollection[cID][i].Update(UpdateType)
            }
        } else if (count === 1) {
            WC.IN.IndicatorCollection[cID][0].Update(UpdateType);
        }
    }

    BaseIndicator.RemoveIndicator = function (cID, ID) {
        if (ID === undefined) {
            ID = cID;
            cID = ContainerID;
        }
        var count = WC.IN.IndicatorCollection[cID].length;
        if (count === null || count === 0) {
            return;
        }
        RemoveSessionItem(ID);
        for (var i = 0; i < count; i++) {
            if (WC.IN.IndicatorCollection[cID][i].IndicatorID === ID) {
                if (WC.IN.IndicatorCollection[cID][i].OnBars) { //OnBars
                    WC.IN.IndicatorCollection[cID].splice(i, 1);
                    ChartInstance.IndicatorTopCanvas.width = ChartInstance.IndicatorTopCanvas.width;
                    TriggerSettingsClose(ID, ChartInstance, "Remove");
                    ChartDisplay.ResizeFunction();
                    ChartInstance.Resizemethod();
                    break;
                }
                else { //Lower
                    var newHeight;
                    WC.IN.LowerIndicatorInstanceCollection[cID][ID].ChartHeight = 0;
                    WC.IN.LowerIndicatorInstanceCollection[cID][ID].Resizemethod();
                    delete WC.IN.LowerIndicatorInstanceCollection[cID][ID];
                    WC.IN.IndicatorCollection[cID].splice(i, 1);
                    var lCount = Object.keys(WC.IN.LowerIndicatorInstanceCollection[cID]).length;
                    ChartDisplay.isLowerIndicatorVisible = (lCount !== 0) ? true : false;
                    ChartDisplay.ResizeFunction();
                    newHeight = ChartDisplay.ChartFormElement.find('.BotIndicatorHolder').height() / lCount;
                    TriggerSettingsClose(ID, ChartInstance, "Remove");
                    $('#botIndicatorContainer-' + ID).remove();
                    $('[CloseID="' + ID + '"]').remove();
                    if (lCount !== 0) {
                        for (var i in WC.IN.LowerIndicatorInstanceCollection[cID]) {
                            var instance = WC.IN.LowerIndicatorInstanceCollection[cID][i];
                            instance.ChartHeight = newHeight;
                            instance.Resizemethod();
                        }
                        ChartInstance.Resizemethod();
                    }
                    else if (lCount === 0) {
                        WC.IN.LowerIndicatorInstanceCollection[cID] = [];
                        ChartInstance.IndicatorTopCanvas.width = ChartInstance.IndicatorTopCanvas.width;
                        ChartDisplay.isLowerIndicatorVisible = false;
                        ChartDisplay.ChartFormElement.find('.BotIndicatorHolder').empty();
                        ChartDisplay.ResizeFunction();
                        ChartInstance.Resizemethod();
                    }
                }

            }
        }
    }

    BaseIndicator.RemoveAllIndicator = function () {
        WC.IN.IndicatorCollection[ContainerID] = [];
        ChartInstance.IndicatorTopCanvas.width = ChartInstance.IndicatorTopCanvas.width;
        TriggerSettingsClose(null, ChartInstance, "RemoveAll");
        if (Object.keys(WC.IN.LowerIndicatorInstanceCollection[ContainerID]).length !== 0) {
            WC.IN.LowerIndicatorInstanceCollection[ContainerID] = [];
            ChartInstance.IndicatorTopCanvas.width = ChartInstance.IndicatorTopCanvas.width;
            ChartDisplay.isLowerIndicatorVisible = false;
            ChartDisplay.ChartFormElement.find('.BotIndicatorHolder').empty();
            ChartDisplay.ResizeFunction();
            ChartInstance.Resizemethod();
        }
        ChartDisplayInstance.ActiveIndicators = [];
        ChartDisplayInstance.ParentElement.trigger("ChartSettingsChanged", [ChartInstance.GetAllSettingsProperty(), ChartInstance]);
        ChartDisplay.ResizeFunction();
        ChartInstance.Resizemethod();
    }

    BaseIndicator.DrawIndicator = function (IndicatorContext, ChartInstance, IndicatorSettings, IndicatorData, BarSpace, LineColor, Bars, MainIndicatorChart, PolygonSettings) {
        if (PolygonSettings != null) { PresentationToPolygon(PolygonSettings, ChartInstance, MainIndicatorChart); return; }
        if (IndicatorSettings.CollectionType === "Dots") { PresentationToDots(IndicatorContext, ChartInstance, IndicatorSettings, IndicatorData, BarSpace, LineColor, MainIndicatorChart); return; }
        if (IndicatorSettings.CollectionType === "Histogram") { PresentationToHistogram(IndicatorContext, ChartInstance, IndicatorSettings, IndicatorData, BarSpace, LineColor, Bars, MainIndicatorChart); return; }
        if (IndicatorSettings.CollectionType === "Histogram Fill") { PresentationToHistogramFill(IndicatorContext, ChartInstance, IndicatorSettings, IndicatorData, BarSpace, LineColor, MainIndicatorChart); return; }
        var shift = +IndicatorSettings.Shift;
        ShiftValue = ChartInstance.ComputationProperties.BarSpace;
        var ctx = IndicatorContext;
        var DataCount = ChartInstance.ComputationProperties.DataEndInternal - ChartInstance.ComputationProperties.DataStartInternal;
        var DataIndex = 0;
        var PointDistance = (BarSpace === null) ? ChartInstance.ComputationProperties.BarSpace : BarSpace;
        var isLatestBarVisible = (MainIndicatorChart !== undefined) ? ((MainIndicatorChart.ChartOtherProperties.dataAdded === 1) ? true : (((MainIndicatorChart.ComputationProperties.DataEndInternal - MainIndicatorChart.ComputationProperties.DataStartInternal) < MainIndicatorChart.ComputationProperties.NumbersOfVisibleBars) ? true : false)) : ((ChartInstance.ChartOtherProperties.dataAdded === 1) ? true : false) ? true : ((ChartInstance.ComputationProperties.DataEndInternal >= ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? false : true);
        ctx.strokeStyle = LineColor;
        ctx.lineWidth = IndicatorSettings.Width;
        var lineStyle = getLineStyle(IndicatorSettings.LineStyle);
        ctx.setLineDash(lineStyle);
        ctx.beginPath();
        var DataStart = (shift >= 0) ? ChartInstance.ComputationProperties.DataStartInternal : (((ChartInstance.ComputationProperties.DataStartInternal + shift) < 0) ? setDataIndex(shift, ChartInstance.ComputationProperties.DataStartInternal) : ChartInstance.ComputationProperties.DataStartInternal + shift);
        for (var i = DataStart; i <= ChartInstance.ComputationProperties.DataEndInternal + (shift >= 0 ? shift : 0) ; i++) {

            if (i === ChartInstance.ComputationProperties.DataEndInternal + (shift > 0 ? shift : 0) && i === (IndicatorData.length - 1) + (shift >= 0 ? shift : 0)) {
                ctx.stroke();
                return;
            }
            if (i >= IndicatorData.length) { break; }
            var isEnoughData = (ChartInstance.ComputationProperties.DataEndInternal >= ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? true : ((ChartInstance.ComputationProperties.DataEndInternal + 1) === ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? true : false;
            isEnoughData = (isEnoughData) ? true : (MainIndicatorChart !== undefined) ? ((MainIndicatorChart.ComputationProperties.DataEndInternal >= MainIndicatorChart.ComputationProperties.NumbersOfVisibleBars) ? true : false) : false;
            var xCoordinate = getXCoordinate(ctx.canvas.width, ChartInstance.ComputationProperties.DefaultBarsWidth, DataIndex, PointDistance, isLatestBarVisible, ChartInstance.ComputationProperties.XPositionFirstData, isEnoughData) + ((shift >= 0) ? (shift * ShiftValue) : 0);
            var yCoordinate = ChartInstance.GetYaxis(IndicatorData[i].Value);
            if (i === DataStart) { ctx.moveTo(xCoordinate, yCoordinate); }
            else {
                ctx.lineTo(xCoordinate, yCoordinate);
            }
            DataIndex++;
        }
        ctx.lineJoin = 'round';
        ctx.stroke();

        function setDataIndex(shift, dataStart) {
            var Shift = Math.abs(shift);
            DataIndex = Shift - dataStart;

            return 0;
        }

    }

    //Draw indicator
    BaseIndicator.IndicatorReDrawFunction = function (cID) {
        if (WC.IN.IndicatorCollection[cID].length !== 0 && ChartDisplay !== undefined) {
            var count = WC.IN.IndicatorCollection[cID].length;
            var nh = ChartDisplay.ChartFormElement.find('.BotIndicatorHolder').height() / Object.keys(WC.IN.LowerIndicatorInstanceCollection[cID]).length;
            for (var i = 0; i < count; i++) {
                if (!WC.IN.IndicatorCollection[cID][i].OnBars) {

                    WC.IN.LowerIndicatorInstanceCollection[cID][WC.IN.IndicatorCollection[cID][i].IndicatorID].ChartHeight = nh;
                    WC.IN.LowerIndicatorInstanceCollection[cID][WC.IN.IndicatorCollection[cID][i].IndicatorID].initRedraw(WC.IN.IndicatorCollection[cID][i].IndicatorData, ChartInstance);
                    if (WC.IN.IndicatorCollection[cID][i].IndicatorData.length !== 0) { WC.IN.IndicatorCollection[cID][i].DrawIndicatorLine(); }
                    DrawLowerIndicatorName(WC.IN.LowerIndicatorInstanceCollection[cID][WC.IN.IndicatorCollection[cID][i].IndicatorID].ctxIndicatorTopCanvas, WC.IN.IndicatorCollection[cID][i].IndicatorInfo.IndicatorName, ChartInstance.ChartSettings.ForeGround);

                } else {
                    WC.IN.IndicatorCollection[cID][i].DrawIndicatorLine();
                }
            }
        }
    }

    BaseIndicator.ComputeSMA = function (Values, Period) {
        var total = 0;
        for (var i = 0; i != Period; i++) {
            total = total + Values[i];
        }

        return (total / Period);
    }

    BaseIndicator.ComputeEMA = function (Values, Period, firstEMA, PreviousValue) {
        var K = 2 / (Period + 1);
        var ReturnValue;
        if (firstEMA) {
            ReturnValue = BaseIndicator.ComputeSMA(Values, Period);
        }
        else {
            ReturnValue = ((Values[0] * K) + (PreviousValue * (1 - K)));
        }

        return ReturnValue;
    }

    BaseIndicator.ComputeSMMA = function (BarData, IndicatorValue, index, Period, firstSMMA, PreviousValue) {
        var ReturnValue;
        var total;
        if (firstSMMA) {
            var rangeSMA = BaseIndicator.getDataRange(index, Period, BarData);
            var range = BaseIndicator.getValueToCompute(IndicatorValue, rangeSMA);
            ReturnValue = BaseIndicator.ComputeSMA(range, Period)
        }
        else {
            var Price = BaseIndicator.getValue(IndicatorValue, BarData, index);
            total = PreviousValue * Period;
            ReturnValue = ((total - PreviousValue + Price) / Period);
        }

        return ReturnValue;
    }

    BaseIndicator.Median = function (BarData, index) {
        return ((BarData[index].High() + BarData[index].Low()) / 2);
    }

    BaseIndicator.Typical = function (BarData, index) {
        return ((BarData[index].High() + BarData[index].Low() + BarData[index].Close()) / 3);
    }

    BaseIndicator.objValue = function (ComputedValue, TimeStamp) {
        var obj = { Value: ComputedValue, Stamp: TimeStamp };

        return obj;
    }

    BaseIndicator.getDataRange = function (index, Period, BarData) {
        var ReturnRange = [];
        ReturnRange = BarData.slice(index, (index + Period));
        return ReturnRange;
    }

    BaseIndicator.getValueToCompute = function (IndicatorValue, BarData) {
        var ReturnRange = [];

        switch (IndicatorValue) {
            case "High":
                for (var i = BarData.length - 1; i >= 0; i--) {
                    ReturnRange.unshift(BarData[i].High());
                }
                break;

            case "Low":
                for (var i = BarData.length - 1; i >= 0; i--) {
                    ReturnRange.unshift(BarData[i].Low());
                }
                break;

            case "Open":
                for (var i = BarData.length - 1; i >= 0; i--) {
                    ReturnRange.unshift(BarData[i].Open());
                }
                break;

            case "Close":
                for (var i = BarData.length - 1; i >= 0; i--) {
                    ReturnRange.unshift(BarData[i].Close());
                }
                break;
        }

        return ReturnRange;
    }

    BaseIndicator.getValue = function (IndicatorValue, BarData, index) {
        var ReturnValue;

        switch (IndicatorValue) {
            case "High":
                ReturnValue = BarData[index].High();
                break;

            case "Low":
                ReturnValue = BarData[index].Low();
                break;

            case "Open":
                ReturnValue = BarData[index].Open();
                break;

            case "Close":
                ReturnValue = BarData[index].Close();
                break;
        }

        return ReturnValue;
    }

    BaseIndicator.getTrueRange = function (CurrentHigh, CurrentLow, PreviousClose) {
        var TrueHigh = (CurrentHigh > PreviousClose) ? CurrentHigh : PreviousClose;
        var TrueLow = (CurrentLow > PreviousClose) ? PreviousClose : CurrentLow;
        var TrueRange = TrueHigh - TrueLow;

        return Math.abs(TrueRange);
    }

    function LowerIndicatorEventSubscription(ID) {
        WC.IN.LowerIndicatorInstanceCollection[ContainerID][ID].ParentELement.on("ChartDragged", {
        }, function (e, BottomIndicatorTopCanvas, BotChartInstance) {
            ChartInstance.ComputationProperties.DataStartInternal = BotChartInstance.ComputationProperties.DataStartInternal;
            ChartInstance.Resizemethod();
        });

        WC.IN.LowerIndicatorInstanceCollection[ContainerID][ID].ParentELement.on("LowerIndicatorClose", {
        }, function (e, IndicatorID) {
            BaseIndicator.RemoveIndicator(ContainerID, IndicatorID);
        });
    }

    ChartInstance.ParentELement.on("TimeFrameChanged", {
    }, function (event, VisualToolsCanvas, IndicatorTopCanvas, IndicatorBotCanvas, BarsData, ChartObject) {
        if (ContainerID !== undefined) {
            if (event.handled !== true) {
                BaseIndicator.RecomputeIndicatorValues(ContainerID, BarsData);
                event.handled = true;
            }
        }
    });

    ChartInstance.ParentELement.on("GraphTypeChanged", {
    }, function (event, VisualToolsCanvas, IndicatorTopCanvas, IndicatorBotCanvas, BarsData, ChartObject) {
        if (ContainerID !== undefined) {
            if (event.handled !== true) {
                BaseIndicator.RecomputeIndicatorValues(ContainerID, BarsData);
                event.handled = true;
            }
        }
    });

    ChartInstance.ParentELement.on("SymbolChanged", {
    }, function (event, VisualToolsCanvas, IndicatorTopCanvas, IndicatorBotCanvas, BarsData, ChartObject) {
        if (ContainerID !== undefined) {
            if (event.handled !== true) {
                BaseIndicator.RecomputeIndicatorValues(ContainerID, BarsData);
                event.handled = true;
            }
        }
    });

    ChartInstance.ParentELement.on("HistoryDataAdd", {
    }, function (event, IndicatorTopCanvas, IndicatorBotCanvas, BarsData, ChartObject) {
        if (ContainerID !== undefined) {
            if (event.handled !== true) {
                BaseIndicator.RecomputeIndicatorValues(ContainerID, BarsData);
                event.handled = true;
            }
        }
    });

    ChartInstance.ParentELement.on("BarUpdate", {
    }, function (event, IndicatorTopCanvas, IndicatorBotCanvas, BarsData, ChartObject) {
        if (ContainerID !== undefined) {
            if (event.handled !== true) {
                BaseIndicator.IndicatorUpdate("BarUpdate", ContainerID);
                event.handled = true;
            }
        }
    });

    ChartInstance.ParentELement.on("FrontDataAdded", {
    }, function (event, IndicatorTopCanvas, IndicatorBotCanvas, BarsData, ChartObject) {
        if (ContainerID !== undefined) {
            if (event.handled !== true) {
                BaseIndicator.IndicatorUpdate("FrontDataAdded", ContainerID);
                event.handled = true;
            }
        }
    });

    ChartInstance.ParentELement.on("ChartAfterDraw", {
    }, function (event, VisualToolsContext, IndicatorTopCanvas, IndicatorBotCanvas, BarsData, ChartObject) {
        if (ContainerID !== undefined) {
            BaseIndicator.IndicatorReDrawFunction(ContainerID);
        }
        if (BarsData.length !== 0) {
            if (isLoadingIndicatorSession) {
                var count = BaseIndicator.IndicatorSessionCollection.length;
                if (count !== 0) {
                    isLoadingIndicatorSession = false
                    LoadSessionData(count, BarsData, Options);
                }

            }
        }
        if (BarsData != undefined || BarsData !== null) {
            isDataAvailable = true;
        }
    });
};

//Functions
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

function setVisualTypeChangedVisibility(Container, Key, SettingsValues) {
    if (SettingsValues.VisualType === "oneLine") {
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor1", Visible: true });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor2", Visible: false });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor3", Visible: false });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor4", Visible: false });
        return;
    }
    if (SettingsValues.VisualType === "twoLine" || SettingsValues.VisualType === "Change") {
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor1", Visible: true });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor2", Visible: true });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor3", Visible: false });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor4", Visible: false });
        return;
    }
    if (SettingsValues.VisualType === "Multi") {
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor1", Visible: true });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor2", Visible: true });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor3", Visible: true });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor4", Visible: true });
        return;
    }
}

function setCollectionTypeChangedVisibility(Container, Key, SettingsValues) {
    if (SettingsValues.CollectionType === "Line") {
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor1", Visible: true });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor2", Visible: false });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor3", Visible: false });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor4", Visible: false });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "VisualType", Visible: false });
    }
    if (SettingsValues.CollectionType === "Histogram Fill") {
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "VisualType", Visible: true });
        setVisualTypeChangedVisibility(Container, Key, SettingsValues);
    }
    if (SettingsValues.CollectionType === "Histogram") {
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "VisualType", Visible: true });
        setVisualTypeChangedVisibility(Container, Key, SettingsValues);
    }
    if (SettingsValues.CollectionType === "Dots") {
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor1", Visible: true });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor2", Visible: false });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor3", Visible: false });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "HistogramColor4", Visible: false });
        Container.PropertyGrid("SetVisibility", { KeyObject: Key, PropertyName: "VisualType", Visible: false });
    }
}

function getObjectValueToCompute(Range) {
    var ReturnRange = [];
    for (var i = Range.length - 1; i >= 0; i--) {
        ReturnRange.unshift(Range[i].Value);
    }

    return ReturnRange;
}

function getXCoordinate(CanvasWidth, BarsWidth, DataIndex, PointDistance, LatestVisible, xStartPoint, isEnoughData) {
    var ReturnValue;
    if (LatestVisible) {
        if (DataIndex === 0) { ReturnValue = (isEnoughData ? (CanvasWidth - BarsWidth) : xStartPoint); } else { ReturnValue = ((isEnoughData ? (CanvasWidth - BarsWidth) : xStartPoint) - Math.round(PointDistance * DataIndex)); }

    }
    else {
        if (DataIndex === 0) { ReturnValue = CanvasWidth; } else { ReturnValue = (CanvasWidth - Math.round(PointDistance * DataIndex)); }
    }

    return ReturnValue;
}

function CreateBasicSettingsPackage(CollectionType, Shift, Width, Style, VisualType) {
    var x = {
        CollectionType: CollectionType,
        Shift: Shift,
        Width: Width,
        LineStyle: Style,
        VisualType: VisualType
    };

    return x;
}

function CreatePolygonSettingsPackage(PointData1, Color1, Shift1, Width1, PointData2, Color2, Shift2, Width2) {
    return {
        Polygon1: {
            Data: PointData1,
            Color: Color1,
            Shift: Shift1,
            Width: Width1
        },
        Polygon2: {
            Data: PointData2,
            Color: Color2,
            Shift: Shift2,
            Width: Width2
        }
    }
}

function CreatePolygonSettingsObject(PointData, Color, Shift, Width) {
    return {
        Data: PointData,
        Color: Color,
        Shift: Shift,
        Width: Width
    };
}

function getLineStyle(LineStyle) {
    var pattern;
    switch (LineStyle) {
        case "Dash":
            pattern = [10, 10];
            break;

        case "DashDotDot":
            pattern = [0, 5, 12, 5, 3, 5, 3, 3];
            break;

        case "DashDot":
            pattern = [10, 10, 0, 0, 1, 10];
            break;

        case "Dot":
            pattern = [1, 2, 0];
            break;

        case "Solid":
            pattern = [];
            break;

        default:
            pattern = [];
            break;
    }

    return pattern;
}

function getBarValue(IndicatorValue, BarData, index) {
    var ReturnValue;

    switch (IndicatorValue) {
        case "High":
            ReturnValue = BarData[index].High();
            break;

        case "Low":
            ReturnValue = BarData[index].Low();
            break;

        case "Open":
            ReturnValue = BarData[index].Open();
            break;

        case "Close":
            ReturnValue = BarData[index].Close();
            break;
    }

    BarData = null;

    return ReturnValue;
}

function PresentationToHistogram(IndicatorContext, ChartInstance, IndicatorSettings, IndicatorData, BarSpace, LineColor, Bars, MainIndicatorChart) {
    var chartHeight = ChartInstance.ChartHeight;
    ShiftValue = ChartInstance.ComputationProperties.BarSpace;
    var shift = +IndicatorSettings.Shift;
    var DataCount = ChartInstance.ComputationProperties.DataEndInternal - ChartInstance.ComputationProperties.DataStartInternal;
    var DataIndex = 0;
    var PointDistance = (BarSpace === null) ? ChartInstance.ComputationProperties.BarSpace : BarSpace;
    var isLatestBarVisible = (MainIndicatorChart !== undefined) ? ((MainIndicatorChart.ChartOtherProperties.dataAdded === 1) ? true : (((MainIndicatorChart.ComputationProperties.DataEndInternal - MainIndicatorChart.ComputationProperties.DataStartInternal) < MainIndicatorChart.ComputationProperties.NumbersOfVisibleBars) ? true : false)) : ((ChartInstance.ChartOtherProperties.dataAdded === 1) ? true : false) ? true : ((ChartInstance.ComputationProperties.DataEndInternal >= ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? false : true);
    var lineStyle = getLineStyle(IndicatorSettings.LineStyle);
    IndicatorContext.lineWidth = IndicatorSettings.Width;
    var yBasePoint = (ChartInstance.ComputationProperties.yMin >= 0) ? ChartInstance.GetYaxis(ChartInstance.ComputationProperties.yMin) : ChartInstance.GetYaxis(0);
    var DataStart = (shift >= 0) ? ChartInstance.ComputationProperties.DataStartInternal : (((ChartInstance.ComputationProperties.DataStartInternal + shift) < 0) ? setDataIndex(shift, ChartInstance.ComputationProperties.DataStartInternal) : ChartInstance.ComputationProperties.DataStartInternal + shift);
    for (var i = DataStart; i < ChartInstance.ComputationProperties.DataEndInternal + (shift >= 0 ? shift : 0) ; i++) {
        if (i >= IndicatorData.length) { return; }
        var isEnoughData = (ChartInstance.ComputationProperties.DataEndInternal >= ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? true : ((ChartInstance.ComputationProperties.DataEndInternal + 1) === ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? true : false;
        isEnoughData = (isEnoughData) ? true : (MainIndicatorChart !== undefined) ? ((MainIndicatorChart.ComputationProperties.DataEndInternal >= MainIndicatorChart.ComputationProperties.NumbersOfVisibleBars) ? true : false) : false;
        var xCoordinate = getXCoordinate(IndicatorContext.canvas.width, ChartInstance.ComputationProperties.DefaultBarsWidth, DataIndex, PointDistance, isLatestBarVisible, ChartInstance.ComputationProperties.XPositionFirstData, isEnoughData) + ((shift >= 0) ? (shift * ShiftValue) : 0);
        var yCoordinate = ChartInstance.GetYaxis(IndicatorData[i].Value);
        IndicatorContext.strokeStyle = (IndicatorSettings.VisualType === "oneLine") ? IndicatorSettings.HistogramColor1 : setLineColor(i);
        IndicatorContext.beginPath();
        IndicatorContext.moveTo(xCoordinate, yCoordinate);
        IndicatorContext.lineTo(xCoordinate, yBasePoint);
        IndicatorContext.stroke();
        DataIndex++;
    }

    function setDataIndex(shift, dataStart) {
        var Shift = Math.abs(shift);
        DataIndex = Shift - dataStart;

        return 0;
    }

    function setLineColor(index) {
        if (IndicatorSettings.VisualType === "twoLine") {
            var color = (yCoordinate < yBasePoint) ? IndicatorSettings.HistogramColor1 : IndicatorSettings.HistogramColor2;
            return color;
        }
        if (IndicatorSettings.VisualType === "Change") {
            var color;
            if (index === DataStart) {
                color = (IndicatorData[index].Value > IndicatorData[index + 1].Value) ? IndicatorSettings.HistogramColor1 : IndicatorSettings.HistogramColor2;
            }
            if (index === IndicatorData.length - 1) {
                color = (IndicatorData[index].Value < IndicatorData[index - 1].Value) ? IndicatorSettings.HistogramColor2 : IndicatorSettings.HistogramColor1;
            }
            if (index > DataStart && index < (IndicatorData.length - 1)) {
                color = (IndicatorData[index].Value > IndicatorData[index + 1].Value) ? IndicatorSettings.HistogramColor1 : IndicatorSettings.HistogramColor2;
            }

            return color;
        }
        if (IndicatorSettings.VisualType === "Multi") {
            var color;
            if (index === DataStart) {
                if (IndicatorData[index].Value > IndicatorData[index + 1].Value && Bars[index].Volume() > Bars[index + 1].Volume()) {
                    color = IndicatorSettings.HistogramColor1;
                }
                if (IndicatorData[index].Value > IndicatorData[index + 1].Value && Bars[index].Volume() < Bars[index + 1].Volume()) {
                    color = IndicatorSettings.HistogramColor2;
                }
                if (IndicatorData[index].Value < IndicatorData[index + 1].Value && Bars[index].Volume() > Bars[index + 1].Volume()) {
                    color = IndicatorSettings.HistogramColor3;
                }
                if (IndicatorData[index].Value < IndicatorData[index + 1].Value && Bars[index].Volume() < Bars[index + 1].Volume()) {
                    color = IndicatorSettings.HistogramColor4;
                }
            }
            if (index === IndicatorData.length - 1) {
                if (Bars.length > IndicatorData.length) {
                    if (Bars[index].Volume() > Bars[index + 1].Volume()) {
                        color = IndicatorSettings.HistogramColor1;
                    }
                    if (Bars[index].Volume() < Bars[index + 1].Volume()) {
                        color = IndicatorSettings.HistogramColor2;
                    }
                }
                else {
                    color = IndicatorSettings.HistogramColor1;
                }
            }
            if (index > DataStart && index < (IndicatorData.length - 1)) {
                if (IndicatorData[index].Value > IndicatorData[index + 1].Value && Bars[index].Volume() > Bars[index + 1].Volume()) {
                    color = IndicatorSettings.HistogramColor1;
                }
                if (IndicatorData[index].Value > IndicatorData[index + 1].Value && Bars[index].Volume() < Bars[index + 1].Volume()) {
                    color = IndicatorSettings.HistogramColor2;
                }
                if (IndicatorData[index].Value < IndicatorData[index + 1].Value && Bars[index].Volume() > Bars[index + 1].Volume()) {
                    color = IndicatorSettings.HistogramColor3;
                }
                if (IndicatorData[index].Value < IndicatorData[index + 1].Value && Bars[index].Volume() < Bars[index + 1].Volume()) {
                    color = IndicatorSettings.HistogramColor4;
                }
            }

            return color;
        }
    }
}

function PresentationToDots(IndicatorContext, ChartInstance, IndicatorSettings, IndicatorData, BarSpace, LineColor, MainIndicatorChart) {
    ShiftValue = ChartInstance.ComputationProperties.BarSpace;
    var shift = +IndicatorSettings.Shift;
    var DataCount = ChartInstance.ComputationProperties.DataEndInternal - ChartInstance.ComputationProperties.DataStartInternal;
    var DataIndex = 0;
    var PointDistance = (BarSpace === null) ? ChartInstance.ComputationProperties.BarSpace : BarSpace;
    var isLatestBarVisible = (MainIndicatorChart !== undefined) ? ((MainIndicatorChart.ChartOtherProperties.dataAdded === 1) ? true : (((MainIndicatorChart.ComputationProperties.DataEndInternal - MainIndicatorChart.ComputationProperties.DataStartInternal) < MainIndicatorChart.ComputationProperties.NumbersOfVisibleBars) ? true : false)) : ((ChartInstance.ChartOtherProperties.dataAdded === 1) ? true : false) ? true : ((ChartInstance.ComputationProperties.DataEndInternal >= ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? false : true);

    IndicatorContext.strokeStyle = LineColor;
    IndicatorContext.lineWidth = IndicatorSettings.Width;
    IndicatorContext.fillStyle = LineColor;
    var dotRadius = IndicatorSettings.Width;
    var startAngle = 0;
    var endAngle = (2 * Math.PI);

    var DataStart = (shift >= 0) ? ChartInstance.ComputationProperties.DataStartInternal : (((ChartInstance.ComputationProperties.DataStartInternal + shift) < 0) ? setDataIndex(shift, ChartInstance.ComputationProperties.DataStartInternal) : ChartInstance.ComputationProperties.DataStartInternal + shift);
    for (var i = DataStart; i <= ChartInstance.ComputationProperties.DataEndInternal + (shift >= 0 ? shift : 0) ; i++) {
        if (i >= IndicatorData.length) { break; }
        var isEnoughData = (ChartInstance.ComputationProperties.DataEndInternal >= ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? true : ((ChartInstance.ComputationProperties.DataEndInternal + 1) === ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? true : false;
        isEnoughData = (isEnoughData) ? true : (MainIndicatorChart !== undefined) ? ((MainIndicatorChart.ComputationProperties.DataEndInternal >= MainIndicatorChart.ComputationProperties.NumbersOfVisibleBars) ? true : false) : false;
        var xCoordinate = getXCoordinate(IndicatorContext.canvas.width, ChartInstance.ComputationProperties.DefaultBarsWidth, DataIndex, PointDistance, isLatestBarVisible, ChartInstance.ComputationProperties.XPositionFirstData, isEnoughData) + ((shift >= 0) ? (shift * ShiftValue) : 0);
        var yCoordinate = ChartInstance.GetYaxis(IndicatorData[i].Value);

        IndicatorContext.beginPath();
        IndicatorContext.arc(xCoordinate, yCoordinate, dotRadius, startAngle, endAngle, false);
        IndicatorContext.fill();
        IndicatorContext.stroke();
        DataIndex++;
    }

    IndicatorContext.stroke();


    function setDataIndex(shift, dataStart) {
        var Shift = Math.abs(shift);
        DataIndex = Shift - dataStart;

        return 0;
    }
}

function PresentationToHistogramFill(IndicatorContext, ChartInstance, IndicatorSettings, IndicatorData, BarSpace, LineColor, MainIndicatorChart) {

    var chartHeight = ChartInstance.ChartHeight;
    var xVal = [], yVal = [];
    var shift = +IndicatorSettings.Shift;
    ShiftValue = ChartInstance.ComputationProperties.BarSpace;
    var ctx = IndicatorContext;
    var DataCount = ChartInstance.ComputationProperties.DataEndInternal - ChartInstance.ComputationProperties.DataStartInternal;
    var DataIndex = 0;
    var PointDistance = (BarSpace === null) ? ChartInstance.ComputationProperties.BarSpace : BarSpace;
    var isLatestBarVisible = (MainIndicatorChart !== undefined) ? ((MainIndicatorChart.ChartOtherProperties.dataAdded === 1) ? true : (((MainIndicatorChart.ComputationProperties.DataEndInternal - MainIndicatorChart.ComputationProperties.DataStartInternal) < MainIndicatorChart.ComputationProperties.NumbersOfVisibleBars) ? true : false)) : ((ChartInstance.ChartOtherProperties.dataAdded === 1) ? true : false) ? true : ((ChartInstance.ComputationProperties.DataEndInternal >= ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? false : true);
    var yBasePoint = (ChartInstance.ComputationProperties.yMin >= 0) ? ChartInstance.GetYaxis(ChartInstance.ComputationProperties.yMin) : ChartInstance.GetYaxis(0);
    var DataStart = (shift >= 0) ? ChartInstance.ComputationProperties.DataStartInternal : (((ChartInstance.ComputationProperties.DataStartInternal + shift) < 0) ? setDataIndex(shift, ChartInstance.ComputationProperties.DataStartInternal) : ChartInstance.ComputationProperties.DataStartInternal + shift);
    var DataEnd = ChartInstance.ComputationProperties.DataEndInternal + (shift >= 0 ? shift : 0);
    var isEnoughData = (ChartInstance.ComputationProperties.DataEndInternal >= ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? true : ((ChartInstance.ComputationProperties.DataEndInternal + 1) === ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? true : false;
    isEnoughData = (isEnoughData) ? true : (MainIndicatorChart.ComputationProperties.DataEndInternal >= MainIndicatorChart.ComputationProperties.NumbersOfVisibleBars) ? true : false;

    function setDataIndex(shift, dataStart) {
        var Shift = Math.abs(shift);
        DataIndex = Shift - dataStart;

        return 0;
    }

    if (IndicatorSettings.VisualType === "twoLine") {
        HistogramFillTwoLines(ChartInstance, IndicatorData, IndicatorContext, IndicatorSettings, { x1: -1000, y1: yBasePoint, x2: IndicatorContext.canvas.width, y2: yBasePoint }, DataStart, DataEnd, shift, ShiftValue, isEnoughData, PointDistance, DataIndex, isLatestBarVisible);
    }
    else {
        ctx.strokeStyle = LineColor;
        ctx.lineWidth = IndicatorSettings.Width;
        var lineStyle = getLineStyle(IndicatorSettings.LineStyle);
        ctx.setLineDash(lineStyle);
        ctx.beginPath();
        for (var i = DataStart; i <= ChartInstance.ComputationProperties.DataEndInternal + (shift >= 0 ? shift : 0) ; i++) {

            if (i === ChartInstance.ComputationProperties.DataEndInternal + (shift > 0 ? shift : 0) && i === (IndicatorData.length - 1) + (shift > 0 ? shift : 0)) {
                ctx.stroke();
                return;
            }
            if (i >= IndicatorData.length) {
                break;
            }

            var xCoordinate = getXCoordinate(ctx.canvas.width, ChartInstance.ComputationProperties.DefaultBarsWidth, DataIndex, PointDistance, isLatestBarVisible, ChartInstance.ComputationProperties.XPositionFirstData, isEnoughData) + ((shift >= 0) ? (shift * ShiftValue) : 0);
            var yCoordinate = ChartInstance.GetYaxis(IndicatorData[i].Value);
            if (i === DataStart) { ctx.moveTo(xCoordinate, yCoordinate); xVal.push(xCoordinate); xVal.push(xCoordinate); yVal.push(yBasePoint); yVal.push(yCoordinate); }
            else {
                ctx.lineTo(xCoordinate, yCoordinate); xVal.push(xCoordinate); yVal.push(yCoordinate);
            }
            DataIndex++;
        }
        ctx.lineJoin = 'round';
        ctx.stroke();

        xVal.push(xVal[xVal.length - 1]);
        yVal.push(yBasePoint);
        FillFunction(IndicatorContext, xVal, yVal, LineColor);
    }
}

function PresentationToPolygon(PolygonSettings, ChartInstance, MainIndicatorChart) {
    var polygonData1 = getPolygonRange(MainIndicatorChart.ComputationProperties.DataStartInternal, ChartInstance.ComputationProperties.NumbersOfVisibleBars, PolygonSettings.Polygon1.Shift, PolygonSettings.Polygon1.Data, ChartInstance, MainIndicatorChart);
    var polygonData2 = getPolygonRange(MainIndicatorChart.ComputationProperties.DataStartInternal, ChartInstance.ComputationProperties.NumbersOfVisibleBars, PolygonSettings.Polygon2.Shift, PolygonSettings.Polygon2.Data, ChartInstance, MainIndicatorChart);

    PolygonSettings.Polygon1.Data = polygonData1;
    PolygonSettings.Polygon2.Data = polygonData2;

    DrawPolygonFill(PolygonSettings, ChartInstance);
}

function getPolygonRange(index, Period, Shift, BarData, ChartInstance, MainIndicatorChart) {
    var range = [];
    var retVal = [];

    var isHasMargin = ChartInstance.ChartOtherProperties.dataAdded == 1;
    var marginVisibleBars = Math.ceil(ChartInstance.ComputationProperties.DefaultBarsWidth / ChartInstance.ComputationProperties.BarSpace);

    var xPositionVisibleBars = (ChartInstance.ctxIndicatorTopCanvas.canvas.width - ChartInstance.ComputationProperties.XPositionFirstData) / ChartInstance.ComputationProperties.BarSpace;

    var numberOfOriginalBars = BarData.length < Period ? xPositionVisibleBars + BarData.length : ChartInstance.ComputationProperties.NumbersOfVisibleBars + marginVisibleBars;

    var tempIndex = BarData.length < Period ? Shift <= xPositionVisibleBars ? 0 : index + (Shift - xPositionVisibleBars) : isHasMargin ? Shift <= marginVisibleBars ? 0 : index + (Shift - marginVisibleBars) : index + Shift >= 0 ? index + Shift : 0;
    var tempPeriod = isHasMargin ? Shift <= marginVisibleBars ? tempIndex + Period + Shift : tempIndex + Period + marginVisibleBars : tempIndex + Period > BarData.length ? BarData.length - 1 : Shift + index < 0 ? tempIndex + Period + (Shift + index) : tempIndex + Period;
    var tempIndex = BarData.length < Period ? Shift <= xPositionVisibleBars ? 0 : 0 : isHasMargin ? Shift <= marginVisibleBars ? 0 : index + (Shift - marginVisibleBars) : index + Shift >= 0 ? index + Shift : 0;
    var tempPeriod = isHasMargin ? Shift <= marginVisibleBars ? tempIndex + Period + Shift : tempIndex + Period + marginVisibleBars : tempIndex + Period > BarData.length ? BarData.length - 1 : Shift + index < 0 ? tempIndex + Period + (Shift + index) : tempIndex + Period;

    var barsToValidate = isHasMargin ? ChartInstance.ComputationProperties.NumbersOfVisibleBars : numberOfOriginalBars;

    if (barsToValidate + Shift < 0) {
        range = []
    } else {
        range = BarData.slice(tempIndex, tempPeriod + 1);
    }

    var isLatestBarVisible = (MainIndicatorChart !== undefined) ? ((MainIndicatorChart.ChartOtherProperties.dataAdded === 1) ? true : (((MainIndicatorChart.ComputationProperties.DataEndInternal - MainIndicatorChart.ComputationProperties.DataStartInternal) < MainIndicatorChart.ComputationProperties.NumbersOfVisibleBars) ? true : false)) : ((ChartInstance.ChartOtherProperties.dataAdded === 1) ? true : false) ? true : ((ChartInstance.ComputationProperties.DataEndInternal >= ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? false : true);
    var isEnoughData = (ChartInstance.ComputationProperties.DataEndInternal >= ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? true : ((ChartInstance.ComputationProperties.DataEndInternal + 1) === ChartInstance.ComputationProperties.NumbersOfVisibleBars) ? true : false;

    var len = range.length;
    for (var i = 0; i < len; i++) {
        var val = range[i];

        var tempX = Math.ceil(getXCoordinate(ChartInstance.ctxIndicatorTopCanvas.canvas.width, ChartInstance.ComputationProperties.DefaultBarsWidth, i, ChartInstance.ComputationProperties.BarSpace, isLatestBarVisible, ChartInstance.ComputationProperties.XPositionFirstData, isEnoughData) + (BarData.length < Period ? Shift <= xPositionVisibleBars ? ChartInstance.ComputationProperties.BarSpace * Shift : ChartInstance.ComputationProperties.BarSpace * Shift : isHasMargin ? Shift <= marginVisibleBars ? ChartInstance.ComputationProperties.BarSpace * Shift : ChartInstance.ComputationProperties.BarSpace * marginVisibleBars : Shift < 0 ? index + Shift < 0 ? ChartInstance.ComputationProperties.BarSpace * (Shift + index) : 0 : 0));
        var tempY = ChartInstance.GetYaxis(val.Value);



        retVal.push({ X: tempX, Y: tempY });
    }

    return retVal;
}

function FillFunction(ctx, xValues, yValues, LineColor) {
    var color = hexToRGBA(LineColor, 0.2);
    ctx.strokeStyle = color;
    ctx.beginPath();
    var x = xValues.length - 1;
    for (var i = 0; i < xValues.length; i++) {
        if (i === x) { ctx.lineTo(xValues[i], yValues[i]); break; }
        if (i === 0) { ctx.moveTo(xValues[i], yValues[i]); }
        else { ctx.lineTo(xValues[i], yValues[i]); }
    }
    ctx.fillStyle = color;
    ctx.stroke();
    ctx.fill();
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

function DrawLowerIndicatorName(context, name, textColor) {
    context.fillStyle = textColor;
    context.font = "11px Arial";
    context.fillText(name, 4, 16);
}

function HistogramFillTwoLines(ChartInstance, Data, context, settings, CoordinatesOfZero, DataStart, DataEnd, shift, ShiftValue, isEnoughData, PointDistance, DataIndex, isLatestBarVisible) {
    context.beginPath();
    context.strokeStyle = 'black';
    context.globalAlpha = 0.3;
    var IsPositive = true;
    var LastXOfIntersection = 0;
    DataEnd = DataEnd - shift;
    if (DataEnd > Data.length) {
        DataEnd = Data.length;
    }
    for (var i = DataStart; i < DataEnd; i++) {
        var Y = ChartInstance.GetYaxis(Data[i].Value);
        var X = getXCoordinate(context.canvas.width, ChartInstance.ComputationProperties.DefaultBarsWidth, DataIndex, PointDistance, isLatestBarVisible, ChartInstance.ComputationProperties.XPositionFirstData, isEnoughData) + ((shift >= 0) ? (shift * ShiftValue) : 0);
        var NextY = null;
        var NextX = null;
        var value = Data[i].Value;
        var nextValue = null;

        if (i + 1 !== Data.length) {
            nextValue = Data[i + 1].Value;
            NextY = ChartInstance.GetYaxis(Data[i + 1].Value);
            NextX = getXCoordinate(context.canvas.width, ChartInstance.ComputationProperties.DefaultBarsWidth, DataIndex + 1, PointDistance, isLatestBarVisible, ChartInstance.ComputationProperties.XPositionFirstData, isEnoughData) + ((shift >= 0) ? (shift * ShiftValue) : 0);;
        }
        if (i === DataStart) {
            context.moveTo(X, CoordinatesOfZero.y1);
            context.lineTo(X, Y);
        }
        else {
            context.lineTo(X, Y);
        }
        var IntersectionCoordinates = ComputeIntersection(X, Y, NextX, NextY, CoordinatesOfZero.x1, CoordinatesOfZero.y1, CoordinatesOfZero.x2, CoordinatesOfZero.y2);
        if (nextValue !== null) {
            if (IntersectionCoordinates) {
                if ((value >= 0 && nextValue < 0) === true || (nextValue >= 0 && value < 0) === true) {
                    context.lineTo(IntersectionCoordinates.XPoint, IntersectionCoordinates.YPoint);

                    LastXOfIntersection = IntersectionCoordinates.XPoint;
                    context.stroke();
                    if (value >= 0) {
                        context.fillStyle = settings.HistogramColor1;
                        context.fill();
                    }
                    else {
                        context.fillStyle = settings.HistogramColor2;
                        context.fill();
                    }
                    context.beginPath();
                    context.moveTo(IntersectionCoordinates.XPoint, IntersectionCoordinates.YPoint);
                }
            }
        }

        if (i === DataEnd - 1) {
            context.lineTo(X, CoordinatesOfZero.y2);
            if (value >= 0) {
                context.fillStyle = settings.HistogramColor1;
                context.fill();
            }
            else {
                context.fillStyle = settings.HistogramColor2;
                context.fill();
            }
        }
        DataIndex++;
    }
    context.stroke();
}

function DrawPolygonFill(Data, ChartInstance) {
    var context = ChartInstance.ctxIndicatorTopCanvas;
    var Offset = null;

    if (ChartInstance.ComputationProperties.DataLength < ChartInstance.ComputationProperties.NumbersOfVisibleBars) {
        Offset = Data.Polygon2.Shift - Data.Polygon1.Shift;
    }
    else {
        Offset = Data.Polygon2.Data.length - Data.Polygon1.Data.length;
    }
    var EqualIndex = null;
    var LastColor = null;
    var LastIntersectionPoint = null;
    var FirstDataEquevalentToZeroIndexOfPolygon1 = null;
    context.globalAlpha = 0.3;
    //DrawPolygon1
    context.beginPath();
    context.strokeStyle = "transparent";

    var LastNumber = 0;
    for (var i = 0; i < Data.Polygon1.Data.length; i++) {
        var CurDataPolygon1 = Data.Polygon1.Data[i];
        var CurDataPolygon2 = null;
        var PrevDataPolygon1 = null;
        var PrevDataPolygon2 = null;

        if (i + Offset < Data.Polygon2.Data.length && i + Offset >= 0) {
            CurDataPolygon2 = Data.Polygon2.Data[i + Offset];
        }
        if (i + 1 < Data.Polygon1.Data.length) {
            PrevDataPolygon1 = Data.Polygon1.Data[i + 1];
        }
        if (i + Offset + 1 < Data.Polygon2.Data.length && i + Offset + 1 >= 0) {
            PrevDataPolygon2 = Data.Polygon2.Data[i + Offset + 1];
        }
        if (i === 0) {
            if (Offset > 0) {
                if (i + Offset < Data.Polygon2.Data.length) {
                    context.moveTo(Data.Polygon2.Data[i + Offset].X, Data.Polygon2.Data[i + Offset].Y);
                }
                context.lineTo(CurDataPolygon1.X, CurDataPolygon1.Y);
                FirstDataEquevalentToZeroIndexOfPolygon1 = i + Offset;
            }
            else {
                context.moveTo(CurDataPolygon1.X, CurDataPolygon1.Y);
            }
        }
        else {
            if (CurDataPolygon2 === null && PrevDataPolygon2 === null) {
                continue;
            }
            context.lineTo(CurDataPolygon1.X, CurDataPolygon1.Y);
        }


        SetLastColor();
        if (PrevDataPolygon2 === undefined && PrevDataPolygon1 === undefined) {
            continue;
        }
        if (PrevDataPolygon1 !== null && CurDataPolygon2 !== null && PrevDataPolygon2 !== null && CurDataPolygon1 !== null) {
            if (PrevDataPolygon1.X !== PrevDataPolygon2.X) {
                PrevDataPolygon1.X = PrevDataPolygon2.X;
            }
            if (CurDataPolygon2.X !== CurDataPolygon1.X) {
                CurDataPolygon2.X = CurDataPolygon1.X;
            }
            var IntersectionCoortinates = ComputeIntersection(CurDataPolygon1.X, CurDataPolygon1.Y, PrevDataPolygon1.X, PrevDataPolygon1.Y, CurDataPolygon2.X, CurDataPolygon2.Y, PrevDataPolygon2.X, PrevDataPolygon2.Y);
            if (IntersectionCoortinates) {
                context.lineTo(IntersectionCoortinates.XPoint, IntersectionCoortinates.YPoint);
                var IsNotApplicableToFill = false;
                for (var ii = i + Offset; ii >= LastNumber; ii--) {
                    context.lineTo(Data.Polygon2.Data[ii].X, Data.Polygon2.Data[ii].Y);
                    if (FirstDataEquevalentToZeroIndexOfPolygon1 !== null) {
                        if (ii === FirstDataEquevalentToZeroIndexOfPolygon1) {
                            IsNotApplicableToFill = true;
                            FillCondition2();
                            context.closePath();
                            context.beginPath();
                            context.moveTo(Data.Polygon2.Data[ii].X, Data.Polygon2.Data[ii].Y);
                            FirstDataEquevalentToZeroIndexOfPolygon1 = null;
                        }
                    }
                }
                if (LastNumber === 0 && Offset < 0) {
                    context.lineTo(Data.Polygon1.Data[LastNumber - Offset].X, Data.Polygon1.Data[LastNumber - Offset].Y);
                }
                if (LastIntersectionPoint !== null) {
                    context.lineTo(LastIntersectionPoint.XPoint, LastIntersectionPoint.YPoint);
                }
                LastIntersectionPoint = IntersectionCoortinates;
                if (!IsNotApplicableToFill) {
                    FillCondition2();
                }
                context.stroke();
                context.closePath();
                context.beginPath();
                context.moveTo(IntersectionCoortinates.XPoint, IntersectionCoortinates.YPoint);
                LastNumber = i + Offset + 1;
            }
        }
        else {
            if ((PrevDataPolygon1 === null && CurDataPolygon1 !== null && CurDataPolygon2 !== null && PrevDataPolygon2 !== null) || (PrevDataPolygon2 === null && CurDataPolygon1 !== null && CurDataPolygon2 !== null && PrevDataPolygon1 !== null)) {
                context.lineTo(CurDataPolygon2.X, CurDataPolygon2.Y);
            }
            else if (CurDataPolygon2 === null && PrevDataPolygon2 === null) {
                if (Offset < 0) {
                    context.closePath();
                    context.beginPath();
                    context.lineTo(CurDataPolygon1.X, CurDataPolygon1.Y);
                }
            }
            else if (CurDataPolygon2 === null && PrevDataPolygon2 !== null) {
                if (Offset < 0) {
                    context.closePath();
                    context.beginPath();
                    context.lineTo(CurDataPolygon1.X, CurDataPolygon1.Y);
                }
            }
        }
        EqualIndex++;
    }
    for (var ii = i - 1 + (Offset) ; ii >= (LastNumber === 0 ? FirstDataEquevalentToZeroIndexOfPolygon1 : LastNumber) ; ii--) {
        if (ii < Data.Polygon2.Data.length) {
            context.lineTo(Data.Polygon2.Data[ii].X, Data.Polygon2.Data[ii].Y);
        }
    }
    if (LastIntersectionPoint != null) {
        context.lineTo(LastIntersectionPoint.XPoint, LastIntersectionPoint.YPoint);
    }

    if (LastNumber === 0 && FirstDataEquevalentToZeroIndexOfPolygon1 === null) {
        if (Math.abs(Offset) < Data.Polygon1.Data.length) {
            context.lineTo(Data.Polygon1.Data[Math.abs(Offset)].X, Data.Polygon1.Data[Math.abs(Offset)].Y);
        }
    }
    FillCondition();
    context.stroke();
    context.closePath();
    DrawPolygonLines(Data, ChartInstance);

    function FillCondition() {
        if (Data.Polygon2.Data.length - 1 < Data.Polygon2.Data.length && Data.Polygon1.Data.length - 1 < Data.Polygon1.Data.length) {
            if (Data.Polygon2.Data.length <= 0 || Data.Polygon1.Data.length <= 0) {
                return;
            }
            context.fillStyle = LastColor;
            context.fill();
        }
    }

    function FillCondition2() {
        if (LastColor === null) {
            if (PrevDataPolygon2.Y < PrevDataPolygon1.Y) {
                context.fillStyle = Data.Polygon1.Color;
            }
            else {
                context.fillStyle = Data.Polygon2.Color;
            }
        }
        else {
            if (LastColor !== null) {
                context.fillStyle = LastColor;
            }
        }
        context.fill();
    }

    function SetLastColor() {
        if (CurDataPolygon2 !== null && CurDataPolygon1 !== null) {
            if (CurDataPolygon2.Y > CurDataPolygon1.Y) {
                LastColor = Data.Polygon1.Color;
            }
            else if (CurDataPolygon2.Y < CurDataPolygon1.Y) {
                LastColor = Data.Polygon2.Color;
            }
        }
    }

}

function DrawPolygonLines(Data, ChartInstance) {
    DrawLines(Data.Polygon1, ChartInstance);
    DrawLines(Data.Polygon2, ChartInstance);
}

function DrawLines(Data, ChartInstance) {
    var context = ChartInstance.ctxIndicatorTopCanvas;
    context.beginPath();
    context.strokeStyle = Data.Color;
    context.lineWidth = Data.lineWidth;
    context.globalAlpha = 1;
    for (var i = 0; i < Data.Data.length; i++) {
        var X = Data.Data[i].X;
        var Y = Data.Data[i].Y;
        if (i === 0) {
            context.moveTo(X, Y);
        }
        else {
            context.lineTo(X, Y);
        }
    }
    context.stroke();
    context.closePath();
}

function ComputeIntersection(x1, y1, x2, y2, x3, y3, x4, y4) {
    var PointX = 0;
    var PointY = 0;
    if (!lineIntersect(x1, y1, x2, y2, x3, y3, x4, y4)) {
        return false;
    }
    PointX = Math.round(((x1 * y2 - y1 * x2) * (x3 - x4) - ((x1 - x2) * (x3 * y4 - y3 * x4)))
          / ((x1 - x2) * (y3 - y4) - (y1 - y2) * (x3 - x4)));

    PointY = Math.round(((x1 * y2 - y1 * x2) * (y3 - y4) - (y1 - y2) * (x3 * y4 - y3 * x4))
         / ((x1 - x2) * (y3 - y4) - (y1 - y2) * (x3 - x4)));

    return { XPoint: PointX, YPoint: PointY };

}

function lineIntersect(x1, y1, x2, y2, x3, y3, x4, y4) {
    var x = ((x1 * y2 - y1 * x2) * (x3 - x4) - (x1 - x2) * (x3 * y4 - y3 * x4)) / ((x1 - x2) * (y3 - y4) - (y1 - y2) * (x3 - x4));
    var y = ((x1 * y2 - y1 * x2) * (y3 - y4) - (y1 - y2) * (x3 * y4 - y3 * x4)) / ((x1 - x2) * (y3 - y4) - (y1 - y2) * (x3 - x4));
    if (isNaN(x) || isNaN(y)) {
        return false;
    } else {
        if (x1 >= x2) {
            if (!(x2 <= x && x <= x1)) { return false; }
        } else {
            if (!(x1 <= x && x <= x2)) { return false; }
        }
        if (y1 >= y2) {
            if (!(y2 <= y && y <= y1)) { return false; }
        } else {
            if (!(y1 <= y && y <= y2)) { return false; }
        }
        if (x3 >= x4) {
            if (!(x4 <= x && x <= x3)) { return false; }
        } else {
            if (!(x3 <= x && x <= x4)) { return false; }
        }
        if (y3 >= y4) {
            if (!(y4 <= y && y <= y3)) { return false; }
        } else {
            if (!(y3 <= y && y <= y4)) { return false; }
        }
    }
    return true;
}

function TriggerSettingsClose(ID, ChartInstance, Action) {
    ChartInstance.ParentELement.trigger("TriggerSettingsClose", [ID, Action]);
}

function IsDrawPolygon(CollectionType1, CollectionType2) {
    if (CollectionType1 == "Polygon1" && CollectionType2 == "Polygon2") {
        return true;
    } else if (CollectionType1 == "Polygon2" && CollectionType2 == "Polygon1") {
        return true
    } else {
        return false;
    }
}

function DrawPolygonPairs(canvas, chartInstance, barSpace, barData, mainChartInstance, SettingsList) {
    for (var i = 0; i < SettingsList.length; i++) {
        for (var ii = 0; ii < SettingsList.length; ii++) {
            var cur = SettingsList[i];
            var nxt = SettingsList[ii];

            if ((cur.CollectionType == "Polygon1" && nxt.CollectionType == "Polygon2") || (cur.CollectionType == "Polygon2" && nxt.CollectionType == "Polygon1")) {
                self.DrawIndicator(canvas, chartInstance, null, null, barSpace, null, barData, mainChartInstance, PSettings);
            }
        }
    }
}

//Simple Moving Average
WC.IN.IndicatorSMA = function (ChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this;
    var PreviousValue = false;
    var isIndicatorSettingsBuffers = true;
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorInfo = {
        IndicatorName: "SMA",
        IndicatorFullName: "Simple Moving Average",
        IndicatorCodeName: "Simple_Moving_Average",
    };

    self.SettingsValues = {
        Period: 9,
        CollectionType: "Line",
        LineColor: '#0000FF',
        Shift: 0,
        LineStyle: "Solid",
        Width: 1
    };

    self.SettingsObject = {
        Period: { group: "Computations", name: "Period", type: "number", options: { min: 2, max: 999 } },
        CollectionType: { group: "SMA Line", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        LineColor: { group: "SMA Line", name: "Color", type: "color", options: { preferformat: "hex" } },
        Shift: { group: "SMA Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "SMA Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        Width: { group: "SMA Line", name: "Width", type: "number", options: { min: 1, max: 20 } }
    };

    WC.IN.BaseIndicator.call(this);

    self.IndicatorID = "SMA-" + IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = true;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, Period: self.SettingsValues.Period, ContainerID: self.ContainerId, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        isIndicatorSettingsBuffers = false;
        self.DrawIndicatorLine();
        self.tmpIndicatorData = [];
    }

    self.DrawIndicatorLine = function () {
        self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, self.IndicatorData, null, self.SettingsValues.LineColor, null);
    }

    self.Update = function (UpdateType) {
        if (isIndicatorSettingsBuffers === false) {
            var value = Calculate(0);
            var obj = { Value: value, Stamp: self.Bars[0].Stamp() };
            if (UpdateType === "FrontDataAdded") {
                self.IndicatorData.unshift(obj);
            }
            else if (UpdateType === "BarUpdate") {
                self.IndicatorData[0] = obj;
            }

            // self.DrawIndicatorLine();
        }
    }
    function Calculate(index) {
        var rangeSMA = self.getDataRange(index, self.SettingsValues.Period, self.Bars);
        var range = self.getValueToCompute(IndicatorValue, rangeSMA);
        var ReturnValue = self.ComputeSMA(range, self.SettingsValues.Period);

        return ReturnValue;
    }

}

// Average True Range
WC.IN.IndicatorATR = function (ChartInstance, MainChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this;
    var PreviousValue = true;
    var isIndicatorSettingsBuffers = true;
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorID = IndicatorID;
    self.IndicatorInfo = {
        IndicatorName: "ATR",
        IndicatorFullName: "Average True Range",
        IndicatorCodeName: "Average_True_Range",
    };

    self.SettingsValues = {
        Period: 9,
        CollectionType: "Histogram Fill",
        HistogramColor1: '#006400',
        HistogramColor2: '#8B0000',
        HistogramColor3: '#00008B',
        HistogramColor4: '#FFD700',
        Shift: 0,
        LineStyle: "Solid",
        VisualType: "oneLine",
        Width: 1,

    };

    self.SettingsObject = {
        Period: { group: "Computations", name: "Period", type: "number", options: { min: 2, max: 999 } },
        CollectionType: { group: "ATR Line", name: "Collection Type", type: "option", options: ["Line", "Histogram", "Histogram Fill", "Dots"] },
        HistogramColor1: { group: "ATR Line", name: "Histogram Color 1", type: "color", options: { preferformat: "hex" }, visible: true },
        HistogramColor2: { group: "ATR Line", name: "Histogram Color 2", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor3: { group: "ATR Line", name: "Histogram Color 3", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor4: { group: "ATR Line", name: "Histogram Color 4", type: "color", options: { preferformat: "hex" }, visible: false },
        Shift: { group: "ATR Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "ATR Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        VisualType: { group: "ATR Line", name: "VisualType", type: "option", options: ["oneLine", "twoLine", "Change", "Multi"], visible: true },
        Width: { group: "ATR Line", name: "Width", type: "number", options: { min: 1, max: 20 } },
    };

    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setVisualTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }

    WC.IN.BaseIndicator.call(this);

    self.IndicatorID = IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = false;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, Period: self.SettingsValues.Period, ContainerID: self.ContainerId, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        isIndicatorSettingsBuffers = false;
        ChartInstance.Resizemethod();
        ChartInstance.ChartData = self.IndicatorData;

        ChartInstance.initYBoundaries(self.IndicatorData);
        self.DrawIndicatorLine();
        DrawLowerIndicatorName(ChartInstance.ctxIndicatorTopCanvas, self.IndicatorInfo.IndicatorName, MainChartInstance.ChartSettings.ForeGround);
    }


    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length !== 0) {
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, self.IndicatorData, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.HistogramColor1, BarData, MainChartInstance);
        }
    }


    self.Update = function (UpdateType) {
        if (!isIndicatorSettingsBuffers) {
            if (UpdateType === "FrontDataAdded") {
                var TrueRange = self.getTrueRange(self.Bars[0].High(), self.Bars[0].Low(), self.Bars[1].Close());
                var ATR = ((self.IndicatorData[0].Value * (self.SettingsValues.Period - 1)) + TrueRange) / self.SettingsValues.Period;
                var obj = { Value: ATR, Stamp: self.Bars[0].Stamp() };
                self.IndicatorData.unshift(obj);
            }
            else if (UpdateType === "BarUpdate") {
                var TrueRange = self.getTrueRange(self.Bars[0].High(), self.Bars[0].Low(), self.Bars[1].Close());
                var ATR = ((self.IndicatorData[1].Value * (self.SettingsValues.Period - 1)) + TrueRange) / self.SettingsValues.Period;
                var obj = { Value: ATR, Stamp: self.Bars[0].Stamp() };
                self.IndicatorData[0] = obj;
            }
            // self.DrawIndicatorLine();
        }
    }
};

// Exponential Moving Average
WC.IN.IndicatorEMA = function (ChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this;
    var PreviousValue = false;
    var isIndicatorSettingsBuffers = true;
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorInfo = {
        IndicatorName: "EMA",
        IndicatorFullName: "Exponential Moving Average",
        IndicatorCodeName: "Exponential_Moving_Average",
    };

    self.isSettingsActivated = false;

    self.SettingsValues = {
        Period: 14,
        CollectionType: "Line",
        LineColor: '#008B8B',
        Shift: 0,
        LineStyle: "Solid",
        Width: 1
    };

    self.SettingsObject = {
        Period: { group: "Computations", name: "Period", type: "number", options: { min: 2, max: 999 } },
        CollectionType: { group: "EMA Line", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        LineColor: { group: "EMA Line", name: "Color", type: "color", options: { preferformat: "hex" } },
        Shift: { group: "EMA Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "EMA Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        Width: { group: "EMA Line", name: "Width", type: "number", options: { min: 1, max: 20 } }
    };

    WC.IN.BaseIndicator.call(this);

    self.IndicatorID = "EMA-" + IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = true;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, Period: self.SettingsValues.Period, ContainerID: self.ContainerId, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        isIndicatorSettingsBuffers = false;
        self.DrawIndicatorLine();
        self.tmpIndicatorData = [];
    }

    self.DrawIndicatorLine = function (IndicatorContext) {
        if (self.IndicatorData.length !== 0) {
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, self.IndicatorData, null, self.SettingsValues.LineColor, null);
        }
    }

    self.Update = function (UpdateType) {
        if (isIndicatorSettingsBuffers === false) {
            if (UpdateType === "FrontDataAdded") {
                var value = Calculate(0, false, self.IndicatorData[0].Value);
                var obj = { Value: value, Stamp: self.Bars[0].Stamp() };
                self.IndicatorData.unshift(obj);
            }
            else if (UpdateType === "BarUpdate") {
                var value = Calculate(0, false, self.IndicatorData[1].Value);
                var obj = { Value: value, Stamp: self.Bars[0].Stamp() };
                self.IndicatorData[0] = obj;
            }
        }
    }

    function Calculate(index, firstEMA, PreviousValue) {
        var rangeEMA = self.getDataRange(index, self.SettingsValues.Period, self.Bars);
        var range = self.getValueToCompute(IndicatorValue, rangeEMA);
        var ReturnValue = self.ComputeEMA(range, self.SettingsValues.Period, firstEMA, PreviousValue);

        return ReturnValue;
    }
};

// Donchian Channel
WC.IN.IndicatorDC = function (ChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID ) {
    var self = this;
    var PreviousValue = false;
    var isIndicatorSettingsBuffers = true;
    var HighBand = [];
    var LowBand = [];
    var MidBand = [];
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorInfo = {
        IndicatorName: "DC",
        IndicatorFullName: "Donchian Channel",
        IndicatorCodeName: "Donchian_Channel",
    };

    self.isSettingsActivated = false;

    self.SettingsValues = {
        Period: 10,
        CollectionTypeHigh: "Line",
        LineColorHigh: '#191970',
        ShiftHigh: 0,
        LineStyleHigh: "Solid",
        WidthHigh: 1,
        CollectionTypeMid: "Line",
        LineColorMid: '#FF00FF',
        ShiftMid: 0,
        LineStyleMid: "Solid",
        WidthMid: 1,
        CollectionTypeLow: "Line",
        LineColorLow: '#191970',
        ShiftLow: 0,
        LineStyleLow: "Solid",
        WidthLow: 1
    };

    self.SettingsObject = {
        Period: { group: "Computations", name: "Period", type: "number", options: { min: 2, max: 999 } },
        CollectionTypeHigh: { group: "Upper Band", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        LineColorHigh: { group: "Upper Band", name: "Color", type: "color", options: { preferformat: "hex" } },
        ShiftHigh: { group: "Upper Band", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyleHigh: { group: "Upper Band", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        WidthHigh: { group: "Upper Band", name: "Width", type: "number", options: { min: 1, max: 20 } },
        CollectionTypeMid: { group: "Middle Line", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        LineColorMid: { group: "Middle Line", name: "Color", type: "color", options: { preferformat: "hex" } },
        ShiftMid: { group: "Middle Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyleMid: { group: "Middle Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        WidthMid: { group: "Middle Line", name: "Width", type: "number", options: { min: 1, max: 20 } },
        CollectionTypeLow: { group: "Lower Band", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        LineColorLow: { group: "Lower Band", name: "Color", type: "color", options: { preferformat: "hex" } },
        ShiftLow: { group: "Lower Band", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyleLow: { group: "Lower Band", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        WidthLow: { group: "Lower Band", name: "Width", type: "number", options: { min: 1, max: 20 } }
    };

    WC.IN.BaseIndicator.call(this);

    self.IndicatorID = "DC-" + IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = true;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, Period: self.SettingsValues.Period, ContainerID: self.ContainerId, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        HighBand = []; MidBand = []; LowBand = [];
        HighBand = self.IndicatorData[0];
        MidBand = self.IndicatorData[1];
        LowBand = self.IndicatorData[2];
        isIndicatorSettingsBuffers = false;
        self.DrawIndicatorLine();
        self.tmpIndicatorData = [];
    }

    self.DrawIndicatorLine = function (IndicatorContext) {
        if (self.IndicatorData.length !== 0) {
            var propHigh = CreateBasicSettingsPackage(self.SettingsValues.CollectionTypeHigh, self.SettingsValues.ShiftHigh, self.SettingsValues.WidthHigh, self.SettingsValues.LineStyleHigh, null);
            var propMid = CreateBasicSettingsPackage(self.SettingsValues.CollectionTypeMid, self.SettingsValues.ShiftMid, self.SettingsValues.WidthMid, self.SettingsValues.LineStyleMid, null);
            var propLow = CreateBasicSettingsPackage(self.SettingsValues.CollectionTypeLow, self.SettingsValues.ShiftLow, self.SettingsValues.WidthLow, self.SettingsValues.LineStyleLow, null);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, propHigh, HighBand, null, self.SettingsValues.LineColorHigh, null);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, propMid, MidBand, null, self.SettingsValues.LineColorMid, null);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, propLow, LowBand, null, self.SettingsValues.LineColorLow, null);
            console.log("1");
        }
    }

    self.Update = function (UpdateType) {
        if (isIndicatorSettingsBuffers === false) {

            var BarsRange = self.getDataRange(1, self.SettingsValues.Period, self.Bars);
            var HighValues = self.getValueToCompute("High", BarsRange);
            var LowValues = self.getValueToCompute("Low", BarsRange);
            var HighestHigh = { Value: Math.max.apply(Math, HighValues), Stamp: null };
            var LowestLow = { Value: Math.min.apply(Math, LowValues), Stamp: null };
            var Mid = { Value: ((HighestHigh + LowestLow) / 2), Stamp: null };

            if (UpdateType === "FrontDataAdded") {
                HighBand.unshift(HighestHigh);
                LowBand.unshift(LowestLow);
                MidBand.unshift(Mid);
            }
            else if (UpdateType === "BarUpdate") {
                HighBand[0] = HighestHigh;
                LowBand[0] = LowestLow;
                MidBand[0] = Mid;
            }
        }
    }
};

// Fractal Chaos Bands
WC.IN.IndicatorFCB = function (ChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID ) {
    var self = this;
    var PreviousValue = false;
    var isIndicatorSettingsBuffers = true;
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    var FractalHigh, FractalLow;
    self.IndicatorInfo = {
        IndicatorName: "FCB",
        IndicatorFullName: "Fractal Chaos Bands",
        IndicatorCodeName: "Fractal_Chaos_Bands",
    };

    self.SettingsValues = {
        CollectionTypeHigh: "Line",
        LineColorHigh: '#00FF00',
        ShiftHigh: 0,
        LineStyleHigh: "Solid",
        WidthHigh: 1,
        CollectionTypeLow: "Line",
        LineColorLow: '#FF0000',
        ShiftLow: 0,
        LineStyleLow: "Solid",
        WidthLow: 1
    };

    self.SettingsObject = {
        CollectionTypeHigh: { group: "Fractal High", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        LineColorHigh: { group: "Fractal High", name: "Color", type: "color", options: { preferformat: "hex" } },
        ShiftHigh: { group: "Fractal High", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyleHigh: { group: "Fractal High", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        WidthHigh: { group: "Fractal High", name: "Width", type: "number", options: { min: 1, max: 20 } },
        CollectionTypeLow: { group: "Fractal Low", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        LineColorLow: { group: "Fractal Low", name: "Color", type: "color", options: { preferformat: "hex" } },
        ShiftLow: { group: "Fractal Low", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyleLow: { group: "Fractal Low", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        WidthLow: { group: "Fractal Low", name: "Width", type: "number", options: { min: 1, max: 20 } }
    };

    WC.IN.BaseIndicator.call(this);

    self.IndicatorID = "FCB-" + IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = true;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, Period: null, ContainerID: self.ContainerId, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        FractalHigh = self.IndicatorData[0];
        FractalLow = self.IndicatorData[1];
        isIndicatorSettingsBuffers = false;
        self.DrawIndicatorLine();
        self.tmpIndicatorData = [];
    }


    self.DrawIndicatorLine = function (IndicatorContext) {
        if (self.IndicatorData.length !== 0) {
            var propHigh = CreateBasicSettingsPackage(self.SettingsValues.CollectionTypeHigh, self.SettingsValues.ShiftHigh, self.SettingsValues.WidthHigh, self.SettingsValues.LineStyleHigh, null);
            var propLow = CreateBasicSettingsPackage(self.SettingsValues.CollectionTypeLow, self.SettingsValues.ShiftLow, self.SettingsValues.WidthLow, self.SettingsValues.LineStyleLow, null);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, propHigh, FractalHigh, null, self.SettingsValues.LineColorHigh, null);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, propLow, FractalLow, null, self.SettingsValues.LineColorLow, null);
        }
    }

    self.Update = function (UpdateType) {
        if (isIndicatorSettingsBuffers === false) {

            var FractalHighCheck = CheckFractalHigh(i);
            var FractalLowCheck = CheckFractalLow(i);

            var FractalHighValue;
            var FractalLowValue;

            if (FractalHighCheck === true) {
                var index = 0 + 2;
                var value = self.Bars[index].High();
                FractalHighValue = { Value: value, Stamp: null };

            } else {
                if (FractalHigh.length !== 0) {
                    FractalHighValue = { Value: FractalHigh[0].Value, Stamp: null };
                }
            }

            if (FractalLowCheck === true) {
                var index = 0 + 2;
                var value = self.Bars[index].Low();
                FractalLowValue = { Value: value, Stamp: null };
            } else {
                if (FractalLow.length !== 0) {
                    FractalLowValue = { Value: FractalLow[0].Value, Stamp: null };
                }
            }

            var obj = { Value: value, Stamp: self.Bars[0].Stamp() };
            if (UpdateType === "FrontDataAdded") {
                FractalHigh.unshift(FractalHighValue);
                FractalLow.unshift(FractalLowValue);
            }
            else if (UpdateType === "BarUpdate") {
                FractalHigh[0] = FractalHighValue;
                FractalLow[0] = FractalLowValue;
            }
        }
    }

    function CheckFractalHigh(index) {

        var GetRange = self.getDataRange(index, 5, self.Bars);
        var Range = self.getValueToCompute("High", GetRange);

        if (Range[2] >= Range[3] && Range[2] >= Range[4] && Range[2] >= Range[1] && Range[2] >= Range[0]) {
            return true;
        }
        else {
            return false;
        }

    }

    function CheckFractalLow(index) {

        var GetRange = self.getDataRange(index, 5, self.Bars);
        var Range = self.getValueToCompute("Low", GetRange);

        if (Range[2] <= Range[3] && Range[2] <= Range[4] && Range[2] <= Range[1] && Range[2] <= Range[0]) {
            return true;
        }
        else {
            return false;
        }
    }
};

// Parabolic SAR
WC.IN.IndicatorPSAR = function (ChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this;
    var PreviousValue = false;
    var isIndicatorSettingsBuffers = true;
    var SarNumber = -1;
    var CurrentEP = 0;
    var CurrentSAR = 0;
    var CurrentAF = 0;
    var PrevSarNumber = -1;
    var PrevEP = 0;
    var PrevSAR = 0;
    var PrevAF = 0;
    var trychange = 0;
    var AF = 0.02;
    var MaxAF = 0.20;
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorInfo = {
        IndicatorName: "SAR",
        IndicatorFullName: "Parabolic SAR",
        IndicatorCodeName: "Parabolic_SAR"
    };

    self.SettingsValues = {
        CollectionType: "Dots",
        LineColor: '#800080',
        Shift: 0,
        LineStyle: "Solid",
        Width: 1
    };

    self.SettingsObject = {
        CollectionType: { group: "Parabolic SAR", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        LineColor: { group: "Parabolic SAR", name: "Color", type: "color", options: { preferformat: "hex" } },
        Shift: { group: "Parabolic SAR", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "Parabolic SAR", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        Width: { group: "Parabolic SAR", name: "Width", type: "number", options: { min: 1, max: 20 } }
    };

    WC.IN.BaseIndicator.call(this);

    self.IndicatorID = "SAR-" + IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = true;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, Period: null, ContainerID: self.ContainerId, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        SarNumber = self.tmpIndicatorData.SarNumber;
        CurrentEP = self.tmpIndicatorData.CurrentEP;
        CurrentSAR = self.tmpIndicatorData.CurrentSAR;
        CurrentAF = self.tmpIndicatorData.CurrentAF;
        PrevSarNumber = self.tmpIndicatorData.PrevSarNumber;
        PrevEP = self.tmpIndicatorData.PrevEP;
        PrevSAR = self.tmpIndicatorData.PrevSAR;
        PrevAF = self.tmpIndicatorData.PrevAF;
        trychange = self.tmpIndicatorData.trychange;
        isIndicatorSettingsBuffers = false;
        self.DrawIndicatorLine();
        self.tmpIndicatorData = [];
    }

    self.DrawIndicatorLine = function (IndicatorContext) {
        if (self.IndicatorData.length !== 0) {
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, self.IndicatorData, null, self.SettingsValues.LineColor, null);
        }
    }



    self.Update = function (UpdateType) {
        if (isIndicatorSettingsBuffers === false) {
            var value = Calculate(0);
            var obj = { Value: value, Stamp: self.Bars[0].Stamp() };
            if (UpdateType === "FrontDataAdded") {
                self.IndicatorData.unshift(obj);
            }
            else if (UpdateType === "BarUpdate") {
                self.IndicatorData[0] = obj;
            }
        }
    }

    function Calculate(index) {
        var changeSarNumber = false;
        if (index > 0) {
            PrevSAR = CurrentSAR;
            PrevEP = CurrentEP;
            PrevAF = CurrentAF;
            changeSarNumber = true;
        }
        else if (trychange === self.Bars.length) {
            PrevSAR = CurrentSAR;
            PrevEP = CurrentEP;
            PrevAF = CurrentAF;
            changeSarNumber = true;
            trychange = self.Bars.length + 1;
        }
        else {
            trychange = self.Bars.length + 1;
        }

        var CalculatedSAR = 0;
        CalculatedSAR = PrevSAR + (PrevAF * (PrevEP - PrevSAR));

        var tentativeSAR = 0;
        if (PrevSarNumber < 0) {
            tentativeSAR = Math.max(Math.max((PrevSAR + (PrevAF * (PrevEP - PrevSAR))), self.Bars[index + 1].High()), self.Bars[index + 2].High());
        }
        else {
            tentativeSAR = Math.min(Math.min((PrevSAR + (PrevAF * (PrevEP - PrevSAR))), self.Bars[index + 1].Low()), self.Bars[index + 2].Low());
        }

        if (PrevSarNumber < 0) {
            if (tentativeSAR <= self.Bars[index].High()) {
                SarNumber = 1;
            }
            else {
                SarNumber = PrevSarNumber - 1;
            }
        }
        else {
            if (tentativeSAR > self.Bars[index].Low()) {
                SarNumber = -1;
            }
            else {
                SarNumber = PrevSarNumber + 1;
            }
        }

        if (SarNumber === -1) {
            CurrentSAR = Math.max(PrevEP, self.Bars[index].High());
        }
        else {
            if (SarNumber === 1) {
                CurrentSAR = Math.min(PrevEP, self.Bars[index].Low());
            }
            else {
                CurrentSAR = tentativeSAR;
            }
        }

        if (SarNumber < 0) {
            if (SarNumber === -1) {
                CurrentEP = self.Bars[index].Low();
            }
            else {
                CurrentEP = Math.min(self.Bars[index].Low(), PrevEP);
            }
        }
        else {
            if (SarNumber === 1) {
                CurrentEP = self.Bars[index].High();
            }
            else {
                CurrentEP = Math.max(self.Bars[index].High(), PrevEP);
            }
        }

        if (Math.abs(SarNumber) === 1) {
            CurrentAF = AF;
        }
        else {
            if (PrevEP === CurrentEP) {
                CurrentAF = PrevAF;
            }
            else {
                CurrentAF = Math.min(MaxAF, PrevAF + AF);
            }
        }

        if (changeSarNumber) {
            PrevSarNumber = SarNumber;
        }

        return CurrentSAR;
    }

};

// Moving Average Convergence-Divergence (MACD)
WC.IN.IndicatorMACD = function (ChartInstance, MainChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this;
    var PreviousValue = true;
    var isIndicatorSettingsBuffers = true;
    var MACDHist = [];
    var SignalLine = [];
    var MACDLine = [];
    var ShortEMA = [];
    var LongEMA = [];
    self.ChartInstance = ChartInstance;
    self.IndicatorID = IndicatorID;
    self.ContainerId = ContainerID;
    self.IndicatorInfo = {
        IndicatorName: "MACD",
        IndicatorFullName: "Moving Average Convergence-Divergence",
        IndicatorCodeName: "Moving_Average_Convergence_Divergence"
    };

    self.SettingsValues = {
        ShortPeriod: 12,
        LongPeriod: 26,
        SignalPeriod: 9,
        MACDLineCollectionType: "Line",
        MACDLineColor: '#00FF00',
        MACDLineStyle: "Solid",
        MACDLineShift: 0,
        MACDLineWidth: 1,
        SignalLineCollectionType: "Line",
        SignalLineColor: '#FF0000',
        SignalLineStyle: "Dash",
        SignalLineShift: 0,
        SignalLineWidth: 1,
        CollectionType: "Histogram",
        HistogramColor1: '#006400',
        HistogramColor2: '#8B0000',
        HistogramColor3: '#00008B',
        HistogramColor4: '#FFD700',
        Shift: 0,
        LineStyle: "Solid",
        VisualType: "oneLine",
        Width: 1,

    };

    self.SettingsObject = {
        ShortPeriod: { group: "Computations", name: "Short Period", type: "number", options: { min: 2, max: 999 } },
        LongPeriod: { group: "Computations", name: "Long Period", type: "number", options: { min: 2, max: 999 } },
        SignalPeriod: { group: "Computations", name: "Signal Period", type: "number", options: { min: 2, max: 999 } },
        MACDLineCollectionType: { group: "MACD Line", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        MACDLineColor: { group: "MACD Line", name: "Color", type: "color", options: { preferformat: "hex" }, visible: true },
        MACDLineStyle: { group: "MACD Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        MACDLineShift: { group: "MACD Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        MACDLineWidth: { group: "MACD Line", name: "Width", type: "number", options: { min: 1, max: 20 } },
        SignalLineCollectionType: { group: "Signal Line", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        SignalLineColor: { group: "Signal Line", name: "Color", type: "color", options: { preferformat: "hex" }, visible: true },
        SignalLineStyle: { group: "Signal Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        SignalLineShift: { group: "Signal Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        SignalLineWidth: { group: "Signal Line", name: "Width", type: "number", options: { min: 1, max: 20 } },
        HistogramColor1: { group: "MACD Histogram", name: "Histogram Color 1", type: "color", options: { preferformat: "hex" }, visible: true },
        HistogramColor2: { group: "MACD Histogram", name: "Histogram Color 2", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor3: { group: "MACD Histogram", name: "Histogram Color 3", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor4: { group: "MACD Histogram", name: "Histogram Color 4", type: "color", options: { preferformat: "hex" }, visible: false },
        CollectionType: { group: "MACD Histogram", name: "Collection Type", type: "option", options: ["Histogram", "Histogram Fill"] },
        Shift: { group: "MACD Histogram", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "MACD Histogram", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        VisualType: { group: "MACD Histogram", name: "VisualType", type: "option", options: ["oneLine", "twoLine", "Change", "Multi"], visible: true },
        Width: { group: "MACD Histogram", name: "Width", type: "number", options: { min: 1, max: 20 } },
    };

    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setVisualTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }

    WC.IN.BaseIndicator.call(this);

    self.IndicatorID = IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = false;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, SignalPeriod: self.SettingsValues.SignalPeriod, LongPeriod: self.SettingsValues.LongPeriod, ShortPeriod: self.SettingsValues.ShortPeriod, ContainerID: self.ContainerId, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        MACDLine = self.IndicatorData[0];
        SignalLine = self.IndicatorData[1];
        MACDHist = self.IndicatorData[2];
        ShortEMA = self.tmpIndicatorData.ShortEMA;
        LongEMA = self.tmpIndicatorData.LongEMA;
        isIndicatorSettingsBuffers = false;
        ChartInstance.Resizemethod();
        ChartInstance.ChartData = self.IndicatorData;
        ChartInstance.initYBoundaries(self.IndicatorData);
        self.DrawIndicatorLine();
        DrawLowerIndicatorName(ChartInstance.ctxIndicatorTopCanvas, self.IndicatorInfo.IndicatorName, MainChartInstance.ChartSettings.ForeGround);
    }

    self.DrawIndicatorLine = function (IndicatorContext, MainIndicatorChart) {
        if (self.IndicatorData.length !== 0) {
            var propMACDLine = CreateBasicSettingsPackage(self.SettingsValues.MACDLineCollectionType, self.SettingsValues.MACDLineShift, self.SettingsValues.MACDLineWidth, self.SettingsValues.MACDLineStyle, null);
            var propSignalLine = CreateBasicSettingsPackage(self.SettingsValues.SignalLineCollectionType, self.SettingsValues.SignalLineShift, self.SettingsValues.SignalLineWidth, self.SettingsValues.SignalLineStyle, null);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, MACDHist, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.HistogramColor1, BarData, MainChartInstance);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, propMACDLine, MACDLine, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.MACDLineColor, null, MainChartInstance);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, propSignalLine, SignalLine, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.SignalLineColor, null, MainChartInstance);
        }
    }

    self.Update = function (UpdateType) {
        if (!isIndicatorSettingsBuffers) {
            var prevShortEMA;
            var prevLongEMA;
            var prevSignalEMA;
            if (UpdateType === "FrontDataAdded") {
                prevShortEMA = ShortEMA[0].Value;
                prevLongEMA = LongEMA[0].Value;
                prevSignalEMA = SignalLine[0].Value;

                var rangeShortEMA = self.getDataRange(0, self.SettingsValues.ShortPeriod, self.Bars);
                var rangeShort = self.getValueToCompute(IndicatorValue, rangeShortEMA);
                var ShortEMAValue = self.ComputeEMA(rangeShort, self.SettingsValues.ShortPeriod, false, prevShortEMA);
                var shortEMA = { Value: ShortEMAValue, Stamp: self.Bars[0].Stamp() };
                ShortEMA.unshift(shortEMA);
                var rangeLongEMA = self.getDataRange(0, self.SettingsValues.LongPeriod, self.Bars);
                var rangeLong = self.getValueToCompute(IndicatorValue, rangeLongEMA);
                var LongEMAValue = self.ComputeEMA(rangeLong, self.SettingsValues.LongPeriod, false, prevLongEMA);
                var longEMA = { Value: LongEMAValue, Stamp: self.Bars[0].Stamp() };
                LongEMA.unshift(longEMA);

                var MACDValue = ShortEMA[0].Value - LongEMA[0].Value;
                var ComputedMACD = { Value: MACDValue, Stamp: self.Bars[0].Stamp() };
                MACDLine.unshift(ComputedMACD);

                var EMARange = self.getDataRange(0, self.SettingsValues.SignalPeriod, MACDLine);
                var getRange = getObjectValueToCompute(EMARange);
                var computedSignal = self.ComputeEMA(getRange, self.SettingsValues.SignalPeriod, false, prevSignalEMA);
                var SignalEMAValue = { Value: computedSignal, Stamp: self.Bars[0].Stamp() };
                SignalLine.unshift(SignalEMAValue);

                var MACDHistogram = MACDLine[0].Value - SignalLine[0].Value;
                var MACDHistValue = { Value: MACDHistogram, Stamp: self.Bars[0].Stamp() };
                MACDHist.unshift(MACDHistValue);
                self.IndicatorData = [];
                self.IndicatorData.unshift(MACDHist);
                self.IndicatorData.unshift(SignalLine);
                self.IndicatorData.unshift(MACDLine);
            }
            else if (UpdateType === "BarUpdate") {
                prevShortEMA = ShortEMA[1].Value;
                prevLongEMA = LongEMA[1].Value;
                prevSignalEMA = SignalLine[1].Value;

                var rangeShortEMA = self.getDataRange(0, self.SettingsValues.ShortPeriod, self.Bars);
                var rangeShort = self.getValueToCompute(IndicatorValue, rangeShortEMA);
                var ShortEMAValue = self.ComputeEMA(rangeShort, self.SettingsValues.ShortPeriod, false, prevShortEMA);
                var shortEMA = { Value: ShortEMAValue, Stamp: self.Bars[0].Stamp() };
                ShortEMA[0] = shortEMA;
                var rangeLongEMA = self.getDataRange(0, self.SettingsValues.LongPeriod, self.Bars);
                var rangeLong = self.getValueToCompute(IndicatorValue, rangeLongEMA);
                var LongEMAValue = self.ComputeEMA(rangeLong, self.SettingsValues.LongPeriod, false, prevLongEMA);
                var longEMA = { Value: LongEMAValue, Stamp: self.Bars[0].Stamp() };
                LongEMA[0] = longEMA;

                var MACDValue = ShortEMA[0].Value - LongEMA[0].Value;
                var ComputedMACD = { Value: MACDValue, Stamp: self.Bars[0].Stamp() };
                MACDLine[0] = ComputedMACD;

                var EMARange = self.getDataRange(0, self.SettingsValues.SignalPeriod, MACDLine);
                var getRange = getObjectValueToCompute(EMARange);
                var computedSignal = self.ComputeEMA(getRange, self.SettingsValues.SignalPeriod, false, prevSignalEMA);
                var SignalEMAValue = { Value: computedSignal, Stamp: self.Bars[0].Stamp() };
                SignalLine[0] = SignalEMAValue;

                var MACDHistogram = MACDLine[0].Value - SignalLine[0].Value;
                var MACDHistValue = { Value: MACDHistogram, Stamp: self.Bars[0].Stamp() };
                MACDHist[0] = MACDHistValue;
                self.IndicatorData[0] = MACDLine;
                self.IndicatorData[1] = SignalLine;
                self.IndicatorData[2] = MACDHist;
            }
            // self.DrawIndicatorLine();
            // ChartInstance.IndicatorTopCanvas.width = ChartInstance.IndicatorTopCanvas.width;
        }
    }
};

// Bull Power Oscillator
WC.IN.IndicatorBear = function (ChartInstance, MainChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this;
    var PreviousValue = true;
    var ComputedEMAValues = [];
    var isIndicatorSettingsBuffers = true;
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorInfo = {
        IndicatorName: "Bear",
        IndicatorFullName: "Bear Power",
        IndicatorCodeName: "Bear_Power"
    };

    self.SettingsValues = {
        CollectionType: "Histogram",
        HistogramColor1: '#006400',
        HistogramColor2: '#8B0000',
        HistogramColor3: '#00008B',
        HistogramColor4: '#FFD700',
        Shift: 0,
        LineStyle: "Solid",
        VisualType: "twoLine",
        Width: 1,
        Period: 13,
    };

    self.SettingsObject = {
        CollectionType: { group: "Bear Power", name: "Collection Type", type: "option", options: ["Line", "Dots", "Histogram", "Histogram Fill"] },
        HistogramColor1: { group: "Bear Power", name: "Histogram Color 1", type: "color", options: { preferformat: "hex" }, visible: true },
        HistogramColor2: { group: "Bear Power", name: "Histogram Color 2", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor3: { group: "Bear Power", name: "Histogram Color 3", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor4: { group: "Bear Power", name: "Histogram Color 4", type: "color", options: { preferformat: "hex" }, visible: false },
        Shift: { group: "Bear Power", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "Bear Power", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        VisualType: { group: "Bear Power", name: "VisualType", type: "option", options: ["oneLine", "twoLine", "Change", "Multi"], visible: true },
        Width: { group: "Bear Power", name: "Width", type: "number", options: { min: 1, max: 20 } },
        Period: { group: "Computations", name: "Period", type: "number", options: { min: 2, max: 999 } },
    };

    WC.IN.BaseIndicator.call(this);

    self.IndicatorID = IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = false;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, Period: self.SettingsValues.Period, ContainerID: self.ContainerId, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        ComputedEMAValues = self.tmpIndicatorData.EMAValues;
        isIndicatorSettingsBuffers = false;
        ChartInstance.Resizemethod();
        ChartInstance.ChartData = self.IndicatorData;
        ChartInstance.initYBoundaries(self.IndicatorData);
        self.DrawIndicatorLine();
        DrawLowerIndicatorName(ChartInstance.ctxIndicatorTopCanvas, self.IndicatorInfo.IndicatorName, MainChartInstance.ChartSettings.ForeGround);
    }

    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length !== 0) {
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, self.IndicatorData, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.HistogramColor1, BarData, MainChartInstance);
        }
    }

    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setVisualTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }


    self.Update = function (UpdateType) {
        if (isIndicatorSettingsBuffers === false) {
            if (UpdateType === "FrontDataAdded") {
                var value = Calculate(0, false, ComputedEMAValues[0]);
                var obj = { Value: value, Stamp: self.Bars[0].Stamp() };
                self.IndicatorData.unshift(obj);
            }
            else if (UpdateType === "BarUpdate") {
                var value = Calculate(0, false, ComputedEMAValues[1]);
                var obj = { Value: value, Stamp: self.Bars[0].Stamp() };
                self.IndicatorData[0] = obj;
            }
        }
    }

    function Calculate(index, firstEMA, PreviousValue, UpdateType) {
        var rangeEMA = self.getDataRange(index, self.SettingsValues.Period, self.Bars);
        var range = self.getValueToCompute(IndicatorValue, rangeEMA);
        var ComputedEMA = self.ComputeEMA(range, self.SettingsValues.Period, firstEMA, PreviousValue);
        var ReturnValue = self.Bars[0].Low() - ComputedEMA;
        if (UpdateType === "FrontDataAdded") {
            ComputedEMAValues.unshift(ComputedEMA);
        }
        else if (UpdateType === "BarUpdate") {
            ComputedEMAValues[0] = ComputedEMA;
        }
        return ReturnValue;
    }
};

//Bollinger Bands
WC.IN.IndicatorBB = function (ChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this;
    var PreviousValue = true;
    var isIndicatorSettingsBuffers = true;
    var bbTop = [], bbMid = [], bbBot = [];
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorID = IndicatorID;
    self.IndicatorInfo = {
        IndicatorName: "BB",
        IndicatorFullName: "Bollinger Bands",
        IndicatorCodeName: "Bollinger_Bands",
    };

    self.SettingsValues = {
        Period: 20,
        DeviationPeriod: 2,
        CollectionType: "Line",
        Color: '#008000',
        Shift: 0,
        Style: "Solid",
        Width: 1,
        TCollectionType: "Line",
        TColor: '#DC143C',
        TShift: 0,
        TStyle: "Solid",
        TWidth: 1,
        BCollectionType: "Line",
        BColor: '#DC143C',
        BShift: 0,
        BStyle: "Solid",
        BWidth: 1,
    };

    self.SettingsObject = {
        TCollectionType: { group: "Bollinger Top Line", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        TColor: { group: "Bollinger Top Line", name: "Color", type: "color", options: { preferformat: "hex" }, },
        TShift: { group: "Bollinger Top Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        TStyle: { group: "Bollinger Top Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        TWidth: { group: "Bollinger Top Line", name: "Width", type: "number", options: { min: 1, max: 999 } },

        CollectionType: { group: "Bollinger Mid Line", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        Color: { group: "Bollinger Mid Line", name: "Color", type: "color", options: { preferformat: "hex" }, },
        Shift: { group: "Bollinger Mid Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        Style: { group: "Bollinger Mid Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        Width: { group: "Bollinger Mid Line", name: "Width", type: "number", options: { min: 1, max: 999 } },

        BCollectionType: { group: "Bollinger Bottom Line", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        BColor: { group: "Bollinger Bottom Line", name: "Color", type: "color", options: { preferformat: "hex" }, },
        BShift: { group: "Bollinger Bottom Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        BStyle: { group: "Bollinger Bottom Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        BWidth: { group: "Bollinger Bottom Line", name: "Width", type: "number", options: { min: 1, max: 999 } },

        DeviationPeriod: { group: "Computations", name: "Deviation", type: "number", options: { min: 2, max: 999 } },
        Period: { group: "Computations", name: "Period", type: "number", options: { min: 2, max: 999 } }
    };

    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setVisualTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }

    WC.IN.BaseIndicator.call(this);

    self.IndicatorID = "BB-" + IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = true;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, Period: self.SettingsValues.Period, ContainerID: self.ContainerId, Deviation: self.SettingsValues.DeviationPeriod, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        bbTop = self.IndicatorData[2];
        bbMid = self.IndicatorData[1];
        bbBot = self.IndicatorData[0];
        isIndicatorSettingsBuffers = false;
        self.DrawIndicatorLine();
        self.tmpIndicatorData = [];

    }

    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length !== 0) {
            var propBbTop = CreateBasicSettingsPackage(self.SettingsValues.TCollectionType, self.SettingsValues.TShift, self.SettingsValues.TWidth, self.SettingsValues.TStyle, null);
            var propBbBot = CreateBasicSettingsPackage(self.SettingsValues.BCollectionType, self.SettingsValues.BShift, self.SettingsValues.BWidth, self.SettingsValues.BStyle, null);
            var propBbMid = CreateBasicSettingsPackage(self.SettingsValues.CollectionType, self.SettingsValues.Shift, self.SettingsValues.Width, self.SettingsValues.Style, null);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, propBbMid, bbMid, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.Color, BarData);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, propBbTop, bbTop, null, self.SettingsValues.TColor, null);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, propBbBot, bbBot, null, self.SettingsValues.BColor, null);
        }
    }

    self.Update = function (UpdateType) {
        if (!isIndicatorSettingsBuffers) {
            var bbCurrData = [];
            var bbTopVal = 0, bbMidVal = 0, bbBotVal = 0;
            bbCurrData = SetIndicatorBB(self.SettingsValues.Period, self.SettingsValues.DeviationPeriod);
            bbTopVal = bbCurrData[2];
            bbMidVal = bbCurrData[1];
            bbBotVal = bbCurrData[0];
            if (UpdateType === "FrontDataAdded") {
                bbTop.unshift({ Value: bbTopVal, Stamp: self.Bars[0].Stamp() });
                bbMid.unshift({ Value: bbMidVal, Stamp: self.Bars[0].Stamp() });
                bbBot.unshift({ Value: bbBotVal, Stamp: self.Bars[0].Stamp() });
            }
            else if (UpdateType === "BarUpdate") {
                bbTop[0] = { Value: bbTopVal, Stamp: self.Bars[0].Stamp() };
                bbMid[0] = { Value: bbMidVal, Stamp: self.Bars[0].Stamp() };
                bbBot[0] = { Value: bbBotVal, Stamp: self.Bars[0].Stamp() };
            }
            //  self.DrawIndicatorLine();
        }
    }

    function SetIndicatorBB(period, deviation) {
        var bbCurrData = [];
        var index = 0;
        var bbTopVal = 0, bbMidVal = 0, bbBotVal = 0, stdDev = 0;
        bbMidVal = ComputeIndicatorSMA(index, period);
        stdDev = Calculate(index, period) * deviation;
        bbTopVal = bbMidVal + (stdDev);
        bbBotVal = bbMidVal - (stdDev);
        bbCurrData.unshift(bbTopVal);
        bbCurrData.unshift(bbMidVal);
        bbCurrData.unshift(bbBotVal);
        return bbCurrData;

        function Calculate(index, Period, barData) {
            var GetRange = self.getDataRange(index, Period, self.Bars);
            var Range = self.getValueToCompute(IndicatorValue, GetRange);

            var Sum = 0;

            var SMA = self.ComputeSMA(Range, Period);
            for (var i = 0; i < Period; i++) {
                Sum = (Sum + (Math.pow((SMA - Range[i]), 2)));
            }

            var Variance = (Sum / (Period - 1));
            var StdDev = 0;

            return StdDev = Math.sqrt(Variance);
        }

        function ComputeIndicatorSMA(index, period) {
            var rangeSMA = self.getDataRange(index, period, self.Bars);
            var range = self.getValueToCompute(IndicatorValue, rangeSMA);
            var ReturnValue = self.ComputeSMA(range, self.SettingsValues.Period);

            return ReturnValue;
        }
    }
};

//Weighted Moving Average
WC.IN.IndicatorWMA = function (ChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this;
    var PreviousValue = false;
    var isIndicatorSettingsBuffers = true;
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorInfo = {
        IndicatorName: "WMA",
        IndicatorFullName: "Weighted Moving Average",
        IndicatorCodeName: "Weighted_Moving_Average"
    };

    self.SettingsValues = {
        Period: 9,
        CollectionType: "Line",
        LineColor: '#FF0000',
        Shift: 0,
        LineStyle: "Solid",
        Width: 1
    };

    self.SettingsObject = {
        Period: { group: "Computations", name: "Period", type: "number", options: { min: 2, max: 999 } },
        CollectionType: { group: "WMA Line", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        LineColor: { group: "WMA Line", name: "Color", type: "color", options: { preferformat: "hex" } },
        Shift: { group: "WMA Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "WMA Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        Width: { group: "WMA Line", name: "Width", type: "number", options: { min: 1, max: 20 } }
    };

    WC.IN.BaseIndicator.call(this);

    self.IndicatorID = "WMA-" + IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = true;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, Period: self.SettingsValues.Period, ContainerID: self.ContainerId, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        isIndicatorSettingsBuffers = false;
        self.DrawIndicatorLine();
        self.tmpIndicatorData = [];
    }

    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length) {
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, self.IndicatorData, null, self.SettingsValues.LineColor, null);
        }
    }

    self.Update = function (UpdateType) {
        if (isIndicatorSettingsBuffers === false) {
            var value = CalculateWMA();
            var obj = { Value: value, Stamp: self.Bars[0].Stamp() };
            if (UpdateType === "FrontDataAdded") {
                self.IndicatorData.unshift(obj);
            }
            else if (UpdateType === "BarUpdate") {
                self.IndicatorData[0] = obj;
            }

            //  self.DrawIndicatorLine();
        }
    }

    function CalculateWMA() {
        var getBarRange = self.getDataRange(0, self.SettingsValues.Period, self.Bars)
            , ii = self.SettingsValues.Period
            , d = (ii * (ii + 1)) / 2
            , n = null
            , WMAvalue = null
        ;
        while (ii--) {
            n = ii + 1;
            WMAvalue += (getBarRange[ii].Close() * (n / d));
        }
        getBarRange = null;

        return WMAvalue;
    }
}

//Swing Index Indicator
WC.IN.IndicatorSI = function (ChartInstance, MainChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this
    , PreviousValue = true
    , isIndicatorSettingsBuffers = true;

    self.ChartInstance = ChartInstance;
    self.IndicatorID = IndicatorID;
    self.ContainerId = ContainerID;
    self.IndicatorInfo = {
        IndicatorName: "SI",
        IndicatorFullName: "Swing Index",
        IndicatorCodeName: "Swing_Index"
    };

    self.SettingsValues = {
        LimitMove_Period: 3,
        CollectionType: "Line",
        HistogramColor1: '#FF00FF',
        HistogramColor2: '#8B0000',
        HistogramColor3: '#00008B',
        HistogramColor4: '#FFD700',
        Shift: 0,
        LineStyle: "Solid",
        VisualType: "oneLine",
        Width: 1,
    };

    self.SettingsObject = {
        LimitMove_Period: { group: "Computations", name: "Limit Move", type: "number", options: { min: 2, max: 9999 } },
        CollectionType: { group: "Swing Index Line", name: "Collection Type", type: "option", options: ["Line", "Histogram", "Histogram Fill", "Dots"] },
        HistogramColor1: { group: "Swing Index Line", name: "Color", type: "color", options: { preferformat: "hex" }, visible: true },
        HistogramColor2: { group: "Swing Index Line", name: "Histogram Color 2", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor3: { group: "Swing Index Line", name: "Histogram Color 3", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor4: { group: "Swing Index Line", name: "Histogram Color 4", type: "color", options: { preferformat: "hex" }, visible: false },
        Shift: { group: "Swing Index Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "Swing Index Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        VisualType: { group: "Swing Index Line", name: "VisualType", type: "option", options: ["oneLine", "twoLine", "Change", "Multi"] },
        Width: { group: "Swing Index Line", name: "Width", type: "number", options: { min: 1, max: 20 } },
    };

    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }

    WC.IN.BaseIndicator.call(this);
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = false;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, LimitMovePeriod: self.SettingsValues.LimitMove_Period, ContainerID: self.ContainerId, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;

        Bars = null;
        SetBufferPackage = null;
    }


    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        isIndicatorSettingsBuffers = false;
        ChartInstance.Resizemethod();
        ChartInstance.ChartData = self.IndicatorData;
        ChartInstance.initYBoundaries(self.IndicatorData);
        self.DrawIndicatorLine();
        DrawLowerIndicatorName(ChartInstance.ctxIndicatorTopCanvas, self.IndicatorInfo.IndicatorName, MainChartInstance.ChartSettings.ForeGround);
    }


    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length) {
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, self.IndicatorData, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.HistogramColor1, BarData, MainChartInstance);
        }
    }

    self.Update = function (UpdateType) {
        if (!isIndicatorSettingsBuffers) {

            var value = CalculateSI();
            var obj = { Value: value, Stamp: self.Bars[0].Stamp() };

            if (UpdateType === "FrontDataAdded") {
                self.IndicatorData.unshift(obj);
            }
            else if (UpdateType === "BarUpdate") {
                self.IndicatorData[0] = obj;
            }
            obj = null;
        }

        //  self.DrawIndicatorLine();

    }

    function CalculateSI() {
        var bar = self.Bars[0]
            , priorbar = self.Bars[1]
            , HyC = bar.High() - priorbar.Close()
            , absHyC = Math.abs(HyC)
            , LyC = bar.Low() - priorbar.Close()
            , absLyC = Math.abs(LyC)
            , HL = bar.High() - bar.Low()
            , yCyO = priorbar.Close() - priorbar.Open()
            , CyC = bar.Close() - priorbar.Close()
            , CO = bar.Close() - bar.Open()
            , oT = (.25 * yCyO)
            , absoT = Math.abs(oT)
            , N = null
            , K = null
            , R = null
            , SI = null;

        N = CyC + (.5 * CO) + oT;

        if (absHyC > absLyC) {
            K = absHyC; //determine K
            if (absHyC > HL) { //determine R
                R = absHyC - (.5 * LyC) + absoT;
            }
            else {
                R = HL + absoT;
            }
        }
        else {
            K = absLyC; //determine K
            if (absLyC > HL) { //determine R
                R = absLyC - (.5 * HyC) + absoT;
            }
            else {
                R = HL + absoT;
            }
        }

        SI = R ? 50 * (N / R) * (K / self.SettingsValues.LimitMove_Period) : 0;

        bar = null;
        priorbar = null;

        return SI;

    }

};

//Accumulative Swing Index Indicator
WC.IN.IndicatorASI = function (ChartInstance, MainChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this
    , PreviousValue = true
    , isIndicatorSettingsBuffers = true
    , SwingIndexValues = [];

    self.ChartInstance = ChartInstance;
    self.IndicatorID = IndicatorID;
    self.ContainerId = ContainerID;
    self.IndicatorInfo = {
        IndicatorName: "ASI",
        IndicatorFullName: "Accumulative Swing Index",
        IndicatorCodeName: "Accumulative_Swing_Index"
    };

    self.SettingsValues = {
        LimitMove_Period: 3,
        CollectionType: "Line",
        HistogramColor1: '#00008B',
        HistogramColor2: '#8B0000',
        HistogramColor3: '#00FF00',
        HistogramColor4: '#FFD700',
        Shift: 0,
        LineStyle: "Solid",
        VisualType: "oneLine",
        Width: 1,
    };

    self.SettingsObject = {

        CollectionType: { group: "Accumulative Swing Index Line", name: "Collection Type", type: "option", options: ["Line", "Histogram", "Histogram Fill", "Dots"] },
        HistogramColor1: { group: "Accumulative Swing Index Line", name: "Color", type: "color", options: { preferformat: "hex" }, visible: true },
        HistogramColor2: { group: "Accumulative Swing Index Line", name: "Histogram Color 2", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor3: { group: "Accumulative Swing Index Line", name: "Histogram Color 3", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor4: { group: "Accumulative Swing Index Line", name: "Histogram Color 4", type: "color", options: { preferformat: "hex" }, visible: false },
        Shift: { group: "Accumulative Swing Index Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "Accumulative Swing Index Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        Width: { group: "Accumulative Swing Index Line", name: "Width", type: "number", options: { min: 1, max: 20 } },
        VisualType: { group: "Accumulative Swing Index Line", name: "VisualType", type: "option", options: ["oneLine", "twoLine", "Change", "Multi"] },
        LimitMove_Period: { group: "Computations", name: "Limit Move", type: "number", options: { min: 2, max: 9999 } },
    };

    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }

    WC.IN.BaseIndicator.call(this);
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = false;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, LimitMovePeriod: self.SettingsValues.LimitMove_Period, ContainerID: self.ContainerId, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;

        Bars = null;
        SetBufferPackage = null;
    }


    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        SwingIndexValues = self.tmpIndicatorData.SwingIndexValues
        isIndicatorSettingsBuffers = false;
        ChartInstance.Resizemethod();
        ChartInstance.ChartData = self.IndicatorData;
        ChartInstance.initYBoundaries(self.IndicatorData);
        self.DrawIndicatorLine();
        DrawLowerIndicatorName(ChartInstance.ctxIndicatorTopCanvas, self.IndicatorInfo.IndicatorName, MainChartInstance.ChartSettings.ForeGround);
    }


    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length) {
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, self.IndicatorData, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.HistogramColor1, BarData, MainChartInstance);
        }
    }

    self.Update = function (UpdateType) {
        if (!isIndicatorSettingsBuffers) {

            var value = CalculateASI(UpdateType);
            var obj = { Value: value, Stamp: self.Bars[0].Stamp() };

            if (UpdateType === "FrontDataAdded") {
                self.IndicatorData.unshift(obj);
            }
            else if (UpdateType === "BarUpdate") {
                self.IndicatorData[0] = obj;
            }
            obj = null;
        }

    }

    function CalculateASI(UpdateType) {
        var bar = self.Bars[0]
            , priorbar = self.Bars[1]
            , HyC = bar.High() - priorbar.Close()
            , absHyC = Math.abs(HyC)
            , LyC = bar.Low() - priorbar.Close()
            , absLyC = Math.abs(LyC)
            , HL = bar.High() - bar.Low()
            , yCyO = priorbar.Close() - priorbar.Open()
            , CyC = bar.Close() - priorbar.Close()
            , CO = bar.Close() - bar.Open()
            , oT = (.25 * yCyO)
            , absoT = Math.abs(oT)
            , N = null
            , K = null
            , R = null
            , SI = null
            , ASI = null;

        N = CyC + (.5 * CO) + oT;

        if (absHyC > absLyC) {
            K = absHyC; //determine K
            if (absHyC > HL) { //determine R
                R = absHyC - (.5 * LyC) + absoT;
            }
            else {
                R = HL + absoT;
            }
        }
        else {
            K = absLyC; //determine K
            if (absLyC > HL) { //determine R
                R = absLyC - (.5 * HyC) + absoT;
            }
            else {
                R = HL + absoT;
            }
        }

        SI = R ? 50 * (N / R) * (K / self.SettingsValues.LimitMove_Period) : 0;

        if (UpdateType === "FrontDataAdded") {
            SwingIndexValues.unshift(SI);
            ASI = self.IndicatorData[0].Value + SwingIndexValues[0];
        }
        else {
            SwingIndexValues[0] = SI;
            ASI = self.IndicatorData[1].Value + SwingIndexValues[0];
        }


        bar = null;
        priorbar = null;

        return ASI;

    }

};

// Commodity Channel Index
WC.IN.IndicatorCCI = function (ChartInstance, MainChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this;
    var PreviousValue = true;
    var isIndicatorSettingsBuffers = true;

    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorID = IndicatorID;
    self.IndicatorInfo = {
        IndicatorName: "CCI",
        IndicatorFullName: "Commodity Channel Index",
        IndicatorCodeName: "Commodity_Channel_Index"
    };

    self.SettingsValues = {
        Period: 20,
        CollectionType: "Histogram Fill",
        HistogramColor1: '#006400',
        HistogramColor2: '#8B0000',
        HistogramColor3: '#00008B',
        HistogramColor4: '#FFD700',
        Shift: 0,
        LineStyle: "Solid",
        VisualType: "oneLine",
        Width: 1

    };

    self.SettingsObject = {
        Period: { group: "Computations", name: "Period", type: "number", options: { min: 2, max: 999 } },
        CollectionType: { group: "CCI Line", name: "Collection Type", type: "option", options: ["Line", "Histogram", "Histogram Fill", "Dots"] },
        HistogramColor1: { group: "CCI Line", name: "Histogram Color 1", type: "color", options: { preferformat: "hex" }, visible: true },
        HistogramColor2: { group: "CCI Line", name: "Histogram Color 2", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor3: { group: "CCI Line", name: "Histogram Color 3", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor4: { group: "CCI Line", name: "Histogram Color 4", type: "color", options: { preferformat: "hex" }, visible: false },
        Shift: { group: "CCI Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "CCI Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        VisualType: { group: "CCI Line", name: "VisualType", type: "option", options: ["oneLine", "twoLine", "Change", "Multi"] },
        Width: { group: "CCI Line", name: "Width", type: "number", options: { min: 1, max: 20 } }
    };

    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setVisualTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }

    WC.IN.BaseIndicator.call(this);

    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = false;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, Period: self.SettingsValues.Period, ContainerID: self.ContainerId, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        isIndicatorSettingsBuffers = false;
        ChartInstance.Resizemethod();
        ChartInstance.ChartData = self.IndicatorData;
        ChartInstance.initYBoundaries(self.IndicatorData);
        self.DrawIndicatorLine();
        DrawLowerIndicatorName(ChartInstance.ctxIndicatorTopCanvas, self.IndicatorInfo.IndicatorName, MainChartInstance.ChartSettings.ForeGround);
    }

    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length !== 0) {
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, self.IndicatorData, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.HistogramColor1, BarData, MainChartInstance);
        }
    }


    self.Update = function (UpdateType) {
        if (!isIndicatorSettingsBuffers) {
            var value = ComputeCCI();
            var obj = { Value: value, Stamp: self.Bars[0].Stamp() };


            if (UpdateType === "FrontDataAdded") {
                self.IndicatorData.unshift(obj);
            }
            else if (UpdateType === "BarUpdate") {
                self.IndicatorData[0] = obj;
            }
            obj = null;
            // self.DrawIndicatorLine();
        }
    }

    function ComputeCCI() {
        var barsrange = self.Bars.slice(0, self.SettingsValues.Period)
        , bar = self.Bars[0]
        , TP = (bar.High() + bar.Low() + bar.Close()) / 3
        , i = self.SettingsValues.Period
        , ii = self.SettingsValues.Period
        , TPtotal = null
        , SMAofTP = null
        , MeanAbstotal = null
        , MeanDeviation = null
        , CCI = null;

        // get 20-day SMA of TP
        while (i--) {
            var ibar = barsrange[i]
            , iTP = (ibar.High() + ibar.Low() + ibar.Close()) / 3;
            TPtotal += iTP;
            ibar = null;
        }
        SMAofTP = TPtotal / self.SettingsValues.Period;

        // get 20-day of Mean Deviation
        while (ii--) {
            var iibar = barsrange[ii]
             , iiTP = (iibar.High() + iibar.Low() + iibar.Close()) / 3;
            MeanAbstotal += Math.abs(SMAofTP - iiTP);
            iibar = null;
        }
        MeanDeviation = MeanAbstotal / self.SettingsValues.Period;

        CCI = (TP - SMAofTP) / (0.015 * MeanDeviation);


        barsrange = null;
        return CCI;


    }
};

//Alligator Indicator
WC.IN.IndicatorAI = function (ChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this;
    var PreviousValue = true;
    var isIndicatorSettingsBuffers = true;
    var aJaw = [], aLips = [], aTeeth = [];
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorID = IndicatorID;
    self.IndicatorInfo = {
        IndicatorName: "AI",
        IndicatorFullName: "Alligator",
        IndicatorCodeName: "Alligator"
    };

    self.SettingsValues = {
        CollectionType: "Line",
        Color: '#0000FF',
        Shift: 8,
        LineStyle: "Solid",
        Width: 1,
        LCollectionType: "Line",
        LColor: '#008000',
        LShift: 3,
        LLineStyle: "Solid",
        LWidth: 1,
        TCollectionType: "Line",
        TColor: '#FF0000',
        TShift: 5,
        TLineStyle: "Solid",
        TWidth: 1,
        Period: 13,
        LPeriod: 5,
        TPeriod: 8
    };

    self.SettingsObject = {
        CollectionType: { group: "Alligator's Jaw", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        Color: { group: "Alligator's Jaw", name: "Color", type: "color", options: { preferformat: "hex" } },
        Shift: { group: "Alligator's Jaw", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "Alligator's Jaw", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        Width: { group: "Alligator's Jaw", name: "Width", type: "number", options: { min: 1, max: 999 } },

        LCollectionType: { group: "Alligator's Lips", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        LColor: { group: "Alligator's Lips", name: "Color", type: "color", options: { preferformat: "hex" } },
        LShift: { group: "Alligator's Lips", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LLineStyle: { group: "Alligator's Lips", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        LWidth: { group: "Alligator's Lips", name: "Width", type: "number", options: { min: 1, max: 999 } },

        TCollectionType: { group: "Alligator's Teeth", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        TColor: { group: "Alligator's Teeth", name: "Color", type: "color", options: { preferformat: "hex" } },
        TShift: { group: "Alligator's Teeth", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        TLineStyle: { group: "Alligator's Teeth", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        TWidth: { group: "Alligator's Teeth", name: "Width", type: "number", options: { min: 1, max: 999 } },

        Period: { group: "Computations", name: "Jaw_Period", type: "number", options: { min: 2, max: 999 } },
        LPeriod: { group: "Computations", name: "Lips_Period", type: "number", options: { min: 2, max: 999 } },
        TPeriod: { group: "Computations", name: "Teeth_Period", type: "number", options: { min: 2, max: 999 } }
    };

    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setVisualTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }

    WC.IN.BaseIndicator.call(this);

    self.IndicatorID = "AI-" + IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = true;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, Period: self.SettingsValues.Period, Lips_Period: self.SettingsValues.LPeriod, Teeth_Period: self.SettingsValues.TPeriod, ContainerID: self.ContainerId, Deviation: self.SettingsValues.Deviation, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        aJaw = self.IndicatorData[2];
        aLips = self.IndicatorData[1];
        aTeeth = self.IndicatorData[0];
        isIndicatorSettingsBuffers = false;
        self.DrawIndicatorLine();
        self.tmpIndicatorData = [];

    }

    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length !== 0) {
            var propALips = CreateBasicSettingsPackage(self.SettingsValues.LCollectionType, self.SettingsValues.LShift, self.SettingsValues.LWidth, self.SettingsValues.LLineStyle, null);
            var propATeeth = CreateBasicSettingsPackage(self.SettingsValues.TCollectionType, self.SettingsValues.TShift, self.SettingsValues.TWidth, self.SettingsValues.TLineStyle, null);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, aJaw, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.Color, BarData);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, propALips, aLips, null, self.SettingsValues.LColor, null);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, propATeeth, aTeeth, null, self.SettingsValues.TColor, null);
        }
    }

    self.Update = function (UpdateType) {
        if (!isIndicatorSettingsBuffers) {
            if (UpdateType === "FrontDataAdded") {
                aJaw.unshift(self.objValue(self.ComputeSMMA(self.Bars, IndicatorValue, 0, self.SettingsValues.Period, false, aJaw[0].Value), self.Bars[0].Stamp()));
                aLips.unshift(self.objValue(self.ComputeSMMA(self.Bars, IndicatorValue, 0, self.SettingsValues.LPeriod, false, aLips[0].Value), self.Bars[0].Stamp()));
                aTeeth.unshift(self.objValue(self.ComputeSMMA(self.Bars, IndicatorValue, 0, self.SettingsValues.TPeriod, false, aTeeth[0].Value), self.Bars[0].Stamp()));
            }
            else if (UpdateType === "BarUpdate") {
                aJaw[0] = self.objValue(self.ComputeSMMA(self.Bars, IndicatorValue, 0, self.SettingsValues.Period, false, aJaw[1].Value), self.Bars[0].Stamp());
                aLips[0] = self.objValue(self.ComputeSMMA(self.Bars, IndicatorValue, 0, self.SettingsValues.LPeriod, false, aLips[1].Value), self.Bars[0].Stamp());
                aTeeth[0] = self.objValue(self.ComputeSMMA(self.Bars, IndicatorValue, 0, self.SettingsValues.TPeriod, false, aTeeth[1].Value), self.Bars[0].Stamp());
            }
            //   self.DrawIndicatorLine();
        }
    }
};

//Stochastic Oscillator(SO)
WC.IN.IndicatorSO = function (ChartInstance, MainChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this;
    var PreviousValue = true;
    var isIndicatorSettingsBuffers = true;
    var percK = [];
    var percD = [];
    var pKVals = [];
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorID = IndicatorID;
    self.IndicatorInfo = {
        IndicatorName: "SO",
        IndicatorFullName: "Stochastic Oscillator",
        IndicatorCodeName: "Stochastic_Oscillator"
    };

    self.SettingsValues = {
        CollectionType: "Line",
        HistogramColor1: '#B03060',
        HistogramColor2: '#8B0000',
        HistogramColor3: '#00008B',
        HistogramColor4: '#FFD700',
        Shift: 0,
        LineStyle: "Solid",
        VisualType: "twoLine",
        Width: 1,
        KCollectionType: "Line",
        KHistogramColor1: '#00ff00',
        KHistogramColor2: '#00008B',
        KHistogramColor3: '#8B0000',
        KHistogramColor4: '#FFD700',
        KShift: 0,
        KLineStyle: "Solid",
        KVisualType: "twoLine",
        KWidth: 1,
        DPeriod: 3,
        Period: 14
    };

    self.SettingsObject = {
        CollectionType: { group: "Percent D Line", name: "Collection Type", type: "option", options: ["Line", "Histogram", "Histogram Fill", "Dots", "Polygon1", "Polygon2"] },
        HistogramColor1: { group: "Percent D Line", name: "Histogram Color 1", type: "color", options: { preferformat: "hex" }, visible: true },
        HistogramColor2: { group: "Percent D Line", name: "Histogram Color 2", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor3: { group: "Percent D Line", name: "Histogram Color 3", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor4: { group: "Percent D Line", name: "Histogram Color 4", type: "color", options: { preferformat: "hex" }, visible: false },
        Shift: { group: "Percent D Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "Percent D Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        VisualType: { group: "Percent D Line", name: "VisualType", type: "option", options: ["oneLine", "twoLine", "Change", "Multi"], visible: false },
        Width: { group: "Percent D Line", name: "Width", type: "number", options: { min: 1, max: 999 } },
        KCollectionType: { group: "Percent K Line", name: "Collection Type", type: "option", options: ["Line", "Histogram", "Histogram Fill", "Dots", "Polygon1", "Polygon2"] },
        KHistogramColor1: { group: "Percent K Line", name: "Histogram Color 1", type: "color", options: { preferformat: "hex" }, visible: true },
        KHistogramColor2: { group: "Percent K Line", name: "Histogram Color 2", type: "color", options: { preferformat: "hex" }, visible: false },
        KHistogramColor3: { group: "Percent K Line", name: "Histogram Color 3", type: "color", options: { preferformat: "hex" }, visible: false },
        KHistogramColor4: { group: "Percent K Line", name: "Histogram Color 4", type: "color", options: { preferformat: "hex" }, visible: false },
        KShift: { group: "Percent K Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        KLineStyle: { group: "Percent K Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        KVisualType: { group: "Percent K Line", name: "VisualType", type: "option", options: ["oneLine", "twoLine", "Change", "Multi"], visible: false },
        KWidth: { group: "Percent K Line", name: "Width", type: "number", options: { min: 1, max: 999 } },
        DPeriod: { group: "Computations", name: "Percent D Period", type: "number", options: { min: 2, max: 999 } },
        Period: { group: "Computations", name: "Percent K Period", type: "number", options: { min: 2, max: 999 } }
    };

    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setVisualTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }

    WC.IN.BaseIndicator.call(this);

    self.IndicatorID = IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = false;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = { IndicatorID: self.IndicatorID, Indicator: self.IndicatorInfo.IndicatorName, BarsData: Bars, IndicatorValue: IndicatorValue, Period: self.SettingsValues.Period, ContainerID: self.ContainerId, dPeriod: self.SettingsValues.DPeriod, GraphType: ChartInstance.ChartSettings.GraphType };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        isIndicatorSettingsBuffers = false;
        pKVals = self.IndicatorData[2];
        percD = self.IndicatorData[1];
        percK = self.IndicatorData[0];
        ChartInstance.Resizemethod();
        ChartInstance.ChartData = self.IndicatorData;
        ChartInstance.initYBoundaries(self.IndicatorData);
        self.DrawIndicatorLine();
        DrawLowerIndicatorName(ChartInstance.ctxIndicatorTopCanvas, self.IndicatorInfo.IndicatorName, MainChartInstance.ChartSettings.ForeGround);
    }

    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length !== 0) {
            if (IsDrawPolygon(self.SettingsValues.CollectionType, self.SettingsValues.KCollectionType)) {
                var PSettings = CreatePolygonSettingsPackage(percD, self.SettingsValues.HistogramColor1, self.SettingsValues.Shift, self.SettingsValues.Width, percK, self.SettingsValues.KHistogramColor1, self.SettingsValues.KShift, self.SettingsValues.KWidth);

                self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, null, null, ChartInstance.ComputationProperties.BarSpace, null, BarData, MainChartInstance, PSettings);
            }
            else {
                var propKLine = CreateBasicSettingsPackage(self.SettingsValues.KCollectionType, self.SettingsValues.KShift, self.SettingsValues.KWidth, self.SettingsValues.KLineStyle, self.SettingsValues.KVisualType);
                self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, percD, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.HistogramColor1, BarData, MainChartInstance);
                self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, propKLine, percK, null, self.SettingsValues.KHistogramColor1, null, MainChartInstance);
            }
        }
    }

    self.Update = function (UpdateType) {
        if (!isIndicatorSettingsBuffers) {
            var cl = 0, hl = 0, pKVal = 0;
            cl = self.Bars[0].Close() - Math.min.apply(Math, self.getValueToCompute("Low", self.getDataRange(0, self.SettingsValues.Period, self.Bars)));
            hl = Math.max.apply(Math, self.getValueToCompute("High", self.getDataRange(0, self.SettingsValues.Period, self.Bars))) - Math.min.apply(Math, self.getValueToCompute("Low", self.getDataRange(0, self.SettingsValues.Period, self.Bars)));
            pKVal = (cl / hl) * 100;
            if (UpdateType === "FrontDataAdded") {
                pKVals.unshift(pKVal);
                percK.unshift({ Value: pKVal, Stamp: self.Bars[0].Stamp() });
                percD.unshift({ Value: self.ComputeEMA(self.getDataRange(0, self.SettingsValues.DPeriod, pKVals), self.SettingsValues.DPeriod, false, percD[0].Value), Stamp: self.Bars[0].Stamp() });
            }
            else if (UpdateType === "BarUpdate") {
                pKVals[0] = pKVal;
                percK[0] = { Value: pKVal, Stamp: self.Bars[0].Stamp() };
                percD[0] = { Value: self.ComputeEMA(self.getDataRange(0, self.SettingsValues.DPeriod, pKVals), self.SettingsValues.DPeriod, false, percD[1].Value), Stamp: self.Bars[0].Stamp() };
            }
            //self.DrawIndicatorLine();
        }
    }
};

//Envelope Moving Average
WC.IN.IndicatorEnMA = function (ChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this
        , isIndicatorSettingsBuffers = true
        , UpperBandLine = []
        , LowerBandLine = [];

    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorInfo = {
        IndicatorName: "EnMA",
        IndicatorFullName: "Envelope Moving Average",
        IndicatorCodeName: "Envelope_Moving_Average"
    }

    self.SettingsValues = {
        Period: 9
       , PercentagePeriod: 5
       , NotationPeriod: 3

       , lowerCollectionType: "Line"
       , lowerLineColor: '#FF00FF'
       , lowerShift: 0
       , lowerLineStyle: "Solid"
       , lowerWidth: 1

       , upperCollectionType: "Line"
       , upperLineColor: '#FF00FF'
       , upperShift: 0
       , upperLineStyle: "Solid"
       , upperWidth: 1

    }

    self.SettingsObject = {
        Period: { group: "Computations", name: "Period", type: "number", options: { min: 2, max: 999 } },
        PercentagePeriod: { group: "Computations", name: "Percentage", type: "number", options: { min: 2, max: 999 } },
        NotationPeriod: { group: "Computations", name: "Notation", type: "number", options: { min: 2, max: 999 } },

        lowerCollectionType: { group: "Lower Band Line", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        lowerLineColor: { group: "Lower Band Line", name: "Color", type: "color", options: { preferformat: "hex" } },
        lowerShift: { group: "Lower Band Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        lowerLineStyle: { group: "Lower Band Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        lowerWidth: { group: "Lower Band Line", name: "Width", type: "number", options: { min: 1, max: 20 } },

        upperCollectionType: { group: "Upper Band Line", name: "Collection Type", type: "option", options: ["Line", "Dots"] },
        upperLineColor: { group: "Upper Band Line", name: "Color", type: "color", options: { preferformat: "hex" } },
        upperShift: { group: "Upper Band Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        upperLineStyle: { group: "Upper Band Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        upperWidth: { group: "Upper Band Line", name: "Width", type: "number", options: { min: 1, max: 20 } }
    }

    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setVisualTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }

    WC.IN.BaseIndicator.call(this);
    self.IndicatorID = "EnMA-" + IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = true;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var bars = ko.toJS(self.Bars)
          , SetBufferPackage = {
              IndicatorID: self.IndicatorID
            , Indicator: self.IndicatorInfo.IndicatorName
            , ContainerID: self.ContainerId
            , BarsData: bars
            , Period: self.SettingsValues.Period
            , Percentage: self.SettingsValues.PercentagePeriod
            , Notation: self.SettingsValues.NotationPeriod
              , GraphType: ChartInstance.ChartSettings.GraphType
          };

        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;

        bars = null;
        SetBufferPackage = null;
    };

    self.SetWorkerData = function () {
        if (self.tmpIndicatorData.Values) {
            self.IndicatorData = self.tmpIndicatorData.Values
            LowerBandLine = self.IndicatorData[0];
            UpperBandLine = self.IndicatorData[1];
            isIndicatorSettingsBuffers = false;
            self.DrawIndicatorLine();
            self.tmpIndicatorData = [];
        }
    }

    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length) {
            var upperprop = CreateBasicSettingsPackage(self.SettingsValues.upperCollectionType, self.SettingsValues.upperShift, self.SettingsValues.upperWidth, self.SettingsValues.upperLineStyle, null)
            , lowerprop = CreateBasicSettingsPackage(self.SettingsValues.lowerCollectionType, self.SettingsValues.lowerShift, self.SettingsValues.lowerWidth, self.SettingsValues.lowerLineStyle, null);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, upperprop, UpperBandLine, null, self.SettingsValues.upperLineColor, null);
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, lowerprop, LowerBandLine, null, self.SettingsValues.lowerLineColor, null);
        }
    }

    self.Update = function (UpdateType) {
        if (!isIndicatorSettingsBuffers) {
            var bar = self.Bars[0]
            , UpLowvalue = CalculateEnMA();

            if (UpdateType === "FrontDataAdded") {
                UpperBandLine.unshift({ Value: UpLowvalue.Up, Stamp: bar.Stamp() });
                LowerBandLine.unshift({ Value: UpLowvalue.Low, Stamp: bar.Stamp() });
            }
            else if (UpdateType === "BarUpdate") {
                UpperBandLine[0] = { Value: UpLowvalue.Up, Stamp: bar.Stamp() };
                LowerBandLine[0] = { Value: UpLowvalue.Low, Stamp: bar.Stamp() };
            }
            bar = null;
            UpLowvalue = null;
            //self.DrawIndicatorLine();
        }
    }

    function CalculateEnMA() {
        var barsrange = self.Bars.slice(0, self.SettingsValues.Period)
            , K = (self.SettingsValues.PercentagePeriod / 100) / Math.pow(10, self.SettingsValues.NotationPeriod)
            , i = self.SettingsValues.Period
            , SMA = null
            , shifted = null
            , uppervalue = null
            , lowervalue = null;

        while (i--) {
            SMA += (barsrange[i].Close() / self.SettingsValues.Period);
        }

        shifted = SMA * K;
        uppervalue = SMA + shifted;
        lowervalue = SMA - shifted;

        barsrange = null;

        return { Up: uppervalue, Low: lowervalue };
    }

}

//Ulcer Indicator
WC.IN.IndicatorUI = function (ChartInstance, MainChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this
    , isIndicatorSettingsBuffers = true
    , CloseValues = null
    , PercentDrawDownSquared = null;
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorID = IndicatorID;
    self.IndicatorInfo = {
        IndicatorName: "Ulcer",
        IndicatorFullName: "Ulcer Index",
        IndicatorCodeName: "Ulcer_Index"
    };

    self.SettingsValues = {
        Period: 14,
        PeriodCloseMax: 14,
        CollectionType: "Histogram Fill",
        HistogramColor1: '#006400',
        HistogramColor2: '#8B0000',
        HistogramColor3: '#00008B',
        HistogramColor4: '#FFD700',
        Shift: 0,
        LineStyle: "Solid",
        VisualType: "oneLine",
        Width: 1,
    };

    self.SettingsObject = {
        Period: { group: "Computations", name: "Period", type: "number", options: { min: 2, max: 999 } },
        PeriodCloseMax: { group: "Computations", name: "Period_Close_Max", type: "number", options: { min: 2, max: 999 } },
        CollectionType: { group: "Ulcer Line", name: "Collection Type", type: "option", options: ["Line", "Histogram", "Histogram Fill", "Dots"] },
        HistogramColor1: { group: "Ulcer Line", name: "Histogram Color 1", type: "color", options: { preferformat: "hex" }, visible: true },
        HistogramColor2: { group: "Ulcer Line", name: "Histogram Color 2", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor3: { group: "Ulcer Line", name: "Histogram Color 3", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor4: { group: "Ulcer Line", name: "Histogram Color 4", type: "color", options: { preferformat: "hex" }, visible: false },
        Shift: { group: "Ulcer Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "Ulcer Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        VisualType: { group: "Ulcer Line", name: "VisualType", type: "option", options: ["oneLine", "twoLine", "Change", "Multi"] },
        Width: { group: "Ulcer Line", name: "Width", type: "number", options: { min: 1, max: 20 } },
    };

    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setVisualTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }

    WC.IN.BaseIndicator.call(this);

    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = false;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = {
            IndicatorID: self.IndicatorID
          , Indicator: self.IndicatorInfo.IndicatorName
          , BarsData: Bars
          , Period: self.SettingsValues.Period
          , PeriodCloseMax: self.SettingsValues.PeriodCloseMax
          , ContainerID: self.ContainerId
        , GraphType: ChartInstance.ChartSettings.GraphType
        };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values[0];
        PercentDrawDownSquared = self.tmpIndicatorData.Values[1];
        CloseValues = self.tmpIndicatorData.Values[2];
        isIndicatorSettingsBuffers = false;
        ChartInstance.Resizemethod();
        ChartInstance.ChartData = self.IndicatorData;
        ChartInstance.initYBoundaries(self.IndicatorData);
        self.DrawIndicatorLine();
        DrawLowerIndicatorName(ChartInstance.ctxIndicatorTopCanvas, self.IndicatorInfo.IndicatorName, MainChartInstance.ChartSettings.ForeGround);
    }


    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length !== 0) {
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, self.IndicatorData, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.HistogramColor1, BarData, MainChartInstance);
        }
    }


    self.Update = function (UpdateType) {
        if (!isIndicatorSettingsBuffers) {
            var bar = self.Bars[0]
              , Ulcer = Calculate(UpdateType, bar)
              , indicatorinfo = { Value: Ulcer, Stamp: bar.Stamp() };

            if (UpdateType === "FrontDataAdded") {
                self.IndicatorData.unshift(indicatorinfo);
            }
            else if (UpdateType === "BarUpdate") {
                self.IndicatorData[0] = indicatorinfo;
            }

            //  self.DrawIndicatorLine();
            bar = null;
            indicatorinfo = null;
        }
    }

    function Calculate(UpdateType, bar) {

        if (UpdateType === "FrontDataAdded") {
            CloseValues.unshift(bar.Close())
        }
        else {
            CloseValues[0] = bar.Close();
        }

        var closerange = CloseValues.slice(0, self.SettingsValues.PeriodCloseMax)
        , maxclose = Math.max.apply(null, closerange)
        , percentDD = ((bar.Close() - maxclose) / maxclose) * 100
        , percentDDS = percentDD * percentDD;

        if (UpdateType === "FrontDataAdded") {
            PercentDrawDownSquared.unshift(percentDDS)
        }
        else {
            PercentDrawDownSquared[0] = percentDDS;
        }

        var pddsrange = PercentDrawDownSquared.slice(0, self.SettingsValues.Period)
          , averagesquare = self.ComputeSMA(pddsrange, self.SettingsValues.Period)
          , ulcerindex = Math.sqrt(averagesquare);

        bar = null;
        closerange = null;
        pddsrange = null;

        return ulcerindex;
    }
};

//Williams %R
WC.IN.IndicatorWilliamsPercentR = function (ChartInstance, MainChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this
    , isIndicatorSettingsBuffers = true
    , HighValues = null
    , LowValues = null;
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorID = IndicatorID;
    self.IndicatorInfo = {
        IndicatorName: "WilliamsPercentR",
        IndicatorFullName: "Williams Percent R",
        IndicatorCodeName: "Williams_Percent_R",
    };

    self.SettingsValues = {
        Period: 14,
        CollectionType: "Histogram Fill",
        HistogramColor1: '#870f0f',
        HistogramColor2: '#006400',
        HistogramColor3: '#00008B',
        HistogramColor4: '#FFD700',
        Shift: 0,
        LineStyle: "Solid",
        VisualType: "oneLine",
        Width: 1,
    };

    self.SettingsObject = {
        Period: { group: "Computations", name: "Period", type: "number", options: { min: 2, max: 999 } },
        CollectionType: { group: "Percent R Line", name: "Collection Type", type: "option", options: ["Line", "Histogram", "Histogram Fill", "Dots"] },
        HistogramColor1: { group: "Percent R Line", name: "Histogram Color 1", type: "color", options: { preferformat: "hex" }, visible: true },
        HistogramColor2: { group: "Percent R Line", name: "Histogram Color 2", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor3: { group: "Percent R Line", name: "Histogram Color 3", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor4: { group: "Percent R Line", name: "Histogram Color 4", type: "color", options: { preferformat: "hex" }, visible: false },
        Shift: { group: "Percent R Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "Percent R Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        VisualType: { group: "Percent R Line", name: "VisualType", type: "option", options: ["oneLine", "twoLine", "Change", "Multi"] },
        Width: { group: "Percent R Line", name: "Width", type: "number", options: { min: 1, max: 20 } },
    };

    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setVisualTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }

    WC.IN.BaseIndicator.call(this);

    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = false;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = {
            IndicatorID: self.IndicatorID
          , Indicator: self.IndicatorInfo.IndicatorName
          , BarsData: Bars
          , Period: self.SettingsValues.Period
          , ContainerID: self.ContainerId
            , GraphType: ChartInstance.ChartSettings.GraphType
        };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values[0];
        LowValues = self.tmpIndicatorData.Values[1];
        HighValues = self.tmpIndicatorData.Values[2];
        isIndicatorSettingsBuffers = false;
        ChartInstance.Resizemethod();
        ChartInstance.ChartData = self.IndicatorData;
        ChartInstance.initYBoundaries(self.IndicatorData);
        self.DrawIndicatorLine();
        DrawLowerIndicatorName(ChartInstance.ctxIndicatorTopCanvas, self.IndicatorInfo.IndicatorName, MainChartInstance.ChartSettings.ForeGround);
    }


    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length) {
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, self.IndicatorData, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.HistogramColor1, BarData, MainChartInstance);
        }
    }


    self.Update = function (UpdateType) {
        if (!isIndicatorSettingsBuffers) {
            var bar = self.Bars[0]
              , PercentR = Calculate(UpdateType, bar)
              , indicatorinfo = { Value: PercentR, Stamp: bar.Stamp() };

            if (UpdateType === "FrontDataAdded") {
                self.IndicatorData.unshift(indicatorinfo);
            }
            else if (UpdateType === "BarUpdate") {
                self.IndicatorData[0] = indicatorinfo;
            }

            //  self.DrawIndicatorLine();
            bar = null;
            indicatorinfo = null;
        }
    }

    function Calculate(UpdateType, bar) {

        if (UpdateType === "FrontDataAdded") {
            HighValues.unshift(bar.High());
            LowValues.unshift(bar.Low());
        }
        else {
            HighValues[0] = bar.High();
            LowValues[0] = bar.Low();
        }

        var highrange = HighValues.slice(0, self.SettingsValues.Period)
          , highesthigh = Math.max.apply(null, highrange)
          , lowrange = LowValues.slice(0, self.SettingsValues.Period)
          , lowestlow = Math.min.apply(null, lowrange)
          , percentR = (highesthigh - bar.Close()) / (highesthigh - lowestlow) * -100
        ;
        highrange = null;
        lowrange = null;
        bar = null;

        return percentR;

    }
};

// Chaikin Volatility Indicator
WC.IN.IndicatorCHV = function (ChartInstance, MainChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this;
    var PreviousValue = true;
    var HL_Diff = [];
    var HL_EMA = [];

    self.isIndicatorSettingsBuffers = true;
    self.ChartInstance = ChartInstance;
    self.ContainerId = ContainerID;
    self.IndicatorID = IndicatorID;
    self.IndicatorInfo = {
        IndicatorName: "CHV",
        IndicatorFullName: "Chaikin Volatility",
        IndicatorCodeName: "Chaikin_Volatility"
    };

    self.SettingsValues = {
        CollectionType: "Line",
        Color: "#FF0000",
        Shift: 0,
        Style: "Solid",
        Width: 1,
        Period: 10,
        Range: 10
    };
    self.SettingsObject = {
        CollectionType: { group: "Chaikin Volatility Line", name: "Collection Type", type: "option", options: ["Line", "Histogram", "Histogram Fill", "Dots"] },
        Color: { group: "Chaikin Volatility Line", name: "Color", type: "color", options: { preferformat: "hex" }, visible: true },
        Shift: { group: "Chaikin Volatility Line", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        Style: { group: "Chaikin Volatility Line", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        Width: { group: "Chaikin Volatility Line", name: "Width", type: "number", options: { min: 1, max: 20 } },
        Period: { group: "Computations", name: "Period", type: "number", options: { min: 1, max: 9999 } },
        Range: { group: "Computations", name: "Range", type: "number", options: { min: 1, max: 9999 } }
    };

    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setVisualTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;

            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }

    WC.IN.BaseIndicator.call(this);

    self.IndicatorID = IndicatorID;
    self.Bars = BarData;
    self.tmpIndicatorData = [];
    self.IndicatorData = [];
    self.OnBars = false;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = {
            IndicatorID: self.IndicatorID,
            Indicator: self.IndicatorInfo.IndicatorName,
            BarsData: Bars,
            IndicatorValue: IndicatorValue,
            Period: self.SettingsValues.Period,
            Range: self.SettingsValues.Range,
            ContainerID: self.ContainerId, GraphType: ChartInstance.ChartSettings.GraphType
        };

        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        self.isIndicatorSettingsBuffers = true;
    }
    self.SetWorkerData = function () {
        self.IndicatorData = self.tmpIndicatorData.Values;
        HL_Diff = self.tmpIndicatorData.HL_Diff_List;
        HL_EMA = self.tmpIndicatorData.ComputedEMA;
        self.isIndicatorSettingsBuffers = false;

        ChartInstance.Resizemethod();
        ChartInstance.ChartData = self.IndicatorData;

        ChartInstance.initYBoundaries(self.IndicatorData);
        self.DrawIndicatorLine();
        DrawLowerIndicatorName(ChartInstance.ctxIndicatorTopCanvas, self.IndicatorInfo.IndicatorName, MainChartInstance.ChartSettings.ForeGround);
    }

    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length !== 0) {
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, self.IndicatorData, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.Color, BarData, MainChartInstance);
        }
    }

    self.Update = function (UpdateType) {
        if (!self.isIndicatorSettingsBuffers) {
            if (UpdateType === "FrontDataAdded") {
                HL_Diff.unshift(self.Bars[0].High() - self.Bars[0].Low());
                var chv_val = null;
                var values = self.getDataRange(0, self.SettingsValues.Period, HL_Diff);
                var isFirstEMA = HL_EMA.length == 0;
                var previousValue = HL_EMA[0] == undefined ? null : HL_EMA[0];

                var hl_ema = self.ComputeEMA(values, self.SettingsValues.Period, isFirstEMA, previousValue);

                HL_EMA.unshift(hl_ema);

                if (HL_EMA.length > self.SettingsValues.Range) {
                    var hl_current = HL_EMA[0];
                    var hl_range = HL_EMA[self.SettingsValues.Range];
                    var value = hl_range == 0 ? 0 : ((hl_current - hl_range) / hl_range) * 100;

                    chv_val = self.objValue(value, self.Bars[0].Stamp());

                    self.IndicatorData.unshift(chv_val);
                }
            }
            else if (UpdateType === "BarUpdate") {
                HL_Diff[0] = self.Bars[0].High() - self.Bars[0].Low();
                var chv_val = null;
                var values = self.getDataRange(0, self.SettingsValues.Period, HL_Diff);
                var isFirstEMA = HL_EMA.length == 0;
                var previousValue = HL_EMA[0] == undefined ? null : HL_EMA[0];

                var hl_ema = self.ComputeEMA(values, self.SettingsValues.Period, isFirstEMA, previousValue);

                HL_EMA[0] = hl_ema;

                if (HL_EMA.length > self.SettingsValues.Range) {
                    var hl_current = HL_EMA[0];
                    var hl_range = HL_EMA[self.SettingsValues.Range];
                    var value = hl_range == 0 ? 0 : ((hl_current - hl_range) / hl_range) * 100;

                    chv_val = self.objValue(value, self.Bars[0].Stamp());

                    self.IndicatorData[0] = chv_val;
                }
            }
        }
    }
}

//Mass Index
WC.IN.IndicatorMI = function (ChartInstance, MainChartInstance, BarData, IndicatorValue, IndicatorID, ContainerID) {
    var self = this
    , isIndicatorSettingsBuffers = true
    , HL = null
    , SingleEMA = null
    , DoubleEMA = null
    , EMARatio = null
    ;

    self.ChartInstance = ChartInstance;
    self.IndicatorID = IndicatorID;
    self.ContainerId = ContainerID;
    self.IndicatorInfo = {
        IndicatorName: "MI"
      , IndicatorFullName: "Mass Index",
        IndicatorCodeName: "Mass_Index"
    };

    self.SettingsValues = {
        Period: 25,
        EMAPeriod: 9,
        CollectionType: "Line",
        HistogramColor1: '#FFFFFF',
        HistogramColor2: '#8B0000',
        HistogramColor3: '#006400',
        HistogramColor4: '#FFD700',
        Shift: 0,
        LineStyle: "Solid",
        VisualType: "oneLine",
        Width: 1,
    };

    self.SettingsObject = {
        EMAPeriod: { group: "Computations", name: "EMAPeriod", type: "number", options: { min: 2, max: 999 } },
        Period: { group: "Computations", name: "Period", type: "number", options: { min: 2, max: 999 } },
        CollectionType: { group: "Mass Index", name: "Collection Type", type: "option", options: ["Line", "Histogram", "Histogram Fill", "Dots"] },
        HistogramColor1: { group: "Mass Index", name: "Histogram Color 1", type: "color", options: { preferformat: "hex" }, visible: true },
        HistogramColor2: { group: "Mass Index", name: "Histogram Color 2", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor3: { group: "Mass Index", name: "Histogram Color 3", type: "color", options: { preferformat: "hex" }, visible: false },
        HistogramColor4: { group: "Mass Index", name: "Histogram Color 4", type: "color", options: { preferformat: "hex" }, visible: false },
        Shift: { group: "Mass Index", name: "Shift", type: "number", options: { min: -999, max: 999 } },
        LineStyle: { group: "Mass Index", name: "Style", type: "option", options: ["Solid", "Dash", "Dot", "DashDot", "DashDotDot"] },
        VisualType: { group: "Mass Index", name: "VisualType", type: "option", options: ["oneLine", "twoLine", "Change", "Multi"], visible: false },
        Width: { group: "Mass Index", name: "Width", type: "number", options: { min: 1, max: 20 } },
    };


    function SetPropertyGridItemVisibility(Container, Key, PropertyChanged) {
        switch (PropertyChanged) {
            case "VisualType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
            case "CollectionType":
                setCollectionTypeChangedVisibility(Container, Key, self.SettingsValues);
                break;
        }
    }

    self.SetPropertyVisibility = function (pgDiv, KeyObject, Property) {
        SetPropertyGridItemVisibility(pgDiv, KeyObject, Property);
    }

    WC.IN.BaseIndicator.call(this);

    self.Bars = BarData;

    self.IndicatorData = [];
    self.tmpIndicatorData = [];
    self.OnBars = false;
    self.IndicatorSettingsHeader = $('<div style="width:100%"><div id="SettingsHeader-' + ContainerID + '" class="wc-SettingsTitle"><span class="textTrimmable" style="width:88%;">' + self.IndicatorInfo.IndicatorFullName + '</span><button type="button" id="SettingsCloseButton' + ContainerID + '" class="Settings-Close-button">x</button></div></div>');

    self.initIndicatorComputations = function (ComputationType) {
        var Bars = ko.toJS(self.Bars);
        var SetBufferPackage = {
            IndicatorID: self.IndicatorID
            , Indicator: self.IndicatorInfo.IndicatorName
            , BarsData: Bars
            , ContainerID: self.ContainerId
            , Period: self.SettingsValues.Period
            , EMAPeriod: self.SettingsValues.EMAPeriod
            , GraphType: ChartInstance.ChartSettings.GraphType
        };
        WC.IN.IndicatorWorker.postMessage(SetBufferPackage);
        isIndicatorSettingsBuffers = true;
    }

    self.SetWorkerData = function () {
        if (self.tmpIndicatorData.Values) {
            HL = self.tmpIndicatorData.Values[4];
            SingleEMA = self.tmpIndicatorData.Values[3];
            DoubleEMA = self.tmpIndicatorData.Values[2];
            EMARatio = self.tmpIndicatorData.Values[1];
            self.IndicatorData = self.tmpIndicatorData.Values[0];
        }
        isIndicatorSettingsBuffers = false;
        ChartInstance.Resizemethod();
        ChartInstance.ChartData = self.IndicatorData;
        ChartInstance.initYBoundaries(self.IndicatorData);
        self.DrawIndicatorLine();
        DrawLowerIndicatorName(ChartInstance.ctxIndicatorTopCanvas, self.IndicatorInfo.IndicatorName, MainChartInstance.ChartSettings.ForeGround);
    }

    self.DrawIndicatorLine = function () {
        if (self.IndicatorData.length) {
            self.DrawIndicator(ChartInstance.ctxIndicatorTopCanvas, ChartInstance, self.SettingsValues, self.IndicatorData, ChartInstance.ComputationProperties.BarSpace, self.SettingsValues.HistogramColor1, BarData, MainChartInstance);
        }
    }

    self.Update = function (UpdateType) {
        if (!isIndicatorSettingsBuffers) {
            if (!self.IndicatorData.length) return;
            var Period = self.SettingsValues.Period
            , EMAPeriod = self.SettingsValues.EMAPeriod
            , bar = self.Bars[0]
            ;
            if (UpdateType === "FrontDataAdded") {
                //High Low difference
                HL.unshift(bar.High() - bar.Low());
                // Single EMA
                SingleEMA.unshift(self.ComputeEMA(HL, EMAPeriod, false, SingleEMA[0]));
                //Double EMA
                DoubleEMA.unshift(self.ComputeEMA(SingleEMA, EMAPeriod, false, DoubleEMA[0]));
                //EMA Ratio
                EMARatio.unshift(SingleEMA[0] / DoubleEMA[0]);
                var ratiorange = EMARatio.slice(0, Period)
                , ii = Period
                , massindex = null
                , indicatorinfo = null
                ;
                while (ii--) { massindex += ratiorange[ii]; }
                indicatorinfo = { Value: massindex, Stamp: bar.Stamp() };
                self.IndicatorData.unshift(indicatorinfo);
                ratiorange = null;
                massindex = null;


            }
            else if (UpdateType === "BarUpdate") {
                //High Low difference
                HL[0] = bar.High() - bar.Low();
                // Single EMA
                SingleEMA[0] = self.ComputeEMA(HL, EMAPeriod, false, SingleEMA[1]);
                //Double EMA
                DoubleEMA[0] = self.ComputeEMA(SingleEMA, EMAPeriod, false, DoubleEMA[1]);
                //EMA Ratio
                EMARatio[0] = SingleEMA[0] / DoubleEMA[0];
                var ratiorange = EMARatio.slice(0, Period)
                , ii = Period
                , massindex = null
                , indicatorinfo = null
                ;
                while (ii--) { massindex += ratiorange[ii]; }
                indicatorinfo = { Value: massindex, Stamp: bar.Stamp() };
                self.IndicatorData[0] = indicatorinfo;
                ratiorange = null;
                massindex = null;

            }
            bar = null;

        }
    }
};




self.IndicatorInfo = {
    "SMA": {
        IndicatorName: "SMA",
        IndicatorFullName: "Simple Moving Average"
    },
    "ATR": {
        IndicatorName: "ATR",
        IndicatorFullName: "Average True Range"
    },
    "EMA": {
        IndicatorName: "EMA",
        IndicatorFullName: "Exponential Moving Average"
    },
    "DC": {
        IndicatorName: "DC",
        IndicatorFullName: "Donchian Channel"
    },
    "FCB": {
        IndicatorName: "FCB",
        IndicatorFullName: "Fractal Chaos Bands"
    },
    "SAR": {
        IndicatorName: "SAR",
        IndicatorFullName: "Parabolic SAR"
    },
    "MACD": {
        IndicatorName: "MACD",
        IndicatorFullName: "Moving Average Convergence-Divergence"
    },
    "Bear": {
        IndicatorName: "Bear",
        IndicatorFullName: "Bear Power"
    },
    "BB": {
        IndicatorName: "BB",
        IndicatorFullName: "Bollinger Bands"
    },
    "WMA": {
        IndicatorName: "WMA",
        IndicatorFullName: "Weighted Moving Average"
    },
    "SI": {
        IndicatorName: "SI",
        IndicatorFullName: "Swing Index",
    },
    "ASI": {
        IndicatorName: "ASI",
        IndicatorFullName: "Accumulative Swing Index"
    },
    "CCI": {
        IndicatorName: "CCI",
        IndicatorFullName: "Commodity Channel Index"
    },
    "AI": {
        IndicatorName: "AI",
        IndicatorFullName: "Alligator",
    },
    "SO": {
        IndicatorName: "SO",
        IndicatorFullName: "Stochastic Oscillator",
    },
    "EnMA": {
        IndicatorName: "EnMA",
        IndicatorFullName: "Envelope Moving Average",
    },
    "Ulcer": {
        IndicatorName: "Ulcer",
        IndicatorFullName: "Ulcer Index",
    },
    "WilliamsPercentR": {
        IndicatorName: "WilliamsPercentR",
        IndicatorFullName: "Williams Percent R",
    },
    "CHV": {
        IndicatorName: "CHV",
        IndicatorFullName: "Chaikin Volatility",
    },
    "MI": {
        IndicatorName: "MI",
        IndicatorFullName: "Mass Index",
    }
};