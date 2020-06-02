<?php

namespace App\Console\Commands\Devloops;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devloops:create-role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Super-Admin Role';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $Role = Role::create([
                'name' => 'super-admin',
                'guard_name' => 'admin',
            ]);
            $this->info('Role Super-Admin Created with ID ' . $Role->id);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
