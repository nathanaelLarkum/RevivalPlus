<?php

namespace App\Http\Controllers;

use App\Models\Church;
use Illuminate\Http\Request;
use Inertia\Inertia; // Assuming you're using Inertia with Jetstream

class HomeController extends Controller
{
    /**
     * Display the main church search page.
     *
     * This method is responsible for showing the primary view where users
     * can search for churches. It can also pass initial data, like a
     * list of featured or recently added churches.
     */
    public function __invoke(Request $request)
    {
        // Example: Eager load relationships to prevent N+1 query problems.
        $churches = Church::query()
            ->with(['denomination', 'amenities']) // Eager load for efficiency
            ->latest() // Order by most recently created
            ->take(10) // Get the 10 newest churches
            ->get();

        // Using Inertia.js, which comes with Jetstream.
        // If you were using Blade, you would return view('welcome', compact('churches'));
        return Inertia::render('Welcome', [
            'featuredChurches' => $churches,
        ]);
    }
}
