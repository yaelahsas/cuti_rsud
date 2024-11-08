<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Persetujuan_model extends CI_Model
{

	public $table = 'persetujuan';
	public $id = 'id';
	public $order = 'DESC';

	function __construct()
	{
		parent::__construct();
	}

	// datatables
	function json()
	{
		$this->datatables->select('id,id_cuti,id_jenis_cuti,id_pimpinan1,id_pimpinan2,id_pimpinan3,status_pimpinan1,status_pimpinan2,status_pimpinan3,tanggal_persetujuan');
		$this->datatables->from('persetujuan');
		//add this line for join
		//$this->datatables->join('table2', 'persetujuan.field = table2.field');
		$this->datatables->add_column('action', anchor(site_url('persetujuan/read/$1'), 'Read') . " | " . anchor(site_url('persetujuan/update/$1'), 'Update') . " | " . anchor(site_url('persetujuan/delete/$1'), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
		return $this->datatables->generate();
	}


	public function get_pending_cuti_by_pimpinan($user_id)
	{
		// Tentukan kondisi berdasarkan peran pimpinan
		$status_condition = '';
		if ($this->is_pimpinan1($user_id)) {
			$status_condition = "ps.status_pimpinan1 = 'pending'";
		} elseif ($this->is_pimpinan2($user_id)) {
			$status_condition = "ps.status_pimpinan2 = 'pending'";
		} elseif ($this->is_pimpinan3($user_id)) {
			$status_condition = "ps.status_pimpinan3 = 'pending'";
		}

		// Buat query SQL dengan kondisi status yang sesuai
		$query = "
			SELECT u.nama AS nama_user, c.tanggal_pengajuan AS cuti_pengajuan
			FROM pegawai p
			JOIN persetujuan ps ON p.id = ps.id_pimpinan1 OR p.id = ps.id_pimpinan2 OR p.id = ps.id_pimpinan3
			JOIN cuti c ON ps.id = c.id_persetujuan
			JOIN users u ON c.id_user = u.id
			WHERE p.id_user = ? AND $status_condition
		";

		// Jalankan query dengan binding parameter
		$result = $this->db->query($query, [$user_id]);
		return $result->result(); // Mengembalikan array hasil query
	}
	public function get_cuti_by_pegawai($user_id)
	{
		// Query untuk mengambil data cuti yang diajukan oleh pegawai tertentu
		// Query untuk menghitung jumlah cuti dengan status "pending" dari pimpinan1, pimpinan2, atau pimpinan3
		$query = "
			SELECT COUNT(*) AS pending_count
			FROM pegawai p
			JOIN cuti c ON p.id = c.id_user
			JOIN persetujuan ps ON ps.id = c.id_persetujuan
			WHERE p.id_user = ?
				AND (ps.status_pimpinan1 = 'pending' 
					OR ps.status_pimpinan2 = 'pending' 
					OR ps.status_pimpinan3 = 'pending')
		
		";

		// Jalankan query dan ambil hasilnya
		$result = $this->db->query($query, [$user_id]);
		return $result->result(); // Mengembalikan array hasil query
	}

	private function is_pimpinan1($user_id)
	{
		$this->db->where('users.id', $user_id); // Spesifik untuk id tabel users
		$this->db->where('users.id_role', 3);
		$query = $this->db->get('users');

		return $query->num_rows() > 0;
	}

	private function is_pimpinan2($user_id)
	{
		$this->db->where('users.id', $user_id);
		$this->db->where('users.id_role', 4);
		$query = $this->db->get('users');

		return $query->num_rows() > 0;
	}

	private function is_pimpinan3($user_id)
	{
		$this->db->where('users.id', $user_id);
		$this->db->where('users.id_role', 5);
		$query = $this->db->get('users');

		return $query->num_rows() > 0;
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
		$this->db->or_like('id_cuti', $q);
		$this->db->or_like('id_jenis_cuti', $q);
		$this->db->or_like('id_pimpinan1', $q);
		$this->db->or_like('id_pimpinan2', $q);
		$this->db->or_like('id_pimpinan3', $q);
		$this->db->or_like('status_pimpinan1', $q);
		$this->db->or_like('status_pimpinan2', $q);
		$this->db->or_like('status_pimpinan3', $q);
		$this->db->or_like('tanggal_persetujuan', $q);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	// get data with limit and search
	function get_limit_data($limit, $start = 0, $q = NULL)
	{
		$this->db->order_by($this->id, $this->order);
		$this->db->like('id', $q);
		$this->db->or_like('id_cuti', $q);
		$this->db->or_like('id_jenis_cuti', $q);
		$this->db->or_like('id_pimpinan1', $q);
		$this->db->or_like('id_pimpinan2', $q);
		$this->db->or_like('id_pimpinan3', $q);
		$this->db->or_like('status_pimpinan1', $q);
		$this->db->or_like('status_pimpinan2', $q);
		$this->db->or_like('status_pimpinan3', $q);
		$this->db->or_like('tanggal_persetujuan', $q);
		$this->db->limit($limit, $start);
		return $this->db->get($this->table)->result();
	}

	// insert data
	function insert($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
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

/* End of file Persetujuan_model.php */
/* Location: ./application/models/Persetujuan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-10-26 03:48:44 */
/* http://harviacode.com */
