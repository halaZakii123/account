@extends('layouts.amz')
@section('style')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="container">

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
                            <table class="table table-bordered display responsive nowrap  optionDataTable">
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
                                            <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $option->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('Options.destroy', $option->id) }}" method="post" id="delete-{{ $option->id }}" style="display: none;">
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
