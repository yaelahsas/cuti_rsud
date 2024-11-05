<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('datatables');
		$this->load->model('Dashboard_model');
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Dashboard_model->json();
	}

	public function dashboard_pegawai()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('pegawai_cuti/data_cuti');
		$this->load->view('template/footer');
	}
	public function dashboard_pimpinan()
	{

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('dashboard_pegawai');
		$this->load->view('template/footer');
	}
}
