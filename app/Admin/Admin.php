<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;

class Admin extends Model
{
	protected $table = 'users';
    //

    public static function getSearchResult(  $role , $input )
	    {
	    	$name 		= @$input['name'];
	    	$min_taille = floor(@$input['min_taille']);
	    	$max_taille = ceil(@$input['max_taille']);
	    	$region 	= @$input['region'];
	    	$where = " WHERE u.role = '".$role."' ";
	    	if($name){
	    		$where .= " AND  u.firstName LIKE '%".$name."%' " ;
	    	}

	    	if($min_taille){
	    		$where .= " AND  up.taille  > '".$min_taille."' " ;
	    	}

	    	if($max_taille){
	    		$where .= " AND  up.taille  < '".$max_taille."' " ;
	    	}
	    	if($region){
	    		$where .= " AND  u.region  = '".$region."' " ;
	    	}
	    	$query = "SELECT * FROM users u LEFT JOIN userprofile up ON u.id=up.user_id ". $where. "ORDER BY u.id DESC"; 
			return DB::select( DB::raw( $query  ) );
	    }
}
