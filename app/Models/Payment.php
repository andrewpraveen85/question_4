<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['order_id', 'payment_type', 'payment_amount'];
    
    public function order(){
        return $this->belongsTo(Order::class, 'order_id')->withDefault();
    }
}
