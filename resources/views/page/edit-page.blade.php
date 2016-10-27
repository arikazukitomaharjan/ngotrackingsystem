@extends('admin.app')
@section('content')
<div id="main-wrapper">
<div class="row">
<div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Create Page</h4>
            </div>
           
            <div class="panel-body">
                {!! Form::open(['url'=>'admin/pages/update/'.$page->id, 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                       {!! Form::label( 'title' , 'Title' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text( 'title' , $page->title , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                        </div>
                    </div>
                   <div class="form-group">
                       {!! Form::label( 'content' , 'Content' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea( 'content' , $page->content , ['class' => 'form-control' , 'required' => 'required']) !!}
                        </div>
                    </div>

                    
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


         {!! Html::script( 'resources/assets/plugins/jquery/jquery-2.1.4.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/jquery-ui/jquery-ui.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/pace-master/pace.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/jquery-blockui/jquery.blockui.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/bootstrap/js/bootstrap.min.js', [ 'defer' => 'defer' ] ) !!}
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
         {!! Html::script( 'resources/assets/js/modern.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/js/pages/form-elements.js', [ 'defer' => 'defer' ] ) !!}
