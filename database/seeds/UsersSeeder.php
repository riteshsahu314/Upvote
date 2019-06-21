<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        User::truncate();

        // create a dev user
        factory(User::class)->create([
            'name' => 'Ritesh',
            'email' => 'ritesh@example.com',
        ]);

        // create another dev user
        factory(User::class)->create([
            'name' => 'Elon',
            'email' => 'elon@example.com',
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
