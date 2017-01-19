<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_files extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
	}

	public function index()
	{
		$this->data['files'] = $this->files_m->get_files();
		$this->data['error'] = null;

		$this->data['subview'] = 'admin/files/manage_files';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);			
	}

	public function do_upload()
	{
		$rules = $this->files_m->file_rules;
		$this->form_validation->set_rules($rules);

		if($this->input->post('upload'))
		{
			$this->file_path = realpath(APPPATH . '../assets/uploaded_files/');

			$config['upload_path'] = $this->file_path;
			$config['max_size'] = 1000000;
			$config['allowed_types'] = 'hqx|cpt|csv|bin|dms|lha|lzh|exe|class|psd|so|sea|dll|oda|pdf|ai|eps|ps|smi|smil|mif|xls|ppt|wbxml|wmlc|dcr|dir|dxr|dvi|gtar|gz|php|php4|php3|phtml|phps|js|swf|sit|tar|tgz|xhtml|xht|zip|mid|midi|mpga|mp2|mp3|aif|aiff|aifc|ram|rm|rpm|ra|rv|wav|bmp|gif|jpeg|jpg|jpe|png|tiff|tif|css|html|htm|shtml|txt|text|log|rtx|rtf|xml|xsl|mpeg|mpg|mpe|qt|mov|avi|movie|doc|docx|xlsx|word|xl|eml|ico|json|3gp|7z|aac|apk|dxf|torrent|bz|bz2|flv|jar|java|m3u|m4v|mdb|pptx|wmv|mid|ogg|odt|rar|rss|svg';
			$config['file_name'] = md5(str_replace(' ','',$this->input->post('file_title')));

			$this->load->library('upload', $config);

			if($this->form_validation->run() == FALSE || !$this->upload->do_upload())
			{
				$this->data['files'] = $this->files_m->get_files();
				$this->data['error'] = 'Upload pliku zakończony niepowodzeniem';
				
				$this->data['subview'] = 'admin/files/manage_files';
				$this->load->view('admin/include/header', $this->data);
				$this->load->view('admin/admin_layout', $this->data);
				$this->load->view('admin/include/footer', $this->data);	
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$this->data = array(
					'file_title' => $this->input->post('file_title'),
					'file_url' => $data['upload_data']['file_name'],
					'extension' => $data['upload_data']['file_ext'], 
					'raw_name' => $data['upload_data']['raw_name'], 
					'file_size' => $data['upload_data']['file_size'], 
				);

				$this->logs_m->log_add_file($this->data['file_title']);
				$this->files_m->save_file($this->data);
				redirect('admin/manage_files');
			}
		}
	}

	public function delete_file($file_title)
	{
		//usuwanie z db
		$title = base64_decode(urldecode($file_title));
		$this->files_m->delete_file($title);
		//usuwanie z folderu
		unlink(realpath(APPPATH . '../assets/uploaded_files/') . '/' . $title); 

		$this->logs_m->log_delete_file($file_title);
		redirect('admin/manage_files');
	}

	public function alpha_dash_space($str)
	{
    	return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
	}

}

/* End of file manage_files.php */
/* Location: ./application/controllers/manage_files.php */