			<ul class="nav pull-right">
            <!------------------------------------------------------------------>
			<?php
			if($user_type == "admin"){
				$query_menu_user = mysql_query("select*from admin where id='$id_user'");
				$array_menu_user = mysql_fetch_array($query_menu_user);
				$nama_menu_user = $array_menu_user["nama"];
			}else if($user_type == "siswa"){
				$query_menu_user = mysql_query("select*from siswa where id='$id_user'");
				$array_menu_user = mysql_fetch_array($query_menu_user);
				$nama_menu_user = $array_menu_user["nama_siswa"];
			}
			?>
			<!------------------------------------------------------------------>

				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Welcome, <?php echo $nama_menu_user; ?><b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#ganti_password" data-toggle="modal">Ganti Password</a></li>
                        <li class="divider"></li>
                        <li><a href="login/sign_out.php">Sign Out</a></li>
                    </ul>
                </li>
            </ul>
			<!---------------------------------------------------------->
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
			
			<!----Ganti Password-------------------------------------------------------------->
			<!-- Modal -->
			
			<div id="ganti_password" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form action="menu/ganti_password.php" method="POST">
			  <input type="hidden" value="<?php echo $user_type; ?>" name="user_type">
			  <input type="hidden" value="<?php echo $id_user; ?>" name="id_user">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Ganti Password</h3>
			  </div>
			  <div class="modal-body">
				<label>Masukan Password Lama :</label> 
					<input type="password" class="input-block-level" placeholder="Old Password" name="old_password">
				<label>Password Baru :</label> 
					<input type="password" class="input-block-level" placeholder="New Password" name="new_password">
			  </div>
			  <div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn btn-primary">Save changes</button>
			  </div>
			  </form>
			</div>
			

			<!------------------------------------------------------------------>			
			<!----Ganti title-------------------------------------------------------------->
			<!-- Modal -->
			<div id="ganti_title" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form action="menu/pengaturan.php" method="POST">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Pengaturan</h3>
			  </div>
			  <div class="modal-body">
				<label>Title :</label> 
					<input type='text' value="Gami_know" id="title" name="title" class="input-block-level">
				</div>
			  <div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn btn-primary">Save changes</button>
			  </div>
			  </form>
			</div>
			

			<!------------------------------------------------------------------>