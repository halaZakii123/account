@extends('layouts.amz')

@section('content')
    <div class="page-breadcrumb" style="margin-bottom:20px">
        <div class="row">
            <div class="col-5 align-self-center">
                {{--                        <h4 class="page-title">{{ Request::segment(1) }}</h4>--}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">{{__('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Options')}}</li>
                        @if(!empty($option))
                        <li class="breadcrumb-item active" aria-current="page">{{__('update')}}</li>
                        @else
                        <li class="breadcrumb-item active" aria-current="page">{{__('create')}}</li>
                         @endif
                    </ol>
                </nav>

            </div>
        </div>
    </div>

            <div class="col-md-8" style="margin: auto ;">
                <div class="card">
                   

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
                                        <option disabled>{{__('select type')}}</option>
                                        @if(!empty($option))
                                            <option  value="currency_symbol" {{$option->type == 'currency_symbol'? 'selected':''}}> {{__('Currency symbol')}}</option>

                                          @else
                                            <option value="currency_symbol" {{old('type')?'selected' :''}} > {{__('Currency symbol')}}</option>

                                          @endif
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="A form-group row" >
                                <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Value') }}</label>

                                <div class="col-md-6">
                                    <input id="contents" type="text" class="form-control @error('contents') is-invalid @enderror" name="contents" value="@if(!empty($option)){{$option->contents}} @else {{old('contents')? 'selected':''}} @endif" required autocomplete="contents" autofocus>

                                    @error('contents')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="B form-group row"  >
                                <label for="exchange_rate" class="col-md-4 col-form-label text-md-right">{{ __('Exchange rate') }}</label>

                                <div class="col-md-6">
                                    <input id="exchange_rate" type="text" class=" enable form-control @error('exchange_rate') is-invalid @enderror" name="exchange_rate" value="@if(!empty($option)){{$option->exchange_rate}} @else {{old('exchange_rate')? 'selected':''}} @endif" required autocomplete="exchange_rate" autofocus style="text-align: right" >

                                    @error('exchange_rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    
                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{__('Save')}}</button>
                <a href="{{ route('Options.index') }}"><button type="button" class="btn btn-danger">{{__('Cancel')}}</button></a>
       
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


@endsection


