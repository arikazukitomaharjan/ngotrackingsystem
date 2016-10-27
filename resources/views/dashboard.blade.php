@extends('admin')
@section('content')

    <div class="site_body">

        <section class="project_n_count clearfix">
            <div class="col_3_3 testcol">
                <div class="projects_view">
                    <div class="proj_title">
                        {{ Lang::get('global.total').' '.Lang::get('global.projects') }}
                    </div>

                    <div class="proj_count">
                        {{$counts['all']}}
                    </div>
                </div>
            </div>


            <div class="col_3_3 testcol">
                <div class="projects_view">
                    <div class="proj_title">
                        {{ Lang::get('global.running').' '.Lang::get('global.projects') }}
                    </div>

                    <div class="proj_count">
                        {{$counts['running']}}
                    </div>
                </div>
            </div>


            <div class="col_3_3 testcol">
                <div class="projects_view">
                    <div class="proj_title">
                        {{ Lang::get('global.completed').' '.Lang::get('global.projects') }}
                    </div>

                    <div class="proj_count">
                        {{$counts['completed']}}
                    </div>
                </div>
            </div>
            <div class="col_3_3 testcol">
                <div class="projects_view">
                    <div class="proj_title">
                        {{ Lang::get('global.proposed').' '.Lang::get('global.projects') }}
                    </div>

                    <div class="proj_count">
                        {{$counts['proposed']}}
                    </div>
                </div>
            </div>


            <div class="col_3_3 testcol">
                <div class="projects_view   ">
                    <div class="proj_title">
                        {{ Lang::get('global.unknown').' '.Lang::get('global.projects') }}
                    </div>

                    <div class="proj_count">
                        {{$counts['unknown']}}
                    </div>
                </div>
            </div>


            <div class="col_3_3 testcol">
                <div class="projects_view">
                    <div class="proj_title">
                        {{ Lang::get('global.approved').' '.Lang::get('global.projects') }}
                    </div>

                    <div class="proj_count">
                        {{$counts['approved']}}
                    </div>
                </div>
            </div>
            <div class="col_3_3 testcol">
                <div class="projects_view">
                    <div class="proj_title">


                        {{ Lang::get('global.total').' '.Lang::get('global.Budget') }}
                    </div>
                    <div class="proj_count">
                        {{$total['total_budget']}}
                    </div>
                </div>
            </div>
            <div class="col_3_3 testcol">
                <div class="projects_view">
                    <div class="proj_title">


                        {{ Lang::get('global.total').' '.Lang::get('global.VDC') }}
                    </div>
                    <div class="proj_count">
                        {{$total['total_vdc']}}
                    </div>
                </div>
            </div>
            <div class="col_3_3 testcol">
                <div class="projects_view">
                    <div class="proj_title">
                        {{ Lang::get('global.total').' '.Lang::get('global.Organisation') }}
                    </div>
                    <div class="proj_count">
                        {{$total['total_organisation']}}
                    </div>
                </div>
            </div>
            {{--
                <div class="col_3_3 testcol">
                    <div class="projects_view">
                        <div class="proj_title">
                            {{ Lang::get('global.proposed').' '.Lang::get('global.projects') }}
                        </div>

                        <div class="proj_count">
                            {{$counts['proposed']}}
                        </div>
                    </div>
                </div>
                <div class="col_3_3 testcol">
                    <div class="projects_view">
                        <div class="proj_title">
                            {{ Lang::get('global.unknown').' '.Lang::get('global.projects') }}
                        </div>

                        <div class="proj_count">
                            {{$counts['unknown']}}
                        </div>
                    </div>
                </div>
            --}}
        </section>
        <!--Coounter Section Ends-->

        <!--Table View-->
        <section class="site_list_view">

            <div class="section_hdr clearfix">
                <h1 class="site_page_title">By VDC</h1>

                <span class="section_hdr_btns_wrp"><a href="#" class="btn btn_green">Add new</a></span>

            </div>


            <div class="site_tabling">
                <table cellpadding="0" cellspacing="0">

                    <thead>

                    <tr>
                        <th>S.N.</th>
                        <th>VDC</th>
                        <th>Organization</th>
                        <th>Project</th>
                        <th>Budget</th>
                        {{--<th>Action</th>--}}

                    </tr>

                    </thead>

                    <tbody>
                    <tr>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($vdcs as $vd)

                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{$vd->name}}</td>
                            <td>{{ $wz->countOrganisationByWorkingZone($vd->id ) }}</td>
                            <td>{{ $wz->countProjectByWorkingZone( $vd->id ) }}</td>
                            <td>{{ $wz->getBudgetByWorkingZone( $vd->id ) }}</td>
                            {{-- <td>
                                 <div class="action_icon"><i class="fa fa-cogs" aria-hidden="true"></i>

                                     <!--ActionBtns-->
                             <span class="actions_wrapp">
                                 <a href="#" class="fa fa-pencil-square-o" aria-hidden="true"></a>
                                 <a href="#" class="fa fa-eye" aria-hidden="true"></a>
                                 <a href="#" class="fa fa-trash-o" aria-hidden="true"></a>
                             </span>

                                 </div>
                             </td>--}}
                        </tr>
                        <?php
                        $i++;
                        ?>
                    @endforeach


                    </tbody>


                    <?php
                    $views = Request::get('views');
                    if (!$views) {
                        $views = 10;
                    }
                    ?>

                </table>

            </div>


        </section>
        <section class="site_list_view">

            <div class="section_hdr clearfix">
                <h1 class="site_page_title">By SECTOR</h1>

                <span class="section_hdr_btns_wrp"><a href="#" class="btn btn_green">Add new</a></span>

            </div>


            <div class="site_tabling">
                <table cellpadding="0" cellspacing="0">

                    <thead>

                    <tr>
                        <th>S.N.</th>
                        <th>SECTORS</th>
                        <th>Organization</th>
                        <th>Project</th>
                        <th>Budget</th>

                    </tr>

                    </thead>

                    <tbody>
                    <tr>
                    <?php
                    $i = 1;

                    ?>
                    @foreach($sectors as $sector)

                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{$sector->name}}</td>
                            <td>{{ $s->countOrganisationBySector($sector->id ) }}</td>
                            <td>{{ $s->countProjectBySector( $sector->id ) }}</td>
                            <td>{{ $s->getBudgetBySector( $sector->id ) }}</td>
                        </tr>

                        <?php $j=1;?>
                        @foreach($subSectors as $sector)

                            @if($sector->parent_id==$sector->id)

                                <tr>
                                    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $j }}</td>
                                    <td>{{$sector->name}}</td>
                                    <td>{{ $s->countOrganisationBySector($sector->id ) }}</td>
                                    <td>{{ $s->countProjectBySector( $sector->id ) }}</td>
                                    <td>{{ $s->getBudgetBySector( $sector->id ) }}</td>
                                </tr>
                                <?php $j++; ?>
                            @endif

                        @endforeach
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
                {{--<div class="grid_pagination">
                    <ul class="ftr_sort">
                        <li class="pull-left">
                            Showing <strong>{{ $dataList->currentPage() }} </strong> of {{ $dataList->lastPage() }}
                        </li>
                        <li>|</li>
                        <li><span>Show</span><span>
                            <select id="row-view-select">
                            <option {{ $view==10?'selected':'' }} value="{{ url('sectors?view=10') }}">10</option>
            <option {{ $view==25?'selected':'' }} value="{{ url('sectors?view=25') }}">25</option>
            <option {{ $view==50?'selected':'' }} value="{{ url('sectors?view=50') }}">50</option>
            <option {{ $view==100?'selected':'' }} value="{{ url('sectors?view=100') }}">100</option>
                            </select>
                        </span></li>
                    </ul>
                    <ul>
                        <li><a href="{!! $dataList->previousPageUrl()!!}">Prev</a></li>
                        <li>{!!  str_replace('/?', '?', $dataList->appends(['view' => $view ])->render()) !!}</li>
                        <li><a href="{!! $dataList->nextPageUrl()!!}">Next</a></li>

                    </ul>
                </div>--}}
            </div>


        </section>
        <!--Table Grid Ends-->


        <div class="copyright">
            BRUM-NS 2.0 | 2016 © Brum Info Tech.
        </div>


    </div>


@stop



         