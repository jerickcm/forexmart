<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class News extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->helper('thumb');
        $this->nlanguage = FXPP::html_url();
    }

    public function index2()
    {
        $this->lang->load('news');
        $this->lang->load('Location');
//        if(IPLoc::WhitelistPIPCandCC()){
            $page = 1;

            $news_headlines = $this->news_model->getNewsHeadline();

            /* Get Latest News List */
            $latest_news = $this->news_model->getLatestNewsByLimit(5, (($page-1)*5), $this->nlanguage);
            $news_lang = $this->nlanguage;
            if(count($latest_news) > 0){
                $top_latest_news = $latest_news[0];
                if(!empty($top_latest_news['publisher_image'])) {
                    if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                        $top_latest_news['publisher_image'] = 'avatar.png';
                    }
                }else{
                    $top_latest_news['publisher_image'] = 'avatar.png';
                }
            }else{
                $news_lang = 'EN';
                $latest_news = $this->news_model->getLatestNewsByLimit(5, (($page-1)*5), 'EN');
                if(count($latest_news) > 0){
                    $top_latest_news = $latest_news[0];
                    if(!empty($top_latest_news['publisher_image'])) {
                        if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                            $top_latest_news['publisher_image'] = 'avatar.png';
                        }
                    }else{
                        $top_latest_news['publisher_image'] = 'avatar.png';
                    }
                }else{
                    $top_latest_news = array();
                }
            }

            $news_count = $this->news_model->getAllNewsCount();
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'news' ;
            $config['total_rows'] = $news_count;
            $config['per_page'] = 5;
            $config['num_links'] = 5;
            $config['page'] = $page;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = '&#60;';
            $config['prev_link'] = '&laquo;';
            $config['last_link'] = '&#62;';
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

            /* Get Most Read News List */
            $most_read_news = $this->news_model->getMostReadNewsByLimit(5, (($page-1)*5), $this->nlanguage);
            if(count($most_read_news) <= 0){
                $most_read_news = $this->news_model->getMostReadNewsByLimit(5, (($page-1)*5), 'EN');
            }
//            $news_count = $this->news_model->getAllNewsCount();
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'news';
            $config['total_rows'] = $news_count;
            $config['per_page'] = 5;
            $config['num_links'] = 5;
            $config['page'] = $page;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = '&#60;';
            $config['prev_link'] = '&laquo;';
            $config['last_link'] = '&#62;';
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

            /* Get Archive News List */
            $archive_news = $this->news_model->getArchiveNewsByLimit(3, (($page-1)*3), $top_latest_news['id'], $news_lang);
            if(count($archive_news) <= 0){
                $archive_news = $this->news_model->getArchiveNewsByLimit(3, (($page-1)*3), 'EN');
            }
//            $news_count = $this->news_model->getAllNewsCount();
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'news/' . $top_latest_news['id'];
            $config['total_rows'] = $news_count;
            $config['per_page'] = 3;
            $config['num_links'] = 5;
            $config['page'] = $page;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = '&#60;';
            $config['prev_link'] = '&laquo;';
            $config['last_link'] = '&#62;';
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

            $data['most_read_news_page_links'] = $most_read_news_page_links;
            $data['most_read_news'] = $most_read_news;

            $data['latest_news_page_links'] = $latest_news_page_links;
            $data['latest_news'] = $latest_news;

            $data['archive_news_page_links'] = $archive_news_page_links;
            $data['archive_news'] = $archive_news;

            $data['top_latest_news'] = $top_latest_news;

            $data['news_headlines'] = $news_headlines;
            $css = $this->template->Css();

            $this->template->title("ForexMart | News")
                ->set_layout('external/main')
                ->append_metadata_css("
                            <link rel='stylesheet' href='".$css."news.min.css'>
                            <link rel='stylesheet' href='".$css."mapstyle.css'>
                        ")
                ->build('news/news', $data);
//        }else{
//            show_404();
//        }

    }

    public function article( $id = 0 ){
        $this->lang->load('news');
        $this->lang->load('Location');

        $isExist = $this->news_model->isNewsExist($id);
        if($isExist) {
            $news = $this->news_model->getNewsById($id);
            $css = $this->template->Css();

            if($news['enabled']){
                $page = 1;
                $data['most_read_news'] = $this->news_model->getMostReadNewsByLimit(5, (($page-1)*5), $this->nlanguage);
                if(count($data['most_read_news']) <= 0){
                    $data['most_read_news'] = $this->news_model->getMostReadNewsByLimit(5, (($page-1)*5), 'EN');
                }
                $news_images = $this->news_model->getNewsImagesByNewsId($id);
                $data['news'] = $news;
                if(IPLoc::Office()){
                    $title_txt=$news['headline'];
                }
                $head_title=isset($title_txt) ? $title_txt:'News';
                $data['news_images'] = $news_images;
                $update_data = array(
                    'read' => ((int) $news['read']) + 1
                );
                $this->news_model->updateNewsById($id, $update_data);
                $data['other_news'] = $this->news_model->getNewsHeadline();
                $this->template->title($head_title)
                    ->set_layout('external/main')
                    ->append_metadata_css("
                            <link rel='stylesheet' href='".$css."mapstyle.css'>
                        ")
                    ->build('news/article', $data);
            }else{
                show_404();
            }
        }else{
            show_404();
        }
    }

    public function preview( $id = 0 ){
        $this->lang->load('news');
        $isExist = $this->news_model->isDisabledNewsExist($id);
        if ($isExist) {
            $news = $this->news_model->getNewsById($id);

            if (!$news['enabled']) {
                $news_images = $this->news_model->getNewsImagesByNewsId($id);
                $data['news'] = $news;
                $data['news_images'] = $news_images;
                $update_data = array(
                    'read' => ((int)$news['read']) + 1
                );
                $this->news_model->updateNewsById($id, $update_data);
                $data['other_news'] = $this->news_model->getNewsHeadline();
                $this->template->title("ForexMart | News")
                    ->set_layout('external/main')
                    ->build('news/article', $data);
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

            $latest_news = $this->news_model->getLatestNewsByLimit(5, (($page-1)*5), $this->nlanguage);
            $news_count = $this->news_model->getAllNewsCount();
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'news';
            $config['total_rows'] = $news_count;
            $config['per_page'] = 5;
            $config['num_links'] = 5;
            $config['page'] = $page;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = '&#60;';
            $config['prev_link'] = '&laquo;';
            $config['last_link'] = '&#62;';
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

            $most_read_news = $this->news_model->getMostReadNewsByLimit(5, (($page-1)*5), $this->nlanguage);
            if(count($most_read_news) <= 0){
                $most_read_news = $this->news_model->getMostReadNewsByLimit(5, (($page-1)*5), 'EN');
            }
            $news_count = $this->news_model->getAllNewsCount();
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'news';
            $config['total_rows'] = $news_count;
            $config['per_page'] = 5;
            $config['num_links'] = 5;
            $config['page'] = $page;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = '&#60;';
            $config['prev_link'] = '&laquo;';
            $config['last_link'] = '&#62;';
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

            $archive_news = $this->news_model->getArchiveNewsByLimit(3, (($page-1)*3), $latest_news_id, $this->nlanguage);
            if(count($archive_news) <= 0){
                $archive_news = $this->news_model->getArchiveNewsByLimit(3, (($page-1)*3), $latest_news_id, 'EN');
            }
            $news_count = $this->news_model->getAllNewsCount();
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'news/' . $latest_news_id;
            $config['total_rows'] = $news_count;
            $config['per_page'] = 3;
            $config['num_links'] = 5;
            $config['page'] = $page;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = '&#60;';
            $config['prev_link'] = '&laquo;';
            $config['last_link'] = '&#62;';
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

    public function index($page){

        $this->lang->load('Location');
        $this->lang->load('news');
//        if(IPLoc::WhitelistPIPCandCC()){
        $language = 'en';
        if($this->nlanguage == 'en'){
            $config['uri_segment'] = 3;
        }else{
            $config['uri_segment'] = 4;
        }
        if($this->nlanguage == 'ru'){
            $language = 'ru';
        }

        $page = is_numeric($page) ? $page : 1;

        $news_headlines = $this->news_model->getNewsHeadline2($language);

        foreach($news_headlines as $key => $value){
            $news_images = $this->news_model->getNewsImagesByNewsId($value['id']);
            $news_headlines[$key]['file_name'] = $news_images[0]['file_name'];
        }

        // print_r($news_headlines);
        // exit;

        /* Get Latest News List */
        $latest_news = $this->news_model->getLatestNewsByLimit(4, (($page-1)*4), $language);
        foreach($latest_news as $key => $value){
            $news_images = $this->news_model->getNewsImagesByNewsId($value['id']);
            $latest_news[$key]['file_name'] = $news_images[0]['file_name'];
        }

        if(count($latest_news) > 0){
            $top_latest_news = $latest_news[0];
            if(!empty($top_latest_news['publisher_image'])) {
                if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                    $top_latest_news['publisher_image'] = 'avatar.png';
                }
            }else{
                $top_latest_news['publisher_image'] = 'avatar.png';
            }
        }else{
            $top_latest_news = array();
        }


        $news_count = $this->news_model->getAllNewsCount2($language);
        $this->load->library('pagination');
        $config['base_url'] = FXPP::ajax_url() . 'news/index/';
        $config['total_rows'] = $news_count;
        $config['per_page'] = 4;
        $config['num_links'] = 4;
        $config['page'] = $page;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = '&#60;';
        $config['prev_link'] = '&laquo;';
        $config['last_link'] = '&#62;';
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
        $most_read_news = $this->news_model->getMostReadNewsByLimit(4, (($page-1)*4),$language);
        foreach($most_read_news as $key => $value){
            $news_images = $this->news_model->getNewsImagesByNewsId($value['id']);
            $most_read_news[$key]['file_name'] = $news_images[0]['file_name'];
        }

        $all_news = $this->news_model->getLatestNewsByLimit(4, 0, $language);
        foreach($all_news as $key => $value){
            $news_images = $this->news_model->getNewsImagesByNewsId($value['id']);
            $all_news[$key]['file_name'] = $news_images[0]['file_name'];
        }
        $data['all_news'] = $all_news;


        $news_count = $this->news_model->getAllNewsCount2($language);
        $this->load->library('pagination');
        $config['base_url'] = FXPP::ajax_url() . 'news/index/';
        $config['total_rows'] = $news_count;
        $config['per_page'] = 4;
        $config['num_links'] = 4;
        $config['page'] = $page;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = '&#60;';
        $config['prev_link'] = '&laquo;';
        $config['last_link'] = '&#62;';
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
        $this->template->title("News | Page ".$page)
            ->set_layout('external/main')
            ->build('news/news_list', $data);

    }
    public function latest_news($page){
        // $page = $this->input->post('page');
        $this->lang->load('news');
//        if(IPLoc::WhitelistPIPCandCC()){
        $language = 'en';
        if($this->nlanguage == 'en'){
            $config['uri_segment'] = 3;
        }else{
            $config['uri_segment'] = 4;
        }
        if($this->nlanguage == 'ru'){
            $language = 'ru';
        }

        $page = is_numeric($page) ? $page : 1;
        /* Get Latest News List */
        $latest_news = $this->news_model->getLatestNewsByLimit(4, (($page-1)*4), $language);

        if(count($latest_news) > 0){
            $top_latest_news = $latest_news[0];
            if(!empty($top_latest_news['publisher_image'])) {
                if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                    $top_latest_news['publisher_image'] = 'avatar.png';
                }
            }else{
                $top_latest_news['publisher_image'] = 'avatar.png';
            }
        }else{
            $top_latest_news = array();
        }


        $news_count = $this->news_model->getAllNewsCount2($language);
        // print_r($news_count);
        // exit;
        $this->load->library('pagination');
        $config['base_url'] = FXPP::ajax_url() . 'news/index/';
        $config['total_rows'] = $news_count;
        $config['per_page'] = 4;
        $config['num_links'] = 4;
        $config['page'] = $page;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = '&#60;';
        $config['prev_link'] = '&laquo;';
        $config['last_link'] = '&#62;';
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

        foreach($latest_news as $key => $value){
            $news_images = $this->news_model->getNewsImagesByNewsId($value['id']);
            $latest_news[$key]['date_published'] = date('D M j H:i:s e Y', strtotime($value['date_published']));
            $latest_news[$key]['file_name'] = $news_images[0]['file_name'];
        }
        
        echo json_encode(array('latest_news'=>$latest_news,'links'=>$latest_news_page_links));
    }

    public function most_read($page){
        // $page = $this->input->post('page');
        $this->lang->load('news');
//        if(IPLoc::WhitelistPIPCandCC()){
        $language = 'en';
        if($this->nlanguage == 'en'){
            $config['uri_segment'] = 3;
        }else{
            $config['uri_segment'] = 4;
        }
        if($this->nlanguage == 'ru'){
            $language = 'ru';
        }

        $page = is_numeric($page) ? $page : 1;

        $most_read_news = $this->news_model->getMostReadNewsByLimit(4, (($page-1)*4),$language);
        $news_count = $this->news_model->getAllNewsCount2($language);
        $this->load->library('pagination');
        $config['base_url'] = FXPP::ajax_url() . 'news/index/';
        $config['total_rows'] = $news_count;
        $config['per_page'] = 4;
        $config['num_links'] = 4;
        $config['page'] = $page;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = '&#60;';
        $config['prev_link'] = '&laquo;';
        $config['last_link'] = '&#62;';
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
        foreach($most_read_news as $key => $value){
            $news_images = $this->news_model->getNewsImagesByNewsId($value['id']);
            $most_read_news[$key]['date_published'] = date('D M j H:i:s e Y', strtotime($value['date_published']));
            $most_read_news[$key]['file_name'] = $news_images[0]['file_name'];
        }
        echo json_encode(array('most_read'=>$most_read_news,'links'=>$most_read_news_page_links));

    }
    public function getMostReadForSideMenu(){
        if($this->input->is_ajax_request()){
            $this->lang->load('news');
           // $most_read_news = $this->news_model->getMostReadNewsByLimit(3,0,'en');

            $most_read_news = $this->news_model->getLatestNewsByLimit(3,0,'en');

            foreach($most_read_news as $key => $value){
                $news_images = $this->news_model->getNewsImagesByNewsId($value['id']);
                $most_read_news[$key]['date_published'] = date('D M j H:i:s e Y', strtotime($value['date_published']));
                $most_read_news[$key]['file_name'] = $news_images[0]['file_name'];
            }
            $data['latest_news']=$most_read_news;
            $this->load->view('news/news-on-menu',$data);
        }

    }
    public function all_news(){
        if($this->input->is_ajax_request()){
            $language = 'en';
            if($this->nlanguage == 'ru'){
                $language = 'ru';
            }
            $all_news = $this->news_model->getLatestNewsByLimit($this->input->post('limit',true), $this->input->post('start',true), $language);
            foreach($all_news as $key => $value){
                $news_images = $this->news_model->getNewsImagesByNewsId($value['id']);
                $all_news[$key]['file_name'] = $news_images[0]['file_name'];
            }
            $data['all_news'] = $all_news;
             $this->load->view('news/all_news',$data);

            //$this->output->set_content_type('application/json')->set_output(json_encode(array('html_data' => $this->load->view('news/all_news',$data), 'html_page_links' => '')));

        }
    }
}