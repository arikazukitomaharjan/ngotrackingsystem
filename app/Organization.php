<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Organization extends Model
{
    protected $table = 'organizations';

    public static function getBudgetByOrganization( $id )
    {
	          return DB::table('projects')->where('organization' , $id )->sum('budget_rs');

    }
}
