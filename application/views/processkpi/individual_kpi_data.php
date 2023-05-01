
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
    </div>
    <div class="container-fluid" style="margin: 7px 7px">
        <!--        <p style="font-size: 17px;margin: 10px 4px 8px 0px;color: white">--><?php //echo $page_title; ?><!--</p>-->
        <form action="<?php echo base_url('processkpi/individualKpiData'); ?>" method="post" style="margin-left: -8px">
            <div style="display: flex">
                <div>
                    <p style="font-size: 14px;">Business</p>
                    <select name="BusinessName" id="BusinessName">
                        <option value="">Select Business</option>
                        <?php
                        foreach ($business as $value){
                            ?>
                            <option value="<?php echo $value['BusinessName'];?>" <?php if($business_name === $value['BusinessName']){ echo 'selected';} ?> ><?php echo $value['BusinessName'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <p style="font-size: 14px;">User</p>
                    <select name="ResponsiblePerson" id="ResponsiblePerson">
                        <option value="">Select User</option>
                        <?php
                        foreach ($user as $item){
                            ?>
                            <option value="<?php echo $item['ResponsiblePerson'];?>" <?php if($user_name === $item['ResponsiblePerson']){ echo 'selected';} ?> > <?php echo $item['ResponsiblePerson'];?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div style="padding-top: 30px;margin-left: 10px">
                    <button type="submit" class="btn btn-success">Filter</button>
                    <!--                        <button type="submit" class="btn btn-success" value="export" name="export">Export</button>-->
                </div>
            </div>
        </form>
        <div class="container-fluid">
        <?php
        if (!empty($userInfo) && !empty($individual_dashboard)){
            ?>
            <div class="row">
                <div class="col-sm-6" style="width: 49%">
                    <table class="table table-bordered table-hover table-striped" style="margin-bottom:-30px">
                        <tbody>
                        <tr>
                            <th class="bold" colspan="12" style="text-align: center;background: #ad5e0d;color: white;font-size: 14px;">
                                KPI Dashboard
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: left;color: black">Name</th>
                            <th style="font-weight: normal;text-align: left"><?php echo $userInfo[0]['ResponsiblePerson'];?></th>
                            <th style="text-align: left;color: black">Reporting to</th>
                            <th style="font-weight: normal;text-align: left"></th>
                        </tr>
                        <tr>
                            <th style="text-align: left;color: black">Designation</th>
                            <th style="font-weight: normal;text-align: left"><?php echo $userInfo[0]['Designition'];?></th>
                            <th></th>
                            <th style="font-weight: normal;text-align: left"></th>
                        </tr>
                        <tr>
                            <th style="text-align: left;color: black">Business group</th>
                            <th style="font-weight: normal;text-align: left"><?php echo $userInfo[0]['BusinessName'];?></th>
                            <th style="text-align: left;color: black">HR</th>
                            <th style="font-weight: normal;text-align: left"></th>
                        </tr>
                        <tr>
                            <th style="text-align: left;color: black">Business Name</th>
                            <th style="font-weight: normal;text-align: left"><?php echo $userInfo[0]['BusinessName'];?></th>
                            <th></th>
                            <th style="font-weight: normal;text-align: left"></th>
                        </tr>
                        <tr>
                            <th style="text-align: left;color: black">Cluster</th>
                            <th style="font-weight: normal;text-align: left"><?php echo $userInfo[0]['FcatoryName'];?></th>
                            <th></th>
                            <th style="font-weight: normal;text-align: left"></th>
                        </tr>
                        </tbody>
                        <thead>
                        <tr>

                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div style="display: flex">
                        <div style="text-align: center;color: white;width: 50%;font-size: 15px;padding: 5px;"></div>
                        <div style="text-align: center;background: #878585;color: white;width: 52%;font-size: 15px;padding: 5px;">Period Wise Performance</div>
                    </div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr style="background: #030303;color: #363232">
                                <?php
                                $index = array_keys($individual_dashboard[0]);
                                for($i = 0; $i < count($index); $i++){
                                    ?>
                                    <th style="font-size: 12px;background: #2c2727;color: white"><?php echo str_replace(array('_'), array(' '), $index[$i]); ?></th>
                                    <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="gradeX">
                            <?php
                            for ($i = 0; $i < count($individual_dashboard); $i++) {
                            $arrayvalue = array_values($individual_dashboard[$i]);
                            ?>
                        <tr>
                            <?php
                            for ($j = 0; $j < count($index); $j++) {
                                $value = $arrayvalue[$j];
                                ?>

                                <?php
                                if ($j < 4){
                                    ?>
                                    <td style="color: black"> <?php echo $value; ?> </td>
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
                </div>
            </div>
            <?php
        }
        ?>
        </div>
    </div>

</div>

<script>

</script>
