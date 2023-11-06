<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class General_model extends CI_Model
{	
	function __construct(){
		parent::__construct();
    

	}
    function difference_day($date1,$date2){
        $split1 = explode("-", $date1);
        $dates1  = $split1[2];	$month1 = $split1[1]; $year1  = $split1[0];

        $split2 = explode("-", $date2);
        $dates2 = $split2[2]; $month2 = $split2[1]; $year2 =  $split2[0];

        $gtj1 = GregorianToJD($month1, $dates1, $year1);
        $gtj2 = GregorianToJD($month2, $dates2, $year2);

        $diff_day = $gtj2 - $gtj1;

        return $diff_day;
    }
    public function FetchPagesRT($table,$limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by('Id','desc');
        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function FetchPages($table,$limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function showt4w1jx($table,$table2,$table3,$table4,$field2,$id2,$limit, $start,$select) {
        $this->db->distinct();
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' a',' ud.user_Id = a.user_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where("u.".$field2, 0);
        $this->db->where("CHARACTER_LENGTH(a.".'account_number) >', 5);
//        $this->db->or_where("u.".$field2, 2);
        $this->db->group_by('ud.user_Id');
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;

    }
    public function showt4w1jUV($table,$table2,$table3,$table4,$field2,$id2,$limit, $start,$select) {
        $this->db->distinct();
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' a',' ud.user_Id = a.user_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where("u.".$field2, $id2);
        $this->db->where("CHARACTER_LENGTH(a.".'account_number) >', 5);
        $this->db->group_by('ud.user_Id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;

    }
    public function showt4w1jxV($table,$table2,$table3,$table4,$field2,$id2,$limit, $start,$select) {
        $this->db->distinct();
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' a',' ud.user_Id = a.user_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where("u.".$field2, $id2);
        $this->db->where("CHARACTER_LENGTH(a.".'account_number) >', 5);

        $this->db->group_by('ud.user_Id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;

    }
    public function showt4w0jxUV($table,$table2,$table3,$table4,$field2,$id2,$limit, $start,$select) {
        $this->db->distinct();
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' a',' ud.user_Id = a.user_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where("u.".$field2, 0);
        $this->db->or_where("u.".$field2, 2);
        $this->db->group_by('ud.user_Id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function FetchJoinedTablePagesX($table,$table2,$table3,$field2,$id2,$limit, $start,$select) {
        $this->db->distinct();
        $this->db->limit($limit, $start);
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $where = " u.".$field2."='0' OR  u.".$field2."='2'";
        $this->db->where($where);
        $this->db->group_by('ud.user_Id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function showt4w0jxNotDistinctXUV($table,$table2,$table3,$table4,$field2,$id2,$limit, $start,$select) {
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' a',' ud.user_Id = a.user_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where("u.".$field2, 0);
        $this->db->or_where("u.".$field2, 2);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function showt4w0jxNotDistinctX($table,$table2,$table3,$table4,$field2,$id2,$limit, $start,$select) {
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' a',' ud.user_Id = a.user_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where("u.".$field2, 0);
        $this->db->or_where("u.".$field2, 2);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function FetchJoinedTablePagesNotDistinctX($table,$table2,$table3,$field2,$id2,$limit, $start,$select) {
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $where = " u.".$field2."='0' OR  u.".$field2."='2'";
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function FetchJoinedTablePages($table,$table2,$table3,$field2,$id2,$limit, $start,$select) {
        $this->db->distinct();
        $this->db->limit($limit, $start);
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->where('u.'.$field2,$id2 );
        $this->db->order_by('date_uploaded','desc');
        $this->db->group_by('ud.user_Id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function FetchJoinedTablePagesNotDistinct($table,$table2,$table3,$field2,$id2,$limit, $start,$select) {
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->where('u.'.$field2,$id2 );
        $this->db->order_by('date_uploaded','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function showt4w0jxNotDistinctXV($table,$table2,$table3,$table4,$field2,$id2,$limit, $start,$select) {
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' a',' ud.user_Id = a.user_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where('u.'.$field2,$id2 );
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function CountJoinedTableRecords($table,$table2,$table3,$field2,$id2) {
        $this->db->distinct();
        $this->db->select(' ud.user_Id');
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->where('u.'.$field2,$id2 );
        return  $this->db->count_all_results();

    }
    public function CountJoinedTableRecordsX($table,$table2,$table3,$field2,$id2) {
        $this->db->distinct();
        $this->db->select(' ud.user_Id');
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $where = " u.".$field2."='0' OR  u.".$field2."='2'";
        $this->db->where($where);
        return  $this->db->count_all_results();

    }
    public function countmy($table,$select,$where){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result_array();
        }
        return 0;
    }

    public function showPt4w1jx($table,$table2,$table3,$table4,$field2,$id2,$limit, $start,$select) {
        $this->db->distinct();
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' part',' ud.user_Id = part.partner_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where("part.dateregistered>", '2015-10-01 00:00:00');
        $this->db->where("u.".$field2, 0);
        $this->db->where("CHARACTER_LENGTH(part.".'reference_num) >', 5);
        $this->db->group_by('ud.user_Id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;

    }
    public function showPt4w1jUV($table,$table2,$table3,$table4,$field2,$id2,$limit, $start,$select) {
        $this->db->distinct();
        $this->db->select($select);
        $this->db->from($table.' ud');
        $this->db->join($table2.' u',' ud.user_Id = u.id');
        $this->db->join($table3.' p',' ud.user_Id = p.user_id');
        $this->db->join($table4.' part',' ud.user_Id = part.partner_id');
        $this->db->order_by('u.accountstatus','asc');
        $this->db->order_by('date_uploaded','desc');
        $this->db->where("u.".$field2, $id2);
        $this->db->where("part.dateregistered>", '2015-10-01 00:00:00');
        $this->db->where("CHARACTER_LENGTH(part.".'reference_num) >', 5);
        $this->db->group_by('ud.user_Id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;

    }

    public function CountRecords($table) {
        return $this->db->count_all($table);
    }

	function insert($table,$data){
		$this->db->insert($table,$data);
		return $this->db->insert_id();

	}
    function insertmy($table,$data){
        if ($this->db->insert($table, $data)){
            return $this->db->insert_id();
        }
        return false;
    }
	function update($table,$field,$id,$data){

        $this->db->trans_start();
		$this->db->where($field, $id);
		$this->db->update($table, $data);
            $this->db->trans_complete();
	}
        
        
    function updatemy($table,$field,$id,$data){
        $this->db->where($field, $id);
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }
    function updatemy2($table,$field,$id,$field2,$id2,$data){
        $this->db->where($field, $id);
        $this->db->where($field2, $id2);
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }
	function delete($table,$field,$id){
		$this->db->delete($table, array($field => $id));
	}
    function showlike($table,$field="",$id="",$select=""){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($field, 'FM'.$id);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    function showlike2($table,$field="",$id="",$select=""){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($field, $id);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    function showmy($table, $sort_by = null){
        if(!empty($sort_by)){
            $this->db->order_by('date_withdraw', 'DESC');
        }
        $query = $this->db->get($table);


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    function showsfields($table,$select=""){
        $this->db->select($select);
        $this->db->from($table);
        $query =  $this->db->get();
        return $query->result_array();
    }
    function show1st1w3($table,$field0="",$id0="",$field1="",$id1="",$field2="",$id2="",$select="",$order_by=""){
        $this->db->from($table);
        $this->db->where($field0, $id0);
        $this->db->where($field1, $id1);
        $this->db->where($field2, $id2);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->row_array();
        }else{
            return false;
        }
    }
    function show1st1w2($table,$field0="",$id0="",$field1="",$id1="",$field2="",$id2="",$select="",$order_by=""){
        $this->db->from($table);
        $this->db->where($field0, $id0);
        $this->db->where($field1, $id1);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->row_array();
        }else{
            return false;
        }
    }
    function showssingle($table,$field="",$id="",$select="",$order_by=""){

        $this->db->from($table);
        $this->db->where($field, $id);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->row_array();
        }else{
            return false;
        }
    }
    function showssingle2($table,$field="",$id="",$select="",$order_by=""){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($field, $id);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->row_array();
        }else{
            return false;
        }
    }
    function showssingle3($table,$field="",$id="",$field2="",$id2="",$select="",$order_by=""){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($field, $id);
        $this->db->where($field2, $id2);
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->row_array();
        }else{
            return false;
        }
    }

    function showt3w0j2($table1,$table2,$table3,$field="",$id="",$select="",$join12,$join23,$order){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2 ,$join12);
        $this->db->join($table3 ,$join23);
        $this->db->order_by($order,'desc');
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
    function showt3w1j2($table1,$table2,$table3,$field="",$id="",$select="",$join12,$join23,$order){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2 ,$join12);
        $this->db->join($table3 ,$join23);
        $this->db->where(array('created >'=>'2015-10-01 00:00:00'));
        $this->db->order_by($order,'desc');
        $data = $this->db->get();
        if($data->num_rows() > 0) {
            return $data->result_array();
        }else{
            return false;
        }
    }
	function show($table,$field="",$id="",$select="",$order_by=""){

        $this->db->trans_start();
		if(!$select){ $select ="*"; } $this->db->select($select);
		if($order_by){ $orderby = explode(',',$order_by); $this->db->order_by($orderby[0],$orderby[1]); } 
		if($id) { $result = $this->db->get_where($table, array($field => $id)); 
		} else { $result = $this->db->get($table);}
	
		return $result;
        $this->db->trans_complete();
	}
	function showWhere2($table,$field1="",$id1="",$field2="",$id2="",$order_by=""){

        $this->db->trans_start();
		$this->db->where($field1, $id1);
		$this->db->where($field2, $id2);
		if($order_by){ $orderby = explode(',',$order_by); $this->db->order_by($orderby[0],$orderby[1]); } 
		$result = $this->db->get($table);	
		return $result;
        $this->db->trans_complete();
	}

	function getTimezones($company_id=""){

		if($this->session->userdata('logged_in')){
            $localization = $this->show('locale_table','company_id',$this->session->userdata('company_id'));
        }else{
			$localization = $this->show('locale_table','company_id',$company_id);	
		}
		if($localization->num_rows() >0){
			$get_tz= $localization->row()->timezone;
				if($get_tz){
					$get_tzx = $get_tz;
					}else{			
					$get_tzx = ini_get('date.timezone');	
					}
			return date_default_timezone_set($get_tzx); 
		}

	}
	function numberFormat($number,$type=""){
	    $number = str_replace(" ","",$number);
		if($type =="nf1"){
			$number = number_format($number,2,".",","); 
		}else if($type =="nf2"){
			$number = number_format($number,2,".",", ");
			$number = str_replace(',',', ',$number);
		}else if($type =="nf3"){
			$number = number_format($number,2,"."," "); 
		}else if($type =="nf4"){
			$number = number_format($number,2,",","."); 
		}else if($type =="nf5"){
			$number = number_format($number,2,",",". "); 
			$number = str_replace('.','. ',$number);
		}else if($type =="nf6"){
			$number = number_format($number,2,","," "); 
		}else if($type =="nf7"){
			$number = number_format($number,0,"",""); 
		}else if($type =="nf8"){
			$number = number_format($number,0,"",","); 
		}else if($type =="nf9"){
			$number = number_format($number,0,"","."); 
		}else if($type =="nf10"){
			$number = number_format($number,0,""," "); 
		}
		return $number;

	}

	function dateFormat($date,$type=""){
		$exp = explode('-',$date);
		if((count($exp) == 3)&&($type !='')) {
			 $date = new DateTime($date);
			 $date = date_format($date, $type); 			
		}
		return $date;

	}
	function convertDateSql($date,$type=""){
		$exp = explode('/',$date);
		if(count($exp) == 3) {  
			if($type=="1"){               
				$date = $exp[2].'-'.$exp[0].'-'.$exp[1];    		// mm/dd/yy -> yy-mm-dd
			}else{
				$date = $exp[2].'-'.$exp[1].'-'.$exp[0];			// dd/mm/yy -> yy-mm-dd
			}
		}	
		return $date;

	}
	function convertDateStr($date,$type=""){
		$exp = explode('-',$date);
		if(count($exp) == 3) {		
			if($type=='1'){
				$date = $exp[1].'-'.$exp[2].'-'.$exp[0];  			//=> 08-29-2014
			}else if($type=='2'){				
				$d = $exp[2]; $p='';
				if(($d ==1)||($d ==21)||($d ==31)){
					$p = 'st'; 
				}else if(($d ==2)||($d ==22)){
					$p = 'nd';
				}else if(($d ==3)||($d ==23)){
					$p = 'rd';
				}else{
					$p = 'th';
				}
				$date = $exp[2].$p.' of '.$this->get_month($exp[1]).' '.$exp[0];  			//=> 17th of October 2014
			}
			else{
				$date = $exp[2].'/'.$exp[1].'/'.$exp[0];  			//=> 29/08/2014
			}
		}
		return $date;

	}
	function convertDtime($date_time,$type=""){

		$exp_date_time = explode(" ",$date_time);
		$get_date = $exp_date_time[0];	$get_time =$exp_date_time[1];
		
		$exp_date = explode("-",$get_date);
		$year =$exp_date[0];	$month =$exp_date[1]; $date =$exp_date[2];

		$exp_time = explode(":",$get_time);
		$hours =$exp_time[0]; $minute =$exp_time[1];
			
		if($type==""){	
			$new_date_time = $date."-".$month."-".$year." ".$get_time;								//=> 29-08-2014 08:03:22
		}else if($type==1){	
			$new_date_time = $year."-".$month."-".$date;											//=> 2014-08-27
		}else if($type==2){	
			$new_date_time = $date."/".$month."/".$year." ".date("g:i a", strtotime($get_time));  //=> 28/08/2014 11:18 am
		}
			return $new_date_time;

	}
	function differenceDay($date1,$date2){

		$split1 = explode("-", $date1);
		$dates1  = $split1[2];	$month1 = $split1[1]; $year1  = $split1[0];			 
							 
		$split2 = explode("-", $date2);
		$dates2 = $split2[2]; $month2 = $split2[1]; $year2 =  $split2[0];			
				 
		$gtj1 = GregorianToJD($month1, $dates1, $year1);
		$gtj2 = GregorianToJD($month2, $dates2, $year2);			 
							 
		$diff_day = $gtj2 - $gtj1;
				 
		return $diff_day;
    }

	function getMonth($month){
		switch ($month){
				case $month=='01':
					$month="January";
					break;
				case $month=='02':
					$month="February";
					break;
				case $month=='03':
					$month="March";
					break;
				case $month=='04':
					$month="April";
					break;
				case $month=='05':
					$month="May";
					break;
				case $month=='06':
					$month="June";
					break;
				case $month=='07':
					$month="July";
					break;
				case $month=='08':
					$month="August";
					break;
				case $month=='09':
					$month="September";
					break;
				case $month=='10':
					$month="October";
					break;
				case $month=='11':
					$month="November";
					break;
				case $month=='12':
					$month="December";
					break;
				}
		return $month;
	}
	function getCountries($country_id="")
    {
        $countries = array(
            "GB" => "United Kingdom",
           /* "US" => "United States",*/
            "AF" => "Afghanistan",
            "AL" => "Albania",
            "DZ" => "Algeria",
            "AS" => "American Samoa",
            "AD" => "Andorra",
            "AO" => "Angola",
            "AI" => "Anguilla",
            "AQ" => "Antarctica",
            "AG" => "Antigua And Barbuda",
            "AR" => "Argentina",
            "AM" => "Armenia",
            "AW" => "Aruba",
            "AU" => "Australia",
            "AT" => "Austria",
            "AZ" => "Azerbaijan",
            "BS" => "Bahamas",
            "BH" => "Bahrain",
            "BD" => "Bangladesh",
            "BB" => "Barbados",
            "BY" => "Belarus",
            "BE" => "Belgium",
            "BZ" => "Belize",
            "BJ" => "Benin",
            "BM" => "Bermuda",
            "BT" => "Bhutan",
            "BO" => "Bolivia",
            "BA" => "Bosnia And Herzegowina",
            "BW" => "Botswana",
            "BV" => "Bouvet Island",
            "BR" => "Brazil",
            "IO" => "British Indian Ocean Territory",
            "BN" => "Brunei Darussalam",
            "BG" => "Bulgaria",
            "BF" => "Burkina Faso",
            "BI" => "Burundi",
            "KH" => "Cambodia",
            "CM" => "Cameroon",
            "CA" => "Canada",
            "CV" => "Cape Verde",
            "KY" => "Cayman Islands",
            "CF" => "Central African Republic",
            "TD" => "Chad",
            "CL" => "Chile",
            "CN" => "China",
            "CX" => "Christmas Island",
            "CC" => "Cocos (Keeling) Islands",
            "CO" => "Colombia",
            "KM" => "Comoros",
            "CG" => "Congo",
            "CD" => "Congo, The Democratic Republic Of The",
            "CK" => "Cook Islands",
            "CR" => "Costa Rica",
            "CI" => "Cote D'Ivoire",
            "HR" => "Croatia (Local Name: Hrvatska)",
            "CU" => "Cuba",
            "CY" => "Cyprus",
            "CZ" => "Czech Republic",
            "DK" => "Denmark",
            "DJ" => "Djibouti",
            "DM" => "Dominica",
            "DO" => "Dominican Republic",
            "TP" => "East Timor",
            "EC" => "Ecuador",
            "EG" => "Egypt",
            "SV" => "El Salvador",
            "GQ" => "Equatorial Guinea",
            "ER" => "Eritrea",
            "EE" => "Estonia",
            "ET" => "Ethiopia",
            "FK" => "Falkland Islands (Malvinas)",
            "FO" => "Faroe Islands",
            "FJ" => "Fiji",
            "FI" => "Finland",
            "FR" => "France",
            "FX" => "France, Metropolitan",
            "GF" => "French Guiana",
            "PF" => "French Polynesia",
            "TF" => "French Southern Territories",
            "GA" => "Gabon",
            "GM" => "Gambia",
            "GE" => "Georgia",
            "DE" => "Germany",
            "GH" => "Ghana",
            "GI" => "Gibraltar",
            "GR" => "Greece",
            "GL" => "Greenland",
            "GD" => "Grenada",
            "GP" => "Guadeloupe",
            "GU" => "Guam",
            "GT" => "Guatemala",
            "GN" => "Guinea",
            "GW" => "Guinea-Bissau",
            "GY" => "Guyana",
            "HT" => "Haiti",
            "HM" => "Heard And Mc Donald Islands",
            "VA" => "Holy See (Vatican City State)",
            "HN" => "Honduras",
            "HK" => "Hong Kong",
            "HU" => "Hungary",
            "IS" => "Iceland",
            "IN" => "India",
            "ID" => "Indonesia",
            "IR" => "Iran (Islamic Republic Of)",
            "IQ" => "Iraq",
            "IE" => "Ireland",
            "IL" => "Israel",
            "IT" => "Italy",
            "JM" => "Jamaica",
            "JP" => "Japan",
            "JO" => "Jordan",
            "KZ" => "Kazakhstan",
            "KE" => "Kenya",
            "KI" => "Kiribati",
            "KP" => "Korea, Democratic People's Republic Of",
            /*"KR" => "Korea, Republic Of",*/
            "KW" => "Kuwait",
            "KG" => "Kyrgyzstan",
            "LA" => "Lao People's Democratic Republic",
            "LV" => "Latvia",
            "LB" => "Lebanon",
            "LS" => "Lesotho",
            "LR" => "Liberia",
            "LY" => "Libyan Arab Jamahiriya",
            "LI" => "Liechtenstein",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MO" => "Macau",
            "MK" => "Macedonia, Former Yugoslav Republic Of",
            "MG" => "Madagascar",
            "MW" => "Malawi",
            "MY" => "Malaysia",
            "MV" => "Maldives",
            "ML" => "Mali",
            "MT" => "Malta",
            "MH" => "Marshall Islands",
            "MQ" => "Martinique",
            "MR" => "Mauritania",
            "MU" => "Mauritius",
            "YT" => "Mayotte",
            "MX" => "Mexico",
            "FM" => "Micronesia, Federated States Of",
            "MD" => "Moldova, Republic Of",
            "MC" => "Monaco",
            "MN" => "Mongolia",
            "MS" => "Montserrat",
            "MA" => "Morocco",
            "MZ" => "Mozambique",
          /*  "MM" => "Myanmar",*/
            "NA" => "Namibia",
            "NR" => "Nauru",
            "NP" => "Nepal",
            "NL" => "Netherlands",
            "AN" => "Netherlands Antilles",
            "NC" => "New Caledonia",
            "NZ" => "New Zealand",
            "NI" => "Nicaragua",
            "NE" => "Niger",
            "NG" => "Nigeria",
            "NU" => "Niue",
            "NF" => "Norfolk Island",
            "MP" => "Northern Mariana Islands",
            "NO" => "Norway",
            "OM" => "Oman",
            "PK" => "Pakistan",
            "PW" => "Palau",
            "PA" => "Panama",
            "PG" => "Papua New Guinea",
            "PY" => "Paraguay",
            "PE" => "Peru",
            "PH" => "Philippines",
            "PN" => "Pitcairn",
            "PL" => "Poland",
            "PT" => "Portugal",
            "PR" => "Puerto Rico",
            "QA" => "Qatar",
            "RE" => "Reunion",
            "RO" => "Romania",
            "RU" => "Russian Federation",
            "RW" => "Rwanda",
            "KN" => "Saint Kitts And Nevis",
            "LC" => "Saint Lucia",
            "VC" => "Saint Vincent And The Grenadines",
            "WS" => "Samoa",
            "SM" => "San Marino",
            "ST" => "Sao Tome And Principe",
            "SA" => "Saudi Arabia",
            "SN" => "Senegal",
            "SC" => "Seychelles",
            "SL" => "Sierra Leone",
            "SG" => "Singapore",
            "SK" => "Slovakia (Slovak Republic)",
            "SI" => "Slovenia",
            "SB" => "Solomon Islands",
            "SO" => "Somalia",
            "ZA" => "South Africa",
            "GS" => "South Georgia, South Sandwich Islands",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SH" => "St. Helena",
            "PM" => "St. Pierre And Miquelon",
           /* "SD" => "Sudan",*/
            "SR" => "Suriname",
            "SJ" => "Svalbard And Jan Mayen Islands",
            "SZ" => "Swaziland",
            "SE" => "Sweden",
            "CH" => "Switzerland",
           /* "SY" => "Syrian Arab Republic",*/
            "TW" => "Taiwan",
            "TJ" => "Tajikistan",
            "TZ" => "Tanzania, United Republic Of",
            "TH" => "Thailand",
            "TG" => "Togo",
            "TK" => "Tokelau",
            "TO" => "Tonga",
            "TT" => "Trinidad And Tobago",
            "TN" => "Tunisia",
            "TR" => "Turkey",
            "TM" => "Turkmenistan",
            "TC" => "Turks And Caicos Islands",
            "TV" => "Tuvalu",
            "UG" => "Uganda",
            "UA" => "Ukraine",
            "AE" => "United Arab Emirates",
            "UM" => "United States Minor Outlying Islands",
            "UY" => "Uruguay",
            "UZ" => "Uzbekistan",
            "VU" => "Vanuatu",
            "VE" => "Venezuela",
            "VN" => "Viet Nam",
            "VG" => "Virgin Islands (British)",
            "VI" => "Virgin Islands (U.S.)",
            "WF" => "Wallis And Futuna Islands",
            "EH" => "Western Sahara",
            "YE" => "Yemen",
            "YU" => "Yugoslavia",
            "ZM" => "Zambia",
            "ZW" => "Zimbabwe"
        );
		if($country_id){ 
			return isset($countries[$country_id])?$countries[$country_id]:false;
		}else{
			return $countries;
			}			
	}
	function getCurrency($currency_id="")
    {
        $currency = array (
            'ALL' => 'Albania Lek',
            'AFN' => 'Afghanistan Afghani',
            'ARS' => 'Argentina Peso',
            'AWG' => 'Aruba Guilder',
            'AUD' => 'Australia Dollar',
            'AZN' => 'Azerbaijan New Manat',
            'BSD' => 'Bahamas Dollar',
            'BBD' => 'Barbados Dollar',
            'BDT' => 'Bangladeshi taka',
            'BYR' => 'Belarus Ruble',
            'BZD' => 'Belize Dollar',
            'BMD' => 'Bermuda Dollar',
            'BOB' => 'Bolivia Boliviano',
            'BAM' => 'Bosnia and Herzegovina Convertible Marka',
            'BWP' => 'Botswana Pula',
            'BGN' => 'Bulgaria Lev',
            'BRL' => 'Brazil Real',
            'BND' => 'Brunei Darussalam Dollar',
            'KHR' => 'Cambodia Riel',
            'CAD' => 'Canada Dollar',
            'KYD' => 'Cayman Islands Dollar',
            'CLP' => 'Chile Peso',
            'CNY' => 'China Yuan Renminbi',
            'COP' => 'Colombia Peso',
            'CRC' => 'Costa Rica Colon',
            'HRK' => 'Croatia Kuna',
            'CUP' => 'Cuba Peso',
            'CZK' => 'Czech Republic Koruna',
            'DKK' => 'Denmark Krone',
            'DOP' => 'Dominican Republic Peso',
            'XCD' => 'East Caribbean Dollar',
            'EGP' => 'Egypt Pound',
            'SVC' => 'El Salvador Colon',
            'EEK' => 'Estonia Kroon',
            'EUR' => 'Euro Member Countries',
            'FKP' => 'Falkland Islands (Malvinas) Pound',
            'FJD' => 'Fiji Dollar',
            'GHC' => 'Ghana Cedis',
            'GIP' => 'Gibraltar Pound',
            'GTQ' => 'Guatemala Quetzal',
            'GGP' => 'Guernsey Pound',
            'GYD' => 'Guyana Dollar',
            'HNL' => 'Honduras Lempira',
            'HKD' => 'Hong Kong Dollar',
            'HUF' => 'Hungary Forint',
            'ISK' => 'Iceland Krona',
            'INR' => 'India Rupee',
            'IDR' => 'Indonesia Rupiah',
            'IRR' => 'Iran Rial',
            'IMP' => 'Isle of Man Pound',
            'ILS' => 'Israel Shekel',
            'JMD' => 'Jamaica Dollar',
            'JPY' => 'Japan Yen',
            'JEP' => 'Jersey Pound',
            'KZT' => 'Kazakhstan Tenge',
            'KPW' => 'Korea (North) Won',
            'KRW' => 'Korea (South) Won',
            'KGS' => 'Kyrgyzstan Som',
            'LAK' => 'Laos Kip',
            'LVL' => 'Latvia Lat',
            'LBP' => 'Lebanon Pound',
            'LRD' => 'Liberia Dollar',
            'LTL' => 'Lithuania Litas',
            'MKD' => 'Macedonia Denar',
            'MYR' => 'Malaysia Ringgit',
            'MUR' => 'Mauritius Rupee',
            'MXN' => 'Mexico Peso',
            'MNT' => 'Mongolia Tughrik',
            'MZN' => 'Mozambique Metical',
            'NAD' => 'Namibia Dollar',
            'NPR' => 'Nepal Rupee',
            'ANG' => 'Netherlands Antilles Guilder',
            'NZD' => 'New Zealand Dollar',
            'NIO' => 'Nicaragua Cordoba',
            'NGN' => 'Nigeria Naira',
            'NOK' => 'Norway Krone',
            'OMR' => 'Oman Rial',
            'PKR' => 'Pakistan Rupee',
            'PAB' => 'Panama Balboa',
            'PYG' => 'Paraguay Guarani',
            'PEN' => 'Peru Nuevo Sol',
            'PHP' => 'Philippines Peso',
            'PLN' => 'Poland Zloty',
            'QAR' => 'Qatar Riyal',
            'RON' => 'Romania New Leu',
            'RUB' => 'Russia Ruble',
            'SHP' => 'Saint Helena Pound',
            'SAR' => 'Saudi Arabia Riyal',
            'RSD' => 'Serbia Dinar',
            'SCR' => 'Seychelles Rupee',
            'SGD' => 'Singapore Dollar',
            'SBD' => 'Solomon Islands Dollar',
            'SOS' => 'Somalia Shilling',
            'ZAR' => 'South Africa Rand',
            'LKR' => 'Sri Lanka Rupee',
            'SEK' => 'Sweden Krona',
            'CHF' => 'Switzerland Franc',
            'SRD' => 'Suriname Dollar',
            'SYP' => 'Syria Pound',
            'TWD' => 'Taiwan New Dollar',
            'THB' => 'Thailand Baht',
            'TTD' => 'Trinidad and Tobago Dollar',
            'TRY' => 'Turkey Lira',
            'TRL' => 'Turkey Lira',
            'TVD' => 'Tuvalu Dollar',
            'UAH' => 'Ukraine Hryvna',
            'GBP' => 'United Kingdom Pound',
            'USD' => 'United States Dollar',
            'UYU' => 'Uruguay Peso',
            'UZS' => 'Uzbekistan Som',
            'VEF' => 'Venezuela Bolivar',
            'VND' => 'Viet Nam Dong',
            'YER' => 'Yemen Rial',
            'ZWD' => 'Zimbabwe Dollar'
        );
		if($currency_id){ 
			return isset($currency[$currency_id])?$currency[$currency_id]:false;
		}else{
			return $currency;
			}
	}
    function getCurrencyV2($currency_id=""){

        /**commentend currencies are not availble in yahoo pair of date history */

        $currency = array (
            'ALL' => 'Albania Lek (ALL)',
//            'AFN' => 'Afghanistan Afghani (AFN)',
            'ARS' => 'Argentina Peso (ARS)',
            'AWG' => 'Aruba Guilder (AWG)',
            'AUD' => 'Australia Dollar (AUD)',
//            'AZN' => 'Azerbaijan New Manat (AZN)',
            'BSD' => 'Bahamas Dollar (BSD)',
            'BBD' => 'Barbados Dollar (BBD)',
            'BDT' => 'Bangladeshi taka (BDT)',
//            'BYR' => 'Belarus Ruble (BYR)',

            'BZD' => 'Belize Dollar (BZD)',
            'BMD' => 'Bermuda Dollar (BMD)',
            'BOB' => 'Bolivia Boliviano (BYR)',
//            'BAM' => 'Bosnia and Herzegovina Convertible Marka (BAM)',
            'BWP' => 'Botswana Pula (BWP)',
            'BGN' => 'Bulgaria Lev (BGN)',
            'BRL' => 'Brazil Real (BRL)',
            'BND' => 'Brunei Darussalam Dollar (BND)',
            'KHR' => 'Cambodia Riel (KHR)',
            'CAD' => 'Canada Dollar (CAD)',

            'KYD' => 'Cayman Islands Dollar (KYD)',
            'CLP' => 'Chile Peso (CLP)',
            'CNY' => 'China Yuan Renminbi (CNY)',
            'COP' => 'Colombia Peso (COP)',
            'CRC' => 'Costa Rica Colon (CRC)',
            'HRK' => 'Croatia Kuna (HRK)',
            'CUP' => 'Cuba Peso (CUP)',
            'CZK' => 'Czech Republic Koruna (CZK)',
            'DKK' => 'Denmark Krone (DKK)',
            'DOP' => 'Dominican Republic Peso (DOP)',

            'XCD' => 'East Caribbean Dollar (XCD)',
            'EGP' => 'Egypt Pound (EGP)',
            'SVC' => 'El Salvador Colon (SVC)',
//            'EEK' => 'Estonia Kroon (EEK)',
            'EUR' => 'Euro Member Countries (EUR)',
//            'FKP' => 'Falkland Islands (Malvinas) Pound(FKP)',
            'FJD' => 'Fiji Dollar (FJD)',
//            'GHC' => 'Ghana Cedis (GHC)',
//            'GIP' => 'Gibraltar Pound (GIP)',
            'GTQ' => 'Guatemala Quetzal (GTQ)',

//            'GGP' => 'Guernsey Pound (GGP)',
            'GYD' => 'Guyana Dollar (GYD)',
            'HNL' => 'Honduras Lempira (HNL)',
            'HKD' => 'Hong Kong Dollar (HKD)',
            'HUF' => 'Hungary Forint (HUF)',
            'ISK' => 'Iceland Krona (ISK)',
            'INR' => 'India Rupee (INR)',
            'IDR' => 'Indonesia Rupiah (IDR)',
//            'IRR' => 'Iran Rial (IRR)',
//            'IMP' => 'Isle of Man Pound (IMP)',

            'ILS' => 'Israel Shekel (ILS)',
            'JMD' => 'Jamaica Dollar (JMD)',
            'JPY' => 'Japan Yen (JPY)',
//            'JEP' => 'Jersey Pound (JEP)',
            'KZT' => 'Kazakhstan Tenge (KZT)',
//            'KPW' => 'Korea (North) Won (KPW)',
            'KRW' => 'Korea (South) Won (KRW)',
//            'KGS' => 'Kyrgyzstan Som (KGS)',
            'LAK' => 'Laos Kip (LAK)',
//            'LVL' => 'Latvia Lat (LVL)',

            'LBP' => 'Lebanon Pound (LBP)',
            'LRD' => 'Liberia Dollar (LRD)',
//            'LTL' => 'Lithuania Litas (LTL)',
            'MKD' => 'Macedonia Denar (MKD)',
            'MYR' => 'Malaysia Ringgit (MYR)',
            'MUR' => 'Mauritius Rupee (MUR)',
            'MXN' => 'Mexico Peso (MXN)',
//            'MNT' => 'Mongolia Tughrik (MNT)',
            'MZN' => 'Mozambique Metical (MZN)',
            'NAD' => 'Namibia Dollar (NAD)',
            'NPR' => 'Nepal Rupee (NPR)',

            'ANG' => 'Netherlands Antilles Guilder (ANG)',
            'NZD' => 'New Zealand Dollar (NZD)',
            'NIO' => 'Nicaragua Cordoba (NIO)',
            'NGN' => 'Nigeria Naira (NGN)',
            'NOK' => 'Norway Krone (NOK)',
            'OMR' => 'Oman Rial (OMR)',
            'PKR' => 'Pakistan Rupee (PKR)',
            'PAB' => 'Panama Balboa (PAB)',
            'PYG' => 'Paraguay Guarani (PYG)',
            'PEN' => 'Peru Nuevo Sol (PEN)',

            'PHP' => 'Philippines Peso (PHP)',
            'PLN' => 'Poland Zloty (PLN)',
            'QAR' => 'Qatar Riyal (QAR)',
            'RON' => 'Romania New Leu (RON)',
            'RUB' => 'Russia Ruble (RUB)',
            'SHP' => 'Saint Helena Pound (SHP)',
            'SAR' => 'Saudi Arabia Riyal (SAR)',
            'RSD' => 'Serbia Dinar (RSD)',
            'SCR' => 'Seychelles Rupee (SCR)',
            'SGD' => 'Singapore Dollar (SGD)',
//            'SBD' => 'Solomon Islands Dollar (SBD)',

            'SOS' => 'Somalia Shilling (SOS)',
            'ZAR' => 'South Africa Rand (ZAR)',
            'LKR' => 'Sri Lanka Rupee (LKR)',
            'SEK' => 'Sweden Krona (SEK)',
            'CHF' => 'Switzerland Franc (CHF)',
//            'SRD' => 'Suriname Dollar (SRD)',
//            'SYP' => 'Syria Pound (SYP)',
            'TWD' => 'Taiwan New Dollar (TWD)',
            'THB' => 'Thailand Baht (THB)',
            'TTD' => 'Trinidad and Tobago Dollar (TTD)',

            'TRY' => 'Turkey Lira (TRY)',
//            'TRL' => 'Turkey Lira (TRL)',
//            'TVD' => 'Tuvalu Dollar (TVD)',
            'UAH' => 'Ukraine Hryvna (UAH)',
            'GBP' => 'United Kingdom Pound (GBP)',
            'USD' => 'United States Dollar (USD)',
            'UYU' => 'Uruguay Peso (UYU)',
            'UZS' => 'Uzbekistan Som (UZS)',
            'VEF' => 'Venezuela Bolivar (VEF)',
            'VND' => 'Viet Nam Dong (VND)',
            'YER' => 'Yemen Rial (YER)',
//            'ZWD' => 'Zimbabwe Dollar (ZWD)'
        );
        if($currency_id){
            return isset($currency[$currency_id])?$currency[$currency_id]:false;
        }else{
            return $currency;
        }
    }

    function sendEmail($file_name, $subject, $email, $data,$configemail=null)
    {
        $this->config->load('tank_auth');
        $this->load->library('email');
        if($configemail != null){
            $this->email->initialize($configemail);
        }
        $this->SMTPDebug =1;
        $this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
        $this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($this->load->view('email/'.$file_name, $data, TRUE));
        $this->email->send();

    }

    function getCallingCode($country_code){
        $countryCallingCodes = array
        (
            'Afghanistan' => '93',
            'Albania' => '355',
            'Algeria' => '213',
            'American Samoa' => '1 684',
            'Andorra' => '376',
            'Angola' => '244',
            'Anguilla' => '1264',
            'Antarctica' => '672',
            'Antigua And Barbuda' => '1268',
            'Antilles, Netherlands' => '599',
            'Argentina' => '54',
            'Armenia' => '374',
            'Aruba' => '297',
            'Australia' => '61',
            'Austria' => '43',
            'Azerbaijan' => '994',
            'Bahamas' => '1242',
            'Bahrain' => '973',
            'Bangladesh' => '880',
            'Barbados' => '1246',
            'Belarus' => '375',
            'Belgium' => '375',
            'Belize' => '501',
            'Benin' => '229',
            'Bermuda' => '1 441',
            'Bhutan' => '975',
            'Bolivia' => '591',
            'Bosnia And Herzegowina' => '387',
            'Botswana' => '267',
            'Brazil' => '55',
            'British Indian Ocean Territory' => '246',
            'British Virgin Islands' => '1 284',
            'Brunei Darussalam' => '673',
            'Bulgaria' => '359',
            'Burkina Faso' => '226',
            'Burundi' => '257',
            'Cambodia' => '855',
            'Cameroon' => '237',
            'Canada' => '1',
            'Cape Verde' => '238',
            'Cayman Islands' => '1 345',
            'Central African Republic' => '236',
            'Chad' => '235',
            'Chile' => '56',
            'China' => '86',
            'Christmas Island' => '64',
            'Cocos (Keeling) Islands' => '61',
            'Colombia' => '57',
            'Comoros' => '269',
            'Congo' => '242',
            'Cook Islands' => '682',
            'Costa Rica' => '506',
            'Cote D\'Ivoire' => '225',
            'Croatia' => '385',
            'Cuba' => '53',
            'Cyprus' => '357',
            'Czech Republic' => '420',
            'Denmark' => '45',
            'Djibouti' => '253',
            'Dominica' => '1 767',
            'Dominican Republic' => '1 809',
            'East Timor (Timor-Leste)' => '670',
            'Ecuador' => '593',
            'Egypt' => '20',
            'El Salvador' => '503',
            'Equatorial Guinea' => '240',
            'Eritrea' => '291',
            'Estonia' => '372',
            'Ethiopia' => '251',
            'Falkland Islands (Malvinas)' => '500',
            'Faroe Islands' => '298',
            'Fiji' => '679',
            'Finland' => '358',
            'France' => '33',
            'French Guiana' => '594',
            'French Polynesia' => '689',
            'Gabon' => '241',
            'Gambia, the' => '220',
            'Georgia' => '995',
            'Germany' => '49',
            'Ghana' => '233',
            'Gibraltar' => '350',
            'Greece' => '30',
            'Greenland' => '299',
            'Grenada' => '1 473',
            'Guadeloupe' => '590',
            'Guam' => '1 671',
            'Guatemala' => '502',
            'Guernsey and Alderney' => '5399',
            'Guinea' => '224',
            'Guinea-Bissau' => '245',
            'Guinea, Equatorial' => '240',
            'Guiana, French' => '594',
            'Guyana' => '592',
            'Haiti' => '509',
            'Holy See (Vatican City State)' => '379',
            'Holland' => '31',
            'Honduras' => '504',
            'Hong Kong, (China)' => '852',
            'Hungary' => '36',
            'Iceland' => '354',
            'India' => '91',
            'Indonesia' => '62',
            'Iran' => '98',
            'Iraq' => '964',
            'Ireland' => '353',
            'Isle of Man' => '44',
            'Israel' => '972',
            'Italy' => '39',
            'Jamaica' => '1 876',
            'Japan' => '81',
            'Jersey' => '44',
            'Jordan' => '962',
            'Kazakhstan' => '7',
            'Kenya' => '254',
            'Kiribati' => '686',
            'Korea(North)' => '850',
            'Korea(South)' => '82',
            'Kosovo' => '381',
            'Kuwait' => '965',
            'Kyrgyzstan' => '996',
            'Lao People\'s Democratic Republic' => '856',
            'Latvia' => '371',
            'Lebanon' => '961',
            'Lesotho' => '266',
            'Liberia' => '231',
            'Libyan Arab Jamahiriya' => '218',
            'Liechtenstein' => '423',
            'Lithuania' => '370',
            'Luxembourg' => '352',
            'Macao, (China)' => '853',
            'Macedonia, TFYR' => '389',
            'Madagascar' => '261',
            'Malawi' => '265',
            'Malaysia' => '60',
            'Maldives' => '960',
            'Mali' => '223',
            'Malta' => '356',
            'Marshall Islands' => '692',
            'Martinique' => '596',
            'Mauritania' => '222',
            'Mauritius' => '230',
            'Mayotte' => '262',
            'Mexico' => '52',
            'Micronesia' => '691',
            'Moldova' => '373',
            'Monaco' => '377',
            'Mongolia' => '976',
            'Montenegro' => '382',
            'Montserrat' => '1 664',
            'Morocco' => '212',
            'Mozambique' => '258',
            'Myanmar' => '95',
            'Namibia' => '264',
            'Nauru' => '674',
            'Nepal' => '977',
            'Netherlands' => '31',
            'Netherlands Antilles' => '599',
            'New Caledonia' => '687',
            'New Zealand' => '64',
            'Nicaragua' => '505',
            'Niger' => '227',
            'Nigeria' => '234',
            'Niue' => '683',
            'Norfolk Island' => '672',
            'Northern Mariana Islands' => '1 670',
            'Norway' => '47',
            'Oman' => '968',
            'Pakistan' => '92',
            'Palau' => '680',
            'Palestinian Territory' => '970',
            'Panama' => '507',
            'Papua New Guinea' => '675',
            'Paraguay' => '595',
            'Peru' => '51',
            'Philippines' => '63',
            'Pitcairn Island' => '872',
            'Poland' => '48',
            'Portugal' => '351',
            'Puerto Rico' => '1787',
            'Qatar' => '974',
            'Reunion' => '262',
            'Romania' => '40',
            'Russia' => '7',
            'Rwanda' => '250',
            'Sahara' => '212',
            'Saint Helena' => '290',
            'Saint Kitts and Nevis' => '1869',
            'Saint Lucia' => '1758',
            'Saint Pierre and Miquelon' => '508',
            'Saint Vincent and the Grenadines' => '1784',
            'Samoa' => '685',
            'San Marino' => '374',
            'Sao Tome and Principe' => '239',
            'Saudi Arabia' => '966',
            'Senegal' => '221',
            'Serbia' => '381',
            'Seychelles' => '248',
            'Sierra Leone' => '232',
            'Singapore' => '65',
            'Slovakia' => '421',
            'Slovenia' => '386',
            'Solomon Islands' => '677',
            'Somalia' => '252',
            'South Africa' => '27',
            'S. Georgia and S. Sandwich Is.' => '500',
            'Spain' => '34',
            'Sri Lanka (ex-Ceilan)' => '94',
            'Sudan' => '249',
            'Suriname' => '597',
            'Svalbard and Jan Mayen Islands' => '79',
            'Swaziland' => '41',
            'Sweden' => '46',
            'Switzerland' => '41',
            'Syrian Arab Republic' => '963',
            'Taiwan' => '886',
            'Tajikistan' => '992',
            'Tanzania' => '255',
            'Thailand' => '66',
            'Timor-Leste (East Timor)' => '670',
            'Togo' => '228',
            'Tokelau' => '690',
            'Tonga' => '676',
            'Trinidad and Tobago' => '1 868',
            'Tunisia' => '216',
            'Turkey' => '90',
            'Turkmenistan' => '993',
            'Turks and Caicos Islands' => '1 649',
            'Tuvalu' => '688',
            'Uganda' => '256',
            'Ukraine' => '380',
            'United Arab Emirates' => '971',
            'United Kingdom' => '44',
            'United States' => '1',
            'US Minor Outlying Islands' => '808',
            'Uruguay' => '598',
            'Uzbekistan' => '998',
            'Vanuatu' => '678',
            'Vatican City State (Holy See)' => '379',
            'Venezuela' => '58',
            'Viet Nam' => '84',
            'Virgin Islands, British' => '1284',
            'Virgin Islands, U.S.' => '1340',
            'Wallis and Futuna' => '681',
            'Western Sahara' => '212',
            'Yemen' => '967',
            'Zambia' => '260',
            'Zimbabwe' => '263',
        );

       $country_name = $this->getCountries($country_code);

        return isset($countryCallingCodes[$country_name])?$countryCallingCodes[$country_name]:false;


    }

    function getLanguage($id){
        $language_codes = array(
            'en' => 'English' ,
            'aa' => 'Afar',
            'ab' => 'Abkhazian' ,
            'af' => 'Afrikaans' ,
            'am' => 'Amharic' ,
            'ar' => 'Arabic' ,
            'as' => 'Assamese' ,
            'ay' => 'Aymara' ,
            'az' => 'Azerbaijani' ,
            'ba' => 'Bashkir' ,
            'be' => 'Byelorussian' ,
            'bg' => 'Bulgarian' ,
            'bh' => 'Bihari' ,
            'bi' => 'Bislama' ,
            'bn' => 'Bengali/Bangla' ,
            'bo' => 'Tibetan' ,
            'br' => 'Breton' ,
            'ca' => 'Catalan' ,
            'co' => 'Corsican' ,
            'cs' => 'Czech' ,
            'cy' => 'Welsh' ,
            'da' => 'Danish' ,
            'de' => 'German' ,
            'dz' => 'Bhutani' ,
            'el' => 'Greek' ,
            'eo' => 'Esperanto' ,
            'es' => 'Spanish' ,
            'et' => 'Estonian' ,
            'eu' => 'Basque' ,
            'fa' => 'Persian' ,
            'fi' => 'Finnish' ,
            'fj' => 'Fiji' ,
            'fo' => 'Faeroese' ,
            'fr' => 'French' ,
            'fy' => 'Frisian' ,
            'ga' => 'Irish' ,
            'gd' => 'Scots/Gaelic' ,
            'gl' => 'Galician' ,
            'gn' => 'Guarani' ,
            'gu' => 'Gujarati' ,
            'ha' => 'Hausa' ,
            'hi' => 'Hindi' ,
            'hr' => 'Croatian' ,
            'hu' => 'Hungarian' ,
            'hy' => 'Armenian' ,
            'ia' => 'Interlingua' ,
            'ie' => 'Interlingue' ,
            'ik' => 'Inupiak' ,
            'in' => 'Indonesian' ,
            'is' => 'Icelandic' ,
            'it' => 'Italian' ,
            'iw' => 'Hebrew' ,
            'ja' => 'Japanese' ,
            'ji' => 'Yiddish' ,
            'jw' => 'Javanese' ,
            'ka' => 'Georgian' ,
            'kk' => 'Kazakh' ,
            'kl' => 'Greenlandic' ,
            'km' => 'Cambodian' ,
            'kn' => 'Kannada' ,
            'ko' => 'Korean' ,
            'ks' => 'Kashmiri' ,
            'ku' => 'Kurdish' ,
            'ky' => 'Kirghiz' ,
            'la' => 'Latin' ,
            'ln' => 'Lingala' ,
            'lo' => 'Laothian' ,
            'lt' => 'Lithuanian' ,
            'lv' => 'Latvian/Lettish' ,
            'mg' => 'Malagasy' ,
            'mi' => 'Maori' ,
            'mk' => 'Macedonian' ,
            'ml' => 'Malayalam' ,
            'mn' => 'Mongolian' ,
            'mo' => 'Moldavian' ,
            'mr' => 'Marathi' ,
            'ms' => 'Malay' ,
            'mt' => 'Maltese' ,
            'my' => 'Burmese' ,
            'na' => 'Nauru' ,
            'ne' => 'Nepali' ,
            'nl' => 'Dutch' ,
            'no' => 'Norwegian' ,
            'oc' => 'Occitan' ,
            'om' => '(Afan)/Oromoor/Oriya' ,
            'pa' => 'Punjabi' ,
            'pl' => 'Polish' ,
            'ps' => 'Pashto/Pushto' ,
            'pt' => 'Portuguese' ,
            'qu' => 'Quechua' ,
            'rm' => 'Rhaeto-Romance' ,
            'rn' => 'Kirundi' ,
            'ro' => 'Romanian' ,
            'ru' => 'Russian' ,
            'rw' => 'Kinyarwanda' ,
            'sa' => 'Sanskrit' ,
            'sd' => 'Sindhi' ,
            'sg' => 'Sangro' ,
            'sh' => 'Serbo-Croatian' ,
            'si' => 'Singhalese' ,
            'sk' => 'Slovak' ,
            'sl' => 'Slovenian' ,
            'sm' => 'Samoan' ,
            'sn' => 'Shona' ,
            'so' => 'Somali' ,
            'sq' => 'Albanian' ,
            'sr' => 'Serbian' ,
            'ss' => 'Siswati' ,
            'st' => 'Sesotho' ,
            'su' => 'Sundanese' ,
            'sv' => 'Swedish' ,
            'sw' => 'Swahili' ,
            'ta' => 'Tamil' ,
            'te' => 'Tegulu' ,
            'tg' => 'Tajik' ,
            'th' => 'Thai' ,
            'ti' => 'Tigrinya' ,
            'tk' => 'Turkmen' ,
            'tl' => 'Tagalog' ,
            'tn' => 'Setswana' ,
            'to' => 'Tonga' ,
            'tr' => 'Turkish' ,
            'ts' => 'Tsonga' ,
            'tt' => 'Tatar' ,
            'tw' => 'Twi' ,
            'uk' => 'Ukrainian' ,
            'ur' => 'Urdu' ,
            'uz' => 'Uzbek' ,
            'vi' => 'Vietnamese' ,
            'vo' => 'Volapuk' ,
            'wo' => 'Wolof' ,
            'xh' => 'Xhosa' ,
            'yo' => 'Yoruba' ,
            'zh' => 'Chinese' ,
            'zu' => 'Zulu' ,
        );
        if($language_codes){
            return isset($language_codes[$id])?$language_codes[$id]:false;
        }else{
            return $language_codes;
        }
    }

    function get_currency3($currency_id=""){
        $currency = array (
            'ALL' => 'ALL',
            'AFN' => 'AFN',
            'ARS' => 'ARS',
            'AWG' => 'AWG',
            'AUD' => 'AUD',
            'AZN' => 'AZN',
            'BSD' => 'BSD',
            'BBD' => 'BBD',
            'BDT' => 'BDT',
            'BYR' => 'BYR',
            'BZD' => 'BZD',
            'BMD' => 'BMD',
            'BOB' => 'BOB',
            'BAM' => 'BAM',
            'BWP' => 'BWP',
            'BGN' => 'BGN',
            'BRL' => 'BRL',
            'BND' => 'BND',
            'KHR' => 'KHR',
            'CAD' => 'CAD',
            'KYD' => 'KYD',
            'CLP' => 'CLP',
            'CNY' => 'CNY',
            'COP' => 'COP',
            'CRC' => 'CRC',
            'HRK' => 'HRK',
            'CUP' => 'CUP',
            'CZK' => 'CZK',
            'DKK' => 'DKK',
            'DOP' => 'DOP',
            'XCD' => 'XCD', // missing
            'EGP' => 'EGP',
            'SVC' => 'SVC',
            'EEK' => 'EEK', //missing
            'EUR' => 'EUR', // fix the flag
            'FKP' => 'FKP',
            'FJD' => 'FJD',
            'GHC' => 'GHC', // missing
            'GIP' => 'GIP',
            'GTQ' => 'GTQ',
            'GGP' => 'GGP',
            'GYD' => 'GYD',
            'HNL' => 'HNL',
            'HKD' => 'HKD',
            'HUF' => 'HUF',
            'ISK' => 'ISK',
            'INR' => 'INR',
            'IDR' => 'IDR',
            'IRR' => 'IRR',
            'IMP' => 'IMP', //missing
            'ILS' => 'ILS',
            'JMD' => 'JMD',
            'JPY' => 'JPY',
            'JEP' => 'JEP', //missing
            'KZT' => 'KZT',
            'KPW' => 'KPW',
            'KRW' => 'KRW',
            'KGS' => 'KGS',
            'LAK' => 'LAK',
            'LVL' => 'LVL',
            'LBP' => 'LBP',
            'LRD' => 'LRD',
            'LTL' => 'LTL',
            'MKD' => 'MKD',
            'MYR' => 'MYR',
            'MUR' => 'MUR',
            'MXN' => 'MXN',
            'MNT' => 'MNT',
            'MZN' => 'MZN', // missing Currency
            'NAD' => 'NAD',
            'NPR' => 'NPR',
            'ANG' => 'ANG',  //EUR
            'NZD' => 'NZD',
            'NIO' => 'NIO',
            'NGN' => 'NGN',
            'NOK' => 'OMR',
            'OMR' => 'OMR',
            'PKR' => 'PKR',
            'PAB' => 'PAB',
            'PYG' => 'PYG',
            'PEN' => 'PEN',
            'PHP' => 'PHP',
            'PLN' => 'PLN',
            'QAR' => 'QAR',
            'RON' => 'RON',
            'RUB' => 'RUB',
            'SHP' => 'SHP',
            'SAR' => 'SAR',
            'RSD' => 'RSD',
            'SCR' => 'SCR',
            'SGD' => 'SGD',
            'SBD' => 'SBD',
            'SOS' => 'SOS',
            'ZAR' => 'ZAR',
            'LKR' => 'LKR',
            'SEK' => 'SEK',
            'CHF' => 'CHF',
            'SRD' => 'SRD',
            'SYP' => 'SYP',
            'TWD' => 'TWD',
            'THB' => 'THB',
            'TTD' => 'TTD',
            'TRY' => 'TRY',
            'TRL' => 'TRL',
            'TVD' => 'TVD',
            'UAH' => 'UAH',
            'GBP' => 'GBP',
            'USD' => 'USD',
            'UYU' => 'UYU',
            'UZS' => 'UZS',
            'VEF' => 'VEF',
            'VND' => 'VND',
            'YER' => 'YER',
            'ZWD' => 'ZWD'
        );
        if($currency_id){
            return isset($currency[$currency_id])?$currency[$currency_id]:false;
        }else{
            return $currency;
        }
    }
    function getCurrenciesPair($currency_id=""){
        $currency = array (

            'AUD/CAD' => 'AUD/CAD',
            'AUD/CHF' => 'AUD/CHF',
            'AUD/JPY' => 'AUD/JPY',
            'AUD/NZD' => 'AUD/NZD',
            'AUD/USD' => 'AUD/USD', //5

            'BGN/RON' => 'BGN/RON',
            'CAD/CHF' => 'CAD/CHF',
            'CAD/JPY' => 'CAD/JPY',
            'CHF/BGN' => 'CHF/BGN',
            'CHF/JPY' => 'CHF/JPY', //10

            'CHF/RON' => 'CHF/RON',
            'CHF/TRY' => 'CHF/TRY',
            'EUR/AUD' => 'EUR/AUD',
            'EUR/CAD' => 'EUR/CAD',
            'EUR/CHF' => 'EUR/CHF', //15

            'EUR/CZK' => 'EUR/CZK',
            'EUR/DKK' => 'EUR/DKK',
            'EUR/GBP' => 'EUR/GBP',
            'EUR/HKD' => 'EUR/HKD',
            'EUR/HUF' => 'EUR/HUF', // 20

            'EUR/ILS' => 'EUR/ILS',
            'GBP/NZD' => 'GBP/NZD',
            'GBP/PLN' => 'GBP/PLN',
            'GBP/RON' => 'GBP/RON',
            'GBP/SEK' => 'GBP/SEK', // 25

            'GBP/SGD' => 'GBP/SGD',
            'GBP/TRY' => 'GBP/TRY',
            'GBP/USD' => 'GBP/USD',
            'GBP/ZAR' => 'GBP/ZAR',
            'HKD/JPY' => 'HKD/JPY', //30

            'NZD/CAD' => 'NZD/CAD',
            'NZD/CHF' => 'NZD/CHF',
            'NZD/JPY' => 'NZD/JPY',
            'NZD/USD' => 'NZD/USD',
            'SGD/HKD' => 'SGD/HKD', //35

            'SGD/JPY' => 'SGD/JPY',
            'TRY/BGN' => 'TRY/BGN',
            'TRY/JPY' => 'TRY/JPY',
            'TRY/RON' => 'TRY/RON',
            'USD/BGN' => 'USD/BGN', //40

            'USD/CAD' => 'USD/CAD',
            'USD/CHF' => 'USD/CHF',
            'USD/CZK' => 'USD/CZK',
            'USD/DKK' => 'USD/DKK',
            'USD/HKD' => 'USD/HKD', //45

            'USD/HUF' => 'USD/HUF',
            'USD/ILS' => 'USD/ILS',
            'USD/JPY' => 'USD/JPY',
            'USD/MXN' => 'USD/MXN',
            'USD/NOK' => 'USD/NOK', //50

            'USD/PLN' => 'USD/PLN',
            'USD/RON' => 'USD/RON',
            'USD/RUB' => 'USD/RUB',
            'USD/SEK' => 'USD/SEK',
            'USD/SGD' => 'USD/SGD', //55

            'USD/TRY' => 'USD/TRY',
            'USD/ZAR' => 'USD/ZAR', //57

        );
        if($currency_id){
            return isset($currency[$currency_id])?$currency[$currency_id]:false;
        }else{
            return $currency;
        }
    }
    function getAccountType($id=null){

        $data= array(
            '1' =>"ForexMart Standard",
            '2' => "ForexMart Zero Spread",
            '4' => "ForexMart Micro Account"
        );
        
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }

    function getMTAccountType( $id ){
        $data= array(
            '0' => "Demo",
            '1' => "Live"
        );

        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }
    }

    public function getPartnershipCurrency($id=null){
        $data= array(
            'EUR' =>"EUR",
            'USD' => "USD",
            'GBP' => "GBP",
            'RUB' => "RUB",
        );

        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }
    }
    function getAccountCurrencyBase($id=null){

        $data= array(
            'EUR' =>"EUR",
            'USD' => "USD",
            'GBP' => "GBP",
            'RUB' => "RUB",
        );

        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }
    }

    function getLeverage($id=null){

        $data= array(
            '1:1' =>"1:1",
            '1:2' => "1:2",
            '1:3' => "1:3",
            '1:5' => "1:5",
            '1:10' => "1:10",
            '1:20' => "1:20",
            '1:25' => "1:25",
            '1:50' => "1:50",
            '1:100' => "1:100",
            '1:200' => "1:200",
            '1:300' => "1:300",
            '1:400' => "1:400",
            '1:500' => "1:500",
            '1:1000' => "1:1000",
            '1:3000' => "1:3000"
        );

        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getAmount($id=null){

        $data= array(
            '500' =>"500",
            '1000' => "1000",
            '3000' => "3000",
            '5000' => "5000",
            '10000' => "10000",
            '25000' => "25000",
            '50000' => "50000",
            '100000' => "100000",
            '500000' => "500000"

        );

        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getEmploymentStatus($id=null){
        $data= array( "Employed","Self-employed","Retired","Student","Unemployed");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getIndustry($id=null){
        $data= array( "Accountancy","Admin/Secretarial","Agriculture","Finance Services - Banking","Catering/Hospitality","Creative/Media","Education","Emergency Services","Engineering","Financial Services - Others","Health/Medicine","HM Forces",
            "HR","Financial Services - Insurance","IT","Legal","Leisure/Entertainment/Tourism","Manufacturing","Marketing/PR/Advertising","Pharmaceuticals",
            "Property/Constructions/Trades","Retail","Sales","Social Care/Services","Telecommunications","Transport/Logistics","Others");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getSourceOfFunds($id=null){
        $data= array( "Savings/Investments","Partner/Parent/Family","Benefits/Borrowing","Private Pension","State Pension","Other");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getEstimatedAnnualIncome($id=null){
        $data= array( ">100,000","50,000 - 100,000","10,000 - 50,000","<10,000");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getEstimatedNetWorth($id=null){
        $data= array( ">100,000","50,000 - 100,000","10,000 - 50,000","<10,000");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getInvestmentKnowledge($id=null){
        $data= array( "Non-Existing","Limited","Fair","Excellent");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getEducationLevel($id=null){
        $data= array( "Elementary","High School","College/University","Masters/PHD","Professional Qualification");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getTradeDuration($id=null){
        $data= array( "Daily","Weekly","Monthly");
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }
    }

    function selectOptionList($data,$selected_val=null){
        $selectOption="";
        if(is_array($data)){

            foreach($data as $key=>$d){
                $selected = $selected_val == $key ? "selected":"";
                $selectOption= $selectOption."<option ".$selected." value='".$key."'>".$d."</option>";
            }
        }
        return $selectOption;
    }

    function getPartnersStatusType($id=null){

        $data= array(
            '1' => "Individual",
            '2' => "Company"
        );

        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }

    public function getOptionMailer($table){
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getLanguagesMailer(){
        $this->db->select('settingslanguage.Language,settingslanguage.Id');
        $this->db->from('mailer');
        $this->db->join('settingslanguage', 'settingslanguage.Id = mailer.Language', 'left');
        $this->db->group_by('settingslanguage.Language');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getMailerByLanguage($lang){
        $this->db->select('*, mailer.Id');
        $this->db->from('mailer');
        $this->db->join('settingsscheme', 'mailer.Scheme = settingsscheme.Id', 'inner');
        $this->db->where('mailer.Language', $lang);
        $this->db->order_by('mailer.Id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getLanguageIdByText($lang){
        $this->db->select('Id')
            ->from('settingslanguage')
            ->where('Language', $lang);

        $result = $this->db->get();
        if($result->num_rows() > 0 ){
            return $result->row_array();
        }else{
            return false;
        }
    }

    public function getMailer(){
        $this->db->select('*, mailer.Id');
        $this->db->from('mailer');
        $this->db->join('settingsreplyto', 'mailer.ReplyTo = settingsreplyto.Id', 'inner');
        $this->db->join('settingsscheme', 'mailer.Scheme = settingsscheme.Id', 'inner');
        $this->db->join('settingslanguage', 'mailer.Language = settingslanguage.Id', 'inner');
        $this->db->order_by('mailer.Id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }
    public function getMailerById($mailerId){
        $this->db->select('*, mailer.Id');
        $this->db->from('mailer');
        $this->db->join('settingsreplyto', 'mailer.ReplyTo = settingsreplyto.Id', 'inner');
        $this->db->join('settingsscheme', 'mailer.Scheme = settingsscheme.Id', 'inner');
        $this->db->join('settingslanguage', 'mailer.Language = settingslanguage.Id', 'inner');
        $this->db->where('mailer.id', $mailerId);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getAllMailer(){
        $this->db->select('mailer_scheduler.*, mailer.NameOfMailing,settingslanguage.Language');
        $this->db->from('mailer_scheduler');
        $this->db->join('mailer', 'mailer.Id = mailer_scheduler.mailer', 'inner');
        $this->db->join('settingslanguage', 'mailer.Language = settingslanguage.Id', 'inner');
        $this->db->order_by('mailer_scheduler.date_added', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    public function getRecipientsByMailerId($mailer_id){
        $this->db->select('recipients');
        $this->db->from('mailer_scheduler');
        $this->db->where('Id', $mailer_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }

    }

    function getMailbox($id=null){

        $data= array(
            'noreply@contact.forexmart.com' =>"noreply@contact.forexmart.com",
            'notification@contact.forexmart.com' => "notification@contact.forexmart.com",
            'sales@contact.forexmart.com' => "sales@contact.forexmart.com",
            'marketing@contact.forexmart.com' => "marketing@contact.forexmart.com",
            'support@contact.forexmart.com' => "support@contact.forexmart.com",
            'partners@contact.forexmart.com' => "partners@contact.forexmart.com",
            'bonuses@contact.forexmart.com' => "bonuses@contact.forexmart.com"
        );

        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }

    public function checkUniqueData($table, $field, $data){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like($field, $data, 'before');
        $queryResult = $this->db->get();

        return ($queryResult->num_rows() > 0) ? false : true;
    }

    public function getSavedSchedule(){
        $this->db->select('*, mailer_scheduler.Id');
        $this->db->from('mailer_scheduler');
        $this->db->join('mailer', 'mailer_scheduler.mailer = mailer.Id', 'inner');
        $this->db->join('settingsscheme', 'mailer.Scheme = settingsscheme.Id', 'inner');
        $this->db->join('settingsreplyto', 'mailer.ReplyTo = settingsreplyto.Id', 'inner');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function updateScheduleMailer($mailerId, $data){
        $this->db->where('Id',$mailerId);
        $this->db->update('mailer_scheduler', $data);
    }

    public function getSavedSchedule2(){
        $this->db->select('*, mailer_scheduler.Id');
        $this->db->from('mailer_scheduler');
        $this->db->join('mailer', 'mailer_scheduler.mailer = mailer.Id', 'inner');
        $this->db->join('settingsscheme', 'mailer.Scheme = settingsscheme.Id', 'inner');
        $this->db->join('settingsreplyto', 'mailer.ReplyTo = settingsreplyto.Id', 'inner');
        $this->db->join('settingslanguage', 'mailer.Language = settingslanguage.Id', 'inner');
        $this->db->join('mailer_mailbox', 'mailer.Sentfrom = mailer_mailbox.Email', 'inner');
        $this->db->where('mailer.Active', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }
    public function getDataMailSchedule($mailScheduleId){
        $this->db->select('*, mailer_scheduler.Id');
        $this->db->from('mailer_scheduler');
        $this->db->join('mailer', 'mailer_scheduler.mailer = mailer.Id', 'inner');
        $this->db->join('settingsscheme', 'mailer.Scheme = settingsscheme.Id', 'inner');
        $this->db->join('settingsreplyto', 'mailer.ReplyTo = settingsreplyto.Id', 'inner');
        $this->db->join('settingslanguage', 'mailer.Language = settingslanguage.Id', 'inner');
        $this->db->join('mailer_mailbox', 'mailer.Sentfrom = mailer_mailbox.Email', 'inner');
        $this->db->where('mailer_scheduler.Id', $mailScheduleId);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getRecipientDetailsByEmail($recipient){
        $this->db->select('*');
        $this->db->from('mailer_recipients');
        $this->db->where('Email', $recipient);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }
    public function getRecipientDetailsById($recipientId){
        $this->db->select('*');
        $this->db->from('mailer_recipients');
        $this->db->where('Id', $recipientId);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getSearchRecipient($search){
        $this->db->select('*');
        $this->db->from('mailer_recipients');
        $this->db->like('Email', $search);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getMailerSchedulerById($mailerId){
        $this->db->select('*');
        $this->db->from('mailer_scheduler');
        $this->db->where('Id', $mailerId);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }
    function getCurrenciesPairFI($currency_id=""){
        //reference https://www.forexmart.com/financial-instruments
        $currency = array (

            'USDJPY'=> 'USD/JPY',
            'USDCHF'=> 'USD/CHF',
            'USDCAD'=> 'USD/CAD',
            'AUDUSD'=> 'AUD/USD',
            'NZDUSD'=> 'NZD/USD',
            'EURJPY'=> 'EUR/JPY',
            'EURCHF'=> 'EUR/CHF',
            'EURGBP'=> 'EUR/GBP',
            'AUDCAD'=> 'AUD/CAD',
            'AUDCHF'=> 'AUD/CHF',
            'AUDJPY'=> 'AUD/JPY',
            'CADCHF'=> 'CAD/CHF',
            'CADJPY'=> 'CAD/JPY',
            'CHFJPY'=> 'CHF/JPY',
            'NZDCAD'=> 'NZD/CAD',
            'NZDCHF'=> 'NZD/CHF',
            'NZDJPY'=> 'NZD/JPY',
            'EURAUD'=> 'EUR/AUD',
            'GBPCHF'=> 'GBP/CHF',
            'GBPJPY'=> 'GBP/JPY',
            'AUDNZD'=> 'AUD/NZD',
            'EURCAD'=> 'EUR/CAD',
            'EURNZD'=> 'EUR/NZD',
            'GBPAUD'=> 'GBP/AUD',
            'GBPCAD'=> 'GBP/CAD',
            'GBPNZD'=> 'GBP/NZD',
            'USDDKK'=> 'USD/DKK',
            'USDNOK'=> 'USD/NOK',
            'USDSEK'=> 'USD/SEK',
            'USDZAR'=> 'USD/ZAR',
            'AUDCZK'=> 'AUD/CZK',
            'AUDDKK'=> 'AUD/DKK',
            'AUDHKD'=> 'AUD/HKD',
            'AUDHUF'=> 'AUD/HUF',
            'AUDMXN'=> 'AUD/MXN',
            'AUDNOK'=> 'AUD/NOK',
            'AUDPLN'=> 'AUD/PLN',
            'AUDSEK'=> 'AUD/SEK',
            'AUDSGD'=> 'AUD/SGD',
            'AUDZAR'=> 'AUD/ZAR',
            'CADCZK'=> 'CAD/CZK',
            'CADDKK'=> 'CAD/DKK',
            'CADHKD'=> 'CAD/HKD',
            'CADHUF'=> 'CAD/HUF',
            'CADMXN'=> 'CAD/MXN',
            'CADNOK'=> 'CAD/NOK',
            'CADPLN'=> 'CAD/PLN',
            'CADSEK'=> 'CAD/SEK',
            'CADSGD'=> 'CAD/SGD',
            'CADZAR'=> 'CAD/ZAR',
            'CHFCZK'=> 'CHF/CZK',
            'CHFDKK'=> 'CHF/DKK',
            'CHFHKD'=> 'CHF/HKD',
            'CHFHUF'=> 'CHF/HUF',
            'CHFMXN'=> 'CHF/MXN',
            'CHFNOK'=> 'CHF/NOK',
            'CHFPLN'=> 'CHF/PLN',
            'CHFSEK'=> 'CHF/SEK',
            'CHFSGD'=> 'CHF/SGD',
            'CHFZAR'=> 'CHF/ZAR',
            'EURCZK'=> 'EUR/CZK',
            'EURDKK'=> 'EUR/DKK',
            'EURHKD'=> 'EUR/HKD',
            'EURHUF'=> 'EUR/HUF',
            'EURMXN'=> 'EUR/MXN',
            'EURNOK'=> 'EUR/NOK',
            'EURPLN'=> 'EUR/PLN',
            'EURSEK'=> 'EUR/SEK',
            'EURSGD'=> 'EUR/SGD',
            'EURZAR'=> 'EUR/ZAR',
            'GBPCZK'=> 'GBP/CZK',
            'GBPDKK'=> 'GBP/DKK',
            'GBPHKD'=> 'GBP/HKD',
            'GBPHUF'=> 'GBP/HUF',
            'GBPMXN'=> 'GBP/MXN',
            'GBPNOK'=> 'GBP/NOK',
            'GBPPLN'=> 'GBP/PLN',
            'GBPSEK'=> 'GBP/SEK',
            'GBPSGD'=> 'GBP/SGD',
            'GBPZAR'=> 'GBP/ZAR',
            'NZDCZK'=> 'NZD/CZK',
            'NZDDKK'=> 'NZD/DKK',
            'NZDHKD'=> 'NZD/HKD',
            'NZDHUF'=> 'NZD/HUF',
            'NZDMXN'=> 'NZD/MXN',
            'NZDNOK'=> 'NZD/NOK',
            'NZDPLN'=> 'NZD/PLN',
            'NZDSEK'=> 'NZD/SEK',
            'NZDSGD'=> 'NZD/SGD',
            'NZDZAR'=> 'NZD/ZAR',
            'USDCZK'=> 'USD/CZK',
            'USDHKD'=> 'USD/HKD',
            'USDHUF'=> 'USD/HUF',
            'USDMXN'=> 'USD/MXN',
            'USDSGD'=> 'USD/SGD',
            'USDPLN'=> 'USD/PLN',
            'CZKJPY'=> 'CZK/JPY',
            'DKKJPY'=> 'DKK/JPY',
            'HKDJPY'=> 'HKD/JPY',
            'HUFJPY'=> 'HUF/JPY',
            'MXNJPY'=> 'MXN/JPY',
            'NOKJPY'=> 'NOK/JPY',
            'SGDJPY'=> 'SGD/JPY',
            'SEKJPY'=> 'SEK/JPY',
            'ZARJPY'=> 'ZAR/JPY',
            'USDRUB'=> 'USD/RUB',

            'EURUSD'=> 'EUR/USD',
            'GBPUSD'=> 'GBP/USD',
            'GBPPLN'=> 'GBP/PLN',
            'USDRUR'=> 'USD/RUR',


            '#AA'=> '#AA',
            '#AAL'=> '#AAL',
            '#AAPL'=> '#AAPL',
            '#AIG'=> '#AIG',
            '#AMZN'=> '#AMZN',
            '#AXP'=> '#AXP',
            '#BA'=> '#BA',
            '#BABA'=> '#BABA',
            '#BAC'=> '#BAC',
//            '#BARC'=> '#BARC',
            '#BLT'=> '#BLT',
            '#BP'=> '#BP',
            '#BTA'=> '#BTA',
            '#C'=> '#C',
            '#CAT'=> '#CAT',
            '#CSCO'=> '#CSCO',
            '#CVX'=> '#CVX',
            '#DD'=> '#DD',
            '#DIS'=> '#DIS',
            '#EBAY'=> '#EBAY',
            '#FB'=> '#FB',
            '#GEN'=> '#GEN',
            '#GOOG'=> '#GOOG',
            '#GS'=> '#GS',
            '#GSK'=> '#GSK',
            '#HD'=> '#HD',
            '#HPQ'=> '#HPQ',
//            '#HSBA'=> '#HSBA',
            '#IBM'=> '#IBM',
            '#INTC'=> '#INTC',
            '#JNJ'=> '#JNJ',
            '#JPM'=> '#JPM',
            '#KO'=> '#KO',
//            '#LLOY'=> '#LLOY',
            '#LNKD'=> '#LNKD',
            '#MCD'=> '#MCD',
            '#MMM'=> '#MMM',
            '#MRK'=> '#MRK',
            '#MSFT'=> '#MSFT',
            '#ORCL'=> '#ORCL',
            '#PFE'=> '#PFE',
            '#PG'=> '#PG',
            '#T'=> '#T',
            '#TRV'=> '#TRV',
            '#TSCO'=> '#TSCO',
            '#TWTR'=> '#TWTR',
            '#UTX'=> '#UTX',
            '#VOD'=> '#VOD',
            '#VZ'=> '#VZ',
            '#WFC'=> '#WFC',
            '#WMT'=> '#WMT',
            '#XOM'=> '#XOM',
            '#YHOO'=> '#YHOO',

            'XAUUSD'=> 'GOLD',
            'XAGUSD'=> 'SILVER',
            'XXAU/USD'=> 'XAU/USD',

        );
        if($currency_id){
            return isset($currency[$currency_id])?$currency[$currency_id]:false;
        }else{
            return $currency;
        }
    }
    function getFCLeverage($id=null){
        // FXPP-794
        $data= array(
            '1:1' => "1:1",
            '1:2' => "1:2",
            '1:3' => "1:3",
            '1:5' => "1:5",
            '1:10' => "1:10",
            '1:20' => "1:20",
            '1:25' => "1:25",
            '1:33' => "1:33",
            '1:50' => "1:50",
            '1:66' => "1:66",
            '1:100' => "1:100",
            '1:125' => "1:125",
            '1:150' => "1:150",
            '1:175' => "1:175",
            '1:200' => "1:200",
            '1:300' => "1:300",
            '1:400' => "1:400",
            '1:500' => "1:500",
            '1:600' => "1:600",
            '1:1000' => "1:1000"
        );

        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    function getFCVolume($id=null){
        $data= array(
            '0.1' => '0.1',
            '1'=>'1',
            '10'=>'10',
            '100'=>'100',
            '1000'=>'1000',
            '10000'=>'10000',
            '100000'=>'100000',
            '1000000'=>'1000000',
            '10000000'=>'10000000',
            '100000000'=>'100000000',
            '1000000000'=>'1000000000',
            '10000000000'=>'10000000000',
            '100000000000'=>'100000000000',
        );
        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }
    }
    function getAccountCurrencyBase3($id=null){
        $data= array(
            'EUR' =>"EUR",
            'USD' => "USD",
            'GBP' => "GBP",
        );

        if($id==null){
            return $data;
        }else{
            return isset($data[$id])?$data[$id]:false;
        }

    }
    
        public function getAdministratorList() {   
        $this->db->select('users.id user_id,users.email email,users.activated `status`,user_profiles.id profile_id, user_profiles.full_name `name`,manage_access.id manage_ac_id,manage_access.permission permission,manage_access.`status` manage_ac_status');
        $this->db->from('users');
        $this->db->join('user_profiles',' users.id=user_profiles.user_id','inner');
        $this->db->join('manage_access','users.id=manage_access.user_id','left');
        $this->db->where('manage_access.type=3');
         $this->db->where('manage_access.admin=3');
          $this->db->where('users.administration=1');
         $this->db->group_by('users.email'); 
        $this->db->order_by('users.id','desc');
        $query = $this->db->get();
          
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;

    }
    public function getAdministratorListWhere($status) {   
        $this->db->select('users.id user_id,users.email email,users.activated `status`,user_profiles.id profile_id, user_profiles.full_name `name`,manage_access.id manage_ac_id,manage_access.permission permission,manage_access.`status` manage_ac_status');
        $this->db->from('users');
        $this->db->join('user_profiles',' users.id=user_profiles.user_id','inner');
        $this->db->join('manage_access','users.id=manage_access.user_id','left');
        $this->db->where('users.administration=1');
        $this->db->where('manage_access.type=3');
         $this->db->where('manage_access.admin=3');
        $this->db->where('users.activated',$status);
        $this->db->group_by('users.email'); 
        $this->db->order_by('users.id','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;

    }
    
    public function getOneData($table,$column,$value)
    {
         $this->db->select("*");
         $this->db->from($table);
         $this->db->where("$column=$value");
         $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return false;
    }
    public function CheckDoneEmail($email)
    {
          $this->db->select("*");
          $this->db->from('users');
          $this->db->where('administration=1');
          $this->db->where('email',$email);
          $this->db->limit(1);
           $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
          
    }

    public function getGroupCurrency( $account_type, $currency_code, $swap_free = 0 ){

        $data= array(
            1 => array( // API group codes for ForexMart Standard
                'USD' => array(
                    0 => 'StSwUS',
                    1 => 'StSFUS'
                ),
                'EUR' => array(
                    0 => 'StSwEU',
                    1 => 'StSFEU'
                ),
                'GBP' => array(
                    0 => 'StSwGB',
                    1 => 'StSFGB'
                ),
                'RUB' => array(
                    0 => 'StSwRU',
                    1 => 'StSFRU'
                )
            ),
            2 => array( // API group codes for ForeMart Zero Spread
                'USD' => array(
                    0 => 'ZeSwUS',
                    1 => 'ZeSFUS'
                ),
                'EUR' => array(
                    0 => 'ZeSwEU',
                    1 => 'ZeSFEU'
                ),
                'GBP' => array(
                    0 => 'ZeSwGB',
                    1 => 'ZeSFGB'
                ),
                'RUB' => array(
                    0 => 'ZeSwRU',
                    1 => 'ZeSFRU'
                )
            ),
            3 => array( // API group codes for Partners/Affiliates
                'USD' => 'PaUS',
                'EUR' => 'PaEU',
                'GBP' => 'PaGB',
                'RUB' => 'PaRU'
            )
        );

        if(in_array($account_type, array(1,2))){
            return $data[$account_type][$currency_code][$swap_free];
        }elseif(in_array($account_type, array(3))){
            return $data[$account_type][$currency_code];
        }else{
            return '';
        }
    }

    public function getDemoGroupCurrency( $account_type, $currency_code, $swap_free = 0 ){

        $data= array(
            1 => array( // API group codes for ForexMart Demo Standard
                'USD' => 'StUS',
                'EUR' =>'StEU',
                'GBP' => 'StGB'
            ),
            2 => array( // API group codes for ForexMart Demo Zero-Spread
                'USD' => 'ZeUS',
                'EUR' =>'ZeEU',
                'GBP' => 'ZeGB'
            ),
            3 => array( // API group codes for Contest Moneyfall for swap-free/non swap-free
                0 => 'ContestMF',
                1 => 'ContestMFSF'
            )
        );

        if(in_array($account_type, array(1,2))){
            return $data[$account_type][$currency_code];
        }elseif(in_array($account_type, array(3))){
            return $data[$account_type][$swap_free];
        }else{
            return '';
        }
    }

    public function showdoc($table,$field1,$id1,$field2,$id2,$select) {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->order_by('date_uploaded','asc');
        $this->db->where($field1, $id1);
        $this->db->where($field2, $id2);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function showdoc12($table,$field1,$id1,$field2,$id2,$select) {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->order_by('uploadset','desc');
        $this->db->where($field1, $id1);
        $this->db->where($field2, $id2);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    function updatemydocs($table,$field1,$id1,$field2,$id2,$data){

        $this->db->where($field1, $id1);
        $this->db->where($field2, $id2);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }
    function updatet1w3($table,$field,$id,$field2,$id2,$field3,$id3,$data){
        $this->db->where($field, $id);
        $this->db->where($field2, $id2);
        $this->db->where($field3, $id3);
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }
  	public function getDataQueryString($table,$star,$whereData="",$orderbyField="",$AscDesc="",$limit="")
	{
                                
		$this->db->select($starVal);
                 $this->db->from($table);		
		if($whereData!=""){ foreach($whereData as $key=>$val) {$this->db->where($key, $val);  }}	
                                
		if($orderbyField!=""){ $this->db->order_by($orderbyField,$AscDesc);}
		if($limit!=""){$this->db->limit($limit);}
                 $result = $this->db->get();
		return $result->row();
		 
	}    
        
        
        public function deleteQueryString($table,$whereData)
	{
		if($whereData!=""){ foreach($whereData as $key=>$val) {$this->db->where($key, $val); }}	         
		$this->db->delete($table); 
		 if ($this->db->affected_rows() > 0){
            return true;
        }
        return false;
	}
    
         
    public function getQueryStirngResult($table,$star,$data="",$gropup="",$order="",$join=""){
        $this->db->select($star);
        $this->db->from($table);
        if($join!=""){foreach($join as $key=>$val){$this->db->join($key ,$val);}}
        if($data!=""){foreach($data as $key=>$val){ $this->db->where($key ,$val);}}
        
        if($gropup!=""){foreach($gropup as $key=>$val){ $this->db->group_by($val); }}
        if($order!=""){foreach($order as $key=>$val){ $this->db->order_by($key,$val); }}
  
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }    
       
    public function getQueryStirngRow($table,$star,$data="",$gropup="",$order="",$join=""){
        $this->db->select($star);
        $this->db->from($table);
        if($join!=""){foreach($join as $key=>$val){$this->db->join($key ,$val);}}
        if($data!=""){foreach($data as $key=>$val){ $this->db->where($key ,$val);}}
        
        if($gropup!=""){foreach($gropup as $key=>$val){ $this->db->group_by($val); }}
        if($order!=""){foreach($order as $key=>$val){ $this->db->order_by($key,$val); }}
  
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    } 
        
    public function getOneDataMange($table,$column,$value,$colmn2,$value2,$colmn3,$value3)
    {
         $this->db->select("*");
         $this->db->from($table);
         $this->db->where("$column=$value");
         $this->db->where("$colmn2=$value2");
         $this->db->where("$colmn3=$value3");
         $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
            return false;
    }
    
    public function getDataQueryStringRowDataOrdery($table,$data,$star,$orderby)
    {	

            $values="";
            $i=0;
            foreach($data as $key=>$val)
            {
                    if($i==0){$values=$key." = '".$val."'";}
                    else{$values.=" and ".$key." = '".$val."'";}
                    $i++;
            }


             $sql='SELECT '.$star.' FROM '.$table.' where '.$values.' '.$orderby.'';
              $query = $this->db->query($sql);
            return $query->result();
    }	
    public function getQueryStringRow($table,$star,$whereData="",$orderbyField="",$AscDesc="",$limit=""){

    $this->db->select($star);
     $this->db->from($table);		
    if($whereData!=""){ foreach($whereData as $key=>$val) {$this->db->where($key, $val);  }}	

    if($orderbyField!=""){ $this->db->order_by($orderbyField,$AscDesc);}
    if($limit!=""){$this->db->limit($limit);}
     $result = $this->db->get();
    return $result->row();

    }
    
    
   function showWhere3($table,$field1="",$id1="",$field2="",$id2="",$field3="",$id3="",$order_by=""){

        $this->db->trans_start();
		$this->db->where($field1, $id1);
		$this->db->where($field2, $id2);
                $this->db->where($field3, $id3);
		if($order_by){ $orderby = explode(',',$order_by); $this->db->order_by($orderby[0],$orderby[1]); } 
		$result = $this->db->get($table);	
		return $result;
        $this->db->trans_complete();
	}

    function getDeclinedReason($dec_id=""){
        $reason = array (
            '0' => 'Account holder did not reached the age limit.',
            '1' => 'Address provided and address on document do not match.',
            '2' => 'Document is altered or modified without proper certification from issuer.',
            '3' => 'Document is corrupt and cannot be opened.',
            '4' => 'Document is expired.',

            '5' => 'Document is password protected.',
            '6' => 'Document presented page mismatch.',
            '7' => 'Document presented shows a photo without identity details.',
            '8' => 'Document presented shows no proof of identity.',
            '9' => 'Document scanned from the wrong side.',

            '10' => 'Document shows lack of issuer signatures.',
            '11' => 'Document shows no country of issuance.',
            '12' => 'Document shows no signature of the account holder.',
            '13' => 'Invalid document.',
            '14' => 'Low resolution scanned document.',

            '15' => 'Missing pages on scanned document.',
            '16' => 'Name of the account holder and name on the document mismatch.',
            '17' => 'No images found on the scanned document.',
            '18' => 'No second document submitted.',
            '19' => 'Poor quality scanned document.',

            '20' => 'Poor quality scanned images.',
            '21' => 'Same document submitted on the previous.',
            '22' => 'Translation required.',
        );
//        if($dec_id){
        return isset($reason[$dec_id])?$reason[$dec_id]:false;
//        }else{
//            return $reason;
//        }
    }

    function where( $table, $condition,$select="*"){
        $this->db->select($select);
        $this->db->where($condition);
        $result = $this->db->get($table);
        if($result->num_rows()>0) return $result;
        return false;
    }

    function showinfo($tbl, $sel , $fld , $id){
        $q  =   $this->db
            ->select($sel)
            ->from($tbl)
            ->where($fld,$id);
        $ret['rows']    =   $q->get()->result();
        return $ret;

    }
    function getuserinfo($id){
        $q = $this->db->select('a.email,a.id,b.full_name,c.permission')
            ->from('users a')
            ->join('user_profiles b', 'a.id = b.user_id','inner')
            ->join('manage_access c', 'b.user_id = c.user_id','inner')
            ->where('a.id',$id);
        $ret['rows'] = $q->get()->result();
        return $ret;
    }
    function insertup($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }
    function insert_inc($data){
        $this->db->insert('incomplete_registers',$data);
        return $this->db->insert_id();
    }

    function getAllCountries($country_id = "")
    {
        $countries = array(
            "GB" => "United Kingdom",
            //  "US" => "United States",
            "AF" => "Afghanistan",
            "AL" => "Albania",
            "DZ" => "Algeria",
            "AS" => "American Samoa",
            "AD" => "Andorra",
            "AO" => "Angola",
            "AI" => "Anguilla",
            "AQ" => "Antarctica",
            "AG" => "Antigua And Barbuda",
            "AR" => "Argentina",
            "AM" => "Armenia",
            "AW" => "Aruba",
            "AU" => "Australia",
            "AT" => "Austria",
            "AZ" => "Azerbaijan",
            "BS" => "Bahamas",
            "BH" => "Bahrain",
            "BD" => "Bangladesh",
            "BB" => "Barbados",
            "BY" => "Belarus",
            "BE" => "Belgium",
            "BZ" => "Belize",
            "BJ" => "Benin",
            "BM" => "Bermuda",
            "BT" => "Bhutan",
            "BO" => "Bolivia",
            "BA" => "Bosnia and Herzegovina",
            "BW" => "Botswana",
            "BV" => "Bouvet Island",
            "BR" => "Brazil",
            "IO" => "British Indian Ocean Territory",
            "BN" => "Brunei Darussalam",
            "BG" => "Bulgaria",
            "BF" => "Burkina Faso",
            "BI" => "Burundi",
            "KH" => "Cambodia",
            "CM" => "Cameroon",
            "CA" => "Canada",
            "CV" => "Cape Verde",
            "KY" => "Cayman Islands",
            "CF" => "Central African Republic",
            "TD" => "Chad",
            "CL" => "Chile",
            "CN" => "China",
            "CX" => "Christmas Island",
            "CC" => "Cocos (Keeling) Islands",
            "CO" => "Colombia",
            "KM" => "Comoros",
            "CG" => "Congo",
            "CD" => "Congo, The Democratic Republic Of The",
            "CK" => "Cook Islands",
            "CR" => "Costa Rica",
            "CI" => "Cote D'Ivoire",
            "HR" => "Croatia (Local Name: Hrvatska)",
            "CU" => "Cuba",
            "CY" => "Cyprus",
            "CZ" => "Czech Republic",
            "DK" => "Denmark",
            "DJ" => "Djibouti",
            "DM" => "Dominica",
            "DO" => "Dominican Republic",
            "TP" => "East Timor",
            "EC" => "Ecuador",
            "EG" => "Egypt",
            "SV" => "El Salvador",
            "GQ" => "Equatorial Guinea",
            "ER" => "Eritrea",
            "EE" => "Estonia",
            "ET" => "Ethiopia",
            "FK" => "Falkland Islands (Malvinas)",
            "FO" => "Faroe Islands",
            "FJ" => "Fiji",
            "FI" => "Finland",
            "FR" => "France",
            "FX" => "France, Metropolitan",
            "GF" => "French Guiana",
            "PF" => "French Polynesia",
            "TF" => "French Southern Territories",
            "GA" => "Gabon",
            "GM" => "Gambia",
            "GE" => "Georgia",
            "DE" => "Germany",
            "GH" => "Ghana",
            "GI" => "Gibraltar",
            "GR" => "Greece",
            "GL" => "Greenland",
            "GD" => "Grenada",
            "GP" => "Guadeloupe",
            "GU" => "Guam",
            "GT" => "Guatemala",
            "GN" => "Guinea",
            "GW" => "Guinea-Bissau",
            "GY" => "Guyana",
            "HT" => "Haiti",
            "HM" => "Heard And Mc Donald Islands",
            "VA" => "Holy See (Vatican City State)",
            "HN" => "Honduras",
            "HK" => "Hong Kong",
            "HU" => "Hungary",
            "IS" => "Iceland",
            "IN" => "India",
            "ID" => "Indonesia",
            "IR" => "Iran (Islamic Republic Of)",
            "IQ" => "Iraq",
            "IE" => "Ireland",
            "IL" => "Israel",
            "IT" => "Italy",
            "JM" => "Jamaica",
            "JP" => "Japan",
            "JO" => "Jordan",
            "KZ" => "Kazakhstan",
            "KE" => "Kenya",
            "KI" => "Kiribati",
            "KP" => "Korea, Democratic People's Republic Of",
            // "KR" => "Korea, Republic Of",
            "KW" => "Kuwait",
            "KG" => "Kyrgyzstan",
            "LA" => "Lao People's Democratic Republic",
            "LV" => "Latvia",
            "LB" => "Lebanon",
            "LS" => "Lesotho",
            "LR" => "Liberia",
            "LY" => "Libyan Arab Jamahiriya",
            "LI" => "Liechtenstein",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MO" => "Macau",
            "MK" => "Macedonia, Former Yugoslav Republic Of",
            "MG" => "Madagascar",
            "MW" => "Malawi",
            "MY" => "Malaysia",
            "MV" => "Maldives",
            "ML" => "Mali",
            "MT" => "Malta",
            "MH" => "Marshall Islands",
            "MQ" => "Martinique",
            "MR" => "Mauritania",
            "MU" => "Mauritius",
            "YT" => "Mayotte",
            "MX" => "Mexico",
            "FM" => "Micronesia, Federated States Of",
            "MD" => "Moldova, Republic Of",
            "MC" => "Monaco",
            "MN" => "Mongolia",
            "MS" => "Montserrat",
            "MA" => "Morocco",
            "MZ" => "Mozambique",
            // "MM" => "Myanmar",
            "NA" => "Namibia",
            "NR" => "Nauru",
            "NP" => "Nepal",
            "NL" => "Netherlands",
            "AN" => "Netherlands Antilles",
            "NC" => "New Caledonia",
            "NZ" => "New Zealand",
            "NI" => "Nicaragua",
            "NE" => "Niger",
            "NG" => "Nigeria",
            "NU" => "Niue",
            "NF" => "Norfolk Island",
            "MP" => "Northern Mariana Islands",
            "NO" => "Norway",
            "OM" => "Oman",
            "PK" => "Pakistan",
            "PW" => "Palau",
            "PS"=>  "Palestina",
            "PA" => "Panama",
            "PG" => "Papua New Guinea",
            "PY" => "Paraguay",
            "PE" => "Peru",
            "PH" => "Philippines",
            "PN" => "Pitcairn",
            "PL" => "Poland",
            "PT" => "Portugal",
            "PR" => "Puerto Rico",
            "QA" => "Qatar",
            "RE" => "Reunion",
            "RO" => "Romania",
            "RU" => "Russian Federation",
            "RW" => "Rwanda",
            "KN" => "Saint Kitts And Nevis",
            "LC" => "Saint Lucia",
            "VC" => "Saint Vincent And The Grenadines",
            "WS" => "Samoa",
            "SM" => "San Marino",
            "ST" => "Sao Tome And Principe",
            "SA" => "Saudi Arabia",
            "SN" => "Senegal",
            "RS" => "Serbia",
            "SC" => "Seychelles",
            "SL" => "Sierra Leone",
            "SG" => "Singapore",
            "SK" => "Slovakia (Slovak Republic)",
            "SI" => "Slovenia",
            "SB" => "Solomon Islands",
            "SO" => "Somalia",
            "ZA" => "South Africa",
            "GS" => "South Georgia, South Sandwich Islands",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SH" => "St. Helena",
            "PM" => "St. Pierre And Miquelon",
            //"SD" => "Sudan",
            "SR" => "Suriname",
            "SJ" => "Svalbard And Jan Mayen Islands",
            "SZ" => "Swaziland",
            "SE" => "Sweden",
            "CH" => "Switzerland",
            //  "SY" => "Syrian Arab Republic",
            "TW" => "Taiwan",
            "TJ" => "Tajikistan",
            "TZ" => "Tanzania, United Republic Of",
            "TH" => "Thailand",
            "TG" => "Togo",
            "TK" => "Tokelau",
            "TO" => "Tonga",
            "TT" => "Trinidad And Tobago",
            "TN" => "Tunisia",
            "TR" => "Turkey",
            "TM" => "Turkmenistan",
            "TC" => "Turks And Caicos Islands",
            "TV" => "Tuvalu",
            "UG" => "Uganda",
            "UA" => "Ukraine",
            "AE" => "United Arab Emirates",
            "UM" => "United States Minor Outlying Islands",
            "UY" => "Uruguay",
            "UZ" => "Uzbekistan",
            "VU" => "Vanuatu",
            "VE" => "Venezuela",
            "VN" => "Viet Nam",
            "VG" => "Virgin Islands (British)",
            "VI" => "Virgin Islands (U.S.)",
            "WF" => "Wallis And Futuna Islands",
            "EH" => "Western Sahara",
            "YE" => "Yemen",
//            "YU" => "Yugoslavia",
            "ZM" => "Zambia",
            "ZW" => "Zimbabwe"
        );
        if ($country_id) {
            return isset($countries[$country_id]) ? $countries[$country_id] : false;
        } else {
            return $countries;
        }
    }
    function getGroupSpard($id = null)
    {

        $data = array(
            "refSt201" => "ForexMart Standard / spread 2.0 pips",
            "refSt251" => "ForexMart Standard / spread 2.5 pips",
            "refSt301" => "ForexMart Standard / spread 3.0 pips",
            "refSt351" => "ForexMart Standard / spread 3.5 pips",
            "refSt401" => "ForexMart Standard / spread 4.0 pips",
            "refZe201" => "ForexMart Zero Spread / fee 2.0 pips",
            "refZe251" => "ForexMart Zero Spread / fee 2.5 pips",
            "refZe301" => "ForexMart Zero Spread / fee 3.0 pips",
            "refZe351" => "ForexMart Zero Spread / fee 3.5 pips",
            "refZe401" => "ForexMart Zero Spread / fee 4.0 pips"
        );

        if ($id == null) {
            return $data;
        } else {
            return isset($data[$id]) ? $data[$id] : false;
        }

    }
}