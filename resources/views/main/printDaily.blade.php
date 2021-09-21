@extends('layouts.print')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h2>{{ $main->id }}</h2>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>{{ __('Operation Date') }}</th>
                                <td>{{ $main->operation_date }}</td>
                                <th>{{ __('Explained') }}</th>
                                <td>@if (app()->getLocale() == 'ar'){{$main->explained_ar}} @else  {{$main->explained}} @endif </td>
                            </tr>
                            <tr>
                                <th>{{ __('Type of operation') }}</th>
                                <td>{{ $main->type_of_operation }}</td>
                                <th>{{ __('Currency Symbol') }}</th>
                                <td>{{ $main->currency_symbol }}</td>
                                <th>{{ __('Exchange rate') }}</th>
                                <td>{{ $main->exchange_rate }}</td>
                            </tr>
                            <tr>
                                <th>{{__('Account Number')}}</th>
                                @foreach($main->subs as $sub)
                                 <td>{{ $sub->account_number }} </td>
                                @endforeach
                            </tr>
                        </table>

                        <h3>{{ __('details') }}</h3>

                        <table class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Explained') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($main->subs as $sub)
                                <tr>
                                    <td width="5%">{{ $loop->iteration }}</td>
                                    @if($main->type_of_operation == "cashing")
                                        <td width="10%">{{ $sub->credit }}</td>
                                    @else
                                        <td width="10%">{{ $sub->debit }}</td>
                                    @endif
                                        <td width="10%">@if (app()->getLocale() == 'ar'){{$sub->explained_ar}} @else  {{$sub->explained}} @endif </td>
                                </tr>
                            @endforeach
                            </tbody>

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

