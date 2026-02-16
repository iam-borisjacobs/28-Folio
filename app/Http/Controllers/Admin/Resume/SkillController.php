<?php

namespace App\Http\Controllers\Admin\Resume;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::ordered()->get();
        return view('admin.resume.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.resume.skills.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'proficiency' => 'required|integer|min:1|max:100',
            'category' => 'nullable|string|max:255',
            'sort_order' => 'integer',
        ]);

        $skill = Skill::create($validated);

        // Log activity
        activity()
            ->performedOn($skill)
            ->causedBy(auth()->user())
            ->log('created skill');
        
        return redirect()->route('admin.resume.skills.index')->with('success', 'Skill added successfully.');
    }

    public function edit(Skill $skill)
    {
        return view('admin.resume.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'proficiency' => 'required|integer|min:1|max:100',
            'category' => 'nullable|string|max:255',
            'sort_order' => 'integer',
        ]);

        $skill->update($validated);

        // Log activity
        activity()
            ->performedOn($skill)
            ->causedBy(auth()->user())
            ->log('updated skill');

        return redirect()->route('admin.resume.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        // Log activity
        activity()
            ->performedOn($skill)
            ->causedBy(auth()->user())
            ->log('deleted skill');

        return redirect()->route('admin.resume.skills.index')->with('success', 'Skill deleted successfully.');
    }
}
