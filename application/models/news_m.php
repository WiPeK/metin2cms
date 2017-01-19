<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_m extends MY_Model {

	protected $_table_name = 'articles';
	protected $_order_by = 'pubdate desc, id desc';
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();	
	}

	public $rules = array(
		'pubdate' => array(
			'field' => 'pubdate', 
			'label' => 'Publication date', 
			'rules' => 'trim|required|xss_clean'
		), 
		'title' => array(
			'field' => 'title', 
			'label' => 'Title', 
			'rules' => 'trim|required|max_length[100]|xss_clean'
		), 
		'body' => array(
			'field' => 'body', 
			'label' => 'Body', 
			'rules' => 'trim|required'
		),
	);

	public function get_news()
	{
		$query = $this->db->query("SELECT * FROM articles ORDER BY pubdate DESC LIMIT 5");
		return $query->result();
	}

	public function get_new ()
	{
		$article = new stdClass();
		$article->id = '';
		$article->created = date('Y-m-d H:i:s');
		$article->modified = '0000-00-00 00:00:00';
		$article->created_by = $this->session->userdata('login');
		$article->modified_by = '';
		$article->title = '';
		$article->body = '';
		$article->views = '';
		$article->pubdate = date('Y-m-d H:i:s');
		return $article;
	}

	public function set_published(){
		$this->db->where('pubdate <=', date('Y-m-d H:i:s'));
	}
	
	public function get_recent($limit = 3){
		
		// Fetch a limited number of recent articles
		$limit = (int) $limit;
		$this->set_published();
		$this->db->limit($limit);
		return parent::get();
	}

	public function add_views($id)
	{
		$this->db->query("UPDATE articles SET views=views+1 WHERE id='$id'");
		if($this->db->affected_rows() === 1)
		{
			return true;
		}
		else
			return false;
	}

	public function get_new_news_id($title)
	{
		$query = $this->db->query("SELECT id FROM articles WHERE title='$title'");
		return $query->row('id');
	}

	public function title_deleted_news($id)
	{
		$query = $this->db->query("SELECT title FROM articles WHERE id='$id'");
		return $query->row('title');
	}

}

/* End of file news_m.php */
/* Location: ./application/models/news_m.php */