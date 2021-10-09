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
                            <form method="POST"  name ="aa" on onsubmit="return v" action="{!! route('TransactionsSelect') !!}">
                                @csrf

                                <p>{{__('please select one :')}}</p>

                                <div class="form-group">
                                  <input type="radio" id="account_number" name="trans" value="account_number" >
                                  <label for="html">{{__('Account Number')}}</label>
                                  <input type="text" id="account_number_value" name="account_number_value" placeholder="{{__('enter account number')}}"> <br>
                                </div>
                                <div class="form-group">
                                  <input type="radio" id="document_number" name="trans" value="document_number">
                                  <label for="html">{{__('Document Number')}}</label>
                                  <input type="text" id="document_number_value" name="document_number_value" placeholder="{{__('enter document number')}}"><br>
                                </div>
                                <div class="form-group">
                                  <input type="radio" id="doc_date" name="trans" value="doc_date">
                                  <label for="html">{{__('From date to date')}}</label>
                                  <input type="date" id="doc_date_value" name="doc_date_from" >
                                  <input type="date" id="doc_date_value" name="doc_date_to"><br>
                                </div>
                                <div class="form-group" type="submit">
                                    <button type="submit"> {{__('submit')}}</button>
                                    </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function displayRadioValue() {
            var ele = document.getElementsByName('trans');

            for(i = 0; i < ele.length; i++) {
                if(ele[i].checked){
                    if (ele[i].value == 'account_number'){
                        $('.account_number').prop('disabled', true);
                        $('.document_number').prop('disabled', false);
                        $('.doc_date').prop('disabled', false);
                    }}
            }}
    </script>
@endsection

