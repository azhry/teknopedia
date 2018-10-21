<?php 

class Login_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->table_name 	= 'user';
		$this->primary_key 	= 'id';
	}

	public function check($data)
	{
		if (!is_array($data))
		{
			$this->session->set_flashdata('msg', '<div class="text-danger"><i class="glyphicon glyphicon-remove"></i> Username atau password salah</div>');
			return FALSE;
		}

		$result = $this->get($data);
		if (count($result) > 0)
		{
			date_default_timezone_set('Asia/Jakarta');
			foreach ($result as $row)
			{
				$this->session->set_userdata(['id' => $row->id, 'nama' => $row->nama]);
				$this->update($row->id, ['last_login' => date('Y-m-d H:i:s')]);
				return TRUE;
			}
		}

		$this->session->set_flashdata('msg', '<div class="text-danger"><i class="glyphicon glyphicon-remove"></i> Email atau password salah</div>');
		return FALSE;
	}
}