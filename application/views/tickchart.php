<!DOCTYPE html >
<html>
	<head>
		<!--Style Sheet-->		
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart/ChartCSS.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart/ChartDisplayCSS.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart/IndicatorCSS.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart/StyleSheet.ChartDisplayCSS.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart/PTContextMenuCSS.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart/spectrum.css">
		<link rel="stylesheet" type="text/css" href="<?= $this->template->Css()?>tickchart/Index.css">
		<!--Plugins-->		
		<script src="<?= $this->template->Js()?>tickchart/UIControls/jquery-2.1.1.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/UIControls/jquery-ui.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/UIControls/knockout-3.3.0.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/UIControls/jquery.mousewheel.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/UIControls/accounting.js"></script>
		<!--UI Controls-->
		<script src="<?= $this->template->Js()?>tickchart/UIControls/dropdown.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/UIControls/PTContextMenu.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/UIControls/propertygrid.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/UIControls/spectrum.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/UIControls/symbolselector.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/UIControls/ColorPicker.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/UIControls/ScrollBar.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/UIControls/spinner.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/UIControls/tooltip.js"></script>
		<!--Modules-->
		<script src="<?= $this->template->Js()?>tickchart/WebChart.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/Modules/ChartDisplayJS.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/Modules/ChartScript.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/Modules/IndicatorReferenceJS.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/Modules/Worker.js"></script>
		<script src="<?= $this->template->Js()?>tickchart/Modules/VisualToolsReference.js"></script>
		<!--DummyData-->
		<script src="<?= $this->template->Js()?>tickchart/DummyData.js"></script>
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