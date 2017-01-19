<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_download extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$rules = $this->files_m->rules_client;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == true)
		{
			$this->files_m->save_client_link($this->input->post('client_url'),$this->input->post('name'));
			$this->logs_m->log_add_client_link();
			$this->cache->clean();
			redirect(site_url('admin/client_download'));
		}
		else
		{
			$this->data['client_links'] = $this->files_m->get_client_links();

			$this->data['subview'] = 'admin/client/index';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);
		}	
	}

	public function cdelete($id)
	{
		$this->files_m->delete_link($id);
		$this->logs_m->log_delete_clink();
		$this->cache->clean();
		redirect(site_url('admin/client_download'));
	}

}

/* End of file client_download.php */
/* Location: ./application/controllers/client_download.php */