@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/pickadate/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pickadate/classic.date.css') }}">
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function my() {
        var x = document.getElementById("debit");
        document.getElementById("row_sub_total").value = x.value;}
    function gettotal() {
        var arr = document.querySelectorAll('.dd');
        var total =0;
        for (var i=0; i<arr.length;i++){
            if (parseInt(arr[i].value)){
                total+=parseInt(arr[i].value);
            }
        }
        document.getElementById('total').value = total;
    }
</script>
<script>
    window.addEventListener('load', (event) => {
        var arr = document.querySelectorAll('.debit_filed');
        var total =0;
        for (var i=0; i<arr.length;i++){
            if (parseInt(arr[i].value)){
                total+=parseInt(arr[i].value);
            }
        }
        document.getElementById('totalDebit').value = total;
        var arr = document.querySelectorAll('.credit_filed');
        var total =0;
        for (var i=0; i<arr.length;i++){
            if (parseInt(arr[i].value)){
                total+=parseInt(arr[i].value);
            }
        }
        document.getElementById('totalCredit').value = total;

        var x = document.getElementById("totalDebit").value;
        var y = document.getElementById("totalCredit").value;
        var z = parseInt(x-y);
        document.getElementById("total").value = z;
    });


</script>


{{--@foreach ($account_numbers as $a)--}}
{{--     {{$a}}--}}
{{--    @endforeach--}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <a href="{{ route('Mains.index') }}" class="btn btn-primary ml-auto"><i class="fa fa-home"></i> {{ __('Back') }}</a>
                        @if(!empty($main))
                            <a href="/pdfM/daily/{{$main->id}}" class="btn btn-primary ml-auto"> {{__('pdf')}}</a>
                            <a href="/main/print/daily/{{$main->id}}" class="btn btn-primary ml-auto">{{__('print')}}</a>

                        @endif
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST"  name ="aa" on onsubmit="return v" action="{!! !empty($main) ? route('Mains.update',$main->id)  : route('Mains.store') !!}">
                            @csrf
                            @if (!empty($main))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="operation_date">{{ __('Operation Date') }}</label>
                                        <input id="operation_date" type="text" class=" form-control pickdate" name="operation_date" required  value= "@if (!empty($main)) {{$main->operation_date}} @else {{ old('operation_date') }} @endif" >
                                        @error('operation_date')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="Explained" >{{ __('Explained in eng') }}</label>
                                        <input id="Explained" type="text" class="form-control @error('Explained') is-invalid @enderror" name="Explained" value= "@if (!empty($main)) {{ $main->explained}} @else {{ old('Explained') }} @endif" required >
                                        @error('Explained')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="Explained_ar" >{{ __('Explained in ar') }}</label>
                                        <input id="Explained_ar" type="text" class="form-control @error('Explained_ar') is-invalid @enderror" name="Explained_ar" value= "@if (!empty($main)) {{ $main->explained_ar}} @else {{ old('Explained_ar') }} @endif" required >
                                        @error('Explained_ar')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cash id" >{{ __('Cash Id') }}</label>
                                        <input id="cash_id" type="text" name="cash_id" class="form-control @error('cash_id') is-invalid @enderror" value="{{$c}}" readonly="true">
                                        @error('cash_id')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="document_number" >{{ __('Document Number') }}</label>
                                        <input id="document_number" type="text" name="document_number" class="form-control @error('document_number') is-invalid @enderror" value="@if (!empty($main)) {{ $main->document_number}} @else {{ old('document_number') }} @endif " >
                                        @error('document_number')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="type_of_operation" >{{ __('Type of operation') }}</label>
                                        <input id="type_of_operation" type="text" name="type_of_operation" class="form-control @error('type_of_operation') is-invalid @enderror" value=" @if (!empty($main)) {{ $main->type_of_operation}} @else  {{$v}}  @endif" readonly="true">

                                        @error('type_of_operation')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="currency_symbol">{{ __('Currency symbol') }}</label>
                                        <select name="currency_symbol" id="currency_symbol" class="unit form-control" onchange="ajaxE()" >
                                            <option value="" > {{__('select currency')}}</option>
                                            @foreach($cus as $cu)
                                                @if(!empty($main))
                                                    <option value=" {{$cu->contents}} "{{ $main->currency_symbol == $cu->contents? 'selected' : '' }} >{{$cu->contents}} </option>
                                                @else
                                                    <option value="{{$cu->contents}}" {{ old('currency_symbol')? 'selected' : '' }} >{{$cu->contents}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('Currency symbol')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exchange_rate" >{{ __('Exchange rate') }}</label>
                                        <div id="c">
                                            @if(!empty($main))
                                                <input id="exchange_rate" type="text" class="form-control @error('exchange_rate') is-invalid @enderror" name="exchange_rate"  value= "{{$main->exchange_rate}} " required >
                                            @endif
                                        </div>
                                        @error('exchange_rate')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table" id="sub_details">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Account Number') }}</th>
                                        <th>{{ __('Explained in eng') }}</th>
                                        <th>{{ __('Explained in ar') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="i">
                                    @if(!empty($main))

                                        @foreach($main->subs as $sub)
                                            <tr class="cloning_row" id="{{ $loop->index }}">
                                                <td>
                                                    @if($loop->index == 0)
                                                        {{ '#' }}
                                                    @else
                                                        <button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="text" name="amount[{{ $loop->index }}]" id="amount_{{$loop->index}}" class="amount_filed" value="@if($main->type_of_operation == __('Cash'))  {{$sub->credit}} @else {{ $sub->debit }} @endif"   onchange="gettotald()">
                                                    @error('debit')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>
                                                <td>
                                                    <select name="account_number[{{ $loop->index }}]" id="account_number" class="account_number form-control">
                                                        <option></option>
                                                        @foreach($account_numbers as $account)
                                                            <option value=" {{$account}} "{{ $sub->account_number == $account ? 'selected' : '' }}  >{{$account}} </option>
                                                        @endforeach
                                                    </select>
                                                    @error('option')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>

                                                <td>
                                                    <input id="explained" type="text" class="form-control "name="explained[{{ $loop->index }}]" value= "{{ $sub->explained}}" required >
                                                    @error('explained')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>
                                                <td>
                                                    <input id="explained_ar" type="text" class="form-control " name="explained_ar[{{ $loop->index }}]" value= "{{ $sub->explained_ar}}" required >
                                                    @error('explained_ar')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>


                                            </tr>

                                        @endforeach


                                    @else
                                        <tr class="cloning_row" id="0">
                                            <td>#</td>
                                            <td>
                                                <input type="number" name="amount[0]" id='amount' class="amount_filed"  required onchange="gettotald() " >
                                                @error('amount')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                            </td>
                                            <td>
                                            <select name="account_number[0]" id="account_number" class=" form-control">
                                                <option></option>
                                                @foreach($account_numbers as $account)
                                                    <option value="{{$account}}"{{old('account_number')}} >{{$account}} </option>
                                                @endforeach
                                            </select>
                                            </td>
                                            <td>
                                                <input id="explained" type="text" class="explained form-control "name="explained[0]" value= " {{ old('explained') }}" required >
                                                @error('explained')<span class="help-block text-danger">{{ $message }}</span>@enderror

                                            </td>
                                            <td>
                                                <input id="explained_ar" type="text" class="form-control "name="explained_ar[0]" value= "{{ old('explained_ar') }}" required >
                                                @error('explained_ar')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                            </td>

                                        </tr>

                                        <tr id="i">

                                        </tr>
                                    @endif
                                    </tbody>


                                </table>
                            </div>
                            <tfoot>
                            <tr>
                                <td colspan="6">
                                    <button   type="button" id="btn_add" class="btn_add btn btn-primary">{{ __('Add another sub') }}</button>
                                </td>

                            </tr>
                            </tfoot>
                            <div class="table-responsive">
                                <table class="table" id="sub_details">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Total') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="total">

                                        <td><input type="number"  name="total" id="total" value="0" class="total" readonly="readonly"  >                                             <span id="error"></span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-right pt-3">
                                <button onclick="check()" name="save" class=" enableOnInput btn btn-primary"  >{{ __('Submit') }}  </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        var c = 0;
        $(document).on('click', '.btn_add', function () {

            c++;
            console.log('x:',c);
            $.ajax({
                type:'post',
                url:'{{URL::to('/addDailyOp')}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'count': c,

                },
                success:function (data){
                    console.log('data:',data);
                    $('#i').append(data);
                },
                error:function(){
                    console.log('error ',$error);
                }
            });

        });
    </script>
    <script>
        function ajaxE() {
            var ddl = document.getElementById("currency_symbol");
            var selectedValue = ddl.options[ddl.selectedIndex].value;
            console.log('x:',selectedValue);
            $.ajax({
                type:'post',
                url:'{{URL::to('/addC')}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'selectedValue': selectedValue,

                },
                success:function (data){
                    console.log('data:',data);
                    $('#c').html(data);
                },
                error:function(){
                    console.log('error ',$error);
                }
            });

        }
    </script>


    <script>

        function gettotald() {
            var arr = document.querySelectorAll('.amount_filed');
            var total =0;
            for (var i=0; i<arr.length;i++){
                if (parseInt(arr[i].value)){
                    total+=parseInt(arr[i].value);
                }
            }
            document.getElementById('total').value = total;
        }

    </script>

    <script>
        $(document).on('click', '.delegated-btn', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();

        });

    </script>


    <script src="{{ asset('js/form_validation/jquery.form.js') }}"></script>
    <script src="{{ asset('js/form_validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/form_validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('js/custom.js') }}"></script>

@endsection



