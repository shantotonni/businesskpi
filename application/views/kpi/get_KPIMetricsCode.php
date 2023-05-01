<table class="table table-bordered table-striped table-condensed">
	<tr>
		<td>ValueDriverCode</td>
		<td>KPIMetricsCode</td>
		<td>Business</td>
		<td>CPERIOD</td>
		<td style="text-align:center">IndexValue</td>
	</tr>
	<?php foreach ($rows as $Qs):?>                                
	<tr>
		<td><?php echo $Qs->ValueDriverCode;?></td>
		<td><?php echo $Qs->KPIMetricsCode;?></td>
		<td><?php echo $Qs->Business;?></td>
		<td><?php echo $Qs->CPERIOD;?></td>
		<td style="text-align:center"><?php echo $Qs->IndexValue;?></td>
	</tr>
	<?php endforeach;?>	
</table>	