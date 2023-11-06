<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transactions extends MY_Controller {

    public function index()
    {
        redirect('transactions/withdraw');
    }

    public function withdraw(){
        // Render Deposit View
        $js = $this->template->Js();
        $this->template->title("FXPP | Witdrawal Funds")
            ->set_layout('internal/main')
            ->prepend_metadata("

                            ")
            ->build('withdraw');
    }

    public function deposit(){
        // Render Deposit View
        $js = $this->template->Js();
        $this->template->title("FXPP | Deposit Funds")
            ->set_layout('internal/main')
            ->prepend_metadata("

                            ")
            ->build('deposit');
    }

}