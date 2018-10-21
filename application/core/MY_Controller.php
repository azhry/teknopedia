<?php 

class MY_Controller extends CI_Controller
{
	public $title = 'Teknopedia - Tempatnya jual-beli barang-barang teknologi secara online';

	public function template($data)
	{
		return $this->load->view('components/template', $data);
	}

	public function flashmsg($msg)
	{
		return $this->session->set_flashdata('msg', $msg);
	}

	public function POST($key)
	{
		return $this->input->post($key);
	}

	public function upload($id, $tag_name = 'userfile', $directory = '') 
	{
		if (strlen($directory) > 1)
		{
			$rootUrl = APPPATH;
			$rootUrl = substr($rootUrl, 0, strlen($rootUrl) - strlen('application') - 1);
	    	@unlink($rootUrl . 'img/'.$directory.'/' . $id . '.png');
	    	$config = array(
	    		'file_name'		=> $id . '.png',
	    		'allowed_types'	=> 'jpg|jpeg|png|gif',
	    		'upload_path'	=> realpath(APPPATH . '../img/' . $directory)
	    	);
	    	$this->load->library('upload', $config);
	    	$this->upload->do_upload($tag_name);	
		}
		else
		{
			$rootUrl = APPPATH;
			$rootUrl = substr($rootUrl, 0, strlen($rootUrl) - strlen('application') - 1);
	    	@unlink($rootUrl . 'img/profile/' . $id . '.png');
	    	$config = array(
	    		'file_name'		=> $id . '.png',
	    		'allowed_types'	=> 'jpg|jpeg|png|gif',
	    		'upload_path'	=> realpath(APPPATH . '../img/profile')
	    	);
	    	$this->load->library('upload', $config);
	    	$this->upload->do_upload($tag_name);
		}
    }
}