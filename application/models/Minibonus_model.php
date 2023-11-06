<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Minibonus_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    public function all_live_users(){
        //FXPP-3989 stable use
        $query = $this->db->query("
                    SELECT
                `mt_accounts_set`.`account_number` AS `account_number`,
                `users`.`email` AS `email`,
                `users`.`login_type` AS `login_type`,
                `mt_accounts_set`.`active` AS `active`,
                `mt_accounts_set`.`mt_currency_base` AS `mt_currency_base`
                FROM
                    (
                        `users`
                        JOIN `mt_accounts_set` ON (
                            (
                                `mt_accounts_set`.`user_id` = `users`.`id`
                            )
                        )
                    )
                WHERE
                (
                    (`users`.`login_type` = 0)
                    AND (
                        char_length(
                            `mt_accounts_set`.`account_number`
                        ) > 5
                    )
                    AND (`users`.`type` = 1)
                    AND (`users`.`test` <> 1)
                    AND (`users`.`test_1` <> 0)
                    AND (
                        `mt_accounts_set`.`active` <> 5
                    )
                    AND (
                        `mt_accounts_set`.`active` <> 3
                    )
                    AND (
                        `mt_accounts_set`.`active` <> 2
                    )
                    AND (
                        `mt_accounts_set`.`mini_bonus_credit` <> 1
                    )
                    AND (
                        `mt_accounts_set`.`annually_credited_minibonus` <> 1
                    )
                    AND (
                        `mt_accounts_set`.`new_account_minibonus` <> 1
                    )
                )
        ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function all_live_users_validations(){
        //FXPP-3989 stable use
        $query = $this->db->query("
                                SELECT
                            `mt_accounts_set`.`account_number` AS `account_number`,
                            `users`.`email` AS `email`,
                            `users`.`login_type` AS `login_type`,
                            `mt_accounts_set`.`active` AS `active`,
                            `users`.`nodepositbonus` AS `nodepositbonus`,
                            `mt_accounts_set`.`mt_currency_base` AS `mt_currency_base`,
                            `mt_accounts_set`.`amount` AS `amount`,
                            `users`.`verified` AS `verified`,
                            `users`.`accountstatus` AS `accountstatus`,
                            `user_profiles`.`full_name` AS `full_name`,
                            `user_profiles`.`dob` AS `dob`,
                            `user_profiles`.`user_id` AS `user_id`,
                            `mt_accounts_set`.`has_activeaccount` AS `has_activeaccount`,
                            `mt_accounts_set`.`is_ndb_acquire_from_another_account` AS `is_ndb_acquire_from_another_account`
                        FROM
                            (
                                (
                                    `users`
                                    JOIN `mt_accounts_set` ON (
                                        (
                                            `mt_accounts_set`.`user_id` = `users`.`id`
                                        )
                                    )
                                )
                                JOIN `user_profiles` ON (
                                    (
                                        `user_profiles`.`user_id` = `mt_accounts_set`.`user_id`
                                    )
                                )
                            )
                        WHERE
                            (
                                (`users`.`login_type` = 0)
                                AND (
                                    char_length(
                                        `mt_accounts_set`.`account_number`
                                    ) > 5
                                )
                                AND (`users`.`type` = 1)
                                AND (`users`.`test` <> 1)
                                AND (`users`.`test_1` <> 0)
                                AND (`users`.`nodepositbonus` = 0)
                                AND (
                                    `mt_accounts_set`.`active` <> 1
                                )
                                AND (
                                    `mt_accounts_set`.`active` <> 0
                                )
                                AND (
                                    `mt_accounts_set`.`active` <> 3
                                )
                                AND (
                                    `mt_accounts_set`.`active` <> 2
                                )
                                AND (
                                    `mt_accounts_set`.`active` <> 4
                                )
                                AND (`users`.`accountstatus` = 1)
                                AND (
                                    `mt_accounts_set`.`is_ndb_acquire_from_another_account` <> 1
                                )
                                AND (
                                    `mt_accounts_set`.`is_ndb_acquire_from_another_account` <> 2
                                )
                                AND (
                                    `mt_accounts_set`.`annually_credited_minibonus` <> 1
                                )
                            )

        ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function showFullname_v2(
        $table1,$table2,$table3,
        $field1="",$id1="",
        $field2="",$id2="",
        $field3="",$id3="",
        $field4="",$id4="",
        $join12="",$join13,
        $select=""){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2 ,$join12);
        $this->db->join($table3 ,$join13);
        $this->db->where($field3, $id3);
        $this->db->where($field4, $id4);
        $this->db->where($field2, $id2);
        $this->db->where($field1, $id1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function showEmail_v2(
        $table1,$table2,$table3,
        $field1="",$id1="",
        $field3="",$id3="",
        $field4="",$id4="",
        $join12="",
        $join13="",
        $select=""){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2 ,$join12);
        $this->db->join($table3 ,$join13);
        $this->db->where($field3, $id3);
        $this->db->where($field4, $id4);
        $this->db->where($field1, $id1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    public function all_live_users_restoration(){
        //FXPP-3989 stable use
        $query = $this->db->query("
                        SELECT
                    `mt_accounts_set`.`id` AS `id`,
                    `mt_accounts_set`.`user_id` AS `user_id`,
                    `mt_accounts_set`.`mt_account_set_id` AS `mt_account_set_id`,
                    `mt_accounts_set`.`leverage` AS `leverage`,
                    `mt_accounts_set`.`amount` AS `amount`,
                    `mt_accounts_set`.`mt_currency_base` AS `mt_currency_base`,
                    `mt_accounts_set`.`mt_trading_group` AS `mt_trading_group`,
                    `mt_accounts_set`.`mt_status` AS `mt_status`,
                    `mt_accounts_set`.`mt_comment` AS `mt_comment`,
                    `mt_accounts_set`.`mt_passport_id` AS `mt_passport_id`,
                    `mt_accounts_set`.`registration_time` AS `registration_time`,
                    `mt_accounts_set`.`registration_ip` AS `registration_ip`,
                    `mt_accounts_set`.`last_login_ip` AS `last_login_ip`,
                    `mt_accounts_set`.`mt_type` AS `mt_type`,
                    `mt_accounts_set`.`swap_free` AS `swap_free`,
                    `mt_accounts_set`.`account_number` AS `account_number`,
                    `mt_accounts_set`.`trader_password` AS `trader_password`,
                    `mt_accounts_set`.`investor_password` AS `investor_password`,
                    `mt_accounts_set`.`phone_password` AS `phone_password`,
                    `mt_accounts_set`.`group` AS `group`,
                    `mt_accounts_set`.`group_code` AS `group_code`,
                    `mt_accounts_set`.`auto_leverage` AS `auto_leverage`,
                    `mt_accounts_set`.`auto_leverage_change` AS `auto_leverage_change`,
                    `mt_accounts_set`.`registration_leverage` AS `registration_leverage`,
                    `mt_accounts_set`.`client_autolevchange_disable` AS `client_autolevchange_disable`,
                    `mt_accounts_set`.`amount_conv_api` AS `amount_conv_api`,
                    `mt_accounts_set`.`active` AS `active`,
                    `mt_accounts_set`.`inactive_email_error` AS `inactive_email_error`,
                    `mt_accounts_set`.`is_ndb_acquire_from_another_account` AS `is_ndb_acquire_from_another_account`,
                    `mt_accounts_set`.`has_activeaccount` AS `has_activeaccount`,
                    `mt_accounts_set`.`restored_inactive_account` AS `restored_inactive_account`,
                    `mt_accounts_set`.`mini_bonus_credit` AS `mini_bonus_credit`,
                    `mt_accounts_set`.`is_standard_account` AS `is_standard_account`,
                    `mt_accounts_set`.`is_groupupdated` AS `is_groupupdated`,
                    `mt_accounts_set`.`is_notactive_notemailed` AS `is_notactive_notemailed`,
                    `mt_accounts_set`.`updated_creditedbonus` AS `updated_creditedbonus`,
                    `mt_accounts_set`.`is_enabled` AS `is_enabled`
                FROM
                    `mt_accounts_set`
                WHERE
                    (
                        (
                            `mt_accounts_set`.`restored_inactive_account` = 4
                        )
                        AND (
                            `mt_accounts_set`.`annually_credited_minibonus` <> 1
                        )
                        AND (
                            `mt_accounts_set`.`new_account_ready` <> 1
                        )
                    )
        ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function FXPP_4280(){
        //FXPP-3989 stable use
        $query = $this->db->query("
                                SELECT
                            `mt_accounts_set`.`id` AS `id`,
                            `mt_accounts_set`.`user_id` AS `user_id`,
                            `mt_accounts_set`.`mt_account_set_id` AS `mt_account_set_id`,
                            `mt_accounts_set`.`leverage` AS `leverage`,
                            `mt_accounts_set`.`amount` AS `amount`,
                            `mt_accounts_set`.`mt_currency_base` AS `mt_currency_base`,
                            `mt_accounts_set`.`mt_trading_group` AS `mt_trading_group`,
                            `mt_accounts_set`.`mt_status` AS `mt_status`,
                            `mt_accounts_set`.`mt_comment` AS `mt_comment`,
                            `mt_accounts_set`.`mt_passport_id` AS `mt_passport_id`,
                            `mt_accounts_set`.`registration_time` AS `registration_time`,
                            `mt_accounts_set`.`registration_ip` AS `registration_ip`,
                            `mt_accounts_set`.`last_login_ip` AS `last_login_ip`,
                            `mt_accounts_set`.`mt_type` AS `mt_type`,
                            `mt_accounts_set`.`swap_free` AS `swap_free`,
                            `mt_accounts_set`.`account_number` AS `account_number`,
                            `mt_accounts_set`.`trader_password` AS `trader_password`,
                            `mt_accounts_set`.`investor_password` AS `investor_password`,
                            `mt_accounts_set`.`phone_password` AS `phone_password`,
                            `mt_accounts_set`.`group` AS `group`,
                            `mt_accounts_set`.`group_code` AS `group_code`,
                            `mt_accounts_set`.`auto_leverage` AS `auto_leverage`,
                            `mt_accounts_set`.`auto_leverage_change` AS `auto_leverage_change`,
                            `mt_accounts_set`.`registration_leverage` AS `registration_leverage`,
                            `mt_accounts_set`.`client_autolevchange_disable` AS `client_autolevchange_disable`,
                            `mt_accounts_set`.`amount_conv_api` AS `amount_conv_api`,
                            `mt_accounts_set`.`active` AS `active`,
                            `mt_accounts_set`.`inactive_email_error` AS `inactive_email_error`,
                            `mt_accounts_set`.`is_ndb_acquire_from_another_account` AS `is_ndb_acquire_from_another_account`,
                            `mt_accounts_set`.`has_activeaccount` AS `has_activeaccount`,
                            `mt_accounts_set`.`restored_inactive_account` AS `restored_inactive_account`,
                            `mt_accounts_set`.`mini_bonus_credit` AS `mini_bonus_credit`,
                            `mt_accounts_set`.`is_standard_account` AS `is_standard_account`,
                            `mt_accounts_set`.`is_groupupdated` AS `is_groupupdated`,
                            `mt_accounts_set`.`is_notactive_notemailed` AS `is_notactive_notemailed`,
                            `mt_accounts_set`.`updated_creditedbonus` AS `updated_creditedbonus`,
                            `mt_accounts_set`.`is_enabled` AS `is_enabled`,
                            `mt_accounts_set`.`annually_credited_minibonus` AS `annually_credited_minibonus`
                        FROM
                            `mt_accounts_set`
                        WHERE
                            (
                                (
                                    `mt_accounts_set`.`new_account_ready` = 1
                                )
                                AND (
                                    `mt_accounts_set`.`old_account_created_newaccount` <> 1
                                )
                                AND (
                                    `mt_accounts_set`.`annually_credited_minibonus` <> 1
                                )
                            )

        ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function all_3rd_to_Nth(){
        //FXPP-3989 stable use
        $query = $this->db->query("
                                SELECT
                            `mt_accounts_set`.`id` AS `id`,
                            `mt_accounts_set`.`user_id` AS `user_id`,
                            `mt_accounts_set`.`mt_account_set_id` AS `mt_account_set_id`,
                            `mt_accounts_set`.`leverage` AS `leverage`,
                            `mt_accounts_set`.`amount` AS `amount`,
                            `mt_accounts_set`.`mt_currency_base` AS `mt_currency_base`,
                            `mt_accounts_set`.`mt_trading_group` AS `mt_trading_group`,
                            `mt_accounts_set`.`mt_status` AS `mt_status`,
                            `mt_accounts_set`.`mt_comment` AS `mt_comment`,
                            `mt_accounts_set`.`mt_passport_id` AS `mt_passport_id`,
                            `mt_accounts_set`.`registration_time` AS `registration_time`,
                            `mt_accounts_set`.`registration_ip` AS `registration_ip`,
                            `mt_accounts_set`.`last_login_ip` AS `last_login_ip`,
                            `mt_accounts_set`.`mt_type` AS `mt_type`,
                            `mt_accounts_set`.`swap_free` AS `swap_free`,
                            `mt_accounts_set`.`account_number` AS `account_number`,
                            `mt_accounts_set`.`trader_password` AS `trader_password`,
                            `mt_accounts_set`.`investor_password` AS `investor_password`,
                            `mt_accounts_set`.`phone_password` AS `phone_password`,
                            `mt_accounts_set`.`group` AS `group`,
                            `mt_accounts_set`.`group_code` AS `group_code`,
                            `mt_accounts_set`.`auto_leverage` AS `auto_leverage`,
                            `mt_accounts_set`.`auto_leverage_change` AS `auto_leverage_change`,
                            `mt_accounts_set`.`registration_leverage` AS `registration_leverage`,
                            `mt_accounts_set`.`client_autolevchange_disable` AS `client_autolevchange_disable`,
                            `mt_accounts_set`.`amount_conv_api` AS `amount_conv_api`,
                            `mt_accounts_set`.`active` AS `active`,
                            `mt_accounts_set`.`inactive_email_error` AS `inactive_email_error`,
                            `mt_accounts_set`.`is_ndb_acquire_from_another_account` AS `is_ndb_acquire_from_another_account`,
                            `mt_accounts_set`.`has_activeaccount` AS `has_activeaccount`,
                            `mt_accounts_set`.`restored_inactive_account` AS `restored_inactive_account`,
                            `mt_accounts_set`.`mini_bonus_credit` AS `mini_bonus_credit`,
                            `mt_accounts_set`.`is_standard_account` AS `is_standard_account`,
                            `mt_accounts_set`.`is_groupupdated` AS `is_groupupdated`,
                            `mt_accounts_set`.`is_notactive_notemailed` AS `is_notactive_notemailed`,
                            `mt_accounts_set`.`updated_creditedbonus` AS `updated_creditedbonus`,
                            `mt_accounts_set`.`is_enabled` AS `is_enabled`,
                            `mt_accounts_set`.`annually_credited_minibonus` AS `annually_credited_minibonus`,
                            `mt_accounts_set`.`update_minicreditedbonuse_db` AS `update_minicreditedbonuse_db`,
                            `mt_accounts_set`.`annual_minibonus_tag` AS `annual_minibonus_tag`,
                            `mt_accounts_set`.`inactive_date` AS `inactive_date`,
                            `mt_accounts_set`.`inactive_counter` AS `inactive_counter`,
                            `mt_accounts_set`.`new_account_minibonus` AS `new_account_minibonus`,
                            `mt_accounts_set`.`new_account_ready` AS `new_account_ready`,
                            `mt_accounts_set`.`old_account_created_newaccount` AS `old_account_created_newaccount`
                        FROM
                            `mt_accounts_set`
                        WHERE
                            (
                                (
                                    `mt_accounts_set`.`annually_credited_minibonus` = 1
                                )
                                AND (
                                    `mt_accounts_set`.`mini_bonus_credit` = 1
                                )
                                AND (
                                    `mt_accounts_set`.`new_account_minibonus` = 1
                                )
                                AND (
                                    `mt_accounts_set`.`old_account_created_newaccount` <> 1
                                )
                                AND (
                                    `mt_accounts_set`.`active` <> 5
                                )
                            )

        ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function all_3rd_to_Nth_2(){
        //FXPP-3989 stable use
        $query = $this->db->query("SELECT * from annual_ndb_3rd_to_nth_2");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function showFullname_v3(
        $table1,$table2,$table3,
        $field1="",$id1="",
        $field2="",$id2="",
//        $field3="",$id3="",
        $field4="",$id4="",
        $join12="",$join13,
        $select=""){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2 ,$join12);
        $this->db->join($table3 ,$join13);
//        $this->db->where($field3, $id3);
        $this->db->where($field4, $id4);
        $this->db->where($field2, $id2);
        $this->db->where($field1, $id1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

    function showEmail_v3(
        $table1,$table2,$table3,
        $field1="",$id1="",
//        $field3="",$id3="",
//        $field4="",$id4="",
        $join12="",
        $join13="",
        $select=""){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2 ,$join12);
        $this->db->join($table3 ,$join13);
//        $this->db->where($field3, $id3);
//        $this->db->where($field4, $id4);
        $this->db->where($field1, $id1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }

    public function annual_ndb_3rd_to_nth_3(){
        //FXPP-3989 stable use
        $query = $this->db->query("SELECT * from annual_ndb_3rd_to_nth_3");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
}
