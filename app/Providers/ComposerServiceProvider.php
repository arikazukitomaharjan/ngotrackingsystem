<?php

    namespace App\Providers;

    use View;
    use Illuminate\Support\ServiceProvider;

    class ComposerServiceProvider extends ServiceProvider
    {

        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        public function boot()
        {

            //
            View::composer('*' , 'App\Http\ViewComposer\ShowDistrict');
            /*  View::composer('/administrator.*' , 'App\Http\ViewComposer\AdministratorLayout');
              //View::composer('administrator' , 'App\Http\ViewComposer\AdministratorLayout');

              View::composer('/org.*' , 'App\Http\ViewComposer\ShowDistrict\OrgLayout');*/

        }





        /**
         * Register the application services.
         *
         * @return void
         */
        public function register()
        {
            //
        }
    }
