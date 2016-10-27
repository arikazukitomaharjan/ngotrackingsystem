<?php

    namespace App;

    use DB;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Auth;

    class Sector extends Model
    {

        protected $table = 'sectors';





        public static function getBudgetBySector($id)
        {
            $district = Auth::User()->working_zone;
            return DB::table('projects')->where('sector' , $id)->where('district' , '=' , $district)->sum('budget_rs');

        }





        public static function getBudgetByArea($id)
        {

            return DB::table('projects')->where('area' , $id)->sum('budget_rs');

        }





        public function countOrganisationBySector($id)
        {

            $district = Auth::User()->working_zone;

            return DB::table('projects')->where('sector' , $id)
                ->where('district' , '=' , $district)
                ->groupBy('organization')
                ->count('organization');
        }





        public function countProjectBySector($id)
        {
            $district = Auth::User()->working_zone;

            return DB::table('projects')->where('sector' , $id)
                ->where('district' , '=' , $district)
                ->count();
        }
    }
