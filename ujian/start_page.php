<?php
session_start();
require("../config/database.php");
require("../config/title.php");
error_reporting(0);
//$id_ujian = $_POST["id_ujian"];
$id_ujian = $_GET["id_ujian"];
if(isset($_SESSION["siswa"])and !empty($id_ujian)){
	$query_ujian_utama = mysql_query("SELECT * FROM ujian WHERE id='$id_ujian'")or die('gagal');
	$array_ujian_utama  = mysql_fetch_array($query_ujian_utama);
	$waktu_ujian_menit = $array_ujian_utama["waktu"];
	$waktu_ujian_detik = $waktu_ujian_menit*60;
	$idtest =$array_ujian_utama["id"];
	$nama_ujian =$array_ujian_utama["nama_ujian"];
	$jml_soal = $array_ujian_utama["jml_soal"];
	$tgl_soal = $array_ujian_utama["tgl_input"];
	$text_pembuka = $array_ujian_utama["text_pembuka"];
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
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../assets/css/docs.css" rel="stylesheet">
    <link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet">

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
								   
    <script src="../assets/js/jquery-1.4.4.min.js"></script>
 
<script>
var totalwaktu =<?php echo $waktu_ujian_detik;?>; //batas waktu pengerjaan semua soal
var indexsoal = 0;
var topik;
var id_soal = "";
var timer;
var habis = 0;
var nilaiakhir = 0;
var inputpilihan;
var inputjawaban;
$(document).ready(function(){
    $("#benar").val(nilaiakhir);
    checkCookie();
    topik = <?php echo $idtest;?>;
    url = "ambilsoal.php?topik="+topik
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            topik = msg;
            console.log(topik)
            setinputpilihan();
            setinputjawaban()
            tampilkan();
            mainkanwaktu();
        }
    });
    $("#next").click(function(){
        indexsoal++;
        $("#dividsoal").hide();
        $("#divpertanyaan").hide();
        $("#divoption").hide();
        tampilkan();
    });
});

function setinputpilihan(){
    inputpilihan = "";
    for(i=0;i<topik.soal.length;i++){
        inputpilihan = inputpilihan+"<input type=hidden name=pilihan[] id=pilihan"+i+">";
    }
    $("#divpilihan").html(inputpilihan);
}

function setinputjawaban(){
    inputjawaban = "";
    for(i=0;i<topik.soal.length;i++){
        inputjawaban = inputjawaban+"<input type=hidden name=jawaban[] value='"+topik.soal[i].jawaban+"'>";
        id_soal = id_soal+"<input type=hidden name=idsoal[] value='"+topik.soal[i].id_soal+"'>";
    }
    $("#divjawaban").html(inputjawaban);
    $("#dividsoal").html(id_soal);
}
function mainkanwaktu(){
    if(totalwaktu>0){
        $("#divtotalwaktu").html(totalwaktu);
        totalwaktu--;
        timer = setTimeout("mainkanwaktu()",1000);
    }else{
        clearTimeout(timer);
        habis = 1;
        document.getElementById("formulir").submit();
    }
}
function setnilai(nilai){
    idinput = "#pilihan"+indexsoal;
    $(idinput).val(nilai);
}
function tampilkan(){
    if(indexsoal<topik.soal.length){
        nomorsoal = indexsoal + 1;

        $("#divnomor").html("Soal "+nomorsoal+" dari "+ topik.soal.length);
        $("#no").html(nomorsoal);
        $("#divpertanyaan").html(topik.soal[indexsoal].pertanyaan);
        $("#divpertanyaan").fadeIn(2000);
		if(topik.soal[indexsoal].byk_pilihan == 5){
			$("#jawaban_a").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='A'>A. "+topik.soal[indexsoal].a);
			$("#jawaban_b").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='B'>B. "+topik.soal[indexsoal].b);
			$("#jawaban_c").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='C'>C. "+topik.soal[indexsoal].c);
			$("#jawaban_d").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='D'>D. "+topik.soal[indexsoal].d);
			$("#jawaban_e").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='E'>E. "+topik.soal[indexsoal].e);
		}else if(topik.soal[indexsoal].byk_pilihan == 4){
			$("#jawaban_a").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='A'>A. "+topik.soal[indexsoal].a);
			$("#jawaban_b").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='B'>B. "+topik.soal[indexsoal].b);
			$("#jawaban_c").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='C'>C. "+topik.soal[indexsoal].c);
			$("#jawaban_d").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='D'>D. "+topik.soal[indexsoal].d);
			$("#jawaban_e").html("<input type='hidden' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='E'>");
		}else if(topik.soal[indexsoal].byk_pilihan == 3){
			$("#jawaban_a").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='A'>A. "+topik.soal[indexsoal].a);
			$("#jawaban_b").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='B'>B. "+topik.soal[indexsoal].b);
			$("#jawaban_c").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='C'>C. "+topik.soal[indexsoal].c);
			$("#jawaban_d").html("<input type='hidden' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='D'>");
			$("#jawaban_e").html("<input type='hidden' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='E'>");
		}
        $("#divoption").slideDown(750);
    }else{
        habis = 1;
        document.getElementById("formulir").submit();
    }
}

function getCookie(c_name){
    if (document.cookie.length>0){
        c_start=document.cookie.indexOf(c_name + "=");
        if (c_start!=-1){
            c_start=c_start + c_name.length+1;
            c_end=document.cookie.indexOf(";",c_start);
            if (c_end==-1) c_end=document.cookie.length;
            return unescape(document.cookie.substring(c_start,c_end));
        }
    }
    return "";
}

function setCookie(c_name,value,expiredays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate()+expiredays);
    document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}

function checkCookie(){
    totalwaktucookies=getCookie('waktucookies');
    if (totalwaktucookies!=null && totalwaktucookies!=""){
        totalwaktu = totalwaktucookies;
    }else{
        setCookie('waktucookies',totalwaktu,7);
    }
}
function keluar(){
    if(habis==0){
        setCookie('waktucookies',totalwaktu,7);
    }else{
        setCookie('waktucookies',0,-1);
    }
}
function finish(){
	document.getElementById("formulir").submit();
}
</script>
<style>
#divpertanyaan{display:none}
#divoption{display:none}
     body {
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-ujian {
        max-width: 100%;
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
      .form-ujian .checkbox {
        margin-bottom: 10px;
      }
      .form-ujian input[type="text"],
      .form-ujian input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
</style>
 </head>

  <body>
    <div class="container">
			<div class='alert fade in alert-info'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong><?php echo $text_pembuka; ?></strong>
			</div>
	<form action="nilaiakhir.php" method="post" id="formulir" class="form-ujian">
	<fieldset>
    <legend>Ujian : <?php echo $nama_ujian; ?></legend>
	Sisa Waktu: <span id="divtotalwaktu" class="badge badge-important"></span>
		<div id="divnomor"></div><br>
		<div class="row">
			<div class="span1" style="background-color:#f5f5f5;">
				<center><font size="4"><b><div id="no"></div></b></font></center>
			</div>
			<div class="span7" style="background-color:#f5f5f5;padding-left:30px;">
				<b><div id="divpertanyaan"></div></b>
				
				<div id="divoption">
					<label id="jawaban_a" class="radio"></label>
					<label id="jawaban_b" class="radio"></label>
					<label id="jawaban_c" class="radio"></label>
					<label id="jawaban_d" class="radio"></label>
					<label id="jawaban_e" class="radio"></label>
				</div>
			</div>
		</div>
		<p><br>
			<div class="form-actions">
				<a id="next" class="btn btn-primary" href="#"><i class="icon-step-forward icon-white"></i> Next</a>
				<a onclick="javascript:finish()" class="btn" href="#"><i class="icon-off icon-black"></i> Finish</a>
			</div>
		
			<input type="hidden" name="nama" id="nama" value="">
			<input type="hidden" name="idtest" id="idtest" value="<?php echo $idtest;?>">
			<input type="hidden" name="jsoal" id="jsoal" value="<?php echo $jml_soal;?>">
			<input type="hidden" name="tsoal" id="tsoal" value="<?php echo $tgl_soal;?>">
			<div id="divpilihan"></div>
			<div id="divjawaban"></div>
			<div id="dividsoal"></div>
		</fieldset>
		</form>
	</div> <!-- /container -->
	
    <!-- Footer
    ================================================== -->
    <footer class="footer">
      <div class="container">
        <p>Designed and built with all the love in the world by <a href="" target="_blank">Polinema</a></p>
        </ul>
      </div>
    </footer>


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript"></script>
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
    <script src="../assets/js/bootstrap-affix.js"></script>

    <script src="../assets/js/holder/holder.js"></script>
    <script src="../assets/js/google-code-prettify/prettify.js"></script>

    <!--<script src="assets/js/application.js"></script>-->

  </body>
</html>
<?php
}else{
header("location:../login/signincadangan.php");
}
?>
