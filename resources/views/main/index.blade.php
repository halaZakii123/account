@extends('layouts.amz')
@section('style')
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />--}}
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

@endsection
@section('content')

    <div class="container">

                <div class="card">
                    <div class="card-header d-flex">
                        <div class="dropdown  col-md-2">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-plus"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a  class="dropdown-item" href ="{{route('Mains.create')}} "> {{__('financial record')}} </a>
                                <a class="dropdown-item" href=" {{route('Mains.dailyCash',3)}} "> {{__('Cash')}}</a>
                                <a  class="dropdown-item" href=" {{route('Mains.dailyCashIn',1)}}"> {{__('Cash in')}}</a>
                                <a  class="dropdown-item" href=" {{route('Mains.dailyCashOut',2)}}"> {{__('Cash out')}}</a>
                            </div>
                        </div>

                    </div>
                </div>


                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


      <div>
           <form method="post" action=" {{route('search')}}" >
            @csrf
                <label>{{__('Search between two dates')}}</label>
                <div class="col-4">
                    <div class ="form-group" >
                        <label style="font-size: small"> {{__('start date :')}}</label>
                        <input type="date" id="startDate" name="from" placeholder="yyyy-mm-dd"  autocomplete="on">
                    </div>
                </div>
                <div class="col-4">
                    <div class ="form-group" >
                        <label style="font-size: small"> {{__('end date :')}}</label>
                        <input type="date" id="endDate"  name="to"  placeholder="yyyy-mm-dd"  autocomplete="on" >
                        <button type="submit" class="btn btn-primary" style="height: 25px;font-size: small">
                            {{ __('Search') }}
                        </button>
                    </div>
                </div>
            </form>
       </div>
        <div class="table-responsive">
                            <table class="table table-bordered display responsive  mainDataTable" id="ii">
                                <thead>
                                <tr>
                                    <th>{{__('Operation_number')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Explained')}}</th>
                                    <th>{{__('Document Number')}}</th>
                                    <th>{{__('Type of operation')}}</th>
                                    <th>{{__('Currency symbol')}}</th>
                                    <th>{{__('Exchange rate')}}</th>
                                    <th>{{__('Action')}}</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mains as $main)
                                    <tr class="active">
                                        <td>{{$main->id}} </td>
                                        <td>{{$main->operation_date}} </td>
                                        <td> @if (app()->getLocale() == 'ar'){{$main->explained_ar}} @else  {{$main->explained}} @endif </td>
                                        <td>{{$main->document_number}} </td>
                                        <td>@if($main->type_of_operation == 0)
                                                {{__('financial record')}}
                                             @elseif($main->type_of_operation == 1)
                                                {{__('Cash in')}}
                                             @elseif($main->type_of_operation == 2)
                                                {{__('Cash out')}}
                                             @else
                                                {{__('Cash')}}
                                            @endif
                                            </td>
                                        <td>{{$main->currency_symbol}} </td>
                                        <td>{{ number_format($main->exchange_rate , 2, '.', ',')}} </td>
                                            <td><a href="{{route('Mains.edit',$main->id) }}"><i class="fa fa-edit"></i></a>
                                                <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $main->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                <form action="{{ route('Mains.destroy', $main->id) }}" method="post" id="delete-{{ $main->id }}" style="display: none;">
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



@endsection
@section('script')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.mainDataTable').DataTable();
        });
    </script>

    <script>

    </script>
    <script type="text/javascript">
        function myfun(){
            var startDate = document.getElementById("startDate").value;
            var endDate = document.getElementById("endDate").value;
            var allDate = function(start_date, end_date) {
                var date_range = new Array();
                var st_date = new Date(start_date);
                while (st_date <= end_date) {
                    let month  = ("0" + (st_date.getMonth() + 1)).slice(-2);
                    let day   = ("0" + st_date.getDate()).slice(-2);
                    let date = [st_date.getFullYear(), month, day].join("-");
                    date_range.push(date);
                    st_date.setDate(st_date.getDate() + 1);
                }
                return date_range;
            }
        var dateArr = allDate(startDate, endDate);

        // Output
        var input, filter, table, tr, td,td1, i, txtValue ,txtv;

                table = document.getElementById("ii");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    for (var j = 0; j < dateArr.length; j++){
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.indexOf(dateArr[j]) > -1 ) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none" }}}}}
        </script>
    @endsection
