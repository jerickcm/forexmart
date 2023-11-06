<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Description of web_terminal
 * @author IT
 */

class Webterminal extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->template->title('ForexMart Web Trading')
        ->append_metadata_js('')
        ->set_layout('')
        ->build('widget/web-platform', $data['data']);
        
        #$this->load->view('widget/web-platform');
    }
}
