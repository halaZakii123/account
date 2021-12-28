@auth()
    @extends('layouts.amz')
@section('style')
    <link href="{{asset('libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('extra-libs/c3/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/morris.js/morris.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.min.css" rel="stylesheet')}}">
@endsection
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                {{--                        <h4 class="page-title">{{ Request::segment(1) }}</h4>--}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">{{__('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </nav>

            </div>
        </div>
    </div>
<div class="container">
    
    <div class="card-group">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg bg-danger">
                                        <i class="ti-clipboard text-white"></i>
                                    </span>
                                </div>
                                <div>
                                    {{__('Daily Entry')}}
                                </div>
                                <div class="ml-auto">
                                    <h2 class="m-b-0 font-light">23</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg btn-info">
                                    <i class="mdi mdi-currency-usd text-white"></i>
                                    </span>
                                </div>
                                <div>
                                    {{__('Financial constraints')}}

                                </div>
                                <div class="ml-auto">
                                    <h2 class="m-b-0 font-light">113</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg bg-success">
                                        <i class="ti-shopping-cart text-white"></i>
                                    </span>
                                </div>
                                <div>
                                    {{__('Accounts')}}

                                </div>
                                <div class="ml-auto">
                                    <h2 class="m-b-0 font-light">{{$num[0]}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg bg-warning">
                                    <i class="fas fa-user text-white"></i>
                                    </span>
                                </div>
                                <div>
                                   {{__('Users')}}

                                </div>
                                <div class="ml-auto">
                                    <h2 class="m-b-0 font-light">63</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <!-- Column -->


                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Product Sales</h4>
                                        <h5 class="card-subtitle">Overview of Latest Month</h5>
                                    </div>
                                    <div class="ml-auto">
                                        <ul class="list-inline font-12 dl m-r-10">
                                            <li class="list-inline-item">
                                                <i class="fas fa-dot-circle text-info"></i> Ipad
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="fas fa-dot-circle text-danger"></i> Iphone</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- <div id="chartContainer" style="height: 300px; "></div> -->
                                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                            </div>
                          </div>
                     </div>

                        <div class="col-md-6 col-lg-6">
                           <div class="card">
                             <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h4 class="card-title">Product Sales</h4>
                                            <h5 class="card-subtitle">Overview of Latest Month</h5>
                                        </div>
                                        <div class="ml-auto">
                                            <ul class="list-inline font-12 dl m-r-10">
                                                <li class="list-inline-item">
                                                    <i class="fas fa-dot-circle text-info"></i> Ipad
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="fas fa-dot-circle text-danger"></i> Iphone</li>
                                            </ul>
                                        </div>
                                    </div>
                               
                                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                             </div>
                            </div>
                        </div>
                    </div>
                  
                   


                
                

</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<!-- <script type="text/javascript">

window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
		title:{
			text: "My First Chart in CanvasJS"              
		},
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "column",
			dataPoints: [
				{ label: "apple",  y: 10  },
				{ label: "orange", y: 15  },
				{ label: "banana", y: 25  },
				{ label: "mango",  y: 30  },
				{ label: "grape",  y: 28  }
			]
		}
		]
	});
	chart.render();
}
</script> -->

<script>
var xValues = [100,200,300,400,500,600,700,800,900,1000];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
      borderColor: "red",
      fill: false
    }, { 
      data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
      borderColor: "green",
      fill: false
    }, { 
      data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
      borderColor: "blue",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});
</script>

<script>
var xValues = [100,200,300,400,500,600,700,800,900,1000];

new Chart("myChart1", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
      borderColor: "red",
      fill: false
    }, { 
      data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
      borderColor: "green",
      fill: false
    }, { 
      data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
      borderColor: "blue",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});
</script>
@endsection    

@endauth
