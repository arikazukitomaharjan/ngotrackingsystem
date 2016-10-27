@extends('admin')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">


<div class="table_list_view">

<h1 class="list_title">All Sectors<a href="{{ URL::route('createSector') }}" class="app_btn dark_grey_box">Add New</a></h1>

<table border="0" cellpadding="0" cellspacing="0">

<thead class="dark_grey_box">
  <tr>
    <td>S. N.</td>
    <td>Sector Name</td>
    <td>Status</td>
    <td class="actions">Action</td>
  </tr>
</thead>

<tbody>

    <?php $i = 2; $j = 1; ?>
  @foreach($dataList as $row)
  <?php 
  if($row->parent_id >0):
        continue;
    endif;

   $sectorLink      = url('/organization/sectors/'.$row->id);
   $editLink        = url('/organization/edit/'.$row->id);
   $deleteLink      = url('/organization/delete/'.$row->id);
   $k = 1;
  ?>
  <tr>
  <td>{{ $j }}</td>
    <td> <a href="{{$sectorLink}}"> <strong> {{ $row->name }} </strong> </a> </td>
    <td> {{ $row->status }} </td>
   
    <td class="actions">
    <span class="icon_yellow"> <a href="{{ $editLink }}"> <i class="icon-pencil"></i> </a> </span>
    <span class="icon_green"> <a href="{{ $sectorLink }}"> <i class="icon-eye"></i> </a></span>
    <span class="icon_red"> <a onclick = "return confirm('Are you sure? You can\'t undo this action.')" href="{{$deleteLink}}"> <i class="icon-trash-bin"></i> </a></span>
    </td>
  </tr>

    @foreach($dataList as $child)
            <?php
            
            $sectorLink      = url('/organization/sectors/sectors/'.$child->id);
            $editLink        = url('/organization/sectors/edit/'.$child->id);
            $deleteLink      = url('/organization/sectors/delete/'.$child->id);
            ?>
           @if($child->parent_id == $row->id)
            
            <tr>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ integerToRoman($k) }}</td>
                <td> <a href="{{$sectorLink}}"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-{{ $child->name }} </a> </td>
                <td> {{ $child->status }} </td>
                
                <td class="actions">
                <span class="icon_yellow"> <a href="{{$editLink}}"> <i class="icon-pencil"></i> </a> </span>
                <span class="icon_green"> <a href="{{$sectorLink}}"> <i class="icon-eye"></i> </a></span>
                <span class="icon_red"> <a onclick = "return confirm('Are you sure? You can\'t undo this action.')" href="{{$deleteLink}}"> <i class="icon-trash-bin"></i> </a></span>
                </td>
            </tr>
            <?php $k++; ?>
          @endif
    @endforeach
    <?php $j++; ?>

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
    shaow <span>
        <select id="row-view-select">
        
            <option {{ $view==10?'selected':'' }} value="{{ url('sectors?view=100') }}">100</option>
            <option {{ $view==25?'selected':'' }} value="{{ url('sectors?view=200') }}">200</option>
            <option {{ $view==50?'selected':'' }} value="{{ url('sectors?view=500') }}">500</option>
            <option {{ $view==100?'selected':'' }} value="{{ url('sectors?view=1000') }}">1000</option>
        </select>
    </span>
    </td>

  </tr>
 </tfoot> 
</table>
</div>

</div>
<?php 
function integerToRoman($integer)
        {
         // Convert the integer into an integer (just to make sure)
         $integer = intval($integer);
         $result = '';
         
         // Create a lookup array that contains all of the Roman numerals.
         $lookup = array('M' => 1000,
         'CM' => 900,
         'D' => 500,
         'CD' => 400,
         'C' => 100,
         'XC' => 90,
         'L' => 50,
         'XL' => 40,
         'X' => 10,
         'IX' => 9,
         'V' => 5,
         'IV' => 4,
         'I' => 1);
         
         foreach($lookup as $roman => $value){
          // Determine the number of matches
          $matches = intval($integer/$value);
         
          // Add the same number of characters to the string
          $result .= str_repeat($roman,$matches);
         
          // Set the integer to be the remainder of the integer and the value
          $integer = $integer % $value;
         }
         
         // The Roman numeral should be built, return it
         return $result;
        }
?>
@stop



         