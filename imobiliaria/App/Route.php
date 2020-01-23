<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['login'] = array(
			'route' => '/login',
			'controller' => 'indexController',
			'action' => 'login'
		);
		

		$routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['timeline'] = array(
			'route' => '/timeline',
			'controller' => 'AdmController',
			'action' => 'timeline'
		);

		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);

		$routes['cadastrarImovel'] = array(
			'route' => '/cadastrarImovel',
			'controller' => 'AppController',
			'action' => 'cadastrarImovel'
		);

		$routes['imagem'] = array(
			'route' => '/imagem',
			'controller' => 'IndexController',
			'action' => 'imagem'
		);

		$routes['upar_imagem'] = array(
			'route' => '/upar_imagem',
			'controller' => 'IndexController',
			'action' => 'upar_imagem'
		);

		$routes['ver_imagem'] = array(
			'route' => '/ver_imagem',
			'controller' => 'IndexController',
			'action' => 'ver_imagem'
		);


		$this->setRoutes($routes);
	}

}

?>