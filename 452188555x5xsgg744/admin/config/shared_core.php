<?php
//Production => 0 ... 1 ... 2 <= Development
Configure::write('debug', 2);
Configure::write('log', true);
Configure::write('App.encoding', 'UTF-8');
define('LOG_ERROR', 2);

Configure::write('Session.save', 'php');
Configure::write('Session.cookie', 'CAKEPHP');
Configure::write('Session.timeout', '120');
Configure::write('Session.start', true);
Configure::write('Session.checkAgent', true);

Configure::write('Security.level', 'medium');
Configure::write('Security.salt', B3CMS_SECURITY_SALT);
Configure::write('Security.cipherSeed', B3CMS_SECURITY_CHIPERSEED);

Configure::write('Acl.classname', 'DbAcl');
Configure::write('Acl.database', 'default');

if (function_exists('date_default_timezone_set')) date_default_timezone_set('America/Sao_Paulo');

Cache::config('default', array('engine' => 'File'));