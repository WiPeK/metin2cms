<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop_logs_m extends MY_Model {

	public function __construct()
	{
		parent::__construct();	
	}

	public function log_buy_item($user_id, $item_vnum)
	{
		$date = date('Y-m-d H:i:s');
		
		$this->db->query("INSERT INTO is_log (account_id, vnum, time) VALUES ('$user_id','$item_vnum','$date')");
	}

	public function log_buy_coins($code)
	{
		$date = date('Y-m-d H:i:s');
		$login = $this->session->userdata('login');
		$this->db->query("INSERT INTO buy_coins_log (login, code, time) VALUES ('$login','$code','$date')");
	}

	public function log_buy_exp($id, $days, $category)
	{
		$date = date('Y-m-d H:i:s');
		$this->db->query("INSERT INTO vip_buys_log (user_id, days, category, time) VALUES ('$id','$days','$category', '$date')");
	}

	public function log_buy_money($id, $days, $category)
	{
		$date = date('Y-m-d H:i:s');
		$this->db->query("INSERT INTO vip_buys_log (user_id, days, category, time) VALUES ('$id','$days','$category', '$date')");
	}

}

/* End of file shop_logs_m.php */
/* Location: ./application/models/shop_logs_m.php */