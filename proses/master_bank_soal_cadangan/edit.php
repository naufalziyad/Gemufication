<?php
session_start();
require("../../config/database.php");
	$id_soal    	 = $_POST["id_soal"];
	$id_ujian    	 = $_POST["ujian"];
	$pertanyaan    	 = $_POST["pertanyaan"];
	$jenis_pilihan   = $_POST["jenis_pilihan"];
	$banyak_pilihan  = $_POST["banyak_pilihan"];
	$a    = $_POST["a"];
	$b    = $_POST["b"];
	$c    = $_POST["c"];
	$d    = $_POST["d"];
	$e    = $_POST["e"];
	$jawaban_benar   = $_POST["jawaban_benar"];
	if(empty($id_soal) || empty($id_ujian) || empty($pertanyaan) || empty($jenis_pilihan) || empty($banyak_pilihan) || empty($jawaban_benar)){
		header("location:../../?page=Bank Soal&error=empty");
	}else{
			$set = mysql_query("update bank_soal set id_ujian='$id_ujian',pertanyaan='$pertanyaan',jenis_pilihan='$jenis_pilihan',banyak_pilihan='$banyak_pilihan',a='$a',b='$b',c='$c',d='$d',e='$e',jawaban_benar='$jawaban_benar' where id='$id_soal'");
			if($set){
				$form1  = "<form method='POST' action='../../?page=Bank Soal&success=edit' id='alert'>";
				$form1 .= "<input type='hidden' name='success' value='edit'>";
				$form1 .= "<input type='hidden' name='page' value='Bank Soal'>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;
			}else{
				$form1  = "<form method='POST' action='../../?page=Bank Soal&success=edit' id='alert'>";
				$form1 .= "<input type='hidden' name='error' value='cant'>";
				$form1 .= "<input type='hidden' name='page' value='Bank Soal'>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;				
			}
	}
?>