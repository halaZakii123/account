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
                                <td>{{ $main->explained }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Type of Operation') }}</th>
                                <td>{{ $main->type_of_operation }}</td>
                                <th>{{ __('Currency Symbol') }}</th>
                                <td>{{ $main->currency_symbol }}</td>
                                <th>{{ __('Exchange rate') }}</th>
                                <td>{{ $main->exchange_rate }}</td>
                            </tr>
                        </table>

                        <h3>{{ __('details') }}</h3>

                        <table class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>{{ __('Debit') }}</th>
                                <th>{{ __('Credit') }}</th>
                                <th>{{ __('Account Number') }}</th>
                                <th>{{ __('explained') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($main->subs as $sub)
                                <tr>
                                    <td width="5%">{{ $loop->iteration }}</td>
                                    <td width="10%">{{ $sub->debit }}</td>
                                    <td width="10%">{{ $sub->credit }}</td>
                                    <td width="10%">{{ $sub->account_number }}</td>
                                    <td width="10%">{{ $sub->explained }}</td>
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

{{--@section('script')--}}
{{--    <script>--}}
{{--        window.print();--}}
{{--    </script>--}}
{{--@endsection--}}

