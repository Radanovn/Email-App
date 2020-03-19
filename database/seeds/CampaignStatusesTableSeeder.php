<?php

use App\CampaignStatus;
use Illuminate\Database\Seeder;

class CampaignStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$status = new CampaignStatus;
        $status->alias = 'draft';
        $status->name = 'Чернова';
        $status->save();*/

        $status = new CampaignStatus;
        $status->alias = 'sent';
        $status->name = 'Изпратнеа';
        $status->save();

        /*$status = new CampaignStatus;
        $status->alias = 'scheduled';
        $status->name = 'Scheduled';
        $status->save();*/
    }
}
