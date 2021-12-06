<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model {

	var $table = 'cpns_user';
	var $column_order = array('user_id','user_nama','user_email','user_username','user_no_hp','user_tgl_lahir','user_asal_sekolah','user_kelas','user_alamat','user_ind','user_status',null); //set column field database for datatable orderable
	var $column_search = array('user_nama','user_email','user_username','user_no_hp','user_tgl_lahir','user_asal_sekolah','user_kelas','user_alamat','user_ind','user_status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('user_id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($ind)
	{
		
		$this->db->from($this->table);
		if($ind == 'A')
		{
			$this->db->where('user_akses', 'A');
		} else if($ind == 'S')
		{
			$this->db->where('user_akses', 'S');
		} else if($ind == 'G')
		{
			$this->db->where('user_akses', 'G');
		}
		
		
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{ 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables($ind)
	{
		$this->_get_datatables_query($ind);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($ind)
	{
		$this->_get_datatables_query($ind);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($ind)
	{
		$this->db->from($this->table);
		if($ind == 'A')
		{
			$this->db->where('user_akses', 'A');
		} else if($ind == 'S')
		{
			$this->db->where('user_akses', 'S');
		} else if($ind == 'G')
		{
			$this->db->where('user_akses', 'G');
		}
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('guru_id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('guru_id', $id);
		$this->db->delete($this->table);
	}

}
