<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChurchRequest;
use App\Http\Requests\UpdateChurchRequest;
use App\Models\Church;
use Inertia\Inertia;

class ChurchController extends Controller
{
    /**
     * Display a listing of the churches, often with search and filtering.
     */
    public function index()
    {
        // Here you would add your filtering and pagination logic
        $churches = Church::with('denomination')->paginate(15);

        return Inertia::render('Churches/Index', [
            'churches' => $churches,
        ]);
    }

    /**
     * Show the form for creating a new church.
     * (This would be handled on the frontend with Inertia)
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created church in storage.
     * We use a dedicated FormRequest for validation.
     */
    public function store(StoreChurchRequest $request)
    {
        $church = Church::create($request->validated());

        // You can attach related data like amenities
        if ($request->has('amenities')) {
            $church->amenities()->attach($request->amenities);
        }

        return redirect()->route('churches.show', $church)->with('success', 'Church created successfully!');
    }

    /**
     * Display the specified church.
     * We use Route Model Binding here ($church).
     */
    public function show(Church $church)
    {
        // Eager load all relationships for the detail page
        $church->load(['denomination', 'reviews.user', 'amenities', 'events.eventType']);

        return Inertia::render('Churches/Show', [
            'church' => $church,
        ]);
    }

    /**
     * Show the form for editing the specified church.
     * (Handled on the frontend with Inertia)
     */
    public function edit(Church $church)
    {
        //
    }

    /**
     * Update the specified church in storage.
     */
    public function update(UpdateChurchRequest $request, Church $church)
    {
        $church->update($request->validated());

        // Sync amenities - this adds/removes them as needed
        if ($request->has('amenities')) {
            $church->amenities()->sync($request->amenities);
        }

        return redirect()->route('churches.show', $church)->with('success', 'Church updated successfully!');
    }

    /**
     * Remove the specified church from storage.
     */
    public function destroy(Church $church)
    {
        // Add authorization here later (e.g., only an admin can delete)
        // Gate::authorize('delete', $church);

        $church->delete();

        return redirect()->route('churches.index')->with('success', 'Church deleted successfully.');
    }
}
