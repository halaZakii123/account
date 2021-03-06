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
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">{{__('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Financial constraints')}}</li>

                    </ol>
                </nav>

            </div>
        </div>
    </div>




            <div class="col-md-10"  style="margin: auto;">
            <div class="callout callout-primary">
                  <h5>{{__('please select one :')}} </h5>

            <form method="get"  name ="aa" on onsubmit="return v" action="{!! route('TransSearch') !!}">

                <div class="form-group">
                <div>
                    <input type="radio" id="sourc_id" name="trans" value="source_id" checked>
                      <label for="html">{{__('Source id')}} :</label>
                    <select name="source_id_value">
                        @foreach($allTransSource as $tran)
                            <option value="{{$tran->sourceid}}"> {{$tran->sourceid}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <input type="radio" id="doc_date" name="trans" value="doc_date">
                    <label for="html">{{__('From date to date')}}</label>
                    <input type="date" id="doc_date_value" name="doc_date_from"  value="{{$first}}">
                    <input type="date" id="doc_date_value" name="doc_date_to" value="{{$last}}">
                    <button type="submit" class="btn btn-info"> <i class="fas fa-search"></i> {{__('search')}} </button>

                    </div>

                </div>
            </form>
                </div>

                   @if($trans != null)
                       @if($searchType == 'source_id')
                            <h5>{{__('Result by source id')}} {{$source_id}} :</h5>
                        @else
                            <h5>{{__('Result by date')}} {{__('From:')}} {{$dateFrom}} {{__('To:')}} {{$dateTo}} : </h5>
                        @endif

                        <div class=" table-responsive">
                            
                     <table class="table table-bordered display responsive nowrap  optionDataTable" >
                        <thead >
                        <tr style="background-color:#D3D3D3">
                            <th>{{__('Debit')}}</th>
                            <th>{{__('Credit')}}</th>
                            <th>{{__('Account Number')}}</th>
                            <th>{{__('Account Name')}}</th>
                            <th>{{__('Document Number')}}</th>
                            <th>{{__('Document Date')}}</th>

                        </tr>
                        <tr style="background-color:#D3D3D3">
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
                                <td>{{$tran->trans_docno}}</td>
                                <td>{{$tran->trans_date}}</td>
                            </tr>
                            <tr class="active" style=" border-bottom: 2px solid black">
                                <td style="text-align: right">{{ number_format($tran->trans_dbc, 2, '.', ',') }}</td>
                                <td style="text-align: right"> {{ number_format($tran->trans_crc, 2, '.', ',') }}</td>
                                <td>{{$tran->trans_curr}}</td>
                                <td colspan="3" style="text-align: center;padding-right: 30px">  {{$tran->trans_docdate}} , @if (app()->getLocale() == 'ar'){{$tran->trans_descrip_ar}} @else  {{$tran->trans_descrip_en}} @endif </td>

                            </tr>

                        @endforeach
                        

                        <tr>

                            <td style="text-align: right">{{ number_format($totaldb, 2, '.', ',') }}
                            <td style="text-align: right">{{ number_format($totalcr, 2, '.', ',') }}
                            </td>
                            <td style="text-align: right">{{ number_format($subAmount, 2, '.', ',') }} </td>
                             <th> {{__('Total')}}</th> 
                        </tr>
                        <tr>
                            <td style="text-align: right">{{ number_format($totaldbc, 2, '.', ',') }} </td>
                            <td style="text-align: right">{{ number_format($totalcrc, 2, '.', ',') }} </td>

                            <td style="text-align: right" >{{ number_format($subAmountc, 2, '.', ',') }} </td>

                        </tr>

                        </tbody>
                        @endif
                    </table>


                           <div class="col-12">
                              @if($searchType == 'source_id')
                                <a href="{{route('printSource',[$searchType,$source_id])}}" class="btn btn-success float-right"><i class="fas fa-print"></i> {{__('print')}} </a>
                                <a href="{{route('pdfSource',[$searchType,$source_id])}}" class="btn btn-danger btn-md active float-right" style="margin-left: 10px;" class="pdf" role="button" aria-pressed="true"><i class="fas fa-download"></i>{{__('Download')}} PDF</a>

                                @else
                               <a href="{{route('printdate',[$searchType,$dateFrom,$dateTo])}}" class="btn btn-success float-right"><i class="fas fa-print"></i> {{__('print')}} </a>
                               <a href="{{route('pdfdate',[$searchType,$dateFrom,$dateTo])}}" class="btn btn-danger btn-md active float-right" style="margin-left: 10px;" class="pdf" role="button" aria-pressed="true"><i class="fas fa-download"></i>{{__('Download')}} PDF</a>

                               @endif
                            </div>
                          @endif

                </div>
                </div>



@endsection

