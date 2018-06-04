<?php
session_start();
require("../../config/database.php");
$id_jurusan     = $_POST["id_jurusan"];
$nama_jurusan     = $_POST["nama_jurusan"];
if(empty($nama_jurusan)){
	header("location:../../?page=Server&error=empty");
}else{
	$cek_query = mysql_query("select*from jurusan where nama_jurusan='$nama_jurusan'");
	$cek_array = mysql_fetch_array($cek_query);
	$cek = $cek_array["nama_jurusan"];
	if($nama_jurusan != $cek){
		$set = mysql_query("update jurusan set nama_jurusan='$nama_jurusan' where id='$id_jurusan'");
			if($set){
				header("location:../../?page=Server&success=edit");
			}else{
				header("location:../../?page=Server&error=cant");
			}
	}else{
		header("location:../../?page=Server&error=same");
	}
}
?>