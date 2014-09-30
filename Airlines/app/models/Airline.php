<?php

class Airline extends Eloquent {
	
	   protected $primaryKey = "ApID";
     protected $table = 'airport';
     //public $timestamps = false;
     // protected $fillable;

     /*static public $rules = ['prodcode'=>'required|alpha_num|max:6',
                             'prodname'=>'required'];                       

     static function setRules()
     {
     	return self::$rules;
     }                      */
}