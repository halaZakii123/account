@extends('layouts.amz')
@section('style')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="dropdown dropleft float-right">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            {{__('More')}}
        </button>
        <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('print')}}" class="btn btn-primary ml-auto"> print</a>
                <a  class="dropdown-item"href="{{route('pdf')}}" class="btn btn-primary ml-auto">pdf</a>
        </div>
    </div>
    <div class="container">
                <div class="card">
                    <div class="card-header d-flex">
                        <a href="{{ route('Accounts.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>
                       @if($count == 0)
                         <a href="{{ route('createAccountTree') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create Account Tree') }}</a>
                       @endif
                    </div>


                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="table-responsive">
                        <table class="table table-bordered  display responsive  yajra-datatable">
                            <thead>
                            <tr>
                                {{-- <th>#</th> --}}
                                <th>{{__('Account Number')}}</th>
                                <th>{{__('Account Name')}}</th>
                                <th>{{__('Master Account number')}}</th>
                                <th>{{__('Report')}}</th>
                                <th>{{__('Mainly')}}</th>
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
                                    <td> @if($account->report== 1)
                                          {{__('budget')}}
                                         @else
                                         {{__('list')}}
                                         @endif
                                    </td>
                                    <td>@if($account->mainly == 1)
                                            <i class="fas fa-check"></i>
                                        @elseif($account->mainly == null)
                                            <i class="fa fa-times"></i>
                                        @endif</td>
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

                         </div>
                </div>
                    </div>

@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.yajra-datatable').DataTable();

        });
    </script>
@endsection
