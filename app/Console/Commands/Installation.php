<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Installation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // MODIFICATION: Added {--dummy} and {--force} options
    protected $signature = 'fixit:install {--dummy} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command line installation.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appName = config('app.name');

        // MODIFICATION: Check for the --force flag instead of asking for confirmation.
        if ($this->option('force')) {
            $this->info("Installing {$appName} ...");

            // MODIFICATION: Check for the --dummy flag.
            if ($this->option('dummy')) {
                $this->call('db:wipe');
                $this->info('Dropping all tables...');
                $this->info('Importing dummy data...');
                $this->call('fixit:import');
                $this->info('Dummy Data Imported Successfully!');
            } else {
                $this->info('Migration is being run to build tables...');
                $this->call('migrate:fresh');
                $this->info('The seeder is being used for Generating the Administrator Credentials.');
                $this->call('db:seed');
                $this->info('Seed completed successfully!');
            }

            $this->info('');
            $this->info("{$appName} installed Successfully.");
        } else {
             // Inform the user that the --force flag is required.
            $this->error('This is a destructive command. Please use the --force option to run the installation.');
        }
    }
}
