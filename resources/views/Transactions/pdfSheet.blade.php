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
        table{
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }
        th{
            border: 1px solid black;
            border-collapse: collapse;

        }
        td{

            border-right: 1px solid black;
            border-collapse: collapse;

        }
        .active1 td{
            border-bottom: 1px solid black;
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
    <table >
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


            <table class="table table-bordered">
                <thead>
                <tr style="background-color: #95999c">
                    <th>{{__('Account ID')}}</th>
                    <th style="width:10%;text-align: right">{{__('Account Name')}}</th>
                    <th>{{__('Account belongTO')}}</th>
                    <th>{{__('Account finalReport')}}</th>
                    <th>{{__('Account ismaster')}}</th>
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

                @foreach($items as $item)
                    <tr class="item {{ $loop->last ? 'last' : '' }}">
                        <td>{{$item['AccId']}}</td>
                        <td>{{$item['acc_name']}}</td>
                        <td>{{$item['acc_belongTo']}}</td>
                        <td>{{$item['acc_finalReport']}}</td>
                        <td>{{$item['acc_ismaster']}}</td>
                        <td  style="text-align: right;width: 12%">{{ number_format($item['Tot_DB'], 2, '.', ',') }}</td>
                        <td style="text-align: right;width: 12%">{{ number_format($item['Tot_Cr'], 2, '.', ',') }}</td>
                        <td style="text-align: right;width: 12%">{{ number_format($item['Tot_Bal'], 2, '.', ',') }}</td>
                        <td style="text-align: right;width: 12%">{{ number_format($item['Tot_BalDb'], 2, '.', ',') }}</td>
                        <td style="text-align: right;width: 12%">{{ number_format($item['Tot_BalCr'], 2, '.', ',') }}</td>
                    </tr>
                    <tr class="active1" >
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right;font-size: small;color: blue">{{ number_format($item['Tot_DBc'], 2, '.', ',') }}</td>
                        <td style="text-align: right;font-size: small;color: blue"> {{ number_format($item['Tot_Crc'], 2, '.', ',') }}</td>
                        <td style="text-align: right;font-size: small;color: blue"> {{ number_format($item['Tot_Balc'], 2, '.', ',') }}</td>
                        <td style="text-align: right;font-size: small;color: blue"> {{ number_format($item['Tot_BalDbc'], 2, '.', ',') }}</td>
                        <td style="text-align: right;font-size: small;color: blue"> {{ number_format($item['Tot_BalCrc'], 2, '.', ',') }}</td>

                    </tr>

                @endforeach

            </table>

        </div>

</body>
</html>
