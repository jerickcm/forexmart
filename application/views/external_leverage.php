<link href="<?= $this->template->Css() ?>leverage.css" rel="stylesheet">
<?php if (IPLoc::Office()) { ?>
    <style>
        .leverage-title h2 {
            font-family: Arial;
            font-weight: 700;
            color: #29a643;
            margin-top: 12px;
            letter-spacing: -2px;
            text-transform: uppercase;
            text-align: right;
            text-shadow: 3px 3px #222;
        }
        .leverage-title h1 {
            font-family: Impact;
            font-weight: 700;
            color: #fff;
            margin-top: 2px;
            margin-bottom: 0px;
            letter-spacing: -2px;
            text-transform: uppercase;
            text-align: right;
            text-shadow: 3px 3px #222;
        }
        @media screen and (min-width: 1200px) {
            .leverage-title h1 {
                font-size: 156px!important;
            }
            .leverage-title h2 {
                font-size: 92px!important;
            }
        }
        @media screen and (min-width: 993px) and (max-width: 1199px){
            .leverage-title h2:lang(ru),  .leverage-title h2:lang(fr), .leverage-title h2:lang(es) , .leverage-title h2:lang(bg) {
                font-size: 49px!important;
            }
        }
        @media screen and (min-width: 992px) {
            .leverage-title h1 {
                font-size: 147px!important;
            }
            .leverage-title h2 {
                font-size: 86px!important;
            }
            .leverage-title h2:lang(ru),.leverage-title h2:lang(fr), .leverage-title h2:lang(es), .leverage-title h2:lang(bg)  {
                font-size: 49px!important;
            }
        }
        @media screen and (max-width: 991px) {
            .leverage-title h3 {
                text-align: center;
            }
            .leverage-form-holder {
                display: block;
                margin: 0 auto;
            }
            .leverage-title h1 {
                font-size: 147px!important;
                text-align: center;
            }
            .leverage-title h2 {
                padding: 0;
                margin-left: 13px!important;
                text-align: center;
                font-size: 86px!important;
            }
            .leverage-title h2:lang(ru),.leverage-title h2:lang(fr), .leverage-title h2:lang(es), .leverage-title h2:lang(bg)  {
                font-size: 47px!important;
            }
        }

        @media screen and (max-width: 499px) {
            .leverage-title h1 {
                font-size: 128px!important;
                text-align: center;
            }
            .leverage-title h2 {
                padding: 0;
                text-align: center;
                font-size: 75px!important;
            }
            .leverage-title h2:lang(ru),.leverage-title h2:lang(fr), .leverage-title h2:lang(es) , .leverage-title h2:lang(bg) {
                font-size: 43px!important;
            }
        }
        @media screen and (max-width: 449px) {
            .leverage-title h1 {
                font-size: 120px!important;
                text-align: center;
            }
            .leverage-title h2 {
                padding: 0;
                text-align: center;
                font-size: 70px!important;
            }
            .leverage-title h2:lang(ru), .leverage-title h2:lang(fr) , .leverage-title h2:lang(es) , .leverage-title h2:lang(bg){
                font-size: 41px!important;
            }
        }
        @media screen and (max-width: 399px) {
            .leverage-title h1 {
                font-size: 100px!important;
                text-align: center;
            }
            .leverage-title h2 {
                padding: 0;
                text-align: center;
                font-size: 60px!important;
            }
            .leverage-title h2:lang(ru),.leverage-title h2:lang(fr), .leverage-title h2:lang(es), .leverage-title h2:lang(bg)  {
                font-size: 35px!important;
            }
        }
        @media screen and (max-width: 359px) {
            .leverage-title h1 {
                font-size: 95px!important;
                text-align: center;
            }
            .leverage-title h2 {
                padding: 0;
                text-align: center;
                font-size: 55px!important;
            }
            .leverage-title h2:lang(ru), .leverage-title h2:lang(fr), .leverage-title h2:lang(es), .leverage-title h2:lang(bg)  {
                font-size: 33px!important;
            }
        }


        @media screen and (max-width: 320px) {
            .leverage-title h1 {
                font-size: 84px!important;
                text-align: center;
            }
            .leverage-title h2 {
                padding: 0;
                text-align: center;
                font-size: 50px!important;
            }
            .leverage-title h2:lang(ru),.leverage-title h2:lang(fr), .leverage-title h2:lang(es), .leverage-title h2:lang(bg) {
                font-size: 30px!important;
            }
        }

    </style>
<?php } ?>

<div class="leverage-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 leverage leverage-title">
                <h4>
                    <?= (lang('lav-1') != '') ? lang('lav-1') : 'Open The World of <b>Opportunities</b>'; ?>
                </h4>
                <h5>
                    <?= (lang('lav-2') != '') ? lang('lav-2') : 'Explore Infinite <b>Possibilities</b> With <b>Highest</b> Leverage Ever'; ?>
                </h5>
                <h4>
                    <?= (lang('lav-3') != '') ? lang('lav-3') : '<b class="bb">Navigate your way</b> to Success'; ?>
                </h4>
                <p>
                    <?= (lang('lav-4') != '') ? lang('lav-4') : "With our Unparalleled Customer support and competitive services, ForexMart offers 1:5000 Leverage in both Standard and Zero Spread Accounts. <br>This allows you to:"; ?>
                </p>
                <ul>
                    <li><i class="fa fa-lg fa-check-square"></i>
                        <?= (lang('lav-5') != '') ? lang('lav-5') : 'Open deals in bigger volume and get more profit' ?>
                    </li>
                    <li><i class="fa fa-lg fa-check-square"></i>
                        <?= (lang('lav-6') != '') ? lang('lav-6') : ''; ?>
                    </li>
                    <li><i class="fa fa-lg fa-check-square"></i>
                        <?= (lang('lav-7') != '') ? lang('lav-7') : ''; ?>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 leverage-title">
                <h3><a href="<?= FXPP::www_url() ?>"><?= (lang('lav-8') != '') ? lang('lav-8') : 'Start <b>trading</b> today!'; ?> </a></h3>
                <div class="leverage-form-holder">
                    <form action="#" method="post" class="form-horizontal leverage-form">
                        <div class="form-group">
                            <label class="control-label col-sm-3 leverage-label"> <?= (lang('lav-11') != '') ? lang('lav-11') : 'Email'; ?><cite class="req">*</cite></label>
                            <div class="col-sm-9 leverage_error_email">

                                <input name="email" type="email" class="form-control round-0 leverage_email" id="inputEmail3" placeholder="<?= (lang('x-ru-3') != '') ? lang('x-ru-3') : 'Email'; ?>">
                                <span class="red pull-r"><?php echo form_error('email') ?> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3 leverage-label"><?= (lang('lav-12') != '') ? lang('lav-12') : 'Full name'; ?><cite class="req">*</cite></label>
                            <div class="col-sm-9 leverage_error_name">

                                <input name="full_name" type="text" class="form-control round-0 leverage_name" id="full" placeholder="<?= (lang('x-ru-4') != '') ? lang('x-ru-4') : 'Full name'; ?>">
                                <span class="red pull-r"><?php echo form_error('full_name') ?> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" id="leverage-btm-submit" class="btn-submit"> <?= (lang('lav-13') != '') ? lang('lav-13') : 'Submit'; ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="leverage-title">
                    <?= (lang('lav-9') != '') ? lang('lav-9') : '<b> 1 : 5000</b>'; ?>
                </div>
            </div>

            <div class="col-md-12 leverage leverage-title">
                <div class="col-md-12 terms">
                    <a href="#" id="terms_lev">  <?= (lang('lav-15') != '') ? lang('lav-15') : 'Terms leverage of 1: 5000'; ?></a>
                </div>

                <br>
                <div id="terms" style="display: none">
                    <h5><?= lang('lav-20'); ?></h5>
                    <ul>
                        <li> <i class="fa fa-lg fa-check-square"></i> <?= (lang('lav-16') != '') ? lang('lav-16') : 'The 1:5000 leverage is available for Clients with account balance not exceeding 1000 USD.'; ?></li>
                        <li> <i class="fa fa-lg fa-check-square"></i> <?= (lang('lav-17')) ? lang('lav-17') : 'The 1:5000 leverage is not compatible with some types of bonuses. Please read carefully the Agreement of Bonuses.'; ?></li>
                        <li> <i class="fa fa-lg fa-check-square"></i> <?= (lang('lav-18') != '') ? lang('lav-18') : 'The maximum leverage 1:5000 can be reduced to 1:1000 by the company at its sole discretion.'; ?></li>
                        <li><i class="fa fa-lg fa-check-square"></i> <?= (lang('lav-19') != '') ? lang('lav-19') : 'By using 1:5000 leverage client agrees with the Terms of Service.'; ?></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->load->ext_view('modal', 'validate-cyrillic', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'validate-cyrillic-2', '', TRUE); ?>
<!-- end content -->
<script type="text/javascript">
    $(document).on("click", '#terms_lev', function () {

        $("#terms").toggle();
    })


    var language = "<?= FXPP::html_url() ?>";
    str = language.replace(/\s/g, "");
    console.log(str);
    if (str == 'ru') {
        $("#lbl-email").removeClass("col-sm-3");
        $("#lbl-email").addClass("col-sm-5");

        $("#div-email").removeClass("col-sm-9");
        $("#div-email").addClass("col-sm-7");

        $("#lbl-fullname").removeClass("col-sm-3");
        $("#lbl-fullname").addClass("col-sm-5");

        $("#div-fullname").removeClass("col-sm-9");
        $("#div-fullname").addClass("col-sm-7");
    }
</script>
<?php if (IPLoc::Office_and_Vpn()) { ?>
    <style type="text/css">
        .error{
            color:red;
            font-size: 14px;
            font-weight: normal;
            text-align: left;
        }
    </style>
<?php } ?>
<?php if (IPLoc::Office_and_Vpn()) { ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $.validator.addMethod(
                    "regex",
                    function (value, element, regexp) {
                        var re = new RegExp(regexp);
                        return this.optional(element) || re.test(value);
                    },
                    "Please check your input."
                    );


            $('#ruble-reg').validate({// initialize the plugin
                rules: {
                    email: {
                        regex: cyrillic
                    },
                    full_name: {
                        regex: cyrillic
                    }
                },
                messages: {
                    email: {
                        regex: "The characters you have entered are not yet supported. You can only enter English and Russian characters."
                    },
                    full_name: {
                        regex: "The characters you have entered are not yet supported. You can only enter English and Russian characters."
                    }
                },
                submitHandler: function (form) {
                    return true;
                }
            });

        });
    </script>
<?php } ?>

<script type="text/javascript">

    $(document).ready(function () {
        $(document).on('click', '#leverage-btm-submit', function (e) {
            e.preventDefault();
            var leverage_submit = false;
            var leverage_email = $('.leverage_email').val();
            var leverage_name = $('.leverage_name').val();

            if (leverage_email != '') {
                $('.pull_email').hide();
                if (validateEmail(leverage_email) == true) {
                    leverage_submit = true;
                } else {
                    $('.pull_email').hide();
                    $('.leverage_error_email').append('<span class="red pull-r pull_email">Please enter valid e-mail address.</span>');
                    leverage_submit = false;
                    return false;
                }
            } else {
                $('.pull_email').hide();
                $('.leverage_error_email').append('<span class="red pull-r pull_email">Please enter valid e-mail address.</span>');
                leverage_submit = false;
                return false;
            }

            if (leverage_name != '') {
                $('.pull_name').hide();
                leverage_submit = true;

            } else {
                $('.pull_name').hide();
                $('.leverage_error_name').append('<span class="red pull-r pull_name">Please enter full name.</span>');
                leverage_submit = false;
                return false;
            }
            if (leverage_submit == true) {
                $(".leverage-form").submit();
            }
        });
    });

    function validateEmail(sEmail) {
        var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        if (filter.test(sEmail)) {
            return true;
        } else {
            return false;
        }
    }

</script>