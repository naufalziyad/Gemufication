<?php
session_start();
require("../../config/database.php");
	$id_matpel    	 = $_POST["matpel"];
	$id_ujian    	 = $_POST["id_ujian"];
	$nama    	     = $_POST["nama"];
	$waktu    		 = $_POST["waktu"];
	$text_pembuka    = $_POST["text_pembuka"];
	$id_guru    	 = $_POST["id_guru"];
	$jumlah_soal     = $_POST["jumlah_soal"];
	if(empty($id_matpel) || empty($jumlah_soal) || empty($nama) || empty($waktu) || empty($text_pembuka) || empty($id_ujian)){
		header("location:../../?page=Ujian&error=empty");
	}else{
			$set = mysql_query("update ujian set id_matpel='$id_matpel',nama_ujian='$nama',text_pembuka='$text_pembuka',waktu='$waktu',jml_soal='$jumlah_soal' where id='$id_ujian'");
			if($set){
				header("location:../../?page=Ujian&success=edit");
			}else{
				header("location:../../?page=Ujian&error=cant");
			}
	}
?>