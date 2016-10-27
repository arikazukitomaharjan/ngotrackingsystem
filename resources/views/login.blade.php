<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login - Brum Info Tech</title>

    {!! Html::style( 'resources/assets/styles/animation.css' ) !!}
    {!! Html::style( 'resources/assets/fonts/styles.css' ) !!}
    {!! Html::style( 'resources/assets/styles/custom.css' ) !!}
    {!! Html::style( 'resources/assets/styles/responsive.css' ) !!}
    
    <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>


  </head>
  
  
<!--body Start-->  
<body>


<!--Login Page-->
<div class="proj_login_page">
<div class="dis_table_cell">
<div class="login_box">
    <div class="logo_wrapp"><h1>{{ Lang::get('global.login-head') }}</h1></div>
    <h2></h2>
    {!! Form::open(['url'=>'/login', 'enctype' => "multipart/form-data"]) !!}
        <div class="field_set">
            {!! Form::text( 'username' , '' , ['class' => '','placeholder'=>Lang::get('global.username')]) !!}
            <i class="icon-user"></i>
        </div>
        <div class="field_set">
            {!! Form::password( 'password' , ['class' => '','placeholder'=>Lang::get('global.password')]) !!}
            <i class="icon-lock"></i>
        </div>
        
        <button type="submit" class="app_btn btn_red">{{ Lang::get('global.login') }}</button>
    </form>
  <!--  <a href="#" class="forget_pass">Forget password?</a> -->
  <a href="{{ url('/registration/organization/')}}">Register Organization</a>
    </div>
    <div class="copyright">© 2015 Brum Info Tech. All rights reserved. </div>
</div>
</div>
<!--Ends-->

{!! Html::script( 'resources/assets/plugins/jquery/jquery-2.1.4.min.js', [ 'defer' => 'defer' ] ) !!}
{!! Html::script( 'resources/assets/plugins/jquery-ui/jquery-ui.min.js', [ 'defer' => 'defer' ] ) !!}

</body>
</html>