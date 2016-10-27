<?php
    namespace App\Http\Controllers;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Request;
    use Hash;
    use Auth;
    use Redirect;
    use Session;
    use App\Organization;
    use URL;
    use App\Project;
    use App\User;
    use App\Sector;
    use App\LineOffice;
    use App\WorkingZone;
    use App\Activity;
    use DB;

    class OrganizationController extends Controller
    {

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {

            $view = Request::get('view');
            $user = Auth::user();

            $wd = $user->working_zone;
            if (!$view) {

                $view = 10;
            }
            $dataList = DB::table('users as u')->join('organizations as o' , 'u.id' , '=' , 'o.user_id')->where('o.status' , 'Approved')->where('u.working_zone' , $wd)->paginate($view);
            $title = 'Organizations';
            $createLink = URL::route('createOrganization');
            $editLink = url('/organizations/edit');
            $deleteLink = url('/organizations/delete');

            return view('lists.organization' , compact('dataList' , 'title' , 'createLink' , 'editLink' , 'deleteLink'));
        }





        public function getOrgAbout()
        {

            return view('org.about');
        }





        public function getRequests()
        {

            $view = Request::get('view');
            if (!$view) {

                $view = 10;
            }
            $user = Auth::user();
            $wd = $user->working_zone;

            $dataList = DB::table('users as u')->join('organizations as o' , 'u.id' , '=' , 'o.user_id')->where('o.status' , 'Pending')->where('u.working_zone' , $wd)->paginate($view);
            $title = 'Organizations';
            $createLink = URL::route('createOrganization');
            $editLink = url('/organizations/edit');
            $deleteLink = url('/organizations/delete');

            return view('lists.organization' , compact('dataList' , 'title' , 'createLink' , 'editLink' , 'deleteLink'));
        }





        public function getOrganizationsBudget()
        {

            $district = Auth::User()->district;
            $view = Request::get('view');
            if (!$view) {

                $view = 10;
            }

            $dataList = Organization::join('users' , 'users.id' , '=' , 'organizations.id')->where('users.working_zone' , '=' , $district)->where('organizations.status' , 'Approved')->paginate($view);
            $obj = new Organization;

            return view('lists.organization-budget' , compact('dataList' , 'obj' , 'view'));
        }





        public function getOrgDashboard()
        {

            $view = Request::get('view');
            if (!$view) {

                $view = 10;
            }
            $user = Auth::User();
            $id = Auth::user()->id;
            //            dd($id);
            $vdcList = Auth::user()->working_zone;
            $orgid = Organization::select('id')->where('user_id' , '=' , $id)->first();

            $projectList = Project::getProjectsByOrganization('' , '' , $view , $orgid['id']);
            $currentDistrict = WorkingZone::where('tier' , 2)->where('scope' , 'district')->where('id' , '=' , $vdcList)->first();
            $cDistrict = $currentDistrict['name'];

            $counts = $this->getCount($orgid['id']);
            $obj = new Project;

            return view('org.dashboard' , compact('projectList' , 'counts' , 'obj' , 'cDistrict'));
        }





        public function getOrgProjects($status = NULL)
        {

            $district = Auth::User()->working_zone;
            $view = Request::get('view');
            if (!$view) {

                $view = 10;
            }
            $user = Auth::user();
            $id = Auth::user()->id;
            $orgid = Organization::select('id')->where('user_id' , '=' , $id)->first();
            $projectList = Project::getProjectsByOrganization($status , '' , $view , $orgid['id']);
            $fiscal_year_bs = Project::select('fiscal_year_bs')->groupBy('fiscal_year_bs')->get();
            $counts = $this->getCount($orgid['id']);
            $obj = new Project;

            return view('org.lists.project' , compact('projectList' , 'counts' , 'obj' , 'fiscal_year_bs'));
        }





        public function getOrgProjectsByFiscalYear($year , $status = NULL)
        {

            $fiscal_year_bs = Project::select('fiscal_year_bs')->where('fiscal_year_bs' , '=' , $year)->groupBy('fiscal_year_bs')->get();
            $district = Auth::User()->working_zone;
            $view = Request::get('view');
            if (!$view) {

                $view = 10;
            }
            $user = Auth::user();
            $id = Auth::user()->id;
            $orgid = Organization::select('id')->where('user_id' , '=' , $id)->first();
            $projectList = Project::getProjectsByOrganization($status , '' , $view , $orgid['id']);
            $fiscal_year_bs = Project::select('fiscal_year_bs')->groupBy('fiscal_year_bs')->get();
            $counts = $this->getCount($orgid['id']);
            $obj = new Project;

            return view('org.lists.project' , compact('projectList' , 'counts' , 'obj' , 'fiscal_year_bs'));
        }





        public function createOrgProject()
        {

            $working_zone = Auth::User()->working_zone;
            //            $orgList = Organization::join('users' , 'users.id' , '=' , 'organizations.user_id')->where('users.working_zone' , '=' , $working_zone)->where('organizations.status' , 'Approved')->get(['organizations.id' , 'organizations.name']);
            $orgList = Organization::join('users' , 'users.id' , '=' , 'organizations.user_id')->where('users.working_zone' , '=' , $working_zone)->where('organizations.status' , '=' , 'Approved')->get(['organizations.id' , 'organizations.name']);
            $orgListActivities = $orgList->lists('name' , 'id');
            $orgListActivities->prepend('Choose acceptor');
            $sectorList = Sector::where('status' , 'Published')->get();
            $lineList = LineOffice::where('status' , 'Published')->get();
            $zoneList = WorkingZone::where('status' , 'Published')->where('parent_id' , '=' , $working_zone)->get();

            return view('org.forms.project-create' , compact('areaList' , 'sectorList' , 'lineList' , 'zoneList' , 'orgListActivities'));
        }





        public function storeOrgProject(Request $request)
        {

            $lineOffice = Request::get('line_office');

            if (is_array($lineOffice)) {

                $lineOffice = implode(',' , $lineOffice);
            }

            $wzone = Request::get('working_zone');

            if (is_array($wzone)) {

                $wzone = implode(',' , $wzone);
            }
            $user = Auth::user();
            $district = Auth::user()->working_zone;
            $id = Auth::user()->id;
            $orgid = Organization::select('id')->where('user_id' , '=' , $id)->first();
            $parentSector = Sector::where('id' , Request::get('sector'))->pluck('parent_id');
            $project = new Project;
            $project->title = Request::get('title');
            $project->organization = $orgid['id'];
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

            return Redirect::to('/organization/project/');

        }





        public function editOrgProject($id)
        {

            $working_zone = Auth::User()->working_zone;
            $project = Project::where('id' , $id)->first();
            if (!$project) {
                return view('errors.missing');
            }

            $orgList = Organization::join('users' , 'users.id' , '=' , 'organizations.user_id')->where('users.working_zone' , '=' , $working_zone)->where('organizations.status' , 'Approved')->get(['organizations.id' , 'organizations.name']);
            $orgListActivities = $orgList->lists('name' , 'id');
            $orgListActivities->prepend('Choose acceptor');
            $sectorList = Sector::where('status' , 'Published')->get();
            $lineList = LineOffice::where('status' , 'Published')->get();

            $zoneList = WorkingZone::where('status' , 'Published')->where('parent_id' , '=' , $working_zone)->get();
            $activitiesList = Activity::where('project_id' , $id)->get();

            return view('org.forms.project-edit' , compact('project' , 'orgList' , 'areaList' , 'sectorList' , 'lineList' , 'zoneList' , 'activitiesList' , 'orgListActivities'));
        }





        public function updateOrgProject(Request $request , $id)
        {

            $user = Auth::user()->id;
            $lineOffice = Request::get('line_office');

            if (is_array($lineOffice)) {

                $lineOffice = implode(',' , $lineOffice);
            }

            $wzone = Request::get('working_zone');

            if (is_array($wzone)) {

                $wzone = implode(',' , $wzone);
            }
            $orgID = Organization::join('users' , 'users.id' , '=' , 'organizations.user_id')->select('organizations.id')->where('users.id' , '=' , $user)->first();


            $parentSector = Sector::where('id' , Request::get('sector'))->pluck('parent_id');
            $project = Project::find($id);
            $project->title = Request::get('title');
            $project->organization = $orgID['id'];
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

            return Redirect::to('/organization/project');
        }





        public function viewOrgProject($id)
        {

            $project = Project::getProjectDetail($id);
            $activities = Activity::where('project_id' , $id)->get();
            $obj = new Project;

            return view('org.details.project' , compact('project' , 'activities' , 'obj'));
        }





        public function deleteOrgProject($id)
        {

            Project::where('id' , $id)->delete();

            return Redirect::to(URL::route('getOrgProjects'));
        }





        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {

            $title = 'Organizations';
            //            $districtList = WorkingZone::where('scope' , 'district')->get()
            $formAction = URL::route('storeOrganization');

            return view('forms.organization-create' , compact('title' , 'formAction'));
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

            $userId = $this->checkIfUserEmailExist(Request::get('contact_email'));
            if ($userId) {
                Session::put('alert' , ['class' => 'alert-danger' , 'msg' => 'Email Already Registered!']);

                return Redirect::to(URL::route('createOrganization'));
            }
            $working_zone = Auth::User()->district;

            $user = new User;

            $user->role = 'Organization';

            $user->working_zone = Auth::User()->working_zone;
            $user->first_name = Request::get('name');
            $user->username = $this->generateUserNameFromEmail(Request::get('contact_email'));
            $user->email = Request::get('contact_email');
            $user->password = Hash::make(Request::get('password'));
            $user->status = Request::get('status');
            $user->save();

            $insesrtId = $user->id;

            $obj = new Organization;
            $obj->user_id = $insesrtId;
            $obj->name = Request::get('name');
            $obj->introduction = Request::get('introduction');
            $obj->address = Request::get('address');
            $obj->contact_person = Request::get('contact_person');
            $obj->contact_no = Request::get('contact_no');
            $obj->contact_email = Request::get('contact_email');
            $obj->objectives = Request::get('objectives');
            $obj->reg_district = Request::get('reg_district');
            $obj->reg_no = Request::get('reg_no');
            $obj->reg_date = Request::get('reg_date');
            $obj->pan_no = Request::get('pan_no');
            $obj->pan_reg_date = Request::get('pan_reg_date');
            $obj->affiliation_no = Request::get('affiliation_no');
            $obj->last_renewal = Request::get('last_renewal');
            $obj->last_audit = Request::get('last_audit');
            $obj->assets = Request::get('assets');
            $obj->status = Request::get('status');
            $obj->save();
            Session::put('alert' , ['class' => 'alert-success' , 'msg' => 'Successfully Registered! We are reviewing your Entry.']);

            return Redirect::to(URL::route('createOrganization'));

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

            $org = Organization::where('id' , $id)->first();
            if (!$org) {

                return Redirect::to('/organizations');
            }
            $view = Request::get('view');
            if (!$view) {

                $view = 10;
            }
            $obj = new Project;
            $projectList = Project::getProjectsByOrganization('' , '' , $view , $id);

            return view('details.organization' , compact('org' , 'projectList' , 'obj'));
        }





        public function getProjectBySector($id)
        {

            $sector = Sector::where('id' , $id)->first();

            if (!$sector) {
                return Redirect::to('/sectors/');
            }
            $view = Request::get('view');
            if (!$view) {

                $view = 10;
            }
            $user = Auth::user();
            /* $id=$user['id'];
             dd($id);*/
            $obj = new Project;
            $projectList = Project::getProjectsBySector($id , $view , $user['id']);

            return view('org.details.sector' , compact('sector' , 'projectList' , 'obj'));
        }





        public function getProjectByArea($id)
        {

            $sector = Sector::where('id' , $id)->first();
            if (!$sector) {
                return Redirect::to('/sectors/');
            }
            $view = Request::get('view');
            if (!$view) {

                $view = 10;
            }
            $user = Auth::user();
            $obj = new Project;
            $projectList = Project::getProjectsByArea($id , $view , $user['id']);

            return view('org.details.sector' , compact('sector' , 'projectList' , 'obj'));
        }





        function getProjectByWorkingZone($id)
        {

            $workingzone = WorkingZone::where('id' , $id)->first();
            if (!$workingzone) {
                return Redirect::to('/working-zones');
            }
            $view = Request::get('view');
            if (!$view) {

                $view = 10;
            }
            $user = Auth::user();
            $obj = new Project;
            $projectList = Project::getProjectsByWorkingZone($id , $view , $user['id']);
            $counts = $this->getCount($id);

            return view('org.details.working-zone' , compact('workingzone' , 'projectList' , 'counts' , 'obj'));

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

            $title = 'Organizations';
            $formAction = url('organizations/update/' . $id);
            $record = Organization::where('id' , $id)->first();

            return view('forms.organization-edit' , compact('title' , 'formAction' , 'record'));
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

            $obj = Organization::find($id);
            $userId = $obj->user_id;

            $user = User::find($userId);

            $user->first_name = Request::get('name');
            $user->email = Request::get('contact_email');
            $user->status = Request::get('status');
            if (trim(Request::get('password'))) {

                $user->password = Hash::make(Request::get('password'));
            }
            $user->save();

            $obj->name = Request::get('name');
            $obj->introduction = Request::get('introduction');
            $obj->address = Request::get('address');
            $obj->contact_person = Request::get('contact_person');
            $obj->contact_no = Request::get('contact_no');
            $obj->contact_email = Request::get('contact_email');
            $obj->objectives = Request::get('objectives');
            $obj->reg_district = Request::get('reg_district');
            $obj->reg_no = Request::get('reg_no');
            $obj->reg_date = Request::get('reg_date');
            $obj->pan_no = Request::get('pan_no');
            $obj->pan_reg_date = Request::get('pan_reg_date');
            $obj->affiliation_no = Request::get('affiliation_no');
            $obj->last_renewal = Request::get('last_renewal');
            $obj->last_audit = Request::get('last_audit');
            $obj->assets = Request::get('assets');
            $obj->status = Request::get('status');
            $obj->save();
            Session::put('alert' , ['class' => 'alert-success' , 'msg' => 'Successfully Updated.']);

            return Redirect::to(URL::route('editOrganization' , [$id]));
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

            Organization::where('id' , $id)->delete();

            return Redirect::to(URL::route('getOrganizations'));
        }





        public function createOrganizationRegistration()
        {

            $districts = WorkingZone::where('scope' , 'district')->get();

            return view('org.forms.registration' , compact('districts'));
        }





        public function storeOrganizationRegistration(Request $request)
        {

            $userId = $this->checkIfUserEmailExist(Request::get('contact_email'));
            if ($userId) {
                Session::put('alert' , ['class' => 'alert-danger' , 'msg' => 'Email Already Registered!']);

                return Redirect::to(URL::route('createOrganizationRegistration'));
            }
            $user = new User;
            $user->role = 'Organization';
            $user->working_zone = Request::get('district');
            $user->first_name = Request::get('name');
            $user->username = $this->generateUserNameFromEmail(Request::get('contact_email'));
            $user->email = Request::get('contact_email');
            $user->password = Hash::make(Request::get('password'));
            $user->status = 'Pending';
            $user->save();

            $insesrtId = $user->id;

            $obj = new Organization;
            $obj->user_id = $insesrtId;
            $obj->name = Request::get('name');
            $obj->introduction = Request::get('introduction');
            $obj->address = Request::get('address');
            $obj->contact_person = Request::get('contact_person');
            $obj->contact_no = Request::get('contact_no');
            $obj->contact_email = Request::get('contact_email');
            $obj->objectives = Request::get('objectives');
            $obj->reg_district = Request::get('reg_district');
            $obj->reg_no = Request::get('reg_no');
            $obj->reg_date = Request::get('reg_date');
            $obj->pan_no = Request::get('pan_no');
            $obj->pan_reg_date = Request::get('pan_reg_date');
            $obj->affiliation_no = Request::get('affiliation_no');
            $obj->last_renewal = Request::get('last_renewal');
            $obj->last_audit = Request::get('last_audit');
            $obj->assets = Request::get('assets');
            $obj->status = 'Pending';
            $obj->save();
            Session::put('alert' , ['class' => 'alert-success' , 'msg' => 'Successfully Registered! We are reviewing your Entry.']);

            return Redirect::to(URL::route('createOrganizationRegistration'));

        }





        function generateUserNameFromEmail($email)
        {

            $explode = explode('@' , $email);
            $username = $explode[0];
            $i = 1;
            $return = $username;
            while (User::where('username' , $return)->pluck('username')) {

                $return = $username . $i;
                $i++;
            }

            return $return;
        }





        function checkIfUserEmailExist($email)
        {

            return User::where('email' , $email)->pluck('id');
        }





        private function addUpdateObjective($projectId , $act)
        {

            Activity::where('project_id' , $projectId)->delete();

            $count = count($act['description']);

            for ($i = 0; $i < $count; $i++):
                $actv = new Activity;
                $actv->project_id = $projectId;
                $actv->description = $act['description'][$i];
                $actv->unit = $act['unit'][$i];
                $actv->quantity = $act['quantity'][$i];
                $actv->duration = $act['duration'][$i];
                $actv->period = $act['period'][$i];
                $actv->unit_cost = $act['unit_cost'][$i];
                $actv->total_budget = $act['total_budget'][$i];

                $actv->phase = $act['phase'][$i];
                $actv->save();
                $actv->id = NULL;

            endfor;
        }





        private function getCount($id)
        {

            $data['all'] = Project::where('organization' , $id)->count();
            $data['running'] = Project::where('organization' , $id)->where('status' , 'running')->count();
            $data['completed'] = Project::where('organization' , $id)->where('status' , 'completed')->count();

            return $data;
        }





        private function cleanAmount($input)
        {

            $input = preg_replace("/[^\d.-]/" , "" , $input);

            return $input;
        }





        public function countProjectByOrg()
        {

        }


    }
