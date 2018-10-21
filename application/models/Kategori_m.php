<?php 

class Kategori_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table_name 	= 'kategori';
		$this->primary_key 	= 'id';
	}

	public function getIdKategoriByNama($nama)
	{
		$this->db->where(['nama' => $nama]);
		$query = $this->db->get($this->table_name);
		return $query->row()->id;
	}
}