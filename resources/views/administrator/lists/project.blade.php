@extends('administrator')
@section('content')
    <div class="site_body">

        <section class="site_list_view">

            <div class="section_hdr clearfix">
                <h1 class="site_page_title">Projects</h1>


            </div>


            <div class="site_tabling">


                <table cellpadding="0" cellspacing="0">

                    <thead>

                    <tr>

                        <th>S. N.</th>
                        <th>Name</th>
                        <th>Organization</th>
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
                        <?php $i++; ?>
                    @endforeach

                    </tbody>

                    <tfoot>


                </table>

        </section>
        <!--Table Grid Ends-->


        <div class="copyright">
            BRUM-NS 2.0 | 2016 © Brum Info Tech.
        </div>


    </div>

@stop



         