<?php
class DATABASE_CONFIG {
    
    var $default = array(
        'driver'     => 'mysql',
        'persistent' => B3CMS_DB_PERSISTENT,
        'host'       => B3CMS_DB_HOST,
        'login'      => B3CMS_DB_USER,
        'password'   => B3CMS_DB_PASSWORD,
        'database'   => B3CMS_DB_NAME,
        'prefix'     => B3CMS_DB_PREFIX,
        'encoding'   => 'utf8'
    );
}
