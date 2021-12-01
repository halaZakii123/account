{{-- show all tasks finished --}}
@extends('layouts.amz')
    @section('style')
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    @endsection
 
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
                        <li class="breadcrumb-item active" aria-current="page">{{__('Archive')}}</li>

                    </ol>
                </nav>

            </div>
        </div>
    </div>
    <div class="col-md-10" style="margin:auto ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-bordered tasksTable" style="width:100%;text-align:center">
                        <caption style="caption-side: top;text-align:center;font-weight:bold;font-size:30px">{{__('Archive')}}</caption>
                        <thead>
                            <tr>
                              <th scope="col" style="width: 15%">{{__('Title')}}</th>
                              <th scope="col" width="30%">{{__('Description')}}</th>
                              <th scope="col" style="width: 13%">{{__('Assigned From')}}</th>
                              @if(Auth::User()->parent_id == null)
                              <th scope="col" style="width: 13%">{{__('Assigned To')}}</th>
                              @endif
                              <th scope="col" style="width: 15%">{{__('Status')}}</th>
                              <th scope="col" style="width: 20%">{{__('Due Date')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($tasks as $task)
                               <tr>
                                <td>{{$task->title}}</td>
                                <td>{{$task->description}}</td>
                                <td>{{ App\User::where(['id' => $task->user_id])->pluck('name')->first()}}</td>
                                @if(Auth::User()->parent_id == null)
                                <td>{{ App\User::where(['id' => $task->assigned_to])->pluck('name')->first()}}</td>
                                @endif
                                <td>{{$task->status}} </td>
                                <td>{{$task->duedate}}
                              </tr>
                              @endforeach
                          </tbody>
                    </table>
                    <br>
                    <br>
                    <a href="{{route('tasks.printArchive')}}" class="btn btn-primary float-right" style="margin-left: 10px;"><i class="fas fa-download"></i> {{__('Generate PDF')}} </a>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script>
        $(document).ready(function() {
               $('.tasksTable').DataTable();
           });
        </script>
    @endsection