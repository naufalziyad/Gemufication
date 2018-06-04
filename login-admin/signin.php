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
        margin: 40px 0;
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

	
    <!----------------------------------------------------->
	<script>
	function change(){
			pilih = document.getElementById("user_type");
			document.getElementById("index_user").value = pilih.options[pilih.selectedIndex].text;
			
		if(pilih.options[pilih.selectedIndex].text == "Admin"){
			document.getElementById("user").placeholder = "Username";
		}
		else if(pilih.options[pilih.selectedIndex].text == "Guru"){
			document.getElementById("user").placeholder = "NIP";
		}
		else{
			document.getElementById("user").placeholder = "NIS";
		}
	}
	function a(){
		document.getElementById("user1").value = "";
		
	}
</script>
    <!----------------------------------------------------->
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

  <body>
	<div class="jumbotron">
        <h1>Gamification </h1>
        <p class="lead">Halaman Administrator<?php echo $brand; ?></p>
    </div>

    <div class="container">

      <form class="form-signin" method="POST" action="signin_proses.php">
        <h2 class="form-signin-heading">Please sign in</h2>
		<!--------alert-------------------------------------------------------------------------------->
		<?php
		if(@$_GET["success"] == "signup"){
		?>
		<div class="alert fade in alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Sign up Success</strong>
        </div>
		<?php
		}
		?>
		<!------alert------------------------------------------------------------------------------------>
		<?php
		if(@$_GET["error"] == "wrong"){
		?>
		<div class="alert fade in alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Username dan password salah</strong>
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
		<!--------------------------------------------------------------------------------------------->
		<label>Anda Sebagai :</label>
			<select class="input-block-level" name="user_type" id="user_type" onchange='change()'>	
				<option value="admin">Admin</option>

			</select>
		<input type="hidden" id="index_user"></input>
        <input type="text" class="input-block-level" placeholder="Username" name="username" id='user'>
        <input type="password" class="input-block-level" placeholder="Password" name="password">

        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
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