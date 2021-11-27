<div class="form-group row" style=" @if(app()->getLocale() == 'ar')margin-right:280px;width: 870px @else margin-left:280px;width: 870px @endif ">

    <div class="col-md-6">
        <input id="option_{{$x}}" type="text" class="form-control " name="option[]" placeholder="{{__('option')}}{{$x+1}}" />

    </div>
    <button type="button" class="btn btn-danger btn-sm delegated-btn" ><i class="fa fa-minus"></i></button>

</div>
