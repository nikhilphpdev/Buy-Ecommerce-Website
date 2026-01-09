<?php
// vendor Url
function get_template_directory(){
	global $conn;
	$path = "https://testing.buyjee.com/vendor/";
	return $path;
}
// subvendor Url
function get_template_directory_subvendor(){
	global $conn;
	$path = "https://testing.buyjee.com/subvendor/";
	return $path;
}

// Admin URL
function get_template_directory_admin(){
	global $conn;
	$path = "https://testing.buyjee.com/admin/";
	return $path;
}

// Home URL
function get_template_directory_main(){
	global $conn;
	$path = "https://testing.buyjee.com/";
	return $path;
}
?>