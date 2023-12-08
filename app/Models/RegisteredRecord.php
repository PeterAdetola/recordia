<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredRecord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function recorder(){
        return $this->belongsTo(User::class,'recorder_id', 'id');
    }

    public function donor(){
        return $this->belongsTo(Donor::class,'donor_id', 'id');
    }
}
