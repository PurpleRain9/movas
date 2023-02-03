@extends('admin.layout')
@section('content')
<style>
    .card-height {
    height: 100px;
    border-radius: 25px;
    background: #73AD21;
    padding: 20px;
    }
    .card {
    border-radius: 25px;
    padding: 20px;
    }
    .circle-icon {
    padding:15px;
    border-radius: 50%;
    }
    .circle-icon1 {
    background: orangered;
    }
    .circle-icon2 {
    background: #44ce42;
    }
    .circle-icon3 {
    background: indigo;
    }
    .circle-icon4 {
    background: #bb0a5c;
    }
</style>

@php
$d_from_date = request()->from_date === null ? '' : request()->from_date;
$d_to_date = request()->to_date === null ? '' : request()->to_date;
if (old()) {
    $d_from_date = old('from_date');
    $d_to_date = old('to_date');
}
@endphp
      <div class="row mb-3">
        <div class="col-md-12 col-sm-6 shadow-sm" style="height: 100px;border-radius: 15px;padding: ">
          <form class="navbar-form ">
                    <div class="d-flex justify-content-around mt-2">
                      <div style="width: 45%" class=" ml-4">
                        <small class="mt-3">Date From :</small>
                        <input type="date" id="search" class="form-control" value="{{$d_from_date}}"  style="border-radius: 3px;" name="from_date">    
                      </div>
                      <div style="width: 45%" class=" ml-4">
                        <small class="mt-3">Date to :</small>
                        <input type="date" id="search" class="form-control" value="{{$d_to_date}}"  style="border-radius: 3px;" name="to_date">
                      </div>
                      <div style="width: 10%">
                        <button type="submit" style="margin-left: 10px;width: 40px;margin-top: 23px;" class="btn btn-primary ">
                          <i class="fa fa-search"></i>
                          <!--<div class="ripple-container"></div>-->
                        </button>
                      </div>
                    </div>
            </form>
        </div>
      </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card-body shadow mb-5 bg-white  card-height " style="width: 100%;">
                    <div class="row mt-2" >
                        <div class="col-9 ">
                            <p class="text-sm mb-1 text-uppercase font-weight-bold text-light ">Profile Resubmitted</p>
                            <span class="h3 font-weight-bold mt-2">{{$profile_reject}}</span>
                        </div> 
                        <div class="col-3 mt-1">
                            <i class="fa fa-user-times text-white circle-icon1 circle-icon " aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-body shadow p-3 mb-5 bg-white  card-height">
                    <div class="row mt-2">
                    <div class="col-9  ">
                        <p class="text-sm mb-1 text-uppercase font-weight-bold text-light">Profile Approved</p>
                        <span class="h3 font-weight-bold mt-2">{{$profile_approved->count()}}</span>
                    </div>
                    <div class="col-3 mt-1 ">
                        <i class="fa fa-user-circle-o  text-white text-white circle-icon2 circle-icon " aria-hidden="true"></i>
                    </div>
                    </div>
                
                    </div>
            </div>
            <div class="col-md-3">
                <div class="card-body shadow p-3 mb-5 bg-white  card-height">
                    <div class="row mt-2">
                    <div class="col-9 ">
                        <p class="text-sm mb-1 text-uppercase font-weight-bold text-light">Visa Resubmitted</p>
                        <span class="h3 font-weight-bold mt-1">{{$reject_times->count()}}</span>
                    </div>
                    <div class="col-3 mt-1 ">
                        <i class="fa fa-minus-circle text-white circle-icon3 circle-icon mr-3" aria-hidden="true"></i>
                    </div>
                    </div>
                 
                    </div>
            </div>
            <div class="col-md-3">
                <div class="card-body shadow p-3 mb-5 bg-white  card-height">
                    <div class="row mt-2">
                    <div class="col ml-1">
                        <p class="text-sm mb-1 text-uppercase font-weight-bold text-light">Visa Approved</p>
                        <span class="h3 font-weight-bold mt-2">{{$visa_heads->count()}}</span>
                    </div>
                    <div class="col-auto mt-1">
                        <i class="fa fa-book text-white text-white circle-icon4 circle-icon " aria-hidden="true"></i>
                    </div>
                    </div>
                
                    </div>
            </div>
        </div>
        <div class="row">
                <div class="col-md-7  " >
                  <div class="shadow pl-2 pt-2">
                    <small class="text-muted">{{$fromDate}} to {{$toDate}}</small>
                    <div id="visaChart" style="height:5in;" class="mt-3 px-2 "></div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="shadow pl-2 pt-2 " style="height:525px;">
                    <small class="text-muted">{{$fromDate}} to {{$toDate}}</small>
                    <h4 class="text-center pt-3">Visa Application Resubmit</h4>
                    <div id="visaChartTotal" style="height: 400px;" class="mt-3 px-2 "></div>
                    <h5 class=" mb-5 text-center text-dark">Total - {{$visa_rejects->count()}}</h5>
                  </div>
                </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-7 " >
            <div class="shadow pl-2 pt-2" >
              <small class="text-muted">{{$fromDate}} to {{$toDate}}</small>
              <div id="userChart"  class="mt-3 px-2 " style="height: 480px;"></div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="shadow pl-2 pt-2 " style="height:525px;">
              <small class="text-muted">{{$fromDate}} to {{$toDate}}</small>
              <h4 class="text-center pt-3 ">Visa Application Submit</h4>
              <div id="visaChartSubmit" style="height: 400px;" class="mt-3 px-2 "></div>
              <h5 class=" mb-5 text-center text-dark">Total - {{$visa_submit_count}}</h5>
            </div>
          </div>
        </div>
        <br>
        @php
        $reject_val=[];
        foreach ($reject_histories as $reject_history) {
          array_push($reject_val, array("name" => $reject_history->reviewer->username, "count" => $reject_history->count));
        }
        $submit_val=[];
        foreach ($visa_submits as $visa_submit) {
          array_push($submit_val, array("name" => $visa_submit->reviewer->username, "count" => $visa_submit->count));
        }
        
   @endphp
@endsection


@section('scriptAdmin')
<script>

    var reject_history=<?php echo json_encode($reject_val); ?>;

    var visa_submit=<?php echo json_encode($submit_val); ?>;
    console.log(visa_submit)
</script>
<script src="https://cdn.jsdelivr.net/npm/echarts@5.3.3/dist/echarts.min.js"></script>
{{-- visa chart with weekly dates --}}
<script>
    var chartDom = document.getElementById('visaChart');
    var myChart = echarts.init(chartDom);
    var option;

    const seriesLabel = {
      show: true
    };
    option = {
      title: {
        text: 'Visa Application'
      },
      tooltip: {
        trigger: 'axis',
        axisPointer: {
          type: 'shadow'
        }
      },
      legend: {
        data: ['Approve', 'Resubmit']
      },
      grid: {
        left: 100
      },
      toolbox: {
        show: true,
        feature: {
          saveAsImage: {}
        }
      },
      xAxis: {
        type: 'value',
        name: 'QTY',
        axisLabel: {
          formatter: '{value}'
        }
      },
      yAxis: {
        type: 'category',
        inverse: true,
        data: [
          'Monday',
          'Tuesday',
          'Wednesday',
          'Thursday',
          'Friday',
          'Saturday',
          'Sunday',
        ],
        axisLabel: {
          formatter: function (value) {
            return '{' + value + '| }\n{value|' + value + '}';
          },
          margin: 20,
          rich: {
            value: {
              lineHeight: 30,
              align: 'center'
            },
          }
        }
      },

      series: [
        {
          name: 'Approve',
          type: 'bar',
          color: '#44ce42',
          label: seriesLabel,
          data: [  {{$approveMon}},{{$approveTue}},{{$approveWed}},{{$approveThur}},{{$approveFri}},{{$approveSat}},{{$approveSun}},]
        },
        {
        
          name: 'Resubmit',
          type: 'bar',
          color: '#d50a39',
          label: seriesLabel,
          data: [    {{$rejectMon}},{{$rejectTue}},{{$rejectWed}},{{$rejectThur}},{{$rejectFri}},{{$rejectSat}},{{$rejectSun}},]
        }
      ]
    };

  myChart.setOption(option);

</script>
<script>
  var chartDom = document.getElementById('visaChartTotal');
  var myChart = echarts.init(chartDom);
  var option;
  var colorPalette = ['#6610f2', '#ffbf00', '#f6e84e','#E91E63'];
  option = {

    tooltip: {
      trigger: 'item'
    },
    legend: {
      orient: 'vertical',
      left: 'left'
    },
    series: [
      {
        name: 'Visa  Resubmit',
        type: 'pie',
        radius: '50%',
        data: reject_history.map(obj => ({value:obj.count,name:obj.name})),
        color: colorPalette,
        emphasis: {
          itemStyle: {
            shadowBlur: 10,
            shadowOffsetX: 0,
            shadowColor: 'rgba(0, 0, 0, 0.5)'
          }
        },
        center: ["50%", "50%"], 
      },
    ],
    graph: {
    color : colorPalette
  }
  };

  myChart.setOption(option);
</script>
<script>
  var chartDom = document.getElementById('userChart');
  var myChart = echarts.init(chartDom);
  var option;

  option = {
    title: {
        text: 'Profile And Visa Application Statistics',
        x:'center',
      },
    legend: {
      orient: 'vertical',
        left: 'left',
      },
    tooltip: {},
    grid: {
      left: '20%',
      right: '10%',
      bottom: '10%',
      containLabel: true
    },
    dataset: {
      source: [
        ['product', 'Approve', 'Resubmit', 'Inprocess','New Case'],
        ['Profile', {{$profile_approved->count()}}, {{$profile_reject}}, {{$profile_inprocess}}],
        ['Visa Application', {{$visa_heads->count()}}, {{$reject_times->count()}}, {{$visa_inprocess}},{{$visa_newcase}}],
      ]
    },
    xAxis: { type: 'category' },
    yAxis: {},
   
    // Declare several bar series, each will be mapped
    // to a column of dataset.source by defaultp.
    series: [{ type: 'bar' ,barMaxWidth: 50,barCategoryGap: '20%',color :'#44ce42'}, { type: 'bar' ,barMaxWidth: 50,color :'#d50a39'}, { type: 'bar',barMaxWidth: 50 }, { type: 'bar',barMaxWidth: 50 ,color:'#ebdc3b'}],
  };

  myChart.setOption(option);
  </script>
  <script>
  var chartDom = document.getElementById('visaChartSubmit');
  var myChart = echarts.init(chartDom);
  var option;
  var colorPalette = ['#6610f2', '#ffbf00', '#f6e84e','#E91E63'];
  option = {

    tooltip: {
      trigger: 'item'
    },
    legend: {
      orient: 'vertical',
      left: 'left'
    },
    series: [
      {
        name: 'Visa Submit',
        type: 'pie',
        radius: '50%',
        data: visa_submit.map(obj => ({value:obj.count,name:obj.name})),
        color: colorPalette,
        emphasis: {
          itemStyle: {
            shadowBlur: 10,
            shadowOffsetX: 0,
            shadowColor: 'rgba(0, 0, 0, 0.5)'
          }
        },
        center: ["50%", "50%"], 
      },
    ],
    graph: {
    color : colorPalette
  }
  };

  myChart.setOption(option);
</script>
@endsection