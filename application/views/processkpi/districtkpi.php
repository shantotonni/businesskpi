<!DOCTYPE HTML>
<html>
<head>
<title>KPI Report</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>kpiprocess/assets/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="<?php echo base_url(); ?>kpiprocess/assets/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.9.1.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">            
            <div class="container-fluid">				
				
                <div class="row">
                    <div class="col-sm-12">&nbsp;</div>
                </div>
                
            </div>
        </div>
    </div>
	
	<form action="<?php echo base_url(); ?>processkpi/districtkpi" method="post">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">&nbsp;</div>
			</div>
			<div class="row">
				<div class="col-md-1"><label for="Business">Business : &nbsp;</label></div>
				<div class="col-sm-1">
					<select class="form-control" id="business" name="business" required="">
						<option value="">All</option>
						<?php  foreach ($allbusiness as $Bu):                   
							echo '<option value="'.$Bu['Business'].'">'.$Bu['Business'].'</option>';
							endforeach; 
						?>
					</select>
				</div>
				<div class="col-sm-1"><button id="submit_data" type="submit" class="btn btn-success">Submit</button></div>
			</div>	
		</div>
	</form>
    <div class="container-fluid">
		<div class="row"> 
			<div class="col-md-6">
				<div style="width: 100%; font-size:16px; background-color: #ffffc2; color: #444;  margin-top: 10px; margin-bottom: 10px; padding: 5px; ">
					<div style="width: 100%;">                            
						<div style="width: 100%; text-align: left;">
							<?php echo $business; ?> - District-wise sales dispersion <i class="fa fa-plus" style="font-size:16px; color:#888;"></i>
						</div>
					</div>                            
				</div>	
				<div class="col-md-12">				
					<?php
					if (!empty($districtwisesals)) {
						$index = array_keys($districtwisesals[0]);
						$count = 0;       
						//echo "<pre />"; print_r($districtwisesals) ; exit();
						?>    
						<div class="table-responsive">
							<table id="doctorbrandtable" class="table table-bordered table-hover  table-striped">
								<thead>
									<tr>
										<?php
										for($i = 0; $i < count($index); $i++){
											?><th class="text-center"><?php echo str_replace(array('No_','Per_month','_', 'Percentage'), array('# ','/ Month',' ', '%'), $index[$i]); ?></th><?php
										}
										?>
									</tr>
								</thead>
								<?php
								for ($i = 0; $i < count($districtwisesals); $i++) {
									$arrayvalue = array_values($districtwisesals[$i]);
									?>
									<tr>
										
										<?php
										for ($j = 0; $j < count($index); $j++) {
											$value = $arrayvalue[$j];
											?>  
												<td id="category<?php if(!empty(explode("__",$value)[1])){ echo round(explode("__",$value)[0]); } ?>" <?php if($j > 0){ ?> class="text-right" <?php } ?>>
													<?php 
													if($j > 0){
														if(!empty(explode("__",$value)[1])){
															echo number_format(explode("__",$value)[1],2); 
														}else{
															echo 0.00;
														}
													}else{
														echo $value; 
													}
													?>
												</td>
											
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
			
			<div class="col-md-6">
				<div class="col-md-12">
					<?php
					if (!empty($monthwisedata)) {
						$index = array_keys($monthwisedata[0]);
						$count = 0;       
						//echo "<pre />"; print_r($districtwisesals) ; exit();
						?>    
						<div class="table-responsive">
							<table id="doctorbrandtable" class="table table-bordered table-hover  table-striped">
								<thead>
									<tr>
										<?php
										for($i = 0; $i < count($index); $i++){
											?><th class="text-center"><?php echo str_replace(array('No_','Per_month','_', 'Percentage'), array('# ','/ Month',' ', '%'), $index[$i]); ?></th><?php
										}
										?>
									</tr>
								</thead>
								<?php
								for ($i = 0; $i < count($monthwisedata); $i++) {
									$arrayvalue = array_values($monthwisedata[$i]);
									?>
									<tr>
										
										<?php
										for ($j = 0; $j < count($index); $j++) {
											$value = $arrayvalue[$j];
											?>  
												<td style="<?php 
													if($j > 1){?> text-align: right <?php } ?>">
													<?php 
													if($j > 1){
														echo number_format($value,0); 
													}else{
														echo $value; 
													}
													?>
												</td>
											
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
				<div class="col-md-6">
					<?php
						if (!empty($category)) {
							$index = array_keys($category[0]);
							$count = 0;       
							//echo "<pre />"; print_r($districtwisesals) ; exit();
							?>    
							<div class="table-responsive">
								<table id="doctorbrandtable" class="table table-bordered table-hover  table-striped">
									<thead>
										<tr>
											<?php
											for($i = 0; $i < count($index); $i++){
												?><th class="text-center"><?php echo str_replace(array('No_','Per_month','_', 'Percentage'), array('# ','/ Month',' ', '%'), $index[$i]); ?></th><?php
											}
											?>
										</tr>
									</thead>
									<?php
									for ($i = 0; $i < count($category); $i++) {
										$arrayvalue = array_values($category[$i]);
										?>
										<tr>
											
											<?php
											for ($j = 0; $j < count($index); $j++) {
												$value = $arrayvalue[$j];
												?>  
													<td id="category<?php echo $i + 1; ?>" <?php if($j > 0){ ?> class="text-right" <?php } ?>>
														<?php 
														if($j > 0){
															echo number_format($value,2); 
														}else{
															echo $value; 
														}
														?>
													</td>
												
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
			
		</div>
    </div>

<style>
	td, th{
		padding: 1px !important;
		font-size: 12px;
	}
	#category8{
		background-color: #041904;
		color: #FFF;
	}
	#category7{
		background-color: #0b4c0b;
		color: #FFF;
	}
	#category6{
		background-color: #137f13;
		color: #FFF;
	}
	#category5{
		background-color: #1bb21b;
		color: #FFF;
	}
	#category4{
		background-color: #29df29;
		color: #111;
	}
	#category3{
		background-color: #7eee7e;
		color: #111;
	}
	#category2{
		background-color: #c2f6c2;
		color: #111;
	}
	#category1{
		background-color: #f5fef5;
		color: #111;
	}
	#category{
		background-color: #f5fef5;
		color: #111;
	}
</style>
<script>
$(document).ready(function(){
	$("#business").val('<?php echo $business; ?>'); //$("#business").value('pharma');
}); 
</script>
</body>
</html>

 