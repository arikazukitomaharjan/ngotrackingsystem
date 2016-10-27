<!DOCTYPE html>
<html>
    <head>
        
        <!-- Title -->
        <title>App - Admin area</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        {!! Html::style( 'resources/assets/plugins/pace-master/themes/blue/pace-theme-flash.css' ) !!}
        {!! Html::style( 'resources/assets/plugins/uniform/css/uniform.default.min.css' ) !!}
        {!! Html::style( 'resources/assets/plugins/bootstrap/css/bootstrap.min.css' ) !!}
        {!! Html::style( 'resources/assets/plugins/fontawesome/css/font-awesome.css' ) !!}
        {!! Html::style( 'resources/assets/plugins/line-icons/simple-line-icons.css' ) !!}
        {!! Html::style( 'resources/assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css' ) !!}
        {!! Html::style( 'resources/assets/plugins/waves/waves.min.css' ) !!}
        {!! Html::style( 'resources/assets/plugins/switchery/switchery.min.css' ) !!}
        {!! Html::style( 'resources/assets/plugins/3d-bold-navigation/css/style.css' ) !!}
        {!! Html::style( 'resources/assets/css/modern.min.css' ) !!}
        {!! Html::style( 'resources/assets/css/themes/green.css' ) !!}
        {!! Html::style( 'resources/assets/css/custom.css' ) !!}

        {!! Html::style( 'resources/assets/plugins/slidepushmenus/css/component.css' ) !!}
        {!! Html::style( 'resources/assets/plugins/weather-icons-master/css/weather-icons.min.css' ) !!}
        {!! Html::style( 'resources/assets/plugins/metrojs/MetroJs.min.css' ) !!}
        {!! Html::style( 'resources/assets/plugins/toastr/toastr.min.css' ) !!}

        {!! Html::script( 'resources/assets/plugins/3d-bold-navigation/js/modernizr.js', [ 'defer' => 'defer' ] ) !!}
        {!! Html::script( 'resources/assets/plugins/offcanvasmenueffects/js/snap.svg-min.js', [ 'defer' => 'defer' ] ) !!}


        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body class="page-header-fixed">
    <div class="hola-hola"> </div>
        <div class="overlay"></div>
       
        <main class="page-content content-wrap">
          
            <div class="page-sidebar sidebar">
                <div class="page-sidebar-inner slimscroll">
                   
                    <ul class="menu">
                        <li class="dashboard-li"><a href=" <?php echo url('/dashboard');?> " class="waves-effect waves-button">Dashboard</a></li>
                        <li class="heading"><a href="#"><span class="menu-icon glyphicon glyphicon-asterisk"></span>Title</a>
                        <ul class="link-menu">
                            <li class=""><a href="<?php echo url('/sectors');?>">Sectors</a></li>
                            <li class=""><a href="<?php echo url('/organizations');?>">Organizations</a></li>
                            <li class=""><a href="<?php echo url('/line-offices');?>">Line Offices</a></li>
                            <li class=""><a href="<?php echo url('/working-zones');?>">Working VDC</a></li>
                        </ul>
                       <li class="heading"><a href="#"><span class="menu-icon glyphicon glyphicon-th-list"></span>Projects<span class="arrow"></span></a>
                            <ul class="link-menu">
                                <li><a href="<?php echo url('/projects');?>">All Projects</a></li>
                                <li><a href="<?php echo url('/projects/running');?>">Running</a></li>
                                <li><a href="<?php echo url('/projects/completed');?>">Completed</a></li>
                                <li><a href="<?php echo url('/projects/new');?>">Add New</a></li>
                                
                            </ul>
                        </li> 
                         <li><a href=" <?php echo url('/logout');?> "><span class="menu-icon glyphicon glyphicon-logout"></span>Logout</a></li>
                       
                         
                    </ul>
                </div><!-- Page Sidebar Inner -->
            </div><!-- Page Sidebar -->
            <div class="page-inner">
            <div class="logo">
            <img src="<?php echo url('/resources/assets/images/brum-logo.jpg');?>">
            </div>
               <div class="header-part text-center">
               <h1>Goverment of Nepal</h1>
               <h2>Ministry of Home Affairs</h2>
               <h3>Rasuwa</h3>
               </div>
                
                @yield('content');
                
                <div class="page-footer">
                    <p class="no-s">2015 &copy; Brum Info Tech.</p>
                </div>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
       
        <div class="cd-overlay"></div>
    

        <!-- Javascripts -->
         
        
        
    </body>
</html>

    
