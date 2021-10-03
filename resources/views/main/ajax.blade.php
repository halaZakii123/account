<tr>
    <td><button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>
    <td>
        <input type="text" name="debit[]" id="debit-{{$x}}" class="debit_filed" value= "{{ old('debit') }} "required onchange="gettotald(),changeDebitt({{$x}}),gettotalc(),Total(),check(),cur()" >
        @error('debit')<span class="help-block text-danger">{{ $message }}</span>@enderror
    </td>
    <td>
        <input type="text" name="credit[]" id="credit-{{$x}}" class="credit_filed" value= "{{ old('credit') }} "required onchange="gettotalc(),changeCreditt({{$x}}),gettotald(),Total(),check(),cur()">
        @error('credit')<span class="help-block text-danger">{{ $message }}</span>@enderror

    </td>
    <td>
        <select name="account_name[]" id="account_name_" class=" form-control" onchange="ajaxB()">
            <option></option>
            @foreach($accounts as $account)
                <option value="{{$account->account_name}}"{{old('account_name')}} >{{$account->account_name}} </option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="account_number[]" id="B" class=" form-control">

        </select>
    </td>
    <td>
        <input id="explained" type="text" class="explained form-control "name="explained[]" value= " {{ old('explained') }}" required autocomplete="on" >
    </td>
    <td>
        <input id="explained_ar" type="text" class=" explained_ar form-control "name="explained_ar[]" value= "{{ old('explained_ar')}}" required autocomplete="on">
    </td>
</tr>
<script>
    function ajaxB() {
        var ddl = document.getElementById("account_name_");
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


