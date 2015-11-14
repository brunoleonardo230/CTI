<?php 

class Atendimento extends Eloquent{

	protected $funcionarios = DB::table('tblusuario_nti')->get();

	

	public function funcionarios() {
		
		return $funcionarios;

	}

	
}