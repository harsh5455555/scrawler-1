<?php

$config = parse_ini_file(__DIR__ . '/App/config.ini');
$debug = $config['Debugging'];
if($debug == 0 )
{
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
}
else{
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_prepend_string','<div class="container"><div class="panel panel-danger"><div class="panel-heading">Scrawler - PHP Error</div><div class="panel-body">');
ini_set('error_append_string','</div></div></div>');
}
