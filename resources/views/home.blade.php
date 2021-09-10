@auth()
    @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Auth::user()->parent_id == null)
                        <button class="btn"><a href="{{route('Users.index')}}"> {{__('Employees')}} </a></button>
                    @endif
                        <button class="btn"><a href="{{route('Accounts.index')}}"> {{__('Accounts')}} </a></button>
                        <button class="btn"><a href="{{route('Options.index')}}"> {{__('Options')}}</a></button>
                        <button class="btn"><a href="{{route('Subs.index')}}"> {{__('Subs')}}</a></button>
                        <button class="btn"><a href="{{route('Mains.index')}}"> {{__('Mains')}}</a></button>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
