<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_m extends MY_Model {

	protected $_table_name = 'gallery';
	protected $_order_by = 'add_date';

	public function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../public_html/assets/images/gallery/');
		$this->gallery_path_url = base_url() . 'assets/images/gallery/';
	}

	public function get_images_url()
	{
		$images_url = parent::get();

		$images = array();
		if(count($images_url))
		{
			foreach($images_url as $image_url)
			{
				$images[] = array(
					'img_title' => $image_url->img_title,
					'img_describe' => $image_url->img_describe,
					'img_who_add' => $image_url->img_who_add,
					'add_date' => $image_url->add_date,
					'img_url' => base_url() . $image_url->img_url,
					'thumb_url' => base_url() . $image_url->thumb_url,
				);
			}
		}
		return $images; 
	}

	public function save_img($image)
	{
		//dodanie danych obrazka do bazy danych
		$add_date = date('Y-m-d H:i:s');
		$who_add = $this->session->userdata('login');
		$data = array(
			'img_title' => $image['img_title'],
			'img_describe' => $image['opis'],
			'img_who_add' => $who_add,
			'add_date' => $add_date,
			'img_url' => $image['img_url'],
			'thumb_url' => $image['thumb_url'],
		);
		$this->db->insert('gallery',$data);
	}

	public function delete_image($title)
	{	
		$this->db->query("DELETE FROM gallery WHERE img_title='$title'");
	}

	public function get_img_urls($title)
	{
		$query = $this->db->query("SELECT img_url, thumb_url FROM gallery WHERE img_title='$title'");
		return $query->result();
	}

}

/* End of file gallery_m.php */
/* Location: ./application/models/gallery_m.php */