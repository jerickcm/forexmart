<link href="<?= $this->template->Css() ?>ruble.css" rel="stylesheet">
<link href="<?= $this->template->Css() ?>view-ruble.css" rel="stylesheet">
<div class="ruble-main-holder">
    <div class="container">
        <div class="row lang_it">
            <div class="col-md-7">
                <p class="ruble-text">
                    <span> <?= lang('x-ru');?></span> <?= lang('x-ru-de');?>
                </p>
                <p class="ruble-text">
                    <img src="<?= $this->template->Images() ?>fxlogo-blue.png" class="ruble-fxlogo" alt="" /> <?= lang('x-ru-1');?>
                </p>
                <h1 class="ruble-h1"><a href="#"> <?= lang('x-ru-2');?></a></h1>
                <!-- <a href="#" class="ruble-link">Open Trading Account</a> -->
                <div class="ruble-form-holder col-md-8">
                    <form  method="post" class="form-horizontal ruble-form" id="ruble-reg">
                        <div class="form-group">
                            <label id="lbl-email" class="col-sm-3 ruble-label"> <?= lang('x-ru-3');?><cite class="req">*</cite></label>
                            <div id="div-email" class="col-sm-9">
                                <input name="email" type="email" class="form-control round-0" id="inputEmail3" placeholder="<?= lang('x-ru-3');?>">
                                <span class="red pull-r"><?php echo  form_error('email')?> </span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label id="lbl-fullname" class="col-sm-3 ruble-label"> <?= lang('x-ru-4');?><cite class="req">*</cite></label>
                            <div id="div-fullname" class="col-sm-9">
                                <input name="full_name" type="text" class="form-control round-0" id="full" placeholder="<?= lang('x-ru-4');?>">
                                <span class="red pull-r"><?php echo  form_error('full_name')?> </span>
                            </div>

                        </div>
                        <div class="form-group ruble-submit">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn-submit"> <?= lang('x-ru-5');?></button>
                            </div><div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5">
                <img src="<?= $this->template->Images() ?>ruble-img.png" class="img-responsive ruble-img" alt="" />
            </div>
        </div>
    </div>
</div>


<!-- end content -->
<?= $this->load->ext_view('modal', 'validate-cyrillic', '', TRUE); ?>
<?= $this->load->ext_view('modal', 'validate-cyrillic-2', '', TRUE); ?>

<script type="text/javascript">
    var language = "<?=FXPP::html_url()?>";
    str = language.replace(/\s/g, "");
    console.log(str);
    if (str=='ru'){
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



    <script type="text/javascript">
        $( document ).ready( function () {
            $.validator.addMethod(
                "regex",
                function(value, element, regexp) {
                    var re = new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                },
                "Please check your input."
            );


            $('#ruble-reg').validate({ // initialize the plugin
                rules: {
                    email: {
                        regex: cyrillic
                    },
                    full_name:{
                        regex: cyrillic
                    }
                },
                messages: {
                    email:{
                        regex:"The characters you have entered are not yet supported. You can only enter English and Russian characters."
                    },
                    full_name:{
                        regex:"The characters you have entered are not yet supported. You can only enter English and Russian characters."
                    }
                },
                submitHandler: function (form) {
                    return true;
                }
            });

        });
    </script>
