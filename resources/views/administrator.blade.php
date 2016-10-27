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

    {!! Html::script( 'resources/assets/js/modernizr-2.8.3.min.js' ) !!}</head>


<!--body Start-->
<body>

<header>
    <div class="top_row clearfix">
        <div class="col_3 padding-L-0">Hi !,{!! Auth::User()->first_name !!}</div>

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

        </div>

        <div class="main_nav col_7">
            <nav>
                <ul>
                    <li>
                        <a href="{{url('/administrator/')}}">
                            <i class="fa fa-desktop" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>


                    <li class="has_drop_child">
                        <a href="#">
                            <i class="fa fa-building-o" aria-hidden="true"></i>
                            <span>User</span>
                        </a>

                        <ul class="drop_Down_menu">
                            <li class=""><a href="<?php echo url('/administrator/user/');?>">All Users</a></li>
                            <li class=""><a href="<?php echo url('/administrator/user/create');?>">Add New</a></li>

                        </ul>

                    </li>
                    <li class="has_drop_child">
                        <a href="#">
                            <i class="fa fa-building-o" aria-hidden="true"></i>
                            <span>Organization</span>
                        </a>

                        <ul class="drop_Down_menu">
                            <li class=""><a href="<?php echo url('/administrator/organization');?>">All
                                    Organizations</a></li>

                        </ul>

                    </li>

                    <li class="has_drop_child">
                        <a href="#">
                            <i class="fa fa-sellsy" aria-hidden="true"></i>
                            <span>Projects</span>
                        </a>

                        <ul class="drop_Down_menu">
                            <li><a href="<?php echo url('/administrator/project');?>">All Projects</a></li>


                        </ul>
                    </li>




                </ul>
            </nav>

            <!--Search top-->
            <div class="module_search">

                <div>
                    <form class="search-form" action="{{ url('/administrator/projectSearch') }}" method="get"><input id="q" name="q"
                                                                                                  type="text"
                                                                                                  value="<?php if (isset($searchKey))
                                                                                                      echo $searchKey;?>"
                                                                                                  placeholder="Search Project">
                    </form>
                    {{--<input type="text" placeholder="search">--}}
                </div>

                <div>


                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>

            </div>


        </div>
    </div>

</header>

<!--Ends-->
<!--==================================================================================================-->

@yield('content')


<!--Ends-->
<!--==================================================================================================-->



{!! Html::script( 'resources/assets/js/jquery.js' ) !!}
{!! Html::script( 'resources/assets/js/jquery-ui.js' ) !!}
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>

{{--<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>--}}
{{--{!! Html::script( 'resources/assets/js/jquery-ui.js' ) !!}--}}
{!! Html::script( 'resources/assets/js/plugins.js' ) !!}
{!! Html::script( 'resources/assets/js/main.js' ) !!}
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
        $('#row-view-select').on('change', function () {
            var url = $(this).val(); // get selected value
            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });
    });
</script>


</div><!--App Right Part Ends-->


</section><!--section ends-->
</body>
</html>