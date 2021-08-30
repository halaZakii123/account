@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h2> {{__('Mains')}} </h2>

                        <a href="{{ route('Mains.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>

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
                                    <th>{{__('Operation_number')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Explained')}}</th>
                                    <th>{{__('Type_of_operation')}}</th>
                                    <th>{{__('Currency_symbol')}}</th>
                                    <th>{{__('Exchange_rate')}}</th>
                                    <th>{{__('Action')}}</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mains as $main)
                                    <tr class="active">
                                        <td>{{$main->id}} </td>
                                        <td>{{$main->operation_date}} </td>
                                        <td>{{$main->explained}} </td>
                                        <td>{{$main->type_of_operation}} </td>
                                        <td>{{$main->currency_symbol}} </td>
                                        <td>{{$main->exchange_rate}} </td>
                                            <td><a href="{{route('Mains.edit',$main->id) }}"><i class="fa fa-edit"></i></a>
                                                <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $main->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                <form action="{{ route('Mains.destroy', $main->id) }}" method="post" id="delete-{{ $main->id }}" style="display: none;">
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
