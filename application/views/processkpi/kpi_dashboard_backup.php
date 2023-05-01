<!DOCTYPE HTML>
<html>
<head>
<title>KPI Report</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>kpiprocess/assets/css/bootstrap.min.css" crossorigin="anonymous">
<script src="<?php echo base_url(); ?>kpiprocess/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.9.1.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="container-fluid">
                <br>

                <form action="<?php echo base_url('processkpi/kpiDashboard'); ?>" method="post">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="" id="" class="form-control">
                                    <option value="">Select Business</option>
                                    <?php
                                    foreach ($business as $value){
                                    ?>
                                    <option value="<?php echo $value['BusinessName'];?>"><?php echo $value['BusinessName'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="" id="" class="form-control">
                                    <option value="">Select Business</option>
                                    <?php
                                    foreach ($user as $item){
                                    ?>
                                    <option value="<?php echo $item['ResponsiblePerson'];?>"> <?php echo $item['ResponsiblePerson'];?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-success">Filter</button>
                        </div>
                    </div>
                </form>

                <form action="<?php echo base_url('kpi/performanceFiltering'); ?>" method="post">
                    <div style="display: flex">
                        <div>
                            <p style="font-size: 14px;color: white">Business</p>
                            <select name="BusinessName" id="BusinessName">
                                <option value="">Select Business</option>
                                <?php
                                foreach ($business as $value){
                                    ?>
                                    <option value="<?php echo $value['BusinessName'];?>"><?php echo $value['BusinessName'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <p style="font-size: 14px;color: white">User</p>
                            <select name="ResponsiblePerson" id="ResponsiblePerson">
                                <option value="">Select User</option>
                                <?php
                                foreach ($user as $item){
                                    ?>
                                    <option value="<?php echo $item['ResponsiblePerson'];?>"> <?php echo $item['ResponsiblePerson'];?> </option>
                                    <?php
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

                <?php
                    if (isset($userInfo) && isset($individual_dashboard)){
                ?>
				<div class="row">
                    <div class="col-sm-6">
						<table class="table table-bordered table-hover table-striped">
							<tbody>
                                <tr>
                                    <th class="bold" colspan="12" style="text-align: center;background: #ad5e0d;color: white">
                                        KPI dashboard
                                    </th>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <th style="font-weight: normal;">Md. Altaf Hossain</th>
                                    <th>Reporting to</th>
                                    <th style="font-weight: normal;">COO Pharma</th>
                                </tr>
                                <tr>
                                    <th>Designation</th>
                                    <th style="font-weight: normal;">Director, Quality Assurance</th>
                                    <th></th>
                                    <th style="font-weight: normal;"></th>
                                </tr>
                                <tr>
                                    <th>Business group</th>
                                    <th style="font-weight: normal;">Pharma</th>
                                    <th>HR</th>
                                    <th style="font-weight: normal;">Raihan.ahmed@aci-bd.com</th>
                                </tr>
                                <tr>
                                    <th>Business Name</th>
                                    <th style="font-weight: normal;">Pharma</th>
                                    <th></th>
                                    <th style="font-weight: normal;"></th>
                                </tr>
                                <tr>
                                    <th>Cluster</th>
                                    <th style="font-weight: normal;">Factory</th>
                                    <th></th>
                                    <th style="font-weight: normal;"></th>
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
                            <div class="col-sm-6" style="text-align: center;background: #524d4d;color: white;">Last Year performance</div>
                        </div>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr style="background: #4e4740;color: white">
<!--                                    --><?php
//                                    $index = array_keys($second[0]);
//
//                                    for($i = 0; $i < count($index); $i++){
//                                        ?>
<!--                                        <th>--><?php //echo str_replace(array('_'), array(' '), $index[$i]); ?><!--</th>-->
<!--                                        --><?php
//                                    }
//                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Q</td>
                                    <td>Batch release on time- FG</td>
                                    <td>%</td>
                                    <td>H</td>
                                    <td>15%</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Q</td>
                                    <td>Batch release on time- FG</td>
                                    <td>%</td>
                                    <td>H</td>
                                    <td>15%</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Q</td>
                                    <td>Batch release on time- FG</td>
                                    <td>%</td>
                                    <td>H</td>
                                    <td>15%</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Q</td>
                                    <td>Batch release on time- FG</td>
                                    <td>%</td>
                                    <td>H</td>
                                    <td>15%</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Q</td>
                                    <td>Batch release on time- FG</td>
                                    <td>%</td>
                                    <td>H</td>
                                    <td>15%</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Q</td>
                                    <td>Batch release on time- FG</td>
                                    <td>%</td>
                                    <td>H</td>
                                    <td>15%</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                    }
                ?>
                <div class="row">
                    <div class="col-sm-12">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">

</script>

<style type="text/css">
.table td, .table th{
    padding: 5px;
    font-size: 12px;
}
</style>