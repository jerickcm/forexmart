<script type="text/javascript">
    $(document).ready(function(){
        $("head").append('<style>.btn-partner{text-decoration:none!important}.btn-partner:hover{color:#fff!important}.fg{margin-top:30px}input[type=search]{margin-left:10px}.tab-content{color:#333!important}.ins-tabs ul li{width:calc(100%/3)}.ins-tabs ul li a.ins-active{color:#FFF!important;text-decoration:none!important}.ins-tabs ul li a:hover{color:#FFF!important;text-decoration:none!important}div.cstm_tab:hover{color:#FFF!important}@media screen and (max-width: 991px){.list_item{height:58px}.list_item:lang(bg){height:81px}}@media screen and (max-width: 541px){.list_item{height:75px}}@media screen and (max-width: 427px){.list_item{height:100px}}@media screen and (max-width: 364px){.list_item{height:120px}}@media screen and (max-width: 960px){.ins-tabs ul li{width:90%!important;float:none!important;margin:3px auto}.ins-tabs ul li a{color:#333;background:#d3edff}.ins-tabs ul li a:hover{background:#2988ca;color:#fff}.ins-tabs ul li:lang(ru){width:90%!important;float:none!important;margin:3px auto}.ins-tabs ul li a:lang(ru){color:#333;background:#d3edff}.ins-tabs ul li a:hover:lang(ru){background:#2988ca;color:#fff}.ins-tabs ul li:lang(jp){width:90%!important;float:none!important;margin:3px auto}.ins-tabs ul li a:lang(jp){color:#333;background:#d3edff}.ins-tabs ul li a:hover:lang(jp){background:#2988ca;color:#fff}.ins-tabs ul li:lang(id){width:90%!important;float:none!important;margin:3px auto}.ins-tabs ul li a:lang(id){color:#333;background:#d3edff}.ins-tabs ul li a:hover:lang(id){background:#2988ca;color:#fff}.ins-tabs ul li:lang(de){width:90%!important;float:none!important;margin:3px auto}.ins-tabs ul li a:lang(de){color:#333;background:#d3edff}.ins-tabs ul li a:hover:lang(de){background:#2988ca;color:#fff}.ins-tabs ul li:lang(fr){width:90%!important;float:none!important;margin:3px auto}.ins-tabs ul li a:lang(fr){color:#333;background:#d3edff}.ins-tabs ul li a:hover:lang(fr){background:#2988ca;color:#fff}.ins-tabs ul li:lang(it){width:90%!important;float:none!important;margin:3px auto}.ins-tabs ul li a:lang(it){color:#333;background:#d3edff}.ins-tabs ul li a:hover:lang(it){background:#2988ca;color:#fff}.ins-tabs ul li:lang(sa){width:90%!important;float:none!important;margin:3px auto}.ins-tabs ul li a:lang(sa){color:#333;background:#d3edff}.ins-tabs ul li a:hover:lang(sa){background:#2988ca;color:#fff}.ins-tabs ul li:lang(es){width:90%!important;float:none!important;margin:3px auto}.ins-tabs ul li a:lang(es){color:#333;background:#d3edff}.ins-tabs ul li a:hover:lang(es){background:#2988ca;color:#fff}.ins-tabs ul li:lang(pt){width:90%!important;float:none!important;margin:3px auto}.ins-tabs ul li a:lang(pt){color:#333;background:#d3edff}.ins-tabs ul li a:hover:lang(pt){background:#2988ca;color:#fff}.ins-tabs ul li:lang(bg){width:90%!important;float:none!important;margin:3px auto}.ins-tabs ul li a:lang(bg){color:#333;background:#d3edff}.ins-tabs ul li a:hover:lang(bg){background:#2988ca;color:#fff}.list_item:lang(bg){height:58px}.ins-tabs ul li:lang(my){width:90%!important;float:none!important;margin:3px auto}.ins-tabs ul li a:lang(my){color:#333;background:#d3edff}.ins-tabs ul li a:hover:lang(my){background:#2988ca;color:#fff}}@media screen and (max-width: 1210px){.ins-tabs ul li:lang(jp){width:90%!important;float:none!important;margin:3px auto}.ins-tabs ul li a:lang(jp){color:#333;background:#d3edff}.ins-tabs ul li a:hover:lang(jp){background:#2988ca;color:#fff}}.comm-text2{margin-top:25px!important}@media screen and (max-width: 830px){.div1{width:23%;float:left}.div2{width:71%;float:left}}@media screen and (max-width: 991px){.ext-arabic-license-title:lang(sa){text-align:right!important}}.div1:lang(sa){float:right!important;}</style>');
    });
</script>
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title ext-arabic-license-title">
                <?=lang('x_cs_h');?>
                </h1>
                <div class="mt4-desk-holder">
                    <div class="div1 col-md-2 col-sm-2 mt4-img-holder ext-arabic-mt4-image-holder">
                        <img src="<?= $this->template->Images()?>/comm-img.png" class="img-responsive" alt="" />
                    </div>
                    <div class="div2 col-md-10 col-sm-10 ext-arabic-comm-text-parent">
                        <p class="comm-text2 comm-text">
                            <?=lang('x_cs_p0-0');?>
                            <br/><br/>
                            <?=lang('x_cs_p0-1');?>
                        </p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="ins-tab-holder ext-arabic-ins-tabs ext-arabic-ins-tabs-second">
                    <div class="ins-tabs ext-arabic-ins-tabs ext-arabic-ins-tabs-second">
                        <ul id="nav-comission" role="tablist">

                            <li role="presentation">
                                <a href="#forex" aria-controls="forex" role="tab" data-toggle="tab" id="fo" class=" list_item">
                                    <div class="cstm_tab">
                                    <?=lang('x_cs_li-a0');?>
                                    </div>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#spot" aria-controls="spot" role="tab" data-toggle="tab" id="sp" class=" list_item">
                                    <div class="cstm_tab">
                                    <?=lang('x_cs_li-a1');?>
                                        </div>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#futures" aria-controls="futures" role="tab" data-toggle="tab" id="fu" class=" list_item">
                                    <div class="cstm_tab">
                                    <?=lang('x_cs_li-a2');?>
                                        </div>
                                </a>
                            </li>

                        </ul>
                        <div class="clearfix">

                        </div>
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane" id="forex">

                            <div class="table-responsive ext-arabic-table-responsive-border">
                                <table id="forexTable" class="table table-bordered ins-table ext-arabic-ins-table">
                                    <thead>
                                    <tr>
                                        <td rowspan="2" class="rowspan">
                                            <?=lang('x_cs_inc0');?>
                                        </td>
                                        <td colspan="2">
                                            <?=lang('x_cs_inc1');?>

                                        </td>
                                        <td colspan="2">
                                            <?=lang('x_cs_inc2');?>
                                        </td>
                                        <td rowspan="2">
                                            <?php if(IPLoc::isChinaIP() || FXPP::html_url() == 'zh'){ ?>
                                                <?=lang('x_cs_inc3');?>
                                            <?php } else { ?>
                                                <?=lang('x_cs_inc3');?> [4]
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?=lang('x_cs_inc4');?>
                                        </td>
                                        <td>
                                            <?=lang('x_cs_inc5');?>
                                        </td>
                                        <td>
                                            <?=lang('x_cs_inc4');?>
                                        </td>
                                        <td>
                                            <?=lang('x_cs_inc5');?> [2]
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(IPLoc::isChinaIP() || FXPP::html_url() == 'zh'){ ?>
                                        <tr><td>EUR/USD</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1</td></tr>
                                        <tr><td>GBP/USD</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1</td></tr>
                                        <tr><td>USD/JPY</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1</td></tr>
                                        <tr><td>USD/CHF</td><td>2 [1]</td><td>0</td><td>0[3]</td><td>2</td><td>1</td></tr>
                                        <tr><td>USD/CAD</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1</td></tr>
                                        <tr><td>AUD/USD</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1</td></tr>
                                        <tr><td>NZD/USD</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1</td></tr>
                                        <tr><td>EUR/JPY</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1</td></tr>
                                        <tr><td>EUR/CHF </td><td>2 [1]</td><td>0</td><td>0[3]</td><td>2</td><td>1</td></tr>
                                        <tr><td>EUR/GBP</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1</td></tr>
                                        <tr><td>AUD/CAD</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>AUD/CHF</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>AUD/JPY</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>CAD/CHF</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>CAD/JPY</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>CHF/JPY</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>NZD/CAD</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>NZD/CHF</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>NZD/JPY</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>EUR/AUD</td><td>6</td><td>0</td><td>0</td><td>6</td><td>1</td></tr>
                                        <tr><td>GBP/CHF</td><td>6 [1]</td><td>0</td><td>0[3]</td><td>6</td><td>1</td></tr>
                                        <tr><td>GBP/JPY</td><td>6</td><td>0</td><td>0</td><td>6</td><td>1</td></tr>
                                        <tr><td>AUD/NZD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>EUR/CAD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>EUR/NZD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>GBP/AUD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>GBP/CAD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>GBP/NZD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>USD/DKK</td><td>45</td><td>0</td><td>45</td><td>0</td><td>1</td></tr>
                                        <tr><td>USD/NOK</td><td>100</td><td>0</td><td>100</td><td>0</td><td>1</td></tr>
                                        <tr><td>USD/SEK</td><td>60</td><td>0</td><td>60</td><td>0</td><td>1</td></tr>
                                        <tr><td>USD/ZAR</td><td>110</td><td>0</td><td>110</td><td>0</td><td>1</td></tr>
                                        <tr><td>AUD/CZK</td><td>18</td><td>0</td><td>18</td><td>0</td><td>1</td></tr>
                                        <tr><td>AUD/DKK</td><td>50</td><td>0</td><td>50</td><td>0</td><td>1</td></tr>
                                        <tr><td>AUD/HKD</td><td>70</td><td>0</td><td>70</td><td>0</td><td>1</td></tr>
                                        <tr><td>AUD/HUF</td><td>25</td><td>0</td><td>25</td><td>0</td><td>1</td></tr>
                                        <tr><td>AUD/MXN</td><td>110</td><td>0</td><td>110</td><td>0</td><td>1</td></tr>
                                        <tr><td>AUD/NOK</td><td>60</td><td>0</td><td>60</td><td>0</td><td>1</td></tr>
                                        <tr><td>AUD/PLN</td><td>35</td><td>0</td><td>35</td><td>0</td><td>1</td></tr>
                                        <tr><td>AUD/SEK</td><td>40</td><td>0</td><td>40</td><td>0</td><td>1</td></tr>
                                        <tr><td>AUD/SGD</td><td>8</td><td>0</td><td>8</td><td>0</td><td>1</td></tr>
                                        <tr><td>AUD/ZAR</td><td>160</td><td>0</td><td>160</td><td>0</td><td>1</td></tr>
                                        <tr><td>CAD/CZK</td><td>18</td><td>0</td><td>18</td><td>0</td><td>1</td></tr>
                                        <tr><td>CAD/DKK</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1</td></tr>
                                        <tr><td>CAD/HKD</td><td>90</td><td>0</td><td>90</td><td>0</td><td>1</td></tr>
                                        <tr><td>CAD/HUF</td><td>18</td><td>0</td><td>18</td><td>0</td><td>1</td></tr>
                                        <tr><td>CAD/MXN</td><td>130</td><td>0</td><td>130</td><td>0</td><td>1</td></tr>
                                        <tr><td>CAD/NOK</td><td>50</td><td>0</td><td>50</td><td>0</td><td>1</td></tr>
                                        <tr><td>CAD/PLN</td><td>20</td><td>0</td><td>20</td><td>0</td><td>1</td></tr>
                                        <tr><td>CAD/SEK</td><td>40</td><td>0</td><td>40</td><td>0</td><td>1</td></tr>
                                        <tr><td>CAD/SGD</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1</td></tr>
                                        <tr><td>CAD/ZAR</td><td>180</td><td>0</td><td>180</td><td>0</td><td>1</td></tr>
                                        <tr><td>CHF/CZK</td><td>18</td><td>0</td><td>18</td><td>0</td><td>1</td></tr>
                                        <tr><td>CHF/DKK</td><td>8</td><td>0</td><td>8</td><td>0</td><td>1</td></tr>
                                        <tr><td>CHF/HKD</td><td>90</td><td>0</td><td>90</td><td>0</td><td>1</td></tr>
                                        <tr><td>CHF/HUF</td><td>40</td><td>0</td><td>40</td><td>0</td><td>1</td></tr>
                                        <tr><td>CHF/MXN</td><td>180</td><td>0</td><td>180</td><td>0</td><td>1</td></tr>
                                        <tr><td>CHF/NOK</td><td>90</td><td>0</td><td>90</td><td>0</td><td>1</td></tr>
                                        <tr><td>CHF/PLN</td><td>35</td><td>0</td><td>35</td><td>0</td><td>1</td></tr>
                                        <tr><td>CHF/SEK</td><td>50</td><td>0</td><td>50</td><td>0</td><td>1</td></tr>
                                        <tr><td>CHF/SGD</td><td>13</td><td>0</td><td>13</td><td>0</td><td>1</td></tr>
                                        <tr><td>CHF/ZAR</td><td>160</td><td>0</td><td>160</td><td>0</td><td>1</td></tr>
                                        <tr><td>EUR/CZK</td><td>40</td><td>0</td><td>40</td><td>0</td><td>1</td></tr>
                                        <tr><td>EUR/DKK</td><td>13</td><td>0</td><td>13</td><td>0</td><td>1</td></tr>
                                        <tr><td>EUR/HKD</td><td>120</td><td>0</td><td>120</td><td>0</td><td>1</td></tr>
                                        <tr><td>EUR/HUF</td><td>75</td><td>0</td><td>75</td><td>0</td><td>1</td></tr>
                                        <tr><td>EUR/MXN</td><td>220</td><td>0</td><td>220</td><td>0</td><td>1</td></tr>
                                        <tr><td>EUR/NOK</td><td>130</td><td>0</td><td>130</td><td>0</td><td>1</td></tr>
                                        <tr><td>EUR/PLN</td><td>35</td><td>0</td><td>35</td><td>0</td><td>1</td></tr>
                                        <tr><td>EUR/SEK</td><td>55</td><td>0</td><td>55</td><td>0</td><td>1</td></tr>
                                        <tr><td>EUR/SGD</td><td>20</td><td>0</td><td>20</td><td>0</td><td>1</td></tr>
                                        <tr><td>EUR/ZAR</td><td>220</td><td>0</td><td>220</td><td>0</td><td>1</td></tr>
                                        <tr><td>GBP/CZK</td><td>25</td><td>0</td><td>25</td><td>0</td><td>1</td></tr>
                                        <tr><td>GBP/DKK</td><td>13</td><td>0</td><td>13</td><td>0</td><td>1</td></tr>
                                        <tr><td>GBP/HKD</td><td>130</td><td>0</td><td>130</td><td>0</td><td>1</td></tr>
                                        <tr><td>GBP/HUF</td><td>50</td><td>0</td><td>50</td><td>0</td><td>1</td></tr>
                                        <tr><td>GBP/MXN</td><td>180</td><td>0</td><td>180</td><td>0</td><td>1</td></tr>
                                        <tr><td>GBP/NOK</td><td>130</td><td>0</td><td>130</td><td>0</td><td>1</td></tr>
                                        <tr><td>GB/PLN</td><td>25</td><td>0</td><td>25</td><td>0</td><td>1</td></tr>
                                        <tr><td>GBP/SEK</td><td>110</td><td>0</td><td>110</td><td>0</td><td>1</td></tr>
                                        <tr><td>GBP/SGD</td><td>20</td><td>0</td><td>20</td><td>0</td><td>1</td></tr>
                                        <tr><td>GBP/ZAR</td><td>320</td><td>0</td><td>320</td><td>0</td><td>1</td></tr>
                                        <tr><td>NZD/CZK</td><td>13</td><td>0</td><td>13</td><td>0</td><td>1</td></tr>
                                        <tr><td>NZD/DKK</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1</td></tr>
                                        <tr><td>NZD/HKD</td><td>50</td><td>0</td><td>50</td><td>0</td><td>1</td></tr>
                                        <tr><td>NZD/HUF</td><td>30</td><td>0</td><td>30</td><td>0</td><td>1</td></tr>
                                        <tr><td>NZD/MXN</td><td>70</td><td>0</td><td>70</td><td>0</td><td>1</td></tr>
                                        <tr><td>NZD/NOK</td><td>40</td><td>0</td><td>40</td><td>0</td><td>1</td></tr>
                                        <tr><td>NZD/PLN</td><td>15</td><td>0</td><td>15</td><td>0</td><td>1</td></tr>
                                        <tr><td>NZD/SEK</td><td>70</td><td>0</td><td>70</td><td>0</td><td>1</td></tr>
                                        <tr><td>NZD/SGD</td><td>13</td><td>0</td><td>13</td><td>0</td><td>1</td></tr>
                                        <tr><td>NZD/ZAR</td><td>40</td><td>0</td><td>40</td><td>0</td><td>1</td></tr>
                                        <tr><td>USD/CZK</td><td>25</td><td>0</td><td>25</td><td>0</td><td>1</td></tr>
                                        <tr><td>USD/HKD</td><td>5</td><td>0</td><td>5</td><td>0</td><td>1</td></tr>
                                        <tr><td>USD/HUF</td><td>50</td><td>0</td><td>50</td><td>0</td><td>1</td></tr>
                                        <tr><td>USD/MXN</td><td>10</td><td>0</td><td>10</td><td>0</td><td>1</td></tr>
                                        <tr><td>USD/SGD</td><td>8</td><td>0</td><td>8</td><td>0</td><td>1</td></tr>
                                        <tr><td>USD/PLN</td><td>20</td><td>0</td><td>20</td><td>0</td><td>1</td></tr>
                                        <tr><td>CZK/JPY</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1</td></tr>
                                        <tr><td>DKK/JPY</td><td>2</td><td>0</td><td>2</td><td>0</td><td>1</td></tr>
                                        <tr><td>HKD/JPY</td><td>2</td><td>0</td><td>2</td><td>0</td><td>1</td></tr>
                                        <tr><td>HUF/JPY</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1</td></tr>
                                        <tr><td>MXN/JPY</td><td>2</td><td>0</td><td>2</td><td>0</td><td>1</td></tr>
                                        <tr><td>NOK/JPY</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1</td></tr>
                                        <tr><td>SGD/JPY</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1</td></tr>
                                        <tr><td>SEK/JPY</td><td>2</td><td>0</td><td>2</td><td>0</td><td>1</td></tr>
                                        <tr><td>ZAR/JPY</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1</td></tr>
                                        <tr><td>USD/RUR</td><td>400</td><td>0</td><td>400</td><td>0</td><td>1</td></tr>
                                        <tr><td>EUR/RUR</td><td>450</td><td>0</td><td>450</td><td>0</td><td>1</td></tr>
                                    <?php } else { ?>
                                        <tr><td>EUR/USD</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>GBP/USD</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>USD/JPY</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>USD/CHF</td><td>2 [1]</td><td>0</td><td>0[3]</td><td>2</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>USD/CAD</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>AUD/USD</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>NZD/USD</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/JPY</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/CHF </td><td>2 [1]</td><td>0</td><td>0[3]</td><td>2</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/GBP</td><td>2</td><td>0</td><td>0</td><td>2</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>AUD/CAD</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>AUD/CHF</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>AUD/JPY</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>CAD/CHF</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>CAD/JPY</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>CHF/JPY</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>NZD/CAD</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>NZD/CHF</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>NZD/JPY</td><td>8</td><td>0</td><td>0</td><td>8</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>EUR/AUD</td><td>6</td><td>0</td><td>0</td><td>6</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>GBP/CHF</td><td>6 [1]</td><td>0</td><td>0[3]</td><td>6</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>GBP/JPY</td><td>6</td><td>0</td><td>0</td><td>6</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>AUD/NZD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>EUR/CAD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>EUR/NZD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>GBP/AUD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>GBP/CAD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>GBP/NZD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>2 - 3.5 pips</td></tr>
                                        <tr><td>USD/DKK</td><td>45</td><td>0</td><td>45</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>USD/NOK</td><td>100</td><td>0</td><td>100</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>USD/SEK</td><td>60</td><td>0</td><td>60</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>USD/ZAR</td><td>110</td><td>0</td><td>110</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>AUD/CZK</td><td>18</td><td>0</td><td>18</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>AUD/DKK</td><td>50</td><td>0</td><td>50</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>AUD/HKD</td><td>70</td><td>0</td><td>70</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>AUD/HUF</td><td>25</td><td>0</td><td>25</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>AUD/MXN</td><td>110</td><td>0</td><td>110</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>AUD/NOK</td><td>60</td><td>0</td><td>60</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>AUD/PLN</td><td>35</td><td>0</td><td>35</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>AUD/SEK</td><td>40</td><td>0</td><td>40</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>AUD/SGD</td><td>8</td><td>0</td><td>8</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>AUD/ZAR</td><td>160</td><td>0</td><td>160</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CAD/CZK</td><td>18</td><td>0</td><td>18</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CAD/DKK</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CAD/HKD</td><td>90</td><td>0</td><td>90</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CAD/HUF</td><td>18</td><td>0</td><td>18</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CAD/MXN</td><td>130</td><td>0</td><td>130</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CAD/NOK</td><td>50</td><td>0</td><td>50</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CAD/PLN</td><td>20</td><td>0</td><td>20</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CAD/SEK</td><td>40</td><td>0</td><td>40</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CAD/SGD</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CAD/ZAR</td><td>180</td><td>0</td><td>180</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CHF/CZK</td><td>18</td><td>0</td><td>18</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CHF/DKK</td><td>8</td><td>0</td><td>8</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CHF/HKD</td><td>90</td><td>0</td><td>90</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CHF/HUF</td><td>40</td><td>0</td><td>40</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CHF/MXN</td><td>180</td><td>0</td><td>180</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CHF/NOK</td><td>90</td><td>0</td><td>90</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CHF/PLN</td><td>35</td><td>0</td><td>35</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CHF/SEK</td><td>50</td><td>0</td><td>50</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CHF/SGD</td><td>13</td><td>0</td><td>13</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CHF/ZAR</td><td>160</td><td>0</td><td>160</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/CZK</td><td>40</td><td>0</td><td>40</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/DKK</td><td>13</td><td>0</td><td>13</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/HKD</td><td>120</td><td>0</td><td>120</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/HUF</td><td>75</td><td>0</td><td>75</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/MXN</td><td>220</td><td>0</td><td>220</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/NOK</td><td>130</td><td>0</td><td>130</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/PLN</td><td>35</td><td>0</td><td>35</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/SEK</td><td>55</td><td>0</td><td>55</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/SGD</td><td>20</td><td>0</td><td>20</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/ZAR</td><td>220</td><td>0</td><td>220</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>GBP/CZK</td><td>25</td><td>0</td><td>25</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>GBP/DKK</td><td>13</td><td>0</td><td>13</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>GBP/HKD</td><td>130</td><td>0</td><td>130</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>GBP/HUF</td><td>50</td><td>0</td><td>50</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>GBP/MXN</td><td>180</td><td>0</td><td>180</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>GBP/NOK</td><td>130</td><td>0</td><td>130</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>GB/PLN</td><td>25</td><td>0</td><td>25</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>GBP/SEK</td><td>110</td><td>0</td><td>110</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>GBP/SGD</td><td>20</td><td>0</td><td>20</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>GBP/ZAR</td><td>320</td><td>0</td><td>320</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>NZD/CZK</td><td>13</td><td>0</td><td>13</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>NZD/DKK</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>NZD/HKD</td><td>50</td><td>0</td><td>50</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>NZD/HUF</td><td>30</td><td>0</td><td>30</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>NZD/MXN</td><td>70</td><td>0</td><td>70</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>NZD/NOK</td><td>40</td><td>0</td><td>40</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>NZD/PLN</td><td>15</td><td>0</td><td>15</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>NZD/SEK</td><td>70</td><td>0</td><td>70</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>NZD/SGD</td><td>13</td><td>0</td><td>13</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>NZD/ZAR</td><td>40</td><td>0</td><td>40</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>USD/CZK</td><td>25</td><td>0</td><td>25</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>USD/HKD</td><td>5</td><td>0</td><td>5</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>USD/HUF</td><td>50</td><td>0</td><td>50</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>USD/MXN</td><td>10</td><td>0</td><td>10</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>USD/SGD</td><td>8</td><td>0</td><td>8</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>USD/PLN</td><td>20</td><td>0</td><td>20</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>CZK/JPY</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>DKK/JPY</td><td>2</td><td>0</td><td>2</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>HKD/JPY</td><td>2</td><td>0</td><td>2</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>HUF/JPY</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>MXN/JPY</td><td>2</td><td>0</td><td>2</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>NOK/JPY</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>SGD/JPY</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>SEK/JPY</td><td>2</td><td>0</td><td>2</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>ZAR/JPY</td><td>4</td><td>0</td><td>4</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>USD/RUR</td><td>400</td><td>0</td><td>400</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                        <tr><td>EUR/RUR</td><td>450</td><td>0</td><td>450</td><td>0</td><td>1 - 1.3 pips</td></tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <p class="ins-text-sub ext-arabic-inst-text-sub note-text">
                                <?php if(IPLoc::isChinaIP() || FXPP::html_url() == 'zh'){ ?>
                                    <span class="legend">[1]</span> - <?=lang('x_cs_lg0-0');?> <br>
                                    <span class="legend">[2]</span> - <?=lang('x_cs_lg0-1');?><br>
                                    <span class="legend">[3]</span> - <?=lang('x_cs_lg0-2');?>
                                <?php } else { ?>
                                    <span class="legend">[1]</span> - <?=lang('x_cs_lg0-0');?> <br>
                                    <span class="legend">[2]</span> - <?=lang('x_cs_lg0-1');?><br>
                                    <span class="legend">[3]</span> - <?=lang('x_cs_lg0-2');?><br>
                                    <span class="legend">[4]</span> - <?=lang('x_cs_lg0-3');?>
                                <?php } ?>
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="spot">

                            <div class="table-responsive ext-arabic-table-responsive-border">
                                <table id="sharesTable" class="table table-bordered ins-table ext-arabic-ins-table">
                                    <thead>
                                    <tr>
                                        <td>
                                            <?=lang('x_cs_inc7');?>

                                        </td>
                                        <td>
                                            <?=lang('x_cs_inc8');?>
                                        </td>
                                        <td>
                                            <?=lang('x_cs_inc9');?> [1]
                                        </td>
                                        <td>
                                            <?=lang('x_cs_inc10');?>
                                        </td>
                                        <td>
                                            <?=lang('x_cs_inc13');?> [3]
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>#AA Alcoa, Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#AAL ANGLO AMERICAN PLC</td><td>100 shares</td><td>1.00[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#AAPL Apple Inc.</td><td>100 shares</td><td>0.152[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#AIG American International Group, Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#AMZN Amazon.com Inc.</td><td>100 shares</td><td>0.12[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#AXP American Express</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#BA Boeing</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#BABA Alibaba Group Inc.</td><td>100 shares</td><td>0.05[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#BAC Bank of America</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#BARC Barclays PLC</td><td>100 shares</td><td>0.20[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#BLT BHP BILLITON PLC</td><td>100 shares</td><td>1.00[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#BP BP PLC</td><td>100 shares</td><td>0.25[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#BTA BT Group PLC</td><td>100 shares</td><td>0.20[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#C Citigroup, Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#CAT Caterpillar, Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#CSCO Cisco Systems, Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#CVX Chevron Corporation</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#DD DuPont</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#DIS Walt Disney</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#EBAY eBay Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#FB Facebook Inc.</td><td>100 shares</td><td>0.05</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#GEN General Electric</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#GOOG Google Inc.</td><td>100 shares</td><td>0.22[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#GS Goldman Sachs Group, Inc.</td><td>100 shares</td><td>0.06[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#GSK GlaxoSmithKline PLC</td><td>100 shares</td><td>1.00[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#HD Home Depot, Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#HPQ Hewlett Packard Co.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#HSBA HSBC Holdings PLC</td><td>100 shares</td><td>0.20[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#IBM IBM</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#INTC Intel Corporation</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#JNJ Johnson &amp; Johnson</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#JPM JPMorgan Chase &amp; Co.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#KO Coca-Cola</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#LLOY LLOYDS BANKING GROUP PLC</td><td>100 shares</td><td>0.10[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#LNKD LinkedIn Corporation</td><td>100 shares</td><td>0.15[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#MCD McDonald's Corporation</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#MMM 3M</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#MRK Merck &amp; Co, Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#MSFT Microsoft Corporation</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#ORCL Oracle Corp.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#PFE Pfizer, Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#PG Procter &amp; Gamble Co.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#T AT&amp;T, Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#TRV Travelers Companies, Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#TSCO TESCO PLC</td><td>100 shares</td><td>0.40[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#TWTR Twitter Inc.</td><td>100 shares</td><td>0.06[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#UTX United Technologies Corporation</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#VOD VODAFONE GROUP PLC</td><td>100 shares</td><td>0.20[2]</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#VZ Verizon Communications, Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#WFC Wells Fargo &amp; Co</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#WMT Wal-Mart Stores, Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#XOM Exxon Mobil Corporation</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                        <tr><td>#YHOO Yahoo, Inc.</td><td>100 shares</td><td>0.03</td><td>0.10%</td><td>$1</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="ins-text-sub ext-arabic-inst-text-sub note-text">
                                <span class="legend">[1]</span> - <?=lang('x_cs_lg1-0');?><br>
                                <span class="legend">[2]</span> - <?=lang('x_cs_lg1-1');?><br>
                                <span class="legend">[3]</span> - <?=lang('x_cs_lg1-2');?><br>
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="futures">
                            <div class="table-responsive ext-arabic-table-responsive-border">
                                <table id="metalsTable" class="table table-bordered ins-table ext-arabic-ins-table">
                                    <thead>
                                    <tr>
                                        <td>
                                            <?=lang('x_cs_inc7')?>
                                        </td>
                                        <td>
                                            <?=lang('x_cs_inc8')?>
                                        </td>
                                        <td>
                                            <?=lang('x_cs_inc4')?>
                                        </td>
                                        <td>
                                            <?=lang('x_cs_inc5')?>
                                        </td>
                                        <td>
                                            <?=lang('x_cs_inc3')?> [*]
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(IPLoc::isChinaIP() || FXPP::html_url() == 'zh'){?>
                                        <tr><td>GOLD</td><td>100 ounces</td><td>60</td><td>0</td><td>20</td></tr>
                                        <tr><td>SILVER</td><td>500 ounces</td><td>40</td><td>0</td><td>20</td></tr>
                                        <tr><td>XAUUSD</td><td>500 ounces</td><td>60</td><td>0</td><td>20</td></tr>
                                    <?php } else { ?>
                                        <tr><td>GOLD</td><td>100 ounces</td><td>60</td><td>0</td><td>20 - 26 pips</td></tr>
                                        <tr><td>SILVER</td><td>500 ounces</td><td>40</td><td>0</td><td>20 - 26 pips</td></tr>
                                        <tr><td>XAUUSD</td><td>500 ounces</td><td>60</td><td>0</td><td>20 - 26 pips</td></tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <p class="ins-text-sub ext-arabic-inst-text-sub note-text">
                                <?php if(IPLoc::isChinaIP() || FXPP::html_url() == 'zh'){?>

                                <?php } else {?>
                                    * - <?=lang('x_cs_lg2-0');?>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="comm-sub-holder">
                    <h1 class="comm-sub"><?=lang('x_cs_h-0');?></h1>
                    <div class="form-group fg">
                        <a href="<?= FXPP::loc_url('partnership/friend-referrer')?>" class=" btn-partner">
                            <?= lang('x_cs_a0-1');?>
                        </a>
                    </div>
                </div>
                <?= $DemoAndLiveLinks?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js" ></script>
<script>
    $(document).ready(function() {
        var language = "<?=FXPP::html_url()?>";
        var dom_tbl='<"row ins-filter"<"col-sm-6"<"form-inline"f>>>';
        language = language.replace(/\s/g, '');
        if (language=='sa'){
            dom_tbl='<"row ins-filter"<"col-sm-12"<"form-inline"f>>>';
        }
        $("#sp").click(function(){
            $("#fo, #fu").removeClass("ins-active");
            if($(this).hasClass('ins-active')){
                $("#sp").removeClass("ins-active");
                $("#spot").removeClass("active");
                $('#nav-commission li.active').removeClass("active");
                $("#blank_tab").addClass("active");
                $(this).blur();
            }else {
                $("#sp").addClass("ins-active");
                $("#spot").addClass("active");
                $(this).focus();
            }
        });

        $("#fu").click(function(){
            $("#sp, #fo").removeClass("ins-active");
            if($(this).hasClass('ins-active')){
                $("#fu").removeClass("ins-active");
                $("#futures").removeClass("active");
                $('#nav-commission li.active').removeClass("active");
                $("#blank_tab").addClass("active");
                $(this).blur();
            }else {
                $("#fu").addClass("ins-active");
                $("#futures").addClass("active");
                $(this).focus();
            }
        });

        $("#fo").click(function(){
            $("#fu, #sp").removeClass("ins-active");
            if($(this).hasClass('ins-active')){
                $("#fo").removeClass("ins-active");
                $("#forex").removeClass("active");
                $('#nav-commission li.active').removeClass("active");
                $("#blank_tab").addClass("active");
                $(this).blur();
            }else {
                $("#fo").addClass("ins-active");
                $("#forex").addClass("active");
                $(this).focus();
            }
        });

        $('#forexTable').DataTable({
            paging: false,
            "bSort": false,
            "ordering": false,
            "info":     false,
            dom: dom_tbl,
            language: {
                search: "<?=lang('search');?>:",
                lengthMenu: "<?=lang('show_entries');?>"
            }
            //search: '<div class="row ins-filter"><div class="col-sm-6 "><form class="form-inline"><div class="form-group"><label class="ins-search-text" for="">Search:</label>fl</div></form></div><div class="col-sm-6 chk-ins ins-search"><label><input type="checkbox"> Show major only</label></div></div>'
        });

        $('#forexTable_filter').addClass('form-group');
        $('#forexTable_filter label').addClass('ins-search-text');
        $('#forexTable_filter input').addClass('form-control round-0');

        $('#sharesTable').DataTable({
            paging: false,
            "bSort": false,
            "ordering": false,
            "info":     false,
            dom: dom_tbl,
            language: {
                search: "<?=lang('search');?>:",
                lengthMenu: "<?=lang('show_entries');?>"
            }
            //search: '<div class="row ins-filter"><div class="col-sm-6 "><form class="form-inline"><div class="form-group"><label class="ins-search-text" for="">Search:</label>fl</div></form></div><div class="col-sm-6 chk-ins ins-search"><label><input type="checkbox"> Show major only</label></div></div>'
        });

        $('#sharesTable_filter').addClass('form-group');
        $('#sharesTable_filter label').addClass('ins-search-text');
        $('#sharesTable_filter input').addClass('form-control round-0');

        $('#metalsTable').DataTable({
            paging: false,
            "bSort": false,
            "ordering": false,
            "info":     false,
            dom: dom_tbl,
            language: {
                search: "<?=lang('search');?>:",
                lengthMenu: "<?=lang('show_entries');?>"
            }
            //search: '<div class="row ins-filter"><div class="col-sm-6 "><form class="form-inline"><div class="form-group"><label class="ins-search-text" for="">Search:</label>fl</div></form></div><div class="col-sm-6 chk-ins ins-search"><label><input type="checkbox"> Show major only</label></div></div>'
        });

        $('#metalsTable_filter').addClass('form-group');
        $('#metalsTable_filter label').addClass('ins-search-text');
        $('#metalsTable_filter input').addClass('form-control round-0');

    });
    var language = '<?=FXPP::html_url(); ?>';
    $(window).load(function() {

        if (window.innerWidth>952) {

            $('#fu').height($('#sp').height());
            $('#fo').height($('#sp').height());
        }else if ((window.innerWidth<382) && (language=='ru' || language=='bg' || language=='es'))  {
            $('#fu').height(40);
            $('#fo').height(40);
            $('#sp').height(75);
        }else{

            $('#fu').height(40);
            $('#sp').height(40);
            $('#fo').height(40);
        }
    });
    $(window).resize(function() {

        if (window.innerWidth>952){
            $('#fu').height($('#sp').height());
            $('#fo').height($('#sp').height());
        }else if ((window.innerWidth<382) && (language=='ru' || language=='bg' || language=='es'))  {

            $('#sp').height(75);

        }else{
            $('#fu').height(40);
            $('#sp').height(40);
            $('#fo').height(40);
        }
    });
$(document).ready(function() {//forexTable_wrapper//$('.dataTables_wrapper').addClass('ext-arabic-search-form-inline');
});
</script>