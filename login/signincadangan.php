<?php
session_start();
require("../config/database.php");
require("../config/title.php");
if( isset($_SESSION["siswa"])){
    header("location:..");
}else{
?>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login </title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  
      <link rel="stylesheet" href="css/login.css">

  
</head>

  <div class="wrap">
      <form class="form-signin" method="POST" action="signin_proses.php">


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


        <div class="avatar">
      <img src="http://cdn.ialireza.me/avatar.png">
		</div>
          <input type="text"  placeholder="Username" name="username" id='user'>


		<div class="bar">
			<i></i>
		</div>
          <input type="password" placeholder="Password" name="password">
		<a href="" class="forgot_link">forgot ?</a>
		<button type="submit">Sign in</button>
	</div>
</form>




    <script src="js/login.js"></script>

</body>
</html>
<?php }
?>