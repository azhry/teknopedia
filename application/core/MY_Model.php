<?php 

class MY_Model extends CI_Model
{
	protected $table_name;
	protected $primary_key;
	public $rows = 0;

	public function __construct()
	{
		parent::__construct();
	}

	public function get($cond = '')
	{
		if (is_array($cond))
			$this->db->where($cond);

		$query = $this->db->get($this->table_name);
		return $query->result();
	}

	public function insert($data)
	{
		return $this->db->insert($this->table_name, $data);
	}

	public function update($pk, $data)
	{
		$this->db->where($this->primary_key, $pk);
		return $this->db->update($this->table_name, $data);
	}

	public function delete($pk)
	{
		$this->db->where($this->primary_key, $pk);
		return $this->db->delete($this->table_name);
	}

	public function getOrdered($order = 'ASC')
	{
		$query = $this->db->query('SELECT * FROM ' . $this->table_name . ' ORDER BY ' . $this->primary_key . ' ' . $order);
		return $query->result();
	}

	public function getDataLike($data)
	{
		$this->db->select('*');
		$this->db->like($data);
		$query = $this->db->get($this->table_name);
		$this->rows = $query->num_rows();
		return $query->result();
	}
}