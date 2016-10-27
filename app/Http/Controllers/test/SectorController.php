<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Hash;
use Auth;
use Redirect;
use Session;
use App\Sector;
use URL;
use App\Project;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataList    = Sector::all();
        $title       = 'Sectors';
        $createLink  = URL::route('createSector') ;
        $editLink    = url('/sectors/edit');
        $deleteLink  = url('/sectors/delete');
        return view('lists.sector' , compact( 'dataList' , 'title' , 'createLink' , 'editLink' , 'deleteLink'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title      = 'Sectors';
        $formAction = URL::route('storeSector');
        $options    = $this->getMainSectorOptions();
        return view('forms.sector-create-form' , compact( 'title' , 'formAction' , 'options' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $obj = new Sector;
        $obj->parent_id = Request::get('parent_id');
        $obj->name   = Request::get('name');
        $obj->status = Request::get('status');
        $obj->save();
        return Redirect::to( URL::route('getSectors'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sector      = Sector::where('id',$id)->pluck('name');
        $projectList = Project::getProjectsBySector($id);
        return view('details.sector', compact('sector','projectList'));
    }

    public function showByArea($id)
    {
        $sector      = Sector::where('id',$id)->pluck('name');
        $projectList = Project::getProjectsByArea($id);
        return view('details.sector', compact('sector','projectList'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title      = 'Sectors';
        $formAction = url('sectors/update/'.$id);
        $options    = $this->getMainSectorOptions();
        $record     = Sector::where( 'id' , $id )->first();
        return view('forms.sector-edit-form' , compact( 'title', 'formAction' , 'record' , 'options'));
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
        $obj = Sector::find($id); 
        $obj->parent_id = Request::get('parent_id');
        $obj->name     = Request::get('name');
        $obj->status   = Request::get('status');
        $obj->save();
        return Redirect::to( URL::route('getSectors'));
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sector::where('id' , $id)->delete();
        return Redirect::to( URL::route('getSectors'));
    }

    private function getMainSectorOptions()
    {
        $sectors = Sector::where('status','published')->get();
        $options = array('0'=>'Select Main Sector');
        foreach($sectors as $sector):
            if($sector->parent_id>0):
                continue;
            endif;
            $options[$sector->id] = $sector->name;
        endforeach;
        return $options;
    }
}
