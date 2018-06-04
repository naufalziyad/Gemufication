<?php
session_start();
require("../../config/database.php");
	$nama    	  = $_POST["nama"];
	$nis    	  = $_POST["nis"];
	$id_kelas     = $_POST["kelas"];
	$id_siswa      = $_POST["id_siswa"];
	$before_nis   = $_POST["before_nis"];
	$password     = md5($_POST["password"]);
	$password2    = $_POST["password2"];
	if(empty($nis) || empty($nama) || empty($password2) || empty($id_kelas)){
		header("location:../../?page=Member&error=empty");
	}else{
		if(empty($_POST["password"])){
			if($nis != $before_nis){
				$cek_query = mysql_query("select*from siswa where nis='$nis'");
				$cek_array = mysql_fetch_array($cek_query);
				$cek = $cek_array["id"];
			}
			if(empty($cek)){
				$set = mysql_query("update siswa set nis='$nis',nama_siswa='$nama', id_kelas='$id_kelas' where id='$id_siswa'");
				if($set){
					header("location:../../?page=Member&success=edit");
				}else{
					header("location:../../?page=Member&error=cant");
				}
			}else{
				header("location:../../?page=Member&error=same");
			}
		}else{
			if($nis != $before_nis){
				$cek_query = mysql_query("select*from siswa where nis='$nis'");
				$cek_array = mysql_fetch_array($cek_query);
				$cek = $cek_array["id"];
			}
			if(empty($cek)){
				$set = mysql_query("update siswa set nis='$nis',nama_siswa='$nama', id_kelas='$id_kelas', password='$password' where id='$id_siswa'");
				if($set){
					header("location:../../?page=Member&success=edit");
				}else{
					header("location:../../?page=Member&error=cant");
				}
			}else{
				header("location:../../?page=Member&error=same");
			}
		}
	}
?>