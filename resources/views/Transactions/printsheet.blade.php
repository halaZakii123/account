@extends('layouts.amz')
@section('style')
@section('content')

                <table class="table table-bordered display responsive   optionDataTable" >
                    <thead >
                    <tr style="background-color: #95999c">
                        <th>{{__('Account ID')}}</th>
                        <th>{{__('Account Name')}}</th>
                        <th>{{__('Account belongTO')}}</th>
                        <th>{{__('Account finalReport')}}</th>
                        <th >{{__('Account ismaster')}}</th>
                        <th>{{__('Total debit')}}</th>
                        <th>{{__('Total credit')}}</th>
                        <th>{{__('Total Bal')}}</th>
                        <th>{{__('Total BalDb')}}</th>
                        <th>{{__('Total BalCr')}}</th>


                    </tr>
                    <tr style="background-color: #95999c">
                        <th style="border-bottom: 2px solid black"></th>
                        <th style="border-bottom: 2px solid black"></th>
                        <th style="border-bottom: 2px solid black"></th>
                        <th style="border-bottom: 2px solid black"></th>
                        <th style="border-bottom: 2px solid black"></th>
                        <th style="border-bottom: 2px solid black">{{__('DTot_DB')}}</th>
                        <th style="border-bottom: 2px solid black">{{__('DTot_Crc')}}</th>
                        <th style="border-bottom: 2px solid black">{{__('DTot_Balc')}}</th>
                        <th style="border-bottom: 2px solid black">{{__('DTot_BalDbc')}}</th>
                        <th colspan="2" style="text-align: center;border-bottom: 2px solid black">{{__('DTot_Crc')}}</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if($sheets != null)
                        @foreach($sheets  as $sheet )
                            <tr class="active" style="border-left: 2px solid black;border-top: 2px solid black;border-right: 2px solid black">
                                <td>{{$sheet->AccID}}</td>
                                <td>{{$sheet->acc_name}}</td>
                                <td>{{$sheet->acc_belongTo}}</td>
                                <td>{{$sheet->acc_finalReport}}</td>
                                <td>{{$sheet->acc_ismaster}}</td>
                                <td  style="text-align: right">{{ number_format($sheet->Tot_DB, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_Cr, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_Bal, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_BalDb, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_BalCr, 2, '.', ',') }}</td>

                            </tr>
                            <tr class="active" style="border-left: 2px solid black;border-right: 2px solid black; border-bottom: 2px solid black">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;font-size: small;color: blue">{{ number_format($sheet->Tot_DBc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_Crc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_Balc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_BalDbc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_BalCrc, 2, '.', ',') }}</td>

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
