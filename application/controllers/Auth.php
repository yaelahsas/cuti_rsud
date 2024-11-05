<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
	}
	public function index()
	{
		check_login(); // Pastikan sudah ada helper check_login untuk memeriksa sesi login
		$data = array(
			'title' => "Login"
		);
		$this->load->view('auth/login', $data);
	}

	// Fungsi untuk proses login
	public function process()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		// Mengirim data login ke model
		$user = $this->Auth_model->login($email, $password);

		if ($user) {
			$this->session->set_userdata('user', $user);
			if ($user->id_role == 2) {
				redirect('Admin');
			} elseif ($user->id_role == 1) {
				redirect('Dashboard/dashboard_pegawai');
			} else {
				redirect('Dashboard/dashboard_pimpinan');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Login failed. <br>Please check Username and Password!</div>');
			redirect('auth');
		}
	}
	public function register()
	{
		if ($this->input->post()) {
			$data = [
				'nama' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				// Password disimpan dalam bentuk plaintext, hashing dilakukan di model
				'password' => $this->input->post('password')
			];

			// Simpan data pengguna baru ke database
			$this->Auth_model->register($data);
			redirect('auth');
		} else {
			$this->load->view('auth/register');
		}
	}
	// Fungsi untuk logout
	public function logout()
	{

		$this->session->unset_userdata('user');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
		redirect('Auth');
	}
}
