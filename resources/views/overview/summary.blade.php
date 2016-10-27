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
    <td>Organization Name</td>
    <td>Projects</td>
    
    <td class="actions">Approved</td>
  </tr>
</thead>
<tbody>

  @foreach($orgList as $row)
  <tr>
    <td> {{ $row->name }} </td>
    <td class="project-list"> 
      @foreach( $row->projects as $proj )
        <span class="prj-name"> {{  $proj->title }} </span> 
      @endforeach

    </td>
   
    <td> 
    @if($row->status=='Published') 
    Yes
   @else
   No
   @endif

    </td>
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
    <td>Projects</td>
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
    <td> <strong>{{ $row->name }} </strong> </td>
    <td> 
  
     </td>
    </tr>
       @foreach($sectorList as $child)
          @if($child->parent_id == $row->id)
          <tr>
          <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -  {{ $child->name }}  </td>
          <td class="project-list"> 
            @foreach($child->projects as $proj)
               <span class="prj-name"> {{ $proj->title }} </span>
            @endforeach
        
           </td>
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
              <td>Projects</td>
            </tr>
          </thead>
          <tbody>

            @foreach($zoneList as $row)
            <?php 
             
            ?>
            <tr>
              <td> {{ $row->name }}  </td>
                    <td class="project-list"> 
                      @foreach($row->projects as $proj)
                      <span class="prj-name"> {{ $proj->title }} </span>
                      @endforeach
                  
                     </td>  
               
              </tr>

           @endforeach

           </tbody>

          </table>
        
   </div>

       <div id="tabs-4">
        <table border="0" cellpadding="0" cellspacing="0">
          <thead class="dark_grey_box">
            <tr>
              <td>Name</td>
              <td>Projects</td>
            </tr>
          </thead>
          <tbody>

            @foreach($lineOfficeList as $row)
            <?php 
             
            ?>
            <tr>
              <td> {{ $row->name }}  </td>
                    <td class="project-list"> 
                      @foreach($row->projects as $proj)
                         <span class="prj-name"> {{ $proj->title }} </span>
                      @endforeach
                  
                     </td>  
               
              </tr>

           @endforeach

           </tbody>

          </table>
        
   </div>
   <div id="tabs-5">

<table border="0" cellpadding="0" cellspacing="0">

<thead class="dark_grey_box">
  <tr>
    <td>Name</td>
    <td>Organization</td>
    <td>Duration</td>
    <td>Sector</td>
    <td>Working Zone</td>
    <td>Line Office</td>
    <td class="actions">Status</td>
  </tr>
</thead>
<tbody>

  @foreach($projectList as $row)
  <tr>
    <td> {{ $row->title }} </td>
    <td> {{ $row->organization }} </td>
    <td> {{ date('M d, y', strtotime($row->start_date)). ' - '. date('M d, y', strtotime($row->end_date))  }} </td>
    <td> <strong>{{ $row->sector }}</strong> <br/> {{ $row->area }} </td>
    <td> {{ $row->working_zone }} </td>
    <td> {{ $row->line_office }} </td>
    <td> {{ $row->status }} </td>
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



         