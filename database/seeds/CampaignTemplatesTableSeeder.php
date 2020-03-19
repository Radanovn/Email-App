<?php

use App\CampaignTemplate;
use Illuminate\Database\Seeder;

class CampaignTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = new CampaignTemplate;
        $template->name = 'Template 1';
        $template->view = 'template-1';
        $template->save();

        $template = new CampaignTemplate;
        $template->name = 'Template 2';
        $template->view = 'template-2';
        $template->save();

        $template = new CampaignTemplate;
        $template->name = 'Template 3';
        $template->view = 'template-3';
        $template->save();
    }
}
