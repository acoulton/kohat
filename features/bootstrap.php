<?php
require_once __DIR__.'/../../../modules/unittest/bootstrap.php';

// Attach a memory config reader
Kohana::$config->attach(new Config_Memory);