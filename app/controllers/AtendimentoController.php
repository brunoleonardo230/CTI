<?php

class AtendimentoController extends BaseController {

	public function index() {

		$title = 'Registro de Atendimento';

		$select_funcionario = DB::table('dbgeral.tblfuncionario')
	        ->orderBy('strfuncionario', 'asc')
	        ->get();
	        //exit;

	    $select_problemas = DB::table('tblproblems')
	        ->orderBy('tblproblems.strproblema', 'asc')
	        ->get();

	    $select_subproblemas = DB::table('tblsubproblems')
	        ->orderBy('strsubproblema', 'asc')
	        ->get();

	     $select_setor = DB::table('dbgeral.tblsetor')
	        ->orderBy('strsetor', 'asc')
	        ->get();

		return View::make('atendimento/index', compact('select_funcionario', 'title', 'select_problemas','select_subproblemas','select_setor'));

	}

	public function atendimentopendente(){
		$title = 'Atendimentos Pendentes';

		$select_atendimento_pendente = DB::table('tblatendimento')
		->select('strfuncionario', 'strsetor', 'dta_solicitacao', 'strprioridade', 'strproblema', 'strsubproblema','strstatus', 'intatendimentoid')
		->join('dbgeral.tblfuncionario', 'dbgeral.tblfuncionario.intfuncionarioid', '=', 'tblatendimento.intfuncionario_solicitadoid')
		->join('dbgeral.tblsetor', 'dbgeral.tblsetor.intsetorid', '=', 'tblatendimento.intsetorid')
		->join('tblprioridade', 'tblprioridade.intprioridadeid', '=', 'tblatendimento.intprioridadeatendimentoid')
		->join('tblproblems', 'tblproblems.intproblemid', '=', 'tblatendimento.intproblemid')
		->join('tblsubproblems', 'tblsubproblems.intsubproblemid', '=', 'tblatendimento.intsubproblemid')
		->join('tblstatus', 'tblstatus.intstatusid', '=', 'tblatendimento.intstatusid')
		->where('tblatendimento.intstatusid', '=', 1)
		->orderBy('dta_solicitacao', 'asc')
		->paginate(8);

		
		//->get();

		return View::make('atendimento/pendente', compact('title'))
		->with('select_atendimento_pendente', $select_atendimento_pendente);
	}

	public function atendimentoandamento(){
		$title = 'Atendimentos em Andamento';

		$select_atendimento_andamento = DB::table('tblatendimento')
		->select('strfuncionario', 'strsetor', 'dta_solicitacao', 'strprioridade', 'strproblema', 'strsubproblema','strstatus', 'intatendimentoid')
		->join('dbgeral.tblfuncionario', 'dbgeral.tblfuncionario.intfuncionarioid', '=', 'tblatendimento.intfuncionario_solicitadoid')
		->join('dbgeral.tblsetor', 'dbgeral.tblsetor.intsetorid', '=', 'tblatendimento.intsetorid')
		->join('tblprioridade', 'tblprioridade.intprioridadeid', '=', 'tblatendimento.intprioridadeatendimentoid')
		->join('tblproblems', 'tblproblems.intproblemid', '=', 'tblatendimento.intproblemid')
		->join('tblsubproblems', 'tblsubproblems.intsubproblemid', '=', 'tblatendimento.intsubproblemid')
		->join('tblstatus', 'tblstatus.intstatusid', '=', 'tblatendimento.intstatusid')
		->where('tblatendimento.intstatusid', '=', 2)
		->orderBy('dta_solicitacao', 'asc')
		->paginate(8);

	return View::make('atendimento/andamento', compact('title'))
		->with('select_atendimento_andamento', $select_atendimento_andamento);
	}
	
	public function atendimentoconcluido(){
		$title = 'Atendimentos Concluidos';

		$select_atendimento_concluidos = DB::table('tblatendimento')
		->select('strfuncionario', 'strsetor', 'dta_solicitacao', 'strprioridade', 'strproblema', 'strsubproblema','strstatus', 'intatendimentoid', 'strlaudo_atend', 'bolatendimentotelefone', 'bolatendimentoremoto')
		->join('dbgeral.tblfuncionario', 'dbgeral.tblfuncionario.intfuncionarioid', '=', 'tblatendimento.intfuncionario_solicitadoid')
		->join('dbgeral.tblsetor', 'dbgeral.tblsetor.intsetorid', '=', 'tblatendimento.intsetorid')
		->join('tblprioridade', 'tblprioridade.intprioridadeid', '=', 'tblatendimento.intprioridadeatendimentoid')
		->join('tblproblems', 'tblproblems.intproblemid', '=', 'tblatendimento.intproblemid')
		->join('tblsubproblems', 'tblsubproblems.intsubproblemid', '=', 'tblatendimento.intsubproblemid')
		->join('tblstatus', 'tblstatus.intstatusid', '=', 'tblatendimento.intstatusid')
		->where('tblatendimento.intstatusid', '=', 3)
		->orderBy('dta_solicitacao', 'desc')
		->paginate(8);

	return View::make('atendimento/concluidos', compact('title'))
		->with('select_atendimento_concluidos', $select_atendimento_concluidos);
	}

	public function create() {

		//print_r($_POST);

		$intfuncionario_atend_id = '116';
		$intfuncionario_solicitadoid = $_POST['intfuncionario_solicitadoid'];
		$intproblemid = $_POST['intproblemid'];
		$intsubproblemid = $_POST['intsubproblemid'];
		$intsetorid = $_POST['intsetorid'];
		$intfuncionario_solic_id = $_POST['intfuncionario_solic_id'];
		$intprioridadeatendimentoid = $_POST['intprioridadeatendimentoid'];
		$dta_solicitacao = date('Y-m-d H:i:s');
		$intstatusid = '1';
		$prazo = '1 dia';

		DB::table('tblatendimento')->insert(array(
			'intfuncionario_atend_id' => "$intfuncionario_atend_id",
	    	'intfuncionario_solicitadoid' => "$intfuncionario_solicitadoid",
	    	'intproblemid' => "$intproblemid",
	    	'intsubproblemid' => "$intsubproblemid",
	    	'intsetorid' => "$intsetorid",
	    	'intfuncionario_solic_id' => "$intfuncionario_solic_id",
	    	'intprioridadeatendimentoid' => "$intprioridadeatendimentoid",
	    	'dta_solicitacao' => "$dta_solicitacao",
	    	'intstatusid' => "$intstatusid",
	    	'prazo' => "$prazo"
	    	));
		
		

		return Redirect::action('AtendimentoController@atendimentopendente');

	}

	public function atender(){
		echo $intatendimentoid = $_GET['id'];

		DB::table('tblatendimento')
            ->where('intatendimentoid', $intatendimentoid)
            ->update(array(
            	'intstatusid' => 2,
            	'dta_atendimento' => date('Y-m-d H:i:s')
            	));


        return Redirect::action('AtendimentoController@atendimentoandamento');

	}

	public function finalizar(){

		$intatendimentoid = $_POST['intatendimentoid'];
		$intstatusid = 3;
		$dta_conclusao = date('Y-m-d H:i:s');
		$laudo = $_POST['laudo'];
		if($_POST['bolatendimentoremoto'] = 1){
			$bolatendimentoremoto = 1;
		}else{
			$bolatendimentoremoto = '';
		}
		if($_POST['bolatendimentotelefone'] = 1){
			$bolatendimentotelefone = 1;
		}else{
			$bolatendimentotelefone = '';
		}
		
		DB::table('tblatendimento')
			->where('intatendimentoid', $intatendimentoid)
			->update(array(
				'intstatusid' 			=> $intstatusid,
				'dta_conclusao' 		=> $dta_conclusao,
				'strlaudo_atend' 		=> $laudo,
				'bolatendimentoremoto' 	=> $bolatendimentoremoto,
				'bolatendimentotelefone'=> $bolatendimentotelefone
				 ));
		
		$msg = '1';
		return Redirect::action('AtendimentoController@atendimentoandamento', compact('msg'));
		

	}
	
}
