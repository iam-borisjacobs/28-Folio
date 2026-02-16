<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewLeadNotification;
use App\Mail\AutoReply;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'website_url' => 'nullable|string', // Honeypot
        ]);

        if (!empty($validated['website_url'])) {
            // Honeypot trapped
            return response()->json(['message' => 'Message sent successfully!']);
        }

        $lead = Lead::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Send notification to admin
        $adminEmail = setting('contact_email') ?? config('mail.from.address');
        if ($adminEmail) {
            Mail::to($adminEmail)->send(new NewLeadNotification($lead));
        }

        // Send auto-reply to user
        Mail::to($lead->email)->send(new AutoReply($lead));

        return response()->json(['message' => 'Your message has been sent successfully! We will get back to you soon.']);
    }
}
