<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use App\Models\Concern;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJournalEntryRequest;
use App\Http\Requests\UpdateJournalEntryRequest;

class JournalEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
        ]);
        // dd('dave');

        $concern = Concern::find($request->id);
        $concern->journalEntry($validated)->create($validated);
        return redirect(route('concerns.case'));
    }

    /**
     * Display the specified resource.
     */
    public function show(JournalEntry $journalEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JournalEntry $journalEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJournalEntryRequest $request, JournalEntry $journalEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JournalEntry $journalEntry)
    {
        //
    }
}
