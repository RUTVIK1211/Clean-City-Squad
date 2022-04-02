<?php

namespace App\Console\Commands;

use Database\Factories\UserFactory;
use Illuminate\Console\Command;

class DatabaseFill extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DatabaseFill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'genrating random Data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start_time = microtime(true);


        $user = $this->ask('How Much User you need ?');
        UserFactory::factory()->count($user)->create();
        $this->info("Department generated: " . $user . " In ". (microtime("now") - $start_time) ." Sec");

    }
}