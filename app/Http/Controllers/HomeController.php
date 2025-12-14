<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the landing page.
     */
    public function index()
    {
        $featuredProducts = Product::with(['category', 'primaryImage'])
            ->active()
            ->featured()
            ->limit(8)
            ->get();
        
        $categories = Category::where('is_active', true)
            ->withCount('activeProducts')
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        return view('public.home', compact('featuredProducts', 'categories'));
    }

    /**
     * Show the about page.
     */
    public function about()
    {
        return view('public.about');
    }

    /**
     * Show the contact page.
     */
    public function contact()
    {
        return view('public.contact');
    }

    /**
     * Handle contact form submission.
     */
    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // TODO: Send email or store in database
        
        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
