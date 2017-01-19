<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Admin Controller
*
* @package		WiPeK CMS
* @author 		Krzysztof Adamczyk - WiPeK wipekxxx@gmail.com
* @copyright	Krzysztof Adamczyk 2015
* @version 		Version 1.0
*/

class Admin_Controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//set empty subview variable
		$this->data['subview'] = '';

		//load models
		$this->load->model('user_m');
		$this->load->model('page_config_m');
		$this->load->model('news_m');
		$this->load->model('files_m');
		$this->load->model('support_m');
		$this->load->model('logs_m');

		//load libraries
		$this->load->library('session');
		$this->load->driver('cache', array('adapter' => 'file'));
		$this->load->library('form_validation');

		//load helpers
		$this->load->helper('form');
		$this->load->helper('file');
		$this->load->helper('cms_helper');
		$this->load->helper('item_helper');

		if($this->admin_access() === false)
		{
			redirect(site_url());
		}

		$this->data['navbar_admin'] = 'admin/include/navbar_admin';

		$this->data['cmscfg'] = $this->page_config_m->get_cmsconfig();

		$this->data['site_name'] = $this->data['cmscfg']->name;

		$this->data['user_data'] = $this->user_m->get_user_data();

		$this->data['players_online'] = $this->page_config_m->get_online();

		$this->load->library('email', array(
    		'mailtype' => 'html',
    		'protocol' => 'smtp',
    		'smtp_host' => 'ssl://smtp.gmail.com',
    		'smtp_port' => '465',
    		'smtp_timeout' => '7',
    		'smtp_user' => $this->data['cmscfg']->cms_email,
    		'smtp_pass' => $this->data['cmscfg']->cms_email_pass,
    		'charset' => 'utf-8',
    		'newline' => "\r\n",
    	));
		
	}

	public function admin_access()
	{
		if($this->user_m->loggedin() == TRUE && $this->session->userdata('mods') === 'admin')
		{
			return true;
		}
		else
			return false;
	}

}

/* End of file Admin_Controller.php */
/* Location: ./application/controllers/Admin_Controller.php */