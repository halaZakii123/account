@extends('layouts.amz')
@section('style')
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />--}}
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                {{--                        <h4 class="page-title">{{ Request::segment(1) }}</h4>--}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">{{__('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('blSheet')}}</li>

                    </ol>
                </nav>

            </div>
        </div>
    </div>
    @if($sheets != null)
        <div class="dropdown dropleft float-right">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                {{__('More')}}
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('printSheet',[$from,$to])}}" class="btn btn-primary ml-auto">{{__('print')}}</a>
                <a class="dropdown-item" href="{{route('pdfSheet',[$from,$to])}}" class="btn btn-primary ml-auto">{{__('pdf')}}</a>
            </div>
        </div>
    @endif
            <div class="col-md-10"style="margin: auto">
                <div class="card-header d-flex">


                </div>

                <div>
                    <form method="POST"  name ="aa" on onsubmit="return v" action="{!! route('BLsheet') !!}">
                        @csrf

                        <p>{{__('please select one :')}}</p>

                        <div class="form-group">

                            <div>
                                <input type="date" id="doc_date_value" name="date_from" value="{{$first}}"  >
                                <input type="date" id="doc_date_value" name="date_to" value="{{$last}}"><br>
                            </div>

                            <div>

                                <div class="form-group" type="submit">
                                    <button type="submit"> {{__('Search')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                @if($sheets != null)
                    <h5>{{__('Result by Balance sheet')}}  {{__('between')}} {{$from}} / {{$to}}:</h5>

                @endif
                <table class="table table-bordered display responsive   optionDataTable" >
                    <thead >
                    <tr style="background-color: #95999c">
                        <th>{{__('Account ID')}}</th>
                        <th>{{__('Account Name')}}</th>
                        <th>{{__('Account belongTO')}}</th>
                        <th>{{__('Final Report')}}</th>
                        <th >{{__('Master')}}</th>
                        <th>{{__('Total Debit')}}</th>
                        <th>{{__('Total Credit')}}</th>
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

            </div>



@endsection


@section('script')


@endsection
