<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guru_Model extends CI_Model {

	var $table = 'tbl_guru';
	var $column_order = array('guru_id','guru_nip','guru_nama','guru_jenis_kelamin','jabatan_nama','golongan_nama','mata_pelajaran_nama','guru_alamat','guru_telepon','guru_no_hp','guru_keterangan',null); //set column field database for datatable orderable
	var $column_search = array('guru_nip','guru_nama','guru_jenis_kelamin','jabatan_nama','golongan_nama','mata_pelajaran_nama','guru_alamat','guru_telepon','guru_no_hp','guru_keterangan'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('guru_id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
		$this->db->join('tbl_jabatan', 'tbl_guru.guru_jabatan_id=tbl_jabatan.jabatan_id', 'left');
		$this->db->join('tbl_mata_pelajaran', 'tbl_guru.guru_mata_pelajaran_id=tbl_mata_pelajaran.mata_pelajaran_id', 'left');
		$this->db->join('tbl_golongan', 'tbl_guru.guru_golongan_id=tbl_golongan.golongan_id', 'left');

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

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
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
