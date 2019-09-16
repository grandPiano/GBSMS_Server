<?php
namespace App\Models;

use \Illuminate\Database\Eloquent\Model as El_Model;


class TM_TripCostings extends El_Model{
	protected $table = "tm_trip_costings";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
       "trip_id","type","purpose","description","requested_amt","requested_date","given","given_date","given_amt","qty",
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }

}



?>