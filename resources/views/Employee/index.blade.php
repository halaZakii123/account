@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"> </script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex">

{{--                        @if (Auth::user()->parent_id == null)--}}
{{--                            <button class="btn"><a href="{{route('Users.index')}}"> {{__('Employees')}} </a></button>--}}
{{--                        @endif--}}
{{--                        <button class="btn"><a href="{{route('Accounts.index')}}"> {{__('Accounts')}} </a></button>--}}
{{--                        <button class="btn"><a href="{{route('Options.index')}}"> {{__('Options')}}</a></button>--}}
{{--                        <button class="btn"><a href="{{route('Mains.index')}}"> {{__('Mains')}}</a></button>--}}


                            <a href="{{ route('Users.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>


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
                        <table class="table display responsive nowrap">                                <thead>
                                <tr>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Action')}}</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)

                                    <tr class="active">
                                        <td>
                                            {{$user->name}} </td>
                                        <td>{{$user->email}}

                                        </td>
                                        <td>  <a href="{{route('Users.edit',$user->id) }}"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $user->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('Users.destroy', $user->id) }}" method="post" id="delete-{{ $user->id }}" style="display: none;">
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
