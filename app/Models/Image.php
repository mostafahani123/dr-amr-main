<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable=[
        'image',
        'image_categories_id',
    ];
    public function image_category(){
        return $this->belongsTo(Image_Categories::class);
         }
}
