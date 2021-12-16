@extends('layouts.amz')

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
    <div class="page-breadcrumb" style="margin-bottom: 20px;">
        <div class="row">
            <div class="col-5 align-self-center">
                {{--                        <h4 class="page-title">{{ Request::segment(1) }}</h4>--}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">{{__('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Accounts')}}</li>
                        @if(!empty($account))
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
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{__('Save')}}</button>
                                        <a href="{{ route('Accounts.index') }}"><button type="button" class="btn btn-danger">{{__('Cancel')}}</button></a>
                                    </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

@endsection

