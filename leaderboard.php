<?php
session_start();
require("config/database.php");
if(isset($_SESSION["admin"]) || isset($_SESSION["siswa"])){
?>
<!DOCTYPE html>
<html>

<?php
    $id_user = $_SESSION["siswa"];
    $query_menu_user = mysql_query("select*from siswa where id='$id_user'");
    $array_menu_user = mysql_fetch_array($query_menu_user);
    $nama_menu_user = $array_menu_user["nama_siswa"];
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C:\Users\naufal\Documents\chalanngae</title>
    <link rel="stylesheet" href="assetsChallange/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsChallange/css/user.css">
    <link rel="stylesheet" href="assetsChallange/bootstrap/fonts/font-awesome.min.css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button><a class="navbar-brand navbar-link" href="">Leaderboard</a></div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active" role="presentation"><a href="index2.php">Home </a></li>
                    <li role="presentation"><a href="challange.php">Challenge </a></li>
                    <li role="presentation"><a href="profile.php">Profile</a></li>
                    <li role="persentation" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Welcome, <?php echo $nama_menu_user; ?><b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#ganti_password" data-toggle="modal">Ganti Password</a></li>
                            <li class="divider"></li>
                            <li><a href="login-admin/sign_out.php">Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
            </div><!----Ganti Password-------------------------------------------------------------->
            <!-- Modal -->
    
    <section class="awal">
        <center> <h1><strong>"LEADERBOARD MODE"   </strong><img src="assetsChallange/img/profile.png"></h1> </center></section>
       <section class="kosong"></section>
	<section class="features">
        <div class="row"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>LEADERBOARD <img src="assetsChallange/img/rank.png"> </h2>
                    <TABLE class="table table-bordered" border=1>
                    	<thead>
                    		<tr>
	                    		<th width="10%">Rank</th>
	                    		<th>Username</th>
	                    		<th>Score</th>
                                <th> <br> </br> </th>
	                    	</tr>

                    	</thead>

                        <tbody>

                    	<?php
                    		$qry="SELECT sum(skor) as hasil, s.nama_siswa FROM hasil_ujian hu, siswa s where hu.id_siswa = s.id group by id_siswa order by hasil desc";
                    		$query_score= mysql_query($qry);  /*where tgl='$hari_ini'*/
                    		$no=1;
    						while($array_score = mysql_fetch_array($query_score)){
                    	?>

                    	<tr>
                    		<td><?=$no?></td>
                    		<td><?=$array_score['nama_siswa']?></tD>
                    		<td><?=$array_score['hasil']?></td>

                    	</tr>
                    	<?php
                    			$no++;
							}
					    ?>

					    </tbody>
                    </TABLE>

                </div>
            </div>
        </div>
    </section>
    <section class="kosong"></section>
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5>Gamification @2016</h5></div>
                <div class="col-sm-6 social-icons"><a href="#"><span class="fa fa-facebook"></span></a><a href="#"><span class="fa fa-twitter"></span></a><a href="#"><span class="fa fa-instagram"></span></a></div>
            </div>
        </div>
        <div></div>
    </footer>
    <script src="assetsChallange/js/jquery.min.js"></script>
    <script src="assetsChallange/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
<?php
}else{
header("location:login-cadangan/signincadangan.php");
}
?>