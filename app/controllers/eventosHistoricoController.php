<?php

class EventosHistoricoController extends BaseController {

	public function retrieve() {

		$title = "Eventos";

		$query = DB::table('tbleventos')
			->leftJoin('dbgeral.tblfuncionario', 'dbgeral.tblfuncionario.intfuncionarioid', '=', 'tbleventos.intfuncionarioid')
			->where('tbleventos.bolfinalizar', '=', 1)
			->orderBy('tbleventos.dta_inicioevento', 'desc')
			->paginate(10);

		return View::make('eventos/historico/index', compact('title', 'query'))->with('query', $query);

	}

}