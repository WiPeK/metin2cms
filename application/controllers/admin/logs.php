<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$count = $this->logs_m->count_logs();

		//pagination
		$perpage = 50;
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
		$this->data['logs'] = $this->logs_m->get_logs($perpage, $offset);

		$this->data['subview'] = 'admin/logs/index';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);
	}

	public function is_logs()
	{
		$count = $this->logs_m->count_is_logs();

		//pagination
		$perpage = 50;
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
		$this->data['logs'] = $this->logs_m->get_is_logs($perpage, $offset);

		$this->data['subview'] = 'admin/logs/is_logs';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);
	}

	public function vip_logs()
	{
		$count = $this->logs_m->count_vip_logs();

		//pagination
		$perpage = 50;
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
		$this->data['logs'] = $this->logs_m->get_vip_logs($perpage, $offset);

		$this->data['subview'] = 'admin/logs/vip_logs';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);
	}

	public function cash_logs()
	{
		$count = $this->logs_m->count_cash_logs();

		//pagination
		$perpage = 50;
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
		$this->data['logs'] = $this->logs_m->get_cash_logs($perpage, $offset);

		$this->data['subview'] = 'admin/logs/cash_logs';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);
	}

	public function user_logs()
	{
		$count = $this->logs_m->count_user_logs();

		//pagination
		$perpage = 50;
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
		$this->data['logs'] = $this->logs_m->get_user_logs($perpage, $offset);

		$this->data['subview'] = 'admin/logs/user_logs';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);
	}

	public function command_logs()
	{
		$count = $this->logs_m->count_command_logs();

		//pagination
		$perpage = 50;
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
		$this->data['logs'] = $this->logs_m->get_command_logs($perpage, $offset);

		$this->data['subview'] = 'admin/logs/command_logs';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);
	}

}

/* End of file logs.php */
/* Location: ./application/controllers/logs.php */