<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserAccess {

                
    function __construct(){ 
    }
   
    public static function ManageAccessList(){
        
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->model('virtual_account_model');        
        
        $user_id= $ci->session->userdata('user_id');      
        //return $this->general_model->getOneDataMange('manage_access','user_id',$user_id,'type',1);
       return $data= $ci->general_model->getOneDataMange('manage_access','user_id',$user_id,'type',3,'admin',3); 
    }
   
    
    public static function checkUserPermission($menuTab)
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->load->model('virtual_account_model');      
        
        
        $permit=  self::ManageAccessList();
        $datarray=explode(",",$permit['permission']);
        if (!in_array($menuTab, $datarray))
          {

            //redirect('signout/admin');
                                
            $permitArry = array("qjum", "acc", "fina","ord","part","vef","mkt","tinfo", "ticra","mana");
            $chekMinPer="";
            foreach($datarray as $key)
            {
                if (in_array($key, $permitArry)) {echo  $chekMinPer=$key; }
            }
                
            
            switch ($chekMinPer) {
//                case "qjum":
//                    redirect('administration/mailer');
//                    break;
                case "acc":
                    redirect('accounts/search_account');
                    break;
                case "openacc":
                    redirect('Open_account/index');
                    break;
                case "fina":
                    redirect('finance-deposit-withdraw');
                    break;
                case "ord":
                    redirect('find-orders');
                    break;
//                case "part":
//                    redirect('administration/manage-accounts');
//                    break;
                  case "vef":
                    redirect('Verify/index');
                    break;
//                case "mkt":
//                    redirect('administration/manage-bonus');
//                    break;
//                case "tinfo":
//                    redirect('administration/ticket-raffle');
//                    break;
//                case "ticra":
//                    redirect('administration/manage-deposits');
//                    break;
                 case "mana":
                    redirect('manage-access');
                    break;              
                default:
                  redirect('Signout');
            }



        }
        

    }
    
    
    
    
    
    
    
    
    
}