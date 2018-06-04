<script language="JavaScript" src="chart/JSClass/FusionCharts.js"></script> 	
<div class="row">
<div class="span12">
<?php
//===========================================================================================================================================
	$dataPerPage = 10;

	if(isset($_GET['halaman']) and !empty($_GET['halaman']))
	{
		$noPage = $_GET['halaman'];
	} 
	else $noPage = 1;

	$offset = ($noPage - 1) * $dataPerPage;
//===========================================================================================================================================
		if(empty($_GET["ujian"]) || $_GET["ujian"] == "all"){
			$txt_ujian="";
		}
		else{
			$txt_ujian= "and hasil_ujian.id_ujian=".$_GET["ujian"]."";
			$page_ujian= $_GET["ujian"];
		}		
		
		if(empty($_GET["kelas"]) || $_GET["kelas"] == "all"){
			$txt_kelas="";
		}
		else{
			$txt_kelas= "and kelas.id=".$_GET["kelas"]."";
			$page_kelas= $_GET["kelas"];
		}
//===========================================================================================================================================

?>
	<div class="page-header">
		<h2>Laporan Ujian</h2>
	</div>
        
	<div>
 <!--==================tampil===================================================================================================-->
 
  <!--=====================================================================================================================-->
 		<form class="form-search" align="right" method="GET" action="">
		  <div class="input-append">
			<input type="hidden" name="page" value="Laporan_Kelas">
			<select name="ujian">
			<option value='all'>--Semua Ujian--</option>
			<?php
				if(isset($_SESSION["guru"])){
					$id_guru = $_SESSION["guru"];
					$query_input_ujian = mysql_query("select * from ujian where id_guru='$id_guru'");
					while($array_input_ujian = mysql_fetch_array($query_input_ujian)){
						echo "<option value='".$array_input_ujian['id']."'>".$array_input_ujian['nama_ujian']."</option>";
					}
				}else{
					$query_input_ujian = mysql_query("select * from ujian");
					while($array_input_ujian = mysql_fetch_array($query_input_ujian)){
						echo "<option value='".$array_input_ujian['id']."'>".$array_input_ujian['nama_ujian']."</option>";
					}
				}
			?>
			</select>
			<select class="span2" name="kelas">
				<option value='all'>--Semua Kelas--</option>
					<?php
						$query_input_kelas = mysql_query("select kelas.id,kelas.nama_kelas,jurusan.nama_jurusan from kelas,jurusan where kelas.id_jurusan=jurusan.id");
						while($array_input_kelas = mysql_fetch_array($query_input_kelas)){
							echo "<option value='".$array_input_kelas['id']."'>".$array_input_kelas['nama_kelas']."-".$array_input_kelas['nama_jurusan']."</option>";
						}
					?>
			</select>
			<button type="submit" class="btn">Pilih</button>
		  </div>
		</form>
 <!--=====================================================================================================================-->
 <?php 

 for($n=0;$n<=20;$n++){
	$tingkat_nilai = $n*5;
	$nilai_chart = "nilai".$n*5;
	$tingkat_nilai2 = ($n*5)+5;
	$query_nilai = mysql_query("SELECT COUNT(*) AS jml_data FROM hasil_ujian,siswa,kelas where hasil_ujian.id_siswa=siswa.id and siswa.id_kelas=kelas.id and hasil_ujian.skor >= $tingkat_nilai and hasil_ujian.skor < $tingkat_nilai2 $txt_ujian $txt_kelas");
	$array_nilai   = mysql_fetch_array($query_nilai);
	$jml_nilai = $array_nilai["jml_data"];
	?>
		<script>
			var <?php echo $nilai_chart; ?> = <?php echo $jml_nilai; ?>;
		</script>
	<?php
	//echo "(".$tingkat_nilai3."-".$jml_nilai.")-";
  }
 ?>
 <!--=====================================================================================================================-->
 				<div id="top_chart" align="center"> 
				FusionCharts. </div>
				<script type="text/javascript">
				   var chart = new FusionCharts("chart/Charts/Line.swf", "ChartId", "1170", "300", "0", "0");
				   chart.setDataXML("<chart bgcolor='#e5e5e5' caption='Grafik Nilai' xAxisName='Nilai' yAxisName='Jumlah' yAxisMinValue='0'  numberPrefix='' showValues='0' alternateHGridColor='FCB541' alternateHGridAlpha='10' divLineColor='FCB541' divLineAlpha='50' canvasBorderColor='666666' baseFontColor='666666' lineColor='FCB541'><set label='>=0' value='"+nilai0+"' /><set label='>=5' value='"+nilai5+"' /><set label='>=10' value='"+nilai10+"' /><set label='>=15' value='"+nilai15+"' /><set label='>=20' value='"+nilai20+"' /><set label='>=25' value='"+nilai25+"' /><set label='>=30' value='"+nilai30+"' /><set label='>=35' value='"+nilai35+"' /><set label='>=40' value='"+nilai40+"' /><set label='>=45' value='"+nilai45+"' /><set label='>=50' value='"+nilai50+"' /><set label='>=55' value='"+nilai55+"' /><set label='>=60' value='"+nilai60+"' /><set label='>=65' value='"+nilai65+"' /><set label='>=70' value='"+nilai70+"' /><set label='>=75' value='"+nilai75+"' /><set label='>=80' value='"+nilai80+"' /><set label='>=85' value='"+nilai85+"' /><set label='>=90' value='"+nilai90+"' /><set label='>=95' value='"+nilai95+"' /><set label='=100' value='"+nilai100+"' /><styles><definition><style name='Anim1' type='animation' param='_xscale' start='0' duration='1' /><style name='Anim2' type='animation' param='_alpha' start='0' duration='0.6' /><style name='DataShadow' type='Shadow' alpha='40'/></definition><application><apply toObject='DIVLINES' styles='Anim1' /><apply toObject='HGRID' styles='Anim2' /><apply toObject='DATALABELS' styles='DataShadow,Anim2' /></application></styles></chart> ");	   
				   chart.render("top_chart");
				</script> 
 <!--=====================================================================================================================-->
		<br>
        <table class="table table-striped table-condensed table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Ujian</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Total Skor</th>
                    <th>Tanggal Ujian</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
        <tbody>
		<?php
			$select_hasil_ujian = "hasil_ujian.id, hasil_ujian.skor, hasil_ujian.tgl, hasil_ujian.status, hasil_ujian.benar, hasil_ujian.salah, hasil_ujian.kosong,";
			$select_siswa = "siswa.nis, siswa.nama_siswa,";
			$select_ujian = "ujian.jml_soal, ujian.nama_ujian,";
			$select_kelas = "kelas.nama_kelas,";
			$select_jurusan = "jurusan.nama_jurusan";
	


			$query_count = mysql_query("SELECT COUNT(*) AS jml_data FROM hasil_ujian,ujian,siswa,kelas,jurusan where hasil_ujian.id_siswa=siswa.id and hasil_ujian.id_ujian=ujian.id and siswa.id_kelas=kelas.id and kelas.id_jurusan=jurusan.id $txt_ujian $txt_kelas");
			$query_page = mysql_query("select $select_hasil_ujian $select_siswa $select_ujian $select_kelas $select_jurusan from hasil_ujian,ujian,siswa,kelas,jurusan where hasil_ujian.id_siswa=siswa.id and hasil_ujian.id_ujian=ujian.id and siswa.id_kelas=kelas.id and kelas.id_jurusan=jurusan.id $txt_ujian $txt_kelas order by tgl desc LIMIT $offset, $dataPerPage");
			
			$array_count   = mysql_fetch_array($query_count);
			$jml_data = $array_count["jml_data"];
			$jumPage = ceil($jml_data/$dataPerPage);

			while($array_page = mysql_fetch_array($query_page)){
		?>
            <tr>
                <td><?php echo $array_page["id"]; ?></td>
                <td><?php echo $array_page["nama_ujian"]; ?></td>
                <td><?php echo $array_page["nis"]; ?></td>
                <td><?php echo $array_page["nama_siswa"]; ?></td>
                <td><?php echo $array_page["nama_kelas"]."-".$array_page["nama_jurusan"]; ?></td>
                <td><?php echo $array_page["skor"]; ?></td>
                <td><?php echo $array_page["tgl"]; ?></td>
                <td><?php echo $array_page["status"]; ?></td>
                <td>
                    <a href="#detail" data-toggle="modal" onclick="javacript:detail(<?php echo "'".$array_page["benar"]."','".$array_page["salah"]."','".$array_page["kosong"]."'"; ?>)"><i class="icon-list-alt"></i></a>
                </td>
            </tr>

		<?php
			}
		?>
        </tbody>
        </table>
		<div class="pagination pagination-centered">
            <ul>
                <li><a href="?page=Laporan_Kelas&halaman=1&ujian=<?php echo $page_ujian; ?>&kelas=<?php echo $page_kelas; ?>">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Laporan_Kelas&halaman=".($noPage-1)."&ujian=".$page_ujian."&kelas=".$page_kelas."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Laporan_Kelas&halaman=".$noPage2."&ujian=".$page_ujian."&kelas=".$page_kelas."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Laporan_Kelas&halaman=".$noPage1."&ujian=".$page_ujian."&kelas=".$page_kelas."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Laporan_Kelas&halaman=".$noPage."&ujian=".$page_ujian."&kelas=".$page_kelas."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Laporan_Kelas&halaman=".$noPage3."&ujian=".$page_ujian."&kelas=".$page_kelas."'>".$noPage3."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Laporan_Kelas&halaman=".$noPage4."&ujian=".$page_ujian."&kelas=".$page_kelas."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Laporan_Kelas&halaman=".($noPage+1)."&ujian=".$page_ujian."&kelas=".$page_kelas."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Laporan_Kelas&halaman=<?php echo $jumPage; ?>&ujian=<?php echo $page_ujian; ?>&kelas=<?php echo $page_kelas; ?>">Last(<?php echo $jumPage; ?>)</a></li>
            </ul>
        </div>
 <!--=========================================================================================================================-->

 <!--==================Hasil Chart===================================================================================================-->
	<script>
 		</script>
		<div id="detail" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form action="proses/master_ujian/edit.php" method="POST" name="fedit">
			  <input type="hidden" value="" name="id_ujian">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Laporan Ujian</h3>
			  </div>
			  <div class="modal-body">				
				<div id="chart" align="center"> 
				FusionCharts. </div>
				<script type="text/javascript">
				function detail(benar,salah,kosong){
				   var chart = new FusionCharts("chart/Charts/Pie2D.swf", "ChartId", "400", "300", "0", "0");
				   chart.setDataXML("<chart palette='7' caption='Hasil Jawaban' bgColor='#F6D8CE,#F3E2A9'><set label='Benar' value='"+benar+"' color='#58FA58' /><set label='Salah' value='"+salah+"' color='#FA5858'/><set label='Kosong' value='"+kosong+"' color='#CEECF5'/></chart>");	   
				   chart.render("chart");
				   }
				</script> 
			  </div>
			  <div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn btn-primary">Save changes</button>
			  </div>
			  </form>
   	    </div>
 <!--=========================================================================================================================--> 
</div>
</div>
</div>
</div>
