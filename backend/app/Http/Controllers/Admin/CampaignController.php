<?php

namespace App\Http\Controllers\Admin;

use App\Services\CampaignService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampaignController extends Controller
{
    protected $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'newsletter_id' => 'required|exists:newsletters,id',
        ]);

        $campaign = $this->campaignService->createCampaign($validated);

        return response()->json(['message' => 'Campaign created successfully', 'campaign' => $campaign], 201);
    }

    public function send($id)
    {
        $campaign = $this->campaignService->sendCampaign($id);

        return response()->json(['message' => 'Campaign sent successfully', 'campaign' => $campaign]);
    }

    public function stats($id)
    {
        $stats = $this->campaignService->getCampaignStats($id);

        return response()->json(['stats' => $stats]);
    }
}

