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

                        <form method="POST" action="{!! !empty($main) ? route('Mains.update',$main->id)  : route('Mains.store') !!}">
                            @csrf
                            @if (!empty($main))
                                @method('PUT')
                            @endif
                            <div class="form-group row">
                                <label for="operation_date" class="col-md-4 col-form-label text-md-right">{{ __('Operation Date') }}</label>
                                <div class="col-md-6">
                                    <input id="operation_date" type="text" class="form-control @error('operation_date') is-invalid @enderror" name="operation_date" value= "@if (!empty($main)) {{$main->operation_date}} @else {{ old('operation_date') }} @endif" required autocomplete="operation_date" autofocus placeholder="yyyy-mm-dd">
                                    {{$errors->first('operation_date')}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="explained" class="col-md-4 col-form-label text-md-right">{{ __('Explained') }}</label>
                                <div class="col-md-6">
                                    <input id="explained" type="text" class="form-control @error('explained') is-invalid @enderror" name="explained" value= "@if (!empty($main)) {{ $main->explained}} @else {{ old('explained') }} @endif" required >
                                    {{$errors->first('explained')}}

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type_of_operation" class="col-md-4 col-form-label text-md-right">{{ __('Type of Operation') }}</label>
                                <div class="col-md-6">
                                    <select name="type_of_operation" id="type_of_operation" >
                                        <option value="" disabled> Select type of operation</option>

                                        @foreach($ops as $op)
                                            @if(!empty($main))
                                                <option value=" {{$op->contents}} "{{ $main->type_of_operation == $op->contents? 'selected' : '' }} >{{$op->contents}} </option>
                                            @else
                                                <option value="{{$op->contents}}" {{ old('type_of_operation')? 'selected' : '' }} >{{$op->contents}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('type_of_operation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="currency_symbol" class="col-md-4 col-form-label text-md-right">{{ __('Currency Symbol') }}</label>
                            <div class="col-md-6">
                                <select name="currency_symbol" id="currency_symbol" >
                                    <option value="" disabled> Select type of operation</option>

                                    @foreach($cus as $cu)
                                        @if(!empty($main))
                                            <option value=" {{$cu->contents}} "{{ $main->currency_symbol == $cu->contents? 'selected' : '' }} >{{$cu->contents}} </option>
                                        @else
                                            <option value="{{$cu->contents}}" {{ old('currency_symbol')? 'selected' : '' }} >{{$cu->contents}} </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('currency_symbol')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                     </span>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group row">
                                <label for="exchange_rate" class="col-md-4 col-form-label text-md-right">{{ __('exchange_rate') }}</label>
                                <div class="col-md-6">
                                    <input id="exchange_rate'" type="text" class="form-control @error('exchange_rate') is-invalid @enderror" name="exchange_rate" value= "@if (!empty($main)) {{ $main->exchange_rate}} @else {{ old('exchange_rate') }} @endif" required >
                                    {{$errors->first('exchange_rate')}}

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

