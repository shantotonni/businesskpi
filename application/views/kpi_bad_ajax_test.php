<?php  /*
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-migrate-1.1.1.min.js"></script> 
*/
?>
<style>
    .canvasjs-chart-credit {
        display: none;
    }
</style>
<!--<div id="ReportBDloading"></div>-->

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




            <?php
            $count = 0;

            foreach($row_KPI_Business as $row_bus){
                global $Business;
                $Business = $row_bus['Business'];
                $row_kpi_driven = array_filter($row_KPIDriven, "filterBusiness");

                /***************/
                foreach($row_kpi_driven as $row){
                    global $ValueDriver;               
                    $ValueDriver = $row['ValueDriver'];
					if(!empty($row_KPIMetrics)){
                    $drivenfilter = array_filter($row_KPIMetrics, "filterDriven");            
//print_r($row_KPIMetrics); exit();
                    //if($Business == 'CB Core' && $ValueDriver == 'Campaign Effectiveness') { echo "<pre />"; print_r($drivenfilter);       exit();     } 
                    foreach($drivenfilter as $row1){ 
                        $count++; 
                        global $ValueKPIMetrics;
                        $ValueKPIMetrics = $row1['KPIMetrics']; //exit();
                        $KPIMetricsfilter = array_filter($rows, "filterKPIMetrics");
                        // if($ValueKPIMetrics == 'Cash Collection to Bank Deposit'){ echo "<pre />"; print_r($KPIMetricsfilter); exit(); }    
//print_r($KPIMetricsfilter)                        ; exit();
                        ?>
                        var chart<?php echo $count;?> = new CanvasJS.Chart("chart<?php echo $count;?>", {
                            zoomEnabled: true,
                            credit: false,
                            zoomEnabled: true,
                            credit: false,
                            title:{
                               text: "<?php echo $ValueKPIMetrics;?>",
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
                                type: "<?php echo $charttype; ?>",
                                //type: 'bar',
                                //type: "column",  
                                //type: "pie",
                                showInLegend: false,
                                name: "<?php echo $ValueKPIMetrics;?>",
                                markerType: "square",
                                //color: "#F08080",
                                dataPoints: [
									{ label: '<?php echo $min_period; ?>', y: 0 },								
                                    <?php 
                                    if(!empty($KPIMetricsfilter)){
                                        foreach($KPIMetricsfilter as $row3){ 
                                            if($row3['ValueType'] == 'Anomolies'){
                                                $color = " , color: \"red\" ";
                                            }else{
                                                $color = " ";
                                            }
                                            ?>{ label: '<?php echo $row3['CPERIOD']; ?>', y: <?php echo $row3['KPIIndex'] . $color; ?> },<?php
                                        }
                                    }
                                    ?>
                                ]
                            }]
                        });	
                        chart<?php echo $count;?>.render();
                        <?php 
                    }
					}
                }
                /***********************/
            }
            ?>
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

<?php
    function filterBusiness($val){
        //print_r($val); exit();
        global $Business;
        if($val['Business'] == $Business){
            return true;
        }else{
            return false;
        }                        
    }

    function filterDriven($val){
        //print_r($val); exit();
        global $ValueDriver;
        global $Business;
        if($val['ValueDriver'] == $ValueDriver && $val['Business'] == $Business){
            return true;
        }else{
            return false;
        }                        
    }
	
    function filterKPIMetrics($val){
        //print_r($val); exit();
        global $ValueKPIMetrics;
        global $ValueDriver;
        global $Business;
        
        //echo $ValueKPIMetrics . $ValueDriver . $Business; exit();
        
        if($val['KPIMetrics'] == $ValueKPIMetrics && $val['ValueDriver'] == $ValueDriver && $val['Business'] == $Business){
            return true;
        }else{
            return false;
        }                        
    }
	
    $count = 0;
	?>
<div class="row">

			<?php
			if(empty($row_KPI_Business)){
				exit();
			}
			foreach($row_KPI_Business as $row_bus){
				global $Business;
				$Business = $row_bus['Business'];
				$row_kpi_driven = array_filter($row_KPIDriven, "filterBusiness");
				?>
				 <!--<div class="col-md-4">-->
					<!--<div style="width: 98%; float: left; text-align: left; font-size:16px; background-color: #ccff90; 
						color: #000; border: 1px solid #CCC; margin-top: 10px; margin-bottom: 10px; padding: 5px;">
						&nbsp;&nbsp;&nbsp;<?php echo $row_bus['Business']; //echo count($row_kpi_driven); ?>
					</div>	-->			
							
							<?php
							/*******************/   
							foreach($row_kpi_driven as $row){
								global $ValueDriver;
								$ValueDriver = $row['ValueDriver'];
								if(!empty($row_KPIMetrics)){
									$matricsfilter = array_filter($row_KPIMetrics, "filterDriven");
								
								?>

							
								<?php                         
								foreach($matricsfilter as $row1){ $count++; ?>
									<div class="col-md-6">
										
										<div onclick="doLoadChartBad('<?php echo $row_bus['Business']; ?>','<?php echo $row['ValueDriver']; ?>','<?php echo str_replace("&","___", $row1['KPIMetrics']); ?>')" style="cursor:grab; width: 95%; font-size:16px; background-color: #ffffc2; color: #444;  margin-top: 10px; margin-bottom: 10px; padding-left: 5px;">
											<div style="width: 100%;">							
												<div style="width: 80%; text-align: left;"  aria-hidden="true">
													&nbsp;<?php echo $row_bus['Business'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row1['ValueDriver']; ?>&nbsp;<i class="fa fa-plus" style="font-size:16px; color:#888;"></i>
												</div>
											</div>							
										</div>
										<div style="width: 95%; height: 350px; border: 1px solid #CCC;">
											<div style="border-bottom:1px solid #ddd;  height: 350px;  margin-left: 1%; margin-right: 2%; margin-bottom: 20px;" 
												id="chart<?php echo $count; ?>">
												<?php echo $row1['KPIMetrics']; ?>
											</div>
										</div>
									</div> 
							<?php
							} 
								}
							?>

								<?php
							} 
							?>					
					   
				<!--</div> --> 				
				<?php
				/***********************/
			}
			?>

</div>
<script src="<?php echo base_url(); ?>assets/canvasjs-2.3.2/canvasjs.min.js"></script>

<div class="row">
    <div class="col-md-12">&nbsp;</div>
</div>
<script>
    $(document).ready(function() {
        var total_sale = 0;
        var rows = $("#tbl tr:gt(0)");

        rows.children("td:nth-child(2)").each(function() {
            total_sale += parseFloat($(this).html());
            //console.log(total_sale);
        });
        $("#total_vale").html(total_sale);
    });
</script>
<div class="row">

    <div class="col-md-3">
        <?php //echo '<pre/>';print_r($row_count);?>
        <style>
            .table td, .table th {
                padding: 0rem;
                font-size: 12px;
            }
        </style>
        <table id="tbl" class="table table-bordered">
            <thead>
                <tr>
                    <th>&nbsp;Business</th>
                    <th class="text-center">CNT</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($row_count AS $row){ ?>
                    <tr>
                        <td style="width:200px;">&nbsp;<?php echo $row['Business'];?></td>
                        <td class="text-center"><?php echo $row['cnt'];?></td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td style="width:200px; font-weight:600;">&nbsp;Total</td>
                    <td class="text-center"><span id="total_vale"></span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>		