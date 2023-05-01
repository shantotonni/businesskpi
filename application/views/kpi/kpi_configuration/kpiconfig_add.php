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
                        <form action="<?php echo base_url('kpi/kpiconfigAdd');?>" method="post" class="form-horizontal">                           
                           
                            
                            <div class="control-group">
                                <label class="control-label">Value Driver :</label>
                                <div class="controls">
                                    <select name="ValueDriverCode" id="ValueDriverCode" class="span6">
                                        <option value="">Select</option>
                                        <?php foreach($allValueDrivers as $v){ ?>
                                            <option value="<?php echo $v['ValueDriverCode']; ?>"><?php echo $v['ValueDriver']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Sub Value Driver :</label>
                                <div class="controls">
                                    <select name="SubDriverCode" id="SubDriverCode" class="span6">
                                        <option value="">Select</option>
                                        <!-- <?php foreach($allSubValueDrivers as $v){ ?>
                                            <option value="<?php echo $v['SubValueDriverCode']; ?>"><?php echo $v['SubValueDriver']; ?></option>
                                        <?php } ?> -->
                                    </select>
                                </div>
                            </div>
                             
                            <div class="control-group">
                                <label class="control-label">KPI Name :</label>
                                <div class="controls">
                                    <input id="KPIName" type="text" name="KPIName" value="" class="span6" placeholder="KPIName" />
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Description :</label>
                                <div class="controls">
                                    <textarea id="Description" rows="3" type="text" name="Description" value="" class="span6" placeholder="Description"></textarea>
                                </div>
                            </div>
                           
                            <div class="control-group">
                                <label class="control-label">Formula :</label>
                                <div class="controls">
                                    <input id="Formula" type="text" name="Formula" value="" class="span6" placeholder="Formula" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">SOURCE :</label>
                                <div class="controls">
                                    <input id="SOURCE" type="text" name="SOURCE" value="" class="span6" placeholder="SOURCE" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Status :</label>
                                <div class="controls">
                                    <select name="active" id="active" class="span6">
                                        <option value="">Select</option>
                                        <option value="Y">Active</option>
                                        <option value="N">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Nature :</label>
                                <div class="controls">
                                    <select name="Nature" id="Nature" class="span6">
                                        <option value="">Select</option>
                                        <option value="1">Positive</option>
                                        <option value="-1">Negative</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Business :</label>
                                <div class="controls">
                                    <select name="Business" id="Business">
                                        <option value="">Select Business</option>
                                        <?php
                                            foreach ($Business_rows as $business){
                                        ?>
                                        <option value="<?php echo $business['Business']?>"><?php echo $business['Business']?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="">
                                    <table class="table table-bordered" id="tableinsert">
                                        <thead>
                                            <tr>
                                                <th class="span3">Title</th>
                                                <th class="span3">Value Type</th>
                                                <th>Chart Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablebody">
                                            <tr id="rowToClone" class="processkpi">
                                                <td>
                                                    <?php echo $input1 = '<input type="text" class="span15 title" name="title[]" id="title" value="" required style="min-width:400px;">'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input2 = '<select class="span10 valuetype" name="valuetype[]" id="valuetype" onchange="findData(this);" required>
                                                        <option value="">Select</option>
                                                        <option value="number">Number</option>
                                                        <option value="percentage">Percentage</option>
                                                    </select>'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input3 = '<select class="span10 charttype" name="charttype[]" id="charttype" onchange="findData(this);" required>
                                                        <option value="">Select</option>
                                                        <option value="line">Line</option>
                                                        <option value="column">Column</option>
                                                    </select>'; ?>
                                                </td>
                                                <td><a class="btn btn-primary" onclick="insertrow(this)">Add</a>
                                                    <?php $input4 = '<a onclick="deleterow(this)" class="btn btn-warning">Remove</a>'; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <script>
                                        $("input[name='Returnable']").click(function() {
                                            $('#show-me').css('display', ($(this).val() === 'Y') ? 'block' : 'none');
                                        });

                                        function insertrow(r) {
                                            var table = document.getElementById("tableinsert");
                                            str = table.rows.length;
                                            var row = table.insertRow();
                                            // console.log(r);

                                            var cell1 = row.insertCell(0);
                                            var cell2 = row.insertCell(1);
                                            var cell3 = row.insertCell(2);
                                            var cell4 = row.insertCell(3);

                                            var input1 = document.getElementById("title").innerHTML;
                                            var input2 = document.getElementById("valuetype").innerHTML;
                                            var input3 = document.getElementById("charttype").innerHTML;

                                            cell1.innerHTML = '<input type="text" class="span15 title" name="title[]" id="title" value="" required>';
                                            cell2.innerHTML = '<select class="span10 valuetype" name="valuetype[]" id="valuetype" onchange="findData(this);" required>' + input2 + '</select>';
                                            cell3.innerHTML = '<select class="span10 charttype" name="charttype[]" id="charttype" onchange="findData(this);" required>' + input3 + '</select>';
                                          
                                            cell4.innerHTML = '<?php echo $input4; ?>';

                                            // console.log(input1);
                                        }

                                        function deleterow(r) {
                                            var i = r.parentNode.parentNode.rowIndex;
                                            document.getElementById("tableinsert").deleteRow(i);
                                        }
                                    </script>
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
	var ValueDriverCode = $('#ValueDriverCode').find(":selected").val();
	//alert(ValueDriverCode);return false;
	 $.ajax({
            url: '<?php echo base_url('kpi/getSubValueDriverCodeByValueDriver')?>',
            type: 'POST',
            data: {ValueDriverCode: ValueDriverCode},
            dataType:'json',
            success: function(response){
                console.log(response);
                $('#SubDriverCode').html(response);
                }
        });
	
	//alert(businessId);
});
</script>
