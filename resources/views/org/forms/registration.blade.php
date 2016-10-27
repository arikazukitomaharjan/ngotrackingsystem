<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Brum Info Tech</title>
    {!! Html::style( 'resources/assets/styles/jquery-ui.css' ) !!}
    {!! Html::style( 'resources/assets/styles/animation.css' ) !!}
    {!! Html::style( 'resources/assets/fonts/styles.css' ) !!}
    {!! Html::style( 'resources/assets/styles/custom.css' ) !!}
    {!! Html::style( 'resources/assets/styles/responsive.css' ) !!}
    <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
    {!! Html::script( 'resources/assets/js/jquery.js' ) !!}
    {!! Html::script( 'resources/assets/js/jquery-ui.js' ) !!}
  
  </head>
  
  
<!--body Start-->  
<body>



<section id="all_page_wrapper">
<!--Left Part-->
<div class="app_right_part">

<div class="content_wrap relative">
<div class="form_kit">
<h1 class="list_title">Register Organization</h1>
<p>Please fill up the form below</p>
<?php 
$alert= Session::get('alert'); 
if($alert){
?>
<div class="alert <?php echo $alert['class']; ?>"><?php echo $alert['msg']; Session::put('alert',''); ?></div>
<?php } ?>
  {!! Form::open(['url'=> URL::route('storeOrganizationRegistration') , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal']) !!}
  <div class="field_set">
    <label>District</label>
      <select name="district" required class="form-control m-b-sm req">
          <option value="">Select District</option>
          @foreach($districts as $row)
              <option value="{{$row->id}}"><strong>{{$row->name}}</strong></option>  
          @endforeach
      </select>   
  </div>

  <div class="field_set">
    General Information
  </div>
  <div class="field_set">
    <label>Name</label>
          {!! Form::text( 'name' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
  </div>

  <div class="field_set">
  <label>Contact Email</label>
       {!! Form::text( 'contact_email' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
  </div>
  <div class="field_set">
  <label>password</label>
       {!! Form::password( 'password' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
  </div>

<div class="field_set">
    Detail Information
  </div>
  <div class="field_set">
    <label>Introduction</label>
         {!! Form::textarea( 'introduction' , '' , ['class' => 'form-control' , 'required' => 'required']) !!}
  </div>

  <div class="field_set">
    <label>Address</label>
       {!! Form::text( 'address' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
  </div>
  <div class="field_set">
  <label>Contact Person</label>
       {!! Form::text( 'contact_person' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
  </div>
  <div class="field_set">
  <label>Contact No.</label>
       {!! Form::text( 'contact_no' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
  </div>
  

<div class="field_set">
  <label>Objectives</label>
       {!! Form::text( 'objectives' , '' , ['class' => 'form-control' ]) !!}
  </div>

  <div class="field_set">
  <label>Reg. District</label>
      {!! Form::text( 'reg_district' , '' , ['class' => 'form-control']) !!}
  </div>

  <div class="field_set">
  <label>Reg No.</label>
       {!! Form::text( 'reg_no' , '' , ['class' => 'form-control']) !!}
  </div>

  <div class="field_set">
  <label>Reg. Date</label>
      {!! Form::text( 'reg_date' , '' , ['class' => 'form-control popcorn'  ]) !!}
  </div>

  <div class="field_set">
  <label>PAN No.</label>
      {!! Form::text( 'pan_no' , '' , ['class' => 'form-control' ]) !!}
  </div>

  
  
  <div class="field_set">
  <label>PAN Reg. Date</label>
      {!! Form::text( 'pan_reg_date' , '' , ['class' => 'form-control popcorn'  ]) !!}
  </div>

  

  <div class="field_set">
  <label>Affiliation No.</label>
       {!! Form::text( 'affiliation_no' , '' , ['class' => 'form-control'  ]) !!}
  </div>

  <div class="field_set">
  <label>Last Renewel</label>
     {!! Form::text( 'last_renewal' , '' , ['class' => 'form-control popcorn' ]) !!}
  </div>

  <div class="field_set">
  <label>Last Audit</label>
     {!! Form::text( 'last_audit' , '' , ['class' => 'form-control'  ]) !!}
  </div>

<div class="field_set">
  <label>Assets</label>
     {!! Form::text( 'assets' , '' , ['class' => 'form-control' ]) !!}
  </div>


<div class="field_set">
  <label></label>
    <button class="app_btn btn_green">Register</button>
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
</div><!--App Right Part Ends-->


</section><!--section ends-->
</body>
</html>

         
        
