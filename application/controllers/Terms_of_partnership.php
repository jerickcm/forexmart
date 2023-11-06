<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms_of_partnership extends MY_Controller {

    public function index()
    {
        $this->template->title("FXPP | Terms of Partnership")
            ->set_layout('external/main')
            ->build('terms_of_partnership');
    }
}
