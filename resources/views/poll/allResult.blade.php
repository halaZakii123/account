@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">

                 @foreach($details as $detail)

                <div class="card">
                    <div class="card-header d-flex">

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

                                @foreach($detail as $d)
                                    <tr>

                                        <th>{{$d['name']}}</th>
                                        <th>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width:{{$d['option']}}% ">{{$d['option']}}%</div>
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
        </div>
    </div>
@endsection


@section('script')


@endsection
