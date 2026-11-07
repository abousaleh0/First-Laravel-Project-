<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // 1. قُم بإضافة هذا السطر هنا ✅


#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    // 2. أضف كلمة HasApiTokens هنا في بداية الكلاس ✅
    use HasApiTokens, HasFactory, Notifiable;


    #--------------------------------------------------------------------
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            // 'password' => 'hashed',
        ];
    }

    #--------------------------------------------------------------------
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    #--------------------------------------------------------------------
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    #--------------------------------------------------------------------
    public function favoratesTasks()
    {
        return $this->belongsToMany(Task::class, 'favorates');
    }

    #--------------------------------------------------------------------
}
