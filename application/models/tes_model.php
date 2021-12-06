<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tes_Model extends CI_Model {

	var $table = 'cpns_tes_parent';
	var $column_order = array('tes_parent_id','soal_type','kategori_soal_nama','soal_pertanyaan','tes_detail_jawaban','soal_kunci_jawaban', 'soal_penyelesaian',null); //set column field database for datatable orderable
	var $column_search = array('soal_type','kategori_soal_nama','soal_pertanyaan','tes_detail_jawaban','soal_kunci_jawaban', 'soal_penyelesaian'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('tes_parent_id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($idUser)
	{
		
		$this->db->from($this->table);
		$this->db->join('cpns_ujian', 'cpns_tes_parent.	tes_parent_ujian_id=cpns_ujian.ujian_id', 'left');
		$this->db->join('cpns_paket_parent', 'cpns_ujian.ujian_paket_parent_id=cpns_paket_parent.paket_parent_id', 'left');
		$this->db->where_in('tes_parent_user_id', $idUser);
		$this->db->where('tes_parent_ind', 'Y');
		
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

	function get_datatables($idUser)
	{
		$this->_get_datatables_query($idUser);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($idUser)
	{
		$this->_get_datatables_query($idUser);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($idUser)
	{
		$this->db->from($this->table);
		$this->db->join('cpns_paket_parent', 'cpns_tes_parent.tes_parent_paket_parent_id=cpns_paket_parent.paket_parent_id', 'left');
		$this->db->where_in('tes_parent_user_id', $idUser);
		$this->db->where('tes_parent_ind', 'Y');
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

	
	function get_datatables_view($idPaket)
	{
		$this->_get_datatables_query_view($idPaket);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all_view($idPaket)
	{
		$this->db->from($this->table);
		$this->db->join('cpns_ujian', 'cpns_tes_parent.tes_parent_ujian_id=cpns_ujian.ujian_id', 'left');
		$this->db->join('cpns_paket_parent', 'cpns_ujian.ujian_paket_parent_id=cpns_paket_parent.paket_parent_id');
		$this->db->join('cpns_tes_detail', 'cpns_tes_detail.tes_detail_tes_id = cpns_tes_parent.tes_parent_id');
		$this->db->join('cpns_soal', 'cpns_soal.soal_id = cpns_tes_detail.tes_detail_soal_id');
		$this->db->join('cpns_kategori_soal', 'cpns_kategori_soal.kategori_soal_id=cpns_soal.soal_kategori_id');
		$this->db->where('ujian_id', $idPaket);
		$this->db->where('tes_parent_user_id', $this->session->userdata('user_id'));
		return $this->db->count_all_results();
	}
	
	function count_filtered_view($idPaket)
	{
		$this->_get_datatables_query_view($idPaket);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	private function _get_datatables_query_view($idPaket)
	{
		
		$this->db->from($this->table);
		$this->db->join('cpns_ujian', 'cpns_tes_parent.tes_parent_ujian_id=cpns_ujian.ujian_id', 'left');
		$this->db->join('cpns_paket_parent', 'cpns_ujian.ujian_paket_parent_id=cpns_paket_parent.paket_parent_id');
		$this->db->join('cpns_tes_detail', 'cpns_tes_detail.tes_detail_tes_id = cpns_tes_parent.tes_parent_id');
		$this->db->join('cpns_soal', 'cpns_soal.soal_id = cpns_tes_detail.tes_detail_soal_id');
		$this->db->join('cpns_kategori_soal', 'cpns_kategori_soal.kategori_soal_id=cpns_soal.soal_kategori_id');
		$this->db->where('ujian_id', $idPaket);
		$this->db->where('tes_parent_user_id', $this->session->userdata('user_id'));
		
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
