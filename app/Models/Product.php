<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Product extends Model implements  HasMedia, TranslatableContract
{
    use HasFactory , InteractsWithMedia , Translatable;
    protected $table = 'products';

    protected $with = ['translations'];
    public $translatedAttributes = ['name','description'];
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class,'category_id','id');
    }


}
