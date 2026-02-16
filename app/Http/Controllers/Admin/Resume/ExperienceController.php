<?php

namespace App\Http\Controllers\Admin\Resume;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::ordered()->get();
        return view('admin.resume.experience.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.resume.experience.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        if ($request->has('is_current') && $request->is_current) {
            $validated['end_date'] = null;
        }

        $experience = Experience::create($validated);

        // Log activity
        activity()
            ->performedOn($experience)
            ->causedBy(auth()->user())
            ->log('created experience');
        
        return redirect()->route('admin.resume.experience.index')->with('success', 'Experience added successfully.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.resume.experience.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        if ($request->has('is_current') && $request->is_current) {
            $validated['end_date'] = null;
        }

        $experience->update($validated);

        // Log activity
        activity()
            ->performedOn($experience)
            ->causedBy(auth()->user())
            ->log('updated experience');

        return redirect()->route('admin.resume.experience.index')->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        // Log activity
        activity()
            ->performedOn($experience)
            ->causedBy(auth()->user())
            ->log('deleted experience');

        return redirect()->route('admin.resume.experience.index')->with('success', 'Experience deleted successfully.');
    }
}
