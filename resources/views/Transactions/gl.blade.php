@extends('layouts.amz')
@section('style')
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
                {{--                        <h4 class="page-title">{{ Request::segment(1) }}</h4>--}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">{{__('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('General ledger')}}</li>

                    </ol>
                </nav>

            </div>
        </div>
    </div>

   
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="callout callout-primary">
                  <h5>{{__('please select one :')}} </h5>

                  <form method="get"  name ="aa" on onsubmit="return v" action="{!! route('TransSearchAccount') !!}">
                    

                        <div class="form-group">

                               <div>
                                <input type="radio" id="account_number" name="trans" value="account_number" checked>
                                  <label for="html">{{__('Account Number')}} :</label>
                                <select name="account_number_value">
                                    @foreach($allTrans as $tran)
                                        @foreach($account as $acc)
                                            @if($acc->account_number == $tran->accountid)
                                                <option value="{{$tran->accountid}}"> {{$tran->accountid}} {{$acc->account_name}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                                <input type="date" id="doc_date_value" name="A_date_from" value="{{$first}}"  >
                                <input type="date" id="doc_date_value" name="A_date_to" value="{{$last}}"><br>
                             </div>
 

                             <div class="center" style="display: flex; justify-content: center; margin-top:20px">

                                <div class="form-group" type="submit" >
                                    <button type="submit" class="btn btn-info"> <i class="fas fa-search"></i> {{__('search')}} </button>
                                </div>
                              </div>
                        </div>
                    </form>
                </div>

                @if($trans != null)
                        <h5>{{__('Result by Account Number')}} {{$account_number}} {{__('between')}} {{$from}} / {{$to}}:</h5>

                <div class="table-responsive">
                <table class="table table-bordered display responsive nowrap  optionDataTable" >
                    <thead >
                    <tr style="background-color: #D3D3D3">
                        <th>{{__('Debit')}}</th>
                        <th>{{__('Credit')}}</th>
                        <th>{{__('Account Number')}}</th>
                        <th>{{__('Account Name')}}</th>
                        <th>{{__('Source id')}}</th>
                        <th>{{__('Document Date')}}</th>

                    </tr>
                    <tr style="background-color: #D3D3D3">
                        <th style="border-bottom: 2px solid black">{{__('Debit Curr.')}}</th>
                        <th style="border-bottom: 2px solid black">{{__('Credit Curr.')}}</th>
                        <th style="border-bottom: 2px solid black">{{__('Currency symbol')}}</th>
                        <th colspan="3" style="text-align: center;border-bottom: 2px solid black">{{__('Explained')}}</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if($trans != null)
                        @foreach($trans  as $tran )
                            <tr class="active" style="border-top: 2px solid black">
                                <td  style="text-align: right">{{ number_format($tran->trans_db, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($tran->trans_cr, 2, '.', ',') }}</td>
                                <td>{{$tran->trans_accno}}</td>
                                <td>{{$tran->acc_name}}</td>
                                <td>{{$tran->trans_sid}}</td>
                                <td>{{$tran->trans_date}}</td>
                            </tr>
                            <tr class="active" style=" border-bottom: 2px solid black">
                                <td style="text-align: right">{{ number_format($tran->trans_dbc, 2, '.', ',') }}</td>
                                <td style="text-align: right"> {{ number_format($tran->trans_crc, 2, '.', ',') }}</td>
                                <td>{{$tran->trans_curr}}</td>
                                <td colspan="3" style="text-align: center;padding-right: 30px"> {{$tran->trans_docno}} , {{$tran->trans_docdate}} , @if (app()->getLocale() == 'ar'){{$tran->trans_descrip_ar}} @else  {{$tran->trans_descrip_en}} @endif </td>

                            </tr>

                        @endforeach
                        <th>{{__('Total')}}</th>
                        
                        <tr>

                            <td style="text-align: right">{{ number_format($totaldb, 2, '.', ',') }}
                            <td style="text-align: right">{{ number_format($totalcr, 2, '.', ',') }}
                            </td>
                            <td style="text-align: right">{{ number_format($subAmount, 2, '.', ',') }} </td>
                        </tr>
                        <tr>
                            <td style="text-align: right">{{ number_format($totaldbc, 2, '.', ',') }} </td>
                            <td style="text-align: right">{{ number_format($totalcrc, 2, '.', ',') }} </td>

                            <td style="text-align: right" >{{ number_format($subAmountc, 2, '.', ',') }} </td>

                        </tr>
                    </tbody>
                    @endif
                </table>
                @endif
                @if(!empty($trans))  
                           <div class="col-12">
                              <a href="{{route('printAcc',[$account_number,$from,$to])}}" class="btn btn-success float-right"><i class="fas fa-print"></i> {{__('print')}} </a>
                              <a href="{{route('pdfAcc',[$account_number,$from,$to])}}" class="btn btn-primary float-right" style="margin-left: 10px;"><i class="fas fa-download"></i> {{__('Generate PDF')}} </a>
                              
                            </div>
                 @endif
            </div>
            </div>


        </div>
    </div>
    <div class="social-media">
        <ul class="list-unstyled social-fa">
            <li><a href="https://www.facebook.com/siic.sy"><i class="fa fa-facebook"></i></a></li>
        </ul>
        <ul class="list-unstyled social-tw">
            <li><a href="https://twitter.com/SIIC_SY"><i class="fa fa-twitter"></i></a></li>
        </ul>
        <ul class="list-unstyled social-gm">
            <li><a href="mailto:info@siic-insurance.com"><i class="fa fa-google"></i></a></li>
        </ul>
    </div>
@endsection


@section('script')

@endsection
