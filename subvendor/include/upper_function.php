<?php
require_once("session.php");
//include_once('../config_db/conn_connect.php');

$conn = conndata();

date_default_timezone_set('Asia/Kolkata');

$session_login = $_SESSION['subvendorsessionlogin'];

function fullnameval(){
	global $conn;
	global $session_login;

	$vender_name = "SELECT * FROM subvendor WHERE subvendor_auto='$session_login' LIMIT 1";
	$quweryname = mysqli_query($conn,$vender_name);
	while($rowname = mysqli_fetch_array($quweryname)){
		$fname_val = $rowname['subvendor_fname'];
		$lname_val = $rowname['subvendor_lname'];
		$full_name = $fname_val.' '.$lname_val;

		return $full_name;
	}
}

function getsubvendrurl(){
	global $conn;
	global $session_login;

	$subvenderurl = "SELECT * FROM subvendor WHERE subvendor_auto='$session_login' LIMIT 1";

	$aueryurl = mysqli_query($conn,$subvenderurl);
	while($rowurlval = mysqli_fetch_array($aueryurl)){
		$urlnameval = $rowurlval['vendor_uni_name'];
	}

	return $urlnameval;
}
?>