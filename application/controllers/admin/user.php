<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//count all accounts
		$count = $this->user_m->count_accounts();

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
		$this->data['users'] = $this->user_m->get_accounts($perpage, $offset);

		$this->data['subview'] = 'admin/user/index';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);	
	}

	public function edit($id = NULL)
	{
		if($id)
		{
			$this->data['user'] = $this->user_m->get_user($id);
			count($this->data['user']) || $this->data['errors'][] = 'user could not found';
			//user chars
			$this->data['user_chars'] = $this->user_m->get_user_chars($id);
		}
		else
		{
			$this->data['user'] = $this->user_m->get_new_acc();
		}

		$rules = $this->user_m->rules_edit_user;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == TRUE)
		{
			$this->data = $this->user_m->array_from_post(array(
				'login',
				'password',
				'social_id',
				'email',
				'status',
				'availDt',
				'cash',
				'gold_expire',
				'silver_expire',
				'money_drop_rate_expire',
			));

			if($this->data['password'] != '')
			{
				$this->data['password'] = '*' . strtoupper(sha1(sha1($this->data['password'],true)));
				if($id)
				{
					if($this->user_m->save_edited_acc($this->data,$id) == true)
					{
						$this->logs_m->log_edit_acc($id);
						redirect(site_url('admin/user/'));
					}
					else
					{
						if(isset($id))
						{
							redirect(site_url() . 'admin/user/edit/' . $id);
						}
						else
						{
							redirect(site_url() . 'admin/user/edit/');
						}
					}
				}
				else
				{
					if($this->user_m->save_new_acc($this->data) == true)
					{
						$this->logs_m->log_create_acc($this->data['login']);
						redirect(site_url('admin/user/'));
					}
					else
					{
						if(isset($id))
						{
							redirect(site_url() . 'admin/user/edit/' . $id);
						}
						else
						{
							redirect(site_url() . 'admin/user/edit/');
						}
					}
				}
			}
			else
			{
				if($id)
				{
					if($this->user_m->save_edited_acc($this->data,$id) == true)
					{
						$this->logs_m->log_edit_acc($id);
						redirect(site_url('admin/user/'));
					}
					else
					{
						if(isset($id))
						{
							redirect(site_url() . 'admin/user/edit/' . $id);
						}
						else
						{
							redirect(site_url() . 'admin/user/edit/');
						}
					}
				}
				else
				{
					if($this->user_m->save_new_acc($this->data) == true)
					{
						$this->logs_m->log_create_acc($this->data['login']);
						redirect(site_url('admin/user/'));
					}
					else
					{
						if(isset($id))
						{
							redirect(site_url() . 'admin/user/edit/' . $id);
						}
						else
						{
							redirect(site_url() . 'admin/user/edit/');
						}
					}
				}
			}
		}
		else
		{
			$this->data['subview'] = 'admin/user/edit';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);	
		}
	}

	public function delete_account($id)
	{
		$this->user_m->del_acc($id);

		$this->logs_m->log_del_acc($id);

		redirect(site_url('admin/user'));
	}

	public function search_acc()
	{
		$rules = $this->user_m->front_search_rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() === true)
		{
			$this->data['users'] = $this->user_m->search_acc($this->input->post('search_input'));

			$this->data['subview'] = 'admin/user/index';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);	
		}
		else
		{
			redirect(site_url());
		}
	}

	public function search_ip()
	{
		$rules = $this->user_m->ip_search_rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() === true)
		{
			$this->data['users'] = $this->user_m->search_ip($this->input->post('search_input'));

			$this->data['subview'] = 'admin/user/index_ip';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);	
		}
		else
		{
			redirect(site_url());
		}
	}

	public function search_char()
	{
		$rules = $this->user_m->front_search_rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() === true)
		{
			$this->data['users'] = $this->user_m->search_char($this->input->post('search_input'));

			$this->data['subview'] = 'admin/user/char_index';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);	
		}
		else
		{
			redirect(site_url());
		}
	}

	public function search_guild()
	{
		$rules = $this->user_m->front_search_rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() === true)
		{
			$this->data['guilds'] = $this->user_m->search_guild($this->input->post('search_input'));

			$this->data['subview'] = 'admin/user/guild_index';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);	
		}
		else
		{
			redirect(site_url());
		}
	}

	public function char_index()
	{
		//count all players
		$count = $this->user_m->count_chars();

		//pagination
		$perpage = 20;
		if($count > $perpage)
		{
			$this->load->library('pagination');
			$config['base_url'] = site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3) . '/');
			$config['total_rows'] = $count;
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
			if($this->uri->segment(4) == '' || $this->uri->segment(4) == 0)
			{
				$offset = 0;
			}
			elseif($this->uri->segment(4) >= $perpage)
			{
				$offset = $this->uri->segment(4);
			}
		}
		else
		{
			$this->data['pagination'] = '';
			$offset = 0;
		}
		// Fetch all accounts
		$this->data['users'] = $this->user_m->get_chars_pag($perpage, $offset);

		$this->data['subview'] = 'admin/user/char_index';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);
	}

	public function char_edit($id)
	{
		if(!$id)
		{
			redirect(site_url());
		}

		$this->data['char'] = $this->user_m->get_char_data($id);
		count($this->data['char']) || $this->data['errors'][] = 'char could not found';

		$rules = $this->user_m->rules_edit_char;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == TRUE)
		{
			$this->data = $this->user_m->array_from_post(array(
				'name',
				'level',
				'exp',
				'gold',
				'alignment',
				'horse_level'
			));

			$this->logs_m->log_edit_char($id);
			$this->user_m->update_char($this->data, $id);
			redirect(site_url('admin/user/char_index'));

		}
		else
		{
			$this->data['subview'] = 'admin/user/char_edit';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);	
		}
	}

	public function char_delete($id)
	{
		$this->logs_m->log_char_delete($id);
		$this->user_m->delete_char($id);
		redirect(site_url('admin/user/char_index'));
	}

	public function block($id)
	{
		if(!$id)
		{
			redirect(site_url());
		}

		$rules = $this->user_m->rules_block;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == true)
		{
			if($this->user_m->ban_user($id) == false)
			{
				$this->logs_m->log_block_user($id);
				redirect(site_url() . 'admin/user/block/' . $id);
			}
			else
			{
				redirect(site_url() . 'admin/user/block/' . $id);
			}
		}
		else
		{
			$this->data['user'] = $this->user_m->get_user($id);
			$this->data['block_user'] = $this->user_m->get_banned($id);

			$this->data['subview'] = 'admin/user/block';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);	
		}
	} 

	public function unblock($id)
	{
		$this->user_m->unblock_user($id);
		$this->logs_m->log_unblock_user($id);
		redirect(site_url() . 'admin/user/block/' . $id);
	}

	public function guild_index()
	{
		//count all accounts
		$count = $this->user_m->count_guilds();

		//pagination
		$perpage = 20;
		if($count > $perpage)
		{
			$this->load->library('pagination');
			$config['base_url'] = site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3) . '/');
			$config['total_rows'] = $count;
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
			if($this->uri->segment(4) == '' || $this->uri->segment(4) == 0)
			{
				$offset = 0;
			}
			elseif($this->uri->segment(4) >= $perpage)
			{
				$offset = $this->uri->segment(4);
			}
		}
		else
		{
			$this->data['pagination'] = '';
			$offset = 0;
		}
		// Fetch all accounts
		$this->data['guilds'] = $this->user_m->get_guilds_pag($perpage, $offset);

		$this->data['subview'] = 'admin/user/guild_index';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);
	}

	public function banned_index()
	{
		$count = $this->user_m->count_banned_accounts();

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
		$this->data['users'] = $this->user_m->get_banned_accounts($perpage, $offset);

		$this->data['subview'] = 'admin/user/banned_index';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);	
	}

	public function block_ip($id)
	{
		if(!$id)
		{
			redirect(site_url());
		}

		if($this->user_m->block_ip($id) === true)
		{
			$this->logs_m->log_block_ip($id);
			redirect(site_url() . 'admin/user/banned_index');
		}
		redirect(site_url() . 'admin/user/banned_index');
	}

	public function _pass_password($str)
	{
		//pobranie hasła z db
		$old_pass_db = $this->user_m->get_password($this->session->userdata('login'));  
		//sprawdzenie czy stare hasło wpisane w formularzu jest identyczne z hasłem z db
		$pass_from_input = '*' . strtoupper(sha1(sha1($this->input->post('old_password'),true)));

		if($old_pass_db === $pass_from_input)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('_pass_password', '%s musi być twoim starym hasłem');
			return false;
		}
	}

	public function _pass_delcode($str)
	{
		//pobranie kodu z db
		$old_del_code = $this->user_m->get_del_code($this->session->userdata('login'));  
		//sprawdzenie czy stare hasło wpisane w formularzu jest identyczne z hasłem z db
		$del_code_from_input = $this->input->post('old_del_code');

		if($old_del_code == $del_code_from_input)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('_pass_delcode', '%s musi być twoim starym kodem');
			return false;
		}
	}

	public function _unique_email($str)
	{
		if($this->user_m->check_unique_email($str) == false)
		{
			$this->form_validation->set_message('_unique_email', '%s jest już w użyciu');
			return false;
		}
		else
		{
			return true;
		}
	}

	//callback sprawdzania czy zgodny email
	public function _pass_email ($str)
	{
		//pobranie kodu z db
		$old_email = $this->user_m->get_email_remind($this->session->userdata('login'));  
		//sprawdzenie czy stare hasło wpisane w formularzu jest identyczne z hasłem z db
		$email_from_input = $this->input->post('old_email');

		if($old_email === $email_from_input)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('_pass_email', '%s musi być twoim starym emailem.');
			return false;
		}
	}
	//calback sprawdzania ostatniej zmiany
	public function _last_email_change ($str)
	{
		//sprawdzic czy uzytkownik cos zmienial
		if($this->user_m->are_user_change_sth($this->session->userdata('login')) === true)
		{
			//pobranie kodu z db
			$last_change = $this->user_m->get_last_email_change($this->session->userdata('login'));  

			$now = date('Y-m-d H:i:s');
			$day_ago = strtotime(date("Y-m-d H:i:s", strtotime($now)) . " -1 day");
			$yesterday = date('Y-m-d H:i:s', $day_ago);

			//jesli data ostatniej zmiany jest mniejsza niz jednen dzień wstecz
			if($last_change < $yesterday)
			{
				return true;
			}
			else
			{
				$this->form_validation->set_message('_last_email_change', 'Email może być zmieniony raz na 24 godziny.');
				return false;
			}
			
		}
		else
		{
			return true;
		}
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */