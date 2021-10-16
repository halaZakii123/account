<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __() }}</title>

    <style>
        body {
            font-family: 'XBRiyaz', sans-serif;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            font-size: 9px;
            line-height: 24px;
            font-family: 'XBRiyaz', sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: right;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td {
            text-align: left;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 30px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td {
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: 'XBRiyaz', sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td {
            text-align: right;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }
    </style>
</head>

<body>
<div class="invoice-box {{ config('app.locale') == 'ar' ? 'rtl' : '' }}">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="6">
                <table>
                    <tr>
                        <td width="35%">
                            {{ __('Date') }}: {{ Carbon\Carbon::now()->format('Y-m-d') }}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered">
                <thead>
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

{{--                @foreach($trans  as $tran )--}}
{{--                    <tr class="active" style="border-left: 2px solid black;border-top: 2px solid black;border-right: 2px solid black">--}}
{{--                        <td >{{ number_format($tran->amntdb, 2, ',', '.') }}</td>--}}
{{--                        <td>{{ number_format($tran->amntcr, 2, ',', '.') }}</td>--}}
{{--                        <td>{{$tran->accountid}}</td>--}}
{{--                        <td></td>--}}
{{--                        <td>{{$tran->sourceid}}</td>--}}
{{--                        <td>{{$tran->dydate}}</td>--}}
{{--                    </tr>--}}
{{--                --}}
{{--                    <tr class="active" style="border-left: 2px solid black;border-right: 2px solid black; border-bottom: 2px solid black">--}}
{{--                        <td >{{ number_format($tran->amntdbc, 2, ',', '.') }}</td>--}}
{{--                        <td> {{ number_format($tran->amntcrc, 2, ',', '.') }}</td>--}}
{{--                        <td>{{$tran->currcode}}</td>--}}
{{--                        <td colspan="3" style="text-align: center;padding-right: 30px"> {{$tran->docno}} , {{$tran->docdate}} , @if (app()->getLocale() == 'ar'){{$tran->description_ar}} @else  {{$tran->description_en}} @endif </td>--}}

{{--                    </tr>--}}

{{--                @endforeach--}}
                @foreach($items as $item)
                    <tr class="item {{ $loop->last ? 'last' : '' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{number_format($item['amntdb'], 2, '.', ',')  }}</td>
                        <td>{{  number_format($item['amntcr'], 2, '.', ',') }}</td>
                        <td>{{ $item['accountid'] }}</td>
                        <td>{{ $item['sourceid'] }}</td>
                        <td>{{ $item['dydate'] }}</td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td>{{  number_format($item['amntdbc'], 2, '.', ',') }}</td>
                        <td>{{  number_format($item['amntcrc'], 2, '.', ',')}}</td>
                        <td>{{ $item['currcode'] }}</td>
                        <td>{{ $item['docno'] }}  {{ $item['docdate'] }}  {{ $item['description'] }} </td>

                    </tr>

                @endforeach
                <tr>
                   <td></td>
                    <td>{{  number_format($totaldb ,2, '.', ',') }} </td>
                    <td>{{  number_format($totalcr, 2, '.', ',')}}</td>
                    <td colspan="4">{{__('Total')}}</td>
                    <td>{{ number_format($subAmount, 2, '.', ',') }}</td>

                </tr>
                <tr>
                    <td></td>

                    <td>{{  number_format($totaldbc, 2, '.', ',')}} </td>
                    <td>{{  number_format($totalcrc, 2, '.', ',') }} </td>
                    <td colspan="4">{{__('Total')}}</td>
                    <td>{{ number_format($subAmountc, 2, '.', ',') }}</td>

                </tr>

            </table>

        </div>
    </div>
</div>
</body>
</html>
