@extends('admin.app')
@section('content')
<div id="main-wrapper">
<div class="row">
<div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">{{ $title }}</h4>
            </div>
            <?php $role = Request::segment(3); $userId = Request::segment(4); ?>
            <div class="panel-body">
                {!! Form::open(['url'=>'admin/form/'.$role.'/'.$userId , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                       {!! Form::label( 'first_name' , 'First Name' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text( 'first_name' , $formData->firstName , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                        </div>
                    </div>
                   <div class="form-group">
                       {!! Form::label( 'last_name' , 'Last Name' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text( 'last_name' , $formData->lastName , ['class' => 'form-control' , 'required' => 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label( 'email' , 'Email' , ['class' => 'col-sm-2 control-label'] ) !!}
                        <div class="col-sm-10">
                           {!! Form::email( 'email' , $formData->email , ['class' => 'form-control' , 'required' => 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                       {!! Form::label( 'password' , 'Password' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                             {!! Form::text( 'password' , '' , ['class' => 'form-control']) !!}
                             @if( $formData->id )
                             <p> Leave this field blank If you are not changing the password!</p>
                             @endif
                        </div>
                    </div>
                    
                    <div class="form-group" <?php if($role =='admin'){echo 'style="display:none;"';}?>>
                         {!! Form::label( 'status' , 'Select Status' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                           {!! Form::select( 'status' , array( 'published' => 'Published' , 'pending' => 'Pending' , 'blocked' => 'Blocked'  , 'deactivated' => 'Deactivated' ) , $formData->status , ['class' => 'form-control m-b-sm']) !!}
                        </div>
                    </div>

                     <div class="form-group">
                         {!! Form::label( 'role' , 'Select Role' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                           {!! Form::select( 'role' , array( $role =>  ucfirst($role) ) , '' , ['class' => 'form-control m-b-sm']) !!}
                        </div>
                    </div>
                   @if($role == 'member')

                    <div class="form-group">
                         {!! Form::label( 'expiry' , 'Expiry Date' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                           {!! Form::text( 'expiry' ,  $formData->expiry_date , ['class' => 'form-control' , 'id' => 'popcorn']) !!}
                        </div>
                    </div>

                   @endif
                     <div class="form-group">
                      <label class="col-sm-2 control-label"></label>
                       <div class="col-sm-10">
                        <input type="submit" class="btn" value="Submit">
                         </div>
                    </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</div>
@stop


         {!! Html::script( 'resources/assets/plugins/jquery/jquery-2.1.4.min.js' ) !!}
         {!! Html::script( 'resources/assets/plugins/jquery-ui/jquery-ui.min.js') !!} 
         {!! Html::script( 'resources/assets/plugins/bootstrap/js/bootstrap.min.js') !!}

 <script>
        $(document).ready(function(){

            $(function() {
                $('#popcorn').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: '+1d'
                });
            }); 

        });
        </script>


         {!! Html::script( 'resources/assets/plugins/pace-master/pace.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/jquery-blockui/jquery.blockui.js', [ 'defer' => 'defer' ] ) !!}
        
         {!! Html::script( 'resources/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/switchery/switchery.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/uniform/jquery.uniform.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/offcanvasmenueffects/js/classie.js', [ 'defer' => 'defer' ] ) !!}
          {!! Html::script( 'resources/assets/plugins/offcanvasmenueffects/js/main.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/waves/waves.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/3d-bold-navigation/js/main.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/summernote-master/summernote.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js', [ 'defer' => 'defer' ] ) !!} 
        <!-- {!! Html::script( 'resources/assets/js/modern.min.js', [ 'defer' => 'defer' ] ) !!} -->
         {!! Html::script( 'resources/assets/js/pages/form-elements.js', [ 'defer' => 'defer' ] ) !!}
       