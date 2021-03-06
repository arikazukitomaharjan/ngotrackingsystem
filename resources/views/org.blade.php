<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>NMIS2.0 - Brum Info Tech</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        {!! Html::style( 'resources/assets/fonts/css/font-awesome.css' ) !!}

        {!! Html::style( 'resources/assets/css/normalize.css' ) !!}

        {!! Html::style( 'resources/assets/css/custom.css' ) !!}
        {!! Html::style( 'resources/assets/css/style.css' ) !!}
        {!! Html::style( 'resources/assets/styles/jquery-ui.css' ) !!}

        {!! Html::script( 'resources/assets/js/modernizr-2.8.3.min.js' ) !!}


        </head>


        <!--body Start-->
<body>

<header>

    <div class="top_row clearfix">
        <div class="col_3 padding-L-0">Hi !, welcome</div>

        <div class="col_7 text_algn_R padding-R-0">

            <span class="log_out">
               <a href="{{ url('/logout') }}"> <i class="icon-power-off"></i></a>
            </span>
                <span class="language_opt">
                    Lang:<a href="{{ url('/switch-lang/np') }}">Nep</a><a href="{{ url('/switch-lang/en') }}">Eng</a>
                </span>

            <a href="{{ url('/logout') }}" class="btn btn_yellow logoutBtn">Logout</a>

        </div>
    </div>

    <div class="main_menu_row clearfix">


        <div class="col_1_5 logo_img">
            <img src="{{url('resources/assets/images/logo.jpg')}}">
        </div>

        <div class="col_1_5 main_logo">
            {{ Lang::get('global.goverment') }}<br>


            <span class="bigltr">{{ Lang::get('global.ddc') }}</span><br>
            {!! Lang::get('global'.'.'. $cDistrict) !!}
            {{--{{ Lang::get('global'. $cdistrict) }}--}}

        </div>

        <div class="main_nav col_7">
            <nav>
                <ul>
                    <li>
                        <a href="{{url('/organization/'.Auth::User()->username)}}">
                            <i class="fa fa-desktop" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="has_drop_child">
                        <a href="#">
                            <i class="fa fa-sellsy" aria-hidden="true"></i>
                            <span>Projects</span>
                        </a>

                        <ul class="drop_Down_menu">
                            <li><a href="<?php echo url('/organization/project/');?>">All Projects</a></li>
                            <li><a href="<?php echo url('/organization/project/Proposed/');?>">Proposed</a></li>
                            <li><a href="<?php echo url('/organization/project/Approved/');?>">Approved</a></li>
                            <li><a href="<?php echo url('/organization/project/Running/');?>">Running</a></li>
                            <li><a href="<?php echo url('/organization/project/completed');?>">Completed</a></li>
                            <li><a href="<?php echo url('/organization/project/Unknown');?>">Not Known</a></li>
                            <li><a href="<?php echo url('/organization/project/create');?>">Add New</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{url('/organization/about')}}">
                            <i class="fa fa-cube" aria-hidden="true"></i>
                            <span>About</span>
                        </a>
                    </li>

                </ul>
            </nav>
            <!--Search top-->
            <div class="module_search">

                <div>
                    <form class="search-form" action="{{ url('/projects') }}" method="get"> <input id="q" name="q" type="text" value="<?php if(isset($searchKey)) echo $searchKey;?>" placeholder="Search Project"> </form>
                </div>

                <div>
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>

            </div>


        </div>
    </div>

</header>
<!--Header ends -->

<!--==================================================================================================-->
@yield('content')

<!--==================================================================================================-->
{!! Html::script( 'resources/assets/js/jquery.js' ) !!}
{!! Html::script( 'resources/assets/js/jquery-ui.js' ) !!}
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>

{{--<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>--}}
{{--{!! Html::script( 'resources/assets/js/jquery-ui.js' ) !!}--}}
{!! Html::script( 'resources/assets/js/plugins.js' ) !!}
{!! Html::script( 'resources/assets/js/main.js' ) !!}
<script>
    $('.icon-search-find').click(function () {
        var query = $('#q').val();
        if (query != null && query != '') {
            $('.search-form').submit();
        }

    });

    $(document).ready(function () {

        $('.has_child').click(function () {

            $(this).find('.submenu').slideToggle(300);

        });
        $(function () {
            $('.popcorn').datepicker({
                dateFormat: "yy-mm-dd",
                'changeYear': true,
                'changeMonth': true,
                'minDate': '2014-01-01'
            });
        });

        $('.add-objective').click(function (e) {
            e.preventDefault();
            var closeObj = $('.obj-row:eq(0)').clone();
            closeObj.find('input').val('');
            closeObj.find('.remove-objective').show();
            $(closeObj).insertBefore($('.add-objective'));
        });

        $(document).on('click', '.remove-objective', function () {

            $(this).closest('.obj-row').remove();

        });
        $(function () {
            $('#select_fiscal_year').change(function () {
                var id = $(this).find('option:selected').val();
                $('#hide_this').hide();
                window.location.href = "http://localhost/ngo/organization/project/fiscal_year_bs/" + id;


                /*
                 $.ajax({

                 url: url,
                 method: "GET",

                 success(result){
                 $(html).html(result);
                 }
                 });*/
            });
        });

    });

</script>


</div><!--App Right Part Ends-->


</section><!--section ends-->
</body>
</html>