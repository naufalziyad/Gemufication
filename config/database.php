<?php 
date_default_timezone_set("asia/jakarta");
$host	  = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "db_ujian"; 
$connect=mysql_connect($host,$username,$password)or die("<script>alert('Koneksi Gagal');</script>"); 
mysql_select_db($database)or die("<script>alert('Koneksi ke Database gagal');</script>"); 
?>