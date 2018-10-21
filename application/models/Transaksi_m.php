<?php 

class Transaksi_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->table_name 	= 'transaksi';
		$this->primary_key 	= 'id_transaksi';
	}
}