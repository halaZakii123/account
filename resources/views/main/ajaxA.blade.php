    @foreach($account_number as $acc)
            <option value="{{$acc->account_number}}">{{$acc->account_number}}</option>
@endforeach
    @foreach($account_numbers as $account)
            <option value="{{$account->account_number}}">{{$account->account_number}}</option>
     @endforeach

