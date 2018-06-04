<div class="row">
	<div class="span5">
			<div class="page-header">
				<center>
					<h2>Pilih Ujian</h2>
				</center>
			</div>
        
			<div>
				<center>
				<form action="ujian/start_page.php" method="post">
				<?php
				$hari_ini=date("Y-m-d");
				if(isset($_SESSION["siswa"])){
					
					echo "<select name='id_ujian'>";
					echo "<option>---------  Pilih  ---------</option>";
					$id_siswa = $_SESSION["siswa"];
					$query_cek_siswa = mysql_query("select*from siswa where id='$id_siswa'");
					$array_cek_siswa = mysql_fetch_array($query_cek_siswa);
					$id_kelas_siswa = $array_cek_siswa["id_kelas"];
						$query_combo_jadwal= mysql_query("select*from jadwal");  /*where tgl='$hari_ini'*/
						while($array_combo_jadwal = mysql_fetch_array($query_combo_jadwal)){
							$id_ujian = $array_combo_jadwal['id_ujian'];
							$id_kelas = $array_combo_jadwal['id_kelas'];
							$query_check_ujian = mysql_query("select*from ujian where id='$id_ujian'");
							$array_check_ujian = mysql_fetch_array($query_check_ujian);
							$query_check_hasil = mysql_query("select*from hasil_ujian where id_ujian='$id_ujian' AND id_siswa='$id_siswa'");
							$array_check_hasil = mysql_fetch_array($query_check_hasil);
							if(empty($array_check_hasil['id']) && $id_kelas_siswa == $id_kelas){
								echo "<option value='".$id_ujian."'>".$array_check_ujian['nama_ujian']."</option>";
							}
						}
					echo "</select></br></br>";
					echo "<input type='submit' value='Start Ujian' class='btn btn-primary btn-large'>";
				?>
				<?php
				}
				?>
				</form>
				</center>
			</div>
	</div>
	<div class="span5">
			<div class="page-header">
				<center>
					<h2>Keterangan</h2>
				</center>
			</div>
        
			<div style="text-align:center;">
				<dl class="dl-vertikal">
					<dt><span id="divtotalwaktu" class="badge badge-important">60</span></dt>
					<dd>Menunjukkan waktu Ujian (second)</dd><br>
					<dt><div class='alert fade in alert-info'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Text Pembuka</strong></div></dt>
				</dl>
			</div>
	</div>
</div>