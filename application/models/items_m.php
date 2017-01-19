<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items_m extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_items($id)
	{
		$query = $this->db->query("SELECT * from item WHERE owner_id='$id' AND window = 'EQUIPMENT' ORDER BY pos");
		return $query->result();
	}

	public function get_item_proto($item)
	{
		$query = $this->db->query("SELECT * FROM item_proto WHERE vnum='$item'");
		return $query->result();
	}

	public function get_kd_name($kd)
	{
		$query = $this->db->query("SELECT locale_name FROM item_proto WHERE vnum='$kd'");
		return $query->row('locale_name');
	}

	public function get_item_icon($vnum)
	{
		$query = $this->db->query("SELECT icon FROM item_icon WHERE vnum='$vnum'");
		return $query->row('icon');
	}

}

/* End of file items_m.php */
/* Location: ./application/models/items_m.php */