<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom">
        <i class="icon-home"></i> Home</a> <a href="<?php echo base_url();?>kpi/update/<?php echo $ValueDriverCode;?>" class="current"><?php echo $page_title;?></a> </div>
        <h1><?php echo $page_title;?></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    
                    <?php	
                   
                            $message = $this->session->userdata('message');
                            if (isset($message) && !empty($message)) {
                                    echo '<div class="alert alert-success" align="center">';
                                    echo '<h5>'.$message.'</h5>';
                                    echo '</div>';
                                    $this->session->unset_userdata('message');
                            }
                            // echo '<pre/>';print_r($ValueDriverCode);//exit();
                    ?>
                    <div class="widget-title"> 
                        <span class="icon"> <i class="icon-align-justify"></i> </span>
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
                        <?php $row = $rows[0]; //echo '<pre/>';print_r($row);echo $row['ValueDriverCode'];exit();?>
                        <form action="<?php echo base_url('kpi/update_submit');?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Value Driver Code :</label>
                                <div class="controls">
                                    <input type="text" name="ValueDriverCode" value="<?php echo isset($row['ValueDriverCode']) ? $row['ValueDriverCode'] : '' ?>" class="span3" readonly="" />
                                </div>
                            </div>
							
                            <div class="control-group">
                                <label class="control-label">Value Driver Name :</label>
                                <div class="controls">
                                    <input type="text" name="ValueDriverName" value="<?php echo isset($row['ValueDriverName']) ? $row['ValueDriverName'] : '' ?>" class="span11" placeholder="Quiz title" />
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
                                            <?php //echo count($row['QuestionOption']);?>
                                            <?php for($i=0;$i<count($row['GroupKPIMetrics']);$i++){?>
                                            <tr id="rowToClone">
                                                <td>
                                                    <input id="KPIMetricsCode<?php echo $i;?>" type="text" class="KPIMetricsCode span2" name="KPIMetricsCode[]" value="<?php echo $row['GroupKPIMetrics'][$i]['KPIMetricsCode'];?>" readonly="">
                                                    <?php echo $input1 = '<input type="text" class="span10" name="KPIMetricsName[]" value="'.$row['GroupKPIMetrics'][$i]['KPIMetricsName'].'">'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input2 = '<input type="text" class="span10" name="CCalculation[]" value="'.$row['GroupKPIMetrics'][$i]['CCalculation'].'">'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input3 = '<input type="text" class="span10" name="DCalculation[]" id="DCalculation" value="'.$row['GroupKPIMetrics'][$i]['DCalculation'].'">'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input4 = '<input type="text" class="span10" name="IndexValueCalculation[]" id="IndexValueCalculation" value="'.$row['GroupKPIMetrics'][$i]['IndexValueCalculation'].'">'; ?>
                                                </td>
                                                <td>
                                                    <?php //echo $input5 = '<a onclick="deleterow(this)" class="btn btn-warning">Remove</a>'; ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
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


                                            cell1.innerHTML = '<input type="text" class="span12" name="KPIMetricsName[]" id="KPIMetricsName">';
                                            cell2.innerHTML = '<input type="text" class="span10" name="CCalculation[]" id="CCalculation">';
                                            cell3.innerHTML = '<input type="text" class="span10" name="DCalculation[]" id="DCalculation">';
                                            cell4.innerHTML = '<input type="text" class="span10" name="IndexValueCalculation[]" id="IndexValueCalculation">'; 
                                            cell5.innerHTML = '<a onclick="deleterow(this)" class="btn btn-warning">Remove</a>';
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
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div id="KPIMetricsCode_details"></div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('.KPIMetricsCode').click(function(){
	var KPIMetricsCode = $(this).val();
	console.log(KPIMetricsCode);//return false;
	 $.ajax({
		url: '<?php echo base_url('kpi/getKPIMetricsCode');?>',
		type: 'POST',
		data: 'KPIMetricsCode='+ KPIMetricsCode,
		success: function(data){
		    $('#KPIMetricsCode_details').html(data);
		}
	});
	
	//alert(businessId);
});
</script>