<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Support Controller
*
* @package		WiPeK Metin2CMS
* @author 		Krzysztof Adamczyk - WiPeK wipekxxx@gmail.com
* @copyright	Krzysztof Adamczyk 2015
* @version 		Version 1.0
*/

class Support extends Frontend_Controller {

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
		//fetch rules
		$rules = $this->support_m->support_rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() === true)
		{
			//zapis wiadomości do db
			//save message to db
			if($this->support_m->save_application($this->input->post('email_support'),$this->input->post('support_body')) === true)
			{
				//wyslanie emaila
	    		$this->email->from($this->data['cmscfg']->cms_email, $this->data['cmscfg']->name);
	    		$this->email->to($this->input->post('email_support'));
	    		$this->email->subject("Zgłoszenie");
	    		$message = '<p>Wysłałeś zgłoszenie o treści:</p>';
	    		$message .= $this->input->post('support_body');
	    		$message .= "<p>Gdy zostanie rozpatrzone otrzymasz wiadomość.</p>";
	    		$this->email->message($message);

	    		if($this->email->send())
	    		{
	    			$this->data['message'] = 'Czekaj na rozpatrzenie twojego zgłoszenia. Odpowiedź otrzymasz na podany email.';
	    			$this->data['subview'] = 'messages/message';

	    			$this->load->view('front_layout');
	    		}
	    		else
	    		{
	    			redirect(site_url());
	    		}
			}
		}
		else
		{
			$this->data['subview'] = 'support/index';

	    	$this->load->view('front_layout', $this->data);
		}
	}

}

/* End of file support.php */
/* Location: ./application/controllers/support.php */