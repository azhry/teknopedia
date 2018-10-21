<?php 

class Register extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('register_m');
	}

	public function index()
	{
		if ($this->POST('register'))
		{
			if ($this->register_m->validate())
			{
				$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
				$month = array_search($this->POST('bulan'), $months) + 1;

				$data = [
					'nama'			=> $this->POST('nama'),
					'email'			=> $this->POST('email'),
					'no_hp'			=> $this->POST('no_hp'),
					'password'		=> md5($this->POST('password')),
					'jenis_kelamin'	=> $this->POST('gender'),
					'tanggal_lahir'	=> $this->POST('tahun') . '-' . 
										$month . '-' .
										$this->POST('tanggal'),
					'id_role'		=> 1
				];

				$this->register_m->insert($data);
				$this->session->set_userdata([$data['nama'] . '_setting' => 'new']);
			}
		}

		$data = [
			'title'		=> 'Register | ' . $this->title, // cara bikin title yang SEO
			'content'	=> 'register/public'
		];
		$this->template($data);
	}
}

/* end of file Register.php */
/* location: ./application/controllers/Register.php */