@extends('org')
@section('content')
    <section class="site_list_view">
        <div class="section_hdr clearfix vew">
            <h1 class="list_title"><span style="float:right;"
                                         class="app_btn btn_green btn_curve"></span><a
                        href="{{ url('/sectors/edit/'.$sector->id) }}">{{ $sector->name }}</a></h1>

            <span class="section_hdr_btns_wrp"></span>


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
                        <td>   {!! $obj->workingZones($row->working_zone) !!}  </td>
                        <td>  @if($row->budget) {{  $row->currency .' ' . $row->budget }}  @endif  </td>
                        <td><a href="{{$statusLink}}"> {{ $row->status }} </a></td>
                        <td>
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
                <?php $i++; ?>
                @endforeach

                <tfoot>

            </table>
        </div>

        </div>


        </div>
@stop

