@extends('layouts.print')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex" @if (app()->getLocale() == 'ar') style="text-align: right ;direction: rtl;"@endif>
                    <h2>{{ $main->id }}</h2>
                </div>

                <div class="card-body" @if (app()->getLocale() == 'ar') style="text-align: right ;direction: rtl;"@endif>
                    <div class="table-responsive ">
                        <table class="table">
                            <tr>
                                <th>{{ __('Operation Date') }}</th>
                                <td>{{ $main->operation_date }}</td>
                                <th>{{ __('Explained') }}</th>
                                <td colspan="3">@if (app()->getLocale() == 'ar'){{$main->explained_ar}} @else  {{$main->explained}} @endif </td>
                            </tr>
                            <tr>

                                <th>{{__('Document Number')}}</th>
                                <td>{{ $main->document_number }} </td>
                                <th>{{ __('Document Date') }}</th>
                                <td>{{ $main->doc_date }} </td>
                            </tr>
                            <tr>
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
                                <th>{{ __('Currency symbol') }}</th>
                                <td>{{ $main->currency_symbol }}</td>
                                <th>{{ __('Exchange rate') }}</th>
                                <td>{{  number_format($main->exchange_rate, 2, '.', ',') }}</td>
                            </tr>
                        </table>

                        <h3>{{ __('details') }}</h3>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Debit') }}</th>
                                <th>{{ __('Credit') }}</th>
                                <th>{{ __('Account Number') }}</th>
                                <th>{{ __('Explained') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($main->subs as $sub)
                                <tr>
                                    <td >{{ $loop->iteration }}</td>
                                    <td style="text-align: right">{{ number_format($sub->debit, 2, '.', ',')  }}</td>
                                    <td  style="text-align: right">{{  number_format($sub->credit, 2, '.', ',') }}</td>
                                    <td >{{ $sub->account_number }}</td>
                                    <td >@if (app()->getLocale() == 'ar'){{$sub->explained_ar}} @else  {{$sub->explained}} @endif </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{__('Total')}}</th>
                                <td style="text-align: right">{{number_format($totalDebit, 2, '.', ',')}}</td>
                                <td style="text-align: right">{{number_format($totalCredit, 2, '.', ',')}}</td>
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

