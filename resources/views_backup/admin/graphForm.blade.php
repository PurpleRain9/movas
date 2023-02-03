@extends('admin.layout')
@section('content')


    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">



        <style>
            /*#Chart{margin-left: -70px; margin-right: 70px;}*/

        </style>
    </head>



    @php
    use Carbon\Carbon;
    $g_from_date = request()->from_date === null ? '' : request()->from_date;
    $g_to_date = request()->to_date === null ? '' : request()->to_date;
    $g_dmy = request()->DMY === null ? '' : request()->DMY;
    $g_chartType = request()->chartType === null ? '' : request()->chartType;
    if (old()) {
        $g_from_date = old('from_date');
        $g_to_date = old('to_date');
    }
    @endphp

    <script>

    </script>

    <body class="antialiased">
        <form action="{{ route('GraphForm') }}" method="get">
            @csrf
            <div class="row">
                <div class="col-md-6 input-group input-daterange">
                    <div class="input-group-addon mx-2 pt-2">From:</div>
                    <!-- <input type="date" name="from_date" class="form-control" autocomplete="off" value="<?php echo date('Y-m-d'); ?>"> -->
                    <input type="date" name="from_date" class="form-control" value="{{ $g_from_date }}"
                        style="width: 10px;">

                    <div class="input-group-addon mx-2 pt-2">to</div>
                    <input type="date" name="to_date" class="form-control" value="{{ $g_to_date }}">
                </div>
                <div class="col-md-2 col-sm-12">
                    <select id="DMY" name="DMY" class="form-control">
                        <option value="">Choose</option>
                        <option value="D" {{ $g_dmy == 'D' ? 'selected' : '' }}>Daily</option>
                        <option value="M" {{ $g_dmy == 'M' ? 'selected' : '' }}>Monthly</option>
                        <option value="Y" {{ $g_dmy == 'Y' ? 'selected' : '' }}>Yearly</option>
                    </select>
                </div>
                <div class="col-md-2 col-sm-12">
                    <select id="chartType" name="chartType" class="form-control">
                        <option value="">Choose</option>
                        <option value="column" {{ $g_chartType == 'column' ? 'selected' : '' }}>Column Chart</option>
                        <option value="bar" {{ $g_chartType == 'bar' ? 'selected' : '' }}>Bar Chart</option>
                        <option value="line" {{ $g_chartType == 'line' ? 'selected' : '' }}>Line Chart</option>
                        <option value="pie" {{ $g_chartType == 'pie' ? 'selected' : '' }}>Pie Chart</option>
                    </select>
                </div>
                <div class="col-md-2 col-sm-12">
                    <button class="btn btn-primary" style="height: 46px;" id="linkid">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        User Registration
                    </div>
                    <div class="card-body pt-4">
                        <div id="approvedProfile" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Applied Case
                    </div>
                    <div class="card-body pt-4">
                        <div id="appliedCase" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Approved Case
                    </div>
                    <div class="card-body pt-4">
                        <div id="approvedCase" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Reject Case
                    </div>
                    <div class="card-body  pt-4">
                        <div id="rejectedCase" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Apply Person
                    </div>
                    <div class="card-body pt-4">
                        <div id="appliedPerson" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Approved Person
                    </div>
                    <div class="card-body pt-4">
                        <div id="approvedPerson" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Applied Person By Type
                    </div>
                    <div class="card-body pt-4">
                        <div id="appliedPersonByType" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>

        </div>

        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Approved Person By Type
                    </div>
                    <div class="card-body pt-4">
                        <div id="approvedPersonByType" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>

        </div>

        <br>

        <div class="row">
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Applied Case By Country
                    </div>
                    <div class="card-body pt-4">
                        <div id="appliedCaseByCountry" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Approved Case By Country
                    </div>
                    <div class="card-body pt-4">
                        <div id="approvedCaseByCountry" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Applied Person By Country
                    </div>
                    <div class="card-body pt-4">
                        <div id="appliedPersonByCountry" style="height:400px;margin-left: -50px;margin-right: -100px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Approved Person By Country
                    </div>
                    <div class="card-body pt-4">
                        <div id="approvedPersonByCountry" style="height:400px;margin-left: -50px;margin-right: -100px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Applied Gender
                    </div>
                    <div class="card-body pt-4">
                        <div id="appliedGender" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>

        </div>

        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Approved Gender
                    </div>
                    <div class="card-body pt-4">
                        <div id="approvedGender" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>

        </div>

        <br>

        <div class="row">
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Applied Case By Sector
                    </div>
                    <div class="card-body pt-4">
                        <div id="appliedCaseBySector" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Approved Case By Sector
                    </div>
                    <div class="card-body pt-4">
                        <div id="approvedCaseBySector" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Applied Person By Sector
                    </div>
                    <div class="card-body pt-4">
                        <div id="appliedPersonBySector" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                        Approved Person By Sector
                    </div>
                    <div class="card-body pt-4">
                        <div id="approvedPersonBySector" style="height:400px;margin-left: -50px;margin-right: -100px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                    Applied Person By Applicant Type
                    </div>
                    <div class="card-body pt-4">
                        <div id="appliedPersonByApplicantType" style="height:400px;margin-left: -50px;margin-right: -100px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                    Approved Person By Applicant Type
                    </div>
                    <div class="card-body pt-4">
                        <div id="approvedPersonByApplicantType" style="height:400px;margin-left: -50px;margin-right: -100px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- ------------------------------------------------------------------------------------------------ -->
<div class="row mb-3">
            <div class="col-md-12">
                <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                    <div class="card-header" style="background-color: #BBDEFB;">
                    Approved Summary
                    </div>
                    <div class="card-body pt-4">
                        <div id="approved" style="height:400px;margin-left: -50px;margin-right: -100px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!---------------------------------------------------------->
        <!---------------------- Google Chart ---------------------->
        <!---------------------------------------------------------->

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <!-- User Registration  -->
        <script type="text/javascript">
        
            var approvedProfile = <?php echo $approvedProfile; ?>;
            console.log(approvedProfile);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);
            

            function drawChart() {
                var data = new google.visualization.arrayToDataTable(approvedProfile);
                // data.addColumn({role:'annotation'});
                var options = {
                    title: 'User Registration',
                    annotation: {
                        alwaysOutside: true,
                        textStyle: {
                            fontSize: 17,
                            auraColor: 'none',
                            color: '#555'
                        }
                    },
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('approvedProfile'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('approvedProfile'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('approvedProfile'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('approvedProfile'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('approvedProfile'));
                chart.draw(data, options);
            }
        </script>


        <!-- Applied Case -->
        <script type="text/javascript">
            var appliedCase = <?php echo $appliedCase; ?>;
            console.log(appliedCase);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(appliedCase);
                var options = {
                    title: 'Applied Case',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('appliedCase'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('appliedCase'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('appliedCase'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('appliedCase'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('appliedCase'));
                chart.draw(data, options);
            }
        </script>


        <!-- Approved Case -->
        <script type="text/javascript">
            var approvedCase = <?php echo $approvedCase; ?>;
            console.log(approvedCase);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(approvedCase);
                var options = {
                    title: 'Approved Case',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('approvedCase'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('approvedCase'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('approvedCase'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('approvedCase'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('approvedCase'));
                chart.draw(data, options);
            }
        </script>


        <!-- Rejected Case -->
        <script type="text/javascript">
            var rejectedCase = <?php echo $rejectedCase; ?>;
            console.log(rejectedCase);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(rejectedCase);
                var options = {
                    title: 'Rejected Case',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('rejectedCase'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('rejectedCase'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('rejectedCase'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('rejectedCase'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('rejectedCase'));
                chart.draw(data, options);
            }
        </script>


        <!-- Applied Person -->
        <script type="text/javascript">
            var appliedPerson = <?php echo $appliedPerson; ?>;
            console.log(appliedPerson);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(appliedPerson);
                var options = {
                    title: 'Applied Person',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('appliedPerson'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('appliedPerson'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('appliedPerson'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('appliedPerson'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('appliedPerson'));
                chart.draw(data, options);
            }
        </script>


        <!-- Approved Person -->
        <script type="text/javascript">
            var approvedPerson = <?php echo $approvedPerson; ?>;
            console.log(approvedPerson);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(approvedPerson);
                var options = {
                    title: 'Approved Person',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('approvedPerson'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('approvedPerson'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('approvedPerson'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('approvedPerson'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('approvedPerson'));
                chart.draw(data, options);
            }
        </script>


        <!-- Applied Person By Type -->
        <script type="text/javascript">
            var appliedPersonByType = <?php echo $appliedPersonByType; ?>;
            console.log(appliedPersonByType);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(appliedPersonByType);
                var options = {
                    title: 'Applied Person By Type',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('appliedPersonByType'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('appliedPersonByType'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('appliedPersonByType'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('appliedPersonByType'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('appliedPersonByType'));
                chart.draw(data, options);
            }
        </script>


        <!-- Approved Person By Type -->
        <script type="text/javascript">
            var approvedPersonByType = <?php echo $approvedPersonByType; ?>;
            console.log(approvedPersonByType);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(approvedPersonByType);
                var options = {
                    title: 'Approved Person By Type',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('approvedPersonByType'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('approvedPersonByType'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('approvedPersonByType'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('approvedPersonByType'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('approvedPersonByType'));
                chart.draw(data, options);
            }
        </script>


        <!-- Applied Gender -->
        <script type="text/javascript">
            var appliedGender = <?php echo $appliedGender; ?>;
            console.log(appliedGender);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(appliedGender);
                var options = {
                    title: 'Applied Gender',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('appliedGender'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('appliedGender'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('appliedGender'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('appliedGender'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('appliedGender'));
                chart.draw(data, options);
            }
        </script>


        <!-- Approved Gender -->
        <script type="text/javascript">
            var approvedGender = <?php echo $approvedGender; ?>;
            console.log(approvedGender);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(approvedGender);
                var options = {
                    title: 'Approved Gender',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('approvedGender'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('approvedGender'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('approvedGender'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('approvedGender'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('approvedGender'));
                chart.draw(data, options);
            }
        </script>


        <!-- Applied Case By Country -->
        <script type="text/javascript">
            var appliedCaseByCountry = <?php echo $appliedCaseByCountry; ?>;
            console.log(appliedCaseByCountry);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(appliedCaseByCountry);
                var options = {
                    title: 'Applied Case By Country',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('appliedCaseByCountry'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('appliedCaseByCountry'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('appliedCaseByCountry'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('appliedCaseByCountry'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('appliedCaseByCountry'));
                chart.draw(data, options);
            }
        </script>



        <!-- Approved Case By Country -->
        <script type="text/javascript">
            var approvedCaseByCountry = <?php echo $approvedCaseByCountry; ?>;
            console.log(approvedCaseByCountry);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(approvedCaseByCountry);
                var options = {
                    title: 'Approved Case By Country',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('approvedCaseByCountry'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('approvedCaseByCountry'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('approvedCaseByCountry'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('approvedCaseByCountry'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('approvedCaseByCountry'));
                chart.draw(data, options);
            }
        </script>



        <!-- Applied Person By Country -->
        <script type="text/javascript">
            var appliedPersonByCountry = <?php echo $appliedPersonByCountry; ?>;
            console.log(appliedPersonByCountry);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(appliedPersonByCountry);
                var options = {
                    title: 'Applied Person By Country',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('appliedPersonByCountry'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('appliedPersonByCountry'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('appliedPersonByCountry'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('appliedPersonByCountry'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('appliedPersonByCountry'));
                chart.draw(data, options);
            }
        </script>



        <!-- Approved Person By Country -->
        <script type="text/javascript">
            var approvedPersonByCountry = <?php echo $approvedPersonByCountry; ?>;
            console.log(approvedPersonByCountry);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(approvedPersonByCountry);
                var options = {
                    title: 'Approved Person By Country',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('approvedPersonByCountry'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('approvedPersonByCountry'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('approvedPersonByCountry'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('approvedPersonByCountry'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('approvedPersonByCountry'));
                chart.draw(data, options);
            }
        </script>



        <!-- Applied Case By Sector -->
        <script type="text/javascript">
            var appliedCaseBySector = <?php echo $appliedCaseBySector; ?>;
            console.log(appliedCaseBySector);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(appliedCaseBySector);
                var options = {
                    title: 'Applied Case By Sector',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('appliedCaseBySector'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('appliedCaseBySector'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('appliedCaseBySector'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('appliedCaseBySector'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('appliedCaseBySector'));
                chart.draw(data, options);
            }
        </script>



        <!-- Approved Case By Sector -->
        <script type="text/javascript">
            var approvedCaseBySector = <?php echo $approvedCaseBySector; ?>;
            console.log(approvedCaseBySector);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(approvedCaseBySector);
                var options = {
                    title: 'Approved Case By Sector',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('approvedCaseBySector'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('approvedCaseBySector'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('approvedCaseBySector'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('approvedCaseBySector'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('approvedCaseBySector'));
                chart.draw(data, options);
            }
        </script>



        <!-- Applied Person By Sector -->
        <script type="text/javascript">
            var appliedPersonBySector = <?php echo $appliedPersonBySector; ?>;
            console.log(appliedPersonBySector);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(appliedPersonBySector);
                var options = {
                    title: 'Applied Person By Sector',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('appliedPersonBySector'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('appliedPersonBySector'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('appliedPersonBySector'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('appliedPersonBySector'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('appliedPersonBySector'));
                chart.draw(data, options);
            }
        </script>



        <!-- Approved Person By Sector -->
        <script type="text/javascript">
            var approvedPersonBySector = <?php echo $approvedPersonBySector; ?>;
            console.log(approvedPersonBySector);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(approvedPersonBySector);
                var options = {
                    title: 'Approved Person By Sector',
                    colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('approvedPersonBySector'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('approvedPersonBySector'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('approvedPersonBySector'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('approvedPersonBySector'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('approvedPersonBySector'));
                chart.draw(data, options);
            }
        </script>



        <!-- Applied Person By Applicant Types -->
        <script type="text/javascript">
            var appliedPersonByApplicantType = <?php echo $appliedPersonByApplicantType; ?>;
            console.log(appliedPersonByApplicantType);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(appliedPersonByApplicantType);
                var options = {
                    title: 'Applied Person By Applicant Type',
                    // colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('appliedPersonByApplicantType'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('appliedPersonByApplicantType'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('appliedPersonByApplicantType'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('appliedPersonByApplicantType'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('appliedPersonByType'));
                chart.draw(data, options);
            }
        </script>
        <!-- End AppliedPersonByApplicantTypes  -->



        <!-- Approved Person By Applicant Type -->
        <script type="text/javascript">
            var approvedPersonByApplicantType = <?php echo $approvedPersonByApplicantType; ?>;
            console.log(approvedPersonByApplicantType);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(approvedPersonByApplicantType);
                var options = {
                    title: 'Applied Person By Applicant Type',
                    // colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('approvedPersonByApplicantType'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('approvedPersonByApplicantType'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('approvedPersonByApplicantType'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('approvedPersonByApplicantType'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('appliedPersonByType'));
                chart.draw(data, options);
            }
        </script>
        <!-- End Approved Person By Applicant -->

          <!-- Approved Summary -->
          <script type="text/javascript">
            var approved = <?php echo $approved; ?>;
            console.log(approved);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable(approved);
                var options = {
                    title: 'Approved Summary',
                    // colors: ['#889fd7', '#f8a784', '#c0c0c0'],
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chartType = document.getElementById('chartType').value;
                if (chartType == 'line') {
                    var chart = new google.visualization.LineChart(document.getElementById('approved'));
                } else if (chartType == 'bar') {
                    var chart = new google.visualization.BarChart(document.getElementById('approved'));
                } else if (chartType == 'pie') {
                    var chart = new google.visualization.PieChart(document.getElementById('approved'));
                } else {
                    var chart = new google.visualization.ColumnChart(document.getElementById('approved'));
                }
                // var chart = new google.visualization.ColumnChart(document.getElementById('appliedPersonByType'));
                chart.draw(data, options);
            }
        </script>
        <!-- End Approved Summary -->

        
     

         
        
     
    </body>

    </html>
@endsection
