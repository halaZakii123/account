@extends('layouts.print')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="col-md-12" style="margin: auto ;">

        <div class="card">
            <div class="card-body"  @if (app()->getLocale() == 'ar') style="text-align: right ;direction: rtl;"@endif>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div>
                    <table class="table table-bordered ">
                        <caption style="font-size:20px;caption-side:top;text-align:center"> {{__('Daily Account Balance')}}</caption>
                        <thead>
                        <tr >
                                    <th>{{__('Debit')}}</th>
                                    <th>{{__('Credit')}}</th>
                                    <th>{{__('Balance')}}</th>
                                    <th>{{__('Currency symbol')}}</th>
                                    <th>{{__('Account Name')}}</th>
                                    <th>{{__('Account Number')}}</th>
                                    <th>{{__('Final Report')}}</th>

                        </tr>
                        <tr>
                                    <th>{{__('Debit Curr.')}}</th>
                                    <th>{{__('Credit Curr.')}}</th>
                                    <th>{{__('Balance Curr.')}}</th>
                            <th colspan="4"></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($BlDailys as $BlDaily)
                            <tr class="active">
                                <td style="text-align: right"> {{ number_format($BlDaily->Db, 2, '.', ',') }} </td>
                                <td style="text-align: right">{{  number_format($BlDaily->CR, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{  number_format($BlDaily->BAl, 2, '.', ',') }}</td>
                                <td>{{ $BlDaily->trans_curr}}</td>
                                <td>{{$BlDaily->acc_name}}</td>
                                 <td>{{$BlDaily->acc_no}}</td>
                                
                                <td>@if($BlDaily->acc_finalReport== 1)
                                          {{__('budget')}}
                                         @else
                                         {{__('Income list')}}
                                         @endif </td>


                            </tr>
                            <tr style=" border-bottom: 2px solid black">
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($BlDaily->Dbc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($BlDaily->Crc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($BlDaily->BAlc, 2, '.', ',') }}</td>
                                <td colspan="4"></td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>{{__('Total')}}</th>
                        
                        </tr>
                        <tr >
                            <td style="text-align: right"> {{  number_format($totdb, 2, '.', ',') }}</td>
                            <td style="text-align: right"> {{  number_format($totcr, 2, '.', ',') }}</td>
                            <td style="text-align: right">{{  number_format($totBAl, 2, '.', ',') }}</td>
                        </tr>  
                        <tr>  
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

