@extends('admin.layout')
@section('content')
<div class="row" id="proBanner">
              <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                  <p>Welcome Admin.</p>
                  <i class="mdi mdi-close" id="bannerClose"></i>
                </span>
              </div>
            </div>
<div class="row">
              <div class="col-md-12">
                <div class="tab-content tab-transparent-content">
                  <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Daily User Registration</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{$daily}}</h2>
                            <div class="dashboard-progress dashboard-progress-1 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-account-circle icon-md absolute-center text-dark"></i></div>
                            <p class="mt-4 mb-0">Increased since yesterday</p>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{$increased}}</h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Weekly User Registration</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{$weekly}}</h2>
                            <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-account-circle icon-md absolute-center text-dark"></i></div>
                            <p class="mt-4 mb-0">Profile Completed</p>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{(int)$percent_weekly}}%</h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3  col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Monthly User Registration</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{$monthly}}</h2>
                            <div class="dashboard-progress dashboard-progress-3 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-account-circle icon-md absolute-center text-dark"></i></div>
                            <p class="mt-4 mb-0">Profile Completed</p>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{(int)$percent_monthly}}%</h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Total Users</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{$total}}</h2>
                            <div class="dashboard-progress dashboard-progress-4 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-cube icon-md absolute-center text-dark"></i></div>
                            <p class="mt-4 mb-0">Profile Completed</p>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{(int)$percent_monthly}}%</h3>
                          </div>
                        </div>
                      </div>

                      
                      
                    </div>
                  </div>
                </div>
              </div>
            </div> 
<div id="container"></div>
<script src="{{ asset('js/highchart.js') }}"></script>
<script type="text/javascript">
    var users =  <?php echo json_encode($userArr) ?>;
    var year = {{ now()->year }};
		Highcharts.chart('container', {
        title: {
            text: 'New User Growth, '+year+''
        },
        subtitle: {
            text: 'Source: itsolutionstuff.com.com'
        },
         xAxis: {
            categories: ['UserCount','Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Number of New Users'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'New Users',
            data: users
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
});
    
</script>
@endsection