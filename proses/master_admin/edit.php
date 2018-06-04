<?php
session_start();
require("../../config/database.php");
	$id_admin     = $_POST["id_admin"];
	$nama    	  = $_POST["nama"];
	$username     = $_POST["username"];
	$before_username     = $_POST["before_username"];
	$password     = md5($_POST["password"]);
	$password2     = $_POST["password2"];
	if(empty($nama) || empty($username) || empty($password2)){
		header("location:../../?page=Admin&error=empty");
	}else{
		if(empty($_POST["password"])){
			if($username != $before_username){
				$cek_query = mysql_query("select*from admin where username='$username' and password='$password2'");
				$cek_array = mysql_fetch_array($cek_query);
				$cek = $cek_array["id"];
			}
				if(empty($cek)){
					$set = mysql_query("update admin set nama='$nama',username='$username' where id='$id_admin'");
					if($set){
						header("location:../../?page=Admin&success=edit");
					}else{
						header("location:../../?page=Admin&error=cant");
					}
				}else{
					header("location:../../?page=Admin&error=same");
				}
		}else{
			$cek_query = mysql_query("select*from admin where username='$username' and password='$password'");
			$cek_array = mysql_fetch_array($cek_query);
			$cek = $cek_array["id"];
			if(empty($cek)){
				$set = mysql_query("update admin set nama='$nama',username='$username',password='$password' where id='$id_admin'");
				if($set){
					header("location:../../?page=Admin&success=edit");
				}else{
					header("location:../../?page=Admin&error=cant");
				}
			}else{
				header("location:../../?page=Admin&error=same");
			}
		}
	}
?>