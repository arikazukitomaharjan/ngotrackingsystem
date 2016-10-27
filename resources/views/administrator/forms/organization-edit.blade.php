@extends('administrator')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">
<h1 class="list_title">Organization</h1>
<!-- <p>Some small text goes here</p> -->

<div class="form_kit">
<h1 class="list_title">Update Organization</h1>
<?php 
$alert= Session::get('alert'); 
if($alert){
?>
<div class="alert <?php echo $alert['class']; ?>"><?php echo $alert['msg']; Session::put('alert',''); ?></div>
<?php } ?>
  {!! Form::open(['url'=>$formAction , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal']) !!}
  <div class="field_set">
    General Information
  </div>
  <div class="field_set">
    <label>Name</label>
          {!! Form::text( 'name' , $record->name , ['class' => 'form-control' , 'required' => 'required' ]) !!}
  </div>

  <div class="field_set">
  <label>Contact Email</label>
       {!! Form::text( 'contact_email' , $record->contact_email , ['class' => 'form-control' , 'required' => 'required' ]) !!}
  </div>
  <div class="field_set">
  <label>password</label>
       {!! Form::password( 'password' , '' , ['class' => 'form-control']) !!}
      <span class="entry-info">Please leave this field blank if your are not changing password.</span>
  </div>
  <div class="field_set">
    Detail Information
  </div>

  <div class="field_set">
    <label>Introduction</label>
         {!! Form::textarea( 'introduction' , $record->introduction , ['class' => 'form-control' ]) !!}
  </div>

  <div class="field_set">
    <label>Address</label>
       {!! Form::text( 'address' , $record->address , ['class' => 'form-control' ]) !!}
  </div>
  <div class="field_set">
  <label>Contact Person</label>
       {!! Form::text( 'contact_person' , $record->contact_person , ['class' => 'form-control'  ]) !!}
  </div>

<div class="field_set">
  <label>Contact No.</label>
       {!! Form::text( 'contact_no' , $record->contact_no , ['class' => 'form-control'  ]) !!}
  </div>

<div class="field_set">
  <label>Objectives</label>
       {!! Form::text( 'objectives' , $record->objectives , ['class' => 'form-control' ]) !!}
  </div>

  <div class="field_set">
  <label>Reg. District</label>
      {!! Form::text( 'reg_district' , $record->reg_district , ['class' => 'form-control']) !!}
  </div>

  <div class="field_set">
  <label>Reg No.</label>
       {!! Form::text( 'reg_no' , $record->reg_no , ['class' => 'form-control']) !!}
  </div>

  <div class="field_set">
  <label>Reg. Date</label>
      {!! Form::text( 'reg_date' , $record->reg_date , ['class' => 'form-control popcorn'  ]) !!}
  </div>

  <div class="field_set">
  <label>PAN No.</label>
      {!! Form::text( 'pan_no' , $record->pan_no , ['class' => 'form-control' ]) !!}
  </div>

  
  
  <div class="field_set">
  <label>PAN Reg. Date</label>
      {!! Form::text( 'pan_reg_date' , $record->pan_reg_date , ['class' => 'form-control popcorn'  ]) !!}
  </div>

  

  <div class="field_set">
  <label>Affiliation No.</label>
       {!! Form::text( 'affiliation_no' , $record->affiliation_no , ['class' => 'form-control'  ]) !!}
  </div>

  <div class="field_set">
  <label>Last Renewel</label>
     {!! Form::text( 'last_renewal' , $record->last_renewal , ['class' => 'form-control popcorn' ]) !!}
  </div>

  <div class="field_set">
  <label>Last Audit</label>
     {!! Form::text( 'last_audit' , $record->last_audit , ['class' => 'form-control'  ]) !!}
  </div>

<div class="field_set">
  <label>Assets</label>
     {!! Form::text( 'assets' , $record->assets , ['class' => 'form-control' ]) !!}
  </div>

<div class="field_set">
  <label>Status</label>
     {!! Form::select( 'status' , array( 'Approved' => 'Approved' , 'Draft' => 'Draft' , 'Pending' => 'Pending' ) , $record->status , ['class' => 'form-control m-b-sm']) !!}
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
                 dateFormat: "yy-mm-dd",
                    'changeYear':true,
                    'changeMonth':true,
                    yearRange: "-100:+0",
            });
        });
    });
</script>
@stop


         
        
