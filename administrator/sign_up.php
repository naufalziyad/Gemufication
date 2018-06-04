<?php
session_start();
require("../config/database.php");
require("../config/title.php");
if(isset($_SESSION["admin"]) || isset($_SESSION["siswa"])){
header("location:..");
}else{
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

	   .jumbotron {
        margin: 30px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 60px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>


  <div class="container">
		
      <form class="form-signin" action="sign_up_proses.php" method="POST">
        <h2 class="form-signin-heading">Daftar Siswa</h2>
		<!--------alert-------------------------------------------------------------------------------->
		<?php
		if(@$_GET["error"] == "nis"){
		?>
		<div class="alert fade in alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Maaf NIS sudah ada</strong>
        </div>
		<?php
		}else if(@$_GET["error"] == "empty"){
		?>
		<div class="alert fade in alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Isi semua field</strong>
        </div>
		<?php
		}
		?>
		<!---------------------------------------------------------------------------------------------> <!---->
        <label>NIS :</label> 
			<input type="text" class="input-block-level" placeholder="NIS" name="nis">
        <label>Nama :</label> 
			<input type="text" class="input-block-level" placeholder="Nama" name="nama">
        <label>Password :</label> 
			<input type="password" class="input-block-level" placeholder="Password" name="password">
      <!-- <label>Kelas :</label> 
			<select class="input-block-level" name="kelas"> -->
			<!--<?php
				$query_kelas = mysql_query("select kelas.id, kelas.nama_kelas, jurusan.nama_jurusan from kelas, jurusan where kelas.id_jurusan = jurusan.id");
				while($array_kelas = mysql_fetch_array($query_kelas)){
			?>
				<option value="<?php echo $array_kelas['id']; ?>"><?php echo $array_kelas['nama_kelas']."-".$array_kelas['nama_jurusan'];?></option>
			<?php
				}
			?> -->
			</select>
        <label>Email :</label> 
			<input type="text" class="input-block-level" placeholder="Email" name="email">
        <button class="btn btn-large btn-primary" type="submit">Sign Up</button>
        <a class="btn btn-large btn-primary" href="signin.php">Cancel</a>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
<?php
}
?>