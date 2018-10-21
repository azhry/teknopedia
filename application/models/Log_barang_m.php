<?php 

class Log_barang_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->table_name 	= 'log_barang';
		$this->primary_key 	= 'id';
	}
}