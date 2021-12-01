@extends('layouts.print')
@section('style')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/><link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('content')

                <table class="table table-bordered display responsive   optionDataTable" @if (app()->getLocale() == 'ar') style="text-align: right ;direction: rtl;"@endif>
                    <thead >
                    <tr style="background-color: #95999c">
                    <th>{{__('Total Debit')}}</th>
                        <th>{{__('Total Credit')}}</th>
                        <th>{{__('Total Balance')}}</th>
                        <th>{{__('Total Balance Debit')}}</th>
                        <th>{{__('Total Balance Credit')}}</th>
                        <th>{{__('Account Name')}}</th>
                        <th>{{__('Account ID')}}</th>
                        <th>{{__('Account belongTO')}}</th>
                        <th>{{__('Final Report')}}</th>
                        <th >{{__('Master')}}</th>
                        


                    </tr>
                    <tr style="background-color: #95999c">
                
                        <th>{{__('DTot_DB')}}</th>
                        <th>{{__('DTot_Crc')}}</th>
                        <th>{{__('DTot_Balc')}}</th>
                        <th>{{__('DTot_BalDbc')}}</th>
                        <th  style="text-align: center;">{{__('DTot_Crc')}}</th>
                        <th colspan="5"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($sheets != null)
                        @foreach($sheets  as $sheet )
                            <tr class="active">
                            <td  style="text-align: right">{{ number_format($sheet->Tot_DB, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_Cr, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_Bal, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_BalDb, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_BalCr, 2, '.', ',') }}</td>
                                <td>{{$sheet->acc_name}}</td>
                                <td>{{$sheet->AccID}}</td>
                            
                                <td>{{$sheet->acc_belongTo}}</td>
                                <td>@if($sheet->acc_finalReport == 1)
                                          {{__('budget')}}
                                         @else
                                         {{__('list')}}
                                         @endif</td>
                                <td>@if($sheet->acc_ismaster == 1)
                                            <i class="fas fa-check"></i>
                                        @else
                                            <i class="fa fa-times"></i>
                                        @endif</td>
                                
                            </tr>
                            <tr class="active" style=" border-bottom: 2px solid black">
                                
                                <td style="text-align: right;font-size: small;color: blue">{{ number_format($sheet->Tot_DBc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_Crc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_Balc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_BalDbc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_BalCrc, 2, '.', ',') }}</td>
                                <td colspan="5"></td>

                            </tr>

                        @endforeach
                        {{--                        <th>{{__('Total')}}</th>--}}
                        {{--                        <th>{{__('Total')}}</th>--}}
                        {{--                        <th>{{__('Sub')}}</th>--}}
                        {{--                        <tr>--}}

                        {{--                            <td style="text-align: right">{{ number_format($totaldb, 2, '.', ',') }}--}}
                        {{--                            <td style="text-align: right">{{ number_format($totalcr, 2, '.', ',') }}--}}
                        {{--                            </td>--}}
                        {{--                            <td style="text-align: right">{{ number_format($subAmount, 2, '.', ',') }} </td>--}}
                        {{--                        </tr>--}}
                        {{--                        <tr>--}}
                        {{--                            <td style="text-align: right">{{ number_format($totaldbc, 2, '.', ',') }} </td>--}}
                        {{--                            <td style="text-align: right">{{ number_format($totalcrc, 2, '.', ',') }} </td>--}}

                        {{--                            <td style="text-align: right" >{{ number_format($subAmountc, 2, '.', ',') }} </td>--}}

                        {{--                        </tr>--}}
                    </tbody>
                    @endif
                </table>


@endsection

@section('script')

    <script>
        window.print();
    </script>
@endsection
