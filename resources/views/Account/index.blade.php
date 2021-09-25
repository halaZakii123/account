@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection


@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-2  ">
                <div class="card-header d-flex">
                </div>
                <div class="card  ">
                    <a href="{{ route('Accounts.create') }}" class="text-center"><i class="fa fa-plus"></i>
                        {{ __('create') }}</a>
                  <a href="{{route('print')}}" class="text-center">{{__('print')}}</a>
                    <a href="{{route('pdf')}}" class="text-center"> {{__('pdf')}}</a>

                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex">
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        {{-- <div class="table-responsive"> --}}
                        <table class="table table-bordered  display responsive  yajra-datatable">
                            <thead>
                            <tr>
                                {{-- <th>#</th> --}}
                                <th>{{__('Account Number')}}</th>
                                <th>{{__('Account Name')}}</th>
                                <th>{{__('Master Account number')}}</th>
                                <th>{{__('Report')}}</th>
                                <th>{{__('Mainly')}}</th>
                                {{-- <th>{{__('Create At')}}</th> --}}
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accounts as $account)

                                <tr class="active">
                                    <td>
                                        {{$account->account_number}} </td>
                                    <td>{{$account->account_name}}</td>
                                    <td>{{$account->master_account_number}}</td>
                                    <td>{{$account->report}}</td>
                                    <td>{{$account->mainly}}</td>
                                    <td>  <a href="{{route('Accounts.edit',$account->id) }}"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $account->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        <form action="{{ route('Accounts.destroy', $account->id) }}" method="post" id="delete-{{ $account->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{-- </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.yajra-datatable').DataTable();

        });
    </script>
@endsection
