    @extends('layouts.amz')
    @section('style')
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
     @endsection
    @section('content')
    <div class="py-12">
    @if (Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{__('Good')}} </strong>{{__(Session::get('success')) }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
<div style="padding: 40px">
    @if(count($tasks) <> 0)<a href="{{route('tasks.printCreated')}}" class="btn btn-danger btn-md active"class="pdf" role="button" aria-pressed="true"><i class="fa fa-download" aria-hidden="true"></i> {{__('Download')}} PDF</a>@endif
    <a href="{{route('tasks.create')}}"><button type="button" class="btn_add btn btn-success"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;{{__('create task')}}</button></a><br><br>

    <table class="table table-responsive table-bordered tasksTable">
        <thead>
            <tr class="bg-primary">
            <th scope="col" style="width: 10%">{{__('Action')}}</th>
            <th scope="col" style="width: 10%">{{__('Duration')}}</th>
            <th scope="col" style="width: 8%">{{__('Status')}}</th>
            <th scope="col" style="width: 25%" >{{__('Task')}}</th>
            <th scope="col" style="width: 5%">{{__('Assigned From')}}</th>
            <th scope="col" style="width: 5%">{{__('Assigned To')}}</th>
            <th scope="col" style="width: 15%">{{__('Due Date')}}</th>
            <th scope="col" style="width: 12%">{{__('create Date')}}</th>
            <th scope="col" style="width: 18%">{{__('update Date')}}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td scope="row">
                    <a href="{{route('tasks.edit',$task->id)}}"><button type="button" class="btn btn-outline-primary"><i style="color:black"class="fa fa-edit" ></i></button></a>
                        <button class="btn btn-light"data-toggle="modal" data-target="#centralModalSm{!! $task->id !!}"><i style="color:red"class="fa fa-trash" aria-hidden="true"></i></button>
<!-- Central Modal Small -->
                        <div class="modal fade" id="centralModalSm{!! $task->id !!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                            <!--Content-->
                            <div class="modal-content">
                                <!--Header-->
                                <div class="modal-header">
                                <h4 class="modal-title w-100" id="myModalLabel">{{__('Are you sure?')}}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <!--Footer-->
                                <div class="modal-footer">
                                    <form action="{{route('tasks.destroy', $task->id)}}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{__('Cancel')}}</button>
                                        <button type="submit" class="btn btn-primary btn-sm">{{__('Save changes')}}</button>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
<!-- Central Modal Small -->
                </td>
                <td>
                @if(\Carbon\Carbon::now()->diffInDays($task->duedate) <= 0)
                    <small style="background: #ff7676;"><i class="far fa-clock"></i> < 24 {{__('hours')}}</small>
                @elseif(\Carbon\Carbon::now()->diffInDays($task->duedate) <= 3 and \Carbon\Carbon::now()->diffInDays($task->duedate) > 0)
                <small style="background: #ffcf76;"><i class="far fa-clock"></i> {{\Carbon\Carbon::now()->diffInDays($task->duedate)}} {{__('days')}}</small>
                @else
                <small style="background: #98FF98;"><i class="far fa-clock"></i> {{\Carbon\Carbon::now()->diffInDays($task->duedate)}} {{__('days')}}</small>
                @endif
                </td>
                <td>{{__($task->status)}}</td>
                <td>{{$task->description}}</td>
                @foreach ($users as $user)
                    @if($user->id == $task->user_id)
                    <td>{{$user->name}}</td>
                    @break
                    @endif
                @endforeach
                @foreach ($users as $user)
                    @if($user->id == $task->assigned_to)
                    <td>{{$user->name}}</td>
                    @break
                    @endif
                @endforeach
                <td>{{$task->duedate}}</td>
                <td>{{$task->created_at}}</td>
                <td>{{$task->updated_at}}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
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




