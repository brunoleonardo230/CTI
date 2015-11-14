<?php 

class Problems extends Eloquent{

	protected $problems = DB::table('tblproblems')->get();

	protected $subproblems = DB::table('tblsubproblems')->get();

	public function problems() {
		
		return $problems;

	}

	public function subproblems() {

		return $subproblems;

	}

}