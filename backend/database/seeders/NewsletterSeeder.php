<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Newsletter;

class NewsletterSeeder extends Seeder
{
    public function run(): void
    {
        Newsletter::create([
            'title' => 'Welcome to MailMaster!',
            'content' => 'Thank you for subscribing. Stay tuned for updates!',
        ]);
    }
}
