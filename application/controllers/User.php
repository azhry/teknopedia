<?php 

class User extends MY_Controller
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

		// $previousUrl = $this->session->userdata('current_url');
		// $currentUrl = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
		// if (isset($previousUrl))
		// {
		// 		if ($previousUrl == $currentUrl)
		// 		{

		// 		 }
		// }
		// $this->session->set_userdata(['current_url' => $currentUrl]);

		$this->load->model('user_m');
		
		$id_role = $this->user_m->get_role($this->id);
		if ($id_role == 2)
		{
			redirect('admin');
			exit;
		}
		$this->session->set_userdata(['id_role' => $id_role]);

		$this->data = $this->user_m->get_identity($this->id);
		$this->data['id_role'] = $id_role;
		$this->data['id'] = $this->id;
	}

	public function index()
	{
		$newUser = $this->session->userdata($this->data['nama'] . '_setting');
		if (isset($newUser))
		{
			redirect('user/setting');
			exit;
		}

		$this->data['title'] = 'Dashboard | ' . $this->title;
		$this->data['content'] = 'user/dashboard';
		$this->template($this->data);
	}

	public function items()
	{
		$this->load->model('barang_m');
		$this->data['title'] 	= 'Barang Anda | ' . $this->title;
		$this->data['content']	= 'user/list_item';
		$this->data['barang']	= $this->barang_m->get(['id_penjual' => $this->id]);
		$this->template($this->data);
	}

	public function transaksi()
	{
		$this->load->model('barang_m');
		$this->load->model('transaksi_m');
		$this->data['title']			= 'Barang yang terjual | ' . $this->title;
		$this->data['content']			= 'user/bought_item';
		$this->data['barang_terjual']	= $this->transaksi_m->get(['id_penjual' => $this->id]);
		$this->template($this->data);
	}

	public function status()
	{
		$this->load->model('barang_m');
		$this->load->model('transaksi_m');
		$this->data['title']		= 'Transaksi Anda | ' . $this->title;
		$this->data['content']		= 'user/transaksi';
		$this->data['transaksi']	= $this->transaksi_m->get(['id_pembeli' => $this->id]);
		$this->template($this->data);
	}

	public function update_status_transaksi($id)
	{
		if (!isset($id))
		{
			redirect('user/transaksi');
			exit;
		}

		$this->load->model('transaksi_m');
		$this->transaksi_m->update($id, ['status' => 'Terkirim']);
		redirect('user/transaksi');
		exit;
	}

	public function beli()
	{
		$this->load->model('barang_m');
		$this->load->model('transaksi_m');
	
		date_default_timezone_set('Asia/Jakarta');
		$data = [
			'id_pembeli'	=> $this->POST('id_pembeli'),
			'id_penjual'	=> $this->POST('id_penjual'),
			'id_barang'		=> $this->POST('id_barang'),
			'harga'			=> $this->POST('harga'),
			'pcs'			=> $this->POST('quantity'),
			'status'		=> 'Barang belum dikirim',
			'tanggal'		=> date('Y-m-d H:i:s')
		];
		$this->transaksi_m->insert($data);

		$barang = $this->barang_m->get(['id' => $data['id_barang']]);
		$stok = 0;
		foreach ($barang as $row)
			$stok = $row->stok;
		if ($stok > 0)
			$stok = $stok - $data['pcs'];

		$this->barang_m->update($data['id_barang'], ['stok' => $stok]);
		$this->flashmsg('<div class="alert alert-success">Anda berhasil melakukan transaksi dengan total Rp. '.$data['harga'] * $data['pcs'].' ,-</div>');
		redirect('home/details/'.$data['id_barang']);
		exit;
	}

	public function form()
	{
		$this->load->model('kategori_m');
		if ($this->POST('submit'))
		{
			$this->load->model('barang_m');
			$data = [
				'id_penjual'	=> $this->id,
				'nama'			=> $this->POST('nama'),
				'deskripsi'		=> $this->POST('deskripsi'),
				'harga'			=> $this->POST('harga'),
				'stok'			=> $this->POST('stok'),
				'id_kategori' 	=> $this->kategori_m->getIdKategoriByNama($this->POST('tipe')),
				'status' 		=> $this->POST('status')
			];

			$kategori = $this->POST('tipe');
			if ($kategori == 'Laptop' or $kategori == 'Smartphone' or $kategori == 'Tablet')
			{
				$data['spesifikasi'] = json_encode([
					'merk'		=> $this->POST('merk'),
					'ram'		=> $this->POST('ram'),
					'kapasitas' => $this->POST('kapasitas'),
					'prosesor'	=> $this->POST('prosesor'),
					'warna'		=> $this->POST('warna')
				]);
			}
			else if ($kategori == 'Flashdisk' or $kategori == 'Harddisk')
			{
				$data['spesifikasi'] = json_encode([
					'merk'		=> $this->POST('merk'),
					'kapasitas'	=> $this->POST('size'),
					'warna'		=> $this->POST('warna')
				]);
			}
			else if ($kategori == 'Keyboard' or $kategori == 'Mouse' or $kategori == 'Charger Laptop' or $kategori == 'Charger HP')
			{
				$data['spesifikasi'] = json_encode([
					'merk'		=> $this->POST('merk'),
					'warna'		=> $this->POST('warna')
				]);
			}

			$this->barang_m->insert($data);
			$id_barang = $this->barang_m->getIdBarang($data);
			$this->upload($id_barang, 'upload', 'barang');
		}

		$this->data['title'] 	= 'Form | ' . $this->title;
		$this->data['content']	= 'user/form';
		$this->data['kategori']	= $this->kategori_m->get();
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
			redirect('user/setting');
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

	public function display_item($id)
	{
		if (!isset($id))
		{
			redirect('user/items');
			exit;
		}

		$this->load->model('barang_m');
		$barang = $this->barang_m->get(['id' => $id]);
		$data = [];
		foreach ($barang as $row)
		{
			$data = [
				'id'			=> $row->id,
				'nama'			=> $row->nama,
				'harga'			=> $row->harga,
				'stok'			=> $row->stok,
				'deskripsi'		=> $row->deskripsi,
				'spesifikasi'	=> json_decode($row->spesifikasi)
			];
		}

		echo '<div id="image_display" style="text-align: center;">
			<img src="'.base_url('img/barang/'.$id.'.png').'" width="300" height="300" style="border: 1px solid grey; box-shadow: 3px 3px grey;">
		</div>
		<br>
		<div align="middle">
			<div id="detail" style="border: 1px solid grey; width: 70%; height: 250px;">
				<table class="table">';

		$specs 		= array_keys((array)$data['spesifikasi']);
		$details	= array_values((array)$data['spesifikasi']);	
		for ($i = 0; $i < count($specs); $i++)
		{
			echo '<tr>';
			echo '<td>' . $specs[$i] . '</td>';
			echo '<td>' . $details[$i] . '</td>';
			echo '</tr>';
		}

		echo '</table>
			</div>
		</div>';
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->flashmsg('<div class="text-success"><i class="glyphicon glyphicon-success"></i> Anda berhasil logout</div>');
		redirect('login');
		exit;
	}
}

/* end of file User.php */
/* location: ./application/controllers/User.php */