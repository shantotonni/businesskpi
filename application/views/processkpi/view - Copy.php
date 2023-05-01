<!DOCTYPE HTML>
<html>
<head>
<title>KPI Report</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>kpiprocess/assets/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="<?php echo base_url(); ?>kpiprocess/assets/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
window.onload = function () {
    <?php 
    

    function datafilter($val){
        global $kpicode;
        global $componentcode;
        if($val['KPICode'] == $kpicode && $val['ComponentCode'] == $componentcode){
            return true;
        }
    }            
    if(!empty($kpi)){
        foreach($kpi as $row){
            global $kpicode;
            global $componentcode;
            $kpicode        = $row['KPICode'];
            $componentcode  = 1;                
            $datafilter = array_values(array_filter($kpidata, "datafilter"));
            $string = '';
            $count =0;
            $data1 ='';
            if(!empty($datafilter)){
                $type = $datafilter[0]['ChartType'];
                $title = $datafilter[0]['Title'];
                foreach($datafilter as $data){
                    $count++;    
                    $string = $string  .  '{ x: '.$count.',  y: '.$data['Value'].', label: "'.$data['Period'].'" },' ;   
                }
                $data1 = '{
                    type: "'.$type.'", //change type to bar, line, area, pie, etc
                    indexLabelFontColor: "#5A5757",
                    indexLabelFontSize: 16,
                    indexLabelPlacement: "outside",
                    showInLegend: true, 
                    legendText: "'.$title.'",
                    dataPoints: [
                        '.$string.'
                    ]
                }';
            }
            
            $kpicode        = $row['KPICode'];
            $componentcode  = 2;                
            $datafilter = array_values(array_filter($kpidata, "datafilter"));
            $string = '';
            $count =0;
            $data2 ='';
            if(!empty($datafilter)){
                 
                $type = $datafilter[0]['ChartType'];
                $title = $datafilter[0]['Title'];
                foreach($datafilter as $data){
                    $count++;    
                    $string = $string  .  '{ x: '.$count.',  y: '.$data['Value'].', label: "'.$data['Period'].'" },' ;   
                }
                $data2 = '{
                    type: "'.$type.'", //change type to bar, line, area, pie, etc
                    indexLabelFontColor: "#5A5757",
                    indexLabelFontSize: 16,
                    indexLabelPlacement: "outside",
                    showInLegend: true, 
                    legendText: "'.$title.'",
                    dataPoints: [
                        '.$string.'
                    ]
                }';
            }
            
            
            $kpicode        = $row['KPICode'];
            $componentcode  = 3;                
            $datafilter = array_values(array_filter($kpidata, "datafilter"));
            $string = '';
            $count =0;
            $data3 ='';
            if(!empty($datafilter)){                 
                $type = $datafilter[0]['ChartType'];
                $title = $datafilter[0]['Title'];
                foreach($datafilter as $data){
                    $count++;    
                    $string = $string  .  '{ x: '.$count.',  y: '.$data['Value'].', label: "'.$data['Period'].'" },' ;   
                }
                $data3 = '{
                    type: "'.$type.'", //change type to bar, line, area, pie, etc
                    indexLabelFontColor: "#5A5757",
                    indexLabelFontSize: 16,
                    indexLabelPlacement: "outside",
                    showInLegend: true, 
                    legendText: "'.$title.'",
                    dataPoints: [
                        '.$string.'
                    ]
                }';
            }
            
            $kpicode        = $row['KPICode'];
            $componentcode  = 4;                
            $datafilter = array_values(array_filter($kpidata, "datafilter"));
            $string = '';
            $count =0;
            $data4 ='';
            if(!empty($datafilter)){                 
                $type = $datafilter[0]['ChartType'];
                $title = $datafilter[0]['Title'];
                foreach($datafilter as $data){
                    $count++;    
                    $string = $string  .  '{ x: '.$count.',  y: '.$data['Value'].', label: "'.$data['Period'].'" },' ;   
                }
                $data4 = '{
                    type: "'.$type.'", //change type to bar, line, area, pie, etc
                    indexLabelFontColor: "#5A5757",
                    indexLabelFontSize: 16,
                    indexLabelPlacement: "outside",
                    showInLegend: true, 
                    legendText: "'.$title.'",
                    dataPoints: [
                        '.$string.'
                    ]
                }';
            }
               
            //echo "adsf<pre />"; print_r($data2); exit();     
            if($row['ChartType'] == 1){                
                echo chart1BarChart("chartContainer" . $row['ValueDriverCode'] . $row['KPICode'],
                    $title = $row['KPIName'],     
                    $row['Description'],
                    $row['Formula'], $data1);
            }else if($row['ChartType'] == 2){                
                echo chart2BarLineChart("chartContainer" . $row['ValueDriverCode'] . $row['KPICode'],
                    $title = $row['KPIName'],     
                    $row['Description'],
                    $row['Formula'], $data1, $data2);
            }else if($row['ChartType'] == 3){
                echo chart3LineChart("chartContainer" . $row['ValueDriverCode'] . $row['KPICode'],
                    $title = $row['KPIName'],     
                    $row['Description'],
                    $row['Formula'], $data1);
            }else if($row['ChartType'] == 4){
               echo chart4ComboChart("chartContainer" . $row['ValueDriverCode'] . $row['KPICode'],
                    $title = $row['KPIName'],     
                    $row['Description'],
                    $row['Formula'], $data1, $data2, '', $data3);
            }else if($row['ChartType'] == 5){
                /*
                echo chart5ComboChart("chartContainer" . $row['ValueDriverCode'] . $row['KPICode'],
                    $title = $row['KPIName'],     
                    $row['Description'],
                    $row['Formula'], $data1, $data2, $data3, $data4); */
            }else if($row['ChartType'] == 6){
                echo chart6ComboChart("chartContainer" . $row['ValueDriverCode'] . $row['KPICode'],
                    $title = $row['KPIName'],     
                    $row['Description'],
                    $row['Formula'], $data1, $data2, $data3, $data4);
            }
        }
    }        
    
          /*      
    echo chart2BarLineChart("chartContainer2",
                $title = "Purchase Rate Variance",     
                "Shows purchasing value changes over the period ",
                "'=Ʃ{(Actual price – Last price) x Quantity purchased}", $data1, $data2);
    echo chart3LineChart("chartContainer3",
                $title = "Purchase Rate Variance",     
                "Shows purchasing value changes over the period ",
                "'=Ʃ{(Actual price – Last price) x Quantity purchased}", $data2);
    echo chart4ComboChart("chartContainer4",
                $title = "Purchase Rate Variance",     
                "Shows purchasing value changes over the period ",
                "'=Ʃ{(Actual price – Last price) x Quantity purchased}", $data1, $data2stack, '', $data2);
 
    echo chart5ComboChart("chartContainer5",
                $title = "Purchase Rate Variance",     
                "Shows purchasing value changes over the period ",
                "'=Ʃ{(Actual price – Last price) x Quantity purchased}", $data1, $data2stack, $data2stack, $data2);
    
    echo chart6ComboChart("chartContainer6",
                $title = "Purchase Rate Variance",     
                "Shows purchasing value changes over the period ",
                "'=Ʃ{(Actual price – Last price) x Quantity purchased}", $data1, $data2stack, '', '');     */
                ?>
}
</script>
</head>
<body>
    <div class="container-fluid">
        <?php
        function filterkpi($val){
            global $valuedrivercode;
            if($val['ValueDriverCode'] == $valuedrivercode){
                return true;
            }
        }
        //echo "<pre />"; print_r($valuedriver); exit();
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
                        <div  style="cursor:grab; width: 100%; font-size:16px; background-color: #ffffc2; color: #444;  margin-top: 10px; margin-bottom: 10px; ">
                            <div style="width: 100%;">                            
                                <div style="width: 100%; text-align: left;">
                                    <?php echo $row['KPIName']; ?>&nbsp;<i class="fa fa-plus" style="font-size:16px; color:#888;"></i>
                                </div>
                            </div>                            
                        </div>
                        <div id="chartContainer<?php echo $row['ValueDriverCode'] . $row['KPICode']; ?>" style="height: 370px; width: 100%;"></div>
                    </div>
                <?php }
                }
                ?>
 
            </div>
        <?php
            }
        }
        ?>
    </div>    



<script src="<?php echo base_url(); ?>kpiprocess/assets/js/canvasjs.min.js"></script>
</body>
</html>

<?php

function chart1BarChart($chartid, $title = "", $subtitle, $subtitle2, $data1){
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

function chart2BarLineChart($chartid, $title = "", $subtitle, $subtitle2, $data1, $data2){
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
                data: ['.$data1.', '.$data2.']
            });
            chart.render();';
            return $string;
}

function chart3LineChart($chartid, $title = "", $subtitle, $subtitle2, $data1){
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

function chart4ComboChart($chartid, $title = "", $subtitle, $subtitle2, $data1, $data2stack, $data3stack, $data2){
    if(!empty($data3stack)){
        $string = $data1.','.$data2stack.','.$data3stack.','.$data2;
    }else{
        $string = $data1.','.$data2stack.','.$data2;
    }
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
                data: ['.$string.']
            });
            chart.render();';
            return $string;
}

function chart5ComboChart($chartid, $title = "", $subtitle, $subtitle2, $data1, $data2stack, $data3stack, $data2){
    if(!empty($data3stack)){
        $string = $data1.','.$data2stack.','.$data3stack.','.$data2;
    }else{
        $string = $data1.','.$data2stack.','.$data2;
    }
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
                data: ['.$string.']
            });
            chart.render();';
            return $string;
}

function chart6ComboChart($chartid, $title = "", $subtitle, $subtitle2, $data1, $data2stack, $data3stack, $data2){
    if(!empty($data3stack)){
        $string = $data1.','.$data2stack.','.$data3stack.','.$data2;
    }else{
        $string = $data1.','.$data2stack.','.$data2;
    }
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
                data: ['.$string.']
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