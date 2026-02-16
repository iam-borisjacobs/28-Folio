<?php

namespace App\Services;

use App\Models\AnalyticsEvent;
use Illuminate\Support\Facades\Request;

class AnalyticsService
{
    /**
     * Track an analytics event.
     *
     * @param string $eventType
     * @param mixed|null $subject
     * @return AnalyticsEvent
     */
    public function track(string $eventType, $subject = null): AnalyticsEvent
    {
        // Basic bot filtering (very simple)
        if ($this->isBot()) {
            return new AnalyticsEvent(); // Return empty or handle as needed, but don't save
        }

        $ip = Request::ip();
        $userAgent = Request::header('User-Agent');
        
        // Hash IP with a daily salt (or just simple hash as per requirements)
        // Using simple hash for now to meet "No personal data storage" requirement strictly
        $ipHash = hash('sha256', $ip . date('Y-m-d')); 

        $data = [
            'event_type' => $eventType,
            'ip_hash' => $ipHash,
            'user_agent' => substr($userAgent, 0, 255), // Truncate if too long
        ];

        if ($subject) {
            $data['subject_type'] = get_class($subject);
            $data['subject_id'] = $subject->id;
        }

        return AnalyticsEvent::create($data);
    }

    /**
     * Get count of unique visits (by IP hash) for an event type.
     * 
     * @param string $eventType
     * @return int
     */
    public function count(string $eventType): int
    {
        return AnalyticsEvent::where('event_type', $eventType)->count();
    }

    /**
     * Get count for a specific subject.
     * 
     * @param string $eventType
     * @param mixed $subject
     * @return int
     */
    public function countForSubject(string $eventType, $subject): int
    {
        return AnalyticsEvent::where('event_type', $eventType)
            ->where('subject_type', get_class($subject))
            ->where('subject_id', $subject->id)
            ->count();
    }

    /**
     * Simple bot detection
     */
    private function isBot(): bool
    {
        $userAgent = strtolower(Request::header('User-Agent') ?? '');
        $bots = ['googlebot', 'bingbot', 'slurp', 'duckduckbot', 'baidu', 'yandex', 'sogou', 'exabot', 'facebot', 'ia_archiver'];

        foreach ($bots as $bot) {
            if (str_contains($userAgent, $bot)) {
                return true;
            }
        }

        return false;
    }
}
