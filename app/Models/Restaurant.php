<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $table = 'restaurant';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['restaurant_name', 'restaurant_status'];
    
    public function menu(){
        return $this->hasmany('menu');
    }
}
