<?php
function allowed($param, $param2 = null)
{
	$CI = &get_instance();
	$role = $CI->session->userdata('role');
	if ($role == null) {
		if ($param != null && $param2 != null) {
			$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda harus login terlebih dahulu", "danger", "fa fa-exclamation")</script>');
			redirect(base_url('admin/login'));
		} else {
			if ($param == 'admin') {
				$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Harus Login Sebagai Admin", "danger", "fa fa-exclamation")</script>');
				redirect(base_url('admin/login'));
			} else {
				$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Harus Login", "danger", "fa fa-exclamation")</script>');
				redirect(base_url());
			}
		}
	}elseif ($role != $param && $param2 == null) {
		if ($param == 'admin') {
			$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Harus Login Sebagai Admin", "danger", "fa fa-exclamation")</script>');
			redirect(base_url('admin/login'));
		}
	}
}
