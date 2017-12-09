<?php

namespace App;

use Spatie\Activitylog\Models\Activity as original_act;
use Illuminate\Database\Eloquent\Relations\MorphTo;
class Activity extends original_act{


    public function subject(): MorphTo{
        if (config('activitylog.subject_returns_soft_deleted_models')) {
            return $this->morphTo()->withTrashed();
        }

        return $this->morphTo();
    }

    public function causer(): MorphTo{
        if (config('activitylog.subject_returns_soft_deleted_models')) {
            return $this->morphTo()->withTrashed();
        }
        return $this->morphTo();
    }
}


