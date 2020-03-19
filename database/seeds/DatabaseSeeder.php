<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(ContactsSeeder::class);
         $this->call(GroupsTableSeeder::class);
         $this->call(CampaignTemplatesTableSeeder::class);
         $this->call(CampaignStatusesTableSeeder::class);
         $this->call(CampaignsTableSeeder::class);
    }
}
