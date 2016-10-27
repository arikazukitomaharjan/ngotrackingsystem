<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;
    use DB;

    class Project extends Model
    {

        protected $table = 'projects';





        public static function getProjects($status = NULL , $searchKey = NULL , $view , $district)
        {

            if ($status) {
                return DB::table('projects as p')
                    ->where('p.status' , $status)
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.line_office' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.start_date' , 'p.end_date' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->where('p.district' , '=' , $district)
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);

            } else if ($searchKey) {
                $searchKey = str_replace('+' , '%' , $searchKey);

                return DB::table('projects as p')
                    ->where('p.title' , 'LIKE' , '%' . $searchKey . '%')
                    ->orWhere('o.affiliation_no' , 'LIKE' , '%' . $searchKey . '%')
                    ->orWhere('o.name' , 'LIKE' , '%' . $searchKey . '%')
                    ->orWhere('s.name' , 'LIKE' , '%' . $searchKey . '%')
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.line_office' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.start_date' , 'p.end_date' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->where('p.district' , '=' , $district)
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);
            } else {

                return DB::table('projects as p')
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.line_office' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.start_date' , 'p.end_date' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->where('p.district' , '=' , $district)
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);

            }

        }





        public static function getAdminProjects($status = NULL , $searchKey = NULL , $view)
        {

            if ($status) {
                return DB::table('projects as p')
                    ->where('p.status' , $status)
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.line_office' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.start_date' , 'p.end_date' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);

            } else if ($searchKey) {
                $searchKey = str_replace('+' , '%' , $searchKey);

                return DB::table('projects as p')
                    ->where('p.title' , 'LIKE' , '%' . $searchKey . '%')
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.line_office' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.start_date' , 'p.end_date' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);
            } else {

                return DB::table('projects as p')
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.line_office' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.start_date' , 'p.end_date' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);

            }

        }





        public static function getProjectDetail($id)
        {

            return DB::table('projects as p')
                ->where('p.id' , $id)
                ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                ->select('p.id' , 'p.title' , 'p.start_date' , 'p.line_office' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.working_zone' , 'p.end_date' , 'p.fiscal_year_bs' , 'p.fiscal_year_ad' , 'p.objectives' , 'p.activities' , 'p.targeted_group' , 'p.remark' , 'p.status' , 'p.budget' , 'a.name as area' , 's.name as sector' , 'o.name as organization')
                ->orderBy('p.start_date' , 'desc')
                ->first();
        }





        public static function getProjectByDistrict($district_id , $view)
        {

            return DB::table('projects as p')
                ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                ->select('p.id' , 'p.title' , 'p.line_office' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.start_date' , 'p.end_date' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                    'a.name as area' , 'a.id as area_id' ,
                    'o.name as organization' , 'o.id as organization_id')
                ->where('p.district' , '=' , $district_id)
                ->orderBy('p.start_date' , 'desc')
                ->paginate($view);
        }





        public static function getProjectAdministrator($searchKey = NULL)
        {

            if ($searchKey) {
                $searchKey = str_replace('+' , '%' , $searchKey);

                return DB::table('projects as p')
                    ->where('p.title' , 'LIKE' , '%' . $searchKey . '%')
                    ->orWhere('o.name' , 'LIKE' , '%' . $searchKey . '%')
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.line_office' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.start_date' , 'p.end_date' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->orderBy('p.budget_rs' , 'desc')
                    ->get();
            } else {

                return DB::table('projects as p')
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.line_office' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.start_date' , 'p.end_date' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->orderBy('p.budget_rs' , 'desc')
                    ->get();

            }

        }





        public static function getProjectsByOrganization($status = NULL , $searchKey = NULL , $view , $id)
        {

            if ($status) {

                return DB::table('projects as p')
                    ->where('p.organization' , $id)
                    ->where('p.status' , $status)
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.line_office' , 'p.status' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);

            } else {

                return DB::table('projects as p')
                    ->where('p.organization' , $id)
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.line_office' , 'p.status' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);

            }

        }





        public static function getProjectsByWorkingZone($id , $view , $orgId)
        {

            $id1 = $id . ',';
            $id2 = ',' . $id;
            if ($orgId) {

                return DB::table('projects as p')
                    ->where('p.working_zone' , $id)
                    ->orWhere('p.working_zone' , 'LIKE' , '%' . $id1 . '%')
                    ->orWhere('p.working_zone' , 'LIKE' , '%' . $id2 . '%')
                    ->where('p.organization' , 'LIKE' , $orgId)
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);

            } else {

                return DB::table('projects as p')
                    ->where('p.working_zone' , $id)
                    ->orWhere('p.working_zone' , 'LIKE' , '%' . $id1 . '%')
                    ->orWhere('p.working_zone' , 'LIKE' , '%' . $id2 . '%')
                    ->where('p.organization' , 'LIKE' , $orgId)
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);

            }

        }





        public static function getProjectsBySector($id , $view , $orgId = NULL)
        {

            if ($orgId) {

                return DB::table('projects as p')
                    ->where('p.sector' , $id)
                    ->where('p.organization' , $orgId)
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);

            } else {

                return DB::table('projects as p')
                    ->where('p.sector' , $id)
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);

            }

        }





        public static function getProjectsByArea($id , $view , $orgId = NULL)
        {

            if ($orgId) {

                return DB::table('projects as p')
                    ->where('p.area' , $id)
                    ->where('p.organization' , $orgId)
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);

            } else {

                return DB::table('projects as p')
                    ->where('p.area' , $id)
                    ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                    ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                    ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                    ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                    ->select('p.id' , 'p.title' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 'p.working_zone' , 's.name as sector' , 's.id as sector_id' ,
                        'a.name as area' , 'a.id as area_id' ,
                        'o.name as organization' , 'o.id as organization_id')
                    ->orderBy('p.start_date' , 'desc')
                    ->paginate($view);

            }
        }





        public static function getProjectsByLineOffice($id)
        {

            $id1 = $id . ',';
            $id2 = ',' . $id;

            return DB::table('projects as p')
                ->where('p.line_office' , $id)
                ->orWhere('p.line_office' , 'LIKE' , '%' . $id1 . '%')
                ->orWhere('p.line_office' , 'LIKE' , '%' . $id2 . '%')
                ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                ->select('p.id' , 'p.title' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 's.name as sector' , 'p.working_zone' , 's.id as sector_id' ,
                    'a.name as area' , 'a.id as area_id' ,
                    'o.name as organization' , 'o.id as organization_id')
                ->orderBy('p.start_date' , 'desc')
                ->get();
        }





        public static function getProjectsByLineOfficeAdmin($id , $view)
        {

            $id1 = $id . ',';
            $id2 = ',' . $id;

            return DB::table('projects as p')
                ->where('p.line_office' , $id)
                ->orWhere('p.line_office' , 'LIKE' , '%' . $id1 . '%')
                ->orWhere('p.line_office' , 'LIKE' , '%' . $id2 . '%')
                ->leftJoin('sectors as s' , 'p.sector' , '=' , 's.id')
                ->leftJoin('sectors as a' , 'p.area' , '=' , 'a.id')
                ->leftJoin('line_offices as l' , 'p.line_office' , '=' , 'l.id')
                ->leftJoin('organizations as o' , 'p.organization' , '=' , 'o.id')
                ->select('p.id' , 'p.title' , 'p.status' , 'p.currency' , 'p.budget' , 'p.budget_rs' , 's.name as sector' , 'p.working_zone' , 's.id as sector_id' ,
                    'a.name as area' , 'a.id as area_id' ,
                    'o.name as organization' , 'o.id as organization_id')
                ->orderBy('p.start_date' , 'desc')
                ->paginate($view);
        }





        public function lineOffices($str)
        {

            $array = explode(',' , $str);
            $return = '';
            if (is_array($array)) {
                foreach ($array as $lo):
                    $name = DB::table('line_offices')->where('id' , $lo)->pluck('name');
                    $return[] = $name;
                endforeach;
            }

            return implode(', ' , $return);
        }





        public function workingZones($str)
        {

            $array = explode(',' , $str);
            $return = '';
            if (is_array($array)) {
                foreach ($array as $lo):
                    $name = DB::table('working_zones')->where('id' , $lo)->pluck('name');
                    $return[] = $name;
                endforeach;
            }

            return implode(', ' , $return);

        }
    }
