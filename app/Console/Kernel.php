<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            // Output the formatted result of now()


            // Rest of your scheduled task
            DB::table('element_de_paniers')
                ->whereExists(function ($query) {
                    $query->from('paniers')
                        ->whereColumn('element_de_paniers.panier_id', 'paniers.id')
                        ->where('paniers.status', 'new')
                        ->where('paniers.start', '=', now()->format('Y-m-d H:i:s'));
                })
                ->delete();

            // Delete rows in paniers table
            DB::table('paniers')
                ->where('status', 'new')
                ->where('start', '=', now()->format('Y-m-d H:i:s'))
                ->delete();
        })->everyTwoHours();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
