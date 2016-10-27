@extends('admin')
@section('content')

    <div class="site_body">
        <div class="section_hdr clearfix">
            <h1 class="site_page_title">Organization</h1>

            <!--<span class="section_hdr_btns_wrp"><a href="#" class="btn btn_green">Add new</a></span>-->

        </div>
        <!--Page Title-->

        <!--Add Forms View-->
        <section class="site_form_kit">

            <h2 class="formTitle">Add New Organization</h2>
            <p class="formTitleDecp">Please fill up the form below</p>


            <div class="form_wrapp">

                <!--//////////////////////////////////////////////////////////////////-->
                <?php
                $alert = Session::get('alert');
                if($alert){
                ?>
                <div class="alert <?php echo $alert['class']; ?>"><?php echo $alert['msg']; Session::put('alert', ''); ?></div>
                <?php } ?>
                {!! Form::open(['url'=>$formAction , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal']) !!}
                {{--<div class="field_set clearfix">
                    <div class="col_4">
                        <label>District</label>
                    </div>
                    <div class="col_4">


                        <select name="working_zone" class="form-control m-b-sm req" id="district" required>
                            <option value="district">Select</option>
                            @foreach($districtList as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>


                    </div>

                </div>--}}
                <div class="section_line">
                    <h2><span>General Information</span></h2>
                </div>


                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Name</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'name' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                    </div>
                    <div class="form_error_msg">*This is required field</div>
                </div>


                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Contact Email</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'contact_email' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                    </div>
                    <div class="form_error_msg">*This is required field</div>
                </div>


                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Password</label>
                    </div>
                    <div class="col_4">
                        {!! Form::password( 'password' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                    </div>

                </div>

                <!--//////////////////////////////////////////////////////////////////-->

                <div class="section_line">
                    <h2><span>Detail Information</span></h2>
                </div>


                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Introduction</label>
                    </div>
                    <div class="col_4">
                        {!! Form::textarea( 'introduction' , '' , ['class' => 'form-control' ]) !!}
                    </div>

                </div>


                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Address</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'address' , '' , ['class' => 'form-control' ]) !!}

                    </div>

                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Contact Person</label>
                    </div>
                    <div class="col_4">

                        {!! Form::text( 'contact_person' , '' , ['class' => 'form-control'  ]) !!}
                    </div>

                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Contact No.</label>
                    </div>
                    <div class="col_4">

                        {!! Form::text( 'contact_no' , '' , ['class' => 'form-control'  ]) !!}
                    </div>

                </div>


                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Objectives</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'objectives' , '' , ['class' => 'form-control' ]) !!}
                    </div>

                </div>


                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Reg District</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'reg_district' , '' , ['class' => 'form-control']) !!}
                    </div>

                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Reg No.</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'reg_no' , '' , ['class' => 'form-control']) !!}
                    </div>

                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Reg Date.</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'reg_date' , '' , ['class' => 'form-control popcorn'  ]) !!}
                    </div>

                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Pan No.</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'pan_no' , '' , ['class' => 'form-control' ]) !!}
                    </div>

                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>PAN Reg. Date</label>
                    </div>
                    <div class="col_4">

                        {!! Form::text( 'pan_reg_date' , '' , ['class' => 'form-control popcorn'  ]) !!}
                    </div>

                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Affiliation No.</label>
                    </div>
                    <div class="col_4">

                        {!! Form::text( 'affiliation_no' , '' , ['class' => 'form-control'  ]) !!}
                    </div>

                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Last Renewel</label>
                    </div>
                    <div class="col_4">

                        {!! Form::text( 'last_renewal' , '' , ['class' => 'form-control popcorn' ]) !!}
                    </div>

                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Last Audit</label>
                    </div>
                    <div class="col_4">


                        {!! Form::text( 'last_audit' , '' , ['class' => 'form-control'  ]) !!}
                    </div>

                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Assets</label>
                    </div>
                    <div class="col_4">


                        {!! Form::text( 'assets' , '' , ['class' => 'form-control' ]) !!}
                    </div>

                </div>


                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Status</label>
                    </div>
                    <div class="col_4">
                        {!! Form::select( 'status' , array( 'Approved' => 'Approved' , 'Pending' => 'Pending' ) , '' , ['class' => 'form-control m-b-sm']) !!}
                    </div>

                </div>


                <div class="field_set clearfix">
                    <div class="col_4">
                        &nbsp;
                    </div>
                    <div class="col_4 action_btns">

                        <button class="btn btn_green">
                            <i class="fa fa-check" aria-hidden="true"></i> Save
                        </button>

                        <a href="{{url('/organizations/create')}}" class="btn btn_red">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Cancel
                        </a>

                    </div>

                </div>


            </div>

        </section>
        <div class="copyright">
            BRUM-NS 2.0 | 2016 © Brum Info Tech.
        </div>

    </div>

    <script>
        $(document).ready(function () {

            $(function () {
                $('.popcorn').datepicker({
                    dateFormat: "yy-mm-dd",
                    'changeYear': true,
                    'changeMonth': true,
                    yearRange: "-100:+0",
                });
            });
        });
    </script>
@stop


         
        
