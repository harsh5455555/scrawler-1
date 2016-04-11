<?php
require_once __DIR__."/../Core/Start.php";
loader()->registerNamespace('Tests', __DIR__.'/../');
loader()->registerNamespace('GuzzleHttp',__DIR__.'/');
include __DIR__ . '/GuzzleHttp/functions_include.php';