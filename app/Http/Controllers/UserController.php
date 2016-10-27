<?php
    namespace App\Http\Controllers;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Request;
    use Hash;
    use Auth;
    use Redirect;
    use Session;
    use Validator;
    use App\UserprofileTemp;
    use App\Usermeta;
    use App\Userprofile;
    use Config;
    use App\Memberforclient;
    use Excel;
    use Image;
    use App\Project;
    use App\User;
    use App\WorkingZone;
    use App\Organization;
    use App\Activity;

    class UserController extends Controller
    {


        public function getLogin()
        {

            $user = Auth::user();
            if ($user) {
                $role = $user->role;
                if ($role == 'Admin') {

                    return Redirect::to('/dashboard/');

                } else if ($role == 'Organization') {

                    return Redirect::to('/dashboard/organization/');

                } else if ($role == 'Administrator') {

                    return Redirect::to('/administrator/');
                }
            }

            return view('login');
        }





        public function postLogin()
        {

            $column = 'username';
            $username = trim(Request::get('username'));
            $password = trim(Request::get('password'));
            if (filter_var($username , FILTER_VALIDATE_EMAIL)) {
                $column = 'email';
            }

            if (Auth::attempt([$column => $username , 'password' => $password])) {
                $user = Auth::user();
                $role = $user->role;
                if ($user->role == 'Organization') {

                    if ($user->status == 'Pending') {
                        dd('Your Account has not been Approved!!');
                    }

                }

                if ($role == 'Admin') {

                    return Redirect::to('/dashboard/');

                } else if ($role == 'Organization') {

                    return Redirect::to('/organization/' . $user->username);

                } else if ($role == 'Administrator') {

                    return Redirect::to('/administrator/');
                }

            } else {

                Session::flash('message' , 'The email/username and password combination is invalid!');

                return Redirect::to('/login');
            }
        }





        public function getAdminstratorDashboard()
        {

            $projectList = Project::getProjectAdministrator('' );
            $counts = $this->getCount();
            $obj = new Project;
            $wz = new WorkingZone;
            //            $vdcs = WorkingZone::where('tier' , 2)->where('scope' , 'district')->where('parent_id' , '=' , 0)->get();
            $districts = WorkingZone::where('tier' , 2)->where('scope' , 'district')->get();

            return view('administrator.dashboard' , compact('projectList' , 'counts' , 'obj' , 'wz' , 'districts'));
        }





        public function getUser()
        {

            $view = Request::get('view');
            if (!$view) {

                $view = 10;
            }
            $userList = User::getUser($view);

            return view('administrator.lists.user' , compact('userList'));
        }





        public function createUser()
        {

            $districts = $this->getDistricts();

            return view('administrator.forms.user-create' , compact('districts'));
        }





        public function storeUser()
        {

            $user = new User;
            $user->first_name = Request::get('first_name');
            $user->last_name = Request::get('last_name');
            $user->role = 'Admin';
            $user->email = Request::get('email');
            $user->username = $this->generateUserNameFromEmail($user->email);
            $user->password = Hash::make(Request::get('password'));
            $user->working_zone = Request::get('district');
            $user->status = 'active';
            $user->save();

            return Redirect::to('/administrator/user');
        }





        public function editUser($id)
        {

            $districts = $this->getDistricts();
            $user = User::where('id' , $id)->first();

            return view('administrator.forms.user-edit' , compact('districts' , 'user'));
        }





        public function updateUser($id)
        {

            $user = User::find($id);
            $user->first_name = Request::get('first_name');
            $user->last_name = Request::get('last_name');
            $user->role = 'Admin';
            $user->email = Request::get('email');
            if (trim(Request::get('password'))) {
                $user->password = Hash::make(Request::get('password'));
            }

            $user->working_zone = Request::get('district');
            $user->status = 'active';
            $user->save();

            return Redirect::to('/administrator/user');
        }





        public function deleteUser($id)
        {

            User::where('id' , $id)->delete();

            return Redirect::to('/administrator/user');
        }





        public function getOrgs()
        {

            $view = Request::get('view');
            if (!$view) {

                $view = 10;
            }
            $dataList = Organization::paginate($view);

            return view('administrator.lists.organization' , compact('dataList'));

        }





        public function getProjectByDistrict($district_id)
        {

            $projectList = Project::getProjectByDistrict($district_id , 10);

            return view('administrator.details.projectByDistrict' , compact('projectList'));
        }





        public function getOrgDetail($id)
        {

            $org = Organization::where('id' , $id)->first();
            if (!$org) {

                return Redirect::to('/administrator');
            }
            $view = Request::get('view');
            if (!$view) {

                $view = 10;
            }
            $obj = new Project;
            $projectList = Project::getProjectsByOrganization('' , '' , $view , $id);

            return view('administrator.details.organization' , compact('org' , 'projectList' , 'obj'));
        }





        public function getProjectDetail($id)
        {

            $project = Project::getProjectDetail($id);
            $activities = Activity::where('project_id' , $id)->get();
            $obj = new Project;

            return view('administrator.details.project' , compact('project' , 'activities' , 'obj'));

        }





        public function getProjs()
        {

            $view = Request::get('view');
            if (!$view) {
                $view = 10;
            }
            $projectList = Project::getAdminProjects('' , '' , $view);
            $counts = $this->getCount();
            $obj = new Project;

            return view('administrator.lists.projects' , compact('projectList' , 'counts' , 'obj'));
        }





        private function getDistricts()
        {

            $districts = WorkingZone::where('scope' , 'district')->get();

            foreach ($districts as $dis) {
                $arr[$dis->id] = $dis->name;

            }

            return $arr;
        }





        private function getCount()
        {

            $data['all'] = Project::count();
            $data['running'] = Project::where('status' , 'running')->count();
            $data['completed'] = Project::where('status' , 'completed')->count();

            return $data;
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





        public function getProjectAdministrator()
        {

            $district = Auth::User()->working_zone;
            $searchKey = Request::get('q');

            $projectList = Project::getProjectAdministrator($searchKey );
            $obj = new Project;

            return view('administrator.lists.project' , compact('projectList' , 'obj' , 'searchKey'));
        }





        public function logout()
        {

            Auth::logout();
            Session::flush();

            return Redirect::to('/');
        }
        public function export(Project $project){

            $excels=$project->all();
            Excel::create('project', function($excel) use($excels) {
                $excel->sheet('Sheet 1', function($sheet) use($excels) {
                    $sheet->fromArray($excels);
                });
            })->export('xls');
        }


    }
