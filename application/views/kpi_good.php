<!DOCTYPE html>
<html lang="en">
    <head>
        <title>KPI goodbad Report</title>
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



        <?php //echo '<pre/>'; print_r($row_KPIMetrics);?>
        <?php //echo '<pre/>'; print_r($rows);?>
        <style>
            /* Hiding the checkbox, but allowing it to be focused */
            .badgebox
            {
                opacity: 0;
            }
            .badgebox + .badge
            {
                /* Move the check mark away when unchecked */
                text-indent: -999999px;
                /* Makes the badge's width stay the same checked and unchecked */
                width: 27px;
            }

            .badgebox:focus + .badge
            {
                /* Set something to make the badge looks focused */
                /* This really depends on the application, in my case it was: */

                /* Adding a light border */
                box-shadow: inset 0px 0px 5px;
                /* Taking the difference out of the padding */
            }

            .badgebox:checked + .badge
            {
                /* Move the check mark back when checked */
                text-indent: 0;
            }
        </style>
        <script>

            function doLoadChart(Business, ValueDriver, KPIMetrics){
                //alert('ss');
                var CYEAR =  $.map($('input[name="CYEAR"]:checked'), function(c){return c.value; });
                var ChartType = '<?php echo $charttype; ?>';
                var dataString = "Business=" + Business + "&ValueDriver=" + ValueDriver + "&KPIMetrics=" + KPIMetrics + "&CYEAR=" + CYEAR+ "&ChartType=" + ChartType +"&action=report";
                //console.log(dataString);
                $.ajax({  
                    type: "POST",  
                    url: "<?php echo base_url(); ?>goodbad/kpi_good_ajax_single",  
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
			
			function doLoadChartBad(Business, ValueDriver, KPIMetrics){
                //alert('ss');
                var CYEAR =  $.map($('input[name="CYEAR"]:checked'), function(c){return c.value; });
                var ChartType = '<?php echo $charttype; ?>';
                var dataString = "Business=" + Business + "&ValueDriver=" + ValueDriver + "&KPIMetrics=" + KPIMetrics + "&CYEAR=" + CYEAR+ "&ChartType=" + ChartType +"&action=report";
                //console.log(dataString);
                $.ajax({  
                    type: "POST",  
                    url: "<?php echo base_url(); ?>goodbad/kpi_bad_ajax_single",  
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

            $(document).ready(function(){

                $("#submit_data").click(function(){
                    var Business = jQuery("select#Business").val();
                    var charttype = jQuery("select#charttype").val();
                    var CYEAR =  $.map($('input[name="CYEAR"]:checked'), function(c){return c.value; });
                    var KPIMetrics = jQuery("select#KPIMetrics").val();
                    //console.log($('input[name="CYEAR"]:checked').serialize());
                    var dataString = "Business=" + Business + "&CYEAR=" + CYEAR + "&charttype=" + charttype + "&KPIMetrics=" + KPIMetrics +"&action=report";
                    //console.log(dataString);//alert(dataString);
                    $.ajax({  
                        type: "POST",  
                        url: "<?php echo base_url(); ?>goodbad/kpi_good_ajax",  
                        data: dataString,
                        beforeSend: function() 
                        {
                            $( ".inner" ).append( "<div id='ReportBDloading'></div>" );            
                            jQuery("#ReportBD").remove();           
                            jQuery("#ReportBDloading").html('<img src="<?php echo base_url(); ?>assets/img/Infinity.gif" align="absmiddle" width="80" height="50" alt="Loading..."> Loading...');
                        },  
                        success: function(response)
                        {
                            //console.log(response);
                            jQuery("#ReportBDloading").remove();
                            // jQuery("#ReportBD").hide();

                            jQuery("#ReportBDNew").html(response);
                        }
                    });
                    return false;
                });
                $("#submit_data_bad").click(function(){
                    var Business = jQuery("select#Business").val();
                    var charttype = jQuery("select#charttype").val();
                    var CYEAR =  $.map($('input[name="CYEAR"]:checked'), function(c){return c.value; });
                    var KPIMetrics = jQuery("select#KPIMetrics").val();
                    //console.log($('input[name="CYEAR"]:checked').serialize());
                    var dataString = "Business=" + Business + "&CYEAR=" + CYEAR + "&charttype=" + charttype + "&KPIMetrics=" + KPIMetrics +"&action=report";
                    //console.log(dataString);//alert(dataString);
                    $.ajax({  
                        type: "POST",  
                        url: "<?php echo base_url(); ?>goodbad/kpi_bad_ajax",  
                        data: dataString,
                        beforeSend: function() 
                        {
                            $( ".inner" ).append( "<div id='ReportBDloading'></div>" );            
                            jQuery("#ReportBD").remove();           
                            jQuery("#ReportBDloading").html('<img src="<?php echo base_url(); ?>assets/img/Infinity.gif" align="absmiddle" width="80" height="50" alt="Loading..."> Loading...');
                        },  
                        success: function(response)
                        {
                            //console.log(response);
                            jQuery("#ReportBDloading").remove();
                            // jQuery("#ReportBD").hide();

                            jQuery("#ReportBDNew").html(response);
                        }
                    });
                    return false;
                });
            });
        </script>    
    </head>
    <body>


        <div class="container-fluid">
            <div class="row">            
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <form class="form-inline" action="/action_page.php">
                                <label for="Business">Business : &nbsp;</label>
                                <?php //print_r($Business);?>
                                <select class="form-control" id="Business" name="Business"  style="width: 60%;">
                                    <option value="All">All</option>
                                    <?php foreach ($row_business as $Bu):                                
                                        if (isset($Business) && $Business == $Bu->Business) {$selected = ' selected="selected"';}
                                        else {$selected = '';}
                                        echo '<option value="'.$Bu->Business.'"'.$selected.'>'.$Bu->Business.'</option>';
                                        endforeach;
                                    ?>
                                </select>
                            </form>
                        </div>					
                        <div class="col-sm-2">
                            <form class="form-inline" action="/action_page.php">
                                <label for="Business">KPI : &nbsp;</label>
                                <?php //print_r($row_business);?>
                                <select class="form-control" id="KPIMetrics" name="KPIMetrics" style="width: 70%;">
                                    <option value=""></option>
                                    <?php 
                                    if(!empty($row_KPIMetricsdistinct)){ 
                                        foreach($row_KPIMetricsdistinct as $value){
                                            ?>
                                            <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                            <?php 
                                        } 
                                    }
                                    ?>                            
                                </select>
                            </form>
                        </div>						
                        <div class="col-sm-2" style="display:none">
                            <?php 
                            foreach ($row_cyear as $cy):                                
                                ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="CYEAR" checked value="<?php echo $cy->CYEAR;?>" id="CYEAR_<?php echo $cy->CYEAR;?>">
                                    <label class="form-check-label" for="defaultCheck1">
                                        <?php echo $cy->CYEAR;?>
                                    </label>
                                </div>
                                <?php
                                endforeach;
                            ?>                        
                        </div>					
                        <div class="col-sm-2">
                            <form class="form-inline" action="/action_page.php">
                                <label for="Business">Chart Type : &nbsp;</label>
                                <select class="form-control" id="charttype" name="charttype"  style="width: 50%;">
                                    <option value="line">Line</option>
                                    <option value="column">Column</option>
                                    <option value="bar">Bar</option>								
                                    <option value="pie">Pie</option>                                
                                </select>
                            </form>
                        </div>					
                        <div class="col-sm-1"><button id="submit_data" type="button" class="btn btn-success">Good</button></div>
                        <div class="col-sm-1">
                            <button id="submit_data_bad" type="button" class="btn btn-danger">Bad</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div id="ReportBDloading"></div>-->
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="inner"></div>
                </div>
            </div>        
            <div id="ReportBDNew"></div>
            <div id="ReportBD">
                <?php include('kpi_good_ajax_test.php');?>
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


    </body>
</html>