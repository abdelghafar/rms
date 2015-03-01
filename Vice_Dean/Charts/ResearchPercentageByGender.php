<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../../js/jqwidgets/jqwidgets/styles/jqx.summer.css" type="text/css" />
        <script type="text/javascript" src="../../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="../../js/jqwidgets/scripts/demos.js"></script>
        <script type="text/javascript" src="../../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../../js/jqwidgets/jqwidgets/jqxchart.js"></script>
        <script type="text/javascript" src="../../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>

        <script type="text/javascript" src="../../js/jqwidgets/jqwidgets/jqxdata.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var maxValue = 50;
                // prepare the data
                var theme = 'summer';
                var source =
                        {
                            datatype: "json",
                            useGradient: true,
                            datafields: [
                                {name: 'text'},
                                {name: 'val'}
                            ],
                            url: '../../Reports/inc/GetTotalResearchCountByGender.php?year=1435'
                        };
                var dataAdapter = new $.jqx.dataAdapter(source,
                        {
                            autoBind: true,
                            async: false,
                            downloadComplete: function() {
                            },
                            loadComplete: function() {
                            },
                            loadError: function(xhr, status, error) {
                                alert('Error loading "' + source.url + '" : ' + error);
                            }
                        });
                // prepare jqxChart settings
                var settings = {
                    title: "اجمالي الابحاث المقدمة لعام 1435",
                    description: "نسبة الابحاث ذكور/ اناث باعتبار الباحث الرئيس",
                    showLegend: true,
                    rtl: true,
                    padding: {left: 5, top: 5, right: 50, bottom: 5},
                    titlePadding: {left: 90, top: 0, right: 0, bottom: 10},
                    source: dataAdapter,
                    colorScheme: 'scheme02',
                    seriesGroups:
                            [
                                {
                                    type: 'pie',
                                    showLabels: true,
                                    series:
                                            [
                                                {
                                                    dataField: 'val',
                                                    displayText: 'text',
                                                    labelRadius: 100,
                                                    initialAngle: 15,
                                                    radius: 180,
                                                    centerOffset: 0,
                                                    formatSettings: {sufix: '%', decimalPlaces: 2}
                                                }
                                            ]
                                }
                            ]

                };
                //print button 
                // setup the chart
                $('#jqxChart').jqxChart(settings);
                $("#printButton").jqxButton({theme: theme});
                $("#pngButton").jqxButton({theme: theme});


                $("#pngButton").click(function() {
                    // call the export server to create a PNG image
                    $('#jqxChart').jqxChart('saveAsPNG', 'myChart.png');
                });


            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#printButton").click(function() {
                    var content = $('#jqxChart')[0].outerHTML;
                    var newWindow = window.open('', '', 'width=800, height=500'),
                            document = newWindow.document.open(),
                            pageContent =
                            '<!DOCTYPE html>' +
                            '<html>' +
                            '<head>' +
                            '<link rel="stylesheet" href="../../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />' +
                            '<meta charset="utf-8" />' +
                            '<title>اجمالي الابحاث المقدمة الذكور/الاناث</title>' +
                            '</head>' +
                            '<body>' + content + '</body></html>';
                    document.write(pageContent);
                    document.close();
                    newWindow.print();
                });
            });


        </script>
    </head>
    <body>
    <center>
        <div style="width:700px; height:450px" id="jqxChart"></div>
        <div style='margin-top: 10px;'>
            <input style='float: left; margin-left: 5px;' id="pngButton" type="button" value="Save" />
            <input style='float: left;' id="printButton" type="button" value="Print" />
        </div>
    </center>
</body>
</html>
