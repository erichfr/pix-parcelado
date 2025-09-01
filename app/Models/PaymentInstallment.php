<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInstallment extends Model
{
    protected $fillable = ['payment_id','numero_parcela','valor','data_vencimento','status','pix_code'];
    
    public function payment() {
        return $this->belongsTo(Payment::class);
    }
}
