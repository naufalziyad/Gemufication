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
      <link rel="stylesheet" href="css/login.css">
      <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
      <style>
          body {
              width:100%;
              height:100%;
              position:fixed;
              background-color:#34495e;
          }
          .avatar {
              width: 100%;
              margin: auto;
              width: 65px;
              border-radius: 100px;
              height: 65px;
              background: white;
              position: relative;
              bottom: -15px;
          }
          .avatar img {
              width: 55px;
              height: 55px;
              border-radius: 100px;
              margin: auto;
              border:3px solid #fff;
              display: block;
          }
          .content {
              position: absolute;
              top: 25%;
              left: 50%;
              transform: translate(-50%, -50%);
              font-size: 35px;
              line-height: 40px;
              font-family: 'Lato', sans-serif;
              color: #ecf0f1;
              height: 127px;
              overflow:hidden;
          }

          .visible {
              font-weight:600;
              overflow:hidden;
              height:40px;
              padding:0 40px;

          &:before {
               content:'[';
               left: 0;
               line-height:40px;
           }
          &:after {
               content:']';
               position:absolute;
               right: 0;
               line-height:40px;
           }
          &:after, &:before {
                        position:absolute;
                        top:0;
                        color: #ffffff;;
                        font-size:42px;
                        -webkit-animation-name: opacity;
                        -webkit-animation-duration: 4s;
                        -webkit-animation-iteration-count: infinite;
                        animation-name: opacity;
                        animation-duration: 4s;
                        animation-iteration-count: infinite;

                    }
          }

          p {
              display:inline;
              float:left;
              margin:0;
          }

          ul {
              margin-top:0;
              padding-left:110px;
              text-align:left;
              list-style:none;
              -webkit-animation-name: change;
              -webkit-animation-duration: 6s;
              -webkit-animation-iteration-count: infinite;
              animation-name: change;
              animation-duration: 6s;
              animation-iteration-count: infinite;
          }

          ul li {
              line-height:40px;
              margin:0;
          }

          @-webkit-keyframes opacity {
              0%, 100% {opacity:0;}
              50% {opacity:1;}
          }

          @-webkit-keyframes change {
              0%, 12%, 100% {transform:translateY(0);}
              17%,29% {transform:translateY(-25%);}
              34%,46% {transform:translateY(-50%);}
              51%,63% {transform:translateY(-75%);}
              68%,80% {transform:translateY(-50%);}
              85%,97% {transform:translateY(-25%);}
          }

          @keyframes opacity {
              0%, 100% {opacity:0;}
              50% {opacity:1;}
          }

          @keyframes change {
              0%, 12%, 100% {transform:translateY(0);}
              17%,29% {transform:translateY(-25%);}
              34%,46% {transform:translateY(-50%);}
              51%,63% {transform:translateY(-75%);}
              68%,80% {transform:translateY(-50%);}
              85%,97% {transform:translateY(-25%);}
          }
      </style>



	
    <!----------------------------------------------------->
	<script>
	function change(){
			pilih = document.getElementById("user_type");/
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

  </head>

    <body>

      <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
      <div class='content'>
      <div class='visible'>
              <p>
                  Hello....
              <ul>
                  <li>Selamat </li>
                  <li>Datang </li>
                  <li>Users </li>
                  <li>Login Yuk </li>
              </ul>
      </div>
      </div>
      <script src="js/index.js"></script>
      <div class="wrap">

      <form class="form-signin" method="POST" action="signin_proses.php">

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
            <br>
		<div class="alert fade in alert-error">
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


          <div class="avatar">
              <img src="https://cdn4.iconfinder.com/data/icons/avatar-and-user/86/Avatar_person_user_character_man_woman_human-04-512.png">
          </div>

		<input type="hidden" id="index_user"></input>
        <input type="text" class="input-block-level" placeholder="Username" name="username" id='user'>
        <input type="password" class="input-block-level" placeholder="Password" name="password">
          <br>
          <select class="input-block-level" name="user_type" id="user_type" >
              <option value="siswa">Anda Login Sebagai Member</option>
          </select>

<br>
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>

      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


  </body>
</html>
<?php
}
?>