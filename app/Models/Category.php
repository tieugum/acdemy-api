<?php

namespace App\Models;

use App\Support\Eloquents\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'parent_id',
        'slug',
    ];

    protected $slugAttribute = 'name';

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($category) {
            $category->children()->delete();
        });
    }

    public static function all($columns = ['*'])
    {
        return static::query()
            ->whereNull('parent_id')
            ->with('children')
            ->get( is_array($columns) ? $columns : func_get_args() );
    }

    public static function findBySlug($slug)
    {
        return self::with('children')
            ->whereNull('parent_id')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
