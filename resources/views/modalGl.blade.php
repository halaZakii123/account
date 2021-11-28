@extends('layouts.amz')

@section('content')


<div class="container">
 
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3>{{__('please select one :')}} </h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <div class="container">
                    <form method="POST"  name ="aa" on onsubmit="return v" action="{!! route('TransSearchAccount') !!}">
                        @csrf

                        <p>{{__('please select one :')}}</p>

                        <div class="form-group">

                               <div>
                                <input type="radio" id="account_number" name="trans" value="account_number" checked>
                                  <label for="html">{{__('Account Number')}} :</label>
                                <select name="account_number_value">
                                    @foreach($allTrans as $tran)
                                        @foreach($account as $acc)
                                            @if($acc->account_number == $tran->accountid)
                                                <option value="{{$tran->accountid}}"> {{$tran->accountid}} {{$acc->account_name}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                                <input type="date" id="doc_date_value" name="A_date_from" value="{{$first}}"  >
                                <input type="date" id="doc_date_value" name="A_date_to" value="{{$last}}"><br>
                            </div>


                            <div>

                                <div class="form-group" type="submit">
                                    <button type="submit"> {{__('Search')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
    

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal').modal('show');

        });
    </script>
@endsection