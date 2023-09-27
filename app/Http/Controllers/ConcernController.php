<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Concern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class ConcernController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Concern/Index', [

            'concerns' => Concern::where('reporter_id', Auth::id())->with('reporter:id,name')->latest()->get(),

        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function issues(): Response
    {
        return Inertia::render('Concern/Issues', [

            'concerns' => Concern::where('owner_id', Auth::id())->with('reporter:id,name')->latest()->get(),

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

        $reporter = Auth::user();
        $tld = explode('@', $reporter->email)[1];

        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:255',
            'recipient_email' => 'email:rfc,dns|ends_with:@'.$tld,
        ]);

        $request->user()->concernReported()->create($validated);

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
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:255',
            'recipient_email' => 'email:rfc,dns',
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
