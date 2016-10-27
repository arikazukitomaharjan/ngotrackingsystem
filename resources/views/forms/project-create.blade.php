@extends('admin')
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
                {!! Form::open(['url'=>URL::route('storeProject') , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal validate-form']) !!}
                <div class="col_5 clearfix">
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Project Name</label>
                        </div>
                        <div class="col_6">
                            {!! Form::text( 'title' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                        </div>

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Organisation</label>
                        </div>
                        <div class="col_6">
                            <select name="organization" class="form-control m-b-sm req" required>
                                <option value="organization">Select</option>
                                @foreach($orgList as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Sector</label>
                        </div>
                        <div class="col_6">
                            <select name="sector" class="form-control m-b-sm req" required>
                                <option value="">Select</option>
                                @foreach($sectorList as $row)
                                    <?php if ($row->parent_id > 0): continue; endif; ?>
                                    <option disabled value="{{$row->id}}"><strong>{{$row->name}}</strong></option>

                                    @foreach($sectorList as $child)
                                        @if($child->parent_id == $row->id)
                                            <option value="{{ $child->id }}">
                                                &nbsp;&nbsp;&nbsp;&nbsp;{{ $child->name }}</option>
                                        @endif
                                    @endforeach

                                @endforeach
                            </select>
                        </div>

                    </div>
                    {{--<div class="field_set clearfix ">
                        <div class="col_4">
                            <label>District</label>
                        </div>
                        <div class="col_4">


                            <select name="district" class="form-control m-b-sm req" id="district" required>
                                <option value="district">Select</option>
                                @foreach($districtList as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>


                        </div>

                    </div>--}}
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Working Zone</label>
                        </div>
                        <div class="col_6" id="workingZone">

                            @foreach($zoneList as $row)

                                <p><input type="checkbox" value="{{ $row->id }}" name="working_zone[]"
                                          style="width:30%">
                                    <span style="text-align:left;">{{ $row->name }}</span></p>

                            @endforeach
                        </div>

                    </div>

                    <div class="field_set clearfix li-of">

                        <label style="text-align:center;">Line Office</label>


                        @foreach($lineList as $row)
                            <div class="col_5">
                                <span class="col_2"><input type="checkbox" value="{{ $row->id }}" name="line_office[]"></span>
                                <span class="col_8">{{ $row->name }}</span>
                            </div>
                        @endforeach


                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Fiscal Year (AD)</label>
                        </div>
                        <div class="col_6">
                            {!! Form::text( 'fiscal_year_ad' , '' , ['class' => 'form-control' ]) !!}
                        </div>

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Fiscal Year (BS)</label>
                        </div>
                        <div class="col_6">
                            {!! Form::text( 'fiscal_year_bs' , '' , ['class' => 'form-control' ]) !!}
                        </div>

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Start Date</label>
                        </div>
                        <div class="col_6">
                            {!! Form::text( 'start_date' , '' , ['class' => 'form-control popcorn' ]) !!}
                        </div>

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>End Date</label>
                        </div>
                        <div class="col_6">
                            {!! Form::text( 'end_date' , '' , ['class' => 'form-control popcorn' ]) !!}
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
                                <option>NPR</option>
                                <option>USD</option>
                                <option>EUR</option>
                                <option>CAD</option>
                                <option>GBP</option>
                            </select>
                        </div>

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Budget (Amount )</label>
                        </div>
                        <div class="col_6">


                            {!! Form::text( 'budget' , '' , ['class' => 'form-control' ]) !!}
                        </div>

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Budget ( RS )</label>
                        </div>
                        <div class="col_6">

                            {!! Form::text( 'budget_rs' , '' , ['class' => 'form-control' ]) !!}
                        </div>

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Targeted Group</label>
                        </div>
                        <div class="col_6">

                            {!! Form::text( 'targeted_group' , '' , ['class' => 'form-control' ]) !!}
                        </div>

                    </div>

                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Activities</label>
                        </div>
                        <div class="col_6">

                            <div class="obj-row">
                                <br>
                                {!! Form::text( 'act[description][]' , '' , ['class' => 'full-width', 'placeholder' => 'Descritpion']) !!}
                                {!! Form::text( 'act[unit][]' , '' , ['class' => 'form-control', 'placeholder' => 'Unit']) !!}
                                {!! Form::text( 'act[quantity][]' , '' , ['class' => 'form-control', 'placeholder' => 'Quantity']) !!}
                                {!! Form::text( 'act[duration][]' , '' , ['class' => 'form-control', 'placeholder' => 'Duration']) !!}
                                {!! Form::select( 'act[period][]' , array('Day' => 'Day' , 'Month' => 'Month' , 'Year' => 'Year') , '' , ['class' => 'form-control small']) !!}
                                {!! Form::select( 'act[acceptor_id][]', $orgListActivities ,NULL, ['class' => 'form-control small']) !!}
                                {!! Form::text( 'act[unit_cost][]' , '' , ['class' => 'form-control', 'placeholder' => 'Unit Cost']) !!}
                                {!! Form::text( 'act[total_budget][]' , '' , ['class' => 'form-control', 'placeholder' => 'Total Budget']) !!}
                                {!! Form::text( 'act[phase][]' , '' , ['class' => 'form-control', 'placeholder' => 'Phase']) !!}
                                <br>
                                <a href="javascript:void(0);" style="display:none;"
                                   class="remove-objective btn btn_red remove_btn"><i class="icon-remove"></i></a>

                            </div>


                            <a href="" class="add-objective btn btn_green">Add More</a>
                        </div>

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Objectives</label>
                        </div>
                        <div class="col_6">


                            {!! Form::textarea( 'objectives' , '' , ['class' => 'form-control']) !!}
                        </div>

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Remark</label>
                        </div>
                        <div class="col_6">

                            {!! Form::textarea( 'remark' , '' , ['class' => 'form-control']) !!}
                        </div>

                    </div>
                    <div class="field_set clearfix">
                        <div class="col_4">
                            <label>Status</label>
                        </div>
                        <div class="col_6">


                            {!! Form::select( 'status' , array('Proposed'=>'Proposed', 'Approved'=>'Approved','Running' => 'Running' ,'Completed' => 'Completed' , 'Not Known' => 'Uknown') , '' , ['class' => 'form-control m-b-sm']) !!}

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

                            <a href="{{url('/projects/new')}}" class="btn btn_red">
                                <i class="fa fa-times" aria-hidden="true"></i>
                                Cancel
                            </a>

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




