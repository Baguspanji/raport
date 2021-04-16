<?php
function allowed($param, $param2 = null, $param3 = null)
{
	$CI = &get_instance();
	$role = $CI->session->userdata('role');
	if ($role == null) {
		$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda harus login terlebih dahulu", "danger", "fa fa-exclamation")</script>');
		redirect(base_url('admin/login'));
	// } else
	// if ($role != $param && $param2 == null) {
	// 	if ($param == 'admin') {
	// 		$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Harus Login Sebagai Admin", "danger", "fa fa-exclamation")</script>');
	// 		redirect(base_url('admin/login'));
	// 	}
	} elseif ($role != $param2 && $role != $param && $role != $param3) {
		if ($param == 'admin') {
			$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Harus Login Sebagai Admin", "danger", "fa fa-exclamation")</script>');
			redirect(base_url('admin/login'));
		}
	}
}
