<?php
/*Router::connect('/', array(
	'controller' => 'dashboard', 'action' => 'index'
));*/
Router::connect('/', array(
    'controller' => 'produtos', 'action' => 'index'
));
Router::connect('/login',
    array('controller' => 'usuarios', 'action' => 'login')
);
Router::connect('/logout',
    array('controller' => 'usuarios', 'action' => 'logout')
);