<?php
	// partial view 
	$config_h = ['title' => $title];
	$this->load->view('components/header', $config_h);
	
	$config_n = [];
	$this->load->view('components/navbar', $config_n);

	$config_c = [];
	$this->load->view($content, $config_c);

	$config_f = [];
	$this->load->view('components/footer', $config_f);
?>