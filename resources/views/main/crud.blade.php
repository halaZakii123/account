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


{{--@foreach ($account_numbers as $a)--}}
{{--     {{$a}}--}}
{{--    @endforeach--}}
  @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h2> {{__('Mains')}} <span> @if(!empty($main))#{{$main->id}} @endif</span></h2>
                        <a href="{{ route('Mains.index') }}" class="btn btn-primary ml-auto"><i class="fa fa-home"></i> {{ __('Back') }}</a>
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
                                        <label for="Explained" >{{ __('Explained') }}</label>
                                        <input id="Explained" type="text" class="form-control @error('Explained') is-invalid @enderror" name="Explained" value= "@if (!empty($main)) {{ $main->explained}} @else {{ old('Explained') }} @endif" required >
                                        @error('Explained')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="type_of_operation" >{{ __('Type of Operation') }}</label>
                                        <select name="type_of_operation" id="type_of_operation" class="unit form-control">
                                            <option value="" disabled> Select type of operation</option>
                                            @foreach($ops as $op)
                                                @if(!empty($main))
                                                    <option value=" {{$op->contents}} "{{ $main->type_of_operation == $op->contents? 'selected' : '' }} >{{$op->contents}} </option>
                                                @else
                                                    <option value="{{$op->contents}}" {{ old('type_of_operation')? 'selected' : '' }} >{{$op->contents}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('type_of_operation')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="currency_symbol">{{ __('Currency Symbol') }}</label>
                                        <select name="currency_symbol" id="currency_symbol" class="unit form-control" >
                                            <option value="" disabled> Select type of operation</option>
                                            @foreach($cus as $cu)
                                                @if(!empty($main))
                                                    <option value=" {{$cu->contents}} "{{ $main->currency_symbol == $cu->contents? 'selected' : '' }} >{{$cu->contents}} </option>
                                                @else
                                                    <option value="{{$cu->contents}}" {{ old('currency_symbol')? 'selected' : '' }} >{{$cu->contents}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('type_of_operation')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exchange_rate" >{{ __('exchange_rate') }}</label>
                                        <input id="exchange_rate'" type="text" class="form-control @error('exchange_rate') is-invalid @enderror" name="exchange_rate"  required value= "@if (!empty($main)) {{ $main->exchange_rate}} @else {{ old('exchange_rate') }} @endif" required >
                                        @error('exchange_rate')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="sub_details">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ __('Debit') }}</th>
                                        <th>{{ __('Credit') }}</th>
                                        <th>{{ __('Account Number') }}</th>
                                        <th>{{ __('explained') }}</th>
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
                                                    <input type="number" name="debit[{{ $loop->index }}]" id="debit" class="debit_filed" value= "{{  $sub->debit}} " required  onchange="gettotald(),Total(),check()" >
                                                    @error('debit')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>
                                                <td>
                                                    <input id="credit" type="number" class="credit_filed"  name="credit[{{ $loop->index }}]" value= " {{ $sub->credit}} " required  onchange="gettotalc(),Total(),check()">
                                                    @error('credit')<span class="help-block text-danger">{{ $message }}</span>@enderror

                                                </td>
                                                <td>
                                                    <select name="account_number[{{ $loop->index }}]" id="account_number" class="account_number form-control">
                                                        <option></option>
                                                        @foreach($accounts as $account)
                                                            <option value=" {{ $account->account_number }} "{{ $sub->account_number == $account->account_number? 'selected' : '' }}  >{{$account->account_number}} </option>
                                                        @endforeach
                                                    </select>
                                                    @error('option')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>
                                                <td>
                                                    <input id="explained" type="text" class="form-control "name="explained[{{ $loop->index }}]" value= "{{ $sub->explained}}" required >
                                                    @error('explained')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>
                                                <td>
                                                   <input class="box" id="total" value="0" >
                                                </td>

                                            </tr>

                                        @endforeach


                                         @else
                                        <tr class="cloning_row" id="0">
                                            <td>#</td>
                                            <td>
                                                <input type="number" name="debit[0]" id='debit' class="debit_filed" value= "  {{ old('debit') }} "  required onchange="gettotald(),Total(),check()" >
                                                @error('debit')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                            </td>
                                            <td>
                                                <input id="credit" type="number" class="credit_filed"  name="credit[0]" value= "{{ old('credit') }}" required onchange="gettotalc(),Total(),check()" >
                                                @error('credit')<span class="help-block text-danger">{{ $message }}</span>@enderror

                                            </td>
                                            <td>
                                                <select name="account_number[0]" id="account_number" class=" form-control">
                                                    <option></option>
                                                    @foreach($accounts as $account)
                                                        <option value="{{$account->account_number}}"{{old('account_number')}} >{{$account->account_number}} </option>
                                                    @endforeach
                                                </select>
                                                @error('option')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                            </td>
                                            <td>
                                                <input id="explained" type="text" class="explained form-control "name="explained[0]" value= " {{ old('explained') }}" required >
                                                @error('explained')<span class="help-block text-danger">{{ $message }}</span>@enderror

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
                                    <button   type="button" id="btn_add" class="btn_add btn btn-primary">{{ __('add_another_sub') }}</button>
                                </td>

                            </tr>
                            </tfoot>
                            <div class="table-responsive">
                                <table class="table" id="sub_details">
                                    <thead>
                                        <tr>

                                            <th>{{ __('Total_Debit') }}</th>
                                            <th>{{ __(' total_Credit') }}</th>
                                            <th>{{ __('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="total">
                                             <td><input type="number" id="totalDebit" class="totalD" value="0" readonly="readonly"   ></td>
                                             <td><input type="number" id="totalCredit"  class="totalC" value="0" readonly="readonly" ></td>
                                             <td><input type="number"  name="total" id="total" value="0" class="total" readonly="readonly"  >                                             <span id="error"></span>
                                             </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-right pt-3">
                                <button onclick="check()" name="save" class=" enableOnInput btn btn-primary"  >{{ __('save') }}  </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

{{--    <script>--}}
{{--        function myFunction() {--}}
{{--            let trCount = $('#sub_details').find('tr.cloning_row:last').length;--}}
{{--            let numberIncr = trCount > 0 ? parseInt($('#sub_details').find('tr.cloning_row:last').attr('id')) + 1 : 0;--}}
{{--            $('#sub_details').find('tbody').append($('' +--}}
{{--                '<tr class="cloning_row" id="' + numberIncr + '">' +--}}
{{--                '<td><button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +--}}
{{--                '<td><input type="text" name="debit[' + numberIncr + ']" class="debit_filed" onchange="gettotald(),Total(),check()"></td>' +--}}
{{--                '<td><input type="text" name="credit[' + numberIncr + ']" class="credit_filed" onchange="gettotalc(),Total(),check()"></td>' +--}}
{{--                '<td><select name="unit[' + numberIncr + ']" class="unit form-control"> <option  value =" posts"></option>' +--}}
{{--                '<td><input type="text" name="explained[' + numberIncr + ']" step="0.01" class="explained form-control"></td>' +--}}
{{--                '<td>  </td>'+--}}
{{--                --}}
{{--                    --}}
{{--            --}}
{{--                '</tr>'));--}}
{{--            --}}

{{--        }--}}

{{--    </script>--}}
    <script>
        $(document).on('click', '.btn_add', function () {

            $count = 1;
            console.log('x:',$count);
            $.ajax({
                type:'post',
                url:'{{URL::to('/addOption')}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'count': $count,

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

        function gettotald() {
            var arr = document.querySelectorAll('.debit_filed');
            var total =0;
            for (var i=0; i<arr.length;i++){
                if (parseInt(arr[i].value)){
                    total+=parseInt(arr[i].value);
                }
            }
            document.getElementById('totalDebit').value = total;
        }
        function gettotalc() {
            var arr = document.querySelectorAll('.credit_filed');
            var total =0;
            for (var i=0; i<arr.length;i++){
                if (parseInt(arr[i].value)){
                    total+=parseInt(arr[i].value);
                }
            }
            document.getElementById('totalCredit').value = total;
        }
        function Total() {
            var x = document.getElementById("totalDebit").value;
            var y = document.getElementById("totalCredit").value;
            var z = parseInt(x-y);
            document.getElementById("total").value = z;
        }
        function check() {
            var x = document.getElementById("total").value;
            if (x != 0) {
                error.innerHTML = "<span style='color: red;'>"+
                    "The Total must be zero</span>"
                $('.enableOnInput').prop('disabled', true);

            } else {
                // input is fine -- reset the error message
                error.innerHTML = ""
                $('.enableOnInput').prop('disabled', false);
            }
        }
    </script>
 <script>
     $(document).on('click', '.delegated-btn', function (e) {
         e.preventDefault();
         $(this).parent().parent().remove();})

     $('form').validate({
         rules: {
             'operation_date' : { required:true },
             'explained' : { required:true, email:true },
             'type_of_operation' : { required:true, digits: true, minlength: 10, maxlength: 14 },
             'currency_symbol' : { required:true },
             'invoice_number' : { required:true, digits: true },
             'exchange_rate' : { required:true },
             'debit' : { required:true ,digits:true},
             'credit' : { required:true ,digits:true},
             'account_number' : { required:true ,digits:true},
         },
         submitHandler: function (form) {
             form.submit();
         }
     });
 </script>

    <script src="{{ asset('js/form_validation/jquery.form.js') }}"></script>
    <script src="{{ asset('js/form_validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/form_validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('js/custom.js') }}"></script>

@endsection



