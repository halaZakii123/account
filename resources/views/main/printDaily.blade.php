@extends('layouts.print')
@section('content')

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex"  >
                  <h4> <b> {{__('Daily Entry')}}</b></h4> <br>
                  
                </div>

                <div class="card-body" @if (app()->getLocale() == 'ar') style="text-align: right ;direction: rtl;"@endif>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table  display responsive ">
                            <tr>
                                <th>{{ __('Operation Date') }}</th>
                                <td>{{ $main->operation_date }}</td>
                                <th>{{ __('Explained') }}</th>
                                <td colspan="3">@if (app()->getLocale() == 'ar'){{$main->explained_ar}} @else  {{$main->explained}} @endif </td>
                            </tr>
                            <tr>
                                <th>{{__('Cash Id')}}</th>
                                <td>{{ $main->cash_id }} </td>
                                <th>{{__('Document Number')}}</th>
                                <td>{{$main->document_number}}</td>

                            </tr>
                            <tr>
                                <th>{{ __('Document Date') }}</th>
                                <td>{{ $main->doc_date }} </td>
                                <th>{{ __('Type of operation') }}</th>
                                <td>@if($main->type_of_operation == 0)
                                        {{__('financial record')}}
                                    @elseif($main->type_of_operation == 1)
                                        {{__('Cash in')}}
                                    @elseif($main->type_of_operation == 2)
                                        {{__('Cash out')}}
                                    @else
                                        {{__('Cash')}}
                                    @endif</td>

                            </tr>
                            <tr>
                                <th>{{ __('Currency symbol') }}</th>
                                <td>{{ $main->currency_symbol }}</td>
                                <th>{{ __('Exchange rate') }}</th>
                                <td>{{ number_format($main->exchange_rate, 2, '.', ',') }}</td>
                            </tr>

                        </table>

                        <h5>{{ __('details') }}</h5>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Account Number') }}</th>
                                <th>{{ __('Explained') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($main->subs as $sub)
                                <tr>
                                    <td width="5%">{{ $loop->iteration }}</td>
                                    @if($main->type_of_operation == "cashing")
                                        <td width="5%" style="text-align: right">{{number_format($sub->credit, 2, '.', ',')  }}</td>
                                    @else
                                        <td width="5%" style="text-align: right">{{ number_format($sub->debit, 2, '.', ',') }}</td>
                                    @endif
                                     <td width="5%">{{$sub->account_number}}</td>
                                        <td width="5%">@if (app()->getLocale() == 'ar'){{$sub->explained_ar}} @else  {{$sub->explained}} @endif </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                               <th>{{__('Total')}}</th>
                                <td  style="text-align: right">{{number_format($total, 2, '.', ',')}}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        window.print();
    </script>
@endsection

