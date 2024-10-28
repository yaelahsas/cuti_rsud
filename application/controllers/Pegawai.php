<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Pegawai_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');

		$this->load->model('Ruangan_model');  // Pastikan ada model Ruangan_model
		$this->load->model('Jabatan_model');  // Pastikan ada model Jabatan_model
	}

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('pegawai/pegawai_list');
		$this->load->view('template/footer');
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Pegawai_model->json();
	}

	public function read($id)
	{
		$row = $this->Pegawai_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'id_user' => $row->id_user,
				'id_jabatan' => $row->id_jabatan,
				'id_ruangan' => $row->id_ruangan,
				'nip' => $row->nip,
				'status_pegawai' => $row->status_pegawai,
				'alamat' => $row->alamat,
				'tanggal_lahir' => $row->tanggal_lahir,
				'jenis_kelamin' => $row->jenis_kelamin,
				'telepon' => $row->telepon,
				'email' => $row->email,
			);
			$this->load->view('pegawai/pegawai_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('pegawai'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('pegawai/create_action'),
			'id' => set_value('id'),
			'id_user' => set_value('id_user'),
			'id_jabatan' => set_value('id_jabatan'),
			'id_ruangan' => set_value('id_ruangan'),
			'nip' => set_value('nip'),
			'status_pegawai' => set_value('status_pegawai'),
			'alamat' => set_value('alamat'),
			'tanggal_lahir' => set_value('tanggal_lahir'),
			'jenis_kelamin' => set_value('jenis_kelamin'),
			'telepon' => set_value('telepon'),
			'email' => set_value('email'),
			'jabatan_list' => $this->Jabatan_model->get_all(),  // Data Jabatan
			'ruangan_list' => $this->Ruangan_model->get_all()   // Data Ruangan
		);
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('pegawai/pegawai_form', $data);
		$this->load->view('template/footer');
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'id_user' => $this->input->post('id_user', TRUE),
				'id_jabatan' => $this->input->post('id_jabatan', TRUE),
				'id_ruangan' => $this->input->post('id_ruangan', TRUE),
				'nip' => $this->input->post('nip', TRUE),
				'status_pegawai' => $this->input->post('status_pegawai', TRUE),
				'alamat' => $this->input->post('alamat', TRUE),
				'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
				'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
				'telepon' => $this->input->post('telepon', TRUE),
				'email' => $this->input->post('email', TRUE),
			);

			$this->Pegawai_model->insert($data);
			// $this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('pegawai'));
		}
	}

	public function update($id)
	{
		$row = $this->Pegawai_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('pegawai/update_action'),
				'id' => set_value('id', $row->id),
				'id_user' => set_value('id_user', $row->id_user),
				'id_jabatan' => set_value('id_jabatan', $row->id_jabatan),
				'id_ruangan' => set_value('id_ruangan', $row->id_ruangan),
				'nip' => set_value('nip', $row->nip),
				'status_pegawai' => set_value('status_pegawai', $row->status_pegawai),
				'alamat' => set_value('alamat', $row->alamat),
				'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
				'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
				'telepon' => set_value('telepon', $row->telepon),
				'email' => set_value('email', $row->email),
				'jabatan_list' => $this->Jabatan_model->get_all(),  // Data Jabatan
				'ruangan_list' => $this->Ruangan_model->get_all()   // Data Ruangan
			);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/topbar');
			$this->load->view('pegawai/pegawai_form', $data);
			$this->load->view('template/footer');
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('pegawai'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id', TRUE));
		} else {
			$data = array(
				'id_user' => $this->input->post('id_user', TRUE),
				'id_jabatan' => $this->input->post('id_jabatan', TRUE),
				'id_ruangan' => $this->input->post('id_ruangan', TRUE),
				'nip' => $this->input->post('nip', TRUE),
				'status_pegawai' => $this->input->post('status_pegawai', TRUE),
				'alamat' => $this->input->post('alamat', TRUE),
				'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
				'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
				'telepon' => $this->input->post('telepon', TRUE),
				'email' => $this->input->post('email', TRUE),
			);

			$this->Pegawai_model->update($this->input->post('id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('pegawai'));
		}
	}

	public function delete($id)
	{
		$row = $this->Pegawai_model->get_by_id($id);

		if ($row) {
			$this->Pegawai_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('pegawai'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('pegawai'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
		$this->form_validation->set_rules('id_jabatan', 'id jabatan', 'trim|required');
		$this->form_validation->set_rules('id_ruangan', 'id ruangan', 'trim|required');
		$this->form_validation->set_rules('nip', 'nip', 'trim|required');
		$this->form_validation->set_rules('status_pegawai', 'status pegawai', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
		$this->form_validation->set_rules('telepon', 'telepon', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-10-26 03:48:23 */
/* http://harviacode.com */
