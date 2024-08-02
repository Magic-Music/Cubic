<?php

namespace Commands;

use Cubic\Cli\CliColours;
use Cubic\Cli\Command;
use Services\TestService;

class Test extends Command
{
    public string $command = 'test:run|test:go';
    public string $signature = "file ?operation --boot|b --string|s --purple|p --pink|P";

    public function __construct(private TestService $testService)
    {
    }

    public function handle()
    {
        $this->log("Test service: " . $this->testService->getTest());

        $this->log("Command: " . $this->cliCommand);

        $this->log("file: " . $this->argument('file'));
        $this->log("operation: " . $this->argument('operation'));

        $this->log("string: " . $this->option('string'));

        $this->log("purple: " . ($this->option('purple') ? "True" : "False"), CliColours::MAGENTA);
        $this->log("pink: " . ($this->option('pink') ? "True" : "False"), CliColours::MAGENTA);

        $this->error("Ouch");
    }
}
