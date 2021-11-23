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
                        <li class="breadcrumb-item active" aria-current="page">{{__('Bldaily')}}</li>

                    </ol>
                </nav>

            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom:15px ">
    <div class="dropdown dropleft float-right">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            {{__('More')}}
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{route('printBL')}}" class="btn btn-primary ml-auto">{{__('print')}}</a>
            <a class="dropdown-item" href="{{route('pdfBL')}}" class="btn btn-primary ml-auto">{{__('pdf')}}</a>
{{--            <a class="dropdown-item" href="{{route('pdfBL')}}" class="btn btn-primary ml-auto">{{__('pdf')}}</a>--}}
        </div>
    </div>
    </div>
        <div class="col-md-12" style="margin: auto ;">

                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <table class="table table-bordered display responsive  optionDataTable">
                                <thead>
                                <tr style="font-size: small">
                                    <th>{{__('Sum Trans debit')}}</th>
                                    <th>{{__('Sum Trans credit')}}</th>
                                    <th>{{__('BAl')}}</th>
                                    <th>{{__('Sum Trans debit M')}}</th>
                                    <th>{{__('Sum Trans credit M')}}</th>
                                    <th>{{__('BAlc')}}</th>
                                    <th>{{__('Currency symbol')}}</th>
                                    <th>{{__('Account Number')}}</th>
                                    <th>{{__('Account Name')}}</th>
                                    <th>{{__('Final Report')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($BlDailys as $BlDaily)
                                    <tr class="active">
                                        <td style="text-align: right"> {{ number_format($BlDaily->Db, 2, '.', ',') }} </td>
                                        <td style="text-align: right">{{  number_format($BlDaily->CR, 2, '.', ',') }}</td>
                                        <td style="text-align: right">{{  number_format($BlDaily->BAl, 2, '.', ',') }}</td>
                                        <td style="text-align: right"> {{ number_format($BlDaily->Dbc, 2, '.', ',') }}</td>
                                        <td style="text-align: right"> {{ number_format($BlDaily->Crc, 2, '.', ',') }}</td>
                                        <td style="text-align: right"> {{ number_format($BlDaily->BAlc, 2, '.', ',') }}</td>
                                        <td>{{ $BlDaily->trans_curr}}</td>
                                        <td>{{$BlDaily->acc_no}}</td>
                                        <td>{{$BlDaily->acc_name}}</td>
                                        <td> {{$BlDaily->acc_finalReport}}</td>


                                    </tr>
                                @endforeach


                                </tbody>


                            </table>

                            <table class="table table-bordered display responsive ">
                                <thead>
                                <tr>
                                    <th>{{__('Total Trans debit')}}</th>
                                    <th>{{__('Total Trans credit')}}</th>
                                    <th>{{__(' Total BAl')}}</th>
                                    <th>{{__('Total Trans debit M')}}</th>
                                    <th>{{__('Total Trans credit M')}}</th>
                                    <th>{{__(' Total BAlc')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr >
                                    <td style="text-align: right"> {{  number_format($totdb, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{  number_format($totcr, 2, '.', ',') }}</td>
                                    <td style="text-align: right">{{  number_format($totBAl, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{ number_format($totdbc, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{ number_format($totcrc, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{ number_format($totBAlc, 2, '.', ',') }}</td>
                                    <td></td>

                                </tr>
                                </tbody>
                            </table>


                        </div>

                    </div>
                </div>
            </div>


@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.optionDataTable').DataTable();
        });
    </script>
@endsection
