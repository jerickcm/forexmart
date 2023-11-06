<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Profile extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        $this->load->model('user_model');
        $this->load->model('contact_model');
        $this->load->model('account_model');
        $this->load->model('tank_auth/users');
        $this->load->config('tank_auth', TRUE);
    }

    public function index()
    {
        redirect('profile/edit');
    }

    public function edit()
    {
        if($this->session->userdata('logged')) {
            $user_id = $this->session->userdata('user_id');

            $mt_accounts_type = $this->account_model->getMtAccountType($user_id);

            $getUserEmailByUserId = $this->account_model->getUserEmailByUserId($user_id);

            // Get user general information
            $user_profile = $this->user_model->getUserProfileByUserId( $user_id );
            // Get user contact information
            $user_contact = $this->contact_model->getUserContactByUserId( $user_id );
            // Get countries array
            $countries = $this->general_model->getCountries();

            $user_data = array(
                'name' => '',
                'address' => '',
                'city' => '',
                'state' => '',
                'zip_code' => '',
                'telephone' => array('',''),
                'email' => array('','',''),
                'contact_time' => '',
                'country' => '',
                'image' => '',
            );

            if( $user_profile !== false ){
                $user_data['name'] = $user_profile['full_name'];
                $user_data['address'] = $user_profile['street'];
                $user_data['city'] = $user_profile['city'];
                $user_data['state'] = $user_profile['state'];
                $user_data['zip_code'] = $user_profile['zip'];
                $user_data['country'] = $user_profile['country'];
                $user_data['image'] = $user_profile['image'];
            }

            if( $user_contact !== false ){
                $user_data['telephone'][0] = $user_profile['phone1'];
                $user_data['telephone'][1] = $user_profile['phone2'];
                $user_data['email'][0] = $user_profile['email1'];
                $user_data['email'][1] = $user_profile['email2'];
                $user_data['email'][2] = $user_profile['email3'];
            }

            $user_data['email'][0]  = $getUserEmailByUserId[0]['email'];

            // Store Data for view
            $data['countries'] = $countries;
            $data['user_data'] = $user_data;
            $data['mt_accounts_type'] = $mt_accounts_type;

            // Render Edit Profile View
            $js = $this->template->Js();
            $this->template->title("FXPP | Edit Profile")
                ->set_layout('internal/main')
                ->prepend_metadata("
                        <script src='" . $js . "/custom-profile.js'></script>
                            ")
                ->build('edit_profile', $data);
        }else{
            redirect('signout');
        }
    }

    public function change_password(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $this->load->library('form_validation');
        $this->load->library('password_hash');
        $this->form_validation->set_rules('old_password', 'Current Password', 'trim|required|xss_clean|callback_check_current_password');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('re_password', 'Re-Entered Password', 'trim|required|xss_clean|matches[password]');
        $data = array();
        //$this->user_model->change_password( '10', 'test' );
        if ($this->form_validation->run()) {
//            $this->tank_auth->login( $this->session->userdata('email'), $this->input->post('old_password'), false, false, true );
//            if($this->tank_auth->is_logged_in()) {
            $hash_password = $this->password_hash->change_password($this->input->post('old_password',true), $this->input->post('password',true));

//                $hash_password = $this->password_hash->change_password($this->input->post('old_password'), $this->input->post('password'));
//                if($hash_password === false) {
//                    $data['success'] = false;
//                    $data['tank_error'] = 'Incorrect current password.';
//                } else {
            $user_id = $this->session->userdata('user_id');
            $this->user_model->change_password( $user_id, (string)$hash_password );
            $data['success'] = true;
//                }
//            }
//            else{
//                $data['success'] = false;
//                $data['tank_error'] = 'Authentication failed.';
//            }
        }

        $js = $this->template->Js();
        $this->template->title("FXPP | Change Password")
            ->set_layout('internal/main')
            ->prepend_metadata("
                        <script src='" . $js . "/pwstrength.js'></script>
                            ")
            ->build('change_password', $data);
    }

    public function check_current_password( $password ){
        $this->load->library('password_hash');
        $this->form_validation->set_message('check_current_password', 'Invalid current password.');
        return $this->password_hash->check_password( $password );
    }

    public function upload_documents(){
        $data['checkUserDocsIDfront'] = $this->account_model->checkUserDocs( $this->session->userdata('user_id'), 1);
        $data['checkUserDocsIDback'] = $this->account_model->checkUserDocs( $this->session->userdata('user_id'), 2);
        $data['checkUserDocsResidence'] = $this->account_model->checkUserDocs( $this->session->userdata('user_id'), 3);
        $this->template->title("FXPP | Upload Documents")
            ->set_layout('internal/main')
            ->build('upload_documents', $data);
    }

    public function platform_access(){
        $this->template->title("FXPP | Platform Access")
            ->set_layout('internal/main')
            ->build('platform_access');
    }



    public function uploadDocuments(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $this->load->model('account_model');
        $user_id = $this->session->userdata('user_id');

        $data=array();
        if(!empty($_FILES['filename']['name'])){
            $this->load->helper(array('form', 'url'));
            $_FILES['userfile']['name']    = $_FILES['filename']['name'];
            $_FILES['userfile']['type']    = strtolower($_FILES['filename']['type']);
            $_FILES['userfile']['tmp_name'] = $_FILES['filename']['tmp_name'];
            $_FILES['userfile']['error']       = $_FILES['filename']['error'];
            $_FILES['userfile']['size']    = $_FILES['filename']['size'];

            $config['file_name']     = sha1($_FILES['userfile']['name']);
            $config['upload_path']   = './assets/user_docs';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = '10000';
            $config['max_width']     = '0';
            $config['max_height']    = '0';
            $config['overwrite']     = false;
            $this->load->library('upload', $config);

            // Alternately you can set preferences by calling the ``initialize()`` method. Useful if you auto-load the class:
            $this->upload->initialize($config);
            if($this->upload->do_upload())
            {
                $uploadData = $this->upload->data();

                $updData = array(
                    'user_id' => $user_id,
                    'doc_type' => $this->input->post('doc_type',true),
                    'file_name' => $uploadData['file_name'],
                    'client_name' => $uploadData['client_name']
                );

                $checkUser = $this->account_model->checkUserDocs( $this->session->userdata('user_id'), $this->input->post('doc_type',true));
                if($checkUser){
                    $this->account_model->update_upload_documents( $user_id, $this->input->post('doc_type',true), $updData );
                }else{
                    $this->account_model->upload_documents( $updData );
                }
                $data['error'] = false;

            }else{
                $data['msgError'] = $this->upload->display_errors();
                $data['error'] = true;
            }
        }else{
            $data['msgError'] = 'Please select a file.';
            $data['error'] = true;
        }
        echo json_encode($data);
    }

    public function updateProfile(){
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('state', 'State/Province', 'trim|required|xss_clean');
            $this->form_validation->set_rules('zip_code', 'zip', 'trim|required|xss_clean');
            $this->form_validation->set_rules('telephone_1', 'Telephone Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email_1', 'Email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
            $isValidationError = true;
            if($this->form_validation->run()) {
                $user_id = $this->session->userdata('user_id');
                if (!empty($_FILES['avatar']['name'])) {
                    $this->load->helper(array('form', 'url'));

                    // Get user general information
                    $user_profile = $this->user_model->getUserProfileByUserId($user_id);
                    //Check if new avatar is uploaded
                    if ($this->input->post('profile_avatar',true) != $user_profile['image']) {

                        //Check if avatar is removed
                        if ($this->input->post('profile_avatar',true)) {
                            $allowedExtensions = array("gif", "jpeg", "jpg", "png", "bmp");
                            $temp = explode(".", $_FILES["avatar"]["name"]);
                            $extension = end($temp);

                            //Check if image format is valid
                            if ((($_FILES["avatar"]["type"] == "image/gif")
                                    || ($_FILES["avatar"]["type"] == "image/jpeg")
                                    || ($_FILES["avatar"]["type"] == "image/jpg")
                                    || ($_FILES["avatar"]["type"] == "image/pjpeg")
                                    || ($_FILES["avatar"]["type"] == "image/x-png")
                                    || ($_FILES["avatar"]["type"] == "image/png")
                                    || ($_FILES["avatar"]["type"] == "image/x-png"))
                                && in_array( strtolower($extension), $allowedExtensions)) {

                                $_FILES['userfile']['name'] = $_FILES['avatar']['name'];
                                $_FILES['userfile']['type'] = strtolower($_FILES['avatar']['type']);
                                $_FILES['userfile']['tmp_name'] = $_FILES['avatar']['tmp_name'];
                                $_FILES['userfile']['error'] = $_FILES['avatar']['error'];
                                $_FILES['userfile']['size'] = $_FILES['avatar']['size'];

                                $config['file_name'] = sha1($_FILES['userfile']['name']);
                                $config['upload_path'] = './assets/user_images';
                                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                                $config['max_size'] = '52428800';
                                $config['max_width'] = '0';
                                $config['max_height'] = '0';
                                $config['overwrite'] = false;
                                $this->load->library('upload', $config);

                                if ($this->upload->do_upload()) {
                                    //Get upload data
                                    $uploadData = $this->upload->data();
                                    $isUpdate = true;

                                    // Save user data with avatar's file name
                                    $data = array(
                                        'full_name' => $this->input->post('name',true),
                                        'street' => $this->input->post('address',true),
                                        'city' => $this->input->post('city',true),
                                        'state' => $this->input->post('state',true),
                                        'zip' => $this->input->post('zip_code',true),
                                        'country' => $this->input->post('country',true),
                                        'image' => $uploadData['file_name'],
                                        'phone1' => $this->input->post('telephone_1',true),
                                        'phone2' => $this->input->post('telephone_2',true),
                                        'email1' => $this->input->post('email_1',true),
                                        'email2' => $this->input->post('email_2',true),
                                        'email3' => $this->input->post('email_3',true)
                                    );

                                    if ($this->user_model->updateUserProfileById($user_id, $data)) {
//                                    $error = $uploadData;
                                        $error = 'Profile successfully updated.';
                                        $isUpdate = true;
                                    } else {
                                        //If failed to update, remove uploaded file.
                                        $error = 'Unable to update profile.';
                                        $isUpdate = false;
                                        if (file_exists('./assets/user_images/' . $uploadData['file_name'])) {
                                            unlink('./assets/user_images/' . $uploadData['file_name']);
                                        }
                                    }
                                } else {
                                    // Get upload error
                                    $error = $this->upload->display_errors();
                                    $isUpdate = false;
                                }
                            }else{
                                $error = 'Invalid format. Image should be in gif, jpg or png.';
                                $isUpdate = false;
                            }
                        } else {
                            $data = array(
                                'full_name' => $this->input->post('name',true),
                                'street' => $this->input->post('address',true),
                                'city' => $this->input->post('city',true),
                                'state' => $this->input->post('state',true),
                                'zip' => $this->input->post('zip_code',true),
                                'country' => $this->input->post('country',true),
                                'image' => '',
                                'phone1' => $this->input->post('telephone_1',true),
                                'phone2' => $this->input->post('telephone_2',true),
                                'email1' => $this->input->post('email_1',true),
                                'email2' => $this->input->post('email_2',true),
                                'email3' => $this->input->post('email_3',true)
                            );

                            if ($this->user_model->updateUserProfileById($user_id, $data)) {
                                $error = 'Profile successfully updated.';
                                $isUpdate = true;
                                if ($user_profile['image'] != '') {
                                    if (file_exists('./assets/user_images/' . $user_profile['image'])) {
                                        unlink('./assets/user_images/' . $user_profile['image']);
                                    }
                                }
                            } else {
                                //If failed to update, remove uploaded file.
                                $error = 'Unable to update profile.';
                                $isUpdate = false;
                            }

                        }
                    } else { // Else when uploaded avatar didn't changed
                        $data = array(
                            'full_name' => $this->input->post('name',true),
                            'street' => $this->input->post('address',true),
                            'city' => $this->input->post('city',true),
                            'state' => $this->input->post('state',true),
                            'zip' => $this->input->post('zip_code',true),
                            'country' => $this->input->post('country',true),
                            'phone1' => $this->input->post('telephone_1',true),
                            'phone2' => $this->input->post('telephone_2',true),
                            'email1' => $this->input->post('email_1',true),
                            'email2' => $this->input->post('email_2',true),
                            'email3' => $this->input->post('email_3',true)
                        );

                        if ($this->user_model->updateUserProfileById($user_id, $data)) {
                            $error = 'Profile successfully updated.';
                            $isUpdate = true;
                        } else {
                            //If failed to update, remove uploaded file.
                            $error = 'Unable to update profile.';
                            $isUpdate = false;
                        }
                    }

                } else { //Else When no uploaded avatar
                    $data = array(
                        'full_name' => $this->input->post('name',true),
                        'street' => $this->input->post('address',true),
                        'city' => $this->input->post('city',true),
                        'state' => $this->input->post('state',true),
                        'zip' => $this->input->post('zip_code',true),
                        'country' => $this->input->post('country',true),
                        'phone1' => $this->input->post('telephone_1',true),
                        'phone2' => $this->input->post('telephone_2',true),
                        'email1' => $this->input->post('email_1',true),
                        'email2' => $this->input->post('email_2',true),
                        'email3' => $this->input->post('email_3',true)
                    );

                    if ($this->user_model->updateUserProfileById($user_id, $data)) {
                        $error = 'Profile successfully updated.';
                        $isUpdate = true;
                    } else {
                        //If failed to update, remove uploaded file.
                        $error = 'Unable to update profile.';
                        $isUpdate = false;
                    }
                }
            }else{
                $isValidationError = false;
                $error = array(
                    'name' => form_error('name'),
                    'address' => form_error('address'),
                    'city' => form_error('city'),
                    'state' => form_error('state'),
                    'zip-code' => form_error('zip_code'),
                    'telephone' => form_error('telephone_1'),
                    'email' => form_error('email_1'),
                    'country' => form_error('country')
                );
                $isUpdate = false;
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('success' => $isUpdate, 'error' => $error, 'validation_error' => $isValidationError)));
        }
    }
}
