<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Client_download Controller
*
* @package		WiPeK Metin2CMS
* @author 		Krzysztof Adamczyk - WiPeK wipekxxx@gmail.com
* @copyright	Krzysztof Adamczyk 2015
* @version 		Version 1.0
*/

class Client_download extends Frontend_Controller {

	public function __construct()
	{
		parent::__construct();
		//load model
		$this->load->model('files_m');
	}

	public function index()
	{
		//caching client downloads links
		$cacheCLINK = 'cacheCLINK';
		if(!$this->data['client_links'] = $this->cache->get($cacheCLINK))
		{
			//fetch links to client downloads
			$this->data['client_links'] = $this->files_m->get_client_links();
			$this->cache->save($cacheCLINK, $this->data['client_links'],3600);
		}
		

		//load view
		$this->data['subview'] = 'client/index';
		$this->load->view('front_layout', $this->data);
	}

}

/* End of file client_download.php */
/* Location: ./application/controllers/client_download.php */