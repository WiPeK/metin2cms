<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Shop Controller
*
* @package		WiPeK Metin2CMS
* @author 		Krzysztof Adamczyk - WiPeK wipekxxx@gmail.com
* @copyright	Krzysztof Adamczyk 2015
* @version 		Version 1.0
*/

class Shop extends Frontend_Controller {

	private $conf_sms = array(
		'pakiet_1' => array(
			'pack' => 'pakiet_1', //nazwa pakieru
			'sm_number' => 100, //ilość sm
			'sms_code' => 'DOT.1', //kod wysylany w sms
			'sms_number' => 12345, //numer na ktory wyslac sms
			'sm_cost' => '10zł', //koszt sms
			'gr_val' => 1000, //wartosc netto w groszach
		),
		'pakiet_2' => array(
			'pack' => 'pakiet_2',
			'sm_number' => 200,
			'sms_code' => 'DOT.2',
			'sms_number' => 54321,
			'sm_cost' => '20zł',
			'gr_val' => 2000,
		),
		'pakiet_3' => array(
			'pack' => 'pakiet_3',
			'sm_number' => 300,
			'sms_code' => 'DOT.3',
			'sms_number' => 97531,
			'sm_cost' => '30zł',
			'gr_val' => 3000,
		),
		'pakiet_4' => array(
			'pack' => 'pakiet_4',
			'sm_number' => 400,
			'sms_code' => 'DOT.4',
			'sms_number' => 86420,
			'sm_cost' => '40zł',
			'gr_val' => 4000,
		),
	);

	// private $conf_call = array(
	// 	'sm_number' => '100',
	// 	'call_code' => '1234',
	// 	'call_number' => '0-700-000-000',
	// 	'sm_cost' => '10zł',
	// );

	// private $conf_transfer = array(
	// 	'pakiet_1' => array(
	// 		'sm_cost' => '10zł',
	// 		'sm_number' => 100,
	// 	),
	// 	'pakiet_2' => array(
	// 		'sm_cost' => '20zł',
	// 		'sm_number' => 200,
	// 	),
	// 	'pakiet_3' => array(
	// 		'sm_cost' => '30zł',
	// 		'sm_number' => 300,
	// 	),
	// 	'pakiet_4' => array(
	// 		'sm_cost' => '40zł',
	// 		'sm_number' => 400,
	// 	),
	// 	'pakiet_5' => array(
	// 		'sm_cost' => '50zł',
	// 		'sm_number' => 500,
	// 	),
	// );

	public function __construct()
	{
		parent::__construct();
		$this->load->model('front_shop_m');
		$this->load->model('shop_logs_m');
		if($this->user_m->loggedin() == FALSE)
		{
			redirect(site_url());
		}
		if($this->front_shop_m->get_shop_status() == 0)
		{
			redirect(site_url());
		}
	}

	public function index()
	{
		//load index shop page
		$this->data['sub_view'] = 'shop/describe';
		$this->data['subview'] = 'shop/index';
		$this->load->view('front_layout',$this->data);
	}

	public function category($id)
	{
		//validate $id param
		if((!$id) || ($id == 0) || ($id == ''))
		{
			redirect(site_url());
		}
		//validate are param is shop category
		if($this->front_shop_m->is_category($id) === true)
		{
			//load shop category page
			$this->data['items'] = $this->front_shop_m->get_items_to_category($id);
			$this->data['sub_view'] = 'shop/category';
			$this->data['subview'] = 'shop/index';
			$this->load->view('front_layout',$this->data);
		}
		else
		{
			//if id isn't shop category then redirect
			redirect(site_url());
		}
	}

	public function buy_item($id)
	{
		//validate id param
		if((!$id) || ($id == 0) || ($id == ''))
		{
			redirect(site_url());
		}
		//sprawdzenie czy istnieje
		//check param are item in shop
		if($this->front_shop_m->is_item($id) === true)
		{
		//sprawdzenie ceny
			//fetch item price
			$data['item'] = $this->front_shop_m->get_item_price($id); 
		//sprawdzenie ile user ma sm
			//validate are user have cash to buy item
			if($this->data['user_data'][0]->cash >= $data['item']->price)
			{
				//pobranie przedmiotu z item_proto
				//get item data from item_proto
				$fetch = $this->front_shop_m->get_item_proto_shop($data['item']->vnum);
				
				//check item shop box position
				$item_size = $fetch[0]->size;
				$belPos = $this->front_shop_m->checkPos($this->data['user_data'][0]->id, $item_size);

				$possiblePos = $this->front_shop_m->findPos($belPos['islager'], $item_size);

				if(!empty($possiblePos))
				{
					//substract cash from account
					if($this->front_shop_m->substract_cash($this->data['user_data'][0]->id,$data['item']->price) === true)
					{
						//add item to mall
						if($this->front_shop_m->add_item($this->data['user_data'][0]->id, (int)$data['item']->vnum, $possiblePos[0], (int)$data['item']->stack) === true)
						{
							//load success view
							$this->shop_logs_m->log_buy_item($this->data['user_data'][0]->id, $data['item']->vnum);
							$this->data['sub_view'] = 'shop/success';
							$this->data['subview'] = 'shop/index';
							$this->load->view('front_layout',$this->data);
						}
						else
						{
							redirect(site_url());
						}			
					}
					else
					{
						redirect(site_url());
					}
				}
				else
				{
					//if user have full mall
					$this->data['sub_view'] = 'shop/full_mall';
					$this->data['subview'] = 'shop/index';
					$this->load->view('front_layout',$this->data);
				}

			}
			else
			{	
				redirect(site_url());
			}	
		}
		else
		{
			redirect(site_url());
		}
	}

	public function add_methods()
	{
		//load view with buy cash methods
		$this->data['sub_view'] = 'shop/add_methods';
		$this->data['subview'] = 'shop/index';
		$this->load->view('front_layout',$this->data);
	}

	public function add_method($id)
	{
		//load views with buy cash method
		if((int)$id === 1)
		{
			$this->data['sub_view'] = 'shop/add_method_1';
			$this->data['subview'] = 'shop/index';
			$this->load->view('front_layout',$this->data);
		}
		elseif((int)$id === 2)
		{
			$this->data['sub_view'] = 'shop/add_method_2';
			$this->data['subview'] = 'shop/index';
			$this->load->view('front_layout',$this->data);
		}
		elseif((int)$id === 3)
		{
			$this->data['call_conf'] = $this->conf_call;

			$this->data['sub_view'] = 'shop/add_method_3';
			$this->data['subview'] = 'shop/index';
			$this->load->view('front_layout',$this->data);
		}
		else
		{
			//if method does't exist redirect
			redirect(site_url());
		}
	}

	public function add_method_sms($id)
	{
		switch ((int)$id) {
			case 1:
				$this->data['sms_conf'] = $this->conf_sms['pakiet_' . (int)$id];
				break;

			case 2:
				$this->data['sms_conf'] = $this->conf_sms['pakiet_' . (int)$id];
				break;

			case 3:
				$this->data['sms_conf'] = $this->conf_sms['pakiet_' . (int)$id];
				break;

			case 4:
				$this->data['sms_conf'] = $this->conf_sms['pakiet_' . (int)$id];
				
				break;
			
			default:
				redirect(site_url());
				break;
		}

		$this->data['sub_view'] = 'shop/add_sms';
		$this->data['subview'] = 'shop/index';
		$this->load->view('front_layout',$this->data);
	}

	public function add_coins_sms()
	{
		//platnosci-online
		//fetch validate rules
		$rules = $this->front_shop_m->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() === true)
		{
			$check = $this->input->post('code');

			$pack = $this->input->post('pack');

			$id_sprzedawcy = 1234; // ID Partnera
			$klucz_transakcyjny = 'abcdefabcdefabcdefabcdef';

			$prefix = "MPA";
			$sufix = $this->conf_sms[$pack]['sms_code']; // sufiks usługi SMS (dla uslugi MPA.ABCD będzie to slowo ABCD ).
			$numer_sms = $check;

			$tab = array();
			$tab['code'] = $numer_sms;
			$tab['id'] = $id_sprzedawcy;
			$tab['sufix'] = $sufix;

			$sms_server = 'https://platnosci-online.pl/sms_check.php';

			$opch = curl_init();
		
			curl_setopt ($opch, CURLOPT_URL, $sms_server);
			curl_setopt ($opch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt ($opch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt ($opch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt ($opch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($opch, CURLOPT_TIMEOUT, 100);
			curl_setopt ($opch, CURLOPT_POST, 1);
			curl_setopt ($opch, CURLOPT_POSTFIELDS, $tab);

			# wywołanie sesji cURL i wpisanie
			# odpowiedzi serwera Płatności do zmiennej $wynik
			$wynik = curl_exec ($opch);

			# zamknięcie sesji cURL
			curl_close ($opch);

			# zapisz wynik zapytania do tablicy $dane
			$dane = explode("\n", $wynik);
			
			# wartości danych odpowiedzi z serwera Płatności:
			$status = $dane[0]; # Status transakcji. 1 - OK, 0 - błąd
			$amount = $dane[1]; # Kwota w groszach za przesłanie SMS lub kod błędu jeśli wartość status jest równa 0
			$control = $dane[2]; # Podpis transakcji przekazany z serwera Płatności

			$bkey = pack('H*',$klucz_transakcyjny);
			// $status = 1;
			// $amount = 1000;
			// $control = md5($id_sprzedawcy . $sufix . $numer_sms . $bkey);


			$control_test = md5($id_sprzedawcy . $sufix . $numer_sms . $bkey);

			if($status == '0')
		    {
		    	$this->data['sub_view'] = 'shop/bad_key';
				$this->data['subview'] = 'shop/index';
				$this->load->view('front_layout',$this->data);
		    }
		    elseif($status == '1')
		    {
		    	if($control_test == $control)
		    	{
		    		if($amount == $this->conf_sms['pakiet_1']['gr_val'])
			    	{
			    		$ilosc_sm = $this->conf_sms['pakiet_1']['sm_number'];
			    	}
			    	elseif($amount == $this->conf_sms['pakiet_2']['gr_val'])
			    	{
			    		$ilosc_sm = $this->conf_sms['pakiet_2']['sm_number'];
			    	}
			    	elseif($amount == $this->conf_sms['pakiet_3']['gr_val'])
			    	{
			    		$ilosc_sm = $this->conf_sms['pakiet_3']['sm_number'];
			    	}
			    	elseif($amount == $this->conf_sms['pakiet_4']['gr_val'])
			    	{
			    		$ilosc_sm = $this->conf_sms['pakiet_4']['sm_number'];
			    	}

			    	if($this->front_shop_m->add_coins($this->session->userdata('login'),$ilosc_sm) === true)
					{
						$this->shop_logs_m->log_buy_coins($this->input->post('code'));
						$this->data['sub_view'] = 'shop/add_succ';
						$this->data['subview'] = 'shop/index';
						$this->load->view('front_layout',$this->data);
					}
					else
					{
						$this->data['sub_view'] = 'shop/add_fail';
						$this->data['subview'] = 'shop/index';
						$this->load->view('front_layout',$this->data);
					}
		    	}

		    	
		    } 

		}
		else
		{

		}

	}

	// public function add_coins_sms()
	// {
	// 	//fetch validate rules
	// 	$rules = $this->front_shop_m->rules;
	// 	$this->form_validation->set_rules($rules);

	// 	if($this->form_validation->run() === true)
	// 	{
	// 		//sprawdzanie czy smnumb odpowiada smscode
	// 		$code_inp = $this->input->post('smscode');
	// 		$smnumb = $this->input->post('smnum');
	// 		$check = $this->input->post('code');

	// 		if(($smnumb == $this->conf_sms['pakiet_1']['sm_number']) && ($code_inp == $this->conf_sms['pakiet_1']['sms_code']))
	// 		{
	// 			$code = $this->conf_sms['pakiet_1']['sms_code'];
	// 			$ilosc_sm = (int)$this->conf_sms['pakiet_1']['sm_number'];
	// 		}
	// 		elseif(($smnumb == $this->conf_sms['pakiet_2']['sm_number']) && ($code_inp == $this->conf_sms['pakiet_2']['sms_code']))
	// 		{
	// 			$code = $this->conf_sms['pakiet_2']['sms_code'];
	// 			$ilosc_sm = (int)$this->conf_sms['pakiet_2']['sm_number'];
	// 		}
	// 		elseif(($smnumb == $this->conf_sms['pakiet_3']['sm_number']) && ($code_inp == $this->conf_sms['pakiet_3']['sms_code']))
	// 		{
	// 			$code = $this->conf_sms['pakiet_3']['sms_code'];
	// 			$ilosc_sm = (int)$this->conf_sms['pakiet_3']['sm_number'];
	// 		}
	// 		elseif(($smnumb == $this->conf_sms['pakiet_4']['sm_number']) && ($code_inp == $this->conf_sms['pakiet_4']['sms_code']))
	// 		{
	// 			$code = $this->conf_sms['pakiet_4']['sms_code'];
	// 			$ilosc_sm = (int)$this->conf_sms['pakiet_4']['sm_number'];
	// 		}
	// 		elseif(($smnumb == $this->conf_call['sm_number']) && ($code_inp == $this->conf_call['call_code']))
	// 		{
	// 			$code = $this->conf_call['call_code'];
	// 			$ilosc_sm = (int)$this->conf_call['sm_number'];
	// 		}
	// 		else
	// 		{
	// 			redirect(site_url());
	// 		}

	// 		# przy sprawdzaniu kilku kont o różnych identyfikatorach należy użyć zapisu:
	// 		# $code = "abcd1,abcd2,kody2,kody6";

	// 		//przelewy za pomocą linków generowanych 

	// 		$type = 'sms'; //c1 - 8 znakowy kod bezobslugowy #sms

	// 		$del = 1; //1 - automatycznie usuwany 0 - nie usuwany
			
	// 		$user_id = 740555; # numer ID zarejestrowanego klienta

	// 		$handle = fopen("http://dotpay.pl/check_code.php?&check=".$check."&id=".$user_id."&code=".$code."&type=".$type."&del=".$del, 'r');
	// 	    $status = fgets($handle, 8);
	// 	    fclose($handle);

	// 	    //zwrócić usługe i dodać odpowiednią liczbe sm


	// 	    //http://dotpay.pl/check_code.php?id=XXXXX&code=YYYYY&type=c1&del=0&check=test1234
	// 	    //lub
	// 	    //http://dotpay.pl/check_code_fullinfo.php?id=XXXXX&code=YYYYY&type=c1&del=0&check=test1234
	// 	    //gdzie:XXXXX - ID konta w systemie Dotpay,
	// 	    //YYYYY - identyfikator usługi SMS (np. dla usługi AP.KODY identyfikator to KODY), 
	// 	    //test1234 - testowany kod (dodany wcześniej do listy kodów).
	// 	    //Wyświetlona zostanie odpowiedź zbliżona do poniższej:
	// 	    // 1
	// 	    // 172801
	// 	    // YYYY
	// 	    // 2.00

	// 	    //pierwsza   cyfra   oznacza   kod   poprawny   (1)   lub   niepoprawny   (0),   druga   wartość   to   ważność   kodu(w sekundach) wyświetlony zostaje także identyfikator usługi. Dla interfejsu  check_code_fullinfo.php  w kolejnej liniizwracany jest koszt netto dla transakcji dla której wydano kod


	// 	    if($status == 0)
	// 	    {
	// 	    	$this->data['sub_view'] = 'shop/bad_key';
	// 			$this->data['subview'] = 'shop/index';
	// 			$this->load->view('front_layout',$this->data);
	// 	    }
	// 	    else
	// 	    {
	// 	    	if($this->front_shop_m->add_coins($this->session->userdata('login'),$ilosc_sm) === true)
	// 			{
	// 				$this->shop_logs_m->log_buy_coins($this->input->post('code'));
	// 				$this->data['sub_view'] = 'shop/add_succ';
	// 				$this->data['subview'] = 'shop/index';
	// 				$this->load->view('front_layout',$this->data);
	// 			}
	// 			else
	// 			{
	// 				$this->data['sub_view'] = 'shop/add_fail';
	// 				$this->data['subview'] = 'shop/index';
	// 				$this->load->view('front_layout',$this->data);
	// 			}
	// 	    } 
	// 	}
	// 	else
	// 	{
	// 		redirect(site_url('shop'));
	// 	}
	// }		
			


	// 		// $res = $this->front_shop_m->checkCode($this->input->post('code'));
	// 		// if($res == false)
	// 		// {
	// 		// 	$this->data['sub_view'] = 'shop/bad_key';
	// 		// 	$this->data['subview'] = 'shop/index';
	// 		// 	$this->load->view('front_layout',$this->data);
	// 		// }
	// 		// else
	// 		// {
	// 		// 	//zmien status kodu
	// 		// 	if($this->front_shop_m->change_code_status($this->input->post('code')) === true)
	// 		// 	{
	// 		// 		//dodaj sm
	// 		// 		if($this->front_shop_m->add_coins($this->session->userdata('login'),1000) === true)
	// 		// 		{
	// 		// 			$this->shop_logs_m->log_buy_coins($this->input->post('code'));
	// 		// 			$this->data['sub_view'] = 'shop/add_succ';
	// 		// 			$this->data['subview'] = 'shop/index';
	// 		// 			$this->load->view('front_layout',$this->data);
	// 		// 		}
	// 		// 		else
	// 		// 		{
	// 		// 			$this->data['sub_view'] = 'shop/add_fail';
	// 		// 			$this->data['subview'] = 'shop/index';
	// 		// 			$this->load->view('front_layout',$this->data);
	// 		// 		}
	// 		// 	}
	// 		// 	else
	// 		// 	{
	// 		// 		redirect(site_url());
	// 		// 	}
				
	// 		// }	
	// 	}
	// 	else
	// 	{
	// 		$this->data['sub_view'] = 'shop/bad_key';
	// 		$this->data['subview'] = 'shop/index';
	// 		$this->load->view('front_layout',$this->data);
	// 	}
	// }

	// public function add_coins()
	// {
	// 	//fetch validate rules
	// 	$rules = $this->front_shop_m->rules;
	// 	$this->form_validation->set_rules($rules);

	// 	if($this->form_validation->run() === true)
	// 	{

	// 		$check = $this->input->post('code');
	// 		$usluga = $this->input->post('usluga');

	// 		$page = site_url('shop');

	// 		$res = $this->front_shop_m->checkCode($this->input->post('code'));
	// 		if($res == false)
	// 		{
	// 			$this->data['sub_view'] = 'shop/bad_key';
	// 			$this->data['subview'] = 'shop/index';
	// 			$this->load->view('front_layout',$this->data);
	// 		}
	// 		else
	// 		{
	// 			//zmien status kodu
	// 			if($this->front_shop_m->change_code_status($this->input->post('code')) === true)
	// 			{
	// 				//dodaj sm
	// 				if($this->front_shop_m->add_coins($this->session->userdata('login'),1000) === true)
	// 				{
	// 					$this->shop_logs_m->log_buy_coins($this->input->post('code'));
	// 					$this->data['sub_view'] = 'shop/add_succ';
	// 					$this->data['subview'] = 'shop/index';
	// 					$this->load->view('front_layout',$this->data);
	// 				}
	// 				else
	// 				{
	// 					$this->data['sub_view'] = 'shop/add_fail';
	// 					$this->data['subview'] = 'shop/index';
	// 					$this->load->view('front_layout',$this->data);
	// 				}
	// 			}
	// 			else
	// 			{
	// 				redirect(site_url());
	// 			}
				
	// 		}	
	// 	}
	// 	else
	// 	{
	// 		$this->data['sub_view'] = 'shop/bad_key';
	// 		$this->data['subview'] = 'shop/index';
	// 		$this->load->view('front_layout',$this->data);
	// 	}
	// }

	public function vip_exp()
	{
		$this->data['vip_exp'] = $this->front_shop_m->get_vip_exp();
		$this->data['sub_view'] = 'shop/vip_exp';
		$this->data['subview'] = 'shop/index';
		$this->load->view('front_layout',$this->data);
	}

	public function vip_drop()
	{
		$this->data['vip_drop'] = $this->front_shop_m->get_vip_drop();
		$this->data['sub_view'] = 'shop/vip_drop';
		$this->data['subview'] = 'shop/index';
		$this->load->view('front_layout',$this->data);
	}

	public function vip_money()
	{
		$this->data['vip_money'] = $this->front_shop_m->get_vip_money();
		$this->data['sub_view'] = 'shop/vip_money';
		$this->data['subview'] = 'shop/index';
		$this->load->view('front_layout',$this->data);
	}

	public function buy_vip_exp($id)
	{
		if((!$id) || ($id == 0) || ($id == ''))
		{
			redirect(site_url());
		}

		if($this->front_shop_m->is_exp_cat($id) == false)
		{
			redirect(site_url());
		}

		$data['vip_exp'] = $this->front_shop_m->get_exp_price($id);
		//sprawdzenie cash
		if($this->data['user_data'][0]->cash >= $data['vip_exp']->cash)
		{
			//odjecie monet
			if($this->front_shop_m->substract_cash($this->data['user_data'][0]->id,$data['vip_exp']->cash) === true)
			{
				//dodanie czasu do expa
				if($this->front_shop_m->add_exp_time($this->data['user_data'][0]->id, $data['vip_exp']->days, $this->data['user_data'][0]->silver_expire) === true)
				{
					//log
					$this->shop_logs_m->log_buy_exp($this->data['user_data'][0]->id, $data['vip_exp']->days, $data['vip_exp']->category);
					
					$this->data['sub_view'] = 'shop/add_succ';
					$this->data['subview'] = 'shop/index';
					$this->load->view('front_layout',$this->data);
				}
				else
				{
					$this->data['sub_view'] = 'shop/add_fail';
					$this->data['subview'] = 'shop/index';
					$this->load->view('front_layout',$this->data);
				}
			}
			else
			{
				$this->data['sub_view'] = 'shop/add_fail';
				$this->data['subview'] = 'shop/index';
				$this->load->view('front_layout',$this->data);
			}
		}
		else
		{
			$this->data['sub_view'] = 'shop/add_fail';
			$this->data['subview'] = 'shop/index';
			$this->load->view('front_layout',$this->data);
		}
	}

	public function buy_vip_drop($id)
	{
		if((!$id) || ($id == 0) || ($id == ''))
		{
			redirect(site_url());
		}

		if($this->front_shop_m->is_drop_cat($id) == false)
		{
			redirect(site_url());
		}

		$data['vip_drop'] = $this->front_shop_m->get_drop_price($id);
		//sprawdzenie cash
		if($this->data['user_data'][0]->cash >= $data['vip_drop']->cash)
		{
			//odjecie monet
			if($this->front_shop_m->substract_cash($this->data['user_data'][0]->id,$data['vip_drop']->cash) === true)
			{
				//dodanie czasu do expa
				if($this->front_shop_m->add_drop_time($this->data['user_data'][0]->id, $data['vip_drop']->days, $this->data['user_data'][0]->gold_expire) === true)
				{
					//log
					$this->shop_logs_m->log_buy_exp($this->data['user_data'][0]->id, $data['vip_drop']->days, $data['vip_drop']->category);
					
					$this->data['sub_view'] = 'shop/add_succ';
					$this->data['subview'] = 'shop/index';
					$this->load->view('front_layout',$this->data);
				}
				else
				{
					$this->data['sub_view'] = 'shop/add_fail';
					$this->data['subview'] = 'shop/index';
					$this->load->view('front_layout',$this->data);
				}
			}
			else
			{
				$this->data['sub_view'] = 'shop/add_fail';
				$this->data['subview'] = 'shop/index';
				$this->load->view('front_layout',$this->data);
			}
		}
		else
		{
			$this->data['sub_view'] = 'shop/add_fail';
			$this->data['subview'] = 'shop/index';
			$this->load->view('front_layout',$this->data);
		}
	}

	public function buy_vip_money($id)
	{
		//validate param
		if((!$id) || ($id == 0) || ($id == ''))
		{
			redirect(site_url());
		}

		//validate are param is category
		if($this->front_shop_m->is_money_cat($id) == false)
		{
			redirect(site_url());
		}


		$data['vip_money'] = $this->front_shop_m->get_money_price($id);
		//sprawdzenie cash
		if($this->data['user_data'][0]->cash >= $data['vip_money']->cash)
		{
			//odjecie monet
			if($this->front_shop_m->substract_cash($this->data['user_data'][0]->id,$data['vip_money']->cash) === true)
			{
				//dodanie czasu do expa
				if($this->front_shop_m->add_money_time($this->data['user_data'][0]->id, $data['vip_money']->days, $this->data['user_data'][0]->money_drop_rate_expire) === true)
				{
					//log
					$this->shop_logs_m->log_buy_money($this->data['user_data'][0]->id, $data['vip_money']->days, $data['vip_money']->category);
					
					$this->data['sub_view'] = 'shop/add_succ';
					$this->data['subview'] = 'shop/index';
					$this->load->view('front_layout',$this->data);
				}
				else
				{
					$this->data['sub_view'] = 'shop/add_fail';
					$this->data['subview'] = 'shop/index';
					$this->load->view('front_layout',$this->data);
				}
			}
			else
			{
				$this->data['sub_view'] = 'shop/add_fail';
					$this->data['subview'] = 'shop/index';
					$this->load->view('front_layout',$this->data);
			}
		}
		else
		{
			$this->data['sub_view'] = 'shop/add_fail';
			$this->data['subview'] = 'shop/index';
			$this->load->view('front_layout',$this->data);
		}
	}
}

/* End of file shop.php */
/* Location: ./application/controllers/shop.php */