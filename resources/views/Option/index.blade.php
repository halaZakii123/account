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
                        <li class="breadcrumb-item active" aria-current="page">{{__('Options')}}</li>
                    </ol>
                </nav>

            </div>
        </div>
    </div>
    <div class="col-md-8" style="margin: auto ;">

                <div class="card">
                    <div class="card-header d-flex">
                        <a href="{{ route('Options.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div class="table-responsive">
                            <table class="table table-bordered    optionDataTable">
                                <thead>
                                <tr>
                                    <th>{{__('Type')}}</th>
                                    <th>{{__('Content')}}</th>
                                    <th>{{__('Exchange rate')}}</th>
                                    <th>{{__('Action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($options as $option)
                                    <tr class="active">
                                        <td>@if($option->type == 'currency_symbol') {{__('Currency symbol')}} @else {{__('Type of operation')}} @endif</td>
                                        <td>
                                            {{$option->contents}}</td>
                                        <td style="text-align: right"> {{ number_format($option->exchange_rate, 2, '.', ',') }}</td>
                                        <td>
                                            <a href="{{route('Options.edit',$option->id) }}"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal{!! $option->id !!}"  data-category="{{ $option->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                         
                                         <div class="modal fade" id="exampleModal{!! $option->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                   <p> {{__('To Delete This option')}}<p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
                                                <form action="{{route('Options.destroy', $option->id) }}" method="post" >
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
                        </div>

                    </div>
                </div>
    </div>

@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.optionDataTable').DataTable();
        });
    </script>
@endsection
