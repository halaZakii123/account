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
                        <li class="breadcrumb-item active" aria-current="page">{{__('Polls')}}</li>
                        @if(!empty($poll))
                            <li class="breadcrumb-item active" aria-current="page">{{__('update')}}</li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{__('create')}}</li>
                        @endif
                    </ol>
                </nav>

            </div>
        </div>
    </div>

            <div class="col-md-8" style="margin: auto;">
                <div class="card">
                    <div class="card-header d-flex">
                        <a href="{{ route('poll.index') }}" class="btn btn-primary ml-auto"><i class="fa fa-home"></i> {{ __('Back') }}</a>
                    </div>

                    <div class="card-body" >
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{!! !empty($poll) ? route('poll.update',$poll->id)  : route('poll.store') !!}" id="op" >
                            @csrf
                            @if(!empty($poll))
                                @method('PUT')
                            @endif

                            <div class="form-group row">
                                <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question:') }}</label>
                                <div class="col-md-6">
                                    <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="@if(!empty($poll)) {{$poll->question}} @else {{old('question')}} @endif" placeholder="enter the question" required  />

                                    @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if(!empty($poll))
                                <div class="form-group row">
                                    <label for="option" class="col-md-4 col-form-label text-md-right">{{ __('Options:') }}</label>
                                </div>
                                @foreach($poll->options as $option)
                                    <div class="form-group row" style=" margin-right:280px;width: 870px" >
                                            <div class="col-md-6" >
                                                <input id="option_{{$loop->index}}" type="text" class="form-control " name="option[{{$loop->index}}]" value="{{$option->name}}" required  />
                                            </div>
                                     </div>

                                 @endforeach
{{--                                <button type="button" id="btn_add" class="btn_add btn btn-primary"><i class="fa fa-plus"></i></button>--}}

                            @else
                                <div class="form-group row">
                                    <label for="option" class="col-md-4 col-form-label text-md-right">{{ __('Options:') }}</label>
                                    <div class="col-md-6">
                                        <input id="option" type="text" class="form-control" name="option[0]" value="{{old('option[0]')}}"   placeholder="option0" required/>
                                    </div>
                                </div>


                            <div class="form-group row" style=" margin-right:280px;width: 870px">
                                <div class="col-md-6">
                                    <input id="option" type="text" class="form-control" name="option[1]" value="{{old('option[1]')}}"   placeholder="option1" required onclick="my()"/>

                                </div>

                            </div>
                            @endif
                            <div id="i">

                            </div>
                            <button type="button" id="btn_add" class="btn_add btn btn-primary"><i class="fa fa-plus"></i></button>

                            <div class="form-group row">
                                <label for="option" class="col-md-4 col-form-label text-md-right">{{ __('Status:') }}</label>
                                <div class="col-md-6">
                                    <select  name="status">
                                        @if(!empty($poll))

                                            <option value="{{$poll->status}} " selected>@if($poll->status==1) {{__('active')}} @elseif($poll->status == 2){{__('close')}} @else {{__('inactive')}} @endif</option>
                                        @endif
                                            <option value="0">{{__('inactive')}}</option>
                                            <option value="1">{{__('active')}}</option>
                                            <option value="2">{{__('Close')}}</option>


                                    </select>
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



@endsection


@section('script')

    <script>
        $(document).on('click', '.delegated-btn', function (e) {
            e.preventDefault();
            $(this).parent().remove();


        });

    </script>

    <script >
        var c = 1;
        $(document).on('click', '.btn_add', function () {
            c++;
            console.log('x:',c);
            $.ajax({
                type:'post',
                url:'{{URL::to( route('add'))}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'count': c,

                },
                success:function (data){
                    console.log('data:',data);
                    $('#i').append(data);
                },
                error:function(){
                    console.log('error ',$error);
                }
            });


        });

    </script>


@endsection
