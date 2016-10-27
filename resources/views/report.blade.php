@extends('admin')
@section('content')
    <div class="site_body">


        <!--Table View-->
        <section class="site_list_view">


            <div class="site_tabling report_table">
                <table cellpadding="0" cellspacing="0">

                    <thead>

                    <tr>
                        <th rowspan="2">SN</th>
                        <th rowspan="2" align="left">Projects</th>
                        <th rowspan="2">Activities</th>
                        <th rowspan="2">Unit</th>
                        <th colspan="2" align="center">Yearly Goal</th>
                        <th colspan="2" rowspan="2">Remarks</th>
                    </tr>
                    <tr>
                        <th style="width:100px;">Quantity</th>
                        <th style="width:100px;">Budget</th>
                    </tr>

                    </thead>

                    <tbody>
                    <?php
                    $i = 1;
                    foreach( $projectList as $row){
                    $activities = $row->ProjActivities;
                    ?>
                    <tr>
                        <td><p>{{ $i }}</p>

                        <td><p>{{ $row->title }} </p>


                        <?php
                        $j = 1;
                        foreach($activities as $act):
                        ?>

                        <td>{{ $j }}</td>
                        <td>{{ $act->description }}</td>
                        <td>{{ $act->unit }}</td>
                        <td>{{ $act->quantity }}</td>
                        <td>{{ $act->total_budget }}</td>
                        <td > -</td>

                        <?php
                        $j++; endforeach;
                        ?>

                    </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
            </div><!--Ends-->


            <div class="grid_pagination">
                <ul class="ftr_sort">
                    <li>
                        Showing <strong>10</strong> of 29
                    </li>
                    <li>|</li>
                    <li><span>Show</span><span>
                            <select>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </span></li>
                </ul>
                <ul>
                    <li><a href="#">Prev</a></li>
                    <li><a href="#" class="active_page">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </div>
    </div>


    </section>
    <!--Table Grid Ends-->


    <div class="copyright">
        BRUM-NS 2.0 | 2016 © Brum Info Tech.
    </div>


    </div>
@stop

