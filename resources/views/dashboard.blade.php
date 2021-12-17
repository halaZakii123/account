    @extends('layouts.amz')
    @section('style')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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

        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">{{__('Home')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Delegated Tasks')}}</li>

                        </ol>
                    </nav>

                </div>
            </div>
        </div>
        <div class="col-md-11" style="margin: auto ;">

            <div class="card">
                <div class="card-header d-flex">
                    <a href="{{route('tasks.create')}}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-responsive table-bordered tasksTable">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%">{{__('Duration')}}</th>
                                    <th scope="col" style="width: 8%">{{__('Status')}}</th>
                                    <th scope="col" style="width: 25%">{{__('Task')}}</th>
                                    <th scope="col" style="width: 5%">{{__('Assigned From')}}</th>
                                    <th scope="col" style="width: 5%">{{__('Assigned To')}}</th>
                                    <th scope="col" style="width: 15%">{{__('Due Date')}}</th>
                                    <th scope="col" style="width: 12%">{{__('create Date')}}</th>
                                    <th scope="col" style="width: 18%">{{__('update Date')}}</th>
                                    <th scope="col" style="width: 10%">{{__('Action')}}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                <tr>

                                    <td>
                                        @if(\Carbon\Carbon::now()->diffInDays($task->duedate) <= 0) <small style="background: #ff7676;"><i class="far fa-clock"></i>
                                            < 24 {{__('hours')}}</small>
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
                                    <td scope="row">
                                        <a href="{{route('tasks.edit',$task->id)}}"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal{!! $task->id!!}" data-category="{{ $task->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                        <div class="modal fade" id="exampleModal{!! $task->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div style="text-align:center">
                                                            <h2> {{__('Are you sure?')}}</h2>
                                                        </div>
                                                        <div style="text-align:center">
                                                            <p> {{__('To Delete it')}}
                                                            <p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('close')}}</button>
                                                        <form action="{{route('tasks.destroy', $task->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(count($tasks) <> 0)<a href="{{route('tasks.printCreated')}}" class="btn btn-primary float-right" style="margin-left: 10px;"><i class="fas fa-download"></i> {{__('Generate PDF')}} </a>@endif



                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('script')
        {{-- for datatable --}}
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
        <script>
            $(document).ready(function() {
                $('.tasksTable').DataTable();
            });
        </script>
        @endsection
