<?php
session_start();
	require("../../config/database.php");
	$nama    	  = $_POST["nama"];
	$nis    	  = $_POST["nis"];
	$id_kelas     = $_POST["kelas"];
	$password     = md5($_POST["password"]);
	if(empty($nama) || empty($nis) || empty($password)){
		header("location:../../?page=Member&error=empty");
	}else{
		$cek_query = mysql_query("select*from siswa where nis='$nis'");
		$cek_array = mysql_fetch_array($cek_query);
		$cek = $cek_array["id"];
		if(empty($cek)){
			$set = mysql_query("insert into siswa(nis,nama_siswa,id_kelas,password) values('$nis','$nama','$id_kelas','$password')");
			if($set){
				header("location:../../?page=Member&success=input");
			}else{
				header("location:../../?page=Member&error=cant");
			}
		}else{
			header("location:../../?page=Member&error=same");
		}
	}
?>