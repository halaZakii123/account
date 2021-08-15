@extends('layouts.app')

@section('content')
    <?php          use App\TblAccount;
    $accounts= TblAccount::all();
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ Auth::user()->company_name }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div>
                            <table class="table table-cl">
                                <thead>
                                <tr>
                                    <th>{{__('Account Number')}}</th>
                                    <th>{{__('Account Name')}}</th>
                                    <th>{{__(' Master Account Number')}}</th>
                                    <th>{{__('Report')}}</th>
                                    <th>{{__('Mainly')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                    <tr class="active">
                                        <td>{{$account->account_number}}</td>
                                        <td>{{$account->account_name}}</td>
                                        <td>{{$account->master_account_number}}</td>
                                        <td>{{$account->report}}</td>
                                        <td>{{$account->mainly}}</td>
                                    </tr>


                                </tbody>
                            </table>
                            <button class="btn"><a href="/edit_account/{{$account->id}}">{{__('Edit')}}</a></button>
                            <button class="btn"><a href="/delete_account/{{$account->id}}">{{__('Delete')}}</a></button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
