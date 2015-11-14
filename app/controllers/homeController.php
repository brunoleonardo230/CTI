<?php

class HomeController extends BaseController {


	public function index() {

		$title = 'Início';

		$eventos = DB::table('tbleventos')
			->leftJoin('dbgeral.tblfuncionario', 'dbgeral.tblfuncionario.intfuncionarioid', '=', 'tbleventos.intfuncionarioid')
			->where('tbleventos.bolfinalizar', '=', 0)
			->orderBy('tbleventos.dta_inicioevento', 'desc')
			->get();

		$chamados = DB::table('tblchamados')
			->select('intchamadoid', 'strsolicitante', 'strprotocolo', 'dtaabertura', 'dtaprevisaoencerramento', 'horaprevisaoencerramento', 'descricao','dbgeral.tblpolo.strpolo')
			->join('dbgeral.tblpolo', 'dbgeral.tblpolo.intpoloid', '=', 'tblchamados.strpolo')
			->where('dtaencerramento', '=', "0000-00-00 00:00:00")
			->orderBy('dtaabertura', 'desc')
			->get();

		$atendimentos = DB::table('tblatendimento')
		->select('strfuncionario', 'strsetor', 'dta_solicitacao', 'strprioridade', 'strproblema', 'strsubproblema','strstatus', 'intatendimentoid')
		->join('dbgeral.tblfuncionario', 'dbgeral.tblfuncionario.intfuncionarioid', '=', 'tblatendimento.intfuncionario_solicitadoid')
		->join('dbgeral.tblsetor', 'dbgeral.tblsetor.intsetorid', '=', 'tblatendimento.intsetorid')
		->join('tblprioridade', 'tblprioridade.intprioridadeid', '=', 'tblatendimento.intprioridadeatendimentoid')
		->join('tblproblems', 'tblproblems.intproblemid', '=', 'tblatendimento.intproblemid')
		->join('tblsubproblems', 'tblsubproblems.intsubproblemid', '=', 'tblatendimento.intsubproblemid')
		->join('tblstatus', 'tblstatus.intstatusid', '=', 'tblatendimento.intstatusid')
		->where('tblatendimento.intstatusid', '=', 1)
		->orderBy('dta_solicitacao', 'desc')
		->get();

		return View::make('home/index', compact('title', 'eventos', 'chamados', 'atendimentos'));

	}

}
