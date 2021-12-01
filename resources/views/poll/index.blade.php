@extends('layouts.amz')
@section('style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                        <li class="breadcrumb-item active" aria-current="page">{{__('Polls')}}</li>
                    </ol>
                </nav>

            </div>
        </div>
    </div>

            <div class="col-md-9" style="margin: auto;">
                <div class="card">
                    <div class="card-header d-flex">
                        <a href="{{ route('poll.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <table class="table table-bordered display responsive nowrap  optionDataTable">
                                <thead>
                                <tr>
                                    <th>{{__('#')}}</th>
                                    <th>{{__('Question')}}</th>
                                    <th>{{__('options')}}</th>
                                    <th>{{__('Status')}}</th>

                                    <th>{{__('Action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($polls as $poll)
                                    <tr class="active">
                                        <td>{{$poll->id}}</td>
                                        <td > {{ $poll->question}}</td>
                                        <td > {{ $poll->options_count}}</td>
                                        <td >
                                            @if($poll->status ==0)
                                            {{__('inactive')}}
                                           @elseif($poll->status == 1)
                                            {{__('active')}}
                                           @else
                                                {{__('close')}}
                                            @endif
                                        </td>
                                        <td>
                                            
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal{!! $poll->id !!}"  data-category="{{ $poll->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                         
                                         <div class="modal fade" id="exampleModal{!! $poll->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                           <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" >
                                                <div style="text-align:center">
                                                   <h2> {{__('Are you sure?')}}</h2>
                                                </div>
                                                <div style="text-align:center">
                                                   <p> {{__('To Delete This Poll')}}<p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('close')}}</button>
                                                <form action="{{route('poll.destroy', $poll->id) }}" method="post" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button   type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                                                </form>
                                             </div>
                                         </div>
                                     </div>
                                    </div>  

                                            @if($poll->status==0)
                                             <a href="{{route('poll.edit',$poll->id) }}"><i class="fa fa-edit"></i></a>
                                           @endif

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.optionDataTable').DataTable();
        });
    </script>
@endsection
