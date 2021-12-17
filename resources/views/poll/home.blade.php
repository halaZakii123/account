@extends('layouts.app')
@section('style')
    <link href="{{asset('libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('extra-libs/c3/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/morris.js/morris.css')}}" rel="stylesheet">
 @endsection   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <a href="{{route('poll.create')}}">{{__('create')}}</a>
                    <a href="{{route('getvote')}}">{{__('Vote')}}</a>
                    <a href="{{route('result')}}">{{__('result')}}</a>

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
                                <div id="product-sales" style="height:305px"></div>
                            </div>
                        </div>

                    </div>
    </div>
</div>

@endsection

@section('script')
    <!--chartis chart-->
    <script src="{{asset('libs/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{asset('libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <!--c3 charts -->
    <script src="{{asset('extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{asset('extra-libs/c3/c3.min.js')}}"></script>
    <!--chartjs -->
    <script src="{{asset('libs/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('libs/morris.js/morris.min.js')}}"></script>
@endsection