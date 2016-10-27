
@extends('default')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">


<div class="view_page_module">
<h1 class="list_title">Report</h1>
<!--<p>Some small text goes here</p>-->


<div class="report_view">

<div class="staticTable">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col">SN.</th>
    <th scope="col" class="fixwidth_col">Projects</th>
    <th scope="col" class="fixwidth_col">Activities</th>
    <th scope="col">Unit</th>
    <th scope="col" colspan="2" class="fixwidth_col" style="border-bottom:solid 1px rgba(0,0,0,.3) !important">Yearly Goal</th>
    <th scope="col"  class="fixwidth_col">Remarks</th>
  </tr>
  
  <tr>
    <th scope="row">&nbsp;</th>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col">Quantity</th>
    <th scope="col">Budget</th>
    <th scope="col"></th>
  </tr>
  
  <?php 
  $i = 1;
  foreach( $projectList as $row){ 
  $activities = $row->ProjActivities;
  ?>
  
  <tr>
    <td scope="row s-n">{{ $i }}</td>
    <td scope="col"> {{ $row->title }} </td>
    <td scope="col">
        @foreach($activities as $act)
        <span class="inTD"> {{ $act->description }} </span>
        @endforeach
    </td>
    <td scope="col">
        @foreach($activities as $act)
        <span class="inTD"> {{ $act->unit }} </span>
        @endforeach
      </td>
        
    <td scope="col">
        @foreach($activities as $act)
        <span class="inTD"> {{ $act->quantity }} </span>
        @endforeach
      </td>
    <td scope="col">
        @foreach($activities as $act)
        <span class="inTD"> {{ $act->total_budget }} </span>
        @endforeach
      </td>
    <td scope="col">
    @foreach($activities as $act)
        <span class="inTD"> &nbsp; </span>
        @endforeach
       </td>
  </tr>
  <?php $i++; } ?>
  
  
 
</table>
</div>

</div>
</div>



</div>
@stop

