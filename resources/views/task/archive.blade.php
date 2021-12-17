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
    <div class="col-md-10" style="margin: auto ;">
                <div class="card">


                    <div class="card-body">


        <table class="table table-bordered table-responsive tasksTable">
            <thead>
                <tr>
                    <th scope="col" style="width: 20%">{{__('Title')}}</th>
                    <th scope="col" style="width: 30%">{{__('Description')}}</th>
                    <th scope="col" style="width: 13%">{{__('Assigned From')}}</th>

                    <th scope="col" style="width: 13%">{{__('Assigned To')}}</th>

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
                    <td>{{ App\User::where(['id' => $task->assigned_to])->pluck('name')->first()}}</td>
                    <td>{{__($task->status)}} </td>
                    <td>{{$task->duedate}}
                    </tr>
                    @endforeach
                </tbody>
        </table>
        @if(count($tasks) <> 0)<a href="{{route('tasks.printArchive')}}" class="btn btn-danger btn-md active"class="pdf" role="button" aria-pressed="true">{{__('Download')}} PDF</a>@endif<br><br>

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
