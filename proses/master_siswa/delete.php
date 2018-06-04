<?php
session_start();
require("../../config/database.php");
$id     = $_GET["id"];

				$cek_query_hasil_ujian = mysql_query("select*from hasil_ujian where id_siswa='$id'");
				$cek_query_hasil_jawaban = mysql_query("select*from hasil_jawaban where id_siswa='$id'");
				while($cek_array_hasil_ujian = mysql_fetch_array($cek_query_hasil_ujian)){
					$id_hasil_ujian = $cek_array_hasil_ujian[id];
					mysql_query("delete from hasil_ujian where id='$id_hasil_ujian'");
				}
				while($cek_array_hasil_jawaban = mysql_fetch_array($cek_query_hasil_jawaban)){
					$id_hasil_jawaban = $cek_array_hasil_jawaban[id];
					mysql_query("delete from hasil_jawaban where id='$id_hasil_jawaban'");
				}
				
		$set = mysql_query("delete from siswa where id='$id'");
			if($set){
				$form1  = "<form method='POST' action='../../' id='alert'>";
				$form1 .= "<input type='hidden' name='success' value='delete'>";
				$form1 .= "<input type='hidden' name='page' value='Member'>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;
			}else{
				$form1  = "<form method='POST' action='../../' id='alert'>";
				$form1 .= "<input type='hidden' name='error' value='cant'>";
				$form1 .= "<input type='hidden' name='page' value='Member'>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;				
			}

?>