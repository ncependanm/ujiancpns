<?php
/**
 * Description of mcrud
 * class ini digunakan untuk melakukan manipulasi  data sederhana
 * dengan parameter yang dikirim dari controller.
 * @author nuris akbar
 */
class mcrud extends CI_Model{
   
    // Menampilkan data dari sebuah tabel dengan pagination.
    public function getList($tables,$limit,$page,$by,$sort){
        $this->db->order_by($by,$sort);
        $this->db->limit($limit,$page);
        return $this->db->get($tables);
    }
    
    // menampilkan semua data dari sebuah tabel.
    public function getAll($tables){
    
        return $this->db->get($tables);
    }
    
    // menghitun jumlah record dari sebuah tabel.
    public function countAll($tables){
        return $this->db->get($tables)->num_rows();
    }
    
    // menghitun jumlah record dari sebuah query.
    public function countQuery($query){
        return $this->db->get($query)->num_rows();
    }
    
    //enampilkan satu record brdasarkan parameter.
    public function kondisi($tables,$where)
    {
        $this->db->where($where);
        return $this->db->get($tables);
    }
    //menampilkan satu record brdasarkan parameter.
    public  function getByID($tables,$pk,$id){
        $this->db->where($pk,$id);
        return $this->db->get($tables);
    }
    
    // Menampilkan data dari sebuah query dengan pagination.
    public function queryList($query,$limit,$page){
       
        return $this->db->query($query." limit ".$page.",".$limit."");
    }
    
    public function queryBiasa($query,$by,$sort){
       // $this->db->order_by($by,$sort);
        return $this->db->query($query);
    }
    // memasukan data ke database.
    public function insert($tables,$data){
        $this->db->insert($tables,$data);
    }
    
    // update data kedalalam sebuah tabel
    public function update($tables,$data,$pk,$id){
        $this->db->where($pk,$id);
        $this->db->update($tables,$data);
    }

	// update dengan array data kedalalam sebuah tabel
    public function updateArray($tables,$data,$array){
        $this->db->where($array);
        $this->db->update($tables,$data);
    }
	
    // menghapus data dari sebuah tabel
    public function delete($tables,$pk,$id){
        $this->db->where($pk,$id);
        $this->db->delete($tables);
    }
    
    function login($username,$password)
    {
       return $this->db->get_where('users',array('username'=>$username,'password'=>$password));        
    }
	// digunakan untuk cek NISN ketika pendaftaran
	public function cekNISN($data){		
		$this->db->from('tbl_reg_akun');
		$this->db->where('reg_akun_nisn',$data);

		return $this->db->count_all_results();
	}
	// digunakan untuk cek Email ketika pendaftaran
	public function cekEmail($data){		
		$this->db->from('cpns_user');
		$this->db->where('user_email',$data);

		return $this->db->count_all_results();
	}
	
	public function cekUsername($data){		
		$this->db->from('cpns_user');
		$this->db->where('user_username',$data);

		return $this->db->count_all_results();
	}
	
	
	function sendMail($to_email, $subject, $message)
	{
		$config = Array(
		  'protocol' => 'imap',
		  'smtp_host' => 'smtp.gmail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'cpns.to@gmail.com', 
		  'smtp_pass' => 'cpnsto123', 
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);
		
        $this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('cpns.to@gmail.com', 'Admin CPNS TO'); // change it to yours
		$this->email->to($to_email);// change it to yours
		$this->email->subject($subject);
		$this->email->message($message);
		return $this->email->send();
	}
	    
    //activate user account
    function verifyEmailID($key)
    {
        $data = array('user_status' => 1);
        $this->db->where('md5(user_email)', $key);
        return $this->db->update('cpns_user', $data);
    }
	//activate user account
    function resetPassword($id, $password)
    {
        $data = array('user_password' => $password );
        $this->db->where('user_id', $id);
        return $this->db->update('cpns_user', $data);
    }
}

?>
