<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meet_us_offline extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Events_model');
        $this->load->library('pagination');
        $this->load->helper("url");
        $this->lang->load('meetusoffline');
        $this->nlanguage = FXPP::html_url();
    }

    public function index(){
            $page = 1;
            $r1 =   $this->Events_model->get_featured($this->nlanguage)['rows'];
            if(count($r1)>0){
                $data['featured'] = $r1;
            }else if(count($r1)<=0 && $this->nlanguage!='en'){
                $r1 =   $this->Events_model->get_featured('EN')['rows'];
                $data['featured'] = $r1;
            }
            $f_id = $data['featured'][0]->offevents_ID;
            $res 			= $this->Events_model->get('*','exhibit_images','event_id',$f_id);
            $data['images'] = $res['rec_img'];

                $results = $this->Events_model->get_all_events(4, (($page-1)*4),$this->nlanguage);
                if($results['num_rows']>1) { $results = $results; }else{ $results = $this->Events_model->get_all_events(4, (($page-1)*4),'en'); }
                $count = $results['num_rows'];
                $this->load->library('pagination');
                $config['base_url'] =  base_url().'meet_us_offline';
                $config['total_rows'] = $count;
                $config['per_page'] = 4;
                $config['num_links'] = 4;
                $config['page'] = $page;
                $config['use_page_numbers'] = TRUE;
                $config['first_link'] = '<';
                $config['prev_link'] = '&laquo;';
                $config['last_link'] = '>';
                $config['next_link'] = '&raquo;';
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
                $config['uri_segment'] = 3;
                $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li class="latest-page">';
                $config['num_tag_close'] = '</li>';
                $this->pagination->initialize($config);
                $page_links = $this->pagination->create_links();
                $data['exhibition_pagination'] = $page_links;
                if(count( $results['rows'] )>0){$data['events']=$results['rows'];}
//            if(IPLoc::Office()){ $build = 'meetusoffline';}else{ $build = 'external_meetusoffline'; }
            $data['data']['metadata_description'] = lang('muf_dsc');
            $data['data']['metadata_keyword'] = lang('muf_kew');
            $this->template->title(lang('muf_tit'))
                ->set_layout('external/main')
                ->build('meetusoffline', $data);
    }
    public function exhibitions(){
            $this->lang->load('meetusoffline');
        $this->load->helper('thumb');
            if($this->nlanguage!='en'){
                $post_ID 		= $this->uri->segment(4);
            }else{
                $post_ID 		= $this->uri->segment(3);
            }
            $table			= "offline_exhibitions";
            $field			= "offevents_ID";
            $results 		= $this->Events_model->get_post($table, $field, $post_ID);
            $data['articles'] = $results['record'];

            $res 			= $this->Events_model->get('*','exhibit_images','event_id',$post_ID);
            $data['img_arr']= $res['rec_img'];

            $data['heading'] = "Exhibitions";
            $l = 'offevents_ID !=';
            $res1			= $this->Events_model->get1('*','offline_exhibitions',$l,$post_ID, 'offevents_ID',$this->nlanguage);
            if(count($res1['rec_img']) >0){ $res1 = $res1; }else{ $res1 = $this->Events_model->get1('*','offline_exhibitions',$l,$post_ID, 'offevents_ID','en'); }
            if(count($res1['rec_img']) >0){$data['other']	= $res1['rec_img'];}

            $data['data']['metadata_description'] = lang('muf_dsc');
            $data['data']['metadata_keyword'] = lang('muf_kew');
            $this->template->title(lang('muf_tit'))
                ->set_layout('external/main')
                ->build('external_event', $data);
    }

    public function update( $page = 1 ){
        if($this->input->is_ajax_request()){
            $cur_page = $this->input->post('cur_page',true);
            if(!$cur_page || !is_numeric($page)){
                $page = 1;
            }
            $results = $this->Events_model->get_all_events(4, (($page-1)*4),$this->nlanguage);
            $record  = $results['rows'];
            $news_count =$results['num_rows'];
            $this->load->library('pagination');
            $config['base_url'] =  FXPP::ajax_url() . 'meet_us_offline';
            $config['total_rows'] = $news_count;
            $config['per_page'] = 4;
            $config['page'] = $page;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = '<';
            $config['prev_link'] = '&laquo;';
            $config['last_link'] = '>';
            $config['next_link'] = '&raquo;';
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
            // $config['uri_segment'] = 3;
            $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="latest-page">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $exhibition_pagination = $this->pagination->create_links();
            $latest_news_html = '';
            foreach( $record as $entry ){
                $str = preg_replace('/[[:space:]]+/', '-', $entry->title);
                $c = strip_tags(substr(htmlspecialchars_decode($entry->content, ENT_QUOTES), 0, 600));
                $latest_news_html .= '<div class="child-column-exhibition" style="" > <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 child-column-right-exhibition" style="width:96%;">
                    <a href="' . FXPP::ajax_url('meet-us-offline/exhibitions/' . $entry->offevents_ID.'/'.$str) . '" target="_blank">' . $entry->title . '</a>
                    <span>' . date('D M j H:i:s e Y', strtotime($entry->date)). '</span><p>'.$c.'...</p>
                </div></div>';
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('html_data' => $latest_news_html, 'html_page_links' => $exhibition_pagination)));
        }
    }
}