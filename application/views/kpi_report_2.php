<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-migrate-1.1.1.min.js"></script> 
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
               $drivenfilter = array_filter($row_KPIMetrics, "filterDriven");            

               //if($Business == 'CB Core' && $ValueDriver == 'Campaign Effectiveness') { echo "<pre />"; print_r($drivenfilter);       exit();     } 
                   foreach($drivenfilter as $row1){ 
                       $count++; 
                       global $ValueKPIMetrics;
                       $ValueKPIMetrics = $row1['KPIMetrics'];
                       $KPIMetricsfilter = array_filter($rows, "filterKPIMetrics");
                        //if($ValueKPIMetrics == 'ATL to BTL Cost Mix'){ echo "<pre />"; print_r($KPIMetricsfilter); exit(); }
                       ?>
                           var chart<?php echo $count;?> = new CanvasJS.Chart("chart<?php echo $count;?>", {
                                   zoomEnabled: true,
                                   credit: false,
                                   animationEnabled: true,
                                   theme: "light2",
                                  toolTip:{
                                    contentFormatter: function ( e ) {
                                        return "Index : " +  e.entries[0].dataPoint.y;  
                                    }  
                                  },
                                   title:{
                                           text: "<?php echo $ValueKPIMetrics;?>",
                                           fontSize: 16,
                                   },
                                   axisX:{
                                    labelAngle: 45
                                   },
                                   axisY:{
                                           includeZero: false
                                   },
                                   data: [{
                                       type: "line",
                                       showInLegend: true,
                                       name: "<?php echo $ValueKPIMetrics;?>",
                                       markerType: "square",
                                       color: "#F08080",
                                       dataPoints: [ 
											{ label: '<?php echo $min_period; ?>', y: 0 },									   
                                           <?php 
                                           if(!empty($KPIMetricsfilter)){
                                               foreach($KPIMetricsfilter as $row3){ 
                                                   ?>{ label: '<?php echo $row3['CPERIOD']; ?>', y: <?php echo $row3['KPIIndex']; ?> },<?php
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
                /***********************/
                }
           ?>
      // }
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
       if($val['KPIMetrics'] == $ValueKPIMetrics && $val['ValueDriver'] == $ValueDriver && $val['Business'] == $Business){
           return true;
       }else{
           return false;
       }                        
   }
   $count = 0;
   foreach($row_KPI_Business as $row_bus){
       global $Business;
       $Business = $row_bus['Business'];
       $row_kpi_driven = array_filter($row_KPIDriven, "filterBusiness");
    ?>
    <div style="width: 100%; float: left; text-align: left; font-size:16px; background-color: #ccff90; 
                color: #000; border: 1px solid #CCC; margin-top: 10px; margin-bottom: 10px; padding: 5px;">
        &nbsp;&nbsp;&nbsp;<?php echo $row_bus['Business']; ?>
    </div>
    <?php
   /*******************/
   
   foreach($row_kpi_driven as $row){
       global $ValueDriver;
       $ValueDriver = $row['ValueDriver'];
       $matricsfilter = array_filter($row_KPIMetrics, "filterDriven");
   ?>
       <div style="width: 100%; float: left">
           <div style="width: 100%; float: left; text-align: left; font-size:16px; background-color: #ffffc2; 
                color: #000; border: 1px solid #CCC; margin-top: 10px; margin-bottom: 10px; padding: 5px;">
               &nbsp;&nbsp;&nbsp;<?php echo $row['ValueDriver']; ?>
           </div>
               <?php                         
               foreach($matricsfilter as $row1){ $count++; ?>

                   <div style="width: 30%; border:1px solid #ddd; margin-left: 1%; margin-right: 2%; margin-bottom: 20px; float: left; height: 300px;" 
                            id="chart<?php echo $count; ?>">
                        <?php echo $row1['KPIMetrics']; ?>
                   </div>

               <?php } ?>
       </div>
       <?php
   } 
   /***********************/
   }
   ?> 
</div>
<script src="<?php echo base_url(); ?>assets/canvasjs-2.3.2/canvasjs.min.js"></script>