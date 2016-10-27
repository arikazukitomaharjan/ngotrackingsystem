@extends('administrator')
@section('content')
<div class="app_right_part">

<div class="content_wrap relative">


<div class="table_list_view">

<h1 class="list_title">All Line Offices<a href="{{ URL::route('createLineOffice') }}" class="app_btn dark_grey_box">Add New</a></h1>

<table border="0" cellpadding="0" cellspacing="0">

<thead class="dark_grey_box">
  <tr>
    <td>S. N.</td>
    <td>Name</td>
    <td>Status</td>
    <td class="actions">Action</td>
  </tr>
</thead>

<tbody>
<?php
  $i = 1;
?>
  @foreach($dataList as $row)
  <?php 
   $loLink          = url('/line-offices/'.$row->id);
   $editLink        = url('/line-offices/edit/'.$row->id);
   $deleteLink      = url('/line-offices/delete/'.$row->id);
  ?>
  <tr>
  <td>{{ $i }}</td>
    <td> <a href="{{$loLink}}"> {{ $row->name }} </a> </td>
    <td> {{ $row->status }} </td>
    <td class="actions">
    <span class="icon_yellow"> <a href="{{$editLink}}"> <i class="icon-pencil"></i> </a> </span>
    <span class="icon_green"> <a href="{{$loLink}}"> <i class="icon-eye"></i> </a></span>
    <span class="icon_red"> <a onclick = "return confirm('Are you sure? You can\'t undo this action.')" href="{{$deleteLink}}"> <i class="icon-trash-bin"></i> </a></span>
    </td>
  </tr>
<?php
  $i++;
?>
 @endforeach

 </tbody>
<tfoot>
  <?php 
        $view = Request::get('view');
        if( !$view ){
          $view = 10;
        }
    ?>
  <tr>
 
     <td colspan="2">{!!  str_replace('/?', '?', $dataList->appends(['view' => $view ])->render()) !!}</td>
    <td colspan="1">showing {{ $dataList->currentPage() }} of {{ $dataList->lastPage() }}</td>
    <td colspan="1" align="right">
    show <span>
        <select id="row-view-select">
        
            <option {{ $view==10?'selected':'' }} value="{{ url('line-offices?view=10') }}">10</option>
            <option {{ $view==25?'selected':'' }} value="{{ url('line-offices?view=25') }}">25</option>
            <option {{ $view==50?'selected':'' }} value="{{ url('line-offices?view=50') }}">50</option>
            <option {{ $view==100?'selected':'' }} value="{{ url('line-offices?view=100') }}">100</option>
        </select>
    </span>
    </td>

  </tr>
 </tfoot> 
</table>
</div>

</div>

@stop


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
        {!! Html::style( 'resources/assets/fonts/font-awesome.css.css' ) !!}

        {!! Html::style( 'resources/assets/styles/normalize.css' ) !!}
        {!! Html::style( 'resources/assets/styles/custom.css' ) !!}
        {!! Html::style( 'resources/assets/styles/style.css' ) !!}
        {!! Html::style( 'resources/assets/styles/jquery-ui.css' ) !!}
        {!! Html::style( 'resources/assets/styles/animation.css' ) !!}
        {!! Html::style( 'resources/assets/fonts/styles.css' ) !!}

        {!! Html::style( 'resources/assets/styles/responsive.css' ) !!}
        {!! Html::script( 'resources/assets/js/modernizr-2.8.3.min.js' ) !!}

    </head>


    <!--body Start-->
    <body>

    <header>
        <div class="top_row clearfix">
            <div class="col_3 padding-L-0">Hi !, welcome</div>
            <div class="col_7 text_algn_R padding-R-0">

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
                            <a href="{{url('/administrator')}}">
                                <i class="fa fa-desktop" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>


                        <li class="has_drop_child">
                            <a href="#">
                                <i class="fa fa-building-o icon-sitemap" aria-hidden="true"></i>
                                <span>Organization</span>
                            </a>

                            <ul class="drop_Down_menu">
                                <li><a href="<?php echo url('/administrator/organization');?>">All Organization</a></li>
                                <li><a href="#">Requests</a></li>
                                <li><a href="#">Add New</a></li>
                            </ul>

                        </li>

                        <li class="has_drop_child">
                            <a href="#">
                                <i class="fa fa-sellsy" aria-hidden="true"></i>
                                <span>Sector</span>
                            </a>

                            <ul class="drop_Down_menu">
                                <li><a href="#">All Sector</a></li>
                                <li><a href="#">Add New</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-object-group" aria-hidden="true"></i>
                                <span>Working Zones</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-building-o" aria-hidden="true"></i>
                                <span>Line Offices</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                <span>Projects</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-line-chart" aria-hidden="true"></i>
                                <span>Report</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
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
        </div>


    </header>

    <div class="app_header_top">
    <span class="logo_slogan">
        {{ Lang::get('global.goverment') }}<br>
        <span>{{ Lang::get('global.ddc') }}</span><br>
        {{ Lang::get('global.rasuwa') }}
        </span>

        <span class="loged_in_status">
            <i class="icon-user"></i>
            <span>Hi !, welcome</span>
        </span>

        <span class="right_infos">
           <!--  <span class="relative"><i  class="icon-bell-two"></i>
               <div class="notification absolute">14</div>
           </span> -->

            <form class="search-form" action="{{ url('/projects') }}" method="get"> <input id="q" name="q" type="text"
                                                                                           value="<?php if (isset($searchKey)) echo $searchKey;?>"
                                                                                           placeholder="Search Project"> </form>
            <span><i class="icon-search-find"></i></span>
            <span class="log_out">
               <a href=""> <i class="icon-power-off"></i></a>
            </span>
        </span>

        </header>
        <!--Header ends -->

        <section id="all_page_wrapper">
            <!--Left Part-->
            <div class="app_left_part">

                <div class="app_logo_holder">
                    <img src="">
                    <br>
                </div>

                <div class="app_left_navigation">
                    <ul>
                        <li class="activeLink">
                            <a href="{{url('/administrator')}}">
                                <i class="icon-screen-desktop"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="has_child">
                            <a href="#">
                                <i class="icon-sitemap"></i>
                                <span>Organization</span>
                            </a>

                            <ul class="submenu">
                                <li class=""><a href=">All
                                    Organizations</a>
                            </li>

                        </ul>
                    </li>

                    <li class="has_child">
                                    <a href="#">
                                        <i class="icon-trello"></i>
                                        <span>Projects</span>
                                    </a>

                                    <ul class="submenu">
                                        <li><a href="<?php echo url('/administrator/project');?>">All Projects</a></li>
                                    </ul>
                                </li>
                                <li class="has_child">
                                    <a href="#">
                                        <i class="icon-trello"></i>
                                        <span>Users</span>
                                    </a>

                                    <ul class="submenu">
                                        <li><a href="<?php echo url('/administrator/user/');?>">All Users</a></li>
                                        <li><a href="<?php echo url('/administrator/user/create/');?>">Add New</a></li>
                                    </ul>
                                </li>

                            <!--  <li class="activeLink">
                          <a href="{{url('/report')}}">
                              <i class="icon-screen-desktop"></i>
                              <span>Report</span>
                          </a>
                </li> -->
                                <li class="activeLink">
                                    <a href="{{url('/about')}}">
                                        <i class="icon-screen-desktop"></i>
                                        <span>About</span>
                                    </a>
                                </li>
                            </ul>
                </div><!--left_nav_ends-->
            </div>
            <!--Ends-->
            <!--==================================================================================================-->

        @yield('content')

        <!--==================================================================================================-->
            {!! Html::script( 'resources/assets/js/jquery.js' ) !!}
            <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
            {!! Html::script( 'resources/assets/js/jquery-ui.js' ) !!}
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
                });
            </script>
            <script>
                (function (b, o, i, l, e, r) {
                    b.GoogleAnalyticsObject = l;
                    b[l] || (b[l] =
                            function () {
                                (b[l].q = b[l].q || []).push(arguments)
                            });
                    b[l].l = +new Date;
                    e = o.createElement(i);
                    r = o.getElementsByTagName(i)[0];
                    e.src = 'https://www.google-analytics.com/analytics.js';
                    r.parentNode.insertBefore(e, r)
                }(window, document, 'script', 'ga'));
                ga('create', 'UA-XXXXX-X', 'auto');
                ga('send', 'pageview');
            </script>

    </div><!--App Right Part Ends-->


    </section><!--section ends-->
    </body>
    </html>
         