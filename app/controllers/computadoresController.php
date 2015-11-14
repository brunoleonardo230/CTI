<?php

class ComputadoresController extends BaseController {

	public function retrieve() {

		$title = "Computadores";

		$hide = "false";

		$polos = DB::table('dbgeral.tblpolo')
			->orderBy('dbgeral.tblpolo.strpolo', 'asc')->get();

		$query = DB::table('dbgeral.tblpolo')
			->leftJoin('tblcpu', 'dbgeral.tblpolo.intpoloid', '=', 'tblcpu.intpoloid')
			->orderBy('dbgeral.tblpolo.strpolo', 'asc')->get();

		return View::make('administracao/computadores/index', compact('query', 'polos','title', 'hide'));

	}

	public function create() {

		$strnomecpu = $_POST['cpu'];
		$intpoloid = $_POST['poloid'];

		$strnomecpu = strtoupper("$strnomecpu");

		DB::table('tblcpu')->insertGetId(array(
			'strnomecpu' => "$strnomecpu",
			'intpoloid' => "$intpoloid"));

		return Redirect::action('computadoresController@retrieve');
	}

	public function data() {

		$title = 'Computadores';

		$query = DB::table('dbgeral.tblpolo')
			->leftJoin('tblcpu', 'dbgeral.tblpolo.intpoloid', '=', 'tblcpu.intpoloid')
			->orderBy('dbgeral.tblpolo.strpolo', 'asc')->get();

		$item = $_GET['item'];
		$id = $_GET['id'];

		$hide = "true";

		return View::make('administracao/computadores/index', compact('item', 'id', 'hide', 'query', 'title'));

	}

	public function update() {

		$intcpuid = $_POST['cpuid'];
		$strnomecpu = $_POST['cpu'];

		$strnomecpu = strtoupper("$strnomecpu");

		DB::table('tblcpu')
			->where('idcpu', '=', "$intcpuid")
			->update(array('strnomecpu' => "$strnomecpu"));

		return Redirect::action('computadoresController@retrieve');

	}

	public function delete() {

		$id = $_GET['id'];

		DB::table('tblcpu')
			->where('idcpu', '=', "$id")->delete();

		return Redirect::action('computadoresController@retrieve');

	}

}