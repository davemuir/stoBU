<?php

//use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
//use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Mongap implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function feed()
	{
		# code...
	}


	/**
	 * Filter for user registration
	 *
	 * @var array
	 */
	public static $rules = array(
		'fname'=>'required|alpha_num|min:2',
		'lname'=>'required|alpha_num|min:2',
		'email'=>'required|email|unique:users',
		'password'=>'required|alpha_num|between:7,15|confirmed',
		'password_confirmation'=>'required|alpha_num|between:7,15'
	);

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier() {
		return $this->getKey();
	}

	/*public function isAdmin() {
		return ($this->user_access == 'admin');
	}*/

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword() {
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken() {
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param string $value
	 * @return void
	 */
	public function setRememberToken($value) {
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName() {
		return 'remember_token';
	}



	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail() {
		return $this->email;
	}

	/**
   * Relationship with Company object.
   *
   * @return null
   */
  public function company() {
    return $this->belongsTo('Company');
  }

}

