<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop_m extends MY_Model {

	public $rules_category= array(
		'category' => array(
			'field' => 'category', 
			'label' => 'Nazwa kategorii',
			'rules' => 'trim|xss_clean|required|callback__category_check|min_length[3]|max_length[100]'
		),
	);

	public $items_rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'Nazwa przedmiotu',
			'rules' => 'trim|xss_clean|required|min_length[3]|max_length[100]'
		),
		'vnum' => array(
			'field' => 'vnum', 
			'label' => 'Id przedmiotu',
			'rules' => 'trim|xss_clean|required|integer'
		),
		'stack' => array(
			'field' => 'stack', 
			'label' => 'Ilość przedmiotu',
			'rules' => 'trim|xss_clean|required|integer'
		),
		'price' => array(
			'field' => 'price', 
			'label' => 'Cena przedmiotu',
			'rules' => 'trim|xss_clean|required|integer'
		),
		'describe' => array(
			'field' => 'describe', 
			'label' => 'Opis przedmiotu',
			'rules' => 'trim|xss_clean'
		),
		'category_id' => array(
			'field' => 'Kategoria przedmiotu', 
			'label' => 'Nazwa kategorii',
			'rules' => 'trim|xss_clean'
		),
	);

	public $vip_rules= array(
		'days' => array(
			'field' => 'days', 
			'label' => 'Dni',
			'rules' => 'trim|xss_clean|required|min_length[1]|max_length[3]|integer'
		),
		'cash' => array(
			'field' => 'cash', 
			'label' => 'Cena',
			'rules' => 'trim|xss_clean|required|min_length[1]|integer'
		),
		'category' => array(
			'field' => 'category', 
			'label' => 'Kategoria',
			'rules' => 'trim|xss_clean|required'
		),
	);

	public function __construct()
	{
		parent::__construct();	
	}

	public function count_shop_items()
	{
		$query = $this->db->query("SELECT count(*) as ilosc from shop_items");
		return (int) $query->row('ilosc');
	}

	public function get_shop_items($perpage, $offset)
	{
		if($offset > 0)
		{
			$query = $this->db->query("SELECT * FROM shop_items LIMIT $perpage, $offset ");
			return $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT * FROM shop_items LIMIT $perpage ");
			return $query->result();
		}
	}

	public function get_category($id)
	{
		$query = $this->db->query("SELECT category FROM shop_category WHERE id='$id'");
		return $query->row('category');
	}

	public function edit_category($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('shop_category', $data);
	}

	public function add_category($data)
	{
		$this->db->insert('shop_category', $data);
	}

	public function get_shop_item($id)
	{
		$query = $this->db->query("SELECT * FROM shop_items WHERE id='$id'");
		return $query->result();
	}

	public function get_vips()
	{
		$query = $this->db->query("SELECT * FROM is_vip");
		return $query->result();
	}

	public function get_shop_vip($id)
	{
		$query = $this->db->query("SELECT * FROM is_vip WHERE id='$id'");
		return $query->row();
	}

	public function get_new_is()
	{
		$item[0] = new stdClass();
		$item[0]->name = '';
		$item[0]->stack = 0;
		$item[0]->price = 0;
		$item[0]->describe = '';
		$item[0]->logo = 'unknown.png';
		$item[0]->category_id = 0;
		$item[0]->vnum = '';
		return $item;
	}

	public function get_new_vip()
	{
		$vip = new stdClass();
		$vip->days = 0;
		$vip->cash = 0;
		return $vip;
	}

	public function check_category($str)
	{
		$query = $this->db->query("SELECT * FROM shop_category WHERE category='$str'");
		if($query->num_rows() > 0)
		{
			return false;
		}
		elseif($query->num_rows() === 0)
		{
			return true;
		}
	}

	public function get_category_to_dropdown()
	{
		$query = $this->db->query("SELECT id,category FROM shop_category");
		$array = array(
			'0' => 'Brak'
		);
		if(count($query->result()))
		{
			foreach ($query->result() as $row) {
				$array[$row->id] = $row->category;
			}
		}
		return $array;
	}

	public function update_item($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('shop_items', $data);
	}

	public function add_new_item($data)
	{
		$this->db->insert('shop_items', $data);
	}

	public function delete_item($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('shop_items');
	}

	public function delete_category($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('shop_category');
	}

	public function save_vip($id)
	{
		$data = $this->array_from_post(array(
			'days',
			'cash',
			'category'
		));

		$this->db->where('id',$id);
		$this->db->update('is_vip', $data);
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
			return false;
	}

	public function save_new_vip()
	{
		$data = $this->array_from_post(array(
			'days',
			'cash',
			'category'
		));
		$this->db->insert('is_vip', $data);
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
			return false;
	}

	public function vip_delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('is_vip');
		if($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
			return false;
	}
}

/* End of file shop_m.php */
/* Location: ./application/models/shop_m.php */