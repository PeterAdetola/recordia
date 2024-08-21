<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class GenerateUniqueIds extends Command
{
    protected $signature = 'generate:unique-ids';
    protected $description = 'Generate unique IDs for existing users';

    public function handle()
    {
        User::whereNull('unique_id')->chunk(100, function ($users) {
            foreach ($users as $user) {
                $user->unique_id = $user->generateUniqueId();
                $user->save();
            }
        });

        $this->info('Unique IDs generated for existing users.');
    }
}
