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
		<h2>Member Scope</h2>
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
			<input type="hidden" name="page" value="Member">
			<input type="text" class="span2 search-query" placeholder="search" name="txt_search">
			<select class="span2" name="jenis_search">
				<option value='siswa.id'>ID</option>
				<option value='siswa.nis'>No Induk</option>
				<option value='siswa.nama_siswa'>Nama Member</option>
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
                    <th>No Induk</th>
                    <th>Nama Member</th>
                    <th>Level-Server</th>
                    <th>Password</th>
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
			if(empty($_GET['kelas']) || $_GET['kelas'] == "all"){
			$get_kelas = "";
			}else{
			$get_kelas = "and siswa.id_kelas='".$_GET['kelas']."' ";
			}
			$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM siswa where $jenis_search like '%$txt_search%' $get_kelas");
			$array_count   = mysql_fetch_array($query_count);
			$query_page = mysql_query("select siswa.id,siswa.id_kelas,siswa.nis,siswa.nama_siswa,siswa.password,kelas.nama_kelas,jurusan.nama_jurusan from siswa,kelas,jurusan where siswa.id_kelas=kelas.id and kelas.id_jurusan=jurusan.id $get_kelas and $jenis_search like '%$txt_search%' LIMIT $offset, $dataPerPage");
		}else{
			if(empty($_GET['kelas']) || $_GET['kelas'] == "all"){
			$get_kelas = "";
			}else{
			$get_kelas = "where siswa.id_kelas='".$_GET['kelas']."' ";
			$get_kelas2 = "and siswa.id_kelas='".$_GET['kelas']."' ";
			}
			$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM siswa $get_kelas");
			$array_count   = mysql_fetch_array($query_count);
			$query_page = mysql_query("select siswa.id,siswa.id_kelas,siswa.nis,siswa.nama_siswa,siswa.password,kelas.nama_kelas,jurusan.nama_jurusan from siswa,kelas,jurusan where siswa.id_kelas=kelas.id and kelas.id_jurusan=jurusan.id $get_kelas2 LIMIT $offset, $dataPerPage");
		}

			$jml_data = $array_count["jml_data"];
			$jumPage = ceil($jml_data/$dataPerPage);

			while($array_page = mysql_fetch_array($query_page)){
				$nama_kelas = $array_page['nama_kelas']."-".$array_page['nama_jurusan'];
		?>
            <tr>
                <td><?php echo $array_page["id"]; ?></td>
                <td><?php echo $array_page["nis"]; ?></td>
                <td><?php echo $array_page["nama_siswa"]; ?></td>
                <td><?php echo $nama_kelas; ?></td>
                <td><?php echo $array_page["password"]; ?></td>
                <td>
                    <a href="#edit" data-toggle="modal" onclick="javacript:edit(<?php echo $array_page['id'].",'".$array_page['id_kelas']."','".$array_page['nis']."','".$array_page['nama_siswa']."','".$nama_kelas."','".$array_page["password"]."'";?>)"><i class="icon-edit"></i></a>
                    <a href="javascript:confirmDelete('proses/master_siswa/delete.php?id=<?php echo $array_page["id"]; ?>')"><i class="icon-remove"></i></a>
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
                <li><a href="?page=Member&halaman=1&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?><?php echo $paging_kelas; ?>">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Member&halaman=".($noPage-1)."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Member&halaman=".$noPage2."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Member&halaman=".$noPage1."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Member&halaman=".$noPage."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Member&halaman=".$noPage3."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage3."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Member&halaman=".$noPage4."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Member&halaman=".($noPage+1)."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Member&halaman=<?php echo $jumPage; ?>&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?><?php echo $paging_kelas; ?>">Last(<?php echo $jumPage; ?>)</a></li>
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
                <li><a href="?page=Member&halaman=1<?php echo $paging_kelas; ?>">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Member&halaman=".($noPage-1).$paging_kelas."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Member&halaman=".$noPage2.$paging_kelas."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Member&halaman=".$noPage1.$paging_kelas."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Member&halaman=".$noPage.$paging_kelas."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Member&halaman=".$noPage3."'>".$noPage3.$paging_kelas."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Member&halaman=".$noPage4.$paging_kelas."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Member&halaman=".($noPage+1).$paging_kelas."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Member&halaman=<?php echo $jumPage; ?><?php echo $paging_kelas; ?>">Last(<?php echo $jumPage; ?>)</a></li>
            </ul>
			<?php
			}
			?>
        </div>
    </div>
 <!--=========================================================================================================================-->
 <!--==================input===================================================================================================-->	
	<div class="tab-pane" id="new">
		<form class="form-horizontal" method="post" action="proses/master_siswa/input.php">
			<div class="control-group">
				<label class="control-label" for="inputJurusan">No Induk</label>
				<div class="controls">
					<input type="text" id="inputJurusan" placeholder="NIS" name="nis">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputJurusan">Nama Member</label>
				<div class="controls">
					<input type="text" id="inputJurusan" placeholder="nama" name="nama">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputJurusan">Level-Server</label>
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
				<label class="control-label" for="inputJurusan">Password</label>
				<div class="controls">
					<input type="password" id="inputJurusan" placeholder="Password" name="password">
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
		function edit(id,idkelas,nis,nama,kelas,password){
			var idstr = id;
			var nisstr = nis;
			var idkelasstr = idkelas;
			var namastr = nama;
			var kelasstr = kelas;
			var passwordstr = password;
			document.fedit.id_siswa.value = idstr;
			document.fedit.nis.value = nisstr;
			document.fedit.before_nis.value = nisstr;
			document.fedit.nama.value = namastr;
			document.fedit.nama_kelas.value=kelasstr;
			document.fedit.kelas.value=idkelasstr;
			document.fedit.password2.value = passwordstr;
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
 		</script>
		<div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form action="proses/master_siswa/edit.php" method="POST" name="fedit">
			  <input type="hidden" value="" name="id_siswa">
			  <input type="hidden" value="" name="password2">
			  <input type="hidden" value="" name="before_nis">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Edit Member</h3>
			  </div>
			  <div class="modal-body">
					<div class="control-group">
						<label class="control-label" for="inputJurusan">No Induk</label>
						<div class="controls">
							<input type="text" id="inputJurusan" placeholder="NIS" name="nis">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="inputJurusan">Nama Member</label>
						<div class="controls">
							<input type="text" id="inputJurusan" placeholder="nama" name="nama">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="inputJurusan">Level-Server</label>
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
					<div class="control-group info">
						<label class="control-label" for="inputJurusan">New Password </label>
						<div class="controls">
							<input type="password" id="inputInfo" placeholder="Password" name="password">
							<span class="help-inline">Kosongkan Bila tidak diubah</span>
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
