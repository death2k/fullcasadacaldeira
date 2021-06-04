<?php
Router::connect('/', array(
	'controller' => 'pages', 'action' => 'home'
));
Router::connect('/empresa', array(
	'controller' => 'pages', 'action' => 'empresa'
));
Router::connect('/lancamentos', array(
	'controller' => 'pages', 'action' => 'lancamentos'
));
Router::connect('/localizacao', array(
	'controller' => 'pages', 'action' => 'localizacao'
));
Router::connect('/contato', array(
	'controller' => 'pages', 'action' => 'contato'
));