<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class ActivityServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Define the activities
        Activity::saving(function (Activity $activity) {
            $activity->log_name = 'records';
        });
    }
}