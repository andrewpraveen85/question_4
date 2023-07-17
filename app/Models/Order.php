<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['order_cost', 'order_status'];
    
    public function items(){
        return $this->hasmany('Item');
    }
    
    public function payment(){
        return $this->hasmany('payment');
    }
}
