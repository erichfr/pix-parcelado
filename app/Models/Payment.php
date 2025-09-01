<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['client_id','valor_total','parcelas'];
    
    public function client() {
        return $this->belongsTo(Client::class);
    }
    public function installments() {
        return $this->hasMany(PaymentInstallment::class);
    }
}
