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
                    <th>#</th>
                    <th>{{__('Sum Trans debit')}}</th>
                    <th>{{__('Sum Trans credit')}}</th>
                    <th>{{__('Sum Trans debit M')}}</th>
                    <th>{{__('Sum Trans credit M')}}</th>
                    <th>{{__('Currency symbol')}}</th>
                    <th>{{__('Account Number')}}</th>
                    <th>{{__('Account Name')}}</th>
                    <th>{{__('Final Report')}}</th>

                </tr>
                </thead>

                @foreach($items as $item)
                    <tr class="item {{ $loop->last ? 'last' : '' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td style="text-align: right">{{number_format($item['trans_db'], 2, '.', ',')  }}</td>
                        <td style="text-align: right">{{  number_format($item['trans_cr'], 2, '.', ',') }}</td>
                        <td style="text-align: right">{{  number_format($item['trans_dbc'], 2, '.', ',') }}</td>
                        <td style="text-align: right">{{  number_format($item['trans_crc'], 2, '.', ',') }}</td>
                        <td>{{  $item['trans_curr'] }}</td>
                        <td>{{ $item['acc_id'] }}</td>
                        <td>{{ $item['acc_name'] }}</td>
                        <td>{{ $item['acc_finalReport'] }}</td>
                    </tr>
                    @endforeach
            </table>

        </div>
    </div>
</div>
</body>
</html>
