<?php

namespace App\Http\Controllers;

use App\Models\Concern;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class ConcernController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Concern/Index', [

            'concerns' => Concern::with('user:id,name')->latest()->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->concerns()->create($validated);

        return redirect(route('concerns.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Concern $concern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Concern $concern)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Concern $concern): RedirectResponse
    {
        $this->authorize('update', $concern);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $concern->update($validated);

        return redirect(route('concerns.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Concern $concern): RedirectResponse
    {
        $this->authorize('delete', $concern);
        $concern->delete();
        return redirect(route('concerns.index'));
    }
}
