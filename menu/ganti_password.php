<?php
session_start();
require("../config/database.php");
$user_type = $_POST["user_type"];
$id_user      = $_POST["id_user"];
$old_password  = $_POST["old_password"];
$new_password  = $_POST["new_password"];

$old_password_md5  = md5($_POST["old_password"]);
$new_password_md5  = md5($_POST["new_password"]);

if(empty($old_password) || empty($new_password)){
	header("location:../?error=ganti_password");
}else{
	if($user_type == "admin"){
		$cek_query = mysql_query("select*from admin where id='$id_user' and password='$old_password_md5'");
		$cek_array = mysql_fetch_array($cek_query);
		$id = $cek_array["id"];
		if(!empty($id)){
			mysql_query("update admin set password='$new_password_md5' where id='$id'");
			header("location:../?success=ganti_password");
		}else{
			header("location:../?error=ganti_password");
		}
	}
	else if($user_type == "guru"){
		$cek_query = mysql_query("select*from guru where id='$id_user' and password='$old_password_md5'");
		$cek_array = mysql_fetch_array($cek_query);
		$id = $cek_array["id"];
		if(!empty($id)){
			mysql_query("update guru set password='$new_password_md5' where id='$id'");
			header("location:../?success=ganti_password");
		}else{
			header("location:../?error=ganti_password");
		}
	}
	else if($user_type == "siswa"){
		$cek_query = mysql_query("select*from siswa where id='$id_user' and password='$old_password_md5'");
		$cek_array = mysql_fetch_array($cek_query);
		$id = $cek_array["id"];
		if(!empty($id)){
			mysql_query("update siswa set password='$new_password_md5' where id='$id'");
			header("location:../?success=ganti_password");
		}else{
			header("location:../?error=ganti_password");
		}
	}
	else{
		header("location:signincadangan.php?error=ganti_password");
	}
}
?>