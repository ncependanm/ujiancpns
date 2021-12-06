<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soal_Model extends CI_Model {

	var $table = 'cpns_soal';
	var $column_order = array('soal_id','soal_sesi','soal_pertanyaan','soal_jawaban_a','soal_jawaban_b','soal_jawaban_c','soal_jawaban_d','soal_jawaban_e','soal_kunci_jawaban',null); //set column field database for datatable orderable
	var $column_search = array('soal_sesi','soal_pertanyaan','soal_jawaban_a','soal_jawaban_b','soal_jawaban_c','soal_jawaban_d','soal_jawaban_e','soal_kunci_jawaban'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('soal_id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
		$this->db->join('cpns_kategori_soal', 'cpns_kategori_soal.kategori_soal_id=cpns_soal.soal_kategori_id', 'left');
		
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
	
	function get_datatables_by_type($type, $idSoalIN)
	{
		$this->_get_datatables_query_by_type($type, $idSoalIN);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all_by_type($type, $idSoalIN)
	{
		$this->db->from($this->table);
		$this->db->where_in('soal_type', $type);
		$this->db->where_not_in('soal_id', $idSoalIN);
		return $this->db->count_all_results();
	}
	
	function count_filtered_by_type($type, $idSoalIN)
	{
		$this->_get_datatables_query_by_type($type, $idSoalIN);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	private function _get_datatables_query_by_type($type, $idSoalIN)
	{
		
		$this->db->from($this->table);
		$this->db->join('cpns_kategori_soal', 'cpns_kategori_soal.kategori_soal_id=cpns_soal.soal_kategori_id', 'left');
		$this->db->where_in('soal_type', $type);
		$this->db->where_not_in('soal_id', $idSoalIN);
		
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
	
	
	
	function get_datatables_view($idSoalIN)
	{
		$this->_get_datatables_query_view($idSoalIN);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all_view($idSoalIN)
	{
		$this->db->from($this->table);
		$this->db->where_in('soal_id', $idSoalIN);
		return $this->db->count_all_results();
	}
	
	function count_filtered_view($idSoalIN)
	{
		$this->_get_datatables_query_view($idSoalIN);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	private function _get_datatables_query_view($idSoalIN)
	{
		
		$this->db->from($this->table);
		$this->db->join('cpns_kategori_soal', 'cpns_kategori_soal.kategori_soal_id=cpns_soal.soal_kategori_id', 'left');
		$this->db->where_in('soal_id', $idSoalIN);
		
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
}
