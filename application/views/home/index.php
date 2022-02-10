<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3 class="h3 mb-0 text-gray-800">The Overview Summary by Period</h3>

    <form class="form-inline" action="#" autocomplete="off" method="POST">
        <div class="input-group mr-1">
            <input type="text" name="fromDate" id="fromDate" class="form-control date-picker" readonly>
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar-alt mr-1"></i> To <i class="fas fa-calendar-alt ml-1"></i></span>
            </div>
            <input type="text" name="toDate" id="toDate" class="form-control date-picker" readonly>
        </div>
        <button type="button" class="btn btn-success" onclick="ExecuteFunctions();"><i class="fas fa-sync-alt"></i> Process</button>
    </form>
</div>

<div id="print-doc">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-uppercase">by patient groups</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Full-time employees</div>
                                            <div class="h6 mb-0 font-weight-bold text-success">
                                                <a href="#" class="text-secondary">Total (<span id="full-emp"></span>)</a>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-layer-group fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Daily Employees</div>
                                            <div class="h6 mb-0 font-weight-bold text-info">
                                                <a href="#" class="text-secondary">Total (<span id="daily-emp"></span>)</a>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-layer-group fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Customers</div>
                                            <div class="h6 mb-0 font-weight-bold text-warning">
                                                <a href="#" class="text-secondary">Total (<span id="customer"></span>)</a>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-layer-group fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row overflow-auto">
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-uppercase">by genders</h6>
                    <i class="fas fa-restroom fa-2x text-primary"></i>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-uppercase">by departments</h6>
                    <i class="fas fa-building fa-2x text-primary"></i>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="pieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small" id="pieChartLabel">
                        <!-- dynamic dat -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(function() {
            var currDate = moment().format("YYYY-MM-DD");

            $('#toDate').val(currDate);
            $('#fromDate').val(currDate);

            ExecuteFunctions();
        });

        $(function() {
            $('.date-picker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            })
        });
    });

    function ExecuteFunctions() {
        ByPatientGroup();
        ByDept();
        ByGender();
    }

    function ByPatientGroup() {
        var formData = $('form').serialize();

        $.ajax({
            type: 'POST',
            url: "<?= site_url('ReportController/FetchAllSummary') ?>",
            data: formData
        }).done(function(data) {
            $('#full-emp').text(data.bygroup.FullTimeTotal);
            $('#daily-emp').text(data.bygroup.DailyTotal);
            $('#customer').text(data.bygroup.CustTotal);
        });

        return false;
    }


    //================================================ Begin doughnut chart control ======================================//
    function ByDept() {
        var formData = $('form').serialize();

        $.ajax({
            type: 'POST',
            url: "<?= site_url('ReportController/FetchAllSummary') ?>",
            data: formData
        }).done(function(data) {
            var labelArray = new Array();
            var dataArray = new Array();
            var bgArray = new Array();
            var hoverArray = new Array();
            var labels = '';

            $.each(data.bydept, function(index, value) {
                labelArray.push(value.DeptCode);
                dataArray.push(value.Total);
                bgArray.push(value.DeptBgColor);
                hoverArray.push(value.DeptHoverColor);
                labels += ' <span class="mr-2"><i class="fas fa-circle ' + value.DeptTextColor + ' "></i> ' + value.DeptCode + ' | ';
            });

            PieChart(labelArray, dataArray, bgArray, hoverArray);

            $('#pieChartLabel').html(labels);
        });

        return false;
    }

    function PieChart(labelArray, dataArray, bgArray, hoverArray) {
        var ctx = document.getElementById("pieChart");
        var pieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labelArray,
                datasets: [{
                    data: dataArray,
                    backgroundColor: bgArray,
                    hoverBackgroundColor: hoverArray,
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255, 255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    }
    //================================================ end ======================================//


    //================================================ Begin area chart control ======================================//
    function ByGender() {
        var formData = $('form').serialize();

        $.ajax({
            type: 'POST',
            url: "<?= site_url('ReportController/FetchAllSummary') ?>",
            data: formData
        }).done(function(data) {
            var dataArray = new Array();

            $.each(data.bygender, function(index, value) {
                dataArray.push(value);
            });

            BarChart(dataArray);
        });

        return false;
    }

    function BarChart(dataArray) {
        var ctx = document.getElementById("barChart");
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Female', 'Male'],
                datasets: [{
                    label: "Total ",
                    backgroundColor: ['#A569BD', '#4e73df'],
                    hoverBackgroundColor: ['#8E44AD', '#2e59d9'],
                    borderColor: "#4e73df",
                    data: dataArray,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        },
                        maxBarThickness: 25,
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: Math.max(...dataArray) + 10,
                            maxTicksLimit: 5,
                            padding: 10,
                            callback: function(value, index, values) {
                                return number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + number_format(tooltipItem.yLabel);
                        }
                    }
                },
            }
        });
    }
    //================================================ end ======================================//
</script>