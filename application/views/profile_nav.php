<?php $uri = $this->uri->segment(2);?>
<link href="<?= $this->template->Css()?>jquery.fileupload.css" rel="stylesheet">
<h1>My Profile</h1>

<div class="prof-tabs-holder" role="tabpanel">
    <ul role="tablist" class="prof-tabs">
        <li><a href="<?php echo base_url();?>profile/edit" class="<?=($uri == 'edit') ? 'prof-active' : '';?>">Edit Profile</a></li>
        <li><a href="<?php echo base_url();?>profile/change-password" class="<?=($uri == 'change-password') ? 'prof-active' : '';?>">Change Password</a></li>
        <li><a href="<?php echo base_url();?>profile/upload-documents" class="<?=($uri == 'upload-documents') ? 'prof-active' : '';?>">Upload Documents</a></li>
        <li><a href="<?php echo base_url();?>profile/platform-access" class="<?=($uri == 'platform-access') ? 'prof-active' : '';?>">Platform Access</a></li>
    </ul><div class="clearfix"></div>
</div>