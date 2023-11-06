<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title><?php echo lang('ave_00'); ?> <?php echo $site_name; ?>!</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
    <?php $this->lang->load('activate_email');?>
    <table width="80%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="5%"></td>
            <td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
                <h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;"><?php echo lang('ave_00'); ?> <?php echo $site_name; ?>!</h2>
                <?php echo lang('ave_01'); ?> <?php echo $site_name; ?>. <?php echo lang('ave_02'); ?>.<br />
                <?php echo lang('ave_03'); ?>:<br />
                <br />
                <big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo FXPP::loc_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo lang('ave_12'); ?>...</a></b></big><br />
                <br />
                <?=lang('ave_11')?>:<br />
                <nobr><a href="<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?></a></nobr><br />
                <br />
                <?php echo lang('ave_04'); ?> <?php echo $activation_period; ?> <?php echo lang('ave_05'); ?>.<br />
                <br />
                <br />
                <?php if (strlen($username) > 0) { ?><?php echo lang('ave_06'); ?>: <?php echo $username; ?><br /><?php } ?>
                <?php echo lang('ave_07'); ?>: <?php echo $email; ?><br />
                <?php if (isset($password)) { /* ?>Your password: <?php echo $password; ?><br /><?php */ } ?>
                <br />
                <br />
                <?php echo lang('ave_08'); ?>!<br />
                <?php echo lang('ave_09'); ?> <?php echo $site_name; ?> <?php echo lang('ave_10'); ?>
            </td>
        </tr>
    </table>
</div>
</body>
</html>