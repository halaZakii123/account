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
<script>
    window.onbeforeunload = function() {
        localStorage.setItem("debit_filed", $('.debit_filed').val());
        localStorage.setItem("credit_filed", $('.credit_filed').val());
        localStorage.setItem("account_number", $('.account_number').val());
        localStorage.setItem("explained", $('.explained').val());
        localStorage.setItem("explained_ar", $('.explained_ar').val());
        // ...
    }
    window.onload = function() {
        var debit = localStorage.getItem(debit_filed);
        var credit = localStorage.getItem(credit_filed);
        if (debit !== null) $('.debit_filed').val(debit); if (credit !== null) $('.credit_filed').val(credit);
        // ...
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
                        <a href="{{ route('Mains.index') }}" class="btn btn-primary ml-auto"><i class="fa fa-home"></i> {{ __('Back') }}</a>
                        @if(!empty($main))
                        <a href="/pdfM/{{$main->id}}" class="btn btn-primary ml-auto"> pdf</a>
                        <a href="/main/print/{{$main->id}}" class="btn btn-primary ml-auto">print</a>

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
                                        <input id="operation_date" type="text" class=" form-control pickdate" name="operation_date" required  value= " {{ Carbon\Carbon::now()->format('Y/m/d') }}" >
                                        @error('operation_date')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="Explained" >{{ __('Explained in eng') }}</label>
                                        <input id="Explained" type="text" class="form-control "name="Explained" value= "@if (!empty($main)) {{ $main->explained}} @else {{ old('Explained') }} @endif" required autocomplete="on">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="Explained_ar" >{{ __('Explained in ar') }}</label>
                                        <input id="Explained_ar" type="text" class="form-control " name="Explained_ar" value= "@if (!empty($main)) {{ $main->explained_ar}} @else {{ old('Explained_ar') }} @endif" required autocomplete="on">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cash id" >{{ __('Cash Id') }}</label>
                                        <select name="cash_id" id="cash_id" class="cash_id form-control">
                                            <option>{{$c}}</option>
                                            @foreach($accounts as $account)
                                                @if($account->account_number != $c)
                                                    @if(!empty($main))
                                                        <option value=" {{$account->account_number}} "{{ $main->cash_id == $account->account_number? 'selected' : '' }} >{{$account->account_number}} </option>
                                                    @else
                                                        <option value="{{$account->account_number}}" {{ old('cash_id')? 'selected' : '' }} >{{$account->account_number}} </option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('cash_id')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="document_number" >{{ __('Document Number') }}</label>
                                        <input id="document_number" type="text" name="document_number" class="form-control @error('document_number') is-invalid @enderror"  required value="@if (!empty($main)) {{ $main->document_number}} @else {{ old('document_number') }} @endif "  >
                                        @error('document_number')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="type_of_operation" >{{ __('Type of operation') }}</label>
                                        <select name="type_of_operation" id="type_of_operation" class="unit form-control">
                                            <option value="0">{{__('financial record')}}</option>
                                        </select>
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
                                        @error('type_of_operation')<span class="help-block text-danger">{{ $message }}</span>@enderror
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
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="doc_date" >{{ __('document date') }}</label>
                                        @if(!empty($main))
                                         <input id="doc_date" type="date" class="form-control " name="doc_date"  value= "{{$main->doc_date}}" required >
                                        @else
                                         <input id="doc_date" type="date" class="form-control " name="doc_date"  value= "@if (!empty($main)) {{ $main->doc_no}} @else {{ old('doc_no')? 'selected' : '' }} @endif" required >
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="doc_no" >{{ __('document no') }}</label>
                                        <input id="doc_no" type="text" class="form-control " name="doc_no"  value= "{{old('doc_no')}} " required >

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
                                        <th>{{__('Account Name')}}</th>
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
                                                    <input type="text" name="debit[{{ $loop->index }}]" id="debit_{{$loop->index}}" class="debit_filed" value="{{$sub->debit}} "   onchange="gettotald(),changeDebit({{$loop->index}}),gettotalc(),Total(),check(),cur()" >
                                                    @error('debit')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>
                                                <td>
                                                    <input id="credit_{{$loop->index}}" type="text" class="credit_filed"  name="credit[{{ $loop->index }}]" value= " {{ $sub->credit}} "  onchange="gettotalc(),changeCredit({{$loop->index}}),gettotald(),Total(),check(),cur()">
                                                    @error('credit')<span class="help-block text-danger">{{ $message }}</span>@enderror

                                                </td>
                                                <td>
                                                    <select name="account_name[{{ $loop->index }}]" id="account_name" class="account_name form-control" onchange="ajaxA()">
                                                        <option></option>
                                                        @foreach($accounts as $account)
                                                            <option value=" {{$account->account_name}} "{{ $sub->account_name == $account->account_name ? 'selected' : '' }}  >{{$account->account_name}} </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="account_number[{{ $loop->index }}]" id="account_number" class="account_number form-control">
                                                        @foreach($accounts as $account)
                                                            <option value=" {{$account->account_number}} "{{ $sub->account_name == $account->account_number ? 'selected' : '' }}  >{{$account->account_number}} </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input id="explained" type="text" class="form-control "name="explained[{{ $loop->index }}]" value= "{{ $sub->explained}}" required autocomplete="on">
                                                    @error('explained')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>
                                                <td>
                                                    <input id="explained_ar" type="text" class="form-control "name="explained_ar[{{ $loop->index }}]" value= "{{ $sub->explained_ar}}" required autocomplete="on">
                                                    @error('explained_ar')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>
{{--                                                <td>--}}
{{--                                                   <input class="box" id="total" value="0" >--}}
{{--                                                </td>--}}

                                            </tr>

                                        @endforeach


                                         @else
                                        <tr class="cloning_row" id="0">
                                            <td>#</td>
                                            <td>
                                                <input type="text" name="debit[0]" id='debit' class="debit_filed" value="{{old('debit')}}" required onchange="cur(),gettotald() ,change_Debit(),gettotalc(),Total(),check()" >
                                                @error('debit')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                            </td>
                                            <td>
                                                <input id="credit" type="text" class="credit_filed"  name="credit[0]"  value="{{old('credit')}}" required onchange="gettotalc(),change_Credit(),gettotald(),Total(),check(),cur()" >
                                                @error('credit')<span class="help-block text-danger">{{ $message }}</span>@enderror

                                            </td>
                                            <td>
                                                <select name="account_name[0]" id="account_name" class=" form-control" onchange="ajaxA()">
                                                    <option></option>
                                                    @foreach($accounts as $account)
                                                        <option value="{{$account->account_name}}"{{old('account_name')}} >{{$account->account_name}} </option>
                                                    @endforeach
                                                </select>
                                                @error('option')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                            </td>
                                            <td >
                                                <select name="account_number[0]" id="A" class=" form-control">

                                                </select>
                                            </td>
                                            <td>
                                                <input id="explained" type="text" class="explained form-control "name="explained[0]" value= " {{ old('explained') }}" required autocomplete="on" >

                                            </td>
                                            <td>
                                                <input id="explained_ar" type="text" class=" explained_ar form-control "name="explained_ar[0]" value= "{{ old('explained_ar') }}" required autocomplete="on">
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
                                    <button   type="button" id="btn_add" class="btn_add btn btn-primary"><i class="fa fa-plus"></i></button>
                                </td>

                            </tr>
                            </tfoot>
                            <div class="table-responsive">
                                <table class="table" id="sub_details">
                                    <thead>
                                        <tr>

                                            <th>{{ __('Total Debit') }}</th>
                                            <th>{{ __('Total Credit') }}</th>
                                            <th>{{ __('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="total">
                                             <td><input type="text" id="totalDebit" class="totalD" value="0" readonly="readonly"  onchange=" check(), Total()" ></td>
                                             <td><input type="text" id="totalCredit"  class="totalC" value="0" readonly="readonly" onchange="check(),Total()"></td>
                                             <td><input type="text"  name="total" id="total" value="0" class="total" readonly="readonly"  >                                             <span id="error"></span>
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
                url:'{{URL::to('/addOption')}}',
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
        function ajaxA() {
            var ddl = document.getElementById("account_name");
            var selectedValue = ddl.options[ddl.selectedIndex].value;
            console.log('x:',selectedValue);
            $.ajax({
                type:'post',
                url:'{{URL::to('/addA')}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'selectedValue': selectedValue,

                },
                success:function (data){
                    console.log('data:',data);
                    $('#A').html(data);
                },
                error:function(){
                    console.log('error ',$error);
                }
            });

        }
    </script>

    <script>
        function changeDebit(x) {
            var a = document.getElementById('debit_'+x);
                if ((parseInt(a.value) >= 0)){
                    document.getElementById('credit_'+x).value = 0;

                }
        }

    </script>
    <script>
        function changeCredit(x) {
            var a = document.getElementById('credit_'+x);
            if ((parseInt(a.value) >= 0)){
                document.getElementById('debit_'+x).value = 0;
            }

        }
    </script>
    <script>
        function changeDebitt(x) {
            var a = document.getElementById('debit-'+x);
                if ((parseInt(a.value) >= 0)){
                    document.getElementById('credit-'+x).value = 0;

                }
        }

    </script>
    <script>
        function changeCreditt(x) {
            var a = document.getElementById('credit-'+x);
            if ((parseInt(a.value) >= 0)){
                document.getElementById('debit-'+x).value = 0;
            }

        }
    </script>
    <script>
        function change_Debit() {
            var a = document.getElementById('debit');
                if ((parseInt(a.value) >= 0)){
                    document.getElementById('credit').value = 0;

                }

        }

    </script>
    <script>
        function change_Credit(x) {
            var a = document.getElementById('credit');
            if ((parseInt(a.value) >= 0)){
                document.getElementById('debit').value = 0;
            }
        }
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
            var num = new Intl.NumberFormat("en-US",{
                maximumSignificantDigits: 3
            })
            document.getElementById('totalDebit').value =  num.format(total);
        }
        function gettotalc() {
            var arr = document.querySelectorAll('.credit_filed');
            var total =0;
            for (var i=0; i<arr.length;i++){
                if (parseInt(arr[i].value)){
                    total+=parseInt(arr[i].value);
                }
            }
            var num = new Intl.NumberFormat("en-US",{
                maximumSignificantDigits: 3
            })
            document.getElementById('totalCredit').value = num.format(total);
        }

         function check() {
                 var x = document.getElementById("total").value;
                      if (x != 0) {
                 error.innerHTML = "<span style='color: red;'>"+
                     "The Total must be zero</span>"
                 $('.enableOnInput').prop('disabled', true);

             } else {
                          $('.enableOnInput').prop('disabled', false);
             }
         }
    </script>
    <script>
        function Total() {
            var x = document.getElementById("totalDebit").value;
            var y = document.getElementById("totalCredit").value;
            var z = parseInt(x-y);

            document.getElementById("total").value = z;
        }
    </script>
 <script>
     $(document).on('click', '.delegated-btn', function (e) {
         e.preventDefault();
        $(this).parent().parent().remove();

     });

 </script>

    <script>
        function cur() {
            var debitCu = document.getElementById("debit").value;

            document.getElementById("debit").value = new Intl.NumberFormat().format(debitCu);
        }
    </script>


    <script src="{{ asset('js/form_validation/jquery.form.js') }}"></script>
    <script src="{{ asset('js/form_validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/form_validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('js/custom.js') }}"></script>

@endsection



