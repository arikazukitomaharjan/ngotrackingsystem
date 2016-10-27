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
        $view      = Request::get('view');
        if( !$view ){
            $view = 10;
        }
        $dataList    = Sector::paginate( $view );
        $title       = 'Sectors';
        $createLink  = URL::route('createSector') ;
        $editLink    = url('/sectors/edit');
        $deleteLink  = url('/sectors/delete');
        $obj = new Project;
        return view('lists.sector' , compact( 'dataList' , 'title' , 'createLink' , 'editLink' , 'deleteLink' , 'obj' ));
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
        return view('forms.sector-create' , compact( 'title' , 'formAction' , 'options' ));
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
        $sector      = Sector::where('id',$id)->first();
        if(!$sector){
            return Redirect::to('/sectors/');
        }
        $view      = Request::get('view');
        if( !$view ){
            $view = 100;
        }
        $obj = new Project;
        $projectList = Project::getProjectsBySector($id , $view ,  NULL );
        return view('details.sector', compact('sector','projectList' , 'obj' ));
    }

    public function showByArea($id)
    {
        $sector      = Sector::where('id',$id)->first();
        if(!$sector){
            return Redirect::to('/sectors/');
        }
        $view      = Request::get('view');
        if( !$view ){
            $view = 10;
        }
        $projectList = Project::getProjectsByArea($id , $view ,  NULL);
        
        $obj = new Project;
        return view('details.sector', compact('sector','projectList' , 'obj' ));
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
        return view('forms.sector-edit' , compact( 'title', 'formAction' , 'record' , 'options'));
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
        $parentId = Sector::where('id',$id)->pluck('parent_id');
        $obj = Sector::find($id); 
        if($parentId){
            
            $obj->parent_id = Request::get('parent_id');
        }
        
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

    public function getSectorsBudget()
    {
        $view      = Request::get('view');
        if( !$view ){
            $view = 100;
        }
        $dataList    = Sector::paginate( $view );
        
        $obj = new Sector;
        return view('lists.sector-budget' , compact( 'dataList' , 'obj' ));
    }


}
