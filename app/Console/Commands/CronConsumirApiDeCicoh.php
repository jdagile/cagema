<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MasterControler;

class CronConsumirApiDeCicoh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronConsumirApiDeCicoh:automaticamente';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume el Api de sistema cicoh';

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
     * @return mixed
     */
    public function handle()
    {
      $masterControler  = new MasterControler();
      $masterControler->index();
    }
}
