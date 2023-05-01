<script language="Javascript" type="text/javascript">
function confirm_submit()
{
    if (confirm('<?php echo 'Confirm Delete Data'; ?>')) {return true;}
    else {return false;}
}
</script>
<div id="content">
    <div id="content-header" style="display:none;">
        <div id="breadcrumb"> 
            <a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> 
            <a href="<?php echo base_url('kpi');?>" class="current"><?php echo $page_title;?></a> 
        </div>
        <h1><?php echo $page_title;?></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12" style="display:none;">                             
                <?php                    
                    $message = $this->session->userdata('message');
                    if (isset($message) && !empty($message)) {
                        echo '<div class="alert alert-success" align="center">';
                        echo '<h5>'.$message.'</h5>';
                        echo '</div>';
                        $this->session->unset_userdata('message');
                    }
                ?>
                <div class="widget-box">                    
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5><?php echo $page_title;?></h5>
                        <!--<button id="btncurrent" class="btn btn-success" style=" float: right;">Export to Excel</button>	-->
                    </div>          
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table" id="report_data">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width:90px;">Value Driver Code</th>
                                    <th>Value Driver Name</th>
                                    <th>STATUS</th>
                                    <th>Report Status</th>
                                    <td>Group KPI Metrics - Index Value Calculation</td>
                                    <th>Edit</th>
                                    <!--<th>Delete</th>-->
                                </tr>
                            </thead>
                            <tbody>                                
                            <?php 
                                $prevValueDriverCode=-1;
                                $i = 1;
                                if (!empty($rows)) foreach ($rows as $row): 
                                if($row['ValueDriverCode'] != $prevValueDriverCode)
                                {
                                    $i = 1;
                                }else{
                                    ++$i;      
                                }
                                $prevValueDriverCode=$row['ValueDriverCode'];
                                
                                ?>
                                <tr class="gradeX">
                                    <td style="text-align: center; width:90px;"><?php echo $row['ValueDriverCode']; ?></td>
                                    <td style="text-align: left;"><?php echo $row['ValueDriverName']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['STATUS']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['ReportStatus']; ?></td>                                
                                    <td style="text-align: left;">                                        
                                        <?php 
                                            //print_r($row['GroupKPIMetrics']); 
                                            $j = 1;
                                            foreach ($row['GroupKPIMetrics'] as $row_GKM){
                                                echo $j.'. '.$row_GKM['KPIMetricsName'].' ('.$row_GKM['KPIMetricsCode'].') - <b>'.$row_GKM['IndexValueCalculation'].'</b><br/>';
                                                $j++;
                                            }
                                        ?>
                                    </td> 
                                    <td style="text-align: center;"><a class="btn btn-primary" href="<?php echo base_url(); ?>kpi/update/<?php echo $row['ValueDriverCode']; ?>">Edit</a></td>
                                    <!--<td style="text-align: center;"><a onclick="return confirm_submit()" class="btn btn-danger" href="<?php echo base_url(); ?>kpi/delete/<?php echo $row['ValueDriverCode']; ?>">Delete</a></td>-->
                                    <!--<td><a class="btn blue" href="<?php echo base_url(); ?>business/AreaView/<?php echo $row['Business']; ?>">View</a></td>-->
                                </tr>
                            <?php 
                                endforeach; 
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#btncurrent').click(function(){

        $('#report_data').table2excel({

           exclude: ".noExl",

           name: "CVsummary",

           filename: "Quiz Export "

        });

   });
</script>
