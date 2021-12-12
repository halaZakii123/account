@extends('layouts.amz')

@section('content')


<div class="container">
 
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header ">
          <h5>{{__('please select date:')}} </h5><button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
         <div class="modal-body" style="margin:auto">
                    <form method="get"  name ="aa" on onsubmit="return v" action="{!! route('BLsheet') !!}">
                        
                        <div class="form-group">

                            <div>
                                <lable> {{__('To')}}</lable>
                                <input type="date" id="doc_date_value" name="date_from" value="{{$first}}"  >
                                <lable> {{__('From')}}</lable>
                                <input type="date" id="doc_date_value" name="date_to" value="{{$last}}"><br>
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