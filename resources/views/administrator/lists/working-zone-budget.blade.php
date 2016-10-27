@extends('administrator')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">


<div class="table_list_view">

<h1 class="list_title">All Working Zones<a href="{{ URL::route('createWorkingZone') }}" class="app_btn dark_grey_box">Add New</a></h1>

<table border="0" cellpadding="0" cellspacing="0">

<thead class="dark_grey_box">
  <tr>
    <td>S. N.</td>
    <td>Name</td>
    <td>Budget</td>
    <td class="actions">Action</td>
  </tr>
</thead>

<tbody>
<?php
  $i = 1;
?>
  @foreach($dataList as $row)
  <?php 
   $wzLink          = url('/working-zones/'.$row->id);
   $editLink        = url('/working-zones/edit/'.$row->id);
   $deleteLink      = url('/working-zones/delete/'.$row->id);
  ?>
  <tr>
  <td>{{$i}}</td>
    <td> <a href="{{$wzLink}}"> {{ $row->name }} </a> </td>
    <td> {{ $obj->getBudgetByWorkingZone( $row->id ) }} </td>
    <td class="actions">
    <span class="icon_yellow"> <a href="{{$editLink}}"> <i class="icon-pencil"></i> </a> </span>
    <span class="icon_green"> <a href="{{$wzLink}}"> <i class="icon-eye"></i> </a></span>
    <span class="icon_red"> <a onclick = "return confirm('Are you sure? You can\'t undo this action.')" href="{{$deleteLink}}"> <i class="icon-trash-bin"></i> </a></span>
    </td>
  </tr>
<?php
  $i++;
?>
 @endforeach

 </tbody>
 <tfoot>
  <?php 
        $view = Request::get('view');
        if( !$view ){
          $view = 10;
        }
    ?>
  <tr>
 
     <td colspan="2">{!!  str_replace('/?', '?', $dataList->appends(['view' => $view ])->render()) !!}</td>
    <td colspan="1">showing {{ $dataList->currentPage() }} of {{ $dataList->lastPage() }}</td>
    <td colspan="1" align="right">
    show <span>
        <select id="row-view-select">
        
            <option {{ $view==10?'selected':'' }} value="{{ url('working-zones?view=10') }}">10</option>
            <option {{ $view==25?'selected':'' }} value="{{ url('working-zones?view=25') }}">25</option>
            <option {{ $view==50?'selected':'' }} value="{{ url('working-zones?view=50') }}">50</option>
            <option {{ $view==100?'selected':'' }} value="{{ url('working-zones?view=100') }}">100</option>
        </select>
    </span>
    </td>

  </tr>
 </tfoot> 
</table>
</div>

</div>

@stop



         