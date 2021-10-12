@extends('layouts.app')
@section('style')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                    <div class="card-header d-flex">
                        {{--                        <a href="{{ route('Options.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>--}}
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
                                                <input type="text" id="account_number_value" name="account_number_value" placeholder="{{__('Enter account number')}} ">
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
                                            <input type="text" id="source_id_value" name="source_id_value" placeholder="{{__('Enter Source id')}}"><br>

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

                            <table class="table table-bordered display responsive nowrap  optionDataTable" >
                                <thead >
                                <tr style="background-color: #95999c">
                                    <th>{{__('Debit')}}</th>
                                    <th>{{__('Credit')}}</th>
                                    <th>{{__('Account_number')}}</th>
                                    <th>{{__('Account_name')}}</th>
                                    <th>{{__('Document Number')}}</th>
                                    <th>{{__('Document Date')}}</th>

                                </tr>
                                <tr style="background-color: #95999c">
                                    <th style="border-bottom: 2px solid black">{{__('Debit M')}}</th>
                                    <th style="border-bottom: 2px solid black">{{__('Credit M')}}</th>
                                    <th style="border-bottom: 2px solid black">{{__('Currency Symbol')}}</th>
                                    <th colspan="3" style="text-align: center;border-bottom: 2px solid black">{{__('Explained')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trans  as $tran )
                                    <tr class="active" style="border-left: 2px solid black;border-top: 2px solid black;border-right: 2px solid black">
                                        <td >{{$tran->amntdb}}</td>
                                        <td>{{$tran->amntcr}}</td>
                                        <td>{{$tran->accountid}}</td>
                                        <td></td>
                                        <td>{{$tran->sourceid}}</td>
                                        <td>{{$tran->dydate}}</td>
                                    </tr>
                                    <tr class="active" style="border-left: 2px solid black;border-right: 2px solid black; border-bottom: 2px solid black">
                                        <td >{{$tran->amntdbc}}</td>
                                        <td>{{$tran->amntcrc}}</td>
                                        <td>{{$tran->currcode}}</td>
                                        <td colspan="3" style="text-align: center;padding-right: 30px"> {{$tran->docno}} , {{$tran->docdate}} , {{$tran->description_ar}}</td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>


                </div>
            </div>
        </div>
@endsection
@section('script')

@endsection
