@extends('administrator')
@section('content')
    <div class="app_right_part">

        <div class="site_body">
            <section class="project_n_count clearfix">
                <div class="col_3_3">
                    <div class="projects_view">
                        <div class="proj_title">
                            Total Projects
                        </div>

                        <div class="proj_count">
                            {{$counts['all']}}
                        </div>
                    </div>
                </div>


                <div class="col_3_3">
                    <div class="projects_view">
                        <div class="proj_title">
                            Current Projects
                        </div>

                        <div class="proj_count">
                            {{$counts['running']}}
                        </div>
                    </div>
                </div>


                <div class="col_3_3">
                    <div class="projects_view">
                        <div class="proj_title">
                            Finished Projects
                        </div>

                        <div class="proj_count">
                            {{$counts['completed']}}
                        </div>
                    </div>
                </div>
            </section>
            <section class="site_list_view">

                <div class="section_hdr clearfix">
                    <h1 class="site_page_title">
                        <Projects></Projects>
                    </h1>

                <span class="section_hdr_btns_wrp"><a href="{{ URL::route('createProject') }}"
                                                      class="btn btn_green">Add new</a></span>
                    <span class="section_hdr_btns_wrp"> <a href="{{ URL::route('exportData') }}"
                                                           class="btn btn_green">Export</a></span>

                </div>

                <label>Fiscal Year</label>
                <select name="">
                    <option>2071/2072</option>
                </select>
                <div class="site_tabling">
                    <table cellpadding="0" cellspacing="0">

                        <thead>

                        <tr>


                            <table border="0" cellpadding="0" cellspacing="0">

                                <thead class="dark_grey_box">
                                <tr>
                                    <th>S. N.</th>
                                    <th>Name</th>
                                    <th>Organization</th>
                                    <th>Sector</th>
                                    <th>Sub Sector</th>
                                    <th>Working Zone</th>
                                    <th>Budget</th>
                                    <th>Status</th>

                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $i = 1;
                                ?>

                                @foreach($projectList as $row)
                                    <?php
                                    $projectLink = url('/administrator/project/view/' . $row->id);
                                    $orgLink = url('/administrator/organization/view/' . $row->organization);
                                    $statusLink = url('/administrator/project/' . $row->status);
                                    $sectorLink = url('/admistrator/sector/' . $row->sector_id);
                                    $areaLink = url('/administrator/area/' . $row->area_id);
                                    $editLink = url('/administrator/project/edit/' . $row->id);
                                    $deleteLink = url('/administrator/project/delete/' . $row->id);
                                    ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td><a href="{{$projectLink}}"> {{ $row->title }} </a></td>
                                        <td><a href="#"> {{ $row->organization }} </a></td>
                                        <td> {{ $row->sector }}</td>
                                        <td>{{ $row->area }}</td>
                                        <td>  {!! $obj->workingZones($row->working_zone) !!}  </td>
                                        <td class="working_zone"> {{  $row->currency .' ' . $row->budget }}  </td>
                                        <td> {{ $row->status }} </td>

                                    </tr>
                                    <?php $i++; ?>
                                @endforeach

                                </tbody>

                                <tfoot>
                                <?php
                                $view = Request::get('view');
                                if (!$view) {
                                    $view = 10;
                                }
                                ?>


                            </table>
                            <div class="grid_pagination">
                                <ul class="ftr_sort">
                                    <li class="pull-left">
                                        Showing <strong>{{ $projectList->currentPage() }} </strong>
                                        of {{ $projectList->lastPage() }}
                                    </li>
                                    <li>|</li>
                                    <li><span>Show</span><span>
                            <select id="row-view-select">
                               <?php $path = Request::url();
                                ?>
                                <option {{ $view==10?'selected':'' }} value="{{ url($path.'?view=10') }}">10</option>
                            <option {{ $view==25?'selected':'' }} value="{{ url($path.'?view=25') }}">25</option>
                            <option {{ $view==50?'selected':'' }} value="{{ url($path.'?view=50') }}">50</option>
                            <option {{ $view==100?'selected':'' }} value="{{ url($path.'?view=100') }}">100</option>
                            </select>
                        </span></li>
                                </ul>
                                <ul>
                                    <li><a href="{!! $projectList->previousPageUrl()!!}">Prev</a></li>
                                    <li>{!!  str_replace('/?', '?', $projectList->appends(['view' => $view ])->render()) !!}</li>
                                    <li><a href="{!! $projectList->nextPageUrl()!!}">Next</a></li>

                                </ul>
                            </div>




@stop



         