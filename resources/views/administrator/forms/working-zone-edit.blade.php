
@extends('administrator')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">
<h1 class="list_title">Working Zones</h1>
<!--<p>Please fill up the form below</p> -->
<div class="form_kit">
<h1 class="list_title">Working Zones</h1>
<p>Please fill up the form below</p>
 
  {!! Form::open(['url'=>$formAction , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal']) !!}

  <div class="field_set">
    <label>Name</label>
           {!! Form::text( 'name' , $record->name , ['class' => 'form-control' , 'required' => 'required' ]) !!} 
  </div>

  <div class="field_set">
  <label>Status</label>
      {!! Form::select( 'status' , array('Published' => 'Published' ,'Draft' => 'Draft') , $record->status , ['class' => 'form-control m-b-sm']) !!}
  </div>
<div class="field_set">
  <label></label>
    <button class="app_btn btn_green">Update</button>
</div>


</div>



</div>
<script>
        $(document).ready(function(){

            $(function() {
                $('.popcorn').datepicker({
                    dateFormat: "yy-mm-dd"
                });
            });

        });
        </script>
@stop


         
        
