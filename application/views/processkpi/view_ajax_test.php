<!DOCTYPE HTML>
<html>
    <head>
        <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>  
        <script type="text/javascript">
            $(document).ready(function(){
                var chart1 = new CanvasJS.Chart("chartContainerV001M005Pharma", {
                    zoomEnabled:true,
                    animationEnabled: true,
                    exportEnabled: false,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    title:{
                        text: "Pharma - Supply Chain KPIs",
                        fontSize: 14,
                        fontFamily: "tahoma",
                        horizontalAlign: "left",
                        verticalAlign: "center",
                    },
                    subtitles:[
                        {
                            text: " ",
                            fontSize: 15,
                            fontFamily: "tahoma",
                            horizontalAlign: "left",
                            verticalAlign: "center",
                    }],
                    axisY:[{
                        title: "Number",
                        lineColor: "#369EAD",
                        titleFontColor: "#369EAD",
                        labelFontColor: "#369EAD",
                        fontSize: 12
                    }],
                    axisY2:[{
                        title: "Percentage",
                        lineColor: "#7F6084",
                        titleFontColor: "#7F6084",
                        labelFontColor: "#7F6084",
                        fontSize: 12
                    }],
                    legend: {
                        cursor: "pointer",
                        itemclick: function (e) {
                            //console.log("legend click: " + e.dataPointIndex);
                            //console.log(e);
                            if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                e.dataSeries.visible = false;
                            } else {
                                e.dataSeries.visible = true;
                            }

                            e.chart.render();
                        }
                    },

                    axisY: {
                        includeZero: true
                    },
                    data: [{
                        type: "column", //change type to bar, line, area, pie, etc 1
                        axisYIndex: "0", //defaults to 0
                        axisYType: "primary",
                        indexLabelFontColor: "#5A5757",
                        indexLabelFontSize: 16,
                        indexLabelPlacement: "outside",
                        showInLegend: true, 
                        legendText: "Average Lead time",
                        dataPoints: [
                            { x: 1,  y: 3196.00, label: "Jan 20" },{ x: 2,  y: 3801.00, label: "Feb 20" },{ x: 3,  y: 2261.00, label: "Mar 20" },{ x: 4,  y: 2702.00, label: "Apr 20" },{ x: 5,  y: 3739.00, label: "May 20" },{ x: 6,  y: 5749.00, label: "Jun 20" },{ x: 7,  y: 4330.00, label: "Jul 20" },{ x: 8,  y: 3478.00, label: "Aug 20" },{ x: 9,  y: 3553.00, label: "Sep 20" },{ x: 10,  y: 4892.00, label: "Oct 20" },{ x: 11,  y: 3307.00, label: "Nov 20" },{ x: 12,  y: 2429.00, label: "Dec 20" },{ x: 13,  y: 3974.00, label: "Jan 21" },{ x: 14,  y: 2469.00, label: "Feb 21" }
                        ]
                    }]
                });
                chart1.render();
            });
        </script>
        </head>
    <body>
        <div id="chartContainerV001M005Pharma" style="height: 300px; width: 100%;">adsf
        </div>
    </body>
</html>