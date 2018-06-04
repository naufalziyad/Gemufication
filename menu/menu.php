<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="nav-collapse collapse">
			<!---------------------------------------------------------->
			<?php
			if(isset($_SESSION["admin"])){
				$id_user = $_SESSION["admin"];
				$user_type = "admin";
				include("admin.php");
				include("user.php");
			}else if(isset($_SESSION["siswa"])){
				$id_user = $_SESSION["siswa"];
				$user_type = "siswa";
				include("siswa.php");
				include("user.php");
			}
			?>

