<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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

    // check windos os to start process in BG 
    protected function startProcessInBackground($command)
    {
        if (substr(php_uname(), 0, 7) == "Windows") {
            pclose(popen("start /B " . $command, "r"));
        }
    }
}
