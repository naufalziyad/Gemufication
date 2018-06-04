<?php
require("../config/database.php");
$nis      = $_POST["nis"];
$nama     = $_POST["nama"];
$password = md5($_POST["password"]);
$kelas    = $_POST["kelas"];
$email    = $_POST["email"];
if(empty($nis) || empty($nama) || empty($password) || empty($email)){
	header("location:sign_up.php?error=empty");
}else{
	$cek_query = mysql_query("select*from siswa where nis=$nis");
	$cek_array = mysql_fetch_array($cek_query);
	$cek_nis = $cek_array["nis"];
	if($nis != $cek_nis){
		mysql_query("insert into siswa(nis,nama_siswa,password,id_kelas,email) values('$nis','$nama','$password','15','$email')");
		header("location:signincadangan.php?success=signup");
	}else{
		header("location:sign_up.php?error=nis");
	}
}
?>