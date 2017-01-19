<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop_api extends Frontend_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function api_dotpay()
	{
		//fetch validate rules
		$rules = $this->front_shop_m->rules;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == true)
		{
			$check = $this->input->post('code');

			$pack = $this->input->post('pack');

			$id  = 10; # numer ID zarejestrowanego klienta
			$code = $this->conf_sms[$pack]['sms_code'];

			$type = "sms"; # typ konta: C1 - 8 znakowy kod bezobsługowy
		       		 	   # typ konta: sms dla sprawdzania SMSow
			#
			# gdy sprawdzane będą zarówno konta smsowe jak i konta przy płatnościach kartą
			# to należy wtedy użyć zapisu:
			# $type = "c1,sms";
			#
			#
			# przy sprawdzaniu kilku kont o różnych identyfikatorach należy użyć zapisu:
			# $code = "abcd1,abcd2,kody2,kody6"; 
			# $check = "xxxxxxxx"; # podany kod na stronie gdzie wejście jest płatne i wymagany jest zakupiony kod

			$del=1;                # jezeli kod ma byc jednorazowy to ustaw wartosc na 1;


			#############################################################################################################################

			 $array = array();
		       $array['check']= $check;
			   $array['code'] = $code;
		       $array['id']   = $id;
		       $array['type'] = $type;
		       $array['del']  = $del;

		       $ch = curl_init ();
		       curl_setopt ($ch, CURLOPT_URL, "https://ssl.dotpay.pl/check_code_fullinfo.php");
		       curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 2);
		       curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		       curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		       curl_setopt ($ch, CURLOPT_TIMEOUT, 100);
		       curl_setopt ($ch, CURLOPT_POST, 1);
		       curl_setopt ($ch, CURLOPT_POSTFIELDS, $array);
		       $recv = curl_exec ($ch);
		       curl_close ($ch);

		       $dane = explode("\n", $recv);
		       $status = $dane[0];
		       $usluga = $dane[2]; //kod uslugi
		       $amount = intval($dane[3]); //koszt w groszach netto 

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
		    		if($amount == $this->conf_sms['pakiet_1']->gr_val)
			    	{
			    		$ilosc_sm = $this->conf_sms['pakiet_1']->sm_number;
			    	}
			    	elseif($amount == $this->conf_sms['pakiet_2']->gr_val)
			    	{
			    		$ilosc_sm = $this->conf_sms['pakiet_2']->sm_number;
			    	}
			    	elseif($amount == $this->conf_sms['pakiet_3']->gr_val)
			    	{
			    		$ilosc_sm = $this->conf_sms['pakiet_3']->sm_number;
			    	}
			    	elseif($amount == $this->conf_sms['pakiet_4']->gr_val)
			    	{
			    		$ilosc_sm = $this->conf_sms['pakiet_4']->sm_number;
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

	public function api_homepay()
	{

	}

	public function api_platnosci()
	{
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
		    		if($amount == $this->conf_sms['pakiet_1']->gr_val)
			    	{
			    		$ilosc_sm = $this->conf_sms['pakiet_1']->sm_number;
			    	}
			    	elseif($amount == $this->conf_sms['pakiet_2']->gr_val)
			    	{
			    		$ilosc_sm = $this->conf_sms['pakiet_2']->sm_number;
			    	}
			    	elseif($amount == $this->conf_sms['pakiet_3']->gr_val)
			    	{
			    		$ilosc_sm = $this->conf_sms['pakiet_3']->sm_number;
			    	}
			    	elseif($amount == $this->conf_sms['pakiet_4']->gr_val)
			    	{
			    		$ilosc_sm = $this->conf_sms['pakiet_4']->sm_number;
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

}

/* End of file shop_api.php */
/* Location: ./application/controllers/shop_api.php */