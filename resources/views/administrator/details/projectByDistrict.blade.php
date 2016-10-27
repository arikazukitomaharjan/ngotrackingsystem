@extends('administrator')
@section('content')

    <div class="site_body">


        <section class="site_list_view">


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
                        $areaLink = url('/organization/sector/' . $row->area_id);
                        $editLink = url('/organization/project/edit/' . $row->id);
                        $deleteLink = url('/organization/project/delete/' . $row->id);
                        ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td><a href="{{$projectLink}}"> {{ $row->title }} </a></td>
                            <td> {{ $row->sector }}</td>
                            <td>{{ $row->area }} </td>
                            <td>  {!! $row->working_zone !!}  </td>
                            <td>  @if($row->budget) {{  $row->currency .' ' . $row->budget }}  @endif  </td>
                            <td><a href="{{$statusLink}}"> {{ $row->status }} </a></td>


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
                                 <option {{ $view==10?'selected':'' }} value="{{ url('organization/project?view=10') }}">10</option>
            <option {{ $view==25?'selected':'' }} value="{{ url('organization/project?view=25') }}">25</option>
            <option {{ $view==50?'selected':'' }} value="{{ url('organization/project?view=50') }}">50</option>
            <option {{ $view==100?'selected':'' }} value="{{ url('organization/project?view=100') }}">100</option>
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


    </div>

@stop
