{{-- show all tasks assigned to me --}}
@extends('layouts.amz')
@section('style')
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link rel="stylesheet" href=" {{asset('css/mystyle.css')}} ">

@endsection
@section('content')
    <div class="py-12">
        <form action="{{route('tasks.printAssign')}}" method="GET">
            @csrf
        @if(count($tasks) <> 0)
        {{-- <a href="" class="btn btn-danger btn-md active"class="pdf" role="button" aria-pressed="true">{{__('Download')}} PDF</a> --}}
        <button type="submit" class="btn btn-danger mr-2"> <i class="fa fa-download" aria-hidden="true"></i> {{__('Download')}} PDF</button>
        @endif<br><br>
        <input type="hidden" name="status" value={{$status}}>
        </form>
        <form action="{{route('tasks.store_status')}}" method="POST">
            @csrf
            <table class="table table-responsive table-bordered tasksTable">
                <thead>
                    <tr>
                    <th scope="col" style="width: 10%">{{__('Duration')}}</th>
                    <th scope="col" style="width: 20%">{{__('Title')}}</th>
                    <th scope="col" style="width: 25%">{{__('Description')}}</th>
                    <th scope="col" style="width: 10%">{{__('Assigned From')}}</th>
                    <th scope="col" style="width: 15%">{{__('Status')}}</th>
                    <th scope="col" style="width: 12%">{{__('Forward to')}}</th>
                    <th scope="col" style="width: 25%">{{__('Due Date')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                        <td>
                            @if(\Carbon\Carbon::now()->diffInDays($task->duedate) <= 0)
                                <small style="background: #ff7676;"><i class="far fa-clock"></i> < 24 {{__('hours')}}</small>
                            @elseif(\Carbon\Carbon::now()->diffInDays($task->duedate) <= 3 and \Carbon\Carbon::now()->diffInDays($task->duedate) > 0)
                            <small style="background: #ffcf76;"><i class="far fa-clock"></i> {{\Carbon\Carbon::now()->diffInDays($task->duedate)}} {{__('days')}}</small>
                            @else
                            <small style="background: #98FF98;"><i class="far fa-clock"></i> {{\Carbon\Carbon::now()->diffInDays($task->duedate)}} {{__('days')}}</small>
                            @endif
                        </td>
                        <td>{{$task->title}}</td>
                        <td>{{$task->description}}</td>
                        <td>{{ App\User::where(['id' => $task->user_id])->pluck('name')->first()}}</td>
                        <td>
                            <div class="form-check">
                                <select style="width:100%"name="status[]"class="form-select form-select-sm" aria-label=".form-select-sm example">
                                @if($task->status <> "not started")
                                    <option>{{__($task->status)}}</option>
                                    <option value="not started">{{__('not started')}}</option>
                                @else
                                    <option value="not started" selected>{{__('not started')}}</option>
                                @endif
                                <option value="in progress">{{__('in progress')}}</option>
                                <option value="waiting">{{__('waiting')}}</option>
                                <option value="finished">{{__('finished')}}</option>
                                <option value="denied">{{__('denied')}}</option>
                                <option value="forward">{{__('forward')}}</option>
                                </select>
                                <input type="hidden" name="taskId[]" value="{{$task->id}}">
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <select style="width:100%"name="forwardto[]"class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option></option>
                                    @foreach ($users as $user)
                                        @unless($user->id == Auth::User()->id)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endunless

                                    @endforeach
                                </select>
                                @error('forwardto[]')
                                <p class="help is-danger" style="color: black">{{ $message }}</p>
                                @enderror
                            </div>
                        </td>
                        <td>{{$task->duedate->format('Y-m-d')}}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>

                        @if(count($tasks) <> 0)
                        <button type="submit" class="btn btn-success mr-2"> <i class="fa fa-check"></i> {{__('Save')}}</button>
                        @endif
                    <a href="{{route('delegatedTasks')}}"><button type="button" class="btn btn-danger">{{__('Cancel')}}</button></a>
                    </form>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
        {{-- for datatable --}}
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"  defer></script>
        <script>
        $(document).ready(function() {
               $('.tasksTable').DataTable();
           });
        </script>
     @endsection

