         <?php if(!empty($_POST["page"])){$page = $_POST["page"];}else{$page = @$_GET["page"];} ?>
			<ul class="nav">
				<li <?php if(empty($page)){echo "class='active'";}?>><a href="?page=">Home</a></li>
				<li class="dropdown <?php if($page == "Jurusan" || $page == "Kelas" || $page == "Mata Pelajaran" || $page == "Guru" || $page == "Admin" || $page == "Siswa" || $page == "Ujian" || $page == "Jadwal" || $page == "Bank Soal"){ echo "active"; } ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu<b class="caret"></b></a>
					<ul class="dropdown-menu">
					<?php
					$query_page_type = mysql_query("select*from page_type order by id");
					while($array_page_type = mysql_fetch_array($query_page_type)){
						$id_page_type = $array_page_type["id"];
					?>
							<li class="divider"></li>
							<li class="nav-header"><?php echo $array_page_type["page_type"]; ?></li>
							<?php
							$query_page = mysql_query("select*from pages where type='$id_page_type' order by id");
							while($array_page = mysql_fetch_array($query_page)){
								echo "<li><a href='?page=".$array_page['nama']."'>".$array_page['nama']."</a></li>";
							}
							?>
					<?php
					}
					?>
					</ul>
				</li>
				<li class="dropdown <?php if($page == "Laporan" || $page == "Laporan_Kelas"){ echo "active"; }?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="divider"></li>
						<li class="nav-header">Laporan Ujian</li>
						<li><a href="?page=Laporan">User</a></li>
					</ul>
				</li>
				<li <?php if($page == "About"){ echo "class='active'"; }?>><a href="?page=About">About</a></li>
            </ul>