<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* User statistic model
*
* @package		WiPeK CMS
* @author 		Krzysztof Adamczyk - WiPeK wipekxxx@gmail.com
* @copyright	Krzysztof Adamczyk 2015
* @version 		Version 1.0
*/

class User_statistic_m extends MY_Model {

	public function __construct()
	{
		parent::__construct();	
	}

	public function robot_visit($data)
	{
		switch ($data) 
		{
			case 'Googlebot':
				$this->db->query("UPDATE robots_visit SET googlebot = googlebot+1");
			break;
			case 'MSNBot':
				$this->db->query("UPDATE robots_visit SET msnbot = msnbot+1");
			break;
			case 'Baiduspider':
				$this->db->query("UPDATE robots_visit SET baiduspider = baiduspider+1");
			break;
			case 'Bing':
				$this->db->query("UPDATE robots_visit SET bing = bing+1");
			break;
			case 'Inktomi Slurp':
				$this->db->query("UPDATE robots_visit SET inktomi_slurp = inktomi_slurp+1");
			break;
			case 'Yahoo':
				$this->db->query("UPDATE robots_visit SET yahoo = yahoo+1");
			break;
			case 'AskJeeves':
				$this->db->query("UPDATE robots_visit SET askjeeves = askjeeves+1");
			break;
			case 'FastCrawler':
				$this->db->query("UPDATE robots_visit SET fastcrawler = fastcrawler+1");
			break;
			case 'InfoSeek Robot 1.0':
				$this->db->query("UPDATE robots_visit SET infoseek_robot_1_0 = infoseek_robot_1_0+1");
			break;
			case 'Lycos':
				$this->db->query("UPDATE robots_visit SET lycos = lycos+1");
			break;
			case 'YandexBot':
				$this->db->query("UPDATE robots_visit SET yandexbot = yandexbot+1");
			break;
			case 'MediaPartners Google':
				$this->db->query("UPDATE robots_visit SET mediapartners_google = mediapartners_google+1");
			break;
			case 'Crazy Webcrawler':
				$this->db->query("UPDATE robots_visit SET crazy_webcrawler = crazy_webcrawler+1");
			break;
			case 'AdsBot Google':
				$this->db->query("UPDATE robots_visit SET adsbot_google = adsbot_google+1");
			break;
			case 'Feedfetcher Google':
				$this->db->query("UPDATE robots_visit SET feedfetcher_google = feedfetcher_google+1");
			break;
			case 'Curious George':
				$this->db->query("UPDATE robots_visit SET curious_george = curious_george+1");
			break;
			default:
				$this->db->query("UPDATE robots_visit SET other_robot = other_robot+1");
		}
	}

	public function user_platform($data)
	{
		switch ($data)
		{
			case 'Windows 8.1':
				$this->db->query("UPDATE user_systems SET windows_8_1 = windows_8_1+1");
			break;
			case 'Windows 8':
				$this->db->query("UPDATE user_systems SET windows_8 = windows_8+1");
			break;
			case 'Windows 7':
				$this->db->query("UPDATE user_systems SET windows_7 = windows_7+1");
			break;
			case 'Windows Vista':
				$this->db->query("UPDATE user_systems SET windows_vista = windows_vista+1");
			break;
			case 'Windows 2003':
				$this->db->query("UPDATE user_systems SET windows_2003 = windows_2003+1");
			break;
			case 'Windows XP':
				$this->db->query("UPDATE user_systems SET windows_xp = windows_xp+1");
			break;
			case 'Windows 2000':
				$this->db->query("UPDATE user_systems SET windows_2000 = windows_2000+1");
			break;
			case 'Windows NT 4.0':
				$this->db->query("UPDATE user_systems SET windows_nt_4_0 = windows_nt_4_0+1");
			break;
			case 'Windows NT':
				$this->db->query("UPDATE user_systems SET windows_nt = windows_nt+1");
			break;
			case 'Windows 98':
				$this->db->query("UPDATE user_systems SET windows_98 = windows_98+1");
			break;
			case 'Windows 95':
				$this->db->query("UPDATE user_systems SET windows_95 = windows_95+1");
			break;
			case 'Windows Phone':
				$this->db->query("UPDATE user_systems SET windows_phone = windows_phone+1");
			break;
			case 'Unknown Windows OS':
				$this->db->query("UPDATE user_systems SET unknown_windows = unknown_windows+1");
			break;
			case 'Android':
				$this->db->query("UPDATE user_systems SET android = android+1");
			break;
			case 'BlackBerry':
				$this->db->query("UPDATE user_systems SET blackberry = blackberry+1");
			break;
			case 'iOS':
				$this->db->query("UPDATE user_systems SET ios = ios+1");
			break;
			case 'Mac OS X':
				$this->db->query("UPDATE user_systems SET mac_osx = mac_osx+1");
			break;
			case 'Power PC Mac':
				$this->db->query("UPDATE user_systems SET power_pc_mac = power_pc_mac+1");
			break;
			case 'FreeBSD':
				$this->db->query("UPDATE user_systems SET freebsd = freebsd+1");
			break;
			case 'Macintosh':
				$this->db->query("UPDATE user_systems SET macintosh = macintosh+1");
			break;
			case 'Linux':
				$this->db->query("UPDATE user_systems SET linux = linux+1");
			break;
			case 'Debian':
				$this->db->query("UPDATE user_systems SET debian = debian+1");
			break;
			case 'Sun Solaris':
				$this->db->query("UPDATE user_systems SET sun_solaris = sun_solaris+1");
			break;
			case 'BeOS':
				$this->db->query("UPDATE user_systems SET beos = beos+1");
			break;
			case 'ApacheBench':
				$this->db->query("UPDATE user_systems SET apachebench = apachebench+1");
			break;
			case 'AIX':
				$this->db->query("UPDATE user_systems SET aix = aix+1");
			break;
			case 'Irix':
				$this->db->query("UPDATE user_systems SET irix = irix+1");
			break;
			case 'DEC OSF':
				$this->db->query("UPDATE user_systems SET decosf = decosf+1");
			break;
			case 'HP-UX':
				$this->db->query("UPDATE user_systems SET hp_ux = hp_ux+1");
			break;
			case 'NetBSD':
				$this->db->query("UPDATE user_systems SET netbsd = netbsd+1");
			break;
			case 'BSDi':
				$this->db->query("UPDATE user_systems SET bsdi = bsdi+1");
			break;
			case 'OpenBSD':
				$this->db->query("UPDATE user_systems SET openbsd = openbsd+1");
			break;
			case 'GNU/Linux':
				$this->db->query("UPDATE user_systems SET gnu_linux = gnu_linux+1");
			break;
			case 'Unknown Unix OS':
				$this->db->query("UPDATE user_systems SET unknown_unix = unknown_unix+1");
			break;
			case 'Symbian OS':
				$this->db->query("UPDATE user_systems SET symbian_os = symbian_os+1");
			break;
			default:
				$this->db->query("UPDATE user_systems SET other_system = other_system+1");
		}
	}

	public function user_browser($data)
	{
		switch ($data)
		{
			case 'Opera':
				$this->db->query("UPDATE user_browsers SET opera = opera+1");
			break;
			case 'Flock':
				$this->db->query("UPDATE user_browsers SET flock = flock+1");
			break;
			case 'Chrome':
				$this->db->query("UPDATE user_browsers SET chrome = chrome+1");
			break;
			case 'Internet Explorer':
				$this->db->query("UPDATE user_browsers SET internet_explorer = internet_explorer+1");
			break;
			case 'Shiira':
				$this->db->query("UPDATE user_browsers SET shiira = shiira+1");
			break;
			case 'Firefox':
				$this->db->query("UPDATE user_browsers SET firefox = firefox+1");
			break;
			case 'Chimera':
				$this->db->query("UPDATE user_browsers SET chimera = chimera+1");
			break;
			case 'Phoenix':
				$this->db->query("UPDATE user_browsers SET phoenix = phoenix+1");
			break;
			case 'Firebird':
				$this->db->query("UPDATE user_browsers SET firebird = firebird+1");
			break;
			case 'Camino':
				$this->db->query("UPDATE user_browsers SET camino = camino+1");
			break;
			case 'Netscape':
				$this->db->query("UPDATE user_browsers SET netscape = netscape+1");
			break;
			case 'OmniWeb':
				$this->db->query("UPDATE user_browsers SET omniweb = omniweb+1");
			break;
			case 'Safari':
				$this->db->query("UPDATE user_browsers SET safari = safari+1");
			break;
			case 'Mozilla':
				$this->db->query("UPDATE user_browsers SET mozilla = mozilla+1");
			break;
			case 'Konqueror':
				$this->db->query("UPDATE user_browsers SET konqueror = konqueror+1");
			break;
			case 'iCab':
				$this->db->query("UPDATE user_browsers SET icab = icab+1");
			break;
			case 'Lynx':
				$this->db->query("UPDATE user_browsers SET lynx = lynx+1");
			break;
			case 'Links':
				$this->db->query("UPDATE user_browsers SET links = links+1");
			break;
			case 'HotJava':
				$this->db->query("UPDATE user_browsers SET hotjava = hotjava+1");
			break;
			case 'Amaya':
				$this->db->query("UPDATE user_browsers SET amaya = amaya+1");
			break;
			case 'IBrowse':
				$this->db->query("UPDATE user_browsers SET ibrowse = ibrowse+1");
			break;
			case 'Maxthon':
				$this->db->query("UPDATE user_browsers SET maxthon = maxthon+1");
			break;
			case 'Ubuntu Web Browser':
				$this->db->query("UPDATE user_browsers SET ubuntu_web_browser = ubuntu_web_browser+1");
			break;
			case 'Mobile Browser':
				$this->db->query("UPDATE user_browsers SET mobile_browser = mobile_browser+1");
			break;
			default:
				$this->db->query("UPDATE user_browsers SET other_browser = other_browser+1");
		}
	}

}

/* End of file user_statistic_m.php */
/* Location: ./application/models/user_statistic_m.php */