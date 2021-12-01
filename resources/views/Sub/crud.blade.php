@extends('layouts.amz')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{!! !empty($sub) ? "/update/$sub->id/$main" : "/store/$id"!!}">
                            @csrf
                            @if (!empty($account))
                                @method('PUT')
                            @endif
                            <div class="form-group row">
                                <label for="debit" class="col-md-4 col-form-label text-md-right">{{ __('Debit') }}</label>

                                <div class="col-md-6">
                                    <input id="debit" type="number" class="form-control @error('debit') is-invalid @enderror" name="debit" value= "@if (!empty($sub)) {{ $sub->debit}} @else {{ old('debit') }} @endif" required autocomplete="debit" autofocus>
                                    {{$errors->first('debit')}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="credit" class="col-md-4 col-form-label text-md-right">{{ __('Credit') }}</label>
                                <div class="col-md-6">
                                    <input id="credit" type="text" class="form-control @error('credit') is-invalid @enderror" name="credit" value= "@if (!empty($sub)) {{ $sub->credit}} @else {{ old('credit') }} @endif" required >
                                    {{$errors->first('credit')}}

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>

                                <div class="col-md-6">
                                    <select name="account_number" id="account_number" >
                                        <option value="" disabled> Select Account Number</option>

                                        @foreach($accounts as $account)
                                            @if(!empty($sub))
                                                <option value=" {{$account->account_number}} "{{ $sub->account_number == $account->account_number? 'selected' : '' }} >{{$account->account_number}}  </option>
                                            @else
                                                <option value="{{$account->account_number}}" {{ old('account_number')? 'selected' : '' }} >{{$account->account_number}}  </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('account_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="explained" class="col-md-4 col-form-label text-md-right">{{ __('Explained') }}</label>
                                <div class="col-md-6">
                                    <input id="explained" type="text" class="form-control @error('explained') is-invalid @enderror" name="explained" value= "@if (!empty($sub)) {{ $sub->explained}} @else {{ old('explained') }} @endif" required >
                                    {{$errors->first('explained')}}

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

