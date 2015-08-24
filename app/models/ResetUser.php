<?php

//use Illuminate\Auth\UserTrait;
//use Illuminate\Auth\UserInterface;
//use Illuminate\Auth\Reminders\RemindableTrait;
//use Illuminate\Auth\Reminders\RemindableInterface;

//class RestUser extends Mongap implements UserInterface, RemindableInterface {
class ResetUser extends Mongap {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'resetuser';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	public function feed()
	{
		# code...
	}


	/**
	 * Filter for user registration
	 *
	 * @var array
	 */
	public static $rules = array();

}

