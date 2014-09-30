<?php

class Airline extends Eloquent {
	
	 protected $primaryKey = "ApID";
     protected $table = 'airport';
     //public $timestamps = false;
     /*protected $fillable = ['prodcode','prodname',
                           'prodtype','prodqty',
                           'prodprice','prodrlevel',
                           'prodrquant'];*/

     static public $rules = ['FlightDate'=>'required'];                       

     static function setRules()
     {
     	return self::$rules;
     }                      
}