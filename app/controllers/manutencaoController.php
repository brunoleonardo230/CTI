<?php

class ManutencaoController extends BaseController {

	public function retrieve() {

		$title = "Manutenção";

		$hide = "false";

		$polos = DB::table('dbgeral.tblpolo')
			->orderBy('dbgeral.tblpolo.strpolo', 'asc')->get();

		$cpus = DB::table('tblcpu')
			->orderBy('tblcpu.strnomecpu', 'asc')->get();

		$funcionarios = DB::table('dbgeral.tblfuncionario')
			->orderBy('dbgeral.tblfuncionario.strfuncionario', 'asc')->get();

		$query = DB::table('tblmanutencaopreventiva')
			->leftJoin('dbgeral.tblfuncionario', 'dbgeral.tblfuncionario.intfuncionarioid', '=', 'tblmanutencaopreventiva.intfuncionarioid')
			->leftJoin('tblcpu', 'tblcpu.idcpu', '=', 'tblmanutencaopreventiva.idcpu')
			->leftJoin('dbgeral.tblpolo', 'dbgeral.tblpolo.intpoloid', '=', 'tblmanutencaopreventiva.intpoloid')
			->where('tblmanutencaopreventiva.bolativo', '=', 0)
			->where('tblmanutencaopreventiva.bolfinalizar', '=', 0)
			->orderBy('tblmanutencaopreventiva.dta_manutencao', 'desc')
			->paginate(5);

		return View::make('manutencao/registro/index', compact('title', 'hide', 'polos', 'cpus', 'query', 'funcionarios'))->with('query', $query);

	}

	public function selectCpuAjax($intpoloid) {

		$cpus = DB::table('tblcpu')
			->where('tblcpu.intpoloid', '=', "$intpoloid")
			->orderBy('tblcpu.strnomecpu', 'asc')->get();

		return View::make('manutencao/registro/selectCpuAjax', compact('cpus'));

	}

	public function create() {

		$funcid = 116;
		$cpuid = $_POST['cpuid'];
		$intpoloid = $_POST['poloid'];
		$data = date('Y-m-d');
		$horaInicial = date('H:i:s');

		DB::table('tblmanutencaopreventiva')
			->insertGetId(array(
				'idcpu' => "$cpuid",
				'dta_manutencao' => "$data",
				'hora_inicial' => "$horaInicial",
				'intpoloid' => "$intpoloid",
				'intfuncionarioid' => "$funcid"));

		return Redirect::action('manutencaoController@retrieve');

	}

	public function data() {

		$title = "Manutenção";

		$hide = "true";

		$show = "false";

		$problems = DB::table('tblproblem')
			->orderBy('strproblem', 'asc')->get();

		$subproblems = DB::table('tblsubproblem')
			->orderBy('strsubproblem', 'asc')->get();

		$polos = DB::table('dbgeral.tblpolo')
			->orderBy('dbgeral.tblpolo.strpolo', 'asc')->get();

		$cpus = DB::table('dbgeral.tblpolo')
			->join('tblcpu', 'dbgeral.tblpolo.intpoloid', '=', 'tblcpu.intpoloid')
			->orderBy('tblcpu.strnomecpu', 'asc')->get();

		$funcionarios = DB::table('dbgeral.tblfuncionario')
			->orderBy('dbgeral.tblfuncionario.strfuncionario', 'asc')->get();

		$query = DB::table('tblmanutencaopreventiva')
			->leftJoin('dbgeral.tblfuncionario', 'dbgeral.tblfuncionario.intfuncionarioid', '=', 'tblmanutencaopreventiva.intfuncionarioid')
			->leftJoin('tblcpu', 'tblcpu.idcpu', '=', 'tblmanutencaopreventiva.idcpu')
			->leftJoin('dbgeral.tblpolo', 'dbgeral.tblpolo.intpoloid', '=', 'tblmanutencaopreventiva.intpoloid')
			->where('tblmanutencaopreventiva.bolativo', '=', 0)
			->where('tblmanutencaopreventiva.bolfinalizar', '=', 0)
			->orderBy('tblmanutencaopreventiva.dta_manutencao', 'desc')
			->paginate(5);

			$id = $_GET['id'];
			$polo = $_GET['polo'];
			$poloid = $_GET['poloid'];
			$cpu = $_GET['cpu'];
			$cpuid = $_GET['cpuid'];
			$func = $_GET['func'];
			$funcid = $_GET['funcid'];
			$observacao = $_GET['obs'];
			$checked = " ";
			$check = $_GET['check'];
			if($check == 1) {
				$checked = "checked";
				$show = "true";
			}

		return View::make('manutencao/registro/index', compact('title', 'hide', 'show', 'problems', 'subproblems', 'polos', 'cpus', 'query', 'funcionarios', 'id', 'polo', 'poloid', 'cpu', 'cpuid', 'func', 'funcid', 'observacao', 'checked', 'check'))->with('query', $query);

	}

	public function update() {

		$manutencaoid = $_POST['manutencaoid'];
		$obs = $_POST['obs'];
		$recolido = $_POST['recolhido'];
		if($recolido == 's') {
			$recolido = 1;
		} else {
			$recolido = 0;
		}
		$finalizar = $_POST['finalizar'];
		if($finalizar == 's') {
			$finalizar = 1;
			$horaFim = date('H:i:s');
		} else {
			$finalizar = 0;
			$horaFim = "00:00:00";
		}

		DB::table('tblmanutencaopreventiva')
			->where('intmanutencaopreventivaid', '=', "$manutencaoid")
			->update(array(
				'laudo_manutencao' => "$obs",
				'bolfinalizar' => "$finalizar",
				'hora_final' => "$horaFim",
				'bolrecolhido' => "$recolido"));

		return Redirect::action('manutencaoController@retrieve');

	}

	public function delete() {

		$id = $_GET['id'];

		DB::table('tblmanutencaopreventiva')
			->where('intmanutencaopreventivaid', '=', "$id")
			->update(array('bolativo' => 1));

		return Redirect::action('manutencaoController@retrieve');

	}

}