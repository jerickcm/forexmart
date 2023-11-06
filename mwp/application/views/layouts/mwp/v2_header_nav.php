<header class="main-header">
    <!-- Logo -->
    <a href="javascript:;" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="<?= $this->template->Images()?>v2_images/fx_logo-sm.svg" width="70%"/></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><!-- Manager Web Panel --> <img src="<?= $this->template->Images()?>v2_images/fx_logo_white-sm.svg"/></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="style-notification-warning">3</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have <strong>3</strong> notifications</li>
                        <li>
                            <ul class="menu style-menu-notification"></ul>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?=base_url()?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?=$this->session->userdata('full_name');?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?=base_url()?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            <p><?=$this->session->userdata('full_name');?></p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="style-profile-button">
                                <a href="<?=site_url('Signout')?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>
<script src="<?=base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>
    $(document).ready(function () {
        var base_url = "<?php echo FXPP::ajax_url('quick_jump/getLogs')?>//";
        $.ajax({
            type: 'POST',
            url: base_url,
            dataType: 'json',
            beforeSend: function(){ $('#loader-holder').show(); },
            success: function(data) {
                $('.style-menu-notification').html(data.notifs);
            }
        });
    });
</script>