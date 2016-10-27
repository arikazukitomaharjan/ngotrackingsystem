<?php
    namespace App\Http\Controllers;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use App\Organization;
    use App\Sector;
    use App\LineOffice;
    use App\WorkingZone;
    use App\Project;
    use App\Activity;
    use Request;
    use Hash;
    use Auth;
    use Redirect;
    use Session;
    use Validator;
    use Config;
    use Excel;
    use Image;
    use App;

    class AppController extends Controller
    {


        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function switchLang($lang)
        {

            Session::put('language' , $lang);

            return Redirect::back();
        }





        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {

        }





        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getDashboard()
        {

            /*$target_file = $_SERVER['DOCUMENT_ROOT'].'/appv2/kabhre.xls';
            echo $target_file;
            $result = Excel::load( $target_file )->get();

            echo '<pre>'; print_r($result );echo '</pre>';*/

            $user = Auth::user();
            $vdcList = Auth::user()->working_zone;
            $district = $user['working_zone'];
            $projectList = Project::getProjects('' , '' , 10 , $district);
            $counts = $this->getCount();
            $total = $this->getSum();
            $obj = new Project;
            $wz = new WorkingZone;
            $s = new Sector;

            $sectors = Sector::where('parent_id' , 0)->get();
            $subSector_id = Sector::select('id')->get();
            $subSectors = Sector::where('parent_id' , '>' , 0)->get();
            $vdcs = WorkingZone::where('tier' , 1)->where('scope' , 'vdc')->where('parent_id' , '=' , $vdcList)->get();
            $currentDistrict = WorkingZone::where('tier' , 2)->where('scope' , 'district')->where('id' , '=' , $vdcList)->first();
            $cDistrict=$currentDistrict['name'];

            $view = Request::get('view');
            if (!$view) {
                $view = 10;
            }
            $views = Request::get('views');
            if (!$views) {
                $views = 10;
            }
            $dataList = Sector::paginate($views);

            $dataLists = WorkingZone::paginate($view);

            return view('dashboard' , compact('projectList' , 'counts' , 'obj' , 'wz' , 'vdcs' , 'total' , 'sectors' , 's' , 'subSectors' , 'dataList' , 'dataLists','cDistrict'));
        }





        public function getReport()
        {

            $projectList = $this->getProjectActivities();

            return view('report' , compact('projectList'));
        }





        public function about()
        {

            return view('about');
        }





        private function getCount()
        {

            $district = Auth::User()->working_zone;
            $data['all'] = Project::where('district' , '=' , $district)->count();
            $data['running'] = Project::where('status' , 'running')->where('district' , '=' , $district)->count();
            $data['completed'] = Project::where('status' , 'completed')->where('district' , '=' , $district)->count();
            $data['unknown'] = Project::where('status' , 'unknown')->where('district' , '=' , $district)->count();
            $data['approved'] = Project::where('status' , 'approved')->where('district' , '=' , $district)->count();
            $data['proposed'] = Project::where('status' , 'proposed')->where('district' , '=' , $district)->count();

            return $data;
        }





        private function getSum()
        {

            $district = Auth::User()->working_zone;
            $data['total_budget'] = Project::where('district' , '=' , $district)->where('type','!=',"Acceptor")->sum('budget_rs');
//            dd($data);
            $data['total_vdc'] = WorkingZone::where('scope' , 'vdc')->where('parent_id' , '=' , $district)->count();
            $data['total_organisation'] = Organization::join('users' , 'users.id' , '=' , 'organizations.user_id')->where('working_zone' , '=' , $district)->count();

            return $data;
        }





        private function getProjectActivities()
        {

            $projectList = [];
            $projects = Project::all();
            foreach ($projects as $row):
                $row['ProjActivities'] = Activity::where('project_id' , $row->id)->get();
                array_push($projectList , $row);
            endforeach;

            return $projectList;

        }





        public function exportProject()
        {

            $filename = "projects-" . date('Y-m-d') . ".xls";
            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Content-Type: application/csv");
            $flag = FALSE;
            $projectList = Project::getProjects();

            foreach ($projectList as $row):
                if (!$flag) {
                    $title = [
                        'Project Name' ,
                        'Sector' ,
                        'Sub Sector' ,
                        'Working Zone' ,
                        'Budget' ,
                        'Status' ,
                    ];
                    $flag = TRUE;

                    echo implode("\t" , array_values($title)) . "\r\n";

                }
                $array = [
                    $row->title ,
                    $row->sector ,
                    $row->area ,
                    $row->working_zone ,
                    $row->budget ,
                    $row->status
                ];

                echo implode("\t" , array_values($array)) . "\r\n";

            endforeach;
            exit;
        }





        private function processProjectsToExport()
        {

            $projectList = Project::getProjects();
        }
    }
