<!DOCTYPE html>
<html lang="en">
<head>
  <title>KPI Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php /*
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  */ ?>
  
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
/*
$(document).ready(function(){
	$('#button').on( "click", function() {
	   $('#myModal').modal('show');
	});
});*/
</script>
<style>
    table th{
        font-size: 12px;
    }
    table td{
        font-size: 12px;
    }
</style>

   
</head>
<body>
 
<?php //print_r($comparedata); //exit(); ?> 

    <div class="container-fluid">
        <div class="row">            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">&nbsp;</div>
                </div>
                <form action="" method="POST" style="border: 1px solid #CCC; padding: 20px;">
                    <div class="row">                                 
                        <div class="col-sm-1">
                            <label for="Business">Business : &nbsp;</label>
                                
                        </div>	
                        <div class="col-sm-2">
                          <select class="form-control" id="Business" name="Business">
                            <option value="">All</option>
                            <?php foreach ($row_business as $Bu):                                
                                 if (isset($Business) && $Business == $Bu->Business) {$selected = ' selected="selected"';}
                                 else {$selected = '';}
                                 echo '<option value="'.$Bu->Business.'"'.$selected.'>'.$Bu->Business.'</option>';
                                 endforeach;
                             ?>
                        </select>
                        </div>				
					    <div class="col-sm-1">
                            <label for="Business">Value Driver : &nbsp;</label>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="ValueDriver" name="ValueDriver"
                                onchange="doLoadKPI(this.value)">
                                <option value=""></option>
								<?php 
								if(!empty($valuedriven)){ 
									foreach($valuedriven as $value){
								?>
									<option 
                                    <?php if(!empty($ValueDriver) && $ValueDriver == $value['ValueDriverCode']){ ?> selected="selected" <?php } ?>
                                    value="<?php echo $value['ValueDriverCode']; ?>"><?php echo $value['ValueDriverName']; ?></option>
								<?php 
									} 
								}
								?>                            
                            </select>
                        </div>	
                        
                        <div class="col-sm-1">
                            <label for="Business">KPI : &nbsp;</label>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="KPIMetrics" name="KPIMetrics[]" multiple="multiple">
                                <?php 
                                if(!empty($kpilist)){
                                    foreach ($kpilist as $dt) {
                                        ?><option 
                                        <?php
                                            if(!empty($KPIMetrics)){
                                                for($i = 0; $i < count($KPIMetrics); $i++){
                                                    $selected = "";
                                                    //print_r($period); exit();
                                                    if($KPIMetrics[$i] == $dt['KPIMetricsCode']){
                                                        echo " selected=\"selected\" ";
                                                    }
                                                }
                                            }
                                        ?>
                                        
                                         value="<?php echo $dt['KPIMetricsCode']; ?>"><?php echo $dt['KPIMetricsName']; ?></option><?php
                                    }     
                                }
                                ?>                            
                            </select> 
                        </div>
                    					    
                    					    
					    <div class="col-sm-1">
                            <label for="Business">Chart Type : &nbsp;</label>
                        </div>
                        
                        <div class="col-sm-2">
                            <select class="form-control" id="charttype" name="charttype">
                                <option <?php if(!empty($charttype) && $charttype == "line"){ ?> selected="selected"  <?php } ?> value="line">Line</option>
								<option <?php if(!empty($charttype) && $charttype == "column"){ ?> selected="selected"  <?php } ?> value="column">Column</option>
								<option <?php if(!empty($charttype) && $charttype == "bar"){ ?> selected="selected"  <?php } ?> value="bar">Bar</option>								

                            </select>
                        </div>	
                        
                        <div class="col-sm-1"><label for="Year">Year : &nbsp;</label></div>
                        <div class="col-sm-2">
                            <?php 
                               foreach ($row_cyear as $cy):                                
                            ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="CYEAR[]" checked value="<?php echo $cy->CYEAR;?>" id="CYEAR_<?php echo $cy->CYEAR;?>">
                                <label class="form-check-label" for="defaultCheck1">
                                  <?php echo $cy->CYEAR;?>
                                </label>
                            </div>
                            <?php
                               endforeach;
                             ?>                        
                        </div>
                        
                    				    
                        <div class="col-sm-1"><button id="submit_data" type="submit" class="btn btn-success">Submit</button></div>
                    </div>
                </form>
                
            </div>
        </div>
        <!--<div id="ReportBDloading"></div>-->
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="inner"></div>
            </div>
         </div>        
        <div id="ReportBDNew">
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
                        zoomEnabled: true,
                        credit: false,
                        title:{
                            text: "KPI Comparison"   ,
                            fontSize: 20, 
                            fontFamily: "tahoma",        
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
							labelFontSize: 12
                        },
                        toolTip: {
                            shared: true
                        },
                        data: [
                            <?php 
                            if(!empty($comparedata)){
                                $index = array_keys($comparedata[0]);
                                for ($i = 0; $i < count($comparedata); $i++) {
                                    $arrayvalue = array_values($comparedata[$i]);
                                   ?>
                                        {        
                                            type: "<?php echo $charttype; ?>",  
                                            name: "<?php echo $comparedata[$i]['Business'] . ' - ' . $comparedata[$i]['Metrics']; ?>",        
                                            showInLegend: true,
                                                dataPoints: [
                                                    <?php
                                                        for ($j = 5; $j < count($index) - 3; $j++) {
                                                    ?>
                                                        { label: "<?php echo $index[$j]; ?>" , y: <?php echo number_format($arrayvalue[$j],1, '.', ''); ?> },     
                                                    <?php } ?>
                                                ]
                                        } ,
                                   <?php 
                                }
                            }    
                            ?>
                            
                            ]
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
                <div style="width: 99%; height: 510px; border: 1px solid #CCC; margin-top: 50px; margin-bottom: 50px;" >
                    <div id="chartContainer" style="height: 500px; width: 100%;"></div>
                </div>
            </div>
            
            
            <?php if(!empty($comparedata)){ ?>
            <div class="col-md-12" >
                <div style="width: 99%; height: 510px; border: 1px solid #CCC; margin-top: 50px; margin-bottom: 50px;" class="table-responsive">
                    <table id="doctorbrandtable" class="table table-bordered table-hover  table-striped">
                        <thead>
                            <tr>
                                <?php
                                $index = array_keys($comparedata[0]);
                                $count = 0;
                                for($i = 0; $i < count($index); $i++){
                                    ?><th><?php echo str_replace(array('_'), array(' '), $index[$i]); ?></th><?php
                                }
                                ?>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <?php
                        for ($i = 0; $i < count($comparedata); $i++) {
                            $arrayvalue = array_values($comparedata[$i]);
                            ?>
                            <tr>
                                <?php                                        
                                for ($j = 0; $j < count($index); $j++) {
                                    $value = $arrayvalue[$j];
                                    //echo "<pre />"; print_r($arrayvalue); exit();
                                    ?>                                            
                                        <td <?php if (is_numeric($value)) { ?> class="text-right" <?php } ?>>
                                            <?php 
                                                if (is_numeric($value)) { 
                                                    echo number_format($value,1); 
                                                }else{ 
                                                    echo $value;                                                     
                                                } 
                                            ?>
                                        </td>
                                        
                                <?php                                 
                                } 
                                ?>
                                <td><button class="btn btn-primary" onclick="doLoadChart('<?php echo $arrayvalue['0']; ?>', '<?php echo str_replace("&","___", $arrayvalue['2']); ?>', '<?php echo str_replace("&","___", $arrayvalue['4']); ?>')">Details</button></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </table>
                </div>
            </div>    
            <?php } ?>
			<script src="<?php echo base_url(); ?>assets/js/canvasjs.min.js"></script>
            <!--<script src="<?php echo base_url(); ?>assets/canvasjs-2.3.2/canvasjs.min.js"></script>    -->
        </div>
    </div>
	

<!-- Modal  data-toggle="modal" data-target="#myModal" -->


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="min-height: 500px; width: 100%;">  
            <div id="ajaxload">

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
    function doLoadKPI(valuedrivencode){
        $("#KPIMetrics").empty();
        $.ajax({  
            type: "POST",  
            url: "<?php echo base_url(); ?>compare/loadkpi",  
            dataType: "json",
            data: "valuedrivencode=" + valuedrivencode,
            beforeSend: function() 
            {
                $("#KPIMetrics").empty();
            },  
            success: function(response)
            {
                //$("#KPIMetrics").empty();
                $("#KPIMetrics").append(new Option('', ''));
                for(i = 0; i < response.length; i++){
                    $("#KPIMetrics").append(new Option(response[i]['KPIMetricsName'], response[i]['KPIMetricsCode']));
                }
            }
        });
    }
    
    
    function doLoadChart(Business, ValueDriver, KPIMetrics){
        //alert('ss');
        var CYEAR =  "<?php echo $yearstring; ?>";
        var ChartType = '<?php echo $charttype; ?>';
        var dataString = "Business=" + Business + "&ValueDriver=" + ValueDriver + "&KPIMetrics=" + KPIMetrics + "&CYEAR=" + CYEAR+ "&ChartType=" + ChartType +"&action=report";
        //console.log(dataString);
        $.ajax({  
            type: "POST",  
            url: "<?php echo base_url(); ?>site/kpi_report_ajax_single",  
            data: dataString,
            beforeSend: function() 
            {
                $( "#ajaxload" ).html("");
            },  
            success: function(response)
             {
                $("#ajaxload").html(response);
                $('#myModal').modal('show');
             }
        });
            
    }
    
</script>

    
</body>
</html>