<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Brum Info Tech</title>
    {!! Html::style( 'resources/assets/styles/jquery-ui.css' ) !!}
    {!! Html::style( 'resources/assets/styles/animation.css' ) !!}
    {!! Html::style( 'resources/assets/fonts/styles.css' ) !!}
    {!! Html::style( 'resources/assets/styles/custom.css' ) !!}
    {!! Html::style( 'resources/assets/styles/responsive.css' ) !!}
    <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
    {!! Html::script( 'resources/assets/js/jquery.js' ) !!}
    {!! Html::script( 'resources/assets/js/jquery-ui.js' ) !!}
  
  </head>
  
  
<!--body Start-->  
<body>

<header>
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
           <span><a href="{{ url('/switch-lang/np') }}">Ne</a></span>
           <span><a href=" {{ url('/switch-lang/en') }} ">En</a></span>
            <form class="search-form" action="{{ url('/projects') }}" method="get"> <input id="q" name="q" type="text" value="<?php if(isset($searchKey)) echo $searchKey;?>" placeholder="Search Project"> </form>
            <span><i  class="icon-search-find"></i></span> 
            <span class="log_out">
               <a href="{{ url('/logout') }}"> <i class="icon-power-off"></i></a>  
            </span>
        </span>
        
</header>
<!--Header ends -->

<section id="all_page_wrapper">
<!--Left Part-->
<div class="app_left_part">

    <div class="app_logo_holder">
        <img src="{{url('resources/assets/images/logo.jpg')}}">
        <br>
    </div>
    
    <div class="app_left_navigation">
        <ul>
            <li class="activeLink">
                <a href="{{url('/dashboard')}}">
                    <i class="icon-screen-desktop"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="has_child">
                <a href="#">
                    <i class="icon-sitemap"></i>
                    <span>Title</span>
                </a>
                
                <ul class="submenu">
                    <li class=""><a href="<?php echo url('/sectors');?>">Sectors</a></li>
                    <li class=""><a href="<?php echo url('/organizations');?>">Organizations</a></li>
                    <li class=""><a href="<?php echo url('/line-offices');?>">Line Offices</a></li>
                    <li class=""><a href="<?php echo url('/working-zones');?>">Working Zones</a></li>
                </ul>
            </li>
            
            
            <li class="has_child">
                <a href="#">
                    <i class="icon-trello"></i>
                    <span>Projects</span>
                </a>
                
                <ul class="submenu">
                    <li><a href="<?php echo url('/projects');?>">All Projects</a></li>
                    <li><a href="<?php echo url('/projects/running');?>">Running</a></li>
                    <li><a href="<?php echo url('/projects/completed');?>">Completed</a></li>
                    <li><a href="<?php echo url('/projects/new');?>">Add New</a></li>
                </ul>
            </li>
            
            <li class="has_child">
                <a href="#">
                    <i class="icon-trello"></i>
                    <span>Overviews</span>
                </a>
                
                <ul class="submenu">
                    <li><a href="<?php echo url('/overview/summary');?>">Summary</a></li>
                    <li><a href="<?php echo url('/overview/budget');?>">Budget</a></li>
                    <li><a href="<?php echo url('/overview/objectives');?>">Objectives</a></li>
                    <li><a href="<?php echo url('/overview/activities');?>">Activities</a></li>
                </ul>
            </li>
             <li class="activeLink">
                <a href="{{url('/report')}}">
                    <i class="icon-screen-desktop"></i>
                    <span>Report</span>
                </a>
            </li>           
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
<script>
$('.icon-search-find').click(function(){
    var query = $('#q').val();
    if( query != null && query != ''){
        $('.search-form').submit();
    }
    
});

$(document).ready(function(){
    
        $('.has_child').click(function(){
            
            $(this).find('.submenu').slideToggle(300);
            
        });

        var curUrl = $(document).href;
alert(curUrl);
});
</script>


</div><!--App Right Part Ends-->


</section><!--section ends-->
</body>
</html>