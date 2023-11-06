<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    public function _remap($method, $params = array()){
        $this->index();
    }
    public function index(){
//        if(IPLoc::Office()){
//            $this->index3();
//        }
//        else{
            $this->index2();       
//        }
    }

    public function index2()
    {
       // session_write_close(); // developing a website with heavy AJAX usage
        $nlanguage = FXPP::html_url();
        $user_country = FXPP::getUserCountryCode();
        $this->lang->load('home');
        $this->lang->load('moneyfall');
        $this->lang->load('contest');
        $this->load->model('account_model');
        $this->load->model('news_model');
        $this->lang->load('Location');

        if(in_array($user_country, array('US', 'KP', 'MM', 'SD', 'SY'))){
            $data['unavailable'] = true;
        }else{
            $data['unavailable'] = false;
        }

//        if(IPLoc::Office()){
            //Contest Monitoring
            $start_date = date('Y-m-d 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
            $end_date = date('Y-m-d 23:59:59', strtotime($start_date . ' +6 days'));
            $contest_data = $this->account_model->getContestWinnersLimit( $start_date, $end_date, 10 );
            if($contest_data){
                $rank = 0;
                $prev_value = 0;

                $start_dates = date('Y-m-d 00:00:00', strtotime('next monday', strtotime($start_date)));
                $end_dates = date('Y-m-d 22:59:59', strtotime($start_dates . ' +4 days'));


                foreach($contest_data as $key => $value){
                    if($prev_value <> $value['amount']){
                        $rank++;
                        $prev_value = $value['amount'];
                    }
                    // $contest_data[$key]['country_name'] = $this->g_m->getCountries($value['country']);
                    $country_name = $this->g_m->getCountries($value['country']);
                    if(!is_array($country_name)){
                        if($country_name){
                            $contest_data[$key]['country_name'] = $country_name;
                        }else{
                            $contest_data[$key]['country_name'] = '';
                        }
                    }else{
                        $contest_data[$key]['country_name'] = '';
                    }
                    $contest_data[$key]['rank'] = $rank;
                    $contest_data[$key]['start_end'] = date("m/d/Y", strtotime($start_dates))." - ". date("m/d/Y", strtotime($end_dates));
                }
            }
            $data['rankings'] = $contest_data;

            /* Get Latest News List */
            $latest_news = $this->news_model->getLatestNewsByLimit(6, 0, $nlanguage);
            if(count($latest_news) > 0){
                $top_latest_news = $latest_news[0];
                if(!empty($top_latest_news['publisher_image'])) {
                    if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                        $top_latest_news['publisher_image'] = 'avatar.png';
                    }
                }else{
                    $top_latest_news['publisher_image'] = 'avatar.png';
                }
                unset($latest_news[0]);
            }else{
                $latest_news = $this->news_model->getLatestNewsByLimit(6, 0, 'EN');
                if(count($latest_news) > 0){
                    $top_latest_news = $latest_news[0];
                    if(!empty($top_latest_news['publisher_image'])) {
                        if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                            $top_latest_news['publisher_image'] = 'avatar.png';
                        }
                    }else{
                        $top_latest_news['publisher_image'] = 'avatar.png';
                    }
                    unset($latest_news[0]);
                }else{
                    $top_latest_news = array();
                }
            }

            $top_news_images = $this->news_model->getNewsImagesByNewsId($top_latest_news['id']);

            $data['latest_news'] = $latest_news;
            $data['top_latest_news'] = $top_latest_news;
            $data['top_news_images'] = $top_news_images;
            $data['nlanguage'] = $nlanguage;
//        }

        $sysmbolsData = FXPP::generateQuotesRow();
        $data['quotes'] = $sysmbolsData;
        // $data['metadata_description'] = lang('x_hom_dsc');
        $data['metadata_description'] = '';
        $data['metadata_keyword'] = lang('x_hom_kew');
//        if(IPLoc::Office()){
            $css_files = "
                       <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400|Playball' rel='stylesheet' type='text/css'>
                       <link rel='stylesheet' href='".$this->template->Css()."mapstyle.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."awardarea.css'>
                 ";
//        }else{
//            $css_files = "
//                       <link rel='stylesheet' href='".$this->template->Css()."mapstyle.css'>
//                       <link rel='stylesheet' href='".$this->template->Css()."home/mainpagecustom.css'>
//                 ";
//        }

        $this->template->title(lang('x_hom_tit'))
            ->append_metadata_css($css_files)
            ->append_metadata_js('
                     <script src="' . $this->template->Js() . 'jquery.dataTables.js"></script>
                     <script src="' . $this->template->Js() . 'dataTables.bootstrap.js"></script>
                     <script src="' . $this->template->Js() . 'home/jquery.touchSwipe.js" type="text/javascript"></script>
                     <script src="' . $this->template->Js() . 'home/jquery.simpleslider.js" type="text/javascript"></script>
                     <script src="' . $this->template->Js() . 'home/custom.js" type="text/javascript"></script>
                ')
            ->set_layout('external/main')
            ->build('home', $data);
//        redirect();
    }

    public function routing(){
        redirect();
        $this->lang->load('home');
        $this->lang->load('Location');
        
        $user_country = FXPP::getUserCountryCode();

        if(in_array($user_country, array('US', 'KP', 'MM', 'SD', 'SY'))){
            $data['unavailable'] = true;
        }else{
            $data['unavailable'] = false;
        }
        $data['metadata_description'] = lang('x_hom_dsc');
        $data['metadata_keyword'] = lang('x_hom_kew');
        $this->template->title(lang('x_hom_tit'))
            ->set_layout('external/main')
            ->build('home', $data);
    }

    public function index3(){
       //session_write_close();
        $nlanguage = FXPP::html_url();
        $user_country = FXPP::getUserCountryCode();
        $this->lang->load('home');
        $this->lang->load('moneyfall');
        $this->lang->load('contest');
        $this->load->model('account_model');
        $this->load->model('news_model');
        $this->lang->load('Location');

        if(in_array($user_country, array('US', 'KP', 'MM', 'SD', 'SY'))){
            $data['unavailable'] = true;
        }else{
            $data['unavailable'] = false;
        }


            //Contest Monitoring
            $start_date = date('Y-m-d 00:00:00', strtotime('last monday -1 week', strtotime('tomorrow')));
            $end_date = date('Y-m-d 23:59:59', strtotime($start_date . ' +6 days'));
            $contest_data = $this->account_model->getContestWinnersLimit( $start_date, $end_date, 10 );
            if($contest_data){
                $rank = 0;
                $prev_value = 0;

                $start_dates = date('Y-m-d 00:00:00', strtotime('next monday', strtotime($start_date)));
                $end_dates = date('Y-m-d 22:59:59', strtotime($start_dates . ' +4 days'));


                foreach($contest_data as $key => $value){
                    if($prev_value <> $value['amount']){
                        $rank++;
                        $prev_value = $value['amount'];
                    }

                    $country_name = $this->g_m->getCountries($value['country']);
                    if(!is_array($country_name)){
                        if($country_name){
                            $contest_data[$key]['country_name'] = $country_name;
                        }else{
                            $contest_data[$key]['country_name'] = '';
                        }
                    }else{
                        $contest_data[$key]['country_name'] = '';
                    }
                    $contest_data[$key]['rank'] = $rank;
                    $contest_data[$key]['start_end'] = date("m/d/Y", strtotime($start_dates))." - ". date("m/d/Y", strtotime($end_dates));
                }
            }
            $data['rankings'] = $contest_data;

            /* Get Latest News List */
            $latest_news = $this->news_model->getLatestNewsByLimit(6, 0, $nlanguage);
            if(count($latest_news) > 0){
                $top_latest_news = $latest_news[0];
                if(!empty($top_latest_news['publisher_image'])) {
                    if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                        $top_latest_news['publisher_image'] = 'avatar.png';
                    }
                }else{
                    $top_latest_news['publisher_image'] = 'avatar.png';
                }
                unset($latest_news[0]);
            }else{
                $latest_news = $this->news_model->getLatestNewsByLimit(6, 0, 'EN');
                if(count($latest_news) > 0){
                    $top_latest_news = $latest_news[0];
                    if(!empty($top_latest_news['publisher_image'])) {
                        if (!file_exists('./assets/news_images/' . $top_latest_news['publisher_image'])) {
                            $top_latest_news['publisher_image'] = 'avatar.png';
                        }
                    }else{
                        $top_latest_news['publisher_image'] = 'avatar.png';
                    }
                    unset($latest_news[0]);
                }else{
                    $top_latest_news = array();
                }
            }

            $top_news_images = $this->news_model->getNewsImagesByNewsId($top_latest_news['id']);

            $data['latest_news'] = $latest_news;
            $data['top_latest_news'] = $top_latest_news;
            $data['top_news_images'] = $top_news_images;
            $data['nlanguage'] = $nlanguage;


        $sysmbolsData = FXPP::generateQuotesRow();
        $data['quotes'] = $sysmbolsData;
        
        $data['metadata_description'] = '';
        $data['metadata_keyword'] = lang('x_hom_kew');
            $css_files = "
                       <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400|Playball' rel='stylesheet' type='text/css'>
                       <link rel='stylesheet' href='".$this->template->Css()."mapstyle.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."dataTables.bootstrap2.css'>
                       <link rel='stylesheet' href='".$this->template->Css()."awardarea.css'>
                 ";

        $this->template->title(lang('x_hom_tit'))
            ->append_metadata_css($css_files)
            ->append_metadata_js('
                     <script src="' . $this->template->Js() . 'jquery.dataTables.js"></script>
                     <script src="' . $this->template->Js() . 'dataTables.bootstrap.js"></script>
                     <script src="' . $this->template->Js() . 'home/jquery.touchSwipe.js" type="text/javascript"></script>
                     <script src="' . $this->template->Js() . 'home/jquery.simpleslider.js" type="text/javascript"></script>
                     <script src="' . $this->template->Js() . 'home/custom.js" type="text/javascript"></script>
                ')
            ->set_layout('external/main')
            ->build('home_test', $data);
    }


}
