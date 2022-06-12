<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['category'];


    public function scopeFilter($query, array $filters)
    {
        // filter di home
        // $query->when($filters['search'] ?? false, fn($query, $search) => 
        //     $query->where(fn($query) => 
        //         $query->where('name', 'like', '%' . $search . '%')
        //     )
        // );

        $query->when($filters['search'] ?? false, function($query, $search)
        {
            return $query->where(function($query) use ($search) 
            {
                return $query->where('name', 'like', '%' . $search . '%')->orWhere('description', 'like', '%' . $search . '%');
            });
        });

        // whereHas = punya relationship 'category'
        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn($query) => 
                $query->where('slug', $category)
            )
        );
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // public function category(){
    //     return $this->belongsTo(Category::class);
    // }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
