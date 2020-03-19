<?php

use App\User;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Contact::class, 30)->create([
            'user_id' => 1
        ]);

        factory(App\Contact::class, 50)->create();
    }
}
