<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action{

	public function autenticar(){

		$usuario = Container::getModel('Usuario');

		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));

		$usuario->autenticar();

		if($usuario->__get('id') != '' && $usuario->__get('nome') != ''){

			session_start();
			$_SESSION['id'] = $usuario->__get('id');
			$_SESSION['nome'] = $usuario->__get('nome');

			echo "<br><br><br><br><br><br>";
			echo $usuario->administrador."asdsad";
			echo $usuario->comprador."asdsad";
			echo $usuario->corretor."asdsad";

			if($usuario->__get('administrador')){
				header('Location: /dashboard');
			}elseif($usuario->__get('comprador') && $usuario->__get('corretor')){
				header("Location: /modulo");
			}elseif($usuario->__get('comprador')){
				header("Location: /timeline");
			}elseif($usuario->__get('corretor')){
				header("Location: /dashboardC");
			}

		}else{
			
			header('Location: /login?login=erro');
		}
	}

	public function sair(){
		session_start();
		session_destroy();
		header('Location: /');
	}
}


?>