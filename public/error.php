<?php

require_once join(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'vendor', 'autoload.php']);

$logger = new LoggerWrapper("Error Logger");

// TODO: Why this makes exception?
$inf = 1 / 0;