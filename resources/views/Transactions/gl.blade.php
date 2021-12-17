@extends('layouts.amz')
@section('style')

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
                        <li class="breadcrumb-item active" aria-current="page">{{__('gl')}}</li>

                    </ol>
                </nav>

            </div>
        </div>
    </div>

   
    <div class="col-md-10" style="margin:auto ">
       <div class="card">
          <div class="card-header d-flex">            
            <div>
              <form method="get" action=" {{route('search')}}" >
                    <label>{{__('Search between two dates')}}</label>
                        <div >
                            <div class ="form-group" >
                                <label style="font-size: small"> {{__('start date :')}}</label>
                                <input type="date" id="startDate" name="from" placeholder="yyyy-mm-dd"  autocomplete="on">
                                <label style="font-size: small"> {{__('end date :')}}</label>
                                <input type="date" id="endDate"  name="to"  placeholder="yyyy-mm-dd"  autocomplete="on" >
                                <button type="submit" ><i class="fas fa-search"></i>
                                    
                                </button>
                                
                            </div>
                        </div>
                </form>
            </div>
         </div>
    </div>
                @if($trans != null)
                        <h5>{{__('Result by Account Number')}} {{$account_number}} {{__('between')}} {{$from}} / {{$to}}:</h5>

                @endif
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
                        <th style="border-bottom: 2px solid black">{{__('Debit M')}}</th>
                        <th style="border-bottom: 2px solid black">{{__('Credit M')}}</th>
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
                        <th>{{__('Total')}}</th>
                        <th>{{__('Sub')}}</th>
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
                @if(!empty($trans))  
                           <div class="col-12">
                              <a href="{{route('printAcc',[$account_number,$from,$to])}}" class="btn btn-success float-right"><i class="fas fa-print"></i> {{__('print')}} </a>
                              <a href="{{route('pdfAcc',[$account_number,$from,$to])}}" class="btn btn-primary float-right" style="margin-left: 10px;"><i class="fas fa-download"></i> {{__('Generate PDF')}} </a>
                              
                            </div>
                 @endif
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
