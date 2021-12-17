<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __() }}</title>

    <style>
        body {
            font-family: 'XBRiyaz', sans-serif;
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
            
        <table class="table" >
            <caption style="font-size:20px;caption-side:top;text-align:center"> {{__('Daily Entry')}} </caption>
            <thead>
            <tr>
                <td style="font-weight: bold">{{ __('Operation Date') }} </td>
                <td >{{ $operation_date }}</td>
                <td style="font-weight: bold">{{ __('Explained') }}</td>
                <td >{{ $explained}}</td>
            </tr>

            <tr>
                <td style="font-weight: bold">{{__('Document Number')}}</td>
                <td>{{ $document_number }} </td>
                <td style="font-weight: bold">{{ __('Document Date') }}</td>
                <td>{{ $doc_date }} </td>

            </tr>
            <thead>
            <tr>
                <td style="font-weight: bold">{{ __('Type of operation') }}</td>
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
                <td style="font-weight: bold">{{ __('Currency symbol') }}</td>
                <td>{{ $currency_symbol }}</td>
            </tr>
            <tr style="padding-bottom: 40px">
                <td style="font-weight: bold">{{ __('Exchange rate') }}</td>
                <td>{{ number_format($exchange_rate , 2, '.', ',')}}</td>
            </tr>

        </table>
        <table class="table ">
            <thead>
            <tr >
                <th>#</td>
                <th>{{ __('Debit') }}</th>
                <th>{{ __('Credit') }}</th>
                <th>{{ __('Account Number') }}</th>
                <th>{{ __('Explained') }}</th>
            </tr>
            </thead>

        @foreach($items as $item)
            <tr class="item {{ $loop->last ? 'last' : '' }}">
                <td>{{ $loop->iteration }}</td>
                <td style="text-align: right;">{{ number_format($item['debit'], 2, '.', ',') }}</td>
                <td style="text-align: right ">{{number_format($item['credit'], 2, '.', ',')  }}</td>

                <td >{{ $item['account_number'] }}</td>
                <td >{{ $item['explained'] }}</td>

            </tr>
        @endforeach
            <tfoot>
            <tr>
                <th >{{_('Total')}}</th>
                <td style="text-align: right">{{number_format($totalDebit, 2, '.', ',')}}</td>
                <td style="text-align: right" >{{number_format($totalCredit, 2, '.', ',')}}</td>  </tr>
            </tfoot>
    </table>
    

</div>
            </div>
</div>
</body>
</html>
