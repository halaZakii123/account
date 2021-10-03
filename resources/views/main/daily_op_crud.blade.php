@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/pickadate/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pickadate/classic.date.css') }}">
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    window.addEventListener('load', (event) => {

        var arr = document.querySelectorAll('.amount_filed');
        var total =0;
        for (var i=0; i<arr.length;i++){
            if (parseInt(arr[i].value)){
                total+=parseInt(arr[i].value);
            }
        }

        document.getElementById("total").value = total;
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
                                        <input id="operation_date" type="text" class=" form-control pickdate" name="operation_date" required  value= " {{ Carbon\Carbon::now()->format('Y/m/d') }}" >
                                        @error('operation_date')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="Explained" >{{ __('Explained in eng') }}</label>
                                        <input id="Explained" type="text" class="form-control @error('Explained') is-invalid @enderror" name="Explained" value= "@if (!empty($main)) {{ $main->explained}} @else {{ old('Explained') }} @endif" required autocomplete="on" >
                                        @error('Explained')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="Explained_ar" >{{ __('Explained in ar') }}</label>
                                        <input id="Explained_ar" type="text" class="form-control @error('Explained_ar') is-invalid @enderror" name="Explained_ar" value= "@if (!empty($main)) {{ $main->explained_ar}} @else {{ old('Explained_ar') }} @endif" required autocomplete="on">
                                        @error('Explained_ar')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cash id" >{{ __('Cash Id') }}</label>
                                        <select name="cash_id" id="cash_id" class="cash_id form-control">
                                            <option>{{$c}}</option>
                                            @foreach($account_numbers as $account)
                                                @if($account != $c)
                                                  @if(!empty($main))
                                                        <option value=" {{$account}} "{{ $main->cash_id == $account? 'selected' : '' }} >{{$account}} </option>
                                                      @else
                                                        <option value="{{$account}}" {{ old('cash_id')? 'selected' : '' }} >{{$account}} </option>
                                                      @endif
                                                @endif
                                            @endforeach
                                        </select>                                        @error('cash_id')<span class="help-block text-danger">{{ $message }}</span>@enderror
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
                                        <select name="type_of_operation" id="type_of_operation" class="unit form-control">
                                            @if(!empty($main))
                                                <option value="{{$main->type_of_operation}}">
                                                    @if($main->type_of_operation == 0)
                                                        {{__('financial record')}}
                                                    @elseif($main->type_of_operation == 1)
                                                        {{__('Cash in')}}
                                                    @elseif($main->type_of_operation == 2)
                                                        {{__('Cash out')}}
                                                    @else
                                                        {{__('Cash')}}
                                                    @endif</option>
                                            @else
                                                <option value="1"@if($cash != 1) disabled @endif>{{__('Cash in')}}</option>
                                                <option value="2"@if($cash != 2) disabled @endif>{{__('Cash out')}}</option>
                                                <option value="3"@if($cash != 3) disabled @endif>{{__('Cash')}}</option>
                                            @endif
                                        </select>
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
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="doc_date" >{{ __('document date') }}</label>
                                            @if(!empty($main))
                                                <input id="doc_date" type="date" class="form-control " name="doc_date"  value= "{{$main->doc_date}}" required >
                                            @else
                                                <input id="doc_date" type="date" class="form-control " name="doc_date"  value= "{{ old('doc_date')? 'selected' : '' }} " required >
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="doc_no" >{{ __('document no') }}</label>
                                            <input id="doc_no" type="text" class="form-control " name="doc_no"  value= "@if (!empty($main)) {{ $main->doc_no}} @else {{ old('doc_no')? 'selected' : '' }} @endif" required >

                                        </div>
                                    </div>
                                </div>
                            <div class="table-responsive">
                                <table class="table" id="sub_details">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Account Name') }}</th>
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
                                                    <input type="text" name="amount[{{ $loop->index }}]" id="amount_{{$loop->index}}" class="amount_filed" value="@if($main->type_of_operation == __('Cash in')) {{$sub->credit}} @else {{ $sub->debit }} @endif"   onchange="gettotald(),cur()">
                                                    @error('debit')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>
                                                <td>
                                                    <select name="account_name[{{ $loop->index }}]" id="account_number" class="account_number form-control">
                                                        <option></option>
                                                        @foreach($accounts as $account)
                                                            <option value=" {{$account->account_name}} "{{ $sub->account_name == $account->account_name ? 'selected' : '' }}  >{{$account->account_name}} </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="account_number[{{ $loop->index }}]" id="account_number" class="account_number form-control">
                                                        <option></option>
                                                        @foreach($accounts as $account)
                                                            <option value=" {{$account->account_number}} "{{ $sub->account_number == $account->account_number ? 'selected' : '' }}  >{{$account->account_number}} </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td>
                                                    <input id="explained" type="text" class="form-control "name="explained[{{ $loop->index }}]" value= "{{ $sub->explained}}" required  autocomplete="on">
                                                    @error('explained')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>
                                                <td>
                                                    <input id="explained_ar" type="text" class="form-control " name="explained_ar[{{ $loop->index }}]" value= "{{ $sub->explained_ar}}" required  autocomplete="on">
                                                    @error('explained_ar')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>


                                            </tr>

                                        @endforeach


                                    @else
                                        <tr class="cloning_row" id="0">
                                            <td>#</td>
                                            <td>

                                                <input type="text" name="amount[0]" id='amount_0' class="amount_filed" value="{{old('amount[0]')}}" required onchange=",gettotald()" >
                                                @error('amount')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                            </td>
                                            <td>
                                                <select name="account_name[0]" id="account_name" class=" form-control" onchange="ajaxA()">
                                                    <option></option>
                                                    @foreach($accounts as $account)
                                                        <option value="{{$account->account_name}}"{{old('account_name')}} >{{$account->account_name}} </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                            <select name="account_number[0]" id="A" class=" form-control">


                                            </select>
                                            </td>
                                            <td>
                                                <input id="explained" type="text" class="explained form-control "name="explained[0]" value= " {{ old('explained') }}" required autocomplete="on" >
                                                @error('explained')<span class="help-block text-danger">{{ $message }}</span>@enderror

                                            </td>
                                            <td>
                                                <input id="explained_ar" type="text" class="form-control "name="explained_ar[0]" value= "{{ old('explained_ar') }}" required autocomplete="on">
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
                                    <button   type="button" id="btn_add" class="btn_add btn btn-primary"><i class="fa fa-plus"></i></button>
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

        function gettotald(v) {

            var arr = document.querySelectorAll('.amount_filed');
            var total = 0;


            for (var i=0; i<arr.length;i++){
                if (parseInt(arr[i].value)){
                    total+=parseInt(arr[i].value);
                }
            }
            var num = new Intl.NumberFormat("en-US",{
                maximumSignificantDigits: 1
            })
            document.getElementById('total').value = new Intl.NumberFormat().format(total,0,',',10,'.','');
        }

    </script>

    <script>
        $(document).on('click', '.delegated-btn', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();

        });

    </script>
    <script>
        function cur(v) {
            var vv = document.getElementById('amount_'+v).value;
            var num = new Intl.NumberFormat("en-US",{
                maximumSignificantDigits: 3
            })
            document.getElementById('amount_'+v).value =new Intl.NumberFormat().format(vv,0,',',3,'.','');
        }
    </script>
    <script>
        function ajaxA() {
            var ddl = document.getElementById("account_name");
            var selectedValue = ddl.options[ddl.selectedIndex].value;
            console.log('x:',selectedValue);
            $.ajax({
                type:'post',
                url:'{{URL::to('/addADaily')}}',
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

    <script src="{{ asset('js/form_validation/jquery.form.js') }}"></script>
    <script src="{{ asset('js/form_validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/form_validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('js/custom.js') }}"></script>

@endsection



