Imports System
Imports System.Collections
Imports System.ComponentModel
Imports System.Data
Imports System.Drawing
Imports System.Web
Imports System.Web.SessionState
Imports System.Web.UI
Imports System.Web.UI.WebControls
Imports System.Web.UI.HtmlControls
Imports System.Data.Odbc

Namespace InfoSoftGlobal.GeneralPages.ASP.NET.DBExample

    ''' <summary>
    ''' Summary description for BasicDBExample.
    ''' </summary>
    Public Class BasicDBExample
        Inherits System.Web.UI.Page

        Protected LiteralChart As System.Web.UI.WebControls.Literal

        Private Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs)

        End Sub

        Public Function GetFactorySummaryChartHtml() As String
            'In this example, we show how to connect FusionCharts to a database.
            'For the sake of ease, we've used an Access database which is present in
            '../DB/FactoryDB.mdb. It just contains two tables, which are linked to each
            'other. 
            'xmlData will be used to store the entire XML document generated
            Dim xmlData As String
            'Generate the chart element
            xmlData = "<chart caption='Factory Output report' subCaption='By Quantity' pieSliceDepth='30' showBorder='1' for" & _
            "matNumberScale='0' numberSuffix=' Units'>"
            'Iterate through each factory
            Dim factoryQuery As String = "select * from Factory_Master"
            Dim connectin As OdbcConnection = DbHelper.Connection(DbHelper.ConnectionStringFactory)
            Dim factoryCommand As OdbcCommand = New OdbcCommand(factoryQuery, connectin)
            Dim adapter As OdbcDataAdapter = New OdbcDataAdapter(factoryCommand)
            Dim table As DataTable = New DataTable
            adapter.Fill(table)
            For Each row As DataRow In table.Rows
                Dim quantityQuery As String = ("select sum(Quantity) as TotOutput from Factory_Output where FactoryId=" & row("FactoryId").ToString)
                Dim quantityCommand As OdbcCommand = New OdbcCommand(quantityQuery, connectin)
                xmlData = (xmlData & ("<set label='" _
                            & (row("FactoryName").ToString & ("' value='" _
                            & (quantityCommand.ExecuteScalar.ToString & "' />")))))
            Next
            connectin.Close()
            xmlData = (xmlData & "</chart>")
            'Create the chart - Pie 3D Chart with data from xmlData
            Return FusionCharts.RenderChart("../../FusionCharts/Pie3D.swf", "", xmlData, "FactorySum", "600", "300", False, False)
        End Function

        Protected Overrides Sub OnInit(ByVal e As EventArgs)
            '
            ' CODEGEN: This call is required by the ASP.NET Web Form Designer.
            '
            InitializeComponent()
            MyBase.OnInit(e)
        End Sub

        ''' <summary>
        ''' Required method for Designer support - do not modify
        ''' the contents of this method with the code editor.
        ''' </summary>
        Private Sub InitializeComponent()
            AddHandler Load, AddressOf Me.Page_Load
        End Sub
    End Class
End Namespace