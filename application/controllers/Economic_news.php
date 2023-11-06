<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Economic_news extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper("url");
        $this->load->model('Reviews_model');
        $this->lang->load('economicnews');
        $this->nlanguage = FXPP::html_url();
    }

    public function index(){
        $ip=FXPP::CI()->input->ip_address();
        //if(IPLoc::Office() || $ip=='88.198.94.228' || $ip=='78.46.185.187'){
//            print_r($ip);exit;
            $page = 1;
            switch($this->nlanguage){
                case 'en': case 'jp': case 'id': case 'de': case 'fr': case 'it': case 'sa': case 'es': case 'pt': case 'pl': case 'bg': case 'my':
                    $lang = 'en';break;
                case 'ru':
                    $lang = 'ru';break;
                default : $lang = 'en';break;
            }
            $results = $this->Reviews_model->fetchinfo(4, (($page-1)*4),$lang);
            //LATEST NEWS
            $data['latestnews'] = count($results['rows'])>0?$results['rows']:false;
            count($results['rows'])>0?$data['img']=$this->Reviews_model->get_news('*','econ_images','news_id',$results['rows'][0]->id,'date','DESC')['rows'][0]->file_name:false;
            //WEEKLY NEWS
            $weekresult = $this->Reviews_model->weeklynews(date("Y-m-d 23:59:59"),date('Y-m-d 00:00:00', strtotime('-1 week')) , $lang)['rows'];
            $wimgs = array();
            for($x = 0;$x<count($weekresult);$x++){
                $images = $this->Reviews_model->get_news('*','econ_images','news_id',$weekresult[$x]->id,'date','DESC')['rows'];
                $img = count($images)>0?base_url().'assets/economic_news/'.$images[0]->file_name:$this->template->Images().'sample-news-img.jpg';
                array_push($wimgs, $img);
            }
            $data['weeklynews'] = $weekresult;count($weekresult)>0?$results['rows']:false;
            $data['weeklyimg'] = $wimgs;


            //ALL NEWS
            $arr = array();
            foreach($results['rows'] as $key){
                $images = $this->Reviews_model->get_news('*','econ_images','news_id',$key->id,'date','DESC')['rows'];
                $img = count($images)>0?base_url().'/assets/economic_news/'.$images[0]->file_name:$this->template->Images().'sample-news-img.jpg';
                array_push($arr , $img);
            }
//            $count = $results['num_rows'];
//            $this->load->library('pagination');
//            $config['base_url'] = base_url() . 'economic-news';
//            $config['total_rows'] = $count;
//            $config['per_page'] = 4;
//            $config['num_links'] = 2;
//            $config['page'] = $page;
//            $config['use_page_numbers'] = TRUE;
//            $config['first_link'] = 'first';
//            $config['prev_link'] = 'prev';
//            $config['last_link'] = 'last';
//            $config['next_link'] = 'next';
//            $config['full_tag_open'] = '<ul class="tab-pagination pagination pagination-md">';
//            $config['full_tag_close'] = '</ul>';
//            $config['first_tag_open'] = '<li class="latest-page">';
//            $config['prev_tag_open'] = '<li class="latest-page">';
//            $config['last_tag_open'] = '<li class="latest-page">';
//            $config['next_tag_open'] = '<li class="latest-page">';
//            $config['first_tag_close'] = '</li>';
//            $config['prev_tag_close'] = '</li>';
//            $config['last_tag_close'] = '</li>';
//            $config['next_tag_close'] = '</li>';
////            $config['uri_segment'] = 3;
//            $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
//            $config['cur_tag_close'] = '</a></li>';
//            $config['num_tag_open'] = '<li class="latest-page">';
//            $config['num_tag_close'] = '</li>';
//            $this->pagination->initialize($config);
//            $page_links = $this->pagination->create_links();
           // $data['news_pagination'] = $page_links;
            $data['news_pagination'] = $this->paginate_page($page,$lang);
            if(count( $results['rows'] )>0){$data['econnews']=$results['rows']; $data['econimg'] = $arr;}

            $this->template->title("Economic News | ForexMart")
                ->set_layout('external/main')
                ->build('external_economicnews1', $data);
//        }else{
//            show_404();
//        }

    }

    public function update( $page = 1 ){
        if($this->input->is_ajax_request()){
            $lang = $this->input->post('lang',true);
            $cur_page = $lang!='en'?$cur_page = $this->uri->segment(4):$cur_page = $this->uri->segment(3);
            if(!$cur_page || !is_numeric($page)){ $page = 1; }else{$page=$cur_page;}
//            $results = $this->Reviews_model->fetchinfo(4, (($page-1)*4),$lang);
//            echo "<pre>";
//            print_r('Offset='.($page-1)*4);
//            echo "<br>";
//            print_r($results);
//            echo "<br>";
//            print_r('cur page='.$cur_page);
//            exit;
            $data['news_pagination'] = $this->paginate_page($page,$lang);
            $results = $this->Reviews_model->fetchinfo(4, (($page-1)*4),$lang);
            $arr = array();
            foreach($results['rows'] as $key){
                $images = $this->Reviews_model->get_news('*','econ_images','news_id',$key->id,'date','DESC')['rows'];
                $img = count($images)>0?base_url().'assets/economic_news/'.$images[0]->file_name:$this->template->Images().'sample-news-img.jpg';
                array_push($arr , $img);
            }
            $record  = $results['rows'];
            $latest_news_html = '';
            $x = 0;
            foreach( $record as $key ){
                $str = preg_replace('/[[:space:]]+/', '-', $key->title);
                $rep = array(',','$','%','#','@','&','!','^','*','(',')','?','<','>','/','|','{','}','[','}');
                $str = str_replace($rep, '-', $str);
                $l = 'economic-news/article/'.$key->id.'/'.$str;
                $link1 = FXPP::loc_url($l);
                $wm = $this->template->Images().'fmwm/fx3.png';
                $title = $key->title;
                $date1 = date("F d, Y", strtotime($key->date_created));
                $cont1 = strip_tags($key->content);
                $cont = mb_substr($cont1, 0, 150);
                $lastSpace = strrpos($cont, ' ', 0);
                $content = mb_substr($cont,0,$lastSpace);

                $latest_news_html .= '
                <div class="col-md-6">
                    <div class="row all-news-row">
                        <a  href="'.$link1.'" target="_blank">
                       <div class="col-md-5 col-sm-5 col-xs-5 all-img-col">
							<div style="position: absolute;z-index: 1000;"><img src="'.$wm.'"  style="width:100%;height: auto;display: block;" ></div>
                            <div class="all-news-img">
                                <img src="'.$arr[$x].'" class="img-responsive news-img">
                            </div>
                        </div>
                        
                        <a  href="'.$link1.'" target="_blank">
                        <div class="col-md-7 col-sm-7 col-xs-7 all-img-col">
                            <div class="all-news-content-holder">
                                <h2>'.$title.'</h2>
                                <small>'.$date1.'</small>
                                <p>'.$content.'</p>
                            </div>
                        </div>
                        </a>
                        
                    </div>     
                    <div class="border-bot"></div>
                </div>';
                $x++;
            }
            $data = array(
                'html_data' => $latest_news_html,
                'html_page_links' => $data['news_pagination']
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    public function article(){
      //  if(IPLoc::Office()){
            $this->load->model('Events_model');
            $this->lang->load('economicnews');

            $post_ID = $this->nlanguage!='en'?$this->uri->segment(4):$this->uri->segment(3);
           // print_r($this->uri->segment(4));
            //print_r($post_ID);
            //exit;
                $table			= "tbl_economicnews";
                $field			= "id";
                $results 		= $this->Events_model->get_post($table, $field, $post_ID);
                $data['articles'] = $results['record'];
                $res 			= $this->Events_model->get('*','econ_images','news_id',$post_ID);
                $data['img_arr']= $res['rec_img'];

                $this->template->title("Economic News | ForexMart")
                    ->append_metadata_css('
                         <link rel="stylesheet" href="' . $this->template->Css() . 'econ_news.css">
                 ')
                    ->set_layout('external/main')
                    ->build('external_economicnewsarticle', $data);
//        }else{
//            show_404();
//        }
    }
    public function paginate_page($page,$lang){
        $results = $this->Reviews_model->fetchinfo(4, (($page-1)*4),$lang);
        $count = $results['num_rows'];
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'economic-news';
        $config['total_rows'] = $count;
        $config['per_page'] = 4;
        //$config['num_links'] = 2;
        $config['page'] = $page;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'first';
        $config['prev_link'] = 'prev';
        $config['last_link'] = 'last';
        $config['next_link'] = 'next';
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
//            $config['uri_segment'] = 3;
        $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="latest-page">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page_links = $this->pagination->create_links();
        return $page_links;
    }
}