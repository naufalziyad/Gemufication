<%
	/*We've included ../Includes/FusionCharts.jsp, which contains functions
	to help us easily create the charts.*/
%>
<%@ include file="../Includes/FusionCharts.jsp"%>
<%@ include file="../Includes/DBConn.jsp"%>

<%@ page import="java.sql.Statement"%>
<%@ page import="java.sql.ResultSet"%>
<%@ page import="java.sql.Date"%>
<HTML>
<HEAD>
<TITLE>FusionCharts - Database Example</TITLE>
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
<h2>FusionCharts Database and Drill-Down Example</h2>
<h4>Click on any pie slice to see detailed data.</h4>
<p class='text'>Or, right click on any pie to enable slicing or
rotation mode.</p>
<%
	/*
	In this example, we show how to connect FusionCharts to a database.
	For the sake of ease, we've used a database which contains two tables, which are linked to each
	other. 
	*/
		
	//Database Objects - Initialization
	Statement st1,st2;
	ResultSet rs1,rs2;

	String strQuery="";

	//strXML will be used to store the entire XML document generated
	String strXML="";
	
	
	//Generate the chart element
	strXML = "<chart caption='Factory Output report' subCaption='By Quantity' pieSliceDepth='30' showBorder='1' formatNumberScale='0' numberSuffix=' Units'>";
	
	//Construct the query to retrieve data
	strQuery = "select * from Factory_Master";
	
	
	st1=oConn.createStatement();
	rs1=st1.executeQuery(strQuery);

	String factoryId=null;
	String factoryName=null;
	String totalOutput="";
	//Iterate through each factory		
	while(rs1.next()) {
		
		factoryId=rs1.getString("FactoryId");
		factoryName=rs1.getString("FactoryName");
		//Now create second recordset to get details for this factory
		strQuery = "select sum(Quantity) as TotOutput from Factory_Output where FactoryId=" + factoryId;
		st2=oConn.createStatement();
		rs2 = st2.executeQuery(strQuery);
		if(rs2.next()){
			totalOutput=rs2.getString("TotOutput");
		}
		//Generate <set label='..' value='..'/>		
		strXML += "<set label='" + factoryName + "' value='" +totalOutput+ "'/>";
		//Close resultset
		try {
				if(null!=rs2){
					rs2.close();
					rs2=null;
				}
		}catch(java.sql.SQLException e){
			 //do something
			 System.out.println("Could not close the resultset");
		}
		try{
				if(null!=st2) {
					st2.close();
					st2=null;
				}
		}catch(java.sql.SQLException e){
			 //do something
			 System.out.println("Could not close the statement");
		}
	} //end of while
	//Finally, close <chart> element
	strXML += "</chart>";
	//close the resulset,statement,connection
	try {
		if(null!=rs1){
			rs1.close();
			rs1=null;
		}
	}catch(java.sql.SQLException e){
		 //do something
		 System.out.println("Could not close the resultset");
	}	
	try {
		if(null!=st1) {
			st1.close();
			st1=null;
		}
	    }catch(java.sql.SQLException e){
		 //do something
		 System.out.println("Could not close the statement");
		}
	try {
		if(null!=oConn) {
		    oConn.close();
		    oConn=null;
		}
	    }catch(java.sql.SQLException e){
		 //do something
		 System.out.println("Could not close the connection");
		}
		
	//Create the chart - Pie 3D Chart with data from strXML
	String chartCode=createChart("../../FusionCharts/Pie3D.swf", "", strXML, "FactorySum", 600, 300, false, false);
	
%> 
<%=chartCode%> 
<BR>
<BR>
<a href='../NoChart.html' target="_blank">Unable to see the chart above?</a></CENTER>
</BODY>
</HTML>
