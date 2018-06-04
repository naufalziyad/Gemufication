<?php
session_start();
	require("../../config/database.php");
	$nama_matpel     = $_POST["nama_matpel"];
	$id_kelas     = $_POST["kelas"];
	$kkm     = $_POST["kkm"];
	if(empty($nama_matpel) || empty($id_kelas) || empty($kkm)){
		header("location:../../?page=Kategori&error=empty");
	}else{
		$cek_query = mysql_query("select*from matpel where nama_matpel='$nama_matpel' and id_kelas='$id_kelas'");
		$cek_array = mysql_fetch_array($cek_query);
		$cek = $cek_array["id"];
		if(empty($cek)){
			$set = mysql_query("insert into matpel(id_kelas,nama_matpel,kkm) values('$id_kelas','$nama_matpel','$kkm')");
			if($set){
				header("location:../../?page=Kategori&success=input");
			}else{
				header("location:../../?page=Kategori&error=cant");
			}
		}else{
			header("location:../../?page=Kategori&error=same");
		}
	}
?>