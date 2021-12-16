@extends('layouts.amz')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="page-breadcrumb" style="margin-bottom:20px">
        <div class="row">
            <div class="col-5 align-self-center">
                {{--                        <h4 class="page-title">{{ Request::segment(1) }}</h4>--}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">{{__('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Polls')}}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('All Result')}}</li>
                    </ol>
                </nav>

            </div>
        </div>
    </div>
            <div class="col-md-9" style="margin: auto;">

                 @foreach($polls as $poll)

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
                                            <div class="progress">

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
{{--                  @endforeach--}}
                  @endforeach

            </div>

@endsection


@section('script')


@endsection
