@extends('administrator')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">
<h1 class="list_title">Projects</h1>
<!-- <p>Some small text goes here</p> -->

<div class="form_kit">
<h1 class="list_title">Update Project</h1>
<p>Please update the information</p>
 {!! Form::open(['url'=>url('projects/update/'.$project->id) , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal validate-form']) !!}
   <div class="field_set">
   <label>Project Name</label>
         {!! Form::text( 'title' , $project->title , ['class' => 'form-control req' , 'required' => 'required' ]) !!}
 </div>
  
  <div class="field_set">
    <label>Organization</label>
         <select name="organization" required class="form-control m-b-sm req">
              <option value="organization">Select</option>
              @foreach($orgList as $row)
                  <?php $selected=$project->organization == $row->id?'selected':'';?>
                  <option {{$selected}} value="{{$row->id}}">{{$row->name}}</option>
              @endforeach
          </select>   
  </div>

  <div class="field_set">
    <label>Sector</label>
      <select name="sector" required class="form-control m-b-sm req">
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
  <div class="field_set">
  <label>Working Zone</label>
       
            
            <?php 
            $wzone  = array();
            $wzone  = $project->working_zone;
            $wzones = explode( ',' , $wzone );
            ?>
        
            @foreach($zoneList as $row)
                <?php
                $checked = in_array( $row->id , $wzones )?'checked':'';
                ?>
                
               <p><input type="checkbox" {{ $checked }} value="{{ $row->id }}" name="working_zone[]" style="width:30%"> <span style="text-align:left;">{{ $row->name }}</span></p>
            
            @endforeach    
  </div>

<div class="field_set">
  <label>Line Office</label>
  <?php 
  $lineOffices = array();
  $lineOffice  = $project->line_office;
  $lineOffices = explode( ',', $lineOffice );
  ?>
       @foreach($lineList as $row)
            <label>&nbsp;</label>
                <?php
                $checked = in_array( $row->id , $lineOffices )?'checked':'';
                ?>
              <p> <input type="checkbox" value="{{ $row->id }}" name="line_office[]" {{ $checked }} style="width:30%"> <span style="text-align:left;">{{ $row->name }}</span></p>
            @endforeach
  </div>

  <div class="field_set">
  <label>Fiscal Year (AD)</label>
      {!! Form::text( 'fiscal_year_ad' , $project->fiscal_year_ad , ['class' => 'form-control' ]) !!}
  </div>

  <div class="field_set">
  <label>Fiscal Year(BS)</label>
      {!! Form::text( 'fiscal_year_bs' , $project->fiscal_year_bs , ['class' => 'form-control' ]) !!}
  </div>

  <div class="field_set">
  <label>Start Date</label>
      {!! Form::text( 'start_date' , $project->start_date , ['class' => 'form-control popcorn' ]) !!}
  </div>

  <div class="field_set">
  <label>End Date</label>
      {!! Form::text( 'end_date' , $project->end_date , ['class' => 'form-control popcorn' ]) !!}
  </div>

  <div class="field_set">
  <label>Budget (Currency )</label>
  <?php ?>
    <select name="currency">
    <option {{ $project->currency == 'NPR' ?'selected':'' }}>NPR</option>
    <option {{ $project->currency == 'USD' ?'selected':'' }}>USD</option>
    <option {{ $project->currency == 'EUR' ?'selected':'' }}>EUR</option>
    <option {{ $project->currency == 'CAD' ?'selected':'' }}>CAD</option>
    <option {{ $project->currency == 'GBP' ?'selected':'' }}>GBP</option>
    </select>
    </div>
    <div class="field_set">
      <label>Budget (Amount )</label>
      {!! Form::text( 'budget' , $project->budget , ['class' => 'form-control' ]) !!}
  </div>

  <div class="field_set">
      <label>Budget ( RS )</label>
      {!! Form::text( 'budget_rs' , $project->budget_rs , ['class' => 'form-control' ]) !!}
  </div>

  <div class="field_set">
  <label>Targeted Group</label>
      {!! Form::text( 'targeted_group' , $project->targeted_group , ['class' => 'form-control' ]) !!}
  </div>

  <div class="field_set">
  <label>Activities</label>
     <div class="obj-wrap"> 
        
          <?php  
          if( isset($activitiesList) && !empty($activitiesList) && count($activitiesList) > 0 ){
               $i      = 0;
               $remove = 'style=display:none;';
               foreach( $activitiesList as $row):
               if($i > 0){
                $remove = '';
               }
           

           ?>  
             <div class="obj-row">
                {!! Form::text( 'act[description][]' , $row->description , ['class' => 'full-width', 'placeholder' => 'Descritpion']) !!}                
                {!! Form::text( 'act[unit][]' , $row->unit , ['class' => 'form-control', 'placeholder' => 'Unit']) !!}
                {!! Form::text( 'act[quantity][]' , $row->quantity , ['class' => 'form-control', 'placeholder' => 'Quantity']) !!}
                {!! Form::text( 'act[duration][]' , $row->duration , ['class' => 'form-control', 'placeholder' => 'Duration']) !!}
                {!! Form::select( 'act[period][]' , array('Day' => 'Day' , 'Month' => 'Month' , 'Year' => 'Year') , $row->period , ['class' => 'form-control small']) !!}
                {!! Form::text( 'act[unit_cost][]' , $row->unit_cost , ['class' => 'form-control', 'placeholder' => 'Unit Cost']) !!}
                {!! Form::text( 'act[total_budget][]' , $row->total_budget , ['class' => 'form-control', 'placeholder' => 'Total Budget']) !!}
                {!! Form::text( 'act[phase][]' , $row->phase , ['class' => 'form-control', 'placeholder' => 'Phase']) !!}
                
                 <a href="javascript:void(0);" {{$remove}} class="remove-objective app_btn btn_red remove_btn"><i class="icon-remove"></i></a>  
               </div> 
               <?php
               $i++; 
               endforeach ; 
             }else{

               ?>     
              
                <div class="obj-row">
                {!! Form::text( 'act[description][]' , '' , ['class' => 'full-width', 'placeholder' => 'Descritpion']) !!}                
                {!! Form::text( 'act[unit][]' , '' , ['class' => 'form-control', 'placeholder' => 'Unit']) !!}
                {!! Form::text( 'act[quantity][]' , '' , ['class' => 'form-control', 'placeholder' => 'Quantity']) !!}
                {!! Form::text( 'act[duration][]' , '' , ['class' => 'form-control', 'placeholder' => 'Duration']) !!}
                {!! Form::select( 'act[period][]' , array('Day' => 'Day' , 'Month' => 'Month' , 'Year' => 'Year') , '' , ['class' => 'form-control small']) !!}
                {!! Form::text( 'act[unit_cost][]' , '' , ['class' => 'form-control', 'placeholder' => 'Unit Cost']) !!}
                {!! Form::text( 'act[total_budget][]' , '' , ['class' => 'form-control', 'placeholder' => 'Total Budget']) !!}
                {!! Form::text( 'act[phase][]' , '' , ['class' => 'form-control', 'placeholder' => 'Phase']) !!}
                
                 <a href="javascript:void(0);"  style="display:none;" class="remove-objective app_btn btn_red remove_btn"><i class="icon-remove"></i></a>  
               </div>

           <?php  } ?>

               
            <a href="" class="add-objective app_btn btn_green">Add More</a>  
     </div>
  </div>
  
  <div class="field_set">
  <label>Objectives</label>
      {!! Form::textarea( 'objectives' , $project->objectives , ['class' => 'form-control']) !!}
  </div>

  

  <div class="field_set">
  <label>Remark</label>
      {!! Form::textarea( 'remark' , $project->remark , ['class' => 'form-control']) !!}
  </div>

  <div class="field_set">
  <label>Status</label>
      {!! Form::select( 'status' , array('Proposed'=>'Proposed', 'Approved'=>'Approved','Running' => 'Running' ,'Completed' => 'Completed' , 'Unknown' => 'Unknown') , $project->status , ['class' => 'form-control m-b-sm']) !!}
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
                    'minDate': '2014-01-01'
                });
            });

            $('.add-objective').click(function(e){
              e.preventDefault();
              var closeObj = $('.obj-row:eq(0)').clone();
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


         
        
