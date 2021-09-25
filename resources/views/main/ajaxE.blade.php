@foreach($cus as $c)
   @if($c->contents == $x)
        <input id="exchange_rate" type="text" class="form-control " name="exchange_rate"  value= "{{$c->exchange_rate}} " required >

@endif
    @endforeach
