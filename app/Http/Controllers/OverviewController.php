<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Sector;
use App\LineOffice;
use App\WorkingZone;
use App\Project;
use App\Activity;
use Request;
use Hash;
use Auth;
use Redirect;
use DB;


class OverviewController extends Controller
{

 public function summary()
     {
         $orgList    	= $this->getOrgList();
         $sectorList 	= $this->getSectorList();
         $zoneList 	 	= $this->getZoneList();
         $lineOfficeList= $this->lineOfficeList();
         $projectList 	= Project::getProjects( NULL , NULL , 10 );
         return view('overview.summary' , compact('orgList' , 'sectorList' , 'zoneList' , 'lineOfficeList' , 'projectList'));
     }

 

 public function budget()
	 {
	 	 $projectList   = Project::all();
         $sectorList 	= $this->getSectorBudget();
         $zoneList 	 	= $this->getZoneBudget();
         return view('overview.budget' , compact('projectList' , 'sectorList' , 'zoneList'));

	 }

 public function objectives()
	 {
	 	 $projectList   = Project::all();
         $orgList 		= Organization::all();
         return view('overview.objectives' , compact('projectList' , 'orgList'));	 	
	 }

 public function activities()
	 {
	 	 $projectList   = $this->getProjectActivities();
         $orgList 		= Organization::all();
         return view('overview.activities' , compact('projectList' , 'orgList'));		 	
	 }


  private function getOrgList()
	  {
		  	$orgs = Organization::all();
		  	$orgList = array();
		  	foreach($orgs as $row):
		  		$row['projects'] = Project::where('organization',$row->id)->get();
		  		array_push($orgList,$row);
		  	endforeach;
		  	return $orgList;
	  }

/* summary section */

 private function getSectorList()
		{
			$sectorList = array();
			$sectors = Sector::all();
			foreach($sectors as $row):
				$row['projects'] = Project::where('area',$row->id)->get();
				array_push($sectorList,$row);
			endforeach;
			return $sectorList;
		}

 private function getZoneList()
	{
			$zoneList = array();
			$zones = WorkingZone::all();
			foreach($zones as $row):
				$row['projects'] = Project::where('working_zone',$row->id)->get();
				array_push($zoneList,$row);
			endforeach;
			return $zoneList;

	}

	private function lineOfficeList()
		{
			$loList = array();
			$los = LineOffice::all();
			foreach($los as $row):
				$row['projects'] = Project::where('line_office',$row->id)->get();
				array_push($loList,$row);
			endforeach;
			return $loList;
		}

 
 /* Budget section */

  private function getSectorBudget()
	 {
			$sectorList = array();
			$sectors = Sector::all();
			foreach($sectors as $row):
				$row['sectorBudget'] = Project::where('sector',$row->id)->sum('budget');
				$row['areaBudget'] = Project::where('area',$row->id)->sum('budget');
				array_push($sectorList,$row);
			endforeach;
			return $sectorList;
	 }

   private function getZoneBudget()
		{
				$zoneList = array();
				$zones = WorkingZone::all();
				foreach($zones as $row):
					$row['zoneBudget'] = Project::where('working_zone',$row->id)->sum('budget');
					array_push($zoneList,$row);
				endforeach;
				return $zoneList;

		}

	/* activities section */
  private function getProjectActivities()
		{
				$projectList = array();
				$projects = Project::all();
				foreach($projects as $row):
					$row['ProjActivities'] = Activity::where('project_id',$row->id)->get();
					array_push($projectList,$row);
				endforeach;
				return $projectList;

		}
}
