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
                    @if (Auth::user()->parent_id == null)
                        <button class="btn"><a href="/add_employee"> Add new employee </a></button>
                    @endif
                        <button class="btn"><a href="/add_account"> Add new account </a></button>

                    <label> Accounting</label>
                    <div>
                            <table class="table table-cl">
                                <thead>
                                <tr>
                                    <th>{{__('Account Number')}}</th>
                                    <th>{{__('Account Name')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($accounts as $account)
                                    <tr class="active">
                                        <td>{{$account->account_number}} </td>
                                        <td>{{$account->account_name}} <a href="/show_account/{{$account->id}}">{{__('show')}}</a> </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
