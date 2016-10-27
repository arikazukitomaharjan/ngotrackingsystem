@extends('administrator')
@section('content')
    <div class="site_body">
        <section class="site_list_view">
            <div class="section_hdr clearfix vew">
                <h1 class="site_page_title">Organization</h1>
<span class="section_hdr_btns_wrp">{{ $org->status }}</span>
                {{--class="btn btn_green">Add new</a></span>--}}


            </div>
            <!--Page Title-->


            <!--VIEW PAGE STATE-->
            <div class="view_page_state">

                <!--ROW STARTS-->
                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Organization

                    </div>

                    <div class="view_value">
                        {{ $org->name }}
                    </div>

                </div>
                <!--ROW ENDS-->
                <!--ROW STARTS-->
                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Introduction

                    </div>

                    <div class="view_value">
                        {{ $org->introduction }}
                    </div>

                </div>
                <!--ROW ENDS-->


                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Fiscal Year

                    </div>

                    <div class="view_value">
                        2071/2072 | 2014/2015
                    </div>

                </div>
                <!--ROW ENDS-->
                <!--ROW STARTS-->
                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Address

                    </div>

                    <div class="view_value">
                        {{ $org->address }}
                    </div>

                </div>
                <!--ROW ENDS-->  <!--ROW STARTS-->
                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Contact Person
                    </div>

                    <div class="view_value">
                        {{ $org->contact_person }}
                    </div>

                </div>
                <!--ROW ENDS-->  <!--ROW STARTS-->
                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Contact No.

                    </div>

                    <div class="view_value">
                        {{ $org->contact_no }}
                    </div>

                </div>
                <!--ROW ENDS-->  <!--ROW STARTS-->
                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Email

                    </div>

                    <div class="view_value">
                        {{ $org->contact_email }}
                    </div>

                </div>
                <!--ROW ENDS-->  <!--ROW STARTS-->
                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Districts

                    </div>

                    <div class="view_value">
                        {{ $org->reg_district }}
                    </div>

                </div>
                <!--ROW ENDS-->  <!--ROW STARTS-->
                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Registration Date

                    </div>

                    <div class="view_value">
                        {{ $org->reg_date }}
                    </div>

                </div>
                <!--ROW ENDS-->  <!--ROW STARTS-->
                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Pan No.

                    </div>

                    <div class="view_value">
                        {{ $org->pan_no }}
                    </div>

                </div>

                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Pan Registration Date

                    </div>

                    <div class="view_value">
                        {{ $org->pan_reg_date }}
                    </div>

                </div>
                <!--ROW ENDS-->  <!--ROW STARTS-->
                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Affilition No.

                    </div>

                    <div class="view_value">
                        {{ $org->affilition_no }}
                    </div>

                </div><!--ROW STARTS-->
                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Last Renewal

                    </div>

                    <div class="view_value">
                        {{ $org->last_renewal    }}
                    </div>

                </div>
                <!--ROW ENDS-->
                <!--ROW STARTS-->
                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Objective

                    </div>

                    <div class="view_value">
                        {{ $org->objectives }}
                    </div>

                </div>
                <!--ROW STARTS-->
                <div class="view_row_wrapp clearfix">

                    <div class="view_label">
                        Asset

                    </div>

                    <div class="view_value">
                        {{ $org->assets    }}
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
                                    <th>Project Name</th>
                                    <th>Sector</th>
                                    <th>Sub Sector</th>
                                    <th>Working Zone</th>
                                    <th>Budget</th>
                                    <th>Status</th>

                                </tr>
                                </thead>

                                <tbody>

                                @foreach($projectList as $row)
                                    <?php
                                    $projectLink = url('/administrator/project/view/' . $row->id);
                                    $statusLink = url('/projects/' . $row->status);
                                    $sectorLink = url('/sectors/' . $row->sector_id);
                                    $areaLink = url('/areas/' . $row->area_id);
                                    $editLink = url('/projects/edit/' . $row->id);
                                    $deleteLink = url('/projects/delete/' . $row->id);
                                    ?>
                                    <tr>
                                        <td><a href="{{$projectLink}}"> {{ $row->title }} </a></td>
                                        <td>  {{ $row->sector }} </td>
                                        <td>{{ $row->area }}</td>
                                        <td> {!! $obj->workingZones($row->working_zone) !!}  </td>
                                        <td> NPR {{ $row->budget_rs }} </td>
                                        <td> {{ $row->status }} </td>

                                    </tr>

                                @endforeach

                                </tbody>

                            </table>


                        </div>

                    </div>
                    <!--ROW ENDS-->


                </div>
            </div>
        </section>
        <!--Table Grid Ends-->


        <div class="copyright">
            BRUM-NS 2.0 | 2016 © Brum Info Tech.
        </div>


    </div>


@stop

