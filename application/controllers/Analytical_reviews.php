<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytical_reviews extends MY_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reviews_model');
        $this->load->library('pagination');
        $this->load->helper("url");
        $this->lang->load("analyticalreview");
        $this->nlanguage = FXPP::html_url();
    }

    public function index(){
        // if(IPLoc::Office()){
            $this->today();
        // }
        // else{
        //     $this->index2();       
        // }
    }
    public function index2(){
      // if(IPLoc::Office()){
            $page = 1;
    
          //  $results = $this->Reviews_model->get_all_reviews(3, (($page-1)*3));
            $results = $this->Reviews_model->get_all_reviewsWLan(3, (($page-1)*3),(FXPP::html_url()=="ru")?FXPP::html_url():"en");
            $count = $results['num_rows'];
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'analytical-reviews';
            $config['total_rows'] = $count;
            $config['per_page'] = 3;
            $config['num_links'] = 4;
            $config['page'] = $page;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = lang('page_f');
            $config['prev_link'] = lang('page_p');
            $config['last_link'] = lang('page_l');
            $config['next_link'] = lang('page_n');
            $config['full_tag_open'] = '<ul class="tab-pagination pagination pagination-md">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="latest-page">';
            $config['prev_tag_open'] = '<li class="latest-page">';
            $config['last_tag_open'] = '<li class="latest-page">';
            $config['next_tag_open'] = '<li class="latest-page">';
            $config['first_tag_close'] = '</li>';
            $config['prev_tag_close'] = '</li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_close'] = '</li>';
            $config['uri_segment'] = (FXPP::html_url()=="en")?3:4;
            $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="latest-page">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $page_links = $this->pagination->create_links();

            $data['pagination'] = $page_links;
            if(count( $results['rows'] )>0){ $data['pubs']=$results['rows'];}
            $data['data']['metadata_description'] = lang('ar_dsc');
            $data['data']['metadata_keyword'] = lang('ar_dsc');
            $this->template->title('Analytical Reviews')
                ->set_layout('external/main')
                ->build('external_analyticalreview', $data);
//        }else{
//            show_404();
//        }

    }

    public function read_more(){
          $post_ID = $this->nlanguage!='en'?$this->uri->segment(5):$this->uri->segment(4);          
          if(preg_match("/[a-z]/i", $post_ID)){$post_ID=$this->uri->segment(4);}
          if(preg_match("/[a-z]/i", $post_ID)){$post_ID=$this->uri->segment(3);}
       
                $table = "review_publishes";
                $field = "user_id";
                $results = $this->Reviews_model->get_post($post_ID);
                $data['review'] = $results['rows'];

                $counter = 0;
                foreach ($data['review'] as $key) {
                    $counter = $key->count;
                    $counter++;
                }
                
                $cnt = array('count' => $counter);
                $this->Reviews_model->views_counter($post_ID,$cnt);

                $res = $this->Reviews_model->get('*','pub_images','pub_id',$post_ID);
                $data['img_arr']= $res['rec_img'];

                $data['data']['metadata_description'] = lang('ar_dsc');
                $data['data']['metadata_keyword'] = lang('ar_dsc');
                $this->template->title('Analytical Reviews')
                    ->set_layout('external/main')
                    ->build('external_review', $data);
    }
    
    
    public function limit_words($string, $word_limit){
        $words = explode(" ",$string);
        return implode(" ",array_splice($words,0,$word_limit));
    }
    
    public function update( $page = 1 ){
        if($this->input->is_ajax_request()){
            $cur_page = $this->input->post('cur_page',true);
            if(!$cur_page || !is_numeric($page)){
                $page = 1;
            }
            
            $langu=$this->input->post('langu',true);
            $langubackup=$langu;
            $langu=($langu=="ru")?$langu:"en";
            
            $results = $this->Reviews_model->get_all_reviewsWLan(3, (($page-1)*3),$langu);   
            $record  = $results['rows'];
            $news_count =$results['num_rows'];
            $this->load->library('pagination');
            $config['base_url'] = base_url(). 'analytical-reviews';
            $config['total_rows'] = $news_count;
            $config['per_page'] = 3;
            $config['num_links'] = 4;
            $config['page'] = $page;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = lang('page_f');
            $config['prev_link'] = lang('page_p');
            $config['last_link'] = lang('page_l');
            $config['next_link'] = lang('page_n');
            $config['full_tag_open'] = '<ul class="tab-pagination pagination pagination-md">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="latest-page">';
            $config['prev_tag_open'] = '<li class="latest-page">';
            $config['last_tag_open'] = '<li class="latest-page">';
            $config['next_tag_open'] = '<li class="latest-page">';
            $config['first_tag_close'] = '</li>';
            $config['prev_tag_close'] = '</li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_close'] = '</li>';
            $config['uri_segment'] =(FXPP::html_url()=="en")?3:4;
            $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="latest-page">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);

            $pagination = $this->pagination->create_links();
            $latest_news_html = '';

            foreach( $record as $entry ){
                $str = preg_replace('/[[:space:]]+/', '-', $entry->title);
                $str=str_replace(","," ",$str);                
                $date = date("F j, Y", strtotime($entry->date_modified));
                    $dateMonth = date("F", strtotime($entry->date_modified));
                    $dateday = date("j", strtotime($entry->date_modified));
                    $dateyear = date("Y", strtotime($entry->date_modified));
                    $fullDate=Fx_lang_date::getFullMonth($langubackup,$dateMonth)." ".$dateday.", ".$dateyear;
  
                
                $time = date("h:i a", strtotime($entry->date_modified));
                if($entry->image !=''){  $avatar = base_url('assets/reviews/'.$entry->image); }else{ $avatar = base_url('assets/reviews/default-avatar.png');}
                 if($langu=="en"){$langu;}else{$langu=$langu."/";}
                $msurl=base_url().$langu."/analytical-reviews/read-more/".$entry->id."/".$str;
                
                 
                     $content=$this->limit_words($entry->content,100);
                    
                    $content=(strip_tags($content));
                    $content=(htmlspecialchars($content, ENT_QUOTES,'UTF-8',true));
                   $content=htmlspecialchars_decode($content,ENT_QUOTES);
                
                
                $latest_news_html .= ' <div class="col-md-12">
                                        <div id="latest-reviews">
                                            <div class="reviews-holder">
                                                <div class="row"> 
                                                    <div class="col-md-1 col-sm-2 col-xs-2 col-avatar">
                                                        <div class="review-avatar-holder">
                                                            <img src="'. $avatar.'" class="img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-11 col-sm-10 col-xs-10 col-reviews">
                                                        <p class="reviews-date">'.$fullDate.'<span> '.$time.'</span></p>
                                                        <p class="reviews-title" style="font-size: 15px">'.$entry->full_name.'</p> 
                                                        <a href="'.$msurl.'" target="_blank" class="reviews-title">'.$entry->title.'</a>
                                                       <a  style="color: #555;text-align: left;" href="'.$msurl.'" target="_blank" class="reviews-readmore">
                                                        <p class="reviews-content">'.$content.'...</p>
                                                        </a>
                                                       <a href="'.$msurl.'" target="_blank" class="reviews-readmore">'.lang('redm').'</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>';

            }
            
            if($latest_news_html)
            {
            echo $latest_news_html."_________________________".$pagination;
            }
            else
            {
                echo "<p style=' text-align: center;color:red'>".lang('no_data').".</p>";
            }
           // $this->output->set_content_type('application/json')->set_output(json_encode(array('html_data' => $latest_news_html, 'html_page_links' => $pagination)));
        }
    }

    public function yesterday(){
        if(IPLoc::Office()){
        $yesterday =  date('Y-F-d',strtotime("yesterday"));

        $page = 1;

        $results = $this->Reviews_model->get_yesterday_reviewsWLan(3, (($page-1)*3),FXPP::html_url(),$yesterday);
        $record  = $results['rows'];
        $count = $results['num_rows'];

        if(empty($record)){
            //echo "<p style=' text-align: center;color:red'>".lang('no_data').".</p>";
        }
        else{
            $this->load->library('pagination');
            $config['base_url'] = FXPP::loc_url().'/analytical-reviews/yesterday';   
            $config['total_rows'] = $count;
            $config['per_page'] = 3;
            $config['num_links'] = 4;
            $config['page'] = $page;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = lang('page_f');
            $config['prev_link'] = lang('page_p');
            $config['last_link'] = lang('page_l');
            $config['next_link'] = lang('page_n');
            $config['full_tag_open'] = '<ul class="tab-pagination pagination pagination-md">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="latest-page">';
            $config['prev_tag_open'] = '<li class="latest-page">';
            $config['last_tag_open'] = '<li class="latest-page">';
            $config['next_tag_open'] = '<li class="latest-page">';
            $config['first_tag_close'] = '</li>';
            $config['prev_tag_close'] = '</li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_close'] = '</li>';
            $config['uri_segment'] = (FXPP::html_url()=="en")?3:4;
            $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="latest-page">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $page_links = $this->pagination->create_links();
            $data['pagination'] = $page_links;
        }
        if(count( $results['rows'] )>0){ $data['pubs']=$results['rows'];}
        
        $data['data']['metadata_description'] = lang('ar_dsc');
        $data['data']['metadata_keyword'] = lang('ar_dsc');
        
        $this->template->title('Analytical Reviews')
            ->set_layout('external/main')
            ->build('external_analyticalreview_yest', $data);
        }else{
            $this->load->view('errors/html/error_404');
        }
    }

    public function yes_update( $page = 1 ){
            $yesterday =  date('Y-F-d',strtotime("yesterday"));

            if($this->input->is_ajax_request()){
                $cur_page = $this->input->post('cur_page',true);
                if(!$cur_page || !is_numeric($page)){
                    $page = 1;
                }

                $langu=$this->input->post('langu',true);
                $results = $this->Reviews_model->get_yesterday_reviewsWLan(3, (($page-1)*3),FXPP::html_url(),$yesterday);
                
                $record  = $results['rows'];
                $news_count =$results['num_rows'];
            
                $this->load->library('pagination');

                $config['base_url'] = FXPP::loc_url().'/analytical-reviews/yesterday';   
                $config['total_rows'] = $news_count;
                $config['per_page'] = 3;
                $config['num_links'] = 4;
                $config['page'] = $page;
                $config['use_page_numbers'] = TRUE;
                $config['first_link'] = lang('page_f');
                $config['prev_link'] = lang('page_p');
                $config['last_link'] = lang('page_l');
                $config['next_link'] = lang('page_n');
                $config['full_tag_open'] = '<ul class="tab-pagination pagination pagination-md">';
                $config['full_tag_close'] = '</ul>';
                $config['first_tag_open'] = '<li class="latest-page">';
                $config['prev_tag_open'] = '<li class="latest-page">';
                $config['last_tag_open'] = '<li class="latest-page">';
                $config['next_tag_open'] = '<li class="latest-page">';
                $config['first_tag_close'] = '</li>';
                $config['prev_tag_close'] = '</li>';
                $config['last_tag_close'] = '</li>';
                $config['next_tag_close'] = '</li>';
                $config['uri_segment'] = ($langu=="en")?3:4;;
                $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li class="latest-page">';
                $config['num_tag_close'] = '</li>';

                    $this->pagination->initialize($config);

                    $pagination = $this->pagination->create_links();
                    $latest_news_html = '';

                    foreach( $record as $entry ){
                        $str = preg_replace('/[[:space:]]+/', '-', $entry->title);
                        $str=str_replace(","," ",$str);       
                        $date = date("F j, Y", strtotime($entry->date_modified));
                        $dateMonth = date("F", strtotime($entry->date_modified));
                        $dateday = date("j", strtotime($entry->date_modified));
                        $dateyear = date("Y", strtotime($entry->date_modified));
                        $fullDate=Fx_lang_date::getFullMonth($langu,$dateMonth)." ".$dateday.", ".$dateyear;
                        
                        $time = date("h:i a", strtotime($entry->date_modified));
                        if($entry->image !=''){  $avatar = base_url('assets/reviews/'.$entry->image); }else{ $avatar = base_url('assets/reviews/default-avatar.png');}
                        if($langu==" "){$langu;}else{$langu=$langu."/";}
                        $msurl=base_url().$langu."analytical-reviews/read-more/".$entry->id."/".$str;
                        
                        $latest_news_html .= ' <div class="col-md-12">
                                                <div id="latest-reviews">
                                                    <div class="reviews-holder">
                                                        <div class="row"> 
                                                            <div class="col-md-1 col-sm-2 col-xs-2 col-avatar">
                                                                <div class="review-avatar-holder">
                                                                    <img src="'. $avatar.'" class="img-responsive">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-11 col-sm-10 col-xs-10 col-reviews">
                                                                <p class="reviews-date">'.$fullDate.'<span> '.$time.'</span></p>
                                                                <p class="reviews-title" style="font-size: 15px">'.$entry->full_name.'</p> 
                                                                <a href="'.$msurl.'" target="_blank" class="reviews-title">'.$entry->title.'</a>
                                                               <a  style="color: #555;text-align: left;" href="'.$msurl.'" target="_blank" class="reviews-readmore">
                                                                <p class="reviews-content">'.substr(htmlspecialchars_decode($entry->content, ENT_QUOTES), 0, 600) .'...</p>
                                                                </a>
                                                               <a href="'.$msurl.'" target="_blank" class="reviews-readmore">'.lang('redm').'</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>';  

                    }

                    if($latest_news_html){
                        echo $latest_news_html."_________________________".$pagination;
                    }
                    else{
                        echo "<p style=' text-align: center;color:red'>".lang('no_data').".</p>";
                    }
            }
        }

    public function today(){
            $today =  date('Y-F-d',strtotime("today"));
            $page = 1;
            $langu=FXPP::html_url();
            $langubackup=$langu;
            $langu=($langu=="ru")?$langu:"en";
            $results = $this->Reviews_model->get_yesterday_reviewsWLan(10, (($page-1)*10),$langu,$today);
            $results1 = $this->Reviews_model->get_past_reviews(3, (($page-1)*3),$langu, $today);
            $record  = $results['rows'];
            $count = $results['num_rows'];

            if(empty($record)){
                //echo "<p style=' text-align: center;color:red'>".lang('no_data').".</p>";
            }
            else{
                $this->load->library('pagination');
                $config['base_url'] = FXPP::loc_url().'/analytical-reviews/today';
                $news_count =$results1['num_rows'][0]->count;
                $config['total_rows'] = $news_count;
                $config['per_page'] = 3;
                $config['num_links'] = 4;
                $config['page'] = $page;
                $config['use_page_numbers'] = TRUE;
                $config['first_link'] = lang('page_f');
                $config['prev_link'] = lang('page_p');
                $config['last_link'] = lang('page_l');
                $config['next_link'] = lang('page_n');
                $config['full_tag_open'] = '<ul class="tab-pagination pagination pagination-md">';
                $config['full_tag_close'] = '</ul>';
                $config['first_tag_open'] = '<li class="latest-page">';
                $config['prev_tag_open'] = '<li class="latest-page">';
                $config['last_tag_open'] = '<li class="latest-page">';
                $config['next_tag_open'] = '<li class="latest-page">';
                $config['first_tag_close'] = '</li>';
                $config['prev_tag_close'] = '</li>';
                $config['last_tag_close'] = '</li>';
                $config['next_tag_close'] = '</li>';
                $config['uri_segment'] = (FXPP::html_url()=="en")?3:4;
                $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li class="latest-page">';
                $config['num_tag_close'] = '</li>';
                $this->pagination->initialize($config);
                $page_links = $this->pagination->create_links();
                $data['pagination'] = $page_links;
            }
            if(count( $results['rows'] )>0){ 
                $data['pubs']=$results['rows'];
                $data['data']['metadata_description'] = lang('ar_dsc');
                $data['data']['metadata_keyword'] = lang('ar_dsc');
                
                $this->template->title('Analytical Reviews')
                    ->set_layout('external/main')
                    ->build('external_analyticalreview_tod', $data);
            }else{
                $this->index2();
             }        

    }

    public function tod_update( $page = 1 ){
        $today =  date('Y-F-d',strtotime("today"));
        if($this->input->is_ajax_request()){
            $cur_page = $this->input->post('cur_page',true);
            $langu=$this->input->post('langu',true);
            $langubackup=$langu;
            $langu=($langu=="ru")?$langu:"en";

            if(!$cur_page || !is_numeric($page)){
                $page = 1;
                $results = $this->Reviews_model->get_yesterday_reviewsWLan(10, (($page-1)*10),$langu,$today);
            }else{

                $results = $this->Reviews_model->get_past_reviews(3, (($page-1)*3),$langu, $today);
            }

            $results1 = $this->Reviews_model->get_past_reviews(3, (($page-1)*3),$langu, $today);
                $record  = $results['rows'];
                $news_count =$results1['num_rows'][0]->count;
                $this->load->library('pagination');
                $config['base_url'] = base_url(). 'analytical-reviews';
                $config['total_rows'] = $news_count;
                $config['per_page'] = 3;
                $config['num_links'] = 4;
                $config['page'] = $page;
                $config['use_page_numbers'] = TRUE;
                $config['first_link'] = lang('page_f');
                $config['prev_link'] = lang('page_p');
                $config['last_link'] = lang('page_l');
                $config['next_link'] = lang('page_n');
                $config['full_tag_open'] = '<ul class="tab-pagination pagination pagination-md">';
                $config['full_tag_close'] = '</ul>';
                $config['first_tag_open'] = '<li class="latest-page">';
                $config['prev_tag_open'] = '<li class="latest-page">';
                $config['last_tag_open'] = '<li class="latest-page">';
                $config['next_tag_open'] = '<li class="latest-page">';
                $config['first_tag_close'] = '</li>';
                $config['prev_tag_close'] = '</li>';
                $config['last_tag_close'] = '</li>';
                $config['next_tag_close'] = '</li>';
                $config['uri_segment'] =(FXPP::html_url()=="en")?3:4;
                $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li class="latest-page">';
                $config['num_tag_close'] = '</li>';
                $this->pagination->initialize($config);

                $pagination = $this->pagination->create_links();
                $latest_news_html = '';

                foreach( $record as $entry ){
                    $str = preg_replace('/[[:space:]]+/', '-', $entry->title);
                    $str=str_replace(","," ",$str);
                    $date = date("F d, Y", strtotime($entry->date_created));
                    $dateMonth = date("F", strtotime($entry->date_created));
                    $dateday = date("d", strtotime($entry->date_created));
                    $dateyear = date("Y", strtotime($entry->date_created));
                    $fullDate=Fx_lang_date::getFullMonth($langubackup,$dateMonth)." ".$dateday.", ".$dateyear;


                    $time = date("h:i a", strtotime($entry->date_created));
                    if($entry->image !=''){  $avatar = base_url('assets/reviews/'.$entry->image); }else{ $avatar = base_url('assets/reviews/default-avatar.png');}
                    if($langu=="en"){$langu;}else{$langu=$langu."/";}
                    $msurl=base_url().$langu."/analytical-reviews/read-more/".$entry->id."/".$str;

                    if(!$cur_page || !is_numeric($page)){
                        $page = 1;
                        $content=$this->limit_words($entry->content,60);
                    }else{
                        $content=$this->limit_words($entry->content,100);
                    }

                    //$content=$this->limit_words($entry->content,100);

                    $content=(strip_tags($content));
                    $content=(htmlspecialchars($content, ENT_QUOTES,'UTF-8',true));
                    $content=htmlspecialchars_decode($content,ENT_QUOTES);


                    $latest_news_html .= ' <div class="col-md-12">
                                        <div id="latest-reviews">
                                            <div class="reviews-holder">
                                                <div class="row"> 
                                                    <div class="col-md-1 col-sm-2 col-xs-2 col-avatar">
                                                        <div class="review-avatar-holder">
                                                            <img src="'. $avatar.'" class="img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-11 col-sm-10 col-xs-10 col-reviews">
                                                        <p class="reviews-date">'.$fullDate.'<span> '.$time.'</span></p>
                                                        <p class="reviews-title" style="font-size: 15px">'.$entry->full_name.'</p> 
                                                        <a href="'.$msurl.'" target="_blank" class="reviews-title">'.$entry->title.'</a>
                                                       <a  style="color: #555;text-align: left;" href="'.$msurl.'" target="_blank" class="reviews-readmore">
                                                        <p class="reviews-content">'.$content.'...</p>
                                                        </a>
                                                       <a href="'.$msurl.'" target="_blank" class="reviews-readmore">'.lang('redm').'</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>';

                }

                if($latest_news_html)
                {
                    echo $latest_news_html."_________________________".$pagination;
                }
                else{
                    echo "<p style=' text-align: center;color:red'>".lang('no_data').".</p>";
                }
        }
    }

    public function past_news(){
        if(IPLoc::Office()){
            $today =  date('Y-F-d',strtotime("today"));
            $page = 1;
    
            $results = $this->Reviews_model->get_yesterday_reviewsWLan(3, (($page-1)*3),FXPP::html_url(),$today);
            $langu=FXPP::html_url();
            $langubackup=$langu;
            $langu=($langu=="ru")?$langu:"en";
            $results1 = $this->Reviews_model->get_past_reviews(3, (($page-1)*3),$langu, $today);
            $record  = $results['rows'];
            $count = $results['num_rows'];

            if(empty($record)){
                //echo "<p style=' text-align: center;color:red'>".lang('no_data').".</p>";
            }
            else{
                $this->load->library('pagination');
                $config['base_url'] = FXPP::loc_url().'/analytical-reviews/today';
                $news_count =$results1['num_rows'][0]->count;
                $config['total_rows'] = $news_count;
                $config['per_page'] = 3;
                $config['num_links'] = 4;
                $config['page'] = $page;
                $config['use_page_numbers'] = TRUE;
                $config['first_link'] = lang('page_f');
                $config['prev_link'] = lang('page_p');
                $config['last_link'] = lang('page_l');
                $config['next_link'] = lang('page_n');
                $config['full_tag_open'] = '<ul class="tab-pagination pagination pagination-md">';
                $config['full_tag_close'] = '</ul>';
                $config['first_tag_open'] = '<li class="latest-page">';
                $config['prev_tag_open'] = '<li class="latest-page">';
                $config['last_tag_open'] = '<li class="latest-page">';
                $config['next_tag_open'] = '<li class="latest-page">';
                $config['first_tag_close'] = '</li>';
                $config['prev_tag_close'] = '</li>';
                $config['last_tag_close'] = '</li>';
                $config['next_tag_close'] = '</li>';
                $config['uri_segment'] = (FXPP::html_url()=="en")?3:4;
                $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li class="latest-page">';
                $config['num_tag_close'] = '</li>';
                $this->pagination->initialize($config);
                $page_links = $this->pagination->create_links();
                $data['pagination'] = $page_links;
            }
            if(count( $results['rows'] )>0){ $data['pubs']=$results['rows'];}
            
            $data['data']['metadata_description'] = lang('ar_dsc');
            $data['data']['metadata_keyword'] = lang('ar_dsc');
            
            $this->template->title('Analytical Reviews')
                ->set_layout('external/main')
                ->build('external_analyticalreview', $data);
        }else{
            $this->load->view('errors/html/error_404');
        }
    }
}
?>