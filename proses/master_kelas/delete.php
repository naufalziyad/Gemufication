<?php
session_start();
require("../../config/database.php");
$id     = $_GET["id"];

			$cek_query_siswa = mysql_query("select*from siswa where id_kelas='$id'");
			$cek_query_matpel = mysql_query("select*from matpel where id_kelas='$id'");
			while($cek_array_siswa = mysql_fetch_array($cek_query_siswa)){
				$id_siswa = $cek_array_siswa[id];
				$cek_query_hasil_ujian = mysql_query("select*from hasil_ujian where id_siswa='$id_siswa'");
				$cek_query_hasil_jawaban = mysql_query("select*from hasil_jawaban where id_siswa='$id_siswa'");
				while($cek_array_hasil_ujian = mysql_fetch_array($cek_query_hasil_ujian)){
					$id_hasil_ujian = $cek_array_hasil_ujian[id];
					mysql_query("delete from hasil_ujian where id='$id_hasil_ujian'");
				}
				while($cek_array_hasil_jawaban = mysql_fetch_array($cek_query_hasil_jawaban)){
					$id_hasil_jawaban = $cek_array_hasil_jawaban[id];
					mysql_query("delete from hasil_jawaban where id='$id_hasil_jawaban'");
				}
				mysql_query("delete from siswa where id='$id_siswa'");
			}
			while($cek_array_matpel = mysql_fetch_array($cek_query_matpel)){
				$id_matpel = $cek_array_matpel[id];
				$cek_query_ujian = mysql_query("select*from ujian where id_matpel='$id_matpel'");
				while($cek_array_ujian = mysql_fetch_array($cek_query_ujian)){
					$id_ujian = $cek_array_ujian[id];
					$cek_query_bank_soal = mysql_query("select*from bank_soal where id_ujian='$id_ujian'");
					$cek_query_hasil_ujian2 = mysql_query("select*from hasil_ujian where id_ujian='$id_ujian'");
					$cek_query_hasil_jawaban2 = mysql_query("select*from hasil_jawaban where id_ujian='$id_ujian'");
					$cek_query_jadwal = mysql_query("select*from jadwal where id_ujian='$id_ujian'");
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
					mysql_query("delete from ujian where id='$id_ujian'");
				}
				mysql_query("delete from matpel where id='$id_matpel'");
			}
			
			$set = mysql_query("delete from kelas where id='$id'");
			if($set){
				$form1  = "<form method='POST' action='../../' id='alert'>";
				$form1 .= "<input type='hidden' name='success' value='delete'>";
				$form1 .= "<input type='hidden' name='page' value='Level'>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;
			}else{
				$form1  = "<form method='POST' action='../../' id='alert'>";
				$form1 .= "<input type='hidden' name='error' value='cant'>";
				$form1 .= "<input type='hidden' name='page' value='Level'>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;				
			}

?>