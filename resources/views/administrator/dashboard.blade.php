@extends('administrator')
@section('content')

    <div class="site_body">
        <h1 class="site_page_title">Districts</h1>
        <div class="section_hdr clearfix">

            <section class="site_form_kit">
                <h2>Projects By District</h2>

                <?php foreach( $districts as $vd ):?>
                <div class="district">
                    <a href="{!! url('/administrator/projectByDistrict/'.$vd->id) !!}">{{ $vd->name }}({{ $wz->countProjectByDistrict( $vd->id ) }})</a>
                </div>
                <?php endforeach; ?>

            </section>
            <section class="site_form_kit">
                <h2>Budget By District</h2>

                <?php foreach( $districts as $vd ):?>
                <div class="district">
                    <a href="#">{{ $vd->name }} <br/> Rs. {{ $wz->getBudgetByDistrict( $vd->id ) }}</a>
                </div>
                <?php endforeach; ?>

            </section>


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
                        @foreach($districts as $vd)

                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{$vd->name}}</td>

                                <td>{{ $wz->countOrganisationByDistrict($vd->id ) }}</td>
                                <td>{{ $wz->countProjectByDistrict( $vd->id ) }}</td>
                                <td>{{ $wz->getBudgetByDistrict( $vd->id ) }}</td>
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
            <!--<span class="section_hdr_btns_wrp"><a href="#" class="btn btn_green">Add new</a></span>-->

        </div>


    </div>

@stop



         