
<script src="<?php echo base_url(); ?>kpiprocess/assets/js/canvasjs.min.js"></script>
<script type="text/javascript">

function doLoadChart(chartid, title, subtitle, subtitle2, data){
    var chart = new CanvasJS.Chart(chartid, {
        zoomEnabled:true,
        animationEnabled: true,
        exportEnabled: true,
        theme: "light1", // "light1", "light2", "dark1", "dark2"
        title:{
            text: title,
            fontSize: 20,
            fontFamily: "tahoma",
        },
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
        subtitles:[
        {
            text: subtitle,
            fontSize: 15,
            fontFamily: "tahoma",
        },{
            text: subtitle2,
            fontSize: 15,
            fontFamily: "tahoma",
        }],
        axisY: {
          includeZero: true
        },
        data: [data]
    });
    chart.render();
}

</script>
<script>
$(document).ready(function(){
//window.onload = function () {
    <?php 
    function datafilter($val){
        global $kpicode;
        global $componentcode;
        global $business;
        if($val['KPICode'] == $kpicode && $val['ComponentCode'] == $componentcode && $val['Business'] == $business){
            return true;
        }
    } 
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
                       
                        $datafilter = array_values(array_filter($kpidata, "datafilter"));
                        $string = '';
                        $count =0;                
                        if(!empty($datafilter)){
                            $type = $datafilter[0]['ChartType'];
                            $title = $datafilter[0]['Title'];
                            $arraydata = array();
                            foreach($datafilter as $data){
                                $count++;    
                                $string = " { x: 0,  y: '0', label: '' }, ";
                                $string = $string  .  '{ x: '.$count.',  y: '.$data['Value'].', label: "'.$data['Period'].'" },' ;   
                                $arraydata[] = [
                                    "x" => $count,
                                    "y" => $data['Value'],
                                    "z" => $data['Period']
                                ];    
                            }
                            $data1 .= '{ type: "'.$type.'", indexLabelFontColor: "#5A5757", indexLabelFontSize: 16, indexLabelPlacement: "outside", showInLegend: true,  legendText: "'.$title.'", dataPoints: [ '.json_encode($arraydata).' ] },';
                            $pattern = '/[^A-Za-z0-9\. -#@]/';
                            ?> doLoadChart("chartContainer<?php echo $row['ValueDriverCode'] . $row['KPICode'] . $buss['Business']; ?>", "<?php echo preg_replace($pattern, '', $row['KPIName']); ?>", "<?php echo preg_replace($pattern, '',$row['Description']); ?>", "<?php echo preg_replace($pattern, '',$row['Formula']); ?>", "<?php echo addslashes($data1); ?>"); 
                            <?php
                        }
                    }               
                    //echo chart1BarChart("chartContainer" . $row['ValueDriverCode'] . $row['KPICode'] . $buss['Business'],
                      //      $title = $row['KPIName'],     
                      //      $row['Description'],
                      //      $row['Formula'], $data1);
                   //
                }
            }        
        }    
    }      
                ?>
});
</script>

    <div class="container-fluid">
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
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div style="width: 100%; float: left; text-align: left; font-size:22px; background-color: green; color: #FFF; border: 1px solid #CCC; margin-top: 10px; margin-bottom: 10px; font-weight: bold;">
                            &nbsp;&nbsp;&nbsp;<?php echo $buss['Business']; ?>             
                        </div>
                    </div>
                </div>
                <?php
                if(!empty($valuedriver)){
                    foreach($valuedriver as $row){
                ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="width: 100%; float: left; text-align: left; font-size:16px; background-color: #ccff90; color: #000; border: 1px solid #CCC; margin-top: 10px; margin-bottom: 10px;">
                                &nbsp;&nbsp;&nbsp;<?php echo $row['ValueDriver']; ?>             
                            </div>
                        </div>
                    </div>
                    <?php
                        global $valuedrivercode;
                        $valuedrivercode = $row['ValueDriverCode'];
                        $kpifilter = array_values(array_filter($kpi, "filterkpi"));
                        //echo "<pre />"; print_r($kpifilter); exit();
                    ?>
                    <div class="row">
                        <?php 
                        if(!empty($kpifilter)){ 
                            foreach($kpifilter as $row ){
                            ?>
                            <div class="col-md-4">
                                <div style="display: none;"  style="cursor:grab; width: 100%; font-size:16px; background-color: #ffffc2; color: #444;  margin-top: 10px; margin-bottom: 10px; ">
                                    <div style="width: 100%;">                            
                                        <div style="width: 100%; text-align: left;">
                                            <?php echo $row['KPIName']; ?>&nbsp;<i class="fa fa-plus" style="font-size:16px; color:#888;"></i>
                                        </div>
                                    </div>                            
                                </div>
                                <div id="chartContainer<?php echo $row['ValueDriverCode'] . $row['KPICode'] . $buss['Business']; ?>" style="height: 370px; width: 100%;"></div>
                            </div>
                        <?php }
                        }
                        ?>
         
                    </div>
                <?php
                    }
                }
            }
        }
        ?>
    </div>    


<?php
function chart1BarChart($chartid, $title = "", $subtitle, $subtitle2, $data){
    $string = 'var chart = new CanvasJS.Chart("'.$chartid.'", {
                zoomEnabled:true,
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title:{
                    text: "'.$title.'",
                    fontSize: 20,
                    fontFamily: "tahoma",
                },
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
                axisY: {
                  includeZero: true
                },
                data: ['.$data1.']
            });
            chart.render();';
            return $string;
}


?>


<style type="text/css">
    .canvasjs-chart-credit{ 
        display: none !important;
    }
</style>