@extends('default')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">
<div class="dis_table">

    <div class="dis_table_cell ">
        <div class="dahs_box box_blue">
            <div class="title">Total Projects</div>
            <div class="count">{{$counts['all']}}</div>
        </div>
    </div>
    <div class="dis_table_cell ">
        <div class="dahs_box box_purple middle_box">
            <div class="title">Running Project</div>
            <div class="count">{{$counts['running']}}</div>
        </div>
    </div>
    <div class="dis_table_cell ">
        <div class="dahs_box box_yellow">
            <div class="title">Project Completed</div>
            <div class="count">{{$counts['completed']}}</div>
        </div>
    </div>
    
</div>

<div class="table_list_view">

<h1 class="list_title">All Projects
<a href="{{ URL::route('exportProject') }}">Export</a>
<a href="{{ URL::route('createProject') }}" class="app_btn dark_grey_box">Add New</a>
</h1>

<table border="0" cellpadding="0" cellspacing="0">

<thead class="dark_grey_box">
  <tr>
   <td>S. N.</td>
   <td>Name</td>
    <td>Organization</td>
    <td>Sector</td>
    <td>Sub Sector</td>
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
   $projectLink     = url('/projects/view/'.$row->id);
   $statusLink      = url('/projects/'.$row->status);
   $sectorLink      = url('/sectors/'.$row->sector_id);
   $areaLink        = url('/areas/'.$row->area_id);
   $workingzoneList = url('/working-zones/'.$row->working_zone_id);
   $editLink        = url('/projects/edit/'.$row->id);
   $deleteLink      = url('/projects/delete/'.$row->id);
  ?>
  <tr>
     <td>{{ $i }}</td>
     <td>{{ $row->title}}</td>
    <td> <a href="{{$projectLink}}"> {{ $row->organization }} </a> </td>
    <td> <a href="{{$sectorLink}}"> {{ $row->sector }}  </a> <br> <span> </span></td>
     <td> <a href="{{ $areaLink }}">{{ $row->area }}  </a> </td>
   <!--  <td> <a href="{{$workingzoneList}}"> {{ $row->working_zone }} </a> </td> -->
    <td> {{ $row->budget }} </td>
    <td> <a href="{{$statusLink}}"> {{ $row->status }} </a> </td>
    <td class="actions">
    <span class="icon_yellow"> <a href="{{$editLink}}"> <i class="icon-pencil"></i> </a> </span>
    <span class="icon_green"> <a href="{{$projectLink}}"> <i class="icon-eye"></i> </a></span>
    <span class="icon_red"> <a onclick = "return confirm('Are you sure? You can\'t undo this action.')" href="{{$deleteLink}}"> <i class="icon-trash-bin"></i> </a></span>
    </td>
  </tr>
<?php $i++; ?>
 @endforeach

 </tbody>
 
 <tfoot>
  <tr>
  <?php 
  $curpage = Request::get('page');
  $curpage = $curpage > 0?$curpage:1;
   url('/projects?');
  ?>
  <td>{!!  str_replace('/?', '?', $projectList->render()) !!}</td>
    <td colspan="3">showing {{ $projectList->currentPage() }} of {{ $projectList->lastPage() }}</td>
    <td colspan="3" align="right">
    shaow <span>
        <select id="row-view-select">
            <option value="{{ url('projects?page='.$projectList->currentPage().'&view=1') }}">1</option>
            <option value="{{ url('projects?page='.$projectList->currentPage().'&view=2') }}">2</option>
            <option value="{{ url('projects?page='.$projectList->currentPage().'&view=3') }}">3</option>
            <option value="{{ url('projects?page='.$projectList->currentPage().'&view=4') }}">4</option>
        </select>
    </span>
    </td>

  </tr>
 </tfoot> 
</table>
</div>

</div>

@stop



         