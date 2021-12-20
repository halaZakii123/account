<tr>
    <td>
        <button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button>
    </td>
    <td>
        <input type="currency" name="amount[]" id="amount_{{$x}}" class="amount_filed" value="{{old('amount')}}"  onchange="gettotald()" style="text-align: right">
        @error('debit')<span class="help-block text-danger">{{ $message }}</span>@enderror
    </td>
    <td>
        <select name="account_number[]" id="account_number" class=" form-control" >
            <option></option>
            @foreach($accounts as $account)
                <option value="{{$account->account_number}}"{{old('account_number')}} >{{$account->account_number}} {{$account->account_name}}  </option>
            @endforeach
        </select>
        @error('option')<span class="help-block text-danger">{{ $message }}</span>@enderror
    </td>

    <td>
        <input id="explained" type="text" class="explained form-control "name="explained[]" value= " {{ old('explained') }}" autocomplete="on" >
        @error('explained')<span class="help-block text-danger">{{ $message }}</span>@enderror
    </td>
    <td>
        <input id="explained_ar" type="text" class="form-control "name="explained_ar[]" value= "{{ old('explained_ar')}}"  autocomplete="on">
        @error('explained_ar')<span class="help-block text-danger">{{ $message }}</span>@enderror
    </td>
</tr>
<script>
    function ajaxB() {
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
                $('#B').html(data);
            },
            error:function(){
                console.log('error ',$error);
            }
        });

    }
</script>
<script src="{{asset('js/currency.js')}}"></script>
