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
		<h2>Data Ujian</h2>
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
			<input type="hidden" name="page" value="Ujian">
			<input type="text" class="span2 search-query" placeholder="search" name="txt_search">
			<select class="span2" name="jenis_search">
				<option value='ujian.id'>ID</option>
				<option value='ujian.nama_ujian'>Nama Ujian</option>
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
                    <th>Kategori Ujian</th>
                    <th>Nama Ujian</th>
                    <th>Pembuat</th>
                    <th>Waktu</th>
                    <th>Tanggal Pembuatan</th>
                    <th>Jumlah Soal</th>
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
		
			if(empty($_GET['kelas']) || $_GET['kelas'] == "all"){
				$get_kelas = "";
			}else{
				$get_kelas = "and matpel.id_kelas='".$_GET['kelas']."' ";
			}
			
		if(!empty($txt_search)){
				if(isset($_SESSION["guru"])){
					$id_guru = $_SESSION["guru"];
					$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM ujian,matpel where ujian.id_matpel=matpel.id and ujian.id_guru='$id_guru' and $jenis_search like '%$txt_search%' $get_kelas");
					$query_page = mysql_query("select ujian.id,ujian.jml_soal,ujian.id_matpel,ujian.text_pembuka,ujian.tgl_input,ujian.id_guru,ujian.nama_ujian,ujian.waktu,matpel.nama_matpel from ujian,matpel where ujian.id_matpel=matpel.id AND ujian.id_guru='$id_guru' $get_kelas and $jenis_search like '%$txt_search%' order by ujian.tgl_input desc LIMIT $offset, $dataPerPage");
				}else{
					$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM ujian,matpel where ujian.id_matpel=matpel.id and $jenis_search like '%$txt_search%' $get_kelas");
					$query_page = mysql_query("select ujian.id,ujian.jml_soal,ujian.id_matpel,ujian.text_pembuka,ujian.tgl_input,ujian.id_guru,ujian.nama_ujian,ujian.waktu,matpel.nama_matpel from ujian,matpel where ujian.id_matpel=matpel.id $get_kelas and $jenis_search like '%$txt_search%' order by ujian.tgl_input desc LIMIT $offset, $dataPerPage");
				}
		}else{
				if(isset($_SESSION["guru"])){		
					$id_guru = $_SESSION["guru"];
					$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM ujian,matpel where ujian.id_matpel=matpel.id and ujian.id_guru='$id_guru' $get_kelas");
					$query_page = mysql_query("select ujian.id,ujian.jml_soal,ujian.id_matpel,ujian.text_pembuka,ujian.tgl_input,ujian.id_guru,ujian.nama_ujian,ujian.waktu,matpel.nama_matpel from ujian,matpel where ujian.id_matpel=matpel.id AND ujian.id_guru='$id_guru' $get_kelas order by ujian.tgl_input desc LIMIT $offset, $dataPerPage");
				}else{
					$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM ujian,matpel where ujian.id_matpel=matpel.id $get_kelas");
					$query_page = mysql_query("select ujian.id,ujian.jml_soal,ujian.id_matpel,ujian.text_pembuka,ujian.tgl_input,ujian.id_guru,ujian.nama_ujian,ujian.waktu,matpel.nama_matpel from ujian,matpel where ujian.id_matpel=matpel.id $get_kelas order by ujian.tgl_input desc LIMIT $offset, $dataPerPage");
				}
		}

		
			$array_count   = mysql_fetch_array($query_count);
			$jml_data = $array_count["jml_data"];
			$jumPage = ceil($jml_data/$dataPerPage);
			
			while($array_page = mysql_fetch_array($query_page)){
				$id_matpel_page_kelas = $array_page["id_matpel"];
				$query_page_kelas = mysql_query("select kelas.nama_kelas,jurusan.nama_jurusan from matpel,kelas,jurusan where matpel.id_kelas=kelas.id and kelas.id_jurusan=jurusan.id and matpel.id='$id_matpel_page_kelas'");
				$array_page_kelas = mysql_fetch_array($query_page_kelas);
				$nama_kelas = $array_page_kelas['nama_kelas']."-".$array_page_kelas['nama_jurusan'];
				$id_guru = $array_page["id_guru"];
		?>
            <tr>
                <td><?php echo $array_page["id"]; ?></td>
                <td><?php echo $array_page["nama_matpel"]." [".$nama_kelas."]"; ?></td>
                <td><?php echo $array_page["nama_ujian"]; ?></td>
				<?php
					$query_page_guru = mysql_query("select*from guru where id='$id_guru'");
					$array_page_guru = mysql_fetch_array($query_page_guru);
						if(!empty($array_page_guru["nama_guru"])){
							echo "<td>".$array_page_guru["nama_guru"]."</td>";
						}else{
							echo "<td>#Admin</td>";
						}
				?>
                <td><?php echo $array_page["waktu"]." menit"; ?></td>
                <td><?php echo $array_page["tgl_input"]; ?></td>
                <td><?php echo $array_page["jml_soal"]; ?></td>
                <td>
                    <a href="#edit" data-toggle="modal" onclick="javacript:edit(<?php echo $array_page['id'].",".$array_page['jml_soal'].",'".$array_page['id_matpel']."','".$array_page['nama_matpel']." [".$nama_kelas."]','".$array_page['nama_ujian']."','".$array_page['waktu']."','".$array_page['text_pembuka']."'";?>)"><i class="icon-edit"></i></a>
                    <a href="javascript:confirmDelete('proses/master_ujian/delete.php?id=<?php echo $array_page["id"]; ?>')"><i class="icon-remove"></i></a>
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
                <li><a href="?page=Ujian&halaman=1&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?><?php echo $paging_kelas; ?>">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Ujian&halaman=".($noPage-1)."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Ujian&halaman=".$noPage2."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Ujian&halaman=".$noPage1."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Ujian&halaman=".$noPage."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Ujian&halaman=".$noPage3."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage3."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Ujian&halaman=".$noPage4."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Ujian&halaman=".($noPage+1)."&txt_search=".$txt_search."&jenis_search=".$jenis_search.$paging_kelas."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Ujian&halaman=<?php echo $jumPage; ?>&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?><?php echo $paging_kelas; ?>">Last(<?php echo $jumPage; ?>)</a></li>
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
                <li><a href="?page=Ujian&halaman=1<?php echo $paging_kelas; ?>">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Ujian&halaman=".($noPage-1).$paging_kelas."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Ujian&halaman=".$noPage2.$paging_kelas."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Ujian&halaman=".$noPage1.$paging_kelas."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Ujian&halaman=".$noPage.$paging_kelas."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Ujian&halaman=".$noPage3.$paging_kelas."'>".$noPage3."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Ujian&halaman=".$noPage4.$paging_kelas."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Ujian&halaman=".($noPage+1).$paging_kelas."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Ujian&halaman=<?php echo $jumPage; ?><?php echo $paging_kelas; ?>">Last(<?php echo $jumPage; ?>)</a></li>
            </ul>
			<?php
			}
			?>
        </div>
    </div>
 <!--=========================================================================================================================-->
 <!--==================input===================================================================================================-->	
	<div class="tab-pane" id="new">
		<form class="form-horizontal" method="post" action="proses/master_ujian/input.php">
			<div class="control-group">
				<label class="control-label">Kategori</label>
				<div class="controls">
					<select name="matpel">
					<?php
						$query_input_matpel = mysql_query("select matpel.id,matpel.nama_matpel,kelas.nama_kelas,jurusan.nama_jurusan from matpel,kelas,jurusan where matpel.id_kelas=kelas.id and kelas.id_jurusan=jurusan.id");
						while($array_input_matpel = mysql_fetch_array($query_input_matpel)){
							echo "<option value='".$array_input_matpel['id']."'>".$array_input_matpel['nama_matpel']." [".$array_input_matpel['nama_kelas']."-".$array_input_matpel['nama_jurusan']."]</option>";
						}
					?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Nama Ujian</label>
				<div class="controls">
					<input type="text" placeholder="Nama" name="nama">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Jumlah Soal</label>
				<div class="controls">
					<select name="jumlah_soal">
					<?php
						for($jml_soal=1;$jml_soal<=10;$jml_soal++){
							$jumlah_soal = $jml_soal*10;
							echo "<option value='".$jumlah_soal."'>".$jumlah_soal."</option>";
						}
					?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Waktu</label>
				<div class="controls">
					<select name="waktu">
					<?php
						for($waktu=1;$waktu<=16;$waktu++){
							$waktu_menit = $waktu*15;
							echo "<option value='".$waktu_menit."'>".$waktu_menit." menit</option>";
						}
					?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Text Pembuka</label>
				<div class="controls">
					<textarea rows="3" name="text_pembuka"></textarea>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<?php
						if(isset($_SESSION["guru"])){
							$id_guru_pembuat = $_SESSION["guru"];
							echo "<input type='hidden' name='id_guru' value='".$id_guru_pembuat."'>";
						}
					?>
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
		function edit(id,byk_soal,id_matpel,matpel,nama,waktu,text){
			var idstr = id;
			var idmatpelstr = id_matpel;
			var matpelstr = matpel;
			var namastr = nama;
			var waktustr = waktu;
			var textstr = text;
			var byk_soalstr = byk_soal;
			document.fedit.id_ujian.value = idstr;
			document.fedit.matpel.value = idmatpelstr;
			document.fedit.matpel2.value = matpelstr;
			document.fedit.nama.value = namastr;
			document.fedit.waktu2.value = waktustr+" menit";
			document.fedit.waktu.value = waktustr;		
			document.fedit.jumlah_soal2.value = byk_soalstr;
			document.fedit.jumlah_soal.value = byk_soalstr;
			document.getElementById("text_pembuka").value = textstr;
		}
		function addText_matpel() {
		  var x = document.getElementById("combo_matpel");
		  var y = document.getElementById("matpel_txt");
		  var z = document.getElementById("matpel_txt2");
		  if(x.value != "change"){
		  getCmb1 = x.value.split("|");
		  y.value = getCmb1[1];
		  z.value = getCmb1[0];
		  }
		}		
		function addText_waktu() {
		  var x = document.getElementById("combo_waktu");
		  var y = document.getElementById("waktu_txt");
		  var z = document.getElementById("waktu_txt2");
		  if(x.value != "change"){
		  getCmb1 = x.value;
		  y.value = getCmb1;
		  z.value = getCmb1+" menit";
		  }
		}	
		function addText_jumlah_soal() {
		  var x = document.getElementById("combo_jumlah_soal");
		  var y = document.getElementById("jumlah_soal_txt");
		  var z = document.getElementById("jumlah_soal_txt2");
		  if(x.value != "change"){
		  getCmb1 = x.value;
		  y.value = getCmb1;
		  z.value = getCmb1;
		  }
		}
 		</script>
		<div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form action="proses/master_ujian/edit.php" method="POST" name="fedit">
			  <input type="hidden" value="" name="id_ujian">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Edit Ujian</h3>
			  </div>
			  <div class="modal-body">
			<div class="control-group">
				<label class="control-label" for="inputJurusan">Kategori</label>
				<div class="controls">
					<input type='text' value='' name='matpel2' id="matpel_txt" disabled class='input-medium uneditable-input'>
					<input type='hidden' value='' name="matpel" id="matpel_txt2">
					<select id="combo_matpel" onchange="javascript: addText_matpel();">
						<option value='change'>---Ganti---</option>
					<?php
						$query_input_matpel = mysql_query("select matpel.id,matpel.nama_matpel,kelas.nama_kelas,jurusan.nama_jurusan from matpel,kelas,jurusan where matpel.id_kelas=kelas.id and kelas.id_jurusan=jurusan.id");
						while($array_input_matpel = mysql_fetch_array($query_input_matpel)){
							echo "<option value='".$array_input_matpel['id']."|".$array_input_matpel['nama_matpel']." [".$array_input_matpel['nama_kelas']."-".$array_input_matpel['nama_jurusan']."]'>".$array_input_matpel['nama_matpel']." [".$array_input_matpel['nama_kelas']."-".$array_input_matpel['nama_jurusan']."]</option>";
						}
					?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputJurusan">Nama Ujian</label>
				<div class="controls">
					<input type="text" id="inputJurusan" placeholder="nama" name="nama">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Jumlah Soal</label>
				<div class="controls">
					<input type='text' value='' name='jumlah_soal2' id="jumlah_soal_txt2" disabled class='input-small uneditable-input'>
					<input type='hidden' value='' name="jumlah_soal" id="jumlah_soal_txt">
					<select id="combo_jumlah_soal" onchange="javascript: addText_jumlah_soal();">
						<option value='change'>---Ganti---</option>
					<?php
						for($jml_soal=1;$jml_soal<=10;$jml_soal++){
							$jumlah_soal = $jml_soal*10;
							echo "<option value='".$jumlah_soal."'>".$jumlah_soal."</option>";
						}
					?>
					?>
					</select>
				</div>
			<div class="control-group">
				<label class="control-label">Waktu</label>
				<div class="controls">
					<input type='text' value='' name='waktu2' id="waktu_txt2" disabled class='input-small uneditable-input'>
					<input type='hidden' value='' name="waktu" id="waktu_txt">
					<select id="combo_waktu" onchange="javascript: addText_waktu();">
						<option value='change'>---Ganti---</option>
					<?php
						for($waktu=1;$waktu<=16;$waktu++){
							$waktu_menit = $waktu*15;
							echo "<option value='".$waktu_menit."'>".$waktu_menit." menit</option>";
						}
					?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputJurusan">Text Pembuka</label>
				<div class="controls">
					<textarea rows="3" name="text_pembuka" id="text_pembuka"></textarea>
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
</div>
