<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>NMIS2.1 - Brum Info Tech</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    {!! Html::style( 'resources/assets/fonts/font-awesome.css' ) !!}

    {!! Html::style( 'resources/assets/css/normalize.css' ) !!}

    {!! Html::style( 'resources/assets/css/custom.css' ) !!}
    {!! Html::style( 'resources/assets/css/style.css' ) !!}


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
            {{ Lang::get('global.rasuwa') }}

        </div>




    <div class="main_nav col_7">
        <nav>
            <ul>
                <li>
                    <a href="{{url('/dashboard')}}">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                <li class="has_drop_child">
                    <a href="#">
                        <i class="fa fa-building-o" aria-hidden="true"></i>
                        <span>Organization</span>
                    </a>

                    <ul class="drop_Down_menu">
                        <li class=""><a href="<?php echo url('/organizations');?>">All Organizations</a></li>
                        <li class=""><a href="<?php echo url('/organizations/requests');?>">Requests</a></li>
                        <li class=""><a href="<?php echo url('/organizations/budget');?>">Budget</a></li>
                        <li class=""><a href="<?php echo url('/organizations/create');?>">Add New</a></li>

                    </ul>

                </li>

                <li class="has_drop_child">
                    <a href="#">
                        <i class="fa fa-sellsy" aria-hidden="true"></i>
                        <span>Sector</span>
                    </a>

                    <ul class="drop_Down_menu">
                        <li class=""><a href="<?php echo url('/sectors');?>">All Sectors</a></li>
                        <li class=""><a href="<?php echo url('/sectors/budget');?>">Budget</a></li>
                        <li class=""><a href="<?php echo url('/sectors/create');?>">Add New</a></li>

                    </ul>
                </li>
                <li class="has_drop_child">
                    <a href="#">
                        <i class="fa fa-sellsy" aria-hidden="true"></i>
                        <span>Working Zones</span>
                    </a>

                    <ul class="drop_Down_menu">
                        <li class=""><a href="<?php echo url('/working-zones');?>">All Working Zones</a></li>
                        <li class=""><a href="<?php echo url('/working-zones/budget');?>">Budget</a></li>
                        <li class=""><a href="<?php echo url('/working-zones/create');?>">Add New</a></li>

                    </ul>
                </li>
                <li class="has_drop_child">
                    <a href="#">
                        <i class="fa fa-sellsy" aria-hidden="true"></i>
                        <span>Line Offices</span>
                    </a>

                    <ul class="drop_Down_menu">
                        <li class=""><a href="<?php echo url('/line-offices');?>">All Line Offices</a></li>
                        <li class=""><a href="<?php echo url('/line-offices/create');?>">Add New</a></li>

                    </ul>
                </li>
                <li class="has_drop_child">
                    <a href="#">
                        <i class="fa fa-sellsy" aria-hidden="true"></i>
                        <span>Projects</span>
                    </a>

                    <ul class="drop_Down_menu">
                        <li><a href="<?php echo url('/projects/');?>">All Projects</a></li>
                        <li><a href="<?php echo url('/projects/Proposed/');?>">Proposed</a></li>
                        <li><a href="<?php echo url('/projects/Approved/');?>">Approved</a></li>
                        <li><a href="<?php echo url('/projects/Running/');?>">Running</a></li>
                        <li><a href="<?php echo url('/projects/completed');?>">Completed</a></li>
                        <li><a href="<?php echo url('/projects/Unknown');?>">Not Known</a></li>
                        <li><a href="<?php echo url('/projects/new');?>">Add New</a></li>
                    </ul>
                </li>


                <li>
                    <a href="{{url('/report')}}">
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                        <span>Report</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('/about')}}">
                        <i class="fa fa-cube" aria-hidden="true"></i>
                        <span>About</span>
                    </a>
                </li>

            </ul>
        </nav>

        <!--Search top-->
        <div class="module_search">

            <div>
                <input type="text" placeholder="search">
            </div>

            <div>
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>

        </div>


    </div>


</header>
<div class="site_body">
    <div class="section_hdr clearfix">
        <h1 class="site_page_title">About US</h1>

        <!--<span class="section_hdr_btns_wrp"><a href="#" class="btn btn_green">Add new</a></span>-->

    </div>
    <!--Page Title-->

    <!--Add Forms View-->
    <section class="site_form_kit">



    <!--Left Part-->
    <div class="app_left_part">

        <div class="app_logo_holder">
            <img src="{{url('resources/assets/images/logo.jpg')}}">
            <br>
        </div>
        <?php
        $user = Auth::user();
        ?>

        </section>
    <div class="copyright">
        BRUM-NS 2.0 | 2016 © Brum Info Tech.
    </div>

</div>
    <!--Ends-->
    <!--==================================================================================================-->


<!--==================================================================================================-->
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
        });
    </script>


    </div><!--App Right Part Ends-->


</section><!--section ends-->
</body>
</html>
