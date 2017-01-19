<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Download_menager Controller
*
* @package		WiPeK Metin2CMS
* @author 		Krzysztof Adamczyk - WiPeK wipekxxx@gmail.com
* @copyright	Krzysztof Adamczyk 2015
* @version 		Version 1.0
*/

class Download_menager extends Frontend_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
		$this->load->model('files_m');
	}

	public function index($file_data,$file)
	{
		$all_file = $this->files_m->get_extension($file);
		$data = file_get_contents(realpath(APPPATH . '../assets/uploaded_files/' . $file . $all_file));
		$name = base64_decode(urldecode($file_data));
		force_download($name, $data);
	}

}

/* End of file download_menager.php */
/* Location: ./application/controllers/download_menager.php */