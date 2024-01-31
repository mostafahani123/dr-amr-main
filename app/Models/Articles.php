<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
         'content',
        'elder_id',
    ];
    // this  hidden data
protected $hidden =[
    'created_at',
    'updated_at',
];
public function elder(){
    return $this->belongsTo(Elder::class);
     }
}
