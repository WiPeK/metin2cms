<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends MY_Model {

	public $rules = array(
		'login' => array(
			'field' => 'login',
			'label' => 'Login',
			'rules' => 'trim|xss_clean|required|min_length[4]|max_length[20]|alpha_numeric'
		),
		'password' => array(
			'field' => 'password',
			'label' => 'Hasło',
			'rules' => 'trim|xss_clean|required|min_length[4]|max_length[20]|alpha_numeric'
		),
	);

	public $global_message_rules = array(
		'subject' => array(
			'field' => 'subject',
			'label' => 'Subject',
			'rules' => 'trim|xss_clean|required|min_length[3]|alpha_numeric'
		),
		'message_body' => array(
			'field' => 'message_body',
			'label' => 'Message_body',
			'rules' => 'trim|xss_clean|required|min_length[4]'
		),
	);

	public $change_password_rules = array(
		'old_password' => array(
			'field' => 'old_password',
			'label' => 'Hasło',
			'rules' => 'trim|xss_clean|required|min_length[4]|max_length[20]|callback__pass_password|alpha_numeric'
		),
		'new_password' => array(
			'field' => 'new_password',
			'label' => 'Nowe hasło',
			'rules' => 'trim|xss_clean|required|min_length[4]|max_length[20]|matches[cnew_password]|alpha_numeric'
		),
		'cnew_password' => array(
			'field' => 'cnew_password',
			'label' => 'Powtórzenie nowego hasła',
			'rules' => 'trim|xss_clean|required|min_length[4]|matches[new_password]|alpha_numeric|max_length[20]'
		),
	);

	public $change_del_code_rules = array(
		'old_del_code' => array(
			'field' => 'old_del_code',
			'label' => 'Kod',
			'rules' => 'trim|xss_clean|required|callback__pass_delcode|numeric|exact_length[7]'
		),
		'new_del_code' => array(
			'field' => 'new_del_code',
			'label' => 'Nowy kod',
			'rules' => 'trim|xss_clean|required|exact_length[7]|matches[cnew_del_code]|numeric'
		),
		'cnew_del_code' => array(
			'field' => 'cnew_del_code',
			'label' => 'Powtórzenie nowego kodu',
			'rules' => 'trim|xss_clean|required|exact_length[7]|matches[new_del_code]|numeric'
		),
	);

	public $change_email_rules = array(
		'old_email' => array(
			'field' => 'old_email',
			'label' => 'Stary email',
			'rules' => 'trim|xss_clean|required|callback__pass_email|callback__last_email_change|valid_email'
		),
		'new_email' => array(
			'field' => 'new_email',
			'label' => 'Nowy email',
			'rules' => 'trim|xss_clean|required|matches[cnew_email]|callback__unique_email|valid_email'
		),
		'cnew_email' => array(
			'field' => 'cnew_email',
			'label' => 'Powtórzenie nowego emaila',
			'rules' => 'trim|xss_clean|required|matches[new_email]|valid_email'
		),
	);

	public $front_search_rules = array(
		'search_input' => array(
			'field' => 'search_input', 
			'label' => 'Szukaj', 
			'rules' => 'trim|xss_clean|min_length[3]'
		),
	);

	public $ip_search_rules = array(
		'search_input_ip' => array(
			'field' => 'search_input_ip', 
			'label' => 'Szukaj IP', 
			'rules' => 'trim|xss_clean|valid_ip'
		),
	);

	public $rules_edit_user = array(
		'login' => array(
			'field' => 'login', 
			'label' => 'Login',
			'rules' => 'trim|xss_clean|required|callback__login_check|min_length[4]|max_length[20]|alpha_numeric'
		),
		'password' => array(
			'field' => 'password', 
			'label' => 'Hasło', 
			'rules' => 'trim|xss_clean|min_length[4]|max_length[20]|alpha_numeric'
		),
		'social_id' => array(
			'field' => 'social_id', 
			'label' => 'Kod usunięcia', 
			'rules' => 'trim|xss_clean|required|numeric|exact_length[7]'
		),
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|xss_clean|required|callback__email_check|valid_email'
		),
		'status' => array(
			'field' => 'status', 
			'label' => 'Status', 
			'rules' => 'trim|xss_clean|max_length[7]'
		),
		'availDt' => array(
			'field' => 'availDt', 
			'label' => 'Blokada czasowa', 
			'rules' => 'trim|xss_clean'
		),
		'cash' => array(
			'field' => 'cash', 
			'label' => 'Monety premium', 
			'rules' => 'trim|xss_clean|integer'
		),
		'gold_expire' => array(
			'field' => 'gold_expire', 
			'label' => 'Zwiekszony drop', 
			'rules' => 'trim|xss_clean'
		),
		'silver_expire' => array(
			'field' => 'silver_expire', 
			'label' => 'Zwiekszony exp', 
			'rules' => 'trim|xss_clean'
		),
		'money_drop_rate_expire' => array(
			'field' => 'money_drop_rate_expire', 
			'label' => 'Zwiekszony drop yang', 
			'rules' => 'trim|xss_clean'
		),
	);

	public $rules_edit_char = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'Nick',
			'rules' => 'trim|xss_clean|required|callback__login_check|min_length[2]|max_length[13]'
		),
		'level' => array(
			'field' => 'level', 
			'label' => 'Poziom', 
			'rules' => 'trim|xss_clean|integer|less_than[106]|greater_than[0]'
		),
		'exp' => array(
			'field' => 'exp', 
			'label' => 'Doświadczenie', 
			'rules' => 'trim|xss_clean|integer'
		),
		'gold' => array(
			'field' => 'gold', 
			'label' => 'Złoto', 
			'rules' => 'trim|xss_clean|integer|less_than[1999999999]'
		),
		'alignment' => array(
			'field' => 'alignment', 
			'label' => 'Ranga', 
			'rules' => 'trim|xss_clean|integer|less_than[20000]|greater_than[-20000]'
		),
		'horse_level' => array(
			'field' => 'horse_level', 
			'label' => 'Poziom konia', 
			'rules' => 'trim|xss_clean|integer|less_than[31]greater_than[0]'
		),
	);

	public $charfix_rules = array(
		'charF' => array(
			'field' => 'charF', 
			'label' => 'Postać',
			'rules' => 'trim|xss_clean'
		),
	);

	public $rules_block = array(
		'reason' => array(
			'field' => 'reason', 
			'label' => 'Powód',
			'rules' => 'trim|xss_clean'
		),
	);

	public $search_item_rules = array(
		'vnum' => array(
			'field' => 'vnum', 
			'label' => 'Id przedmiotu',
			'rules' => 'trim|xss_clean|integer'
		),
	);

	public function __construct()
	{
		parent::__construct();
		
	}

	public function login($mods)
	{
		// $user = $this->get_by(array(
		// 	'login' => $this->input->post('login'),
		// 	'password' => '*' . strtoupper(sha1(sha1($this->input->post('password')))),
		// 	'mods' => $mods 
		// 	), TRUE
		// );
		$login = $this->input->post('login');
		$password = '*' . strtoupper(sha1(sha1($this->input->post('password'),true)));


		$query = $this->db->query("SELECT * FROM account WHERE login='$login' AND password='$password' AND mods='$mods'");

		if($query->num_rows() == 1)
		{
			//log in user
			$data = array(
				'login' => $query->row('login'),
				'mods' => $query->row('mods'),
				'loggedin' => TRUE,
			);
			$this->last_log_in();
			$this->session->set_userdata($data);
			return TRUE;
		}
		else
			return FALSE;
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(site_url());
	}

	public function show_mods($login, $password)
	{
		$query = $this->db->query("SELECT mods,status FROM account where login= '$login' and password= '$password'");
		if(($query->row('mods') != 'user' && $query->row('mods') != 'admin') || $query->row('status') != 'OK')
		{
			return false;
		}
		else
			return $query->row('mods');
	}

	public function get_email_remind($login)
	{
		$query = $this->db->query("SELECT email FROM account WHERE login='$login'");
		if($query->num_rows() == 1 AND $query->row('email') != '')
		{
			return $query->row('email');
		}
		else
			return false;
	}

	public function save_change_pw($data)
	{
		$old_pw = $data['old_pw'];
		$new_pw = $data['new_pw'];
		$key_pw = $data['key_pw'];
		$user_id = $data['user_id'];
		$login = $data['login'];
		//sprawdzenie czy jest w tabeli juz login i id to update jezeli nie to insert
		if($this->search_id_and_login($data['user_id'], $data['login']) === true)
		{
			//update

			$this->db->query("UPDATE change_data SET old_pw = '$old_pw', new_pw = '$new_pw', key_pw = '$key_pw' WHERE user_id = '$user_id' AND login = '$login'");
			if($this->db->affected_rows() === 1)
			{
				return true;
			}
			else
				return false;
		}
		else
		{
			//insert
			$this->db->query("INSERT INTO change_data(user_id,login,old_pw,new_pw,key_pw) VALUES ('$user_id','$login','$old_pw','$new_pw','$key_pw')");
			if($this->db->affected_rows() === 1)
			{
				return true;
			}
			else
				return false;
		}
	}

	public function is_valid_data($user_id,$key)
	{
		//$query = $this->db->query("SELECT old_pw, new_pw FROM change_data WHERE user_id = '$user_id' AND key_pw = '$key'");
		$query = $this->db->query("SELECT key_pw FROM change_data WHERE user_id = '$user_id'");
		if($query->row('key_pw') === $key)
		{
			return true;
		}
		else
			return false;
	}

	public function get_new_pw($user_id,$key)
	{
		$query = $this->db->query("SELECT new_pw FROM change_data WHERE user_id = '$user_id' AND key_pw = '$key'");
		return $query->row('new_pw');
	}

	public function save_new_pw_to_users($user_id,$new_pw)
	{
		$this->db->query("UPDATE account SET password='$new_pw' WHERE id='$user_id'");
		if($this->db->affected_rows() === 1)
		{
			return true;
		}
		else
			return false;
	}

	public function search_id_and_login($user_id, $login)
	{
		$query = $this->db->query("SELECT id FROM change_data WHERE user_id='$user_id' AND login='$login'");
		if ($query->num_rows() === 1)
		{
			return true;
		}
		elseif ($query->num_rows() === 0)
		{
			return false;
		}
	}

	public function last_log_in()
	{
		$ost_log = date('Y-m-d H:i:s');
		$login = $this->input->post('login');
		$password = '*' . strtoupper(sha1(sha1($this->input->post('password'),true)));
		$this->db->query("UPDATE account SET last_web_login = '$ost_log' WHERE login='$login' AND password = '$password'");
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
			return false;
	}

	public function save_key($key,$email)
	{
		$this->db->query("UPDATE account SET remind_key = '$key' WHERE email='$email'");
		if($this->db->affected_rows() === 1)
		{
			return true;
		}
		else
			return false;
	}

	public function is_key_valid($key)
	{
		$query = $this->db->query("SELECT * FROM account WHERE remind_key='$key'");

		if ($query->num_rows() == 1)
		{
			return true;
		}
		else
			return false;
	}

	public function get_email_to_new_password($key)
	{
		$query = $this->db->query("SELECT email FROM account WHERE remind_key='$key'");
		return $query->row('email');
	}

	public function save_new_password($new_password,$email)
	{
		$new_password = '*' . strtoupper(sha1(sha1($new_password,true)));
		$this->db->query("UPDATE account SET password='$new_password' WHERE email='$email'");
	}

	public function loggedin()
	{
		return (bool) $this->session->userdata('loggedin');
	}

	public function get_char_ranking()
	{
		$query = $this->db->query("SELECT * FROM player WHERE name NOT LIKE '[%' ORDER BY level DESC, exp DESC, last_play DESC");
		return $query->result();
	}

	public function get_guild_ranking()
	{
		$query = $this->db->query("SELECT * FROM guild ORDER BY ladder_point DESC, level DESC, exp DESC, win DESC");
		return $query->result();
	}

	public function get_id_from_login($login)
	{
		$query = $this->db->query("SELECT id FROM account WHERE login='$login'");
		return $query->row('id');
	}

	public function get_password($login)
	{
		$query = $this->db->query("SELECT password FROM account WHERE login='$login'");
		return $query->row('password');
	}

	public function get_del_code($login)
	{
		$query = $this->db->query("SELECT social_id FROM account WHERE login='$login'");
		return $query->row('social_id');
	}

	public function is_valid_data_c($user_id,$key)
	{
		//$query = $this->db->query("SELECT old_pw, new_pw FROM change_data WHERE user_id = '$user_id' AND key_pw = '$key'");
		$query = $this->db->query("SELECT key_del_code FROM change_data WHERE user_id = '$user_id'");
		if($query->row('key_del_code') === $key)
		{
			return true;
		}
		else
			return false;
	}

	public function save_change_delcode($data)
	{
		$old_del_code = $data['old_del_code'];
		$new_del_code = $data['new_del_code'];
		$key_del_code = $data['key_del_code'];
		$user_id = $data['user_id'];
		$login = $data['login'];
		//sprawdzenie czy jest w tabeli juz login i id to update jezeli nie to insert
		if($this->search_id_and_login($data['user_id'], $data['login']) === true)
		{
			//update

			$this->db->query("UPDATE change_data SET old_del_code = '$old_del_code', new_del_code = '$new_del_code', key_del_code = '$key_del_code' WHERE user_id = '$user_id' AND login = '$login'");
			if($this->db->affected_rows() === 1)
			{
				return true;
			}
			else
				return false;
		}
		else
		{
			//insert
			$this->db->query("INSERT INTO change_data (user_id,login,old_del_code,new_del_code,key_del_code) VALUES ('$user_id','$login','$old_del_code','$new_del_code','$key_del_code')");
			if($this->db->affected_rows() === 1)
			{
				return true;
			}
			else
				return false;
		}
	}

	public function get_new_del_code($user_id,$key)
	{
		$query = $this->db->query("SELECT new_del_code FROM change_data WHERE user_id = '$user_id' AND key_del_code = '$key'");
		return $query->row('new_del_code');
	}

	public function save_new_del_code_to_users($user_id,$new_del_code)
	{
		$this->db->query("UPDATE account SET social_id='$new_del_code' WHERE id='$user_id'");
		if($this->db->affected_rows() === 1)
		{
			return true;
		}
		else
			return false;
	}

	public function check_unique_email($email)
	{
		$query = $this->db->query("SELECT * FROM account WHERE email='$email'");
		if($query->num_rows() == 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function are_user_change_sth($login)
	{
		$query = $this->db->query("SELECT user_id FROM change_data WHERE login = '$login'");
		if($query->num_rows() === 1)
		{
			return true;
		}
		else
			return false;
	}

	public function get_last_email_change($login)
	{
		$query = $this->db->query("SELECT last_change FROM change_data WHERE login = '$login'");
		if($query->row('last_change') == '')
		{
			return date('0000-00-00 00:00:00');
		}
		else
		{
			return $query->row('last_change');
		}
	}

	public function save_change_email($data)
	{
		$old_email = $data['old_email'];
		$new_email = $data['new_email'];
		$key_email = $data['key_email'];
		$user_id = $data['user_id'];
		$login = $data['login'];
		$last_change = $data['last_change'];
		//sprawdzenie czy jest w tabeli juz login i id to update jezeli nie to insert
		if($this->search_id_and_login($data['user_id'], $data['login']) === true)
		{
			//update

			$this->db->query("UPDATE change_data SET old_email = '$old_email', new_email = '$new_email', key_email = '$key_email' WHERE user_id = '$user_id' AND login = '$login'");
			if($this->db->affected_rows() === 1)
			{
				return true;
			}
			else
				return false;
		}
		else
		{
			//insert
			$this->db->query("INSERT INTO change_data (user_id,login,old_email,new_email,key_email) VALUES ('$user_id','$login','$old_email','$new_email','$key_email')");
			if($this->db->affected_rows() === 1)
			{
				return true;
			}
			else
				return false;
		}
	}

	public function is_valid_data_email($user_id,$key)
	{
		//$query = $this->db->query("SELECT old_pw, new_pw FROM change_data WHERE user_id = '$user_id' AND key_pw = '$key'");
		$query = $this->db->query("SELECT key_email FROM change_data WHERE user_id = '$user_id'");
		if($query->row('key_email') === $key)
		{
			return true;
		}
		else
			return false;
	}

	public function get_new_email($user_id,$key)
	{
		$query = $this->db->query("SELECT new_email FROM change_data WHERE user_id = '$user_id' AND key_email = '$key'");
		return $query->row('new_email');
	}

	public function save_new_email_to_users($user_id,$new_email)
	{
		$this->db->query("UPDATE account SET email='$new_email' WHERE id='$user_id'");
		if($this->db->affected_rows() === 1)
		{
			return true;
		}
		else
			return false;
	}

	public function update_last_change($now, $user_id)
	{
		$this->db->query("UPDATE change_data SET last_change='$now' WHERE user_id='$user_id'");
		if($this->db->affected_rows() === 1)
		{
			return true;
		}
		else
			return false;
	}

	public function profile_access($id)
	{
		$query = $this->db->query("SELECT login FROM account WHERE id='$id'");
		if($query->row('login') === $this->session->userdata('login'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function get_user_data()
	{
		$login = $this->session->userdata('login');
		$query = $this->db->query("SELECT * FROM account WHERE login='$login'");
		return $query->result();
	}

	public function get_chars($id)
	{
		$query = $this->db->query("SELECT * FROM player WHERE account_id='$id'");
		return $query->result();
	}

	public function get_chars_fix($id)
	{
		$query = $this->db->query("SELECT id, name FROM player WHERE account_id='$id'");
		
		$data = array();

		foreach($query->result() as $row)
		{
			$data[$row->id] = $row->name;
		}

		return $data;
	}

	public function get_accounts($perpage, $offset)
	{
		if($offset > 0)
		{
			$query = $this->db->query("SELECT * FROM account LIMIT $perpage, $offset ");
			return $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT * FROM account LIMIT $perpage ");
			return $query->result();
		}	
	}

	public function get_banned_accounts($perpage, $offset)
	{
		if($offset > 0)
		{
			$query = $this->db->query("SELECT * FROM account WHERE status != 'OK' LIMIT $perpage, $offset ");
			return $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT * FROM account WHERE status != 'OK' LIMIT $perpage ");
			return $query->result();
		}	
	}

	public function get_chars_pag($perpage, $offset)
	{
		if($offset > 0)
		{
			$query = $this->db->query("SELECT * FROM player WHERE name NOT LIKE '[%' ORDER BY level DESC, exp DESC LIMIT $perpage, $offset ");
			return $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT * FROM player WHERE name NOT LIKE '[%' ORDER BY level DESC, exp DESC LIMIT $perpage ");
			return $query->result();
		}	
	}

	public function get_guilds_pag($perpage, $offset)
	{
		if($offset > 0)
		{
			$query = $this->db->query("SELECT * FROM guild ORDER BY ladder_point DESC, exp DESC, level DESC LIMIT $perpage, $offset ");
			return $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT * FROM guild ORDER BY ladder_point DESC, exp DESC, level DESC LIMIT $perpage ");
			return $query->result();
		}	
	}

	public function count_accounts()
	{
		$query = $this->db->query("SELECT count(*) as ilosc from account");
		return (int) $query->row('ilosc');
	}

	public function count_banned_accounts()
	{
		$query = $this->db->query("SELECT count(*) as ilosc from account WHERE status != 'OK'");
		return (int) $query->row('ilosc');
	}

	public function count_chars()
	{
		$query = $this->db->query("SELECT count(*) as ilosc from player");
		return (int) $query->row('ilosc');
	}

	public function count_guilds()
	{
		$query = $this->db->query("SELECT count(*) as ilosc from guild");
		return (int) $query->row('ilosc');
	}

	public function get_acc_info($id)
	{
		$query = $this->db->query("SELECT login,status FROM account WHERE id='$id'");
		$data['login'] = $query->row('login');
		$data['status'] = $query->row('status');
		return $data;
	}

	public function search_acc($val)
	{
		$query = $this->db->query("SELECT * FROM account WHERE login like '%$val%'");
		return $query->result();
	}

	public function search_ip($val)
	{
		$sql = $this->db->query("SELECT DISTINCT(account_id) FROM player WHERE ip LIKE '%$val%'");

		$data = array();
		foreach($sql->result() as $row)
		{
			$query = $this->db->query("SELECT * FROM account WHERE id = '$row->account_id'");
			$data[] = $query->result();
		}
		return $data;
	}

	public function search_char($val)
	{
		$query = $this->db->query("SELECT * FROM player WHERE name like '%$val%'");
		return $query->result();
	}

	public function search_guild($val)
	{
		$query = $this->db->query("SELECT * FROM guild WHERE name like '%$val%'");
		return $query->result();
	}

	public function get_user($id)
	{
		$query = $this->db->query("SELECT * FROM account WHERE id='$id'");
		return $query->result();
	}

	public function get_user_chars($id)
	{
		$query = $this->db->query("SELECT * FROM player WHERE account_id='$id'");
		return $query->result();
	}

	public function get_new_acc()
	{
		$account[0] = new stdClass();
		$account[0]->login = '';
		$account[0]->social_id = '';
		$account[0]->email = '';
		$account[0]->status = 'OK';
		$account[0]->availDt = '0000-00-00 00:00:00';
		$account[0]->cash = 0;
		$account[0]->mods = 'user';
		$account[0]->gold_expire = '0000-00-00 00:00:00'; //drop
		$account[0]->silver_expire = '0000-00-00 00:00:00'; //exp
		$account[0]->money_drop_rate_expire = '0000-00-00 00:00:00'; //gold
		return $account;
	}

	public function save_edited_acc($data,$id)
	{
		$data['mods'] = 'user';
		$data['last_web_login'] = '0000-00-00 00:00:00';
		$data['activation_key'] = '';
		//sprawdzic czy haslo nie jest puste
		if($data['password'] != '')
		{
			$this->db->where('id',$id);
			$this->db->update('account', $data);
			if($this->db->affected_rows() == 1)
			{
				return true;
			}
			else
				return false;
		}
		else
		{
			unset($data['password']);
			$this->db->where('id',$id);
			$this->db->update('account', $data);
			if($this->db->affected_rows() == 1)
			{
				return true;
			}
			else
				return false;
		}
		//update
	}

	public function del_acc($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('account');
	}

	public function save_new_acc($data)
	{
		$data['mods'] = 'user';
		$data['last_web_login'] = '0000-00-00 00:00:00';
		$data['activation_key'] = '';
		//sprawdzic czy haslo nie jest puste
		if($data['password'] != '')
		{
			$this->db->insert('account', $data);
			if($this->db->affected_rows() == 1)
			{
				return true;
			}
			else
				return false;
		}
		else
		{
			return false;
		}
	}

	public function get_char_data($id)
	{
		$query = $this->db->query("SELECT * FROM player WHERE id='$id'");
		return $query->result();
	}

	public function update_char($data, $id)
	{
		$this->db->where('id',$id);
		$this->db->update('player', $data);
	}

	public function ban_user($id)
	{
		$data = array(
			'acc_id' => $id,
			'reason' => $this->input->post('reason'),
			'admin' => $this->session->userdata('login'),
			'data' => date('Y-m-d H:i:s'),
		);

		$this->db->query("UPDATE account SET status='BLOCK' WHERE id='$id'");

		$query = $this->db->query("SELECT * FROM banned_accounts WHERE acc_id='$id'");
		if($query->num_rows() > 0)
		{
			return false;
		}
		else
		{
			//$this->db->where('acc_id',$id);
			$this->db->insert('banned_accounts', $data);
			return true;
		}

		//status => BANNED 
	}

	public function get_banned($id)
	{
		$query = $this->db->query("SELECT reason FROM banned_accounts WHERE acc_id='$id'");

		if(empty($query->row('reason')))
		{
			return '';
		}
		else
		{
			return $query->row('reason');
		}
	}

	public function unblock_user($id)
	{
		$this->db->query("UPDATE account SET status='OK' WHERE id='$id'");
	}

	public function delete_char($id)
	{
		$data['char'] = $this->get_char_data($id);
		dump($data['char']);
		$this->db->where('id',$id);
		$this->db->delete('player');

		$this->db->insert('player_deleted', $data['char'][0]);
	}

	public function get_emails()
	{
		$emails = $this->db->query("SELECT * FROM account");
		$array = array();
		if(count($emails))
		{
			foreach($emails->result() as $email)
			{
				if($email->email != '')
				{
					$array[$email->email] = $email->email;
				}
			}
		}
		return $array;
	}

	public function block_ip($id)
	{
		//pobierz ip
		$qury = $this->db->query("SELECT ip FROM player WHERE account_id='$id'");
		$ip = $qury->row('ip');
		$query = $this->db->query("SELECT account_id FROM player WHERE ip='$ip'");
		
		//zablokuj wszedzie gdzie to ip
		foreach($query->result() as $row)
		{
			$this->db->query("UPDATE account SET status = 'BLOCK' WHERE id='$row->account_id'");
		}
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function check_block($login)
	{
		$query = $this->db->query("SELECT status,availDt FROM account WHERE login='$login'");
		$now = date('Y-m-d H:i:s');

		if($query->row('status') != 'OK' || $query->row('availDt') > $now)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function debug_char($id)
	{
		$this->db->query("UPDATE player SET x = '290837', y = '552631', map_index = '63' WHERE id = '$id'");
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
			return false;
	}

	public function get_empire($id)
	{
		$query = $this->db->query("SELECT empire FROM player_index WHERE pid1 = '$id'");
		return $query->row('empire');
	}

}

/* End of file user_m.php */
/* Location: ./application/models/user_m.php */