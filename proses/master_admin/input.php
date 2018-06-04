<?php
session_start();
	require("../../config/database.php");
	$nama    	  = $_POST["nama"];
	$username     = $_POST["username"];
	$password     = md5($_POST["password"]);
	if(empty($nama) || empty($username) || empty($password)){
		header("location:../../?page=Admin&error=empty");
	}else{
		$cek_query = mysql_query("select*from admin where username='$username' and password='$password'");
		$cek_array = mysql_fetch_array($cek_query);
		$cek = $cek_array["id"];
		if(empty($cek)){
			$set = mysql_query("insert into admin(nama,username,password) values('$nama','$username','$password')");
			if($set){
				header("location:../../?page=Admin&success=input");
			}else{
				header("location:../../?page=Admin&error=cant");
			}
		}else{
			header("location:../../?page=Admin&error=same");
		}
	}
?>