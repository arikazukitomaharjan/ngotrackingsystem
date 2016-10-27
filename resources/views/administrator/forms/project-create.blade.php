@extends('administrator')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">
<h1 class="list_title">List Title</h1>
<p>Some small text goes here</p>

<div class="form_kit">
<h1 class="list_title">Add new</h1>
<!-- <p>Some small text goes here</p> -->
 {!! Form::open(['url'=>URL::route('storeProject') , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal validate-form']) !!}
   <div class="field_set">
   <label>Project Name</label>
         {!! Form::text( 'title' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
 </div> 

  <div class="field_set">
    <label>Organization</label>
         <select name="organization" class="form-control m-b-sm req" required >
              <option value="organization">Select</option>
              @foreach($orgList as $row)
                  <option value="{{$row->id}}">{{$row->name}}</option>
              @endforeach
          </select>   
  </div>

  <div class="field_set">
    <label>Sector</label>
      <select name="sector" class="form-control m-b-sm req" required>
          <option value="">Select</option>
          @foreach($sectorList as $row)
            <?php if($row->parent_id > 0): continue; endif; ?>
              <option disabled value="{{$row->id}}"><strong>{{$row->name}}</strong></option>
                  
                  @foreach($sectorList as $child)
                      @if($child->parent_id == $row->id)
                      <option value="{{ $child->id }}">&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->name }}</option>
                      @endif
                  @endforeach

          @endforeach
      </select>   
  </div>
  <div class="field_set">
  <label>Working Zone</label>
        @foreach($zoneList as $row)
            
               <p><input type="checkbox" value="{{ $row->id }}" name="working_zone[]" style="width:30%"> <span style="text-align:left;">{{ $row->name }}</span></p>
            
            @endforeach
     
  </div>

<div class="field_set">
  <label>Line Office</label>
       
            @foreach($lineList as $row)
            
               <p><input type="checkbox" value="{{ $row->id }}" name="line_office[]" style="width:30%"> <span style="text-align:left;">{{ $row->name }}</span></p>
            
            @endforeach
        
  </div>

<div class="field_set">
  <label>Fiscal Year (AD)</label>
      {!! Form::text( 'fiscal_year_ad' , '' , ['class' => 'form-control' ]) !!}
  </div>

  <div class="field_set">
  <label>Fiscal Year(BS)</label>
      {!! Form::text( 'fiscal_year_bs' , '' , ['class' => 'form-control' ]) !!}
  </div>

  <div class="field_set">
  <label>Start Date</label>
      {!! Form::text( 'start_date' , '' , ['class' => 'form-control popcorn' ]) !!}
  </div>

  <div class="field_set">
  <label>End Date</label>
      {!! Form::text( 'end_date' , '' , ['class' => 'form-control popcorn' ]) !!}
  </div>

  <div class="field_set">
  <label>Budget (Currency )</label>
    <select name="currency">
    <option>NPR</option>
    <option>USD</option>
    <option>EUR</option>
    <option>CAD</option>
    <option>GBP</option>
    </select>
    </div>
    <div class="field_set">
      <label>Budget (Amount )</label>
      {!! Form::text( 'budget' , '' , ['class' => 'form-control' ]) !!}
  </div>

   <div class="field_set">
      <label>Budget ( RS )</label>
      {!! Form::text( 'budget_rs' , '' , ['class' => 'form-control' ]) !!}
  </div>

  <div class="field_set">
  <label>Targeted Group</label>
      {!! Form::text( 'targeted_group' , '' , ['class' => 'form-control' ]) !!}
  </div>

  <div class="field_set">
  <label>Activities</label>
     <div class="obj-wrap">
     
           
             <div class="obj-row">
                {!! Form::text( 'act[description][]' , '' , ['class' => 'full-width', 'placeholder' => 'Descritpion']) !!}                
                {!! Form::text( 'act[unit][]' , '' , ['class' => 'form-control', 'placeholder' => 'Unit']) !!}
                {!! Form::text( 'act[quantity][]' , '' , ['class' => 'form-control', 'placeholder' => 'Quantity']) !!}
                {!! Form::text( 'act[duration][]' , '' , ['class' => 'form-control', 'placeholder' => 'Duration']) !!}
                {!! Form::select( 'act[period][]' , array('Day' => 'Day' , 'Month' => 'Month' , 'Year' => 'Year') , '' , ['class' => 'form-control small']) !!}
                {!! Form::text( 'act[unit_cost][]' , '' , ['class' => 'form-control', 'placeholder' => 'Unit Cost']) !!}
                {!! Form::text( 'act[total_budget][]' , '' , ['class' => 'form-control', 'placeholder' => 'Total Budget']) !!}
                {!! Form::text( 'act[phase][]' , '' , ['class' => 'form-control', 'placeholder' => 'Phase']) !!}
                
                 <a href="javascript:vbudgeoid(0);" style="display:none;" class="remove-objective app_btn btn_red remove_btn"><i class="icon-remove"></i></a>  
               </div>

               

               
            <a href="" class="add-objective app_btn btn_green">Add More</a>  
     </div>
  </div>
  
  <div class="field_set">
  <label>Objectives</label>
      {!! Form::textarea( 'objectives' , '' , ['class' => 'form-control']) !!}
  </div>

  

  <div class="field_set">
  <label>Remark</label>
      {!! Form::textarea( 'remark' , '' , ['class' => 'form-control']) !!}
  </div>

  <div class="field_set">
  <label>Status</label>
      {!! Form::select( 'status' , array('Proposed'=>'Proposed', 'Approved'=>'Approved','Running' => 'Running' ,'Completed' => 'Completed' , 'Not Known' => 'Uknown') , '' , ['class' => 'form-control m-b-sm']) !!}
  </div>
<div class="field_set">
  <label></label>
    <button class="app_btn btn_green">Add</button>
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
              closeObj.find('.remove-objective').css('display','block');
              $( closeObj ).insertBefore( $( '.add-objective' ) );
            });

            $(document).on('click','.remove-objective',function(){

              $(this).closest('.obj-row').remove();
            });
        });
        </script>
@stop


         
        
