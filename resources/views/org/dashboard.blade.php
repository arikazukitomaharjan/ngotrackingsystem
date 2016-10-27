@extends('org')
@section('content')
    <div class="site_body">

        <section class="project_n_count clearfix">
            <div class="col_3_3">
                <div class="projects_view">
                    <div class="proj_title">
                        {{ Lang::get('global.total').' '.Lang::get('global.projects') }}
                    </div>

                    <div class="proj_count">
                        {{$counts['all']}}
                    </div>
                </div>
            </div>


            <div class="col_3_3">
                <div class="projects_view">
                    <div class="proj_title">
                        {{ Lang::get('global.running').' '.Lang::get('global.projects') }}
                    </div>

                    <div class="proj_count">
                        {{$counts['running']}}
                    </div>
                </div>
            </div>


            <div class="col_3_3">
                <div class="projects_view">
                    <div class="proj_title">
                        {{ Lang::get('global.completed').' '.Lang::get('global.projects') }}
                    </div>

                    <div class="proj_count">
                        {{$counts['completed']}}
                    </div>
                </div>
            </div>
        </section>
        <section class="site_list_view">

            <div class="section_hdr clearfix">
                <h1 class="site_page_title">All Projects</h1>

                <span class="section_hdr_btns_wrp"><a href="{{ URL::route('createOrgProject') }}" class="btn btn_green">Add new</a></span>

            </div>

            <div class="site_tabling">
                <table cellpadding="0" cellspacing="0">

                    <thead>

                    <tr>


                        <th>S. N.</th>
                        <th>Name</th>
                        <th>Sector</th>
                        <th>Sub Sector</th>
                        <th>Working Zone</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th class="actions">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($projectList as $row)
                        <?php
                        $projectLink = url('/organization/project/view/' . $row->id);
                        $statusLink = url('/organization/project/' . $row->status);
                        $sectorLink = url('/organization/sector/' . $row->sector_id);
                        $areaLink = url('/organization/area/' . $row->area_id);
                        $editLink = url('/organization/project/edit/' . $row->id);
                        $deleteLink = url('/organization/project/delete/' . $row->id);
                        ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td><a href="{{$projectLink}}"> {{ $row->title }} </a></td>

                            <td><a href="{{$sectorLink}}"> {{ $row->sector }}</td>
                            <td><a href="{{ $areaLink }}">{{ $row->area }}  </a></td>
                            <td>  {!! $obj->workingZones($row->working_zone) !!}  </td>
                            <td>  @if($row->budget) {{  $row->currency .' ' . $row->budget }}  @endif  </td>
                            <td><a href="{{$statusLink}}"> {{ $row->status }} </a></td>
                            <td class="actions">
                                <div class="action_icon"><i class="fa fa-cogs" aria-hidden="true"></i>

                                    <!--ActionBtns-->
                                    <span class="actions_wrapp">
                                        <a href="{{$editLink}}" class="fa fa-pencil-square-o" aria-hidden="true"></a>
                                        <a href="{{$projectLink}}" class="fa fa-eye" aria-hidden="true"></a>
                                        <a onclick="return confirm('Are you sure? You can\'t undo this action.')"
                                           href="{{$deleteLink}}" class="fa fa-trash-o" aria-hidden="true"></a>
                                    </span>

                                </div>

                            </td>

                        </tr>
                        <?php
                        $i++;
                        ?>
                    @endforeach

                    </tbody>

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
                            Showing <strong>{{ $projectList->currentPage() }} </strong> of {{ $projectList->lastPage() }}
                        </li>
                        <li>|</li>
                        <li><span>Show</span><span>
                            <select id="row-view-select">
                                <option {{ $view==10?'selected':'' }} value="{{ url('projects?view=10') }}">10</option>
            <option {{ $view==25?'selected':'' }} value="{{ url('projects?view=25') }}">25</option>
            <option {{ $view==50?'selected':'' }} value="{{ url('projects?view=50') }}">50</option>
            <option {{ $view==100?'selected':'' }} value="{{ url('projects?view=100') }}">100</option>
                            </select>
                        </span></li>
                    </ul>
                    <ul>
                        <li><a href="{!! $projectList->previousPageUrl()!!}">Prev</a></li>
                        <li>{!!  str_replace('/?', '?', $projectList->appends(['view' => $view ])->render()) !!}</li>
                        <li><a href="{!! $projectList->nextPageUrl()!!}">Next</a></li>

                    </ul>
                </div>
            </div>

        </section>
        <div class="copyright">
            BRUM-NS 2.0 | 2016 © Brum Info Tech.
        </div>
    </div>

@stop



         