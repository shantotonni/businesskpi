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
        <form action="<?php echo base_url('kpi/kpiStatus'); ?>" method="post">
            <div style="display: flex">
                <div>
                    <p style="font-size: 14px;color: white">Business</p>
                    <select name="Business" id="">
                        <option value=''>Select All</option>
                        <?php
                        foreach ($Business_rows as $val){
                            ?>
                            <option value="<?php echo $val['BusinessName'] ?>" <?php if($Business === $val['BusinessName']){ echo 'selected';} ?> ><?php echo $val['BusinessName'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <p style="font-size: 14px;color: white">Cluster</p>
                    <select name="valuedriver" id="valuedriver">
                        <option value="">Select All Cluster</option>
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
                        if (isset($kpi_status_data) && !empty($kpi_status_data)){
                        ?>
                        <table class="table table-bordered data-table" id="report_data">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>UserID</th>
                                <th>Last Entry Period</th>
                                <th>Business Name</th>
                                <th>ValueDriver</th>
                                <th>SubValueDriver</th>
                                <th>KPICode</th>
                                <th>KPIName</th>
                                <th>EmpName</th>
                                <th>EmpCode</th>
                                <th>Designation</th>
                                <th>DataEntryCount</th>
                            </tr>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($kpi_status_data as $key => $value){
                            ?>
                                <tr class="gradeX">
                                    <td><?php echo ++$key; ?></td>
                                    <td><?php echo $value['UserID']; ?></td>
                                    <td><?php echo $value['LastEntryperiod']; ?></td>
                                    <td><?php echo $value['BusinessName']; ?></td>
                                    <td><?php echo $value['ValueDriver']; ?></td>
                                    <td><?php echo $value['SubValueDriver']; ?></td>
                                    <td><?php echo $value['KPICode']; ?></td>
                                    <td><?php echo $value['KPIName']; ?></td>
                                    <td><?php echo $value['EmpName']; ?></td>
                                    <td><?php echo $value['EmpCode']; ?></td>
                                    <td><?php echo $value['Designation']; ?></td>
                                    <td><?php echo $value['DataEntryCount']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
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
</div>

<script>

</script>