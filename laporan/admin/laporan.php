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

?>
	<div class="page-header">
		<h2>Laporan Ujian</h2>
	</div>
        
	<div>
 <!--==================tampil===================================================================================================-->
 
  <!--=====================================================================================================================-->
 		<form class="form-search" align="right" method="GET" action="">
		  <div class="input-append">
			<input type="hidden" name="page" value="Laporan">
			<input type="text" class="span2 search-query" placeholder="search" name="txt_search">
			<select class="span2" name="jenis_search">
				<option value='hasil_ujian.id'>ID</option>
				<option value='siswa.nis'>NIS</option>
				<option value='siswa.nama_siswa'>Nama Siswa</option>
				<option value='ujian.nama_ujian'>Nama Ujian</option>
			</select>
			<button type="submit" class="btn">Search</button>
		  </div>
		</form>
 <!--=====================================================================================================================-->
		
        <table class="table table-striped table-condensed table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Ujian</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
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
			$select_ujian = "ujian.jml_soal, ujian.nama_ujian";
	
		if(empty($_GET["txt_search"])){
			$txt_search="";
		}
		else{
			$txt_search=$_GET["txt_search"];
		}
		$jenis_search = $_GET["jenis_search"];
		if(!empty($txt_search)){
			$query_count = mysql_query("SELECT COUNT(*) AS jml_data FROM hasil_ujian,ujian,siswa where hasil_ujian.id_siswa=siswa.id and hasil_ujian.id_ujian=ujian.id and $jenis_search like '%$txt_search%'");
			$query_page = mysql_query("select $select_hasil_ujian $select_siswa $select_ujian from hasil_ujian,ujian,siswa where hasil_ujian.id_siswa=siswa.id and hasil_ujian.id_ujian=ujian.id and $jenis_search like '%$txt_search%' order by tgl desc LIMIT $offset, $dataPerPage");
		}else{
			$query_count = mysql_query("SELECT COUNT(*) AS jml_data FROM hasil_ujian,ujian,siswa where hasil_ujian.id_siswa=siswa.id and hasil_ujian.id_ujian=ujian.id");
			$query_page = mysql_query("select $select_hasil_ujian $select_siswa $select_ujian from hasil_ujian,ujian,siswa where hasil_ujian.id_siswa=siswa.id and hasil_ujian.id_ujian=ujian.id order by tgl desc LIMIT $offset, $dataPerPage");
		}
			
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
                <td><?php echo $array_page["skor"]; ?></td>
                <td><?php echo $array_page["tgl"]; ?></td>
                <td><?php echo $array_page["status"]; ?></td>
                <td>
                    <a href="#detail" data-toggle="modal" onclick="javacript:detail(<?php echo "'".$array_page["benar"]."','".$array_page["salah"]."','".$array_page["kosong"]."'"; ?>)"><i class="icon-list-alt"></i></a>
                    <a href="proses/laporan/delete.php?id=<?php echo $array_page["id"]; ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="icon-remove"></i></a>
                </td>
            </tr>

		<?php
			}
		?>
        </tbody>
        </table>
		<div class="pagination pagination-centered">
			<?php
			if(!empty($txt_search)){
			?>	
            <ul>
                <li><a href="?page=Laporan&halaman=1&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?>">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Laporan&halaman=".($noPage-1)."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Laporan&halaman=".$noPage2."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Laporan&halaman=".$noPage1."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Laporan&halaman=".$noPage."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Laporan&halaman=".$noPage3."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage3."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Laporan&halaman=".$noPage4."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Laporan&halaman=".($noPage+1)."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Laporan&halaman=<?php echo $jumPage; ?>&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?>">Last(<?php echo $jumPage; ?>)</a></li>
            </ul>
			<?php
			}else{
			?>
            <ul>
                <li><a href="?page=Laporan&halaman=1">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Laporan&halaman=".($noPage-1)."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Laporan&halaman=".$noPage2."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Laporan&halaman=".$noPage1."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Laporan&halaman=".$noPage."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Laporan&halaman=".$noPage3."'>".$noPage3."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Laporan&halaman=".$noPage4."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Laporan&halaman=".($noPage+1)."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Laporan&halaman=<?php echo $jumPage; ?>">Last(<?php echo $jumPage; ?>)</a></li>
            </ul>
			<?php
			}
			?>
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
				<script language="JavaScript" src="chart/JSClass/FusionCharts.js"></script> 	
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
