<?php

namespace App\Http\Controllers\Admin\Resume;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::ordered()->get();
        return view('admin.resume.certifications.index', compact('certifications'));
    }

    public function create()
    {
        return view('admin.resume.certifications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'nullable|date',
            'credential_url' => 'nullable|url|max:255',
            'sort_order' => 'integer',
        ]);

        $certification = Certification::create($validated);

        // Log activity
        activity()
            ->performedOn($certification)
            ->causedBy(auth()->user())
            ->log('created certification');
        
        return redirect()->route('admin.resume.certifications.index')->with('success', 'Certification added successfully.');
    }

    public function edit(Certification $certification)
    {
        return view('admin.resume.certifications.edit', compact('certification'));
    }

    public function update(Request $request, Certification $certification)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'nullable|date',
            'credential_url' => 'nullable|url|max:255',
            'sort_order' => 'integer',
        ]);

        $certification->update($validated);

        // Log activity
        activity()
            ->performedOn($certification)
            ->causedBy(auth()->user())
            ->log('updated certification');

        return redirect()->route('admin.resume.certifications.index')->with('success', 'Certification updated successfully.');
    }

    public function destroy(Certification $certification)
    {
        $certification->delete();

        // Log activity
        activity()
            ->performedOn($certification)
            ->causedBy(auth()->user())
            ->log('deleted certification');

        return redirect()->route('admin.resume.certifications.index')->with('success', 'Certification deleted successfully.');
    }
}
