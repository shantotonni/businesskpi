<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
</div>
<!--End-breadcrumbs-->

<!--Action boxes-->
<div class="container-fluid">


    <!--Chart-box-->    
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
                <h5><?php echo $page_title;?></h5>
            </div>
            <div class="widget-content" >
                <div class="row-fluid">

                    <?php for($i=1; $i<=2;$i++){?>  <?php } ?>
                    <div class="span4"> 
                        <script>
                            window.onload = function () {
                                var chart_1 = new CanvasJS.Chart("chartContainer_1", {
                                    animationEnabled: true,
                                    theme: "light2",
                                    title:{
                                        text: "Simple Line Chart"
                                    },
                                    axisY:{
                                        includeZero: false
                                    },
                                    data: [{        
                                        type: "line",       
                                        dataPoints: [
                                            { y: 350 },
                                            { y: 414},
                                            { y: 520, indexLabel: "highest",markerColor: "red", markerType: "triangle" },
                                            { y: 460 },
                                            { y: 450 },
                                            { y: 500 },
                                            { y: 480 },
                                            { y: 480 },
                                            { y: 410 , indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
                                            { y: 500 },
                                            { y: 480 },
                                            { y: 510 }
                                        ]
                                    }]
                                });
                                chart_1.render();
                            }
                        </script>
                        <div id="chartContainer_1" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>                       
                    </div>
                    <div class="span4"> 
                        <script>
                            window.onload = function () {
                                var chart_2 = new CanvasJS.Chart("chartContainer_2", {
                                    animationEnabled: true,
                                    theme: "light2",
                                    title:{
                                        text: "Simple Line Chart"
                                    },
                                    axisY:{
                                        includeZero: false
                                    },
                                    data: [{        
                                        type: "line",       
                                        dataPoints: [
                                            { y: 250 },
                                            { y: 414},
                                            { y: 520, indexLabel: "highest",markerColor: "red", markerType: "triangle" },
                                            { y: 460 },
                                            { y: 450 },
                                            { y: 500 },
                                            { y: 480 },
                                            { y: 480 },
                                            { y: 410 , indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
                                            { y: 500 },
                                            { y: 480 },
                                            { y: 510 }
                                        ]
                                    }]
                                });
                                chart_2.render();
                            }
                        </script>
                        <div id="chartContainer_2" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>  
                    </div>
                    <script src="<?php echo base_url(); ?>assets/canvasjs-2.3.2/canvasjs.min.js"></script>
                </div>
            </div>
        </div>
        <!--End-Chart-box--> 
    </div>
</div>