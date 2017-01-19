<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bonus_item_m extends MY_Model {

	public $rules = array(
		'bonus_prob' => array(
			'field' => 'bonus_prob',
			'label' => 'Szansa na wejście bonusu',
			'rules' => 'trim|xss_clean|required|greater_than[0]|less_than[100]|integer'
		),
		'bonus_lv1' => array(
			'field' => 'bonus_lv1',
			'label' => 'Wartość 1',
			'rules' => 'trim|xss_clean|required|integer|less_than[32000]|greater_than[-32000]'
		),
		'bonus_lv2' => array(
			'field' => 'bonus_lv2',
			'label' => 'Wartość 2',
			'rules' => 'trim|xss_clean|required|integer|less_than[32000]|greater_than[-32000]'
		),
		'bonus_lv3' => array(
			'field' => 'bonus_lv3',
			'label' => 'Wartość 3',
			'rules' => 'trim|xss_clean|required|integer|less_than[32000]|greater_than[-32000]'
		),
		'bonus_lv4' => array(
			'field' => 'bonus_lv4',
			'label' => 'Wartość 4',
			'rules' => 'trim|xss_clean|required|integer|less_than[32000]|greater_than[-32000]'
		),
		'bonus_lv5' => array(
			'field' => 'bonus_lv5',
			'label' => 'Wartość 5',
			'rules' => 'trim|xss_clean|required|integer|less_than[32000]|greater_than[-32000]'
		),
		'bonus_weapon' => array(
			'field' => 'bonus_weapon',
			'label' => 'Broń',
			'rules' => 'trim|xss_clean|integer|less_than[6]'
		),
		'bonus_body' => array(
			'field' => 'bonus_body',
			'label' => 'Zbroja',
			'rules' => 'trim|xss_clean|integer|less_than[6]'
		),
		'bonus_wrist' => array(
			'field' => 'bonus_wrist',
			'label' => 'Branzoleta',
			'rules' => 'trim|xss_clean|integer|less_than[6]'
		),
		'bonus_foots' => array(
			'field' => 'bonus_foots',
			'label' => 'Buty',
			'rules' => 'trim|xss_clean|integer|less_than[6]'
		),
		'bonus_neck' => array(
			'field' => 'bonus_neck',
			'label' => 'Naszyjnik',
			'rules' => 'trim|xss_clean|integer|less_than[6]'
		),
		'bonus_head' => array(
			'field' => 'bonus_head',
			'label' => 'Hełm',
			'rules' => 'trim|xss_clean|integer|less_than[6]'
		),
		'bonus_shield' => array(
			'field' => 'bonus_shield',
			'label' => 'Tarcza',
			'rules' => 'trim|xss_clean|integer|less_than[6]'
		),
		'bonus_ear' => array(
			'field' => 'bonus_ear',
			'label' => 'Kolczyki',
			'rules' => 'trim|xss_clean|integer|less_than[6]'
		),
	);

	public function __construct()
	{
		parent::__construct();
	}

	public function get_index_bonus()
	{
		$query = $this->db->query("SELECT * FROM item_attr INNER JOIN item_bonus ON item_attr.apply = item_bonus.attr_name");

		return $query->result();
	}

	public function get_bonus($id)
	{
		$query = $this->db->query("SELECT * FROM item_attr INNER JOIN item_bonus ON item_attr.apply = item_bonus.attr_name WHERE item_bonus.id = '$id'");

		return $query->row();
	}

	public function save_bonus($id)
	{
		$bonus = $this->get_bonus($id);

		if($bonus->id == 43 || $bonus->id == 44)
		{
			$vlv1 = 1;
			$vlv2 = 1;
			$vlv3 = 1;
			$vlv4 = 1;
			$vlv5 = 1;
		}
		else
		{
			$vlv1 = $this->input->post('bonus_lv1');
			$vlv2 = $this->input->post('bonus_lv2');
			$vlv3 = $this->input->post('bonus_lv3');
			$vlv4 = $this->input->post('bonus_lv4');
			$vlv5 = $this->input->post('bonus_lv5');
		}

		if($this->input->post('bonus_weapon') > 0)
		{
			if($bonus->id == 43 || $bonus->id == 44)
			{
				$weap = 1;
			}
			else
			{
				$weap = 5;
			}
			
		}
		elseif($this->input->post('bonus_weapon') == 0)
		{
			$weap = 0;
		}

		if($this->input->post('bonus_body') > 0)
		{
			if($bonus->id == 43 || $bonus->id == 44)
			{
				$body = 1;
			}
			else
			{
				$body = 5;
			}
			
		}
		elseif($this->input->post('bonus_body') == 0)
		{
			$body = 0;
		}

		if($this->input->post('bonus_wrist') > 0)
		{
			if($bonus->id == 43 || $bonus->id == 44)
			{
				$wrist = 1;
			}
			else
			{
				$wrist = 5;
			}
			
		}
		elseif($this->input->post('bonus_wrist') == 0)
		{
			$wrist = 0;
		}

		if($this->input->post('bonus_foots') > 0)
		{
			if($bonus->id == 43 || $bonus->id == 44)
			{
				$foots = 1;
			}
			else
			{
				$foots = 5;
			}
			
		}
		elseif($this->input->post('bonus_foots') == 0)
		{
			$foots = 0;
		}

		if($this->input->post('bonus_neck') > 0)
		{
			if($bonus->id == 43 || $bonus->id == 44)
			{
				$neck = 1;
			}
			else
			{
				$neck = 5;
			}
			
		}
		elseif($this->input->post('bonus_neck') == 0)
		{
			$neck = 0;
		}

		if($this->input->post('bonus_head') > 0)
		{
			if($bonus->id == 43 || $bonus->id == 44)
			{
				$head = 1;
			}
			else
			{
				$head = 5;
			}
			
		}
		elseif($this->input->post('bonus_head') == 0)
		{
			$head = 0;
		}

		if($this->input->post('bonus_shield') > 0)
		{
			if($bonus->id == 43 || $bonus->id == 44)
			{
				$shield = 1;
			}
			else
			{
				$shield = 5;
			}
			
		}
		elseif($this->input->post('bonus_shield') == 0)
		{
			$shield = 0;
		}

		if($this->input->post('bonus_ear') > 0)
		{
			if($bonus->id == 43 || $bonus->id == 44)
			{
				$ear = 1;
			}
			else
			{
				$ear = 5;
			}
			
		}
		elseif($this->input->post('bonus_ear') == 0)
		{
			$ear = 0;
		}

		

		$data = array(
			'prob' => $this->input->post('bonus_prob'),
			'lv1' => $vlv1,
			'lv2' => $vlv2,
			'lv3' => $vlv3,
			'lv4' => $vlv4,
			'lv5' => $vlv5,
			'weapon' => $weap,
			'body' => $body,
			'wrist' => $wrist,
			'foots' => $foots,
			'neck' => $neck,
			'head' => $head,
			'shield' => $shield,
			'ear' => $ear,
		);

		$this->db->where('apply', $bonus->apply);
		$this->db->update('item_attr', $data);

		if($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
			return false;
	}

}

/* End of file bonus_item_m.php */
/* Location: ./application/models/bonus_item_m.php */