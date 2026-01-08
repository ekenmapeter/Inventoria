<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reset {--confirm : Confirm the database reset}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the database by truncating all tables except migrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->option('confirm')) {
            $this->error('This command will delete all data in the database!');
            $this->info('Use --confirm flag to proceed: php artisan db:reset --confirm');
            return;
        }

        $this->info('Resetting database...');

        // Disable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Get all tables except migrations
        $tables = \DB::select('SHOW TABLES');
        $database = env('DB_DATABASE');

        foreach ($tables as $table) {
            $tableName = $table->{'Tables_in_' . $database};
            if ($tableName !== 'migrations') {
                \DB::table($tableName)->truncate();
                $this->line("Truncated table: {$tableName}");
            }
        }

        // Re-enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('Database reset complete!');
        $this->info('You may want to run: php artisan db:seed');
    }
}
