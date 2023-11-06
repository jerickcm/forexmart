onmessage = function (event) {

    var info = event.data;

    var Bars = info.BarsData;
    var TPCollection = info.TypicalCollection;
    var Period = info.Period;
    var WMAPeriod = info.WMAPeriod;
    var StochRSIPeriod = info.StochRSIPeriod;
    var StdPeriod = info.StdPeriod;
    var LimitMove = info.LimitMovePeriod
    var cmoPeriod = info.CMOPeriod;
    var deviation = info.Deviation;
    var ATRPeriod = info.ATRPeriod;
    var IndicatorName = info.Indicator;
    var IndicatorValue = info.IndicatorValue;
    var tmpValues = [];
    var TPValues = [];
    SetBarsTypical();
    var LongMA = (info.LongMA !== undefined) ? info.LongMA : null;
    var ShortMA = (info.ShortMA !== undefined) ? info.ShortMA : null;
    var SignalPeriod = (info.SignalPeriod !== undefined) ? info.SignalPeriod : null;
    var LongPeriod = (info.LongPeriod !== undefined) ? info.LongPeriod : null;
    var ShortPeriod = (info.ShortPeriod !== undefined) ? info.ShortPeriod : null;
    var PVTList = [];
    var ADLList = [];
    var NVIList = [];
    var EMA_NVIList = [];
    var smoothingPeriod = info.SmoothingPeriod;
    var initPVI = info.InitialPVI;
    var dPeriod = info.dPeriod;
    var lips_Period = info.Lips_Period;
    var teeth_Period = info.Teeth_Period;
    var Digits = info.Digits;
    var Percentage = info.Percentage;
    var Range = info.Range;

    var SenkouB_Period = info.SenkouB_Period;
    var TenKan_Period = info.TenKan_Period;
    var EMAPeriod = info.EMAPeriod;
    var Slow_Period = info.Slow_Period;
    var Fast_Period = info.Fast_Period;

    var Jaw_Period = info.Jaw_Period;
    var Jaw_Shift = info.Jaw_Shift;
    var Teeth_Period = info.Teeth_Period;
    var Teeth_Shift = info.Teeth_Shift;
    var Lips_Period = info.Lips_Period;
    var Lips_Shift = info.Lips_Shift;

    ComputeIndicatorValues(IndicatorName);

    function ComputeIndicatorValues(Indicator) {
        switch (Indicator) {
            case "SMA":
                SetIndicatorSMA();
                break;
            case "ATR":
                SetIndicatorATR();
                break;
            case "EMA":
                SetIndicatorEMA();
                break;
            case "Bear":
                SetIndicatorBear();
                break;
            case "FCB":
                SetIndicatorFCB();
                break;
            case "DC":
                SetIndicatorDC();
                break;
            case "SAR":
                SetIndicatorPSAR();
                break;
            case "MACD":
                SetIndicatorMACD();
                break;
            case "BB":
                SetIndicatorBB();
                break;
            case "WMA":
                SetIndicatorWeightedMovingAverage();
                break;
            case "SI":
                SetIndicatorSI();
                break;
            case "ASI":
                SetIndicatorASI();
                break;
            case "CCI":
                SetIndicatorCCI();
                break;
            case "AI":
                SetIndicatorAI();
                break;
            case "EnMA":
                SetIndicatorEnMA();
                break;
            case "CHV":
                SetIndicatorCHV();
                break;
            case "MI":
                SetIndicatorMI();
                break;
            case "Ulcer":
                SetIndicatorUlcer();
                break;
            case "SO":
                SetIndicatorSO();
                break;
            case "WilliamsPercentR":
                SetIndicatorWilliamsPercentR();
                break;
        }
    }

    var SarNumber = -1;
    var CurrentEP = 0;
    var CurrentSAR = 0;
    var CurrentAF = 0;
    var PrevSarNumber = -1;
    var PrevEP = 0;
    var PrevSAR = 0;
    var PrevAF = 0;
    var trychange = 0;

    function SetIndicatorPSAR() {
        var AF = 0.02;
        var MaxAF = 0.20;
        if (Bars != undefined) {
            if (Bars.length != 0) {
                if (tmpValues.length > 0) { tmpValues = []; }
                PrevSAR = Bars[Bars.length - 1].High;
                CurrentSAR = PrevSAR;

                PrevEP = Bars[Bars.length - 2].Low;
                CurrentEP = PrevEP;

                PrevAF = AF;
                CurrentAF = AF;

                SarNumber = -1;
                if (3 < Bars.length) {
                    Sleep(5);
                    for (var i = Bars.length - 1; i >= 0; i--) {
                        if (Bars.length - i > 2) {
                            var value = Calculate(i);
                            var indInfo = objValue(value, Bars[i].Stamp);
                            tmpValues.unshift(indInfo)
                        }

                    }
                    info.Values = tmpValues;
                    info.SarNumber = SarNumber;
                    info.CurrentEP = CurrentEP;
                    info.CurrentSAR = CurrentSAR;
                    info.CurrentAF = CurrentAF;
                    info.PrevSarNumber = PrevSarNumber;
                    info.PrevEP = PrevEP;
                    info.PrevSAR = PrevSAR;
                    info.PrevAF = PrevAF;
                    info.trychange = trychange;
                }
            }
        }
        postMessage(info);

        function Calculate(index) {
            var changeSarNumber = false;
            if (index > 0) {
                PrevSAR = CurrentSAR;
                PrevEP = CurrentEP;
                PrevAF = CurrentAF;
                changeSarNumber = true;
            }
            else if (trychange === Bars.length) {
                PrevSAR = CurrentSAR;
                PrevEP = CurrentEP;
                PrevAF = CurrentAF;
                changeSarNumber = true;
                trychange = Bars.length + 1;
            }
            else {
                trychange = Bars.length + 1;
            }

            var CalculatedSAR = 0;
            CalculatedSAR = PrevSAR + (PrevAF * (PrevEP - PrevSAR));

            var tentativeSAR = 0;
            if (PrevSarNumber < 0) {
                tentativeSAR = Math.max(Math.max((PrevSAR + (PrevAF * (PrevEP - PrevSAR))), Bars[index + 1].High), Bars[index + 2].High);
            }
            else {
                tentativeSAR = Math.min(Math.min((PrevSAR + (PrevAF * (PrevEP - PrevSAR))), Bars[index + 1].Low), Bars[index + 2].Low);
            }

            if (PrevSarNumber < 0) {
                if (tentativeSAR <= Bars[index].High) {
                    SarNumber = 1;
                }
                else {
                    SarNumber = PrevSarNumber - 1;
                }
            }
            else {
                if (tentativeSAR > Bars[index].Low) {
                    SarNumber = -1;
                }
                else {
                    SarNumber = PrevSarNumber + 1;
                }
            }

            if (SarNumber === -1) {
                CurrentSAR = Math.max(PrevEP, Bars[index].High);
            }
            else {
                if (SarNumber === 1) {
                    CurrentSAR = Math.min(PrevEP, Bars[index].Low);
                }
                else {
                    CurrentSAR = tentativeSAR;
                }
            }

            if (SarNumber < 0) {
                if (SarNumber === -1) {
                    CurrentEP = Bars[index].Low;
                }
                else {
                    CurrentEP = Math.min(Bars[index].Low, PrevEP);
                }
            }
            else {
                if (SarNumber === 1) {
                    CurrentEP = Bars[index].High;
                }
                else {
                    CurrentEP = Math.max(Bars[index].High, PrevEP);
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

    }

    function SetIndicatorDC() {
        var HighLine = [];
        var LowLine = [];
        var MidLine = [];

        if (Bars != undefined) {
            if (Bars.length != 0) {
                if (tmpValues.length > 0) { tmpValues = []; }

                if (Period < Bars.length) {
                    Sleep(5);
                    for (var i = Bars.length - 1; i >= 0; i--) {
                        if ((Period + 1) < Bars.length - i) {

                            var BarsRange = getDataRange(i, Period, Bars);
                            var HighValues = getValueToCompute("High", BarsRange);
                            var LowValues = getValueToCompute("Low", BarsRange);
                            var HighestHigh = Max(HighValues);
                            var LowestLow = Min(LowValues);
                            var Mid = (HighestHigh + LowestLow) / 2;
                            var indInfoHigh = objValue(HighestHigh, null);
                            var indInfoLow = objValue(LowestLow, null);
                            var indInfoMid = objValue(Mid, null);
                            HighLine.unshift(indInfoHigh);
                            LowLine.unshift(indInfoLow);
                            MidLine.unshift(indInfoMid);
                        }
                    }

                    tmpValues.unshift(LowLine);
                    tmpValues.unshift(MidLine);
                    tmpValues.unshift(HighLine);
                    info.Values = tmpValues;

                }
            }
        }
        postMessage(info);


    }

    function SetIndicatorFCB() {
        var FractalValuesHigh = [];
        var FractalValuesLow = [];
        if (Bars != undefined) {
            if (Bars.length != 0) {

                if (5 < Bars.length) {
                    Sleep(5);
                    for (var i = Bars.length - 1; i >= 0; i--) {
                        if (5 < Bars.length - i) {

                            var FractalHigh = CheckFractalHigh(i);
                            var FractalLow = CheckFractalLow(i);

                            if (FractalHigh === true) {
                                var index = i + 2;
                                var value = Bars[index].High;
                                var indInfo = objValue(value, null);
                                FractalValuesHigh.unshift(indInfo);
                            } else {
                                if (FractalValuesHigh.length !== 0) {
                                    var indInfo = objValue(FractalValuesHigh[0].Value, null);
                                    FractalValuesHigh.unshift(indInfo);
                                }
                            }

                            if (FractalLow === true) {
                                var index = i + 2;
                                var value = Bars[index].Low;
                                var indInfo = objValue(value, null);
                                FractalValuesLow.unshift(indInfo);
                            } else {
                                if (FractalValuesLow.length !== 0) {
                                    var indInfo = objValue(FractalValuesLow[0].Value, null);
                                    FractalValuesLow.unshift(indInfo);
                                }
                            }
                        }
                    }
                    tmpValues.unshift(FractalValuesLow);
                    tmpValues.unshift(FractalValuesHigh);
                    info.Values = tmpValues;
                }
            }
        }
        postMessage(info);

        function CheckFractalHigh(index) {

            var GetRange = getDataRange(index, 5, Bars);
            var Range = getValueToCompute("High", GetRange);

            if (Range[2] >= Range[3] && Range[2] >= Range[4] && Range[2] >= Range[1] && Range[2] >= Range[0]) {
                return true;
            }
            else {
                return false;
            }

        }

        function CheckFractalLow(index) {

            var GetRange = getDataRange(index, 5, Bars);
            var Range = getValueToCompute("Low", GetRange);

            if (Range[2] <= Range[3] && Range[2] <= Range[4] && Range[2] <= Range[1] && Range[2] <= Range[0]) {
                return true;
            }
            else {
                return false;
            }
        }
    }

    function SetIndicatorBear() {
        var EMAValues = [];
        if (Bars != undefined) {
            if (Bars.length != 0) {
                if (tmpValues.length > 0) { tmpValues = []; }

                if (Period < Bars.length) {
                    Sleep(5);
                    for (var i = Bars.length - 1; i >= 0; i--) {
                        if (Period < Bars.length - i) {
                            if (tmpValues.length === 0) {
                                var computedValue = Calculate(i, true, null);
                                var indInfo = objValue(computedValue, Bars[i].Stamp);
                                tmpValues.unshift(indInfo)
                            } else {
                                var computedValue = Calculate(i, false, EMAValues[0]);
                                var indInfo = objValue(computedValue, Bars[i].Stamp);
                                tmpValues.unshift(indInfo)
                            }
                        }
                    }
                    info.Values = tmpValues;
                    info.EMAValues = EMAValues;
                }
            }
        }
        postMessage(info);

        function Calculate(index, firstEMA, PreviousValue) {
            var rangeEMA = getDataRange(index, Period, Bars);
            var range = getValueToCompute(IndicatorValue, rangeEMA);
            var ComputedEMA = ComputeEMA(range, Period, null, firstEMA, PreviousValue);
            EMAValues.unshift(ComputedEMA);
            var value = Bars[index].Low - ComputedEMA;
            return value;
        }
    }

    function SetIndicatorEMA() {
        if (Bars != undefined) {
            if (Bars.length != 0) {
                if (tmpValues.length > 0) { tmpValues = []; }

                if (Period < Bars.length) {
                    Sleep(5);
                    for (var i = Bars.length - 1; i >= 0; i--) {
                        if (Period < Bars.length - i) {
                            if (tmpValues.length === 0) {
                                var computedValue = Calculate(i, true, null);
                                var indInfo = objValue(computedValue, Bars[i].Stamp);
                                tmpValues.unshift(indInfo)
                            } else {
                                var computedValue = Calculate(i, false, tmpValues[0].Value);
                                var indInfo = objValue(computedValue, Bars[i].Stamp);
                                tmpValues.unshift(indInfo)
                            }
                        }
                    }
                    info.Values = tmpValues;
                }
            }
        }
        postMessage(info);

        function Calculate(index, firstEMA, PreviousValue) {
            var rangeEMA = getDataRange(index, Period, Bars);
            var range = getValueToCompute(IndicatorValue, rangeEMA);
            var value = ComputeEMA(range, Period, null, firstEMA, PreviousValue);

            return value;
        }
    }

    function SetIndicatorATR() {
        if (Bars != undefined) {
            if (Bars.length != 0) {
                if (tmpValues.length > 0) { tmpValues = []; }

                if (2 < Bars.length) {
                    var TRCollection = [];
                    Sleep(5);
                    for (var i = Bars.length - 1; i >= 0; i--) {
                        if (2 < Bars.length - i) {
                            var TrueRange = getTrueRange(Bars[i].High, Bars[i].Low, Bars[i + 1].Close);
                            TRCollection.unshift(TrueRange);
                            if (TRCollection.length >= Period) {
                                if (tmpValues.length === 0) {
                                    var value = ComputeSMA(TRCollection, Period);
                                    var indInfo = objValue(value, Bars[i].Stamp);
                                    tmpValues.unshift(indInfo);
                                } else {
                                    var value = ComputeIndicatorATR(tmpValues[0].Value, TRCollection[0], Period);
                                    var indInfo = objValue(value, Bars[i].Stamp);
                                    tmpValues.unshift(indInfo);
                                }
                            }
                        }
                    }
                    info.Values = tmpValues;
                }
            }
        }
        postMessage(info);
    }

    function SetIndicatorSMA() {
        if (Bars != undefined) {
            if (Bars.length != 0) {
                if (tmpValues.length > 0) { tmpValues = []; }

                if (Period < Bars.length) {
                    Sleep(5);
                    for (var i = Bars.length - 1; i >= 0; i--) {
                        if (Period < Bars.length - i) {
                            var computedValue = ComputeIndicatorSMA(i);
                            var indInfo = objValue(computedValue, Bars[i].Stamp);
                            tmpValues.unshift(indInfo)
                        }
                    }
                    info.Values = tmpValues;
                }
            }
        }
        postMessage(info);
    }

    function ComputeSMA(Values, Period) {
        var total = 0;

        for (var i = 0; i != Period; i++) {
            total = total + Values[i];
        }
        return (total / Period);
    }

    function ComputeIndicatorSMA(index) {
        var rangeSMA = getDataRange(index, Period, Bars);
        var range = getValueToCompute(IndicatorValue, rangeSMA);
        var ReturnValue = ComputeSMA(range, Period);

        return ReturnValue;
    }

    function SetIndicatorMACD() {
        var ShortEMA = [];
        var LongEMA = [];
        var SignalEMA = [];
        var MACDLine = [];
        var MACDHistogram = [];
        var firstSignal = true;
        var SignalMultiplier = 2 / (SignalPeriod + 1);
        var LongEMAMultiplier = 2 / (LongPeriod + 1);
        var ShortEMAMultiplier = 2 / (ShortPeriod + 1);
        var PreviousShortEMA = 0;
        var PreviousLongEMA = 0;
        var PreviousSignalEMA = 0;
        if (Bars != undefined) {
            if (Bars.length != 0) {
                if (tmpValues.length > 0) { tmpValues = []; }

                if (ShortPeriod < Bars.length) {
                    Sleep(5);
                    for (var i = Bars.length - 1; i >= 0; i--) {
                        if (ShortPeriod < Bars.length - i) {
                            CalculateShortEMA(i);
                        }
                        if (LongPeriod < Bars.length - i) {
                            CalculateLongEMA(i);
                        }
                        if (ShortEMA.length > 0 && LongEMA.length > 0) {
                            var MACDValue = ShortEMA[0].Value - LongEMA[0].Value;
                            var indInfoMACD = objValue(MACDValue, Bars[i].Stamp);
                            MACDLine.unshift(indInfoMACD);

                            if (SignalPeriod < MACDLine.length) {
                                var EMARange = getDataRange(0, SignalPeriod, MACDLine);
                                var Range = getObjectValueToCompute(EMARange);
                                if (SignalEMA.length && firstSignal) {
                                    firstSignal = false;
                                }
                                var computedValue = ComputeEMA(Range, SignalPeriod, SignalMultiplier, firstSignal, PreviousSignalEMA);
                                PreviousSignalEMA = computedValue;
                                var indInfoSignal = objValue(computedValue, Bars[i].Stamp);
                                SignalEMA.unshift(indInfoSignal);

                                if (SignalEMA.length > 0) {
                                    var MACDHist = MACDLine[0].Value - SignalEMA[0].Value;
                                    var indInfoMACDHist = objValue(MACDHist, Bars[i].Stamp);
                                    MACDHistogram.unshift(indInfoMACDHist);
                                }
                            }
                        }
                    }
                    tmpValues.unshift(MACDHistogram);
                    tmpValues.unshift(SignalEMA);
                    tmpValues.unshift(MACDLine);
                    info.Values = tmpValues;
                    info.ShortEMA = ShortEMA;
                    info.LongEMA = LongEMA;
                }
            }
        }
        postMessage(info);

        function CalculateShortEMA(index) {
            var computedValue;
            if (ShortEMA.length === 0) {
                var EMARange = getDataRange(index, ShortPeriod, Bars);
                var Range = getValueToCompute(IndicatorValue, EMARange);
                computedValue = ComputeEMA(Range, ShortPeriod, ShortEMAMultiplier, true, PreviousShortEMA);
                PreviousShortEMA = computedValue;
            }
            else {
                var EMARange = getDataRange(index, ShortPeriod, Bars);
                var Range = getValueToCompute(IndicatorValue, EMARange);
                computedValue = ComputeEMA(Range, ShortPeriod, ShortEMAMultiplier, false, PreviousShortEMA);
                PreviousShortEMA = computedValue;
            }
            var indInfo = objValue(computedValue, Bars[i].Stamp);
            ShortEMA.unshift(indInfo);
        }

        function CalculateLongEMA(index) {
            var computedValue;
            if (LongEMA.length === 0) {
                var EMARange = getDataRange(index, LongPeriod, Bars);
                var Range = getValueToCompute(IndicatorValue, EMARange);
                computedValue = ComputeEMA(Range, LongPeriod, LongEMAMultiplier, true, PreviousLongEMA);
                PreviousLongEMA = computedValue;
            }
            else {
                var EMARange = getDataRange(index, LongPeriod, Bars);
                var Range = getValueToCompute(IndicatorValue, EMARange);
                computedValue = ComputeEMA(Range, LongPeriod, LongEMAMultiplier, false, PreviousLongEMA);
                PreviousLongEMA = computedValue;
            }
            var indInfo = objValue(computedValue, Bars[i].Stamp);
            LongEMA.unshift(indInfo);
        }
    }

    function ComputeIndicatorROC(index) {
        var ROC = ((Bars[index].Close - Bars[index + Period].Close) / (Bars[index + Period].Close)) * 100;
        return ROC;
    }

    function ComputeIndicatorRBChart(index) {

        var rangeSMA = getDataRange(index, Period, Bars);
        var range = getValueToCompute(IndicatorValue, rangeSMA);
        return ComputeSMA(range, Period);
    }

    function ComputeIndicatorPVT(index) {
        var bar = Bars[index];
        var priorbar = Bars[index + 1];

        var PercentageChange = (bar.Close - priorbar.Close) / priorbar.Close;
        var PercentageVolume = PercentageChange * bar.Volume;
        if (!PVTList.length) {
            return PercentageVolume;
        }
        var PriceVolumeTrend = PercentageVolume + PVTList[0].Value;

        return PriceVolumeTrend;

    }

    function ComputeADL(index) {
        var bar = Bars[index];
        if (bar.High != bar.Low) {
            var MoneyFlowMultiplier = [(bar.Close - bar.Low) - (bar.High - bar.Close)] / (bar.High - bar.Low);
            var MoneyFlowVolume = MoneyFlowMultiplier * bar.Volume;
            if (ADLList.length) {
                return ADLList[0].Value + MoneyFlowVolume;
            }
            else {
                return MoneyFlowVolume;
            }
        }
        else {
            return 0;
        }
    }

    //Momentum Indicator
    function SetIndicatorBB() {
        var bbTop = [], bbMid = [], bbBot = [];
        var index = (Bars.length - Period) - 1;
        if (Bars != undefined) {
            if (tmpValues.length > 0) { tmpValues = []; }
            if (Bars.length != 0) {
                for (var i = index; i >= 0; i--) {
                    var bbTopVal = 0, bbMidVal = 0, bbBotVal = 0, stdDev = 0;
                    bbMidVal = ComputeIndicatorSMA(i);
                    stdDev = Calculate(i) * deviation;
                    bbTopVal = bbMidVal + (stdDev);
                    bbBotVal = bbMidVal - (stdDev);
                    bbMid.unshift(objValue(bbMidVal, Bars[i].Stamp));
                    bbTop.unshift(objValue(bbTopVal, Bars[i].Stamp));
                    bbBot.unshift(objValue(bbBotVal, Bars[i].Stamp));
                }
                tmpValues.unshift(bbTop);
                tmpValues.unshift(bbMid);
                tmpValues.unshift(bbBot);
                info.Values = tmpValues;
            }
        }
        postMessage(info);

        function Calculate(index) {
            var GetRange = getDataRange(index, Period, Bars);
            var Range = getValueToCompute(IndicatorValue, GetRange);

            var Sum = 0;

            var SMA = ComputeSMA(Range, Period);
            for (var i = 0; i < Period; i++) {
                Sum = (Sum + (Math.pow((SMA - Range[i]), 2)));
            }

            var Variance = (Sum / (Period - 1));
            var StdDev = 0;

            return StdDev = Math.sqrt(Variance);
        }
    }

    function SetIndicatorWeightedMovingAverage() {
        if (Bars) {
            var BarsLength = Bars.length;
            if (BarsLength > Period) {
                Sleep(5);
                var WMAValues = []
                , i = BarsLength
                , d = (Period * (Period + 1)) / 2;
                while (i--) {
                    if (Period < (BarsLength - i)) {
                        var getBarRange = getDataRange(i, Period, Bars)
                        , ii = Period
                        , WMAvalue = null
                        , indicatorinfo = null
                        , n = null;

                        while (ii--) {
                            n = ii + 1;
                            WMAvalue += (getBarRange[ii].Close * (n / d));
                        }

                        indicatorinfo = objValue(WMAvalue, Bars[i].Stamp);
                        WMAValues.unshift(indicatorinfo);

                        getBarRange = null;
                        indicatorinfo = null;
                    }
                }

                info.Values = WMAValues;
                WMAValues = null;
            }
        }
        postMessage(info);
    }

    function SetIndicatorSI() {
        if (Bars) {
            var barslength = Bars.length;
            if (barslength > 2) {
                var i = barslength
                    , SwingIndexValues = [];
                while (i--) {
                    if ((barslength - i) > 2) {
                        var bar = Bars[i],
                            priorbar = Bars[i + 1]
                            , HyC = bar.High - priorbar.Close
                            , absHyC = Math.abs(HyC)
                            , LyC = bar.Low - priorbar.Close
                            , absLyC = Math.abs(LyC)
                            , HL = bar.High - bar.Low
                            , yCyO = priorbar.Close - priorbar.Open
                            , CyC = bar.Close - priorbar.Close
                            , CO = bar.Close - bar.Open
                            , oT = (.25 * yCyO)
                            , absoT = Math.abs(oT)
                            , N = null
                            , K = null
                            , R = null
                            , SI = null
                            , indicatorinfo;

                        N = CyC + (.5 * CO) + oT;

                        if (absHyC > absLyC) { //determine K 
                            K = absHyC;
                            if (absHyC > HL) { //determine R
                                R = absHyC - (.5 * LyC) + absoT;
                            }
                            else {
                                R = HL + absoT;
                            }
                        }
                        else {   //determine K
                            K = absLyC;
                            if (absLyC > HL) {  //determine R
                                R = absLyC - (.5 * HyC) + absoT;
                            }
                            else {
                                R = HL + absoT;
                            }
                        }

                        SI = R ? 50 * (N / R) * (K / LimitMove) : 0;
                        indicatorinfo = objValue(SI, bar.Stamp);
                        SwingIndexValues.unshift(indicatorinfo);

                        bar = null;
                        priorbar = null;
                        indicatorinfo = null;
                    }
                }
                info.Values = SwingIndexValues;
                SwingIndexValues = null;
            }
        }
        postMessage(info);
    }

    function SetIndicatorASI() {
        if (Bars) {
            var barslength = Bars.length;
            if (barslength > 2) {
                var i = barslength
                    , SwingIndex = []
                    , AccumulativeSwingIndex = [];

                while (i--) {
                    if ((barslength - i) > 2) {
                        var bar = Bars[i],
                            priorbar = Bars[i + 1]
                            , HyC = bar.High - priorbar.Close
                            , absHyC = Math.abs(HyC)
                            , LyC = bar.Low - priorbar.Close
                            , absLyC = Math.abs(LyC)
                            , HL = bar.High - bar.Low
                            , yCyO = priorbar.Close - priorbar.Open
                            , CyC = bar.Close - priorbar.Close
                            , CO = bar.Close - bar.Open
                            , oT = (.25 * yCyO)
                            , absoT = Math.abs(oT)
                            , N = null
                            , K = null
                            , R = null
                            , SI = null
                            , value = null
                            , indicatorinfo;

                        N = CyC + (.5 * CO) + oT;

                        if (absHyC > absLyC) { //determine K 
                            K = absHyC;
                            if (absHyC > HL) { //determine R
                                R = absHyC - (.5 * LyC) + absoT;
                            }
                            else {
                                R = HL + absoT;
                            }
                        }
                        else {   //determine K
                            K = absLyC;
                            if (absLyC > HL) {  //determine R
                                R = absLyC - (.5 * HyC) + absoT;
                            }
                            else {
                                R = HL + absoT;
                            }
                        }

                        SI = R ? 50 * (N / R) * (K / LimitMove) : 0;
                        SwingIndex.unshift(SI);


                        if (AccumulativeSwingIndex.length) {
                            value = AccumulativeSwingIndex[0].Value + SI;
                            indicatorinfo = objValue(value, bar.Stamp);
                            AccumulativeSwingIndex.unshift(indicatorinfo);
                        }
                        else {
                            indicatorinfo = objValue(SI, bar.Stamp);
                            AccumulativeSwingIndex.unshift(indicatorinfo);
                        }



                        bar = null;
                        priorbar = null;
                        indicatorinfo = null;
                    }
                }
                info.Values = AccumulativeSwingIndex;
                info.SwingIndexValues = SwingIndex;
                SwingIndexValues = null;
                AccumulativeSwingIndex = null;
            }
        }
        postMessage(info);
    }

    function SetIndicatorCCI() {
        if (Bars) {
            var barslength = Bars.length;
            if (barslength > Period) {
                var i = barslength
                    , CCIvalues = [];

                while (i--) {
                    if (Period < (barslength - i)) {
                        var barsrange = Bars.slice(i, i + Period)
                        , bar = Bars[i]
                        , ii = Period
                        , iii = Period
                        , TPtotal = null
                        , SMAofTP = null
                        , MeanAbstotal = null
                        , MeanDeviation = null
                        , CCI = null
                        , indicatorinfo = null;

                        // get 20-day SMA of TP
                        while (ii--) {
                            TPtotal += barsrange[ii].Typical;
                        }
                        SMAofTP = TPtotal / Period;

                        // get 20-day Mean Deviation
                        while (iii--) {
                            MeanAbstotal += Math.abs(SMAofTP - barsrange[iii].Typical);
                        }
                        MeanDeviation = MeanAbstotal / Period;

                        // get 20-day CCI
                        CCI = (bar.Typical - SMAofTP) / (0.015 * MeanDeviation);
                        indicatorinfo = objValue(CCI, bar.Stamp);
                        CCIvalues.unshift(indicatorinfo);

                        barsrange = null;
                        bar = null;
                        indicatorinfo = null;

                    }
                }
                info.Values = CCIvalues;
                CCIvalues = null;
            }
        }
        postMessage(info);
    }


    function SetIndicatorEnMA() {
        if (Bars) {
            var barslength = Bars.length;
            if (barslength > Period) {
                var i = barslength
                    , IndicatorValues = []
                    , UpperBandValues = []
                    , LowerBandValues = []
                    , K = (info.Percentage / 100) / Math.pow(10, info.Notation);
                while (i--) {
                    if (Period < (barslength - i)) {
                        var bar = Bars[i]
                          , barsrange = Bars.slice(i, i + Period)
                          , ii = Period
                          , SMA = null
                          , shifted = null
                          , uppervalue = null
                          , lowervalue = null
                          , upperbandinfo = null
                          , lowerbandinfo = null;

                        while (ii--) {
                            SMA += (barsrange[ii].Close / Period);
                        }

                        shifted = SMA * K
                        uppervalue = SMA + shifted
                        lowervalue = SMA - shifted
                        upperbandinfo = objValue(uppervalue, bar.Stamp)
                        lowerbandinfo = objValue(lowervalue, bar.Stamp);

                        UpperBandValues.unshift(upperbandinfo);
                        LowerBandValues.unshift(lowerbandinfo);

                        bar = null;
                        barsrange = null;
                        upperbandinfo = null;
                        lowerbandinfo = null;
                    }
                }

                IndicatorValues.unshift(UpperBandValues);
                IndicatorValues.unshift(LowerBandValues);
                info.Values = IndicatorValues;

                IndicatorValues = null;
                UpperBandValues = null;
                LowerBandValues = null;
            }
        }
        postMessage(info);
    }

    function SetIndicatorUlcer() {
        if (Bars) {
            var barslength = Bars.length
               , CloseValues = []
               , PercentDrawDownSquared = []
               , UlcerIndex = []
               , ComputationValues = [];
            if (barslength > info.Period + info.PeriodCloseMax) {
                var i = barslength;
                while (i--) {
                    var bar = Bars[i];
                    CloseValues.unshift(bar.Close);
                    if (barslength - i > info.PeriodCloseMax) {
                        var closerange = CloseValues.slice(0, info.PeriodCloseMax)
                            , maxclose = Math.max.apply(null, closerange)
                            , percentDD = ((bar.Close - maxclose) / maxclose) * 100
                            , percentDDS = percentDD * percentDD
                        ;
                        PercentDrawDownSquared.unshift(percentDDS);
                        if (PercentDrawDownSquared.length > info.Period) {
                            var pddsrange = PercentDrawDownSquared.slice(0, info.Period)
                            , averagesquare = sum(pddsrange) / info.Period
                            , ulcerindex = Math.sqrt(averagesquare)
                            , indicatorinfo = objValue(ulcerindex, bar.Stamp);
                            UlcerIndex.unshift(indicatorinfo);
                            pddsrange = null;
                            indicatorinfo = null;
                        }
                        closerange = null;
                    }
                }
                ComputationValues.unshift(CloseValues);
                ComputationValues.unshift(PercentDrawDownSquared);
                ComputationValues.unshift(UlcerIndex);
                info.Values = ComputationValues;

                CloseValues = null;
                PercentDrawDownSquared = null;
                UlcerIndex = null;
                ComputationValues = null;
            }
        }
        postMessage(info);
    }

    function SetIndicatorWilliamsPercentR() {
        if (Bars) {
            var barslength = Bars.length
            ;
            if (barslength > info.Period) {
                var i = barslength
                , HighValues = []
                , LowValues = []
                , WilliamPercentR = []
                , Values = []
                ;
                while (i--) {
                    var bar = Bars[i]
                    ;
                    HighValues.unshift(bar.High);
                    LowValues.unshift(bar.Low);
                    if (HighValues.length > info.Period) {
                        var highrange = HighValues.slice(0, info.Period)
                        , highesthigh = Math.max.apply(null, highrange)
                        , lowrange = LowValues.slice(0, info.Period)
                        , lowestlow = Math.min.apply(null, lowrange)
                        , percentR = (highesthigh - bar.Close) / (highesthigh - lowestlow) * -100
                        , indicatorinfo = objValue(percentR, bar.Stamp)
                        ;
                        WilliamPercentR.unshift(indicatorinfo);

                        highrange = null;
                        lowrange = null;
                        indicatorinfo = null;

                    }
                    bar = null;

                }
                Values.unshift(HighValues);
                Values.unshift(LowValues);
                Values.unshift(WilliamPercentR);
                info.Values = Values;

                HighValues = null;
                LowValues = null;
                WilliamPercentR = null;
                Values = null;

            }
        }
        postMessage(info);

    }

    function SetIndicatorMI() {
        if (Bars) {
            var barslength = Bars.length
            ;
            if (barslength > EMAPeriod + EMAPeriod + Period) {
                var i = barslength
                , HL = []
                , SingleEMA = null
                , DoubleEMA = null
                , EMARatio = []
                , MassIndex = []
                , Values = []
                ;
                while (i--) {
                    var bar = Bars[i]
                    ;
                    //High Low difference
                    HL.unshift(bar.High - bar.Low);
                    if (HL.length > EMAPeriod) {
                        // Single EMA
                        if (SingleEMA) {
                            SingleEMA.unshift(ComputeEMA(HL, EMAPeriod, null, false, SingleEMA[0]))
                            ;
                            if (SingleEMA.length > EMAPeriod) {
                                //Double EMA
                                if (DoubleEMA) {
                                    DoubleEMA.unshift(ComputeEMA(SingleEMA, EMAPeriod, null, false, DoubleEMA[0]))
                                    ;
                                    if (DoubleEMA.length > 1) {
                                        //EMA Ratio
                                        EMARatio.unshift(SingleEMA[0] / DoubleEMA[0])
                                        ;
                                        if (EMARatio.length >= Period) {
                                            var ratiorange = EMARatio.slice(0, Period)
                                            , massindex = sum(ratiorange)
                                            , indicatorinfo = objValue(massindex, bar.Stamp)
                                            ;
                                            MassIndex.unshift(indicatorinfo);
                                            ratiorange = null;
                                            massindex = null;
                                        }
                                    }
                                }
                                else {
                                    DoubleEMA = [];
                                    DoubleEMA.unshift(ComputeSMA(SingleEMA, EMAPeriod));
                                }

                            }

                        }
                        else {
                            SingleEMA = [];
                            SingleEMA.unshift(ComputeSMA(HL, EMAPeriod));
                        }

                    }
                    bar = null;
                }
                Values.unshift(HL);
                Values.unshift(SingleEMA);
                Values.unshift(DoubleEMA);
                Values.unshift(EMARatio);
                Values.unshift(MassIndex);

                info.Values = Values;
                HL = null;
                SingleEMA = null;
                DoubleEMA = null;
                EMARatio = null;
                MassIndex = null;
                Values = null;
            }

        }
        postMessage(info);
    };

    function sum(arr) {
        var i = arr.length,
            total = null;
        while (i--) {
            total += arr[i];
        }
        arr = null;
        return total;
    }

    function getDataRange(index, Period, BarData) {
        var ReturnRange = [];
        ReturnRange = BarData.slice(index, (index + Period));
        return ReturnRange;
    }

    function getValueToCompute(IndicatorValue, BarData) {
        var ReturnRange = [];

        switch (IndicatorValue) {
            case "High":

                for (var i = BarData.length - 1; i >= 0; i--) {
                    ReturnRange.unshift(BarData[i].High);
                }
                break;

            case "Low":

                for (var i = BarData.length - 1; i >= 0; i--) {
                    ReturnRange.unshift(BarData[i].Low);
                }
                break;

            case "Open":

                for (var i = BarData.length - 1; i >= 0; i--) {
                    ReturnRange.unshift(BarData[i].Open);
                }
                break;

            case "Close":

                for (var i = BarData.length - 1; i >= 0; i--) {
                    ReturnRange.unshift(BarData[i].Close);
                }
                break;
            case "Typical":
                for (var i = BarData.length - 1; i >= 0; i--) {
                    ReturnRange.unshift(BarData[i].Typical);
                }
                break;
        }

        return ReturnRange;
    }

    function objValue(ComputedValue, TimeStamp) {
        var obj = { Value: ComputedValue, Stamp: TimeStamp };

        return obj;
    }

    function getObjectValueToCompute(Range) {
        var ReturnRange = [];
        for (var i = Range.length - 1; i >= 0; i--) {
            ReturnRange.unshift(Range[i].Value);
        }

        return ReturnRange;
    }

    function getTrueRange(CurrentHigh, CurrentLow, PreviousClose) {
        var TrueHigh = (CurrentHigh > PreviousClose) ? CurrentHigh : PreviousClose;
        var TrueLow = (CurrentLow > PreviousClose) ? PreviousClose : CurrentLow;
        var TrueRange = TrueHigh - TrueLow;

        return Math.abs(TrueRange);
    }

    function ComputeIndicatorATR(PreviousValue, CurrentTrueRange, Period) {

        var ReturnValue = ((PreviousValue * (Period - 1)) + CurrentTrueRange) / Period;

        return ReturnValue;
    }

    function Sleep(milliseconds) {
        var start = new Date().getTime();
        for (var i = 0; i < 1e7; i++) {
            if ((new Date().getTime() - start) > milliseconds) {
                break;
            }
        }
    }

    function Typical(BarData, index) {
        return ((BarData[index].High + BarData[index].Low + BarData[index].Close) / 3);
    }

    function Median(BarData, index) {
        return ((BarData[index].High + BarData[index].Low) / 2);
    }

    function WeightedClose(BarData, index) {
        return (((BarData[index].Close * 2) + BarData[index].High + BarData[index].Low) / 4)
    }

    function ComputeSMMA(BarData, index, Period, firstSMMA, PreviousValue) {
        var ReturnValue;
        var total;
        if (firstSMMA) {
            var rangeSMA = getDataRange(index, Period, BarData);
            var range = getValueToCompute(IndicatorValue, rangeSMA);
            var ReturnValue = ComputeSMA(range, Period);
        }
        else {
            total = PreviousValue * Period;
            ReturnValue = ((total - PreviousValue + BarData[index][IndicatorValue]) / Period);
        }

        return ReturnValue;
    }

    function ComputeWilderSmoothing(BarData, index, Period, firstSmoothing, PreviousValue) {
        var ReturnValue;
        if (firstSmoothing) {
            var rangeSMA = getDataRange(index, Period, BarData);
            var range = getValueToCompute(IndicatorValue, rangeSMA);
            var ReturnValue = ComputeSMA(range, Period);
        }
        else {
            ReturnValue = (PreviousValue + ((BarData[index][IndicatorValue] - PreviousValue) / Period));
        }

        return ReturnValue;
    }

    function ComputeEMA(Values, Period, Multiplier, firstEMA, PreviousValue) {
        var K = (Multiplier !== null) ? Multiplier : (2 / (Period + 1));
        var ReturnValue;
        if (firstEMA) {
            ReturnValue = ComputeSMA(Values, Period);
        }
        else {
            ReturnValue = ((Values[0] * K) + (PreviousValue * (1 - K)));
        }

        return ReturnValue;
    }

    function SetBarsTypical() {
        for (var i = 0; i < Bars.length; i++) {
            var typical = Typical(Bars, i);
            Bars[i]['Typical'] = typical;
            if (TPCollection) { TPValues.push(typical); }
        }
    }

    function getTotal(Values) {
        var total = 0;

        for (var i = 0; i != Values.length; i++) {
            total = total + Values[i];
        }

        return total;
    }

    function Max(Range) {
        var ReturnValue;
        for (var i in Range) {
            var index = parseInt(i);
            ReturnValue = (index === 0) ? Range[index] : (Range[index] > ReturnValue) ? Range[index] : ReturnValue;
        }

        return ReturnValue;
    }

    function Min(Range) {
        var ReturnValue;
        for (var i in Range) {
            var index = parseInt(i);
            ReturnValue = (index === 0) ? Range[index] : (Range[index] < ReturnValue) ? Range[index] : ReturnValue;
        }

        return ReturnValue
    }

    //Alligator Indicator
    function SetIndicatorAI() {
        var aJaw = [], aLips = [], aTeeth = [];
        var iJaw = (Bars.length - Period), iLips = (Bars.length - lips_Period), iTeeth = (Bars.length - teeth_Period);

        if (Bars != undefined) {
            if (tmpValues.length > 0) { tmpValues = []; }
            if (Bars.length != 0) {
                //Calculate Jaw
                for (var i = iJaw; i >= 0; i--) {
                    if (i == iJaw) {
                        aJaw.unshift(objValue(ComputeSMMA(Bars, i, Period, true, null), Bars[i].Stamp));
                    }
                    else {
                        aJaw.unshift(objValue(ComputeSMMA(Bars, i, Period, false, aJaw[0].Value), Bars[i].Stamp));
                    }
                }

                //Calculate Lips
                for (var i = iLips; i >= 0; i--) {
                    if (i == iLips) {
                        aLips.unshift(objValue(ComputeSMMA(Bars, i, lips_Period, true, null), Bars[i].Stamp));
                    }
                    else {
                        aLips.unshift(objValue(ComputeSMMA(Bars, i, lips_Period, false, aLips[0].Value), Bars[i].Stamp));
                    }
                }

                //Calculate Teeth
                for (var i = iTeeth; i >= 0; i--) {
                    if (i == iTeeth) {
                        aTeeth.unshift(objValue(ComputeSMMA(Bars, i, teeth_Period, true, null), Bars[i].Stamp));
                    }
                    else {
                        aTeeth.unshift(objValue(ComputeSMMA(Bars, i, teeth_Period, false, aTeeth[0].Value), Bars[i].Stamp));
                    }
                }
                tmpValues.unshift(aJaw);
                tmpValues.unshift(aLips);
                tmpValues.unshift(aTeeth);
                info.Values = tmpValues;
            }
        }
        postMessage(info);
    }

    //Stochastic Oscillator
    function SetIndicatorSO() {
        var cl = 0, hl = 0, pKVal = 0, pKVals = [], pKList = [], pDList = [];
        var kIndex = (Bars.length - Period) - 1;

        if (Bars != undefined) {
            if (tmpValues.length > 0) { tmpValues = []; }
            if (Bars.length != 0) {
                for (var i = kIndex; i >= 0; i--) {
                    cl = Bars[i].Close - Math.min.apply(Math, getValueToCompute("Low", getDataRange(i, Period, Bars)));
                    hl = Math.max.apply(Math, getValueToCompute("High", getDataRange(i, Period, Bars))) - Math.min.apply(Math, getValueToCompute("Low", getDataRange(i, Period, Bars)));
                    pKVal = (cl / hl) * 100;
                    pKVals.unshift(pKVal);
                    pKList.unshift(objValue(pKVal, Bars[i].Stamp));
                }
                var dIndex = (pKVals.length - dPeriod) - 1;
                for (var i = dIndex; i >= 0; i--) {
                    if (i == dIndex) {
                        pDList.unshift(objValue(ComputeEMA(getDataRange(i, dPeriod, pKVals), dPeriod, null, true, null), Bars[i].Stamp));
                    }
                    else {
                        pDList.unshift(objValue(ComputeEMA(getDataRange(i, dPeriod, pKVals), dPeriod, null, false, pDList[0].Value), Bars[i].Stamp));
                    }
                }
                tmpValues.unshift(pKVals);
                tmpValues.unshift(pDList);
                tmpValues.unshift(pKList);
                info.Values = tmpValues;
            }
        }
        postMessage(info);
    }

    // Chaikin Volatility
    function SetIndicatorCHV() {
        var barsLength = Bars.length;

        // Clear Temp Collection
        if (tmpValues.length > 0) tmpValues = [];

        if (Bars != null && barsLength > 0) {
            var CHV_List = [];
            var HL_Diff_List = [];
            var HL_EMA_List = [];

            if (Period < barsLength) {
                Sleep(5);

                // Set Reference Lists
                var index = barsLength - 1;
                for (var i = index; i >= 0; i--) {
                    var bar = Bars[i];
                    var diff = bar.High - bar.Low;

                    HL_Diff_List.unshift(diff);
                }

                // Compute CHV
                var hl_index = HL_Diff_List.length - Period - 1;
                for (var i = hl_index; i >= 0; i--) {
                    var values = getDataRange(i, Period, HL_Diff_List);
                    var isFirstEMA = i == hl_index;
                    var previousValue = HL_EMA_List[0] == undefined ? null : HL_EMA_List[0];

                    var hl_ema = ComputeEMA(values, Period, null, isFirstEMA, previousValue);

                    HL_EMA_List.unshift(hl_ema);

                    if (HL_EMA_List.length > Range) {
                        var hl_current = HL_EMA_List[0];
                        var hl_range = HL_EMA_List[Range];
                        var value = hl_range == 0 ? 0 : ((hl_current - hl_range) / hl_range) * 100;

                        var chv_val = objValue(value, Bars[i].Stamp);

                        CHV_List.unshift(chv_val);
                    }
                }

                info.HL_Diff_List = HL_Diff_List;
                info.ComputedEMA = HL_EMA_List;
                info.Values = CHV_List;
            }
        }

        postMessage(info);
    }

    function GetAroonUp(i) {
        var arrHighs = getValueToCompute("High", getDataRange(i, Period, Bars));
        var highestHigh = Math.max.apply(Math, arrHighs);
        return arrHighs.indexOf(highestHigh);
    }

    function GetAroonDown(i) {
        var arrLows = getValueToCompute("Low", getDataRange(i, Period, Bars));
        var lowestLow = Math.min.apply(Math, arrLows);
        return arrLows.indexOf(lowestLow);
    }



};