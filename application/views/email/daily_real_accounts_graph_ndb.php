<?php $this->load->view('email/_email_header');?>
    <div class="wrapper-body" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 10px 0;margin-top: 3px;border-top: 1px solid #2988ca;border-bottom: 1px solid #2988ca;padding-bottom: 20px;">
        <h2 class="h1" style="margin: 0 auto;font-family: Georgia;font-weight: 400;font-size: 25px;color: #2988ca;margin-top: 30px;margin-bottom: 10px;border-bottom: 1px solid #2988ca;padding-bottom: 10px;padding-left: 15px;">NDB Clients Statistics - <?php echo isset($form)? $form." to ".$to : date('m/d/Y', strtotime('now')) ?></h2>
        <img src="<?php echo $img_val ?>" style="width: 100%; margin: 0 auto; display: table;"/>

    </div>
<?php //$this->load->view('email/_email_footer');?>

