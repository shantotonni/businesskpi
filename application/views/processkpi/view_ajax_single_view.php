<link rel="stylesheet" href="<?php echo base_url(); ?>kpiprocess/assets/css/bootstrap.min.css" crossorigin="anonymous">
<script src="<?php echo base_url(); ?>kpiprocess/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>kpiprocess/assets/js/canvasjs.min.js"></script>  
<style>
    .canvasjs-chart-credit {
        display: none;
    }
    .modal-lg {
        max-width: 70% !important;
    }

</style>

<script>
//$(document).ready(function(){
window.onload = function () {
    <?php 
    function kpidatafilter($val){
        global $kpicode;
        global $componentcode;
        global $business;
        if($val['KPICode'] == $kpicode && $val['ComponentCode'] == $componentcode){
            return true;
        }
    }
    function datafilter($val){
        global $kpicode;
        global $componentcode;
        global $business;
        if($val['KPICode'] == $kpicode && $val['ComponentCode'] == $componentcode && $val['Business'] == $business){
            return true;
        }
    } 
    $dataarray = array();
    $pattern = '/[^A-Za-z0-9\. -#@]/';
    $chartcount = 0;
    if(!empty($businesslist)){
        foreach($businesslist as $buss){   
            if(!empty($kpi)){
                foreach($kpi as $row){
                    $data1 ='';
                    $componentcount = $row['ComponentCount'];
                    for($i = 0; $i < $componentcount; $i++){            
                        global $kpicode;
                        global $componentcode;
                        global $business;
                        $kpicode        = $row['KPICode'];
                        $componentcode  = $i + 1;                
                        $business       = $buss['Business'];
                        $kpidetailsfilter = array_values(array_filter($kpidetails, "kpidatafilter"));
                        //print_r($kpidetailsfilter); exit();
                        if(!empty($kpidetailsfilter)){
                            $axisyindex = $kpidetailsfilter[0]['AxisYIndex'];
                        }else{
                            $axisyindex = 0;
                        }                        
                        if($axisyindex == 1){
                            $axisyttype = 'axisYType: "secondary",';
                        }else{
                            $axisyttype = 'axisYType: "primary",';
                        }
                        //$axisyttype = '';
                        $datafilter = array_values(array_filter($kpidata, "datafilter"));
                        $string = '';
                        $count =0;                
                        if(!empty($datafilter)){
                            $type = $datafilter[0]['ChartType'];
                            $title = $datafilter[0]['Title'];
                            if($startfromzero == 'Y'){
                                $string = ' { x: 0,  y: 0, label: "" }, ';
                            }
                            foreach($datafilter as $data){
                                $count++;    
                                $string = $string  .  '{ x: '.$count.',  y: '.$data['Value'].', label: "'.$data['Period'].'" },' ;   
                            }
                            
                            $data1 .= '{
                                type: "'.$type.'", //change type to bar, line, area, pie, etc '.$componentcode.'
                                axisYIndex: "'.$axisyindex.'", //defaults to 0
                                '.$axisyttype.'
                                indexLabelFontColor: "#5A5757",
                                indexLabelFontSize: 16,
                                indexLabelPlacement: "outside",
                                showInLegend: true, 
                                legendText: "'.$title.'",
                                dataPoints: [
                                    '.$string.'
                                ]
                            },';
                            //array_push($dataarray, $datafilter);
                        }
                    }             
                    $chartcount++;  
                    //print_r($row); exit();
                    echo chart1BarChart("newchartContainer" . $row['ValueDriverCode'] . $row['KPICode'] . $buss['Business'],
                            $title = $buss['Business'] . ' - ' . preg_replace($pattern, '',$row['ValueDriver']),     
                            "",addslashes(trim(preg_replace('/\s\s+/', '',$row['Formula']))), $data1, $chartcount);
                   
                }
            }        
        }    
    }      
                ?>
//});
}
</script>

    <!--<div class="container-fluid">-->
        <!--<div class="row">-->
        <?php
        function filterkpi($val){
            global $valuedrivercode;
            if($val['ValueDriverCode'] == $valuedrivercode){
                return true;
            }
        }
        //print_r($businesslist); exit();
        if(!empty($businesslist)){
            foreach($businesslist as $buss){
                /*
                ?>
                <div class="row" style="display: none;">
                    <div class="col-md-12">
                        <div style="width: 100%; float: left; text-align: left; font-size:22px; background-color: green; color: #FFF; border: 1px solid #CCC; margin-top: 10px; margin-bottom: 10px; font-weight: bold;">
                            &nbsp;&nbsp;&nbsp;<?php echo $buss['Business']; ?>             
                        </div>
                    </div>
                </div>
                <?php
                */
                ?>
                <?php
                $dataarray = array_values($dataarray);
                if(!empty($valuedriver)){
                    foreach($valuedriver as $row1){
                ?>
                    
                    <?php
                        global $valuedrivercode;
                        $valuedrivercode = $row1['ValueDriverCode'];
                        $kpifilter = array_values(array_filter($kpi, "filterkpi"));
                        //echo "<pre />"; print_r($kpifilter); exit();
                    ?>
                    
                        <?php 
                        if(!empty($kpifilter)){ 
                            foreach($kpifilter as $row ){
                            ?>
                            <div class="col-md-12">                                
                                <div class="col-md-12">
                                    <div id="newchartContainer<?php echo $row['ValueDriverCode'] . $row['KPICode'] . $buss['Business']; ?>"  style="width: 100% !important; height: 370px;"></div>
                                </div>
                            </div>
                            
                            <div class="col-md-12" style="font-size: 13px;">
                                <?php echo "<b>" . $row['KPIName']      . "</b>"; ?> <br />
                                <?php echo "<b>Business</b> : "         . $buss['Business']; ?> <br />
                                <?php echo "<b>Description</b> : "      . $row['Description']; ?> <br />
                                <?php echo "<b>Formula</b> : "          . $row['Formula']; ?> <br />
                                <?php echo "<b>Source</b> : "           . $row['SOURCE']; ?> <br />
                            </div>
                            
                            <div class="col-md-6" style="float: left !important;">
                            <?php
                                if (!empty($kpipivotdata)) {
                                    $index = array_keys($kpipivotdata[0]);
                                    $count = 0;       
                                    //echo "<pre />"; print_r($kpipivotdata) ; exit();
                                    ?>    
                                    <div class="table-responsive">
                                        <table id="doctorbrandtable" class="table table-bordered table-hover  table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" colspan="<?php echo count($index); ?>">
                                                        Details Data
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    for($i = 1; $i < count($index); $i++){
                                                        ?><th class="text-center"><?php echo str_replace(array('No_','Per_month','_', 'Percentage'), array('# ','/ Month',' ', '%'), $index[$i]); ?></th><?php
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <?php
                                            for ($i = 0; $i < count($kpipivotdata); $i++) {
                                                $arrayvalue = array_values($kpipivotdata[$i]);
                                                ?>
                                                <tr>
                                                    
                                                    <?php
                                                    for ($j = 1; $j < count($index); $j++) {
                                                        $value = $arrayvalue[$j];
                                                        ?>  <td <?php if (is_numeric($value)) {?> class="text-right" <?php } ?>>
                                                                <?php if (is_numeric($value) && $j > 1) { echo number_format($value,1); }else{ echo $value; } ?>
                                                            </td><?php
                                                        ?>

                                                    <?php } ?>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                        </table>
                                    </div>
                                <?php 
                            }
                            ?>
                            </div>    
                        
                            <div class="col-md-6"  style="float: left !important;">
                            <?php
                                if (!empty($kpiconfiguration)) {
                                    $index = array_keys($kpiconfiguration[0]);
                                    $count = 0;       
                                    //echo "<pre />"; print_r($kpipivotdata) ; exit();
                                    ?>    
                                    <div class="table-responsive">
                                        <table id="doctorbrandtable" class="table table-bordered table-hover  table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" colspan="<?php echo count($index); ?>">
                                                        Configuration Data
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    for($i = 0; $i < count($index); $i++){
                                                        ?><th><?php echo str_replace(array('No_','Per_month','_'), array('# ','/ Month',' '), $index[$i]); ?></th><?php
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <?php
                                            for ($i = 0; $i < count($kpiconfiguration); $i++) {
                                                $arrayvalue = array_values($kpiconfiguration[$i]);
                                                ?>
                                                <tr>
                                                    
                                                    <?php
                                                    for ($j = 0; $j < count($index); $j++) {
                                                        $value = $arrayvalue[$j];
                                                        ?>  <td <?php if (is_numeric($value)) {?> class="text-right" <?php } ?>>
                                                                <?php if (is_numeric($value)) { echo number_format($value,0); }else{ echo $value; } ?>
                                                            </td><?php
                                                        ?>

                                                    <?php } ?>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                        </table>
                                    </div>
                                <?php 
                            }
                        ?>
                        </div> 
                                
                        <?php 
                            }
                        }
                    ?>
                <?php
                    }
                    
                } 
                
            } 
        }
        ?>
        <!--</div>    -->
    <!--</div>    -->


<?php
function chart1BarChart($chartid, $title = "", $subtitle, $subtitle2, $data1, $chartcount){
    $string = 'var chart'.$chartcount.' = new CanvasJS.Chart("'.$chartid.'", {
                zoomEnabled:true,
                animationEnabled: true,
                exportEnabled: false,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title:{
                    text: "'.$title.'",
                    fontSize: 14,
                    fontFamily: "tahoma",
                    horizontalAlign: "left",
                    verticalAlign: "center",
                },
                subtitles:[
                {
                    text: "'.$subtitle.' ",
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
                data: ['.$data1.']
            });
            chart'.$chartcount.'.render();';
            return $string;
}
?>

<style type="text/css">
    .canvasjs-chart-credit{ 
        display: none !important;
    }
</style>
