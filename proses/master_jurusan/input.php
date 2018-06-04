<?php
session_start();
	require("../../config/database.php");
	$nama_jurusan     = $_POST["jurusan"];
	if(empty($nama_jurusan)){
		header("location:../../?page=Server&error=empty");
	}else{
		$cek_query = mysql_query("select*from jurusan where nama_jurusan='$nama_jurusan'");
		$cek_array = mysql_fetch_array($cek_query);
		$cek = $cek_array["nama_jurusan"];
		if($nama_jurusan != $cek){
			$set = mysql_query("insert into jurusan(nama_jurusan) values('$nama_jurusan')");
			if($set){
				header("location:../../?page=Server&success=input");
			}else{
				header("location:../../?page=Server&error=cant");
			}
		}else{
			header("location:../../?page=Server&error=same");
		}
	}
?>