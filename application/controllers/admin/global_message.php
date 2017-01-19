<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_message extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$rules = $this->user_m->global_message_rules;
    	$this->form_validation->set_rules($rules);

    	if($this->form_validation->run() === false)
    	{	
			$this->data['subview'] = 'admin/global_message/index';
			$this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);
		}
    	else
    	{
    		$this->email->from($this->data['cmscfg']->cms_email, $this->data['cmscfg']->name);

            $emails = $this->user_m->get_emails();

            foreach($emails as $email){
        		$this->email->to($email);
        		$this->email->subject($this->input->post('subject'));
        		$message = $this->input->post('message_body');
                $this->email->message($message);
                $this->email->send();
            }

            $this->logs_m->log_send_gl_mess();

    		$this->data['message'] = 'Email wyslany';
            $this->data['subview'] = 'admin/global_message/index';
            $this->load->view('admin/include/header', $this->data);
			$this->load->view('admin/admin_layout', $this->data);
			$this->load->view('admin/include/footer', $this->data);
		}
	}

}

/* End of file global_message.php */
/* Location: ./application/controllers/global_message.php */