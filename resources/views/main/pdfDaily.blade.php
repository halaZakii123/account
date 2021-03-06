<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __() }}</title>

    <style>
        body {
            font-family: 'XBRiyaz', sans-serif;
        }

        /* .invoice-box {
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
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        .table1 td{
            border: 1px solid black;

        }
        .table1 tr{
            border-bottom: 1px solid black;
        } */
        table{
            width: 100%;
            border: 1px solid black;
           border-collapse: collapse;
        }
        th{
            background: #eee;
            border: 1px solid black;

        }
        tr{
            border: 1px solid black;
        }
        td{
            border: 1px solid black;
        }
        caption{
            font-size:large;
            color:blue;
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
    
    <div class="card-body">
        <div class="table-responsive">
        
            <table class="table ">
             <caption> {{__('Daily Entry')}} </caption>
                <thead>
                    <tr>
                        <td style="font-weight: bold">{{ __('Operation Date') }}</td>
                        <td>{{ $operation_date }}</td>
                        <td style="font-weight: bold">{{ __('Explained') }}</td>
                        <td colspan="2">{{ $explained}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">{{__('Cash Id')}}</td>
                        <td>{{ $cash_id }} </td>
                        <td style="font-weight: bold">{{__('Document Number')}}</td>
                        <td>{{ $document_number }} </td>
                    </tr>

                    <tr>
                        <td style="font-weight: bold">{{__('Document Date') }}</td>
                        <td>{{ $doc_date }} </td>
                        <td style="font-weight: bold">{{__('Type of operation')}}</td>
                        <td>@if($type_of_operation == 0)
                                {{__('financial record')}}
                            @elseif($type_of_operation == 1)
                                {{__('Cash in')}}
                            @elseif($type_of_operation == 2)
                                {{__('Cash out')}}
                            @else
                                {{__('Cash')}}
                            @endif
                        </td>
                    </tr>
                <tr>
                    <td style="font-weight: bold">{{__('Currency symbol')}}</td>
                    <td>{{ $currency_symbol}}</td>

                    <td style="font-weight: bold">{{__('Exchange rate')}}</td>
                    <td>{{number_format($exchange_rate , 2, '.', ',')}}</td>

                </tr>
                <thead>
            </table>
            <table class="table ">
                <thead>
                <tr class="heading">
                    <th>#</th>
                    <th>{{ __('Amount') }}</th>
                    <th>{{ __('Account Number') }}</th>
                    <th>{{ __('Explained') }}</th>
                </tr>
                </thead>

                @foreach($items as $item)
                    <tr class="item {{ $loop->last ? 'last' : '' }}">
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        @if($type_of_operation == "cashing")
                        <td style="text-align: right">{{number_format($item['credit'] , 2, '.', ',')}}</td>
                        @else
                            <td style=" text-align: right">{{number_format($item['debit'], 2, '.', ',')  }}</td>
                        @endif
                        <td style="text-align: center;">{{$item['account_number']}}</td>
                        <td style="text-align: center">{{ $item['explained'] }}</td>

                    </tr>

                @endforeach
                <tfoot>
                <tr>
                    <th style="border: 1px solid black">{{_('Total')}}</th>
                    <td style=" text-align: right">{{ number_format($total, 2, '.', ',')}}</td>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>
</body>
</html>
