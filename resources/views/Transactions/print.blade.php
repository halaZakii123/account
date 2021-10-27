@extends('layouts.print')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                </div>

                <div class="card-body" @if (app()->getLocale() == 'ar') style="text-align: right ;direction: rtl;"@endif>
                    <div class="table-responsive">


                        <h3>{{ __('details') }}</h3>

                        <table class="table table-bordered">
                            <thead>
                            <thead >
                            <tr style="background-color: #95999c">
                                <th>{{__('Debit')}}</th>
                                <th>{{__('Credit')}}</th>
                                <th>{{__('Account Number')}}</th>
                                <th>{{__('Account Name')}}</th>
                                <th>{{__('Source id')}}</th>
                                <th>{{__('Document Date')}}</th>

                            </tr>
                            <tr style="background-color: #95999c">
                                <th style="border-bottom: 2px solid black">{{__('Debit M')}}</th>
                                <th style="border-bottom: 2px solid black">{{__('Credit M')}}</th>
                                <th style="border-bottom: 2px solid black">{{__('Currency symbol')}}</th>
                                <th colspan="3" style="text-align: center;border-bottom: 2px solid black">{{__('Explained')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trans  as $tran )
                                <tr class="active" style="border-left: 2px solid black;border-top: 2px solid black;border-right: 2px solid black">
                                    <td  style="text-align: right">{{ number_format($tran->trans_db, 2, '.', ',') }}</td>
                                    <td style="text-align: right">{{ number_format($tran->trans_cr, 2, '.', ',') }}</td>
                                    <td>{{$tran->trans_accno}}</td>
                                    <td>{{$tran->acc_name}}</td>
                                    <td>{{$tran->trans_sid}}</td>
                                    <td>{{$tran->trans_date}}</td>
                                </tr>
                                <tr class="active" style="border-left: 2px solid black;border-right: 2px solid black; border-bottom: 2px solid black">
                                    <td  style="text-align: right">{{ number_format($tran->trans_dbc, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{ number_format($tran->trans_crc, 2, '.', ',') }}</td>
                                    <td>{{$tran->trans_curr}}</td>
                                    <td colspan="3" style="text-align: center;padding-right: 30px"> {{$tran->trans_docno}} , {{$tran->trans_docdate}} , @if (app()->getLocale() == 'ar'){{$tran->trans_descrip_ar}} @else  {{$tran->trans_descrip_en}} @endif </td>

                                </tr>

                            @endforeach
                            <tr>
                                <td style="text-align: right">{{ number_format($totaldb, 2, '.', ',') }} </td>
                                <td style="text-align: right">{{ number_format($totalcr, 2, '.', ',') }}</td>
                                <td colspan="4">{{__('Total')}}</td>
                                <td style="text-align: right">{{ number_format($subAmount, 2, '.', ',') }}</td>

                            </tr>
                            <tr>
                                <td style="text-align: right">{{ number_format($totaldbc, 2, '.', ',') }}
                                <td style="text-align: right">{{ number_format($totalcrc, 2, '.', ',') }}

                                <td colspan="4">{{__('Total')}}</td>
                                <td style="text-align: right">{{ number_format($subAmountc, 2, '.', ',') }}</td>

                            </tr>
                            </tbody>

                        </table>
                    </div>
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

