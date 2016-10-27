@extends('org')
@section('content')
    <div class="site_body">
        <div class="section_hdr clearfix">
            <h1 class="site_page_title">Projects</h1>

            <!--<span class="section_hdr_btns_wrp"><a href="#" class="btn btn_green">Add new</a></span>-->

        </div>
        <!--Page Title-->

        <!--Add Forms View-->
        <section class="site_form_kit">

            <h2 class="formTitle">Add New Project</h2>
            <p class="formTitleDecp">Please fill up the form below</p>


            <div class="form_wrapp">
                <?php
                $alert = Session::get('alert');
                if($alert){
                ?>
                <div class="alert <?php echo $alert['class']; ?>"><?php echo $alert['msg']; Session::put('alert' , ''); ?></div>
                <?php } ?>
                {!! Form::open(['url'=>URL::route('updateOrgProject' , array( $project->id) ) , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal validate-form']) !!}
                <div class="col_5 clearfix">
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Project Name</label>
                        </div>
                        <div class="col_6">
                            {!! Form::text( 'title' , $project->title  , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                        </div>

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Organisation</label>
                        </div>
                        <div class="col_6">
                            <select name="sector" class="form-control m-b-sm req">
                                <option value="">Select</option>
                                @foreach($sectorList as $row)
                                    <?php if ($row->parent_id > 0): continue; endif;?>
                                    <option disabled value="{{$row->id}}"><strong>{{$row->name}}</strong></option>

                                    @foreach($sectorList as $child)
                                        @if($child->parent_id == $row->id)
                                            <?php $selected = $child->id == $project->area ? 'selected': '';?>
                                            <option {{$selected}} value="{{$child->id}}">
                                                &nbsp;&nbsp;&nbsp;&nbsp;{{$child->name}}</option>
                                        @endif
                                    @endforeach

                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Working Zone</label>
                        </div>
                        <div class="col_6">
                            <?php
                            $wzone = array ();
                            $wzone = $project->working_zone;
                            $wzones = explode(',' , $wzone);
                            ?>

                            @foreach($zoneList as $row)
                                <?php
                                $checked = in_array($row->id , $wzones) ? 'checked': '';
                                ?>

                                <p><input type="checkbox" {{ $checked }} value="{{ $row->id }}"
                                          name="working_zone[]"
                                          style="width:30%"> <span
                                            style="text-align:left;">{{ $row->name }}</span></p>

                            @endforeach
                        </div>

                    </div>


                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Line Office</label>
                        </div>

                        <?php
                        $lineOffices = array ();
                        $lineOffice = $project->line_office;
                        $lineOffices = explode(',' , $lineOffice);
                        ?>
                        <label>&nbsp;</label>
                        @foreach($lineList as $row)






                            <?php
                            $checked = in_array($row->id , $lineOffices) ? 'checked': '';
                            ?>
                            <div class="col_5">
                            <span class="col_2"><input type="checkbox" value="{{ $row->id }}" name="line_office[]"
                                        {{ $checked }} > </span>
                            <span class="col_8">
                                        {{ $row->name }}</span>
                            </div>
                        @endforeach

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Fiscal Year AD</label>
                        </div>
                        <div class="col_6">

                            <select name="fiscal_year_ad" class="form-control m-b-sm req" required>
                                <option value="">Select</option>
                                <option <?php echo $project->fiscal_year_ad == '2014/15' ? 'selected': ''; ?>value="2014/15">
                                    2014/15
                                </option>
                                <option <?php echo $project->fiscal_year_ad == '2015/16' ? 'selected': ''; ?> value="2015/16">
                                    2015/16
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Fiscal Year BS</label>
                        </div>
                        <div class="col_6">
                            <select name="fiscal_year_bs" class="form-control m-b-sm req" required>
                                <option value="">Select</option>
                                <option <?php echo $project->fiscal_year_ad == '2071/72' ? 'selected': ''; ?>value="2071/72">
                                    2071/72
                                </option>
                                <option <?php echo $project->fiscal_year_ad == '2072/73' ? 'selected': ''; ?> value="2072/73">
                                    2072/73
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Start Date</label>
                        </div>
                        <div class="col_6">
                            {!! Form::text( 'start_date' , $project->start_date , ['class' => 'form-control popcorn' ]) !!}
                        </div>
                    </div>

                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>End Date</label>
                        </div>
                        <div class="col_6">
                            {!! Form::text( 'end_date' , $project->end_date , ['class' => 'form-control popcorn' ]) !!}
                        </div>
                    </div>
                </div>
                <div class="col_5 clearfix">

                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Budget (Currency )</label>
                        </div>
                        <div class="col_6">

                            <select name="currency">
                                <option {{ $project->currency == 'NPR' ?'selected':'' }}>NPR</option>
                                <option {{ $project->currency == 'USD' ?'selected':'' }}>USD</option>
                                <option {{ $project->currency == 'EUR' ?'selected':'' }}>EUR</option>
                                <option {{ $project->currency == 'CAD' ?'selected':'' }}>CAD</option>
                                <option {{ $project->currency == 'GBP' ?'selected':'' }}>GBP</option>

                            </select>
                        </div>
                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Budget (Amount )</label>
                        </div>
                        <div class="col_6">

                            {!! Form::text( 'budget' , $project->budget , ['class' => 'form-control' ]) !!}
                        </div>
                    </div>

                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Budget ( RS )</label>
                        </div>
                        <div class="col_6">

                            {!! Form::text( 'budget_rs' , $project->budget_rs , ['class' => 'form-control' ]) !!}
                        </div>

                        <div class="field_set clearfix">
                            <div class="col_4">
                                <label>Targeted Group</label>
                            </div>
                            <div class="col_6">
                                {!! Form::text( 'targeted_group' , $project->targeted_group , ['class' => 'form-control' ]) !!}
                            </div>
                        </div>
                        <div class="field_set clearfix">
                            <div class="col_4">
                                <label>Activities</label>
                            </div>
                            <div class="col_6">
                                <div class="obj-row">
                                    <?php
                                    if( isset($activitiesList) && !empty($activitiesList) && count($activitiesList) > 0 ){
                                    $i = 0;
                                    $remove = 'style=display:none;';
                                    foreach( $activitiesList as $row):
                                    if ($i > 0) {
                                        $remove = '';
                                    }


                                    ?>
                                    <div class="obj-row">
                                        <br>
                                        {!! Form::text( 'act[description][]' , $row->description , ['class' => 'full-width', 'placeholder' => 'Descritpion']) !!}
                                        {!! Form::text( 'act[unit][]' , $row->unit , ['class' => 'form-control', 'placeholder' => 'Unit']) !!}
                                        {!! Form::text( 'act[quantity][]' , $row->quantity , ['class' => 'form-control', 'placeholder' => 'Quantity']) !!}
                                        {!! Form::text( 'act[duration][]' , $row->duration , ['class' => 'form-control', 'placeholder' => 'Duration']) !!}
                                        {!! Form::select( 'act[period][]' , array('Day' => 'Day' , 'Month' => 'Month' , 'Year' => 'Year') , $row->period , ['class' => 'form-control small']) !!}
                                        {!! Form::text( 'act[unit_cost][]' , $row->unit_cost , ['class' => 'form-control', 'placeholder' => 'Unit Cost']) !!}
                                        {!! Form::text( 'act[total_budget][]' , $row->total_budget , ['class' => 'form-control', 'placeholder' => 'Total Budget']) !!}
                                        {!! Form::text( 'act[phase][]' , $row->phase , ['class' => 'form-control', 'placeholder' => 'Phase']) !!}

                                        <a href="javascript:void(0);"
                                           {{$remove}} class="remove-objective app_btn btn_red remove_btn"><i
                                                    class="icon-remove"></i></a>
                                    </div>
                                    <?php
                                    $i++;
                                    endforeach ;
                                    }else{

                                    ?>

                                    <div class="obj-row">
                                        <br>
                                        {!! Form::text( 'act[description][]' , '' , ['class' => 'full-width', 'placeholder' => 'Descritpion']) !!}
                                        {!! Form::text( 'act[unit][]' , '' , ['class' => 'form-control', 'placeholder' => 'Unit']) !!}
                                        {!! Form::text( 'act[quantity][]' , '' , ['class' => 'form-control', 'placeholder' => 'Quantity']) !!}
                                        {!! Form::text( 'act[duration][]' , '' , ['class' => 'form-control', 'placeholder' => 'Duration']) !!}
                                        {!! Form::select( 'act[period][]' , array('Day' => 'Day' , 'Month' => 'Month' , 'Year' => 'Year') , '' , ['class' => 'form-control small']) !!}

                                        {!! Form::text( 'act[unit_cost][]' , '' , ['class' => 'form-control', 'placeholder' => 'Unit Cost']) !!}
                                        {!! Form::select( 'act[acceptor_id][]', $orgListActivities ,NULL, ['class' => 'form-control small']) !!}
                                        {!! Form::text( 'act[total_budget][]' , '' , ['class' => 'form-control', 'placeholder' => 'Total Budget']) !!}
                                        {!! Form::text( 'act[phase][]' , '' , ['class' => 'form-control', 'placeholder' => 'Phase']) !!}

                                        <a href="javascript:void(0);" style="display:none;"
                                           class="remove-objective app_btn btn_red remove_btn"><i
                                                    class="icon-remove"></i></a>
                                    </div>

                                    <?php  } ?>


                                </div>
                                <a href="" class="add-objective app_btn btn_green">Add More</a>
                            </div>

                            <div class="field_set clearfix">
                                <div class="col_4">
                                    <label>Objectives</label>
                                </div>
                                <div class="col_6">
                                    {!! Form::textarea( 'objectives' , $project->objectives , ['class' => 'form-control']) !!}
                                </div>

                            </div>
                            <div class="field_set clearfix">
                                <div class="col_4">
                                    <label>Remark</label>
                                </div>
                                <div class="col_6">

                                    {!! Form::textarea( 'remark' , $project->remark , ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="field_set clearfix">
                                <div class="col_4">
                                    <label>Status</label>
                                </div>
                                <div class="col_6">

                                    @if( $project->status == 'Proposed')
                                        {!! Form::select( 'status' , array('Proposed'=>'Proposed') , $project->status , ['class' => 'form-control m-b-sm']) !!}
                                    @else
                                        {!! Form::select( 'status' , array('Approved'=>'Approved','Running' => 'Running' ,'Completed' => 'Completed' , 'Unknown' => 'Unknown') , $project->status , ['class' => 'form-control m-b-sm']) !!}
                                    @endif

                                </div>
                            </div>
                            <div class="field_set clearfix">
                                <div class="col_4">
                                    &nbsp;
                                </div>
                                <div class="col_6 action_btns">

                                    <button class="btn btn_green">
                                        <i class="fa fa-check" aria-hidden="true"></i> Save
                                    </button>

                                    <a href="{{url('/organization/projects/new')}}" class="btn btn_red">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                        Cancel
                                    </a>

                                </div>

                            </div>

                        </div>
                    </div>


                </div>

                <div class="clear"></div>

                {!! Form::close() !!}
            </div>

        </section>


        <div class="copyright">
            BRUM-NS 2.0 | 2016 © Brum Info Tech.
        </div>


    </div>

@stop


         
        
