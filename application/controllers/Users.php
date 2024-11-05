<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Users extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('Users_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');

		$this->load->model('Role_model');
	}

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('users/users_list');
		$this->load->view('template/footer');
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Users_model->json();
	}

	public function read($id)
	{
		$row = $this->Users_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'id_role' => $row->id_role,
				'username' => $row->username,
				'email' => $row->email,
				'password' => $row->password,
				'nama' => $row->nama,
			);
			$this->load->view('users/users_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('users'));
		}
	}

	public function create()
	{
		$roles = $this->Role_model->get_all(); // Ambil semua data role dari tabel role

		$data = array(
			'button' => 'Create',
			'action' => site_url('users/create_action'),
			'id' => set_value('id'),
			'id_role' => set_value('id_role'),
			'username' => set_value('username'),
			'email' => set_value('email'),
			'password' => set_value('password'),
			'nama' => set_value('nama'),
			'roles' => $roles, // Kirim data role ke view
		);
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('users/users_form', $data);
		$this->load->view('template/footer');
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'id_role' => $this->input->post('id_role', TRUE),
				'username' => $this->input->post('username', TRUE),
				'email' => $this->input->post('email', TRUE),
				'password' => sha1($this->input->post('password', TRUE)),
				'nama' => $this->input->post('nama', TRUE),
			);

			$this->Users_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('users'));
		}
	}

	public function update($id)
	{
		$row = $this->Users_model->get_by_id($id);
		$roles = $this->Role_model->get_all(); // Ambil semua data role dari tabel role


		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('users/update_action'),
				'id' => set_value('id', $row->id),
				'id_role' => set_value('id_role', $row->id_role),
				'username' => set_value('username', $row->username),
				'email' => set_value('email', $row->email),
				'password' => set_value('password', $row->password),
				'nama' => set_value('nama', $row->nama),
				'roles' => $roles, // Kirim data role ke view

			);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/topbar');
			$this->load->view('users/users_form', $data);
			$this->load->view('template/footer');
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('users'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id', TRUE));
		} else {
			$data = array(
				'id_role' => $this->input->post('id_role', TRUE),
				'username' => $this->input->post('username', TRUE),
				'email' => $this->input->post('email', TRUE),
				'password' => $this->input->post('password', TRUE),
				'nama' => $this->input->post('nama', TRUE),
			);

			$this->Users_model->update($this->input->post('id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('users'));
		}
	}

	public function delete($id)
	{
		$row = $this->Users_model->get_by_id($id);

		if ($row) {
			$this->Users_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('users'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('users'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('id_role', 'id role', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-10-26 03:49:43 */
/* http://harviacode.com */
