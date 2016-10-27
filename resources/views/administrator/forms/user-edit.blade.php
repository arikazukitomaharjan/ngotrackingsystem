@extends('administrator')
@section('content')
    <div class="site_body">
        <div class="section_hdr clearfix">
            <h1 class="site_page_title">User</h1>

        </div>
        <!--Page Title-->

        <!--Add Forms View-->
        <section class="site_form_kit">

            <h2 class="formTitle">Edit</h2>
            <p class="formTitleDecp">Please fill up the form below</p>


            <div class="form_wrapp">

                {!! Form::open(['url'=>url('/administrator/user/update/'.$user->id) , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal']) !!}
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>First Name</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'first_name' , $user->first_name , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                    </div>
                    <div class="form_error_msg">*This is required field</div>
                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Last Name</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'last_name' , $user->last_name , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                    </div>
                    <div class="form_error_msg">*This is required field</div>
                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Email</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'email' ,  $user->email , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                    </div>
                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Password</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'password' , '' , ['class' => 'form-control'  ]) !!}
                    </div>
                    <div class="form_error_msg">*This is required field</div>
                </div>

                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>District</label>
                    </div>
                    <div class="col_4">
                        {!! Form::select( 'district' ,$districts , $user->working_zone  , ['class' => 'form-control m-b-sm']) !!}
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


                    </div>

                </div>
            </div>

        </section>
        <div class="copyright">
            BRUM-NS 2.0 | 2016 © Brum Info Tech.
        </div>


        <script>
            $(document).ready(function () {

                $(function () {
                    $('.popcorn').datepicker({
                        dateFormat: "yy-mm-dd"
                    });
                });

            });
        </script>
@stop


         
        
