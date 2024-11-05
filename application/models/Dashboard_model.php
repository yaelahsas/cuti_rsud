<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	public function json()
	{
		// Ambil ID pegawai dari user yang login
		$user_id = $this->session->userdata('user')->id; // Misalnya ID user disimpan di session
		$this->db->select('id');
		$this->db->where('id_user', $user_id);
		$pegawai = $this->db->get('pegawai')->row(); // Ambil data pegawai

		if (!$pegawai) {
			// Jika tidak ada pegawai ditemukan, kembalikan response kosong
			return json_encode([]);
		}

		$id_pegawai = $pegawai->id; // Dapatkan ID pegawai

		// Membangun query untuk DataTables
		$this->datatables->select('cuti.id, users.username AS nama_user, jenis_cuti.nama_jenis_cuti, cuti.tanggal_pengajuan, cuti.tanggal_mulai, cuti.tanggal_selesai, cuti.lama_cuti, cuti.sisa_cuti, cuti.alasan, cuti.id_persetujuan, cuti.catatan_pimpinan, ps.status_pimpinan1, ps.status_pimpinan2, ps.status_pimpinan3');
		$this->datatables->from('cuti');

		// Join tabel 'users', 'jenis_cuti', dan 'persetujuan' dengan 'cuti'
		$this->datatables->join('users', 'cuti.id_user = users.id', 'left');
		$this->datatables->join('jenis_cuti', 'cuti.id_jenis_cuti = jenis_cuti.id', 'left');
		$this->datatables->join('persetujuan ps', 'cuti.id_persetujuan = ps.id', 'left');

		// Menambahkan filter untuk ID persetujuan berdasarkan ID pegawai
		$this->datatables->where("cuti.id_persetujuan IN (SELECT id FROM persetujuan WHERE id_pimpinan1 = $id_pegawai OR id_pimpinan2 = $id_pegawai OR id_pimpinan3 = $id_pegawai)");

		// Menambahkan kolom 'action' dengan tombol Edit dan Delete
		$this->datatables->add_column(
			'action',
			anchor(site_url('cuti/update/$1'), '<button class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Edit</button>') . " " .
				anchor(site_url('cuti/delete/$1'), '<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>', 'onclick="return confirm(\'Are you sure?\')"'),
			'id'
		);

		return $this->datatables->generate();
	}

	// Fungsi untuk mendapatkan label status pimpinan
	public function getStatusPimpinan($status)
	{
		switch ($status) {
			case 'pending':
				return '<span class="badge badge-warning">Pending</span>';
			case 'disetujui':
				return '<span class="badge badge-success">Disetujui</span>';
			case 'ditolak':
				return '<span class="badge badge-danger">Ditolak</span>';
			default:
				return '<span class="badge badge-secondary">Tidak Diketahui</span>';
		}
	}
}
