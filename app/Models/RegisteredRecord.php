<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RegisteredRecord extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = [];

    public function recorder(){
        return $this->belongsTo(User::class,'recorder_id', 'id');
    }

    public function donor(){
        return $this->belongsTo(Donor::class,'donor_id', 'id');
    }

    public function event(){
        return $this->belongsTo(Event::class,'event_id', 'id');
    }


    protected static $logAttributes = ['amount', 'donor_id', 'payment_mode', 'payment_status'];
    protected static $logName = 'donation';

     public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(static::$logAttributes)
            ->setDescriptionForEvent(fn(string $eventName) => "registered donation {$eventName}");
    }
}
