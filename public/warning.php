<?php

require_once join(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'vendor', 'autoload.php']);

$logger = new LoggerWrapper("Warning Logger");
$logger->warning("Someone found warning.php");