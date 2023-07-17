<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['restaurant_id', 'menu_name','menu_price','menu_status'];
    
    public function restaurant(){
        return $this->belongsTo(Restaurant::class, 'restaurant_id')->withDefault();
    }
    
    public function items(){
        return $this->hasmany('Item');
    }
}
