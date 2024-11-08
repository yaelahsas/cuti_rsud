<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

use Dompdf\Dompdf;

class Cuti extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
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

	public function cetak($id)
	{
		// Ambil data cuti berdasarkan ID
		$data['cuti'] = $this->Cuti_model->get_cuti_by_id($id); // Asumsikan ada fungsi untuk mengambil data cuti berdasarkan ID
	
		// Load library dompdf
		$this->load->library('pdf');

		// Buat view untuk PDF dan masukkan data cuti
		$html = $this->load->view('cuti/pdf_template', $data, true);

		// Buat PDF
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A4', 'portrait');
		$this->pdf->render();

		// Unduh PDF dengan nama file tertentu
		$this->pdf->stream("cuti_" . $id . ".pdf", array("Attachment" => 1));
	}


	public function get_cuti_detail($cuti_id)
	{
		$this->db->select('cuti.*, users.username AS nama_user, jenis_cuti.nama_jenis_cuti, ps.status_pimpinan1, ps.status_pimpinan2, ps.status_pimpinan3');
		$this->db->from('cuti');
		$this->db->join('users', 'cuti.id_user = users.id', 'left');
		$this->db->join('jenis_cuti', 'cuti.id_jenis_cuti = jenis_cuti.id', 'left');
		$this->db->join('persetujuan ps', 'cuti.id_persetujuan = ps.id', 'left');
		$this->db->where('cuti.id', $cuti_id);

		$data = $this->db->get()->row();

		if ($data) {
			// Return HTML detail cuti sebagai response
			echo '<p><strong>Nama User:</strong> ' . $data->nama_user . '</p>';
			echo '<p><strong>Jenis Cuti:</strong> ' . $data->nama_jenis_cuti . '</p>';
			echo '<p><strong>Alasan:</strong> ' . $data->alasan . '</p>';
			echo '<p><strong>Status Pimpinan 1:</strong> ' . $data->status_pimpinan1 . '</p>';
			echo '<p><strong>Status Pimpinan 2:</strong> ' . $data->status_pimpinan2 . '</p>';
			echo '<p><strong>Status Pimpinan 3:</strong> ' . $data->status_pimpinan3 . '</p>';
		} else {
			echo '<p>Detail cuti tidak ditemukan.</p>';
		}
	}

	public function detail($cuti_id) {
        $data['cuti'] = $this->Cuti_model->get_cuti_by_id($cuti_id);

     // Load view dan convert ke HTML
		$html = $this->load->view('cuti/cuti_template', $data, TRUE);

		// Create instance Dompdf
		$dompdf = new Dompdf();
		$dompdf->loadHtml($html);
		// (Opsional) Mengatur ukuran kertas dan orientasi
		$dompdf->setPaper('F4', 'portrait'); // 'portrait' atau 'landscape'

		// Render PDF
		$dompdf->render();

		// Output the generated PDF (ke browser)
		$dompdf->stream("Pengajuan_Cuti.pdf", array("Attachment" => false));
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

	public function generate_pdf()
	{
		// Data yang akan diinput (bisa diambil dari form)
		$data = [
			'tanggal' => '22 Desember 2023',
			'nama' => 'Dhimas Panji Sastra',
			'nip' => '123456789101112',
			'jabatan' => 'Staff IT',
			'masa_kerja' => '1 thn 10 bln',
			'unit_kerja' => 'RSUD Genteng',
			'jenis_cuti' => 'Cuti Tahunan',
			'lama_cuti' => '10 Hari',
			'tanggal_mulai' => '22 Desember 2023',
			'tanggal_selesai' => '02 Januari 2024',
			'alamat' => 'Jember',
			'telepon' => '083853399847'
		];

		// Load view dan convert ke HTML
		$html = $this->load->view('cuti/cuti_template', $data, TRUE);

		// Create instance Dompdf
		$dompdf = new Dompdf();
		$dompdf->loadHtml($html);
		// (Opsional) Mengatur ukuran kertas dan orientasi
		$dompdf->setPaper('F4', 'portrait'); // 'portrait' atau 'landscape'

		// Render PDF
		$dompdf->render();

		// Output the generated PDF (ke browser)
		$dompdf->stream("Pengajuan_Cuti.pdf", array("Attachment" => false));
	}
}

/* End of file Cuti.php */
/* Location: ./application/controllers/Cuti.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-10-26 03:38:25 */
/* http://harviacode.com */
