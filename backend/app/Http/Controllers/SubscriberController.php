<?php

namespace App\Http\Controllers;

use App\Services\SubscriberService;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    protected $subscriberService;

    public function __construct(SubscriberService $subscriberService)
    {
        $this->subscriberService = $subscriberService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $subscriber = $this->subscriberService->subscribe($validated);

        return response()->json(['message' => 'Successfully subscribed', 'subscriber' => $subscriber], 201);
    }

    public function index()
    {
        $this->authorize('viewAny', Subscriber::class); // Pour restreindre l'accès à l'admin

        $subscribers = $this->subscriberService->getAllSubscribers();

        return response()->json(['subscribers' => $subscribers]);
    }
}
