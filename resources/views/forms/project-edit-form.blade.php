
@extends('app')
@section('content')
<div id="main-wrapper">
<div class="row">
<div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">New Project</h4>
            </div>

            <div class="panel-body">
                {!! Form::open(['url'=>url('projects/update/'.$project->id) , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                       {!! Form::label( 'title' ,' Name' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text( 'title' , $project->title , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                         {!! Form::label( 'organization' , 'Organization' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <select name="organization" class="form-control m-b-sm">
                                <option value="organization">Select</option>
                                @foreach($orgList as $row)
                                    <?php $selected=$project->organization == $row->id?'selected':'';?>
                                    <option {{$selected}} value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                         </div>
                    </div>
                     <div class="form-group">
                         {!! Form::label( 'Sector' , 'Sector' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <select name="sector" class="form-control m-b-sm">
                                <option value="">Select</option>
                                @foreach($sectorList as $row)
                                  <?php if($row->parent_id > 0): continue; endif;?>
                                    <option disabled value="{{$row->id}}"><strong>{{$row->name}}</strong></option>

                                        @foreach($sectorList as $child)
                                            @if($child->parent_id == $row->id)
                                            <?php $selected = $child->id == $project->area?'selected':'';?>
                                            <option {{$selected}} value="{{$child->id}}">&nbsp;&nbsp;&nbsp;&nbsp;{{$child->name}}</option>
                                            @endif
                                        @endforeach

                                @endforeach
                            </select>
                         </div>
                    </div>

                    <div class="form-group">
                         {!! Form::label( 'working_zone' , 'Working Zone' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <select name="working_zone" class="form-control m-b-sm">
                                <option value="">Select</option>
                                @foreach($zoneList as $row)
                                    <?php $selected=$project->working_zone == $row->id?'selected':'';?>
                                    <option {{$selected}} value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                         </div>
                    </div>
                    <div class="form-group">
                         {!! Form::label( 'line_office' , 'Concern/Line Office' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <select name="line_office" class="form-control m-b-sm">
                                <option value="">Select</option>
                                @foreach($lineList as $row)
                                    <?php $selected=$project->line_office == $row->id?'selected':'';?>
                                    <option {{$selected}} value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                         </div>
                    </div>


                   <div class="form-group">
                       {!! Form::label( 'start_date' ,'Start Date' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text( 'start_date' , $project->start_date , ['class' => 'form-control popcorn' , 'required' => 'required' ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                       {!! Form::label( 'end_date' ,'End Date' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text( 'end_date' , $project->end_date , ['class' => 'form-control popcorn' , 'required' => 'required' ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                       {!! Form::label( 'budget' ,'Budget' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text( 'budget' , $project->budget , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                        </div>
                    </div>
                     <div class="form-group">
                       {!! Form::label( 'remark' ,'Targeted Group' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text( 'targeted_group' , $project->targeted_group , ['class' => 'form-control']) !!}
                        </div>
                    </div>
                     <div class="form-group">
                       {!! Form::label( 'remark' ,'Objectives' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea( 'objectives' , strip_tags($project->objectives) , ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                       {!! Form::label( 'remark' ,'Activities' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea( 'activities' , strip_tags($project->activities) , ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                       {!! Form::label( 'remark' ,'Remark' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea( 'remark' , strip_tags($project->remark) , ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                         {!! Form::label( 'status' , 'Status' , ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                           {!! Form::select( 'status' , array(  'Running' => 'Running' ,'Completed' => 'Completed') , $project->status , ['class' => 'form-control m-b-sm']) !!}
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


         {!! Html::script( 'resources/assets/plugins/jquery/jquery-2.1.4.min.js' ) !!}
         {!! Html::script( 'resources/assets/plugins/bootstrap/js/bootstrap.min.js' ) !!}

        <script>
        $(document).ready(function(){

            $(function() {
                $('.popcorn').datepicker({
                    format: 'yyyy-mm-dd'
                });
            });

        });
        </script>

         {!! Html::script( 'resources/assets/plugins/jquery-ui/jquery-ui.min.js', [ 'defer' => 'defer' ] ) !!}
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
         {!! Html::script( 'resources/assets/js/modern.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/js/pages/form-elements.js', [ 'defer' => 'defer' ] ) !!}
