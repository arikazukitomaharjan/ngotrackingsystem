@extends('default')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">

<div class="table_list_view">

<h1 class="list_title">Activities</h1>

<div class="">
    <div id="tabs">
    <ul>
      <li><a href="#tabs-1">Projects</a></li>
     </ul>
    
<div id="tabs-1">
      

<table border="0" cellpadding="0" cellspacing="0">

<thead class="dark_grey_box">
  <tr>
    <td>Project Name</td>
    <td>Activities</td>
  </tr>
</thead>
<tbody>
<?php // echo '<pre>'; print_r($projectList);echo '</pre>';?>
  @foreach($projectList as $row)

  <tr class="activities-list">
    <td>  {{ $row->title }} </td>
    <td>  

    @if(count($row->ProjActivities) > 0 )
  <table cellpadding="0" cellspacing="0">
        <tr class="sub_tbl_hdr ">
        <th>S.N.</th>
          <th>Description</th>
          <th>Unit</th>
          <th>Quantity</th>
          <th>Duration</th>
          <th>Unit Cost</th>
          <th>Total Budget</th>
          <th>Phase</th>
        </tr>
        <?php $i = 1; ?>
          @foreach($row->ProjActivities as $row)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{ $row->description }}</td>
                  <td>{{ $row->unit }}</td>
                  <td>{{ $row->quantity }}</td>
                  <td>{{ $row->duration }} {{ $row->period }}</td>
                  
                  <td>{{ $row->unit_cost }}</td>
                  <td>{{ $row->total_budget }}</td>
                  <td>{{ $row->phase }}</td>
                </tr>
                <?php $i++; ?>
            @endforeach
      </table>
@endif
   </td>
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



         