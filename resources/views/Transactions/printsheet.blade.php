@extends('layouts.print')
@section('style')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/><link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('content')

                <table class="table table-bordered display responsive   optionDataTable" @if (app()->getLocale() == 'ar') style="text-align: right ;direction: rtl;" @endif>
                <caption style=" font-size:20px;caption-side:top;text-align:center"> {{__('General Balance')}} </caption> <br>
                 <h5 @if (app()->getLocale() == 'ar') style="text-align: right ;direction: rtl;" @endif>{{__('Result')}}  {{__('between')}} {{$from}} / {{$to}}:</h5>
  
                <thead >
                    <tr style="background-color: #95999c">
                    <th>{{__('Debit')}}</th>
                        <th>{{__('Credit')}}</th>
                        <th>{{__('Balance')}}</th>
                        <th>{{__('Balance Debit')}}</th>
                        <th>{{__('Balance Credit')}}</th>
                        <th>{{__('Account Name')}}</th>
                        <th>{{__('Account ID')}}</th>
                        <th>{{__('Account belongTO')}}</th>
                        <th>{{__('Final Report')}}</th>
                        <th >{{__('Master')}}</th>
                        
                    </tr>
                    <tr style="background-color: #95999c">
                
                       <th >{{__('Total debit')}}</th>
                        <th >{{__('Total credit')}}</th>
                        <th >{{__('Total Balance')}}</th>
                        <th >{{__('Total Balance debit')}}</th>
                        <th >{{__('Total Balance credit')}}</th>
                        <th colspan="5"></th>
                    </tr>
                    </thead>
                    <tbody>
              
                        @foreach($sheets  as $sheet )
                         @if($b == 1)
                         @if($sheet->acc_finalReport == 1)
                            <tr class="active">
                            <td  style="text-align: right">{{ number_format($sheet->Tot_DB, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_Cr, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_Bal, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_BalDb, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_BalCr, 2, '.', ',') }}</td>
                                <td>{{$sheet->acc_name}}</td>
                                <td>{{$sheet->AccID}}</td>
                            
                                <td>{{$sheet->acc_belongTo}}</td>
                                <td>{{__('budget')}}</td>
                                
                                <td>@if($sheet->acc_ismaster == 1)
                                            <i class="fas fa-check"></i>
                                        @else
                                            <i class="fa fa-times"></i>
                                        @endif</td>
                                
                            </tr>
                            <tr class="active" style=" border-bottom: 2px solid black">
                                
                                <td style="text-align: right;font-size: small;color: blue">{{ number_format($sheet->Tot_DBc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_Crc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_Balc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_BalDbc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_BalCrc, 2, '.', ',') }}</td>
                                <td colspan="5"></td>

                            </tr>
                         
                         @endif

                         @elseif($b == 2)
                          @if($sheet->acc_finalReport == 2)
                            <tr class="active">
                            <td  style="text-align: right">{{ number_format($sheet->Tot_DB, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_Cr, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_Bal, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_BalDb, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_BalCr, 2, '.', ',') }}</td>
                                <td>{{$sheet->acc_name}}</td>
                                <td>{{$sheet->AccID}}</td>
                            
                                <td>{{$sheet->acc_belongTo}}</td>
                                <td>{{__('Income list')}}</td>
                                
                                <td>@if($sheet->acc_ismaster == 1)
                                            <i class="fas fa-check"></i>
                                        @else
                                            <i class="fa fa-times"></i>
                                        @endif</td>
                                
                            </tr>
                            <tr class="active" style=" border-bottom: 2px solid black">
                                
                                <td style="text-align: right;font-size: small;color: blue">{{ number_format($sheet->Tot_DBc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_Crc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_Balc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_BalDbc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_BalCrc, 2, '.', ',') }}</td>
                                <td colspan="5"></td>

                            </tr>
                         
                         @endif

                         @elseif($b == 3)
                            <tr class="active">
                            <td  style="text-align: right">{{ number_format($sheet->Tot_DB, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_Cr, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_Bal, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_BalDb, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($sheet->Tot_BalCr, 2, '.', ',') }}</td>
                                <td>{{$sheet->acc_name}}</td>
                                <td>{{$sheet->AccID}}</td>
                            
                                <td>{{$sheet->acc_belongTo}}</td>
                                <td>@if($sheet->acc_finalReport == 1)
                                          {{__('budget')}}
                                         @else
                                         {{__('Income list')}}
                                         @endif</td>
                                <td>@if($sheet->acc_ismaster == 1)
                                            <i class="fas fa-check"></i>
                                        @else
                                            <i class="fa fa-times"></i>
                                        @endif</td>
                                
                            </tr>
                            <tr class="active" style=" border-bottom: 2px solid black">
                                
                                <td style="text-align: right;font-size: small;color: blue">{{ number_format($sheet->Tot_DBc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_Crc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_Balc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_BalDbc, 2, '.', ',') }}</td>
                                <td style="text-align: right;font-size: small;color: blue"> {{ number_format($sheet->Tot_BalCrc, 2, '.', ',') }}</td>
                                <td colspan="5"></td>

                            </tr>
                         @endif
                        @endforeach
                       
                                <tr>
                                  <td style="text-align: right"> {{  number_format($totdb, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{  number_format($totcr, 2, '.', ',') }}</td>
                                    <td style="text-align: right">{{  number_format($totBAl, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{ number_format($totBalDb, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{ number_format($totBalCr, 2, '.', ',') }}</td>
                                    <th> {{__('Total')}}</th> 
                                </tr>
                    </tbody>
                    
                </table>


@endsection

@section('script')

    <script>
        window.print();
    </script>
@endsection
