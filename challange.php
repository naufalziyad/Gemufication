<?php
session_start();
require("config/database.php");
$hari_ini=date("Y-m-d");
if(isset($_SESSION["siswa"])){
    $id_siswa = $_SESSION["siswa"];
    $query_cek_siswa = mysql_query("select*from siswa where id='$id_siswa'");
    $array_cek_siswa = mysql_fetch_array($query_cek_siswa);
    $id_kelas_siswa = $array_cek_siswa["id_kelas"];
    $query_combo_jadwal= mysql_query("select*from jadwal");  /*where tgl='$hari_ini'*/
    while($array_combo_jadwal = mysql_fetch_array($query_combo_jadwal)){
        $id_ujian = $array_combo_jadwal['id_ujian'];
        $id_kelas = $array_combo_jadwal['id_kelas'];
        $query_check_ujian = mysql_query("select*from ujian where id='$id_ujian'");
        $array_check_ujian = mysql_fetch_array($query_check_ujian);
        $query_check_hasil = mysql_query("select*from hasil_ujian where id_ujian='$id_ujian' AND id_siswa='$id_siswa'");
        $array_check_hasil = mysql_fetch_array($query_check_hasil);
        if(empty($array_check_hasil['id']) && $id_kelas_siswa == $id_kelas){
            $statusTombol[$id_ujian] = ' ';
        } else {
            $statusTombol[$id_ujian] = 'disabled';
        }
    }
}


if(isset($_SESSION["admin"]) || isset($_SESSION["siswa"])){
?>

<?php
    $id_user = $_SESSION["siswa"];
    $query_menu_user = mysql_query("select*from siswa where id='$id_user'");
    $array_menu_user = mysql_fetch_array($query_menu_user);
    $nama_menu_user = $array_menu_user["nama_siswa"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C:\Users\naufal\Documents\chalanngae</title>
    <link rel="stylesheet" href="assetsChallange/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsChallange/css/user.css">
    <link rel="stylesheet" href="assetsChallange/bootstrap/fonts/font-awesome.min.css">
</head>

<body id="page-top" class="index">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button><a class="navbar-brand navbar-link" href="">Challenge </a></div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active" role="presentation"><a href="index2.php">Home </a></li>
                    <li role="presentation"><a href="leaderboard.php">Leaderboard</a></li>
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
        <center> <h1><strong>"CHALLENGE MODE"   </strong><img src="assetsChallange/img/profile.png"></h1> </center></section>
       <section class="kosong"></section>
	<section class="features">
        <div class="row"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>SOCIAL <span class="fa fa-male"></span> </h2>
                    <p>Asah kemampuanmu dengan menjawab tantangan yang bersifat sosial. </p>
                </div>
                <div class="col-md-6">
                    <div class="row icon-features">
                        <div class="col-xs-6 icon-feature"><span class="glyphicon glyphicon-tint"></span>
                            <p>Level 1 </p>
                            <p>
                                <a href="ujian/start_page.php?id_ujian=19"><button class="btn btn-default" <?=isset($statusTombol[19])?$statusTombol[19]:'disabled'?> type="button">Mainkan</button></a>
                            </p>
                        </div>
                        <div class="col-xs-6 icon-feature"><span class="glyphicon glyphicon-fire"></span>
                            <p>level 2</p>
                            <p>
                                <a href="ujian/start_page.php?id_ujian=20"><button class="btn btn-default" <?=isset($statusTombol[20])?$statusTombol[20]:'disabled'?> type="button">Mainkan</button></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="kosong"></section>
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>EDUCATION<span class="fa fa-book"></span> </h2>
                    <p>Punya pengetahuan yang luas? yuk selesaikan tantangan berikut ini .</p>
                </div>
                <div class="col-md-6">
                    <div class="row icon-features">
                        <div class="col-xs-6 icon-feature"><span class="glyphicon glyphicon-tint"></span>
                            <p>Level 1 </p>
                            <p>
                                <a href="ujian/start_page.php?id_ujian=27"><button class="btn btn-default" <?=isset($statusTombol[27])?$statusTombol[27]:'disabled'?> type="button">Mainkan</button></a>
                            </p>
                        </div>
                        <div class="col-xs-6 icon-feature"><span class="glyphicon glyphicon-fire"></span>
                            <p>level 2</p>
                            <p>
                                <a href="ujian/start_page.php?id_ujian=28"><button class="btn btn-default" <?=isset($statusTombol[28])?$statusTombol[28]:'disabled'?> type="button">Mainkan</button></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features">
        <section class="kosong"></section>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>SPORT <span class="fa fa-soccer-ball-o"></span> </h2>
                    <p>Buktikan bahwa kamu pecinta Olahraga sejati dengan menyelesaikan tantangan ini.</p>
                </div>
                <div class="col-md-6">
                    <div class="row icon-features">
                        <div class="col-xs-6 icon-feature"><span class="glyphicon glyphicon-tint"></span>
                            <p>Level 1 </p>
                            <p>
                                <a href="ujian/start_page.php?id_ujian=25"><button class="btn btn-default" <?=isset($statusTombol[25])?$statusTombol[25]:'disabled'?> type="button">Mainkan</button></a>
                            </p>
                        </div>
                        <div class="col-xs-6 icon-feature"><span class="glyphicon glyphicon-fire"></span>
                            <p>level 2</p>
                            <p>
                                <a href="ujian/start_page.php?id_ujian=26"><button class="btn btn-default" <?=isset($statusTombol[26])?$statusTombol[26]:'disabled'?> type="button">Mainkan</button></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
header("location:login-cadangan/signin.php");
}
?>