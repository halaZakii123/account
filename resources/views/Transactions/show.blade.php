@extends('layouts.app')
@section('style')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex">
                        {{--                        <a href="{{ route('Options.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>--}}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
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
        </div>
    </div>
@endsection
@section('script')

@endsection
