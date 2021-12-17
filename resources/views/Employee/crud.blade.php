@extends('layouts.amz')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center" style="margin-bottom: 20px;">
                {{--                        <h4 class="page-title">{{ Request::segment(1) }}</h4>--}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">{{__('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Employees')}}</li>
                        @if(!empty($user))
                            <li class="breadcrumb-item active" aria-current="page">{{__('update')}}</li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{__('create')}}</li>
                        @endif
                    </ol>
                </nav>

            </div>
        </div>
    </div>
            <div class="col-md-9" style="margin: auto ;">
                <div class="card">


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form method="POST" action="{!! !empty($user) ? route('Users.update',$user->id)  : route('Users.store') !!}">
                                @csrf
                                @if(!empty($user))
                                    @method('PUT')
                                @endif
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@if(!empty($user)) {{$user->name}} @else {{old('name')}} @endif" required autocomplete="name" autofocus>

                                        <small class="text-danger">{{ $errors->first('name') }}</small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                    <div class="col-md-6">
                                        @if(!empty($user))
                                          <input id="email" type="email" class="form-control " name="email" value="{{$user->email}}"  autocomplete="email">
                                         @else
                                          <input id="email" type="email" class="form-control " name="email" value="{{old('email')}}"  autocomplete="email">
                                         @endif
                                          <small class="text-danger">{{ $errors->first('email') }}</small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="@if(!empty($user)) {{$user->password}} @else {{old('password')}} @endif" required autocomplete="new-password">
                                        <small class="text-danger">{{ $errors->first('password') }}</small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="@if(!empty($user)) {{$user->password}} @else {{old('password')}} @endif" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{__('Save')}}</button>
                                        <a href="{{ route('Users.index') }}"><button type="button" class="btn btn-danger">{{__('Cancel')}}</button></a>

                                    </div>
                                </div>
                            </form>

                    </div>
                </div>
            </div>

@endsection

