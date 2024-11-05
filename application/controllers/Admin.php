<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_not_login();
	}
	public function index()
	{
		// Load template dengan bagian-bagian yang terpisah
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('admin/index'); // Isi konten dashboard
		$this->load->view('template/footer');
	}
}
