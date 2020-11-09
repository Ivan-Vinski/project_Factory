<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Tag extends Model
{
    use HasFactory;
    use Translatable;

    public $timestamps = false;
    public $translatedAttributes = ['title'];
    protected $fillable = ['slug', 'created_at', 'updated_at'];
    protected $hidden = array('translations', 'pivot');

    public function meals() {
        return $this->belongsToMany('App\Models\Meal');
    }

}
