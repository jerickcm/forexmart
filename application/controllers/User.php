<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('tank_auth/users');
        $this->lang->load('nav_lang');
    }

    public function Search(){
        if (FXPP::html_url()=='en'){
            $array = $this->uri->uri_to_assoc(3);
        }else{
            $array = $this->uri->uri_to_assoc(4);
        }

        if ($array){
            $array['searchstring'] = str_replace("%20"," ",$array['searchstring']);
        }else{
            $array['searchstring']='';
        }

        $this->template->title("Search | ForexMart")
            ->append_metadata_css("

            ")
            ->append_metadata_js('
                    <script src="'.$this->template->Js(). 'listfilterAll.min.js'. '"></script>
                    <script src="'.$this->template->Js(). 'listfilterIcon.min.js'. '"></script>
                    <script src="'.$this->template->Js(). 'listfilterMobile.min.js'. '"></script>
                    <script src="'.$this->template->Js(). 'listfilterTop.min.js'. '"></script>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#searchfield").val("'.$array['searchstring'].'").focus();
                            $("#searchfield").blur();
                            $("#searchfield").next().focus();
                            $("#searchfield").trigger({type: "keypress", which: 13, keyCode: 13});
                        });
                    </script>
            ')
            ->set_layout('external/main')
            ->build('external_Search');
    }

    //

}
