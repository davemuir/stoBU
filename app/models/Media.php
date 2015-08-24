<?php

class Media extends Mongap {

  /**
   * The database collection used by the model.
   *
   * @var string
   */
//	protected $collection = 'assets';
	protected $table = 'media';
	public static $rules = array();
	//----------------------------------------
    function __construct(){
    }
	//----------------------------------------
	public function company(){
		return $this->belongsTo('Company');
	}
	//----------------------------------------
	public function feed(){
		# code...
	}
	//----------------------------------------
}