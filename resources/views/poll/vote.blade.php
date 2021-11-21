@extends('layouts.amz')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                    <label for="question" class="col-md-9 col-form-label ">{{ $poll->question }}</label>

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{!! route('vote',$poll->id) !!}">
                        @csrf
                        <div class="form-group row">
                        </div>
                            @foreach($poll->options as $option)

                                <div class="form-group row">

                                    <div class="col-md-6" >
                                        <input id="option_{{$loop->index}}" type="radio"  name="option" value="{{$option->id}}" required />
                                          <label for="option">{{$option->name}}</label><br>

                                    </div>

                                </div>
                            @endforeach

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Vote') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
