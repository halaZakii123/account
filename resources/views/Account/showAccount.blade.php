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
                                        <td> <a href="/show_master/{{$account->master_account_number}}">{{$account->master_account_number}} </a></td>
                                        <td>{{$account->report}}</td>
                                        <td>
                                         @if($account->mainly == 1)
                                                <i class="fas fa-check"></i>
                                          @elseif($account->mainly == null)
                                                <i class="fa fa-times"></i>
                                            @endif
                                        </td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
