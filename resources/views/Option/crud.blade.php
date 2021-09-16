@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex">
                        <a href="{{ route('Options.index') }}" class="btn btn-primary ml-auto"><i class="fa fa-home"></i> {{ __('Back') }}</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{!! !empty($option) ? route('Options.update',$option->id)  : route('Options.store') !!}">
                            @csrf
                             @if(!empty($option))
                                 @method('PUT')
                              @endif
                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                                <div class="col-md-6">
                                    <select name="type" id="type" class="type form-control" onchange="validate()">
                                        <option >{{__('select type')}}</option>
                                        @if(!empty($option))
                                            <option  value="currency_symbol" {{$option->type == 'currency_symbol'? 'selected':''}}> {{__('Currency symbol')}}</option>
                                             <option value="type_of_operation"{{$option->type  == 'type_of_operation' ? 'selected' : '' }}  > {{__('Type of operation')}}</option>
                                          @else
                                            <option value="currency_symbol" {{old('type')?'selected' :''}} > {{__('Currency symbol')}}</option>
                                            <option value="type_of_operation" {{old('type')?'selected' :''}}> {{__('Type of operation')}}</option>
                                          @endif
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contents" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                                <div class="col-md-6">
                                    <input id="contents" type="text" class="form-control @error('contents') is-invalid @enderror" name="contents" value="@if(!empty($option)){{$option->contents}} @else {{old('content')? 'selected':''}} @endif" required autocomplete="contents" autofocus>

                                    @error('contents')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exchange_rate" class="col-md-4 col-form-label text-md-right">{{ __('Exchange rate') }}</label>

                                <div class="col-md-6">
                                    <input id="exchange_rate" type="text" class=" enable form-control @error('exchange_rate') is-invalid @enderror" name="exchange_rate" value="@if(!empty($option)){{$option->exchange_rate}} @else {{old('exchange_rate')? 'selected':''}} @endif" required autocomplete="exchange_rate" autofocus @if(!empty($option and $option->type == "currency_symbol"))  disabled="false" @else disabled="true" @endif>

                                    @error('exchange_rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
    <script>
        function validate()
        {
            var ddl = document.getElementById("type");
            var selectedValue = ddl.options[ddl.selectedIndex].value;
            if (selectedValue === 'currency_symbol')
            {
                $('.enable').prop('disabled', false);
            }
            else{
                $('.enable').prop('disabled', true);
            }
        }
        </script>
@endsection


