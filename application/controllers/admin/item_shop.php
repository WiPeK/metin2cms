<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_shop extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('shop_m');
	}

	public function index()
	{
		$count = $this->shop_m->count_shop_items();

		//pagination
		$perpage = 20;
		if($count > $perpage)
		{
			$this->load->library('pagination');
			$config['base_url'] = site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/');
			$config['total_rows'] = $count;
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
			if($this->uri->segment(3) == '' || $this->uri->segment(3) == 0)
			{
				$offset = 0;
			}
			elseif($this->uri->segment(3) >= $perpage)
			{
				$offset = $this->uri->segment(3);
			}
		}
		else
		{
			$this->data['pagination'] = '';
			$offset = 0;
		}
		// Fetch all accounts
		$this->data['item_shop'] = $this->shop_m->get_shop_items($perpage, $offset);

		$this->data['subview'] = 'admin/item_shop/index';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);
	}

	public function add_category($id = NULL)
	{
		if($id)
		{
			$this->data['category']['name'] = $this->shop_m->get_category($id);
			count($this->data['category']) || $this->data['errors'][] = 'category could not found';
		}
		else
		{
			$this->data['category']['name']= '';
		}
		
		$rules = $this->shop_m->rules_category;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == TRUE)
		{
			$this->data = $this->shop_m->array_from_post(array(
				'category',
			));

			if($id)
			{
				$this->shop_m->edit_category($this->data,$id);
				$this->logs_m->log_edit_cat($id);
			}
			else
			{
				$this->shop_m->add_category($this->data);
				$this->logs_m->log_add_cat();
			}
			$this->cache->clean();
			redirect(site_url('admin/item_shop'));

		}
		else
		{
			$this->data['subview'] = 'admin/item_shop/edit_category';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);	
		}
	}

	public function add_item($id = NULL)
	{
		if($id)
		{
			$this->data['shop_item'] = $this->shop_m->get_shop_item($id);
			count($this->data['shop_item']) || $this->data['errors'][] = 'item could not found';
		}
		else
		{
			$this->data['shop_item']= $this->shop_m->get_new_is();
		}

		$this->data['drop_cat'] = $this->shop_m->get_category_to_dropdown();

		$rules = $this->shop_m->items_rules;
		$this->form_validation->set_rules($rules);

		if($this->input->post('submit'))
		{
			$img_link = $this->input->post('vnum');
			$config = array(
				'upload_path' => realpath(APPPATH . '../public_html/assets/shop/'),
				'allowed_types' => 'jpg|jpeg|gif|png',
				'max_size' => 3000,
				'remove_spaces' => true,
				'overwrite' => true,
				'quality' => '100',
				'file_name' => $img_link,
			);
			$this->load->library('upload', $config);
			if($this->form_validation->run() == TRUE)
			{
				$this->data = $this->shop_m->array_from_post(array(
					'name',
					'stack',
					'price',
					'describe',
					'category_id',
					'vnum'
				));

				if($this->upload->do_upload('logo'))
				{
					$data_img = array('upload_data' => $this->upload->data());
					$file = $data_img['upload_data']['orig_name'];
					$this->data['logo'] = $file; 
				}
				$this->cache->clean();
				if($id)
				{
					$this->shop_m->update_item($this->data,$id);

					$this->logs_m->log_edit_shop_item($id, $this->data['name']);

					redirect(site_url('admin/item_shop'));
				}
				else
				{
					$this->shop_m->add_new_item($this->data);

					$this->logs_m->log_add_new_shop_item($this->data['name']);

					redirect(site_url('admin/item_shop'));
				}
			}
			elseif($this->form_validation->run() == FALSE || !$this->upload->do_upload())
			{
				$this->data['subview'] = 'admin/item_shop/edit_item';
				$this->load->view('admin/include/header', $this->data);
				$this->load->view('admin/admin_layout', $this->data);
				$this->load->view('admin/include/footer', $this->data);	
			}
		}
		else
		{
			$this->data['subview'] = 'admin/item_shop/edit_item';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);	
		}
	}

	public function delete_item($id)
	{
		$this->shop_m->delete_item($id);

		$this->logs_m->log_delete_shop_item($id);
		$this->cache->clean();
		redirect(site_url('admin/item_shop'));
	}

	public function delete_category($id)
	{
		$this->shop_m->delete_category($id);

		$this->logs_m->log_delete_shop_cat($id);
		$this->cache->clean();
		redirect(site_url('admin/item_shop'));
	}

	public function vip_category()
	{
		$this->data['vips_cat'] = $this->shop_m->get_vips();

		$this->data['subview'] = 'admin/item_shop/vip_category';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);	
	}

	public function vip_edit($id = NULL)
	{
		if($id)
		{
			$this->data['vip_cat'] = $this->shop_m->get_shop_vip($id);
			count($this->data['vip_cat']) || $this->data['errors'][] = 'vip could not found';
		}
		else
		{
			$this->data['vip_cat']= $this->shop_m->get_new_vip();
		}

		$rules = $this->shop_m->vip_rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == true)
		{
			if($id)
			{	
				if($this->shop_m->save_vip($id) == true)
				{
					$this->logs_m->log_save_vip($id);
					$this->cache->clean();
					redirect(site_url('admin/item_shop/vip_category'));
				}
				else
				{
					redirect(site_url('admin/item_shop/vip_category'));
				}
			}
			else
			{
				if($this->shop_m->save_new_vip() == true)
				{
					$this->logs_m->log_save_new_vip($id);
					$this->cache->clean();
					redirect(site_url('admin/item_shop/vip_category'));
				}
				else
				{
					redirect(site_url('admin/item_shop/vip_category'));
				}	
			}
		}
		else
		{
			$this->data['subview'] = 'admin/item_shop/vip_edit';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);	
		}
	}

	public function vip_delete($id)
	{
		if($this->shop_m->vip_delete($id) == true)
		{
			$this->cache->clean();
			$this->logs_m->log_vip_delete($id);
			redirect(site_url('admin/item_shop/vip_category'));
		}
	}

	public function _category_check($str)
	{
		if($this->shop_m->check_category($str) == true)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('_category_check', 'Taka kategoria już istnieje');
			return false;
		}
	}
}

/* End of file item_shop.php */
/* Location: ./application/controllers/item_shop.php */