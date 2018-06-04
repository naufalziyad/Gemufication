<?php
session_start();
require("../../config/database.php");
$id     = $_GET["id"];
					$cek_query_bank_soal = mysql_query("select*from bank_soal where id_ujian='$id'");
					$cek_query_hasil_ujian2 = mysql_query("select*from hasil_ujian where id_ujian='$id'");
					$cek_query_hasil_jawaban2 = mysql_query("select*from hasil_jawaban where id_ujian='$id'");
					$cek_query_jadwal = mysql_query("select*from jadwal where id_ujian='$id'");
					while($cek_array_jadwal = mysql_fetch_array($cek_query_jadwal)){
						$id_jadwal = $cek_array_jadwal[id];
						mysql_query("delete from jadwal where id='$id_jadwal'");
					}
					while($cek_array_bank_soal = mysql_fetch_array($cek_query_bank_soal)){
						$id_bank_soal = $cek_array_bank_soal[id];
						mysql_query("delete from bank_soal where id='$id_bank_soal'");
					}
					while($cek_array_hasil_ujian2 = mysql_fetch_array($cek_query_hasil_ujian2)){
						$id_hasil_ujian2 = $cek_array_hasil_ujian2[id];
						mysql_query("delete from hasil_ujian where id='$id_hasil_ujian2'");
					}
					while($cek_array_hasil_jawaban2 = mysql_fetch_array($cek_query_hasil_jawaban2)){
						$id_hasil_jawaban2 = $cek_array_hasil_jawaban2[id];
						mysql_query("delete from hasil_jawaban where id='$id_hasil_jawaban2'");
					}

		$set = mysql_query("delete from ujian where id='$id'");
			if($set){
				$form1  = "<form method='POST' action='../../' id='alert'>";
				$form1 .= "<input type='hidden' name='success' value='delete'>";
				$form1 .= "<input type='hidden' name='page' value='Ujian'>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;
			}else{
				$form1  = "<form method='POST' action='../../' id='alert'>";
				$form1 .= "<input type='hidden' name='error' value='cant'>";
				$form1 .= "<input type='hidden' name='page' value='Ujian'>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;				
			}
?>