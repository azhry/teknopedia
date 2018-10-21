<?php 

class User_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table_name 	= 'user';
		$this->primary_key 	= 'id';
	}
					
	public function get_name($id)
	{
		return $this->db->query('SELECT nama FROM ' . $this->table_name . ' WHERE id='.$id)->row()->nama;
	}

	public function get_identity($id)
	{
		return $this->db->query('SELECT nama, email, jenis_kelamin, alamat, tanggal_lahir, no_hp, last_login FROM ' . $this->table_name . ' WHERE id=' . $id . ' LIMIT 1')->row_array();
	}

	public function get_role($id)
	{
		return $this->db->query('SELECT id_role FROM ' . $this->table_name . ' WHERE id='.$id)->row()->id_role;
	}
}