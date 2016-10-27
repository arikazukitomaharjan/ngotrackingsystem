@extends('default')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">

<div class="table_list_view">

<h1 class="list_title">Budget</h1>

<div class="">
    <div id="tabs">
    <ul>
      <li><a href="#tabs-1">Projects</a></li>
      <li><a href="#tabs-2">Sectors</a></li>
      <li><a href="#tabs-3">Working Zones</a></li>
     
     
    </ul>
    <div id="tabs-1">
      

<table border="0" cellpadding="0" cellspacing="0">

<thead class="dark_grey_box">
  <tr>
    <td>Name</td>
    <td>Budget</td>
  </tr>
</thead>
<tbody>

  @foreach($projectList as $row)

  <tr>
    <td>  {{ $row->title }} </td>
    <td> {{ $row->budget }} </td>
  </tr>

 @endforeach

 </tbody>

</table>

      </div>
    <div id="tabs-2">
    <!-- sector section -->
    <table border="0" cellpadding="0" cellspacing="0">

<thead class="dark_grey_box">
  <tr>
    <td>Name</td>
    <td>Budget</td>
  </tr>
</thead>
<tbody>

  @foreach($sectorList as $row)
  <?php 
   if($row->parent_id > 0){
    continue;
   }
  ?>
  <tr>
    <td> <strong>{{ $row->name }}  </td>
    <td> {{ $row->sectorBudget }} </td>
    </tr>
       @foreach($sectorList as $child)
          @if($child->parent_id == $row->id)
          <tr>
          <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -  {{ $child->name }} </td>
          <td> {{ $child->areaBudget }} </td>
          </tr>     
           @endif
       @endforeach

 @endforeach

 </tbody>

</table>


     </div>
    <div id="tabs-3">
        <table border="0" cellpadding="0" cellspacing="0">
          <thead class="dark_grey_box">
            <tr>
              <td>Name</td>
              <td>Budget</td>
            </tr>
          </thead>
          <tbody>

            @foreach($zoneList as $row)
            <?php 
             
            ?>
            <tr>
              <td> {{ $row->name }} </td>
              <td> {{ $row->zoneBudget }} </td>  
               
              </tr>

           @endforeach

           </tbody>

          </table>
        
   </div>

       
   
  </div>
</div>
</div>

</div>
<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
</head>


@stop



         