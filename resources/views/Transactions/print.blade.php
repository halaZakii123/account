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
                                    <td >{{ number_format($tran->amntdb, 2, '.', ',') }}</td>
                                    <td>{{ number_format($tran->amntcr, 2, '.', ',') }}</td>
                                    <td>{{$tran->accountid}}</td>
                                    <td></td>
                                    <td>{{$tran->sourceid}}</td>
                                    <td>{{$tran->dydate}}</td>
                                </tr>
                                <tr class="active" style="border-left: 2px solid black;border-right: 2px solid black; border-bottom: 2px solid black">
                                    <td >{{ number_format($tran->amntdbc, 2, '.', ',') }}</td>
                                    <td> {{ number_format($tran->amntcrc, 2, '.', ',') }}</td>
                                    <td>{{$tran->currcode}}</td>
                                    <td colspan="3" style="text-align: center;padding-right: 30px"> {{$tran->docno}} , {{$tran->docdate}} , @if (app()->getLocale() == 'ar'){{$tran->description_ar}} @else  {{$tran->description_en}} @endif </td>

                                </tr>

                            @endforeach
                            <tr>
                                <td>{{ number_format($totaldb, 2, '.', ',') }} </td>
                                <td>{{ number_format($totalcr, 2, '.', ',') }}</td>
                                <td colspan="4">{{__('Total')}}</td>
                                <td>{{ number_format($subAmount, 2, '.', ',') }}</td>

                            </tr>
                            <tr>
                                <td>{{ number_format($totaldbc, 2, '.', ',') }}
                                <td>{{ number_format($totalcrc, 2, '.', ',') }}

                                <td colspan="4">{{__('Total')}}</td>
                                <td>{{ number_format($subAmountc, 2, '.', ',') }}</td>

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

