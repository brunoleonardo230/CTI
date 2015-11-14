<?php

	class chamadosoiController extends BaseController {

		public function chamadosoi(){
			$title = 'Chamados OI';

			$select_polo = DB::table('dbgeral.tblpolo')
			->select('intpoloid', 'strpolo')
			->orderBy('strpolo', 'asc')
			->get();

			return View::make('chamadosoi/index', compact('title'))
			->with('select_polo', $select_polo);
		}

		public function editar(){
			$title = 'Editar Chamados OI';
			$intchamadoid = $_GET['id'];

			$select_polo = DB::table('dbgeral.tblpolo')
			->select('intpoloid', 'strpolo')
			->orderBy('strpolo', 'asc')
			->get();

			$select_chamado = DB::table('tblchamados')
			->select('intchamadoid', 'strsolicitante', 'strprotocolo', 'dtaabertura', 'dtaprevisaoencerramento', 'dtaencerramento', 'descricao', 'horaprevisaoencerramento', 'strpolo')
			->where('intchamadoid', '=', $intchamadoid)
			->get();

			return View::make('chamadosoi/index', compact('title', 'select_polo','select_chamado'));


		}

		public function salvareditar(){
			print_r($_POST);
			$intchamadoid				= $_POST['intchamadoid'];
			$strsolicitante 			= $_POST['strsolicitante'];
			$strprotocolo 				= $_POST['strprotocolo'];
			$descricao					= $_POST['descricao'];
			$strpolo 					= $_POST['strpolo'];
			

			DB::table('tblchamados')
			->where('intchamadoid', '=', "$intchamadoid")
			->update(array(
				'strsolicitante'	=> "$strsolicitante",
				'strprotocolo'		=> "$strprotocolo",
				'descricao'			=> "$descricao",
				'strpolo'			=> "$strpolo"
				));

			return Redirect::action('chamadosoiController@controlechamado');
			
		}


		public function salvarchamado(){
			$strsolicitante 			= $_POST['strsolicitante'];
			$strprotocolo 				= $_POST['strprotocolo'];
			$dtaabertura				= date('Y-m-d H:i:s');
			$dtaprevisaoencerramento	= $_POST['dtaprevisaoencerramento'];
			$horaprevisaoencerramento	= $_POST['horaprevisaoencerramento'];
			$descricao					= $_POST['descricao'];
			$strpolo 					= $_POST['strpolo'];
			$dtaencerramento 			= "0000-00-00 00:00:00";

			$data = explode("/", $dtaprevisaoencerramento);

			$dtaprevisaoencerramento = $data[2]."-".$data[1]."-".$data[0];

			DB::table('tblchamados')->insert(array(
				'strsolicitante' => "$strsolicitante",
				'strprotocolo' => "$strprotocolo",
				'dtaabertura' => "$dtaabertura",
				'dtaprevisaoencerramento' => "$dtaprevisaoencerramento",
				'dtaencerramento' => "$dtaencerramento",
				'horaprevisaoencerramento' => "$horaprevisaoencerramento",
				'descricao' => "$descricao",
				'strpolo' => "$strpolo"
			));

			return Redirect::action('chamadosoiController@controlechamado');
		}

		public function controlechamado(){
			$title = 'Controle Chamados';

			$select_chamados_abertos = DB::table('tblchamados')
			->select('intchamadoid', 'strsolicitante', 'strprotocolo', 'dtaabertura', 'dtaprevisaoencerramento', 'horaprevisaoencerramento', 'descricao','dbgeral.tblpolo.strpolo')
			->join('dbgeral.tblpolo', 'dbgeral.tblpolo.intpoloid', '=', 'tblchamados.strpolo')
			->where('dtaencerramento', '=', "0000-00-00 00:00:00")
			->orderBy('dtaabertura', 'asc')
			->paginate(8);


			return View::make('chamadosoi/controlechamado', compact('title'))
			->with('select_chamados_abertos', $select_chamados_abertos);


		}

		public function ocorrencia(){
			$title = 'Ocorrência de Chamados OI';
			$intchamadoid = $_GET['id'];

			$select_dtaprevista = DB::table('tblchamados')
			->select('dtaprevisaoencerramento', 'horaprevisaoencerramento')
			->where('intchamadoid', '=', $intchamadoid)
			->get();

			$select_ocorrencias = DB::table('tblocorrenciaoi')
			->select('intocorrenciaoiid','dta_previstaantiga', 'strocorrenciaoi', 'dta_previstanova')
			->where('intchamadoid', '=', $intchamadoid)
			->orderBy('intocorrenciaoiid','desc')
			->get();

			return View::make('chamadosoi/ocorrencia', compact('title', 'select_ocorrencias','select_dtaprevista'));
		}

		public function salvarocorrencia(){

			$dta_previstaantiga = $_POST['dta_previstaantiga'];
			$data = explode("/", $dta_previstaantiga);
			$dta_previstaantiga	=$data[2]."-".$data[1]."-".$data[0]." ".$_POST['horaprevisaoencerramento'];

			$dta_previstanova = $_POST['dta_previstanova'];
			$data = explode("/", $dta_previstanova);
			$dta_previstanova 			= $data[2]."-".$data[1]."-".$data[0]." ".$_POST['horanova'];

			$intchamadoid 		= $_POST['intchamadoid'];
			$strocorrenciaoi	= $_POST['strocorrenciaoi'];
			
			DB::table('tblocorrenciaoi')->insert(array(
				'dta_previstaantiga' => "$dta_previstaantiga",
				'dta_previstanova' => "$dta_previstanova",
				'intchamadoid' => "$intchamadoid",
				'strocorrenciaoi' => "$strocorrenciaoi"
			));

			$dtaprevisaoencerramento = $_POST['dta_previstanova'];
			$data = explode("/", $dtaprevisaoencerramento);
			$dtaprevisaoencerramento	= $data[2]."-".$data[1]."-".$data[0];

			$horaprevisaoencerramento = $_POST['horanova'];

			DB::table('tblchamados')
			->where('intchamadoid', '=', "$intchamadoid")
			->update(array(
				'dtaprevisaoencerramento'	=> "$dtaprevisaoencerramento",
				'horaprevisaoencerramento'		=> "$horaprevisaoencerramento"
				));

			return Redirect::action('chamadosoiController@controlechamado');

		}

		public function finalizarchamado(){
			$intchamadoid = $_GET['id'];

			$dtaencerramento = date('Y-m-d H:i:s');

			DB::table('tblchamados')
			->where('intchamadoid', '=', "$intchamadoid")
			->update(array(
				'dtaencerramento'	=> "$dtaencerramento"
				));

			return Redirect::action('chamadosoiController@controlechamado');
		}

		public function chamadosfinalizados(){

			$title = 'Chamados Finalizados';
			
			$select_chamados_finalizados = DB::table('tblchamados')
				->select('intchamadoid', 'strsolicitante', 'strprotocolo', 'dtaabertura', 'dtaprevisaoencerramento', 'horaprevisaoencerramento', 'descricao','dbgeral.tblpolo.strpolo', 'dtaencerramento')
				->join('dbgeral.tblpolo', 'dbgeral.tblpolo.intpoloid', '=', 'tblchamados.strpolo')
				->where('dtaencerramento', '<>', "0000-00-00 00:00:00")
				->orderBy('dtaabertura', 'desc')
				->paginate(40);

			$select_ocorrencias = DB::table('tblocorrenciaoi')
			->select('intocorrenciaoiid','dta_previstaantiga', 'strocorrenciaoi', 'dta_previstanova', 'intchamadoid')
			->orderBy('dta_previstanova','desc')
			->paginate(40);

			$select_intchamadoid = DB::table('tblocorrenciaoi')
			->select('intchamadoid')
			->groupBy('intchamadoid')
			->get();

			return View::make('chamadosoi/chamadosfinalizados', compact('title', 'select_intchamadoid'))
				->with('select_chamados_finalizados', $select_chamados_finalizados)
				->with('select_ocorrencias', $select_ocorrencias);
		}


	}