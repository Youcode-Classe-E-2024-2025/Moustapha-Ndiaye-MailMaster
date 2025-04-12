<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Services\NewsletterService; 


class NewsletterController extends Controller
{
    protected $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $newsletter = $this->newsletterService->createNewsletter($validated);

        return response()->json(['message' => 'Newsletter created successfully', 'newsletter' => $newsletter], 201);
    }

    public function index()
    {
        $newsletters = $this->newsletterService->getAllNewsletters();

        return response()->json(['newsletters' => $newsletters]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $newsletter = $this->newsletterService->updateNewsletter($id, $validated);

        return response()->json(['message' => 'Newsletter updated successfully', 'newsletter' => $newsletter]);
    }

    public function destroy($id)
    {
        $newsletter = $this->newsletterService->deleteNewsletter($id);

        return response()->json(['message' => 'Newsletter deleted successfully']);
    }
}

