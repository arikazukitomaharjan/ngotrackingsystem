@extends('default')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">

<div class="table_list_view">

<h1 class="list_title">Summary</h1>

<div class="">
    <div id="tabs">
    <ul>
      <li><a href="#tabs-1">Organization</a></li>
      <li><a href="#tabs-2">Sector</a></li>
      <li><a href="#tabs-3">Zone</a></li>
      <li><a href="#tabs-4">Line Office</a></li>
      <li><a href="#tabs-5">Projects</a></li>
    </ul>
    <div id="tabs-1">
      

<table border="0" cellpadding="0" cellspacing="0">

<thead class="dark_grey_box">
  <tr>
    <td>Name</td>
    <td>Reg. Date</td>
    <td>Reg. No.</td>
    <td>Address</td>
    <td>Contact Person</td>
    <td>Contact No.</td>
    <td class="actions">Approved</td>
  </tr>
</thead>
<tbody>

  @foreach($orgList as $row)
  <?php 
   $orgLink         = url('/organizations/'.$row->id);
   $editLink        = url('/organizations/edit/'.$row->id);
   $deleteLink      = url('/organizations/delete/'.$row->id);
  ?>
  <tr>
    <td> <a href="{{$orgLink}}"> {{ $row->name }} </a> </td>
    <td> {{ $row->reg_date }} </td>
    <td> {{ $row->reg_no }} </td>
    <td> {{ $row->address }} </td>
    <td> {{ $row->contact_person }} </td>
    <td> {{ $row->contact_no }} </td>
    <td> {{ $row->status }} </td>
    </tr>

 @endforeach

 </tbody>

</table>

      </div>
    <div id="tabs-2">
    <!-- sector section -->

     </div>
    <div id="tabs-3">
      <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
      <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
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



         