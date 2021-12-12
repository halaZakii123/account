<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> Account </title>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/><link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
    <table class="table-bordered">
        <tr class="top">
            <td colspan="6">
                <table>
                    <tr>
                        <td width="35%">

                            {{__('Date')}} :{{ Carbon\Carbon::now()->format('Y-m-d') }}<br>
                        </td>
                    </tr>


                </table>
            </td>
        </tr>



        <tr class="heading">

            <td>{{__('Account Number')}}</td>
            <td>{{__('Account Name')}}</td>
            <td>{{__('Master Account number')}}</td>
            <td>{{__('Report')}}</td>
            <td>{{__('Mainly')}}</td>
        </tr>

        @foreach($accounts as $account)

        <tr class="item">
            <td>{{$account->account_number}}</td>
            <td>{{$account->account_name}}</td>
            <td>{{$account->master_account_number}}</td>
            <td>@if($account->report == 1)
                    {{__('budget')}}
                @else
                    {{__('Income list')}}
                @endif
                </td>
            <td>
                @if($account->mainly == 1)
                    <i class="fas fa-check"></i>
                @elseif($account->mainly == null)
                    <i class="fa fa-times"></i>
                @endif
            </td>
        </tr>
            @endforeach
    </table>
</div>
<script>
    window.print();
</script>
</body>
</html>
