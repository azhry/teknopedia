<?php 

class Login extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$user_id = $this->session->userdata('id');
		if (isset($user_id))
		{
			redirect('user');
			exit;
		}
		$this->load->model('login_m');
	}

	public function index()
	{
		if ($this->POST('login'))
		{
			if ($this->login_m->check([
				'email' => $this->POST('email'), 
				'password' => md5($this->POST('password'))]))
			{
				redirect('user'); // redirect to user homepage
				exit;
			}
		}

		$data = [
			'title'		=> 'Login | ' . $this->title,
			'content'	=> 'login/public'
		];
		$this->template($data);
	}
}

/* end of file Home.php */
/* location: ./application/controllers/Login.php */