@extends('layouts.amz')

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
                        <li class="breadcrumb-item active" aria-current="page">{{__('Polls')}}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Result')}}</li>
                    </ol>
                </nav>

            </div>
        </div>
    </div>
        <div class="col-md-8" style="margin: auto;">
            <div class="card">
                <div class="card-header d-flex">
                    {{$poll->question}}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        <table class="table table-bordered display responsive nowrap  optionDataTable">
                            <thead>
                            @foreach($poll->options()->get() as $option)
                            <tr>

                                <th>{{$option->name}}</th>
                                <th>
                                    <div class="progress" style="height:15px" >
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width:{{\App\Helpers\totalVotes::TotalVotes($option->votes,$poll->id)}}% ">{{\App\Helpers\totalVotes::TotalVotes($option->votes,$poll->id)}}%</div>
                                    </div>
                                </th>
                            </tr>
                             @endforeach
                            </thead>

                        </table>
                    </div>

                </div>
            </div>
        </div>

@endsection

