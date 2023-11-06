<div class="getting-started-parent-container">
    <div class="partnership-main-holder">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-2-left">
                    <?php
                    include_once('layouts/external/sidebar-left.php');
                    ?>
                </div>
                <div class="col-lg-8 col-md-8 col-8-center">
                    <div class="">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 how-to-get-started">
                            <div class="new-get-started-container">
                                <div class="get-started-title ext-arabic-get-started-title"><h1><?= lang('gs-h1') ?></h1></div>
                                <div class="news-get-started-content">
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 left-get-started-content ext-arabic-get-started-content">
                                        <div class="left-get-started-holder">
                                            <img src="<?= base_url() ?>assets/images/howtogetstarted-img1.png" width="150" height="150" alt="" class="img-responsive"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 right-get-started-content ext-arabic-get-started-content">
                                        <h1><?= lang('gs-head1') ?></h1>
                                        <p><?= lang('gs-p1') ?> <a href="<?= FXPP::loc_url('faq') ?>"><?= lang('gs-link1') ?></a> <?= lang('gs-or') ?><a href="<?= FXPP::loc_url('forex-glossary') ?>"><?= lang('gs-link2') ?></a>.</p>
                                    </div>
                                </div>
                                <div class="news-get-started-content">
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 left-get-started-content ext-arabic-get-started-content">
                                        <div class="left-get-started-holder">
                                            <img src="<?= base_url() ?>assets/images/howtogetstarted-img2.png" width="150" height="150" alt="" class="img-responsive"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 right-get-started-content ext-arabic-get-started-content">
                                        <?= lang('gs-part-2') ?>
                                    </div>
                                </div>
                                <div class="news-get-started-content">
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 left-get-started-content ext-arabic-get-started-content">
                                        <div class="left-get-started-holder">
                                            <img src="<?= base_url() ?>assets/images/howtogetstarted-img3.png" width="150" height="150" alt="" class="img-responsive"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 right-get-started-content ext-arabic-get-started-content">
                                        <h1><?= lang('gs-head2') ?></h1>
                                        <p><?= lang('gs-p2') ?> <strong><?= lang('gs-p2-link1') ?></strong> <a href="<?= FXPP::loc_url('register/demo') ?>"> <u><?= lang('gs-p2-link2') ?></u></a> <?= lang('gs-p21') ?></p>
                                    </div>
                                </div>
                                <div class="news-get-started-content">
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 left-get-started-content ext-arabic-get-started-content">
                                        <div class="left-get-started-holder fourth-image-getstarted-holder">
                                            <img src="<?= base_url() ?>assets/images/howtogetstarted-img4.png" width="150" height="150" alt="" class="img-responsive"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 right-get-started-content ext-arabic-get-started-content">
                                        <h1><?= lang('gs-head3') ?></h1>
                                        <p><?= lang('gs-p3') ?></p>

                                        <p>  1. <span> <a href="<?= FXPP::loc_url('thirty-percent-bonus') ?>"><?= lang('gs-link5') ?></a></span> -  <?= lang('gs-p31') ?></p>

                                        <p> 2. <span><a href="<?= FXPP::loc_url('no-deposit-bonus') ?>"><?= lang('gs-link6') ?></a></span> - <?= lang('gs-p32') ?>  </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-2-right">
                    <?php
                    include_once('layouts/external/sidebar-right.php');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="parent-chat-widget-container col-centered fix-chat-widget" style="display:none;" id="support-wrapper">
        <div class="chat-widget-container">
            <div class="chat-widget-header">
                <a href="javascript:;" class="chat-widget-button-close"></a>
            </div>
            <div class="chat-widget-body">
                <div class="chat-widget-img-support">
                    <img src="<?= $this->template->Images() ?>chat-widget-img.png" alt="Chat">
                </div>
                <div class="chat-widget-statement">
                    <div class="arrow-up"></div>
                    <div class="arrow-left"></div>
                    <div class="widget-content">
                        <p>Questions? </p> <p>How can I help you?</p>
                    </div>
                </div>
            </div>
            <div class="chat-widget-footer">
                <a href="javascript:void(Tawk_API.toggle())"><button id="start-chat">Start Chat</button></a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('#support-wrapper').toggle('slide');
            var w_width = $(this).width();
            if (w_width < 1551 && w_width > 1340) {
                $(".sidebar-left").css('margin-top', '10px');
            } else {
                $(".sidebar-left").css('margin-top', '400px');
            }
        }, 5000);
    });
    /*
    $("#start-chat").on("click", function () {
        $("#tawkchat-minified-container").click();
        console.log('This is TowkTO test');
    });
    */
</script>
<style type="text/css">
    .chat-widget-footer a{text-decoration:none;}
</style>
