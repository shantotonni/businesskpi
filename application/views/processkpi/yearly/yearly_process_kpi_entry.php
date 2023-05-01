<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/yearpicker.css" />

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="<?php echo base_url(); ?>" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home</a> <a href="<?php echo base_url('processkpi/processkpientry'); ?>" class="current"><?php echo $page_title; ?></a> </div>
        <h1><?php echo $page_title; ?></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5><?php echo $page_title; ?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <?php
                        $message = $this->session->userdata('message');
                        if (isset($message)) {
                            echo '<p style="color: darkgreen;text-align: center;padding: 10px;font-weight: 600;font-size: 30px;">' . $message . '</p>';
                            $this->session->unset_userdata('message');
                        }
                        ?>
                        <form action="<?php echo base_url('processkpi/processYearlyKpiEntrySave'); ?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Cluster :</label>
                                <div class="controls">
                                    <select name="valuedriver" id="valuedriver" required>
                                        <option value="">Select One</option>
                                        <?php
                                        if (isset($allvaluedriver) && !empty($allvaluedriver)) {
                                            foreach ($allvaluedriver as $valueDriver) {
                                        ?>
                                                <option value="<?= $valueDriver['ValueDriverCode']; ?>"><?= $valueDriver['ValueDriver']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Sub Cluster :</label>
                                <div class="controls">
                                    <select name="subvaluedriver" id="subvaluedriver" required>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">KPI :</label>
                                <div class="controls">
                                    <select name="kpi" id="kpi" required></select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Business :</label>
                                <div class="controls">
                                    <select name="Business" id="Business" required></select>
                                </div>
                            </div>
                            <?php $years = range(2023, strftime("%Y", time())); ?>
                            <div class="control-group">
                                <label class="control-label">Year :</label>
                                <div class="controls">
                                    <select name="year" id="year" required>
<!--                                        <option>Select Year</option>-->
<!--                                        --><?php //foreach($years as $year) : ?>
<!--                                            <option value="--><?php //echo $year; ?><!--">--><?php //echo $year; ?><!--</option>-->
<!--                                        --><?php //endforeach; ?>
                                        <option value="2022-23">2022-2023</option>
                                        <option value="2023-24">2023-2024</option>
                                    </select>
                                </div>

<!--                                <div class="controls">-->
<!--                                    <input type="year" name="year" id="year" class="yearpicker">-->
<!--                                </div>-->
                            </div>

                            <div class="control-group">
                                <div class="">
                                    <table class="table table-bordered" id="tableinsert">
                                        <thead>
                                            <tr>
                                                <th class="span3">Component</th>
<!--                                                <th class="span3">Business</th>-->
                                                <th>Month</th>
                                                <th>Value</th>
<!--                                                <th>LM</th>-->
                                                <th>SPLY (Same Period Last Year)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablebody">

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls text-center">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/yearpicker.js"></script>
<script>
    // $('.yearpicker').yearpicker()
    // $("#year").datepicker({ dateFormat: 'yy' });

    $(document).ready(function (){
        $.ajax({
            url: '<?php echo base_url('processkpi/getAllKpiBusiness') ?>',
            type: 'get',
            success: function(data) {
                var response = JSON.parse(data);
                var contentBusiness = '';
                if (response.Business_rows) {
                    // contentBusiness += '<option value="">Select One</option>';
                    for (var j = 0; j < response.Business_rows.length; j++) {
                        contentBusiness += '<option value="' + response.Business_rows[j].Business + '">' + response.Business_rows[j].Business + '</option>'
                    }
                }
                $('#Business').html(contentBusiness);
            }
        });
    });

    $('#valuedriver').change(function() {
        var ValueDriverCode = $(this).val();
        $.ajax({
            url: '<?php echo base_url('processkpi/getSubValueDriver') ?>',
            type: 'POST',
            data: 'ValueDriverCode=' + ValueDriverCode,
            success: function(data) {
                var response = JSON.parse(data);
                var content = '';
                if (data) {
                    content += '<option value="">Select One</option>';
                    for (var i = 0; i < response.length; i++) {
                        content += '<option value="' + response[i].SubValueDriverCode + '">' + response[i].SubValueDriver + '</option>';
                    }
                }
                $('#subvaluedriver').html(content);
            }
        });
    });

    $('#subvaluedriver').change(function() {
        var SubValueDriverCode = $(this).val();
        $.ajax({
            url: '<?php echo base_url('processkpi/getKpi') ?>',
            type: 'POST',
            data: 'SubValueDriverCode=' + SubValueDriverCode,
            success: function(data) {
                console.log(data)
                var response = JSON.parse(data);
                var content = '';
                if (data) {
                    content += '<option value="">Select One</option>';
                    for (var i = 0; i < response.length; i++) {
                        content += '<option value="' + response[i].KPICode + '">' + response[i].KPIName + '</option>';
                    }
                }
                $('#kpi').html(content);
            }
        });
    });

    $('#kpi').change(function (){
        var kpicode = $('#kpi').val();
        var year = $('#year').val();
        var Business = $('#Business').val();
        if (year){
            $.ajax({
                url: '<?php echo base_url('processkpi/getAllKpiComponent') ?>',
                type: 'POST',
                data: {kpicode:kpicode, year:year, Business: Business},
                success: function(data) {
                    console.log(data)
                    var response = JSON.parse(data);
                    $("#tablebody").html(response.string)
                }
            });
        }
    })

    $('#Business').change(function (){
        var kpicode = $('#kpi').val();
        var year = $('#year').val();
        var Business = $('#Business').val();
        if (year){
            $.ajax({
                url: '<?php echo base_url('processkpi/getAllKpiComponent') ?>',
                type: 'POST',
                data: {kpicode:kpicode, year:year, Business: Business},
                success: function(data) {
                    var response = JSON.parse(data);
                    $("#tablebody").html(response.string)
                }
            });
        }
    })

    $('#year').on('change',function (){
        var kpicode = $('#kpi').val();
        var year = $(this).val();
        var Business = $('#Business').val();
        $.ajax({
            url: '<?php echo base_url('processkpi/getAllKpiComponent') ?>',
            type: 'POST',
            data: {kpicode:kpicode, year:year, Business: Business},
            success: function(data) {
                var response = JSON.parse(data);
                $("#tablebody").html(response.string)
            }
        });
    })

</script>