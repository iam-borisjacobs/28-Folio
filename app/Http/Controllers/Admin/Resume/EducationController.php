<?php

namespace App\Http\Controllers\Admin\Resume;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Education;

class EducationController extends Controller
{
    public function index()
    {
        $education = Education::ordered()->get();
        return view('admin.resume.education.index', compact('education'));
    }

    public function create()
    {
        return view('admin.resume.education.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $education = Education::create($validated);

        // Log activity
        activity()
            ->performedOn($education)
            ->causedBy(auth()->user())
            ->log('created education');
        
        return redirect()->route('admin.resume.education.index')->with('success', 'Education added successfully.');
    }

    public function edit(Education $education)
    {
        return view('admin.resume.education.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $education->update($validated);

        // Log activity
        activity()
            ->performedOn($education)
            ->causedBy(auth()->user())
            ->log('updated education');

        return redirect()->route('admin.resume.education.index')->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education)
    {
        $education->delete();

        // Log activity
        activity()
            ->performedOn($education)
            ->causedBy(auth()->user())
            ->log('deleted education');

        return redirect()->route('admin.resume.education.index')->with('success', 'Education deleted successfully.');
    }
}
