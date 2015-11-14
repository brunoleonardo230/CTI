<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* --- Model Bindings --- */

Route::model('problems', 'Problems');

Route::model('funcionarios', 'Atendimento');

/* --- Admin routes --- */

/* --- Home routes --- */

Route::match(array('GET', 'POST'),'/', 'homeController@index');

/* --- Login --- */

Route::match(array('GET', 'POST'),'/login', 'loginController@index');

//Route::match(array('GET', 'POST'),'/login/enter', 'loginController@login');


/* --- View Composer --- */

View::composer('sidebar', function ($view) {
    $view->recentPosts = Post::orderBy('id', 'desc')->take(5)->get();
});


/* --- Atendimento --- */

Route::match(array('GET', 'POST'),'/atendimento', 'AtendimentoController@index');

Route::match(array('GET', 'POST'),'/atendimento/create', 'AtendimentoController@create');

Route::match(array('GET', 'POST'),'/atendimento/atendimentopendente', 'AtendimentoController@atendimentopendente');

Route::match(array('GET', 'POST'),'/atendimento/atendimentoandamento', 'AtendimentoController@atendimentoandamento');

Route::match(array('GET', 'POST'),'/atendimento/atendimentoconcluido', 'AtendimentoController@atendimentoconcluido');

Route::match(array('GET', 'POST'),'/atendimento/atender', 'AtendimentoController@atender');

Route::match(array('GET', 'POST'),'/atendimento/finalizar', 'AtendimentoController@finalizar');


/* --- Chamados OI --- */

Route::match(array('GET', 'POST'),'/chamadosoi', 'chamadosoiController@chamadosoi');

Route::match(array('GET', 'POST'),'/chamadosoi/salvarchamado', 'chamadosoiController@salvarchamado');

Route::match(array('GET', 'POST'),'/chamadosoi/salvareditar', 'chamadosoiController@salvareditar');

Route::match(array('GET', 'POST'),'/chamadosoi/controlechamado', 'chamadosoiController@controlechamado');

Route::match(array('GET', 'POST'),'/chamadosoi/editar', 'chamadosoiController@editar');

Route::match(array('GET', 'POST'),'/chamadosoi/ocorrencia', 'chamadosoiController@ocorrencia');

Route::match(array('GET', 'POST'),'/chamadosoi/salvarocorrencia', 'chamadosoiController@salvarocorrencia');

Route::match(array('GET', 'POST'),'/chamadosoi/finalizarchamado', 'chamadosoiController@finalizarchamado');

Route::match(array('GET', 'POST'),'/chamadosoi/chamadosfinalizados', 'chamadosoiController@chamadosfinalizados');

/* --- Relatório --- */

Route::match(array('GET', 'POST'),'/relatorio/buscarelatorio', 'relatorioController@buscarelatorio');

Route::match(array('GET', 'POST'),'/relatorio/buscar_atendimento', 'relatorioController@buscar_atendimento');

Route::get('relatorio/select_setor_ajax/{intpoloid}', 'relatorioController@select_setor_ajax');

Route::get('relatorio/select_subproblema_ajax/{intproblemid}', 'relatorioController@select_subproblema_ajax');

/* --- Eventos --- */

//Registro de Eventos

Route::match(array('GET', 'POST'), '/eventos/registro', 'eventosController@retrieve');

Route::match(array('GET', 'POST'), '/eventos/registro/data', 'eventosController@data');

Route::match(array('GET', 'POST'), '/eventos/registro/create', 'eventosController@create');

Route::match(array('GET', 'POST'), '/eventos/registro/update', 'eventosController@update');

Route::match(array('GET', 'POST'), '/eventos/registro/delete', 'eventosController@delete');

//Histórico de Eventos

Route::match(array('GET', 'POST'), '/eventos/historico', 'eventosHistoricoController@retrieve');

/* --- Administração --- */

//Cadastro de Problemas

Route::match(array('GET', 'POST'), '/administracao/problemas', 'problemasController@retrieve');

Route::match(array('GET', 'POST'), '/administracao/problemas/data', 'problemasController@data');

Route::match(array('GET', 'POST'), '/administracao/problemas/create', 'problemasController@create');

Route::match(array('GET', 'POST'), '/administracao/problemas/update', 'problemasController@update');

Route::match(array('GET', 'POST'), '/administracao/problemas/delete', 'problemasController@delete');

//Cadastro de Computadores

Route::match(array('GET', 'POST'), '/administracao/computadores', 'computadoresController@retrieve');

Route::match(array('GET', 'POST'), '/administracao/computadores/data', 'computadoresController@data');

Route::match(array('GET', 'POST'), '/administracao/computadores/create', 'computadoresController@create');

Route::match(array('GET', 'POST'), '/administracao/computadores/update', 'computadoresController@update');

Route::match(array('GET', 'POST'), '/administracao/computadores/delete', 'computadoresController@delete');

/* --- Manutenção de Computadores --- */

//Registro de Manutenção

Route::match(array('GET', 'POST'), '/manutencao/registro', 'manutencaoController@retrieve');

Route::match(array('GET', 'POST'), '/manutencao/registro/create', 'manutencaoController@create');

Route::match(array('GET', 'POST'), '/manutencao/registro/data', 'manutencaoController@data');

Route::match(array('GET', 'POST'), '/manutencao/registro/update', 'manutencaoController@update');

Route::match(array('GET', 'POST'), '/manutencao/registro/delete', 'manutencaoController@delete');

Route::match(array('GET', 'POST'), '/manutencao/registro/selectCpuAjax/{intpoloid}', 'manutencaoController@selectCpuAjax');

//Histórico de Manutenção

Route::match(array('GET', 'POST'), '/manutencao/historico', 'manutencaoHistoricoController@retrieve');