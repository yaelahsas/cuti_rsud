<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function register($data) {
		$data['password'] = sha1($data['password']); 
        $this->db->insert('users', $data);
    }

	public function login($email,$password)
    {
		$query = $this->db->get_where('users', ['email' => $email]);
		$user = $query->row();

		// Verifikasi password dengan SHA-1
		if ($user && $user->password === sha1($password)) {
			return $user;
		} else {
			return false;
		}
    }
	
}
