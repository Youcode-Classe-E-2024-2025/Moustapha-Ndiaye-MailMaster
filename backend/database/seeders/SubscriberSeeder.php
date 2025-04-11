<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subscribe;


class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Subscribe::create(['email' => 'subscriber1@example.com']);
        Subscribe::create(['email' => 'subscriber2@example.com']);
    }
}
