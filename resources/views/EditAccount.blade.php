@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __(Auth::user()->company_name) }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                      <label> Edit Account</label>
                        <form method="POST" action="/update_account/{{$account->id}}">
                            @csrf

                            <div class="form-group row">
                                <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>

                                <div class="col-md-6">
                                    <input id="account_number" type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number"  value=" {{ old('account_number')}}" {{$account->account_number}} required autocomplete="account_number" autofocus>

                                    @error('account_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="account_name" class="col-md-4 col-form-label text-md-right">{{ __('Account Name') }}</label>

                                <div class="col-md-6">
                                    <input id="account_name" type="text" class="form-control @error('account_name') is-invalid @enderror" name="account_name"  value=" {{ old('account_name')  }}" required autocomplete="email">

                                    @error('account_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="master_account_number" class="col-md-4 col-form-label text-md-right">{{ __('Master Account number') }}</label>

                                <div class="col-md-6">
                                    <select name="master_account_number" id="master_account_number" >
                                        <option value="" disabled> Select master acount _number</option>
                                        @foreach($views as $view)
                                            <option value= {{$view->account_number}}> {{$view->account_number}}</option>
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
                                    <select name="report" id="report" >
                                        <option value="" disabled> Select Type of report</option>
                                        <option value="budget" > {{__('budget')}}</option>
                                        <option value="list" > {{__('list')}}</option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="mainly" class="col-md-4 col-form-label text-md-right">{{ __('Mainly') }}</label>

                                <div class="col-md-6">
                                    <input type="checkbox" name="mainly" class="switch-input" value="1" {{ old('mainly') ? 'checked="checked"' : '' }}/>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit') }}
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

