<?php

    namespace App\Http\Controllers;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Request;
    use Hash;
    use Auth;
    use Redirect;
    use Session;
    use App\WorkingZone;
    use App\Project;
    use URL;

    class WorkingZoneController extends Controller
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
            $dataList = WorkingZone::where('scope' , 'vdc')->where('parent_id' , '=' , $wd)->paginate($view);
            $title = 'Working Zones';
            $createLink = URL::route('createWorkingZone');
            $editLink = url('/working-zones/edit');
            $deleteLink = url('/working-zones/delete');

            return view('lists.working-zone' , compact('dataList' , 'title' , 'createLink' , 'editLink' , 'deleteLink'));
        }





        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {

            $title = 'Working Zones';
            $formAction = URL::route('storeWorkingZone');
//           $districtList = WorkingZone::where('status' , 'Published')->where('parent_id' , '=' , 0)->get();

            return view('forms.working-zone-create' , compact('title' , 'formAction' ));
        }

//


        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {

            $user = Auth::user();
            $wd = $user->working_zone;
            $obj = new WorkingZone;
            $obj->name = Request::get('name');

            $obj->tier = 1;
            $obj->parent_id = $wd;

            $obj->scope = 'vdc';
            $obj->status = Request::get('status');
            $obj->save();

            return Redirect::to(URL::route('getWorkingZones'));
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

            $workingzone = WorkingZone::where('id' , $id)->first();
            if (!$workingzone) {
                return Redirect::to('/working-zones');
            }
            $view = Request::get('view');
            if (!$view) {
                $view = 100;
            }
            $projectList = Project::getProjectsByWorkingZone($id , $view , NULL);
            $counts = $this->getCount($id);
            $obj = new Project;

            return view('details.working-zone' , compact('workingzone' , 'projectList' , 'counts' , 'obj'));
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

            $title = 'Woking sZone';
            $formAction = url('working-zones/update/' . $id);
            $record = WorkingZone::where('id' , $id)->first();

            return view('forms.working-zone-edit' , compact('title' , 'formAction' , 'record'));
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

            $obj = WorkingZone::find($id);
            $user = Auth::user();
            $wd = $user->working_zone;

            $obj->name = Request::get('name');
            $obj->status = Request::get('status');
            $obj->tier = 1;
            $obj->parent_id = $wd;
            $obj->save();

            return Redirect::to(URL::route('getWorkingZones'));
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

            WorkingZone::where('id' , $id)->delete();

            return Redirect::to(URL::route('getWorkingZones'));
        }





        private function getCount($id)
        {

            $data['all'] = Project::where('working_zone' , $id)->count();
            $data['running'] = Project::where('status' , 'running')->where('working_zone' , $id)->count();
            $data['completed'] = Project::where('status' , 'completed')->where('working_zone' , $id)->count();
            $data['budget'] = Project::where('working_zone' , $id)->sum('budget');

            return $data;
        }





        public function getWorkingZonesBudget()
        {

            $district = Auth::User()->district;
            $view = Request::get('view');
            if (!$view) {
                $view = 10;
            }
            $dataList = WorkingZone::where('parent_id' , $district)->paginate($view);
            $obj = new WorkingZone;

            return view('lists.working-zone-budget' , compact('dataList' , 'obj'));
        }
    }
