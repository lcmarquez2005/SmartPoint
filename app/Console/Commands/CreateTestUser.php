<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Usuario;

class CreateTestUser extends Command
{
    protected $signature = 'make:testuser';
    protected $description = 'Create a test user';

    public function handle()
    {
        Usuario::create([
            'username' => 'Luis',
            'password' => bcrypt('strociak'),
            'rol' => 'sudo',
            'empresa_id' => 1,
        ]);

        $this->info('Test user created successfully.');
    }
}