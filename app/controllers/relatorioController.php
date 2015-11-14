<?php

class relatorioController extends BaseController {

	public function buscarelatorio(){
		$title = 'Relatório por Núcleo';

		$select_polo= DB::table('dbgeral.tblpolo')
		->select('strpolo','intpoloid')
		->where('bolpublicar', '=', 'SIM')
		->orderBy('strpolo', 'asc')
		->get();

		$select_problema = DB::table('tblproblem')
		->orderBy('strproblem', 'asc')
		->get();

		return View::make('relatorio/indexbusca', compact('title','select_polo','select_problema'));
	}

	function select_setor_ajax($intpoloid) { 
		
		$select_setor = DB::table('dbgeral.tblsetor')
		->select('strsetor','dbgeral.tblsetor.intsetorid')
		->join('dbgeral.tblpolosetor','dbgeral.tblpolosetor.intsetorid', '=', 'dbgeral.tblsetor.intsetorid')
		->join('dbgeral.tblpolo', 'dbgeral.tblpolo.intpoloid', '=', 'dbgeral.tblpolosetor.intpoloid')
		->where('dbgeral.tblpolo.intpoloid', '=', $intpoloid)
		->orderBy('strsetor', 'asc')
		->get();
		
		return View::make('relatorio/select_setor_ajax', compact('select_setor'));

	}

	function select_subproblema_ajax($intproblemid){
		$select_subproblema = DB::table('tblsubproblem')
		->select('intsubproblemid', 'strsubproblem')
		->where('intproblemid','=',$intproblemid)
		->orderBy('strsubproblem','asc')
		->get();

		return View::make('relatorio/select_subproblema_ajax', compact('select_subproblema'));
	}

	public function buscar_atendimento(){
		$title = 'Relatório por Núcleo';

		$intpoloid		= $_POST['intpoloid'];
		$intproblemid 	= $_POST['intproblemid'];
		$data1			= $_POST['dtainicial'];
		$data2			= $_POST['dtafinal'];
		
		$data1	=explode("/", $data1);
		$data2	=explode("/", $data2);

		$dtainicial = $data1[2].'-'.$data1[1].'-'.$data1[0];
		$dtafinal = $data2[2].'-'.$data2[1].'-'.$data2[0];


		$select_busca = DB::table('tblatendimento')
		->select('intatendimentoid','dta_solicitacao','dbgeral.tblsetor.strsetor','strproblem','dbgeral.tblfuncionario.strfuncionario','strsubproblem')
		->leftJoin('dbgeral.tblsetor','dbgeral.tblsetor.intsetorid', '=','tblatendimento.intsetorid')
		->leftJoin('tblproblem', 'tblproblem.intproblemid' ,'=', 'tblatendimento.intproblemid')
		->leftJoin('tblsubproblem', 'tblsubproblem.intsubproblemid','=','tblatendimento.intproblemid')
		->leftJoin('dbgeral.tblfuncionario','dbgeral.tblfuncionario.intfuncionarioid','=','tblatendimento.intfuncionario_solicitadoid')
		->whereBetween('dta_solicitacao',array($dtainicial,$dtafinal))
		->get();


		$select_polo= DB::table('dbgeral.tblpolo')
		->select('strpolo','intpoloid')
		->where('bolpublicar', '=', 'SIM')
		->orderBy('strpolo', 'asc')
		->get();

		$select_problema = DB::table('tblproblem')
		->orderBy('strproblem', 'asc')
		->get();


		return View::make('relatorio/indexbusca', compact('title','select_polo','select_busca','select_problema'));
	}

	public function funcionario(){
		$title = 'Relatório por Funcionário';


		return View::make('relatorio/indexfuncionario', compact('title'));
	}

	public function problema(){
		$title = 'Relatório por Problema';


		return View::make('relatorio/indexproblema', compact('title'));
	}

}