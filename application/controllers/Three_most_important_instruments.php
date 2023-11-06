<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Three_most_important_instruments extends MY_Controller {

    public function index(){
      //  if(!IPLoc::Office()) redirect("");
        $this->lang->load('three_important_instruments');
        $data['data']['DemoAndLiveLinks'] = $this->load->view('addin_DemoLiveLinks', NULL, TRUE);
        $data['data']['metadata_description'] = lang('dw_desc');
        $data['data']['metadata_keyword'] = lang('dw_kew');
        $this->template->title(lang('dw_tit'))
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
            ->build('external_three_most_important_instruments', $data['data']);
    }
}
