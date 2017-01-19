<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Home Controller
*
* @package		WiPeK Metin2CMS
* @author 		Krzysztof Adamczyk - WiPeK wipekxxx@gmail.com
* @copyright	Krzysztof Adamczyk 2015
* @version 		Version 1.0
*/

class Home extends Frontend_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_m');
	}

	public function index()
	{
		$cacheHNEWS = 'cacheHNEWS';
		if (!$this->data['news_data'] = $this->cache->get($cacheHNEWS)) {
			//fetch news
			$this->data['news_data'] = $this->news_m->get_news();
			$this->cache->save($cacheHNEWS, $this->data['news_data'],3600);
		}
		
		//load view
		$this->data['subview'] = 'news/index';
		$this->load->view('front_layout', $this->data);
	}

	public function license()
	{
		echo 'WiPeK Metin2 CMS' . br();
		echo 'Krzysztof Adamczyk' . br();
		echo '2015' . br();
		echo 'Kontakt: <a href="mailto:wipekxxx@gmail.com">wipekxxx@gmail.com</a>' . br();
		$server_key = '1d32ddd9316b8a5a022ccd8acbaa7f5f';
		echo 'Klucz licencji: ' . $server_key . br();
		echo br(3);
		echo 'Licencja Bootstrap: ' . anchor(site_url() . 'LICENSE_Bootstrap.txt', 'LICENSE_Bootstrap.txt') . br();
		echo 'Licencja CKEDITOR: ' . anchor(site_url() . 'ckeditor_license.txt', 'ckeditor_license.txt') . br();
		echo 'Licencja Codeigniter: ' . anchor(site_url() . 'license.txt', 'license.txt') . br();
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */