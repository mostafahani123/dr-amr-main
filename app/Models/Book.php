<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file',
        'image',
        'elder_id',
        'status'

    ];
    public function elder(){
   return $this->belongsTo(Elder::class);
    }
}
