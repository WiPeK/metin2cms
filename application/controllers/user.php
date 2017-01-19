<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* User Controller
*
* @package		WiPeK Metin2CMS
* @author 		Krzysztof Adamczyk - WiPeK wipekxxx@gmail.com
* @copyright	Krzysztof Adamczyk 2015
* @version 		Version 1.0
*/

class User extends Frontend_Controller {

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
		$this->load->model('logs_m');
	}

	public function index()
	{
		redirect(site_url('user/login'));
	}

	//logowanie
	public function login()
	{
		//check login status
		if($this->page_config_m->login_status() === false)
		{	
			//if login status is off load this view with message
			$this->data['message'] = 'Niestety, ale logowanie jest wyłączone.';
			$this->data['subview'] = 'messages/message';
			$this->load->view('front_layout',$this->data);
		}
		elseif($this->page_config_m->login_status() === true)
		{
			//if login status is on
			if($this->user_m->loggedin() == TRUE && $this->session->userdata('mods') === 'admin')
			{
				//if user is login now and user is admin redirect to dashboard
				redirect(site_url('admin/dashboard'));
			}
			elseif($this->user_m->loggedin() == TRUE && $this->session->userdata('mods') === 'user')
			{
				//if user is login now and user is not admin redirect to homepage
				redirect('http://www.metin2cms.wipek.pl');
			}

			//set rules
			$rules = $this->user_m->rules;
			$this->form_validation->set_rules($rules);

			if($this->form_validation->run() == TRUE)
			{
				//fetch login from input
	       		$login = $this->input->post('login');
	       		//hashing password from input
	        	$password = '*' . strtoupper(sha1(sha1($this->input->post('password'),true)));
				//fetch user mods
				$mods = $this->user_m->show_mods($login, $password);

				//check user status
				if($this->user_m->check_block($login) === true)
				{	
					//if user status isn't OK user can't login
					redirect('http://www.metin2cms.wipek.pl');
				}
				//if user hasn't mods redirect and can't login
				if($mods == false)
				{
					redirect('http://www.metin2cms.wipek.pl');
				}
				else
				{
					//login user
					if($this->user_m->login($mods) == TRUE)
					{	
						if($mods === 'admin')
						{
							//create positive login log and redirect
							$this->logs_m->log_admin_login();
							redirect('admin/dashboard');
						}
						elseif($mods === 'user')
						{
							//create login log
							$this->logs_m->log_user_login();
							//load view
							//fetch user data and shop category
							$this->data['user_data'] = $this->user_m->get_user_data();
							$this->data['shop_category'] = $this->front_shop_m->get_shop_category();
							//load view
							$this->data['message'] = 'Zalogowano pomyślnie.';
							$this->data['subview'] = 'messages/message';
							$this->load->view('front_layout',$this->data);
						}
						else
						{
							//create log negative login
							$this->logs_m->log_user_neg_login();

							$this->data['message'] = 'Nie zalogowano.';
							$this->data['subview'] = 'messages/message';
							$this->load->view('front_layout',$this->data);
						}
					}
					else 
					{
						//create log negative login
						$this->logs_m->log_user_neg_login();
						$this->session->set_flashdata('error', 'That login/password combination does not exist');

						$this->data['message'] = 'Złe hasło.';
						$this->data['subview'] = 'messages/message';
						$this->load->view('front_layout',$this->data);
					}
					
				}

			}
			else
			{
		        redirect('http://www.metin2cms.wipek.pl');
			}
		}
	}

	//logout method
	public function logout ()
	{
		$this->user_m->logout();
		redirect('http://www.metin2cms.wipek.pl');
	}

	//remind password
	public function forgotten_password()
	{
        $this->form_validation->set_rules('loginf', 'Login', 'trim|xss_clean|required|alpha_numeric|min_length[4]|max_length[20]');

        if($this->form_validation->run() === false)
        {
        	//if form validation is not run or validation is false load this view
        	$this->data['subview'] = 'user/remind';
        	$this->load->view('front_layout', $this->data);
        }
        else
        {
        	$key = md5(uniqid());
        	//znalezienie emaila uzytkownika o loginie z inputa
        	//fetch user email
        	$email = $this->user_m->get_email_remind($this->input->post('loginf'));
        	if($email == false)
        	{
        		//if login hasn't email load this view
        		$this->data['message'] = 'Do tego loginu nie ma przypisanego emaila lub konto nie istnieje.';
				$this->data['subview'] = 'messages/message';
				$this->load->view('front_layout',$this->data);
        	}
        	else
        	{
	        	//zapis klucza do podanego uzytkownika o loginie z inputa
	        	//wyslanie emaila
	    		$this->email->from($this->data['cmscfg']->cms_email, $this->data['cmscfg']->name);
	    		$this->email->to($email);
	    		$this->email->subject("Przypomnienie hasła");
	    		$message = '<p>Wysłałeś/aś żądanie o przypomnienie hasła.</p>';
	    		$message .= '<p>Jeżeli to nie ty wypełniłeś/aś formularz przypomnienia hasła, zignoruj tego emaila.</p>';
	    		$message .= '<p>Aby uzyskać nowe hasło kliknij w poniższy link</p>';
	    		$message .= "<p><a href='".base_url()."user/remaind_password/$key'>Kliknij tutaj</a> aby uzyskać nowe hasło.</p>";

	    		$this->email->message($message);

	        	if($this->user_m->save_key($key,$email) === true)
	        	{
	        		if($this->email->send())
	    			{
	                    $this->data['message'] = 'Email z przypomnieniem hasła został wysłany.';
						$this->data['subview'] = 'messages/message';
						$this->load->view('front_layout',$this->data);
	    			}
	    			else
	    			{
	                    $this->data['message'] = 'Email nie został wysłany. Spróbuj ponownie';
						$this->data['subview'] = 'messages/message';
						$this->load->view('front_layout',$this->data);
	    			}
	        	}		
        	}
        }
    }

    public function remaind_password($key)
    {
    	if($this->user_m->is_key_valid($key))
    	{
    		//send email with new password

    		$capstr = array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","w","x","y","z");
			$new_password = '';
			$n = 0;
			while($n<9)
			{
				$new_password .=$capstr[mt_rand(0, 34)];
				$n++;
			}

			$r_email = $this->user_m->get_email_to_new_password($key);

    		$this->email->from($this->data['cmscfg']->cms_email, $this->data['cmscfg']->name);
    		$this->email->to($r_email);
    		$this->email->subject("Nowe hasło");
    		$message = '<p>Wygenerowane nowe hasło to.</p>';
    		$message .= $new_password;
    		$message .= "<p><a href='".base_url()."user/login'>Kliknij tutaj</a> aby się zalogować.</p>";
    		$this->email->message($message);
    		
        	
        	if($this->user_m->save_new_password($new_password,$r_email));
        	{
        		if($this->email->send())
    			{
    				$this->logs_m->log_rem_pass($r_email);
                    $this->data['message'] = 'Email z nowym hasłem został wysłany.';
					$this->data['subview'] = 'messages/message';
					$this->load->view('front_layout',$this->data);
    			}
    			else
    			{
                    $this->data['message'] = 'Email nie został wysłany. Spróbuj ponownie';
					$this->data['subview'] = 'messages/message';
					$this->load->view('front_layout',$this->data);
    			}
    		}

    	}
    	else
    	{
            $this->data['message'] = 'Klucz zmiany hasła jest niepoprawny.';
			$this->data['subview'] = 'messages/message';
			$this->load->view('front_layout',$this->data);
    	}
    }

	//zmiana hasła

    /* zmiana hasła */
	public function change_password()
	{
		$rules = $this->user_m->change_password_rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() === true)
		{
			//pobranie loginu z sesji
			$login = $this->session->userdata('login');
			//pobranie id usera
			$id_user = $this->user_m->get_id_from_login($login);
			//stare i nowe haslo
			$old_pw = $this->user_m->get_password($login);
			$new_pw = '*' . strtoupper(sha1(sha1($this->input->post('new_password'),true)));
			//generowanie i zapis klucza
			$key = md5(uniqid());
			//zapis do db
			$data = array(
				'user_id' => $id_user,
				'login' => $login,
				'old_pw' => $old_pw,
				'new_pw' => $new_pw,
				'key_pw' => $key,
			);

			//wyslanie emaila
			$email = $this->user_m->get_email_remind($this->session->userdata('login'));
			$this->email->from($this->data['cmscfg']->cms_email, $this->data['cmscfg']->name);
    		$this->email->to($email);
    		$this->email->subject("Zmiana hasła");
    		$message = '<p>Aby potwierdzić zmianę hasła kliknij w poniższy link, jeżeli natomiast nie zmieniałeś hasła, zignoruj tego emaila.</p>';
    		$message .= "<p><a href='".base_url()."user/change_pw/$id_user/$key'>Kliknij tutaj</a> aby potwierdzić zmianę hasła.</p>";

    		$this->email->message($message);

    		if($this->email->send())
    		{
    			if($this->user_m->save_change_pw($data))
    			{
    				$this->data['message'] = 'Email z nowym hasłem został wysłany.';
					$this->data['subview'] = 'messages/message';
					$this->load->view('front_layout',$this->data);    
    			}
    			else
    			{
    				$this->data['message'] = 'Coś poszło nie tak.';
					$this->data['subview'] = 'messages/message';
					$this->load->view('front_layout',$this->data);		      
    			}
    		}
    		else
    		{
    			$this->data['message'] = 'Coś poszło nie tak.';
				$this->data['subview'] = 'messages/message';
				$this->load->view('front_layout',$this->data);
    		}
		}
		else
		{
			$this->data['subview'] = 'user/change_pass';
	        $this->load->view('front_layout', $this->data);
		}
	}

	public function change_pw($user_id,$key)
	{
		if($this->user_m->is_valid_data($user_id,$key))
		{
			//wez new_pw
			$new_pw = $this->user_m->get_new_pw($user_id,$key);
			//zapisz nowe haslo do users
			if($this->user_m->save_new_pw_to_users($user_id,$new_pw))
			{
				$this->logs_m->log_change_pw($user_id);
				$this->logout();
			}
			else
			{
				$this->data['message'] = 'Coś poszło nie tak.';
				$this->data['subview'] = 'messages/message';
				$this->load->view('front_layout',$this->data);
			}
		}	
		else
		{
			$this->data['message'] = 'Zły klucz.';
			$this->data['subview'] = 'messages/message';
			$this->load->view('front_layout',$this->data);
		}
	}
	/* zmiana hasła koniec */

	//zmiana kodu usuwania

	/*zmiana kodu */

	public function change_delcode()
	{
		$rules = $this->user_m->change_del_code_rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() === true)
		{
			//pobranie loginu z sesji
			$login = $this->session->userdata('login');
			//pobranie id usera
			$id_user = $this->user_m->get_id_from_login($login);
			//stary i nowy kod
			$old_del_code = $this->user_m->get_del_code($login);
			$new_del_code = $this->input->post('new_del_code');
			//generowanie i zapis klucza
			$key = md5(uniqid());
			//zapis do db
			$data = array(
				'user_id' => $id_user,
				'login' => $login,
				'old_del_code' => $old_del_code,
				'new_del_code' => $new_del_code,
				'key_del_code' => $key,
			);

			//wyslanie emaila
			$email = $this->user_m->get_email_remind($this->session->userdata('login'));
			$this->email->from($this->data['cmscfg']->cms_email, $this->data['cmscfg']->name);
    		$this->email->to($email);
    		$this->email->subject("Zmiana kodu");
    		$message = '<p>Aby potwierdzić zmianę kodu kliknij w poniższy link, jeżeli natomiast nie zmieniałeś hasła, zignoruj tego emaila.</p>';
    		$message .= "<p><a href='".base_url()."user/change_del_code/$id_user/$key'>Kliknij tutaj</a> aby potwierdzić zmianę kodu.</p>";

    		$this->email->message($message);

    		if($this->email->send())
    		{
    			if($this->user_m->save_change_delcode($data))
    			{
    				$this->data['message'] = 'Potwierdzenie zmiany wysłane na email.';
    				$this->data['subview'] = 'messages/message';
					$this->load->view('front_layout', $this->data);
    			}
    			else
    			{
    				$this->data['message'] = 'Coś poszło nie tak.';
    				$this->data['subview'] = 'messages/message';
					$this->load->view('front_layout', $this->data);
    			}
    		}
		}
		else
		{
			$this->data['subview'] = 'user/change_delcode';
	        $this->load->view('front_layout', $this->data);
		}
	}

	public function change_del_code($user_id,$key)
	{
		if($this->user_m->is_valid_data_c($user_id,$key))
		{
			//wez new_pw
			$new_del_code = $this->user_m->get_new_del_code($user_id,$key);
			//zapisz nowe haslo do users
			if($this->user_m->save_new_del_code_to_users($user_id,$new_del_code))
			{
				$this->logs_m->log_change_del_code($user_id);
				$this->data['message'] = 'Kod zmieniony.';
    			$this->data['subview'] = 'messages/message';
				$this->load->view('front_layout', $this->data);
			}
			else
			{
				$this->data['message'] = 'Coś poszło nie tak.';
    			$this->data['subview'] = 'messages/message';
				$this->load->view('front_layout', $this->data);
			}
		}	
		else
		{
			$this->data['message'] = 'Zły kod potwierdzający.';
    		$this->data['subview'] = 'messages/message';
			$this->load->view('front_layout', $this->data);
		}
	}

	/*zmiana kodu koniec */

	//zmiana emaila

	/*zmiana email*/

	public function change_email()
	{
		$rules = $this->user_m->change_email_rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() === TRUE)
		{
			//pobranie loginu z sesji
			$login = $this->session->userdata('login');
			//pobranie id usera
			$id_user = $this->user_m->get_id_from_login($login);
			//stary i nowy kod
			$old_email = $this->user_m->get_email_remind($login);
			$new_email = $this->input->post('new_email');
			//generowanie i zapis klucza
			$key = md5(uniqid());
			//zapis do db
			$data = array(
				'user_id' => $id_user,
				'login' => $login,
				'old_email' => $old_email,
				'new_email' => $new_email,
				'key_email' => $key,
				'last_change' => $this->user_m->get_last_email_change($this->input->post('email'),$this->session->userdata('login')),
			);

			//wyslanie emaila
			$email = $old_email;
			$this->email->from($this->data['cmscfg']->cms_email, $this->data['cmscfg']->name);
    		$this->email->to($email);
    		$this->email->subject("Zmiana email");
    		$message = '<p>Aby potwierdzić zmianę emaila kliknij w poniższy link, jeżeli natomiast nie zmieniałeś emaila, zignoruj tą wiadomość.</p>';
    		$message .= "<p><a href='".base_url()."user/change_newemail/$id_user/$key'>Kliknij tutaj</a> aby potwierdzić zmianę emaila.</p>";

    		$this->email->message($message);

    		if($this->email->send())
    		{
    			if($this->user_m->save_change_email($data))
    			{
    				$this->data['message'] = 'Email z potwierdzeniem został wysłany.';
		    		$this->data['subview'] = 'messages/message';
					$this->load->view('front_layout', $this->data);
    			}
    			else
    			{
    				$this->data['message'] = 'Coś poszło nie tak.';
		    		$this->data['subview'] = 'messages/message';
					$this->load->view('front_layout', $this->data);
    			}
    		}
		}
		else
		{
			$this->data['subview'] = 'user/change_email';
			$this->load->view('front_layout', $this->data);
		}
	}

	public function change_newemail($user_id,$key)
	{
		if($this->user_m->is_valid_data_email($user_id,$key))
		{
			//wez new_pw
			$new_email = $this->user_m->get_new_email($user_id,$key);
			//zapisz nowe haslo do users
			if($this->user_m->save_new_email_to_users($user_id,$new_email))
			{
				$now = date('Y-m-d H:i:s');
				if($this->user_m->update_last_change($now, $user_id) === TRUE)
				{
					$this->email->from($this->data['cmscfg']->cms_email, $this->data['cmscfg']->name);
		    		$this->email->to($new_email);
		    		$this->email->subject("Zmiana email");
		    		$message = '<p>Email zmnieniony pomyślnie.</p>';
		    		$message .= "<p><a href='".base_url()."user/login'>Kliknij tutaj</a> aby się zalogować.</p>";

		    		$this->email->message($message);

		    		if($this->email->send())
		    		{
		    			$this->logs_m->log_change_email($user_id);
						$this->data['message'] = 'Email z potwierdzeniem wysłany na nowy email.';
		    			$this->data['subview'] = 'messages/message';
						$this->load->view('front_layout', $this->data);
		    		}
				}
			}
			else
			{
				$this->data['message'] = 'Coś poszło nie tak.';
		    	$this->data['subview'] = 'messages/message';
				$this->load->view('front_layout', $this->data);
			}
		}	
		else
		{
			$this->data['message'] = 'Zły klucz potwierdzenia.';
		    $this->data['subview'] = 'messages/message';
			$this->load->view('front_layout', $this->data);
		}
	}

	/*zmiana email koniec*/
	
	//profil

	public function profile($id)
	{
		if($this->user_m->profile_access($id) === false)
		{
			redirect(site_url());
		}

		$this->data['user_chars'] = $this->user_m->get_chars($this->data['user_data'][0]->id);

		$this->data['subview'] = 'user/profile';
		$this->load->view('front_layout', $this->data);
	}

	public function char_profile($id)
	{	
			$this->data['char_data'] = $this->user_m->get_char_data($id);
			$this->data['char_data'][0]->empire = $this->user_m->get_empire($id);
			$data_items = $this->items_m->get_items($id);
			foreach($data_items as $item)
			{
				$it_em = $this->items_m->get_item_proto($item->vnum);
				if ($it_em[0]->value3 != 0 && $it_em[0]->value4 != 0 && $it_em[0]->value5 != 0) {
					$wbud_min_1 = $it_em[0]->value3+$it_em[0]->value5;
					$wbud_max_1 = $it_em[0]->value4+$it_em[0]->value5;
					
					$item->war_atk = $wbud_min_1 . '-' . $wbud_max_1;
					
				}
				if ($it_em[0]->value2 != 0 && $it_em[0]->value3 != 0 && $it_em[0]->value4 != 0) {
					$wbud_min_2 = $it_em[0]->value1+$it_em[0]->value3;
					$wbud_max_2 = $it_em[0]->value2+$it_em[0]->value3;

					$item->war_mag_atk = $wbud_min_2 . '-' . $wbud_max_2;
				}

				if($it_em[0]->value1 != 0)
				{
					$item->def = $it_em[0]->value1 + ($it_em[0]->value5 * 2);
				}

				$bon_dod_0 = $it_em[0]->applytype0;
				
				$bon_dod_1 = $it_em[0]->applytype1;

				$bon_dod_2 = $it_em[0]->applytype2;

				$item->name = $it_em[0]->locale_name;
				$item->req_lev = $it_em[0]->limitvalue0;

				if($bon_dod_0 != 0)
				{
					$item->bon_dod_0 = bonus_name($bon_dod_0);
					$item->bon_dod_val_0 = $it_em[0]->applyvalue0;
				}
				if($bon_dod_1 != 0)
				{
					$item->bon_dod_1 = bonus_name($bon_dod_1);
					$item->bon_dod_val_1 = $it_em[0]->applyvalue1;
				}
				if($bon_dod_2 != 0)
				{
					$item->bon_dod_2 = bonus_name($bon_dod_2);
					$item->bon_dod_val_2 = $it_em[0]->applyvalue2;
				}
				//bon 1
				if($item->attrtype0 != 0)
				{
					$item->bonus = bonus_name($item->attrtype0);
					if($item->attrtype1 != 0)
					{
						$item->bonus2 = bonus_name($item->attrtype1);
						if($item->attrtype2 != 0)
						{
							$item->bonus3 = bonus_name($item->attrtype2);
							if($item->attrtype3 != 0)
							{
								$item->bonus4 = bonus_name($item->attrtype3);
								if($item->attrtype4 != 0)
								{
									$item->bonus5 = bonus_name($item->attrtype4);
								}
							}
						}
					}
				}
				//kd
				//1 zepsuty albo pusty -1 brak
				if($item->socket0 != -1)
				{
					if($item->socket0 != 0 && $item->socket0 != 1)
					{
						$item->slot_kd = $this->items_m->get_kd_name($item->socket0);
						if($item->socket1 == 1)
						{
							$item->slot_kd2 = 'Slot pusty';
						}
						elseif($item->socket1 != -1 && $item->socket1 != 0)
						{
							$item->slot_kd2 = $this->items_m->get_kd_name($item->socket1);
						}

						if($item->socket2 == 1)
						{
							$item->slot_kd3 = 'Slot pusty';
						}
						elseif($item->socket1 != -1 && $item->socket1 != 0)
						{
							$item->slot_kd3 = $this->items_m->get_kd_name($item->socket2);
						}
					}
					elseif($item->socket0 == 1)
					{
						$item->slot_kd = 'Slot pusty';
						if($item->socket1 != -1)
							$item->slot_kd2 = 'Slot pusty';
						if($item->socket2 != -1)
							$item->slot_kd3 = 'Slot pusty';
					}
				}
				//ikona

				$item->icon = $this->items_m->get_item_icon($item->vnum);

			}
			$this->data['user_items'] = $data_items;

			$this->data['subview'] = 'user/char_profile';
			$this->load->view('front_layout', $this->data);
	}

	//ranking postaci
	public function char_ranking()
	{

		$count = $this->user_m->count_chars();

		//pagination
		$perpage = 20;
		if($count > $perpage)
		{
			$this->load->library('pagination');
			$config['base_url'] = site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/');
			$config['total_rows'] = $count;
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
			if($this->uri->segment(3) == '' || $this->uri->segment(3) == 0)
			{
				$offset = 0;
			}
			elseif($this->uri->segment(3) >= $perpage)
			{
				$offset = $this->uri->segment(3);
			}
		}
		else
		{
			$this->data['pagination'] = '';
			$offset = 0;
		}
		$this->data['char_rank'] = $this->user_m->get_chars_pag($perpage, $offset);;

		$this->data['subview'] = 'user/char_ranking';
		$this->load->view('front_layout',$this->data);
	} 
	
	//ranking gildii
	public function guild_ranking()
	{
		//count all accounts
		$count = $this->user_m->count_guilds();

		//pagination
		$perpage = 20;
		if($count > $perpage)
		{
			$this->load->library('pagination');
			$config['base_url'] = site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/');
			//$config['base_url'] = 'http://localhost/cms/ci/admin/user/';
			$config['total_rows'] = $count;
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
			if($this->uri->segment(3) == '' || $this->uri->segment(3) == 0)
			{
				$offset = 0;
			}
			elseif($this->uri->segment(3) >= $perpage)
			{
				$offset = $this->uri->segment(3);
			}
		}
		else
		{
			$this->data['pagination'] = '';
			$offset = 0;
		}
		// Fetch all guilds
		$this->data['guilds_rank'] = $this->user_m->get_guilds_pag($perpage, $offset);

		$this->data['subview'] = 'user/guild_ranking';
		$this->load->view('front_layout',$this->data);
	}

	public function char_fix()
	{
		$this->data['chars_to_fix'] = $this->user_m->get_chars_fix($this->data['user_data'][0]->id);

		$this->data['subview'] = 'user/char_fix';
		$this->load->view('front_layout',$this->data);
	}

	public function charfix()
	{
		$rules = $this->user_m->charfix_rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() === true)
		{
			if($this->user_m->debug_char((int)$this->input->post('charF')) == true)
			{
				//log
				$this->logs_m->log_debug_char((int)$this->input->post('charF'));

				$this->data['message'] = 'Postać została odbugowana. Nie loguj się na konto przez około 15 minut.';
				$this->data['subview'] = 'messages/message';
				$this->load->view('front_layout',$this->data);
			}
			else
			{
				$this->data['message'] = 'Postać nie została odbugowana. Spróbuj ponownie!';
				$this->data['subview'] = 'messages/message';
				$this->load->view('front_layout',$this->data);
			}
		}	
		else
		{
			redirect(site_url('user/char_fix'));
		}
	}

	//callbacki

	public function _pass_password($str)
	{
		//pobranie hasła z db
		$old_pass_db = $this->user_m->get_password($this->session->userdata('login'));  
		//sprawdzenie czy stare hasło wpisane w formularzu jest identyczne z hasłem z db
		$pass_from_input = '*' . strtoupper(sha1(sha1($this->input->post('old_password'),true)));

		if($old_pass_db === $pass_from_input)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('_pass_password', '%s musi być twoim starym hasłem');
			return false;
		}
	}

	public function _pass_delcode($str)
	{
		//pobranie kodu z db
		$old_del_code = $this->user_m->get_del_code($this->session->userdata('login'));  
		//sprawdzenie czy stare hasło wpisane w formularzu jest identyczne z hasłem z db
		$del_code_from_input = $this->input->post('old_del_code');

		if($old_del_code == $del_code_from_input)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('_pass_delcode', '%s musi być twoim starym kodem');
			return false;
		}
	}

	public function _unique_email($str)
	{
		if($this->user_m->check_unique_email($str) == false)
		{
			$this->form_validation->set_message('_unique_email', '%s jest już w użyciu');
			return false;
		}
		else
		{
			return true;
		}
	}

	//callback sprawdzania czy zgodny email
	public function _pass_email ($str)
	{
		//pobranie kodu z db
		$old_email = $this->user_m->get_email_remind($this->session->userdata('login'));  
		//sprawdzenie czy stare hasło wpisane w formularzu jest identyczne z hasłem z db
		$email_from_input = $this->input->post('old_email');

		if($old_email === $email_from_input)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('_pass_email', '%s musi być twoim starym emailem.');
			return false;
		}
	}
	//calback sprawdzania ostatniej zmiany
	public function _last_email_change ($str)
	{
		//sprawdzic czy uzytkownik cos zmienial
		if($this->user_m->are_user_change_sth($this->session->userdata('login')) === true)
		{
			//pobranie kodu z db
			$last_change = $this->user_m->get_last_email_change($this->session->userdata('login'));  

			$now = date('Y-m-d H:i:s');
			$day_ago = strtotime(date("Y-m-d H:i:s", strtotime($now)) . " -1 day");
			$yesterday = date('Y-m-d H:i:s', $day_ago);

			//jesli data ostatniej zmiany jest mniejsza niz jednen dzień wstecz
			if($last_change < $yesterday)
			{
				return true;
			}
			else
			{
				$this->form_validation->set_message('_last_email_change', 'Email może być zmieniony raz na 24 godziny.');
				return false;
			}
			
		}
		else
		{
			return true;
		}
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */