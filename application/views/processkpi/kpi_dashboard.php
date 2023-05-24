<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>KPI Report</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>kpiprocess/assets/css/bootstrap.min.css"
          crossorigin="anonymous">
    <script src="<?php echo base_url(); ?>kpiprocess/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body style="background-color: #e9e9e9">
<div class="container-fluid">
    <div class="row">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <table class="table table-bordered table-hover  table-striped">
                        <tr>
                            <th class="bold">
                                KPI Dashboard
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">&nbsp;</div>
            </div>
            <form method="post">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <select class="form-control" id="business" name="business">
                                <option value="">Select </option>
                                <?php
                                $count = 0;
                                foreach ($business as $Bu):
                                    $count++;
                                    if ($count == 1) {
                                        $selected = ' selected ';
                                        $businessname = $Bu['BusinessName'];
                                    } else {
                                        $selected = ' ';
                                    }
                                    echo '<option ' . $selected . ' value="' . $Bu['BusinessName'] . '">' . $Bu['BusinessName'] . '</option>';
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <button id="submit_data" type="button" class="btn btn-success">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="co1-md-6" style="background: white;padding: 10px;">
                    <div id="chartReport">

                    </div>
                </div>
                <div class="co1-md-6" style="background: white;padding: 10px;margin-left: 10px">
                    <div id="chartReport2">

                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 15px">
                <div style="padding-top: 10px"></div>
                <div class="co1-md-6" style="background: white;padding: 10px;;margin-bottom: 20px">
                    <div id="chartReport3">

                    </div>
                </div>
                <div class="co1-md-6" style="background: white;padding: 10px;margin-left: 10px;margin-bottom: 20px">
                    <div id="chartReport4">

                    </div>
                </div>
            </div>

            <div class="row" style="padding-top: 15px">
                <div style="padding-top: 10px"></div>
                <div class="co1-md-6" style="background: white;padding: 10px;;margin-bottom: 20px">
                    <div id="chartReport5">

                    </div>
                </div>

                <div class="co1-md-6" style="background: white;padding: 10px;margin-left: 10px;margin-bottom: 20px">
                    <div id="chartReport6">

                    </div>
                </div>
            </div>

            <div class="row" style="padding-top: 15px">
                <div style="padding-top: 10px"></div>
                <div class="co1-md-6" style="background: white;padding: 10px;;margin-bottom: 20px">
                    <div id="chartReport7">

                    </div>
                </div>

<!--                <div class="co1-md-6" style="background: white;padding: 10px;margin-left: 10px;margin-bottom: 20px">-->
<!--                    <div id="chartReport7">-->
<!---->
<!--                    </div>-->
<!--                </div>-->
            </div>

        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.2/dist/echarts.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            url: '<?php echo base_url('processkpi/getAllKpiDashboardDate') ?>',
            type: 'GET',
            success: function (data) {
                let response = JSON.parse(data);
                //chartOne(response);
               // chartTwo(response);
                //chartThree(response);
                //chartFour(response);
                //chartFive(response);
                //chartSix(response);
                chartSeven(response);
            }
        });

        $('#submit_data').on('click',function (){
            let business = $('#business').val();
            $.ajax({
                url: '<?php echo base_url('processkpi/filterKpiDashboardDate') ?>',
                type: 'POST',
                data:{business: business},
                success: function (data) {
                    let response = JSON.parse(data);
                    chartOne(response);
                    chartTwo(response);
                    chartThree(response);
                    chartFour(response);
                    chartFive(response);
                    chartSix(response);
                }
            });
        })

        function chartOne(response) {
            document.querySelector("#chartReport").innerHTML = '<canvas style="height: 500px;width: 900px" id="myChart"></canvas>';
            //Start chart one
            let recordOne = response.record_one;
            let kpi_title = response.kpi_title;

            let chart_one_labels = [];
            let chart_one_values = {};
            let chart_one_keys = [];
            recordOne.forEach((getRecord, index) => {
                chart_one_labels.push(getRecord.Period);
                if (index == 0) {
                    chart_one_keys = Object.keys(getRecord)
                    chart_one_keys.forEach((key) => {
                        if (key != 'Period')
                            chart_one_values[key] = []
                    })
                }
                chart_one_keys.forEach((key) => {
                    if (key != 'Period')
                        chart_one_values[key].push(getRecord[key])
                })
            })

            let chart_one_records = [];
            let chart_one_color = ''
            chart_one_keys.forEach((key, index) => {
                if (index !== 0) {
                    chart_one_color = Math.floor(Math.random() * 16777215).toString(16)
                    let final_label = kpi_title.find((item) => {
                        return key === item.KPICode
                    })
                    chart_one_records.push({
                        label: final_label.KPIName,
                        data: chart_one_values[key],
                        backgroundColor: '#' + chart_one_color,
                        borderColor: '#' + chart_one_color,
                        borderWidth: 1
                    })
                }
            })
            // let kpi_title_key = Object.keys(kpi_title)
            //console.log(commonElements(kpi_title_key, chart_one_keys));
            //console.log(chart_one_keys)
            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chart_one_labels,
                    datasets: chart_one_records
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    size: 10
                                }
                            }
                        }
                    },
                    responsive: false
                }
            });
        }

        function chartTwo(response) {
            //Start chart two
            document.querySelector("#chartReport2").innerHTML = '<canvas style="height: 500px;width: 900px" id="myChart2"></canvas>';
            let recordTwo = response.record_two;
            let kpi_title = response.kpi_title;

            let chart_two_labels = [];
            let chart_two_values = {};
            let chart_two_keys = [];
            recordTwo.forEach((getRecord, index) => {
                chart_two_labels.push(getRecord.Period);
                if (index == 0) {
                    chart_two_keys = Object.keys(getRecord)
                    chart_two_keys.forEach((key) => {
                        if (key != 'Period')
                            chart_two_values[key] = []
                    })
                }
                chart_two_keys.forEach((key) => {
                    if (key != 'Period')
                        chart_two_values[key].push(getRecord[key])
                })
            })

            let chart_two_records = [];
            let chart_two_color = ''
            chart_two_keys.forEach((key, index) => {
                if (index !== 0) {
                    chart_two_color = Math.floor(Math.random() * 16777215).toString(16)
                    let final_label = kpi_title.find((item) => {
                        return key === item.KPICode
                    })
                    chart_two_records.push({
                        label: final_label.KPIName,
                        data: chart_two_values[key],
                        backgroundColor: '#' + chart_two_color,
                        borderColor: '#' + chart_two_color,
                        borderWidth: 1
                    })
                }
            })
            var ctx2 = document.getElementById('myChart2');
            var myChart2 = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: chart_two_labels,
                    datasets: chart_two_records
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: false
                }
            });

            //End chart two
        }

        function chartThree(response) {
            document.querySelector("#chartReport3").innerHTML = '<canvas style="height: 500px;width: 900px" id="myChart3"></canvas>';
            //Start chart Three
            let recordThree = response.record_three;
            let kpi_title = response.kpi_title;

            let chart_three_labels = [];
            let chart_three_values = {};
            let chart_three_keys = [];

            recordThree.forEach((getRecord, index) => {
                chart_three_labels.push(getRecord.Period);
                if (index == 0) {
                    chart_three_keys = Object.keys(getRecord)
                    chart_three_keys.forEach((key) => {
                        if (key != 'Period')
                            chart_three_values[key] = []
                    })
                }
                chart_three_keys.forEach((key) => {
                    if (key != 'Period')
                        chart_three_values[key].push(getRecord[key])
                })
            })

            let chart_three_records = [];
            let chart_three_color = ''
            let chartType = ''
            let final_label = []
            console.log(chart_three_keys)

            let barCount = 0, lineCount = 0, find = {};
            chart_three_keys.forEach((key) => {
                find = kpi_title.find((item) => {
                    return key === item.KPICode
                })
                if (find) {
                    if (find.ChartType === 'Line') lineCount++
                    else barCount++
                }

            })


            let lineIndex = 0, barIndex = lineCount;
            chart_three_keys.forEach((key, index) => {
                if (index !== 0) {
                    chart_three_color = Math.floor(Math.random() * 16777215).toString(16)
                    final_label = kpi_title.find((item) => {
                        return key === item.KPICode
                    })

                    chart_three_records.push(
                        {
                            label: final_label.KPIName,
                            type: (final_label.ChartType).toLowerCase(),
                            data: chart_three_values[key],
                            backgroundColor: '#' + chart_three_color,
                            borderColor: '#' + chart_three_color,
                            borderWidth: 1,
                            yAxisID: (final_label.ChartType).toLowerCase() === 'bar' ? 'y1' : 'y',
                            order: (final_label.ChartType).toLowerCase() === 'bar' ?barIndex ++: lineIndex++
                        }
                    )
                }
            })
            var ctx3 = document.getElementById('myChart3');
            var myChart3 = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: chart_three_labels,
                    datasets: chart_three_records
                },
                options: {
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    responsive: false,
                    stacked: false,
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false,
                            },
                        },
                    }
                },
            });
        }

        function chartFour(response) {
            document.querySelector("#chartReport4").innerHTML = '<canvas style="height: 500px;width: 900px" id="myChart4"></canvas>';
            //Start chart Three
            let recordFour = response.record_four;
            let kpi_title = response.kpi_title;

            let chart_four_labels = [];
            let chart_four_values = {};
            let chart_four_keys = [];
            recordFour.forEach((getRecord, index) => {
                chart_four_labels.push(getRecord.Period);
                if (index == 0) {
                    chart_four_keys = Object.keys(getRecord)
                    chart_four_keys.forEach((key) => {
                        if (key != 'Period')
                            chart_four_values[key] = []
                    })
                }
                chart_four_keys.forEach((key) => {
                    if (key != 'Period')
                        chart_four_values[key].push(getRecord[key])
                })
            })

            let chart_four_records = [];
            let chart_four_color = ''
            chart_four_keys.forEach((key, index) => {
                if (index !== 0) {
                    chart_four_color = Math.floor(Math.random() * 16777215).toString(16)
                    let final_label = kpi_title.find((item) => {
                        return key === item.KPICode
                    })
                    chart_four_records.push({
                        label: final_label.KPIName,
                        data: chart_four_values[key],
                        backgroundColor: '#' + chart_four_color,
                        borderColor: '#' + chart_four_color,
                        borderWidth: 1
                    })
                }
            })
            var ctx4 = document.getElementById('myChart4');
            var myChart4 = new Chart(ctx4, {
                type: 'bar',
                data: {
                    labels: chart_four_labels,
                    datasets: chart_four_records
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: false
                }
            });
        }

        function chartFive(response) {
            document.querySelector("#chartReport5").innerHTML = '<canvas style="height: 500px;width: 900px" id="myChart5"></canvas>';
            //Start chart Three
            let recordFive = response.record_five;
            let kpi_title = response.kpi_title;

            let chart_five_labels = [];
            let chart_five_values = {};
            let chart_five_keys = [];
            recordFive.forEach((getRecord, index) => {
                chart_five_labels.push(getRecord.Period);
                if (index == 0) {
                    chart_five_keys = Object.keys(getRecord)
                    chart_five_keys.forEach((key) => {
                        if (key != 'Period')
                            chart_five_values[key] = []
                    })
                }
                chart_five_keys.forEach((key) => {
                    if (key != 'Period')
                        chart_five_values[key].push(getRecord[key])
                })
            })

            let chart_five_records = [];
            let chart_five_color = ''
            chart_five_keys.forEach((key, index) => {
                if (index !== 0) {
                    chart_five_color = Math.floor(Math.random() * 16777215).toString(16)
                    let final_label = kpi_title.find((item) => {
                        return key === item.KPICode
                    })
                    chart_five_records.push({
                        label: final_label.KPIName,
                        data: chart_five_values[key],
                        backgroundColor: '#' + chart_five_color,
                        borderColor: '#' + chart_five_color,
                        borderWidth: 1
                    })
                }
            })
            var ctx5 = document.getElementById('myChart5');
            var myChart5 = new Chart(ctx5, {
                type: 'bar',
                data: {
                    labels: chart_five_labels,
                    datasets: chart_five_records
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: false
                }
            });
        }

        function chartSix(response){
            document.querySelector("#chartReport6").innerHTML = '<div id="myChart6" style="width: 900px;height:500px;"></div>';
            //Start chart Three
            let recordFive = response.record_five;
            let kpi_title = response.kpi_title;
            console.log(recordFive)

            let chart_five_values = [];

            recordFive.forEach((getRecord, index) => {
                chart_five_values.push(getRecord.U008);
            })

            let max_value = Math.max.apply(Math,chart_five_values);
            let value_index = recordFive[0].U008 / recordFive[1].U008
            console.log(value_index)


            var myChart = echarts.init(document.getElementById('myChart6'));

            // Specify the configuration items and data for the chart
            var option = {
                series: [
                    {
                        min: 0,
                        max: max_value,
                        type: 'gauge',
                        data: [
                            {
                                value: value_index,
                               // name: 'SCORE'
                            }
                        ]
                    }
                ]
            };
            myChart.setOption(option);
        }

        function chartSeven(response) {
            document.querySelector("#chartReport7").innerHTML = '<canvas style="height: 500px;width: 900px" id="myChart7"></canvas>';
            //Start chart Three
            let recordThree = response.record_three;
            let kpi_title = response.kpi_title;

            let chart_three_labels = [];
            let chart_three_values = {};
            let chart_three_keys = [];

            recordThree.forEach((getRecord, index) => {
                chart_three_labels.push(getRecord.Period);
                if (index == 0) {
                    chart_three_keys = Object.keys(getRecord)
                    chart_three_keys.forEach((key) => {
                        if (key != 'Period')
                            chart_three_values[key] = []
                    })
                }
                chart_three_keys.forEach((key) => {
                    if (key != 'Period')
                        chart_three_values[key].push(getRecord[key])
                })
            })

            let chart_three_records = [];
            let chart_three_color = ''
            let chartType = ''
            let final_label = []
            console.log(chart_three_keys)

            let barCount = 0, lineCount = 0, find = {};
            chart_three_keys.forEach((key) => {
                find = kpi_title.find((item) => {
                    return key === item.KPICode
                })
                if (find) {
                    if (find.ChartType === 'Line') lineCount++
                    else barCount++
                }

            })


            let lineIndex = 0, barIndex = lineCount;
            chart_three_keys.forEach((key, index) => {
                if (index !== 0) {
                    chart_three_color = Math.floor(Math.random() * 16777215).toString(16)
                    final_label = kpi_title.find((item) => {
                        return key === item.KPICode
                    })

                    chart_three_records.push(
                        {
                            label: final_label.KPIName,
                            type: (final_label.ChartType).toLowerCase(),
                            data: chart_three_values[key],
                            backgroundColor: '#' + chart_three_color,
                            borderColor: '#' + chart_three_color,
                            borderWidth: 1,
                            yAxisID: (final_label.ChartType).toLowerCase() === 'bar' ? 'y1' : 'y',
                            order: (final_label.ChartType).toLowerCase() === 'bar' ?barIndex ++: lineIndex++
                        }
                    )
                }
            })
            var myChart7 = document.getElementById('myChart7');
            var myChart = new Chart(myChart7, {
                type: 'bar',
                data: {
                    labels: chart_three_labels,
                    datasets: chart_three_records
                },
                options: {
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    responsive: false,
                    stacked: false,
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false,
                            },
                        },
                    }
                },
            });
        }
    });

</script>
</body>
</html>
<style type="text/css">
    .table td, .table th {
        padding: 5px;
        font-size: 12px;
    }
</style>