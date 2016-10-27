<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Hash;
use Auth;
use Redirect;
use Session;
use App\Area;
use URL;
use App\Sector;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataList    = Area::all();
        $title       = 'Areas';
        $createLink  = URL::route('createArea') ;
        $editLink    = url('/areas/edit');
        $deleteLink  = url('/areas/delete');
        return view('record-list' , compact( 'dataList' , 'title' , 'createLink' , 'editLink' , 'deleteLink'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title      = 'Areas';
        $formAction = URL::route('storeArea');
        $sectorList = Sector::where('status','published')->get();
        return view('forms.area-create-form' , compact( 'title' , 'sectorList' , 'formAction' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $obj = new Area;
        $obj->name   = Request::get('name');
        $obj->status = Request::get('status');
        $obj->save();
        return Redirect::to( URL::route('getAreas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title      = 'Areas';
        $formAction = url('areas/update/'.$id);
        $options    = $this->getMainSectorOptions();
        $record     = Area::where( 'id' , $id )->first();
        return view('forms.sector-edit' , compact( 'title', 'formAction' , 'record' , 'options' ));
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
        $obj = Area::find($id); 
        $obj->name     = Request::get('name');
        $obj->status   = Request::get('status');
        $obj->save();
        return Redirect::to( URL::route('getAreas'));
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Area::where('id' , $id)->delete();
        return Redirect::to( URL::route('getAreas'));
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
