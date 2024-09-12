<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Process\Pool;

class CustomerImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:customer-import {--processes=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $processes = (int) $this->option('processes');

        // If processes are specified, spawn multiple child processes
        if ($processes) {
            return $this->spawn($processes);
        }

        // Otherwise, seed the database sequentially
        for ($i = 0; $i < 10000; $i++) {
            try {
                $this->insert();
            } catch (\Throwable $th) {
                // Handle exceptions (e.g., log, retry)
            }
        }
    }

    /**
     * Spawns multiple child processes to seed the database in parallel.
     *
     * @param int $processes Number of processes to spawn
     * @return void
     */
    private function spawn(int $processes): void
    {
        Process::pool(function (Pool $pool) use ($processes) {
            for ($i = 0; $i < $processes; $i++) {
                $pool->command('php artisan app:customer-import')->timeout(60 * 5);
            }
        })
            ->start()
            ->wait();
    }

    /**
     * Inserts a new tag into the database.
     *
     * @return void
     */
    private function insert(): void
    {
        $address = array(
            'country' => \fake()->country(),
            'city' => \fake()->city(),
            // 'post_code' => \fake()->postcode(),
            'post_code' => rand(1210, 1240),
        );

        Customer::create([
            'name' => $name = fake()->word(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => '+8801750',
            'address' => json_encode($address)
        ]);
    }
}
