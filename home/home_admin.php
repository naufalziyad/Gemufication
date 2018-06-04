<script language="JavaScript" src="chart/JSClass/FusionCharts.js"></script> 	
    <style>

    /* GLOBAL STYLES
    -------------------------------------------------- */
    /* Padding below the footer and lighter body text */
    /* Carousel base class */

    .carousel .container {
      position: relative;
    }
	.carousel {
      box-shadow: 1px 0px 0px 5px #ddd;
    }

    

    .carousel .item {
      height: 500px;
    }
    .carousel img {
      position: absolute;
      top: 0;
      left: 0;
      min-width: 100%;
      height: 500px;
    }

    .carousel-caption {
      background-color: transparent;
      position: static;
      max-width: 550px;
      padding: 0 20px;
      margin-top: 200px;
    }
    .carousel-caption h1,
    .carousel-caption .lead {
      margin: 0;
      line-height: 1.25;
      color: #fff;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
    }
    .carousel-caption .btn {
      margin-top: 10px;
    }


    /* RESPONSIVE CSS
    -------------------------------------------------- */

    @media (max-width: 979px) {
      .carousel .item {
        height: 500px;
      }
      .carousel img {
        width: auto;
        height: 500px;
      }
    }


    @media (max-width: 767px) {

      .carousel {
        margin-left: -20px;
        margin-right: -20px;
      }
      .carousel .container {

      }
      .carousel .item {
        height: 300px;
      }
      .carousel img {
        height: 300px;
      }
      .carousel-caption {
        width: 65%;
        padding: 0 70px;
        margin-top: 100px;
      }
      .carousel-caption h1 {
        font-size: 30px;
      }
      .carousel-caption .lead,
      .carousel-caption .btn {
        font-size: 18px;
      }

    }
    </style>
<div class="row"><br>
	<div class="span8" style="border:0px solid #ddd;text-align:center;min-height:400px">
		<?php
			include("pictures.php");
		?>
	</div>
	<div class="span3" style="padding-left:30px;">
		<div class="row">
			 <!--=====================================================================================================================-->
 				<div id="home_chart" align="center" style="border:2px solid #ddd"> 
				FusionCharts. </div>
				<?php
					$query_lulus = mysql_query("select COUNT(*) AS jml_data FROM hasil_ujian where status='LULUS'");
					$query_tidak_lulus = mysql_query("select COUNT(*) AS jml_data FROM hasil_ujian where status='TIDAK_LULUS'");
					$array_lulus = mysql_fetch_array($query_lulus);
					$array_tidak_lulus = mysql_fetch_array($query_tidak_lulus);
					$lulus = $array_lulus['jml_data'];
					$tidak_lulus = $array_tidak_lulus['jml_data'];
				?>
				<script type="text/javascript">
				   var chart = new FusionCharts("chart/Charts/Column2D.swf", "ChartId", "295", "350", "0", "0");
				   chart.setDataXML("<chart  canvasBorderColor='666666' yAxisName='Jumlah' xAxisName='Status' caption='Jumlah Total Status Hasil Ujian' useRoundEdges='1' bgColor='FFFFFF,FFFFFF' showBorder='0'><set label='Lulus' value='<? echo $lulus; ?>'  /> <set label='Tidak lulus' value='<? echo $tidak_lulus; ?>' color='#b53636'/> </chart>");	   
				   chart.render("home_chart");
				</script> 
			<!--=====================================================================================================================-->
		</div><br>
		<div class="row" style="border:1px solid #ddd;border-radius:4px;text-align:center;overflow:auto;max-height:500px;">
			<?php
				include("jadwal_data_admin.php");
			?>
		</div>
	</div>
</div>