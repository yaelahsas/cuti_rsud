<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_cuti extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('form_validation');
		$this->load->model('Cuti_model'); // Pastikan ada model Cuti_model
		$this->load->model('Users_model'); // Pastikan ada model User_model
		$this->load->model('Jenis_cuti_model'); // Pastikan ada model JenisCuti_model
		$this->load->model('Pegawai_model'); // Pastikan ada model JenisCuti_model
		$this->load->model('Persetujuan_model'); // Pastikan ada model JenisCuti_model
		$this->load->library('datatables');

	}


	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Cuti_model->json_pegawai();
	}

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('pegawai_cuti/data_cuti');
		$this->load->view('template/footer');
	}
	// Halaman untuk pengajuan cuti oleh pegawai
	public function ajukan()
	{
		$user = $this->Pegawai_model->get_by_id_user($this->session->userdata('user')->id);

		$data = [
			'action' => site_url('pegawai_cuti/ajukan_action'),
			'button' => 'Ajukan',
			'user_list' => $this->Users_model->get_all(), // Mendapatkan semua user
			'jenis_cuti_list' => $this->Jenis_cuti_model->get_all(), // Mendapatkan semua jenis cuti
			'pimpinan1' => $this->Pegawai_model->get_pimpinan($user->id_ruangan, 2), // Pimpinan tetap
			'pimpinan2' => $this->Pegawai_model->get_pimpinan($user->id_ruangan, 3),
			'pimpinan3' => $this->Pegawai_model->get_pimpinan($user->id_ruangan, 6),
		];

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('pegawai_cuti/cuti_form', $data);
		$this->load->view('template/footer');
	}

	// Aksi pengajuan cuti oleh pegawai
	public function ajukan_action()
		{

		$persetujuan = array(
			'id_cuti' => null,
			'id_jenis_cuti' => $this->input->post('id_jenis_cuti'),
			'id_pimpinan1' => $this->input->post('pimpinan1_id'),
			'id_pimpinan2' => $this->input->post('pimpinan2_id'),
			'id_pimpinan3' => $this->input->post('pimpinan3_id'),
			'status_pimpinan1' => 'pending',
			'status_pimpinan2' =>  'pending',
			'status_pimpinan3' =>  'pending',
			'tanggal_persetujuan' => date('Y-m-d'),
		);

		// Memasukkan data persetujuan ke dalam database
		$persetujuan_id = $this->Persetujuan_model->insert($persetujuan);

		// Data cuti untuk tabel cuti
		$data = array(
			'id_user' => (int) $this->session->userdata('user')->id,
			'id_jenis_cuti' => (int) $this->input->post('id_jenis_cuti'),
			'tanggal_pengajuan' => date('Y-m-d'),
			'tanggal_mulai' => $this->input->post('tanggal_mulai', TRUE),
			'tanggal_selesai' => $this->input->post('tanggal_selesai', TRUE),
			'lama_cuti' => $this->input->post('lama_cuti', TRUE),
			'sisa_cuti' => 0,
			'alasan' => $this->input->post('alasan', TRUE),
			'id_persetujuan' => $persetujuan_id, // Menghubungkan ke id persetujuan
			// 'catatan_pimpinan' => "",
		);


		// Menyimpan data cuti ke database menggunakan model Cuti_model
		$this->Cuti_model->insert($data);

		// Set pesan berhasil dan arahkan ke halaman data cuti
		$this->session->set_flashdata('message', 'Pengajuan cuti berhasil dikirim');
		redirect(site_url('pegawai_cuti/data_cuti'));
	}

	// Halaman persetujuan cuti untuk pimpinan
	public function setujui($id_cuti, $pimpinan_id)
	{
		$this->Cuti_model->setujui_cuti($id_cuti, $pimpinan_id); // Setujui cuti oleh pimpinan sesuai urutan
		$this->session->set_flashdata('message', 'Persetujuan berhasil disimpan');
		redirect(site_url('pegawai_cuti/data_cuti'));
	}

	// Menampilkan semua data cuti yang diajukan (untuk admin dan pimpinan)
	public function data_cuti()
	{
		$data['cuti_list'] = $this->Cuti_model->get_all(); // Mendapatkan semua data cuti
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pegawai_cuti/data_cuti', $data);
		$this->load->view('template/footer');
	}
}
