<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;
    protected $table = 'audios';

    protected $fillable = [
        'title',
        'image',
        'audio',
        'status',
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
