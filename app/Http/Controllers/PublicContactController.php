<?php

namespace App\Http\Controllers;

use App\Models\ContactSetting;
use App\Models\Lead;
use App\Mail\NewLeadNotification;
use App\Mail\AutoReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class PublicContactController extends Controller
{
    public function send(Request $request)
    {
        // Rate Limiting (5 per minute by IP)
        $key = 'contact-form:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return response()->json(['message' => 'Too many attempts. Please try again later.'], 429);
        }
        RateLimiter::hit($key, 60);

        // Honeypot Check
        if ($request->filled('website_url')) {
            // Silently fail for bots
            return response()->json(['message' => 'Message sent!']);
        }

        // Validate
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Create Lead
        $lead = Lead::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? 'New Contact Inquiry',
            'message' => $validated['message'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Get Settings
        $settings = ContactSetting::current();

        // Send Admin Notification
        if ($settings->notification_email) {
            Mail::to($settings->notification_email)->send(new NewLeadNotification($lead));
        }

        // Send Auto Reply
        if ($settings->auto_reply_enabled && $settings->auto_reply_message) {
            Mail::to($lead->email)->send(new AutoReply($settings->auto_reply_message));
        }

        // Update Dashboard Metrics (if MetricService exists)
        // For now, we manually log activity if activity helper exists
        if (function_exists('activity')) {
            activity()
                ->performedOn($lead)
                ->log('New lead received');
        }

        return response()->json(['message' => $settings->success_message]);
    }
}
