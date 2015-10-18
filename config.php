<?php

$config = array(
    'mysql' => array(
        'host' => 'localhost',
        'user' => 'msl',
        'password' => 'gkr341ds',
        'database' => 'msl',
        'prefix' => '',
    ),
	'menu' => array(
		'main' => array(
			'title' => 'Главная',
			'url' => '?mode=main',
		),
		'list' => array(
			'title' => 'Список',
			'url' => '?mode=list',
		),
	),
    'url' => '/msl/',
	'tvdb_api' => '';
);

?>