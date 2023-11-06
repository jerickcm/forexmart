
<div class="reg-form-holder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="license-title ext-arabic-license-title">
                    <?=lang('f_h_0');?>
                </h1>
                <p class="ins-text ext-arabic-ins-text">
                    <?=lang('f_p_0');?>
                </p>

                <div class="ins-tab-holder">
                    <div class="instrument-tabs ">
                        <ul role="tablist">
                            <li role="presentation">

                                <a href="<?=FXPP::loc_url('financial-instruments/forex')?>" class="sa-right <?='bw '; ?> <?php echo ($instruments_tab_active == 'forex') ? ' ins-active ' : ''; ?>" aria-controls="forex" role="tab" id="fo">
                                    <?=lang('f_dulli_0');?>
                                </a></li>
                            <li role="presentation">
                                <a href="<?=FXPP::loc_url('financial-instruments/shares')?>" class="sa-right <?='bw '; ?><?php echo ($instruments_tab_active == 'shares') ? ' ins-active ' : ''; ?>" aria-controls="spot" role="tab"  id="sp">
                                    <?=lang('f_dulli_1');?>
                                </a></li>
                            <li role="presentation">
                                <a href="<?=FXPP::loc_url('financial-instruments/spotmetals')?>" class="sa-right <?='bw '; ?> <?php echo ($instruments_tab_active == 'spotmetals') ? ' ins-active ' : ''; ?>" aria-controls="metals" role="tab"  id="fu">

                                    <?=lang('f_dulli_2');?>
                                </a></li>
                            <li role="presentation">
                                <a href="<?=FXPP::loc_url('financial-instruments/bitcoin')?>" class="sa-right <?='bw '; ?> <?php echo ($instruments_tab_active == 'bitcoin') ? ' ins-active ' : ''; ?>" aria-controls="futures" role="tab"  id="bt" >

                                    <?=lang('f_dulli_3');?>
                                </a></li>
                        </ul><div class="clearfix"></div>
                    </div>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane<?php echo ($instruments_tab_active == 'forex') ? ' active' : ''; ?>" id="forex">
                            <p class="ins-tab-text ext-arabic-ins-tab-text">
                                <?=lang('f_p_1');?>
                            </p>
                            <div class="table-responsive">
                                <table id="forexTable" class="table table-bordered ins-table ext-arabic-ins-table">
                                    <thead>
                                        <tr>
                                            <td rowspan="2" class="rowspan"><?=lang('x_cs_inc0')?></td>
                                            <td colspan="2"><?=lang('x_cs_inc1')?></td>
                                            <td colspan="2"><?=lang('x_cs_inc2')?></td>
                                            <td colspan="2"><?=lang('x_fi_inc1')?></td>
                                        </tr>
                                        <tr>
                                            <td><?=lang('x_cs_inc4')?></td>
                                            <td><?=lang('x_cs_inc5')?></td>
                                            <td><?=lang('x_cs_inc4')?></td>
                                            <td><?=lang('x_cs_inc5')?>[2]</td>
                                            <td><?=lang('x_fi_sm_p0-2')?></td>
                                            <td><?=lang('x_fi_sm_p0-3')?></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>EUR/USD</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>2</td>
                                        <td>-0,3</td>
                                        <td>-0,15</td>
                                    </tr>
                                    <tr>
                                        <td>GBP/USD</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>2</td>
                                        <td>-0,30</td>
                                        <td>-0,06</td>
                                    </tr>
                                    <tr><td>USD/JPY</td><td>2</td><td>0</td><td>0</td><td>2</td><td>0.01</td><td>-0.43</td></tr>
                                    <tr><td>USD/CHF</td><td>2[1]</td><td>0</td><td>0[3]</td><td>2</td><td>0.02</td><td>-0.1</td></tr>
                                    <tr><td>USD/CAD</td><td>2</td><td>0</td><td>0</td><td>2</td><td>-0.28</td><td>0.01</td></tr>
                                    <tr><td>AUD/USD</td><td>2</td><td>0</td><td>0</td><td>2</td><td>0.1</td><td>-0.57</td></tr>
                                    <tr><td>NZD/USD</td><td>2</td><td>0</td><td>0</td><td>2</td><td>0.17</td><td>-1.595</td></tr>
                                    <tr><td>EUR/JPY</td><td>2</td><td>0</td><td>0</td><td>2</td><td>-0,05</td><td>-0,15</td></tr>
                                    <tr><td>EUR/CHF </td><td>2[1]</td><td>0</td><td>0[3]</td><td>2</td><td>-0.03</td><td>-0.06</td></tr>
                                    <tr><td>EUR/GBP</td><td>2</td><td>0</td><td>0</td><td>2</td><td>-0,1</td><td>0.01 </td></tr>
                                    <tr><td>AUD/CAD</td><td>8</td><td>0</td><td>0</td><td>8</td><td>0.08</td><td>-0,37</td></tr>
                                    <tr><td>AUD/CHF</td><td>8</td><td>0</td><td>0</td><td>8</td><td>0.33</td><td>-0,55</td></tr>
                                    <tr><td>AUD/JPY</td><td>8</td><td>0</td><td>0</td><td>8</td><td>0,35</td><td>-0,45</td></tr>
                                    <tr><td>CAD/CHF</td><td>8</td><td>0</td><td>0</td><td>8</td><td>0.21</td><td>-0.48</td></tr>
                                    <tr><td>CAD/JPY</td><td>8</td><td>0</td><td>0</td><td>8</td><td>0.24</td><td>-0.34</td></tr>
                                    <tr><td>CHF/JPY</td><td>8</td><td>0</td><td>0</td><td>8</td><td>-0.15</td><td>-0.05</td></tr>
                                    <tr><td>NZD/CAD</td><td>8</td><td>0</td><td>0</td><td>8</td><td>0.34</td><td>-0.8</td></tr>
                                    <tr><td>NZD/CHF</td><td>8</td><td>0</td><td>0</td><td>8</td><td>0.5</td><td>-0.89</td></tr>
                                    <tr><td>NZD/JPY</td><td>8</td><td>0</td><td>0</td><td>8</td><td>0.42</td><td>-0.89</td></tr>
                                    <tr><td>EUR/AUD</td><td>6</td><td>0</td><td>0</td><td>6</td><td>-1.03</td><td>0.46</td></tr>
                                    <tr><td>GBP/CHF</td><td>6 [1]</td><td>0</td><td>0[3]</td><td>6</td><td>0.12</td><td>-0.47</td></tr>
                                    <tr><td>GBP/JPY</td><td>6</td><td>0</td><td>0</td><td>6</td><td>-0,01</td><td>-0,3</td></tr>
                                    <tr><td>AUD/NZD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>-0,2</td><td>0,14</td></tr>
                                    <tr><td>EUR/CAD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>-0,35</td><td>-0.03</td></tr>
                                    <tr><td>EUR/NZD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>-1</td><td>0,5</td></tr>
                                    <tr><td>GBP/AUD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>-0,9</td><td>0,2</td></tr>
                                    <tr><td>GBP/CAD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>-0,25</td><td>-0,1</td></tr>
                                    <tr><td>GBP/NZD</td><td>10</td><td>0</td><td>0</td><td>10</td><td>-1</td><td>0,66</td></tr>
                                    <tr><td>USD/DKK</td><td>45</td><td>0</td><td>45</td><td>0</td><td>-0.35</td><td>-1.57</td></tr>
                                    <tr><td>USD/NOK</td><td>100</td><td>0</td><td>100</td><td>0</td><td>0.8</td><td>-2</td></tr>
                                    <tr><td>USD/SEK</td><td>60</td><td>0</td><td>60</td><td>0</td><td>1</td><td>-3.1</td></tr>
                                    <tr><td>USD/ZAR</td><td>110</td><td>0</td><td>110</td><td>0</td><td>-15.21</td><td>5.47</td></tr>
                                    <tr><td>AUD/CZK</td><td>18</td><td>0</td><td>18</td><td>0</td><td>-2</td><td>-2</td></tr>
                                    <tr><td>AUD/DKK</td><td>50</td><td>0</td><td>50</td><td>0</td><td>-7,5</td><td>-7,5</td></tr>
                                    <tr><td>AUD/HKD</td><td>70</td><td>0</td><td>70</td><td>0</td><td>-9,5</td><td>-9,3</td></tr>
                                    <tr><td>AUD/HUF</td><td>25</td><td>0</td><td>25</td><td>0</td><td>-3</td><td>-3</td></tr>
                                    <tr><td>AUD/MXN</td><td>110</td><td>0</td><td>110</td><td>0</td><td>-13</td><td>-13</td></tr>
                                    <tr><td>AUD/NOK</td><td>60</td><td>0</td><td>60</td><td>0</td><td>-9</td><td>-9</td></tr>
                                    <tr><td>AUD/PLN</td><td>35</td><td>0</td><td>35</td><td>0</td><td>-4,5</td><td>-4,5</td></tr>
                                    <tr><td>AUD/SEK</td><td>40</td><td>0</td><td>40</td><td>0</td><td>-4,5</td><td>-4,5</td></tr>
                                    <tr><td>AUD/SGD</td><td>8</td><td>0</td><td>8</td><td>0</td><td>-1</td><td>-1</td></tr>
                                    <tr><td>AUD/ZAR</td><td>160</td><td>0</td><td>160</td><td>0</td><td>-18,7</td><td>-18,3</td></tr>
                                    <tr><td>CAD/CZK</td><td>18</td><td>0</td><td>18</td><td>0</td><td>-2,4</td><td>-2,4</td></tr>
                                    <tr><td>CAD/DKK</td><td>4</td><td>0</td><td>4</td><td>0</td><td>-0,7</td><td>-0,7</td></tr>
                                    <tr><td>CAD/HKD</td><td>90</td><td>0</td><td>90</td><td>0</td><td>-13,5</td><td>-13,5</td></tr>
                                    <tr><td>CAD/HUF</td><td>18</td><td>0</td><td>18</td><td>0</td><td>-2</td><td>-2</td></tr>
                                    <tr><td>CAD/MXN</td><td>130</td><td>0</td><td>130</td><td>0</td><td>-13</td><td>-13</td></tr>
                                    <tr><td>CAD/NOK</td><td>50</td><td>0</td><td>50</td><td>0</td><td>-7,5</td><td>-7,5</td></tr>
                                    <tr><td>CAD/PLN</td><td>20</td><td>0</td><td>20</td><td>0</td><td>-3</td><td>-3</td></tr>
                                    <tr><td>CAD/SEK</td><td>40</td><td>0</td><td>40</td><td>0</td><td>-4,8</td><td>-4,7</td></tr>
                                    <tr><td>CAD/SGD</td><td>4</td><td>0</td><td>4</td><td>0</td><td>-0.69</td><td>-0.69</td></tr>
                                    <tr><td>CAD/ZAR</td><td>180</td><td>0</td><td>180</td><td>0</td><td>-20</td><td>-20</td></tr>
                                    <tr><td>CHF/CZK</td><td>18</td><td>0</td><td>18</td><td>0</td><td>-2,5</td><td>-2,5</td></tr>
                                    <tr><td>CHF/DKK</td><td>8</td><td>0</td><td>8</td><td>0</td><td>-1,1</td><td>-1,2</td></tr>
                                    <tr><td>CHF/HKD</td><td>90</td><td>0</td><td>90</td><td>0</td><td>-13</td><td>-13</td></tr>
                                    <tr><td>CHF/HUF</td><td>40</td><td>0</td><td>40</td><td>0</td><td>-4</td><td>-4</td></tr>
                                    <tr><td>CHF/MXN</td><td>180</td><td>0</td><td>180</td><td>0</td><td>-23</td><td>-23</td></tr>
                                    <tr><td>CHF/NOK</td><td>90</td><td>0</td><td>90</td><td>0</td><td>-10</td><td>-10</td></tr>
                                    <tr><td>CHF/PLN</td><td>35</td><td>0</td><td>35</td><td>0</td><td>-4</td><td>-4</td></tr>
                                    <tr><td>CHF/SEK</td><td>50</td><td>0</td><td>50</td><td>0</td><td>-6,4</td><td>-6,4</td></tr>
                                    <tr><td>CHF/SGD</td><td>13</td><td>0</td><td>13</td><td>0</td><td>-1.5</td><td>-1.4</td></tr>
                                    <tr><td>CHF/ZAR</td><td>160</td><td>0</td><td>160</td><td>0</td><td>-18,7</td><td>-18,7</td></tr>
                                    <tr><td>EUR/CZK</td><td>40</td><td>0</td><td>40</td><td>0</td><td>-4</td><td>-4</td></tr>
                                    <tr><td>EUR/DKK</td><td>13</td><td>0</td><td>13</td><td>0</td><td>-1,5</td><td>-1,5</td></tr>
                                    <tr><td>EUR/HKD</td><td>120</td><td>0</td><td>120</td><td>0</td><td>-15</td><td>-15</td></tr>
                                    <tr><td>EUR/HUF</td><td>75</td><td>0</td><td>75</td><td>0</td><td>-12</td><td>-12</td></tr>
                                    <tr><td>EUR/MXN</td><td>220</td><td>0</td><td>220</td><td>0</td><td>-33</td><td>-33</td></tr>
                                    <tr><td>EUR/NOK</td><td>130</td><td>0</td><td>130</td><td>0</td><td>-20</td><td>-20</td></tr>
                                    <tr><td>EUR/PLN</td><td>35</td><td>0</td><td>35</td><td>0</td><td>-5</td><td>-5</td></tr>
                                    <tr><td>EUR/SEK</td><td>55</td><td>0</td><td>55</td><td>0</td><td>-6</td><td>-6</td></tr>
                                    <tr><td>EUR/SGD</td><td>20</td><td>0</td><td>20</td><td>0</td><td>-2</td><td>-2</td></tr>
                                    <tr><td>EUR/ZAR</td><td>220</td><td>0</td><td>220</td><td>0</td><td>-25</td><td>-25</td></tr>
                                    <tr><td>GBP/CZK</td><td>25</td><td>0</td><td>25</td><td>0</td><td>-5</td><td>-5</td></tr>
                                    <tr><td>GBP/DKK</td><td>13</td><td>0</td><td>13</td><td>0</td><td>-1,7</td><td>-1,7</td></tr>
                                    <tr><td>GBP/HKD</td><td>130</td><td>0</td><td>130</td><td>0</td><td>-15</td><td>-15</td></tr>
                                    <tr><td>GBP/HUF</td><td>50</td><td>0</td><td>50</td><td>0</td><td>-6</td><td>-6</td></tr>
                                    <tr><td>GBP/MXN</td><td>180</td><td>0</td><td>180</td><td>0</td><td>-21,7</td><td>-21,7</td></tr>
                                    <tr><td>GBP/NOK</td><td>130</td><td>0</td><td>130</td><td>0</td><td>-15,7</td><td>-15,7</td></tr>
                                    <tr><td>GBP/PLN</td><td>25</td><td>0</td><td>25</td><td>0</td><td>-3,4</td><td>-3,4</td></tr>
                                    <tr><td>GBP/SEK</td><td>110</td><td>0</td><td>110</td><td>0</td><td>-16</td><td>-16</td></tr>
                                    <tr><td>GBP/SGD</td><td>20</td><td>0</td><td>20</td><td>0</td><td>-3</td><td>-3</td></tr>
                                    <tr><td>GBP/ZAR</td><td>320</td><td>0</td><td>320</td><td>0</td><td>-37</td><td>-37</td></tr>
                                    <tr><td>NZD/CZK</td><td>13</td><td>0</td><td>13</td><td>0</td><td>-1,8</td><td>-1,8</td></tr>
                                    <tr><td>NZD/DKK</td><td>4</td><td>0</td><td>4</td><td>0</td><td>-0,5</td><td>-0,5</td></tr>
                                    <tr><td>NZD/HKD</td><td>50</td><td>0</td><td>50</td><td>0</td><td>-8</td><td>-8</td></tr>
                                    <tr><td>NZD/HUF</td><td>30</td><td>0</td><td>30</td><td>0</td><td>-4,5</td><td>-4,5</td></tr>
                                    <tr><td>NZD/MXN</td><td>70</td><td>0</td><td>70</td><td>0</td><td>-7,4</td><td>-7,4</td></tr>
                                    <tr><td>NZD/NOK</td><td>40</td><td>0</td><td>40</td><td>0</td><td>-7</td><td>-7</td></tr>
                                    <tr><td>NZD/PLN</td><td>15</td><td>0</td><td>15</td><td>0</td><td>-2</td><td>-2</td></tr>
                                    <tr><td>NZD/SEK</td><td>70</td><td>0</td><td>70</td><td>0</td><td>-10</td><td>-10</td></tr>
                                    <tr><td>NZD/SGD</td><td>13</td><td>0</td><td>13</td><td>0</td><td>-2</td><td>-2</td></tr>
                                    <tr><td>NZD/ZAR</td><td>40</td><td>0</td><td>40</td><td>0</td><td>-5,7</td><td>-5,7</td></tr>
                                    <tr><td>USD/CZK</td><td>25</td><td>0</td><td>25</td><td>0</td><td>-2,5</td><td>-2,5</td></tr>
                                    <tr><td>USD/HKD</td><td>5</td><td>0</td><td>5</td><td>0</td><td>-0,67</td><td>-0,67</td></tr>
                                    <tr><td>USD/HUF</td><td>50</td><td>0</td><td>50</td><td>0</td><td>-7.5</td><td>-7.5</td></tr>
                                    <tr><td>USD/MXN</td><td>10</td><td>0</td><td>10</td><td>0</td><td>-1.7</td><td>-1.7</td></tr>
                                    <tr><td>USD/SGD</td><td>8</td><td>0</td><td>8</td><td>0</td><td>-1.7</td><td>-1.7</td></tr>
                                    <tr><td>USD/PLN</td><td>20</td><td>0</td><td>20</td><td>0</td><td>-2</td><td>-2</td></tr>
                                    <tr><td>CZK/JPY</td><td>4</td><td>0</td><td>4</td><td>0</td><td>-0,55</td><td>-0,55</td></tr>
                                    <tr><td>DKK/JPY</td><td>2 [4]</td><td>0</td><td>2 [4]</td><td>0</td><td>-0,28</td><td>-0,28</td></tr>
                                    <tr><td>HKD/JPY</td><td>2 [4]</td><td>0</td><td>2 [4]</td><td>0</td><td>-0.41</td><td>-0.41</td></tr>
                                    <tr><td>HUF/JPY</td><td>4 [4]</td><td>0</td><td>4 [4]</td><td>0</td><td>-0.7</td><td>-0.7</td></tr>
                                    <tr><td>MXN/JPY</td><td>2 [4]</td><td>0</td><td>2 [4]</td><td>0</td><td>-0.41</td><td>-0.41</td></tr>
                                    <tr><td>NOK/JPY</td><td>4 [4]</td><td>0</td><td>4 [4]</td><td>0</td><td>-0,5</td><td>-0,5</td></tr>
                                    <tr><td>SGD/JPY</td><td>4</td><td>0</td><td>4</td><td>0</td><td>-0,6</td><td>-0,6</td></tr>
                                    <tr><td>SEK/JPY</td><td>2 [4]</td><td>0</td><td>2 [4]</td><td>0</td><td>-0,39</td><td>-0,39</td></tr>
                                    <tr><td>ZAR/JPY</td><td>4 [4]</td><td>0</td><td>4 [4]</td><td>-0.7</td><td>-0.7</td><td>-0.7</td></tr>
                                    <tr><td>USD/RUR</td><td>400</td><td>0</td><td>400</td><td>0</td><td>-27,65</td><td>10,57</td></tr>
                                    <tr><td>EUR/RUR</td><td>450</td><td>0</td><td>450</td><td>0</td><td>-21</td><td>9</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="ins-foot ext-arabic-ins-foot">
                                <?=lang('f_p_2');?>
                                <br>
                                <?=lang('f_p_3');?>
                            </p>
                            <p class="ins-text-sub ext-arabic-inst-text-sub note-text">
                                <span class="legend">[1]</span>
                                - <?=lang('f_p_sp_1');?>
                                <br>
                                <span class="legend">[2]</span>
                                -  <?=lang('f_p_sp_2');?>
                                <br>
                                <span class="legend">[3]</span>
                                - <?=lang('f_p_sp_3');?>
                                <br>
                                <span class="legend">[4]</span>
                                - <?=lang('f_p_sp_4');?>
                                <br>
                                <span class="legend">[5]</span>
                                - <?=lang('f_p_sp_5');?>
                            </p>
                        </div>


                        <div role="tabpanel" class="tab-pane<?php echo ($instruments_tab_active == 'shares') ? ' active' : ''; ?>" id="spot">
                            <p class="ins-tab-text ext-arabic-ins-tab-text">
                                <?=lang('s_p_0');?>
                            </p>

                            <div class="table-responsive">
                                <table id="sharesTable" class="table table-bordered ins-table ext-arabic-ins-table">
                                    <thead>
                                    <tr>
                                        <td colspan="3"><?=lang('x_fi_sm_p0-4')?></td>
                                        <td colspan="6"><?=lang('x_fi_sm_p0-5')?></td>
                                    </tr>
                                    <tr>
                                        <td><?=lang('x_cs_inc7')?></td>
                                        <td><?=lang('x_cs_inc8')?></td>
                                        <td><?=lang('x_fi_sm_p0-6')?></td>
                                        <td><?=lang('x_cs_inc9')?> [1]</td>
                                        <td><?=lang('x_cs_inc10')?></td>
                                        <td><?=lang('x_fi_sm_p0-7')?></td>
                                        <td><?=lang('x_fi_sm_p0-8')?></td>
                                        <td><?=lang('x_fi_sm_p0-9')?></td>
                                        <td><?=lang('x_fi_sm_p0-10')?> [2]</td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr><td>#AA Alcoa, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#AAL ANGLO AMERICAN PLC</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>1.00[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>10:00 - 18:30</td></tr>
                                    <tr><td>#AAPL Apple Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.152[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#AIG American International Group, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#AMZN Amazon.com Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.12[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#AXP American Express</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#BA Boeing</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#BABA Alibaba Group Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.05[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#BAC Bank of America</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#BARC Barclays PLC</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.20[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>10:00 - 18:30</td></tr>
                                    <tr><td>#BLT BHP BILLITON PLC</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>1.00[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>10:00 - 18:30</td></tr>
                                    <tr><td>#BP BP PLC</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.25[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>10:00 - 18:30</td></tr>
                                    <tr><td>#BTA BT Group PLC</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.20[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>10:00 - 18:30</td></tr>
                                    <tr><td>#C Citigroup, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#CAT Caterpillar, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#CSCO Cisco Systems, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#CVX Chevron Corporation</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#DD DuPont</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#DIS Walt Disney</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#EBAY eBay Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#FB Facebook Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.05</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#GEN General Electric</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#GOOG Google Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.22[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#GS Goldman Sachs Group, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.06[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#GSK GlaxoSmithKline PLC</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>1.00[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>10:00 - 18:30</td></tr>
                                    <tr><td>#HD Home Depot, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#HPQ Hewlett Packard Co.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#HSBA HSBC Holdings PLC</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.20[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>10:00 - 18:30</td></tr>
                                    <tr><td>#IBM IBM</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#INTC Intel Corporation</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#JNJ Johnson &amp; Johnson</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#JPM JPMorgan Chase &amp; Co.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#KO Coca-Cola</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#LLOY LLOYDS BANKING GROUP PLC</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.10[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>10:00 - 18:30</td></tr>
                                    <tr><td>#LNKD LinkedIn Corporation</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.15[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#MCD McDonald's Corporation</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#MMM 3M</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#MRK Merck &amp; Co, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#MSFT Microsoft Corporation</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#ORCL Oracle Corp.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#PFE Pfizer, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#PG Procter &amp; Gamble Co.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#T AT&amp;T, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#TRV Travelers Companies, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#TSCO TESCO PLC</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.40[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>10:00 - 18:30</td></tr>
                                    <tr><td>#TWTR Twitter Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.06[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#UTX United Technologies Corporation</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#VOD VODAFONE GROUP PLC</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.20[3]</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>10:00 - 18:30</td></tr>
                                    <tr><td>#VZ Verizon Communications, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#WFC Wells Fargo &amp; Co</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#WMT Wal-Mart Stores, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#XOM Exxon Mobil Corporation</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>
                                    <tr><td>#YHOO Yahoo, Inc.</td><td>100 <?=lang('x_fi_shares')?></td><td>1 <?=lang('x_fi_share')?> = 0.01 <?=lang('x_fi_lot')?></td><td>0.03</td><td>0.10%</td><td>10%</td><td>-0.1</td><td>-0.2</td><td>16:30 - 23:00</td></tr>

                                    </tbody>
                                </table>
                            </div>
                            <p class="ins-text-sub ext-arabic-inst-text-sub note-text">
                                <span class="legend">[1]</span>
                                - <?=lang('s_p_s_1');?>
                                <br>
                                <span class="legend">[2]</span>
                                - <?=lang('s_p_s_2');?> <br>
                                <span class="legend">[3]</span>
                                - <?=lang('s_p_s_3');?><br>
                            </p>
                            <p class="ins-text-sub ext-arabic-inst-text-sub note-text">
                                <span class="note red">
                                    <?=lang('s_p_f_1');?>
                                </span>
                                <br>
                                <?=lang('s_p_f_2');?>
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane<?php echo ($instruments_tab_active == 'spotmetals') ? ' active' : ''; ?>" id="futures">
                            <p class="ins-tab-text">
                                <?=lang('x_fi_sm_p0-1');?>
                            </p>
                            <div class="table-responsive">
                                <table id="metalsTable" class="table table-bordered ins-table ext-arabic-ins-table">
                                    <thead>
                                        <tr>
                                            <td><?=lang('x_cs_inc7')?></td>
                                            <td><?=lang('x_cs_inc8')?></td>
                                            <td><?=lang('x_cs_inc4')?></td>
                                            <td><?=lang('x_cs_inc5')?></td>
                                            <td><?=lang('x_fi_sm_p0-8')?></td>
                                            <td><?=lang('x_fi_sm_p0-9')?></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?=lang('x_fi_sm_p0-11')?></td>
                                            <td><?=lang('x_fi_sm_p0-12')?></td>
                                            <td>60</td>
                                            <td>0</td>
                                            <td>-0.35</td>
                                            <td>0.15</td>
                                        </tr>
                                        <tr>
                                            <td><?=lang('x_fi_sm_p0-13')?></td>
                                            <td><?=lang('x_fi_sm_p0-14')?></td>
                                            <td>40</td>
                                            <td>0</td>
                                            <td>-0.1</td>
                                            <td>0.05</td>
                                        </tr>
                                        <tr>
                                            <td>XAUUSD</td>
                                            <td><?=lang('x_fi_sm_p0-14')?></td>
                                            <td>60</td>
                                            <td>0</td>
                                            <td>-0.35</td>
                                            <td>0.15</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="ins-foot">

                                <?=lang('x_fi_sm_p0-15')?>.
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane<?php echo ($instruments_tab_active == 'bitcoin') ? ' active' : ''; ?>" id="bitcoin">
                            <p class="ins-tab-text">
                                <?=lang('x_fi_bt_p0-1');?>
                            </p>
                            <div class="table-responsive">
                                <table id="metalsTable1" class="table table-bordered ins-table ext-arabic-ins-table">
                                    <thead>
                                        <tr>
                                            <td><?=lang('x_fi_bt_p0-2')?></td>
                                            <td><?=lang('x_fi_bt_p0-3')?></td>
                                            <td><?=lang('x_fi_bt_p0-4')?></td>
                                            <td><?=lang('x_fi_bt_p0-5')?></td>
                                            <td><?=lang('x_fi_bt_p0-6')?></td>
                                            <td><?=lang('x_fi_bt_p0-7')?></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?=lang('x_fi_bt_p0-8')?></td>
                                            <td>1</td>
                                            <td>700</td>
                                            <td>0.10%</td>
                                            <td>-45</td>
                                            <td>-90</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane<?php echo ($instruments_tab_active == 'spotmetals') ? ' active' : ''; ?>" id="metals" >

                        </div>
                    </div>
                </div>
                <?= $this->load->view('addin_DemoLiveLinks', NULL, TRUE); ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("head").append('<style type="text/css">input[type=search] {margin-left: 10px;}.note{font-size:12px}</style>');
    });
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" >
    $(document).ready(function() {
        var language = "<?=FXPP::html_url()?>";
        var dom_tbl='<"row ins-filter"<"col-sm-6"<"form-inline"f>>>';
        language = language.replace(/\s/g, '');
        if (language=='sa'){
            dom_tbl='<"row ins-filter"<"col-sm-12"<"form-inline"f>>>';
        }

        $("#sp").click(function(){
            $("#fo, #fu").removeClass("ins-active");
            $("#sp").addClass("ins-active");
        });
        $("#fu").click(function(){
            $("#sp, #fo").removeClass("ins-active");
            $("#fu").addClass("ins-active");
        });
        $("#fo").click(function(){
            $("#fu, #sp").removeClass("ins-active");
            $("#fo").addClass("ins-active");
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

        $('#metalsTable1').DataTable({
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

        $('#metalsTable1_filter').addClass('form-group');
        $('#metalsTable1_filter label').addClass('ins-search-text');
        $('#metalsTable1_filter input').addClass('form-control round-0');
    });

    $(window).load(function() {
        $('#fu').height($('#sp').height());
        $('#fo').height($('#sp').height());
    });
    $(window).resize(function() {
        $('#fu').height($('#sp').height());
        $('#fo').height($('#sp').height());
    });
</script>