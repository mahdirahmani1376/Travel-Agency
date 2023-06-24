<?php

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class CreateUserCommand extends Command
{
    protected $signature = 'create:user';

    protected $description = 'create users command';

    public function handle()
    {
        $data['email'] = $this->ask('pleases provide an email address');
        $data['password'] = $this->secret('pleases provide a password');
        $data['name'] = $this->ask('pleases provide a name');

        $roles = $this->choice('pleases select one or more roles to assign to user',
            RoleEnum::values(),
            multiple: true,
        );

        $validator = Validator::make($data, [
            'email' => ['required', 'email','string','max:255','unique:'.User::class],
            'name' => ['required','string','max:255'],
            'password' => ['required'],
        ]);

        if ($validator->fails()){
            foreach ($validator->errors()->all() as $e){
                $this->error($e);
            }

            return -1;
        }

        DB::transaction(function () use ($data, $roles) {
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name'],
            ]);

            $user->assignRole($roles);

            $this->info("user with email {$user->email} created successfully");

            return 0;
        });
    }
}
