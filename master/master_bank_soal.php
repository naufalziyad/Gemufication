<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-wysihtml5.css"></link>
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
		<h2>Bank Soal</h2>
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
			<input type="hidden" name="page" value="Bank Soal">
			<input type="text" class="span2 search-query" placeholder="search" name="txt_search">
			<select class="span2" name="jenis_search">
				<option value='bank_soal.id'>ID</option>
				<option value='bank_soal.id_ujian'>ID Ujian</option>
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
                    <th>Ujian(Id)</th>
                    <th>Pertanyaan</th>
                    <th>Banyak Pilihan</th>
                    <th>Jenis Pilihan</th>
                    <th>Jawaban Benar</th>
                    <th>Pembuat</th>
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
		$jenis_search = isset($_GET["jenis_search"])?$_GET["jenis_search"]:'';
		if(!empty($txt_search)){
			if(isset($_SESSION["guru"])){
				$id_guru = $_SESSION["guru"];
				$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM bank_soal,ujian where bank_soal.id_ujian=ujian.id and bank_soal.id_guru='$id_guru' and $jenis_search like '%$txt_search%'");
				$query_page = mysql_query("select bank_soal.id_guru,bank_soal.jenis_pilihan,bank_soal.id,bank_soal.id_ujian,bank_soal.pertanyaan,bank_soal.jawaban_benar,bank_soal.banyak_pilihan,bank_soal.a,bank_soal.b,bank_soal.c,bank_soal.d,bank_soal.e from bank_soal,ujian where bank_soal.id_ujian=ujian.id AND bank_soal.id_guru='$id_guru' and $jenis_search like '%$txt_search%' order by ujian.tgl_input desc LIMIT $offset, $dataPerPage");
			}else{
				$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM bank_soal,ujian where bank_soal.id_ujian=ujian.id and $jenis_search like '%$txt_search%'");
				$query_page = mysql_query("select bank_soal.id_guru,bank_soal.jenis_pilihan,bank_soal.id,bank_soal.id_ujian,bank_soal.pertanyaan,bank_soal.jawaban_benar,bank_soal.banyak_pilihan,bank_soal.a,bank_soal.b,bank_soal.c,bank_soal.d,bank_soal.e from bank_soal,ujian where bank_soal.id_ujian=ujian.id and $jenis_search like '%$txt_search%' order by ujian.tgl_input desc LIMIT $offset, $dataPerPage");
			}
		}else{
			if(isset($_SESSION["guru"])){
				$id_guru = $_SESSION["guru"];
				$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM bank_soal where id_guru='$id_guru'");
				$query_page = mysql_query("select bank_soal.id_guru,bank_soal.jenis_pilihan,bank_soal.id,bank_soal.id_ujian,bank_soal.pertanyaan,bank_soal.jawaban_benar,bank_soal.banyak_pilihan,bank_soal.a,bank_soal.b,bank_soal.c,bank_soal.d,bank_soal.e from bank_soal,ujian where bank_soal.id_ujian=ujian.id AND bank_soal.id_guru='$id_guru' order by ujian.tgl_input desc LIMIT $offset, $dataPerPage");
			}else{
				$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM bank_soal");
				$query_page = mysql_query("select bank_soal.id_guru,bank_soal.jenis_pilihan,bank_soal.id,bank_soal.id_ujian,bank_soal.pertanyaan,bank_soal.jawaban_benar,bank_soal.banyak_pilihan,bank_soal.a,bank_soal.b,bank_soal.c,bank_soal.d,bank_soal.e from bank_soal,ujian where bank_soal.id_ujian=ujian.id order by ujian.tgl_input desc LIMIT $offset, $dataPerPage");
			}
		}

			$array_count   = mysql_fetch_array($query_count);
			$jml_data = $array_count["jml_data"];
			$jumPage = ceil($jml_data/$dataPerPage);
			
			while($array_page = mysql_fetch_array($query_page)){
				$arr_nama_kelas = isset($array_page['nama_kelas'])?$array_page['nama_kelas']:'';
				$arr_nama_jurusan = isset($array_page['nama_jurusan'])?$array_page['nama_jurusan']:'';
				$nama_kelas = $arr_nama_kelas."-".$arr_nama_jurusan;
				$id_guru = $array_page["id_guru"];
				$id_ujian = $array_page["id_ujian"];
				$query_page_ujian = mysql_query("select ujian.nama_ujian from ujian,matpel where ujian.id_matpel=matpel.id and ujian.id='$id_ujian'");
				$array_page_ujian = mysql_fetch_array($query_page_ujian);
		?>
            <tr>
                <td><?php echo $array_page["id"]; ?></td>
                <td><?php echo $array_page_ujian["nama_ujian"]." (".$id_ujian.")"; ?></td>
                <td><?php echo htmlspecialchars_decode($array_page["pertanyaan"]); ?></td>
                <td><?php echo $array_page["banyak_pilihan"]." pilihan"; ?></td>
                <td><?php echo $array_page["jenis_pilihan"]; ?></td>
                <td><?php echo $array_page["jawaban_benar"]; ?></td>
				<?php
					$query_page_guru = mysql_query("select*from guru where id='$id_guru'");
					$array_page_guru = mysql_fetch_array($query_page_guru);
						if(!empty($array_page_guru["nama_guru"])){
							echo "<td>".$array_page_guru["nama_guru"]."</td>";
						}else{
							echo "<td>#Admin</td>";
						}
				?>
                <td>
                    <a href="#edit" data-toggle="modal" onclick="javacript:edit(<?php echo $array_page['id'].",".$id_ujian.",'".$array_page_ujian['nama_ujian']."','".$array_page['pertanyaan']."','".$array_page['jenis_pilihan']."','".$array_page['banyak_pilihan']."','".$array_page['a']."','".$array_page['b']."','".$array_page['c']."','".$array_page['d']."','".$array_page['e']."','".$array_page['jawaban_benar']."'";?>)"><i class="icon-edit"></i></a>
                    <a href="javascript:confirmDelete('proses/master_bank_soal/delete.php?id=<?php echo $array_page["id"]; ?>')"><i class="icon-remove"></i></a>
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
                <li><a href="?page=Bank%20Soal&halaman=1&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?>">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Bank%20Soal&halaman=".($noPage-1)."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Bank%20Soal&halaman=".$noPage2."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Bank%20Soal&halaman=".$noPage1."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Bank%20Soal&halaman=".$noPage."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Bank%20Soal&halaman=".$noPage3."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage3."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Bank%20Soal&halaman=".$noPage4."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Bank%20Soal&halaman=".($noPage+1)."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Bank%20Soal&halaman=<?php echo $jumPage; ?>&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?>">Last(<?php echo $jumPage; ?>)</a></li>
            </ul>
			<?php
			}else{
			?>
			<ul>
                <li><a href="?page=Bank%20Soal&halaman=1">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Bank%20Soal&halaman=".($noPage-1)."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Bank%20Soal&halaman=".$noPage2."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Bank%20Soal&halaman=".$noPage1."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Bank%20Soal&halaman=".$noPage."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Bank%20Soal&halaman=".$noPage3."'>".$noPage3."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Bank%20Soal&halaman=".$noPage4."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Bank%20Soal&halaman=".($noPage+1)."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Bank%20Soal&halaman=<?php echo $jumPage; ?>">Last(<?php echo $jumPage; ?>)</a></li>
            </ul>			
			<?php
			}
			?>
        </div>
    </div>
 <!--=========================================================================================================================-->
 <!--==================input===================================================================================================-->	
<script>
function banyak_jawaban(jml){
	if(jml == "3"){
		document.getElementById("D").disabled = true;
		document.getElementById("E").disabled = true;
	}
	else if(jml == "4"){
		document.getElementById("D").disabled = false;
		document.getElementById("E").disabled = true;
	}
	else if(jml == "5"){
		document.getElementById("D").disabled = false;
		document.getElementById("E").disabled = false;
	}
}
</script>
	<div class="tab-pane" id="new">
		<form class="form-horizontal" method="post" action="proses/master_bank_soal/input.php">
			<div class="control-group">
				<label class="control-label">Nama Ujian</label>
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
				<label class="control-label">Pertanyaan</label>
				<div class="controls">
					<textarea rows="3" name="pertanyaan" id="pertanyaan_input" class="textarea" style="width: 810px; height: 200px"></textarea>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Jenis Jawaban</label>
				<div class="controls">
					<span class='uneditable-input'>Text</span>
					<input name='jenis_jawaban' type="hidden" value="text">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Jumlah Jawaban</label>
				<div class="controls">
					<select name='banyak_pilihan' onchange="javascript:banyak_jawaban(document.getElementById('pilihan-jawaban').value);" data-target="#jawaban" id="pilihan-jawaban">
						<option value="3">3 pilihan</option>
						<option value="4">4 pilihan</option>
						<option value="5">5 pilihan</option>
					</select>
				</div>
			</div>
			<!--=========jawaban==========-->
			<div class="control-group">
				<label class="control-label">Jawaban A</label>
				<div class="controls">
					<textarea rows="3" name="a"></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Jawaban B</label>
				<div class="controls">
					<textarea rows="3" name="b"></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Jawaban C</label>
				<div class="controls">
					<textarea rows="3" name="c"></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Jawaban D</label>
				<div class="controls">
					<textarea id="D" rows="3" name="d" disabled="true"></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Jawaban E</label>
				<div class="controls">
					<textarea rows="3" id="E" name="e" disabled="true"></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Jawaban Benar</label>
				<div class="controls">
					<select name="jawaban_benar">
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
						<option value="D">D</option>
						<option value="E">E</option>
					</select>
				</div>
			</div>
			<!--==========================-->
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
		function edit(id,id_ujian,nama_ujian,pertanyaan,jenis_pilihan,banyak_pilihan,a,b,c,d,e,jawaban_benar){
			var idstr = id;
			var id_ujianstr = id_ujian;
			var nama_ujianstr = nama_ujian;
			var pertanyaanstr = pertanyaan;
			var jenis_pilihanstr = jenis_pilihan;
			var banyak_pilihanstr = banyak_pilihan;
			var astr = a;
			var bstr = b;
			var cstr = c;
			var dstr = d;
			var estr = e;
			var jawaban_benarstr = jawaban_benar;
			document.fedit.id_soal.value = idstr;
			document.fedit.ujian2.value = nama_ujianstr;
			document.fedit.ujian.value = id_ujianstr;
			document.fedit.jenis_pilihan.value = jenis_pilihanstr;
			document.fedit.jenis_pilihan2.value = jenis_pilihanstr;
			document.fedit.banyak_pilihan2.value = banyak_pilihanstr+" Pilihan";
			document.fedit.banyak_pilihan.value = banyak_pilihanstr;
			document.getElementById("pertanyaan").value = pertanyaanstr;
			document.getElementById("a_edit").value = astr;
			document.getElementById("b_edit").value = bstr;
			document.getElementById("c_edit").value = cstr;
			document.getElementById("d_edit").value = dstr;
			document.getElementById("e_edit").value = estr;
			document.fedit.jawaban_benar2.value = jawaban_benarstr;
			document.fedit.jawaban_benar.value = jawaban_benarstr;
			
			if(banyak_pilihanstr == "3"){
				document.getElementById("d_edit").disabled = true;
				document.getElementById("e_edit").disabled = true;
			}
			else if(banyak_pilihanstr == "4"){
				document.getElementById("d_edit").disabled = false;
				document.getElementById("e_edit").disabled = true;
			}
			else if(banyak_pilihanstr == "5"){
				document.getElementById("d_edit").disabled = false;
				document.getElementById("e_edit").disabled = false;
			}
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
		function addText_banyak_pilihan() {
		  var x = document.getElementById("banyak_pilihan_combo");
		  var y = document.getElementById("banyak_pilihan_txt");
		  var z = document.getElementById("banyak_pilihan_txt2");
		  if(x.value != "change"){
		  getCmb1 = x.value;
		  y.value = getCmb1;
		  z.value = getCmb1+" Pilihan";
		  }
			if(x.value == "3"){
				document.getElementById("d_edit").disabled = true;
				document.getElementById("e_edit").disabled = true;
			}
			else if(x.value == "4"){
				document.getElementById("d_edit").disabled = false;
				document.getElementById("e_edit").disabled = true;
			}
			else if(x.value == "5"){
				document.getElementById("d_edit").disabled = false;
				document.getElementById("e_edit").disabled = false;
			}
		}
		function addText_jawaban_benar() {
		  var x = document.getElementById("jawaban_benar_combo");
		  var y = document.getElementById("jawaban_benar_txt");
		  var z = document.getElementById("jawaban_benar_txt2");
		  if(x.value != "change"){
		  getCmb1 = x.value;
		  y.value = getCmb1;
		  z.value = getCmb1;
		  }
		}

 		</script>
		<div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form action="proses/master_bank_soal/edit.php" method="POST" name="fedit">
			  <input type="hidden" value="" name="id_soal">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Edit Ujian</h3>
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
					<label class="control-label">Pertanyaan</label>
					<div class="controls">
						<textarea rows="3" name="pertanyaan" id="pertanyaan"></textarea>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Jenis Pilihan</label>
					<div class="controls">
						<input type='text' name="jenis_pilihan2" disabled class='input-medium uneditable-input'></input>
						<input name='jenis_pilihan' type="hidden" value="">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Banyak Pilihan</label>
					<div class="controls">
						<input type='text' value='' name='banyak_pilihan2' id="banyak_pilihan_txt2" disabled class='input-medium uneditable-input'>
						<input type='hidden' value='' name="banyak_pilihan" id="banyak_pilihan_txt">
						<select id='banyak_pilihan_combo' onchange="javascript: addText_banyak_pilihan();" data-target="#jawaban" >
							<option value='change'>---Ganti---</option>
							<option value="3">3 pilihan</option>
							<option value="4">4 pilihan</option>
							<option value="5">5 pilihan</option>
						</select>
					</div>
				</div>
				<!--=========jawaban==========-->
				<div class="control-group">
					<label class="control-label">Jawaban A</label>
					<div class="controls">
						<textarea rows="3" name="a" id="a_edit"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Jawaban B</label>
					<div class="controls">
						<textarea rows="3" name="b" id="b_edit"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Jawaban C</label>
					<div class="controls">
						<textarea rows="3" name="c" id="c_edit"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Jawaban D</label>
					<div class="controls">
						<textarea rows="3" name="d" id="d_edit"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Jawaban E</label>
					<div class="controls">
						<textarea rows="3" name="e" id="e_edit"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Jawaban Benar</label>
					<div class="controls">
						<input type='text' value='' name='jawaban_benar2' id="jawaban_benar_txt2" disabled class='input-medium uneditable-input'>
						<input type='hidden' value='' name="jawaban_benar" id="jawaban_benar_txt">
						<select id="jawaban_benar_combo" onchange="javascript: addText_jawaban_benar();">
							<option value='change'>---Ganti---</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
							<option value="E">E</option>
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

<script src="assets/js/wysihtml5-0.3.0.js"></script>
<script src="assets/js/jquery-1.7.2.min.js"></script>
<script src="assets/js/bootstrap-wysihtml5.js"></script>

<script>
	$('.textarea').wysihtml5();
</script>