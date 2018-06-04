		<?php
		if(!empty($_POST["success"])){$success = $_POST["success"];}else{$success = @$_GET["success"];}
		if($success == "ganti_password"){
			echo "
			<br>
			<div class='alert fade in alert-success'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>Ganti Password Success</strong>
			</div>
			";
		}
		else if($success == "input"){
			echo "
			<br>
			<div class='alert fade in alert-success'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>Data berhasil disimpan</strong>
			</div>
			";
		}
		else if($success == "pengaturan"){
			echo "
			<br>
			<div class='alert fade in alert-success'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>Pengaturan berhasil disimpan</strong>
			</div>
			";
		}
		else if($success == "delete"){
			echo "
			<br>
			<div class='alert fade in alert-success'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>Data berhasil dihapus</strong>
			</div>
			";
		}
		else if($success == "edit"){
			echo "
			<br>
			<div class='alert fade in alert-success'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>Data berhasil diubah</strong>
			</div>
			";
		}
		?>