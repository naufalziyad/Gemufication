<?php
session_start();
	require("../../config/database.php");
	$id_ujian    	 = $_POST["ujian"];
	$id_kelas    	 = $_POST["kelas"];
	$tgl   			 = $_POST["tgl"];
	if(empty($id_ujian) || empty($id_kelas) || empty($tgl)){
		header("location:../../?page=Jadwal&error=empty");
	}else{
		$cek_query = mysql_query("select*from jadwal where id_ujian='$id_ujian' and id_kelas='$id_kelas' and tgl='$tgl'");
		$cek_array = mysql_fetch_array($cek_query);
		$cek = $cek_array["id"];
		if(empty($cek)){
			$set = mysql_query("insert into jadwal(id_ujian,id_kelas,tgl) values('$id_ujian','$id_kelas','$tgl')");
			if($set){
				header("location:../../?page=Jadwal&success=input");
			}else{
				header("location:../../?page=Jadwal&error=cant");
			}
		}else{
			header("location:../../?page=Jadwal&error=same");
		}
	}
?>