<?php

namespace Odboxxx\SensApi\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use RuntimeException;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    use InstallsSensApi;
 
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sensapi:install';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the SensApi controllers and resources';

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {   
        $this->installSensApi();

        return true;
    }
    /**
     * Install Qecalculator tests.
     *
     * @return bool
     */
    protected function installTests()
    {

        (new Filesystem)->ensureDirectoryExists(base_path('tests/Feature'));

        (new Filesystem)->copyDirectory(__DIR__.'/../../tests/Feature', base_path('tests/Feature'));

        return true;
    }
  
    /**
     * Run the given commands.
     *
     * @param  array  $commands
     * @return void
     */
    protected function runCommands($commands)
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> '.$e->getMessage().PHP_EOL);
            }
        }

        $process->run(function ($type, $line) {
            $this->output->write('    '.$line);
        });
    }    
}