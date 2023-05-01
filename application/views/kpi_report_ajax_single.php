
<style>
    .canvasjs-chart-credit {
        display: none;
    }
</style>
<!--<div id="ReportBDloading"></div>-->
<div class="row">
    <?php
    function filteritem($val){
        Global $FilterKPIMetrics;    
        if($val['KPIMetrics'] == $FilterKPIMetrics){
            return true;
        }else{
            return false;
        }                        
    }  
    ?>
    <script>
        $(document).ready(function(){
            //function () {

            var chartid = new CanvasJS.Chart("chartid", {
                width: 780,
                height:400,
                zoomEnabled: true,
                credit: false,
                title:{
                   text: "<?php echo $KPIMetrics;?>",
                   fontSize: 16,      
                }, 
                legend: {
                    fontSize: 12,
                    cursor:"pointer",
                    itemclick: toggleDataSeries
                },
                axisX:{
                    labelFontSize: 12
                },
                axisY:{
                    title: "",
                    fontSize: 16 ,
                    labelFontSize: 12  ,
                    includeZero: false
                },
                toolTip:{
                    contentFormatter: function ( e ) {
                        return "Period : " + e.entries[0].dataPoint.label + " Index : " +  e.entries[0].dataPoint.y;  
                    }  
                },  
                data: [{
                    type: "<?php echo $ChartType; ?>",
                    showInLegend: false,
                    name: "<?php echo $KPIMetrics;?>",
                    markerType: "square",
                    //color: "#F08080",
                    dataPoints: [  
						{ label: '<?php echo $min_period; ?>', y: 0 },
                        <?php 
                        if(!empty($rows)){
                            foreach($rows as $row3){ 
                                ?>{ label: '<?php echo $row3['CPERIOD']; ?>', y: <?php echo $row3['KPIIndex']; ?> },<?php
                            }
                        }
                        ?>
                    ]
                }]
            });	
            chartid.render();

            // } 
            function toggleDataSeries(e) {
                if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                }
                else {
                    e.dataSeries.visible = true;            
                }
                chart.render();
            }  
        });
    </script>
    <div class="col-md-12" id="chartid" style="width: 100%; height: 500px; border:0px solid red;"></div>

</div>


<div class="row">
    <div class="col-md-6">
        C-Calculation :  <?php echo $rows[0]['CCalculation']; ?>        <br />
        D-Calculation :  <?php echo $rows[0]['DCalculation']; ?>        <br />
        Index Value Calculation  : <?php echo $rows[0]['IndexValueCalculation']; ?> <br />    <br />
    </div>

    <div class="col-md-6">
        A :  <?php echo $rows[0]['ATXT']; ?>        <br />
        B :  <?php echo $rows[0]['BTXT']; ?>        <br />
        C  : <?php echo $rows[0]['CTXT']; ?> <br />    
        D  : <?php echo $rows[0]['DTXT']; ?> <br />    
        <br />
    </div>

    <div class="col-md-12 table-responsive">
        <table class="table table-bordered table-hover  table-striped">
            <thead>
                <tr>
                <tr>
                    <th class="text-center">SL</th>
                    <th class="text-center">CPERIOD</th>
                    <th class="text-center">A</th>
                    <th class="text-center">B</th>
                    <th class="text-center">C</th>
                    <th class="text-center">D</th>
                    <th class="text-center">Index</th>                                
                </tr>

                <?php
                /*
                $index = array_keys($rows[0]);
                for($i = 0; $i < count($index); $i++){
                ?><th><?php echo str_replace(array('_'), array(' '), $index[$i]); ?></th><?php
                }
                */
                ?>
                </tr>
            </thead> 
            <?php

            for ($i = 0; $i < count($rows); $i++) {
                $arrayvalue = array_values($rows[$i]);
                ?>
                <tr>
                    <td class="text-center"><?php echo $i + 1; ?></td>
                    <td><?php echo "&nbsp;" . date("M y",strtotime($rows[$i]['CPERIOD'].'01')); ?></td>
                    <td class="text-center"><?php echo number_format($rows[$i]['Value'],1); ?></td>
                    <td class="text-center"><?php echo number_format($rows[$i]['Value1'],1); ?></td>
                    <td class="text-center"><?php echo number_format($rows[$i]['Value2'],1); ?></td>
                    <td class="text-center"><?php echo number_format($rows[$i]['Value3'],1); ?></td>
                    <td class="text-center"><?php echo number_format($rows[$i]['KPIIndex'],1); ?></td>                  
                </tr>
                <?php
            }
            ?>

        </table>
    </div>
</div>



<script src="<?php echo base_url(); ?>assets/js/canvasjs.min.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/canvasjs-2.3.2/canvasjs.min.js"></script>-->