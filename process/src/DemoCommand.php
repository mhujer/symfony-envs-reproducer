<?php declare(strict_types = 1);

namespace App;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

final class DemoCommand extends \Symfony\Component\Console\Command\Command
{

    protected function configure(): void
    {
        $this->setName('app:demo');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $this->runCmd('php bin/console --version --env=dev', '../dest');
        $this->runCmd('php bin/console --version --env=test', '../dest');
    }

    private function runCmd(string $command, string $cwd): void
    {
        $process = new Process($command, realpath($cwd), []);
        $process->setTimeout(300);
        $process->mustRun(function ($type, $buffer) {
            echo $buffer;
        });
    }

}
