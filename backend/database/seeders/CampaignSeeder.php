<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Campaign;
use Carbon\Carbon;


class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Campaign::create([
            'subject' => 'Campagne de lancement',
            'sent_at' => Carbon::now(),
            'newsletter_id' => 1,
        ]);
    }

}
