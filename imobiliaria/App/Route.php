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

		$routes['imoveis_para_avaliar'] = array(
			'route' => '/imoveis_para_avaliar',
			'controller' => 'CorController',
			'action' => 'imoveis_para_avaliar'
		);

		$routes['imoveis_avaliacao'] = array(
			'route' => '/imovel_avaliacao',
			'controller' => 'AdmController',
			'action' => 'imovel_avaliacao'
		);

		$routes['avaliar_imovelC'] = array(
			'route' => '/avaliar_imovelC',
			'controller' => 'CorController',
			'action' => 'avaliar_imovelC'
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

		$routes['imovel_detalhesNoUser'] = array(
			'route' => '/imovel_detalhesNoUser',
			'controller' => 'IndexController',
			'action' => 'imovel_detalhesNoUser'
		);

		$routes['imoveis_home'] = array(
			'route' => '/imoveis_home',
			'controller' => 'AdmController',
			'action' => 'imoveis_home'
		);

		$routes['adicionar_relatorio'] = array(
			'route' => '/adicionar_relatorio',
			'controller' => 'CorController',
			'action' => 'adicionar_relatorio'
		);

		$routes['validar_imovelC'] = array(
			'route' => '/validar_imovelC',
			'controller' => 'CorController',
			'action' => 'validar_imovelC'
		);

		$routes['meus_imoveis'] = array(
			'route' => '/meus_imoveis',
			'controller' => 'AppController',
			'action' => 'meus_imoveis'
		);

		$routes['visitas_marcadas'] = array(
			'route' => '/visitas_marcadas',
			'controller' => 'CorController',
			'action' => 'visitas_marcadas'
		);

		$routes['marcar_visita'] = array(
			'route' => '/marcar_visita',
			'controller' => 'CorController',
			'action' => 'marcar_visita'
		);

		$routes['acao_cor'] = array(
			'route' => '/acao_cor',
			'controller' => 'CorController',
			'action' => 'acao_cor'
		);


		$this->setRoutes($routes);
	}

}

?>