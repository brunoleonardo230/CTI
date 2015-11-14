<?php

class EventosController extends BaseController {

	public function retrieve() {

		$title = "Eventos";

		$hide = "false";

		$funcionarios = DB::table('dbgeral.tblfuncionario')
			->orderBy('dbgeral.tblfuncionario.strfuncionario', 'asc')->get();

		$query = DB::table('tbleventos')
			->leftJoin('dbgeral.tblfuncionario', 'dbgeral.tblfuncionario.intfuncionarioid', '=', 'tbleventos.intfuncionarioid')
			->where('tbleventos.bolativo', '=', 0)
			->where('tbleventos.bolfinalizar', '=', 0)
			->orderBy('tbleventos.dta_inicioevento', 'desc')
			->paginate(5);

		return View::make('eventos/registro/index', compact('title', 'hide', 'query', 'funcionarios'))->with('query', $query);

	}

	public function create() {

		$evento = $_POST['evento'];
		$funcionario = $_POST['funcid'];
		$local = $_POST['local'];
		$data = $_POST['data'];
		$hora = $_POST['hora'];
		$array = explode("/", $data);
		$data = $array[2].'-'.$array[1].'-'.$array[0];

		DB::table('tbleventos')->insertGetId(array(
			'strevento' => "$evento",
			'intfuncionarioid' => "$funcionario",
			'strlocalevento' => "$local",
			'dta_inicioevento' => "$data",
			'hora_evento' => "$hora"));

		return Redirect::action('eventosController@retrieve');
		
	}

	public function data() {

		$title = "Eventos";

		$hide = "true";

		$funcionarios = DB::table('dbgeral.tblfuncionario')
			->orderBy('dbgeral.tblfuncionario.strfuncionario', 'asc')->get();

		$query = DB::table('tbleventos')
			->leftJoin('dbgeral.tblfuncionario', 'dbgeral.tblfuncionario.intfuncionarioid', '=', 'tbleventos.intfuncionarioid')
			->where('tbleventos.bolativo', '=', 0)
			->where('tbleventos.bolfinalizar', '=', 0)
			->orderBy('tbleventos.dta_inicioevento', 'desc')
			->paginate(5);

		$id = $_GET['id'];
		$evento = $_GET['evento'];
		$func = $_GET['func'];
		$funcid = $_GET['funcid'];
		$local = $_GET['local'];
		$data = $_GET['data'];
		$array = explode("-", $data);
		$data = $array[2].'/'.$array[1].'/'.$array[0];
		$hora = $_GET['hora'];
		$observacao = $_GET['obser'];

		return View::make('eventos/registro/index', compact('title', 'hide', 'query', 'funcionarios', 'id', 'evento', 'func', 'funcid', 'local', 'data', 'hora', 'observacao'))->with('query', $query);
		
	}

	public function update() {

		$eventoid = $_POST['eventoid'];
		$evento = $_POST['evento'];
		$funcionarioid = $_POST['funcid'];
		$local = $_POST['local'];
		$data = $_POST['data'];
		$array = explode("/", $data);
		$data = $array[2].'-'.$array[1].'-'.$array[0];
		$hora = $_POST['hora'];
		$obs = $_POST['obs'];
		$finalizar = $_POST['finalizar'];
		if ($finalizar == 's') {
			$finalizar = 1;
		} else {
			$finalizar = 0;
		}

		DB::table('tbleventos')
			->where('inteventoid', '=', "$eventoid")
			->update(array(
				'strevento' => "$evento",
				'intfuncionarioid' => "$funcionarioid",
				'strlocalevento' => "$local",
				'strobservacao' => "$obs",
				'bolfinalizar' => "$finalizar",
				'dta_inicioevento' => "$data",
				'hora_evento' => "$hora"));

		return Redirect::action('eventosController@retrieve');
		
	}

	public function delete() {

		$id = $_GET['id'];

		DB::table('tbleventos')
			->where('inteventoid', '=', "$id")
			->update(array('bolativo' => 1));

		return Redirect::action('eventosController@retrieve');
		
	}

}