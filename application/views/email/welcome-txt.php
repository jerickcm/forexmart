<?= lang('we_00'); ?> <?php echo $site_name; ?>,

<?= lang('we_01'); ?>  <?php echo $site_name; ?>. <?= lang('we_02'); ?> .
<?= lang('we_03'); ?> :

<?php echo site_url('/auth/login/'); ?>

<?php if (strlen($username) > 0) { ?>

    <?= lang('we_04'); ?> : <?php echo $username; ?>
<?php } ?>

<?= lang('we_05'); ?> : <?php echo $email; ?>

<?php /* Your password: <?php echo $password; ?>

*/ ?>
<?= lang('we_06'); ?>!
<?= lang('we_07'); ?>  <?php echo $site_name; ?> <?= lang('we_08'); ?>