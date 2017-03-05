<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_config_m extends MY_Model {

	public $rules_cmsconfig = array(
		'name' => array(
			'field' => 'name',
			'label' => 'Nazwa',
			'rules' => 'trim|xss_clean|alpha_numeric|min_lenght[3]'	
		),
		'regulamin' => array(
			'field' => 'regulamin',
			'label' => 'Regulamin',
			'rules' => 'trim|xss_clean'	
		),
	);

	public $rules_fb = array(
		'fb_link' => array(
			'field' => 'fb_link',
			'label' => 'Link fb',
			'rules' => 'trim|prep_url|required'	
		),
	);

	public $rules_about = array(
		'about_service' => array(
			'field' => 'about_service',
			'label' => 'O serwisie',
			'rules' => 'trim|xss_clean|required'	
		),
	);

	public $rules_description = array(
		'description' => array(
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'trim|xss_clean|required'	
		),
	);

	public $rules_keywords = array(
		'keywords' => array(
			'field' => 'keywords',
			'label' => 'Keywords',
			'rules' => 'trim|xss_clean|required'	
		),
	);

	public $rules_forum = array(
		'forum' => array(
			'field' => 'forum',
			'label' => 'Forum',
			'rules' => 'trim|required'	
		),
	);

	public $rules_team_speak = array(
		'ts_adress' => array(
			'field' => 'ts_adress',
			'label' => 'Team speak adres',
			'rules' => 'trim|xss_clean|required'	
		),
	);

	public function __construct()
	{
		parent::__construct();	
	}

	public function get_new_cmsconfig(){
		$cmsconfig = new stdClass();
		$all_cms = $this->get_cmsconfig();
		$cmsconfig->name = $all_cms->name;
		$cmsconfig->regulamin = $all_cms->regulamin;
		$cmsconfig->cmsfavicon = $all_cms->favicon_url;
		$cmsconfig->cmslogo = $all_cms->logo_url;
		$cmsconfig->fb_link = $all_cms->fb_link;
		$cmsconfig->about = $all_cms->about;
		$cmsconfig->description = $all_cms->description;
		$cmsconfig->keywords = $all_cms->keywords;
		$cmsconfig->register_status = $all_cms->register_status;
		$cmsconfig->login_status = $all_cms->login_status;
		$cmsconfig->shop_status = $all_cms->shop_status;
		$cmsconfig->shop_describe = $all_cms->shop_describe;
		$cmsconfig->forum_url = $all_cms->forum_url;
		$cmsconfig->ts_adress = $all_cms->ts_adress;
		return $cmsconfig;
	}

	public function get_cmsconfig()
	{
		$query = $this->db->query("SELECT * FROM cmsconfig");
		return $query->row();
	}

	public function save_logo($cmslogo)
	{
		$logo = $cmslogo['logo_url'];
		$this->db->query("UPDATE cmsconfig SET logo_url = '$logo'");
	}

	public function update_fblink($fb)
	{
		$this->db->query("UPDATE cmsconfig SET fb_link = '$fb'");
	}

	public function update_about($about)
	{
		$this->db->query("UPDATE cmsconfig SET about = '$about'");
	}

	public function update_cms_ts($ts)
	{
		$this->db->query("UPDATE cmsconfig SET ts_adress = '$ts'");
	}

	public function update_description($description)
	{
		$this->db->query("UPDATE cmsconfig SET description = '$description'");
	}

	public function update_cms_forum($link)
	{
		$this->db->query("UPDATE cmsconfig SET forum_url = '$link'");
	}

	public function update_keywords($keywords)
	{
		$this->db->query("UPDATE cmsconfig SET keywords = '$keywords'");
	}

	public function update_cms_name($cmsname)
	{
		$this->db->query("UPDATE cmsconfig SET name = '$cmsname'");
	}
	public function update_cms_regulamin($cmsregulamin)
	{
		$this->db->query("UPDATE cmsconfig SET regulamin = '$cmsregulamin'");
	}

	public function register_status()
	{
		//metoda sprawdza czy rejestracja jest włączona czy nie
		$query = $this->db->query("SELECT register_status FROM cmsconfig");

		if((int) $query->row('register_status') === 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function login_status()
	{
		//metoda sprawdza czy rejestracja jest włączona czy nie
		$query = $this->db->query("SELECT login_status FROM cmsconfig");

		if((int) $query->row('login_status') === 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function register_on()
	{
		$this->db->query("UPDATE cmsconfig SET register_status=1");
	}

	public function register_off()
	{
		$this->db->query("UPDATE cmsconfig SET register_status=0");
	}

	public function login_on()
	{
		$this->db->query("UPDATE cmsconfig SET login_status=1");
	}

	public function login_off()
	{
		$this->db->query("UPDATE cmsconfig SET login_status=0");
	}

	public function shop_on()
	{
		$this->db->query("UPDATE cmsconfig SET shop_status=1");
	}

	public function shop_off()
	{
		$this->db->query("UPDATE cmsconfig SET shop_status=0");
	}

	public function get_browser_usage()
	{
		$query = $this->db->query('SELECT chrome,firefox,internet_explorer,safari,opera,mobile_browser FROM user_browsers WHERE id = 1');
		$other = $this->db->query('SELECT sum(flock + shiira + chimera + phoenix + firebird + camino + netscape + omniweb + mozilla + konqueror + icab + lynx + links + hotjava + amaya + ibrowse + maxthon + ubuntu_web_browser + other_browser) as other FROM user_browsers WHERE id =1 ');
		//$brow['Inne'] = $other->row('other');
		$all = (int)$query->row('chrome') + (int)$query->row('firefox') + (int)$query->row('internet_explorer') + (int)$query->row('safari') + (int)$query->row('opera') + (int)$query->row('mobile_browser') + (int)$other->row('other');

		$brow['Chrome'] = round(((int)$query->row('chrome')/$all)*100,1);
		$brow['Firefox'] = round(((int)$query->row('firefox')/$all)*100,1);
		$brow['IE'] = round(((int)$query->row('internet_explorer')/$all)*100,1);
		$brow['Safari'] = round(((int)$query->row('safari')/$all)*100,1);
		$brow['Opera'] = round(((int)$query->row('opera')/$all)*100,1);
		$brow['Mobile'] = round(((int)$query->row('mobile_browser')/$all)*100,1);
		$brow['Inne'] = round(((int)$other->row('other')/$all)*100,1);

		return $brow;
	}

	public function get_system_usage()
	{
		$query = $this->db->query("SELECT windows_8_1,windows_8,windows_7,windows_vista,windows_xp,windows_phone,android,ios,mac_osx,linux,macintosh,debian FROM user_systems WHERE id=1");
		$query_other = $this->db->query("SELECT sum(windows_2003 + windows_2000 + windows_nt_4_0 + windows_nt + windows_98 + windows_95 + unknown_windows + blackberry + power_pc_mac + freebsd + sun_solaris + beos + apachebench + aix + irix + decosf + hp_ux + netbsd + bsdi + openbsd + gnu_linux + unknown_unix + symbian_os + other_system) as other FROM user_systems WHERE id = 1");
	
		$all = (int)$query->row('windows_8_1') + (int)$query->row('windows_8') + (int)$query->row('windows_7') + (int)$query->row('windows_vista') + (int)$query->row('windows_xp') + (int)$query->row('windows_phone') + (int)$query->row('android') + (int)$query->row('ios') + (int)$query->row('mac_osx') + (int)$query->row('linux') + (int)$query->row('macintosh') + (int)$query->row('debian') + (int)$query_other->row('other');

		$usys['Windows 8.1'] = round(((int)$query->row('windows_8_1')/$all)*100,1);
		$usys['Windows 8'] = round(((int)$query->row('windows_8')/$all)*100,1);
		$usys['Windows 7'] = round(((int)$query->row('windows_7')/$all)*100,1);
		$usys['Windows Vista'] = round(((int)$query->row('windows_vista')/$all)*100,1);
		$usys['Windows XP'] = round(((int)$query->row('windows_xp')/$all)*100,1);
		$usys['Windows Phone'] = round(((int)$query->row('windows_phone')/$all)*100,1);
		$usys['Android'] = round(((int)$query->row('android')/$all)*100,1);
		$usys['iOS'] = round(((int)$query->row('ios')/$all)*100,1);
		$usys['mac_osx'] = round(((int)$query->row('mac_osx')/$all)*100,1);
		$usys['linux'] = round(((int)$query->row('linux')/$all)*100,1);
		$usys['macintosh'] = round(((int)$query->row('macintosh')/$all)*100,1);
		$usys['debian'] = round(((int)$query->row('debian')/$all)*100,1);
		$usys['Inne'] = round(((int)$query_other->row('other')/$all)*100,1);

		return $usys;
	}

	public function get_browsers()
	{
		$query = $this->db->query("SELECT * FROM user_browsers");
		return $query->result();
	}

	public function data_to_dashboard()
	{
		$data['cuser'] = $this->db->count_all('account');
		$data['cguild'] = $this->db->count_all('guild');
		$data['cplayer'] = $this->db->count_all('player');
		
		$query = $this->db->get_where('support',array('status' => 'new'));

		$data['csupport'] = $query->num_rows();
		return $data;
	}

	public function get_sales_items()
	{
		$query = $this->db->query("SELECT id, name, vnum FROM shop_items");

		$data = array();
		$i = 0;
		foreach($query->result() as $row)
		{
			$data[$i]['id'] = $row->id;
			$data[$i]['name'] = $row->name;
			$data[$i]['vnum'] = $row->vnum;

			$qry = $this->db->query("SELECT COUNT(*) as count FROM is_log WHERE vnum = '$row->vnum'");
			$cnt = $qry->row();
			$data[$i]['count'] = $cnt->count;
			$i++;
		}
		$q_exp = $this->db->query("SELECT COUNT(*) as count FROM vip_buys_log WHERE category = 'exp'");
		$qexp = $q_exp->row();
		$data[$i]['name'] = 'Pakiety exp';
		$data[$i]['count'] = $qexp->count;
		$i++;

		$q_drop = $this->db->query("SELECT COUNT(*) as count FROM vip_buys_log WHERE category = 'drop'");
		$qdrop = $q_drop->row();
		$data[$i]['name'] = 'Pakiety drop';
		$data[$i]['count'] = $qdrop->count;
		$i++;

		$q_money = $this->db->query("SELECT COUNT(*) as count FROM vip_buys_log WHERE category = 'money'");
		$qmoney = $q_money->row();
		$data[$i]['name'] = 'Pakiety yang';
		$data[$i]['count'] = $qmoney->count;

		return $data;
	}

	public function get_online()
	{
		$query = $this->db->query("SELECT count(*) as count FROM player WHERE DATE_SUB(NOW(), INTERVAL 10 MINUTE) < last_play");
		return $query->row('count');
	}

}

/* End of file page_config_m.php */
/* Location: ./application/models/page_config_m.php */
