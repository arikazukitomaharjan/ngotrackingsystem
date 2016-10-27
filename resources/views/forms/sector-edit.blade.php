@extends('admin')
@section('content')
    <div class="site_body">
        <div class="section_hdr clearfix">
            <h1 class="site_page_title">Sector</h1>

            <!--<span class="section_hdr_btns_wrp"><a href="#" class="btn btn_green">Add new</a></span>-->

        </div>
        <!--Page Title-->

        <!--Add Forms View-->
        <section class="site_form_kit">

            <h2 class="formTitle">{{ $title }}</h2>
            <div class="form_wrapp">
                <?php
                $alert = Session::get('alert');
                if($alert){
                ?>
                <div class="alert <?php echo $alert['class']; ?>"><?php echo $alert['msg']; Session::put('alert' , ''); ?></div>
                <?php } ?>

                {!! Form::open(['url'=>$formAction , 'enctype' => "multipart/form-data" , 'class' => 'form-horizontal']) !!}
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label>Main Sector</label>
                    </div>
                    <div class="col_4">
                        {!! Form::select( 'parent_id' , $options , $record->parent_id , ['class' => 'form-control m-b-sm']) !!}
                    </div>

                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label> Sector Name</label>
                    </div>
                    <div class="col_4">
                        {!! Form::text( 'name' , $record->name  , ['class' => 'form-control' , 'required' => 'required' ]) !!}
                    </div>

                </div>
                <div class="field_set clearfix">
                    <div class="col_4">
                        <label> Status</label>
                    </div>
                    <div class="col_4">
                        {!! Form::select( 'status' , array( 'Published' => 'Published' , 'Draft' => 'Draft' ) , $record->status , ['class' => 'form-control m-b-sm']) !!}
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

                        <a href="{{url('/sectors')}}" class="btn btn_red">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Cancel
                        </a>

                    </div>

                </div>

                {!! Form::close() !!}
            </div>


        </section>
        <!--Table Grid Ends-->


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

            $('.add-objective').click(function (e) {
                e.preventDefault();
                var closeObj = $('.obj-row').clone();
                closeObj.find('input').val('');
                closeObj.find('.remove-objective').show();
                $(closeObj).insertBefore($('.add-objective'));
            });

            $(document).on('click', '.remove-objective', function () {

                $(this).closest('.obj-row').remove();
            });
        });
    </script>
@stop


         
        
