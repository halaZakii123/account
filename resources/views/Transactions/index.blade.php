@extends('layouts.amz')
@section('style')
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
                        <li class="breadcrumb-item active" aria-current="page">{{__('transactions')}}</li>

                    </ol>
                </nav>

            </div>
        </div>
    </div>


             
   
            <div class="col-md-10"  style="margin: auto;">
               
                   @if($trans != null)
                       @if($searchType == 'source_id')
                            <h5>{{__('Result by source id')}} {{$source_id}} :</h5>
                        @else
                            <h5>{{__('Result by date')}} {{__('From:')}} {{$dateFrom}} {{__('To:')}} {{$dateTo}} : </h5>
                        @endif
                    @endif

                    <table class="table table-bordered display responsive nowrap  optionDataTable" >
                        <thead >
                        <tr style="background-color:#D3D3D3">
                            <th>{{__('Debit')}}</th>
                            <th>{{__('Credit')}}</th>
                            <th>{{__('Account Number')}}</th>
                            <th>{{__('Account Name')}}</th>
                            <th>{{__('Source id')}}</th>
                            <th>{{__('Document Date')}}</th>

                        </tr>
                        <tr style="background-color:#D3D3D3">
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
                              @if($searchType == 'source_id')
                                <a href="{{route('printSource',[$searchType,$source_id])}}" class="btn btn-success float-right"><i class="fas fa-print"></i> {{__('print')}} </a>
                                <a href="{{route('pdfSource',[$searchType,$source_id])}}" class="btn btn-primary float-right" style="margin-left: 10px;"><i class="fas fa-download"></i> {{__('Generate PDF')}} </a>
                              @else
                               <a href="{{route('printdate',[$searchType,$dateFrom,$dateTo])}}" class="btn btn-success float-right"><i class="fas fa-print"></i> {{__('print')}} </a>
                               <a href="{{route('pdfdate',[$searchType,$dateFrom,$dateTo])}}" class="btn btn-primary float-right" style="margin-left: 10px;"><i class="fas fa-download"></i> {{__('Generate PDF')}} </a>
                              @endif
                            </div>
                          @endif 
                </div>
               
                         

@endsection


@section('script')

@endsection
