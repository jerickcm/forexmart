<link href="<?= $this->template->Css()?>meet-offline.css" rel="stylesheet">
<script type="text/javascript">
//
//    $(document).ready(function () {
//        $('.user-account').click(function(){
//            $('.btn-user-dropdown').toggle();
//            $('#flagmenu1').hide();
//        });
//        $('.loginname-drop').click(function(){
//            $('.btn-user-dropdown').toggle();
//            $('#flagmenu').hide();
//        });
//        $('.btn-reg').click(function(){
//            $('#flagmenu1').toggle();
//            $('.btn-user-dropdown').hide();
//        });
//        $('#flag_btn1').click(function(){
//            $('#flagmenu').toggle();
//            $('.btn-user-dropdown').hide();
//        });
//    });
    $(window).bind('scroll', function() {
        if ($(window).scrollTop() > 75) {
            $('#nav').addClass('nav-fix');
            $('#top').addClass('top-fix');
        }
        else {
            $('#nav').removeClass('nav-fix');
            $('#top').removeClass('top-fix');
        }
    });
    //PAGINATION
    var baseURL = '<?php echo FXPP::loc_url() ?>';
    var url;
    $(document).on('click', '.latest-page a', function(e){
        e.preventDefault();
        if(baseURL!='https://www.forexmart.com/'){
            url = '/Meet_us_offline/update/';
            console.log('1-yoe');
        }else{ url = 'Meet_us_offline/update/';console.log('2-yoe');}
        var q = jQuery(this).attr('href');
        var cur_page = q.substr(q.lastIndexOf('/') + 1);
        $.ajax({
            type: "POST",
            url: baseURL + url + cur_page,
            data: {cur_page : cur_page},
            dataType: 'JSON',
            cache: false,
            success: function(page) {
                $('#ul-latest-exhibitions').html(page.html_data);
                $('#exhibit-pages').html(page.html_page_links);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                /* console.log(xhr.status);
                console.log(thrownError);*/
            }
        });
        return false;
    });
</script>
<div class="news-parent-container">
    <div class="container">
        <div class="col-lg-offset-1 col-lg-10 col-md-offset-2 col-md-8 col-sm-offset-0 col-sm-12 col-xs-offset-0 col-xs-12">
            <div class="exhibitions-container">
                <?php if(isset($featured)){
                        $i = 0;
                        foreach ($featured as $item) {
                            if ($i == 0) {
                                $date = date("M d, Y", strtotime($item->date));
                                $time = date("h:i ", strtotime($item->date));
                                $str = preg_replace('/[[:space:]]+/', '-', $item->title);
                                ?>
                                <h1><a href="<?php echo FXPP::ajax_url('meet-us-offline/exhibitions/' . $item->offevents_ID.'/'.$str) ?>" target="_blank" data-id="<?php echo $item->offevents_ID;?>"><?php echo $item->title; ?></a></h1>
                                <span><?php echo $date; ?> | <?php echo $time; ?></span>
                                <?php if(isset($images)){
                                    $b = 0;
                                    foreach ($images as $img){

                                        if($b==0){
                                            $f = pathinfo($img->file_name, PATHINFO_EXTENSION);
                                            $vid = array("avi", "mp4");
                                            //  $img =  array("gif", "jpeg", "jpg", "png", "bmp");
                                            $cat = array_search($f,$vid);
                                            if($cat){
                                                $f_type = "video";
                                            }else{
                                                $f_type = "image";
                                            }

                                            if($f_type == "video"){?>
                                                <video style="width:100%;" controls>
                                                    <source src="<?= base_url() . 'assets/offline_images/' . $img->file_name ?> ">
                                                </video>
                                            <?php }else{ ?>
                                                <img src="<?= base_url() . 'assets/offline_images/' . $img->file_name ?>" class="img-responsive" style="width:100%;" alt="" />
                                            <?php }?>
                                            <?php
                                        }$b++;
                                    }
                                }?>
                                <p><?php echo htmlspecialchars_decode($item->content, ENT_QUOTES); ?></p>
                            <?php }
                            $i++;
                        }
                } ?>
            </div>
            <div class="other-exhibitions-container">
                <input type='hidden' id='current_page' />
                <input type='hidden' id='show_per_page' />
                <h1>Post Events of ForexMart</h1>
                <div id="ul-latest-exhibitions">
                    <?php
                    if(isset($events))
                    {
                            foreach($events as $entry)
                            {
                                    $date = date("D M j H:i:s e Y", strtotime($entry->date));
                                    $time = date("h:i ", strtotime($entry->date));
                                    //$str = preg_replace('/[[:space:]]+/', '-', $entry->title);
                                $str = "";
                                    $c = strip_tags(substr(htmlspecialchars_decode($entry->content, ENT_QUOTES), 0, 600));
                                    ?>
                                    <div class="child-column-exhibition" style="" >
                                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 child-column-right-exhibition" style="width:96%;">
                                            <a href="<?php echo FXPP::ajax_url('meet-us-offline/exhibitions/' . $entry->offevents_ID.'/'.$str) ?>" target="_blank"><?php echo $entry->title; ?></a>
                                            <span><?php echo $date;?></span>
                                            <p><?php echo $c.'....'; ?></p>
                                        </div>
                                    </div>
                    <?php }
                    }else{ ?>
                        <div class="child-column-exhibition" >
                            <span style="color:#337ab7;"> No exhibitions available.</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="pagination-holder" id="exhibit-pages">
                    <nav><?php echo $exhibition_pagination; ?></nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content -->


