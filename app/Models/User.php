<?php


namespace App\Models;

use App\Traits\HasPermissionsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'unique_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    

    /**
     * Boot the model and attach the event listener.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->unique_id = $user->generateUniqueId();
        });

        static::updating(function ($user) {
            if ($user->isDirty('username')) {
                $user->unique_id = $user->generateUniqueId();
            }
        });
    }

    public function generateUniqueId()
    {
        return substr(md5(uniqid($this->id . $this->username, true)), 0, 16);
    }


    public function getInitialsAttribute() {

          $name = $this->name;
          
          // Explode name on space
          $parts = explode(' ', $name);

          // Get first char of each part  
          $initials = '';
          foreach($parts as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
          }

          return $initials;

        }
}

