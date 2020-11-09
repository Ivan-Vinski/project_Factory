<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    use HasFactory;
    use Translatable;

    public $timestamps = false;
    public $translatedAttributes = ['title'];
    protected $fillable = ['id', 'slug', 'created_at', 'updated_at'];
    protected $hidden = array('translations');


    public function meal() {
        return $this->hasMany('App\Models\Meal');
    }

    
}
