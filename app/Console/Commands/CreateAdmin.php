<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new Administrative User';

    /**
     * Execute the console command.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $email = $this->ask("Provide the user email");
        if (User::query()->where('email', $email)->exists()) {
            $this->alert('Email already in use. Upgrading user to an Administrative Account.');
        }

        $password = $this->ask("Provide a new password for the account");
        $confirm_password = $this->ask("Confirm the password by typing it again");

        if ($password !== $confirm_password) {
            $this->error('Passwords don\'t match.');
            return 0;
        }

        try {
            $user = User::query()->updateOrCreate([
                'email' => $email,
            ],[
                'name' => 'admin',
                'password' => Hash::make($confirm_password),
            ]);

            $user->is_admin = true;
            $user->save();

            $this->info('The command was successful!');
        } catch (Exception $e) {
            $this->error('Something went wrong, please check the logs.');
            Log::error($e->getMessage());
        }

        return 0;
    }
}
