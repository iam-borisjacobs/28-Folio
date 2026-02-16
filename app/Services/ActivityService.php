<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class ActivityService
{
    protected $subject;
    protected $causer;

    public function performedOn(Model $model)
    {
        $this->subject = $model;
        return $this;
    }

    public function causedBy(?Authenticatable $user)
    {
        $this->causer = $user;
        return $this;
    }

    public function log(string $action)
    {
        return Activity::create([
            'user_id' => $this->causer ? $this->causer->getAuthIdentifier() : auth()->id(),
            'action' => $action,
            'subject_type' => $this->subject ? get_class($this->subject) : null,
            'subject_id' => $this->subject ? $this->subject->getKey() : null,
        ]);
    }
}
