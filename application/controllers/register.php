<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Register Controller
*
* @package		WiPeK Metin2CMS
* @author 		Krzysztof Adamczyk - WiPeK wipekxxx@gmail.com
* @copyright	Krzysztof Adamczyk 2015
* @version 		Version 1.0
*/

class Register extends Frontend_Controller {

	public function __construct()
	{
		parent::__construct();

		//load email library
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

		//load captcha helper
		$this->load->helper('captcha');

		//load register model
		$this->load->model('register_m');
	}

	public function index()
	{
		//metoda index ładuje regulamin, który należy potwierdzić aby przystąpić do rejestracji
		
		//sprawdzenie czy rejestracja jest włączona
		//check register status
		if($this->page_config_m->register_status() === false)
		{	
			//if register is off load view with message
			$this->data['message'] = 'Niestety, ale rejestracja jest wyłączona.';
			$this->data['subview'] = 'messages/message';
			$this->load->view('front_layout',$this->data);
		}
		elseif($this->page_config_m->register_status() === true)
		{
			//if register is on load this view where you must accept reg
			$this->data['subview'] = 'register/regulamin';
			$this->load->view('front_layout',$this->data);
		}

	}

	public function account()
	{
		//sprawdzenie czy rejestracja jest włączona
		if($this->page_config_m->register_status() === false)
		{
			//if register is off load view with message
			$this->data['message'] = 'Niestety, ale rejestracja jest wyłączona.';
			$this->data['statement'] = 'messages/message';
			$this->load->view('front_layout',$this->data);
		}
		elseif($this->page_config_m->register_status() === true)
		{	
			//jeżeli użytkownik jest zalogowany - przekierowanie
			//if user is loggedin redirect
			if($this->user_m->loggedin() == TRUE && $this->session->userdata('mods') === 'admin')
	        {
	        	//if user is admin redirect to admin dashboard
	            redirect(site_url('admin/dashboard'));
	        }
	        elseif($this->user_m->loggedin() == TRUE && $this->session->userdata('mods') === 'user')
	        {
	        	//if user is not admin redirect to site url
	            redirect(site_url());
	        }

	        //ustalenie reguł formularzy
	        $rules = $this->register_m->rules;
	        $this->form_validation->set_rules($rules);

	        //ustawić globalne błędy walidacji po polsku

	        if($this->form_validation->run() === false)
	        {
	        	//create captcha image
	        	$this->data['image'] = $this->register_m->create_image();
	        	$this->data['subview'] = 'register/register';

	        	$this->load->view('front_layout', $this->data);
	        }
	        else
	        {
	        	//generate unique id
	        	$key = md5(uniqid());

	        	//create email
	        	$this->email->from($this->data['cmscfg']->cms_email, $this->data['cmscfg']->name);
	    		$this->email->to($this->input->post('email'));
	    		$this->email->subject("Potwierdzenie rejestracji");
	    		$message = '<p>Dziękujemy za rejestrację</p>';
	    		$message .= "<p><a href='".base_url()."register/activate_user/$key'>Kliknij tutaj</a> aby potwierdzić rejestracje</p>";

	    		$this->email->message($message);

	    		if($this->register_m->add_user($key))
	    		{
	    			//send email
	    			if($this->email->send())
	    			{
	    				//if email send success
	    				$this->data['message'] = 'Email został wysłany. Aby aktywować konto potwierdź go.';
	    				$this->data['subview'] = 'messages/message';
	    				$this->load->view('front_layout',$this->data);
	    			}
	    			else
	    			{
	    				//if email end failed
	    				$this->data['message'] = 'Rejestracja lub wysyłanie email zakończone niepowodzeniem. Spróbuj jeszcze raz.';
	    				$this->data['subview'] = 'messages/message';
	    				$this->load->view('front_layout',$this->data);
	    			}
	    		}
	        }
		}
	}

	public function activate_user($key)
	{
		//check are key is valid
		if($this->register_m->is_valid_key($key))
		{
			//if key is valid activate user account
			if($this->register_m->activate_user($key))
			{
				$this->data['message'] = 'Konto zostało aktywowane.';
	    		$this->data['subview'] = 'messages/message';
	    		$this->load->view('front_layout',$this->data);
			}
			else
			{
				$this->data['message'] = 'Aktywacja nieudana.';
	    		$this->data['subview'] = 'messages/message';
	    		$this->load->view('front_layout',$this->data);
			}
		}
		else
		{
			$this->data['message'] = 'Klucz aktywacyjny nieprawidłowy.';
	    	$this->data['subview'] = 'messages/message';
	    	$this->load->view('front_layout',$this->data);
		}
	}

	//sprawdzanie poprawności captcha
	public function captcha_check($value)
	{
		if ($value == '')
		{
			$this->form_validation->set_message('captcha_check','Przepisz poprawnie kod captcha z obrazka.');
			return false;
		}
		else
		{
			return true;
		}
	}

	public function _email_check($value)
	{
		if($this->register_m->check_email($value) == false)
		{
			$this->form_validation->set_message('_email_check','Email jest już w użyciu');
			return false;
		}
		else
		{
			return true;
		}
	}

	public function _login_check($value)
	{
		if($this->register_m->check_login($value) == false)
		{
			$this->form_validation->set_message('_login_check','Login jest już w użyciu');
			return false;
		}
		else
		{
			return true;
		}
	}

}

/* End of file register.php */
/* Location: ./application/controllers/register.php */