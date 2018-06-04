<?php
session_start();
require("../config/database.php");
$user_type = $_POST["user_type"];
$username      = $_POST["username"];
$password  = md5($_POST["password"]);

if(empty($user_type) || empty($username) || empty($password)){
	header("location:signincadangan.php?error=empty");
}else{
	if($user_type == "admin"){
		$cek_query = mysql_query("select*from admin where username='$username' and password='$password'");
		$cek_array = mysql_fetch_array($cek_query);
		$id = $cek_array["id"];
		if(!empty($id)){
			$_SESSION["admin"] = $id;
			header("location:..");
		}else{
			header("location:signincadangan.php?error=wrong");
		}
	}
	else if($user_type == "siswa"){
		$cek_query = mysql_query("select*from siswa where nis='$username' and password='$password'");
		$cek_array = mysql_fetch_array($cek_query);
		$id = $cek_array["id"];
		if(!empty($id)){
			$_SESSION["siswa"] = $id;
			header("location:../index2.php");
		}else{
			header("location:signincadangan.php?error=wrong");
		}
	}
	else{
		header("location:signincadangan.php?error=wrong");
	}
}
?>