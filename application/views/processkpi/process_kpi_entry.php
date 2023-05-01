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
                            echo '<p style="color: darkgreen;text-align: center;padding: 10px;font-weight: 600;">' . $message . '</p>';
                            $this->session->unset_userdata('message');
                        }
                        ?>
                        <form action="<?php echo base_url('processkpi/processKpiEntrySave'); ?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Value Driver :</label>
                                <div class="controls">
                                    <select name="valuedriver" id="valuedriver">
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
                                <label class="control-label">Sub Value Driver :</label>
                                <div class="controls">
                                    <select name="subvaluedriver" id="subvaluedriver">
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">KPI :</label>
                                <div class="controls">
                                    <select name="kpi" id="kpi"></select>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="">
                                    <table class="table table-bordered" id="tableinsert">
                                        <thead>
                                            <tr>
                                                <th class="span3">Component</th>
                                                <th class="span3">Business</th>
                                                <th>Month</th>
                                                <th>Value</th>
                                                <th>LM</th>
                                                <th>SPLY</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablebody">
                                            <tr id="rowToClone" class="processkpi">
                                                <td>
                                                    <?php echo $input1 = '<select class="span10 component" name="component[]" id="component" onchange="findData(this);" required></select>'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input2 = '<select class="span10 business" name="business[]" id="business" onchange="findData(this);" required></select>'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input3 = '<input type="month" name="month[]" class="span10 month" id="month" onchange="findData(this);" required>'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input4 = '<input type="text" class="span15 value" name="value[]" id="value" value="" required>'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input5 = '<input type="text" class="span15 lm" name="lm[]" id="lm" value="" required>'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $input6 = '<input type="text" class="span15 sply" name="sply[]" id="sply" value="" required>'; ?>
                                                </td>
                                                <td><a class="btn btn-primary" onclick="insertrow(this)">Add</a>
                                                    <?php $input7 = '<a onclick="deleterow(this)" class="btn btn-warning">Remove</a>'; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <script>
                                        $("input[name='Returnable']").click(function() {
                                            $('#show-me').css('display', ($(this).val() === 'Y') ? 'block' : 'none');
                                        });

                                        function insertrow(r) {
                                            var table = document.getElementById("tableinsert");
                                            str = table.rows.length;
                                            var row = table.insertRow();
                                            // console.log(r);

                                            var cell1 = row.insertCell(0);
                                            var cell2 = row.insertCell(1);
                                            var cell3 = row.insertCell(2);
                                            var cell4 = row.insertCell(3);
                                            var cell5 = row.insertCell(4);
                                            var cell6 = row.insertCell(5);
                                            var cell7 = row.insertCell(6);

                                            var input1 = document.getElementById("component").innerHTML;
                                            var input2 = document.getElementById("business").innerHTML;

                                            cell1.innerHTML = '<select class="span10 component" name="component[]" id="component" onchange="findData(this);" required>' + input1 + '</select>';
                                            cell2.innerHTML = '<select class="span10 business" name="business[]" id="business" onchange="findData(this);" required>' + input2 + '</select>';
                                            cell3.innerHTML = '<?php echo $input3; ?>';
                                            cell4.innerHTML = '<?php echo $input4; ?>';
                                            cell5.innerHTML = '<?php echo $input5; ?>';
                                            cell6.innerHTML = '<?php echo $input6; ?>';
                                            cell7.innerHTML = '<?php echo $input7; ?>';

                                            // console.log(input1);
                                        }

                                        function deleterow(r) {
                                            var i = r.parentNode.parentNode.rowIndex;
                                            document.getElementById("tableinsert").deleteRow(i);
                                        }
                                    </script>
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

<script>
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

    $('#kpi').change(function() {
        var kpicode = $(this).val();
        $.ajax({
            url: '<?php echo base_url('processkpi/getKpiComponent') ?>',
            type: 'POST',
            data: 'kpicode=' + kpicode,
            success: function(data) {
                var response = JSON.parse(data);

                var contentKpiComponent = '';
                var contentBusiness = '';
                if (response.kpicomponent) {
                    contentKpiComponent += '<option value="">Select One</option>';
                    for (var i = 0; i < response.kpicomponent.length; i++) {
                        contentKpiComponent += '<option value="' + response.kpicomponent[i].ComponentCode + '">' + response.kpicomponent[i].Title + '</option>';
                    }
                }
                $('#component').html(contentKpiComponent);

                if (response.Business_rows) {
                    contentBusiness += '<option value="">Select One</option>';
                    for (var j = 0; j < response.Business_rows.length; j++) {
                        contentBusiness += '<option value="' + response.Business_rows[j].Business + '">' + response.Business_rows[j].Business + '</option>'
                    }
                }
                $('#business').html(contentBusiness);
            }
        });
    });



    function findData(obj) {
        var currentRow = $(obj).closest('tr');
        var kpicode = $('#kpi').val();
        var componentCode = currentRow.find('.component').val();
        var business = currentRow.find('.business').val();
        var monthString = currentRow.find('.month').val();
        var month = monthString.replace(/-/g, "");
        // console.log(componentCode);

        // console.log(kpicode+'-'+componentCode+'-'+business+'-'+month);
        if (kpicode != '' && componentCode != '' && business != '' && month != '') {
            $.ajax({
                url: '<?php echo base_url('processkpi/getKpiValueIfExists') ?>',
                type: 'POST',
                data: {
                    KPICode: kpicode,
                    ComponentCode: componentCode,
                    Business: business,
                    Month: month
                },
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.success == 1) {
                        // console.log(response.result);
                        currentRow.find('.value').val(response.result[0].Value);
                        currentRow.find('.lm').val(response.result[0].LM);
                        currentRow.find('.sply').val(response.result[0].SPLY);
                    } else {
                        currentRow.find('.value').val('');
                        currentRow.find('.lm').val('');
                        currentRow.find('.sply').val('');
                    }
                }
            });
        }
    }
</script>