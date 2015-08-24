<?php

class CRMUsers extends Mongap {

  /**
   * The database collection used by the model.
   *
   * @var string
   */
//	protected $collection = 'assets';
	protected $table = 'CRMUsers';
	public static $rules = array(
		'first_name' => 'required|alpha_num|min:2',
		'last_name'  => 'required|alpha_num|min:2',
		'email'      => 'required|email'
	);
	//----------------------------------------
    function __construct(){
    }
	//----------------------------------------
	/*public function company(){
		return $this->belongsTo('Company');
	}
	//----------------------------------------
	public function feed(){
		# code...
	}
	//----------------------------------------*/
}