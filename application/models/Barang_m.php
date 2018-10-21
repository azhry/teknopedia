<?php  

class Barang_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->table_name 	= 'barang';
		$this->primary_key 	= 'id';
		$this->rows 		= 0;
	}

	public function getIdBarang($cond)
	{
		$this->db->where($cond);
		$query = $this->db->get($this->table_name);
		return $query->row()->id;
	}

	public function getHotList()
	{
		$query = $this->db->query('SELECT * FROM ' . $this->table_name . ' ORDER BY jumlah_viewer DESC');
		return $query->result();
	}

	public function getItemList($start, $limit)
	{
		$sql = 'SELECT * FROM '.$this->table_name.' ORDER BY '.$this->primary_key.' DESC limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result();
	}

	public function getBarangSpesifikasiLike($substr)
	{
		$query = $this->db->query('SELECT * FROM ' . $this->table_name . ' WHERE spesifikasi LIKE "%' . $substr . '%"');
		$this->rows = $query->num_rows();
		return $query->result();
	}

}