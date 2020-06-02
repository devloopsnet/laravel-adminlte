<?php

namespace App\Console\Commands;

use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Illuminate\Contracts\Http\Kernel;
use Symfony\Component\Console\Input\InputOption;

class CallRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:call {uri}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call route from CLI';

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
        $request = Request::create($this->argument('uri'), 'GET');
        $this->info(app()[Kernel::class]->handle($request));
    }

}
