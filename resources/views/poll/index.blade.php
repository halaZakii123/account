@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex">
                        <a href="{{ route('poll.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>
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
                                <tr>
                                    <th>{{__('#')}}</th>
                                    <th>{{__('Question')}}</th>
                                    <th>{{__('options')}}</th>
                                    <th>{{__('Status')}}</th>

                                    <th>{{__('Action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($polls as $poll)
                                    <tr class="active">
                                        <td>{{$poll->id}}</td>
                                        <td > {{ $poll->question}}</td>
                                        <td > {{ $poll->options_count}}</td>
                                        <td >
                                            @if($poll->status ==0)
                                            {{__('inactive')}}
                                           @elseif($poll->status == 1)
                                            {{__('active')}}
                                           @else
                                                {{__('close')}}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $poll->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                            <form action="{{ route('poll.destroy', $poll->id) }}" method="post" id="delete-{{ $poll->id }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            @if($poll->status==0)
                                             <a href="{{route('poll.edit',$poll->id) }}"><i class="fa fa-edit"></i></a>
                                           @endif

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.optionDataTable').DataTable();
        });
    </script>
@endsection
