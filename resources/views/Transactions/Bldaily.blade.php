@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="dropdown dropleft float-right">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            {{__('More')}}
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{route('printBL')}}" class="btn btn-primary ml-auto">{{__('print')}}</a>
            <a class="dropdown-item" href="{{route('pdfBL')}}" class="btn btn-primary ml-auto">{{__('pdf')}}</a>
{{--            <a class="dropdown-item" href="{{route('pdfBL')}}" class="btn btn-primary ml-auto">{{__('pdf')}}</a>--}}
        </div>
    </div>
        <div class="row ">

                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <table class="table table-bordered display responsive  optionDataTable">
                                <thead>
                                <tr style="font-size: small">
                                    <th>{{__('Sum Trans debit')}}</th>
                                    <th>{{__('Sum Trans credit')}}</th>
                                    <th>{{__('BAl')}}</th>
                                    <th>{{__('Sum Trans debit M')}}</th>
                                    <th>{{__('Sum Trans credit M')}}</th>
                                    <th>{{__('BAlc')}}</th>
                                    <th>{{__('Currency symbol')}}</th>
                                    <th>{{__('Account Number')}}</th>
                                    <th>{{__('Account Name')}}</th>
                                    <th>{{__('Final Report')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($BlDailys as $BlDaily)
                                    <tr class="active">
                                        <td style="text-align: right"> {{ number_format($BlDaily->Db, 2, '.', ',') }} </td>
                                        <td style="text-align: right">{{  number_format($BlDaily->CR, 2, '.', ',') }}</td>
                                        <td style="text-align: right">{{  number_format($BlDaily->BAl, 2, '.', ',') }}</td>
                                        <td style="text-align: right"> {{ number_format($BlDaily->Dbc, 2, '.', ',') }}</td>
                                        <td style="text-align: right"> {{ number_format($BlDaily->Crc, 2, '.', ',') }}</td>
                                        <td style="text-align: right"> {{ number_format($BlDaily->BAlc, 2, '.', ',') }}</td>
                                        <td>{{ $BlDaily->trans_curr}}</td>
                                        <td>{{$BlDaily->acc_id}}</td>
                                        <td>{{$BlDaily->acc_name}}</td>
                                        <td> {{$BlDaily->acc_finalReport}}</td>


                                    </tr>
                                @endforeach


                                </tbody>


                            </table>

                            <table class="table table-bordered display responsive ">
                                <thead>
                                <tr>
                                    <th>{{__('Total Trans debit')}}</th>
                                    <th>{{__('Total Trans credit')}}</th>
                                    <th>{{__(' Total BAl')}}</th>
                                    <th>{{__('Total Trans debit M')}}</th>
                                    <th>{{__('Total Trans credit M')}}</th>
                                    <th>{{__(' Total BAlc')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr >
                                    <td style="text-align: right"> {{  number_format($totdb, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{  number_format($totcr, 2, '.', ',') }}</td>
                                    <td style="text-align: right">{{  number_format($totBAl, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{ number_format($totdbc, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{ number_format($totcrc, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{ number_format($totBAlc, 2, '.', ',') }}</td>
                                    <td></td>

                                </tr>
                                </tbody>
                            </table>


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
            $('.optionDataTable').DataTable();
        });
    </script>
@endsection
