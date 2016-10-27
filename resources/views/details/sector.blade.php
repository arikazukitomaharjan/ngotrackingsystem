@extends('admin')
@section('content')
    <section class="site_list_view">
        <div class="section_hdr clearfix vew">
            <h1 class="list_title"><span style="float:right;"
                                         class="app_btn btn_green btn_curve"></span>{{ $sector->name }}</h1>

            <span class="section_hdr_btns_wrp"></span>


        </div>
        <div class="site_tabling">
            <table cellpadding="0" cellspacing="0">

                <thead>

                <tr>
                    <th>Project Name</th>
                    <th>Sector</th>
                    <th>Working Zone</th>
                    <th>Budget</th>
                    <th>Status</th>
                    <th class="actions">Action</th>
                </tr>
                </thead>

                <tbody>

                @foreach($projectList as $row)
                    <?php
                    $projectLink = url('/projects/view/' . $row->id);
                    $statusLink = url('/projects/' . $row->status);
                    $sectorLink = url('/sectors/' . $row->sector_id);
                    $areaLink = url('/areas/' . $row->area_id);
                    $editLink = url('/projects/edit/' . $row->id);
                    $deleteLink = url('/projects/delete/' . $row->id);
                    ?>
                    <tr>
                        <td><a href="{{$projectLink}}"> {{ $row->title }} </a></td>
                        <td><a href="{{$sectorLink}}"> {{ $row->sector }}  </a> <br> <span><a
                                        href="{{ $areaLink }}">{{ $row->area }}  </a> </span></td>
                        <td>  {!! $obj->workingZones($row->working_zone) !!}  </td>
                        <td> NPR {{ $row->budget_rs }} </td>
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

                @endforeach

                </tbody>

            </table>
        </div>

        </div>


        </div>
@stop

