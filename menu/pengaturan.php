<?php
session_start();
require("../config/database.php");
$title     = $_POST["title"];
$brand     = $_POST["brand"];

		$set = mysql_query("update  title set title='$title', brand='$brand' where id='1'");
			if($set){
				$form1  = "<form method='POST' action='../' id='alert'>";
				$form1 .= "<input type='hidden' name='success' value='pengaturan'>";
				$form1 .= "<input type='hidden' name='page' value=''>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;
			}else{
				$form1  = "<form method='POST' action='../' id='alert'>";
				$form1 .= "<input type='hidden' name='error' value='pengaturan'>";
				$form1 .= "<input type='hidden' name='page' value=''>";
				$form1 .= "</form>";
				
				$header  = "<script type=text/javascript>" ;
				$header .= "document.getElementById('alert').submit();";
				$header .= "</script>";
				echo $form1;
				echo $header;				
			}
?>