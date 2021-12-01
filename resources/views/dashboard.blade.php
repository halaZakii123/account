{{-- <x-app-layout> --}}
    @extends('layouts.amz')
    {{-- <x-slot name="styles"> --}}
        @section('style')
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">   
        @if (app()->getLocale() == 'ar')
        <style>
        .dropdown-item{text-align:right;}
        div{text-align: right;}
        .btn-sm{margin-left: 5px;}
        button{margin-left: 4px;}
        </style>
        @endif
        @endsection
      {{-- </x-slot> --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @section('content')
   <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">{{__('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('All Task')}}</li>

                    </ol>
                </nav>

            </div>
        </div>
    </div>
    <div class="col-md-10" style="margin:auto ">
        

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{__('Good')}} </strong>{{__(Session::get('success')) }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <table class="table table-resposive table-bordered tasksTable" style="width:100%;text-align:center">
                        <caption style="caption-side: top;text-align:center;font-weight:bold;font-size:30px">{{__('Created Tasks')}}</caption>
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
                                    <small style="background: #ff7676; padding:4px;"><i class="far fa-clock"></i> < 24 {{__('hours')}}</small>
                                @elseif(\Carbon\Carbon::now()->diffInDays($task->duedate) <= 3 and \Carbon\Carbon::now()->diffInDays($task->duedate) > 0)
                                <small style="background: #ffcf76;;padding:4px;"><i class="far fa-clock"></i> {{\Carbon\Carbon::now()->diffInDays($task->duedate)}} {{__('days')}}</small>
                                @else
                                <small style="background: #98FF98;padding:4px;"><i class="far fa-clock"></i> {{\Carbon\Carbon::now()->diffInDays($task->duedate)}} {{__('days')}}</small>
                                @endif

                                </td>
                                <td>{{__($task->status)}}</td>
                                <td>{{$task->description}}</td>
                                <td>{{ App\User::where(['id' => $task->user_id])->pluck('name')->first()}}</td>
                                <td>{{ App\User::where(['id' => $task->assigned_to])->pluck('name')->first()}}</td>
                                <td>{{$task->duedate}}</td>
                                <td>{{$task->created_at}}</td>
                                <td>{{$task->updated_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                      </table>
                      <a href="{{route('tasks.printCreated')}}" class="btn btn-primary float-right" style="margin-left: 10px;"><i class="fas fa-download"></i> {{__('Generate PDF')}} </a>

                </div>
            </div>
        </div>
    </div>
    {{-- <x-slot name="scripts"> --}}
       
      
      @endsection
{{-- </x-app-layout> --}}
@section('script')
        {{-- for datatable --}}
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
       <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        {{-- for dropdown button --}}
        <script type="text/javascript">
        $(document).ready(function() {
               $('.tasksTable').DataTable();
           });
        </script>
      {{-- </x-slot> --}}
      @endsection


