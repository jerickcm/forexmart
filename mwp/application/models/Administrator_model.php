<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Administrator_model extends CI_Model
{

    function __construct(){
        parent::__construct();

    }

    function getOfflineEvents(){
        $query = $this->db->query("SELECT * FROM offline_events;");
        return $query;
    }
    function geteventinfo($offID){
        $offID1 = $offID;
        $query = $this->db->query("SELECT * FROM offline_events WHERE off_ID = '$offID1' ;");
        return $query;
    }
    function insertevent()
    {
        $curdate = date("Y-m-d");
        $data = array
        (
            // 'full_name' => $this->input->post('full_name'),
            // 'email' => $this->input->post('email')
            'title'     => $this->input->post('offline_title'),
            'author'    => $this->input->post('offline_author'),
            'content'   => $this->input->post('offline_content'),
            'date'      => $curdate
        );

        $this->db->insert('offline_events',$data);
    }


    function getCpaPartnership($type=0){

        $this->db->select("p.dateregistered,p.partner_id,p.amount,up.full_name");
        $this->db->from('partnership p');
        $this->db->join('user_profiles up',' p.partner_id = up.user_id');
        $this->db->where('p.type_of_partnership',"cpa");
        $this->db->where('p.status_type',$type);
        $this->db->order_by('p.dateregistered','desc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;

    }

    function getCpaClientList($type=0){

        /*
                $sql = "select d.id,d.cpa,d.comments,d.date_cpa,  ac.partner_id, mt.account_number,mt.registration_time,d.amount from mt_accounts_set mt inner join (select * from deposit group by user_id) d on mt.user_id= d.user_id  inner join users_affiliate_code uac on uac.users_id=mt.user_id inner join

        (SELECT pac.affiliate_code,p.partner_id,p.date_of_incorporation from partnership p inner join partnership_affiliate_code pac on p.partner_id=pac.partner_id where p.type_of_partnership='cpa' ) ac on ac.affiliate_code = uac.referral_affiliate_code where d.cpa=?

        group by mt.account_number order by d.payment_date asc
        ";
                $query = $this->db->query($sql,array($type));
        */
        $this->db->select('deposit.transaction_id, deposit.reference_id, mt_accounts_set.account_number, mt_accounts_set.registration_time, sum(deposit.amount) as amount, partner_profile.full_name as partner_name, user_profile.full_name as user_name, p2.reference_num, sum(deposit.cpa_amount) as cpa_amount');
        $this->db->from('partnership p1');
        $this->db->join('partnership p2', 'p2.reference_num = p1.reference_subnum', 'inner');
        $this->db->join('partnership_affiliate_code', 'partnership_affiliate_code.partner_id = p1.partner_id', 'inner');
        $this->db->join('user_profiles partner_profile', 'partner_profile.user_id = p2.partner_id', 'inner');
        $this->db->join('users_affiliate_code', 'users_affiliate_code.referral_affiliate_code = partnership_affiliate_code.affiliate_code', 'inner');
        $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = users_affiliate_code.users_id', 'inner');
        $this->db->join('deposit', 'deposit.status = 2 and deposit.user_id = mt_accounts_set.user_id', 'inner');
        $this->db->join('user_profiles user_profile', 'user_profile.user_id = deposit.user_id', 'inner');
        $this->db->where('p1.type_of_partnership', 'cpa');
        $this->db->where('deposit.cpa', $type);
        $this->db->where('deposit.payment_date', '(select min(payment_date)
                                                   from deposit deposit2
                                                   where deposit2.status = 2
                                                   and deposit2.user_id = deposit.user_id)', false);
        $this->db->group_by('deposit.transaction_id, deposit.reference_id, mt_accounts_set.account_number, mt_accounts_set.registration_time, partner_profile.full_name, user_profile.full_name, p2.reference_num');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getCPAClients($type){
        $result = $this->db->query("CALL getCPAClients('" . $type . "')");
        $data =  $result->result();
        //$result->next_result();
        //$result->free_result();
        return $data;
    }

    public function getWhereMax3($table,$column1="",$val1="",$column2="",$val2="",$column3="",$val3="")
    {		$condition=($column1!="")?' where '.$column1.'='.$val1:'';
        if($condition!="") {$condition.=($column2!="")?' and '.$column2.'='.$val2:'';  $condition.=($column3!="")?' and '.$column3.'='.$val3:''; }

        $sql = "SELECT * from ".$table."".$condition."";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAdminDetailsByEmail($email){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('administration', 1);
        $sql = $this->db->get();
        if($sql->num_rows() > 0){
            return $sql->result_array();
        }
        return false;
    }

    function getExtraPartnershipClientList($type=0){


        $sql = "select ac.partner_id, mt.account_number,mt.registration_time,d.amount from mt_accounts_set mt inner join deposit d on mt.user_id= d.user_id  inner join users_affiliate_code uac on uac.users_id=mt.user_id inner join

(SELECT pac.affiliate_code,p.partner_id from partnership p inner join partnership_affiliate_code pac on p.partner_id=pac.partner_id where p.type_of_partnership='extra_commission' and p.status_type=? ) ac on ac.affiliate_code = uac.referral_affiliate_code

 order by d.payment_date asc
";
        $query = $this->db->query($sql,array($type));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    function getExtraPartnerShipAndClientList($type){

        $sql = "select IFNULL(ecs.status, 0) extra,d.id, mt.registration_time,up.full_name,mt.account_number,d.amount,p.reference_num,cp.full_name partner,d.status from partnership p
inner join partnership_affiliate_code pac on p.partner_id = pac.partner_id
inner join users_affiliate_code ua on ua.referral_affiliate_code = pac.affiliate_code
left join deposit d on d.user_id=ua.users_id
left join user_profiles up on up.user_id=ua.users_id
left join mt_accounts_set mt on mt.user_id= ua.users_id
left join user_profiles cp on cp.user_id=p.partner_id
left join extra_commission_status ecs on d.id=ecs.deposit_id
where p.type_of_partnership='extra_commission'";

        $query = $this->db->query($sql);
//echo $this->db->last_query();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    function getPartnerByUserReferralID( $user_id ){
        $this->db->select('partnership.*, user_profiles.country');
        $this->db->from('partnership');
        $this->db->join('partnership_affiliate_code', 'partnership_affiliate_code.partner_id = partnership.partner_id', 'inner');
        $this->db->join('users_affiliate_code', 'users_affiliate_code.referral_affiliate_code = partnership_affiliate_code.affiliate_code', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = partnership.partner_id', 'inner');
        $this->db->where('users_affiliate_code.users_id', $user_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->row_array();
        }else{
            return false;
        }
    }

    function getCPAPartnerByUserReferralID( $user_id ){
        $this->db->select('p2.*, user_profiles.country');
        $this->db->from('partnership p1');
        $this->db->join('partnership p2', 'p2.reference_num = p1.reference_subnum', 'inner');
        $this->db->join('partnership_affiliate_code', 'partnership_affiliate_code.partner_id = p1.partner_id', 'inner');
        $this->db->join('users_affiliate_code', 'users_affiliate_code.referral_affiliate_code = partnership_affiliate_code.affiliate_code', 'inner');
        $this->db->join('user_profiles', 'user_profiles.user_id = p2.partner_id', 'inner');
        $this->db->where('users_affiliate_code.users_id', $user_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->row_array();
        }else{
            return false;
        }
    }

    function getExtraPartnerList(){
        /* $this->db->select('sum( deposit.amount) as amount, partner_profile.full_name as partner_name, partnership.reference_num');
         $this->db->from('partnership');
         $this->db->join('partnership_affiliate_code', 'partnership_affiliate_code.partner_id = partnership.partner_id', 'inner');
         $this->db->join('user_profiles partner_profile', 'partner_profile.user_id = partnership.partner_id', 'inner');
         $this->db->join('users_affiliate_code', 'users_affiliate_code.referral_affiliate_code = partnership_affiliate_code.affiliate_code', 'inner');
         $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = users_affiliate_code.users_id', 'inner');
         $this->db->join('deposit', 'deposit.status = 2 and deposit.user_id = mt_accounts_set.user_id', 'inner');
         $this->db->join('user_profiles user_profile', 'user_profile.user_id = deposit.user_id', 'inner');
         $this->db->where('partnership.type_of_partnership', 'extra_commission');
         $this->db->group_by('partnership.reference_num');*/
        // $this->db->where('deposit.cpa', $type);

        $sql = "select up.full_name,sum(if(d.status=2,d.amount,0)) amount,p.reference_num,d.status from partnership p
inner join partnership_affiliate_code pac on p.partner_id = pac.partner_id
left join users_affiliate_code ua on ua.referral_affiliate_code = pac.affiliate_code
left join deposit d on d.user_id=ua.users_id
left join user_profiles up on up.user_id=p.partner_id
where p.type_of_partnership='extra_commission'
group by p.reference_num";

        $query = $this->db->query($sql);
//echo $this->db->last_query();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


    function getExtraClientList(){
        /* $this->db->select('deposit.id, mt_accounts_set.account_number, mt_accounts_set.registration_time, deposit.amount, partner_profile.full_name as partner_name, user_profile.full_name as user_name, partnership.reference_num, deposit.cpa_amount');
         $this->db->from('partnership');
         $this->db->join('partnership_affiliate_code', 'partnership_affiliate_code.partner_id = partnership.partner_id', 'inner');
         $this->db->join('user_profiles partner_profile', 'partner_profile.user_id = partnership.partner_id', 'inner');
         $this->db->join('users_affiliate_code', 'users_affiliate_code.referral_affiliate_code = partnership_affiliate_code.affiliate_code', 'inner');
         $this->db->join('mt_accounts_set', 'mt_accounts_set.user_id = users_affiliate_code.users_id', 'inner');
         $this->db->join('deposit', 'deposit.status = 2 and deposit.user_id = mt_accounts_set.user_id', 'inner');
         $this->db->join('user_profiles user_profile', 'user_profile.user_id = deposit.user_id', 'inner');
         $this->db->where('partnership.type_of_partnership', 'extra_commission');*/
        // $this->db->where('deposit.cpa', $type);

        $sql = "select up.full_name,mt.account_number,d.amount,p.reference_num,d.status from partnership p
inner join partnership_affiliate_code pac on p.partner_id = pac.partner_id
inner join users_affiliate_code ua on ua.referral_affiliate_code = pac.affiliate_code
left join deposit d on d.user_id=ua.users_id
left join user_profiles up on up.user_id=ua.users_id
left join mt_accounts_set mt on mt.user_id= ua.users_id
where p.type_of_partnership='extra_commission' ";

        $query = $this->db->query($sql);
//echo $this->db->last_query();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }



    function extraCommission($account_number){

        $sql = 'SELECT  p.reference_num from mt_accounts_set mt
    inner join users_affiliate_code ua on  mt.user_id=ua.users_id
    inner join partnership_affiliate_code pac on pac.affiliate_code=ua.referral_affiliate_code
    inner join partnership p on p.partner_id=pac.partner_id
    where mt.account_number=? and p.type_of_partnership="extra_commission"';
        $query = $this->db->query($sql,array($account_number));

        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    public function getITSRequest($type) {
        $this->db->select('it.*, p.reference_num, u.full_name, mt.account_number, users.login_type');
        $this->db->from('internal_transfer it');
        $this->db->join('users', 'users.id = it.user_id', 'left');
        $this->db->join('partnership p', 'it.user_id = p.partner_id', 'left');
        $this->db->join('user_profiles u', 'u.user_id = it.user_id', 'left');
        $this->db->join('mt_accounts_set mt', 'mt.user_id = it.user_id', 'left');
        $this->db->where('it.status',$type);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function getAccountNumber($user_id){

        $this->db->select('*');
        $this->db->from('mt_accounts_set');
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }

    }

    public function getAgentByAccountNumber($account){
//        $query = $this->db->query("select user_id as user_id  from mt_accounts_set WHERE account_number = ?
//                    UNION ALL SELECT partner_id as user_id FROM partnership WHERE reference_num = ? LIMIT 1");

        $this->db->select('user_id');
        $this->db->from('mt_accounts_set');
        $this->db->where('account_number',$account);
        $client = $this->db->get();

        if($client->num_rows() > 0){
            return $client->row_array();
        }else{
            $this->db->select('partner_id as user_id');
            $this->db->from('partnership');
            $this->db->where('reference_num',$account);
            $partner = $this->db->get();

            if($partner->num_rows() > 0){
                return $partner->row_array();
            } else {
                return false;
            }
        }
    }

    public function getAccountNumfromAffliateCode($user_id){
        $query = $this->db->query("select * from users_affiliate_code
join (SELECT affiliate_code, users_id userid from users_affiliate_code union all SELECT affiliate_code, partner_id userid from partnership_affiliate_code) t
on users_affiliate_code.referral_affiliate_code = t.affiliate_code where t.userid = '".$user_id."'");
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getAccountByAffiliateCode($user_id){
        $subQuery = '(SELECT affiliate_code, users_id AS user_id FROM users_affiliate_code UNION ALL SELECT affiliate_code, partner_id AS user_id from partnership_affiliate_code) AS t';
        $this->db->from('users_affiliate_code');
        $this->db->join($subQuery,'users_affiliate_code.referral_affiliate_code = t.affiliate_code');
        $this->db->where('t.user_id',$user_id);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getAgentsAffiliateByAccountNum($user_id,$account_num) {
        $this->db->select('*');
        $this->db->from('partnership');
        $this->db->join('partnership_affiliate_code pac','pac.partner_id = partnership.partner_id','left');
        $this->db->join('users_affiliate_code uac','uac.referral_affiliate_code = pac.affiliate_code','left');
        $this->db->where('partnership.partner_id',$user_id);
        $this->db->where('uac.affiliate_accountnumber',$account_num);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }


    public function getTransitTransferQueue() {
        $this->db->select('tt.*, mt.account_number, pt.reference_num', false);
        $this->db->from('transit_transfer tt');
        $this->db->join('its_payco_wallets its',' its.wallet_number = SUBSTR(tt.sender,4,10)', 'left');
        $this->db->join('manage_payco_registration mpr','mpr.id = its.mpr_id', 'left');
        $this->db->join('mt_accounts_set mt','mt.user_id = mpr.user_id', 'left');
        $this->db->join('partnership pt','pt.partner_id = mpr.user_id', 'left');
        $this->db->group_by('tt.referral_id');
        $this->db->order_by('tt.id','desc');
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getAccountDetailsByAcctNumber( $acctno , $type){
        if($type=='client'){
            $q = $this->db->select('*')
                ->from('mt_accounts_set a')
                ->join('users b', 'a.user_id = b.id', 'inner')
                ->join('user_profiles b', 'b.id = c.user_id', 'inner')
                ->where('a.account_number', $acctno);
            $ret['rows'] = $q->get()->result();
        }else{
            $q = $this->db->select('*')
                ->from('partnership a')
                ->join('users b', 'a.partner_id = b.id', 'inner')
                ->join('user_profiles b', 'b.id = c.user_id', 'inner')
                ->where('a.reference_num', $acctno);
            $ret['rows'] = $q->get()->result();
        }

        return $ret;
    }

    public function getTransitTransferDetailsByReferralId( $rfid ) {
        $this->db->from('transit_transfer');
        $this->db->where('referral_id',$rfid);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getFundRequestList() {
        $this->db->select('tt.*, mt.account_number, pt.reference_num', false);
        $this->db->from('transit_transfer tt');
        $this->db->join('its_payco_wallets its',' its.wallet_number = SUBSTR(tt.sender,4,10)', 'left');
        $this->db->join('manage_payco_registration mpr','mpr.id = its.mpr_id', 'left');
        $this->db->join('mt_accounts_set mt','mt.user_id = mpr.user_id', 'left');
        $this->db->join('partnership pt','pt.partner_id = mpr.user_id', 'left');
        $this->db->where('tt.request_from_affiliate',1);
        $this->db->where('tt.status',0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function getCurrencyByPayCoWallet($wallet) {
        $this->db->select('mt.account_number, mt.mt_currency_base, pt.currency, pt.reference_num, mpr.user_id, u.login_type, u.email, up.full_name', false);
        $this->db->from('its_payco_wallets its');
        $this->db->join('manage_payco_registration mpr','mpr.id = its.mpr_id','left');
        $this->db->join('mt_accounts_set mt','mt.user_id = mpr.user_id','left');
        $this->db->join('partnership pt','pt.partner_id = mpr.user_id','left');
        $this->db->join('users u','u.id = mpr.user_id','left');
        $this->db->join('user_profiles up','up.user_id = mpr.user_id','left');
        $this->db->where('its.wallet_number',$wallet);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    public function getPayCoRegistrationById($user_id) {
        $this->db->select('mpr.username, mpr.password, mpr.merchant_id, its.*');
        $this->db->from('manage_payco_registration mpr');
        $this->db->join('its_payco_wallets its','its.mpr_id = mpr.id','left');
        $this->db->where('mpr.user_id',$user_id);
        $this->db->group_by('its.mpr_id');
        $query = $this->db->get();
        if ($query->num_rows() > 1) {
            return $query->result_array();
        }
        return false;
    }

    public function getManageIP() {
        $this->db->select('manage_ip.*,user_profiles.full_name');
        $this->db->from('manage_ip');
        $this->db->join('user_profiles','manage_ip.user_id = user_profiles.user_id','left');
        $this->db->order_by('manage_ip.id',desc);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
}
?>