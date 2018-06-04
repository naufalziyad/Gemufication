<?php
session_start();
	require("../../config/database.php");
	$id_ujian    	 = $_POST["ujian"];
	$pertanyaan    	 = htmlspecialchars($_POST["pertanyaan"]);
	$jenis_jawaban   = $_POST["jenis_jawaban"];
	$banyak_pilihan  = $_POST["banyak_pilihan"];
	$id_guru    	 = $_POST["id_guru"];
	$a    			 = htmlspecialchars($_POST["a"], ENT_QUOTES);
	$b    			 = htmlspecialchars($_POST["b"], ENT_QUOTES);
	$c    			 = htmlspecialchars($_POST["c"], ENT_QUOTES);
	$d    			 = htmlspecialchars($_POST["d"], ENT_QUOTES);
	$e    			 = htmlspecialchars($_POST["e"], ENT_QUOTES);
	$jawaban_benar   = $_POST["jawaban_benar"];
	if(empty($id_ujian) || empty($pertanyaan) || empty($jenis_jawaban) || empty($banyak_pilihan) || empty($jawaban_benar)){
		header("location:../../?page=Bank Soal&error=empty");
	}else{
			$set = mysql_query("insert into bank_soal(id_guru,id_ujian,pertanyaan,a,b,c,d,e,banyak_pilihan,jenis_pilihan,jawaban_benar) values('$id_guru','$id_ujian','$pertanyaan','$a','$b','$c','$d','$e','$banyak_pilihan','$jenis_jawaban','$jawaban_benar')");
			if($set){
				header("location:../../?page=Bank Soal&success=input");
			}else{
				header("location:../../?page=Bank Soal&error=cant");
			}
	}
?>