<?php
	if(!empty($_POST["page"])){$page = $_POST["page"];}else{$page = @$_GET["page"];}
	
	if(empty($page)){
		if(isset($_SESSION["admin"])){
			include("home/home_admin.php");
		}
		else if(isset($_SESSION["siswa"])){
			include("home/home_siswa.php");
		}
		else if(isset($_SESSION["guru"])){
			include("home/home_guru.php");
		}
	}else{
		if(isset($_SESSION["admin"])){
			switch ($page) {
				case "Server" : if(file_exists("master/master_jurusan.php"))include("master/master_jurusan.php");else include("alert/not_found.php"); break;
				case "Level" : if(file_exists("master/master_kelas.php"))include("master/master_kelas.php");else include("alert/not_found.php"); break;
				case "Member" : if(file_exists("master/master_siswa.php"))include("master/master_siswa.php");else include("alert/not_found.php"); break;
				case "Kategori" : if(file_exists("master/master_matpel.php"))include("master/master_matpel.php");else include("alert/not_found.php"); break;
				case "Admin" : if(file_exists("master/master_admin.php"))include("master/master_admin.php");else include("alert/not_found.php"); break;
				case "Ujian" : if(file_exists("master/master_ujian.php"))include("master/master_ujian.php");else include("alert/not_found.php"); break;
				case "Jadwal" : if(file_exists("master/master_jadwal.php"))include("master/master_jadwal.php");else include("alert/not_found.php"); break;
				case "Bank Soal" : if(file_exists("master/master_bank_soal.php"))include("master/master_bank_soal.php");else include("alert/not_found.php"); break;
				case "Laporan" : if(file_exists("laporan/admin/laporan.php"))include("laporan/admin/laporan.php");else include("alert/not_found.php"); break;
				case "Laporan_Kelas" : if(file_exists("laporan/admin/laporan_kelas.php"))include("laporan/admin/laporan_kelas.php");else include("alert/not_found.php"); break;
				case "About" : if(file_exists("menu/about.php"))include("menu/about.php");else include("alert/not_found.php"); break;
				default : include("alert/not_found.php"); break;
			};	
		}
		else if(isset($_SESSION["siswa"])){
			switch ($page) {
				case "Ujian" : if(file_exists("ujian/page_ujian.php"))include("ujian/page_ujian.php");else include("alert/not_found.php"); break;
				case "Level" : if(file_exists("master/master_kelas.php"))include("master/master_kelas.php");else include("alert/not_found.php"); break;
				case "Laporan" : if(file_exists("laporan/siswa/laporan.php"))include("laporan/siswa/laporan.php");else include("alert/not_found.php"); break;
				case "About" : if(file_exists("menu/about.php"))include("menu/about.php");else include("alert/not_found.php"); break;
				default : include("alert/not_found.php"); break;
			};	
		}
		/* else if(isset($_SESSION["guru"])){
			switch ($page) {
				case "Ujian" : if(file_exists("master/master_ujian.php"))include("master/master_ujian.php");else include("alert/not_found.php"); break;
				case "Jadwal" : if(file_exists("master/master_jadwal.php"))include("master/master_jadwal.php");else include("alert/not_found.php"); break;
				case "Bank Soal" : if(file_exists("master/master_bank_soal.php"))include("master/master_bank_soal.php");else include("alert/not_found.php"); break;
				case "Laporan" : if(file_exists("laporan/guru/laporan.php"))include("laporan/guru/laporan.php");else include("alert/not_found.php"); break;
				case "Laporan_Kelas" : if(file_exists("laporan/guru/laporan_kelas.php"))include("laporan/guru/laporan_kelas.php");else include("alert/not_found.php"); break;
				case "About" : if(file_exists("menu/about.php"))include("menu/about.php");else include("alert/not_found.php"); break;
				default : include("alert/not_found.php"); break;
			};	
		} */
	}
?>