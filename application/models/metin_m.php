<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Metin_m extends MY_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_acc()
	{
		$query = $this->db->query("SELECT * FROM account WHERE id=1");
		return $query->result();
	}
	public function get_item()
	{
		$query = $this->db->query("SELECT * FROM item WHERE owner_id=1 AND vnum=189 AND window='EQUIPMENT'");
		return $query->result();
	}

}

/* End of file metin_m.php */
/* Location: ./application/models/metin_m.php */