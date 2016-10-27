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
class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataList    = Organization::all();
        $title       = 'Organizations';
        $createLink  = URL::route('createOrganization') ;
        $editLink    = url('/organizations/edit');
        $deleteLink  = url('/organizations/delete');
        return view('lists.organization' , compact( 'dataList' , 'title' , 'createLink' , 'editLink' , 'deleteLink'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title      = 'Organizations';
        $formAction = URL::route('storeOrganization');
        return view('forms.organization-create' , compact( 'title' , 'formAction' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $obj = new Organization;
        $obj->name          = Request::get('name');
        $obj->introduction  = Request::get('introduction');
        $obj->address       = Request::get('address');
        $obj->contact_person= Request::get('contact_person');
        $obj->objectives    = Request::get('objectives');
        $obj->reg_district  = Request::get('reg_district');
        $obj->reg_no        = Request::get('reg_no');
        $obj->reg_date      = Request::get('reg_date');
        $obj->pan_no        = Request::get('pan_no');
        $obj->pan_reg_date  = Request::get('pan_reg_date');
        $obj->affiliation_no = Request::get('affiliation_no');
        $obj->last_renewal  = Request::get('last_renewal');
        $obj->last_audit    = Request::get('last_audit');
        $obj->assets        = Request::get('assets');
        $obj->status        = Request::get('status');
        $obj->save();
        return Redirect::to( URL::route('getOrganizations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $org  = Organization::where('id',$id)->first();
        $projectList = Project::getProjectsByOrganization( $id );
        return view('details.organization' , compact('org' , 'projectList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title      = 'Organizations';
        $formAction = url('organizations/update/'.$id);
        $record     = Organization::where( 'id' , $id )->first();
        return view('forms.organization-edit' , compact( 'title', 'formAction' , 'record' ));
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
        $obj = Organization::find($id); 
        $obj->name          = Request::get('name');
        $obj->introduction  = Request::get('introduction');
        $obj->address       = Request::get('address');
        $obj->contact_person= Request::get('contact_person');
        $obj->objectives    = Request::get('objectives');
        $obj->reg_district  = Request::get('reg_district');
        $obj->reg_no        = Request::get('reg_no');
        $obj->reg_date      = Request::get('reg_date');
        $obj->pan_no        = Request::get('pan_no');
        $obj->pan_reg_date  = Request::get('pan_reg_date');
        $obj->affiliation_no = Request::get('affiliation_no');
        $obj->last_renewal  = Request::get('last_renewal');
        $obj->last_audit    = Request::get('last_audit');
        $obj->assets        = Request::get('assets');
        $obj->status        = Request::get('status');
        $obj->save();
        return Redirect::to( URL::route('getOrganizations'));
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Organization::where('id' , $id)->delete();
        return Redirect::to( URL::route('getOrganizations'));
    }
}
