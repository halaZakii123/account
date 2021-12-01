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
                        <li class="breadcrumb-item active" aria-current="page">{{__('Mains')}}</li>
                    </ol>
                </nav>

            </div>
        </div>
    </div>

    <div class="col-md-10" style="margin:auto ">
                <div class="card">
                        <div class="card-header d-flex">
                            
                        <div>
           <form method="post" action=" {{route('search')}}" >
            @csrf
                <label>{{__('Search between two dates')}}</label>
                <div >
                    <div class ="form-group" >
                        <label style="font-size: small"> {{__('start date :')}}</label>
                        <input type="date" id="startDate" name="from" placeholder="yyyy-mm-dd"  autocomplete="on">
                        <label style="font-size: small"> {{__('end date :')}}</label>
                        <input type="date" id="endDate"  name="to"  placeholder="yyyy-mm-dd"  autocomplete="on" >
                        <button type="submit" ><i class="fas fa-search"></i>
                            
                        </button>
                        
                    </div>
                </div>
                
               
            </form>
       </div>
                        </div>



                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


      

       
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
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal{!! $main->id !!}"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                
                                            </td>


                                    </tr>
                                    <div class="modal fade" id="exampleModal{!! $main->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <p> {{__('To Delete This Daily Entry')}}<p>
                                               </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('close')}}</button>
                                                <button type="button"  onclick=" { document.getElementById('delete-{{ $main->id }}').submit(); }"  class="btn btn-danger ">{{__('Delete')}}</button>
                                                <form action="{{ route('Mains.destroy', $main->id) }}" method="post" id="delete-{{ $main->id }}" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                </div>
    </div>




@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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
