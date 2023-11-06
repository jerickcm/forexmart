<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class News2 extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model'); $this->load->model('news_model_v2');
        $this->load->helper('thumb');
        $this->nlanguage = FXPP::html_url();
    }




    public function article( $id = 0 ){
        $this->lang->load('news');
        $this->lang->load('Location');
        $isExist = $this->news_model_v2->isNewsExist($id);
        // echo $this->db->last_query(); exit();
        if($isExist) {
            $news = $this->news_model_v2->getNewsById($id);
            if($news['enabled']){
                $page = 1;
                $most_read_news = array();
                $most_read_news_new = $this->news_model_v2->getMostReadNewsByLimit(5, (($page-1)*5), $this->nlanguage);
                foreach ($most_read_news_new as $key => $value) {
                    if ($value['isEmpty']==1) {
                        $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                        $most_read_news_new[$key]['file_name'] = $news_images[0]['file_name'];
                        array_push($most_read_news,$most_read_news_new[$key]);
                    } else {
                        $most_read_news_en = $this->news_model_v2->getNewsById($value['news_id']);
                        $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['news_id']);
                        $most_read_news_en['file_name'] = $news_images[0]['file_name'];
                        $most_read_news_en['id2'] = $most_read_news_new[$key]['id'];
                        array_push($most_read_news,$most_read_news_en );
                    }
                }

                $data['most_read_news'] = $most_read_news;
                if(count($data['most_read_news']) <= 0){
                    $most_read_news = array();
                    $most_read_news_new = $this->news_model_v2->getMostReadNewsByLimit(5, (($page-1)*5), 'EN');
                    foreach ($most_read_news_new as $key => $value) {
                        if ($value['isEmpty']==1) {
                            $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                            $most_read_news_new[$key]['file_name'] = $news_images[0]['file_name'];
                            array_push($most_read_news,$most_read_news_new[$key]);
                        } else {
                            $most_read_news_en = $this->news_model_v2->getNewsById($value['news_id']);
                            $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['news_id']);
                            $most_read_news_en['file_name'] = $news_images[0]['file_name'];
                            $most_read_news_en['id2'] = $most_read_news_new[$key]['id'];
                            array_push($most_read_news,$most_read_news_en );
                        }
                    }
                    $data['most_read_news'] = $most_read_news;
                }

                $news_images = $this->news_model_v2->getNewsImagesByNewsId($id);
                $data['news'] = $news;
                $title_text=$news['headline'];
                $data['news_images'] = $news_images;
                $update_data = array(
                    'read' => ((int) $news['read']) + 1
                );

                $last_uri = $this->uri->total_segments();
                $real_id = $this->uri->segment($last_uri);
                if($real_id){
                    $real_news = $this->news_model_v2->getNewsById($real_id);
                    if($real_news['enabled']) {
                        $update_data = array( 'read' => ((int) $real_news['read']) + 1);
                    }
                }else{
                    $real_id = $id;
                }
                $this->news_model_v2->updateNewsById($real_id, $update_data);
                $news_headlines = array();
                $news_headlines_new =$this->news_model_v2->getNewsHeadline($this->nlanguage);
                foreach ($news_headlines_new as $key => $value) {
                    if ($value['isEmpty']==1) {
                        $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                        $news_headlines_new[$key]['file_name'] = $news_images[0]['file_name'];
                        array_push($news_headlines, $news_headlines_new[$key]);
                    } else {
                        $news_headlines_en = $this->news_model_v2->getNewsById($value['news_id']);
                        $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['news_id']);
                        $news_headlines_en['file_name'] = $news_images[0]['file_name'];
                        $news_headlines_en['id2'] =  $news_headlines_new[$key]['id'];
                        array_push($news_headlines, $news_headlines_en);
                    }
                }




                $data['other_news'] =$news_headlines;
                $this->template->title($title_text)
                    ->set_layout('external/main')
                    ->build('news2/article', $data);
            }else{
                show_404();
            }
        }else{
            show_404();
        }
    }

    public function preview( $id = 0 ){
        $this->lang->load('news');
        $this->lang->load('Location');
        $isExist = $this->news_model_v2->isDisabledNewsExist($id);
        if ($isExist) {
            $news = $this->news_model_v2->getNewsById($id);

            if (!$news['enabled']) {
                $news_images = $this->news_model_v2->getNewsImagesByNewsId($id);
                $data['news'] = $news;
                $data['news_images'] = $news_images;
                $update_data = array(
                    'read' => ((int)$news['read']) + 1
                );
                $last_uri = $this->uri->total_segments();
                $real_id = $this->uri->segment($last_uri);
                if($real_id){
                    $real_news = $this->news_model_v2->getNewsById($real_id);
                    if($real_news['enabled']) {
                        $update_data = array( 'read' => ((int) $real_news['read']) + 1);
                    }
                }else{
                    $real_id = $id;
                }
                $this->news_model_v2->updateNewsById($real_id, $update_data);
                $news_headlines = array();
                $news_headlines_new =$this->news_model_v2->getNewsHeadline($this->nlanguage);
                foreach ($news_headlines_new as $key => $value) {
                    if ($value['isEmpty']==1) {
                        $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                        $news_headlines_new[$key]['file_name'] = $news_images[0]['file_name'];
                        array_push($news_headlines, $news_headlines_new[$key]);
                    } else {
                        $news_headlines_en = $this->news_model_v2->getNewsById($value['news_id']);
                        $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['news_id']);
                        $news_headlines_en['file_name'] = $news_images[0]['file_name'];
                        $news_headlines_en['id2'] = $news_headlines_new[$key]['id'];
                        array_push($news_headlines, $news_headlines_en);
                    }
                }
                $data['other_news'] = $news_headlines;
                $this->template->title("ForexMart | News")
                    ->set_layout('external/main')
                    ->build('news2/article', $data);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    public function updateLatestPage( $page = 1 ){
        if($this->input->is_ajax_request()){
            $cur_page = $this->input->post('cur_page',true);
            if(!$cur_page || !is_numeric($page)){
                $page = 1;
            }
            $latest_news = array();
            $latest_news_new = $this->news_model_v2->getLatestNewsByLimit(5, (($page-1)*5), $this->nlanguage);
            foreach ($latest_news_new  as $key => $value) {
                if ($value['isEmpty']==1) {
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                    $latest_news_new[$key]['file_name'] = $news_images[0]['file_name'];
                    array_push($latest_news,  $latest_news_new[$key]);
                } else {
                    $latest_news_en = $this->news_model_v2->getNewsById($value['news_id']);
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['news_id']);
                    $latest_news_en['file_name'] = $news_images[0]['file_name'];
                    $latest_news_en['id2'] = $latest_news_new[$key]['id'];
                    array_push($latest_news, $latest_news_en );
                }
            }

            $news_count = $this->news_model_v2->getAllNewsCount();
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'news2';
            $config['total_rows'] = $news_count;
            $config['per_page'] = 5;
            $config['num_links'] = 5;
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

            $latest_news_page_links = $this->pagination->create_links();
            $latest_news_html = '';
            foreach( $latest_news as $key => $news ){
                $publisher = (!empty( $news['publisher'] )) ? ' | By <a href="javascript:;" class="tab-news-author">' . $news['publisher'] . '</a> ' . $news['job'] : '';
                $latest_news_html .= '<li>
                    <a href="' . base_url('news/article/' . $news['id']) . '" target="_blank">' . $news['headline'] . '</a>
                    <span>' . date('D M j H:i:s e Y', strtotime($news['date_published'])) . $publisher . '</span>
                </li>';
            }

            $this->output->set_content_type('application/json')->set_output(json_encode(array('html_data' => $latest_news_html, 'html_page_links' => $latest_news_page_links)));
        }
    }

    public function updateMostReadPage( $page = 1 ){
        if($this->input->is_ajax_request()){
            $cur_page = $this->input->post('cur_page',true);
            if(!$cur_page || !is_numeric($page)){
                $page = 1;
            }

            $most_read_news = array();
            $most_read_news_new = $this->news_model_v2->getMostReadNewsByLimit(5, (($page-1)*5),'');
            foreach ($most_read_news_new as $key => $value) {
                if ($value['isEmpty']==1) {
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                    $most_read_news_new[$key]['file_name'] = $news_images[0]['file_name'];
                    array_push($most_read_news,$most_read_news_new[$key]);
                } else {
                    $most_read_news_en = $this->news_model_v2->getNewsById($value['news_id']);
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['news_id']);
                    $most_read_news_en['file_name'] = $news_images[0]['file_name'];
                    $most_read_news_en['id2'] = $most_read_news_new[$key]['id'];
                    array_push($most_read_news,$most_read_news_en );
                }
            }



            $news_count = $this->news_model_v2->getAllNewsCount();
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'news2';
            $config['total_rows'] = $news_count;
            $config['per_page'] = 5;
            $config['num_links'] = 5;
            $config['page'] = $page;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = '<';
            $config['prev_link'] = '&laquo;';
            $config['last_link'] = '>';
            $config['next_link'] = '&raquo;';
            $config['full_tag_open'] = '<ul class="tab-pagination pagination pagination-md">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="most-read-page">';
            $config['prev_tag_open'] = '<li class="most-read-page">';
            $config['last_tag_open'] = '<li class="most-read-page">';
            $config['next_tag_open'] = '<li class="most-read-page">';
            $config['first_tag_close'] = '</li>';
            $config['prev_tag_close'] = '</li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_close'] = '</li>';
            $config['uri_segment'] = 3;
            $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="most-read-page">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);

            $most_read_news_page_links = $this->pagination->create_links();
            $most_read_news_html = '';
            foreach( $most_read_news as $key => $news ){
                $publisher = (!empty( $news['publisher'] )) ? ' | By <a href="javascript:;" class="tab-news-author">' . $news['publisher'] . '</a> ' . $news['job'] : '';
                $most_read_news_html .= '<li>
                    <a href="' . base_url('news/article/' . $news['id']) . '" target="_blank">' . $news['headline'] . '</a>
                    <span>' . date('D M j H:i:s e Y', strtotime($news['date_published'])) . $publisher . '</span>
                </li>';
            }

            $this->output->set_content_type('application/json')->set_output(json_encode(array('html_data' => $most_read_news_html, 'html_page_links' => $most_read_news_page_links)));
        }
    }

    public function updateArchivePage( $latest_news_id, $page = 1 ){
        if($this->input->is_ajax_request()){
            $cur_page = $this->input->post('cur_page',true);
            if(!$cur_page || !is_numeric($page)){
                $page = 1;
            }

            $archive_news = array();
            $archive_news_new  =  $this->news_model_v2->getArchiveNewsByLimit(3, (($page-1)*3), $latest_news_id, $this->nlanguage);
            foreach ($archive_news_new as $key => $value) {
                if ($value['isEmpty']==1) {
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                    $archive_news_new[$key]['file_name'] = $news_images[0]['file_name'];
                    array_push($archive_news, $archive_news_new[$key]);
                } else {
                    $archive_news_en = $this->news_model_v2->getNewsById($value['news_id']);
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['news_id']);
                    $archive_news_en['file_name'] = $news_images[0]['file_name'];
                    $archive_news_en['id2'] = $archive_news_new[$key]['id'];
                    array_push($archive_news,  $archive_news_en);
                }

            }



            $news_count = $this->news_model_v2->getAllNewsCount();
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'news2/' . $latest_news_id;
            $config['total_rows'] = $news_count;
            $config['per_page'] = 3;
            $config['num_links'] = 5;
            $config['page'] = $page;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = '<';
            $config['prev_link'] = '&laquo;';
            $config['last_link'] = '>';
            $config['next_link'] = '&raquo;';
            $config['full_tag_open'] = '<ul class="tab-pagination pagination pagination-md">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li class="archive-page">';
            $config['prev_tag_open'] = '<li class="archive-page">';
            $config['last_tag_open'] = '<li class="archive-page">';
            $config['next_tag_open'] = '<li class="archive-page">';
            $config['first_tag_close'] = '</li>';
            $config['prev_tag_close'] = '</li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_close'] = '</li>';
            $config['uri_segment'] = 4;
            $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="archive-page">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);

            $archive_news_page_links = $this->pagination->create_links();
            $archive_news_html = '';
            foreach( $archive_news as $key => $news ){
                $archive_news_html .= '<li>
                    <h1>' . $news['headline'] . '</h1>
                    <span>' . date('D M j H:i:s e Y', strtotime($news['date_published'])) . '</span>
                    <p>' . $news['summary'] . ' <a href="' . base_url('news/article/' . $news['id']) .'">Read More...</a></p>
                </li>';
            }

            $this->output->set_content_type('application/json')->set_output(json_encode(array('html_data' => $archive_news_html, 'html_page_links' => $archive_news_page_links)));
        }
    }

    public function index($page)
    {
        if (IPLoc::Office()) {

            $this->lang->load('Location');
            $this->lang->load('news');
//        if(IPLoc::WhitelistPIPCandCC()){
            $language = $this->nlanguage;
//        if($this->nlanguage == 'en'){
//            $config['uri_segment'] = 3;
//        }else{
//            $config['uri_segment'] = 4;
//        }
//        if($this->nlanguage == 'ru'){
//            $language = 'ru';
//        }

            $page = is_numeric($page) ? $page : 1;


            $news_headlines = array();
            $news_headlines_new = $this->news_model_v2->getNewsHeadline2($language);
            foreach ($news_headlines_new as $key => $value) {
                if ($value['isEmpty'] == 1) {
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                    $news_headlines_new[$key]['file_name'] = $news_images[0]['file_name'];
                    array_push($news_headlines, $news_headlines_new[$key]);
                } else {
                    $news_headlines_en = $this->news_model_v2->getNewsById($value['news_id']);
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['news_id']);
                    $news_headlines_en['file_name'] = $news_images[0]['file_name'];
                    $news_headlines_en['id2'] = $news_headlines_new[$key]['id'];
                    array_push($news_headlines, $news_headlines_en);
                }
            }


            /* Get Latest News List */

            $latest_news = array();
            $latest_news_new = $this->news_model_v2->getLatestNewsByLimit(4, (($page - 1) * 4), $language);
            foreach ($latest_news_new as $key => $value) {
                if ($value['isEmpty'] == 1) {
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                    $latest_news_new[$key]['file_name'] = $news_images[0]['file_name'];
                    array_push($latest_news, $latest_news_new[$key]);

                } else {
                    $latest_news_en = $this->news_model_v2->getNewsById($value['news_id']);
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['news_id']);
                    $latest_news_en['file_name'] = $news_images[0]['file_name'];
                    $latest_news_en['id2'] = $latest_news_new[$key]['id'];
                    array_push($latest_news, $latest_news_en);
                }
            }

            if (count($latest_news) > 0) {
                $top_latest_news = $latest_news[0];
                if (!empty($top_latest_news['publisher_image'])) {
                    if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                        $top_latest_news['publisher_image'] = 'avatar.png';
                    }
                } else {
                    $top_latest_news['publisher_image'] = 'avatar.png';
                }
            } else {
                $top_latest_news = array();
            }


            $news_count = $this->news_model_v2->getAllNewsCount2($language);
            $this->load->library('pagination');
            $config['base_url'] = FXPP::ajax_url() . 'news2/index/';
            $config['total_rows'] = $news_count;
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

            $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="latest-page">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $latest_news_page_links = $this->pagination->create_links();

            /* Get Most Read News List */
            $page = ($page) ? $page : 1;
            $most_read_news = array();
            $most_read_news_new = $this->news_model_v2->getMostReadNewsByLimit(4, (($page - 1) * 4), $language);
            foreach ($most_read_news_new as $key => $value) {
                if ($value['isEmpty'] == 1) {
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                    $most_read_news_new[$key]['file_name'] = $news_images[0]['file_name'];
                    array_push($most_read_news, $most_read_news_new[$key]);
                } else {
                    $most_read_news_en = $this->news_model_v2->getNewsById($value['news_id']);
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['news_id']);
                    $most_read_news_en['file_name'] = $news_images[0]['file_name'];
                    $most_read_news_en['id2'] = $most_read_news_new[$key]['id'];
                    array_push($most_read_news, $most_read_news_en);
                }

            }

            $all_news = array();
            $all_news_new = $this->news_model_v2->getLatestNewsByLimit(4, 0, $language);
            foreach ($all_news_new as $key => $value) {
                if ($value['isEmpty'] == 1) {
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                    $all_news_new[$key]['file_name'] = $news_images[0]['file_name'];
                    array_push($all_news, $all_news_new[$key]);
                } else {
                    $all_news_en = $this->news_model_v2->getNewsById($value['news_id']);
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['news_id']);
                    $all_news_en['file_name'] = $news_images[0]['file_name'];
                    $all_news_en['id2'] = $all_news_new[$key]['id'];
                    array_push($all_news, $all_news_en);
                }

            }
            $data['all_news'] = $all_news;


            $news_count = $this->news_model_v2->getAllNewsCount2($language);
            $this->load->library('pagination');
            $config['base_url'] = FXPP::ajax_url() . 'news2/index/';
            $config['total_rows'] = $news_count;
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
            $config['first_tag_open'] = '<li class="most-read-page">';
            $config['prev_tag_open'] = '<li class="most-read-page">';
            $config['last_tag_open'] = '<li class="most-read-page">';
            $config['next_tag_open'] = '<li class="most-read-page">';
            $config['first_tag_close'] = '</li>';
            $config['prev_tag_close'] = '</li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_close'] = '</li>';

            $config['cur_tag_open'] = '<li class="active"><a id="currentPage">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="most-read-page">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $most_read_news_page_links = $this->pagination->create_links();

            $data['most_read_news_page_links'] = $most_read_news_page_links;
            $data['most_read_news'] = $most_read_news;

            $data['latest_news_page_links'] = $latest_news_page_links;
            $data['latest_news'] = $latest_news;

            $data['top_latest_news'] = $top_latest_news;

            $data['news_headlines'] = $news_headlines;

// print_r($data);
// exit;
            $this->template->title("News | Page " . $page)
                ->set_layout('external/main')
                ->build('news2/news_list', $data);

        }
    }


        public function latest_news($page)
        {
            // $page = $this->input->post('page');
            $this->lang->load('news');
            $this->lang->load('Location');
//        if(IPLoc::WhitelistPIPCandCC()){
            $language = $this->nlanguage;
//        $language = 'en';
//        if($this->nlanguage == 'en'){
//            $config['uri_segment'] = 3;
//        }else{
//            $config['uri_segment'] = 4;
//        }
//        if($this->nlanguage == 'ru'){
//            $language = 'ru';
//        }

            $page = is_numeric($page) ? $page : 1;

//        $news_headlines = $this->news_model->getNewsHeadline($language);


            /* Get Latest News List */
//        $latest_news = $this->news_model->getLatestNewsByLimit(4, (($page-1)*4), $language);

            $news_headlines = array();
            $news_headlines_new = $this->news_model_v2->getNewsHeadline($language);
            foreach ($news_headlines_new as $key => $value) {
                if ($value['isEmpty'] == 1) {
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                    $news_headlines_new[$key]['file_name'] = $news_images[0]['file_name'];
                    array_push($news_headlines, $news_headlines_new[$key]);
                } else {
                    $news_headlines_en = $this->news_model_v2->getNewsById($value['news_id']);
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['new_id']);
                    $news_headlines_en['file_name'] = $news_images[0]['file_name'];
                    $news_headlines_en['id2'] = $news_headlines_new[$key]['id'];
                    array_push($news_headlines, $news_headlines_en);
                }
            }


            $latest_news = array();
            $latest_news_new = $this->news_model_v2->getLatestNewsByLimit(4, (($page - 1) * 4), $language);
            foreach ($latest_news_new as $key => $value) {
                if ($value['isEmpty'] == 1) {
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                    $latest_news_new[$key]['file_name'] = $news_images[0]['file_name'];
                    array_push($latest_news, $latest_news_new[$key]);
                } else {
                    $latest_news_en = $this->news_model_v2->getNewsById($value['news_id']);
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['new_id']);
                    $latest_news_en['file_name'] = $news_images[0]['file_name'];
                    $latest_news_en['id2'] = $latest_news_new[$key]['id'];
                    array_push($latest_news, $latest_news_en);
                }
            }


            if (count($latest_news) > 0) {
                $top_latest_news = $latest_news[0];
                if (!empty($top_latest_news['publisher_image'])) {
                    if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                        $top_latest_news['publisher_image'] = 'avatar.png';
                    }
                } else {
                    $top_latest_news['publisher_image'] = 'avatar.png';
                }
            } else {
                $top_latest_news = array();
            }

            $news_count = $this->news_model->getAllNewsCount2($language);
            $this->load->library('pagination');
            $config['base_url'] = FXPP::ajax_url() . 'news2/index/';
            $config['total_rows'] = $news_count;
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

            $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="latest-page">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $latest_news_page_links = $this->pagination->create_links();

            foreach ($latest_news as $key => $value) {
                $latest_news[$key]['date_created'] = date('D M j H:i:s e Y', strtotime($value['date_created']));
            }

            echo json_encode(array('latest_news' => $latest_news, 'links' => $latest_news_page_links));
        }


    public function most_read($page)
    {
        // $page = $this->input->post('page');
        $this->lang->load('news');
        $this->lang->load('Location');
//        if(IPLoc::WhitelistPIPCandCC()){
        $language = $this->nlanguage;
//        if($this->nlanguage == 'en'){
//            $config['uri_segment'] = 3;
//        }else{
//            $config['uri_segment'] = 4;
//        }
//        if($this->nlanguage == 'ru'){
//            $language = 'ru';
//        }

        $page = is_numeric($page) ? $page : 1;


        $most_read_news = array();
        $most_read_news_new = $this->news_model_v2->getMostReadNewsByLimit(4, (($page - 1) * 4), $language);
        foreach ($most_read_news_new as $key => $value) {
            if ($value['isEmpty'] == 1) {
                $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                $most_read_news_new[$key]['file_name'] = $news_images[0]['file_name'];
                array_push($most_read_news, $most_read_news_new[$key]);
            } else {
                $most_read_news_new_en = $this->news_model_v2->getNewsById($value['news_id']);
                $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['news_id']);
                $most_read_news_new_en[$key]['file_name'] = $news_images[0]['file_name'];
                $most_read_news_new_en[$key]['id2'] = $most_read_news_new[$key]['id'];
                array_push($most_read_news, $most_read_news_new_en);
            }
        }


        $news_count = $this->news_model_v2->getAllNewsCount2($language);
        $this->load->library('pagination');
        $config['base_url'] = FXPP::ajax_url() . 'news2/index/';
        $config['total_rows'] = $news_count;
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
        $config['first_tag_open'] = '<li class="most-read-page">';
        $config['prev_tag_open'] = '<li class="most-read-page">';
        $config['last_tag_open'] = '<li class="most-read-page">';
        $config['next_tag_open'] = '<li class="most-read-page">';
        $config['first_tag_close'] = '</li>';
        $config['prev_tag_close'] = '</li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a id="curPage">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="most-read-page">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $most_read_news_page_links = $this->pagination->create_links();
        foreach ($most_read_news as $key => $value) {
            $most_read_news[$key]['date_created'] = date('D M j H:i:s e Y', strtotime($value['date_created']));
        }
        echo json_encode(array('most_read' => $most_read_news, 'links' => $most_read_news_page_links));
    }

 
    public function all_news(){
        if($this->input->is_ajax_request()){

            $language = $this->nlanguage;
//            $language = 'en';
//            if($this->nlanguage == 'ru'){
//                $language = 'ru';
//            }
//            $all_news = $this->news_model->getLatestNewsByLimit($this->input->post('limit',true), $this->input->post('start',true), $language);
//            foreach($all_news as $key => $value){
//                $news_images = $this->news_model->getNewsImagesByNewsId($value['id']);
//                $all_news[$key]['file_name'] = $news_images[0]['file_name'];
//            }

            $all_news = array();
            $all_news_new = $this->news_model_v2->getLatestNewsByLimit($this->input->post('limit',true), $this->input->post('start',true), $language);

            foreach ($all_news_new as $key => $value) {
                if ($value['isEmpty'] == 1) {
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['id']);
                    $all_news_new[$key]['file_name'] = $news_images[0]['file_name'];
                    array_push($all_news, $all_news_new[$key]);

                } else {
                    $all_news_en = $this->news_model_v2->getNewsById($value['news_id']);
                    $news_images = $this->news_model_v2->getNewsImagesByNewsId($value['news_id']);
                    $all_news_en['file_name'] = $news_images[0]['file_name'];
                    $all_news_en['id2'] = $all_news_new[$key]['id'];
                    array_push($all_news, $all_news_en);
                }

            }

            $data['all_news'] = $all_news;
            $this->load->view('news2/all_news',$data);
            // $this->output->set_content_type('application/json')->set_output(json_encode(array('html_data' => $this->load->view('news/all_news',$data), 'html_page_links' => '')));

        }
    }
}