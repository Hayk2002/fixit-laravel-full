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

        if ($this->option('force')) {
            $this->info("Installing {$appName} ...");

            if ($this->option('dummy')) {
                // MODIFICATION: Added '--force' => true to the sub-command call.
                $this->call('db:wipe', ['--force' => true]);
                $this->info('Dropping all tables...');
                $this->info('Importing dummy data...');
                $this->call('fixit:import');
                $this->info('Dummy Data Imported Successfully!');
            } else {
                $this->info('Migration is being run to build tables...');
                // MODIFICATION: Added '--force' => true to the sub-command call.
                $this->call('migrate:fresh', ['--force' => true]);
                $this->info('The seeder is being used for Generating the Administrator Credentials.');
                $this->call('db:seed', ['--force' => true]); // Also good practice to force seeding.
                $this->info('Seed completed successfully!');
            }

            $this->info('');
            $this->info("{$appName} installed Successfully.");
        } else {
            $this->error('This is a destructive command. Please use the --force option to run the installation.');
        }
    }
}
