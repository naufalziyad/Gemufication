<?php
session_start();
require("../../config/database.php");
	$id_matpel 	  = $_POST["id_matpel"];
	$nama_matpel  = $_POST["nama_matpel"];
	$before_matpel  = $_POST["before_matpel"];
	$before_kelas     = $_POST["before_kelas"];
	$id_kelas     = $_POST["kelas"];
	$kkm    	  = $_POST["kkm"];
	if(empty($nama_matpel) || empty($id_kelas) || empty($kkm)){
		header("location:../../?page=Kategori&error=empty");
	}else{
		if($nama_matpel != $before_matpel and $id_kelas != $before_kelas){
			$cek_query = mysql_query("select*from matpel where nama_matpel='$nama_matpel' and id_kelas='$id_kelas'");
			$cek_array = mysql_fetch_array($cek_query);
			$cek = $cek_array["id"];
		}	
			if(empty($cek)){
				$set = mysql_query("update matpel set id_kelas='$id_kelas', nama_matpel='$nama_matpel', kkm='$kkm' where id='$id_matpel'");
				if($set){
					header("location:../../?page=Kategori&success=edit");
				}else{
					header("location:../../?page=Kategori&error=cant");
				}
			}else{
				header("location:../../?page=Kategori&error=same");
			}
	}
?>