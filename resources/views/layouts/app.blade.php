<!doctype html>
<html dir="{{ str_replace('_', '-', app()->getLocale()) == 'ar' ? 'rtl' : 'ltr' }}"
      lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
          crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>

@if (app()->getLocale() == 'ar')
        <style>
            a,
            .table,
            .card-body
            .card-title,
            .card-text,
            .dropdown-item,
            .dropdown-menu,
            li,
            i,
            div {
                text-align: right;
            }
        </style>
    @endif
    @yield('style')
</head>

<body>

<div id="app">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            @auth()
                {{ __( Auth::user()->company_name) }}
            @endauth
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                @auth()
                @if (Auth::user()->parent_id == null)
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('Users.index')}}"> {{__('Employees')}}</a>
                    </li>

                   @endif
                @endauth
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('Accounts.index')}}"> {{__('Accounts')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('Options.index')}}"> {{__('Options')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('Sets.index')}}"> {{__('Sets')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('Mains.index')}}"> {{__('Mains')}}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('Transactions.index')}}"> {{__('Transactions')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('gl')}}"> {{__('Gl')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('BLdaily')}}"> {{__('Daily balances')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('BLsheetGet')}}"> {{__('Balance sheet')}}</a>
                </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('getvote')}}"> {{__('vote')}}</a>
                </li>
                @auth()
                    @if(Auth::user()->parent_id== null)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('poll.index')}}">{{__('poll')}}</a>
                        </li>
                            <li class="nav-item">
                            <a class="nav-link" href="{{route('allResult')}}">{{__('allResult')}}</a>
                        </li>
                    @endif
                 @endauth

            </ul>
            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                                <li class="nav-item dropdown  @if (app()->getLocale() == 'ar') ml-auto text-right
                                @else mr-auto @endif">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{__('lang')}}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="{{ asset('/locale/ar') }}"> {{__('Arabic')}}</a>
                                        <a class="dropdown-item" href="{{ asset('/locale/en') }}"> {{__('Eng')}}</a>
                                    </div>
                                </li>
                            </ul>

        </div>
    </nav>

    <main class="py-4">
        @yield('content')

    </main>
</div>


</body>


@yield('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


 <script src="{{ asset('js/app.js') }}" ></script>
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>

</html>
