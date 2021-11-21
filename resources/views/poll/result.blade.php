@extends('layouts.amz')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
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
                            @foreach($de as $d)
                            <tr>

                                <th>{{$d['name']}}</th>
                                <th>
                                    <div class="progress" style="height:15px" >
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
        </div>
    </div>
</div>
@endsection

