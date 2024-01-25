<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'role_id',
        'status',
        'isOnline'
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
    ];

    public function threads()
{
    return $this->belongsToMany(Thread::class, 'threads', 'user_id_1', 'user_id_2')
        ->withTimestamps()
        ->withPivot('id', 'create_date');
}

public function getUnreadMessageCountAttribute()
{
    return $this->messages()->where('isRead', false)->count();
}

// Add this relationship to define the messages relation
public function messages()
{
    return $this->hasMany(Message::class, 'sender_id');
}

}
