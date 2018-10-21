<?php  

class Register_m extends MY_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->table_name 	= 'user';
		$this->primary_key 	= 'id';
	}

	public function validate()
	{
		$this->load->library('form_validation');
		
		$config = [
			[
				'field'	=> 'nama',
				'label'	=> 'Nama',
				'rules'	=> 'required',
				'error'	=> [
					'required'	=> '%s harus diisi'
				]
			],
			[
				'field'	=> 'no_hp',
				'label'	=> 'Mobile Number',
				'rules'	=> 'required',
				'error'	=> [
					'required'	=> '%s harus diisi'
				]
			],
			[
				'field'	=> 'email',
				'label'	=> 'Email',
				'rules'	=> 'required',
				'error'	=> [
					'required'	=> '%s harus diisi'
				]
			],
			[
				'field'	=> 'password',
				'label'	=> 'Password',
				'rules'	=> 'required',
				'error'	=> [
					'required'	=> '%s harus diisi'
				]
			],
			[
				'field'	=> 'tanggal',
				'label'	=> 'Tanggal',
				'rules'	=> 'required',
				'error'	=> [
					'required'	=> '%s harus diisi'
				]
			],
			[
				'field'	=> 'bulan',
				'label'	=> 'Bulan',
				'rules'	=> 'required',
				'error'	=> [
					'required'	=> '%s harus diisi'
				]
			],
			[
				'field'	=> 'tahun',
				'label'	=> 'Tahun',
				'rules'	=> 'required',
				'error'	=> [
					'required'	=> '%s harus diisi'
				]
			],
			[
				'field'	=> 'gender',
				'label'	=> 'Gender',
				'rules'	=> 'required',
				'error'	=> [
					'required'	=> '%s harus diisi'
				]
			]
		];

		$this->form_validation->set_rules($config);
		
		$isValid = $this->form_validation->run();

		if ($isValid)
		{
			$this->session->set_flashdata('msg', '<div class="text-success"><i class="glyphicon glyphicon-check"></i> Registration success. <a href="'.base_url('login').'"><u>Login</u></a></div>');
		}
		else
		{
			$this->session->set_flashdata('msg', '<div class="text-danger"><i class="glyphicon glyphicon-remove"></i> Registration failed</div>');
		}

		return $isValid;
	}
}