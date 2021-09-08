@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex">
                        <h2> {{__('Accounts')}} </h2>

                        <a href="{{ route('Accounts.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>
                        <a href="/print" class="btn btn-primary ml-auto"> print</a>
                        <a href="/pdf" class="btn btn-primary ml-auto"> pdf</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>

                        </div>
                        <div>
                            <table class="table table-cl">
                                <thead>
                                <tr>
                                    <th>{{__('Account Number')}}</th>
                                    <th>{{__('Account Name')}}</th>
                                    <th>{{__(' Master Account Number')}}</th>
                                    <th>{{__('Report')}}</th>
                                    <th>{{__('Mainly')}}</th>
                                    <th>{{__('Action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($accounts as $account)
                                    <tr class="active">
                                        <td>{{$account->account_number}} </td>
                                        <td>{{$account->account_name}}</td>
                                        <td> {{$account->master_account_number}}</td>
                                        <td>{{$account->report}}</td>
                                        <td>
                                            @if($account->mainly == 1)
                                                <i class="fas fa-check"></i>
                                            @elseif($account->mainly == null)
                                                <i class="fa fa-times"></i>
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{route('Accounts.edit',$account->id)}}"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $account->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('Accounts.destroy', $account->id) }}" method="post" id="delete-{{ $account->id }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>


                                        </td>

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
