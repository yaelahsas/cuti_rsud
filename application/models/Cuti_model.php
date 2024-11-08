<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Cuti_model extends CI_Model
{

	public $table = 'cuti';
	public $id = 'id';
	public $order = 'DESC';

	function __construct()
	{
		parent::__construct();
	}

	// datatables
	public function json()
	{
		$this->datatables->select('cuti.id, users.username as nama_user, jenis_cuti.nama_jenis_cuti, cuti.tanggal_pengajuan, cuti.tanggal_mulai, cuti.tanggal_selesai, cuti.lama_cuti, cuti.sisa_cuti, cuti.alasan, cuti.id_persetujuan, cuti.catatan_pimpinan');
		$this->datatables->from('cuti');

		// Join tabel 'users' dan 'jenis_cuti' dengan 'cuti'
		$this->datatables->join('users', 'cuti.id_user = users.id', 'left');
		$this->datatables->join('jenis_cuti', 'cuti.id_jenis_cuti = jenis_cuti.id', 'left');

		// Menambahkan kolom 'action' dengan tombol Edit dan Delete
		$this->datatables->add_column(
			'action',
			anchor(site_url('cuti/update/$1'), '<button class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Edit</button>') . " " .
				anchor(site_url('cuti/delete/$1'), '<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>', 'onclick="return confirm(\'Are you sure?\')"'),
			'id'
		);

		return $this->datatables->generate();
	}
	public function json_pegawai()
	{
		// Mendapatkan id_user dari sesi login
		$id_user = $this->session->userdata('user')->id;

		$this->datatables->select("
        cuti.id,
        users.username as nama_user,
        jenis_cuti.nama_jenis_cuti,
        cuti.tanggal_pengajuan,
        cuti.tanggal_mulai,
        cuti.tanggal_selesai,
        cuti.lama_cuti,
        cuti.sisa_cuti,
        cuti.alasan,
        cuti.id_persetujuan,
        cuti.catatan_pimpinan,
        CASE
            WHEN ps.status_pimpinan1 = 'pending' OR ps.status_pimpinan2 = 'pending' OR ps.status_pimpinan3 = 'pending' THEN 'pending'
            WHEN ps.status_pimpinan1 = 'disetujui' AND ps.status_pimpinan2 = 'disetujui' AND ps.status_pimpinan3 = 'disetujui' THEN 'disetujui'
            ELSE 'proses'
        END AS status_pengajuan
    ");
		$this->datatables->from('cuti');

		// Join tabel 'users', 'jenis_cuti', dan 'persetujuan' dengan 'cuti'
		$this->datatables->join('users', 'cuti.id_user = users.id', 'left');
		$this->datatables->join('jenis_cuti', 'cuti.id_jenis_cuti = jenis_cuti.id', 'left');
		$this->datatables->join('persetujuan ps', 'cuti.id_persetujuan = ps.id', 'left');

		// Menambahkan filter untuk hanya menampilkan data sesuai id_user yang sedang login
		$this->datatables->where('cuti.id_user', $id_user);

		// Menambahkan kolom 'action' dengan tombol Edit, Delete, dan Cetak
		$this->datatables->add_column(
			'action',
			anchor(site_url('cuti/update/$1'), '<button class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Edit</button>') . " " .
				anchor(site_url('cuti/delete/$1'), '<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>', 'onclick="return confirm(\'Are you sure?\')"') . " " .
				anchor(site_url('cuti/detail/$1'), '<button class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Cetak</button>'),
			'id'
		);

		return $this->datatables->generate();
	}


	public function get_cuti_by_id($cuti_id)
	{
		$this->db->select("
		cuti.id,
		cuti.tanggal_pengajuan,
		cuti.tanggal_mulai,
		cuti.tanggal_selesai,
		cuti.lama_cuti,
		cuti.sisa_cuti,
		cuti.alasan,
		cuti.id_jenis_cuti,
		jenis_cuti.nama_jenis_cuti as jenis_cuti_nama,
		pengaju_user.nama as nama_pengaju,
		pengaju_pegawai.nip as nip_pengaju,
		pengaju_pegawai.alamat as alamat,
		pengaju_pegawai.telepon as telepon,
		jabatan.nama_jabatan as jabatan_pengaju,
		pengaju_user.email as email_pengaju,
		pimpinan1_user.nama as nama_pimpinan1,
		pimpinan1_pegawai.nip as nip_pimpinan1,
		pimpinan2_user.nama as nama_pimpinan2,
		pimpinan2_pegawai.nip as nip_pimpinan2,
		pimpinan3_user.nama as nama_pimpinan3,
		pimpinan3_pegawai.nip as nip_pimpinan3,

	");
	$this->db->from('cuti');
	
	// JOIN ke tabel jenis_cuti
	$this->db->join('jenis_cuti', 'cuti.id_jenis_cuti = jenis_cuti.id', 'left');
	
	// JOIN ke tabel users dan pegawai untuk mendapatkan data pengaju cuti
	$this->db->join('users as pengaju_user', 'cuti.id_user = pengaju_user.id', 'left');
	$this->db->join('pegawai as pengaju_pegawai', 'cuti.id_user = pengaju_pegawai.id_user', 'left');
	$this->db->join('jabatan', 'pengaju_pegawai.id_jabatan = jabatan.id', 'left');
	
	// JOIN ke tabel persetujuan
	$this->db->join('persetujuan', 'cuti.id_persetujuan = persetujuan.id', 'left');
	
	// JOIN ke tabel pegawai untuk pimpinan 1, 2, dan 3
	$this->db->join('pegawai as pimpinan1_pegawai', 'persetujuan.id_pimpinan1 = pimpinan1_pegawai.id', 'left');
	$this->db->join('pegawai as pimpinan2_pegawai', 'persetujuan.id_pimpinan2 = pimpinan2_pegawai.id', 'left');
	$this->db->join('pegawai as pimpinan3_pegawai', 'persetujuan.id_pimpinan3 = pimpinan3_pegawai.id', 'left');
	
	// JOIN ke tabel users untuk mendapatkan nama pimpinan 1, 2, dan 3
	$this->db->join('users as pimpinan1_user', 'pimpinan1_pegawai.id_user = pimpinan1_user.id', 'left');
	$this->db->join('users as pimpinan2_user', 'pimpinan2_pegawai.id_user = pimpinan2_user.id', 'left');
	$this->db->join('users as pimpinan3_user', 'pimpinan3_pegawai.id_user = pimpinan3_user.id', 'left');
	
	$this->db->where('cuti.id', $cuti_id);
	$query = $this->db->get();
	return $query->row();
	
	}

	// get all
	function get_all()
	{
		$this->db->order_by($this->id, $this->order);
		return $this->db->get($this->table)->result();
	}

	// get data by id
	function get_by_id($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row();
	}

	// get total rows
	function total_rows($q = NULL)
	{
		$this->db->like('id', $q);
		$this->db->or_like('id_user', $q);
		$this->db->or_like('id_jenis_cuti', $q);
		$this->db->or_like('tanggal_pengajuan', $q);
		$this->db->or_like('tanggal_mulai', $q);
		$this->db->or_like('tanggal_selesai', $q);
		$this->db->or_like('lama_cuti', $q);
		$this->db->or_like('sisa_cuti', $q);
		$this->db->or_like('alasan', $q);
		$this->db->or_like('id_persetujuan', $q);
		$this->db->or_like('catatan_pimpinan', $q);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	// get data with limit and search
	function get_limit_data($limit, $start = 0, $q = NULL)
	{
		$this->db->order_by($this->id, $this->order);
		$this->db->like('id', $q);
		$this->db->or_like('id_user', $q);
		$this->db->or_like('id_jenis_cuti', $q);
		$this->db->or_like('tanggal_pengajuan', $q);
		$this->db->or_like('tanggal_mulai', $q);
		$this->db->or_like('tanggal_selesai', $q);
		$this->db->or_like('lama_cuti', $q);
		$this->db->or_like('sisa_cuti', $q);
		$this->db->or_like('alasan', $q);
		$this->db->or_like('id_persetujuan', $q);
		$this->db->or_like('catatan_pimpinan', $q);
		$this->db->limit($limit, $start);
		return $this->db->get($this->table)->result();
	}

	// insert data
	function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

	// update data
	function update($id, $data)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->table, $data);
	}

	// delete data
	function delete($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
	}
}

/* End of file Cuti_model.php */
/* Location: ./application/models/Cuti_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-10-26 03:38:25 */
/* http://harviacode.com */
