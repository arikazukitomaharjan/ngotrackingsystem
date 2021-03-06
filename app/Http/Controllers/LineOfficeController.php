<?php

    namespace App\Http\Controllers;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Request;
    use Hash;
    use Auth;
    use Redirect;
    use Session;
    use App\LineOffice;
    use URL;
    use App\Project;

    class LineOfficeController extends Controller
    {

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {

            $view = Request::get('view');
            if (!$view) {
                $view = 10;
            }
            $dataList = LineOffice::paginate($view);
            $title = 'Line Offices';
            $createLink = URL::route('createLineOffice');
            $editLink = url('/line-offices/edit');
            $deleteLink = url('/line-offices/delete');

            return view('lists.line-office' , compact('dataList' , 'title' , 'createLink' , 'editLink' , 'deleteLink'));
        }





        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {

            $title = 'Line Offices';
            $formAction = URL::route('storeLineOffice');

            return view('forms.line-office-create' , compact('title' , 'formAction'));
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

            $obj = new LineOffice;
            $obj->name = Request::get('name');
            $obj->status = Request::get('status');
            $obj->save();

            return Redirect::to(URL::route('getLineOffices'));
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

            $view = Request::get('view');
            if (!$view) {
                $view = 10;
            }
            $lineoffice = LineOffice::where('id' , $id)->first();
            if (!$lineoffice) {
                return Redirect::to('/line-offices/');
            }

            $obj = new Project;
            $projectList = Project::getProjectsByLineOfficeAdmin($id , $view);
          

            return view('details.line-office' , compact('lineoffice' , 'projectList' , 'obj'));
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

            $title = 'Line Offices';
            $formAction = url('line-offices/update/' . $id);
            $record = LineOffice::where('id' , $id)->first();

            return view('forms.line-office-edit' , compact('title' , 'formAction' , 'record'));
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

            $obj = LineOffice::find($id);
            $obj->name = Request::get('name');
            $obj->status = Request::get('status');
            $obj->save();

            return Redirect::to(URL::route('getLineOffices'));
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

            LineOffice::where('id' , $id)->delete();

            return Redirect::to(URL::route('getLineOffices'));
        }
    }
