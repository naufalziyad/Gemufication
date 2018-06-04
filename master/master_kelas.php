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
		<h2>Level Scope</h2>
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
			<input type="hidden" name="page" value="Level">
			<input type="text" class="span2 search-query" placeholder="search" name="txt_search">
			<select class="span2" name="jenis_search">
				<option value='kelas.id'>ID</option>
			</select>
			<button type="submit" class="btn">Search</button>
		  </div>
		</form>
 <!--=====================================================================================================================-->
        <table class="table table-striped table-condensed table-bordered">
            <thead>
                <tr>
                    <th>ID Level</th>
                    <th>Level</th>
                    <th>Server</th>
                    <th>Action</th>
                </tr>
            </thead>
        <tbody>
		<?php
		if(empty($_GET["txt_search"])){
		$txt_search="";
		}
		else{
		$txt_search=$_GET["txt_search"];
		}
		$jenis_search = $_GET["jenis_search"];
		if(!empty($txt_search)){
			$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM kelas where $jenis_search like '%$txt_search%'");
			$query_page = mysql_query("select kelas.id,kelas.id_jurusan,kelas.nama_kelas,jurusan.nama_jurusan from kelas,jurusan where kelas.id_jurusan=jurusan.id and $jenis_search like '%$txt_search%' LIMIT $offset, $dataPerPage");
		}else{
			$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM kelas");
			$query_page = mysql_query("select kelas.id,kelas.id_jurusan,kelas.nama_kelas,jurusan.nama_jurusan from kelas,jurusan where kelas.id_jurusan=jurusan.id LIMIT $offset, $dataPerPage");
		}
			
			$array_count   = mysql_fetch_array($query_count);
			$jml_data = $array_count["jml_data"];
			$jumPage = ceil($jml_data/$dataPerPage);
			
			
			while($array_page = mysql_fetch_array($query_page)){
		?>
            <tr>
                <td><?php echo $array_page["id"]; ?></td>
                <td><?php echo $array_page["nama_kelas"]; ?></td>
                <td><?php echo $array_page["nama_jurusan"]; ?></td>
                <td>
                    <a href="#edit" data-toggle="modal" onclick="javacript:edit(<?php echo $array_page['id'].",'".$array_page['id_jurusan']."','".$array_page["nama_kelas"]."','".$array_page['nama_jurusan']."'";?>)"><i class="icon-edit"></i></a>
                    <a href="javascript:confirmDelete('proses/master_kelas/delete.php?id=<?php echo $array_page["id"]; ?>')"><i class="icon-remove"></i></a>
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
                <li><a href="?page=Level&halaman=1&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?>">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Level&halaman=".($noPage-1)."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Level&halaman=".$noPage2."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Level&halaman=".$noPage1."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Level&halaman=".$noPage."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Level&halaman=".$noPage3."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage3."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Level&halaman=".$noPage4."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Level&halaman=".($noPage+1)."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Level&halaman=<?php echo $jumPage; ?>&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?>">Last(<?php echo $jumPage; ?>)</a></li>
            </ul>
			<?php
			}else{
			?>
			<ul>
                <li><a href="?page=Level&halaman=1">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Level&halaman=".($noPage-1)."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Level&halaman=".$noPage2."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Level&halaman=".$noPage1."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Level&halaman=".$noPage."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Level&halaman=".$noPage3."'>".$noPage3."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Level&halaman=".$noPage4."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Level&halaman=".($noPage+1)."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Level&halaman=<?php echo $jumPage; ?>">Last(<?php echo $jumPage; ?>)</a></li>
            </ul>
			<?php
			}
			?>
        </div>
    </div>
 <!--=========================================================================================================================-->
 <!--==================input===================================================================================================-->	
	<div class="tab-pane" id="new">
		<form class="form-horizontal" method="post" action="proses/master_kelas/input.php">
			<div class="control-group">
				<label class="control-label" for="inputJurusan">Level</label>
				<div class="controls">
					<select name="kelas">
						<option value="I">I</option>
						<option value="II">II</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputJurusan">Server</label>
				<div class="controls">
					<select name="jurusan">
					<?php
						$query_input_jurusan = mysql_query("select*from jurusan");
						while($array_input_jurusan = mysql_fetch_array($query_input_jurusan)){
							echo "<option value='".$array_input_jurusan['id']."'>".$array_input_jurusan['nama_jurusan']."</option>";
						}
					?>
					</select>
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
		function edit(id,id_jurusan,nama,nama_jurusan){
			var idstr = id;
			var idjurusanstr = id_jurusan;
			var namastr = nama;
			var nama_jurusanstr = nama_jurusan;
			document.fedit.id_kelas.value = idstr;
			document.fedit.kelas.value=namastr;
			document.fedit.kelas_tampil.value=namastr;
			document.fedit.nama_jurusan.value=nama_jurusanstr;
			document.fedit.jurusan.value=idjurusanstr;
			
		}
		function addText_kelas() {
		  var x = document.getElementById("combo_kelas");
		  var y = document.getElementById("txt_kelas");
		  var z = document.getElementById("txt_kelas_tampil");
		  if(x.value != "change"){
		  getCmb1 = x.value;
		  y.value = getCmb1;
		  z.value = getCmb1;
		  }
		}
		function addText_jurusan() {
		  var x = document.getElementById("combo_jurusan");
		  var y = document.getElementById("txt_jurusan");
		  var z = document.getElementById("id_jurusan");
		  if(x.value != "change"){
		  getCmb1 = x.value.split("-");
		  y.value = getCmb1[1];
		  z.value = getCmb1[0];
		  }
		}
		</script>
		
		<div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form action="proses/master_kelas/edit.php" method="post" name="fedit">
			  <input type="hidden" name="id_kelas" id="id_kelas">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Edit Server</h3>
			  </div>
			  <div class="modal-body">
					<div class="control-group">
						<label class="control-label">Level</label>
						<div class="controls">
							<input type='text' name='kelas_tampil' id="txt_kelas_tampil" disabled class='input-mini uneditable-input'>
							<input type='hidden' name='kelas' id="txt_kelas">
							<select id="combo_kelas" onchange="javascript: addText_kelas();">
								<option value='change'>---Ganti---</option>
								<option value="I">I</option>
								<option value="II">II</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Server</label>
						<div class="controls">
							<input type='text' value='' name='nama_jurusan' id="txt_jurusan" disabled class='input-mini uneditable-input'>
							<input type='hidden' name='jurusan' id="id_jurusan">
							<select id="combo_jurusan" onchange="javascript: addText_jurusan();">
								<option value='change'>---Ganti---</option>
							<?php
								$query_edit_jurusan = mysql_query("select*from jurusan");
								while($array_edit_jurusan = mysql_fetch_array($query_edit_jurusan)){
									echo "<option value='".$array_edit_jurusan['id']."-".$array_edit_jurusan['nama_jurusan']."'>".$array_edit_jurusan['nama_jurusan']."</option>";
								}
							?>
							</select>
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
