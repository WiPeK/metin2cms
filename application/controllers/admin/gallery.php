<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('gallery_m');
	}

	public function index()
	{
		$this->data['images'] = $this->gallery_m->get_images_url();
		$this->data['error'] = null;

		$this->data['subview'] = 'admin/gallery/gallery';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);	
	}

	public function do_upload()
	{
		$this->data['error'] ='';

		$this->form_validation->set_rules('img_title', 'Tytuł obrazka', 'trim|xss_clean|required|min_length[3]|max_length[100]|callback__alpha_dash_space|is_unique[gallery.img_title]');
		$this->form_validation->set_rules('opis', 'Opis', 'trim|xss_clean');
		$this->form_validation->set_message('callback__alpha_dash_space', 'Pole może zawierać tylko litery, cyfry i spacje');
		$this->form_validation->set_message('required','Pole %s jest wymagane');
		$this->form_validation->set_message('min_length','Za mało znaków');
		$this->form_validation->set_message('max_length','Za dużo znaków');
		$this->form_validation->set_message('unique','Zawartość pola musi być unikalna');
		
		if($this->input->post('upload'))
		{

			//folder zapisu obrazków
			$this->gallery_path = realpath(APPPATH . '../public_html/assets/gallery/');
			
			$config = array(
				'upload_path' => $this->gallery_path,
				'allowed_types' => 'jpg|jpeg|gif|png',
				'max_size' => 3000,
				'remove_spaces' => true,
				'quality' => '100',
				'overwrite' => true,
				'file_name' => md5(str_replace(' ','',$this->input->post('img_title'))),
			);

			$this->load->library('upload', $config);

			if($this->form_validation->run() == FALSE || !$this->upload->do_upload())
			{	
				$this->data['images'] = $this->gallery_m->get_images_url();
				$this->data['error'] = 'There was a problem with your upload!';

				$this->data['subview'] = 'admin/gallery/gallery';
				$this->load->view('admin/include/header', $this->data);
				$this->load->view('admin/admin_layout', $this->data);
				$this->load->view('admin/include/footer', $this->data);	
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
			
				$imgtitle = md5(str_replace(' ','',$this->input->post('img_title')));

				$filenewz = $this->gallery_path. '/' . $imgtitle . $data['upload_data']['file_ext'];

				$configB['image_library'] = 'gd2';
				$configB['source_image'] = $filenewz;
				$configB['new_image'] = $this->gallery_path . '/thumbs';
				$configB['maintain_ratio'] = true;
				$configB['width'] = 200;
				$configB['height'] = 200;

				$this->load->library('image_lib', $configB); 
                $this->image_lib->resize();
				
				$thumb_url = $this->gallery_path . 'thumbs/';

				$this->data = array(
					'img_title' => $this->input->post('img_title'),
					'opis' => $this->input->post('opis'),
					'img_url' => 'assets/gallery/' . $imgtitle . $data['upload_data']['file_ext'],
					'thumb_url' => 'assets/gallery/thumbs/' . $imgtitle . $data['upload_data']['file_ext'],
				);

				$this->logs_m->log_add_img($this->data['img_title'],$this->data['img_url']);
				//save img data to db
				$this->cache->clean();
				$this->gallery_m->save_img($this->data);
				redirect('admin/gallery');
			}
		}
	}

	public function delete_image($titleh)
	{
		$title = base64_decode(urldecode($titleh));
		$data = $this->gallery_m->get_img_urls($title);
		unlink(realpath(APPPATH . '../public_html/' . $data[0]->img_url));
		unlink(realpath(APPPATH . '../public_html/' . $data[0]->thumb_url));
		//usuwanie z db
		$this->gallery_m->delete_image($title);
		//usuwanie z folderu
		$this->logs_m->log_delete_img($title);
		$this->cache->clean();
		redirect('admin/gallery');
	}

	public function alpha_dash_space($str)
	{
    	return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
	} 

}

/* End of file gallery.php */
/* Location: ./application/controllers/gallery.php */