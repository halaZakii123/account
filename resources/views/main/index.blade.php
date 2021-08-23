@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ Auth::user()->company_name }}
                        @if (Auth::user()->parent_id == null)
                            <button class="btn"><a href="{{route('Users.index')}}"> {{__('Employees')}} </a></button>
                        @endif
                        <button class="btn"><a href="{{route('Accounts.index')}}"> {{__('Accounts')}} </a></button>
                        <button class="btn"><a href="{{route('Options.index')}}"> {{__('Options')}}</a></button>
                        <button class="btn"><a href="{{route('Mains.index')}}"> {{__('Mains')}}</a></button>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <button class="btn"><a href="{{route('Mains.create')}}"> Add <i class="fa fa-plus"></i> </a></button>

                        <div>

                        </div>
                        <div>
                            <table class="table table-cl">
                                <thead>
                                <tr>
                                    <th>{{__('Operation_number')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Explained')}}</th>
                                    <th>{{__('type_of_operation')}}</th>
                                    <th>{{__('currency_symbol')}}</th>
                                    <th>{{__('exchange_rate')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mains as $main)
                                    <tr class="active">
                                        <td>
                                            <a href="{{route('Mains.show',$main->id)}}"><i class="fas fa-eye"></i></a>

                                            {{$main->id}} </td>
                                        <td>{{$main->operation_date}} </td>
                                        <td>{{$main->explained}} </td>
                                        <td>{{$main->type_of_operation}} </td>
                                        <td>{{$main->currency_symbol}} </td>
                                        <td>{{$main->exchange_rate}}

                                            <a href="{{route('Mains.edit',$main->id) }}"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $main->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('Mains.destroy', $main->id) }}" method="post" id="delete-{{ $main->id }}" style="display: none;">
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
