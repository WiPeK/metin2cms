<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Gallery Controller
*
* @package		WiPeK Metin2CMS
* @author 		Krzysztof Adamczyk - WiPeK wipekxxx@gmail.com
* @copyright	Krzysztof Adamczyk 2015
* @version 		Version 1.0
*/

class Gallery extends Frontend_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('gallery_m');
	}

	public function index()
	{
		$cacheGIMAGES = 'cacheGIMAGES';
		if(!$this->data['images'] = $this->cache->get($cacheGIMAGES))
		{
			//fetch images to gallery
			$this->data['images'] = $this->gallery_m->get_images_url();
			$this->cache->save($cacheGIMAGES, $this->data['images'],3600);
		}
		//if gallery is true then gallery script are loading
		$this->data['gallery_page'] = true;
		//load view
		$this->data['subview'] = 'gallery/index';
		$this->load->view('front_layout', $this->data);
	}

}

/* End of file gallery.php */
/* Location: ./application/controllers/gallery.php */