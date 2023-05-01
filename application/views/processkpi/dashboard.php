<!DOCTYPE HTML>
<html>
<head>
    <title>KPI Report</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>kpiprocess/assets/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="<?php echo base_url(); ?>kpiprocess/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.9.1.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <table class="table table-bordered table-hover  table-striped">
                        <tr>
                            <th class="bold">
                                Total KPI (Automated)
                            </th>
                            <td>
                                <?php echo $businesskpicount[0]['TotalKPICount']; ?>
                            </td>
                            <th class="bold">
                                Total Business Wise KPI (Automated)
                            </th>
                            <td>
                                <?php echo $businesskpicount[0]['TotalBusinessKPICount'] + $businesskpicount[0]['District_Wise_KPI']; ?>
                            </td>

                            <!-- <th class="bold">
									<a href="<?php echo base_url(); ?>processkpi/districtkpi">
										District wise sales dispersion
									</a>
								</th> -->

                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-1"><label for="Business">Business : &nbsp;</label></div>
                <div class="col-sm-1">
                    <select class="form-control" id="business" name="business">
                        <option value="">All</option>
                        <?php
                        $count = 0;
                        foreach ($allbusiness as $Bu):
                            $count++;
                            if($count == 1){
                                $selected = ' selected ';
                                $businessname = $Bu['Business'];
                            }else{
                                $selected = ' ';
                            }
                            echo '<option '.$selected.' value="'.$Bu['Business'].'">'.$Bu['Business'].'</option>';
                        endforeach;
                        ?>
                    </select>
                </div>

                <div class="col-md-1"><label for="Business">Value Driver : &nbsp;</label></div>
                <div class="col-sm-2">
                    <?php //print_r($row_business);?>
                    <select class="form-control" id="valuedriver" name="valuedriver" style="width: 70%;">
                        <option value=""></option>
                        <?php
                        if(!empty($allvaluedriver)){
                            foreach($allvaluedriver as $value){
                                ?><option value="<?php echo $value['ValueDriverCode']; ?>"><?php echo $value['ValueDriver']; ?></option><?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-1"><label for="Business">KPI : &nbsp;</label></div>
                <div class="col-sm-2">
                    <select class="form-control" id="kpicode" name="kpicode" style="width: 70%;">
                        <option value=""></option>
                        <?php
                        if(!empty($allkpi)){
                            foreach($allkpi as $value){
                                ?><option value="<?php echo $value['KPICode']; ?>"><?php echo $value['KPIName']; ?></option><?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    Years :
                    <?php
                    if(!empty($allyears)){
                        foreach ($allyears as $cy):
                            ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="CYEAR" checked value="<?php echo $cy['Years'];?>" id="CYEAR_<?php echo $cy['Years'];?>">
                                <label class="form-check-label" for="defaultCheck1">
                                    <?php echo $cy['Years'];?>
                                </label>
                            </div>
                        <?php
                        endforeach;
                    }
                    ?>
                </div>
                <div class="col-sm-1">
                    Start From Zero
                    <br />
                    <input type="radio" name="startfromzero" value="Y"> Yes
                    <input type="radio" name="startfromzero" value="N" checked="checked"> No
                </div>
                <div class="col-sm-1"><button id="submit_data" type="button" class="btn btn-success">Submit</button></div>
                <!-- <div class="col-sm-2"><button id="submit_anomaly" type="button" class="btn btn-success">Rule Based Anomaly (<?php echo $businesskpicount[0]['TotalBusinessAnomoliesKPICount']; ?>)</button></div>
					<div class="col-sm-2"><button id="submit_anomaly_ai" type="button" class="btn btn-success">AI Based Anomaly (<?php echo $businesskpicount[0]['TotalBusinessAnomoliesKPICount_AI']; ?>)</button></div> -->

            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div id="reportLoading"></div>

</div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        var startfromzero = $('input[name=startfromzero]:checked').val();
        var business    = $("#business").val('<?php echo $businessname; ?>');
        var valuedriver = "";
        var kpicode     = "";
        var business    = "<?php echo $businessname; ?>";
        var years       = "";
        var dataString = "valuedriver=" + valuedriver + "&kpicode=" + kpicode + "&business=" + business + "&years=" + years + "&startfromzero=" + startfromzero +"&type=normal&action=report";
        ajaxfunction(dataString);
        //return false;
    }); 
    $("#submit_data").click(function(){
        var array = "";
        var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')

        for (var i = 0; i < checkboxes.length; i++) {
          array = array + ',' + checkboxes[i].value;
        }
        var years = array.substring(1);
        //console.log(array); 
        var startfromzero = $('input[name=startfromzero]:checked').val();
        var valuedriver = $("#valuedriver").val();
        var kpicode     = $("#kpicode").val();
        var business    = $("#business").val();
        //var years       = ""; $.map($('input[name="CYEAR"]:checked'), function(c){return c.value; }); //$("#years").val();
        console.log($.map($('input[name="CYEAR"]:checked'), function(c){return c.value; }));
        var dataString = "valuedriver=" + valuedriver + "&kpicode=" + kpicode + "&business=" + business + "&years=" + years + "&startfromzero=" + startfromzero +"&type=normal&action=report";
        ajaxfunction(dataString);
    })
    $("#submit_anomaly").click(function(){
        var array = "";
        var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')

        for (var i = 0; i < checkboxes.length; i++) {
          array = array + ',' + checkboxes[i].value;
        }
        var years = array.substring(1);
        //console.log(array); 
        var startfromzero = $('input[name=startfromzero]:checked').val();
        var valuedriver = $("#valuedriver").val();
        var kpicode     = $("#kpicode").val();
        var business    = $("#business").val();
        //var years       = ""; $.map($('input[name="CYEAR"]:checked'), function(c){return c.value; }); //$("#years").val();
        console.log($.map($('input[name="CYEAR"]:checked'), function(c){return c.value; }));
        var dataString = "valuedriver=" + valuedriver + "&kpicode=" + kpicode + "&business=" + business + "&years=" + years + "&startfromzero=" + startfromzero +"&type=anomaly&action=report";
        ajaxfunction(dataString);
    })
	
	$("#submit_anomaly_ai").click(function(){
        var array = "";
        var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')

        for (var i = 0; i < checkboxes.length; i++) {
          array = array + ',' + checkboxes[i].value;
        }
        var years = array.substring(1);
        console.log(years); 
        var startfromzero = $('input[name=startfromzero]:checked').val();
        var valuedriver = $("#valuedriver").val();
        var kpicode     = $("#kpicode").val();
        var business    = $("#business").val();
        //var years       = ""; $.map($('input[name="CYEAR"]:checked'), function(c){return c.value; }); //$("#years").val();
        console.log($.map($('input[name="CYEAR"]:checked'), function(c){return c.value; }));
        var dataString = "valuedriver=" + valuedriver + "&kpicode=" + kpicode + "&business=" + business + "&years=" + years + "&startfromzero=" + startfromzero +"&type=anomaly_ai&action=report";
        ajaxfunction(dataString);
    })
    function ajaxfunction(dataString){
        $.ajax({  
            type: "POST",  
            url: "<?php echo base_url(); ?>processkpi/loadreport_ajax",  
            data: dataString,
            beforeSend: function(){
                $("#reportLoading").html('Loading....');
            },  
            success: function(response){
                console.log(response)
                //$("#reportLoading").hide();
                $("#reportLoading").html(response);
            }
        });
    }
</script>

<style type="text/css">
.table td, .table th{
    padding: 5px;
    font-size: 12px;
}
</style>