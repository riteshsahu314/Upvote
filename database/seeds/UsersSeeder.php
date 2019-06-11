<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        // create a dev user
        factory(User::class)->create([
            'name' => 'Ritesh',
            'email' => 'ritesh@example.com',
        ]);
    }
}
