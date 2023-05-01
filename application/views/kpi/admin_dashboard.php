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
<style>
    .widget-content {
        max-height: 50em;
        overflow: scroll;
        position: relative;
    }

    table {
        position: relative;
        border-collapse: collapse;
    }

    td,
    th {
        padding: 0.25em;
    }

    thead th {
        position: -webkit-sticky; /* for Safari */
        position: sticky;
        top: 0;
        background: #000;
        color: #FFF;
    }

    thead th:first-child {
        left: 0;
        z-index: 1;
    }

    tbody th {
        position: -webkit-sticky; /* for Safari */
        position: sticky;
        left: 0;
        background: #FFF;
        border-right: 1px solid #CCC;
    }

</style>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="<?php echo base_url(); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="<?php echo base_url('kpi'); ?>" class="current"><?php echo $page_title; ?></a>
        </div>
<!--        <h1 style="text-align: center">--><?php //echo $page_title; ?><!--</h1>-->
    </div>
    <div class="container-fluid" style="background: #aab1bb;margin: 7px 7px">
        <p style="font-size: 17px;margin: 10px 4px 8px 0px;color: white">Individual KPI Performance</p>
         <form action="<?php echo base_url('kpi/adminDashboard'); ?>" method="post">
          <div style="display: flex">
              <div>
                  <p style="font-size: 14px;color: white;margin-bottom: 0;">Business</p>
                  <select name="Business" id="" required>
                      <option value="all">Select All</option>
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
                  <p style="font-size: 14px;color: white;margin-bottom: 0;">Cluster</p>
                  <select name="valuedriver" id="valuedriver">
                      <option value="">Select Cluster</option>
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
              <div>
                  <p style="font-size: 14px;color: white;margin-bottom: 0;">Sub Cluster</p>
                  <select name="subvaluedriver" id="subvaluedriver"></select>
              </div>
              <div style="padding-top: 20px;margin-left: 10px">
                  <button type="submit" class="btn btn-success">Submit</button>
                  <button type="submit" class="btn btn-success" value="export" name="export">Export</button>
              </div>
          </div>
        </form>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table" id="report_data">
                            <thead>
                            <tr>
                                <th>BusinessName</th>
                                <th>Value Driver Code</th>
                                <th>Sub Driver Code</th>
                                <th>KPI Name</th>
<!--                                <th>d1</th>-->
<!--                                <th>d2</th>-->
<!--                                <th>d3</th>-->
<!--                                <th>d4</th>-->
<!--                                <th>d5</th>-->
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
                            <tbody>
                            <?php
                            foreach ($first as $key => $row) {
                                ?>
                                <tr class="gradeX">
                                    <td><?php echo $row['BusinessName']; ?></td>
                                    <td><?php echo $row['ValueDriver']; ?></td>
                                    <td><?php echo $row['SubValueDriver']; ?></td>
                                    <td><?php echo $row['KPIName']; ?></td>
<!--                                    <td style="text-align: right;--><?php //if ($row['d1'] < 0){ echo 'background:red;color:white';}elseif ($row['d1']==0){echo 'background:yellow;color:black';}else{echo 'background:green;color:white';} ?><!--">--><?php //echo number_format($row['d1'], 2); ?><!--</td>-->
<!--                                    <td style="text-align: right;--><?php //if ($row['d2'] < 0){ echo 'background:red;color:white';}elseif ($row['d2']==0){echo 'background:yellow;color:black';}else{echo 'background:green;color:white';} ?><!--">--><?php //echo number_format($row['d2'], 2); ?><!--</td>-->
<!--                                    <td style="text-align: right;--><?php //if ($row['d3'] < 0){ echo 'background:red;color:white';}elseif ($row['d3']==0){echo 'background:yellow;color:black';}else{echo 'background:green;color:white';} ?><!--">--><?php //echo number_format($row['d3'], 2); ?><!--</td>-->
<!--                                    <td style="text-align: right;--><?php //if ($row['d4'] < 0){ echo 'background:red;color:white';}elseif ($row['d4']==0){echo 'background:yellow;color:black';}else{echo 'background:green;color:white';} ?><!--">--><?php //echo number_format($row['d4'], 2); ?><!--</td>-->
<!--                                    <td style="text-align: right;--><?php //if ($row['d5'] < 0){ echo 'background:red;color:white';}elseif ($row['d5']==0){echo 'background:yellow;color:black';}else{echo 'background:green;color:white';} ?><!--">--><?php //echo number_format($row['d5'], 2); ?><!--</td>-->
                                    <td style="text-align: right;<?php if ($row['1P'] < 0){ echo 'background:red;color:white';}elseif ($row['1P']==0){echo 'background:yellow;color:black';}else{echo 'background:green;color:white';} ?>"><?php echo number_format($row['1P'], 2); ?></td>
                                    <td style="text-align: right;<?php if ($row['2P'] < 0){ echo 'background:red;color:white';}elseif ($row['2P']==0){echo 'background:yellow;color:black';}else{echo 'background:green;color:white';} ?>"><?php echo number_format($row['2P'], 2); ?></td>
                                    <td style="text-align: right;<?php if ($row['3P'] < 0){ echo 'background:red;color:white';}elseif ($row['3P']==0){echo 'background:yellow;color:black';}else{echo 'background:green;color:white';} ?>"><?php echo number_format($row['3P'], 2); ?></td>
                                    <td style="text-align: right;<?php if ($row['4P'] < 0){ echo 'background:red;color:white';}elseif ($row['4P']==0){echo 'background:yellow;color:black';}else{echo 'background:green;color:white';} ?>"><?php echo number_format($row['4P'], 2); ?></td>
                                    <td style="text-align: right;<?php if ($row['5P'] < 0){ echo 'background:red;color:white';}elseif ($row['5P']==0){echo 'background:yellow;color:black';}else{echo 'background:green;color:white';} ?>"><?php echo number_format($row['5P'], 2); ?></td>
                                    <td style="text-align: right;<?php if ($row['6P'] < 0){ echo 'background:red;color:white';}elseif ($row['6P']==0){echo 'background:yellow;color:black';}else{echo 'background:green;color:white';} ?>"><?php echo number_format($row['6P'], 2); ?></td>
                                    <td style="text-align: right;"><?php echo number_format($row['Score'], 2); ?></td>

                                    <td style="text-align: center;">
                                        <div id="container<?php echo $key; ?>"  style="width: 200px; height: 20px;"></div>
                                    </td>
                                </tr>

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
                                </style>

                                <script>
                                    var stage = anychart.graphics.create("container<?php echo $key; ?>");

                                    chart1 = anychart.sparkline();
                                    chart1.seriesType("line");

                                    chart1.data([0,<?php echo $row['1P']; ?>,<?php echo $row['2P']; ?>,<?php echo $row['3P']; ?>,<?php echo $row['4P']; ?>,<?php echo $row['5P']; ?>,<?php echo $row['6P']; ?>]);

                                    chart1.bounds(0, 0, 200, 20);
                                    chart1.maxMarkers(true).minMarkers(true);

                                    chart1.container(stage);

                                    chart1.draw();
                                </script>

                                <?php
                            }
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
                    content += '<option value="">Select Sub Cluster</option>';
                    for (var i = 0; i < response.length; i++) {
                        content += '<option value="' + response[i].SubValueDriver + '">' + response[i].SubValueDriver + '</option>';
                    }
                }
                $('#subvaluedriver').html(content);
            }
        });
    });

</script>