<?php

namespace App\Http\Controllers\Admin\Resume;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Award;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::ordered()->get();
        return view('admin.resume.awards.index', compact('awards'));
    }

    public function create()
    {
        return view('admin.resume.awards.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'award_date' => 'nullable|date',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $award = Award::create($validated);

        // Log activity
        activity()
            ->performedOn($award)
            ->causedBy(auth()->user())
            ->log('created award');
        
        return redirect()->route('admin.resume.awards.index')->with('success', 'Award added successfully.');
    }

    public function edit(Award $award)
    {
        return view('admin.resume.awards.edit', compact('award'));
    }

    public function update(Request $request, Award $award)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'award_date' => 'nullable|date',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $award->update($validated);

        // Log activity
        activity()
            ->performedOn($award)
            ->causedBy(auth()->user())
            ->log('updated award');

        return redirect()->route('admin.resume.awards.index')->with('success', 'Award updated successfully.');
    }

    public function destroy(Award $award)
    {
        $award->delete();

        // Log activity
        activity()
            ->performedOn($award)
            ->causedBy(auth()->user())
            ->log('deleted award');

        return redirect()->route('admin.resume.awards.index')->with('success', 'Award deleted successfully.');
    }
}
