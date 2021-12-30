@extends('layouts.amz')
@section('style')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="page-breadcrumb" style="margin-bottom:20px">
        <div class="row">
            <div class="col-5 align-self-center">
                {{--                        <h4 class="page-title">{{ Request::segment(1) }}</h4>--}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">{{__('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Daily Account Balance')}}</li>

                    </ol>
                </nav>

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
                        <div class="table-responsive">
                            <table class="table table-bordered display responsive  optionDataTable" >
                                <thead>
                                <tr style="background-color: #D3D3D3">
                                    <th>{{__('Debit')}}</th>
                                    <th>{{__('Credit')}}</th>
                                    <th>{{__('Balance')}}</th>
                                    <th>{{__('Currency symbol')}}</th>
                                    <th>{{__('Account Name')}}</th>
                                    <th>{{__('Account Number')}}</th>
                                    <th>{{__('Final Report')}}</th>

                                </tr>
                                <tr style="background-color: #D3D3D3">
                        
                                    <th>{{__('Debit Curr.')}}</th>
                                    <th>{{__('Credit Curr.')}}</th>
                                    <th>{{__('Balance Curr.')}}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($BlDailys as $BlDaily)
                                    <tr class="active">
                                        <td style="text-align: right"> {{ number_format($BlDaily->Db, 2, '.', ',') }} </td>
                                        <td style="text-align: right">{{  number_format($BlDaily->CR, 2, '.', ',') }}</td>
                                        <td style="text-align: right">{{  number_format($BlDaily->BAl, 2, '.', ',') }}</td>
                                        
                                        <td>{{ $BlDaily->trans_curr}}</td>
                                        <td>{{$BlDaily->acc_name}}</td>
                                        <td>{{$BlDaily->acc_no}}</td>
                                        <td> 
                                        @if($BlDaily->acc_finalReport== 1)
                                          {{__('budget')}}
                                         @else
                                         {{__('Income list')}}
                                         @endif</td>


                                    </tr>
                                    <tr  style="border-bottom: 2px solid black">
                                    <td style="text-align: right;font-size: small;color: blue"> {{ number_format($BlDaily->Dbc, 2, '.', ',') }}</td>
                                        <td style="text-align: right;font-size: small;color: blue"> {{ number_format($BlDaily->Crc, 2, '.', ',') }}</td>
                                        <td style="text-align: right;font-size: small;color: blue"> {{ number_format($BlDaily->BAlc, 2, '.', ',') }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                       
                                    </tr>
                                @endforeach
                                
                                    
                                
                                <tr>
                                <td style="text-align: right"> {{  number_format($totdb, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{  number_format($totcr, 2, '.', ',') }}</td>
                                    <td style="text-align: right">{{  number_format($totBAl, 2, '.', ',') }}</td>
                                    <th> {{__('Total')}}</th> 
                                </tr>
                                <td style="text-align: right"> {{ number_format($totdbc, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{ number_format($totcrc, 2, '.', ',') }}</td>
                                    <td style="text-align: right"> {{ number_format($totBAlc, 2, '.', ',') }}</td>
                                </tr>
                                </tbody>


                            </table>
                            <div class="col-12">
                              <a href="{{route('printBL')}}" class="btn btn-success float-right"><i class="fas fa-print"></i> {{__('print')}} </a>
                             <a href="{{route('pdfBL')}}" class="btn btn-danger btn-md active float-right" style="margin-left: 10px;" class="pdf" role="button" aria-pressed="true"><i class="fas fa-download"></i>{{__('Download')}} PDF</a>

                            </div>
                
                        </div>

                    </div>
                </div>
            </div>


@endsection

