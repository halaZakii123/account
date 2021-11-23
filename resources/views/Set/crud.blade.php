@extends('layouts.amz')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                {{--                        <h4 class="page-title">{{ Request::segment(1) }}</h4>--}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">{{__('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Sets')}}</li>
                        @if(!empty($set))
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
                    <div class="card-header d-flex">
                        <a href="{{ route('Sets.index') }}" class="btn btn-primary ml-auto"><i class="fa fa-home"></i> {{ __('Back') }}</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{!! !empty($set) ? route('Sets.update',$set->id)  : route('Sets.store') !!}">
                            @csrf
                            @if(!empty($set))
                                @method('PUT')
                            @endif
                            <div class="form-group row">
                                <label for="key" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                                <div class="col-md-6">
                                    <select name="key" id="key" class="key form-control" onchange="validate()">

                                        @if(!empty($set))
                                            <option  value="cash_id" {{$set->key == 'cash_id'? 'selected':''}}> {{__('Cash Id')}}</option>
                                        @else
                                            <option value="cash_id" {{old('key')?'selected' :''}} > {{__('Cash Id')}}</option>

                                        @endif
                                    </select>
                                    @error('key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="C form-group row" >
                                <label for="account_number" class="col-md-4 col-form-label text-md-right" >{{ __('Value') }}</label>

                                   <div class="col-md-6" >

                                    <select name="value" id="value" class="value form-control" >
                                        <set></set>

                                        @foreach($account_numbers as $account)
                                            @if(!empty($set))
                                                <option value=" {{$account->account_number}} "{{ $set->value == $account->account_number ? 'selected' : '' }}  >{{$account->account_number}} {{$account->account_name}} </option>
                                            @else
                                                <option value=" {{$account->account_number}} "{{old('value')}} >{{$account->account_number}} {{$account->account_name}} </option>
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

    {{--    <script>--}}
    {{--        function validate()--}}
    {{--        {--}}
    {{--            var ddl = document.getElementById("type");--}}
    {{--            var selectedValue = ddl.sets[ddl.selectedIndex].value;--}}
    {{--            if (selectedValue === 'currency_symbol')--}}
    {{--            {--}}
    {{--                $('.enable').prop('disable', false);--}}
    {{--                $('.account_number').prop('disable', true);--}}

    {{--            }--}}
    {{--            else if(selectedValue === 'type_of_operation'){--}}
    {{--                $('.enable').prop('disabled', true);--}}
    {{--            }--}}
    {{--        }--}}
    {{--        </script>--}}
@endsection


