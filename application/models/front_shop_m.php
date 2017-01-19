<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front_shop_m extends MY_Model {

	public $rules = array(
		'code' => array(
			'field' => 'code',
			'label' => 'Kod',
			'rules' => 'trim|xss_clean|required|min_length[8]|max_length[8]|alpha_numeric'
		),
		'smnum' => array(
			'field' => 'smnum',
			'label' => 'Ilość sm',
			'rules' => 'trim|xss_clean|required|integer'
		),
		'pack' => array(
			'field' => 'pack',
			'label' => 'Pakiet',
			'rules' => 'trim|xss_clean|required'
		),
	);

	public function __construct()
	{
		parent::__construct();
	}

	public function get_shop_status()
	{
		$query = $this->db->query("SELECT shop_status FROM cmsconfig");
		return $query->row('shop_status');
	}

	public function get_user_data($login)
	{
		$query = $this->db->query("SELECT * FROM account WHERE login='$login'");
		return $query->row();
	}

	public function get_shop_category()
	{
		$query = $this->db->query("SELECT * FROM shop_category");
		return $query->result();
	}

	public function get_items_to_category($id)
	{
		$query = $this->db->query("SELECT * FROM shop_items WHERE category_id='$id'");
		return $query->result();
	}

	public function is_category($id)
	{
		$query = $this->db->query("SELECT * FROM shop_category WHERE id='$id'");
		if($query->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function is_item($id)
	{
		$query = $this->db->query("SELECT * FROM shop_items WHERE id='$id'");
		if($query->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function get_item_price($id)
	{
		$query = $this->db->query("SELECT * FROM shop_items WHERE id='$id'");
		return $query->row();
	}

	public function substract_cash($id,$price)
	{
		$this->db->query("UPDATE account SET cash=cash-'$price' WHERE id='$id'");
		if($this->db->affected_rows() === 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function get_user_mall($id)
	{
		$query = $this->db->query("SELECT pos,vnum FROM item WHERE owner_id='$id' AND window='MALL' ORDER BY pos ASC");
		return $query->result();
	}

	public function get_item_proto_shop($vnum)
	{
		$query = $this->db->query("SELECT * FROM item_proto WHERE vnum='$vnum' LIMIT 1");
		if($query->num_rows === 1)
		{
			return $query->result();
		}
		else
			return 'Brak przedmiotu';
	}

	public function count_mall($id)
	{
		$query = $this->db->query("SELECT count(ID) FROM item WHERE owner_id = '$id' ");
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function get_position($id)
	{
		$query = $this->db->query("SELECT pos FROM item WHERE owner_id='$id' AND window='MALL' order by pos asc");
		return $query->result();
	}

	public function add_item($id, $vnum, $pos, $count)
	{
		$this->db->query("INSERT INTO item SET vnum = '$vnum', owner_id = '$id', window = 'MALL', pos = '$pos', count = '$count', socket0 = '1', socket1 = '1', socket2 = '1'");
		if($this->db->affected_rows() === 1)
		{
			return true;
		}
		else
			return false;
	}

	public function checkPos($id, $size)
	{
		$query = $this->db->query("SELECT pos,vnum FROM item WHERE owner_id='$id' AND window='MALL'");

		$islPos = array();
		foreach($query->result() as $row)
		{
			$maxGr = $size;
			$aktPos = $row->pos;
			for($i= 1; $i<=$maxGr; $i++)
			{
				$islPos[$aktPos] = $row->vnum;
				$aktPos = $aktPos + 5;
			}
		}
		$returnArray['islager'] = $islPos;
		return $returnArray;
	}

	public function findPos($belegtePos, $size)
	{
		$possPos = array();

		for($i=0; $i<45; $i++)
		{
			if(empty($belegtePos[$i]))
			{
				for($y=0; $y<$size; $y++)
				{
					$aktPos = $i + ($y*5);
					$thisFits = true;
					if(!isset($belegtePos[$aktPos]) && $aktPos<45)
					{
						$thisFits = true;
					}
					else
					{
						$thisFits = false;
						break;
					}
				}
				if($thisFits)
				{
					$possPos[] = $i;
				}
			}
		}
		return $possPos;
	}

	public function checkCode($code)
	{
		$query = $this->db->query("SELECT * FROM codes WHERE code='$code' AND status='active' LIMIT 1");
		if($query->num_rows() == 0)
		{
			return false;
		}
		elseif($query->num_rows() == 1)
		{
			return $query->row();
		}
	}

	public function change_code_status($code)
	{
		$query = $this->db->query("UPDATE codes SET status = 'inactive' WHERE code = '$code'");
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
			return false;
	}

	public function add_coins($login, $val)
	{
		$query = $this->db->query("UPDATE account SET cash=cash+'$val' WHERE login='$login'");
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
			return false;
	}

	public function get_vip_exp()
	{
		$query = $this->db->query("SELECT * FROM is_vip WHERE category = 'exp'");
		return $query->result();
	}

	public function get_vip_drop()
	{
		$query = $this->db->query("SELECT * FROM is_vip WHERE category = 'drop'");
		return $query->result();
	}

	public function get_vip_money()
	{
		$query = $this->db->query("SELECT * FROM is_vip WHERE category = 'money'");
		return $query->result();
	}

	public function is_exp_cat($id)
	{
		$query = $this->db->query("SELECT category FROM is_vip WHERE id='$id'");
		if($query->row('category') == 'exp')
		{
			return true;
		}
		else
			return false;
	}

	public function is_drop_cat($id)
	{
		$query = $this->db->query("SELECT category FROM is_vip WHERE id='$id'");
		if($query->row('category') == 'drop')
		{
			return true;
		}
		else
			return false;
	}

	public function is_money_cat($id)
	{
		$query = $this->db->query("SELECT category FROM is_vip WHERE id='$id'");
		if($query->row('category') == 'money')
		{
			return true;
		}
		else
			return false;
	}

	public function get_exp_price($id)
	{
		$query = $this->db->query("SELECT * FROM is_vip WHERE id='$id' LIMIT 1");
		return $query->row();
	}

	public function get_drop_price($id)
	{
		$query = $this->db->query("SELECT * FROM is_vip WHERE id='$id' LIMIT 1");
		return $query->row();
	}

	public function get_money_price($id)
	{
		$query = $this->db->query("SELECT * FROM is_vip WHERE id='$id' LIMIT 1");
		return $query->row();
	}

	public function add_exp_time($id, $days, $user_exp)
	{
		$now = date('Y-m-d H:i:s');
		if($user_exp > $now)
		{
			//$new_exp = date($user_exp, strtotime('$user_exp + $days day'));
			$new_exp_time = strtotime("+ " . $days . " day", strtotime($user_exp));
		}
		elseif($user_exp < $now)
		{
			//$new_exp = date($now, strtotime('$now + $days day'));
			$new_exp_time = strtotime("+ " . $days . " day", strtotime($now));
		}
		$new_exp = date('Y-m-d H:i:s', $new_exp_time);

		$this->db->query("UPDATE account SET silver_expire='$new_exp' WHERE id='$id'");
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
			return false;
	}

	public function add_drop_time($id, $days, $user_drop)
	{
		$now = date('Y-m-d H:i:s');
		if($user_drop > $now)
		{
			//$new_exp = date($user_exp, strtotime('$user_exp + $days day'));
			$new_drop_time = strtotime("+ " . $days . " day", strtotime($user_drop));
		}
		elseif($user_drop < $now)
		{
			//$new_exp = date($now, strtotime('$now + $days day'));
			$new_drop_time = strtotime("+ " . $days . " day", strtotime($now));
		}
		$new_drop = date('Y-m-d H:i:s', $new_drop_time);

		$this->db->query("UPDATE account SET gold_expire='$new_drop' WHERE id='$id'");
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
			return false;
	}

	public function add_money_time($id, $days, $user_money)
	{
		$now = date('Y-m-d H:i:s');
		if($user_money > $now)
		{
			//$new_exp = date($user_exp, strtotime('$user_exp + $days day'));
			$new_money_time = strtotime("+ " . $days . " day", strtotime($user_money));
		}
		elseif($user_money < $now)
		{
			//$new_exp = date($now, strtotime('$now + $days day'));
			$new_money_time = strtotime("+ " . $days . " day", strtotime($now));
		}
		$new_money = date('Y-m-d H:i:s', $new_money_time);

		$this->db->query("UPDATE account SET money_drop_rate_expire='$new_money' WHERE id='$id'");
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
			return false;
	}

}

/* End of file front_shop_m.php */
/* Location: ./application/models/front_shop_m.php */