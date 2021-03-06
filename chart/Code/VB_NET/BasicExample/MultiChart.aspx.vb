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
Imports System.Text

Namespace InfoSoftGlobal.GeneralPages.ASP.NET.BasicExample

    ''' <summary>
    ''' Summary description for MultiChart.
    ''' </summary>
    Public Class MultiChart
        Inherits System.Web.UI.Page

        Protected LiteralChart As System.Web.UI.WebControls.Literal

        Private Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs)

        End Sub

        Public Function GetMonthlySales3DChartHtml() As String            
            'This page demonstrates how you can show multiple charts on the same page.
            'For this example, all the charts use the pre-built Data.xml (contained in /Data/ folder)
            'However, you can very easily change the data source for any chart. 
            'IMPORTANT NOTE: Each chart necessarily needs to have a unique ID on the page.
            'If you do not provide a unique Id, only the last chart might be visible.
            'Here, we've used the ID chart1, chart2 and chart3 for the 3 charts on page.
            'Create the chart - Column 3D Chart with data from Data/Data.xml
            Return FusionCharts.RenderChart("../../FusionCharts/Column3D.swf", "Data/Data.xml", "", "chart1", "600", "300", False, False)            
        End Function

        Public Function GetMonthlySales2DChartHtml() As String            
            'This page demonstrates how you can show multiple charts on the same page.
            'For this example, all the charts use the pre-built Data.xml (contained in /Data/ folder)
            'However, you can very easily change the data source for any chart. 
            'IMPORTANT NOTE: Each chart necessarily needs to have a unique ID on the page.
            'If you do not provide a unique Id, only the last chart might be visible.
            'Here, we've used the ID chart1, chart2 and chart3 for the 3 charts on page.
            'Now, create a Column 2D Chart
            Return FusionCharts.RenderChart("../../FusionCharts/Column2D.swf", "Data/Data.xml", "", "chart2", "600", "300", False, False)            
        End Function

        Public Function GetMonthlySalesLineChartHtml() As String            
            'This page demonstrates how you can show multiple charts on the same page.
            'For this example, all the charts use the pre-built Data.xml (contained in /Data/ folder)
            'However, you can very easily change the data source for any chart. 
            'IMPORTANT NOTE: Each chart necessarily needs to have a unique ID on the page.
            'If you do not provide a unique Id, only the last chart might be visible.
            'Here, we've used the ID chart1, chart2 and chart3 for the 3 charts on page.
            'Now, create a Line 2D Chart
            Return FusionCharts.RenderChart("../../FusionCharts/Line.swf", "Data/Data.xml", "", "chart3", "600", "300", False, False)            
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