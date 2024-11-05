<?php
class Fungsi
{
	protected $ci;
	function __construct()
	{
		$this->ci = &get_instance();
	}

	function user_login()
	{
		$this->ci->load->model('Users_model');
		$user_id = $this->ci->session->userdata('user');
		$user_data = $this->ci->Users_model->get_by_id($user_id->id);
		return $user_data;
	}

	function getNotification()
	{
		$this->ci->load->model('Persetujuan_model');
		$user_id = $this->ci->session->userdata('user')->id; // ID user dari session
		$pending_cuti = $this->ci->Persetujuan_model->get_pending_cuti_by_pimpinan($user_id);
		// Set data notifikasi global
		$data['notif_count'] = count($pending_cuti);
		$data['pending_cuti'] = $pending_cuti;

		return $data;
	}

	function PdfGenerator($html, $filename, $paper, $orientation)
	{
		$dompdf = new Dompdf\Dompdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper($paper, $orientation);
		$dompdf->render();
		$dompdf->stream($filename, array('Attachment' => 0));
	}
}
