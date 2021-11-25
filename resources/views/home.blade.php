@auth()
    @extends('layouts.amz')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                {{--                        <h4 class="page-title">{{ Request::segment(1) }}</h4>--}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">{{__('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </nav>

            </div>
        </div>
    </div>
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
                        <ul class="wizard-timeline center-align">
                            <li class="completed">
                                <span class="step-num">1</span>
                                <label> {{__('Create your company')}}</label>
                            </li>
                            <li class="completed">
                                <span class="step-num">2</span>
                                <label>{{__('Add your employee')}}</label>
                            </li>
                            <li class="active">
                                <span class="step-num">3</span>
                                <label>{{__('Create Accounts')}}</label>
                            </li>
                            <li>
                                <span class="step-num">4</span>
                                <label>{{__('Create Options')}}</label>
                            </li>
                            <li>
                                <span class="step-num">4</span>
                                <label>{{__('Create Sets')}}</label>
                            </li>
                            <li>
                                <span class="step-num">4</span>
                                <label>{{__('Create Mains')}}</label>
                            </li>
                        </ul>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
