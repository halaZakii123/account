@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex">
                        <h2> {{__('Options')}} </h2>

                        <a href="{{ route('Options.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>
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
                                    <th>{{__('Type')}}</th>
                                    <th>{{__('Content')}}</th>
                                    <th>{{__('Actions')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($options as $option)
                                    <tr class="active">
                                        <td>{{$option->type}} </td>
                                        <td>{{$option->contents}}</td>
                                        <td>
                                            <a href="{{route('Options.edit',$option->id) }}"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $option->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('Options.destroy', $option->id) }}" method="post" id="delete-{{ $option->id }}" style="display: none;">
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
