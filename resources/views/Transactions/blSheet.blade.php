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
    
            <div class="col-md-11"style="margin: auto">
            
                @if($sheets != null)
                    <h5>{{__('Result')}}  {{__('between')}} {{$from}} / {{$to}}:</h5>

                @endif
                <table class="table table-bordered display responsive   optionDataTable" >
                    <thead >
                    <tr style="background-color: #95999c">
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
                    <tr style="background-color: #95999c">
                    <th >{{__('DTot_DB')}}</th>
                        <th >{{__('DTot_Crc')}}</th>
                        <th >{{__('DTot_Balc')}}</th>
                        <th >{{__('DTot_BalDbc')}}</th>
                        <th >{{__('DTot_Crc')}}</th>

                        <th ></th>
                        <th ></th>
                        <th ></th>
                        <th ></th>
                        <th ></th>
                        

                    </tr>
                    </thead>
                    <tbody>
                    @if($sheets != null)
                        @foreach($sheets  as $sheet )
                            <tr class="active" style="border-top: 2px solid black">
                              
                                <td  style="text-align: right">{{ number_format($sheet->Tot_DB, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_Cr, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_Bal, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_BalDb, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_BalCr, 2, '.', ',') }}</td>
                                <td>{{$sheet->acc_name}}</td>
                                <td>{{$sheet->AccID}}</td>
                                
                                <td>{{$sheet->acc_belongTo}}</td>
                                <td> @if($sheet->acc_finalReport == 1)
                                          {{__('budget')}}
                                         @else
                                         {{__('list')}}
                                         @endif</td>
                                <td>@if($sheet->acc_ismaster == 1)
                                            <i class="fas fa-check"></i>
                                        @else
                                        <i class="fa fa-times"></i>
                                       
                                            
                                        @endif</td>
                            </tr>
                            <tr class="active" style="border-bottom: 2px solid black">
                              
                                <td style="text-align: right;font-size: small;color: blue">{{ number_format($sheet->Tot_DBc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_Crc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_Balc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_BalDbc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_BalCrc, 2, '.', ',') }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
                @if(!empty($sheets))
                      <div class="col-12">
                              <a href="{{route('printSheet',[$from,$to])}}" class="btn btn-success float-right"><i class="fas fa-print"></i> {{__('print')}} </a>
                              <a href="{{route('pdfSheet',[$from,$to])}}" class="btn btn-primary float-right" style="margin-left: 10px;"><i class="fas fa-download"></i> {{__('Generate PDF')}} </a>
                              
                        </div>
                 @endif           
            </div>



@endsection


@section('script')


@endsection
