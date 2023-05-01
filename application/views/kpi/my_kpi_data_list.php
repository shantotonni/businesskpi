<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
<script language="Javascript" type="text/javascript">
function confirm_submit()
{
    if (confirm('<?php echo 'Confirm Delete Data'; ?>')) {return true;}
    else {return false;}
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
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <form action="<?php echo base_url('kpi/my_kpi_data'); ?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Year :</label>
                                <div class="controls">
                                    <input type="text" name="year" id="year" required value="<?php if (isset($year)){echo $year ;} ?>">
                                    <button type="submit" class="btn btn-success">Filter</button>
                                    <input type="submit" name="export" class="btn btn-success" value="export">
                                </div>

                            </div>
                        </form>

                        <table class="table table-bordered data-table" id="report_data">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <?php
                                    $index = array_keys($my_kpi_data[0]);
                                    for($i = 0; $i < count($index); $i++){
                                        ?>
                                            <?php
                                        if ($i < 5){
                                        ?>
                                        <th><?php echo str_replace(array('_'), array(' '), $index[$i]); ?></th>

                                        <?php

                                        }else{
                                            $year = substr($index[$i], 0, 4);
                                            $month = substr($index[$i], -2);
                                            $result = $year.'-'.$month.'-'.'01';
                                        ?>
                                            <th><?php echo date('F Y',strtotime($result)); ?></th>
                                            <?php
                                        }
                                            ?>

                                        <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeX">
                                    <?php
                                    for ($i = 0; $i < count($my_kpi_data); $i++) {
                                        $arrayvalue = array_values($my_kpi_data[$i]);
                                        ?>
                                        <tr>
                                    <td><?php echo $i + 1; ?></td>
                                            <?php

                                            for ($j = 0; $j < count($index); $j++) {
                                                $value = $arrayvalue[$j];
                                                ?>
                                                <td> <?php echo $value; ?> </td>
                                            <?php } ?>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script>
    $("#year").datepicker({
        dateFormat: 'yy'
    });
</script>

