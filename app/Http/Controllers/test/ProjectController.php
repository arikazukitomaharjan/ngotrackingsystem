<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Area;
use App\Sector;
use App\WorkingZone;
use App\LineOffice;
use App\Project;
use Request;
use Hash;
use Auth;
use Redirect;
use Session;
use Validator;
use Config;
use Excel;
use Image;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $status = NULL )
    {
        $projectList = Project::getProjects( $status );
        $counts = $this->getCount();
        return view('project-list' , compact( 'projectList' , 'counts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orgList    = Organization::where('status','Published')->get();
        $areaList   = Area::where('status','Published')->get();
        $sectorList = Sector::where('status','Published')->get();
        $lineList   = LineOffice::where('status','Published')->get();
        $zoneList   = WorkingZone::where('status','Published')->get();
        return view('project-create-form' , compact( 'orgList' , 'areaList' , 'sectorList' , 'lineList' , 'zoneList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parentSector = Sector::where('id',Request::get('sector'))->pluck('parent_id');
        $project = new Project;
        $project->title         = Request::get('title');
        $project->organization  = Request::get('organization');
        $project->sector        = $parentSector;
        $project->area          = Request::get('sector');
        $project->working_zone  = Request::get('working_zone');
        $project->line_office   = Request::get('line_office');
        $project->start_date    = Request::get('start_date');
        $project->end_date      = Request::get('end_date');
        $project->budget        = Request::get('budget');
        $project->targeted_group= Request::get('targeted_group');
        $project->objectives    = nl2br(Request::get('objectives'));
        $project->activities    = nl2br(Request::get('activities'));
        $project->remark        = nl2br(Request::get('remark'));
        $project->status        = Request::get('status');
        $project->save();
        return Redirect::to('/projects');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
       $project = Project::getProjectDetail( $id );
       return view('project-detail' , compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::where( 'id' , $id )->first();
        if(!$project){
            return view('errors.missing');
        }
        $orgList    = Organization::where('status','Published')->get();
        $areaList   = Area::where('status','Published')->get();
        $sectorList = Sector::where('status','Published')->get();
        $lineList   = LineOffice::where('status','Published')->get();
        $zoneList   = WorkingZone::where('status','Published')->get();
        return view('project-edit-form', compact( 'project' , 'orgList' , 'areaList' , 'sectorList' , 'lineList' , 'zoneList' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $parentSector = Sector::where('id',Request::get('sector'))->pluck('parent_id');
        $project = Project::find($id);
        $project->title         = Request::get('title');
        $project->organization  = Request::get('organization');
        $project->sector        = $parentSector;
        $project->area          = Request::get('sector');
        $project->working_zone  = Request::get('working_zone');
        $project->line_office   = Request::get('line_office');
        $project->start_date    = Request::get('start_date');
        $project->end_date      = Request::get('end_date');
        $project->budget        = Request::get('budget');
        $project->targeted_group= Request::get('targeted_group');
        $project->objectives    = nl2br(Request::get('objectives'));
        $project->activities    = nl2br(Request::get('activities'));
        $project->remark        = nl2br(Request::get('remark'));
        $project->status        = Request::get('status');
        $project->save();
        return Redirect::to('/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::where( 'id' , $id )->delete();
        return Redirect::to('/projects');
    }

     private function getCount()
        {
            $data['all'] = Project::count();
            $data['running'] = Project::where('status','running')->count();
            $data['completed'] = Project::where('status','completed')->count();
            return $data;
        }
}
