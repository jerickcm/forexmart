<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Analysis extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('analysis_model');
        $this->nlanguage = FXPP::html_url();
    }

    public function index()
    {
        $this->lang->load('news');
//        if(IPLoc::WhitelistPIPCandCC()){
        $page = 1;

        $analysis_headlines = $this->analysis_model->getAnalysisHeadline();

        /* Get Latest analysis List */
        $latest_analysis = $this->analysis_model->getLatestAnalysisByLimit(5, (($page-1)*5), $this->nlanguage);
        $analysis_lang = $this->nlanguage;
        if(count($latest_analysis) > 0){
            $top_latest_analysis = $latest_analysis[0];
            if(!empty($top_latest_analysis['publisher_image'])) {
                if (!file_exists('./assets/analysis_images/' . $top_latest_analysis['publisher_image'])) {
                    $top_latest_analysis['publisher_image'] = 'avatar.png';
                }
            }else{
                $top_latest_analysis['publisher_image'] = 'avatar.png';
            }
        }else{
            $analysis_lang = 'EN';
            $latest_analysis = $this->analysis_model->getLatestAnalysisByLimit(5, (($page-1)*5), 'EN');
            if(count($latest_analysis) > 0){
                $top_latest_analysis = $latest_analysis[0];
                if(!empty($top_latest_analysis['publisher_image'])) {
                    if (!file_exists('./assets/analysis_images/' . $top_latest_analysis['publisher_image'])) {
                        $top_latest_analysis['publisher_image'] = 'avatar.png';
                    }
                }else{
                    $top_latest_analysis['publisher_image'] = 'avatar.png';
                }
            }else{
                $top_latest_analysis = array();
            }
        }

        $analysis_count = $this->analysis_model->getAllAnalysisCount();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'analysis';
        $config['total_rows'] = $analysis_count;
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
        $latest_analysis_page_links = $this->pagination->create_links();

        /* Get Most Read Analysis List */
        $most_read_analysis = $this->analysis_model->getMostReadAnalysisByLimit(5, (($page-1)*5));
        $analysis_count = $this->analysis_model->getAllAnalysisCount();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'analysis';
        $config['total_rows'] = $analysis_count;
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
        $most_read_analysis_page_links = $this->pagination->create_links();

        /* Get Archive Analysis List */
        $archive_analysis = $this->analysis_model->getArchiveAnalysisByLimit(3, (($page-1)*3), $top_latest_analysis['id'], $analysis_lang);
        if(count($archive_analysis) <= 0){
            $archive_analysis = $this->analysis_model->getArchiveAnalysisByLimit(3, (($page-1)*3), 'EN');
        }
//            $analysis_count = $this->analysis_model->getAllAnalysisCount();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'analysis/' . $top_latest_analysis['id'];
        $config['total_rows'] = $analysis_count;
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
        $archive_analysis_page_links = $this->pagination->create_links();

        $data['most_read_analysis_page_links'] = $most_read_analysis_page_links;
        $data['most_read_analysis'] = $most_read_analysis;

        $data['latest_analysis_page_links'] = $latest_analysis_page_links;
        $data['latest_analysis'] = $latest_analysis;

        $data['archive_analysis_page_links'] = $archive_analysis_page_links;
        $data['archive_analysis'] = $archive_analysis;

        $data['top_latest_analysis'] = $top_latest_analysis;

        $data['analysis_headlines'] = $analysis_headlines;
        $css = $this->template->Css();

        $this->template->title("ForexMart | Analysis")
            ->append_metadata_css("
                            <link rel='stylesheet' href='".$css."news.min.css'>
                        ")
            ->set_layout('external/main')
            ->build('analysis/analysis', $data);
//        }else{
//            show_404();
//        }

    }

    public function article( $id = 0 ){
        $this->lang->load('news');
        $isExist = $this->analysis_model->isAnalysisExist($id);
        if($isExist) {
            $analysis = $this->analysis_model->getAnalysisById($id);

            if($analysis['enabled']){
                $analysis_images = $this->analysis_model->getAnalysisImagesByAnalysisId($id);
                $data['analysis'] = $analysis;
                $data['analysis_images'] = $analysis_images;
                $update_data = array(
                    'read' => ((int) $analysis['read']) + 1
                );
                $this->analysis_model->updateAnalysisById($id, $update_data);
                $data['other_analysis'] = $this->analysis_model->getAnalysisHeadline();
                $this->template->title("ForexMart | Analysis")
                    ->set_layout('external/main')
                    ->build('analysis/article', $data);
            }else{
                show_404();
            }
        }else{
            show_404();
        }
    }

    public function updateLatestPage( $page = 1 ){
        if($this->input->is_ajax_request()){
            $cur_page = $this->input->post('cur_page',true);
            if(!$cur_page || !is_numeric($page)){
                $page = 1;
            }

            $latest_analysis = $this->analysis_model->getLatestAnalysisByLimit(5, (($page-1)*5), $this->nlanguage);
            $analysis_count = $this->analysis_model->getAllAnalysisCount();
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'analysis';
            $config['total_rows'] = $analysis_count;
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

            $latest_analysis_page_links = $this->pagination->create_links();
            $latest_analysis_html = '';
            foreach( $latest_analysis as $key => $analysis ){
                $publisher = (!empty( $analysis['publisher'] )) ? ' | By <a href="javascript:;" class="tab-analysis-author">' . $analysis['publisher'] . '</a> ' . $analysis['job'] : '';
                $latest_analysis_html .= '<li>
                    <a href="' . base_url('analysis/article/' . $analysis['id']) . '" target="_blank">' . $analysis['headline'] . '</a>
                    <span>' . date('D M j H:i:s e Y', strtotime($analysis['date_created'])) . $publisher . '</span>
                </li>';
            }

            $this->output->set_content_type('application/json')->set_output(json_encode(array('html_data' => $latest_analysis_html, 'html_page_links' => $latest_analysis_page_links)));
        }
    }

    public function updateMostReadPage( $page = 1 ){
        if($this->input->is_ajax_request()){
            $cur_page = $this->input->post('cur_page',true);
            if(!$cur_page || !is_numeric($page)){
                $page = 1;
            }

            $most_read_analysis = $this->analysis_model->getMostReadAnalysisByLimit(5, (($page-1)*5));
            $analysis_count = $this->analysis_model->getAllAnalysisCount();
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'analysis';
            $config['total_rows'] = $analysis_count;
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

            $most_read_analysis_page_links = $this->pagination->create_links();
            $most_read_analysis_html = '';
            foreach( $most_read_analysis as $key => $analysis ){
                $publisher = (!empty( $analysis['publisher'] )) ? ' | By <a href="javascript:;" class="tab-analysis-author">' . $analysis['publisher'] . '</a> ' . $analysis['job'] : '';
                $most_read_analysis_html .= '<li>
                    <a href="' . base_url('analysis/article/' . $analysis['id']) . '" target="_blank">' . $analysis['headline'] . '</a>
                    <span>' . date('D M j H:i:s e Y', strtotime($analysis['date_created'])) . $publisher . '</span>
                </li>';
            }

            $this->output->set_content_type('application/json')->set_output(json_encode(array('html_data' => $most_read_analysis_html, 'html_page_links' => $most_read_analysis_page_links)));
        }
    }

    public function updateArchivePage( $latest_analysis_id, $page = 1 ){
        if($this->input->is_ajax_request()){
            $cur_page = $this->input->post('cur_page',true);
            if(!$cur_page || !is_numeric($page)){
                $page = 1;
            }

            $archive_analysis = $this->analysis_model->getArchiveAnalysisByLimit(3, (($page-1)*3), $latest_analysis_id, $this->nlanguage);
            if(count($archive_analysis) <= 0){
                $archive_analysis = $this->analysis_model->getArchiveAnalysisByLimit(3, (($page-1)*3), $latest_analysis_id, 'EN');
            }
            $analysis_count = $this->analysis_model->getAllAnalysisCount();
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'analysis/' . $latest_analysis_id;
            $config['total_rows'] = $analysis_count;
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

            $archive_analysis_page_links = $this->pagination->create_links();
            $archive_analysis_html = '';
            foreach( $archive_analysis as $key => $analysis ){
                $archive_analysis_html .= '<li>
                    <h1>' . $analysis['headline'] . '</h1>
                    <span>' . date('D M j H:i:s e Y', strtotime($analysis['date_created'])) . '</span>
                    <p>' . $analysis['summary'] . ' <a href="' . base_url('analysis/article/' . $analysis['id']) .'">Read More...</a></p>
                </li>';
            }

            $this->output->set_content_type('application/json')->set_output(json_encode(array('html_data' => $archive_analysis_html, 'html_page_links' => $archive_analysis_page_links)));
        }
    }
}