<?php

require_once join(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'vendor', 'autoload.php']);

$logger = new LoggerWrapper("Debug Logger");
$logger->debug("Someone entered debug.php");