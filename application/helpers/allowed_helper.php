<?php
function allowed($param, $param2 = null)
{
	$CI = &get_instance();
	$role = $CI->session->userdata('role');
	if ($role == $param || $role == $param2) {
	} else {
		if ($param == 'admin') {
			$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Harus Login Terlebih Dahulu", "danger", "fa fa-exclamation")</script>');
			redirect(base_url('admin/login'));
		} else {
			$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Harus Login Sebagai Pelanggan", "danger", "fa fa-exclamation")</script>');

			redirect(base_url());
		}
	}
}
