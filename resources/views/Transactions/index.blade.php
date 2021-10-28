@extends('layouts.app')
@section('style')
@section('content')
    @if($trans != null)
        <div class="dropdown dropleft float-right">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                {{__('More')}}
            </button>
            <div class="dropdown-menu">


                    @if($searchType == 'source_id')
                        <a class="dropdown-item" href="{{route('pdfSource',[$searchType,$source_id])}}" class="btn btn-primary ml-auto">{{__('pdf')}}</a>
                        <a class="dropdown-item" href="{{route('printSource',[$searchType,$source_id])}}" class="btn btn-primary ml-auto">{{__('print')}}</a>
                    @else
                        <a class="dropdown-item" href="{{route('pdfdate',[$searchType,$dateFrom,$dateTo])}}" class="btn btn-primary ml-auto">{{__('pdf')}}</a>
                        <a class="dropdown-item" href="{{route('printdate',[$searchType,$dateFrom,$dateTo])}}" class="btn btn-primary ml-auto">{{__('print')}}</a>
                    @endif

            </div>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-header d-flex">


                </div>

                    <div>
                        <form method="POST"  name ="aa" on onsubmit="return v" action="{!! route('TransSearch') !!}">
                            @csrf

                            <p>{{__('please select one :')}}</p>

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
                                    <input type="date" id="doc_date_value" name="doc_date_to" value="{{$last}}"><br>
                                <div class="form-group" type="submit">
                                    <button type="submit"> {{__('Search')}}</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>

                    @if($trans != null)
                    @if($searchType == 'account_number')
                      <h5>{{__('Result by Account Number')}} {{$account_number}} {{__('between')}} {{$from}} / {{$to}}:</h5>
                    @elseif($searchType == 'source_id')
                        <h5>{{__('Result by source id')}} {{$source_id}} :</h5>
                    @else
                        <h5>{{__('Result by date')}} {{__('From:')}} {{$dateFrom}} {{__('To:')}} {{$dateTo}} : </h5>
                    @endif
                    @endif
                    <table class="table table-bordered display responsive nowrap  optionDataTable" >
                        <thead >
                        <tr style="background-color: #95999c">
                            <th>{{__('Debit')}}</th>
                            <th>{{__('Credit')}}</th>
                            <th>{{__('Account Number')}}</th>
                            <th>{{__('Account Name')}}</th>
                            <th>{{__('Source id')}}</th>
                            <th>{{__('Document Date')}}</th>

                        </tr>
                        <tr style="background-color: #95999c">
                            <th style="border-bottom: 2px solid black">{{__('Debit M')}}</th>
                            <th style="border-bottom: 2px solid black">{{__('Credit M')}}</th>
                            <th style="border-bottom: 2px solid black">{{__('Currency symbol')}}</th>
                            <th colspan="3" style="text-align: center;border-bottom: 2px solid black">{{__('Explained')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if($trans != null)
                        @foreach($trans  as $tran )
                            <tr class="active" style="border-left: 2px solid black;border-top: 2px solid black;border-right: 2px solid black">
                                <td  style="text-align: right">{{ number_format($tran->trans_db, 2, '.', ',') }}</td>
                                <td style="text-align: right">{{ number_format($tran->trans_cr, 2, '.', ',') }}</td>
                                <td>{{$tran->trans_accno}}</td>
                                <td>{{$tran->acc_name}}</td>
                                <td>{{$tran->trans_sid}}</td>
                                <td>{{$tran->trans_date}}</td>
                            </tr>
                            <tr class="active" style="border-left: 2px solid black;border-right: 2px solid black; border-bottom: 2px solid black">
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
