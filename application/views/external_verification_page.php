


<div class="background-wrapper">
    <form action="" method="post">
    <div class="container">
        <section class="fm-section-wrapper fm-sec-info-form">
            <h1><i class="fa fa-lock"></i> Security Information</h1>
            <hr>
            <div class="row">
                <div class="col-md-offset-4 col-md-4 col-sm-offset-2 col-sm-8 col-xs-offset-0 col-xs-12">
                    <h3>Confirm Email Address</h3>
                    <p class="p-text-desc">Enter the activation code sent to your E-mail: <span><b><?php echo $email?></b></span></p>

                        <input id="activitaion_code" type="text" name="resend_code" class="form-control input-textcode" placeholder="__ __ __ __ __ __">

                    <?php echo form_error('resend_code', '<div class="alert alert-danger">', '</div>'); ?>

                    <?php
                    if($msg){?>
                    <div class="alert alert-danger">
                         <?php echo $msg?>
                    </div>
                    <?php }?>

                        <button id="resend_code" type="button" class="btn btn-success btn-resend-code disabled"><i class="fa fa-refresh"></i> Resend Code</a> <span class="seconds-timer">00:<span id="sec">60</span> sec</span></button>


                </div>
            </div>
            <hr>

            <button type="submit" class="btn btn-primary btn-registration">Continue registration</button>
        </section>
    </div>
    </form>
</div>

<div id="loader-holder" class="loader-holder" dir="ltr">
    <div class="loader">
        <div class="loader-inner ball-pulse">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>

<div id="modal_resend_code" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Notification!</h4>
            </div>
            <div class="modal-body">
                <p id="modal-msg"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>
    var url = "<?=FXPP::ajax_url('email-verification/resend-code')?>";

    var interval = 60000;
    var msg = "The activation code resent to your E-mail: <?php echo $email?>";

   /* setInterval(function(){
        $("#resend_code").removeClass('disabled');
         $(".btn-resend-code").attr("id","resend_activation_code");
    }, interval);*/

    var sec = 60;

    setInterval(function(){
        sec = sec -1;
        if(parseInt(sec) < 1){
            $("#sec").text(0);
            $("#resend_code").removeClass('disabled');
            $(".btn-resend-code").attr("id","resend_activation_code");

        }else{
            $("#sec").text(sec);
        }

    }, 1000);



    $(document).on("click","#resend_activation_code",function(){


        $(".loader-holder").show();
        $.post(url,"",function(data){


            $(".loader-holder").hide();
            $("#modal-msg").html(msg);
            $("#modal_resend_code").modal('show');

            $(".btn-resend-code").attr("id","resend_code");
            $(".alert-danger").hide();
            sec = 60;
            $("#resend_code").addClass('disabled');



        })
    })

    $(document).on("click","#activitaion_code",function(){

        $(".alert-danger").hide();

    })

    $(document).on("click","#resend_code",function(){

        $("#modal-msg").html("You able to resend the activation code after 60 sec");
        $("#modal_resend_code").modal('show');
    })





</script>