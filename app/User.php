<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
	use Notifiable;
	use HasRoles;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function employee() {
		return $this->hasOne('App\Models\Employee\Employee');
	}

	public function getProfile() {

		$profile = $this->employee;

		return $profile;
	}

	public function getNameAttribute() {
		$profile = $this->getProfile();
		return (isset($profile->first_name) ? $profile->first_name : '') . (isset($profile->middle_name) ? ' ' . $profile->middle_name : '') . (isset($profile->last_name) ? ' ' . $profile->last_name : '');
	}

	public function getNameWithEmailAttribute() {
		$profile = $this->getProfile();

		return $profile->first_name . ' ' . $profile->middle_name . ' ' . $profile->last_name . ' (' . $this->email . ')';
	}

}
