@extends('default')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">

<div class="table_list_view">

<h1 class="list_title">Objectives</h1>

<div class="">
    <div id="tabs">
    <ul>
      <li><a href="#tabs-1">Projects</a></li>
      <li><a href="#tabs-2">Organizations</a></li>
     </ul>
    
<div id="tabs-1">
      

<table border="0" cellpadding="0" cellspacing="0">

<thead class="dark_grey_box">
  <tr>
    <td>Project Name</td>
    <td>Objectives</td>
  </tr>
</thead>
<tbody>

  @foreach($projectList as $row)

  <tr>
    <td>  {{ $row->title }} </td>
    <td>  {!! $row->objectives !!} </td>
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
    <td>Organization Name</td>
    <td>Objectives</td>
  </tr>
</thead>
<tbody>

   @foreach($orgList as $row)

  <tr>
    <td>  {{ $row->name }} </td>
    <td>  {!! $row->objectives !!} </td>
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



         