<?php

$config = new Config;
$config->addPaths([
    realpath(WEB_DIR.'/../config')
]);
$config->load('app');


