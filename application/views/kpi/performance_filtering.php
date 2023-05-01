<script language="Javascript" type="text/javascript">
    function confirm_submit() {
        if (confirm('<?php echo 'Confirm Delete Data'; ?>')) {
            return true;
        } else {
            return false;
        }
    }
</script>

<script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-core.min.js"></script>
<script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-sparkline.min.js"></script>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="<?php echo base_url(); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="<?php echo base_url('kpi'); ?>" class="current"><?php echo $page_title; ?></a>
        </div>
<!--        <h1 style="text-align: center">--><?php //echo $page_title; ?><!--</h1>-->
    </div>
    <div class="container-fluid" style="background: #aab1bb;margin: 7px 7px">
        <p style="font-size: 17px;margin: 10px 4px 8px 0px;color: white">Performance Filtering</p>
        <form action="<?php echo base_url('kpi/performanceFiltering'); ?>" method="post">
            <div style="display: flex">
                <div>
                    <p style="font-size: 14px;color: white">Business</p>
                    <select name="Business" id="">
                        <option value=''>Select All</option>
                        <?php
                        foreach ($Business_rows as $val){
                            ?>
                            <option value="<?php echo $val['Business'] ?>" <?php if($Business === $val['Business']){ echo 'selected';} ?> ><?php echo $val['Business'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <p style="font-size: 14px;color: white">Cluster</p>
                    <select name="valuedriver" id="valuedriver">
                        <option value="">Select Cluster</option>
                        <?php
                        if (isset($allvaluedriver) && !empty($allvaluedriver)) {
                            foreach ($allvaluedriver as $valueDriver) {
                                ?>
                                <option value="<?= $valueDriver['ValueDriver']; ?>" <?php if($valuedriver == $valueDriver['ValueDriver']){ echo 'selected';} ?> ><?= $valueDriver['ValueDriver']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <p style="font-size: 14px;color: white">Criteria</p>
                    <select name="criteria" id="criteria" required>
                        <option value="">Select Criteria</option>
                        <?php
                            if ($criteria == 'worst'){
                        ?>
                        <option value="worst" selected>Worst</option>
                        <option value="best">Best</option>
                        <?php
                            }elseif($criteria == 'best'){
                        ?>
                                <option value="worst">Worst</option>
                                <option value="best" selected>Best</option>
                        <?php
                            }else{
                        ?>
                                <option value="worst">Worst</option>
                                <option value="best" >Best</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <p style="font-size: 14px;color: white">Value</p>
                    <input type="number" name="value" value="<?php if (!empty($value)){echo $value;} ?>" required>
                </div>
                <div style="padding-top: 30px;margin-left: 10px">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="submit" class="btn btn-success" value="export" name="export">Export</button>
                </div>
            </div>
        </form>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <?php
                        if (isset($second) && !empty($second)){
                        ?>
                        <table class="table table-bordered data-table" id="report_data">
                            <thead>
                            <tr>
                                <th>Details</th>
                                <?php
                                $index = array_keys($second[0]);

                                for($i = 0; $i < count($index); $i++){
                                    ?>
                                        <th><?php echo str_replace(array('_'), array(' '), $index[$i]); ?></th>
                                    <?php
                                }
                                ?>
                            </tr>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeX">
                                    <?php
                                    for ($i = 0; $i < count($second); $i++) {
                                    $arrayvalue = array_values($second[$i]);
                                    ?>
                                        <tr>
                                            <td><a href="#" onclick="doLoadDetailsData('<?php echo $arrayvalue[0]; ?>','<?php echo $arrayvalue[1]; ?>','<?php echo $arrayvalue[2]; ?>')"> Details</a></td>
                                            <?php
                                            for ($j = 0; $j < count($index); $j++) {
                                                $value = $arrayvalue[$j];
                                                ?>
                                                    <?php
                                                if ($j < 3){
                                                ?>
                                                <td> <?php echo $value; ?> </td>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <td style="text-align: right"> <?php echo $value; ?> </td>
                                                    <?php
                                                }
                                                    ?>

                                            <?php } ?>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal modal-lg hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Details</h3>
        </div>
        <div class="modal-body">
            <table class="table table-bordered" id="tableinsert">
                <thead>
                <tr>
                    <th>BusinessName</th>
                    <th>Value Driver Code</th>
                    <th>Sub Driver Code</th>
                    <th>KPI Name</th>
                    <th>1P</th>
                    <th>2P</th>
                    <th>3P</th>
                    <th>4P</th>
                    <th>5P</th>
                    <th>6P</th>
                    <th>Score</th>
                    <th>Chart</th>
                </tr>
                </thead>
                <tbody id="tablebodyData">

                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>

    <style>
        #container<?php echo $key; ?> {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .anychart-credits a{
            display: none;
        }

        .modal {
            position: fixed;
            top: 10%;
            left: 40% !important;
            z-index: 1050;
            width: 1000px!important;
        }
    </style>

</div>

<script>
        function doLoadDetailsData(business,valudriver,subvalue){
            $.ajax({
                url: '<?php echo base_url('kpi/AdminDataDetails') ?>',
                type: 'POST',
                data: {business: business, valudriver: valudriver, subvalue: subvalue},
                success: function(data) {
                    var response = JSON.parse(data);
                    $('#myModal').modal('show');
                    $("#tablebodyData").html(response.string)
                }
            });
        }
</script>