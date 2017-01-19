<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_m extends MY_Model {

	public $rules = array(
		'login' => array(
			'field' => 'loginr',
			'label' => 'Login',
			'rules' => 'trim|xss_clean|required|callback__login_check|min_length[4]|max_length[20]|alpha_numeric'
		),
		'passwordr' => array(
			'field' => 'passwordr',
			'label' => 'Hasło',
			'rules' => 'trim|xss_clean|required|min_length[4]|max_length[20]|matches[password_c]|alpha_numeric'
		),
		'password_c' => array(
			'field' => 'password_c',
			'label' => 'Powtórzenie hasła',
			'rules' => 'trim|xss_clean|required|min_length[4]|max_length[20]|matches[passwordr]|alpha_numeric'
		),
		'email' => array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|xss_clean|required|callback__email_check|valid_email|matches[email_c]'
		),
		'email_c' => array(
			'field' => 'email_c',
			'label' => 'Powtórzenie email',
			'rules' => 'trim|xss_clean|required|valid_email|matches[email]'
		),
		'del_code' => array(
			'field' => 'del_code',
			'label' => 'Kod usunięcia',
			'rules' => 'trim|xss_clean|required|numeric|exact_length[7]'
		),
		'captcha' => array(
			'field' => 'captcha',
			'label' => 'Captcha',
			'rules' => 'required|trim|strip_tags|xss_clean|callback_captcha_check|match_captcha[captcha.word]'
		),
	);

	public function __construct()
	{
		parent::__construct();	
	}

	public function add_user($key)
	{
		$data = array(
			'login' =>$this->input->post('loginr'),
			'password' =>'*' . strtoupper(sha1(sha1($this->input->post('passwordr'),true))),
			'social_id' =>$this->input->post('del_code'),
			'email' =>$this->input->post('email'),
			'create_time' => date('Y-m-d H:i:s'),
			'status' => 'INACTIVE',
			'web_ip' => $this->input->ip_address(),
			'mods' => 'user',
			'last_web_login' => date('Y-m-d H:i:s'),
			'activation_key' => $key
		);

		$this->db->insert('account',$data);
		if($this->db->affected_rows() === 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function is_valid_key($key)
	{
		$this->db->where('activation_key',$key);
		$query = $this->db->get('account');

		if ($query->num_rows() == 1)
		{
			return true;
		}
		else
			return false;
	}

	public function activate_user($key)
	{
		if($this->is_valid_key($key))
		{
			//pobranie id i loginu gdzie jest taki klucz
			$query = $this->db->query("SELECT id,login FROM account WHERE activation_key='$key'");

			$id = $query->row('id');
			$login = $query->row('login');

			$this->db->query("UPDATE account SET status='OK' WHERE id='$id' AND login='$login'");
			if($this->db->affected_rows() === 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public function create_image()
	{
		$capstr = array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","w","x","y","z");
		$word = '';
		$n = 0;
		while($n<8)
		{
			$word .=$capstr[mt_rand(0, 34)];
			$n++;
		}

		$captcha = array(
			'word' => strtoupper($word),
			'img_path' => './../public_html/assets/captcha/',
			'img_url' => base_url().'assets/captcha/',
			'font_path' => '/fonts/impact.ttf',
			'img_width' => '300',
			'img_height' => '50',
			'expiration' => '60',
			'captcha_time' => time()
		);

		$expire = $captcha['captcha_time'] - $captcha['expiration'];
		
		// $value = array (
		// 	'captcha_time' => $captcha['captcha_time'],
		// 	'ip_address' => $this->input->ip_address(),
		// 	'word' => $captcha['word']
		// );

		$captcha_time = $captcha['captcha_time'];
		$ip_address = $this->input->ip_address();
		$word = $captcha['word'];

		//usuwanie istniejacych captcha
		$this->db->query("DELETE FROM captcha WHERE captcha_time < '$expire'");
		
		//dodawanie captcha do bazy
		//$this->db->insert('captcha', $value);
		$this->db->query("INSERT INTO captcha(captcha_time,ip_address,word) VALUES('$captcha_time','$ip_address','$word')");

		$img = create_captcha($captcha);
		return $data['image'] = $img['image'];
	}

	public function check_email($email)
	{
		$query = $this->db->query("SELECT * FROM account WHERE email='$email'");
		if($query->num_rows() === 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function check_login($login)
	{
		$query = $this->db->query("SELECT * FROM account WHERE login='$login'");
		if($query->num_rows() === 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}

/* End of file register_m.php */
/* Location: ./application/models/register_m.php */