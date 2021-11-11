@extends('layouts.app')
@section('style')
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />--}}
    {{--    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">--}}
    {{--    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ asset('datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables-buttons/css/buttons.bootstrap4.min.css') }}">


@endsection
@section('content')
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">--}}
    {{--    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
    {{--    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"> </script>--}}

    <div class="container">
        <div class="row justify-content-center">
            {{--            <div class="col-md-2  ">--}}
            {{--                <div class="card-header d-flex">--}}
            {{--                </div>--}}
            {{--                <div class="card  ">--}}
            {{--                    <a href="{{ route('Accounts.create') }}" class="text-center"><i class="fa fa-plus"></i>--}}
            {{--                        {{ __('create') }}</a>--}}
            {{--                    --}}{{--                    <a href="{{route('print')}}" class="text-center">{{__('print')}}</a>--}}
            {{--                    --}}{{--                    <a href="{{route('pdf')}}" class="text-center"> {{__('pdf')}}</a>--}}

            {{--                </div>--}}
            {{--            </div>--}}
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex">
                        <a href="{{ route('Users.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>
                            <table class="table  table-bordered display responsive nowrap employeeDataTable" id="example1" >
                                <thead>
                                <tr>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)

                                    <tr class="active">
                                        <td>
                                            {{$user->name}} </td>
                                        <td>{{$user->email}}

                                        </td>
                                        <td>  <a href="{{route('Users.edit',$user->id) }}"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $user->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('Users.destroy', $user->id) }}" method="post" id="delete-{{ $user->id }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>--}}
    {{--    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>--}}
    {{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>--}}
    {{--    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>--}}

    {{--<script src="../../plugins/jquery/jquery.min.js"></script>--}}
    {{--<!-- Bootstrap 4 -->--}}
    {{--<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('.table').DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1 ');

        });
    </script>
@endsection
