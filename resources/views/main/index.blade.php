@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">

                        <a href="{{ route('Mains.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>

                            <a href ="{{route('Mains.create')}} "> {{__('financial record')}} </a>
                            <a href=" {{route('Mains.dailyCash',__('Cash'))}} "> {{__('Cash')}}</a>
                            <a href=" {{route('Mains.dailyCashIn',__('Cash in)'))}}"> {{__('Cash in')}}</a>
                            <a href=" {{route('Mains.dailyCashOut',__('Cash out'))}}"> {{__('Cash out')}}</a>


                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>

                        </div>
                        <div>
                            <table class="table table-bordered display responsive nowrap  mainDataTable">
                                <thead>
                                <tr>
                                    <th>{{__('Operation_number')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Explained')}}</th>
                                    <th>{{__('Cash Id')}}</th>
                                    <th>{{__('Document Number')}}</th>
                                    <th>{{__('Type of operation')}}</th>
                                    <th>{{__('Currency symbol')}}</th>
                                    <th>{{__('Exchange rate')}}</th>
                                    <th>{{__('Action')}}</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mains as $main)
                                    <tr class="active">
                                        <td>{{$main->id}} </td>
                                        <td>{{$main->operation_date}} </td>
                                        <td> @if (app()->getLocale() == 'ar'){{$main->explained_ar}} @else  {{$main->explained}} @endif </td>
                                        <td>{{$main->cash_id}} </td>
                                        <td>{{$main->document_number}} </td>
                                        <td>{{$main->type_of_operation}} </td>
                                        <td>{{$main->currency_symbol}} </td>
                                        <td>{{$main->exchange_rate}} </td>
                                            <td><a href="{{route('Mains.edit',$main->id) }}"><i class="fa fa-edit"></i></a>
                                                <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $main->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                <form action="{{ route('Mains.destroy', $main->id) }}" method="post" id="delete-{{ $main->id }}" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>


                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {!! $mains->links() !!}
                            </div>
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
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.mainDataTable').DataTable();
        });
    </script>
@endsection
