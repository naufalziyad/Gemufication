<?php
session_start();
	require("../../config/database.php");
	$id_matpel    	 = $_POST["matpel"];
	$nama    	     = $_POST["nama"];
	$waktu    		 = $_POST["waktu"];
	$text_pembuka    = $_POST["text_pembuka"];
	$jumlah_soal     = $_POST["jumlah_soal"];
	$tanggal_input = date("Y-m-d");
	if(empty($id_matpel) || empty($jumlah_soal) || empty($nama) || empty($waktu) || empty($text_pembuka)){
		header("location:../../?page=Ujian&error=empty");
	}else{
			$set = mysql_query("insert into ujian(id_matpel,nama_ujian,id_guru,text_pembuka,waktu,tgl_input,jml_soal) values('$id_matpel','$nama','$id_guru','$text_pembuka','$waktu','$tanggal_input','$jumlah_soal')");
			if($set){
				header("location:../../?page=Ujian&success=input");
			}else{
				header("location:../../?page=Ujian&error=cant");
			}
	}
?>