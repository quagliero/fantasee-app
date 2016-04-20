<?php

namespace Fantasee;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


	/**
	* Password should be encrypted
	*
	* @var array
	*/
	public function setPasswordAttribute($input)
	{
		$this->attributes['password'] = \Hash::make($input);
	}

	/**
	* All leagues attached to this user.
	*
	* @return array
	*/
	public function leagues()
	{
		return $this->hasMany('Fantasee\League');
	}

}
