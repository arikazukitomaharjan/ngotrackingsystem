@extends('administrator')
@section('content')
    <div class="site_body">
        <section class="site_list_view">

            <div class="section_hdr clearfix">
                <h1 class="site_page_title">Users</h1>

                <span class="section_hdr_btns_wrp"><a href="{{ URL::route('createUser') }}"
                                                      class="btn btn_green">Create User</a></span>
            </div>
            <section class="site_form_kit">

                <h2 class="formTitle">Add New Sector</h2>
                <p class="formTitleDecp">Please fill up the form below</p>

                <div class="form_wrapp">
                <?php
                $alert = Session::get('alert');
                if($alert){
                ?>
                <div class="alert <?php echo $alert['class']; ?>"><?php echo $alert['msg']; Session::put('alert' , ''); ?></div>
                <?php } ?>
                {!! Form::open(['url'=>URL::route('storeUser') , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal']) !!}
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>First Name</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'first_name' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                    </div>
                    <div class="form_error_msg">*This is required field</div>
                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Last Name</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'last_name' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                    </div>
                    <div class="form_error_msg">*This is required field</div>
                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Email</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'email' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                    </div>
                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Password</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'password' , '' , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                    </div>
                    <div class="form_error_msg">*This is required field</div>
                </div>

                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>District</label>
                    </div>
                    <div class="col_4">
                        {!! Form::select( 'district' , $districts , '' , ['class' => 'form-control m-b-sm']) !!}
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


         
        
