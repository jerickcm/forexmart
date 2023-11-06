<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Banners_model');

    }

    public function index(){
        $this->lang->load('banners');
        $getAllSizes = $this->Banners_model->getAllSizes();
        $tempArray = '';
        foreach($getAllSizes as $index => $details) {
//            if(IPLoc::Office()){
                $rownumber = $index + 1;
                $size = $details["size"];
                $getBannerDetails = $this->Banners_model->getBannerDetailsBySize($size);
//                $count_banner = count($getBannerDetails);
                $showButton = '<button class="btn-show-banner" id="'.$details['size'].'">'.lang("b_t_td_5").'</button>';
                $hide_pl = array('120x600','190x113','550x500','728x90','300x600','1000x212','120x120','970x250','600x425','300x300');
                $hpl = in_array($details["size"], $hide_pl) ? true : false;
                if(FXPP::html_url()=='pl' && $hpl && count($getBannerDetails)<=2){
                  //  print_r('test true');exit;
                }else{
//                    $count_banner = $hpl?count($getBannerDetails)-1:
                 //   print_r('test false');exit;
                    $tempArray .= '<tr >'
                        . '<td>'.$rownumber.'</td>'
                        . '<td>'.$size.'</td>'
                        . '<td>'.count($getBannerDetails).'</td>'
                        . '<td>'.lang('td_image').'</td>'
                        . '<td>'.$showButton.'</td></tr>';
                }
//            }else{
//                $rownumber = $index + 1;
//                $size = $details["size"];
//                $getBannerDetails = $this->Banners_model->getBannerDetailsBySize($size);
//                $showButton = '<button class="btn-show-banner" id="'.$details['size'].'">'.lang("b_t_td_5").'</button>';
//                $tempArray .= '<tr >'
//                    . '<td>'.$rownumber.'</td>'
//                    . '<td>'.$size.'</td>'
//                    . '<td>'.count($getBannerDetails).'</td>'
//                    . '<td>'.lang('td_image').'</td>'
//                    . '<td>'.$showButton.'</td></tr>';
//            }
        }

        $data['bannerList'] = $tempArray;
        $data['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
       // $data['metadata_description'] = lang('b_dsc');
        $data['metadata_description'] = '';

        $data['metadata_keyword'] = lang('b_kew');
        $this->template->title(lang('b_tit'))
            ->append_metadata_js('
                <script src="https://code.jquery.com/jquery-1.12.0.min.js" ></script>
                <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>
                ')
            ->append_metadata_css("
            <link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css'/>
                 ")
            ->set_layout('external/main')
            ->build('external_Banners', $data);
    }

    public function BannersShow() {
        if (!$this->input->is_ajax_request()) {
            redirect('');
        }
        $size = $this->input->post('pagename',true);
        $data['lang'] = $this->input->post('lang',true);
        $getBanners = $this->Banners_model->getBanner($size);
        $stringHtml = '';

        switch($data['lang']){
            case 'ru':
                $data['folder']='banners_ru';
                break;
            case 'es':
                $data['folder']='banners_es';
                break;
            case 'de':
                $data['folder']='banners_de';
                break;
            case 'pt':
                $data['folder']='banners_pt';
                break;
            case 'fr':
                    $data['folder']='banners_fr';
                break;
            case 'id':
                $data['folder']='banners_id';
                break;
            default:
                $data['folder']='banners';
        }

        if($getBanners){
            $stringHtml .= '<div class="forex-banners-holder col-lg-12 col-md-12 col-sm-12 col-xs-12">';
            $stringHtml .= ' <div class="forex-banners-title"><h1>Size: '.$size.'</h1></div>';
            foreach($getBanners as $key => $r){
//                if(IPLoc::Office()){
                    $hide_pl = array('120x600','190x113','550x500','728x90','300x600','1000x212','120x120','970x250','600x425','300x300');
                    $hide_pl_image = array('120x600-3.gif','190x113-3.gif','550x500_banner3.gif','728x90_banner4.gif','300x600_banner3.gif','300x600_banner4.gif','1000x212_banner3.gif','120x120_banner2.gif','970x250_banner1.gif','970x250_banner3.gif','600x425_banner1.gif','600x425_banner3.gif','300x300_banner1.gif');
                    $hpl = in_array($r['size'], $hide_pl) ? 'hide' : 'show';
                    $hplimg = in_array($r['banner_name'], $hide_pl_image) ? 'hide' : 'show';
//                    print_r($hpl);
//                    print_r($hplimg);exit;
                    if((FXPP::html_url()=='pl') && $hpl=='hide' && $hplimg=='hide'){
//                        print_r('test true');exit;
                        $banners = array('400x80', '468x60', '550x500', '580x51', '580x70', '728x90', '970x90', '775x60', '970x250', '600x425','956x40','1000x212');
                        $customStyleForBanners = in_array($r['size'], $banners) ? '12' : '4';
                        $responsiveWidthForTextrea = in_array($r['size'], $banners) ? '30%' : '100%';
                        $stringHtml .= '<div class="col-lg-'.$customStyleForBanners.' col-md-'.$customStyleForBanners.'" col-sm-12 col-xs-12">';
                        $stringHtml .= '<div class="forex-banner-container" style="display:none;">';
                        $stringHtml .= '<a href="'.FXPP::loc_url($r['url']).'" target="_blank" style="outline: none"><img src="'.$this->template->Images().$data['folder'].'/'.$r['size'].'/'.$r['banner_name'].'"></a>';
                        $stringHtml .= '<a class="donalodFile" href="'.$this->template->Images().$data['folder'].'/'.$r['size'].'/'.$r['banner_name'].'" download>Download file</a><br>';
                        $stringHtml .= '<textarea style="width: '.$responsiveWidthForTextrea.';height: 150px;"><a href="'.base_url().'register?id=Your_Affiliate_code" target="_blank" style="outline: none"><img src="'.$this->template->Images().$data['folder'].'/'.$r['size'].'/'.$r['banner_name'].'" width="'.$r['width'].'" height="'.$r['height'].'" alt="Forexmart" border="0" /></a></textarea>';
                        $stringHtml .= '</div>';
                        $stringHtml .= '</div>';
                    }else{
//                        print_r('test false');exit;
                        $banners = array('400x80', '468x60', '550x500', '580x51', '580x70', '728x90', '970x90', '775x60', '970x250', '600x425','956x40','1000x212');
                        $customStyleForBanners = in_array($r['size'], $banners) ? '12' : '4';
                        $responsiveWidthForTextrea = in_array($r['size'], $banners) ? '30%' : '100%';
                        $stringHtml .= '<div class="col-lg-'.$customStyleForBanners.' col-md-'.$customStyleForBanners.'" col-sm-12 col-xs-12">';
                        $stringHtml .= '<div class="forex-banner-container">';
                        $stringHtml .= '<a href="'.FXPP::loc_url($r['url']).'" target="_blank" style="outline: none"><img src="'.$this->template->Images().$data['folder'].'/'.$r['size'].'/'.$r['banner_name'].'"></a>';
                        $stringHtml .= '<a class="donalodFile" href="'.$this->template->Images().$data['folder'].'/'.$r['size'].'/'.$r['banner_name'].'" download>Download file</a><br>';
                        $stringHtml .= '<textarea style="width: '.$responsiveWidthForTextrea.';height: 150px;"><a href="'.base_url().'register?id=Your_Affiliate_code" target="_blank" style="outline: none"><img src="'.$this->template->Images().$data['folder'].'/'.$r['size'].'/'.$r['banner_name'].'" width="'.$r['width'].'" height="'.$r['height'].'" alt="Forexmart" border="0" /></a></textarea>';
                        $stringHtml .= '</div>';
                        $stringHtml .= '</div>';
                    }
//                }else{
//                    $banners = array('400x80', '468x60', '550x500', '580x51', '580x70', '728x90', '970x90', '775x60', '970x250', '600x425','956x40','1000x212');
//                    $customStyleForBanners = in_array($r['size'], $banners) ? '12' : '4';
//                    $responsiveWidthForTextrea = in_array($r['size'], $banners) ? '30%' : '100%';
//                    $stringHtml .= '<div class="col-lg-'.$customStyleForBanners.' col-md-'.$customStyleForBanners.'" col-sm-12 col-xs-12">';
//                    $stringHtml .= '<div class="forex-banner-container">';
//                    $stringHtml .= '<a href="'.FXPP::loc_url($r['url']).'" target="_blank" style="outline: none"><img src="'.$this->template->Images().$data['folder'].'/'.$r['size'].'/'.$r['banner_name'].'"></a>';
//                    $stringHtml .= '<a class="donalodFile" href="'.$this->template->Images().$data['folder'].'/'.$r['size'].'/'.$r['banner_name'].'" download>Download file</a><br>';
//                    $stringHtml .= '<textarea style="width: '.$responsiveWidthForTextrea.';height: 150px;"><a href="'.base_url().'register?id=Your_Affiliate_code" target="_blank" style="outline: none"><img src="'.$this->template->Images().$data['folder'].'/'.$r['size'].'/'.$r['banner_name'].'" width="'.$r['width'].'" height="'.$r['height'].'" alt="Forexmart" border="0" /></a></textarea>';
//                    $stringHtml .= '</div>';
//                    $stringHtml .= '</div>';
//                }

            }
            $stringHtml .= '</div>';
        }
        unset($data);
        echo $stringHtml;

    }

    public function getBanners(){
//        if (!$this->input->is_ajax_request()) {
//            redirect('');
//        }

        $this->load->model('Banners_model');

        $size = '120x600';
        $getBanners = $this->Banners_model->getBanner($size);
        $stringHtml = '';

        if($getBanners){
            $stringHtml .= '<div class="forex-banners-holder col-lg-12 col-md-12 col-sm-12 col-xs-12">';
            $stringHtml .= ' <div class="forex-banners-title"><h1>Size: '.$size.'</h1></div>';
            foreach($getBanners as $key => $r){
                $stringHtml .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
                $stringHtml .= '<div class="forex-banner-container horizontal-forex-banner banner-580x70">';
                $stringHtml .= '<img src="'.$this->template->Images().'banners/'.$r['size'].'/'.$r['banner_name'].'">';
                $stringHtml .= '<a class="donalodFile" href="'.$this->template->Images().'banners/'.$r['size'].'/'.$r['banner_name'].'" download>Download file</a><br>';
                $stringHtml .= '<textarea><a href="'.base_url().'register?id=Your_Affiliate_code" target="_blank" style="outline: none"><img src="'.$this->template->Images().'banners/'.$r['size'].'/'.$r['banner_name'].'" width="'.$r['width'].'" height="'.$r['height'].'" alt="Forexmart" border="0" /></a></textarea>';
                $stringHtml .= '</div>';
                $stringHtml .= '</div>';

            }
            $stringHtml .= '</div>';
        }

        $data['Banners'] = $stringHtml;
        $data['metadata_description'] = lang('b_dsc');
        $data['metadata_keyword'] = lang('b_kew');
        $this->template->title(lang('b_tit'))
            ->set_layout('external/main')
            ->build('banners/get_banners',$data);
    }
}
