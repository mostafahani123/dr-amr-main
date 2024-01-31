<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image_Categories extends Model
{
    use HasFactory;
protected $table='image_categories';
    protected $fillable=[
        'title'
    ];

    // Book
    public function Image(){
        return $this->hasMany(Image::class);
    }
}
