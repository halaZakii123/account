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
        table{
            width: 100%;
            border: 1px solid black;
           border-collapse: collapse;
        }
        th{
            background: #eee;
            border: 1px solid black;

        }
        td{
            border: 1px solid #eee;
        }
      caption{
            font-size: 20px;
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
   


            <table class="table table-bordered">
                <caption>{{__('General Balance')}}</caption>
                <thead>
                <tr >
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
                <tr>
        
                    <th >{{__('DTot_DB')}}</th>
                    <th >{{__('DTot_Crc')}}</th>
                    <th >{{__('DTot_Balc')}}</th>
                    <th >{{__('DTot_BalDbc')}}</th>
                    <th style="text-align: center;">{{__('DTot_Crc')}}</th>
                    <th colspan="5" ></th>

                </tr>
                </thead>

                @foreach($items as $item)
                    <tr class="item {{ $loop->last ? 'last' : '' }}">
                       
                        <td  style="text-align: right;width: 12%;border-right: 1px solid black">{{ number_format($item['Tot_DB'], 2, '.', ',') }}</td>
                        <td style="text-align: right;width: 12%">{{ number_format($item['Tot_Cr'], 2, '.', ',') }}</td>
                        <td style="text-align: right;width: 12%">{{ number_format($item['Tot_Bal'], 2, '.', ',') }}</td>
                        <td style="text-align: right;width: 12%">{{ number_format($item['Tot_BalDb'], 2, '.', ',') }}</td>
                        <td style="text-align: right;width: 12%">{{ number_format($item['Tot_BalCr'], 2, '.', ',') }}</td>
                        <td>{{$item['acc_name']}}</td>
                        <td>{{$item['AccId']}}</td>

                        <td>{{$item['acc_belongTo']}}</td>
                        <td> @if($item['acc_finalReport']== 1)
                                          {{__('budget')}}
                                         @else
                                         {{__('list')}}
                                         @endif</td>
                        <td style="border-left: 1px solid black"> @if($item['acc_ismaster']==1)<i style="font-family:fontawesome;">&#xf00c;</i>@endif</td>
                    </tr>
                    <tr class="active1" >
                        <td style="text-align: right;font-size: small;color: blue;border-bottom: 1px solid black;border-right: 1px solid black">{{ number_format($item['Tot_DBc'], 2, '.', ',') }}</td>
                        <td style="text-align: right;font-size: small;color: blue;border-bottom: 1px solid black;"> {{ number_format($item['Tot_Crc'], 2, '.', ',') }}</td>
                        <td style="text-align: right;font-size: small;color: blue;border-bottom: 1px solid black;"> {{ number_format($item['Tot_Balc'], 2, '.', ',') }}</td>
                        <td style="text-align: right;font-size: small;color: blue;border-bottom: 1px solid black;"> {{ number_format($item['Tot_BalDbc'], 2, '.', ',') }}</td>
                        <td style="text-align: right;font-size: small;color: blue;border-bottom: 1px solid black"> {{ number_format($item['Tot_BalCrc'], 2, '.', ',') }}</td>
                        <td colspan="5" style="border-left:1px solid black"></td>
                    </tr>

                @endforeach

            </table>

        </div>

</body>
</html>
