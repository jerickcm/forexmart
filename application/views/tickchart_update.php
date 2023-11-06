<!DOCTYPE html >
<html>
	<head>
		<!--Style Sheet-->
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart2/ChartCSS.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart2/ChartDisplayCSS.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart2//IndicatorCSS.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart2/StyleSheet.ChartDisplayCSS.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart2/PTContextMenuCSS.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart2/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart2/spectrum.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart2/Index.css">
		<!--Plugins-->		
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/jquery-2.1.1.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/jquery-ui.js"></script>
        <script type="text/javascript">
            var first_symbol='<?php echo $symbol; ?>';
        </script>
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/knockout-3.3.0.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/jquery.mousewheel.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/accounting.js"></script>
		<!--UI Controls-->
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/dropdown.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/PTContextMenu.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/propertygrid.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/spectrum.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/symbolselector.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/ColorPicker.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/ScrollBar.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/spinner.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/UIControls/tooltip.js"></script>
		<!--Modules-->
		<script src="<?= $this->template->Js()?>tickchart2/WebChart.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/Modules/ChartDisplayJS.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/Modules/ChartScript.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/Modules/IndicatorReferenceJS.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/Modules/Worker.js"></script>
		<script src="<?= $this->template->Js()?>tickchart2/Modules/VisualToolsReference.js"></script>
		<!--DummyData-->
		<script type="text/javascript">
            var DD = DD || {};
            DD.Quotes = ko.observableArray([]);
            DD.BarsDataHolder = ko.observableArray([]);
            DD.RequestBarsData = RequestBarsData;
            DD.RequestLastBarStamp = RequestLastBarStamp;
            DD.RequestAdditionalDataForDragging = RequestAdditionalDataForDragging;
            DD.TimeFrameItems = [
                { Id: "1M", Name: "1 Minute", Value: 1 },
                { Id: "5M", Name: "5 Minutes", Value: 5 },
                { Id: "15M", Name: "15 Minutes", Value: 15 },
                { Id: "30M", Name: "30 Minutes", Value: 30 },
                { Id: "1H", Name: "1 Hour", Value: 60 },
                { Id: "4H", Name: "4 Hours", Value: 240 },
                { Id: "12H", Name: "12 Hours", Value: 720 },
                { Id: "Daily", Name: "Daily", Value: 1440 },
                { Id: "Weekly", Name: "Weekly", Value: 10080 },
                { Id: "Monthly", Name: "Monthly", Value: 43829 }
            ];
            DD.Chart = null;
            DD.StopLimitOrders = ko.observableArray([]);
            DD.OpenTrades = ko.observableArray([]);
            DD.Ticks = ko.observableArray([]);

            var QuoutesSubscribe = DD.Quotes.subscribe(function (e) {
                WC.ComObject.Trigger("IsConnected", true);
            });
            var counter = 0;

            //Classes
            function TickItem(q) {
                var self = this;

                var getValue = function (value, digits) {
                    return (Number(Math.round(value + 'e' + digits) + 'e-' + digits)).toFixed(digits);
                };

                self.QuoteID = ko.observable(q.QuoteID);
                self.Symbol = ko.observable(q.Symbol);
                self.Stamp = ko.observable(q.Stamp);
                self.Bid = ko.observable(q.Bid);
                self.Ask = ko.observable(q.Ask);
                self.Digits = ko.observable(q.Digits);

                self.AskValue = ko.computed(function () {
                    return getValue(self.Ask, self.Digits);
                }, self);
                self.BidValue = ko.computed(function () {
                    return getValue(self.Bid, self.Digits);
                }, self);
                q = null;
            }

            function Tick(symbol) {
                var self = this;

                self.Symbol = ko.observable(symbol);
                self.TickItems = ko.observableArray([]);
                self.Count = ko.pureComputed(function () {
                    return self.TickItems().length;
                });
            };

            function Quote(q) {
                var self = this;
                var getValue = function (value, digits) {
                    return (Number(Math.round(value + 'e' + digits) + 'e-' + digits)).toFixed(digits);
                };

                self.Symbol = ko.observable(q.Symbol);
                self.LongName = ko.observable(q.LongName);
                self.Stamp = ko.observable(q.Stamp);
                self.TimeStamp = ko.computed(function () {
                    var stamp = self.Stamp();
                    if (!stamp || stamp.length == 0) return "";
                    return stamp.substring(11, 16);
                });
                self.LongTimeStamp = ko.computed(function () {
                    var stamp = self.Stamp();
                    if (!stamp || stamp.length == 0) return "";
                    return stamp.substring(11, 19);
                });
                self.Bid = ko.observable(q.Bid);
                self.Ask = ko.observable(q.Ask);
                self.Digits = ko.observable(q.Digits);
                self.DepthData = ko.observable(q.DepthData);
                self.AskMovement = ko.observable(q.AskMovement);
                self.BidMovement = ko.observable(q.BidMovement);

                self.AskValue = ko.computed(function () {
                    return getValue(self.Ask(), self.Digits());
                }, self);
                self.BidValue = ko.computed(function () {
                    return getValue(self.Bid(), self.Digits());
                }, self);

                self.IsActive = ko.observable(q.IsActive);
                self.ToggleIsActive = function () {
                    self.IsActive(!self.IsActive());
                };
                self.SessionGroup = ko.observable(q.SessionGroup)
                self.IsOpen = ko.observable(q.IsOpen);
                q = null;
            }

            function OpenTrade(o) {
                var self = this;
                self.TradeId = ko.observable(o.TradeId);
                self.Symbol = ko.observable(o.Symbol);
                self.OpenQuote = ko.observable(o.OpenQuote);
                self.TradeType = ko.observable(o.TradeType);
                self.Volume = ko.observable(o.Volume);

            }

            function Order(or) {
                this.Symbol = ko.observable(or.Symbol);
                this.Rate = ko.observable(or.Rate);
                this.OrderId = ko.observable(or.OrderId);
                this.OrderType = ko.observable(or.OrderType);
                this.Volume = ko.observable(or.Volume);
            }

            //DummyData
            function GenerateQuotes() {
                if (!counter) {
                    //Initial Quotes Data
                    var  chart_quotes='<?php echo $generatequotes;?>';
                    chart_data = chart_quotes.replace(/,\s*$/, "");
                    var  qoutesobject=  JSON.parse('['+chart_data+']');
                    counter++;
                    return $.map(qoutesobject, function (item) {
                        return new Quote(item);
                    });
                }
                else {
                    //Updating Quotes
                    var qoute = JSON.parse('{"Symbol":"$Symbol$","LongName":"SymbolXXX$ (Long Name of $Symbol$)","Stamp":"2016-08-04T11:11:31","Bid":1.1138,"Ask":1.114,"Digits":4,"QuoteID":201812648,"AskMovement":"=","BidMovement":"=","IsOpen":true,"IsActive":true,"SessionGroup":"general","DepthData":null}')
                    var oQuote = new Quote(qoute);
                    DD.Quotes.push(oQuote);
                    for (var i = 0; i < DD.Quotes().length; i++) {
                        if (i == 0) {
                            DD.Quotes()[i].Ask(0.9927);
                            DD.Quotes()[i].Bid(0.9923);
                            DD.Quotes()[i].AskMovement("+");
                            DD.Quotes()[i].BidMovement("-");
                        }
                        else if (i == 1) {
                            DD.Quotes()[i].Ask(1.1134);
                            DD.Quotes()[i].Bid(1.1138);
                            DD.Quotes()[i].AskMovement("-");
                            DD.Quotes()[i].BidMovement("+");
                        }
                    }
                    counter++;
                    return DD.Quotes();
                }

            };

            function GenarateTicks() {
                var  tick='<?php echo $tick;?>';
                var objTicks = JSON.parse('[' + tick +  ']');
                var tickItems = $.map(objTicks, function (item) {
                    return new TickItem(item);
                });

                var _Tick = new Tick(first_symbol);
                _Tick.TickItems(tickItems);
                DD.Ticks.push(_Tick);
            };

            function GetQuotes() {
                DD.Quotes(GenerateQuotes());
                if (counter < 2) setTimeout(GetQuotes, 10000);
            }

            function GenerateOpenTrade() {

                var OpenTradeObj='';
                DD.OpenTrades($.map(OpenTradeObj, function (item) {
                    return new OpenTrade(item);
                }));

            };

            function GenerateTradeOrder() {

                var OrderObject='';
                DD.StopLimitOrders($.map(OrderObject, function (item) {
                    return new Order(item);
                }));
            }

            function InitializeDummyData() {
                GetQuotes();
                setTimeout(GenerateOpenTrade, 5000);
                setTimeout(GenerateTradeOrder, 5000);
                setTimeout(GenarateTicks, 3000);
                //setTimeout(TestForChartmenus, 3000);
            }

            setTimeout(InitializeDummyData, 5000);

            function TestForChartmenus() {

                DD.Chart.HideMenus();
                setTimeout(function () {
                    DD.Chart.AddIndicator("SMA", {
                        Period: 10,
                        CollectionType: "Dots",
                        LineColor: "#f6546a",
                        Shift: 2,
                        LineStyle: "Dash",
                        Width: 2
                    });
                    DD.Chart.AddIndicator("CHV", {
                        CollectionType: "Dots",
                        Color: "#7f763d",
                        Shift: 0,
                        Style: "DashDot",
                        Width: 2,
                        Period: 20,
                        Range: 20
                    });
                    DD.Chart.AddVisualTools("Text", { ForeColor: '#F3F3F2', LineWidth: 3, Font: "Arial", FontSize: 18 });
                    DD.Chart.SetChartObect(false);
                    DD.Chart.SetChartDisplay(false);
                    DD.Chart.SetVisualTools(false);
                    DD.Chart.ShowMenus();
                }, 20000);

            };

            //Constructor
            function BarsData(Symbol, TimeFrame, Data) {

                var self = this;
                self.Symbol = Symbol;
                self.TimeFrame = TimeFrame;
                self.Data = ko.observableArray(Data);
            };

            function BarData(Close, High, Low, Open, Stamp, Symbol, TimeFrame, Volume) {

                var self = this;
                self.Close = ko.observable(Close);
                self.High = ko.observable(High);
                self.Low = ko.observable(Low);
                self.Open = ko.observable(Open);
                self.Stamp = ko.observable(Stamp);
                self.Symbol = ko.observable(Symbol);
                self.TimeFrame = ko.observable(TimeFrame);
                self.Volume = ko.observable(Volume);
            };

            //Helpers
            function MapBarsData(BarsObject) {
                return $.map(BarsObject, function (item) {
                    return new BarData(item.Close, item.High, item.Low, item.Open, item.Stamp, item.Symbol, item.TimeFrame, item.Volume);
                });
            };

            //Properties Callbacks
            function RequestBarsData(Symbol, TimeFrame, NumberOfVisibleBars, FunctionToSubscribe, OHLCChart, isClear, callback) {
                var barsdata = null;

                switch (Symbol) {

                    case first_symbol:
                        break;

                    default:
                        return;
                }



                if (barsdata) {
                    DD.BarsDataHolder.push(barsdata);
                }

            }

            function RequestLastBarStamp(Symbol, TimeFrame, SetLastDateOfBars) {
                SetLastDateOfBars("2000-05-31T00:27:00");
            }

            function RequestAdditionalDataForDragging(Symbol, TimeFrame, NumberOfVisibleBars, FunctionToSubscribe, OHLCChart) {
                switch (Symbol) {

                    case first_symbol:
                        break;
                    default:
                        return;
                }
            }
        </script>
		<script type="text/javascript">
        $(function () {
            $('body').on('contextmenu', function (e) {
                e.preventDefault();
            });
            WC.Init();
        });       
		</script>
	
	</head>
	<body>
	<script type="text/javascript">
    $('#blinds').hide("slow");
	</script>

	<div id="wc-ohlc-chart" style="height: 100%; width: 100%;"></div>
	</body>
</html>