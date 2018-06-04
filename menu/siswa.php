         <?php if(!empty($_POST["page"])){$page = $_POST["page"];}else{$page = @$_GET["page"];} ?>
			<ul class="nav">
				<li <?php if(empty($page)){echo "class='active'";}?>><a href="index2.php">Home</a></li>
				<li <?php if($page == "Laporan"){echo "class='active'";}?>><a href="?page=Laporan">Laporan</a></li>
				<li <?php if($page == "About"){ echo "class='active'"; }?>><a href="?page=About">About</a></li>
            </ul>