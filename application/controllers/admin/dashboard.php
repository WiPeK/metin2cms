<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		$this->data['browser_usage'] = $this->page_config_m->get_browser_usage();
		$this->data['system_usage'] = $this->page_config_m->get_system_usage();
		$this->data['browsers'] = $this->page_config_m->get_browsers();

		$this->data['sales_items'] = $this->page_config_m->get_sales_items();

		$this->data['highcharts'] = true;
		$this->data['cdata'] = $this->page_config_m->data_to_dashboard();

		$this->data['subview'] = 'admin/dashboard/index';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */