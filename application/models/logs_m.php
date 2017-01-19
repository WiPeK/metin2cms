<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs_m extends MY_Model {

	public function __construct()
	{
		parent::__construct();		
	}

	public function count_logs()
	{
		$query = $this->db->query("SELECT count(*) as ilosc FROM logs");
		return (int)$query->row('ilosc');
	}

	public function count_is_logs()
	{
		$query = $this->db->query("SELECT count(*) as ilosc FROM is_log");
		return (int)$query->row('ilosc');
	}

	public function count_vip_logs()
	{
		$query = $this->db->query("SELECT count(*) as ilosc FROM vip_buys_log");
		return (int)$query->row('ilosc');
	}

	public function count_cash_logs()
	{
		$query = $this->db->query("SELECT count(*) as ilosc FROM buy_coins_log");
		return (int)$query->row('ilosc');
	}

	public function count_user_logs()
	{
		$query = $this->db->query("SELECT count(*) as ilosc FROM users_logs");
		return (int)$query->row('ilosc');
	}

	public function count_command_logs()
	{
		$query = $this->db->query("SELECT count(*) as ilosc FROM command_log");
		return (int)$query->row('ilosc');
	}

	public function get_logs($perpage, $offset)
	{
		if($offset > 0)
		{
			$query = $this->db->query("SELECT * FROM logs ORDER BY logdate DESC LIMIT $perpage, $offset ");
			return $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT * FROM logs ORDER BY logdate DESC LIMIT $perpage ");
			return $query->result();
		}	
	}

	public function get_is_logs($perpage, $offset)
	{
		if($offset > 0)
		{
			$query = $this->db->query("SELECT * FROM is_log ORDER BY time DESC LIMIT $perpage, $offset ");
			return $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT * FROM is_log ORDER BY time DESC LIMIT $perpage ");
			return $query->result();
		}	
	}

	public function get_vip_logs($perpage, $offset)
	{
		if($offset > 0)
		{
			$query = $this->db->query("SELECT * FROM vip_buys_log ORDER BY time DESC LIMIT $perpage, $offset ");
			return $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT * FROM vip_buys_log ORDER BY time DESC LIMIT $perpage ");
			return $query->result();
		}	
	}

	public function get_cash_logs($perpage, $offset)
	{
		if($offset > 0)
		{
			$query = $this->db->query("SELECT * FROM buy_coins_log ORDER BY time DESC LIMIT $perpage, $offset ");
			return $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT * FROM buy_coins_log ORDER BY time DESC LIMIT $perpage ");
			return $query->result();
		}	
	}

	public function get_user_logs($perpage, $offset)
	{
		if($offset > 0)
		{
			$query = $this->db->query("SELECT * FROM users_logs ORDER BY time DESC LIMIT $perpage, $offset ");
			return $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT * FROM users_logs ORDER BY time DESC LIMIT $perpage ");
			return $query->result();
		}	
	}

	public function get_command_logs($perpage, $offset)
	{
		if($offset > 0)
		{
			$query = $this->db->query("SELECT * FROM command_log ORDER BY date DESC LIMIT $perpage, $offset ");
			return $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT * FROM command_log ORDER BY date DESC LIMIT $perpage ");
			return $query->result();
		}	
	}

	public function log_add_img($title, $url)
	{
		$login = $this->session->userdata('login');
	
		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' dodał obrazek do galerii o tytule: ' . anchor(site_url() . $url, $title),
		);
		$this->db->insert('logs',$data);
	}

	public function log_delete_img($title)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' usunął obrazek z galerii o tytule: ' . $title,
		);
		$this->db->insert('logs',$data);
	}

	public function log_send_gl_mess()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' wysłał wiadomość do wszystkich użytkowników',
		);
		$this->db->insert('logs',$data);
	}

	public function log_add_file($title)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' dodał plik o nazwie: ' . anchor(site_url('admin/manage_files'), $title),
		);
		$this->db->insert('logs',$data);
	}

	public function log_delete_file($file_title)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' usunął plik o nazwie: ' . $title,
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_news($id, $title)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' edytował news: ' . anchor(site_url() . 'admin/news/edit/' . $id ,$title),
		);
		$this->db->insert('logs',$data);
	}

	public function log_add_news($id, $title)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' dodał news: ' . anchor(site_url() . 'admin/news/edit/' . $id ,$title),
		);
		$this->db->insert('logs',$data);
	}

	public function log_delete_news($id, $title)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' usunął news: ' . $title . ' ID: ' . $id,
		);
		$this->db->insert('logs',$data);
	}

	public function log_answer_support($id)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' odpowiedział na zgłoszenie: ' . anchor(site_url() . 'admin/support/show_answered/' . $id, $id),
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_bonus($id)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' edytował bonus: ' . anchor(site_url() . 'admin/bonus_item/edit_bon/' . $id, $id),
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_cmsname()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' zmienił nazwę strony',
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_forum()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' zmienił link do forum',
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_ts()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' zmienił adres Team Speak',
		);
		$this->db->insert('logs',$data);
	}

	public function log_add_client_link()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' dodał link do pobrania clienta',
		);
		$this->db->insert('logs',$data);
	}

	public function log_delete_clink()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' usunął link do pobrania clienta',
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_regulamin()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' zmienił regulamin',
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_icon()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' zmienił ikonę',
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_logo()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' zmienił logo strony',
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_facebook()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' zmienił link facebook',
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_about()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' zmienił opis o stronie',
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_description()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' zmienił opis meta description',
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_keywords()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' zmienił meta słowa kluczowe',
		);
		$this->db->insert('logs',$data);
	}

	public function log_reg_on()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' włączył rejestracje',
		);
		$this->db->insert('logs',$data);
	}

	public function log_reg_off()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' wyłączył rejestracje',
		);
		$this->db->insert('logs',$data);
	}

	public function log_log_on()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' włączył logowanie',
		);
		$this->db->insert('logs',$data);
	}

	public function log_log_off()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' wyłączył logowanie',
		);
		$this->db->insert('logs',$data);
	}

	public function log_shop_on()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' włączył sklep',
		);
		$this->db->insert('logs',$data);
	}

	public function log_shop_off()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' wyłączył sklep',
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_cat($id)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' edytował kategorie w sklepie: ' . anchor(site_url() . 'admin/item_shop/add_category/' . $id, $id),
		);
		$this->db->insert('logs',$data);
	}

	public function log_add_cat()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' dodał kategorie do sklepu',
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_shop_item($id, $name)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' edytował przedmiot w sklepie ' . anchor(site_url() . 'admin/item_shop/add_item/' . $id, $name),
		);
		$this->db->insert('logs',$data);
	}

	public function log_add_new_shop_item($name)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' dodał przedmiot do sklepu ' . anchor(site_url() . 'admin/item_shop', $name),
		);
		$this->db->insert('logs',$data);
	}

	public function log_delete_shop_item($id)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' usunął przedmiot ze sklepu ID: ' . $id,
		);
		$this->db->insert('logs',$data);
	}

	public function log_delete_shop_cat($id)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' usunął kategorie ze sklepu ID: ' . $id,
		);
		$this->db->insert('logs',$data);
	}

	public function log_save_vip($id)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' edytował kategorie VIP w sklepie ID: ' . anchor(site_url() . 'admin/item_shop/vip_edit/' . $id ,$id),
		);
		$this->db->insert('logs',$data);
	}

	public function log_save_new_vip()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' dodał kategorie VIP do sklepu',
		);
		$this->db->insert('logs',$data);
	}

	public function log_vip_delete()
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' usunął kategorie VIP ze sklepu ID: ' . $id,
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_acc($id)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' edytował konto ID: ' . anchor(site_url() . 'admin/user/edit/' . $id,$id),
		);
		$this->db->insert('logs',$data);
	}

	public function log_create_acc($loginacc)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' stworzył konto Login: ' . $loginacc,
		);
		$this->db->insert('logs',$data);
	}

	public function log_del_acc($id)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' usunął konto ID: ' . $id,
		);
		$this->db->insert('logs',$data);
	}

	public function log_edit_char($id)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' edytował postać: ' . anchor(site_url() . 'admin/user/char_edit/' . $id,$id),
		);
		$this->db->insert('logs',$data);
	}

	public function log_char_delete($id)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' usunął postać ID: ' . $id,
		);
		$this->db->insert('logs',$data);
	}

	public function log_block_user($id)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' zablokował konto: ' . anchor(site_url() . 'admin/user/block/' . $id, $id),
		);
		$this->db->insert('logs',$data);
	}

	public function log_unblock_user($id)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' odblokował konto: ' . anchor(site_url() . 'admin/user/block/' . $id, $id),
		);
		$this->db->insert('logs',$data);
	}

	public function log_block_ip($id)
	{
		$login = $this->session->userdata('login');

		$data = array(
			'logdate' => date('Y-m-d H:i:s'),
			'logbody' => 'Administrator: ' . $login . ' zablokował wszystkie konta powiązane przez ip z kontem o ID: : ' . anchor(site_url() . 'admin/user/block/' . $id, $id),
		);
		$this->db->insert('logs',$data);
	}

	public function log_admin_login()
	{
		$data = array(
			'login' => $this->input->post('login'),
			'time' => date('Y-m-d H:i:s'),
			'action' => 'logowanie administratora',
			'ip' => $this->input->ip_address(),
		);

		$this->db->insert('users_logs',$data);
	}

	public function log_user_login()
	{
		$data = array(
			'login' => $this->input->post('login'),
			'time' => date('Y-m-d H:i:s'),
			'action' => 'logowanie użytkownika',
			'ip' => $this->input->ip_address(),
		);

		$this->db->insert('users_logs',$data);
	}

	public function log_user_neg_login()
	{
		$data = array(
			'login' => $this->input->post('login'),
			'time' => date('Y-m-d H:i:s'),
			'action' => 'nieudane logowanie użytkownika',
			'ip' => $this->input->ip_address(),
		);

		$this->db->insert('users_logs',$data);
	}

	public function log_rem_pass($email)
	{
		$data = array(
			'login' => $email,
			'time' => date('Y-m-d H:i:s'),
			'action' => 'Użytkownik o przypisanym email: ' . $email . ' przypomniał hasło.',
			'ip' => $this->input->ip_address(),
		);

		$this->db->insert('users_logs',$data);
	}

	public function log_change_pw($id)
	{
		$data = array(
			'login' => $this->session->userdata('login'),
			'time' => date('Y-m-d H:i:s'),
			'action' => 'Użytkownik o ID: ' . $id . ' zmienił hasło.',
			'ip' => $this->input->ip_address(),
		);

		$this->db->insert('users_logs',$data);
	}

	public function log_change_del_code($id)
	{
		$data = array(
			'login' => $this->session->userdata('login'),
			'time' => date('Y-m-d H:i:s'),
			'action' => 'Użytkownik o ID: ' . $id . ' zmienił kod usuwania postaci.',
			'ip' => $this->input->ip_address(),
		);

		$this->db->insert('users_logs',$data);
	}

	public function log_change_email($id)
	{
		$data = array(
			'login' => $this->session->userdata('login'),
			'time' => date('Y-m-d H:i:s'),
			'action' => 'Użytkownik o ID: ' . $id . ' zmienił email.',
			'ip' => $this->input->ip_address(),
		);

		$this->db->insert('users_logs',$data);
	}

	public function log_debug_char($id)
	{	
		$login = $this->session->userdata('login');

		$data = array(
			'login' => $this->session->userdata('login'),
			'time' => date('Y-m-d H:i:s'),
			'action' => 'Użytkownik o loginie: ' . $login . ' odbugował postać ID: ' . $id,
			'ip' => $this->input->ip_address(),
		);

		$this->db->insert('users_logs',$data);
	}

}

/* End of file logs_m.php */
/* Location: ./application/models/logs_m.php */