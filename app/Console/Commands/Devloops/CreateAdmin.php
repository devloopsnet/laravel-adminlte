<?php

namespace App\Console\Commands\Devloops;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devloops:create-admin {name} {email} {pass}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin Account';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $Name = $this->argument('name');
        $Email = $this->argument('email');
        $Password = $this->argument('pass');
        /**
         * @var $Admin Admin
         */
        $Admin = Admin::query()->create([
            'name' => $Name,
            'email' => $Email,
            'password' => Hash::make($Password),
        ]);

        if ($Admin) {
            $Admin->assignRole([1]);
            $this->info('Admin ' . $Name . ' created with ID ' . $Admin->id);
        } else {
            $this->error('Could not create admin.');
        }
    }
}
