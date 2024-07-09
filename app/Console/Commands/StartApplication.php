<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class StartApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the Laravel application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Laravel application...');

        // Run composer update
        $this->info('Running composer update...');
        $this->runExternalCommand('composer update');

        // Install npm packages
        $this->info('Installing npm packages...');
        $this->runExternalCommand('npm install');

        // Build the assets
        $this->info('Building assets...');
        $this->runExternalCommand('npm run build');


        // Migrate the database
        $this->call('migrate');

        // Seed the database
        $this->call('db:seed');

        // Run the tests
        $this->info('Running the tests...');
        $this->call('test');

        // Start the server
        $this->info('Starting the server...');
        $this->startProcessInBackground('php artisan serve --host=127.0.0.1 --port=8000');

        // Give some time for the server to start
        sleep(2);

        // Start the queue worker
        $this->info('Starting the queue worker...');
        $this->call('queue:work', [
            '--queue' => 'default',
            '--tries' => 3,
        ]);
    }

    protected function runExternalCommand($command)
    {
        $process = Process::fromShellCommandline($command);
        $process->setTimeout(null); // Optional: Set timeout as needed
        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                $this->error($buffer);
            } else {
                $this->info($buffer);
            }
        });

        if (!$process->isSuccessful()) {
            $this->error("Command failed: $command");
            exit($process->getExitCode());
        }
    }

    // check windos os to start process in BG 
    protected function startProcessInBackground($command)
    {
        if (substr(php_uname(), 0, 7) == "Windows") {
            pclose(popen("start /B " . $command, "r"));
        }
    }
}
