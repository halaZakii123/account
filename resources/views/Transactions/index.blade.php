@extends('layouts.app')
@section('style')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-header d-flex">
                    @if($trans != null)
                    @if($searchType == 'account_number')
                        <a href="/printTrans/{{$searchType}}/{{$account_number}}/{{$from}}/{{$to}}" class="btn btn-primary ml-auto">{{__('print')}}</a>
                        <a href="/pdfTrans/{{$searchType}}/{{$account_number}}/{{$from}}/{{$to}}" class="btn btn-primary ml-auto">{{__('pdf')}}</a>
                    @elseif($searchType == 'source_id')
                        <a href="/printTrans/{{$searchType}}/{{$source_id}}" class="btn btn-primary ml-auto">{{__('print')}}</a>
                        <a href="/pdfTrans/{{$searchType}}/{{$source_id}}" class="btn btn-primary ml-auto">{{__('pdf')}}</a>
                    @else
                        <a href="/printTrans/{{$searchType}}/{{$dateFrom}}/{{$dateTo}}" class="btn btn-primary ml-auto">{{__('print')}}</a>
                        <a href="/pdfTrans/{{$searchType}}/{{$dateFrom}}/{{$dateTo}}" class="btn btn-primary ml-auto">{{__('pdf')}}</a>
                    @endif
                    @endif

                </div>

                <div>
                    <div>
                        <form method="POST"  name ="aa" on onsubmit="return v" action="{!! route('TransSearch') !!}">
                            @csrf

                            <p>{{__('please select one :')}}</p>

                            <div class="form-group">
                                <div>
                                      <input type="radio" id="account_number" name="trans" value="account_number" checked>
                                      <label for="html">{{__('Account Number')}}</label>
                                </div>
                                <div class="row" style="margin-bottom: 10px">
                                    <div  class="col-md-1">
                                    </div>
                                    <div >
                                        <select name="account_number_value">
                                            @foreach($allTrans as $tran)
                                              <option value="{{$tran->accountid}}"> {{$tran->accountid}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div >
                                        <input type="date" id="doc_date_value" name="A_date_from" >
                                        <input type="date" id="doc_date_value" name="A_date_to"><br>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <input type="radio" id="sourc_id" name="trans" value="source_id">
                                      <label for="html">{{__('Source id')}}</label>
                                    <div class="row">
                                        <div  class="col-md-1">
                                        </div>
                                        <select name="source_id_value">
                                            @foreach($allTransSource as $tran)
                                                <option value="{{$tran->sourceid}}"> {{$tran->sourceid}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <input type="radio" id="doc_date" name="trans" value="doc_date">
                                      <label for="html">{{__('From date to date')}}</label>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <input type="date" id="doc_date_value" name="doc_date_from" >
                                        <input type="date" id="doc_date_value" name="doc_date_to"><br>
                                    </div>

                                </div>
                                <div class="form-group" type="submit">
                                    <button type="submit"> {{__('Search')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
        <hr>
                    @if($trans != null)
                    @if($searchType == 'account_number')
                      <h5>{{__('Result by Account Number')}} {{$account_number}} {{__('between')}} {{$from}} / {{$to}}:</h5>
                    @elseif($searchType == 'source_id')
                        <h5>{{__('Result by source id')}} {{$source_id}} :</h5>
                    @else
                        <h5>{{__('Result by date')}} {{__('From:')}} {{$dateFrome}} {{__('To:')}} {{$dateTo}} : </h5>
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
                                <td >{{ number_format($tran->amntdb, 2, ',', '.') }}</td>
                                <td>{{ number_format($tran->amntcr, 2, ',', '.') }}</td>
                                <td>{{$tran->accountid}}</td>
                                <td></td>
                                <td>{{$tran->sourceid}}</td>
                                <td>{{$tran->dydate}}</td>
                            </tr>
                            <tr class="active" style="border-left: 2px solid black;border-right: 2px solid black; border-bottom: 2px solid black">
                                <td >{{ number_format($tran->amntdbc, 2, ',', '.') }}</td>
                                <td> {{ number_format($tran->amntcrc, 2, ',', '.') }}</td>
                                <td>{{$tran->currcode}}</td>
                                <td colspan="3" style="text-align: center;padding-right: 30px"> {{$tran->docno}} , {{$tran->docdate}} , @if (app()->getLocale() == 'ar'){{$tran->description_ar}} @else  {{$tran->description_en}} @endif </td>

                            </tr>

                        @endforeach
                        <tr>
                            <td>{{ number_format($totaldb, 2, ',', '.') }}
                            <td>{{ number_format($totalcr, 2, ',', '.') }}
                            </td>
                            <td colspan="4">{{__('Total')}}</td>
                        </tr>
                        <tr>
                            <td>{{ number_format($totaldbc, 2, ',', '.') }}
                            <td>{{ number_format($totalcrc, 2, ',', '.') }}

                            <td colspan="4">{{__('Total')}}</td>
                        </tr>
                        </tbody>
                        @endif
                    </table>

                </div>


            </div>
        </div>
    </div>
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

{{--<script type="text/javascript">--}}

{{--    $.ajaxSetup({--}}
{{--        headers: {--}}
{{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--        }--}}
{{--    });--}}

{{--    $(".btn-submit").click(function(e){--}}

{{--        e.preventDefault();--}}

{{--        // var name = $("input[name=name]").val();--}}
{{--        // var password = $("input[name=password]").val();--}}
{{--        // var email = $("input[name=email]").val();--}}
{{--         var type = "{{$searchType}}"--}}
{{--        $.ajax({--}}
{{--            type:'POST',--}}
{{--            url:"{{ route('ajaxRequest.post') }}",--}}
{{--            data:{type:type},--}}
{{--            success:function(data){--}}
{{--                alert(data.success);--}}
{{--            }--}}
{{--        });--}}

{{--    });--}}
{{--</script>--}}
@section('script')

@endsection
