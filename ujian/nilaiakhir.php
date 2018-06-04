<?php
error_reporting(0);
session_start();
echo "<body bgcolor='#333333'>";
echo "<br><br><br><center><img src='../assets/img/loading.gif'></center>";
if (!isset($_SESSION['siswa'])) {
    $msg = "<script type=text/javascript>" ;
    $msg .= "window.location = '../'";
    $msg .= "</script>";
    echo"$msg";
}
require("../config/database.php");
$jumlahbenar = 0;
$i = 1;
$nomor = 0;
$benar = 0;
$salah = 0;
$kosong = 0;
foreach($_POST['pilihan'] as $key => $value){
    $nomor++;
	if($value == ""){
		$j = "-";
		$kosong++;
	}
	else if($value == $_POST['jawaban'][$key]){
        $j = "b";
        $jumlahbenar++;
		$benar++;
    }else{
        $j = "s";
		$salah++;
    }
    $soal   =$_POST[idsoal][$key];
    $jawaban=$_POST[pilihan][$key];
    $sql = "INSERT INTO hasil_jawaban (id_siswa,id_ujian,id_soal,pilihan_jawaban,nomor,keterangan)VALUES($_SESSION[siswa],$_POST[idtest],$soal,'$jawaban','$nomor','$j')";
    //echo $sql."<br>";
	if($query = mysql_query($sql)){
        
    }else{$msg = "<script type=text/javascript>" ;
        //$msg .= "alert('Nilai Ujian Gagal Disimpan');";
        $msg .= "window.location = '../'";
        $msg .= "</script>";
	}echo $msg;
    $i++;
}
$hitung = ($jumlahbenar*100)/$_POST[jsoal];
$nilai = round($hitung,2);
//---------------------------------------------------------
$cek_ujian_query = mysql_query("select*from ujian where id=$_POST[idtest]");
$cek_ujian_array = mysql_fetch_array($cek_ujian_query);
$id_matpel = $cek_ujian_array['id_matpel'];
$cek_kkm_query = mysql_query("select*from matpel where id='$id_matpel'");
$cek_kkm_array = mysql_fetch_array($cek_kkm_query);
$kkm = $cek_kkm_array['kkm'];
if($nilai >= $kkm){
	$status = 'LULUS';
}else{
	$status = 'TIDAK_LULUS';
}
//---------------------------------------------------------
$nsql = "INSERT INTO hasil_ujian (id_ujian,id_siswa,benar,salah,kosong,tgl,skor,status)VALUES('$_POST[idtest]','$_SESSION[siswa]','$benar','$salah','$kosong','$_POST[tsoal]','$nilai','$status')";
//echo $nilai;
if($nquery=  mysql_query($nsql)){
	$form1  = "<form method='POST' action='../?page=Laporan' id='success'>";
	$form1 .= "<input type='hidden' name='ujian_success' value='yes'>";
	$form1 .= "<input type='hidden' name='id_ujian' value='$_POST[idtest]'>";
	$form1 .= "</form>";
	
	
    $msg2 = "<script type=text/javascript>" ;
    $msg2 .= "document.getElementById('success').submit();";
    $msg2 .= "</script>";

}else{
    $form1  = "<form method='POST' action='../?page=Laporan' id='failed'>";
	$form1 .= "<input type='hidden' name='ujian_success' value='no'>";
	$form1 .= "<input type='hidden' name='id_ujian' value='$_POST[idtest]'>";
	$form1 .= "</form>";
	
    $msg2 = "<script type=text/javascript>" ;
    $msg2 .= "document.getElementById('failed').submit();";
    $msg2 .= "</script>";
}echo $form1; echo $msg2;
?>
