<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support_m extends MY_Model {

	protected $_table_name = 'support';
	protected $_order_by = 'id';

	public $support_rules = array(
		'email_support' => array(
			'field' => 'email_support',
			'label' => 'Email',
			'rules' => 'trim|xss_clean|required|valid_email'
		),
		'support_body' => array(
			'field' => 'support_body',
			'label' => 'Support',
			'rules' => 'trim|xss_clean|required'
		),
	);

	public $support_admin = array(
		'answer_body' => array(
			'field' => 'answer_body',
			'label' => 'Answer Body',
			'rules' => 'trim|xss_clean|required'
		),
	);

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_support($status)
	{
		$query = $this->db->query("SELECT * FROM support WHERE status = '$status'");
		return $query->result();
	}

	public function save_application($email, $message)
	{
		$now = date('Y-m-d H:i:s');
		$this->db->query("INSERT INTO support (email, body,send_date) VALUES ('$email', '$message','$now')");
		if($this->db->affected_rows() === 1)
		{
			return true;
		}
		else
			return false;
	}

	public function get_email_n_body($id)
	{
		$query = $this->db->query("SELECT email, body FROM support WHERE id='$id'");
		return $query->row();
	}

	public function save_answer($data, $id)
	{
		$who_answer = $data['who_answer'];
		$status = $data['status'];
		$answer_date = $data['answer_date'];
		$answer_body = $data['answer_body'];

		$this->db->query("UPDATE support SET who_answer = '$who_answer', status = '$status', answer_date = '$answer_date', answer_body = '$answer_body' WHERE id='$id'");
		if($this->db->affected_rows() === 1)
		{
			return true;
		}
		else
			return false;
	}

	public function show_answered($id)
	{
		$query = $this->db->query("SELECT * FROM support WHERE id='$id'");
		return $query->row();
	}

}

/* End of file support_m.php */
/* Location: ./application/models/support_m.php */