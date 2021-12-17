@extends('layouts.amz')
@section('style')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                        <li class="breadcrumb-item active" aria-current="page">{{__('Accounts')}}</li>
                    </ol>
                </nav>

            </div>
        </div>
    </div>

    <div class="col-md-9" style="margin: auto ;">
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
                                         {{__('Income list')}}
                                         @endif
                                    </td>
                                    <td>@if($account->mainly == 1)
                                            <i class="fas fa-check"></i>
                                        @elseif($account->mainly == null)
                                            <i class="fa fa-times"></i>
                                        @endif</td>
                                    <td>  <a href="{{route('Accounts.edit',$account->id) }}"><i class="fa fa-edit"></i></a>
                                       <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal{!! $account->id !!}"  data-category="{{ $account->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                         <div class="modal fade" id="exampleModal{!! $account->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                           <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" >
                                                <div style="text-align:center">
                                                   <h2> {{__('Are you sure?')}}</h2>
                                                </div>
                                                <div style="text-align:center">
                                                   <p> {{__('To Delete This Account')}}<p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
                                                <form action="{{route('Accounts.destroy', $account->id) }}" method="post" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button   type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                                                </form>
                                             </div>
                                         </div>
                                     </div>
                                    </div>
                                </td>

                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        @if(!empty($account))
                           <div class="col-12">
                              <a href="{{route('print')}}" class="btn btn-success float-right"><i class="fas fa-print"></i> {{__('print')}} </a>
                              <a href="{{route('pdf')}}" class="btn btn-danger float-right btn-md active" style="margin-left: 10px;"class="pdf" role="button" aria-pressed="true"> <i class="fas fa-download"></i>{{__('Download')}} PDF</a>
                            </div>
                            <a class="btn btn-success float-left" href="{{ route('file-export') }}"> {{__('Export Account')}} </a>

                        @endif
                          @if(empty($account))
                                   <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal1"  data-category="accountImport" class="btn btn btn-primary float-left" style="margin-right: 10px;" >{{__('Import Accounts')}}</a>

                                         <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>

                                            </div>
                                            <div class="modal-body" >
                                                <p> {{__('Your Excel File Has Bee like This')}} </p>
                                               <table class=" table table-bordered " style="font-size:small">
                                                   <thead>
                                                        <th>{{__('Account Number')}}</th>
                                                        <th>{{__('Account Name')}}</th>
                                                        <th>{{__('Master Account number')}}</th>
                                                        <th>{{__('Report')}}</th>
                                                        <th>{{__('Mainly')}}</th>
                                                   </thead>
                                               </table>


                                            </div>
                                            <div class="modal-footer">

                                                <div style="text-align:center,margin:auto" >
                                                    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group mb-4" style="max-width: 500px">
                                                            <div class="custom-file text-left">
                                                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile"> {{__('Choose file')}} </label>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary"> {{__('Import Accounts')}} </button>
                                                    </form>
                                                </div>
                                             </div>
                                         </div>
                                     </div>
                                     @endif
                                 </div>

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
