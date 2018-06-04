<?php
session_start();
require("config/database.php");
if(isset($_SESSION["admin"]) || isset($_SESSION["siswa"])){
?>

<?php
    $id_user = $_SESSION["siswa"];
    $user_type = "siswa";
    $query_menu_user = mysql_query("select*from siswa where id='$id_user'");
    $array_menu_user = mysql_fetch_array($query_menu_user);
    $nama_menu_user = $array_menu_user["nama_siswa"];
?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="profile/assets/css/user.css">
    <link rel="stylesheet" href="profile/assets/bootstrap/fonts/font-awesome.min.css">
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
                </button><a class="navbar-brand navbar-link" href="#">Profile </a></div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active" role="presentation"><a href="index2.php">Home </a></li>
                    <li role="presentation"><a href="challange.php">Challenge </a></li>
                    <li role="presentation"><a href="leaderboard.php">Leaderboard</a></li>
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
<?php
    $qry="SELECT sum(skor) as hasil, s.nama_siswa FROM hasil_ujian hu, siswa s where hu.id_siswa = s.id group by id_siswa order by hasil desc";
    $query_score= mysql_query($qry);  /*where tgl='$hari_ini'*/
    while($array_score = mysql_fetch_array($query_score)){
        $ranking[] = $array_score['hasil'];
    }

    $qry="SELECT sum(skor) as hasil, s.nama_siswa FROM hasil_ujian hu, siswa s where hu.id_siswa = s.id AND hu.id_siswa = $id_user";
    $query_score= mysql_query($qry);  /*where tgl='$hari_ini'*/
    $no=1;
    $score=$qry;
    $array_score = mysql_fetch_array($query_score);{
?>
    <section class="features">
	    <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <center> <h2>Profile <?=  $nama_menu_user ?> </h2> </center>
                    <p> <center> <img src="profile/assets/img/profile.png"> </center></p>
                </div>
                <div class="col-md-6">
                    <div class="row icon-features">
                        <div class="col-xs-4 icon-feature"><span class="glyphicon glyphicon-user"></span>
                            <p>Name</p>
                            <p><?=$nama_menu_user?></p>
                        </div>
                        <div class="col-xs-4 icon-feature"><span class="glyphicon glyphicon-star"></span>
                            <p>Rank</p>
                            <p><?=array_search($array_score['hasil'], $ranking) +1 ?></p>
                        </div>
                        <div class="col-xs-4 icon-feature"><span class="glyphicon glyphicon-usd"></span>
                            <p>Point </p>
                            <p><?=$array_score['hasil']?></p>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </section>
<?php
    $no++;
    }
?>
	<section class="kosong1">
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <center> <h2>Badge <span class="glyphicon glyphicon-tower"></span></h2>  </center>





                    <p>  </p>
                </div>
                <div class="col-md-6">
                    <?php
                        function cekBadge($id_ujian){
                            $id_siswa = $_SESSION["siswa"];
                            $qry="SELECT * FROM hasil_ujian where id_siswa = $id_siswa AND id_ujian= $id_ujian";
                            $query_score= mysql_query($qry);  /*where tgl='$hari_ini'*/
                            $array_score = mysql_fetch_array($query_score);
                            if(mysql_num_rows($query_score)){
                                if($array_score['status']=='LULUS'){
                                    return true;
                                } else {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        }
                        
                    ?>


                    <div class="row icon-features">

                        <?php
                       if(cekBadge(19)){
                            echo '<div class="col-xs-4 icon-feature"><img src="profile/assets/img/badge-silver.png"></span><p>Social level 1</p></div>';

                       }
                        if(cekBadge(27)){
                            echo '<div class="col-xs-4 icon-feature"><img src="profile/assets/img/badge-silver.png"></span><p>   Education level 1</p></div>';

                       }
                        if(cekBadge(25)){
                            echo '<div class="col-xs-4 icon-feature"><img src="profile/assets/img/badge-silver.png"></span><p> Sport level 1</p></div>';

                        }
                        ?>
                    </div>
                    <div class="row icon-features">

                        <?php 
                        if(cekBadge(20)){
                            echo '<div class="col-xs-4 icon-feature"><img src="profile/assets/img/badge-golden.png" > </span><p>Social level 2</p></div>';
                        }
                        if(cekBadge(28)){
                            echo '<div class="col-xs-4 icon-feature"><img src="profile/assets/img/badge-golden.png"></span><p> Education level 2</p></div>';
                        }
                        if(cekBadge(26)){
                            echo '<div class="col-xs-4 icon-feature"><img src="profile/assets/img/badge-golden.png"></span><p> Sport level 2</p></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5>Gamification @ 2016</h5></div>
                <div class="col-sm-6 social-icons"><a href="#"><span class="fa fa-facebook"></span></a><a href="#"><span class="fa fa-twitter"></span></a><a href="#"><span class="fa fa-instagram"></span></a></div>
            </div>
        </div>
        <div></div>
    </footer>
    <script src="profile/assets/js/jquery.min.js"></script>
    <script src="profile/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
<?php
}else{
header("location:login-cadangan/signin.php");
}
?>