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
		<h2>Master Admin</h2>
	</div>
        
	<div>
        
		<ul class="nav nav-tabs">
            <li class="active"><a href="#list" data-toggle="tab"><i class="icon-list"></i>List</a></li>
            <li><a href="#new" data-toggle="tab"><i class="icon-plus-sign"></i>Create</a></li>
         </ul>
        
<div class="tab-content active">
 <!--==================tampil===================================================================================================-->
 
  <!--=====================================================================================================================-->
 		<form class="form-search" align="right" method="GET" action="">
		  <div class="input-append">
			<input type="hidden" name="page" value="Admin">
			<input type="text" class="span2 search-query" placeholder="search" name="txt_search">
			<select class="span2" name="jenis_search">
				<option value='id'>ID</option>
				<option value='nama'>Nama</option>
				<option value='username'>Username</option>
			</select>
			<button type="submit" class="btn">Search</button>
		  </div>
		</form>
 <!--=====================================================================================================================-->
 
    <div class="tab-pane active" id="list">
        <table class="table table-striped table-condensed table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
        <tbody>
		<?php
//-----------------------------------------------------------------------
		if(empty($_GET["txt_search"])){
		$txt_search="";
		}
		else{
		$txt_search=$_GET["txt_search"];
		}
		$jenis_search = $_GET["jenis_search"];
		if(!empty($txt_search)){
			$query_page = mysql_query("select*from admin where $jenis_search like '%$txt_search%' LIMIT $offset, $dataPerPage");
			$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM admin where $jenis_search like '%$txt_search%'");
		}else{
			$query_page = mysql_query("select*from admin LIMIT $offset, $dataPerPage");
			$query_count   = mysql_query("SELECT COUNT(*) AS jml_data FROM admin");
		}
//-----------------------------------------------------------------------			
			$array_count   = mysql_fetch_array($query_count);
			$jml_data = $array_count["jml_data"];
			$jumPage = ceil($jml_data/$dataPerPage);

			while($array_page = mysql_fetch_array($query_page)){
		?>
            <tr>
                <td><?php echo $array_page["id"]; ?></td>
                <td><?php echo $array_page["nama"]; ?></td>
                <td><?php echo $array_page["username"]; ?></td>
                <td><?php echo $array_page["password"]; ?></td>
                <td>
                    <a href="#edit" data-toggle="modal" onclick="javacript:edit(<?php echo $array_page['id'].",'".$array_page['nama']."','".$array_page['username']."','".$array_page["password"]."'";?>)"><i class="icon-edit"></i></a>
                    <a href="javascript:confirmDelete('proses/master_admin/delete.php?id=<?php echo $array_page["id"]; ?>')"><i class="icon-remove"></i></a>
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
                <li><a href="?page=Admin&halaman=1&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?>">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Admin&halaman=".($noPage-1)."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Admin&halaman=".$noPage2."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Admin&halaman=".$noPage1."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Admin&halaman=".$noPage."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Admin&halaman=".$noPage3."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage3."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Admin&halaman=".$noPage4."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Admin&halaman=".($noPage+1)."&txt_search=".$txt_search."&jenis_search=".$jenis_search."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Admin&halaman=<?php echo $jumPage; ?>&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?>">Last(<?php echo $jumPage; ?>)</a></li>
            </ul>
			<?php
			}else{
			?>
		   <ul>
                <li><a href="?page=Admin&halaman=1">First</a></li>
                <li>
					<?php
					if ($noPage > 1) echo  "<a href='?page=Admin&halaman=".($noPage-1)."'>Prev</a>";
                   ?>
                </li>
					<?php
						$noPage1 = $noPage - 1;
						$noPage2 = $noPage - 2;
						$noPage3 = $noPage + 1;
						$noPage4 = $noPage + 2;
						if($noPage > 2)echo "<li><a href='?page=Admin&halaman=".$noPage2."'>".$noPage2."</a></li>";
						if($noPage > 1)echo "<li><a href='?page=Admin&halaman=".$noPage1."'>".$noPage1."</a></li>";
						echo "<li class='active'><a href='?page=Admin&halaman=".$noPage."'>".$noPage."</a></li>";
						if($jumPage > $noPage){
							echo "<li><a href='?page=Admin&halaman=".$noPage3."'>".$noPage3."</a></li>";
							if($jumPage > $noPage3)echo "<li><a href='?page=Admin&halaman=".$noPage4."'>".$noPage4."</a></li>";
						}
					
					?>
                <li>
                        <?php
						if ($noPage < $jumPage) echo "<li><a href='?page=Admin&halaman=".($noPage+1)."'>Next</a>";
						?>
                </li>
                <li><a href="?page=Admin&halaman=<?php echo $jumPage; ?>">Last(<?php echo $jumPage; ?>)</a></li>
            </ul>			
			<?php
			}
			?>
        </div>
    </div>
 <!--=========================================================================================================================-->
 <!--==================input===================================================================================================-->	
	<div class="tab-pane" id="new">
		<form class="form-horizontal" method="post" action="proses/master_admin/input.php">
			<div class="control-group">
				<label class="control-label" for="inputJurusan">Nama</label>
				<div class="controls">
					<input type="text" id="inputJurusan" placeholder="nama" name="nama">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputJurusan">Username</label>
				<div class="controls">
					<input type="text" id="inputJurusan" placeholder="username" name="username">
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
		function edit(id,nama,username,password){
			var idstr = id;
			var namastr = nama;
			var usernamestr = username;
			var passwordstr = password;
			document.fedit.id_admin.value = idstr;
			document.fedit.nama.value = namastr;
			document.fedit.username.value = usernamestr;
			document.fedit.before_username.value = usernamestr;
			document.fedit.password2.value = passwordstr;
		}
		
 		</script>
		<div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form action="proses/master_admin/edit.php" method="POST" name="fedit">
			  <input type="hidden" value="" name="id_admin">
			  <input type="hidden" value="" name="password2">
			  <input type="hidden" value="" name="before_username">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Edit Admin</h3>
			  </div>
			  <div class="modal-body">
					<div class="control-group">
						<label class="control-label" for="inputJurusan">Nama</label>
						<div class="controls">
							<input type="text" id="inputJurusan" placeholder="nama" name="nama">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="inputJurusan">Username</label>
						<div class="controls">
							<input type="text" id="inputJurusan" placeholder="username" name="username">
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
