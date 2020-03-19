<?php

use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Campaign::class, 5)->create([
            'user_id' => 1
        ]);

        factory(App\Campaign::class, 20)->create();
    }
}
