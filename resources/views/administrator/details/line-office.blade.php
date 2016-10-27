
@extends('administrator')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">


<div class="view_page_module">
<h1 class="list_title"> <a href="{{ url('/line-offices/edit/'.$lineoffice->id) }}"> {{ $lineoffice->name }} </a> <span style="float:right;" class="app_btn btn_green btn_curve">{{ $lineoffice->status }}</span></h1>
<!--<p>Some small text goes here</p>-->

<div class="table_list_view">
<table border="0" cellpadding="0" cellspacing="0">

<thead class="dark_grey_box">
  <tr>
    <td>Project Name</td>
    <td>Sector</td>
    <td>Working Zone</td>
    <td>Budget</td>
    <td>Status</td>
    <td class="actions">Action</td>
  </tr>
</thead>

<tbody>

  @foreach($projectList as $row)
  <?php 
   $projectLink     = url('/projects/view/'.$row->id);
   $statusLink      = url('/projects/'.$row->status);
   $sectorLink      = url('/sectors/'.$row->sector_id);
   $areaLink        = url('/areas/'.$row->area_id);
   $editLink        = url('/projects/edit/'.$row->id);
   $deleteLink      = url('/projects/delete/'.$row->id);
  ?>
  <tr>
    <td> <a href="{{$projectLink}}"> {{ $row->title }} </a> </td>
    <td> <a href="{{$sectorLink}}"> {{ $row->sector }}  </a> <br> <span><a href="{{ $areaLink }}">{{ $row->area }}  </a> </span></td>
    <td>  {!! $obj->workingZones($row->working_zone) !!}  </td>
    <td> NPR {{ $row->budget_rs }} </td>
    <td> <a href="{{$statusLink}}"> {{ $row->status }} </a> </td>
    <td class="actions">
    <span class="icon_yellow"> <a href="{{$editLink}}"> <i class="icon-pencil"></i> </a> </span>
    <span class="icon_green"> <a href="{{$projectLink}}"> <i class="icon-eye"></i> </a></span>
    <span class="icon_red"> <a onclick = "return confirm('Are you sure? You can\'t undo this action.')" href="{{$deleteLink}}"> <i class="icon-trash-bin"></i> </a></span>
    </td>
  </tr>

 @endforeach

 </tbody>
 <!--
 <tfoot>
  <tr>
    <td colspan="3">showing 8 of 100</td>
    <td colspan="3" align="right">
    shaow <span>
        <select>
            <option>1</option>
            <option>5</option>
            <option>15</option>
            <option>18</option>
        </select>
    </span>
    </td>

  </tr>
 </tfoot> -->
</table>
</div>

</div>



</div>
@stop

