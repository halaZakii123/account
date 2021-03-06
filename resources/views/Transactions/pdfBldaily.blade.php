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
  
    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered">
                <caption> {{__('Daily Account Balance')}}</caption>
                <thead>
                <tr style="background-color: #95999c">

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

                @foreach($items as $item)
                    <tr class="item {{ $loop->last ? 'last' : '' }}">

                        <td style="text-align: right;border-right: 1px solid black">{{number_format($item['Db'], 2, '.', ',')  }}</td>
                        <td style="text-align: right">{{  number_format($item['CR'], 2, '.', ',') }}</td>
                        <td style="text-align: right">{{  number_format($item['BAl'], 2, '.', ',') }}</td>
                    
                        <td >{{  $item['trans_curr'] }}</td>
                        <td >{{ $item['acc_name'] }}</td>
                        <td >{{ $item['acc_id'] }}</td>
                        <td style="border-left: 1px solid black"> @if($item['acc_finalReport']== 1)
                                          {{__('budget')}}
                                         @else
                                         {{__('list')}}
                                         @endif</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;border-bottom: 1px solid black;border-right: 1px solid black;font-size: small;color: blue">{{  number_format($item['Dbc'], 2, '.', ',') }}</td>
                        <td style="text-align: right;border-bottom: 1px solid black;font-size: small;color: blue">{{  number_format($item['Crc'], 2, '.', ',') }}</td>
                        <td style="text-align: right;border-bottom: 1px solid black;font-size: small;color: blue">{{  number_format($item['BAlc'], 2, '.', ',') }}</td>
                        <td colspan="4" style="border-bottom: 1px solid black;border-left:1px solid black"></td> 
                         
                    </tr>
                @endforeach
                

                 <tr >
                    <td style="border-right: 1px solid black"> {{  number_format($totdb, 2, '.', ',') }}</td>
                    <td style="text-align: right"> {{  number_format($totcr, 2, '.', ',') }}</td>
                    <td style="text-align: right;">{{  number_format($totBAl, 2, '.', ',') }}</td>
                    <th> {{__('Total')}}</th>  
                </tr>
                 <tr>
                    <td style="text-align: right;border-bottom: 1px solid black;border-right: 1px solid black;"> {{ number_format($totdbc, 2, '.', ',') }}</td>
                    <td style="text-align: right;border-bottom: 1px solid black;"> {{ number_format($totcrc, 2, '.', ',') }}</td>
                    <td style="text-align: right;border-bottom: 1px solid black;"> {{ number_format($totBAlc, 2, '.', ',') }}</td>


                </tr>
            </table>


        </div>
    </div>
</div>
</body>
</html>
