<script language="Javascript" type="text/javascript">
    function confirm_submit() {
        if (confirm('<?php echo 'Confirm Delete Data'; ?>')) {
            return true;
        } else {
            return false;
        }
    }
</script>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="<?php echo base_url(); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="<?php echo base_url('kpi'); ?>" class="current"><?php echo $page_title; ?></a>
        </div>
        <h1><?php echo $page_title; ?></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <?php
                if ($this->session->flashdata('message')) {
                ?>
                    <p class="alert alert-success"><?php echo $this->session->flashdata('message'); ?></p>
                <?php
                }
                ?>

                <?php

                $message = $this->session->userdata('message');
                if (isset($message) && !empty($message)) {
                    echo '<div class="alert alert-success" align="center">';
                    echo '<h5>' . $message . '</h5>';
                    echo '</div>';
                    $this->session->unset_userdata('message');
                }
                ?>
                <div class="widget-box" style="overflow-x: auto">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5><?php echo $page_title; ?></h5>
                        <a href="<?php echo base_url(); ?>kpi/kpiconfigAdd" id="btncurrent" class="btn btn-success" style=" float: right;">Add New</a>

                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table" id="report_data">
                            <thead>
                                <tr>
                                    <th>KPI Code</th>
                                    <th>Value Driver Code</th>
                                    <th>Sub Driver Code</th>
                                    <th>KPI Name</th>
                                    <th>Description</th>
                                    <th>Formula</th>
                                    <th>SOURCE</th>
                                    <!-- <th>ChartType</th> -->
                                    <th>Status</th>
                                    <th>Nature</th>
                                    <th>Responsible</th>
                                    <th>FLAG</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //print_r($rows);exit();
                                foreach ($rows as $row) {

                                ?>
                                    <tr class="gradeX">
                                        <td style="text-align: center;"><?php echo $row['KPICode']; ?></td>
                                        <td style="text-align: center;"><?php echo $row['ValueDriver']; ?></td>
                                        <td style="text-align: center;"><?php echo $row['SubValueDriver']; ?></td>
                                        <td style="text-align: center;"><?php echo $row['KPIName']; ?></td>
                                        <td style="text-align: center;"><?php echo $row['Description']; ?></td>
                                        <td style="text-align: center;"><?php echo $row['Formula']; ?></td>
                                        <td style="text-align: center;"><?php echo $row['SOURCE']; ?></td>
                                        <!-- <td style="text-align: center;"><?php //echo $row['ChartType']; 
                                                                                ?></td> -->
                                        <td style="text-align: center;"><?php echo $row['active'] == 'Y' ? 'Active' : 'Inactive'; ?></td>
                                        <td style="text-align: center;"><?php echo $row['Nature'] == 1 ? 'Positive' : 'Negative'; ?></td>
                                        
                                        <td style="text-align: center;"><button class="btn btn-info" id="responsible" onclick="setResponsibleModalData(<?php echo $row['KPICode']; ?>)" data-toggle="modal" data-target="#responsibleModal">Responsible</button></td>
                                        <td style="text-align: center;"><?php echo isset($row['StaffID']) ? "<span class='badge badge-success'>Person Added</span>": ""; ?></td>
                                        <td style="text-align: center;"><a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>kpi/kpiconfigEdit/<?php echo $row['KPICode']; ?>">Edit</a></td>
                                        <td style="text-align: center;">
                                            <a onclick="return confirm_submit()" class="btn btn-danger btn-sm" href="<?php echo base_url();?>kpi/delete/<?php echo $row['ValueDriverCode']; ?>/<?php echo $row['KPICode']; ?>">Delete</a></td>
                                        <!--<td><a class="btn blue" href="<?php //echo base_url();
                                                                            ?>business/AreaView/<?php //echo $row['Business'];
                                                                                                                        ?>">View</a></td>-->
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="responsibleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Responsible Person</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('kpi/addResponsiblePerson');?>" method="POST" id="responsibleForm">
                            <input type="hidden" name="modalKpiCode" id="modalKpiCode">
                            <div class="control-group">
                                <label class="control-label">Staff ID :</label>
                                <div class="controls">
                                    <input id="StaffID" type="text" name="StaffID" value="" class="form-control span5" placeholder="Staff ID" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Emp Name :</label>
                                <div class="controls">
                                    <input id="EmpName" type="text" name="EmpName" value="" class="form-control span5" placeholder="Emp Name" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Designation :</label>
                                <div class="controls">
                                    <input id="Designation" type="text" name="Designation" value="" class="form-control span5" placeholder="Designation" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email :</label>
                                <div class="controls">
                                    <input id="Email" type="email" name="Email" value="" class="form-control span5" placeholder="Email" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Phone :</label>
                                <div class="controls">
                                    <input id="Phone" type="text" name="Phone" value="" class="form-control span5" placeholder="Phone" required />
                                </div>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function setResponsibleModalData(kpiCode){
        console.log(kpiCode);
        $('#modalKpiCode').val(kpiCode);

        $.ajax({
            url: '<?php echo base_url('kpi/getKpiResponsiblePersonValue')?>',
            type: 'POST',
            data: {kpiCode: kpiCode},
            dataType:'json',
            success: function(response){
                console.log(response);
                if(Object.keys(response).length > 0){
                    console.log('hi');
                    $('#responsibleForm').attr('action', '<?php echo base_url() ?>kpi/updateResponsiblePerson');
                }else{
                    $('#responsibleForm').attr('action', '<?php echo base_url() ?>kpi/addResponsiblePerson');
                }
                $('#StaffID').val(response.StaffID);
                $('#EmpName').val(response.EmpName);
                $('#Designation').val(response.Designation);
                $('#Email').val(response.Email);
                $('#Phone').val(response.Phone);
            }
        });
    }
</script>

<script>
    //         $('#btncurrent').click(function(){

    //        $('#report_data').table2excel({

    //            exclude: ".noExl",

    //            name: "CVsummary",

    //            filename: "Quiz Export "

    //        });

    //    });
</script>