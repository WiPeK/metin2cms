<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
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

	public function index()
	{
		$this->data['support_new'] = $this->support_m->get_support('new');
		$this->data['support_answered'] = $this->support_m->get_support('made');
		
		$this->data['subview'] = 'admin/support/index';
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);	
	}

	public function answer($id)
	{
		//pobranie emaila i tresci z id tego kto zgłaszał
		$this->data['support'] = $this->support_m->get_email_n_body($id);
		
		//formularz
		$rules = $this->support_m->support_admin;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() === true)
		{
			$data = array(
				'who_answer' => $this->session->userdata('login'),
				'status' => 'made',
				'answer_date' => date('Y-m-d H:i:s'),
				'answer_body' => $this->input->post('answer_body')
			);
			if($this->support_m->save_answer($data, $id) === true)
			{
				$this->email->from($this->data['cmscfg']->cms_email, $this->data['cmscfg']->name);
	    		$this->email->to($this->data['support']->email);
	    		$this->email->subject("Rozpatrzenie zgłoszenia");
	    		$message = $this->input->post('answer_body');
	    		$message .= 'Administrator: ' . $this->session->userdata('login');

	    		$this->email->message($message);

	    		if($this->email->send())
	    		{
	    			$this->logs_m->log_answer_support($id);
	    			redirect(site_url() . 'admin/support/show_answered/' . $id);
	    		}

			}
			
		}
			$this->data['subview'] = 'admin/support/answer';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);	
		
	}

	public function show_answered($id)
	{
		$this->data['show_answer'] = $this->support_m->show_answered($id);

		$this->data['subview'] = 'admin/support/show_answered';

		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/admin_layout', $this->data);
		$this->load->view('admin/include/footer', $this->data);	
	}

}

/* End of file support.php */
/* Location: ./application/controllers/support.php */