<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chat extends Model
{
    use HasFactory;
    protected $fillable=['name','is_blocked'];



    public function user(){
        return $this->belongsToMany(user::class);
    }
}
