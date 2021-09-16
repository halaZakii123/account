<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8|7 Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <div class="container">

        <div class="row ">
            <div class="col-md-2  ">
                <div class="card-header d-flex">
                </div>
                <div class="card  ">
                        <a href="{{ route('Accounts.create') }}" class="text-center"><i class="fa fa-plus"></i> {{ __('create') }}</a>
                        <a href="/print" class="text-center">{{__('print')}}</a>
                        <a href="/pdf" class="text-center"> {{__('pdf')}}</a>

                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>

                        </div>
                        <div>
{{--                            <table class="table table-cl" id="ii">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>{{__('Account Number')}}</th>--}}
{{--                                    <th>{{__('Account Name')}}</th>--}}
{{--                                    <th>{{__('Master Account number')}}</th>--}}
{{--                                    <th>{{__('Report')}}</th>--}}
{{--                                    <th>{{__('Mainly')}}</th>--}}
{{--                                    <th>{{__('Create At')}}</th>--}}
{{--                                    <th>{{__('Action')}}</th>--}}

{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($accounts as $account)--}}
{{--                                    <tr class="active">--}}
{{--                                        <td>{{$account->account_number}} </td>--}}
{{--                                        <td>{{$account->account_name}}</td>--}}
{{--                                        <td> {{$account->master_account_number}}</td>--}}
{{--                                        <td>{{$account->report}}</td>--}}
{{--                                        <td>--}}
{{--                                            @if($account->mainly == 1)--}}
{{--                                                <i class="fas fa-check"></i>--}}
{{--                                            @elseif($account->mainly == null)--}}
{{--                                                <i class="fa fa-times"></i>--}}
{{--                                            @endif--}}

{{--                                        </td>--}}
{{--                                        <td>{{$account->created_at}}</td>--}}
{{--                                        <td>--}}
{{--                                            <a href="{{route('Accounts.edit',$account->id)}}"><i class="fa fa-edit"></i></a>--}}
{{--                                            <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $account->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>--}}
{{--                                            <form action="{{ route('Accounts.destroy', $account->id) }}" method="post" id="delete-{{ $account->id }}" style="display: none;">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
{{--                                            </form>--}}


{{--                                        </td>--}}

{{--                                    </tr>--}}
{{--                                @endforeach--}}

{{--                                </tbody>--}}
{{--                            </table>--}}

                            <table class="table table-bordered yajra-datatable">
                                <thead>
                                <tr>
                                    <th>{{__('Account Number')}}</th>--}}
                                    <th>{{__('Account Name')}}</th>
                                    <th>{{__('Master Account number')}}</th>
                                    <th>{{__('Report')}}</th>
                                    <th>{{__('Mainly')}}</th>
                                    <th>{{__('Create At')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

{{--                            <div class="d-flex justify-content-center">--}}
{{--                                {!! $accounts->links() !!}--}}
{{--                            </div>--}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


        <script type="text/javascript">
            $(function () {

                var table = $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('accounts.list') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'account_number', name: 'account_number'},
                        {data: 'account_name', name: 'account_name'},
                        {data: 'master_account_number', name: 'master_account_number'},
                        {data: 'report', name: 'report'},
                        {data: 'mainly', name: 'mainly'},
                        {data: 'created_at', name: 'created_at'},
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });

            });
    </script>
</body>
{{--    <script>--}}
{{--        function myFunction() {--}}
{{--            var input, filter, table, tr, td,td1, i, txtValue ,txtv;--}}
{{--            input = document.getElementById("myInput");--}}
{{--            filter = input.value.toUpperCase();--}}
{{--            table = document.getElementById("ii");--}}
{{--            tr = table.getElementsByTagName("tr");--}}
{{--            for (i = 0; i < tr.length; i++) {--}}
{{--                td = tr[i].getElementsByTagName("td")[0];--}}
{{--                td1 = tr[i].getElementsByTagName("td")[1];--}}
{{--                if (td1) {--}}
{{--                    txtValue = td1.textContent || td1.innerText;--}}
{{--                    txtv = td.textContent || td.innerText;--}}
{{--                    if (txtValue.toUpperCase().indexOf(filter) > -1 || txtv.toUpperCase().indexOf(filter) > -1) {--}}
{{--                        tr[i].style.display = "";--}}
{{--                    } else {--}}
{{--                        tr[i].style.display = "none";--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
</html>

