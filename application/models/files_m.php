<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Files_m extends MY_Model {

	protected $_table_name = 'files';
	protected $_order_by = 'add_date';

	public $file_rules = array(
		'file_title' => array(
			'field' => 'file_title',
			'label' => 'Tytuł pliku',
			'rules' => 'trim|xss_clean|required|min_length[3]|max_length[100]|callback__alpha_dash_space|is_unique[files.file_title]'
		),
	);

	public $rules_client = array(
		'client_url' => array(
			'field' => 'client_url',
			'label' => 'Link clienta',
			'rules' => 'trim|required|prep_url',
		),
		'name' => array(
			'field' => 'name',
			'label' => 'Nazwa źródła',
			'rules' => 'trim|required|xss_clean',
		),
	);

	public function __construct()
	{
		parent::__construct();	
	}

	public function save_file($file)
	{
		//dodanie danych pliku do bazy danych
		$data = array(
			'file_title' => $file['file_title'],
			'file_who_add' => $this->session->userdata('login'),
			'add_date' => date('Y-m-d H:i:s'),
			'file_url' => $file['file_url'],
			'extension' => $file['extension'],
			'raw_name' => $file['raw_name'],
			'file_size' => $file['file_size'],
		);
		$this->db->insert('files',$data);
	}

	public function get_files()
	{
		$files = parent::get();
		return $files; 
	}

	public function get_extension($file)
	{
		$query = $this->db->query("SELECT extension FROM files WHERE raw_name = '$file'");
		return $query->row('extension');
	}

	public function delete_file($title)
	{	
		$this->db->query("DELETE FROM files WHERE file_url = '$title'");
	}

	public function get_client_links()
	{
		$query = $this->db->query("SELECT * FROM client_links");
		return $query->result();
	}

	public function save_client_link($link, $name)
	{
		$data = array(
			'url' => $link,
			'add_by' => $this->session->userdata('login'),
			'time' => date('Y-m-d H:i:s'),
			'name' => $name
		);
		$this->db->insert('client_links',$data);
	}

	public function delete_link($id)
	{
		$this->db->query("DELETE FROM client_links WHERE id= '$id'");
	}

}

/* End of file files_m.php */
/* Location: ./application/models/files_m.php */