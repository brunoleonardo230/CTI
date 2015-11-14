<?php

class ProblemasController extends BaseController {

	public function retrieve() {

		$title = "Problemas";

		$hide = "false";

		$problems = DB::table('tblproblems')
			->orderBy('tblproblems.strproblema', 'asc')->get();

		$query = DB::table('tblproblems')
			->leftJoin('tblsubproblems', 'tblproblems.intproblemid', '=', 'tblsubproblems.intproblemid')
			->orderBy('tblproblems.strproblema', 'asc')->get();

		return View::make('administracao/problemas/index', compact('query', 'problems', 'title', 'hide'));

	}

	public function create() {

		$strsubproblema = $_POST['subproblem'];
		$intproblemid = $_POST['problemid'];

		$strsubproblema = strtoupper("$strsubproblema");

		DB::table('tblsubproblems')->insertGetId(array(
			'strsubproblema' => "$strsubproblema",
			'intproblemid' => "$intproblemid"));

		return Redirect::action('problemasController@retrieve');

	}

	public function data() {

		$title = "Problemas";

		$query = DB::table('tblproblems')
			->leftJoin('tblsubproblems', 'tblproblems.intproblemid', '=', 'tblsubproblems.intproblemid')
			->orderBy('tblproblems.strproblema', 'asc')->get();

		$item = $_GET['item'];
		$id = $_GET['id'];

		$hide = "true";

		return View::make('administracao/problemas/index', compact('item', 'id', 'hide', 'query', 'title'));

	}

	public function update() {

		$intproblemid = $_POST['problemid'];
		$strsubproblema = $_POST['subproblem'];

		$strsubproblema = strtoupper("$strsubproblema");

		DB::table('tblsubproblems')
			->where('intsubproblemid', '=', "$intproblemid")
			->update(array('strsubproblema' => "$strsubproblema"));

		return Redirect::action('problemasController@retrieve');

	}

	public function delete() {

		$id = $_GET['id'];

		DB::table('tblsubproblems')
			->where('intsubproblemid', '=', "$id")->delete();

		return Redirect::action('problemasController@retrieve');

	}

}