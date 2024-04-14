<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;

// class Admin extends Model
class Admin extends User
{
    // use HasFactory;
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}

public function sendPasswordResetNotification($token)
{
    $url = url("admin/password/reset/$token");
    $this->notify(new ResetPasswordNotification($url));
}
