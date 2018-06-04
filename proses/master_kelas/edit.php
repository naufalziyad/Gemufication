<?php
session_start();
require("../../config/database.php");
	$id_kelas 		= $_POST["id_kelas"];
	$nama_kelas     = $_POST["kelas"];
	$id_jurusan     = $_POST["jurusan"];
	if(empty($nama_kelas) || empty($id_jurusan)){
		header("location:../../?page=Level&error=empty");
	}else{
		$cek_query = mysql_query("select*from kelas where nama_kelas='$nama_kelas' and id_jurusan='$id_jurusan'");
		$cek_array = mysql_fetch_array($cek_query);
		$cek = $cek_array["id"];
		if(empty($cek)){
			$set = mysql_query("update kelas set id_jurusan='$id_jurusan', nama_kelas='$nama_kelas' where id='$id_kelas'");
			if($set){
				header("location:../../?page=Level&success=edit");
			}else{
				header("location:../../?page=Level&error=cant");
			}
		}else{
			header("location:../../?page=Level&error=same");
		}
	}
?>