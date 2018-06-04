<%@ Page language="c#" Codebehind="Detailed.aspx.cs" AutoEventWireup="false" Inherits="InfoSoftGlobal.GeneralPages.ASP.NET.DBExample.Detailed" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<HTML>
	<HEAD>
		<TITLE>FusionCharts - Database and Drill-Down Example </TITLE>
		<meta name="GENERATOR" Content="Microsoft Visual Studio .NET 7.1">
		<meta name="CODE_LANGUAGE" Content="C#">
		<meta name="vs_defaultClientScript" content="JavaScript">
		<meta name="vs_targetSchema" content="http://schemas.microsoft.com/intellisense/ie5">
		<SCRIPT LANGUAGE="Javascript" SRC="../../FusionCharts/FusionCharts.js"></SCRIPT>
		<LINK href="../../../InfoSoftGlobal.css" type="text/css" rel="stylesheet">
	</HEAD>
	<body>
		<form id='form1' name='form1' method='post' runat="server">
			<CENTER>
				<h2>FusionCharts Database and Drill-Down Example</h2>
				<h4>Detailed report for the factory</h4>
				<%=GetFactoryDetailedChartHtml()%>
				<BR>
				<a href='Default.aspx?animate=0'>Back to Summary</a>
				<BR>
				<BR>
				<a href='../NoChart.html' target="_blank">Unable to see the chart above?</a>
			</CENTER>
		</form>
	</body>
</HTML>
