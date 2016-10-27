
@extends('org')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">


<div class="view_page_module">
<h1 class="list_title"> <a href="{{ url('/working-zones/edit/'.$workingzone->id) }}"> {{ $workingzone->name }} </a> <span style="float:right;" class="app_btn btn_green btn_curve">{{ $workingzone->status }}</span></h1>
<!--<p>Some small text goes here</p>-->

<div class="table_list_view">
<table border="0" cellpadding="0" cellspacing="0">

<thead class="dark_grey_box">
  <tr>
   <td>S. N. </td>
    <td>Name</td>
    <td>Sector</td>
    <td>Sub Sector</td>
    <td>Working Zone</td>
    <td>Budget</td>
    <td>Status</td>
    <td class="actions">Action</td>
  </tr>
</thead>

<tbody>
<?php
  $i = 1;
?>
  @foreach($projectList as $row)
  <?php 
    $projectLink     = url('/organization/project/view/'.$row->id);
   $statusLink      = url('/organization/project/'.$row->status);
   $sectorLink      = url('/organization/sector/'.$row->sector_id);
   $areaLink        = url('/organization/area/'.$row->area_id);
   $editLink        = url('/organization/project/edit/'.$row->id);
   $deleteLink      = url('/organization/project/delete/'.$row->id);
  ?>
 <tr>
     <td>{{ $i }}</td>
     <td> <a href="{{$projectLink}}"> {{ $row->title }} </a> </td>
   
    <td> <a href="{{$sectorLink}}">  {{ $row->sector }}</td>
    <td><a href="{{ $areaLink }}">{{ $row->area }}  </a></td>
    <td>   {!! $obj->workingZones($row->working_zone) !!}  </td>
    <td>  @if($row->budget) {{  $row->currency .' ' . $row->budget }}  @endif  </td>
    <td><a href="{{$statusLink}}"> {{ $row->status }} </a> </td>
    <td class="actions">
    <span class="icon_yellow"> <a href="{{$editLink}}"> <i class="icon-pencil"></i> </a> </span>
    <span class="icon_green"> <a href="{{$projectLink}}"> <i class="icon-eye"></i> </a></span>
    <span class="icon_red"> <a onclick = "return confirm('Are you sure? You can\'t undo this action.')" href="{{$deleteLink}}"> <i class="icon-trash-bin"></i> </a></span>
    </td>
  </tr>
<?php $i++; ?>
 @endforeach

 <tfoot>
  <?php 
        $view = Request::get('view');
        if( !$view ){
          $view = 10;
        }
    ?>
  <tr>
 
    <td colspan="5">{!!  str_replace('/?', '?', $projectList->appends(['view' => $view ])->render()) !!}</td>
    <td colspan="2">showing {{ $projectList->currentPage() }} of {{ $projectList->lastPage() }}</td>
    <td colspan="1" align="right">
    show <span>
        <select id="row-view-select">
        
            <option {{ $view==10?'selected':'' }} value="{{ url('organization/project?view=10') }}">10</option>
            <option {{ $view==25?'selected':'' }} value="{{ url('organization/project?view=25') }}">25</option>
            <option {{ $view==50?'selected':'' }} value="{{ url('organization/project?view=50') }}">50</option>
            <option {{ $view==100?'selected':'' }} value="{{ url('organization/project?view=100') }}">100</option>
        </select>
    </span>
    </td>

  </tr>
 </tfoot> 
</table>
</div>

</div>



</div>
@stop

