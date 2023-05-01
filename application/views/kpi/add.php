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
                        ?>                    
                        <form action="<?php echo base_url('kpi/submit');?>" method="post" class="form-horizontal">
                    
                            <!--<div class="control-group">
                                <label class="control-label">Value Driver Code :</label>
                                <div class="controls">
                                    <input type="text" name="ValueDriverCode" value="<?php //echo isset($row->ValueDriverCode) ? $row->ValueDriverCode : '' ?>" class="span11" placeholder="Exam Id" required />
                                </div>
                            </div>-->
                            
                            
                            <!--<div class="control-group">
                                <label class="control-label">Business Name :</label>
                                <div class="controls">
                                    <select id='SBUId' name="SBUId" required>
                                        <option value="">Select a Business</option>                                        
                                            <?php foreach ($business_rows as $Bu):                                
                                            if (isset($row->SBUId) && $row->SBUId == $Bu->BusinessId) {$selected = ' selected="selected"';}
                                            else {$selected = '';}
                                            echo '<option value="'.$Bu->BusinessId.'"'.$selected.'>'.$Bu->BusinessName.'</option>';
                                            endforeach;?>
                                        <?php //echo isset($row->SBUId) ? select_option_selected('SBU', 'SBUId','SBUName',$row->SBUId) : select_option('SBU', 'SBUId','SBUName'); ?>
                                    </select>
                                </div>
                            </div>-->
                           <!-- <div class="control-group">
                                <label class="control-label">KPI Segments :</label>
                                <div class="controls">
                                    <select id='KPISegmentsId' name="KPISegmentsId">
                                                      
                                    </select>
                                </div>
                            </div>
                            -->
							
                            <div class="control-group">
                                <label class="control-label">Value Driver Name :</label>
                                <div class="controls">
                                    <input id="inputValueDriverName" type="text" name="ValueDriverName" value="<?php echo isset($row->ValueDriverName) ? $row->ValueDriverName : '' ?>" class="span11" placeholder="Value Driver Name" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Status :</label>
                                <div class="controls">
                                    <select name="STATUS">
                                        <option value="Y" <?php if(isset($row->STATUS) && $row->Status == 'Y'){ echo 'selected';}?>>Active</option>
                                        <option value="N" <?php if(isset($row->STATUS) && $row->Status == 'N'){ echo 'selected';}?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Report Status :</label>
                                <div class="controls">
                                    <select name="ReportStatus">
                                        <option value="Y" <?php if(isset($row->ReportStatus) && $row->Status == 'Y'){ echo 'selected';}?>>Active</option>
                                        <option value="N" <?php if(isset($row->ReportStatus) && $row->Status == 'N'){ echo 'selected';}?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls">
                                    <a class="btn btn-primary" onclick="insertrow(this)">Add More</a>
                                    <table class="table table-bordered" id="tableinsert">
                                        <thead>
                                            <tr>
                                                <th>KPI Metrics Name</th><th>C Calculation</th>
                                                <th>D Calculation</th><th>Index Value Calculation</th>
                                                
                                                <th>Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablebody">
                                            <tr id="rowToClone">
                                                <td>
                                                    <?php echo $input1 = '<input type="text" class="span12" name="KPIMetricsName[]" id="KPIMetricsName" >'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input2 = '<input type="text" class="span10" name="CCalculation[]" id="CCalculation" value="">'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input3 = '<input type="text" class="span10" name="DCalculation[]" id="DCalculation" value="">'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input4 = '<input type="text" class="span10" name="IndexValueCalculation[]" id="IndexValueCalculation" value="">'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input5 = '<a onclick="deleterow(this)" class="btn btn-warning">Remove</a>'; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>																
                                    <script>
                                        $("input[name='Returnable']").click(function () {
                                                $('#show-me').css('display', ($(this).val() === 'Y') ? 'block':'none');
                                        });

                                        function insertrow(r){
                                            var table = document.getElementById("tableinsert");
                                            str = table.rows.length;
                                            var row = table.insertRow(); 

                                            var cell1 = row.insertCell(0);
                                            var cell2 = row.insertCell(1);
                                            var cell3 = row.insertCell(2);
                                            var cell4 = row.insertCell(3);
                                            var cell5 = row.insertCell(4);


                                            cell1.innerHTML = '<?php echo $input1; ?>';
                                            cell2.innerHTML = '<?php echo $input2; ?>'; 
                                            cell3.innerHTML = '<?php echo $input3; ?>';
                                            cell4.innerHTML = '<?php echo $input4; ?>';   
                                            cell5.innerHTML = '<?php echo $input5; ?>';
                                        }

                                        function deleterow(r){  
                                            var i = r.parentNode.parentNode.rowIndex;
                                            document.getElementById("tableinsert").deleteRow(i);
                                        }
                                    </script>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls text-center">
                                    <button type="submit" class="btn btn-success">Save</button>
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
$('#SBUId').change(function(){
	var businessId = $(this).val();
	//alert(businessId);return false;
	 $.ajax({
            url: '<?php echo base_url('kpi/getKPISegments')?>',
            type: 'POST',
            data: 'businessId='+ businessId,
            success: function(data){
                $('#KPISegmentsId').html(data);
                }
        });
	
	//alert(businessId);
});
</script>
<script>
$("#inputTitle" ).autocomplete("<?php echo base_url(); ?>kpi/get_title/", {
                    width: 350,
                    matchContains: true,
                    selectFirst: false,
                    
                });
       console.log($("#inputTitle").result(function (event, data, formatted) {}));         
     $("#inputTitle").result(function (event, data, formatted) {
                    $("#inputTitle").val(data[0]);
                });            
                
</script>