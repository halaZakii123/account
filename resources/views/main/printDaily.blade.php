@extends('layouts.print')
@section('content')

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex" @if (app()->getLocale() == 'ar') style="text-align: right ;direction: rtl;"@endif>
                    <h2>{{ $main->id }}</h2>
                </div>

                <div class="card-body" @if (app()->getLocale() == 'ar') style="text-align: right ;direction: rtl;"@endif>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table  display responsive">
                            <tr>
                                <th>{{ __('Operation Date') }}</th>
                                <td>{{ $main->operation_date }}</td>
                                <th>{{ __('Explained') }}</th>
                                <td>@if (app()->getLocale() == 'ar'){{$main->explained_ar}} @else  {{$main->explained}} @endif </td>
                            </tr>
                            <tr>
                                <th>{{__('Cash Id')}}</th>
                                <td>{{ $main->cash_id }} </td>
                                <th>{{__('document_number')}}</th>
                                <td>{{ $main->document_number }} </td>

                            </tr>
                            <tr>
                                <th>{{ __('Type of operation') }}</th>
                                <td>{{ $main->type_of_operation }}</td>
                                <th>{{ __('Currency symbol') }}</th>
                                <td>{{ $main->currency_symbol }}</td>
                                <th>{{ __('Exchange rate') }}</th>
                                <td>{{ $main->exchange_rate }}</td>
                            </tr>

                        </table>

                        <h5>{{ __('details') }}</h5>

                        <table class="table">
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
                                        <td width="5%">{{ $sub->credit }}</td>
                                    @else
                                        <td width="5%">{{ $sub->debit }}</td>
                                    @endif
                                     <td width="5%">{{$sub->account_number}}</td>
                                        <td width="5%">@if (app()->getLocale() == 'ar'){{$sub->explained_ar}} @else  {{$sub->explained}} @endif </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                               <th>{{__('Total')}}</th>
                                <td>{{$total}}</td>
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
