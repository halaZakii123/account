<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __() }}</title>

    <style>
        body {
            font-family: 'XBRiyaz', sans-serif;
        }

        /*.invoice-box {*/
        /*    max-width: 800px;*/
        /*    margin: auto;*/
        /*    padding: 30px;*/
        /*    font-size: 9px;*/
        /*    line-height: 24px;*/
        /*    font-family: 'XBRiyaz', sans-serif;*/
        /*    color: #555;*/
        /*}*/

        /*.invoice-box table {*/
        /*    width: 100%;*/
        /*    line-height: inherit;*/
        /*    text-align: right;*/
        /*}*/

        /*.invoice-box table td {*/
        /*    padding: 5px;*/
        /*    vertical-align: top;*/
        /*}*/

        /*.invoice-box table tr td {*/
        /*    text-align: left;*/
        /*}*/

        /*.invoice-box table tr.top table td {*/
        /*    padding-bottom: 20px;*/
        /*}*/

        /*.invoice-box table tr.top table td.title {*/
        /*    font-size: 30px;*/
        /*    line-height: 45px;*/
        /*    color: #333;*/
        /*}*/

        /*.invoice-box table tr.information table td {*/
        /*    padding-bottom: 40px;*/
        /*}*/

        /*.invoice-box table tr.heading td {*/
        /*    background: #eee;*/
        /*    font-weight: bold;*/
        /*}*/

        /*.invoice-box table tr.details td {*/
        /*    padding-bottom: 20px;*/
        /*}*/

        /*.invoice-box table tr.item td{*/
        /*}*/

        /*.invoice-box table tr.item.last td {*/
        /*    border-bottom: none;*/
        /*}*/

        /*.invoice-box table tr.total td {*/
        /*    font-weight: bold;*/
        /*}*/
        table{
            width: 100%;
            border: 1px solid black;
           border-collapse: collapse;
        }
        th{
            border: 1px solid black;

        }
        tr{
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
                      
            <caption style="font-size:20px;caption-side:top;text-align:center"> {{__('Financial constraints')}}</caption>

                <thead>
                <tr>
                    <th></th>
                    <th>{{__('Debit')}}</th>
                    <th>{{__('Credit')}}</th>
                    <th>{{__('Account Number')}}</th>
                    <th>{{__('Account Name')}}</th>
                    <th>{{__('Source id')}}</th>
                    <th>{{__('Document Date')}}</th>

                </tr>
                <tr>
                    <th>#</th>
                    <th >{{__('Debit Curr.')}}</th>
                    <th >{{__('Credit Curr.')}}</th>
                    <th >{{__('Currency symbol')}}</th>
                    <th colspan="3" >{{__('Explained')}}</th>

                </tr>
                </thead>

                @foreach($items as $item)
                    <tr class="item {{ $loop->last ? 'last' : '' }}" >
                        <td style="border-right: 1px solid black">{{ $loop->iteration }}</td>
                        <td style="text-align: right;">{{number_format($item['amntdb'], 2, '.', ',')  }}</td>
                        <td style="text-align: right ">{{  number_format($item['amntcr'], 2, '.', ',') }}</td>
                        <td style="text-align: center">{{ $item['accountid'] }}</td>
                        <td style="text-align: center">{{ $item['acc_name'] }}</td>
                        <td>{{ $item['sourceid']}}</td>
                        <td style="border-left: 1px solid black">{{ $item['dydate'] }}</td>
                    </tr>
                    <tr >
                        <td style="border-bottom: 1px solid black;border-right: 1px solid black; "> </td>
                        <td style="text-align: right;border-bottom: 1px solid black ">{{  number_format($item['amntdbc'], 2, '.', ',') }}</td>
                        <td style="text-align: right;border-bottom: 1px solid black">{{  number_format($item['amntcrc'], 2, '.', ',')}}</td>
                        <td style=" text-align: center; border-bottom: 1px solid black">{{ $item['currcode'] }}</td>
                        <td  colspan="3" style=" text-align: center;padding-right: 30px;border-bottom: 1px solid black;border-left: 1px solid black">{{ $item['docno'] }},  {{ $item['docdate'] }},  {{ $item['description'] }} </td>
                     
                    </tr>
                    

                @endforeach
                <tr>
                    <th>#</th>
                <th>{{__('Total')}}</th>
            

                </tr>
                <tr>
                    <td style="border-right: 1px solid black"></td>
                    <td style="text-align: right; ">{{ number_format($totaldb, 2, '.', ',') }}
                    <td style="text-align: right;">{{ number_format($totalcr, 2, '.', ',') }}
                    </td>
                    <td style="text-align: right">{{ number_format($subAmount, 2, '.', ',') }} </td>
                </tr>
                <tr>
                    <td style=" border-bottom: 1px solid black;border-right: 1px solid black"></td>
                    <td style="text-align: right; border-bottom: 1px solid black">{{ number_format($totaldbc, 2, '.', ',') }} </td>
                    <td style="text-align: right; border-bottom: 1px solid black">{{ number_format($totalcrc, 2, '.', ',') }} </td>

                    <td style="text-align: right; border-bottom: 1px solid black ">{{ number_format($subAmountc, 2, '.', ',') }} </td>

                </tr>
            </table>

        </div>
    </div>
</div>
</body>
</html>
