@extends('layouts.amz')
@section('style')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
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
                        <li class="breadcrumb-item active" aria-current="page">{{__('Sets')}}</li>

                    </ol>
                </nav>

            </div>
        </div>
    </div>

    <?php
    $user_id = App\Helpers\checkPermissionHelper::checkPermission();
    $sets = App\Set::where('parent_id',$user_id)->get();
    foreach ($accounts as $account){
        foreach ($sets as $set){
            if ($account->account_number == $set->value ){
                $s= $account->account_name;


            }
        }}
    ?>

            <div class="col-md-8" style="margin: auto ;">
                <div class="card">
                    <div class="card-header d-flex">
                     @if($x <= 0)
                        <a href="{{ route('Sets.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('create') }}</a>
                      @endif
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div>

                        </div>
                            <div class="table-responsive">
                            <table class="table table-bordered  display responsive nowrap  setDataTable">
                                <thead>
                                <tr>
                                    <th>{{__('Type')}}</th>
                                    <th>{{__('Value')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sets as $set)
                                    <tr class="active">
                                        <td>@if($set->key == 'cash_id') {{__('Cash id')}} @else {{__(' ')}} @endif</td>
                                        <td>
                                            {{$set->value}}
                                            {{$s}}
                                        </td>


                                        <td>
                                            <a href="{{route('Sets.edit',$set->id) }}"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" onclick=" { document.getElementById('delete-{{ $set->id }}').submit(); } " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('Sets.destroy', $set->id) }}" method="post" id="delete-{{ $set->id }}" style="display: none;">
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

@endsection
@section('script')

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.setDataTable').DataTable();

        });
    </script>
@endsection
