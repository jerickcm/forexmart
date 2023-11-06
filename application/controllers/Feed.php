<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class feed extends CI_Controller
{
    private $js;
    private $country_code;

    function __construct()
    {
        parent::__construct();
        $this->load->helper('xml');
        $this->load->helper('text');
    }

    public function index(){
        redirect('feed/news');
    }

    public function news($lan = ''){

//            $con = array('en', 'jp', 'id', 'de', 'fr', 'it', 'sa', 'es', 'pt', 'sk', 'pl', 'pk', 'gr', 'my', 'bg');
//            if (in_array($lan, $con)) {
//                $lan = 'EN';
//            } else {
//                $lan = 'RU';
//            }

            header('Content-Type: text/xml; charset=utf-8'); // important!
            $this->load->model('news_model');
            $data['feed_name'] = 'www.forexmart.com'; // your website
            $data['encoding'] = 'utf-8'; // the encoding
            $data['feed_url'] = 'https://www.forexmart.com/feed/news/' . $lan; // the url to your feed
            $data['page_description'] = 'Latest ForexMart news'; // some description
            $data['page_language'] = $lan . ' - ' . $lan; // the language
            $data['creator_email'] = 'support@forexmart.com'; // your email
            $data['posts'] = $this->news_model->getLatestNewsByLimit(100, 0, $lan);
            $this->load->view('rss/news_feed', $data);

    }


    public function news2($lan = ''){
        header('Content-Type: text/xml; charset=utf-8'); // important!
      $this->load->model('news_model_v2');
        $data['feed_name'] = 'www.forexmart.com'; // your website
        $data['encoding'] = 'utf-8'; // the encoding
        $data['feed_url'] = 'https://www.forexmart.com/feed/news2/' . $lan; // the url to your feed
        $data['page_description'] = 'Latest ForexMart news'; // some description
        $data['page_language'] = $lan . ' - ' . $lan; // the language
        $data['creator_email'] = 'support@forexmart.com'; // your email

        $latest_news = array();
        $latest_news_new = $this->news_model_v2->getLatestNewsByLimit(100, 0, $lan);
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

        $data['posts'] = $latest_news;
//        print_r($data);
        $this->load->view('rss/news_feed2', $data);

    }


    public function analysis(){
        header('Content-Type: text/xml; charset=utf-8'); // important!
        $this->load->model('analysis_model');
        $data['feed_name'] = 'www.forexmart.com'; // your website
        $data['encoding'] = 'utf-8'; // the encoding
        $data['feed_url'] = 'https://www.forexmart.com/rss/analysis'; // the url to your feed
        $data['page_description'] = 'Latest ForexMart Analysis'; // some description
        $data['page_language'] = 'en-en'; // the language
        $data['creator_email'] = 'support@forexmart.com'; // your email
        $data['posts'] = $this->analysis_model->getLatestAnalysisByLimit(10, 0, 'EN');
        $this->load->view('rss/analysis_feed', $data);
    }
}