<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Withdraw_model extends CI_Model
{
    private $table = 'withdraw';
    private $bonus = 'withdraw_bonus';

    function __construct()
    {
        parent::__construct();
    }


    public function insertWithdraw( $data = array() ){
        if($this->db->insert('withdraw', $data)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function getWithdrawById( $id ){
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row_array() : false;
    }

    public function updateConvertedAmountById( $id, $amount ){
        $data = array(
            'conv_amount' => $amount
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function getWithdrawBonusByTransId($wTransId){
        $this->db->from($this->bonus);
        $this->db->where('Transaction_id', $wTransId);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }

    public function updateBonus($wTransId, $bTicket){
        $data = array(
            'Credit_bonus_ticket' => $bTicket
        );
        $this->db->where('Id', $wTransId);
        $this->db->update($this->bonus, $data);
    }

    public function insertWithdrawBonus( $data = array() ){
        if($this->db->insert('withdraw_bonus', $data)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
}