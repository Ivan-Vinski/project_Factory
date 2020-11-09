<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use HasFactory;
    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['created_at', 'updated_at', 'category_id'];
    protected $hidden = array('translations', 'created_at', 'updated_at', 'deleted_at', 'category_id');

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function ingredients() {
        return $this->belongsToMany('App\Models\Ingredient');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }


}
