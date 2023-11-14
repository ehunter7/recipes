<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;

    protected $fillable = ['step', 'content'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}