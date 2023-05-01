<style>
    .canvasjs-chart-credit {
        display: none;
    }
    .modal-lg {
        max-width: 70% !important;
    }
</style>
<script src="<?php echo base_url(); ?>kpiprocess/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>kpiprocess/assets/js/canvasjs.min.js"></script>  
<script>
$(document).ready(function(){
//window.onload = function () {
    <?php 
    function kpidatafilter($val){
        global $kpicode;
        global $componentcode;
        global $business;
        //echo '"'. $componentcode . '"';
        if(empty($componentcode))   { $componentcode = 1; }
        //print_r($kpicode); print_r($componentcode); print_r($val); exit();
        if($val['KPICode'] == $kpicode ){
            //&& $val['ComponentCode'] == $componentcode
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
    $divstring = '';
    $pattern = '/[^A-Za-z0-9\. -#@]/';
    $chartcount = 0;
    if(!empty($businesslist)){
        foreach($businesslist as $buss){   
            if(!empty($kpi)){
//print_r($kpi)                ; exit();
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
                            if($axisyindex == 1){
                                $axisyttype = 'axisYType: "secondary",';
                            }else{
                                $axisyttype = 'axisYType: "primary",';
                            }
                        //$axisyttype = '';
                            $datafilter = array_values(array_filter($kpidata, "datafilter"));
                            //print_r($datafilter); exit();
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
                                    $color = '';
                                    //print_r($data); //exit();
                                    if($data['IndexType'] == 'Anomolies'){
                                        $color = ' , color: "red" ';
                                    }else{
                                        $color = '';
                                    }
                                    //$color = ' , color: "yellow" ';
                                    $string = $string  .  '{ x: '.$count.',  y: '.$data['xIndex'].', label: "'.$data['Period'] .'"  '.$color.' },' ;   
                                }
                                
                                $data1 .= '{
                                    type: "line", //change type to bar, line, area, pie, etc '.$componentcode.'
                                    axisYIndex: "'.$axisyindex.'", //defaults to 0
                                    '.$axisyttype.'
                                    indexLabelFontColor: "#5A5757",
                                    indexLabelFontSize: 16,
                                    indexLabelPlacement: "outside",
                                    showInLegend: true, 
                                    legendText: "'.$title.'",
                                    dataPoints: [
                                        '.substr($string,0,-1).'
                                    ]
                                },';
                            }
                        }                        
                    }             
                    $chartid = array();
                    if(!empty($datafilter)){
                         $chartcount++;  
                        $divstring .= '
                            <div class="col-md-4">
                                <div style="text-align: left; font-size:16px; background-color: #ccff90; color: #000; border: 1px solid #CCC; margin-top: 10px; margin-bottom: 10px; display: none;" class="col-md-12" style="">
                                    &nbsp;&nbsp;&nbsp; '.$row['ValueDriver'].'
                                </div>
                                
                                <div  onclick="doLoadChartDetails(\''.$row['KPICode'].'\', \''.$buss['Business'].'\')" 
                                    style="cursor: pointer; width: 100%; font-size:16px; background-color: #ffffc2; color: #444;  margin-top: 10px; margin-bottom: 10px; padding: 5px; ">
                                    <div style="width: 100%;">                            
                                        <div style="width: 100%; text-align: left;">
                                            '.$row['KPIName'].'&nbsp;<i class="fa fa-plus" style="font-size:16px; color:#888;"></i>
                                        </div>
                                    </div>                            
                                </div>
                                <div id="chartContainer'.$row['ValueDriverCode'] . $row['KPICode'] . $buss['Business'].'"  class="col-md-12" style="height: 370px; width: 100%;">
                                </div>
                            </div>
                        ';
                    
                    echo chart1BarChart("chartContainer" . $row['ValueDriverCode'] . $row['KPICode'] . $buss['Business'],
                            $title = $buss['Business'] . ' - ' . preg_replace($pattern, '',$row['ValueDriver']),     
                            "",addslashes(trim(preg_replace('/\s\s+/', '',$row['Formula']))), substr($data1,0,-1), $chartcount);
                    }
                }
            }        
        }    
    }      
                ?>
});
//}
</script>
  
    
    <div class="container-fluid">
        <div class="row">
            <?php
            echo $divstring;            
            ?>
        </div>      
        <div class="row">
            <div class="col-md-3">
                <?php
                    if (!empty($kpicount)) {
                        $index = array_keys($kpicount[0]);
                        $count = 0;       
                        //echo "<pre />"; print_r($kpipivotdata) ; exit();
                        ?>    
                        <div class="table-responsive">
                            <table id="doctorbrandtable" class="table table-bordered table-hover  table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="<?php echo count($index); ?>">
                                            KPI Count
                                        </th>
                                    </tr>
                                    <tr>
                                        <?php
                                        for($i = 0; $i < count($index); $i++){
                                            ?><th class="text-center"><?php echo str_replace(array('No_','Per_month','_', 'Percentage'), array('# ','/ Month',' ', '%'), $index[$i]); ?></th><?php
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <?php
                                for ($i = 0; $i < count($kpicount); $i++) {
                                    $arrayvalue = array_values($kpicount[$i]);
                                    ?>
                                    <tr>
                                        
                                        <?php
                                        for ($j = 0; $j < count($index); $j++) {
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
        </div>  

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="singlechartloaddiv">
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>    


<?php
function chart1BarChart($chartid, $title = "", $subtitle, $subtitle2, $data1, $chartcount){
    /*
    subtitles:[
    {
        text: "'.$subtitle.' ",
        fontSize: 15,
        fontFamily: "tahoma",
    },{
        text: "'.$subtitle2.' ",
        fontSize: 15,
        fontFamily: "tahoma",
    }],
    */
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
<script type="text/javascript">
function doLoadChartDetails(kpicode, business){
    //$('#myModal').modal('show');
    $('#exampleModal').modal('show');
    var startfromzero = $('input[name=startfromzero]:checked').val();
    var array = "";
    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')

    for (var i = 0; i < checkboxes.length; i++) {
      array = array + ',' + checkboxes[i].value;
    }
    var years = array.substring(1);
    var dataString = "&kpicode=" + kpicode + "&business=" + business + "&years=" + years + "&startfromzero=" + startfromzero +"&action=report";
    
    $.ajax({  
        type: "POST",  
        url: "<?php echo base_url(); ?>processkpi/loadreport_ajax_single",  
        data: dataString,
        beforeSend: function(){
            $("#singlechartloaddiv").html('Loading....');
        },  
        success: function(response){       
            $("#singlechartloaddiv").html(response);            
        }
    });
    
        
}
</script>
<script type="text/javascript">
    //alert("adf");
    //$('#myModal').modal('show');
</script>
