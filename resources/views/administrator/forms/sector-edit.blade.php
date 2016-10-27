
@extends('administrator')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">
<h1 class="list_title">Sectors</h1>
<!--<p>Please fill up the form below</p> -->
<div class="form_kit">
<h1 class="list_title">Add new Sector</h1>
<p>Please fill up the form below</p>
 {!! Form::open(['url'=>$formAction , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal']) !!}

  <div class="field_set">
    <label>Main Sector </label>
           {!! Form::select( 'parent_id' , $options , $record->parent_id , ['class' => 'form-control m-b-sm']) !!} 
           <br/><label style="font-weight:normal;">Please leave this field if you are updating main sector</<label>  
  </div>

  <div class="field_set">
    <label>Sector Name</label>
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

            $('.add-objective').click(function(e){
              e.preventDefault();
              var closeObj = $('.obj-row').clone();
              closeObj.find('input').val('');
              closeObj.find('.remove-objective').show();
              $( closeObj ).insertBefore( $( '.add-objective' ) );
            });

            $(document).on('click','.remove-objective',function(){

              $(this).closest('.obj-row').remove();
            });
        });
        </script>
@stop


         
        
