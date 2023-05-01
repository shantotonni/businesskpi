<style>
    .canvasjs-chart-credit {
        display: none;
    }
</style>

<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            title:{
                text: "KPI Comparison"   ,
                fontSize: 20, 
                fontFamily: "tahoma",        
            }, 
            axisY:{
                title: "Index"     ,
                fontSize: 16 
            },
            toolTip: {
                shared: true
            },
            legend:{
                cursor:"pointer",
                itemclick: toggleDataSeries
            },
            data: [{        
                type: "spline",  
                name: "US",        
                showInLegend: true,
                dataPoints: [
                    { label: "Atlanta 1996" , y: 44 },     
                    { label: "Sydney 2000", y: 37 },     
                    { label: "Athens 2004", y: 36 },     
                    { label: "Beijing 2008", y: 36 },     
                    { label: "London 2012", y: 46 },
                    { label: "Rio 2016", y: 46 }
                ]
                }, 
                {        
                    type: "spline",
                    name: "China",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 16 },     
                        { label: "Sydney 2000", y: 28 },     
                        { label: "Athens 2004", y: 32 },     
                        { label: "Beijing 2008", y: 48 },     
                        { label: "London 2012", y: 38 },
                        { label: "Rio 2016", y: 26 }
                    ]
                },
                {        
                    type: "spline",  
                    name: "Britain",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 1 },     
                        { label: "Sydney 2000", y: 11 },     
                        { label: "Athens 2004", y: 9 },     
                        { label: "Beijing 2008", y: 19 },     
                        { label: "London 2012", y: 29 },
                        { label: "Rio 2016", y: 27 }
                    ]
                },
                {        
                    type: "spline",  
                    name: "Russia",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 26 },     
                        { label:"Sydney 2000", y: 32 },     
                        { label: "Athens 2004", y: 28 },     
                        { label: "Beijing 2008", y: 22 },     
                        { label: "London 2012", y: 20 },
                        { label: "Rio 2016", y: 19 }
                    ]
                },
                {        
                    type: "spline",  
                    name: "S Korea",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 7 },     
                        { label:"Sydney 2000", y: 8 },     
                        { label: "Athens 2004", y: 9 },     
                        { label: "Beijing 2008", y: 13 },     
                        { label: "London 2012", y: 13 },
                        { label: "Rio 2016", y: 9 }
                    ]
                },  
                {        
                    type: "spline",  
                    name: "Germany",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 20 },     
                        { label:"Sydney 2000", y: 13 },     
                        { label: "Athens 2004", y: 13 },     
                        { label: "Beijing 2008", y: 16 },     
                        { label: "London 2012", y: 11 },
                        { label: "Rio 2016", y: 17 }
                    ]
                },{        
                    type: "spline",  
                    name: "US",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 44 },     
                        { label:"Sydney 2000", y: 37 },     
                        { label: "Athens 2004", y: 36 },     
                        { label: "Beijing 2008", y: 36 },     
                        { label: "London 2012", y: 46 },
                        { label: "Rio 2016", y: 46 }
                    ]
                }, 
                {        
                    type: "spline",
                    name: "China",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 16 },     
                        { label:"Sydney 2000", y: 28 },     
                        { label: "Athens 2004", y: 32 },     
                        { label: "Beijing 2008", y: 48 },     
                        { label: "London 2012", y: 38 },
                        { label: "Rio 2016", y: 26 }
                    ]
                },
                {        
                    type: "spline",  
                    name: "Britain",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 1 },     
                        { label:"Sydney 2000", y: 11 },     
                        { label: "Athens 2004", y: 9 },     
                        { label: "Beijing 2008", y: 19 },     
                        { label: "London 2012", y: 29 },
                        { label: "Rio 2016", y: 27 }
                    ]
                },
                {        
                    type: "spline",  
                    name: "Russia",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 26 },     
                        { label:"Sydney 2000", y: 32 },     
                        { label: "Athens 2004", y: 28 },     
                        { label: "Beijing 2008", y: 22 },     
                        { label: "London 2012", y: 20 },
                        { label: "Rio 2016", y: 19 }
                    ]
                },
                {        
                    type: "spline",  
                    name: "S Korea",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 7 },     
                        { label:"Sydney 2000", y: 8 },     
                        { label: "Athens 2004", y: 9 },     
                        { label: "Beijing 2008", y: 13 },     
                        { label: "London 2012", y: 13 },
                        { label: "Rio 2016", y: 9 }
                    ]
                },  
                {        
                    type: "spline",  
                    name: "Germany",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 20 },     
                        { label:"Sydney 2000", y: 13 },     
                        { label: "Athens 2004", y: 13 },     
                        { label: "Beijing 2008", y: 16 },     
                        { label: "London 2012", y: 11 },
                        { label: "Rio 2016", y: 17 }
                    ]
                },{        
                    type: "spline",  
                    name: "US",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 44 },     
                        { label:"Sydney 2000", y: 37 },     
                        { label: "Athens 2004", y: 36 },     
                        { label: "Beijing 2008", y: 36 },     
                        { label: "London 2012", y: 46 },
                        { label: "Rio 2016", y: 46 }
                    ]
                }, 
                {        
                    type: "spline",
                    name: "China",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 16 },     
                        { label:"Sydney 2000", y: 28 },     
                        { label: "Athens 2004", y: 32 },     
                        { label: "Beijing 2008", y: 48 },     
                        { label: "London 2012", y: 38 },
                        { label: "Rio 2016", y: 26 }
                    ]
                },
                {        
                    type: "spline",  
                    name: "Britain",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 1 },     
                        { label:"Sydney 2000", y: 11 },     
                        { label: "Athens 2004", y: 9 },     
                        { label: "Beijing 2008", y: 19 },     
                        { label: "London 2012", y: 29 },
                        { label: "Rio 2016", y: 27 }
                    ]
                },
                {        
                    type: "spline",  
                    name: "Russia",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 26 },     
                        { label:"Sydney 2000", y: 32 },     
                        { label: "Athens 2004", y: 28 },     
                        { label: "Beijing 2008", y: 22 },     
                        { label: "London 2012", y: 20 },
                        { label: "Rio 2016", y: 19 }
                    ]
                },
                {        
                    type: "spline",  
                    name: "S Korea",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 7 },     
                        { label:"Sydney 2000", y: 8 },     
                        { label: "Athens 2004", y: 9 },     
                        { label: "Beijing 2008", y: 13 },     
                        { label: "London 2012", y: 13 },
                        { label: "Rio 2016", y: 9 }
                    ]
                },  
                {        
                    type: "spline",  
                    name: "Germany",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 20 },     
                        { label:"Sydney 2000", y: 13 },     
                        { label: "Athens 2004", y: 13 },     
                        { label: "Beijing 2008", y: 16 },     
                        { label: "London 2012", y: 11 },
                        { label: "Rio 2016", y: 17 }
                    ]
                },{        
                    type: "spline",  
                    name: "US",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 44 },     
                        { label:"Sydney 2000", y: 37 },     
                        { label: "Athens 2004", y: 36 },     
                        { label: "Beijing 2008", y: 36 },     
                        { label: "London 2012", y: 46 },
                        { label: "Rio 2016", y: 46 }
                    ]
                }, 
                {        
                    type: "spline",
                    name: "China",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 16 },     
                        { label:"Sydney 2000", y: 28 },     
                        { label: "Athens 2004", y: 32 },     
                        { label: "Beijing 2008", y: 48 },     
                        { label: "London 2012", y: 38 },
                        { label: "Rio 2016", y: 26 }
                    ]
                },
                {        
                    type: "spline",  
                    name: "Britain",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 1 },     
                        { label:"Sydney 2000", y: 11 },     
                        { label: "Athens 2004", y: 9 },     
                        { label: "Beijing 2008", y: 19 },     
                        { label: "London 2012", y: 29 },
                        { label: "Rio 2016", y: 27 }
                    ]
                },
                {        
                    type: "spline",  
                    name: "Russia",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 26 },     
                        { label:"Sydney 2000", y: 32 },     
                        { label: "Athens 2004", y: 28 },     
                        { label: "Beijing 2008", y: 22 },     
                        { label: "London 2012", y: 20 },
                        { label: "Rio 2016", y: 19 }
                    ]
                },
                {        
                    type: "spline",  
                    name: "S Korea",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 7 },     
                        { label:"Sydney 2000", y: 8 },     
                        { label: "Athens 2004", y: 9 },     
                        { label: "Beijing 2008", y: 13 },     
                        { label: "London 2012", y: 13 },
                        { label: "Rio 2016", y: 9 }
                    ]
                },  
                {        
                    type: "spline",  
                    name: "Germany",        
                    showInLegend: true,
                    dataPoints: [
                        { label: "Atlanta 1996" , y: 20 },     
                        { label: "Sydney 2000", y: 13 },     
                        { label: "Athens 2004", y: 13 },     
                        { label: "Beijing 2008", y: 16 },     
                        { label: "London 2012", y: 11 },
                        { label: "Rio 2016", y: 17 }
                    ]
            }]
        });

        chart.render();

        function toggleDataSeries(e) {
            if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            }
            else {
                e.dataSeries.visible = true;            
            }
            chart.render();
        }

    }
</script>

<div class="col-md-12" >
    <div style="width: 99%; height: 500px; border: 1px solid #CCC; margin-top: 50px;">
        <div id="chartContainer" style="height: 500px; width: 100%;"></div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/canvasjs-2.3.2/canvasjs.min.js"></script>    






