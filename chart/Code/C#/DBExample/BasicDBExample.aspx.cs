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

namespace InfoSoftGlobal.GeneralPages.ASP.NET.DBExample
{
	/// <summary>
	/// Summary description for BasicDBExample.
	/// </summary>
	public class BasicDBExample : System.Web.UI.Page
	{
		protected System.Web.UI.WebControls.Literal LiteralChart;
	
		private void Page_Load(object sender, System.EventArgs e)
		{
		}

		public string GetFactorySummaryChartHtml()
		{
			//In this example, we show how to connect FusionCharts to a database.
			//For the sake of ease, we've used an Access database which is present in
			//../DB/FactoryDB.mdb. It just contains two tables, which are linked to each
			//other. 
		
			//xmlData will be used to store the entire XML document generated
			string xmlData;

			//Generate the chart element
			xmlData = "<chart caption='Factory Output report' subCaption='By Quantity' pieSliceDepth='30' showBorder='1' formatNumberScale='0' numberSuffix=' Units'>";
	
			//Iterate through each factory
			string factoryQuery = "select * from Factory_Master";
			using (OdbcConnection connectin = DbHelper.Connection(DbHelper.ConnectionStringFactory))
			{
				using (OdbcCommand factoryCommand = new OdbcCommand(factoryQuery, connectin))
				{
					using (OdbcDataAdapter adapter = new OdbcDataAdapter(factoryCommand))
					{
						DataTable table = new DataTable();
						adapter.Fill ( table );

						foreach ( DataRow row in table.Rows)
						{
							string quantityQuery = "select sum(Quantity) as TotOutput from Factory_Output where FactoryId=" + row["FactoryId"].ToString();
							using (OdbcCommand quantityCommand = new OdbcCommand(quantityQuery,connectin))
							{
								xmlData += "<set label='" + row["FactoryName"].ToString() + "' value='" + quantityCommand.ExecuteScalar().ToString() + "' />";
							}
						}
					}
				}
				connectin.Close();

				xmlData += "</chart>";
			}
	
			//Create the chart - Pie 3D Chart with data from xmlData
			return FusionCharts.RenderChart("../../FusionCharts/Pie3D.swf", "", xmlData, "FactorySum", "600", "300", false, false);
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
