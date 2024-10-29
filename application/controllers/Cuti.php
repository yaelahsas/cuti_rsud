<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Cuti extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Cuti_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
		$this->load->model('Users_model');
		$this->load->model('Jenis_cuti_model');
	}

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('cuti/cuti_list');
		$this->load->view('template/footer');
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Cuti_model->json();
	}

	public function read($id)
	{
		$row = $this->Cuti_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'id_user' => $row->id_user,
				'id_jenis_cuti' => $row->id_jenis_cuti,
				'tanggal_pengajuan' => $row->tanggal_pengajuan,
				'tanggal_mulai' => $row->tanggal_mulai,
				'tanggal_selesai' => $row->tanggal_selesai,
				'lama_cuti' => $row->lama_cuti,
				'sisa_cuti' => $row->sisa_cuti,
				'alasan' => $row->alasan,
				'id_persetujuan' => $row->id_persetujuan,
				'catatan_pimpinan' => $row->catatan_pimpinan,
			);
			$this->load->view('cuti/cuti_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('cuti'));
		}
	}

	public function create()
	{
		// Ambil data users dan jenis cuti dari model terkait
		$data = array(
			'button' => 'Create',
			'action' => site_url('cuti/create_action'),
			'id' => set_value('id'),
			'id_user' => set_value('id_user'),
			'id_jenis_cuti' => set_value('id_jenis_cuti'),
			'tanggal_pengajuan' => set_value('tanggal_pengajuan'),
			'tanggal_mulai' => set_value('tanggal_mulai'),
			'tanggal_selesai' => set_value('tanggal_selesai'),
			'lama_cuti' => set_value('lama_cuti'),
			'sisa_cuti' => set_value('sisa_cuti'),
			'alasan' => set_value('alasan'),
			'id_persetujuan' => set_value('id_persetujuan'),
			'catatan_pimpinan' => set_value('catatan_pimpinan'),
			'user_list' => $this->Users_model->get_all(), // Mengambil semua user
			'jenis_cuti_list' => $this->Jenis_cuti_model->get_all() // Mengambil semua jenis cuti
		);

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('cuti/cuti_form', $data);
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
				'id_jenis_cuti' => $this->input->post('id_jenis_cuti', TRUE),
				'tanggal_pengajuan' => $this->input->post('tanggal_pengajuan', TRUE),
				'tanggal_mulai' => $this->input->post('tanggal_mulai', TRUE),
				'tanggal_selesai' => $this->input->post('tanggal_selesai', TRUE),
				'lama_cuti' => $this->input->post('lama_cuti', TRUE),
				'sisa_cuti' => $this->input->post('sisa_cuti', TRUE),
				'alasan' => $this->input->post('alasan', TRUE),
				'id_persetujuan' => $this->input->post('id_persetujuan', TRUE),
				'catatan_pimpinan' => $this->input->post('catatan_pimpinan', TRUE),
			);

			$this->Cuti_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('cuti'));
		}
	}

	public function update($id)
	{
		$row = $this->Cuti_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('cuti/update_action'),
				'id' => set_value('id', $row->id),
				'id_user' => set_value('id_user', $row->id_user),
				'id_jenis_cuti' => set_value('id_jenis_cuti', $row->id_jenis_cuti),
				'tanggal_pengajuan' => set_value('tanggal_pengajuan', $row->tanggal_pengajuan),
				'tanggal_mulai' => set_value('tanggal_mulai', $row->tanggal_mulai),
				'tanggal_selesai' => set_value('tanggal_selesai', $row->tanggal_selesai),
				'lama_cuti' => set_value('lama_cuti', $row->lama_cuti),
				'sisa_cuti' => set_value('sisa_cuti', $row->sisa_cuti),
				'alasan' => set_value('alasan', $row->alasan),
				'id_persetujuan' => set_value('id_persetujuan', $row->id_persetujuan),
				'catatan_pimpinan' => set_value('catatan_pimpinan', $row->catatan_pimpinan),
				'user_list' => $this->Users_model->get_all(),  // Ambil semua data user
				'jenis_cuti_list' => $this->Jenis_cuti_model->get_all() // Ambil semua data jenis cuti
			);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/topbar');
			$this->load->view('cuti/cuti_form', $data);
			$this->load->view('template/footer');
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('cuti'));
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
				'id_jenis_cuti' => $this->input->post('id_jenis_cuti', TRUE),
				'tanggal_pengajuan' => $this->input->post('tanggal_pengajuan', TRUE),
				'tanggal_mulai' => $this->input->post('tanggal_mulai', TRUE),
				'tanggal_selesai' => $this->input->post('tanggal_selesai', TRUE),
				'lama_cuti' => $this->input->post('lama_cuti', TRUE),
				'sisa_cuti' => $this->input->post('sisa_cuti', TRUE),
				'alasan' => $this->input->post('alasan', TRUE),
				'id_persetujuan' => $this->input->post('id_persetujuan', TRUE),
				'catatan_pimpinan' => $this->input->post('catatan_pimpinan', TRUE),
			);

			$this->Cuti_model->update($this->input->post('id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('cuti'));
		}
	}

	public function delete($id)
	{
		$row = $this->Cuti_model->get_by_id($id);

		if ($row) {
			$this->Cuti_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('cuti'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('cuti'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
		$this->form_validation->set_rules('id_jenis_cuti', 'id jenis cuti', 'trim|required');
		$this->form_validation->set_rules('tanggal_pengajuan', 'tanggal pengajuan', 'trim|required');
		$this->form_validation->set_rules('tanggal_mulai', 'tanggal mulai', 'trim|required');
		$this->form_validation->set_rules('tanggal_selesai', 'tanggal selesai', 'trim|required');
		$this->form_validation->set_rules('lama_cuti', 'lama cuti', 'trim|required');
		$this->form_validation->set_rules('sisa_cuti', 'sisa cuti', 'trim|required');
		$this->form_validation->set_rules('alasan', 'alasan', 'trim|required');
		$this->form_validation->set_rules('id_persetujuan', 'id persetujuan', 'trim|required');
		$this->form_validation->set_rules('catatan_pimpinan', 'catatan pimpinan', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Cuti.php */
/* Location: ./application/controllers/Cuti.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-10-26 03:38:25 */
/* http://harviacode.com */
