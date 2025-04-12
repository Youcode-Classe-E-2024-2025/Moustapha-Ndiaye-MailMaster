<?php

namespace App\Services;
namespace App\Services;

use App\Models\Campaign;
use Carbon\Carbon;

class CampaignService
{
   
    public function createCampaign($data)
    {
        return Campaign::create($data);
    }

    public function sendCampaign($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->update([
            'sent_at' => Carbon::now(),
        ]);

        return $campaign;
    }

    public function getCampaignStats($id)
    {
        $campaign = Campaign::findOrFail($id);

        $stats = [
            'opened' => 120, 
            'clicked' => 80, 
        ];

        return $stats;
    }
}
