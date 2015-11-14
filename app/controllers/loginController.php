<?php

class LoginController extends BaseController {

	public function index() {
	
		$title = 'Login';

	    return View::make('login/index', compact('title'));

    }

    public function autenticacao() {

    	$strusuario = $_POST['strusuario'];
        $strsenha = $_POST['strsenha'];
    	$remember = false;
		
		echo  $strusuario;
		exit;
		
        $users = DB::table('dbgeral.tblusuario')->get();

        foreach ($users as $row) {

            if (($row->strusuario == $strusuario) && ($row->strsenha == $strsenha)) {
                
                return Redirect::action('homeController@retrieve');

                exit;

            } 
			
			else {
			
			echo "deu certo";
			exit;
           
		    return Redirect::action('loginController@index')
                ->with('flash_error', 1)
                ->withInput();

            }

        }

        /*if(Input::get('remember')) {

            $remember = true;

        }

        if(Auth::attempt(array(
	            'strusuario' => "$user",
	            'strsenha' => sha1($password)
	            ), $remember)) {

            return Redirect::action('problemasController@index');

        } else {

            return Redirect::action('loginController@index')
                ->with('flash_error', 1)
                ->withInput();

        }*/

    }

    public function logout() {

    	Auth::logout();
        return Redirect::action('loginController@index');

    }

}