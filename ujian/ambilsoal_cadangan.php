<?php
error_reporting(0);
require("../config/database.php");

$topik = @$_GET['topik'];
$query_batas_soal = mysql_query("SELECT * FROM ujian where id='$topik'");
$array_batas_soal = mysql_fetch_array($query_batas_soal);
$batas_soal = $array_batas_soal['jml_soal'];
$data = mysql_query("SELECT * FROM bank_soal WHERE id_ujian='$topik' ORDER BY RAND() limit 0,$batas_soal");

$json = '{"soal":[ ';
while($x = mysql_fetch_array($data)){
	$id = $x['id'];
	$a = $x['a'];
	$b = $x['b'];
	$c = $x['c'];
	if(!empty($x['d'])){$d = $x['d'];}else{$d = "-";}
	if(!empty($x['e'])){$e = $x['e'];}else{$e = "-";}
	
    $json .= '{';
    $json .= '"id":"'.$x['soalid'].'",
        "topik":"'.htmlspecialchars($x['id_ujian']).'",
        "pertanyaan":"'.htmlspecialchars_decode($x['pertanyaan']).'",
        "a":"'.$x['a'].'",
        "b":"'.$x['b'].'",
        "c":"'.$x['c'].'",
        "d":"'.$x['d'].'",
        "e":"'.$x['e'].'",
        "id_soal":"'.$id.'",
        "byk_pilihan":"'.$x['banyak_pilihan'].'",
        "jawaban":"'.$x['jawaban_benar'].'"
    },';
}
$json = substr($json,0,strlen($json)-1);
$json .= ']';

$json .= '}';
echo $json;

?>
