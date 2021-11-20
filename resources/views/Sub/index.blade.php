@extends('layouts.amz')

@section('content')

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

                        <button class="btn"><a href="{{route('Subs.create')}}"> Add <i class="fa fa-plus"></i> </a></button>

                        <div>

                        </div>
                        <div>
                            <table class="table table-cl">
                                <thead>
                                <tr>
                                    <th>{{__('Debit')}}</th>
                                    <th>{{__('Credit')}}</th>
                                    <th>{{__('Account_number')}}</th>
                                    <th>{{__('Explained')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subs as $sub)
                                    <tr class="active">
                                        <td>{{$sub->debit}} </td>
                                        <td>{{$sub->credit}} </td>
                                        <td>{{$sub->account_number}} </td>
                                        <td>{{$sub->explained}}
                                            <a href="{{route('Subs.edit',$sub->id) }}"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $sub->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('Subs.destroy', $sub->id) }}" method="post" id="delete-{{ $sub->id }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
