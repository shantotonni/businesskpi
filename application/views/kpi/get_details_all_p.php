<!--<form name="form1" id="form1" action="<?php echo base_url(); ?>visibilityPanel/approve_invoice" method="post">-->
 <script language="Javascript" type="text/javascript">
	$(document).ready(function () {
	  $('.delete').on('click',function(e, data){  
		if(!data){
		  handleDelete(e, 1);
		}else{
		  window.location = $(this).attr('href');
		}
	  });
	});
	function handleDelete(e, stop){
	  if(stop){
		e.preventDefault();
		swal({
		  title: "Are you sure?",
		  text: "You will not be able to recover the data again!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete!",
		  closeOnConfirm: false
		},
		function (isConfirm) {
                    //console.log(isConfirm);console.log(e.currentTarget);
                    var myString = $(e.currentTarget).attr("id");
                    var arr = myString.split('_');
                    var customer_id = arr[1];
                    console.log(customer_id);
                    if (isConfirm) {
                        console.log(isConfirm);
                        console.log(this);
                        //return false;   
                        $('#customer_' + customer_id).trigger('click', {});
                    }
                });
	  }
	};
	/*function confirm_submit()
	{
		if (confirm('<?php echo 'Confirm Delete Data'; ?>')) 
		{
			return true;
		}
		else {
			return false;
		}
	}*/
</script>  

<div id="msg_reg_container"></div>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <!--<th style="width:8px;"><input type="checkbox" name="checkall2" value="2" onclick="changeAll()" /></th>-->
            <th style="text-align:left;">Value Driver Code</th>
            <th style="text-align:left;">KPI Metrics Code</th>
            <th style="text-align:left;">Business</th>
            <th>CPERIOD</th>
            <th>A</th>
            <th>ATXT</th>
            <th>B</th>
            <th>BTXT</th>
            <th>C</th>
            <th>CTXT</th>
            <th>IndexValue</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        if (!empty($rows)) foreach ($rows as $row): ?>
                <tr id="tr_<?php echo $row['ValueDriverCode']; ?>">
                    <td><?php echo $row['ValueDriverName'].' ('.$row['ValueDriverCode'].')'; ?></td>
                    <td><?php echo $row['KPIMetricsName'].' ('.$row['KPIMetricsCode'].')'; ?></td>
                    <td><?php echo $row['Business']; ?></td>
                    <td style="text-align:center;"><?php echo $row['CPERIOD']; ?></td>
                    <td style="text-align:center;"><?php echo $row['A']; ?></td>
                    <td style="text-align:center;"><?php echo $row['ATXT']; ?></td>
                    <td style="text-align:center;"><?php echo $row['B']; ?></td>
                    <td style="text-align:center;"><?php echo $row['BTXT']; ?></td>
                    <td style="text-align:center;"><?php echo $row['C']; ?></td>
                    <td style="text-align:center;"><?php echo $row['CTXT']; ?></td>
                    <td style="text-align:center;"><?php echo $row['IndexValue']; ?></td>
                    <td>
                        <a class="btn green" href="<?php echo base_url(); ?>kpi/details_update/<?php echo $row['ValueDriverCode']; ?>/<?php echo $row['KPIMetricsCode']; ?>/<?php echo $row['CPERIOD']; ?>/<?php echo $row['Business']; ?>">Edit</a>
                     <!--<a id="customer_<?php //echo $row['ValueDriverCode']; ?>" class="btn red delete" href="<?php echo base_url(); ?>customer/customerDelete/<?php echo $row['ValueDriverCode']; ?>">Delete</a>-->
                    </td>
                </tr>
        <?php $i++;
        endforeach; ?>
<!--        <tr>
            <td colspan="7">
                <button class="btn green" type="submit">Done</button>
            </td>
        </tr>-->
    </tbody>
</table>
<!--</form>-->
<br clear="all" />
<div style="" align="left"><?php echo $vpb_pagination_system; ?></div><!-- This is the pagination buttons -->
<br clear="all" />

                    
                