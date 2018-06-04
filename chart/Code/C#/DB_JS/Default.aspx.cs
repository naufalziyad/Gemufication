using System;
using System.Collections;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Web;
using System.Web.SessionState;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.HtmlControls;
using System.Data.Odbc;

namespace InfoSoftGlobal.GeneralPages.ASP.NET.DB_JS
{
	/// <summary>
	/// Summary description for _Default.
	/// </summary>
	public class _Default : System.Web.UI.Page
	{
		protected System.Web.UI.WebControls.Literal LiteralChart;
		private void Page_Load(object sender, System.EventArgs e)
		{
		}
		/// <summary>
		/// The following string will contain the JS Data and variables.
		///	This string will be built in ASP.NET and rendered at run-time as JavaScript.
		/// </summary>
		public string jsVarString = String.Empty;


		public string GetFactorySummayChartHtml()
		{
			//In this example, we show a combination of database + JavaScript rendering using FusionCharts.
	
			//The entire app (page) can be summarized as under. This app shows the break-down
			//of factory wise output generated. In a pie chart, we first show the sum of quantity
			//generated by each factory. These pie slices, when clicked would show detailed date-wise
			//output of that factory.
	
			//The XML data for the pie chart is fully created in ASP.NET at run-time. ASP.NET interacts
			//with the database and creates the XML for this.
			//Now, for the column chart (date-wise output report), we do not submit request to the server.
			//Instead we store the data for the factories in JavaScript arrays. These JavaScript
			//arrays are rendered by our ASP.NET Code (at run-time). We also have a few defined JavaScript
			//functions which react to the click event of pie slice.
	
			//We've used an Access database which is present in ../DB/FactoryDB.mdb. 
			//It just contains two tables, which are linked to each other. 
	
			//Before the page is rendered, we need to connect to the database and get the
			//data, as we'll need to convert this data into JavaScript variables.
	
	
			//Database Objects
			string factoryQuery = "select * from Factory_Master";
			int indexCount;

			//Initialize the Pie chart with sum of production for each of the factories
			//xmlData will be used to store the entire XML document generated
			string xmlData;
	
			using (OdbcConnection connection = DbHelper.Connection(DbHelper.ConnectionStringFactory))
			{
				OdbcCommand factoryCommand = new OdbcCommand(factoryQuery, connection);
				OdbcDataAdapter factoryAdapter = new OdbcDataAdapter(factoryCommand);
				DataTable factoryTable = new DataTable();
				factoryAdapter.Fill ( factoryTable );
				
				//Initialize Index
				indexCount=0;

				//Generate the chart element
				xmlData = "<chart caption='Factory Output report' subCaption='By Quantity' pieSliceDepth='30' showBorder='1' formatNumberScale='0' numberSuffix=' Units' >";

				foreach (DataRow row in factoryTable.Rows)
				{
					indexCount ++;
					string quantityQuery = "select sum(Quantity) as TotOutput from Factory_Output where FactoryId=" + row["FactoryId"];
					OdbcCommand quantityCommand = new OdbcCommand(quantityQuery, connection);
						
					xmlData += "<set label='" + row["FactoryName"] + "' value='" + quantityCommand.ExecuteScalar().ToString() + "' link='javaScript:updateChart(" + indexCount.ToString() + ")'/>";
				}

				connection.Close();
			}
		
			xmlData += "</chart>";

			System.Text.StringBuilder chartBuilder = new System.Text.StringBuilder();
	
			//Create the chart - Pie 3D Chart with data from xmlData
			chartBuilder.Append( FusionCharts.RenderChart("../../FusionCharts/Pie3D.swf", "", xmlData, "FactorySum", "500", "250", false, true));

			return chartBuilder.ToString();
		}

		public string GetFactoryDetailedChartHtml()
		{
			System.Text.StringBuilder chartBuilder = new System.Text.StringBuilder();
			
			chartBuilder.Append( FusionCharts.RenderChart("../../FusionCharts/Column2D.swf?ChartNoDataText=Please select a factory from pie chart above to view detailed data.", "", "<chart></chart>", "FactoryDetailed", "600", "250", false, true) );

			return chartBuilder.ToString();
		}

		public string GetScript()
		{
			//Iterate through each factory
			//Here, we generate the JavaScript array code for the factory data.
			string factoryQuery = "select * from Factory_Master";
			int indexCount = 0;
			DataTable factoryTable = new DataTable();
			using (OdbcConnection connection = DbHelper.Connection(DbHelper.ConnectionStringFactory))
			{
				OdbcCommand factoryCommand = new OdbcCommand(factoryQuery, connection);
				OdbcDataAdapter factoryAdapter = new OdbcDataAdapter(factoryCommand);
					
				factoryAdapter.Fill ( factoryTable );
				foreach (DataRow row in factoryTable.Rows)
				{
					indexCount ++;
					jsVarString += "\t\t data[" +  indexCount.ToString() + "] = new Array();" + Environment.NewLine;

					string outputQuery = "select * from Factory_Output where FactoryId=" + row["FactoryId"].ToString() + " order by DatePro Asc";
					OdbcCommand outputCommand = new OdbcCommand(outputQuery, connection);
					OdbcDataAdapter outputAdapter = new OdbcDataAdapter(outputCommand);
					DataTable outputTable = new DataTable();

					outputAdapter.Fill ( outputTable );

					foreach (DataRow outputRow in outputTable.Rows)
					{
						jsVarString += "\t\t data[" + indexCount.ToString() + "].push(new Array('" + ((DateTime)outputRow["DatePro"]).Day.ToString() + "/" + ((DateTime)outputRow["DatePro"]).Month.ToString() + "'," + outputRow["Quantity"].ToString() + "));" + Environment.NewLine;
					}
				}
			}

			return jsVarString;
		}

		#region Web Form Designer generated code
		override protected void OnInit(EventArgs e)
		{
			//
			// CODEGEN: This call is required by the ASP.NET Web Form Designer.
			//
			InitializeComponent();
			base.OnInit(e);
		}
		
		/// <summary>
		/// Required method for Designer support - do not modify
		/// the contents of this method with the code editor.
		/// </summary>
		private void InitializeComponent()
		{    
			this.Load += new System.EventHandler(this.Page_Load);

		}
		#endregion
	}
}
