<?php

    namespace App;

    use DB;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Auth;

    class WorkingZone extends Model
    {

        protected $table = 'working_zones';





        public static function getBudgetByWorkingZone($id)
        {
            $district=Auth::User()->working_zone;

            $id1 = $id . ',';
            $id2 = ',' . $id;

            return DB::table('projects')
                ->where('working_zone' , '=' , $id)
                ->orWhere('working_zone' , 'LIKE' , '%' . $id1 . '%')
                ->orWhere('working_zone' , 'LIKE' , '%' . $id2 . '%')
                ->where('district','=',$district)
                ->sum('budget_rs');

        }





        public static function countProjectByWorkingZone($id)
        {
            $district=Auth::User()->working_zone;
            $id1 = $id . ',';
            $id2 = ',' . $id;

            return DB::table('projects')
                ->where('working_zone' , '=' , $id)
                ->orWhere('working_zone' , 'LIKE' , '%' . $id1 . '%')
                ->orWhere('working_zone' , 'LIKE' , '%' . $id2 . '%')
                ->where('district','=',$district)
                ->count('id');

        }





        public function countOrganisationByWorkingZone($id)
        {
            $district=Auth::User()->working_zone;
            $id1 = $id . ',';
            $id2 = ',' . $id;

            return DB::table('projects')
                ->where('working_zone' , '=' , $id)
                ->orWhere('working_zone' , 'LIKE' , '%' . $id1 . '%')
                ->orWhere('working_zone' , 'LIKE' , '%' . $id2 . '%')
                ->where('district','=',$district)
                ->groupBy('working_zone')
                ->count('organization');
        }










        public static function getBudgetByDistrict($id)
        {

            return DB::table('projects')
                ->where('district' , '=' , $id)
                ->sum('budget_rs');

        }





        public static function countProjectByDistrict($id)
        {

            return DB::table('projects')
                ->where('district' , '=' , $id)
                ->count('id');

        }





        public static function countOrganisationByDistrict($id)
        {

            return DB::table('projects')
                ->where('district' , '=' , $id)
                ->groupBy('organization')
                ->count('organization');

        }

    }
