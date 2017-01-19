<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['errors'] = array();
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */