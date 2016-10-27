<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Area;
use App\Sector;
use App\LineOffice;
use App\WorkingZone;
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


class AppController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	
    }

    public function getDashboard()
        {
            $projectList = Project::getProjects();
            $counts = $this->getCount(); 
            return view('dashboard' , compact( 'projectList' , 'counts' ));
        }

    private function getCount()
        {
            $data['all'] = Project::count();
            $data['running'] = Project::where('status','running')->count();
            $data['completed'] = Project::where('status','completed')->count();
            return $data;
        }
}
