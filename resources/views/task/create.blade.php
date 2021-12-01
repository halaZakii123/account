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
                        <li class="breadcrumb-item active" aria-current="page">{{__('New Task')}}</li>

                    </ol>
                </nav>

            </div>
        </div>
    </div>
    <div class="col-md-10" style="margin:auto ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form style="width:50%;margin:auto"action="{!! !empty($task) ? route('tasks.update', $task) :  route('tasks.store')  !!}" method="POST">
                        @csrf
                        @if (!empty($task))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="exampleFormControlInput1">{{__('Title Task')}}</label>
                            <input name="title"type="text" class="form-control" id="exampleFormControlInput1" value="@if(!empty($task)) {{$task->title}} @else {{ old('title') }} @endif"placeholder="{{__('Enter title for task')}}">
                            @error('title')
                            <p class="help is-danger" style="color: red">{{ $message }}</p>
                            @enderror
                        </div><br>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{__('Description Task')}}</label>
                            <textarea name="description"class="form-control" id="exampleFormControlTextarea1" rows="3">@if(!empty($task)) {{$task->description}} @else {{old('description')}} @endif</textarea>
                            @error('description')
                            <p class="help is-danger"style="color: red">{{ $message }}</p>
                            @enderror
                        </div><br>
                        <div class="form-group">
                        <label for="exampleFormControlSelect1">{{__('Assigned To')}}</label>
                        <select name="assigned_to"class="form-control" id="exampleFormControlSelect1" style="appearance: none;background-image: url('<custom_arrow_image_url_here>');">
                            @if (!empty($task) && old('assigned_to', $task->assigned_to))
                            <option value="{{ $task->assigned_to}}" selected>{{ App\User::where(['id' => $task->assigned_to])->pluck('name')->first() }}</option>
                                @foreach ($users as $user)
                                    @if($task->assigned_to <> $user->id)
                                     <option value="{{$user->id}}" @if (old('assigned_to') == $user->id) {{ 'selected' }} @endif>{{$user->name}}</option>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($users as $user)
                                    @if(Auth::User()->id == $user->id)
                                     <option value="{{$user->id}}" @if (old('assigned_to') == $user->id) {{ 'selected' }} @endif selected>{{Auth::User()->name}}</option>
                                    @else
                                      <option value="{{$user->id}}" @if (old('assigned_to') == $user->id) {{ 'selected' }} @endif>{{$user->name}}</option> --}}
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @error('assigned_to')
                        <p class="help is-danger" style="color: red">{{ $message }}</p>
                        @enderror
                        </div><br>
                        <div class="form-group">
                        <label for="exampleFormControlSelect2">{{__('Due Date')}}</label>
                        <input name="duedate"type="date" value=@if(!empty($task)) "{{$task->duedate->format('Y-m-d')}}" @else "{{\Carbon\Carbon::now()->format('Y-m-d')}}" @endif/>
                        @error('duedate')
                            <p class="help is-danger" style="color: red">{{ $message }}</p>
                        @enderror
                    </div>
                    <br><br><br>
                          <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{__('Save')}}</button>
                          <a href="{{route('dashboard')}}"><button type="button" class="btn btn-danger">{{__('Cancel')}}</button></a>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection


