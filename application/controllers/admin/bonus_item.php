<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bonus_item extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('bonus_item_m');
	}

	public function index()
	{
		$this->data['item_bonus'] = $this->bonus_item_m->get_index_bonus();

		$this->data['subview'] = 'admin/bonus_item/index';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);	
	}

	public function edit_bon($id)
	{
		if(!$id)
		{
			redirect(site_url('bonus_item/index'));
		}

		$rules = $this->bonus_item_m->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() === true)
		{
			if($this->bonus_item_m->save_bonus($id) == true)
			{
				$this->logs_m->log_edit_bonus($id);
				redirect(site_url() . 'admin/bonus_item/edit_bon/' . $id);
			}
			else
			{
				$this->data['bonus_data'] = $this->bonus_item_m->get_bonus($id);
			
				$this->data['subview'] = 'admin/bonus_item/edit';
				$this->load->view('admin/include/header', $this->data);
				$this->load->view('admin/admin_layout', $this->data);
				$this->load->view('admin/include/footer', $this->data);	
			}
		}
		else
		{
			$this->data['bonus_data'] = $this->bonus_item_m->get_bonus($id);
			
			$this->data['subview'] = 'admin/bonus_item/edit';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);			
		}
	}

}

/* End of file bonus_item.php */
/* Location: ./application/controllers/bonus_item.php */