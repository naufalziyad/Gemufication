<div class="row">
<div class="span12">
<link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
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
		<h2>Data Jadwal Ujian</h2>
	</div>
        
	<div>
        
		<ul class="nav nav-tabs">
            <li class="active"><a href="#list" data-toggle="tab"><i class="icon-list"></i>List</a></li>
            <li><a href="#new" data-toggle="tab"><i class="icon-plus-sign"></i>Create</a></li>
         </ul>
        
<div class="tab-content active">
 <!--==================tampil===================================================================================================-->
    <div class="tab-pane active" id="list">
<!--=====================================================================================================================-->
 		<form class="form-search" align="right" method="GET" action="">
		  <div class="input-append">
			<input type="hidden" name="page" value="Jadwal">
			<input type="text" class="span2 search-query" placeholder="search" name="txt_search">
			<select class="span2" name="jenis_search">
				<option value='siswa.id'>ID</option>
				<option value='siswa.nama_siswa'>Nama Ujian</option>
			</select>
			<select class="span2" name="kelas">
				<option value='all'>--Semua Level--</option>
					<?php
						$query_input_kelas = mysql_query("select kelas.id,kelas.nama_kelas,jurusan.nama_jurusan from kelas,jurusan where kelas.id_jurusan=jurusan.id");
						while($array_input_kelas = mysql_fetch_array($query_input_kelas)){
							echo "<option value='".$array_input_kelas['id']."'>".$array_input_kelas['nama_kelas']."-".$array_input_kelas['nama_jurusan']."</option>";
						}
					?>
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
                    <th>Level</th>
                    <th>Tanggal (yyyy-MM-dd)</th>
                    <th>Action</th>
                </tr>
            </thead>
        <tbody>
		<?php
		if(empty($_GET['kelas']) || $_GET['kelas'] == "all"){
			$get_kelas = "";
		}else{
			$get_kelas = "and jadwal.id_kelas='".$_GET['kelas']."' ";
		}
		
		if(empty($_GET["txt_search"])){
			$txt_search="";
		}
		else{
			$txt_search=$_GET["txt_search"];
		}
		$jenis_search = $_GET["jenis_search"];
		
		if(!empty($txt_search)){
			if(isset($_SESSION["guru"])){
					$id_guru = $_SESSION["guru"];
					$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM jadwal,ujian,kelas where jadwal.id_ujian=ujian.id and jadwal.id_kelas=kelas.id and ujian.id_guru='$id_guru' and $jenis_search like '%$txt_search%' $get_kelas");
					$query_page = mysql_query("select jadwal.id,jadwal.id_ujian,jadwal.id_kelas,jadwal.tgl,kelas.nama_kelas,ujian.nama_ujian,jurusan.nama_jurusan from jadwal,ujian,kelas,jurusan where jadwal.id_ujian=ujian.id and jadwal.id_kelas=kelas.id and kelas.id_jurusan=jurusan.id and ujian.id_guru='$id_guru' $get_kelas and $jenis_search like '%$txt_search%' LIMIT $offset, $dataPerPage");
			}else{
					$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM jadwal,ujian,kelas where jadwal.id_ujian=ujian.id and jadwal.id_kelas=kelas.id and $jenis_search like '%$txt_search%' $get_kelas");
					$query_page = mysql_query("select jadwal.id,jadwal.id_ujian,jadwal.id_kelas,jadwal.tgl,kelas.nama_kelas,ujian.nama_ujian,jurusan.nama_jurusan from jadwal,ujian,kelas,jurusan where jadwal.id_ujian=ujian.id and jadwal.id_kelas=kelas.id and kelas.id_jurusan=jurusan.id $get_kelas and $jenis_search like '%$txt_search%' LIMIT $offset, $dataPerPage");			
			}
		}else{
			if(isset($_SESSION["guru"])){
					$id_guru = $_SESSION["guru"];
					$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM jadwal,ujian,kelas where jadwal.id_ujian=ujian.id and jadwal.id_kelas=kelas.id and ujian.id_guru='$id_guru' $get_kelas");
					$query_page = mysql_query("select jadwal.id,jadwal.id_ujian,jadwal.id_kelas,jadwal.tgl,kelas.nama_kelas,ujian.nama_ujian,jurusan.nama_jurusan from jadwal,ujian,kelas,jurusan where jadwal.id_ujian=ujian.id and jadwal.id_kelas=kelas.id and ujian.id_guru='$id_guru' and kelas.id_jurusan=jurusan.id $get_kelas LIMIT $offset, $dataPerPage");
			}else{
					$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM jadwal,ujian,kelas where jadwal.id_ujian=ujian.id and jadwal.id_kelas=kelas.id $get_kelas");
					$query_page = mysql_query("select jadwal.id,jadwal.id_ujian,jadwal.id_kelas,jadwal.tgl,kelas.nama_kelas,ujian.nama_ujian,jurusan.nama_jurusan from jadwal,ujian,kelas,jurusan where jadwal.id_ujian=ujian.id and jadwal.id_kelas=kelas.id and kelas.id_jurusan=jurusan.id $get_kelas LIMIT $offset, $dataPerPage");
			}
		}

			$array_count   = mysql_fetch_array($query_count);
			$jml_data = $array_count["jml_data"];
			$jumPage = ceil($jml_data/$dataPerPage);

			while($array_page = mysql_fetch_array($query_page)){
				$nama_kelas = $array_page['nama_kelas']."-".$array_page['nama_jurusan'];
		?>
            <tr>
                <td><?php echo $array_page["id"]; ?></td>
                <td><?php echo $array_page["nama_ujian"]; ?></td>
                <td><?php echo $nama_kelas; ?></td>
                <td><?php echo $array_page["tgl"]; ?></td>
                <td>
                    <a href="#edit" data-toggle="modal" onclick="javacript:edit(<?php echo $array_page['id'].",'".$array_page['id_ujian']."','".$array_page['nama_ujian']."','".$array_page['id_kelas']."','".$nama_kelas."','".$array_page["tgl"]."'";?>)"><i class="icon-edit"></i></a>
                    <a href="javascript:confirmDelete('proses/master_jadwal/delete.php?id=<?php echo $array_page["id"]; ?>')"><i class="icon-remove"></i></a>
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
				if(empty($_GET['kelas']) || $_GET['kelas'] == "all"){
				$paging_kelas = "";
				}else{
				$paging_kelas = "&kelas=".$_GET['kelas'];
				}
			?>	
            <ul>
                <li><a href="?page=Jadwal&halaman=1&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?><?php echo $paging_kelas; ?>">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Jadwal&halaman=".($noPage-1)."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Jadwal&halaman=".$noPage2."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Jadwal&halaman=".$noPage1."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Jadwal&halaman=".$noPage."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Jadwal&halaman=".$noPage3."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage3."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Jadwal&halaman=".$noPage4."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Jadwal&halaman=".($noPage+1)."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Jadwal&halaman=<?php echo $jumPage; ?>&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?><?php echo $paging_kelas; ?>">Last(<?php echo $jumPage; ?>)</a></li>
            </ul>
			<?php
			}else{
				if(empty($_GET['kelas']) || $_GET['kelas'] == "all"){
				$paging_kelas = "";
				}else{
				$paging_kelas = "&kelas=".$_GET['kelas'];
				}
			?>
            <ul>
                <li><a href="?page=Jadwal&halaman=1<?php echo $paging_kelas; ?>">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Jadwal&halaman=".($noPage-1).$paging_kelas."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Jadwal&halaman=".$noPage2.$paging_kelas."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Jadwal&halaman=".$noPage1.$paging_kelas."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Jadwal&halaman=".$noPage.$paging_kelas."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Jadwal&halaman=".$noPage3."'>".$noPage3.$paging_kelas."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Jadwal&halaman=".$noPage4.$paging_kelas."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Jadwal&halaman=".($noPage+1).$paging_kelas."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Jadwal&halaman=<?php echo $jumPage; ?><?php echo $paging_kelas; ?>">Last(<?php echo $jumPage; ?>)</a></li>
            </ul>
			<?php
			}
			?>
        </div>
    </div>
 <!--=========================================================================================================================-->
 <!--==================input===================================================================================================-->	
	<div class="tab-pane" id="new">
		<form class="form-horizontal" method="post" action="proses/master_jadwal/input.php">
			<div class="control-group">
				<label class="control-label" for="inputJurusan">Ujian</label>
				<div class="controls">
					<select name="ujian">
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
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputJurusan">Level</label>
				<div class="controls">
					<select name="kelas">
					<?php
						$query_input_kelas = mysql_query("select kelas.id,kelas.nama_kelas,jurusan.nama_jurusan from kelas,jurusan where kelas.id_jurusan=jurusan.id");
						while($array_input_kelas = mysql_fetch_array($query_input_kelas)){
							echo "<option value='".$array_input_kelas['id']."'>".$array_input_kelas['nama_kelas']."-".$array_input_kelas['nama_jurusan']."</option>";
						}
					?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputJurusan">Tanggal</label>
				<div class="controls">
					<input type="date" value="auto" name="tgl">
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn">Save</button>
				</div>
			</div>
		</form>
    </div>
 <!--=========================================================================================================================-->
 
</div>
 
<script>
  $(function () {
    $('#myTab a:last').tab('show');
	  })
 </script>
 <!--==================Edit===================================================================================================-->
 		<script>
		function edit(id,idujian,ujian,idkelas,kelas,tgl){
			var idstr = id;
			var idujianstr = idujian;
			var ujianstr = ujian;
			var idkelasstr = idkelas;
			var kelasstr = kelas;
			var tglstr = tgl;
			document.fedit.id_jadwal.value = idstr;
			document.fedit.ujian.value = idujianstr;
			document.fedit.ujian2.value = ujianstr;
			document.fedit.kelas.value = idkelasstr;
			document.fedit.nama_kelas.value = kelasstr;
			document.fedit.tgl.value = tglstr;
			document.fedit.text_tgl2.value = tglstr;
		}
		function addText_id_ujian() {
		  var x = document.getElementById("combo_ujian");
		  var y = document.getElementById("ujian_txt2");
		  var z = document.getElementById("ujian_txt");
		  if(x.value != "change"){
		  getCmb1 = x.value.split(";");
		  y.value = getCmb1[1];
		  z.value = getCmb1[0];
		  }
		}	
		function addText_kelas() {
		  var x = document.getElementById("combo_kelas");
		  var y = document.getElementById("txt_kelas");
		  var z = document.getElementById("id_kelas");
		  if(x.value != "change"){
		  getCmb1 = x.value.split("/");
		  y.value = getCmb1[1];
		  z.value = getCmb1[0];
		  }
		}
		function addText_tgl() {
		  var x = document.getElementById("date_tgl");
		  var y = document.getElementById("text_tanggal");
		  var z = document.getElementById("text_tanggal2");
		  if(x.value != ""){
		  y.value = x.value;
		  z.value = x.value;
		  }
		}
 		</script>
		<div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form action="proses/master_jadwal/edit.php" method="POST" name="fedit">
			  <input type="hidden" value="" name="id_jadwal">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Edit Jadwal Ujian</h3>
			  </div>
			  <div class="modal-body">
					<div class="control-group">
						<label class="control-label">Nama Ujian</label>
						<div class="controls">
							<input type='text' value='' name='ujian2' id="ujian_txt2" disabled class='input-large uneditable-input'>
							<input type='hidden' value='' name='ujian' id="ujian_txt">
							<select id="combo_ujian" onchange="javascript: addText_id_ujian();">
								<option value='change'>---Ganti---</option>
							<?php
								if(isset($_SESSION["guru"])){
									$id_guru = $_SESSION["guru"];
									$query_input_ujian = mysql_query("select * from ujian where id_guru='$id_guru'");
									while($array_input_ujian = mysql_fetch_array($query_input_ujian)){
										echo "<option value='".$array_input_ujian['id'].";".$array_input_ujian['nama_ujian']."'>".$array_input_ujian['nama_ujian']."</option>";
									}
								}else{
									$query_input_ujian = mysql_query("select * from ujian");
									while($array_input_ujian = mysql_fetch_array($query_input_ujian)){
										echo "<option value='".$array_input_ujian['id'].";".$array_input_ujian['nama_ujian']."'>".$array_input_ujian['nama_ujian']."</option>";
									}
								}
							?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="inputJurusan">Level</label>
						<div class="controls">
							<input type='text' name='nama_kelas' id="txt_kelas" disabled class='input-medium uneditable-input'>
							<input type='hidden' name='kelas' id="id_kelas">
							<select id="combo_kelas" onchange="javascript: addText_kelas();">
								<option value='change'>---Ganti---</option>
							<?php
								$query_input_kelas = mysql_query("select kelas.id,kelas.nama_kelas,jurusan.nama_jurusan from kelas,jurusan where kelas.id_jurusan=jurusan.id");
								while($array_input_kelas = mysql_fetch_array($query_input_kelas)){
									echo "<option value='".$array_input_kelas['id']."/".$array_input_kelas['nama_kelas']."-".$array_input_kelas['nama_jurusan']."'>".$array_input_kelas['nama_kelas']."-".$array_input_kelas['nama_jurusan']."</option>";
								}
							?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Tanggal</label>
						<div class="controls">
							<input type='text' name="text_tgl2" disabled class='input-medium uneditable-input' id="text_tanggal2">
							<input type='date' name="text_tgl" value="auto" onchange="javascript: addText_tgl();" id="date_tgl">
							<input name='tgl' type="hidden" value="" id="text_tanggal">
						</div>
					</div>
			  </div>
			  <div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn btn-primary">Save changes</button>
			  </div>
			  </form>
   	    </div>
 <!--=========================================================================================================================-->
 <!--===Delete======================================================================================================================-->
<script>
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete")) {
    document.location = delUrl;
  }
}
</script>
 <!--=========================================================================================================================-->
 
</div>
</div>
</div>
