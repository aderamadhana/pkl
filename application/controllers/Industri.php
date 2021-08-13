<?php

class Industri extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != "industri") {
			redirect(base_url("login"));
		}
	}

    public function index()
	{
		$this->load->view('industri/index');
		$this->load->view('industri/sidebar');
		$this->load->view('industri/content');
	}
}