<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\ErrorHandler;
use Monolog\Formatter\LineFormatter;

class LoggerWrapper extends Logger {
    private string $logsPath;
    private string $separator;
    private StreamHandler $streamHandler;

    public function __construct(string $name,
                                array $handlers = [],
                                array $processors = [],
                                ?DateTimeZone $timezone = null) {
        parent::__construct($name, $handlers, $processors, $timezone);
        $this->logsPath = join(DIRECTORY_SEPARATOR, [dirname(__DIR__), "logs", "logs.logs"]);
        $this->separator = " ::: ";
        $this->streamHandler = new StreamHandler($this->logsPath);
        $this->setHandler();
        $this->setFormat();
    }

    private function setHandler(): void {
        $this->pushHandler($this->streamHandler);
        ErrorHandler::register($this);
    }

    private function setFormat(): void {
        $output = join($this->separator, ["%datetime%", "%level_name%", "%message%"]) . PHP_EOL;
        $dateFormat = "d.m.Y H:i:s";
        $formatter = new LineFormatter($output, $dateFormat);
        $this->streamHandler->setFormatter($formatter);
    }

    public function getLogsFromNewer(): array {
        $logs = array();
        foreach (file($this->logsPath) as $line) {
            $data = explode($this->separator, $line);
            $logs[] = ["datetime" => $data[0], "level_name" => strtolower($data[1]), "message" => $data[2]];
        }
        return array_reverse($logs);
    }
}