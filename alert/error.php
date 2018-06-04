		<?php
		if(!empty($_POST["error"])){$error = $_POST["error"];}else{$error = @$_GET["error"];}
		
		if($error == "ganti_password"){
			echo "
			<br>
			<div class='alert fade in alert-error'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>Ganti Password Failed</strong>
			</div>
			";
		}
		else if($error == "empty"){
			echo "
			<br>
			<div class='alert fade in alert-error'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>Isi field yang masih kosong</strong>
			</div>
			";
		}
		else if($error == "pengaturan"){
			echo "
			<br>
			<div class='alert fade in alert-error'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>pengaturan gagal di simpan</strong>
			</div>
			";
		}
		else if($error == "same"){
			echo "
			<br>
			<div class='alert fade in alert-error'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>Data sudah ada</strong>
			</div>
			";
		}
		else if($error == "delete"){
			echo "
			<br>
			<div class='alert fade in alert-error'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>Data gagal dihapus</strong>
			</div>
			";
		}
		else if($error == "cant"){
			echo "
			<br>
			<div class='alert fade in alert-error'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>Input Error</strong>
			</div>
			";
		}
		?>