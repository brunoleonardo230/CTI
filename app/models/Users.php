<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
 
class Users extends Eloquent implements UserInterface {

	protected $table = 'dbgeral.tblusuario';

	protected $hidden = array('strsenha');

	public function getAuthIdentifier() {

		return $this->getKey();

	}
 
	public function getAuthPassword() {

		return $this->strsenha;

	}

	public function getReminderUser() {

		return $this->strusuario;

	}

	public function getRememberToken() {

	    return $this->remember_token;

	}

	public function setRememberToken($value) {

	    $this->remember_token = $value;

	}

	public function getRememberTokenName() {

	    return 'remember_token';

	}

}