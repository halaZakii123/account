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

                        <button class="btn"><a href="{{route('Users.create')}}"> Add <i class="fa fa-plus"></i> </a></button>

                        <div>

                        </div>
                        <div>
                            <table class="table table-cl">
                                <thead>
                                <tr>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)

                                    <tr class="active">
                                        <td>
                                            {{$user->name}} </td>
                                        <td>{{$user->email}}
                                            <a href="{{route('Users.edit',$user->id) }}"><i class="fa fa-edit"></i></a>
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
