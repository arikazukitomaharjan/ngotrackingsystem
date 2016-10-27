
@extends('org')
@section('content')
  <div class="site_body">
    <section class="site_list_view">
      <div class="section_hdr clearfix vew">


        <h1 class="site_page_title"> {{ $project->title }}</h1>
        <span class="section_hdr_btns_wrp">{{ $project->status }}</span>




      </div>
      <!--VIEW PAGE STATE-->
      <div class="view_page_state">

        <!--ROW STARTS-->
        <div class="view_row_wrapp clearfix">

          <div class="view_label">
            Organization Name

          </div>

          <div class="view_value">
            {{$project->organization }}
          </div>

        </div>
        <!--ROW ENDS-->
        <!--ROW STARTS-->
        <div class="view_row_wrapp clearfix">

          <div class="view_label">
            Introduction

          </div>

          <div class="view_value">
            {{ $project->sector}}
          </div>

        </div>
        <!--ROW ENDS-->

        <!--ROW STARTS-->
        <div class="view_row_wrapp clearfix">

          <div class="view_label">
            Address

          </div>

          <div class="view_value">
            {{ $project->area }}
          </div>

        </div>
        <!--ROW ENDS-->  <!--ROW STARTS-->
        <div class="view_row_wrapp clearfix">

          <div class="view_label">
            Contact Person
          </div>

          <div class="view_value">
            {{ $obj->workingZones( $project->working_zone ) }}
          </div>

        </div>
        <!--ROW ENDS-->  <!--ROW STARTS-->
        <div class="view_row_wrapp clearfix">

          <div class="view_label">
            Contact No.

          </div>

          <div class="view_value">
            {!! $obj->lineOffices( $project->line_office ) !!}
          </div>

        </div>
        <!--ROW ENDS-->  <!--ROW STARTS-->
        <div class="view_row_wrapp clearfix">

          <div class="view_label">
            Email

          </div>

          <div class="view_value">
            {{ $project->fiscal_year_bs }} | {{ $project->fiscal_year_ad }}
          </div>

        </div>
        <!--ROW ENDS-->  <!--ROW STARTS-->
        <div class="view_row_wrapp clearfix">

          <div class="view_label">
            Districts

          </div>

          <div class="view_value">
            {{ date('M d, y', strtotime($project->start_date)). ' - '. date('M d, y', strtotime($project->end_date))  }}
          </div>

        </div>
        <!--ROW ENDS-->  <!--ROW STARTS-->
        <div class="view_row_wrapp clearfix">

          <div class="view_label">
            Registration Date

          </div>

          <div class="view_value">
            {{ $project->budget }}
          </div>

        </div>
        <!--ROW ENDS-->
        <!--ROW ENDS-->  <!--ROW STARTS-->
        <div class="view_row_wrapp clearfix">

          <div class="view_label">
            Pan Registration Date

          </div>

          <div class="view_value">
            {{ $project->targeted_group }}
          </div>

        </div><!--ROW STARTS-->
        <div class="view_row_wrapp clearfix">

          <div class="view_label">
            Pan No.

          </div>

          <div class="view_value">
            {{ $project->objectives }}
          </div>

        </div>


        <!--ROW STARTS-->
        <div class="view_row_wrapp acti clearfix">

          <div class="view_label">
            Activities

          </div>

          <div class="view_value">
            <div class="site_tabling">
              <table cellpadding="0" cellspacing="0">

                <thead>

                <tr>
                  <th>S.N.</th>
                  <th>Description</th>
                  <th>Unit</th>
                  <th>Quantity</th>
                  <th>Duration</th>
                  <th>Unit Cost</th>
                  <th>Total Budget</th>
                  <th>Phase</th>
                </tr>

                </thead>

                <tbody>

                <?php $i = 1; ?>
                @foreach($activities as $row)
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

                </tbody>

              </table>
              <tr>
                <td>Remark:</td>
                <td>{{ $project->remark }}</td>
              </tr>
              <br>
              <a href="{{ url('/organization/projects/') }}">
                <button class="app_btn btn_sky">Go Back</button>
              </a>

            </div>

          </div>
          <!--ROW ENDS-->

        </div>


      </div>




</div>



</div>
@stop

