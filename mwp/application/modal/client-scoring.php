<!-- Modal -->
<?php $this->lang->load('riskdisclosure');?>
<style>
    <?php if(FXPP::html_url()=='sa'){ ?>
    ol li:before {
        margin-left: 100%;
        left: 10px; /* space between number and text */
    }
    <?php }else{ ?>
    ol li:before {

        margin-right: 100%;
        right: 10px; /* space between number and text */
    }
    <?php } ?>
    ol {
        counter-reset: item;
    }
    ol li {
        display: block;
        position: relative;
    }
    ol li:before {
        color: #2988CA;
        font-weight: bold;
        content: counters(item, ".")".";
        counter-increment: item;
        position: absolute;
    }
    .rootnumberheadings{
        color: #2988CA;
        font-weight: bold;
    }
    .subnumberheadings{
        font-weight: bold;
    }
    .main{
        padding-top: 20px;
    }
    .primaryunits{
        padding-bottom: 20px;
    }
    .tradomart {
        margin-bottom: 3px;
        padding: 0px !important;
    }
    .col-lg-12 {
        margin-bottom: 30px;
    }
    #body-scoring{
        max-height: 400px; overflow-y: auto; padding: 15px;
    }
    .custome-chek-p{
        margin-top: 20px;
        margin-right: 20px;
    }
</style>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

<div class="modal fade" id="myModal" role="dialog" tabindex="=-1" role="dialog" aria-labelledby="myModal" aria-hidden="true" style="width: 100%;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Risk Disclosure</h4>
            </div>
            <div class="modal-body">
                <p>Based on the information you provided with regards to your trading knowledge and experience, ForexMart considers that Forex and CFDs may not be appropriate for you to trade as you must fully understand the nature and risks involved before you open a Trading Account. Should you wish to proceed with opening a Trading Account in spite of this, you should acknowledge and agree with the Risk Disclosure.</p>

                   <div id="body-scoring" style="">
                       <?php include("client-scoring-risk-body.php");?>
                   </div>
                <hr>
                <p id="custome-chek-p"><input type="checkbox" name="low_scoring_allow" id="low_scoring_allow"> &nbsp;I read and understood the Risk Disclosure and wish to proceed with my registering a trading account with ForexMart. </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-submit" id="low_scoring_submit" style="background: #2fb24a; color:white;">Submit</button>
            </div>
        </div>

    </div>
</div>