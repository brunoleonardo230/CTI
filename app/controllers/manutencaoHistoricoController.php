<?php

class ManutencaoHistoricoController extends BaseController {

	public function retrieve() {

		$title = "Manutenção";

		$query = DB::table('tblmanutencaopreventiva')
			->leftJoin('dbgeral.tblfuncionario', 'dbgeral.tblfuncionario.intfuncionarioid', '=', 'tblmanutencaopreventiva.intfuncionarioid')
			->leftJoin('tblcpu', 'tblcpu.idcpu', '=', 'tblmanutencaopreventiva.idcpu')
			->leftJoin('dbgeral.tblpolo', 'dbgeral.tblpolo.intpoloid', '=', 'tblmanutencaopreventiva.intpoloid')
			->where('tblmanutencaopreventiva.bolfinalizar', '=', 1)
			->orderBy('tblmanutencaopreventiva.dta_manutencao', 'desc')
			->paginate(10);

		return View::make('manutencao/historico/index', compact('title', 'query'))->with('query', $query);

	}

}