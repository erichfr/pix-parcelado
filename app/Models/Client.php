<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
