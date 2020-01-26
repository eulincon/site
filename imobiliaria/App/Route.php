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

		$routes['dashboard'] = array(
			'route' => '/dashboard',
			'controller' => 'AdmController',
			'action' => 'dashboard'
		);

		$routes['timeline'] = array(
			'route' => '/timeline',
			'controller' => 'AppController',
			'action' => 'timeline'
		);

		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);

		$routes['cadastrar_imovel'] = array(
			'route' => '/cadastrar_imovel',
			'controller' => 'AppController',
			'action' => 'cadastrar_imovel'
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

		$routes['modulo'] = array(
			'route' => '/modulo',
			'controller' => 'IndexController',
			'action' => 'modulo'
		);

		$routes['dashboardC'] = array(
			'route' => '/dashboardC',
			'controller' => 'CorController',
			'action' => 'dashboardC'
		);

		$routes['registrarImovel'] = array(
			'route' => '/registrarImovel',
			'controller' => 'AppController',
			'action' => 'registrarImovel'
		);

		$routes['error_notfound'] = array(
			'route' => '/error_notfound',
			'controller' => 'IndexController',
			'action' => 'error_notfound'
		);

		$routes['imoveis_pendentes'] = array(
			'route' => '/imoveis_pendentes',
			'controller' => 'AdmController',
			'action' => 'imoveis_pendentes'
		);

		$routes['imoveis_avaliacao'] = array(
			'route' => '/imovel_avaliacao',
			'controller' => 'AdmController',
			'action' => 'imovel_avaliacao'
		);

		$routes['acao_imovel'] = array(
			'route' => '/acao_imovel',
			'controller' => 'AdmController',
			'action' => 'acao_imovel'
		);

		$routes['acao_usuario'] = array(
			'route' => '/acao_usuario',
			'controller' => 'AdmController',
			'action' => 'acao_usuario'
		);

		$routes['gerenciar_corretores'] = array(
			'route' => '/gerenciar_corretores',
			'controller' => 'AdmController',
			'action' => 'gerenciar_corretores'
		);

		$routes['cadastrar_proprietario'] = array(
			'route' => '/cadastrar_proprietario',
			'controller' => 'AppController',
			'action' => 'cadastrar_proprietario'
		);

		$routes['registrarProprietario'] = array(
			'route' => '/registrarProprietario',
			'controller' => 'AppController',
			'action' => 'registrarProprietario'
		);

		$routes['imovel_detalhes'] = array(
			'route' => '/imovel_detalhes',
			'controller' => 'AppController',
			'action' => 'imovel_detalhes'
		);

		$this->setRoutes($routes);
	}

}

?>