<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Test Testov';
        $user->email = 'test@abv.bg';
        $user->email_verified_at = now();
        $user->password = bcrypt('123456');
        $user->save();

        factory(App\User::class, 5)->create();
    }
}
