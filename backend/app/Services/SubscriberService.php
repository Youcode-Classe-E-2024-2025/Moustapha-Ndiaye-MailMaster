<?php

namespace App\Services;
use App\Models\Subscribe;

class SubscriberService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    public function subscribe($data)
    {
        return Subscribe::create($data);
    }

    public function getAllSubscribers()
    {
        return Subscribe::all();
    }
}
