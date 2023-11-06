<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    private $country_code;
    public function __construct() {
        parent::__construct();
        $this->country_code = FXPP::getUserCountryCode() or null;
    }

//    public function _remap($method){
//        $segment = $this->uri->segment(1, 0);
//        $ci =& get_instance();
//        switch($segment){
//            case 'ru':
//                $this->session->set_userdata('site_lang', 'russuan');
//                break;
//            case 'jp':
//                $this->session->set_userdata('site_lang', 'japanese');
//                break;
//            case 'id':
//                $this->session->set_userdata('site_lang', 'indonesian');
//                break;
//            case 'de':
//                $this->session->set_userdata('site_lang', 'german');
//                break;
//            case 'fr':
//                $this->session->set_userdata('site_lang', 'french');
//                break;
//            case 'it':
//                $this->session->set_userdata('site_lang', 'italian');
//                break;
//            case 'sa':
//                $this->session->set_userdata('site_lang', 'arabic');
//                break;
//            case 'es':
//                $this->session->set_userdata('site_lang', 'spanish');
//                break;
//            case 'pt':
//                $this->session->set_userdata('site_lang', 'portugese');
//                break;
//            case 'en':
//                $this->session->set_userdata('site_lang', 'english');
//                break;
//            default:
//                $this->session->set_userdata('site_lang', 'english');
//
//        }
//        $siteLang = $ci->session->userdata('site_lang');
//        $ci->lang->load('ForexMart',$siteLang);
//        $this->$method();
//    }
    public function SetCookie() {
        if (!$this->input->is_ajax_request()) {
            die('Not authorized!');
        }

        $data['cookie'] = array(
            'name' => 'conceal',
            'value' => rand(0, 100),
            'expire' => time() + (10 * 365 * 24 * 60 * 60),
            'domain' => '.forexmart.com',
            'path' => '/',
            'prefix' => '',
            'secure' => true,
            'httponly' => true,
        );
        $this->input->set_cookie($data['cookie'], true);
    }

    /** start external top navigation */
    /** ABOUT  */

    /** tab1 */

    public function AboutUs() {
        $data['data'] = '';
        $this->template->title("About Us | ForexMart")
                ->set_layout('external/main')
                ->build('external_AboutUs', $data['data']);
    }

    public function companynews() {


        $this->load->helper("url");
        $this->load->model("External_model");
        $this->load->library("pagination");

        $config = array();
        $config["base_url"] = base_url() . "company-news";
        $config["total_rows"] = $this->External_model->record_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 2;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        //first link
        $config['first_tag_open'] = '<li class="">';
        $config['first_tag_close'] = '</li>';
        $config['first_link'] = '&#171;';

        //previous link
        $config['prev_tag_open'] = '<li class="">';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = '&#139;';

        //next link
        $config['next_tag_open'] = '<li class="">';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = '&#155;';

        //last link
        $config['last_tag_open'] = '<li class="">';
        $config['last_tag_close'] = '</li>';
        $config['last_link'] = '&#187;';


        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['data']["results"] = $this->External_model->fetch_news($config["per_page"], $data['page']);

        $data['data']["links"] = $this->pagination->create_links();

        //$data['data']['metadata_description'] = 'Keep abreast of the latest local and international economic, financial, and political events.';
        $data['data']['metadata_description'] = '';

        $data['data']['metadata_keyword'] = 'Company News | About | ForexMart';
        $this->template->title("Company News | About | ForexMart")
                ->set_layout('external/main')
                ->build('external_companynews', $data['data']);
    }

    public function whychooseus() {

        $data['data']['metadata_description'] = 'ForexMart is strongly committed to being your dependable forex trading partner.';
        $data['data']['metadata_keyword'] = 'Why Choose Us | About | ForexMart';
        $this->template->title("Why Choose Us | About | ForexMart")
                ->set_layout('external/main')
                ->build('external_whychooseus', $data['data']);
    }
    public function meetusoffline() {
        if(IPLoc::Office()){
        $data['data']['metadata_description'] = 'ForexMart is strongly committed to being your dependable forex trading partner.';
        $data['data']['metadata_keyword'] = 'Meet Us Offline | About | ForexMart';
        $this->template->title("Meet Us Offline | About | ForexMart")
                ->set_layout('external/main')
                ->build('external_meetusoffline', $data['data']);
        }else{
            $this->load->view('errors/html/error_404');
        }
    }

    public function DepositWithdraw() {

        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'Transferring and sending funds into your trading account have never been this easy and safe. ';
        $data['data']['metadata_keyword'] = 'Deposit and Withdraw | About | ForexMart';
        $this->template->title("Deposit and Withdraw | About | ForexMart")
                ->append_metadata_js("
                    <script type='text/javascript'>
                        $(document).ready(function(){
                          $('#dep').click(function(){
                                $('#with').removeClass('tab-active');
                                $('#dep').addClass('tab-active');
                            });
                             $('#with').click(function(){
                                $('#dep').removeClass('tab-active');
                                $('#with').addClass('tab-active');
                            });
                        });
                    </script>
                ")
                ->set_layout('external/main')
                ->build('external_DepositWithdrawPage', $data['data']);
    }

    public function licenceandregulations() {

        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'ForexMart is regulated by Cyprus Securities and Exchange Commission (CySEC). with license number 266/15.';
        $data['data']['metadata_keyword'] = 'Licence and Regulations | About | ForexMart';
        $this->template->title("Licence and Regulations | About | ForexMart")
                ->set_layout('external/main')
                ->build('external_licenceandregulations', $data['data']);
    }
    public function deposit_insurance(){
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'Deposit Insurance ForexMart';
        $data['data']['menu_item']=array('l_c','l_d','r_e');

        $this->template->title("Deposit Insurance | ForexMart")
            ->append_metadata_js("
                ")
            ->set_layout('external/main')
            ->build('external_deposit_insurance', $data['data']);
    }

    /** FOREX  */

    /** tab1 */

    public function demoaccounts() {

        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean');
        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required|xss_clean');
        $this->form_validation->set_message('is_unique', 'This email is already used.');
        if ($this->form_validation->run()) {


            $user_data = array(
                'email_demo' => $this->input->post('email',true),
                'full_name_demo' => $this->input->post('full_name',true)
            );
            $this->session->set_userdata($user_data);
            redirect('register/demo/step2');
        }
        $data['data']['metadata_description'] = 'Practice forex trading in a risk-free environment - for free!';
        $data['data']['metadata_keyword'] = 'ForexMart Demo Account | Forex demo account | MT4 & MT5 Account';
        $this->template->title("ForexMart Demo Account | MT4 & MT5 Account")
                ->set_layout('external/main')
                ->build('external_demoAccounts', $data['data']);
    }

    public function liveaccounts() {

        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean');
        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required|xss_clean');
        $this->form_validation->set_message('is_unique', 'This email is already used.');
        if ($this->form_validation->run()) {

            $user_data = array(
                'email_live' => $this->input->post('email',true),
                'full_name_live' => $this->input->post('full_name',true)
            );
            $this->session->set_userdata($user_data);
            redirect('register/index/step2');
        }

        $data['data']['metadata_description'] = 'Start your forex trading experience with ForexMart. Experience instant trade executions and glitch-free trading platforms.';
        $data['data']['metadata_keyword'] = 'ForexMart Live Account |Forex live account | MT4 & MT5 Account';
        $this->template->title("ForexMart Live Account | MT4 & MT5 Account")
                ->set_layout('external/main')
                ->build('external_liveAccounts', $data['data']);
    }

    /** tab2 */
    public function tradingplatforms() {
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = '';
    }

    public function forexmartmt4() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'MetaTrader 4 enables you to track up to four charts simultaneously, trade directly from the chart, and place multiple orders.';
        $data['data']['metadata_keyword'] = 'ForexMart MT4 | Metatrader';
        $this->template->title("ForexMart MT4 | Metatrader")
                ->set_layout('external/main')
                ->build('external_MetaTrader4', $data['data']);
    }

    public function forexmartmt5() {
        redirect(''); //temporary redirects to homepage.
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'ForexMart MT5 | Metatrader';
        $this->template->title("ForexMart MT5 | Metatrader")
                ->set_layout('external/main')
                ->build('external_MetaTrader5', $data['data']);
    }

    /** tab3 */
    public function instruments() {
        $data['instruments_tab_active'] = 'forex';
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = '';
        $this->template->title("instruments  | Metatrader")
                ->set_layout('external/main')
                ->build('external_FinancialInstruments', $data);
    }

    public function forex() {
        $data['instruments_tab_active'] = 'forex';
        $data['data']['metadata_description'] = 'ForexMart offers a wide array of financial instruments, as well as CFDs on spot metals and shares.';
        $data['data']['metadata_keyword'] = 'Forex | ForexMart Instruments';
        $this->template->title("Forex | ForexMart Instruments")
                ->set_layout('external/main')
                ->build('external_FinancialInstruments', $data);
    }

    public function futures() {
        redirect(''); //temporary redirects to home page.
        $data['data'] = '';
        $data['call_modal'] = "
        <script type='text/javascript'>
            $(document).ready(function(){
                $('div#futures').addClass('active');
                  $('a#fu').addClass('changeactive');

                    $('a#sp').click(function(){
                       $('a#sp').addClass('changeactive');
                       $('a#sh').removeClass('changeactive');
                       $('a#fo').removeClass('changeactive');
                       $('a#fu').removeClass('changeactive');
                    });

                    $('a#sh').click(function(){
                       $('a#sh').addClass('changeactive');
                       $('a#sp').removeClass('changeactive');
                       $('a#fo').removeClass('changeactive');
                       $('a#fu').removeClass('changeactive');
                    });

                    $('a#fo').click(function(){
                       $('a#fo').addClass('changeactive');
                       $('a#sh').removeClass('changeactive');
                       $('a#sp').removeClass('changeactive');
                       $('a#fu').removeClass('changeactive');
                    });

                    $('a#fu').click(function(){
                       $('a#fu').addClass('changeactive');
                       $('a#sh').removeClass('changeactive');
                       $('a#fo').removeClass('changeactive');
                       $('a#sp').removeClass('changeactive');
                    });
            });
        </script>
        ";
        $data['data']['metadata_description'] = 'Futures allow you to hedge or speculate on the price movement of a particular asset.';
        $data['data']['metadata_keyword'] = 'Futures | ForexMart Instruments';
        $this->template->title("Futures | ForexMart Instruments")
                ->append_metadata_js($data['call_modal'])
                ->set_layout('external/main')
                ->build('external_FinancialInstruments', $data['data']);
    }

    public function shares() {
        $data['instruments_tab_active'] = 'shares';
        $data['data']['metadata_description'] = 'Trade stocks like you have never done before. Go short or long on positions with more than 200 well-known US and UK shares.';
        $data['data']['metadata_keyword'] = 'Shares | ForexMart Instruments';
        $this->template->title("Shares | ForexMart Instruments")
                ->set_layout('external/main')
                ->build('external_FinancialInstruments', $data);
    }

    public function spotmetals() {
        $this->lang->load('FinancialInstruments');
        $data['instruments_tab_active'] = 'spotmetals';
        $data['data']['metadata_description'] = 'We aim to provide the most advantageous spreads and leverage on spot metals and currency crosses.';
        $data['data']['metadata_keyword'] = 'Spot Metals | ForexMart Instruments';
        $this->template->title("Spot Metals | ForexMart Instruments")
                ->set_layout('external/main')
                ->build('external_FinancialInstruments', $data);
    }

    /** BONUSES & OFFERS  */

    /** tab1 */
    public function NoDepositBonus() {
        $data['data']['bonus'] = IPLoc::bonus();
        $data['data']['check'] = $this->load->ext_view('modal', 'check', $data['data'], TRUE);
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'No deposit forex bonus';
        $this->template->title("No Deposit Bonus | Forexmart")
                ->set_layout('external/main')
                ->build('external_NoDepositBonus', $data['data']);
    }

    public function NoDepositBonusAgreement() {

        $data['data']['bonus'] = IPLoc::bonus();

        $data['data']['check'] = $this->load->ext_view('modal', 'check', $data['data'], TRUE);
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = '';
        $this->template->title("No Deposit Bonus Agreement| Forexmart")
                ->set_layout('external/main')
                ->build('external_NoDepositBonusAgreement', $data['data']);
    }

    /** BONUSES & OFFERS  */
    public function bonuses() {

        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = '';
        $this->template->title("Bonuses | Forexmart")
                ->set_layout('external/main')
                ->build('external_bonuses', $data['data']);
    }

//    public function thirtypercentbonus() {
//
//        $data['data']['metadata_description'] = '';
//        $data['data']['metadata_keyword'] = 'Forex bonus';
//        $this->template->title("30&#37; Bonus  | Forexmart")
//                ->set_layout('external/main')
//                ->build('external_ThirtyPercentBonus', $data['data']);
//    }

    public function ThirtyPercentBonusAgreement() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = '';
        $this->template->title("30&#37; Bonus Agreement | Forexmart")
                ->set_layout('external/main')
                ->build('external_ThirtyPercentBonusAgreement', $data['data']);
    }

    /* ---- Tools menu ---- */

    public function vpsHosting() {


        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'ForexMart is regulated by Free VPS Hosting.';
        $data['data']['metadata_keyword'] = 'VPS Hosting | About | ForexMart | Forex vps hosting';
        $this->template->title("VPS Hosting | ForexMart")
                ->set_layout('external/main')
                ->build('external_vpsHosting', $data['data']);
    }

    public function forexCharts() {

        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'ForexMart is regulated by Free VPS Hosting.';
        $data['data']['metadata_keyword'] = 'Forex chart | VPS Hosting | About | ForexMart';
        $this->template->title("Forex Chart | ForexMart")
                ->set_layout('external/main')
                ->build('external_forexCharts', $data['data']);
    }

    public function ajaxForexChartsRequest() {
        if (!$this->input->is_ajax_request()) {
            redirect('');
        }
        $data['command'] = $commandCode = $this->input->post('commandCode',true);
        echo $this->load->view('external_forexCharts_hidden_data', $data, TRUE);
    }

    /** tab2 */
    /** PARTNERS  */

    /** tab1 */
    public function affiliateprogram() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = '';
        $this->template->title("Affiliate Program | Forexmart")
                ->set_layout('external/main')
                ->build('external_affiliate_program', $data['data']);
    }

    public function affiliatelink() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'Earn commissions and reap rewards when referring clients through your affiliate link.';
        $data['data']['metadata_keyword'] = 'Affiliate link | ForexMart';
        $this->template->title("Affiliate Link| ForexMart")
                ->set_layout('external/main')
                ->build('external_AffiliateLink', $data['data']);
    }

    public function commissionspecification() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'Gain as your clients trade. Be our partner today and earn up to 50% revenue share.';
        $data['data']['metadata_keyword'] = 'Commission Specification | ForexMart';
        $this->template->title("Commission Specification | ForexMart")
                ->set_layout('external/main')
                ->build('external_CommissionSpecification', $data['data']);
    }

    /** tab2 */
    public function TypesofPartnership() {
        $data['data'] = '';
        $data['call_modal'] = "
        <script type='text/javascript'>

            $(document).ready(function(){
                $('div#spot').addClass('active')
                $('a#Friendreferral').addClass('changeactive');

                    $('a#Friendreferral').click(function(){
                       $('a#Friendreferral').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Webmaster').click(function(){
                        $('a#Webmaster').addClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#OnlinPartner').click(function(){
                        $('a#OnlinPartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Localonlinepartner').click(function(){
                        $('a#Localonlinepartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Localofficepartner').click(function(){
                        $('a#Localofficepartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                    });
            });

        </script>
        ";

        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = '';
        $this->template->title("Types of Partnership | Metatrader")
                ->append_metadata_js($data['call_modal'])
                ->set_layout('external/main')
                ->build('external_TypesofPartnership', $data['data']);
    }

    public function FriendReferral() {

        $data['data'] = '';

        $data['call_modal'] = "
        <script type='text/javascript'>

            $(document).ready(function(){
                $('div#friend').addClass('active')
                $('a#Friendreferral').addClass('changeactive');

                    $('a#Friendreferral').click(function(){
                       $('a#Friendreferral').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Webmaster').click(function(){
                        $('a#Webmaster').addClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#OnlinPartner').click(function(){
                        $('a#OnlinPartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Localonlinepartner').click(function(){
                        $('a#Localonlinepartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Localofficepartner').click(function(){
                        $('a#Localofficepartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                    });
            });

        </script>
        ";

        $data['data']['metadata_description'] = 'Let people do the work for you. As they generate profit, you earn money too.';
        $data['data']['metadata_keyword'] = 'Friend-referral | ForexMart Partners';
        $this->template->title("Friend-referral | ForexMart Partners")
                ->append_metadata_js($data['call_modal'])
                ->set_layout('external/main')
                ->build('external_TypesofPartnership', $data['data']);
    }

    public function WebMaster() {

        $data['data'] = '';

        $data['call_modal'] = "
        <script type='text/javascript'>

            $(document).ready(function(){
                $('div#webmaster').addClass('active')
                $('a#Webmaster').addClass('changeactive');

                    $('a#Friendreferral').click(function(){
                       $('a#Friendreferral').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Webmaster').click(function(){
                        $('a#Webmaster').addClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#OnlinPartner').click(function(){
                        $('a#OnlinPartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Localonlinepartner').click(function(){
                        $('a#Localonlinepartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Localofficepartner').click(function(){
                        $('a#Localofficepartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                    });
            });

        </script>
        ";
        $data['data']['metadata_description'] = 'Whether launcing a website or improving a site, we got you covered. Our promotional materials can be integrated into any website.';
        $data['data']['metadata_keyword'] = 'Webmaster | ForexMart Partners';
        $this->template->title("Webmaster | ForexMart Partners")
                ->append_metadata_js($data['call_modal'])
                ->set_layout('external/main')
                ->build('external_TypesofPartnership', $data['data']);
    }

    public function OnlinePartner() {

        $data['call_modal'] = "
        <script type='text/javascript'>

            $(document).ready(function(){
                $('div#online').addClass('active')
                $('a#OnlinPartner').addClass('changeactive');

                    $('a#Friendreferral').click(function(){
                       $('a#Friendreferral').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Webmaster').click(function(){
                        $('a#Webmaster').addClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#OnlinPartner').click(function(){
                        $('a#OnlinPartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Localonlinepartner').click(function(){
                        $('a#Localonlinepartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Localofficepartner').click(function(){
                        $('a#Localofficepartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                    });
            });

        </script>
        ";
        $data['data']['metadata_description'] = 'Capitalize on the website trafic. Gain profit without monitoring your clients and their trades.';
        $data['data']['metadata_keyword'] = 'Online Partner | ForexMart Partners';
        $this->template->title("Online Partner | ForexMart Partners")
                ->append_metadata_js($data['call_modal'])
                ->set_layout('external/main')
                ->build('external_TypesofPartnership', $data['data']);
    }

    public function LocalOnlinePartner() {

        $data['data'] = '';

        $data['call_modal'] = "
        <script type='text/javascript'>

            $(document).ready(function(){
                $('div#localon').addClass('active')
                $('a#Localonlinepartner').addClass('changeactive');

                    $('a#Friendreferral').click(function(){
                       $('a#Friendreferral').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Webmaster').click(function(){
                        $('a#Webmaster').addClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#OnlinPartner').click(function(){
                        $('a#OnlinPartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Localonlinepartner').click(function(){
                        $('a#Localonlinepartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Localofficepartner').click(function(){
                        $('a#Localofficepartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                    });
            });

        </script>
        ";

        $data['data']['metadata_description'] = 'They trade, you earn. Attract new clients by promoting our products and services.';
        $data['data']['metadata_keyword'] = 'Local Online Partner | ForexMart Partners';
        $this->template->title("Local Online Partner | ForexMart Partners")
                ->append_metadata_js($data['call_modal'])
                ->set_layout('external/main')
                ->build('external_TypesofPartnership', $data['data']);
    }

    public function LocalOfficePartner() {

        $data['data'] = '';

        $data['call_modal'] = "
        <script type='text/javascript'>

            $(document).ready(function(){
                $('div#localoff').addClass('active')
                $('a#Localofficepartner').addClass('changeactive');

                    $('a#Friendreferral').click(function(){
                       $('a#Friendreferral').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Webmaster').click(function(){
                        $('a#Webmaster').addClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#OnlinPartner').click(function(){
                        $('a#OnlinPartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Localonlinepartner').click(function(){
                        $('a#Localonlinepartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                       $('a#Localofficepartner').removeClass('changeactive');
                    });

                    $('a#Localofficepartner').click(function(){
                        $('a#Localofficepartner').addClass('changeactive');
                       $('a#Webmaster').removeClass('changeactive');
                       $('a#OnlinPartner').removeClass('changeactive');
                       $('a#Localonlinepartner').removeClass('changeactive');
                       $('a#Friendreferral').removeClass('changeactive');
                    });
            });

        </script>
        ";

        $data['data']['metadata_description'] = 'Be an official ForexMart representative. Expand your client network with our latest trading technology and competitive rates.';
        $data['data']['metadata_keyword'] = 'Local Office Partner | ForexMart Partners';
        $this->template->title("Local Office Partner | ForexMart Partners")
                ->append_metadata_js($data['call_modal'])
                ->set_layout('external/main')
                ->build('external_TypesofPartnership', $data['data']);
    }

    /** tab3 */
    public function partnershipregistration() {
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = '';
    }

    /** tab4 */
    public function Materials() {
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = '';
    }

    public function Banners() {
//        $this->load->library('IPLoc', null);
//        if (!IPLoc::WhitelistPIPCandCC()) {
//            redirect('');
//        }
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'Integrate our eye-catching, sophisticated banner on your website, blog, or personal site to advertise our offerings.';
        $data['data']['metadata_keyword'] = 'ForexMart Banners';

        $this->template->title("ForexMart Banners")
                ->set_layout('external/main')
                ->build('external_Banners', $data['data']);
    }

    public function logos() {
        /* $this->load->library('IPLoc', null);
          if(!IPLoc::WhitelistPIPCandCC()){
          redirect('');
          } */

        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'Integrate our eye-catching, sophisticated banner on your website, blog, or personal site to advertise our offerings.';
        $data['data']['metadata_keyword'] = 'ForexMart logos';

        $this->template->title("ForexMart Logos")
                ->set_layout('external/main')
                ->build('external_logos', $data['data']);
    }

    public function BannersShow() {
        if (!$this->input->is_ajax_request()) {
            redirect('');
        }

        $size = $this->input->post('pagename',true);

        $this->load->model('Banners_model');
        $getBanners = $this->Banners_model->getBanner($size);
        $stringHtml = '';

        if($getBanners){
            $stringHtml .= '<div class="forex-banners-holder col-lg-12 col-md-12 col-sm-12 col-xs-12">';
                $stringHtml .= ' <div class="forex-banners-title"><h1>Size: '.$size.'</h1></div>';

                foreach($getBanners as $key => $r){

                    $banners = array('400x80', '468x60', '550x500', '580x51', '580x70', '728x90', '970x90');
                    $customStyleForBanners = in_array($r['size'], $banners) ? '12' : '4';
                    $responsiveWidthForTextrea = in_array($r['size'], $banners) ? '30%' : '100%';
                    $stringHtml .= '<div class="col-lg-'.$customStyleForBanners.' col-md-'.$customStyleForBanners.'" col-sm-12 col-xs-12">';
                        $stringHtml .= '<div class="forex-banner-container">';
                            $stringHtml .= '<a href="'.base_url().''.$r['url'].'" target="_blank" style="outline: none"><img src="'.$this->template->Images().'banners/'.$r['size'].'/'.$r['banner_name'].'"></a>';
                            $stringHtml .= '<a class="donalodFile" href="'.$this->template->Images().'banners/'.$r['size'].'/'.$r['banner_name'].'" download>Download file</a><br>';
                            $stringHtml .= '<textarea style="width: '.$responsiveWidthForTextrea.';height: 150px;"><a href="'.base_url().'register?id=Your_Affiliate_code" target="_blank" style="outline: none"><img src="'.$this->template->Images().'banners/'.$r['size'].'/'.$r['banner_name'].'" width="'.$r['width'].'" height="'.$r['height'].'" alt="Forexmart" border="0" /></a></textarea>';
                        $stringHtml .= '</div>';
                    $stringHtml .= '</div>';

                }
            $stringHtml .= '</div>';
        }

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

        $this->template->title("ForexMart Banners")
            ->set_layout('external/main')
            ->build('banners/get_banners',$data);
    }

    public function informers() {

        $data['data']['metadata_description'] = 'ForexMart offers several informers that can be embedded on any customer or partner website.';
        $data['data']['metadata_keyword'] = 'ForexMart Informers';
        $this->template->title("ForexMart Informers")
                ->set_layout('external/main')
                ->build('faq', $data['data']);
    }

    public function moneyfall() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'ForexMart Money Fall';
        $this->template->title("Money Fall | ForexMart")
                ->append_metadata_js("")
                ->set_layout('external/main')
                ->build('external_MoneyFall', $data['data']);
    }

    public function MoneyFallRegistration() {

//        if(!IPLoc::ForexCalc()){
//            redirect('maintenance');
//        }

        require_once APPPATH . '/helpers/recaptchalib_helper.php';
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $this->load->library('form_validation');

        $this->load->model('General_model');
        $this->g_m = $this->General_model;

        $this->form_validation->set_rules('FullName', 'FullName', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('NickName', 'NickName', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('City', 'City', 'trim|required|xss_clean');

        $this->form_validation->set_rules('PhoneNumber', 'PhoneNumber', 'trim|required|xss_clean');
        $this->form_validation->set_rules('swapfree', 'swapfree', 'trim|xss_clean');

        $data['data']['custom_validation_success'] = '';
        $data['data']['custom_validation'] = '';
        $data['data']['custom_validation1'] = '';

        $data['data']['uniquefields'] = $this->g_m->showsfields($table = 'contestmoneyfall', 'FullName,Email,NickName');
        $data['data']['uniqueFullName'] = array();
        $data['data']['uniqueEmail'] = array();
        $data['data']['uniqueNickName'] = array();

        $data['data']['insertsuccess'] = false;

        $data['return_insert'] = false;
        foreach ($data['data']['uniquefields'] as $key => $value) {
            array_push($data['data']['uniqueNickName'], $value['NickName']);
        }

        if ($this->form_validation->run()) {
            if ($_POST["g-recaptcha-response"]) {

                if (in_array($this->input->post('NickName',true), $data['data']['uniqueNickName'])) {
                    $data['data']['custom_validation'].='NickName has already been used.';
                }

                if ($data['data']['custom_validation'] == '') {

                    $data['data']['gencode'] = $this->GetCodevalidate(6);

                    $data['insert'] = array(
                        'FullName' => $data['data']['Fullname'] = $this->input->post('FullName',true),
                        'Email' => $this->input->post('Email',true),
                        'NickName' => $this->input->post('NickName',true),
                        'Country' => $this->input->post('Country',true),
                        'City' => $this->input->post('City',true),
                        'PhoneNumber' => $this->input->post('PhoneNumber',true),
                        'SwapFree' => $this->input->post('swapfree',true),
                        'Code' => $data['data']['gencode']
                    );

                    $data['return_insert'] = $this->g_m->insertmy($table = "contestmoneyfall", $data['insert']);
                }

                if ($data['return_insert'] != false) {
                    $data['insert'] = array(
                        'Title' => 'Thank you for signing up!',
                        'FullName' => $this->input->post('FullName',true),
                        'Code' => $data['data']['gencode'],
                        'Email' => $this->input->post('Email',true)
                    );
                    Fx_mailer::MoneyFallRegistrationCode($data['insert']);
                    $data['data']['insertsuccess'] = true;
                }
            } else {
                $data['data']['custom_validation1'].='Please verify reCAPTCHA';
            }
        } else {
            
        }


        $data['data']['countries'] = $this->general_model->getCountries();
        unset($data['data']['countries']['KP'], $data['data']['countries']['US'], $data['data']['countries']['MM'], $data['data']['countries']['SD'], $data['data']['countries']['SY']);
        /* country list and code */
        $data['data']['countries'] = $this->general_model->selectOptionList($data['data']['countries'], $this->country_code);
        $data['data']['calling_code'] = $this->general_model->getCallingCode($this->country_code);
        /* country list and code coding close */
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'ForexMart Money Fall';

        $data['data']['Operations'] = IPLoc::Locale();
        $data['data']['PermitIP'] = IPLoc::IsPermittedIPDemoAccountContest();
        $js = $this->template->Js();
        $this->template->title("Money Fall Registration | ForexMart")
                ->append_metadata_css("
                ")
                ->append_metadata_js("
                      <script src='https://www.google.com/recaptcha/api.js'></script>
                      <script src='" . $js . "jquery.validate.js'></script>
                           <script src='" . $js . "pwstrength.js'></script>
                      <script type='text/javascript'>
                        $(document).ready(function(){
                            $('#tab0').addClass('active');
                              $('.registerlink').css('visibility','hidden');
                        });
                         $(document).on('change','#countrylist',function(){
                         var CName=$(this).val(); 
                         $.post('get-country-code',{CName:CName},function(view){ $('#PhoneNumber').val(view);});  
                         });
                      </script>
                ")
                ->set_layout('external/main')
                ->build('external_MoneyFallRegistration', $data['data']);
    }

    public function getCountryCode() {
        $CName = $this->input->post('CName',true);
        echo $Ccode = $this->general_model->getCallingCode($CName);
    }

    private function GetCodevalidate($length) {
        $loopcode = true;
        do {
            $key = '';
            $keys = array_merge(range(0, 9));

            for ($i = 0; $i < $length; $i++) {
                $key .= $keys[array_rand($keys)];
            }

            $loopcode = $this->g_m->showlike2($table = 'contestmoneyfall', $field = 'Code', $id = $key, $select = "Code");
        } while ($loopcode == true);


        return $key;
    }

    private function GetCode($length) {
        $key = '';
        $keys = array_merge(range(0, 9));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    public function Ratings() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        require_once APPPATH . '/helpers/recaptchalib_helper.php';
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $this->load->library('form_validation');

        $this->load->model('General_model');
        $this->g_m = $this->General_model;

        $this->form_validation->set_rules('FullName', 'FullName', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('NickName', 'NickName', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('City', 'City', 'trim|required|xss_clean');

        $this->form_validation->set_rules('PhoneNumber', 'PhoneNumber', 'trim|required|xss_clean');
        $this->form_validation->set_rules('swapfree', 'swapfree', 'trim|xss_clean');

        $data['data']['custom_validation_success'] = '';
        $data['data']['custom_validation'] = '';
        $data['data']['custom_validation1'] = '';

        $data['data']['uniquefields'] = $this->g_m->showsfields($table = 'contestmoneyfall', 'FullName,Email,NickName');

        $data['data']['uniqueNickName'] = array();

        $data['data']['insertsuccess'] = false;

        $data['return_insert'] = false;
        foreach ($data['data']['uniquefields'] as $key => $value) {

            array_push($data['data']['uniqueNickName'], $value['NickName']);
        }

        if ($this->form_validation->run()) {
            if ($_POST["g-recaptcha-response"]) {

                if (in_array($this->input->post('NickName',true), $data['data']['uniqueNickName'])) {
                    $data['data']['custom_validation'].='NickName has already been used.';
                }

                if ($data['data']['custom_validation'] == '') {

                    $data['data']['gencode'] = $this->GetCode(8);

                    $data['insert'] = array(
                        'FullName' => $this->input->post('FullName',true),
                        'Email' => $this->input->post('Email',true),
                        'NickName' => $this->input->post('NickName',true),
                        'Country' => $this->input->post('Country',true),
                        'City' => $this->input->post('City',true),
                        'PhoneNumber' => $this->input->post('PhoneNumber',true),
                        'SwapFree' => $this->input->post('swapfree',true),
                        'Code' => $data['data']['gencode']
                    );

                    $data['return_insert'] = $this->g_m->insertmy($table = "contestmoneyfall", $data['insert']);
                }

                if ($data['return_insert'] != false) {
                    $data['data']['insertsuccess'] = true;
                }
            } else {
                $data['data']['custom_validation1'].='Please verify reCAPTCHA';
            }
        } else {
            
        }

        $data['data']['countries'] = $this->g_m->getCountries();
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'ForexMart Money Fall';
        $js = $this->template->Js();
        $this->template->title("Money Fall - Ratings| ForexMart")
                ->append_metadata_js("
                         <script type='text/javascript'>
                                $(document).ready(function(){
                                     $('#PublicRatings a').addClass('active');
                                     $('#tab0').removeClass('active');
                                        $('#tab1').addClass('active');
                                     $('#tab2').removeClass('active');
                                     $('#tab3').removeClass('active');
                                 });
                         </script>
                    ")
                ->set_layout('external/main')
                ->build('external_MoneyFallRegistration', $data['data']);
    }

    public function Winners() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        require_once APPPATH . '/helpers/recaptchalib_helper.php';
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $this->load->library('form_validation');

        $this->load->model('General_model');
        $this->g_m = $this->General_model;

        $this->form_validation->set_rules('FullName', 'FullName', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('NickName', 'NickName', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('City', 'City', 'trim|required|xss_clean');

        $this->form_validation->set_rules('PhoneNumber', 'PhoneNumber', 'trim|required|xss_clean');
        $this->form_validation->set_rules('swapfree', 'swapfree', 'trim|xss_clean');

        $data['data']['custom_validation_success'] = '';
        $data['data']['custom_validation'] = '';

        $data['data']['uniquefields'] = $this->g_m->showsfields($table = 'contestmoneyfall', 'FullName,Email,NickName');
        $data['data']['uniqueFullName'] = array();
        $data['data']['uniqueEmail'] = array();
        $data['data']['uniqueNickName'] = array();

        $data['data']['insertsuccess'] = false;

        $data['return_insert'] = false;
        foreach ($data['data']['uniquefields'] as $key => $value) {
            array_push($data['data']['uniqueFullName'], $value['FullName']);
            array_push($data['data']['uniqueEmail'], $value['Email']);
            array_push($data['data']['uniqueNickName'], $value['NickName']);
        }

        if ($this->form_validation->run()) {
            if ($_POST["g-recaptcha-response"]) {

                if (in_array($this->input->post('FullName',true), $data['data']['uniqueFullName'])) {
                    $data['data']['custom_validation'].='Full Name has already been used.';
                }
                if (in_array($this->input->post('Email',true), $data['data']['uniqueEmail'])) {
                    $data['data']['custom_validation'].='Email has already been used.';
                }
                if (in_array($this->input->post('NickName',true), $data['data']['uniqueNickName'])) {
                    $data['data']['custom_validation'].='NickName has already been used.';
                }

                if ($data['data']['custom_validation'] == '') {

                    $data['data']['gencode'] = $this->GetCode(8);

                    $data['insert'] = array(
                        'FullName' => $this->input->post('FullName',true),
                        'Email' => $this->input->post('Email',true),
                        'NickName' => $this->input->post('NickName',true),
                        'Country' => $this->input->post('Country',true),
                        'City' => $this->input->post('City',true),
                        'PhoneNumber' => $this->input->post('PhoneNumber',true),
                        'SwapFree' => $this->input->post('swapfree',true),
                        'Code' => $data['data']['gencode']
                    );

                    $data['return_insert'] = $this->g_m->insertmy($table = "contestmoneyfall", $data['insert']);
                }

                if ($data['return_insert'] != false) {
                    $data['data']['insertsuccess'] = true;
                }
            } else {
                $data['data']['custom_validation'].='Please verify reCAPTCHA';
            }
        } else {
            
        }

        $data['data']['countries'] = $this->g_m->getCountries();
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'ForexMart Money Fall';

        $js = $this->template->Js();
        $this->template->title("Money Fall - Winners| ForexMart")
                ->append_metadata_js("
                          <script type='text/javascript'>
                            $(document).ready(function(){
                              $('#PublicWinners a').addClass('active');
                                 $('#tab0').removeClass('active');
                                 $('#tab1').removeClass('active');
                                    $('#tab2').addClass('active');
                                 $('#tab3').removeClass('active');
                             });
                         </script>
                    ")
                ->set_layout('external/main')
                ->build('external_MoneyFallRegistration', $data['data']);
    }

    public function ContestRules() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        require_once APPPATH . '/helpers/recaptchalib_helper.php';
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $this->load->library('form_validation');

        $this->load->model('General_model');
        $this->g_m = $this->General_model;

        $this->form_validation->set_rules('FullName', 'FullName', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('NickName', 'NickName', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('City', 'City', 'trim|required|xss_clean');

        $this->form_validation->set_rules('PhoneNumber', 'PhoneNumber', 'trim|required|xss_clean');
        $this->form_validation->set_rules('swapfree', 'swapfree', 'trim|xss_clean');

        $data['data']['custom_validation_success'] = '';
        $data['data']['custom_validation'] = '';

        $data['data']['uniquefields'] = $this->g_m->showsfields($table = 'contestmoneyfall', 'FullName,Email,NickName');
        $data['data']['uniqueFullName'] = array();
        $data['data']['uniqueEmail'] = array();
        $data['data']['uniqueNickName'] = array();

        $data['data']['insertsuccess'] = false;

        $data['return_insert'] = false;
        foreach ($data['data']['uniquefields'] as $key => $value) {
            array_push($data['data']['uniqueFullName'], $value['FullName']);
            array_push($data['data']['uniqueEmail'], $value['Email']);
            array_push($data['data']['uniqueNickName'], $value['NickName']);
        }

        if ($this->form_validation->run()) {
            if ($_POST["g-recaptcha-response"]) {

                if (in_array($this->input->post('FullName',true), $data['data']['uniqueFullName'])) {
                    $data['data']['custom_validation'].='Full Name has already been used.';
                }
                if (in_array($this->input->post('Email',true), $data['data']['uniqueEmail'])) {
                    $data['data']['custom_validation'].='Email has already been used.';
                }
                if (in_array($this->input->post('NickName',true), $data['data']['uniqueNickName'])) {
                    $data['data']['custom_validation'].='NickName has already been used.';
                }


                if ($data['data']['custom_validation'] == '') {

                    $data['data']['gencode'] = $this->GetCode(8);

                    $data['insert'] = array(
                        'FullName' => $this->input->post('FullName',true),
                        'Email' => $this->input->post('Email',true),
                        'NickName' => $this->input->post('NickName',true),
                        'Country' => $this->input->post('Country',true),
                        'City' => $this->input->post('City',true),
                        'PhoneNumber' => $this->input->post('PhoneNumber',true),
                        'SwapFree' => $this->input->post('swapfree',true),
                        'Code' => $data['data']['gencode']
                    );

                    $data['return_insert'] = $this->g_m->insertmy($table = "contestmoneyfall", $data['insert']);
                }

                if ($data['return_insert'] != false) {
                    $data['data']['insertsuccess'] = true;
                }
            } else {
                $data['data']['custom_validation'].='Please verify reCAPTCHA';
            }
        } else {
            
        }

        $data['data']['countries'] = $this->g_m->getCountries();
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'ForexMart Money Fall';
        $this->template->title("Money Fall - Contest Rules | ForexMart")
                ->append_metadata_js("
                          <script type='text/javascript'>
                            $(document).ready(function(){
                              $('#PublicContestRules a').addClass('active');
                                 $('#tab0').removeClass('active');
                                 $('#tab1').removeClass('active');
                                 $('#tab2').removeClass('active');
                                    $('#tab3').addClass('active');
                             });
                         </script>
                    ")
                ->set_layout('external/main')
                ->build('external_MoneyFallRegistration', $data['data']);
    }

    /** SUPPORT  */

    /** tab1 */
    public function contactus() {
die();
        $data['data']['metadata_description'] = 'ForexMart is more than pleased to assist you 24 hours a day, five days a week.';
        $data['data']['metadata_keyword'] = 'Contact Us | ForexMart';
        $this->template->title("Contact Us | ForexMart")
                ->append_metadata_js("
                <script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAguPkeZtNqEr53aAgxhoVx_J8bmgsDaZg'> </script>
                <script type='text/javascript'>
                 var myLatLng = {lat: 34.6960146, lng: 33.050042};
                  function initialize() {
                    var mapOptions = {
                      center: { lat: 34.6960146, lng: 33.050042},
                      zoom: 15
                    };
                    var map = new google.maps.Map(document.getElementById('map-canvas'),
                        mapOptions);
                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        title: 'Site Location!'
                   });
                  }
                  google.maps.event.addDomListener(window, 'load', initialize);
                 </script>

            ")
                ->set_layout('external/main')
                ->build('external_contactus', $data['data']);
    }

    public function faq() {
        die();
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $js = $this->template->Js();
        $data['data']['metadata_description'] = 'Know more about forex trading, as well as our products and services in this section.';
        $data['data']['metadata_keyword'] = 'FAQ | ForexMart';
        $this->template->title("FAQ | ForexMart")
                ->append_metadata_js("
                        <script src='" . $js . "/listfilter.min.js'></script>
                ")
                ->set_layout('external/main')
                ->build('external_faq', $data['data']);
    }

    public function glossary() {

//        $this->lang->load('Faq');
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $js = $this->template->Js();
        $data['data']['metadata_description'] = 'Know more about forex trading, as well as our products and services in this section.';
        $data['data']['metadata_keyword'] = 'Glossary | ForexMart';
        $this->template->title("Glossary | ForexMart")
                ->append_metadata_js("
                        <script src='" . $js . "/listfilter.min.js'></script>
                ")
                ->set_layout('external/main')
                ->build('external_glossary', $data['data']);
    }

    public function how_to_get_started() {

        // $this->lang->load('Faq');
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $js = $this->template->Js();
        $data['data']['metadata_description'] = 'Know more about forex trading, as well as our products and services in this section.';
        $data['data']['metadata_keyword'] = 'How to get started | ForexMart';
        $this->template->title("How to get started | ForexMart")
                    
                ->append_metadata_js("
                        <script src='" . $js . "/listfilter.min.js'></script>
                ")
                ->set_layout('external/main')
                ->build('external_get_started', $data['data']);
    }

    /** end external top navigation */

    /** start external footer navigation */
//    public function TermsandConditions() {
//
//        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
//        $data['data']['metadata_description'] = 'The Terms and Conditions lays out the framework of the Service Agreement and the nature of the investment services provided by the Company.';
//        $data['data']['metadata_keyword'] = 'Terms & Conditions | ForexMart';
//        $this->template->title("Terms & Conditions | ForexMart")
//                ->set_layout('external/main')
//                ->build('external_TermsandConditions', $data['data']);
//    }

    public function RiskDisclosure() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'The Risk Disclosure Notice, the Notice is provided to the Customer in accordance with Law 144 (I) of 2007 as amended.';
        $data['data']['metadata_keyword'] = 'Risk Disclosure | ForexMart';
        $this->template->title("Risk Disclosure | ForexMart")
                ->set_layout('external/main')
                ->build('external_RiskDisclosure', $data['data']);
    }

    public function PrivacyPolicy() {

        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = '';
        $this->template->title("Privacy Policy | ForexMart")
                ->set_layout('external/main')
                ->build('external_PrivacyPolicy', $data['data']);
    }

    public function Partners() {
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = '';
        $this->output->set_status_header('404');
        $data['content'] = 'error_404'; // View name
        $this->load->view('errors/html/error_404', $data);
    }

    public function TermsofUse() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'You signify your agreement with and understanding of the following Terms and Conditions relative to both this website and any material in it.';
        $data['data']['metadata_keyword'] = 'Website Terms of Use | ForexMart';
        $this->template->title("Website Terms of Use | ForexMart")
                ->set_layout('external/main')
                ->build('external_TermsofUse', $data['data']);
    }

    public function AMLPolicy() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'ForexMart collates and validates the personal information of all its clients, as well as monitor their transactions.';
        $data['data']['metadata_keyword'] = 'AML Policy | ForexMart';
        $this->template->title("AML Policy | ForexMart")
                ->set_layout('external/main')
                ->build('external_AMLPolicy', $data['data']);
    }

    public function BestExecutionPolicy() {

        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = 'The company sets up its Best Execution Policy and implement all measures to attain the best possible result for all its customers.';
        $data['data']['metadata_keyword'] = 'Best Execution Policy | ForexMart';
        $this->template->title("Best Execution Policy | ForexMart")
                ->set_layout('external/main')
                ->build('external_BestExecutionPolicy', $data['data']);
    }

    /**  remove task FXPP-887
      public function ComplaintHandlingProcedure(){

      $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
      $data['data']['metadata_description'] = 'The Complaint Handling Procedure outlines the processes when contending with complaints received by clients.';
      $data['data']['metadata_keyword'] = 'Complaint Handling Procedure | ForexMart';
      $this->template->title("Complaint Handling Procedure | ForexMart")

      ->set_layout('external/main')
      ->build('external_ComplaintHandlingProcedure',$data['data']);

      }

      public function CustomerCategorisation(){

      $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
      $data['data']['metadata_description'] = 'When opening a trading account, prospective clients are classified as retail client, professional clients, or eligible counterparty.';
      $data['data']['metadata_keyword'] = 'Customer Categorisation | ForexMart';
      $this->template->title("Customer Categorisation | ForexMart")

      ->set_layout('external/main')
      ->build('external_CustomerCategorisation',$data['data']);

      }

      public function InvestorCompensationFund(){
      $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
      $data['data']['metadata_description'] = 'The fund encompasses clients, as well investment and ancillary services offered by the company.';
      $data['data']['metadata_keyword'] = 'Investor Compensation Fund | ForexMart';
      $this->template->title("Investor Compensation Fund | ForexMart")
      ->set_layout('external/main')
      ->build('external_InvestorCompensationFund',$data['data']);

      }

      public function Services(){
      $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
      $data['data']['metadata_description'] = 'Under the CIF license, the company offers investment and ancillary services.';
      $data['data']['metadata_keyword'] = 'Services | ForexMart';
      $this->template->title("Services | ForexMart")

      ->set_layout('external/main')
      ->build('external_Services',$data['data']);
      }
     */

    /** end external footer navigation */
	
	
	
    public function FeedbackSendEmail() {
        $this->load->model('External_model');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('feed_email', 'Email', 'trim|valid_email|required');

        $data['return'] = false;
        $data['returnid'] = false;

        if ($this->form_validation->run()) {

            $data['update'] = array(
                'email' => $this->input->post('feed_email',true),
                'id' => $this->session->feedbackid
            );
            $data['returnid'] = $this->External_model->updateFeedbackemail($data['update']);
            $data['return'] = true;
        } else {
            $data['return'] = false;
        }

        if (validation_errors()) {
            $data['return'] = true;
        }

		
		    $data['return']="";
        if ($data['return']) {
            $data['call_modal'] = "
                    <script type='text/javascript'>
                        $(document).ready(function(){
                              $('#popfeedback').modal('show');
                                $('#FeedbackFormRating')
                                  .removeClass('formshow')
                                  .addClass('formhide');

                              $('#FeedbackFormSuccess')
                                   .removeClass('formhide')
                                  .addClass('formshow');

                               $('.modalfeedbackcontent')
                                    .removeClass('setsuccessheight');
                               $('#FeedbackFormDone')
                                  .removeClass('formshow')
                                  .addClass('formhide');
                        });
                    </script>
                ";

            if ($data['returnid'] != false) {
                $data['call_modal'].="
                    <script type='text/javascript'>
                        $(document).ready(function(){
                               $('#FeedbackFormRating')
                                  .removeClass('formshow')
                                  .addClass('formhide');
                               $('#FeedbackFormSuccess')
                                   .removeClass('formshow')
                                  .addClass('formhide');
                              $('.modalfeedbackcontent')
                                    .addClass('setsuccessheight');
                               $('#FeedbackFormDone')
                                 .removeClass('formhide')
                                    .addClass('formshow');
                               $('.modalfeedbackcontent').removeClass('setsuccessheight');
                        });
                    </script>
                ";
            }
        } else {
            $data['call_modal'] = "";
        }


        $data['data'] = '';
        $this->template->title("Feedback| ForexMart")
                ->append_metadata_js($data['call_modal'])
                ->set_layout('external/main')
                ->build('home');
    }

	
	
	
	
	
	
	
	
	
	
	
    public function Feedback() {

        $this->load->model('External_model');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('rate', 'Rating', 'required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('textarea', 'Comment', 'trim|alpha_numeric');
        $data['return'] = false;
        $data['returnid'] = false;

        if ($this->form_validation->run()) {

            if (isset($_POST['feedback'])) {
                $data['insert'] = array(
                    'user_id' => ($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0,
                    'rating' => $this->input->post('rate',true),
                    'category' => $this->input->post('category',true),
                    'message' => $this->input->post('textarea',true)
                );

                $data['returnid'] = $this->External_model->insertFeedback($data['insert']);

                if ($data['returnid'] != false) {
                    $this->session->set_userdata(array('feedbackid' => $data['returnid']));
                }

                $data['return'] = true;
            }
        } else {

            $data['return'] = false;
            $this->session->unset_userdata('feedbackid');
        }


        if (validation_errors()) {
            $data['return'] = true;
        }

        if ($data['return']) {
            $data['call_modal'] = "
                    <script type='text/javascript'>
                        $(document).ready(function(){
                           $('#popfeedback').modal('show');

                        });
                    </script>
                ";

            if ($data['returnid'] != false) {
                $data['call_modal'].="
                    <script type='text/javascript'>
                        $(document).ready(function(){
                                $('#FeedbackFormRating')
                                  .removeClass('formshow')
                                  .addClass('formhide');
                               $('#FeedbackFormSuccess')
                                    .removeClass('formhide')
                                    .addClass('formshow');
                              $('.modalfeedbackcontent').addClass('setsuccessheight');
                        });
                    </script>
                ";
            }
        } else {
            $data['call_modal'] = "";
        }


        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = '';
        $this->template->title("Feedback| ForexMart")
                ->append_metadata_js($data['call_modal'])
                ->set_layout('external/main')
                ->build('home');
    }

    public function LegalDocumentation() {
 
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = ' ForexMart';
        $this->template->title("Legal Documentation | ForexMart")
                ->append_metadata_js("
                ")
                ->set_layout('external/main')
                ->build('external_LegalDocumentation', $data['data']);
    }

    public function testCall()
    {
        
            echo "sdfs";exit;
        
    }
    
    public function callingCode()
    {
        if (!$this->input->is_ajax_request()) {
            die('Not authorized!');
        }
         $code=$this->input->post('c_code',true);
         echo $this->general_model->getCallingCode($code);
        
    }


    public function callBack() {
 
        
        $this->load->library('tank_auth');
        $this->load->library('IPLoc');
        $this->lang->load('tank_auth');
        $captcha_registration = TRUE;
        $use_recaptcha = TRUE;


        if ($captcha_registration) {
            if ($use_recaptcha) {
                $this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
            } else {
                $this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
            }
        }

        $this->form_validation->set_rules('name', 'Full Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
//        $this->form_validation->set_rules('account_number', 'Account number', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('comments', 'Comments', 'trim|required|xss_clean');

        if ($this->form_validation->run()) {


            $mdata = array(
                'name' => $this->input->post('name',true),
                'email' => $this->input->post('email',true),
                'account_number' => $this->input->post('account_number',true),
                'country' => $this->input->post('country',true),
                'phone' => $this->input->post('phone',true),
                'time' => $this->input->post('time',true),
                'language' => $this->input->post('language',true),
                'subject' => $this->input->post('subject',true),
                'comments' => $this->input->post('comments',true)
            );
            $email_store = array( 
                'email' => $this->input->post('email',true),
                'country' => $this->input->post('country',true),
                'phone' => $this->input->post('phone',true)
            );

            $this->general_model->insert('call_back', $mdata);
            $this->session->set_flashdata('msg', 'Data Send Successful');
             $this->session->set_userdata(array('clk' =>1));
            
            $email=$this->input->post('email',true);
           $checkVal=$this->general_model->chechkId('email_store','email',$email);
           if($checkVal=="" or $checkVal==false) {$this->general_model->insert('email_store',$email_store);}
                         
            $country_code= $mdata['country'];
            unset($mdata['country']);
            $array_country=$this->general_model->getCountries();
            $mdata['country']=$array_country[$country_code];
            $mdata['title']='Client Information .';
           //support@forexmart.com
            $config = array('mailtype' => 'html');
          $this->general_model->sendEmail('call-back-html', "ForexMart Callback", 'support@forexmart.com', $mdata, $config);
          
      
            
        }


        if ($captcha_registration) {
            if ($use_recaptcha) {
                $data['recaptcha_html'] = $this->_create_recaptcha();
            } else {
                $data['captcha_html'] = $this->_create_captcha();
            }
        }
 

        $data['country'] = $this->general_model->getCallingCode($this->country_code);
        $ck=$this->session->userdata('clk');
        $data['pld']=0;
        if($ck!=1){$c_code=set_value('country')?set_value('country'):$this->country_code;$data['pld']=1;}else{$c_code=$this->country_code;}
        
        $data['countries'] = $this->general_model->selectOptionList($this->general_model->getCountries(), $c_code);
        $data['metadata_description'] = 'ForexMart is strongly committed to being your dependable forex trading partner.';
        $data['metadata_keyword'] = '"Call Back | ForexMart';


        $this->template->title("Call Back | ForexMart")
                ->set_layout('external/main')
                ->build('external_callback', $data);
    }

    /**
     * Create CAPTCHA image to verify user as a human
     *
     * @return	string
     */
    function _create_captcha() {
        $this->load->helper('captcha');

        $cap = create_captcha(array(
            'img_path' => './' . $this->config->item('captcha_path', 'tank_auth'),
            'img_url' => base_url() . $this->config->item('captcha_path', 'tank_auth'),
            'font_path' => './' . $this->config->item('captcha_fonts_path', 'tank_auth'),
            'font_size' => $this->config->item('captcha_font_size', 'tank_auth'),
            'img_width' => $this->config->item('captcha_width', 'tank_auth'),
            'img_height' => $this->config->item('captcha_height', 'tank_auth'),
            'show_grid' => $this->config->item('captcha_grid', 'tank_auth'),
            'expiration' => $this->config->item('captcha_expire', 'tank_auth'),
        ));

        // Save captcha params in session
        $this->session->set_flashdata(array(
            'captcha_word' => $cap['word'],
            'captcha_time' => $cap['time'],
        ));

        return $cap['image'];
    }

    /**
     * Callback function. Check if CAPTCHA test is passed.
     *
     * @param	string
     * @return	bool
     */
    function _check_captcha($code) {
        $time = $this->session->flashdata('captcha_time');
        $word = $this->session->flashdata('captcha_word');

        list($usec, $sec) = explode(" ", microtime());
        $now = ((float) $usec + (float) $sec);

        if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
            $this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
            return FALSE;
        } elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
                $code != $word) OR
                strtolower($code) != strtolower($word)) {
            $this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Create reCAPTCHA JS and non-JS HTML to verify user as a human
     *
     * @return	string
     */
    function _create_recaptcha() {
        $this->load->helper('recaptcha');

        // Add custom theme so we can get only image
        $options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

        // Get reCAPTCHA JS and non-JS HTML
        $html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'), '', true);

        return $options . $html;
    }

    /**
     * Callback function. Check if reCAPTCHA test is passed.
     *
     * @return	bool
     */
    function _check_recaptcha() {
        $this->load->helper('recaptcha');

        $resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'), $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);

        if (!$resp->is_valid) {
            $this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
            return FALSE;
        }
        return TRUE;
    }

    public function AccountVerification() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'Account Verification ForexMart';
        $this->template->title("Account Verification | ForexMart")
                ->append_metadata_js("
                ")
                ->set_layout('external/main')
                ->build('external_AccountVerification', $data['data']);
    }

    public function PartnershipAgreement() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = '';
        $data['data']['metadata_keyword'] = 'ForexMart Partnership Agreements';
        $this->template->title("Partnership Agreements | ForexMart")
                ->append_metadata_js("
                ")
                ->set_layout('external/main')
                ->build('external_PartnershipAgreement', $data['data']);
    }

    public function account_type() {
        $data['data']['metadata_keyword'] = 'Forex Account';
        $this->template->title("Account Type | ForexMart")
                ->append_metadata_js("
                ")
                ->set_layout('external/main')
                ->build('account_type');
    }

    public function las_palmas() {
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $this->template->title("Las Palmas | ForexMart")
                ->append_metadata_css('<link rel="stylesheet" href="' . $this->template->Css() . 'lightslider.css">')
                ->append_metadata_js('<script src="' . $this->template->Js() . 'lightslider.js" type="text/javascript"></script>')
                ->set_layout('external/main')
                ->build('las_palmas', $data['data']);
    }

//    public function currency_conversion() {
//        error_reporting(-1);
//        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
//
//        $data['data']['countries'] = $this->general_model->getCurrencyV2();
//
//        unset($data['data']['countries']['GGP']);
//        unset($data['data']['countries']['TRL']);
//        unset($data['data']['countries']['ANG']);
//        unset($data['data']['countries']['MZN']);
//        unset($data['data']['countries']['JEP']);
//        unset($data['data']['countries']['IMP']);
//        unset($data['data']['countries']['GHC']);
//        unset($data['data']['countries']['EEK']);
//        unset($data['data']['countries']['XCD']);
//        unset($data['data']['countries']['TVD']);
//        unset($data['data']['countries']['VEF']);
//
//        $this->template->title("Currency Conversion | ForexMart")
//                ->append_metadata_css('
//                 <link rel="stylesheet" href="' . $this->template->Css() . 'loaders.css">
//                 <link rel="stylesheet" href="' . $this->template->Css() . 'select2-bootstrap.css">
//                 <link rel="stylesheet" href="' . $this->template->Css() . 'select2.css">
//                 <link rel="stylesheet" href="' . $this->template->Css() . 'bootstrap-datetimepicker.css">
//                  <link rel="stylesheet" href="' . $this->template->Css() . 'dataTables.bootstrap.css">
//                 ')
//                ->append_metadata_js('
//                <script src="' . $this->template->Js() . 'jquery.dataTables.js"></script>
//                <script src="' . $this->template->Js() . 'dataTables.bootstrap.js"></script>
//                <script src="' . $this->template->Js() . 'select2.js" type="text/javascript"></script>
//                <script src="' . $this->template->Js() . 'Moment.js" type="text/javascript"></script>
//                <script src="' . $this->template->Js() . 'bootstrap-datetimepicker.min.js" ></script>
//                <script src="' . $this->template->Js() . 'canvasjs.min.js" ></script>
//            ')
//                ->set_layout('external/main')
//                ->build('external_CurrencyConversion', $data['data']);
//    }

    public function apiquotes() {
        if (!$this->input->is_ajax_request()) {
            die('Not authorized!');
        }

        $data['data']['custom_validation'] = '';
        $data['convert']['handle'] = fopen('https://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=' . $this->input->post('from',true) . $this->input->post('to',true) . '=X', 'r');

        if ($data['convert']['handle']) {
            $data['convert']['result'] = fgets($data['convert']['handle'], 4096);
            fclose($data['convert']['handle']);
        }

        $data['convert']['all_data'] = explode(',', $data['convert']['result']);

        if ($data['convert']['all_data'][1] != 0.00) {
            $data['data']['value'] = $data['convert']['all_data'][1];
        } else {
            $data['data']['value'] = false;
        }

        echo json_encode($data['data']);
    }

    public function apiquotes2() {
        ini_set('max_execution_time', 300);
        if (!$this->input->is_ajax_request()) {
            die('Not authorized!');
        }
        $contents = '';

        $date = str_replace("/", "", $this->input->post('date',true));
        $handle = fopen('https://finance.yahoo.com/connection/currency-converter-cache?date=' . $date . '', 'r');
        //YYYYMMDD
        while (!feof($handle)) {
            $contents .= fread($handle, 8192);
        }
        fclose($handle);

        $contents = str_replace('/**/YAHOO.Finance.CurrencyConverter.addConversionRates(', '', $contents);
        $contents = str_replace(');', '', $contents);
        $obj = json_decode($contents, true);

        $from = $this->input->post('from',true);

        $count = 0;
        if ($from == 'USD') {
            $fromprice = 1;
            $count = $count + 1;
        }

        $to = $this->input->post('to',true);

        if ($to == 'USD') {
            $toprice = 1;
            $count = $count + 1;
        }

        foreach ($obj['list']['resources'] as $key0 => $value0) {
            $data['data']['date2'] = $value0['resource']['fields']['date'];
            if ($from != 'USD') {
                if ($from . '=X' == $value0['resource']['fields']['symbol']) {
                    $fromprice = $value0['resource']['fields']['price'];
                    $data['data'][$from] = $value0['resource']['fields']['price'];
                    $count = $count + 1;
                }
            }
            if ($to != 'USD') {
                if ($to . '=X' == $value0['resource']['fields']['symbol']) {
                    $toprice = $value0['resource']['fields']['price'];
                    $data['data'][$to] = $value0['resource']['fields']['price'];

                    $count = $count + 1;
                }
            }
            if ($count == 2) {
                $data['data']['date'] = $value0['resource']['fields']['utctime'];
                break;
            }
        }

        $data['data']['value'] = $toprice * (1 / $fromprice);
        list($chart, $AveOpen, $AveHigh, $AveLow, $AveClose, $MaxHigh, $MinHigh, $MaxLow, $MinLow, $LastDate, $table, $aveclosehigh, $avecloselow) = $this->historicalxch($from_cur = $from, $to_cur = $to, $to_date = $this->input->post('date',true));

        $data['data']['chart'] = $chart;
        $data['data']['Open'] = $AveOpen;
        $data['data']['High'] = $AveHigh;
        $data['data']['Low'] = $AveLow;

        $data['data']['Close'] = $AveClose;
        $data['data']['AverageCloseHigh'] = $aveclosehigh;
        $data['data']['AverageCloseLow'] = $avecloselow;

        $data['data']['MaxHigh'] = $MaxHigh;
        $data['data']['MinHigh'] = $MinHigh;
        $data['data']['MaxLow'] = $MaxLow;
        $data['data']['MinLow'] = $MinLow;
        $data['data']['LastDate'] = $LastDate;
        $data['data']['table'] = $table;


        echo json_encode($data['data']);

        exit;
    }

    private function historicalxch($from_cur = '', $to_cur = '', $to_date = '') {
        $data['table'] = '';
        $data['TotalOpen'] = '';
        $data['TotalHigh'] = '';
        $data['TotalLow'] = '';
        $data['TotalClose'] = '';

        $end = DateTime::createFromFormat('Y/d/m', $to_date);

        $now = new DateTime();

        $to_dateDay = DateTime::createFromFormat('Y/d/m', $to_date);

        if ($now->format('Y-m-d') == $to_dateDay->format('Y-m-d')) { // current date is equal to post date use exchange yesterday because today exchange is not yet available
            $end->sub(new DateInterval('P1D'));
        }

        if ($to_dateDay->format('D') == 'Sat') {   // no exhange rate in saturday use friday
            $end->sub(new DateInterval('P1D'));
        } else if ($to_dateDay->format('D') == 'Sun') { // no exhange rate in sunday use friday
            $end->sub(new DateInterval('P2D'));
        }

        $begin = new DateTime($end->format("Y-m-d"));
        $begin->sub(new DateInterval('P90D'));

        $cur1 = $from_cur;
        $cur2 = $to_cur;

        $handle = '';
        $contents = '';

        if ($cur1 != 'USD') {
            $handle = fopen('https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20%3D%20%22' . $cur1 . '%3DX%22%20and%20startDate%20%3D%20%22' . $begin->format("Y-m-d") . '%22%20and%20endDate%20%3D%20%22' . $end->format("Y-m-d") . '%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=', 'r');

            while (!feof($handle)) {
                $contents .= fread($handle, 8192);
            }

            fclose($handle);

            $obj0 = json_decode($contents, true);
            $cur1_history = $obj0['query']['results']['quote'];
            $cur1_history = array_reverse($cur1_history, true);
        }

        $handle = '';
        $contents = '';
        if ($cur2 != 'USD') {

            $handle = fopen('https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20%3D%20%22' . $cur2 . '%3DX%22%20and%20startDate%20%3D%20%22' . $begin->format("Y-m-d") . '%22%20and%20endDate%20%3D%20%22' . $end->format("Y-m-d") . '%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=', 'r');

            while (!feof($handle)) {
                $contents .= fread($handle, 8192);
            }

            fclose($handle);


            $obj1 = json_decode($contents, true);
            $cur2_history = $obj1['query']['results']['quote'];
            $cur2_history = array_reverse($cur2_history, true);
        }


        $ctr = 0;

        $data_points = array();
        if ($cur1 != 'USD' and $cur2 != 'USD') {
            foreach ($cur2_history as $k => $v) {


                $point = array('x' => $v['Date'], 'y' => (1 / $cur1_history[$ctr]['Close']) * $v['Close']);

                array_push($data_points, $point);
                $data['TotalOpen'] = $data['TotalOpen'] + (1 / $cur1_history[$ctr]['Open']) * $v['Open'];
                $data['TotalHigh'] = $data['TotalHigh'] + (1 / $cur1_history[$ctr]['High']) * $v['High'];
                $data['TotalLow'] = $data['TotalLow'] + (1 / $cur1_history[$ctr]['Low']) * $v['Low'];
                $data['TotalClose'] = $data['TotalClose'] + (1 / $cur1_history[$ctr]['Close']) * $v['Close'];

                $data['ArrayHigh'][$k] = (1 / $cur1_history[$ctr]['High']) * $v['High'];
                $data['ArrayLow'][$k] = (1 / $cur1_history[$ctr]['Low']) * $v['Low'];
                $data['ArrayClose'][$k] = (1 / $cur1_history[$ctr]['Close']) * $v['Close'];
                $data['table'].='<tr>';
                $data['table'].='<td>' . $v['Date'] . '</td>';
                $data['table'].='<td>' . (1 / $cur1_history[$ctr]['Close']) * $v['Close'] . '</td>';
                $data['table'].='</tr>';

                $ctr = $ctr + 1;
            }
        } else if ($cur1 == 'USD') {
            foreach ($cur2_history as $k => $v) {

                $point = array('x' => $v['Date'], 'y' => (1 / 1) * $v['Close']);
                array_push($data_points, $point);
                $data['TotalOpen'] = $data['TotalOpen'] + (1 / 1) * $v['Open'];
                $data['TotalHigh'] = $data['TotalHigh'] + (1 / 1) * $v['High'];
                $data['TotalLow'] = $data['TotalLow'] + (1 / 1) * $v['Low'];
                $data['TotalClose'] = $data['TotalClose'] + (1 / 1) * $v['Close'];

                $data['ArrayHigh'][$k] = (1 / 1) * $v['High'];
                $data['ArrayLow'][$k] = (1 / 1) * $v['Low'];
                $data['ArrayClose'][$k] = (1 / 1) * $v['Close'];
                $data['table'].='<tr>';
                $data['table'].='<td>' . $v['Date'] . '</td>';
                $data['table'].='<td>' . (1 / 1) * $v['Close'] . '</td>';
                $data['table'].='</tr>';
                $ctr = $ctr + 1;
            }
        } else {
            foreach ($cur1_history as $k => $v) {

                $point = array('x' => $v['Date'], 'y' => (1 / $v['Close']) * 1);
                array_push($data_points, $point);
                $data['TotalOpen'] = $data['TotalOpen'] + (1 / $cur1_history[$ctr]['Open']) * $v['Open'];
                $data['TotalHigh'] = $data['TotalHigh'] + (1 / $cur1_history[$ctr]['High']) * $v['High'];
                $data['TotalLow'] = $data['TotalLow'] + (1 / $cur1_history[$ctr]['Low']) * $v['Low'];
                $data['TotalClose'] = $data['TotalClose'] + (1 / $cur1_history[$ctr]['Close']) * $v['Close'];

                $data['ArrayHigh'][$k] = (1 / $cur1_history[$ctr]['High']) * $v['High'];
                $data['ArrayLow'][$k] = (1 / $cur1_history[$ctr]['Low']) * $v['Low'];
                $data['ArrayClose'][$k] = (1 / $cur1_history[$ctr]['Close']) * $v['Close'];

                $data['table'].='<tr>';
                $data['table'].='<td>' . $v['Date'] . '</td>';
                $data['table'].='<td>' . (1 / $v['Close']) * 1 . '</td>';
                $data['table'].='</tr>';
                $ctr = $ctr + 1;
            }
        }
        if ($cur1 == 'USD') {
            $data['count'] = count($cur2_history);
        } else {
            $data['count'] = count($cur1_history);
        }

        foreach ($data_points as $k => $v) {
            
        }

        $data['AveOpen'] = $data['TotalOpen'] / $data['count'];
        $data['AveHigh'] = $data['TotalHigh'] / $data['count'];
        $data['AveLow'] = $data['TotalLow'] / $data['count'];

        $data['AveClose'] = $data['TotalClose'] / $data['count'];

        $data['AveCloseHigh'] = max($data['ArrayClose']);
        $data['AveCloseLow'] = min($data['ArrayClose']);

        $data['MaxHigh'] = max($data['ArrayHigh']);
        $data['MinHigh'] = min($data['ArrayHigh']);

        $data['MaxLow'] = max($data['ArrayLow']);
        $data['MinLow'] = min($data['ArrayLow']);

        $data['LastDate'] = $end->format("D, M d, Y");

        return array(json_encode($data_points, JSON_NUMERIC_CHECK), $data['AveOpen'], $data['AveHigh'], $data['AveLow'], $data['AveClose'], $data['MaxHigh'], $data['MinHigh'], $data['MaxLow'], $data['MinLow'], $data['LastDate'], $data['table'], $data['AveCloseHigh'], $data['AveCloseLow']);
    }

    public function calculator() {

        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);

        $data['data']['CurrencyPair'] = $this->general_model->getCurrenciesPairFI();
        $data['data']['Leverage'] = $this->general_model->getFCLeverage();
        $data['data']['Volume'] = $this->general_model->getFCVolume();
        $data['data']['Currency'] = $this->general_model->getAccountCurrencyBase3();
        $data['data']['metadata_keyword'] = 'Forex calculator';
        $this->template->title("Forex Calculator | ForexMart")
                ->append_metadata_css('
                 <link rel="stylesheet" href="' . $this->template->Css() . 'loaders.css">
                 <link rel="stylesheet" href="' . $this->template->Css() . 'select2-bootstrap.css">
                 <link rel="stylesheet" href="' . $this->template->Css() . 'select2.css">
                 ')
                ->append_metadata_js('
                <script src="' . $this->template->Js() . 'select2.js" type="text/javascript"></script>
            ')
                ->set_layout('external/main')
                ->build('external_ForexCalculator', $data['data']);
    }

    public function API_CurrencyPairSpotCFD()
     {
        // used in method forex_calculator
        if (!$this->input->is_ajax_request()) {
            die('Not authorized!');
        }

        $data['data']['custom_validation'] = '';

        if ($this->input->post('cur1',true)[0] == '#') {

            //Computations for CFD

            $data['data']['isCFD'] = true;

            $data['FilteredCFD'] = ltrim($this->input->post('cur1',true), '#');

            // get CFD value
            $data['convert']['handle'] = fopen('http://finance.yahoo.com/d/quotes.csv?s=' . $data['FilteredCFD'] . '&f=sb2b3jk', 'r');

            if ($data['convert']['handle']) {
                $data['convert']['result'] = fgets($data['convert']['handle'], 4096);
                fclose($data['convert']['handle']);
            }

            $pieces = explode(",", $data['convert']['result']);

            $data['cfd'] = floatval($pieces[4]);
            // get USD  currency to currency 3
            $data['convert']['handle2'] = fopen('https://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=USD' . $this->input->post('cur3',true) . '=X', 'r');
            if ($data['convert']['handle2']) {
                $data['convert']['result2'] = fgets($data['convert']['handle2'], 4096);
                fclose($data['convert']['handle2']);
            }
            $data['convert']['all_data2'] = explode(',', $data['convert']['result2']);
            if ($data['convert']['all_data2'][1] != 0.00) {
                $data['data']['CF23'] = floatval($data['convert']['all_data2'][1]);
            }

            $data['data']['CurrentQuote'] = $data['cfd'];
            $data['data']['PIPValue'] = 0.1 * 0.0001 * 100000 * $data['data']['CF23'];
            $data['data']['Margin'] = ($data['data']['PIPValue'] * 0.1 * 100000 * $data['cfd'] * 0.1) / $this->input->post('leverage',true);
        } else {

            //Computations for Currency Pair and Metals

            $data['data']['isCFD'] = false;

            if ($this->input->post('cur1') == 'USD' AND $this->input->post('cur2',true) == 'JPY') {
                $data['USDJYPADJ'] = 100;
            } else {
                $data['USDJYPADJ'] = 1;
            }

            if ($this->input->post('cur1',true) == "XXAU") {
                $data['NewCur1'] = 'XAU';
            } else {
                $data['NewCur1'] = $this->input->post('cur1',true);
            }


            $cur2 = $this->input->post('cur2',true);
            if ($this->input->post('cur2name',true) == "RUR") {
                $cur2 = 'RUR';
            }


            $data['convert']['handle'] = fopen('https://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=' . $cur2 . $this->input->post('cur3',true) . '=X', 'r');

            if ($data['convert']['handle']) {
                $data['convert']['result'] = fgets($data['convert']['handle'], 4096);
                fclose($data['convert']['handle']);
            }

            $data['convert']['all_data'] = explode(',', $data['convert']['result']);

            if ($data['convert']['all_data'][1] != 0.00) {
                if ($this->input->post('cur2name',true) == 'RUR') {
                    $data['data'][$cur2 . $this->input->post('cur3',true)] = floatval($data['convert']['all_data'][1] * 1000);
                    $data['data']['CF23'] = floatval($data['convert']['all_data'][1] * 1000);
                } else {
                    $data['data'][$cur2 . $this->input->post('cur3',true)] = floatval($data['convert']['all_data'][1]);
                    $data['data']['CF23'] = floatval($data['convert']['all_data'][1]);
                }
            }

            $data['convert']['handle1'] = fopen('https://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=' . $data['NewCur1'] . $cur2 . '=X', 'r');

            if ($data['convert']['handle1']) {
                $data['convert']['result1'] = fgets($data['convert']['handle1'], 4096);
                fclose($data['convert']['handle1']);
            }

            $data['convert']['all_data1'] = explode(',', $data['convert']['result1']);

            if ($data['convert']['all_data1'][1] != 0.00) {

                if ($this->input->post('cur2name',true) == 'RUR') {
                    $data['data']['CF12'] = floatval(($data['convert']['all_data1'][1]) / 1000);
                    $data['data'][$data['NewCur1'] . $cur2] = floatval(($data['convert']['all_data1'][1]) / 1000);
                } else {
                    $data['data'][$data['NewCur1'] . $cur2] = floatval($data['convert']['all_data1'][1]);
                    $data['data']['CF12'] = floatval($data['convert']['all_data1'][1]);
                }
            }

            $data['convert']['handle2'] = fopen('https://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=' . $data['NewCur1'] . $this->input->post('cur3',true) . '=X', 'r');

            if ($data['convert']['handle2']) {
                $data['convert']['result2'] = fgets($data['convert']['handle2'], 4096);
                fclose($data['convert']['handle2']);
            }

            $data['convert']['all_data2'] = explode(',', $data['convert']['result2']);

            if ($data['convert']['all_data2'][1] != 0.00) {

                $data['data'][$data['NewCur1'] . $this->input->post('cur3',true)] = floatval($data['convert']['all_data2'][1]);
                $data['data']['CF13'] = floatval($data['convert']['all_data2'][1]);
            }

            if ($data['convert']['all_data'][1] != 0.00 AND $data['convert']['all_data1'][1] != 0.00 AND $data['convert']['all_data2'][1] != 0.00) {

                $SpotMetals = array("SILVER", "GOLD", "XAU");


                $data['data']['value'] = $data['data']['CF23'];

                $data['data']['CurrentQuote'] = floatval(($data['data'][$data['NewCur1'] . $cur2]));


                if (in_array($this->input->post('cur1name',true), $SpotMetals)) {

                    if ($this->input->post('cur1name',true) == "XAU") {

                        $data['data']['PIPValue'] = ($data['data']['value']) * $this->input->post('volume',true) * 100000 * (.0001) * 5;
                        $data['data']['Margin'] = ((0.0001 * $this->input->post('volume',true) * 100000) * $data['data'][$data['NewCur1'] . $this->input->post('cur3',true)]) * 5;
                    } elseif ($this->input->post('cur1name',true) == "SILVER") {

                        $data['data']['PIPValue'] = (($data['data']['value']) * $this->input->post('volume',true) * 100000 * (.0001)) / 2;
                        $data['data']['Margin'] = ((0.0001 * $this->input->post('volume',true) * 100000) * $data['data'][$data['NewCur1'] . $this->input->post('cur3',true)]) / 2;
                    } else {

                        $data['data']['PIPValue'] = $data['USDJYPADJ'] * ($data['data']['value']) * $this->input->post('volume',true) * 100000 * (.0001);
                        $data['data']['Margin'] = ((0.0001 * $this->input->post('volume',true) * 100000) * $data['data'][$data['NewCur1'] . $this->input->post('cur3',true)]);
                    }
                } else {

                    if ($this->input->post('cur2name',true) == 'RUR' or $this->input->post('cur2name',true) == 'RUR') {

                        $data['data']['PIPValue'] = (($data['data']['value']) * $this->input->post('volume',true) * 100000 * (.0001) * 10);
                    } else {
                        $data['data']['PIPValue'] = $data['USDJYPADJ'] * ($data['data']['value']) * $this->input->post('volume',true) * 100000 * (.0001);
                    }
                    $data['data']['Margin'] = (($this->input->post('volume',true) * 100000) / $this->input->post('leverage',true)) * $data['data'][$data['NewCur1'] . $this->input->post('cur3',true)];
                }
            } else {
                $data['data']['value'] = false;
            }
        }
        echo json_encode($data['data']);


    }

    public function rt() {
        echo 'Current PHP version: ' . phpversion();
    }

    public function ForexGlossary() {
        /*if (!IPLoc::WhitelistPIPCandCC()) {
            redirect('');
        }*/
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $this->template->title("Forex Glossary | ForexMart")
                ->append_metadata_js("
                          <script type='text/javascript'>
                            window.alert = function() {};
                          </script>
                          <script src='" . $this->template->Js() . "jquery.dataTables.js'></script>
                          <script src='" . $this->template->Js() . "Moment.js'></script>
                          <script src='" . $this->template->Js() . "datetime-moment.js'></script>
                          <script src='" . $this->template->Js() . "dataTables.bootstrap.js'></script>


                    ")
                ->append_metadata_css('
                         <link rel="stylesheet" href="' . $this->template->Css() . 'dataTables.bootstrap.css">

                 ')
                ->set_layout('external/main')
                ->build('external_ForexGlossary', $data['data']);
    }
    public function aj() {
        $data['data']['home']='home';
        echo json_encode($data['data']);
    }

    public function ceo(){
//        redirect(FXPP::loc_url());
        $this->lang->load('ceo');
        $this->template->title("CEO Letter | ForexMart")
            ->append_metadata_css('
                         <link rel="stylesheet" href="' . $this->template->Css() . 'letter.css">
                 ')
            ->set_layout('external/main')
            ->build('ceo');
    }
    public function vip_winner() {

        if(!IPLoc::Office()){
            redirect('/');
        }

         $data['data'] = '';
         error_reporting(E_ALL);
        $this->lang->load('vipwinner');
        $this->template->title("VIP Winner | ForexMart")
        ->append_metadata_css('
                         <link rel="stylesheet" href="' . $this->template->Css() . 'vipwinner.css">
                 ')
                ->set_layout('external/main')
                ->build('external_vipWinner', $data['data']);
    }
   
    
    public function ticketRaffleVip() {
        if($this->input->is_ajax_request()) {

            $userId="";
            $ticId=$this->input->post('ticId');
            if(strpos($ticId,'@') !== false) {


                $whereData=array('email'=>$ticId,'accountstatus'=>1,'administration'=>0);
                $cdata=$this->general_model->getQueryStringRow('users','*',$whereData);
            //    echo $this->db->last_query();exit;
              $userId= ($cdata->id)?$cdata->id:"";
            }
            else
            {

                $whereData=array('account_number'=>$ticId);
                 $cdata=$this->general_model->getQueryStringRow('mt_accounts_set','*',$whereData);
                $userId= ($cdata->user_id)?$cdata->user_id:"";
            }

            if($userId!="")
            {
                $data=array(
                    'user_id'=>$userId,
                );
                $rsult=$this->general_model->getQueryStringRow('ticket_raffle','*',$data);
                if(empty($rsult))
                {

                    $this->general_model->insert('ticket_raffle',$data);
                    $wher=array('usa.id'=>$userId);
                    $join=array(
                        'user_profiles usp___left'=>"usa.id=usp.user_id ",
                    );
                   $getData['info']=$this->general_model->getQueryStirngRowJoin('users usa','usa.*,usp.full_name,usp.country',$wher,"","",$join);

                     $config = array(
                            'mailtype'=> 'html'
                        );
                    $subject="Congratulations! You have successfully registered to ForexMart's VIP Ticket Raffle!";

                      $this->general_model->sendEmailFiled('vipTicketRaffle', $subject, $getData['info']->email, $getData,$config);

                     echo"frz102";
                }
                else
                {
                    echo "frz101";
                }
            }
            else
            {
                echo "frz";
            }
        }else{die('Not authorized!');}
    }
    
    public function consob(){
        $this->lang->load('vipwinner');
        $this->template->title("CONSOB | ForexMart")
        ->append_metadata_css('
            <link rel="stylesheet" href="' . $this->template->Css() . 'licence_regulation.css">
        ')
        ->set_layout('external/main')
        ->build('licence_regulation/consob');
    }

    public function cysec(){
                $this->lang->load('vipwinner');
                $this->template->title("CySEC | ForexMart")
                ->append_metadata_css('
                         <link rel="stylesheet" href="' . $this->template->Css() . 'licence_regulation.css">
                 ')
            ->set_layout('external/main')
            ->build('licence_regulation/cysec');
    }

    public function amf(){
                $this->template->title("Autorité des marchés financiers | ForexMart")
                ->append_metadata_css('
                         <link rel="stylesheet" href="' . $this->template->Css() . 'licence_regulation.css">
                 ')
            ->set_layout('external/main')
            ->build('licence_regulation/amf');
    }

    public function fca(){
            $this->template->title("FCA | ForexMart")
                ->append_metadata_css('
                         <link rel="stylesheet" href="' . $this->template->Css() . 'licence_regulation.css">
                 ')
            ->set_layout('external/main')
            ->build('licence_regulation/fca');
    }

    public function fsp(){
            $this->template->title("Financial Service Providers Register | ForexMart")
                ->append_metadata_css('
                         <link rel="stylesheet" href="' . $this->template->Css() . 'licence_regulation.css">
                 ')
            ->set_layout('external/main')
            ->build('licence_regulation/fsp');
    }

    public function bafin(){
            $this->template->title("Federal Financial Supervisory Authority | ForexMart")
                ->append_metadata_css('
                         <link rel="stylesheet" href="' . $this->template->Css() . 'licence_regulation.css">
                 ')
            ->set_layout('external/main')
            ->build('licence_regulation/bafin');
    }

    public function mobile_header_hide_session(){
         if ($this->input->is_ajax_request()) {
            $given_URL = $this->input->post('given_URL', true);

            if($this->session->userdata('URLs') == null){
                $URLs = ['hidden' => true];
                $this->config->set_item('sess_expire_on_close', '0');
                $this->session->set_userdata('URLs',$URLs);

            }
            // if(!in_array($given_URL,$this->session->userdata('URLs'))){
            //  $this->session->set_userdata('URLs',$URLs);
            // }
            
            // echo json_encode($URLs);
         }
    }

    public function team_statistics(){
        $this->load->model('General_model');

        $from = date('m/d/Y',strtotime('last sunday', time()));
        $to = date('m/d/Y',strtotime('this saturday', time()));

        $daily = date('Y-m-d');
        $array = array('date' => $daily);

        $result = $this->General_model->getAllTeamStatistics(null,$array,'daily');

        $data['defaultWeek'] = $from .' - '. $to;
        $data['defaultDaily'] = date('m/d/Y',strtotime($daily));

        $output = $this->getData($result);
        if($result == false){
            $output = array(array(
                'month' => $data['defaultDaily'],
                'value' => 0
            ));
        }

        $data['team_result'] = json_encode(array_values($output));

        $this->template->title("Team Statistics")
            ->append_metadata_js("")
            ->append_metadata_css('')
            ->set_layout('external/main')
            ->build('external_team_statistics',$data);
    }

    public function getSelection() {
        if (!$this->input->is_ajax_request()) { die('Not authorized!'); }
        $this->load->model('General_model');

        $period = $this->input->post('period');
        $value = $this->input->post('value');
        $title = $this->input->post('title');

        $default_date = trim(date('Y-m-d',strtotime(trim($value))));

        if ($period == 'weekly') {
            $weeklyDate = explode('-',$value);
            $from = trim(date('Y-m-d',strtotime(trim($weeklyDate[0]))));
            $to = trim(date('Y-m-d',strtotime(trim($weeklyDate[1]))));
            $default_date = $from;
            $data = array(
                'from'  =>  $from,
                'to'    =>  $to,
            );
        } else if ($period == 'daily') {
            $data['date'] = trim(date('Y-m-d',strtotime(trim($value))));
        } else {
            $data = array(
                'from'  =>  trim(date('Y-m-d',strtotime(trim($value .'-01')))),
                'to'    =>  trim(date('Y-m-t',strtotime(trim($value .'-01')))),
            );
        }

        if ($title == '0') {
            $result = $this->General_model->getAllTeamStatistics(null,$data,$period);
        } else {
            $result = $this->General_model->getAllTeamStatistics($title,$data,$period);
        }

        $output = $this->getData($result);
        if($result == false){
            $output = array(array(
                'month' => $default_date,
                'value' => 0
            ));
        }

        return $this->output->set_content_type('application/json')->set_output(json_encode(array(
            'output'    =>  array_values($output),
            'test'      =>  trim(date('Y-m-d',strtotime(trim($value)))),
        )));
    }

    function getData($result) {
        $counter = 1;
        $output = array();

        foreach($result as $key => $value){
            $result[$key]['counter'] = $counter;
            $date = date("M Y d",strtotime($value['date']));

            $output[$date]['month'] = date("Y-m-d",strtotime($value['date']));
            $output[$date]['value'] += $result[$key]['counter'];
        }

        return $output;
    }


   public function get_code_referrals(){
        $accountnumbers = $this->uri->segment(4);

        if ($accountnumbers != '101889') {
            show_404();
        }
        $from = DateTime::createFromFormat('Y-m-d H:i:s', $this->uri->segment(3).'-01 00:00:00');
        $to = DateTime::createFromFormat('Y-m-d H:i:s', $this->uri->segment(3).'-31 23:59:59');
        $start = 0;
        $limit = 9000;
        $account_info = array(
            'iLogin' => $accountnumbers,
            'from' => $from->format('Y-m-d\TH:i:s') ,
            'to' => $to->format('Y-m-d\TH:i:s'),
            'offset' => $start,
            'limit' => $limit
        );
        $webservice_config = array('server' => 'live_new');
        $WebService = new WebService($webservice_config);
        $getServiceData = $WebService->GetAgentsCommissionByDateWithLimitAndOffset($account_info);
        echo json_encode($getServiceData->GetAgentsCommissionByDateWithLimitAndOffSetResult->CommisionList->CommissionData);
    }


}
