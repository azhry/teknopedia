<?php 

class Home extends MY_Controller
{
	protected $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['id_role'] = $this->session->userdata('id_role');
	}

	public function index()
	{
		$this->load->model('barang_m');
		$this->data['title'] = $this->title;
		$this->data['content'] = 'home/public';
		$this->data['hot_list'] = $this->barang_m->getHotList();
		$this->template($this->data);
	}

	public function details($product_id)
	{
		if (!isset($product_id))
		{
			redirect();
			exit;
		}

		$this->load->model('barang_m');
		$temp = $this->barang_m->get(['id' => $product_id]);
		$viewer = 0;
		foreach ($temp as $row)
			$viewer = $row->jumlah_viewer + 1;
		$this->barang_m->update($product_id, ['jumlah_viewer' => $viewer]);
		$this->data['title'] = $this->title;
		$this->data['content'] = 'home/product_details';
		$this->data['item'] = $this->barang_m->get(['id' => $product_id]);
		$this->template($this->data);
	}

	public function search()
	{
		$data = ['keywords' => $this->POST('search')];
		$this->load->model('barang_m');
		$filtered = [];
		if (strpos($data['keywords'], ':'))
		{
			$key = explode(':', $data['keywords']);
			$barang = $this->barang_m->getBarangSpesifikasiLike($key[0]);
			foreach ($barang as $row)
			{
				$spec = json_decode($row->spesifikasi, true);
				if ($spec[strtolower($key[0])] == $key[1])
					$filtered []= $row;
			}
			$this->data['barang'] = $filtered;
		}
		else
		{
			$this->data['barang'] = $this->barang_m->getDataLike(['nama' => $data['keywords']]);
		}

		$this->data['total_pencarian'] = count($this->data['barang']);
		$this->data['title'] 	= 'Pencarian Barang | ' . $this->title;
		$this->data['content']	= 'home/search';
		$this->template($this->data);
	}
}

/* end of file Home.php */
/* location: ./application/controllers/Home.php */