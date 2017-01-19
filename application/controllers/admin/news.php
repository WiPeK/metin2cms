<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//count all articles
		$count = $this->db->count_all_results('articles');

		//pagination
		$perpage = 10;
		if($count > $perpage)
		{
			$this->load->library('pagination');
			$config['base_url'] = site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/');
			$config['total_rows'] = $count;
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
			$offset = $this->uri->segment(3);
		}
		else
		{
			$this->data['pagination'] = '';
			$offset = 0;
		}
		// Fetch all articles
		$this->db->limit($perpage, $offset);
		$this->data['articles'] = $this->news_m->get();

		$this->data['subview'] = 'admin/news/index';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);		
	}

	public function edit($id = NULL)
	{
		if ($id) {
			$this->data['article'] = $this->news_m->get($id);			
			count($this->data['article']) || $this->data['errors'][] = 'news could not be found';
		}
		else {
			$this->data['article'] = $this->news_m->get_new();
		}

		$rules = $this->news_m->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() === TRUE)
		{
			$this->data = $this->news_m->array_from_post(array(
				'title',
				'body',
				'pubdate'
			));

			if ($id) {			
				$this->data['modified_by'] = $this->session->userdata('login');
				$this->data['modified'] = date('Y-m-d H:i:s');
			}
			else {
				$this->data['created_by'] = $this->session->userdata('login');	
				$this->data['modified'] = '';	
				$this->data['modified_by'] = '';
			}

			$this->news_m->save($this->data, $id);
			$this->cache->clean();
			if($id)
			{
				$this->logs_m->log_edit_news($id, $this->data['title']);
				redirect('admin/news/edit/' . $id);
			}
			else
			{
				$idu = $this->news_m->get_new_news_id($this->data['title']);
				$this->logs_m->log_add_news($idu, $this->data['title']);
				redirect('admin/news/edit/' . $idu);
			}
		}
		else
		{
			$this->data['subview'] = 'admin/news/edit';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);	
		}
	}

	public function delete ($id)
	{
		$del_title = $this->news_m->title_deleted_news($id);
		
		$this->news_m->delete($id);

		$this->logs_m->log_delete_news($id, $del_title);
		$this->cache->clean();
		redirect('admin/news');
	}

}

/* End of file news.php */
/* Location: ./application/controllers/news.php */