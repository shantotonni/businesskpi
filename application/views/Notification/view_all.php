<script language="Javascript" type="text/javascript">
function confirm_submit()
{
    if (confirm('<?php echo 'Confirm Delete Data'; ?>')) {return true;}
    else {return false;}
}
function cb_changeAll() {
  var d = document.form1;
  var setTo = d.checkall.checked ? true : false;

  for (var i = 0; i < d.elements.length; i++)
  {
    if(d.elements[i].type == 'checkbox' && d.elements[i].name != 'checkall')
    {
     d.elements[i].checked = setTo;
    }
  }
}
function hesk_confirmExecute(myText) {
	 if (confirm(myText))
	 {
	  return true;
	 }
	 return false;
}
</script>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> 
            <a href="<?php echo base_url('kpi');?>" class="current"><?php echo $page_title;?></a> 
        </div>
        <h1><?php echo $page_title;?></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">                             
                <?php                    
                    $message = $this->session->userdata('message');
                    if (isset($message) && !empty($message)) {
                        echo '<div class="alert alert-success" align="center">';
                        echo '<h5>'.$message.'</h5>';
                        echo '</div>';
                        $this->session->unset_userdata('message');
                    }
                ?>
				<form class="form-inline" action="<?php echo base_url('Notification');?>" method="post">
						<select name="Business" id="Business">
							<option value="">Select a Business</option>
							<?php
							if (isset($business_rows) && !empty($business_rows)) {
								foreach ($business_rows as $row) {
							?>
									<option value="<?= $row['Business']; ?>" 
									<?php if(isset($Business) && $Business == $row['Business']){
										echo  'selected';
									}else {
										echo '';
									}
									?>><?= $row['Business']; ?></option>
							<?php
								}
							}
							?>
						</select>
						<select name="Period" id="Period">
							<option value="">Select a Period</option>
							<?php
							if (isset($period_rows) && !empty($period_rows)) {
								foreach ($period_rows as $row) {
							?>
									<option value="<?= $row['Period']; ?>" <?php if(isset($Period) && $Period == $row['Period']){
										echo  'selected';
									}else {
										echo '';
									}
									?>><?= get_period_month($row['Period']); ?></option>
							<?php
								}
							}
							?>
						</select>
						<button type="submit" class="btn">Search</button>
				</form>
				<form name="form1" action="<?php echo base_url('Notification/send_mail/');?>" method="post" onsubmit="return hesk_confirmExecute('<?php echo 'confirm_execute'; ?>')">
					<div class="widget-box">                    
						<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
							<h5><?php echo $page_title;?></h5>
						</div>          
						<div class="widget-content nopadding">
								<?php //echo '<pre/>';print_r($rows); exit();?>
						
							<table class="table table-bordered data-table" id="report_data">
								<thead>
									<tr>
										<!--<th><input type="checkbox" name="checkall" value="2" onclick="cb_changeAll()" /></th>-->
										<th style="text-align: center; width:90px;">Business</th>
										<th style="text-align: center; width:90px;">Period</th>
										<th>KPI</th>
										<th>Email (To)</th>
										<th>Email (CC)</th>								
										<th>Edit</th>
									</tr>
								</thead>
								<tbody>                                
								<?php 
		   
									$i = 1;
									if (!empty($rows)) foreach ($rows as $row): 
						 
									
									?>
									<tr class="gradeX">
										<!--<td><input type="checkbox" name="KPICode[]" value="<?php echo $row['KPICode']; ?>" /></td>-->
										<td style="text-align: center; width:90px;">
											<input type="hidden" name="KPICode[]" id="KPICode<?php echo $i;?>" value="<?php echo $row['KPICode']; ?>"/><?php echo $row['Business']; ?>
											<input type="hidden" name="Business[]" id="Business<?php echo $i;?>" value="<?php echo $row['Business']; ?>"/>
											<input type="hidden" name="KPIName[]" id="KPIName<?php echo $i;?>" value="<?php echo $row['KPIName']; ?>"/>
											<input type="hidden" name="Period[]" id="Period<?php echo $i;?>" value="<?php echo $row['Period']; ?>"/>
										</td>
										<td style="text-align: center;"><?php echo get_period_month($row['Period']);?></td>
										<td style="text-align: left;"><?php echo $row['KPIName'].'('.$row['KPICode'].')'; ?></td>
										<td style="text-align: center;">
											<input type="email" name="To[]" id="To<?php echo $i;?>" required />
										</td>
										<td style="text-align: center;">
											<input type="email" name="Cc[]" id="Cc<?php echo $i;?>"/>
										</td>                                
										<td style="text-align: center;">
											<div id="display_receive_loading<?php echo $i;?>"></div><a class="btn btn-primary sendEmail" id="KPICode_<?php echo $i;?>" href="javascript:;">Send</a>
										</td>                               
									</tr>
								<?php
									$i++;
									endforeach; 
								?>
								</tbody>
							</table>
						</div>
						<!--<div class="widget-title">
							<input type="submit" class="btn btn-primary" value="Send Email">
						</div> -->
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){    
        $('.sendEmail').click(function(){
		
		
			 
			var attr_id = $(this).attr('id');
			var id = attr_id.substr(attr_id.indexOf("_") + 1);
			
			var KPICode = $("#KPICode"+id).val();
			var KPIName = $("#KPIName"+id).val();
			var To = $("#To"+id).val();
			var Cc = $("#Cc"+id).val();
			var Business = $("#Business"+id).val();
			var Period = $("#Period"+id).val();
			
			if ($('#KPICode').is(':checked')) {
				//alert("Please check first!", "...AssessmentID no not checked")
				alert("Please check first!");
				//swal("Please check first!", "...AssessmentID no not checked!");
				return false;
            }
			console.log(To.length);
			if(To.length ==0){
				alert("Please Enter Email first!");
				//swal("Please check first!", "...AssessmentID no not checked!");
				return false;
			}
			console.log(KPICode);
			//console.log(To);return false;
        
            
                                    
			var dataString = 'KPICode='+ KPICode + '&To='+ To + '&Cc='+ Cc + '&KPIName='+ KPIName + '&Business='+ Business + '&Period='+ Period;
			//console.log(dataString);return false;
                $.ajax
                ({
                    type: "POST",
                    url: "<?php echo  base_url();?>Notification/send_mail",
                    data: dataString,
                    cache: false,
                    beforeSend: function() 
                   {
                           $("#display_receive_loading"+id).show();
                           $("#display_receive_loading"+id).html('<img src="<?php echo base_url();?>assets/img/loading.gif" align="absmiddle" alt="Loading..."> Receiving...');
                   }, 
                    success: function(html)
                    {  
                        $("#display_receive_loading"+id).hide();
                        $("#show_tr_"+id).show();  
                        $("#show_"+id).show();  
                        $("#show_"+id).html(html);                    
                    } 
                });
         
        });
    });
//    $('#dataTableExample').DataTable({
//         "ordering": false
//    });
</script>
