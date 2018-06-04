<?php
session_start();
require("../../config/database.php");
$id     = $_GET["id"];


		$set = mysql_query("delete from hasil_ujian where id='$id'")or die(mysql_error());
			if($set){
				$form1  = "<form method='POST' action='../../' id='alert'>";
				$form1 .= "<input type='hidden' name='success' value='delete'>";
				$form1 .= "<input type='hidden' name='page' value='Laporan'>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;
			}else{
				$form1  = "<form method='POST' action='../../' id='alert'>";
				$form1 .= "<input type='hidden' name='error' value='cant'>";
				$form1 .= "<input type='hidden' name='page' value='Laporan'>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;				
			}

?>