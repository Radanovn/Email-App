<?php

use App\Contact;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Group::class, 5)->create(['user_id' => 1])->each(function ($group) {
            $group->contacts()->attach(Contact::inRandomOrder()->where('user_id', $group->user->id)->limit(5)->get());
        });

        factory(App\Group::class, 10)->create()->each(function ($group) {
            $group->contacts()->attach(Contact::inRandomOrder()->where('user_id', $group->user->id)->limit(5)->get());
        });
    }
}
