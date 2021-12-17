@extends('layouts.amz')
@section('style')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    
  <style>
      .callout {
  padding: 20px;
  margin: 20px 0;
  border: 1px solid #eee;
  
  border-radius: 3px;
  h4 {
    margin-top: 0;
    margin-bottom: 5px;
  }
  p:last-child {
    margin-bottom: 0;
  }
  code {
    border-radius: 3px;
  }
  & + .bs-callout {
    margin-top: -5px;
  }
}</style>
  @if(app()->getLocale() == 'ar')
   <style>
       .callout{
        border-right-width: 5px ; 
        border-right-color: #428bca
       }
   </style>
  @else
   <style>
       .callout{
        border-left-width: 5px; 
        border-left-color: #428bca
       }
   </style> 
  @endif

 
@endsection
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">{{__('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('General Balance')}}</li>

                    </ol>
                </nav>

            </div>
        </div>
    </div>
    
            <div class="col-md-11"style="margin: auto">
            <div class="callout callout-primary">
                  <h5>{{__('please select date:')}} </h5>

                  <form method="get"  name ="aa" on onsubmit="return v" action="{!! route('BLsheet') !!}">
                        
                        <div class="form-group">

                            <div>
                                <lable> {{__('From:')}}</lable>
                                <input type="date" id="doc_date_value" name="date_from" value="{{$first}}"  >
                                <lable> {{__('To:')}}</lable>
                                <input type="date" id="doc_date_value" name="date_to" value="{{$last}}">
                                <button type="submit" class="btn btn-info"> <i class="fas fa-search"></i> {{__('search')}} </button>

                            </div>

            
                        </div>
                    </form>
                </div>   
                @if($sheets != null)
                    <h5>{{__('Result')}}  {{__('between')}} {{$from}} / {{$to}}:</h5>

                <div class="table-responsive">
                <table class="table table-bordered display responsive   optionDataTable" >
                    <thead >
                    <tr style="background-color: #D3D3D3">
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
                    <tr style="background-color: #D3D3D3">
                    <th >{{__('Total debit')}}</th>
                        <th >{{__('Total credit')}}</th>
                        <th >{{__('Total Balance')}}</th>
                        <th >{{__('Total Balance debit')}}</th>
                        <th >{{__('Total Balance credit')}}</th>
                        

                        <th ></th>
                        <th ></th>
                        <th ></th>
                        <th ></th>
                        <th ></th>
                        

                    </tr>
                    </thead>
                    <tbody>
                    
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
                                         {{__('Income list')}}
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
                        <tr>
                                    <th>{{__('Total')}}</th>
                                </tr>
                                <tr>
                                  <td style="text-align: right"> {{  number_format($totdb, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{  number_format($totcr, 2, '.', ',') }}</td>
                                    <td style="text-align: right">{{  number_format($totBAl, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{ number_format($totBalDb, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{ number_format($totBalCr, 2, '.', ',') }}</td>
                                </tr>
                    </tbody>
                    
                </table>
                
                
                      <div class="col-12" style="margin-bottom":40px>
                              <a href="{{route('printSheet',[$from,$to])}}" class="btn btn-success float-right"><i class="fas fa-print"></i> {{__('print')}} </a>
                              <a href="{{route('pdfSheet',[$from,$to])}}" class="btn btn-danger btn-md active float-right" style="margin-left: 10px;" class="pdf" role="button" aria-pressed="true"><i class="fas fa-download"></i>{{__('Download')}} PDF</a>

                        </div>
                 @endif   
    </div>        
            </div>
            



@endsection


@section('script')


@endsection
