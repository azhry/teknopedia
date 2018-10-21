<?php 

class Admin extends MY_Controller
{
	protected $id;
	protected $data;

	public function __construct()
	{
		parent::__construct();
		$this->id = $this->session->userdata('id');
		if (!isset($this->id))
		{
			$this->flashmsg('<div class="text-primary"><i class="glyphicon glyphicon-remove"></i> Anda harus login terlebih dahulu</div>');
			redirect('login');
			exit;
		}

		$this->load->model('user_m');
		
		$id_role = $this->user_m->get_role($this->id);
		if ($id_role != 2)
		{
			$this->session->unset_userdata('id');
			$this->flashmsg('<div class="text-danger"><i class="glyphicon glyphicon-remove"></i> Anda harus login sebagai admin untuk mengakses halaman tersebut</div>');
			redirect('login');
			exit;
		}
		$this->session->set_userdata(['id_role' => $id_role]);

		$this->data = $this->user_m->get_identity($this->id);
		$this->data['id_role'] = $id_role;
		$this->data['id'] = $this->id;
	}

	public function index()
	{
		$this->load->model('barang_m');
		$this->data['title'] 	= 'Dashboard - Admin | ' . $this->title;
		$this->data['content']	= 'admin/dashboard';
		// $this->data['items'] = $this->barang_m->getOrdered('DESC');

		$this->load->library('pagination');

		//pagination settings
        $config['base_url'] = base_url('admin/index');
        $config['total_rows'] = $this->db->count_all('barang');
        $config['per_page'] = "5";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //call the model function to get the department data
        $this->data['items'] = $this->barang_m->getItemList($this->data['page'], $config["per_page"]);           
        $this->data['pagination'] = $this->pagination->create_links();
        $this->template($this->data);
	}

	public function detail($product_id)
	{
		if (!isset($product_id))
		{
			redirect('admin');
			exit;
		}

		$this->load->model('barang_m');

		if ($this->POST('hapus'))
		{
			date_default_timezone_set('Asia/Jakarta');
			$this->data['delete'] = [
				'id_barang'		=> $this->POST('id_barang'),
				'id_penjual'	=> $this->POST('id_penjual'),
				'keterangan'	=> $this->POST('keterangan'),
				'waktu'			=> date('Y-m-d H:i:s')
			];

			$this->barang_m->delete($this->data['delete']['id_barang']);
			$this->load->model('log_barang_m');
			$this->log_barang_m->insert($this->data['delete']);
			redirect('admin');
			exit;
		}
	
		$this->data['title']	= 'Product Detail - Admin | ' . $this->title;
		$this->data['content']	= 'admin/product_details';
		$this->data['item']		= $this->barang_m->get(['id' => $product_id]);
		$this->template($this->data);
	}

	public function setting()
	{
		if ($this->POST('submit'))
		{
			$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
			$month = array_search($this->POST('bulan'), $months) + 1;

			$data = [
				'email'			=> $this->POST('email'),
				'nama'			=> $this->POST('nama'),
				'alamat'		=> $this->POST('alamat'),
				'tanggal_lahir' => $this->POST('tahun') . '-' . 
									$month . '-' .
									$this->POST('tanggal'),
				'no_hp'			=> $this->POST('no_hp')
			];

			$this->user_m->update($this->id, $data);
			$this->flashmsg('<div class="text-success"><i class="glyphicon glyphicon-check"></i> Data identitas berhasil disimpan</div>');
			redirect('admin/setting');
			exit;
		}

		$this->data['title'] 	= 'Profile Settings | ' . $this->title;
		$this->data['content']	= 'user/setting';
		$this->template($this->data);
	}

	public function upload_photo($temp_name = '')
	{
		if (strlen($temp_name) > 1)
			$this->upload($this->id . $temp_name, 'upload', 'temp');
		else
			$this->upload($this->id, 'upload');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->flashmsg('<div class="text-success"><i class="glyphicon glyphicon-success"></i> Anda berhasil logout</div>');
		redirect('login');
		exit;
	}
}

/* end of file Admin.php */
/* location: ./application/controllers/Admin.php */