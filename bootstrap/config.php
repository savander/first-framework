<?php

$config = new Config;


/*
 * Paths to config directories
 */
$config->addPaths([
    realpath(ROOT_DIR.'config')
]);

$config->load('app');
$config->load('database');


/**
 * You need to update configs after add something new.
 */
$config->update();
