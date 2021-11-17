@extends('layouts.app')

@section('content')
    <script>
        function validate(){
            let x = document.forms["f1"]["account_number"].value;
            if (x == "") {
                alert("Name must be filled out");
                return false;
            }

        }
    </script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex">

                        <a href="{{ route('Accounts.index') }}" class="btn btn-primary ml-auto"><i class="fa fa-home"></i> {{ __('Back') }}</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{!! !empty($account) ? route('Accounts.update',$account->id)  : route('Accounts.store') !!}">
                            @csrf
                            @if (!empty($account))
                                @method('PUT')
                            @endif
                            <div class="form-group row">
                                <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>

                                <div class="col-md-6">
                                    <input id="account_number" type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value= "@if (!empty($account)) {{ $account->account_number}} @else {{ old('account_number') }} @endif" required autocomplete="account_number" autofocus>
                                    {{$errors->first('account_number')}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="account_name" class="col-md-4 col-form-label text-md-right">{{ __('Account Name') }}</label>
                                <div class="col-md-6">
                                    <input id="account_name" type="text" class="form-control @error('account_name') is-invalid @enderror" name="account_name" value= "@if (!empty($account)) {{ $account->account_name}} @else {{ old('account_name') }} @endif" required >
                                    {{$errors->first('account_name')}}

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="master_account_number" class="col-md-4 col-form-label text-md-right">{{ __('Master Account number') }}</label>

                                <div class="col-md-6">
                                    <select name="master_account_number" id="master_account_number"  style="width: 200px">
                                        <option value="" disabled> {{__('Select master account number')}}</option>
                                        <option value="-" > {{__('do not have master')}}</option>
                                        @foreach($views as $view)

                                            @if(!empty($account))
                                                <option value=" {{$view->account_number}} "{{ $account->master_account_number == $view->account_number? 'selected' : '' }} >{{$view->account_number}} {{$view->account_name}} </option>
                                            @else
                                                <option value="{{$view->account_number}}" {{ old('master_account_number')? 'selected' : '' }} >{{$view->account_number}}{{$view->account_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('master_account_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="report" class="col-md-4 col-form-label text-md-right">{{ __('Report') }}</label>

                                <div class="col-md-6">
                                    <select name="report" id="report" style="width: 200px" >
                                        <option value="" disabled>{{__('disabled Select Type of report')}}</option>
                                        @if(!empty($account))
                                            @if($account->report == 1)
                                                <option value=" {{$account->report}} "{{ $account->report == 'report'? 'selected' : '' }} >{{__('budget')}} </option>
                                                <option value=" 2 ">{{__('list')}} </option>
                                            @else
                                                <option value=" {{$account->report}} "{{ $account->report == 'report'? 'selected' : '' }} >{{__('list')}} </option>
                                                <option value="1">{{__('budget')}} </option>
                                            @endif

                                        @else
                                            <option value="1" {{old('report')?'selected' :''}} > {{__('budget')}}</option>
                                            <option value="2" {{old('report')?'selected' :''}}> {{__('list')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mainly" class="col-md-4 col-form-label text-md-right">{{ __('Mainly') }}</label>

                                <div class="col-md-6">
                                    @if((!empty($account)))
                                        <input type="checkbox" name="mainly" class="switch-input" @if($account->mainly == 1) checked value="1" @else value="0" @endif/>
                                    @else
                                        <input type="checkbox" name="mainly" class="switch-input" value="0" />
                                    @endif

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

