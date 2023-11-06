<style>
    /*#parmid{*/
        /*font-weight: bold;*/
        /*font-size: 50px;*/
        /*color: black;*/
    /*}*/
    /*#parlower{*/
        /*font-weight: bold;*/
        /*color: black;*/
        /*font-size: 20px;*/
        /*margin-top: 40px;*/
    /*}*/
    /*.fixheight{*/
        /*height: 256px;*/
    /*}*/
    /*.btn-supress{*/
        /*display: inline!important;*/
    /*}*/
    /*.bmargin{*/
        /*margin-top:50px!important;*/
    /*}*/



    a.advrt:hover{
        color: #FFF;
        text-decoration: none;
    }
    a.advrt:link{
        color: #FFF;
        text-decoration: none;
    }
    a.advrt:visited{
        color: #FFF;
        text-decoration: none;
    }
    a.advrt:active{
        color: #FFF;
        text-decoration: none;
    }
    @media only screen and (max-device-width: 767px) {
        .ribbon {
            display: none;
        }
    }

    @media only screen and (max-device-width: 480px) {
        .ribbon {
            display: none;
        }
    }

    @media only screen  and (max-device-width: 381px){
        .ribbon {
            display: none;
        }
    }
    @media screen and (max-width: 329px) {
        .ribbon {
            display: none;
        }
    }

    @media screen and (min-width: 0px) and (max-width: 500px) {
        .ribbon {
            display: none;
        }
    }
    @media screen and (min-width: 100px) and (max-width: 300px){
        .cgrts{
            font-size: 12px!important;
        }
    }
    @media screen and (min-width: 0px) and (max-width: 99px){
        .cgrts{
            font-size: 8px!important;
        }
        .up-to{
            font-size: 8px!important;
        }
    }
    .c-pad{
        padding: 0px 10px;
    }

</style>


<div class="modal fade" id="popup" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="">
    <div class="modal-dialog round-0">
        <div class="modal-content round-0">
            <div class="modal-header round-0">
                <button type="button" class="close supresscookies" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-show-title cgrts">Congratulations!</h4>
            </div>
            <div class="modal-body modal-show-body">
                <div class="row">
                    <div class="no-deposit-image-holder">
                        <img src="<?= $this->template->Images()?>modal-show-img.png" class="img-responsive ribbon">
                        <img src="<?= $this->template->Images()?>logo-prev.png" width="219" height="48" class="img-responsive hidden-image-deposit c-pad"/>
                    </div>
                    <div class="sign-back">
                        <p class="modal-show-text"><span>Sign up</span> and be <span>eligible</span> for</p>
                        <span class="up-to">up to $150</span>
                        <p class="no-deposit-needed">No deposit is needed</p>
                        <div class="btn-modal-show-holder">
                            <a href="<?= $this->config->item('domain-www');?>/account-type" class="btn-modal-show advrt">START TRADING TODAY</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>