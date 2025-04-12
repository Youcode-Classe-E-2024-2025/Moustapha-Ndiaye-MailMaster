<?php

namespace App\Services;

use App\Models\Newsletter;

class NewsletterService
{
    public function createNewsletter($data)
    {
        return Newsletter::create($data);
    }

    public function getAllNewsletters()
    {
        return Newsletter::all();
    }

    public function updateNewsletter($id, $data)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->update($data);
        return $newsletter;
    }

    public function deleteNewsletter($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();
        return $newsletter;
    }
}
