@foreach($account_number as $acc)
    <option value="{{$acc->account_number}}">{{$acc->account_number}}</option>
@endforeach

