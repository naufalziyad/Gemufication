<%
	/*We've included ../Includes/FusionCharts.jsp, which contains functions
	to help us easily create the charts.*/
%>
<%@ include file="../Includes/FusionCharts.jsp"%>
<HTML>
<HEAD>
<TITLE>FusionCharts - dataURL and Database Example</TITLE>
<%
	/*You need to include the following JS file, if you intend to embed the chart using JavaScript.
	Embedding using JavaScripts avoids the "Click to Activate..." issue in Internet Explorer
	When you make your own charts, make sure that the path to this JS file is correct. Else, you would get JavaScript errors.
	*/
	%>
<SCRIPT LANGUAGE="Javascript" SRC="../../FusionCharts/FusionCharts.js"></SCRIPT>
<style type="text/css">
	<!--
	body {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
	.text{
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
	-->
	</style>
</HEAD>
<BODY>
<CENTER>
<h2>FusionCharts dataURL and Database</h2>
<h4>Click on any pie slice to slice it out.Or, right click to enable
rotation mode.</h4>
<%
	/*
	In this example, we show how to connect FusionCharts to a database 
	using dataURL method. In our other examples, we've used dataXML method
	where the XML is generated in the same page as chart. Here, the XML data
	for the chart would be generated in PieData.jsp.
	*/
	
	/*
	To illustrate how to pass additional data as querystring to dataURL, 
	we've added an animate	property, which will be passed to PieData.jsp. 
	PieData.jsp would handle this animate property and then generate the 
	XML accordingly.
	*/
	
	/*For the sake of ease, we've used an Access database which is present in
	../DB/FactoryDB.mdb. It just contains two tables, which are linked to each
	other.
	*/
		
	//Variable to contain dataURL
	String strDataURL="";
	
	//Set DataURL with animation property to 1
	//NOTE: It's necessary to encode the dataURL if you've added parameters to it
	strDataURL = encodeDataURL("PieData.jsp?animate=1","false",response);
	
	//Create the chart - Pie 3D Chart with dataURL as strDataURL
	String chartCode= createChart("../../FusionCharts/Pie3D.swf", strDataURL, "", "FactorySum", 600, 300, false, false);
%> 
<%=chartCode%> 
<BR>
<BR>
<a href='../NoChart.html' target="_blank">Unable to see the chart above?</a></CENTER>
</BODY>
</HTML>
