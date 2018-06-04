<?php

$data = mysql_query("SELECT * FROM ujian");
$tgl = date("Y-m-d");
echo "<table class='table table-condensed'>";
echo "<thead>";
	echo "<tr>";
		echo "<th colspan='2' style='background-color:#ddd'>";
			echo "Jadwal Ujian tanggal : ".$tgl;
		echo "</th>";
	echo "</tr>";
echo "</thead>";

echo "</tbody>";
while($x = mysql_fetch_array($data)){
	$id_ujian = $x['id'];
	$cek_jadwal = mysql_query("SELECT * FROM jadwal where id_ujian='$id_ujian' and tgl='$tgl'");
	$data_jadwal = mysql_query("SELECT * FROM jadwal where id_ujian='$id_ujian' and tgl='$tgl'");
	$cek_data = mysql_fetch_array($cek_jadwal);
	if(!empty($cek_data['id'])){
		echo "<tr style='font-size:12px;'>";
			echo "<td>";
				echo $x['nama_ujian'];
			echo "</td>";
			echo "<td>";
		while($array_jadwal = mysql_fetch_array($data_jadwal)){
			$id_kelas = $array_jadwal["id_kelas"];
			$data_kelas = mysql_query("select*from kelas,jurusan where kelas.id_jurusan=jurusan.id and kelas.id='$id_kelas'");
			$array_kelas = mysql_fetch_array($data_kelas);
			$kelas_data = $array_kelas['nama_kelas']."-".$array_kelas['nama_jurusan'].", ";
			echo $kelas_data;
			
		}
			echo "</td>";
		echo "</tr>";
	}
}
echo "</tbody>";
echo "</table>";

?>
