<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Partners extends CI_Model
{
    private $table_name			= 'partnership_login';

    function __construct()
    {
        parent::__construct();

        $ci =& get_instance();
        $this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
    }

    function create_partner($data, $activated = FALSE){
        $data['activated'] = $activated ? 1 : 0;
        if ($this->db->insert($this->table_name, $data)) {
            $user_id = $this->db->insert_id();
            return array('user_id' => $user_id);
        }
        return NULL;
    }

}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */