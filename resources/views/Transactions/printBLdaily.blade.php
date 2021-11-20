@extends('layouts.amz')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row ">

        <div class="card">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div>
                    <table class="table table-bordered display responsive nowrap  optionDataTable">
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
                                <td>{{$BlDaily->acc_no}}</td>
                                <td>{{$BlDaily->acc_name}}</td>
                                <td> {{$BlDaily->acc_finalReport}}</td>


                            </tr>
                        @endforeach
                        <tr>
                            <th>{{__('Total Trans debit')}}</th>
                            <th>{{__('Total Trans credit')}}</th>
                            <th>{{__(' Total BAl')}}</th>
                            <th>{{__('Total Trans debit M')}}</th>
                            <th>{{__('Total Trans credit M')}}</th>
                            <th>{{__(' Total BAlc')}}</th>
                        </tr>
                        <tr >
                            <td style="text-align: right"> {{  number_format($totdb, 2, '.', ',') }}</td>
                            <td style="text-align: right"> {{  number_format($totcr, 2, '.', ',') }}</td>
                            <td style="text-align: right">{{  number_format($totBAl, 2, '.', ',') }}</td>
                            <td style="text-align: right"> {{ number_format($totdbc, 2, '.', ',') }}</td>
                            <td style="text-align: right"> {{ number_format($totcrc, 2, '.', ',') }}</td>
                            <td style="text-align: right"> {{ number_format($totBAlc, 2, '.', ',') }}</td>

                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('script')

    <script>
        window.print();
    </script>
@endsection

