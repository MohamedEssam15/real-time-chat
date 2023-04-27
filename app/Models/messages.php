<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class messages extends Model
{
    use HasFactory;
protected $fillable=['message','is_attach','sent_by','chat_id','seen'];




    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, false),
            set: fn ($value) => json_encode($value),
        );
    }
}
