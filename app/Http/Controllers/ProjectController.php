<?php
    namespace App\Http\Controllers;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;

    use Illuminate\Support\Facades\Auth;
    use Input;
    use App\Organization;
    use App\Sector;
    use App\WorkingZone;
    use App\LineOffice;
    use App\Project;
    use App\Activity;
    use Maatwebsite\Excel\Facades\Excel;
    use Request;
    use Hash;

    use Redirect;
    use Session;
    use Validator;
    use Config;

    use Image;

    class ProjectController extends Controller
    {

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index($status = NULL)
        {

            $district = Auth::User()->working_zone;
            $searchKey = Request::get('q');
            $view = Request::get('view');
            if (!$view) {
                $view = 10;
            }
            $projectList = Project::getProjects($status , $searchKey , $view , $district);
            $fiscal_year_bs = Project::select('fiscal_year_bs')->groupBy('fiscal_year_bs')->get();

            $project = new Project;
            /*  $fiscal=$project->lists('fiscal_year_bs');
              dd($fiscal);*/
            $counts = $this->getCount();
            $obj = new Project;

            return view('lists.project' , compact('projectList' , 'counts' , 'searchKey' , 'obj' , 'fiscal_year_bs'));
        }





        public function fiscal_year_bs($year)
        {

            //            $year = Request::get('fiscal_year_bs');

            $district = Auth::User()->working_zone;
            $searchKey = Request::get('q');
            $view = Request::get('view');
            if (!$view) {
                $view = 10;
            }
            $projectList = Project::where('district' , '=' , $district)->where('fiscal_year_bs' , '=' , $year)->paginate($view);
            //            $projectList = Project::getProjects($status , $searchKey , $view , $district);
            $fiscal_year_bs = Project::select('fiscal_year_bs')->groupBy('fiscal_year_bs')->get();

            $project = new Project;
            /*  $fiscal=$project->lists('fiscal_year_bs');
              dd($fiscal);*/
            $counts = $this->getCount();
            $obj = new Project;

            return view('lists.project' , compact('projectList' , 'counts' , 'searchKey' , 'obj' , 'fiscal_year_bs'));

        }





        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {

            $user = Auth::user();
            $wd = $user->working_zone;
            $orgList = Organization::join('users' , 'users.id' , '=' , 'organizations.user_id')->where('users.working_zone' , '=' , $wd)->where('organizations.status' , '=' , 'Approved')->get(['organizations.id' , 'organizations.name']);
            $orgListActivities = $orgList->lists('name' , 'id');
            $orgListActivities->prepend('Choose acceptor');
            $sectorList = Sector::where('status' , 'Published')->get();
            $lineList = LineOffice::where('status' , 'Published')->get();
            //            $districtList = WorkingZone::where('status' , 'Published')->where('parent_id' , '=' , 0)->get();
            $zoneList = WorkingZone::where('status' , 'Published')->where('scope' , 'vdc')->where('parent_id' , '=' , $wd)->get();

            return view('forms.project-create' , compact('orgList' , 'areaList' , 'sectorList' , 'lineList' , 'zoneList' , 'orgListActivities'));
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

            $lineOffice = Request::get('line_office');

            if (is_array($lineOffice)) {

                $lineOffice = implode(',' , $lineOffice);
            }

            $district = Auth::User()->working_zone;
            $wzone = Request::get('working_zone');
            if (is_array($wzone)) {

                $wzone = implode(',' , $wzone);
            }

            $parentSector = Sector::where('id' , Request::get('sector'))->pluck('parent_id');
            $project = new Project;

            $project->title = Request::get('title');
            $project->organization = Request::get('organization');
            $project->sector = $parentSector;
            $project->area = Request::get('sector');
            $project->district = $district;
            $project->working_zone = $wzone;
            $project->line_office = $lineOffice;
            $project->fiscal_year_ad = Request::get('fiscal_year_ad');
            $project->fiscal_year_bs = Request::get('fiscal_year_bs');
            $project->start_date = Request::get('start_date');
            $project->end_date = Request::get('end_date');
            $project->currency = Request::get('currency');
            $project->budget = $this->cleanAmount(Request::get('budget'));
            $project->budget_rs = $this->cleanAmount(Request::get('budget_rs'));
            $project->targeted_group = Request::get('targeted_group');
            $project->objectives = nl2br(Request::get('objectives'));
            $project->activities = nl2br(Request::get('activities'));
            $project->remark = nl2br(Request::get('remark'));
            $project->status = Request::get('status');
            $project->type = "";

            $project->save();
            $a = Request::get('act');
            if ($a['description'] != NULL) {

                $this->addUpdateObjective($project->id , Request::get('act'));
                $act = Request::get('act');

                $count = count($act['description']);
                for ($i = 0; $i < $count; $i++):
                    if ($act['acceptor_id'][$i] != "0") {
                        $actv = new Activity;
                        $actv->acceptor_id = $act['acceptor_id'][$i];
                        $org = Organization::where('id' , '=' , $actv->acceptor_id)->first(['name']);

                        $project = new Project;

                        $project->type = "Acceptor";
                        $project->status = "Proposed";
                        $project->title = "project of " . $org['name'];
                        $project->organization = $actv->acceptor_id;
                        $project->sector = $parentSector;
                        $project->area = Request::get('sector');
                        $project->district = $district;
                        $project->working_zone = $wzone;
                        $project->line_office = $lineOffice;
                        $project->budget_rs = $act['total_budget'][$i];

                        $project->save();
                    }
                endfor;

            }

            return Redirect::to('/projects');

        }





        /**
         * Display the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {

            $project = Project::getProjectDetail($id);
            $activities = Activity::where('project_id' , $id)->get();
            $obj = new Project;

            return view('details.project' , compact('project' , 'activities' , 'obj'));
        }





        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {

            $user = Auth::user();
            $wd = $user->working_zone;
            $project = Project::where('id' , $id)->first();
            if (!$project) {
                return view('errors.missing');
            }
            /* $wd = $user->working_zone;
             $orgList = Organization::join('users' , 'users.id' , '=' , 'organizations.user_id')->where('users.working_zone' , '=' , $wd)->where('organizations.status' , '=' , 'Approved')->get(['organizations.id' , 'organizations.name']);
            */
            $orgList = Organization::join('users' , 'users.id' , '=' , 'organizations.user_id')->where('users.working_zone' , '=' , $wd)->where('organizations.status' , '=' , 'Approved')->get(['organizations.id' , 'organizations.name']);
            $orgListActivities = $orgList->lists('name' , 'id');
            $sectorList = Sector::where('status' , 'Published')->get();
            $lineList = LineOffice::where('status' , 'Published')->get();
            $zoneList = WorkingZone::where('status' , 'Published')->where('scope' , 'vdc')->where('parent_id' , $wd)->get();
            $activitiesList = Activity::where('project_id' , $id)->get();

            return view('forms.project-edit' , compact('project' , 'orgList' , 'areaList' , 'sectorList' , 'lineList' , 'zoneList' , 'activitiesList' , 'orgListActivities'));
        }





        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $id
         *
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request , $id)
        {

            $lineOffice = Request::get('line_office');

            if (is_array($lineOffice)) {

                $lineOffice = implode(',' , $lineOffice);
            }

            $wzone = Request::get('working_zone');

            if (is_array($wzone)) {

                $wzone = implode(',' , $wzone);
            }

            $parentSector = Sector::where('id' , Request::get('sector'))->pluck('parent_id');
            $project = Project::find($id);
            $project->title = Request::get('title');
            $project->organization = Request::get('organization');
            $project->sector = $parentSector;
            $project->area = Request::get('sector');
            $project->working_zone = $wzone;
            $project->line_office = $lineOffice;
            $project->fiscal_year_ad = Request::get('fiscal_year_ad');
            $project->fiscal_year_bs = Request::get('fiscal_year_bs');
            $project->start_date = Request::get('start_date');
            $project->end_date = Request::get('end_date');
            $project->currency = Request::get('currency');
            $project->budget = $this->cleanAmount(Request::get('budget'));
            $project->budget_rs = $this->cleanAmount(Request::get('budget_rs'));
            $project->targeted_group = Request::get('targeted_group');
            $project->objectives = nl2br(Request::get('objectives'));
            $project->activities = nl2br(Request::get('activities'));

            $project->remark = nl2br(Request::get('remark'));
            $project->status = Request::get('status');
            $project->save();

            $this->addUpdateObjective($project->id , Request::get('act'));

            return Redirect::to('/projects');
        }





        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {

            Project::where('id' , $id)->delete();

            return Redirect::to('/projects');
        }





        private function addUpdateObjective($projectId , $act)
        {

            Activity::where('project_id' , $projectId)->delete();

            $count = count($act['description']);

            for ($i = 0; $i < $count; $i++):
                if ($act['description'][$i] != NULL) {
                    $actv = new Activity;
                    $actv->project_id = $projectId;
                    $actv->description = $act['description'][$i];
                    $actv->unit = $act['unit'][$i];
                    $actv->quantity = $act['quantity'][$i];
                    $actv->duration = $act['duration'][$i];
                    $actv->period = $act['period'][$i];
                    $actv->unit_cost = $act['unit_cost'][$i];
                    $actv->total_budget = $act['total_budget'][$i];
                    $actv->acceptor_id = $act['acceptor_id'][$i];
                    $actv->phase = $act['phase'][$i];
                    $actv->save();
                    $actv->id = NULL;
                }

            endfor;
        }





        private
        function getCount()
        {

            $district = Auth::User()->working_zone;
            $data['all'] = Project::where('district' , '=' , $district)->count();
            $data['running'] = Project::where('status' , 'running')->where('district' , '=' , $district)->count();
            $data['completed'] = Project::where('status' , 'completed')->where('district' , '=' , $district)->count();

            return $data;
        }





        private
        function cleanAmount($input)
        {

            $input = preg_replace("/[^\d.-]/" , "" , $input);

            return $input;
        }





        public
        function getWorkingZone($id)
        {

            $zoneList = WorkingZone::select('id' , 'name')->where('status' , 'Published')->where('scope' , 'vdc')->where('parent_id' , '=' , $id)->get();

            return $zoneList;
        }


        public function export(Project $project){
            $user_id=Auth::User()->working_zone;
            $excels=$project->where('district','=',$user_id)->get();
            Excel::create('project', function($excel) use($excels) {
                $excel->sheet('Sheet 1', function($sheet) use($excels) {
                    $sheet->fromArray($excels);
                });
            })->export('xls');
        }
    }
