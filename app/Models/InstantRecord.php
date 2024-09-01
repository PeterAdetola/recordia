<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class InstantRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function recorder(){
        return $this->belongsTo(User::class,'recorder_id', 'id');
    }


    protected static $logAttributes = [ 'name','amount', 'payment_mode', 'payment_status', 'transaction'];
    protected static $logName = 'record';

     public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(static::$logAttributes)
            ->setDescriptionForEvent(fn(string $eventName) => "instant donation {$eventName}");
    }

}
