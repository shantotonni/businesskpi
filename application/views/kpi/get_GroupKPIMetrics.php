     <option value="">Select a GroupKPIMetrics</option>  
	<?php foreach ($rows as $Qs):                                
	echo '<option value="'.$Qs->KPIMetricsCode.'">'.$Qs->KPIMetricsName.'</option>';
	endforeach;?>  