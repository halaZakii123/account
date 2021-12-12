@extends('layouts.amz')

@section('content')

<div class="container" >
 
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3>{{__('please select one :')}} </h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <div class="modal-body" style="margin:auto">
          <form method="get"  name ="aa" on onsubmit="return v" action="{!! route('TransSearch') !!}">
             
            <div class="form-group">
             <div>
                  <input type="radio" id="sourc_id" name="trans" value="source_id" checked>
                  <label for="html">{{__('Source id')}} :</label>
                  <select name="source_id_value">
                    @foreach($allTransSource as $tran)
                        <option value="{{$tran->sourceid}}"> {{$tran->sourceid}}</option>
                    @endforeach
                  </select>
              </div>

              <div>
                 <input type="radio" id="doc_date" name="trans" value="doc_date">
                 <label for="html">{{__('From date to date')}}</label>
                 <input type="date" id="doc_date_value" name="doc_date_from"  value="{{$first}}">
                 <input type="date" id="doc_date_value" name="doc_date_to" value="{{$last}}"><br>
               </div>
              
               <div class="center" style="display: flex; justify-content: center; margin-top:20px">

                    <div class="form-group" type="submit" >
                         <button type="submit" class="btn btn-info"> <i class="fas fa-search"></i> {{__('search')}} </button>
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