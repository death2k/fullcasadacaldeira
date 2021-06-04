<?php
App::build(array(
	'models' => array(APP . 'admin/models/'),
	'behaviors' => array(APP . 'admin/models/behaviors/'),
));

require APP.'plugins/cake_ptbr/config/inflections.php';