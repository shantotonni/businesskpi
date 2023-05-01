<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom">
		<i class="icon-home"></i> Home</a> <a href="<?php echo base_url('kpi/add');?>" class="current"><?php echo $page_title;?></a> </div>
        <h1><?php echo $page_title;?></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5><?php echo $page_title;?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <?php
                            $message = $this->session->userdata('message');
                            if (isset($message)) {
                                echo $message;
                                $this->session->unset_userdata('message');
                            }
							//echo '<pre/>';print_r($rows);exit();
                        ?>                    
                        <form action="<?php echo base_url('kpi/details_submit');?>" method="post" class="form-horizontal">                           
                            <div class="control-group">
                                <label class="control-label">Value DriverCode :</label>
                                <div class="controls">
                                    <select id='ValueDriverCode' name="ValueDriverCode" class="span6" required>
                                        <option value="">Select a ValueDriverCode</option>                                        
                                            <?php foreach ($ValueDriverCode_rows as $Bu):                                
                                            if (isset($row->ValueDriverCode) && $row->ValueDriverCode == $Bu->ValueDriverCode) {$selected = ' selected="selected"';}
                                            else {$selected = '';}
                                            echo '<option value="'.$Bu->ValueDriverCode.'"'.$selected.'>'.$Bu->ValueDriverName.'</option>';
                                            endforeach;?>
                                        <?php //echo isset($row->ValueDriverCode) ? select_option_selected('SBU', 'ValueDriverCode','SBUName',$row->ValueDriverCode) : select_option('SBU', 'ValueDriverCode','SBUName'); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Group KPI Metrics :</label>
                                <div class="controls">
                                    <?php //echo $row->KPIMetricsCode;print_r($KPIMetricsCode_rows);?>
                                    <select id='KPIMetricsCode' name="KPIMetricsCode" class="span6" required>
                                            <?php 
                                                if(isset($row->KPIMetricsCode)){
                                                    foreach ($KPIMetricsCode_rows as $Bu):                                
                                                    if (isset($row->KPIMetricsCode) && $row->KPIMetricsCode == $Bu->KPIMetricsCode) {$selected = ' selected="selected"';}
                                                    else {$selected = '';}
                                                    echo '<option value="'.$Bu->KPIMetricsCode.'"'.$selected.'>'.$Bu->KPIMetricsName.'</option>';
                                                    endforeach;
                                                    
                                                }
                                           ?>           
                                    </select>
                                </div>
                            </div>                            
                            <div class="control-group">
                                <label class="control-label">Business :</label>
                                <div class="controls">
                                    <?php //echo $row->Business;?>
                                    <select id='Business' name="Business" class="span6" required>
                                        <option value="">Select a Business</option>
                                        <!--<option value="Pharma" <?php //if(isset($row->Business) && $row->Business == 'Pharma'){echo "selected";}?>>Pharma</option> -->
                                            <?php 
                                            foreach ($Business_rows as $Bu):                                
                                            if (isset($row->Business) && $row->Business == $Bu->Business) {$selected = ' selected="selected"';}
                                            else {$selected = '';}
                                            echo '<option value="'.$Bu->Business.'"'.$selected.'>'.$Bu->Business.'</option>';
                                            endforeach;
                                            ?>
                                        <?php //echo isset($row->ValueDriverCode) ? select_option_selected('SBU', 'ValueDriverCode','SBUName',$row->ValueDriverCode) : select_option('SBU', 'ValueDriverCode','SBUName'); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">CYEAR :</label>
                                <div class="controls">
                                    <select id='CYEAR' name="CYEAR" class="span6" required>
                                        <option value="">Select a CYEAR</option>                                             
                                            <?php 
                                            for ($y=2018; $y <= date('Y'); $y++){   
                                                if(isset($row->CYEAR) && $row->CYEAR == $y) {$selected = ' selected="selected"';}
                                                else {$selected = '';}											
                                                echo '<option value="'.$y.'"'.$selected.'>'.$y.'</option>';
                                            }
                                            ?>
                                        <?php //echo isset($row->ValueDriverCode) ? select_option_selected('SBU', 'ValueDriverCode','SBUName',$row->ValueDriverCode) : select_option('SBU', 'ValueDriverCode','SBUName'); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">CPERIOD :</label>
                                <div class="controls">
                                    <?php //echo $row->CPERIOD;?>
                                    <select name="CPERIOD" id="CPERIOD" class="span6" required>
                                        <option value="">Select a CPERIOD</option>
                                        <option value="01" <?php if(isset($row->CPERIOD) && $row->CPERIOD == '01'){echo "selected";}?>>Jan</option>
                                        <option value="02" <?php if(isset($row->CPERIOD) && $row->CPERIOD == '02'){echo "selected";}?>>Feb</option>
                                        <option value="03" <?php if(isset($row->CPERIOD) && $row->CPERIOD == '03'){echo "selected";}?>>Mar</option>
                                        <option value="04" <?php if(isset($row->CPERIOD) && $row->CPERIOD == '04'){echo "selected";}?>>Apr</option>
                                        <option value="05" <?php if(isset($row->CPERIOD) && $row->CPERIOD == '05'){echo "selected";}?>>May</option>                                        
                                        <option value="06" <?php if(isset($row->CPERIOD) && $row->CPERIOD == '06'){echo "selected";}?>>Jun</option>
                                        <option value="07" <?php if(isset($row->CPERIOD) && $row->CPERIOD == '07'){echo "selected";}?>>Jul</option>
                                        <option value="08" <?php if(isset($row->CPERIOD) && $row->CPERIOD == '08'){echo "selected";}?>>Aug</option>
                                        <option value="09" <?php if(isset($row->CPERIOD) && $row->CPERIOD == '09'){echo "selected";}?>>Sep</option>
                                        <option value="10" <?php if(isset($row->CPERIOD) && $row->CPERIOD == '10'){echo "selected";}?>>Oct</option>
                                        <option value="11" <?php if(isset($row->CPERIOD) && $row->CPERIOD == '11'){echo "selected";}?>>Nov</option>
                                        <option value="12" <?php if(isset($row->CPERIOD) && $row->CPERIOD == '12'){echo "selected";}?>>Dec</option>
                                    </select>
                                </div>
                            </div>
                            
							
                            <div class="control-group">
                                <label class="control-label">A :</label>
                                <div class="controls">
                                    <input id="A" type="number" name="A" value="<?php echo isset($row->A) ? $row->A : '' ?>" class="span6" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">ATXT :</label>
                                <div class="controls">
                                    <input id="ATXT" type="text" name="ATXT" value="<?php echo isset($row->ATXT) ? $row->ATXT : '' ?>" class="span6" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">B :</label>
                                <div class="controls">
                                    <input id="B" type="number" name="B" value="<?php echo isset($row->B) ? $row->B : '' ?>" class="span6" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">BTXT :</label>
                                <div class="controls">
                                    <input id="BTXT" type="text" name="BTXT" value="<?php echo isset($row->BTXT) ? $row->BTXT : '' ?>" class="span6" />
                                </div>
                            </div>                            
                            <div class="control-group">
                                <label class="control-label">C :</label>
                                <div class="controls">
                                    <input id="C" type="number" name="C" value="<?php echo isset($row->C) ? $row->C : '' ?>" class="span6" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">CTXT :</label>
                                <div class="controls">
                                    <input id="CTXT" type="text" name="CTXT" value="<?php echo isset($row->CTXT) ? $row->CTXT : '' ?>" class="span6" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">D :</label>
                                <div class="controls">
                                    <input id="D" type="number" name="D" value="<?php echo isset($row->D) ? $row->D : '' ?>" class="span6" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">DTXT :</label>
                                <div class="controls">
                                    <input id="DTXT" type="text" name="DTXT" value="<?php echo isset($row->DTXT) ? $row->DTXT : '' ?>" class="span6"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">IndexValue :</label>
                                <div class="controls">
                                    <input id="IndexValue" type="number" name="IndexValue" value="<?php echo isset($row->IndexValue) ? $row->IndexValue : '' ?>" class="span6" />
                                </div>
                            </div>
                            
                           <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls text-left">
                                    <button type="submit" class="btn btn-success span3">Save</button>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls text-left">
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('#ValueDriverCode').change(function(){
	var ValueDriverCode = $(this).val();
	//alert(ValueDriverCode);return false;
	 $.ajax({
            url: '<?php echo base_url('kpi/getValueDriverCode')?>',
            type: 'POST',
            data: 'ValueDriverCode='+ ValueDriverCode,
            success: function(data){
                $('#KPIMetricsCode').html(data);
                }
        });
	
	//alert(businessId);
});
</script>
<script>
$('#CPERIOD').change(function(){
	var CPERIOD = $(this).val();
	var ValueDriverCode = $('#ValueDriverCode').val();
	var KPIMetricsCode = $('#KPIMetricsCode').val();
	var Business = $('#Business').val();
	var CYEAR = $('#CYEAR').val();
	var data_details = 'ValueDriverCode='+ ValueDriverCode + '&KPIMetricsCode='+ KPIMetricsCode+ '&Business='+ Business + '&CYEAR='+ CYEAR + '&CPERIOD='+ CPERIOD;
	console.log(data_details);
//	return false;
	 $.ajax({
            url: '<?php echo base_url('kpi/getCPERIOD')?>',
            type: 'POST',
            data: data_details,
            success: function(data){
				var obj = JSON.parse(data);
               // $('#KPIMetricsCode').html(data);
				if(jQuery.isEmptyObject(obj)){
				   console.log('There are no Data!!');
				   	$('#A').val('');
					$('#ATXT').val('');
					$('#B').val('');
					$('#BTXT').val('');
					$('#C').val('');
					$('#CTXT').val('');
					$('#D').val('');
					$('#DTXT').val('');
					$('#IndexValue').val('');
				}else{
					$('#A').val(obj['A']);
					$('#ATXT').val(obj['ATXT']);
					$('#B').val(obj['B']);
					$('#BTXT').val(obj['BTXT']);
					$('#C').val(obj['C']);
					$('#CTXT').val(obj['CTXT']);
					$('#D').val(obj['D']);
					$('#DTXT').val(obj['DTXT']);
					$('#IndexValue').val(obj['IndexValue']);
				}	
			}
        });
	
	//alert(businessId);
});
</script>
