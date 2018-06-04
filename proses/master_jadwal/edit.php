<?php
session_start();
require("../../config/database.php");
	$id_jadwal    	 = $_POST["id_jadwal"];
	$id_ujian    	 = $_POST["ujian"];
	$id_kelas    	 = $_POST["kelas"];
	$tgl		     = $_POST["tgl"];
	
	if(empty($id_jadwal) || empty($id_ujian) || empty($id_kelas) || empty($tgl)){
		header("location:../../?page=Jadwal&error=empty");
	}else{
		$cek_query = mysql_query("select*from jadwal where id_ujian='$id_ujian' and id_kelas='$id_kelas' and tgl='$tgl' and id != $id_jadwal");
		$cek_array = mysql_fetch_array($cek_query);
		$cek = $cek_array["id"];
		if(empty($cek)){
			$set = mysql_query("update jadwal set id_ujian='$id_ujian',id_kelas='$id_kelas',tgl='$tgl' where id='$id_jadwal'");
			if($set){
				$form1  = "<form method='POST' action='../../' id='alert'>";
				$form1 .= "<input type='hidden' name='success' value='edit'>";
				$form1 .= "<input type='hidden' name='page' value='Jadwal'>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;
			}else{
				$form1  = "<form method='POST' action='../../' id='alert'>";
				$form1 .= "<input type='hidden' name='error' value='cant'>";
				$form1 .= "<input type='hidden' name='page' value='Jadwal'>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;				
			}
		}else{
			header("location:../../?page=Jadwal&error=same");
		}	
	}
?>