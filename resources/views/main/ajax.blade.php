<tr>
    <td><button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>
    <td>
        <input type="number" name="debit[]" id="debit-{{$x}}" class="debit_filed" value= "{{ old('debit') }} "required onchange="gettotald(),changeDebitt({{$x}}),gettotalc(),Total(),check()" >
        @error('debit')<span class="help-block text-danger">{{ $message }}</span>@enderror
    </td>
    <td>
        <input type="number" name="credit[]" id="credit-{{$x}}" class="credit_filed" value= "{{ old('credit') }} "required onchange="gettotalc(),changeCreditt({{$x}}),gettotald(),Total(),check()">
        @error('credit')<span class="help-block text-danger">{{ $message }}</span>@enderror

    </td>
    <td>
        <select name="account_number[]" id="account_number" class=" form-control">
            <option></option>
            @foreach($account_numbers as $account)
                <option value="{{$account}}"{{old('account_number')}} >{{$account}} </option>
            @endforeach
        </select>
        @error('option')<span class="help-block text-danger">{{ $message }}</span>@enderror
    </td>
    <td>
        <input id="explained" type="text" class="explained form-control "name="explained[]" value= " {{ old('explained') }}" required >
        @error('explained')<span class="help-block text-danger">{{ $message }}</span>@enderror
    </td>
    <td>
        <input id="explained_ar" type="text" class="form-control "name="explained_ar[]" value= "{{ old('explained_ar')}}" required >
        @error('explained_ar')<span class="help-block text-danger">{{ $message }}</span>@enderror
    </td>
</tr>


