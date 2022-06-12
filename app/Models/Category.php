<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;

    // protected $table = 'categories';
    protected $guarded = ['id'];
    // protected $fillable = ['name', 'slug', 'description', 'status', 'popular', 'meta_title',  'meta_description', 'meta_keywords'];

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    public function products(){
        return $this->hasMany(Product::class);
    }
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    
}
