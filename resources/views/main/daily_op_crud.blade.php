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
                        <li class="breadcrumb-item active" aria-current="page">{{__('Mains')}}</li>
                        @if(!empty($main))
                            <li class="breadcrumb-item active" aria-current="page">{{__('update')}}</li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{__('create')}}</li>
                        @endif
                    </ol>
                </nav>

            </div>
        </div>
    </div>
   
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                   
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form method="POST"  name ="aa" onsubmit="return validateForm()" action="{!! !empty($main) ? route('Mains.update',$main->id)  : route('Mains.store') !!}">
                            @csrf
                            @if (!empty($main))
                                @method('PUT')
                            @endif
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="operation_date">{{ __('Operation Date') }}</label>
                                            @if(!empty($main))
                                                <input id="operation_date" type="text" class=" form-control" name="operation_date" required  value= "{{$main->operation_date}}" >
                                            @else
                                                <input id="operation_date" type="date" class=" form-control" name="operation_date" required data-date-start-date="d"  value= "{{date('Y-m-d', )}}" >
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="Explained" >{{ __('Explained in eng') }}</label>
                                            @if(!empty($main))
                                                <input id="Explained" type="text" class="form-control" name="Explained" value= " {{ $main->explained}}"  autocomplete="on">
                                            @else
                                                <input id="Explained" type="text" class="form-control " name="Explained" autocomplete="on">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="Explained_ar" >{{ __('Explained in ar') }}</label>
                                            @if(!empty($main))
                                                <input id="Explained_ar" type="text" class="form-control " name="Explained_ar" value= " {{ $main->explained_ar}} "  autocomplete="on">
                                            @else
                                                <input id="Explained_ar" type="text" class="form-control " name="Explained_ar"  autocomplete="on">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="cash id" >{{ __('Cash Id') }}</label>
                                            <select name="cash_id" id="cash_id" class="cash_id form-control" required>
                                                <option value="{{$c->account_number}}">{{ $c->account_number.' '.$c->account_name}}</option>
                                                @foreach($accounts as $account)
                                                    @if($account->account_number != $c->account_number)
                                                        @if(!empty($main))
                                                            <option value="{{$account->account_number}}"
                                                                {{ $main->cash_id == $account->account_number? 'selected' : '' }} >
                                                                {{$account->account_number.' '.$account->account_name}} </option>
                                                        @else
                                                            <option value="{{$account->account_number}}" {{ old('cash_id')? 'selected' : '' }} >{{$account->account_number.' '.$account->account_name}} </option>
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
                                            @if(!empty($main))
                                                <input id="document_number" type="text" name="document_number" class="form-control "  required value=" {{ $main->document_number}}  "  >
                                            @else
                                                <input id="document_number" type="text" name="document_number" class="form-control "  required value="{{ old('document_number') }}"  >

                                            @endif
                                            @error('document_number')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="doc_date" >{{ __('Document Date') }}</label>
                                            @if(!empty($main))
                                                <input id="doc_date" type="date" class="form-control " name="doc_date"  value= "{{$main->doc_date}}" required >
                                            @else
                                                <input id="doc_date" type="date" class="form-control " name="doc_date"  data-date-start-date="d"  value= "{{date('Y-m-d', )}}"  required >
                                            @endif
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
                                        <select name="currency_symbol" id="currency_symbol" class="unit form-control" onchange="ajaxE()" required>
                                            
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
                                          @else
                                                <input id="exchange_rate " type="text" class="form-control " name="exchange_rate"  value= "" required >

                                            @endif
                                        </div>
                                        @error('exchange_rate')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                                <div class="row">


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
                                                    <input type="currency"  name="amount[{{ $loop->index }}]" id="amount_{{$loop->index}}" class="amount_filed" value="@if($main->type_of_operation == 1) {{$sub->debit}} @else {{ $sub->credit }} @endif"   onchange="gettotald(),cur()"style="text-align: right">
                                                    @error('debit')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>
                                                <td>
                                                    <select name="account_number[{{ $loop->index }}]" id="account_number" class="account_number form-control"><option>

                                                    @foreach($accounts as $account)
                                                            <option value=" {{$account->account_number}} "{{ $sub->account_number == $account->account_number ? 'selected' : '' }}  >{{$account->account_number}} {{$account->account_name}} </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td>
                                                    <input id="explained" type="text" class="form-control "name="explained[{{ $loop->index }}]" value= "{{ $sub->explained}}"  autocomplete="on">
                                                    @error('explained')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>
                                                <td>
                                                    <input id="explained_ar" type="text" class="form-control " name="explained_ar[{{ $loop->index }}]" value= "{{ $sub->explained_ar}}"   autocomplete="on">
                                                    @error('explained_ar')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                                </td>


                                            </tr>

                                        @endforeach
                                    @else
                                        <tr class="cloning_row" id="0">
                                            <td>#</td>
                                            <td>

                                                <input  type="currency"  name="amount[0]" id='amount_0' class="amount_filed " value="{{old('amount[0]')}}" required onchange="gettotald()" style="text-align: right">
                                                @error('amount')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                            </td>
                                            <td>
                                                <select name="account_number[0]" id="account_number" class=" form-control"  required>
                                                    <option></option>
                                                    @foreach($accounts as $account)
                                                        <option value="{{$account->account_number}}"{{old('account_number')}} > {{ $account->account_number }} {{$account->account_name}} </option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td>
                                                <input id="explained" type="text" class="form-control" name="explained[0]" value= " {{ old('explained') }}" >
                                                @error('explained')<span class="help-block text-danger">{{ $message }}</span>@enderror

                                            </td>
                                            <td>
                                                <input id="explained_ar" type="text" class="form-control "name="explained_ar[0]" value= "{{ old('explained_ar') }}">
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

                                        <td><input type="currency"  name="total" id="total" value="0" class="total" readonly="readonly" style="text-align: right" >                                             <span id="error"></span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            
                           <div class="col-12">
                           <button type="submit" class="btn btn-success" id="save"> <i class="fa fa-check"></i> {{__('Save')}}</button>
                          <a href="{{route('Mains.index')}}"><button type="button" class="btn btn-danger">{{__('Cancel')}}</button></a>
        
                              @if(!empty($main))
                               <a href="{{ route('printDaily',$main->id)}}" class="btn btn-success float-right"><i class="fas fa-print"></i> {{__('print')}} </a>
                               <a href="{{ route('pdfDaily',$main->id)}}" class="btn btn-danger btn-md active float-right" style="margin-left: 10px;" class="pdf" role="button" aria-pressed="true"><i class="fas fa-download"></i>{{__('Download')}} PDF</a>

                               @endif
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script>
        window.addEventListener('load', (event) => {

            var arr = document.querySelectorAll('.amount_filed');
            var total =0;
            for (var i=0; i<arr.length;i++){
                if (parseInt(localStringToNumber(arr[i].value))){
                    total+=parseInt(localStringToNumber(arr[i].value));
                }
            }

            document.getElementById("total").value = total;
            onBlur({ target: document.getElementById("total")});
            ajaxE();
        });


    </script>


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

            var arr = document.querySelectorAll('.amount_filed')

            var total=0;

            for (var i=0; i<arr.length;i++){
                if (parseFloat(localStringToNumber(arr[i].value))){
                    total+=parseFloat(localStringToNumber(arr[i].value));
                }
            }
            document.getElementById('total').value = total;
            onBlur({ target: document.getElementById("total")});
        }

    </script>

    <script>
        $(document).on('click', '.delegated-btn', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();

        });

    </script>
    <script>
        // function cur(v) {
        //     var vv = document.getElementById('amount_'+v).value;
        //     // var formatter = new Intl.NumberFormat('de-DE', {
        //     //     style: 'currency',
        //     //     currency: 'EUR'
        //     // });
        //     var c = new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3 }).format(vv)
        //     document.getElementById('amount_'+v).value = c;
        // }
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
    <script src="{{asset('js/easy-number-separator.js')}}"></script>

    <script src="{{asset('js/currency.js')}}"></script>
    <script>
        function validateForm(){

            var currencis = [...document.querySelectorAll('input[type="currency"]')];
            currencis.forEach(function (item) {
                item.value = localStringToNumber(item.value);
            });
        }
    </script>
 @endsection



